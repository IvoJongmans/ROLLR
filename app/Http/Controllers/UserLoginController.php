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
    public function index(){
        return view('login');
    }






    public function login(Request $request){

        $database_password = User::where('cell_number', $request->cell_number)->value('password');
        $user_id = User::where('cell_number', $request->cell_number)->value('id');
        $user = User::where('cell_number', $request->cell_number);

        if (Hash::check($request->password, $database_password)) {
            Auth::loginUsingId($user_id);
            if (Auth::check()) {
                if(auth()->user()->isAdmin()){
                    return redirect('/admin');
                }
                else   
                return redirect('/account');
            }
            
        }
        else {
            Session::flash("nomatch", "This combination of cellphone number and password doesn't exist.");
            return redirect('/login');
        }
    }
}
