<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Models\User;

Route::view("/", "home");
Route::view("/about", "about");
Route::view("/contact", "contact");

// students crud
Route::get("/students", [StudentController::class, "index"]);
Route::get("/student/create", [StudentController::class, "createStudent"]);
Route::post("/student/store", [StudentController::class, "store"]);
Route::get("/student/{id}", [StudentController::class, "oneStudent"]);
Route::get("/student/{id}/edit", [StudentController::class, "editStudent"]);
Route::patch("/student/{id}", [StudentController::class, "updateStudent"]);
Route::delete("/student/{id}", [StudentController::class, "deleteStudent"]);
// mail
Route::get("/mail", function () {
  
    return "Done";
});

// Auth register
Route::get("/register", [RegisterController::class, "create"]);
Route::post("/register", [RegisterController::class, "store"]);
// Login va logout
Route::get("/login", [LoginController::class, "create"])->name("login");
Route::post("/login", [LoginController::class, "store"]);
Route::post("/logout", [LoginController::class, "logout"]);

// users
Route::get("/users", [UserController::class, "index"]);
Route::get("/user/{id}", [UserController::class, "oneUser"]);

// posts
Route::get("/posts", [PostController::class, "index"]);
Route::get("/post/{id}", [PostController::class, "onePost"]);
Route::get("/posts/create", [PostController::class, "create"])->middleware(
    "auth",
);
Route::post("/posts", [PostController::class, "store"]);
Route::get("/post/{id}/edit", [PostController::class, "edit"])->middleware(
    "auth",
);
Route::patch("/post/{id}", [PostController::class, "update"])->middleware(
    "auth",
);
Route::delete("/post/{id}", [PostController::class, "delete"])->middleware(
    "auth",
);
// comment
Route::post("/comment", [CommentController::class, "store"])->middleware(
    "auth",
);
Route::patch("/comment/{id}", [CommentController::class, "update"])->middleware(
    "auth",
);
Route::delete("/comment/{id}", [
    CommentController::class,
    "delete",
])->middleware("auth");
