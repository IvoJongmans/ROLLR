<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Scooter;
use App\User;
use Session;


class UserLoginController extends Controller
{
    public function index(Scooter $scooter){
        return view('login', compact('scooter'));
    }

    public function login(Scooter $scooter, Request $request){

        $database_password = User::where('cell_number', $request->cell_number)->value('password');
        $user_id = User::where('cell_number', $request->cell_number)->value('id');
        $user = User::where('cell_number', $request->cell_number);

        if (Hash::check($request->password, $database_password)) {
            Auth::loginUsingId($user_id);
            if (Auth::check()) {
                return redirect('scooter/'.$scooter->id.'/user/'.$user_id);
            }
            
        }
        else {
            Session::flash("nomatch", "This combination of cellphone number and password doesn't exist.");
            return redirect('scooter/'.$scooter->id.'/login');
        }
    }
}
