<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(Request $request) {
        $id = $request->query('id');

    if ($id) {
        $students = Student::where('student_id', $id)->paginate(10);
    } else {
        $students = Student::latest()->paginate(10);
    }

    return view('student/students', [
        'students' => $students,
        'searchId' => $id
    ]);
    }
    public function createStudent() {
        return view('student/create_student');
    }
    public function store(){
        request()->validate([
            'student_id' => 'required|unique:students,student_id',
            'name' => ['required', 'min:3'],
            'lastname' => ['required' , 'min:5'],
            'email' => 'required|unique:students,email',
        ]);
    
        Student::create([
            'student_id' => request('student_id'),
            'name' => request('name'),
            'lastname' => request('lastname'),
            'email' => request('email'),
        ]);
    
        return redirect('/students');
    }
    public function oneStudent($id) {
        $student = Student::where('student_id', $id)->first();
    
        if (!$student) {
            abort(404, 'Student not found');
        }
    
        return view('student/one-student', ['student' => $student]);
    }
    public function editStudent($id) {
        $student = Student::where('student_id', $id)->first();  
        if (!$student) {
            abort(404, 'Student not found');
        }
        return view('student/edit-student', ['student' => $student]);
    }

    public function updateStudent($id) {
        $student = Student::where('student_id', $id)->first();  
        if (!$student) {
            abort(404, 'Student not found');
        }

        request()->validate([
            'student_id' => 'required|unique:students,student_id,' . $student->id,
            'name' => ['required', 'min:3'],
            'lastname' => ['required', 'min:5'],
            'email' => 'required|unique:students,email,' . $student->id,
        ]);

        $student->update([
            'student_id' => request('student_id'),
            'name' => request('name'),
            'lastname' => request('lastname'),
            'email' => request('email'),
        ]);

        return redirect('/student/' . $student->student_id);
    }
    public function deleteStudent($id) {
        $student = Student::where('student_id', $id)->first();
        if (!$student) {
            abort(404, 'Student not found');
        }
        $student->delete();
        return redirect('/students');
    }
    
}
