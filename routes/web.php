<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Student;

class Users {
    public static function all() {
        return [
            ['id'=>1, 'name' => 'Asomiddin', 'email' => 'asomiddin@gmail.com'],
            ['id'=>2, 'name' => 'Shoxrux', 'email' => 'shoxrux@gmail.com'],
            ['id'=>3, 'name' => 'Ogabek', 'email' => 'ogabek@gmail.com'],
        ];
    }
}

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

// students
Route::get('/students', function (Request $request) {
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
});

// create student

Route::get('/student/create' , function () {
    return view('student/create_student');
});

// store student
Route::post('/student/store' , function () {
    
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
});

// one student

Route::get('/student/{id}', function ($id) {
    $student = Student::where('student_id', $id)->first();
    
    if (!$student) {
        abort(404, 'Student not found');
    }

    return view('student/one-student', ['student' => $student]);
});
// edit student
Route::get('/student/{id}/edit', function ($id) {
    $student = Student::where('student_id', $id)->first();  
    if (!$student) {
        abort(404, 'Student not found');
    }
    return view('student/edit-student', ['student' => $student]);
});
// update student
Route::patch('/student/{id}', function ($id) {
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
});
// delete student
Route::delete('/student/{id}', function ($id) {
    $student = Student::where('student_id', $id)->first();
    if (!$student) {
        abort(404, 'Student not found');
    }
    $student->delete();
    return redirect('/students');
});

// jobs

Route::get('/jobs', function () {
    return view('jobs');
});

// users
Route::get('/users', function () {
    $users = Users::all();

    return view('user/users' , ['users' => $users]);
});
Route::get('/user/{id}', function ($id) {
    $users = Users::all();

    // ID bo‘yicha to‘g‘ri userni topish
    $user = collect($users)->firstWhere('id', $id);

    // Agar topilmasa 404 chiqsin
    if (!$user) {
        abort(404, 'User not found');
    }

    return view('user/user', compact('user'));
});

// contact
Route::get('/contact', function () {
    return view('contact');
});
