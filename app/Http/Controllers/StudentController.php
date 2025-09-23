<?php

namespace App\Http\Controllers;
use App\Models\Major;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
class StudentController extends Controller
{

  public function insert(Request $request)
  
    {
       /* $request->validate([
            'stud_id'=>'required'
            'stud_name'=>'required',
            'stud_surname'=>'required',
            'familyname'=>'required',
            'curr_sem'=>'required'
       
            ]); */
         student::create([
            'stud_id'=>$request->index,
            'stud_name'=>$request->studentName
          //  'curr_sem'=>$request->curr_sem,

        ]);
 
        return redirect()->route('student.insert')->with('success','New User created successfully');
  
    }







    
    /**
     * Show the search form.
     */
    public function searchForm()
    {
        return view('students.search');
    }

    /**
     * Handle search request and return results.
     */
    public function search(Request $request)
    {
        $query = Student::query();

        // Filter by name (if user typed something)
        if ($request->filled('name')) {
            $query->where('stud_id', 'LIKE', '%' . $request->name . '%');
        }

        // Filter by surname
        if ($request->filled('surname')) {
            $query->where('stud_surname', 'LIKE', '%' . $request->surname . '%');
        }

        // Filter by faculty
        if ($request->filled('faculty')) {
            $query->where('faculty_code', $request->faculty);
        }

        $students = $query->get();

        return view('students.results', compact('students'));
    }

   public function find(Request $request)
{
    // Query students from db1
    $studentsQuery = DB::connection('mysql')
        ->table('students');

    if ($request->filled('name')) {
        $studentsQuery->where('stud_id', 'LIKE', '%' . $request->stud_id . '%');
    }

    $students = $studentsQuery->get();

    // Query parents from db2
   // $ticketQuery = DB::connection('mysql2')
  $ticketQuery = db:: connection('second_db')
        ->table('tickets');

    if ($request->filled('ticket_number')) {
        $ticketQuery->where('ticket_number', 'LIKE', '%' . $request->ticket_number . '%');
    }

    $tickets = $ticketQuery->get();

    return view('students.results', [
        'students' => $students,
        'tickets' => $tickets,
    ]);
}



 
public function getStudent_old($id)
{
    $student = Student::where('stud_id', $id)->first();

    if (!$student) {
        return response()->json([
            'success' => false,
            'message' => 'Student not found'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'student' => [
            'stud_id'   => $student->stud_id,
            'name'      => $student->stud_name . ' ' . $student->stud_surname . ' ' . $student->familyname,
            'faculty'   => $student->faculty_code,
            'major'     => $student->major_code,
            'batch'     => $student->batch,
            'gpa'       => $student->stud_gpa,
            'cgpa'      => $student->stud_cgpa,
     //       'status'    => $student->status_code,
      //      'semester'  => $student->curr_sem,
        ]
    ]);
}
public function getStudentData($stud_id) {
    // استرجاع بيانات الطالب
    $student = DB::table('students')->where('stud_id', $stud_id)->first();
    
    if (!$student) {
        return response()->json([], 404);  // إذا لم يتم العثور على الطالب
    }

    // استرجاع المواد الخاصة بالطالب
    $subjects = DB::table('subjects')->where('stud_id', $stud_id)->get();
    
    // استرجاع التذاكر الخاصة بالطالب
    $tickets = DB::table('tickets')->where('stud_id', $stud_id)->orderBy('created_at', 'desc')->get();
    
    // إرجاع البيانات بشكل JSON
    return response()->json([
        'student' => $student,
        'subjects' => $subjects,
        'tickets' => $tickets
    ]);
}
public function studentView(Request $request)
{
    $data = $request->only(['name', 'faculty', 'batch', 'major']);

    // Now pass the data to the next blade
    return view('studentview', $data);
}



public function getStudent($id)
{
 
    try {
        // التحقق من صحة رقم الطالب
        if (empty($id) || !is_numeric($id)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid student ID'
            ], 400);
        }

        // استرجاع بيانات الطالب
        $student = DB::connection('mysql_sis2')->table('student_profile_e as sp')
            ->join('student_profile_common as SPC', 'SPC.stud_id', '=', 'sp.stud_id')
            ->join('faculty as F', 'F.faculty_code', '=', 'SPC.faculty_code')
            ->join('major as M', function($join) {
                $join->on('M.major_code', '=', 'SPC.major_code')
                     ->on('M.faculty_code', '=', 'F.faculty_code');
            })
            ->where('sp.stud_id', $id)
            ->select([
                DB::raw("CASE 
                            WHEN SPC.status_code = 1 THEN 'Active'
                            WHEN SPC.status_code = 0 THEN 'Not Active'
                            ELSE 'No Data'
                        END as status_code"),
                'M.abbreviation as major_code',
                'F.abbreviation as faculty_code',
                'sp.stud_id',
                'sp.stud_name',
                'sp.stud_surname',
                'sp.familyname',
                'sp.lastName',
                'SPC.batch',
                'SPC.curr_sem',
            ])
            ->first();

             $lastResult = DB::connection('mysql_sis2')->table('results')
                    ->where('stud_id', $student->stud_id)
                    ->orderByDesc('semester')
                    ->select('semester', 'status', 'CGPA')
                    ->first();
        // تسجيل الاستعلام للتصحيح
        \Log::info('Student query executed for ID: ' . $id);
        \Log::info('Student data: ' . json_encode($student));

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }

        // نجيب التذاكر
        $tickets = DB::connection('mysql_Hdesk')->table('hesk_tickets')
            ->where('custom1', $student->stud_id)
             ->select('trackid', 'subject', 'status as status_code', DB::raw("CASE 
                    WHEN priority = 1 THEN 'Normal'
                    WHEN priority = 2 THEN 'Middle' 
                    WHEN priority = 3 THEN 'High'
                    WHEN priority = 4 THEN 'Critical'
                    ELSE 'Unknown'
                END as priority"),'priority as priority_code', DB::raw("CASE 
                    WHEN status = 1 THEN 'CUSTOMER REPLIED'
                    WHEN status = 2 THEN 'STAFF REPLIED' 
                    WHEN status = 3 THEN 'RESOLVED'
                    WHEN status = 4 THEN 'IN PROGRESS'
                    ELSE 'Unknown'
                END as foundStatus")) 
               ->get();

       //  Log::info('Tickets found: ' . $tickets->count());

        // Extract ticket IDs and names for session
        $ticketIds = $tickets->pluck('trackid')->toArray();
        $ticketNames = $tickets->pluck('name')->toArray();



    
        // حفظ في الجلسة
       // session()->put([
         //   'student_id' => $student->stud_id,
        //    'student_name' => trim(($student->stud_name ?? '') . ' ' . 
         //                       ($student->stud_surname ?? '') . ' ' . 
         //                       ($student->familyname ?? '') . ' ' . 
         //                       ($student->lastName ?? '')),
       //     'faculty' => $student->faculty_code ?? null,
         //   'major' => $student->major_code ?? null,
         //   'batch' => $student->batch ?? null,
         //   'status' => $student->status_code ?? null,
       //     'semester' => $student->curr_sem ?? null,
        ///    'tickets_ID' => $ticketIds,
        //    'tickets_name' => $ticketNames,
       // ]);
 // dd($lastResult);
        return response()->json([
            'success' => true,
            'student' => [
                'stud_id' => $student->stud_id,
                'name' => trim(($student->stud_name ?? '') . ' ' . 
                              ($student->stud_surname ?? '') . ' ' . 
                              ($student->familyname ?? '') . ' ' . 
                              ($student->lastName ?? '')),
                'faculty' => $student->faculty_code,
                'major' => $student->major_code,
                'batch' => $student->batch,
              //  'status' => $student->status_code,
              //  'semester' => $student->curr_sem, 
                'semester' => $lastResult->semester ?? null,
                'status'   => $lastResult->status ?? 'No Data',
                'last_cgpa'     => $lastResult->CGPA ?? null,
            ],
            'tickets' => $tickets
          
        ]);

    } catch (\Exception $e) {
        \Log::error('Error in getStudent: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        
        return response()->json([
            'success' => false,
            'message' => 'Server error: ' . $e->getMessage()
        ], 500);
    }
}
public function getTicket($trackid)
{
    try {

 $ticket =  DB::connection('mysql_Hdesk')->table('hesk_tickets')
            ->where('trackid', $trackid)
             ->select('trackid', 'subject', 'status as status_code', DB::raw("CASE 
                    WHEN priority = 1 THEN 'Normal'
                    WHEN priority = 2 THEN 'Middle' 
                    WHEN priority = 3 THEN 'High'
                    WHEN priority = 4 THEN 'Critical'
                    ELSE 'Unknown'
                END as priority"),'priority as priority_code', DB::raw("CASE 
                    WHEN status = 1 THEN 'CUSTOMER REPLIED'
                    WHEN status = 2 THEN 'STAFF REPLIED' 
                    WHEN status = 3 THEN 'RESOLVED'
                    WHEN status = 4 THEN 'IN PROGRESS'
                    ELSE 'Unknown'
                END as foundStatus"))->first() ;

   /*     $ticket = DB::connection('mysql_Hdesk')
            ->table('hesk_tickets')
            ->where('trackid', $trackid)
            ->first();
*/
        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'ticket' => $ticket
        ]);
    } catch (\Exception $e) {
        \Log::error('Error in getTicket: '.$e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Server error: '.$e->getMessage()
        ], 500);
    }
}

}

 