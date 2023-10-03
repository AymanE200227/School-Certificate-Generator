<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
     $searchQuery = $request->query('search');
     if($searchQuery){
        $students = Student::where('code', 'LIKE', '%'.$searchQuery.'%')
        ->orWhere('name', 'LIKE', '%'.$searchQuery.'%')
        ->orWhere('grade', 'LIKE', '%'.$searchQuery.'%')
        ->orWhere('birthday', 'LIKE', '%'.$searchQuery.'%')
        ->orderBy('id', 'desc')
        ->paginate(2);
     } else {
        $students = Student::orderBy('id', 'desc')->paginate(10); 
     }
     return view('Students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
