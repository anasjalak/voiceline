<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\VoiceCall;
use Illuminate\Support\Facades\Auth;
class CallController extends Controller
{
    /**
     * /calls/search?stud_id=...  أو  /calls/search?ticket_number=...
     * - لو فيه ticket_number: يرجّع student + ticket
     * - لو فيه stud_id فقط: يرجّع بيانات الطالب + كل التذاكر تبعه
     */
    public function search(Request $request)
    
    {
        
$student=null;
$ticket=null;
    
        $studId        = trim((string) $request->query('stud_id', ''));
        $ticketNumber  = trim((string) $request->query('ticket_number', ''));

        Log::info('[TRACE] calls.search started', [
            'stud_id_param'       => $studId,
            'ticket_number_param' => $ticketNumber,
        ]);

        try {
            // =========================
            // 1) بحث برقم التذكرة
            // =========================
            if ($ticketNumber !== '') {
                // جرّب بـ ticket_number ثم احتياطياً ticket_id
                $ticket = DB::table('tickets')
                    ->where('ticket_number', $ticketNumber)
                    ->orWhere('ticket_id', $ticketNumber)
                    ->first();

                Log::info('[TRACE] ticket lookup result', ['found' => (bool)$ticket]);

                if (!$ticket) {
                    return response()->json(['message' => 'لم يتم العثور على البلاغ'], 404);
                }

                // استنتاج الطالب بناءً على opened_type
                $student = null;

                if ($ticket->opened_type === 'student') {
                    $student = DB::table('students')->where('stud_id', $ticket->opened_by_whois)->first();
                    Log::info('[TRACE] student via ticket (opened_type=student)', [
                        'opened_by_whois' => $ticket->opened_by_whois,
                        'student_found'   => (bool)$student,
                    ]);
                } elseif ($ticket->opened_type === 'parent') {
                    $parent = DB::table('parents')->where('parent_id', $ticket->opened_by_whois)->first();
                    Log::info('[TRACE] parent via ticket (opened_type=parent)', [
                        'opened_by_whois' => $ticket->opened_by_whois,
                        'parent_found'    => (bool)$parent,
                    ]);

                    if ($parent && $parent->stud_id) {
                        $student = DB::table('students')->where('stud_id', $parent->stud_id)->first();
                        Log::info('[TRACE] student via parent->stud_id', [
                            'stud_id'       => $parent->stud_id,
                            'student_found' => (bool)$student,
                        ]);
                    }
                } else {
                    // opened_type = staff (أو غيرها): غالباً مفيش طالب مرتبط بشكل مباشر
                    Log::warning('[TRACE] ticket opened by staff - no direct student mapping', [
                        'opened_type' => $ticket->opened_type,
                    ]);
                }

                return response()->json([
                    'student' => $student, // قد يكون null لو التذكرة ليست للطالب
                    'ticket'  => $ticket,
                ]);
            }

            // =========================
            // 2) بحث برقم الطالب فقط
            // =========================
            if ($studId !== '') {
                // لو stud_id رقم، حوّله انتجر عشان أي مسافات/نص ما تلخبطش
                $studIdInt = ctype_digit($studId) ? (int) $studId : $studId;
                Log::info('[TRACE] searching student by stud_id', ['stud_id_used' => $studIdInt]);

                $student = DB::table('students')->where('stud_id', $studIdInt)->first();
                Log::info('[TRACE] student lookup result', ['found' => (bool)$student]);
 
                if (!$student) {
                    return response()->json(['message' => 'لم يتم العثور على الطالب'], 404);
                }

                // كل التذاكر المرتبطة بالطالب:
                // - لو opened_type=student: opened_by_whois = stud_id
                // - لو opened_type=parent: لازم نعرف الآباء تبع الطالب ونرجع تذاكرهم أيضاً
                $parentIds = DB::table('parents')
                    ->where('stud_id', $studIdInt)
                    ->pluck('parent_id')
                    ->all();

                $tickets = DB::table('tickets')
                    ->where(function ($q) use ($studIdInt, $parentIds) {
                        $q->where(function ($q2) use ($studIdInt) {
                            $q2->where('opened_type', 'student')
                               ->where('opened_by_whois', $studIdInt);
                        });
                        if (!empty($parentIds)) {
                            $q->orWhere(function ($q3) use ($parentIds) {
                                $q3->where('opened_type', 'parent')
                                   ->whereIn('opened_by_whois', $parentIds);
                            });
                        }
                    })
                    ->orderByDesc('issue_date')
                    ->get();

                Log::info('[TRACE] tickets fetched for student', [
                    'tickets_count' => $tickets->count(),
                    'parent_ids'    => $parentIds,
                ]);

                $student->tickets = $tickets;

                return response()->json($student);
            }

            // لا يوجد بارامترات
            Log::warning('[TRACE] no search params provided');
            return response()->json(['message' => 'الرجاء إدخال رقم الطالب أو رقم البلاغ'], 422);

        } catch (\Throwable $e) {
            Log::error('[TRACE] search exception', [
                'error'   => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
                // لو محتاجين Stacktrace بالكامل:
                // 'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['message' => 'حدث خطأ داخلي أثناء البحث'], 500);

        }
    }

      
public function store(Request $request)
{
    try {
        // ✅ التحقق من البيانات الأساسية المطلوبة
        $validated = $request->validate([
            'category' => 'required',
            'issue' => 'required',
            'priority' => 'required',
            'stud_id' => 'required',
        ]);

        // ✅ إنشاء السجل الجديد في قاعدة البيانات
        VoiceCall::create([
            'customer_type'      => $request->input('customer_type', 'student'),
            'stud_id'            => $request->input('stud_id'),
            'ticket_number'      => $request->input('ticket_number', 'UNKNOWN'),
            'category'           => $request->input('category'),
            'issue'              => $request->input('issue'),
            'Solution_Note'      => $request->input('Solution_Note'),
            'Found_Status'       => $request->input('Found_Status'),
            'Final_Status'       => $request->input('Final_Status'),
            'priority'           => $request->input('priority', 'medium'),
            'handled_by_user_id' => auth()->id() ?? 1,
            'staff_ID'           => $request->input('staff_ID'),
            'parent_name'        => $request->input('caller_Name'),
            'parent_phone'       => $request->input('phone'),
        ]);

        return redirect()->back()->with('success', '✅ تم حفظ البلاغ بنجاح!');

    } catch (\Illuminate\Validation\ValidationException $e) {
        // ⚠️ خطأ في التحقق من البيانات
        Log::warning('⚠️ Validation failed during voice call submission', [
            'inputs' => $request->all(),
            'errors' => $e->errors(),
            'user_id' => auth()->id(),
        ]);

        // 🔁 يرجع المستخدم للصفحة مع الرسالة والبيانات القديمة
        return redirect()->back()
            ->with('error', 'الرجاء التأكد من تعبئة جميع الحقول المطلوبة بشكل صحيح.')
            ->withErrors($e->errors())
            ->withInput();

    } catch (\Exception $e) {
        // ⚙️ أي خطأ آخر (مثل خطأ في قاعدة البيانات)
        Log::error('❌ Error while saving voice call', [
            'message' => $e->getMessage(),
            'inputs' => $request->all(),
            'trace' => $e->getTraceAsString(),
            'user_id' => auth()->id(),
        ]);

        // 🔁 إرجاع المستخدم مع المدخلات السابقة
        return redirect()->back()
            ->with('error', 'حدث خطأ أثناء حفظ البلاغ، الرجاء المحاولة لاحقاً.')
            ->withInput();
    }
}

}