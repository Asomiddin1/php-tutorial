<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
       $users = User::all();

       return view('user/users' , ['users' => $users]);
    }
    public function oneUser($id){
         $users = User::all();

    // ID bo‘yicha to‘g‘ri userni topish
    $user = collect($users)->firstWhere('id', $id);

    // Agar topilmasa 404 chiqsin
    if (!$user) {
        abort(404, 'User not found');
    }

    return view('user/user', compact('user'));
    }
}
