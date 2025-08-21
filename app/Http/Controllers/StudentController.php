<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

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
}
