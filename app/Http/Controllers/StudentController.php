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
        'parents' => $tickets,
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
            'status'    => $student->status_code,
            'semester'  => $student->curr_sem,
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
    $student = Student::with([ 'tickets'])->where('stud_id', $id)->first();
 
    if (!$student) {
        return response()->json([
            'success' => false,
            'message' => 'Student not found'
        ], 404);
    }
    session()->forget('tickets'); 
   session(key: [
        'student_id'   => $student->stud_id ?? null,
        'student_name' =>trim(($student->stud_name ?? '') . ' ' . ($student->stud_surname ?? '') . ' ' . ($student->familyname ?? '')),
        'faculty'   => $student->faculty_code ?? null,
            'major'     => $student->major_code ?? null,
            'batch'     => $student->batch ?? null,
            'gpa'       => $student->stud_gpa ?? null,
            'cgpa'      => $student->stud_cgpa ?? null,
            'status'    => $student->status_code ?? null,
            'semester'  => $student->curr_sem ?? null,
         //   'courses'   => $student->courses  ?? [],
            'tickets'   => $student->tickets  ?? [],
    ]);
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
            'status'    => $student->status_code,
            'semester'  => $student->curr_sem,
     //       'courses'   => $student->courses,
            'tickets'   => $student->tickets,
        ]
    ]);
}

}