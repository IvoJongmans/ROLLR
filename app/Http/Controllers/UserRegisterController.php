<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Scooter;
use App\User;
use Stripe;
use Session;

class UserRegisterController extends Controller
{
    public function index(Scooter $scooter) {

        return view('register');
    }

    public function store(Request $request) {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = \Stripe\Customer::create([
            "phone" => $request->cell_number,
            "description" => "Customer for stepup.com",
          ]);

        $user = User::create([
            'cell_number' => $request->cell_number,
            'password' => bcrypt($request->password),
            'stripe_id' => $customer->id,
        ]);      

        $database_password = User::where('cell_number', $request->cell_number)->value('password');
        $user_id = User::where('cell_number', $request->cell_number)->value('id');
        
        if (Hash::check($request->password, $database_password)) {
            Auth::loginUsingId($user_id);
            if (Auth::check()) {
                return redirect('/account');
            }            
        }
        

    // return view('verify_user', compact('scooter', 'user'));
    
       // return redirect('scooter/'.$scooter.'/verify/'.$local_customer_id);
    }
}
