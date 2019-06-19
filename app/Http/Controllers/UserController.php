<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Scooter;

class UserController extends Controller
{
    public function dashboard(Scooter $scooter,User $user){

            $auth_id = Auth::id();
            $user_id = $user->id;

            if(Auth::check() && Auth::id() == $user_id) {
               
            return view('dashboard', compact('scooter', 'user'));

            }

            else{
                return redirect('scooter/'.$scooter->id.'/login');
            }
            
        
    }
}
