<?php

use Illuminate\Support\Facades\Route;

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
    return view('users');
});

Route::get('/contact', function () {
    return view('contact');
});
