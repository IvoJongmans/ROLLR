<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;

// public function validateCredentials(UserContract $user, array $credentials)

class AdminController extends Controller
{
// Admin Panel with User model and default login



// Admin Panel with custom login and custom model
    // public function home(){
    //     return view('admin/home');
    // }
    // public function login(Request $request)
    // {
    //     $username = $request['username'];
    //     $password = $request['password']; 

    //     $database_password = Admin::where('username', $request['username'])->value('password');
    //     $user_id = Admin::where('username', $request['username'])->value('id');
    //     $user = Admin::where('username', $request['username']);

    //     if ($database_password == $request['password']){
    //     Auth::guard('admin')->loginUsingId($user_id);
    //     return redirect()->route('test');
    //     }
    //     else return  redirect()->route('admin'); 
    // }
    // public function test()
    // {   
    //     return view('admin/test'); 
    // }
}

