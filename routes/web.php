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

Route::get('/students', function (Request $request) {
    $id = $request->query('id');

    if ($id) {
        $students = Student::where('student_id', $id)->paginate(10);
    } else {
        $students = Student::latest()->paginate(10);
    }

    return view('students', [
        'students' => $students,
        'searchId' => $id
    ]);
});

Route::get('/student/create' , function () {
    return view('create_student');
});

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

Route::get('/jobs', function () {
    return view('jobs');
});

Route::get('/users', function () {
    $users = Users::all();

    return view('users' , ['users' => $users]);
});
Route::get('/user/{id}', function ($id) {
    $users = Users::all();

    // ID bo‘yicha to‘g‘ri userni topish
    $user = collect($users)->firstWhere('id', $id);

    // Agar topilmasa 404 chiqsin
    if (!$user) {
        abort(404, 'User not found');
    }

    return view('user', compact('user'));
});

Route::get('/contact', function () {
    return view('contact');
});
