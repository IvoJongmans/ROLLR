<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scooter;
use App\User;

class VerifyUserController extends Controller
{
    public function verify(Scooter $scooter, User $user) {

        return view('verify_user', compact('scooter', 'user'));
    }

    public function handle(){
        return 'test';
    }
}
