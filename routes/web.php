<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Controllers\StudentController;

class Users {
    public static function all() {
        return [
            ['id'=>1, 'name' => 'Asomiddin', 'email' => 'asomiddin@gmail.com'],
            ['id'=>2, 'name' => 'Shoxrux', 'email' => 'shoxrux@gmail.com'],
            ['id'=>3, 'name' => 'Ogabek', 'email' => 'ogabek@gmail.com'],
        ];
    }
}

Route::view('/', 'home');
Route::view('/jobs', 'jobs');
Route::view('/about', 'about');
Route::view('/contact', 'contact');


// students crud
Route::get('/students', [StudentController::class, 'index']);
Route::get('/student/create' , [StudentController::class, 'createStudent']);
Route::post('/student/store' , [StudentController::class, 'store']);
Route::get('/student/{id}', [StudentController::class, 'oneStudent']);
Route::get('/student/{id}/edit', [StudentController::class, 'editStudent']);
Route::patch('/student/{id}', [StudentController::class, 'updateStudent']);
Route::delete('/student/{id}', [StudentController::class, 'deleteStudent']);

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


