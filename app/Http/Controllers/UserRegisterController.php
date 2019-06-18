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

        $local_customer = User::create([
            'cell_number' => $request->cell_number,
            'password' => $request->password,
            'stripe_id' => $customer->id,
        ]);

        $scooter = $scooter->id;
        $local_customer_id = $local_customer->id;
        $user = $local_customer;
        

    return view('verify_user', compact('scooter', 'user'));
    
       // return redirect('scooter/'.$scooter.'/verify/'.$local_customer_id);
    }
}
