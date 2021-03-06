<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Stripe;

class VerifyUserCreditcardController extends Controller
{
    public function verify($scooter, $user){

        $stripe_id = User::where('id', $user)->value('stripe_id');

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $token = $_POST['stripeToken'];

        $card = \Stripe\Customer::createSource(
          $stripe_id,
          [
            'source' => $token,
          ]
        );

        

        return view('verify_cc', compact('scooter','user'));

        // $charge = \Stripe\Charge::create([
        //     'amount' => 100,
        //     'currency' => 'eur',
        //     'description' => 'Card Verification',
        //     'customer' => $stripe_id,
        // ]);
    }
}
