<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Scooter;

class UserController extends Controller
{
    public function dashboard(Scooter $scooter,User $user){

            if(Auth::check()) {
               
            return view('dashboard', compact('scooter', 'user'));

            }
            
        
    }
}
