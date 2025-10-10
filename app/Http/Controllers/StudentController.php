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
         $request->validate([
            'stud_id'=>'required',
            'stud_name'=>'required' 
          //  'stud_surname'=>'required',
          //  'familyname'=>'required',
          //  'curr_sem'=>'required'
       
            ]);  
         student::create([
            'stud_id'=>$request->stud_id,
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
    // نضيف آخر نتيجة أكاديمية
    ->leftJoin(DB::raw('(SELECT st.stud_id, st.semester, st.cgpa_status_code, st.CGPA, cs.status_desc_e as status
                         FROM stud_transcript_table st
                         JOIN cgpa_status cs ON st.cgpa_status_code = cs.cgpa_status_code
                         WHERE st.semester = (
                             SELECT MAX(semester) 
                             FROM stud_transcript_table 
                             WHERE stud_id = st.stud_id
                         )
                        ) as lastResult'), 'lastResult.stud_id', '=', 'sp.stud_id')
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
        // الحقول الجديدة من آخر نتيجة
        'lastResult.semester as last_semester',
        'lastResult.CGPA as last_cgpa',
        'lastResult.status as last_status'
    ])
    ->first();

$clearance = DB::connection('mysql_sis2')
    ->table('stud_course_mark as t')
    ->join('course_desc as c', 't.course_code', '=', 'c.course_code') // join مع course_desc
    ->join('student_profile_common as spc', function($join) {
        $join->on('t.stud_id', '=', 'spc.stud_id')
             ->on('t.batch', '=', 'spc.batch'); // 👈 إضافة شرط batch
    })
    ->where('t.stud_id', $student->stud_id)
    ->whereIn('t.grade', ['F', 'Z', 'I'])
    ->orderBy('t.stud_id')
    ->orderBy('t.semester')
    ->select(
        't.stud_id',
        'spc.batch',          // batch من student_profile_common
        't.course_code',
        'c.course_name',      // اسم الكورس من course_desc
        't.semester',
        DB::raw("CONCAT(
            t.grade,
            CASE WHEN t.sub_grade1 IS NOT NULL AND t.sub_grade1 <> '' 
                 THEN CONCAT('/', t.sub_grade1) ELSE '' END,
            CASE WHEN t.sub_grade2 IS NOT NULL AND t.sub_grade2 <> '' 
                 THEN CONCAT('/', t.sub_grade2) ELSE '' END
        ) as clearance_grade"),
        't.remark'
    )
    ->get();







             $lastResult = DB::connection('mysql_sis2')
    ->table('stud_transcript_table as st')
    ->join('cgpa_status as cs', 'st.cgpa_status_code', '=', 'cs.cgpa_status_code')
    ->where('st.stud_id', $student->stud_id)
    ->orderByDesc('st.semester')
    ->select(
        'st.semester',
        'st.cgpa_status_code',
        'st.CGPA',
        'cs.status_desc_e as status'
    )
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
            'tickets' => $tickets,
            'clearance'=>$clearance
          
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

 $ticket = DB::connection('mysql_Hdesk')
    ->table('hesk_tickets as t')
    ->leftJoin('hesk_users as u', 't.owner', '=', 'u.id')
    ->where('t.trackid', $trackid)
    ->select(
        't.trackid',
        't.subject',
        't.status as status_code',
        't.priority as priority_code',
        't.owner',
        DB::raw("COALESCE(u.name, 'Unassigned') as owner_name"),
        DB::raw("CASE 
            WHEN t.priority = 1 THEN 'Normal'
            WHEN t.priority = 2 THEN 'Middle' 
            WHEN t.priority = 3 THEN 'High'
            WHEN t.priority = 4 THEN 'Critical'
            ELSE 'Unknown'
        END as priority"),
        DB::raw("CASE 
            WHEN t.status = 1 THEN 'CUSTOMER REPLIED'
            WHEN t.status = 2 THEN 'STAFF REPLIED' 
            WHEN t.status = 3 THEN 'RESOLVED'
            WHEN t.status = 4 THEN 'IN PROGRESS'
            ELSE 'Unknown'
        END as foundStatus")
    )
    ->first();


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

 