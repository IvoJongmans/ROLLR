<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scooter;
use App\User;
use Stripe;

class UserRegisterController extends Controller
{
    public function index(Scooter $scooter) {

        return view('register', compact('scooter'));
    }

    public function store(Request $request, Scooter $scooter) {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = \Stripe\Customer::create([
            "phone" => $request->cell_number,
            "description" => "Customer for stepup.com",
            "metadata" => ["scooter_id" => $request->scooter_id]
          ]);

        $user = User::create([
            'cell_number' => $request->cell_number,
            'password' => bcrypt($request->password),
            'stripe_id' => $customer->id,
        ]);     
        
        if (Hash::check($request->password, $database_password)) {
            Auth::loginUsingId($user_id);
            if (Auth::check()) {
                return redirect('scooter/'.$scooter->id.'/user/'.$user_id);
            }
        

    // return view('verify_user', compact('scooter', 'user'));
    
       // return redirect('scooter/'.$scooter.'/verify/'.$local_customer_id);
    }
}
