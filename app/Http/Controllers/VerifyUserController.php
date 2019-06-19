<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scooter;
use App\User;

class VerifyUserController extends Controller
{   
    public function handle(User $user){
        if($user->user_validated == "no"){
            return "user validated";
        }
    }
}
