<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/students', function () {
    return view('students');
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
