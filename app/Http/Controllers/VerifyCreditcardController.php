<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Scooter;

class VerifyCreditcardController extends Controller
{
    public function handle(User $user){
        if($user->cc_validated == "no"){
            return "cc validated";
        }
    }
}
