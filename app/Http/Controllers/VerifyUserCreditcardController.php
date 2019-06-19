<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class VerifyUserCreditcardController extends Controller
{
    public function verify($scooter, $user){

        $stripe_id = User::where('id', $user)->value('stripe_id');

        \Stripe\Stripe::setApiKey('sk_test_PTJVEcRxvyPpiuqtrhdPH6KW00IsgKLAms');

        $token = $_POST['stripeToken'];

        $card = \Stripe\Customer::createSource(
          $stripe_id,
          [
            'source' => $token,
          ]
        );

        // $charge = \Stripe\Charge::create([
        //     'amount' => 100,
        //     'currency' => 'eur',
        //     'description' => 'Card Verification',
        //     'customer' => $stripe_id,
        // ]);
    }
}
