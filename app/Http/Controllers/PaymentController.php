<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;

class PaymentController extends Controller
{
    public function handle(Request $request) {
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        \Stripe\Customer::create([
            "email" => $request->email,
            "name" => $request->name,
            "description" => "Customer for stepup.com",
            "source" => "tok_visa", // obtained with Stripe.js
            "metadata" => ["scooter_id" => $request->scooter_id]
          ]);

        
    }
}
