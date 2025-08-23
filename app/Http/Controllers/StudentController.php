<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
class StudentController extends Controller
{
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


}
