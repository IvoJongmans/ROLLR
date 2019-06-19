<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Scooter;

class UserController extends Controller
{
    public function dashboard(Scooter $scooter,User $user){

        return view('dashboard', compact('scooter', 'user'));
    }
}
