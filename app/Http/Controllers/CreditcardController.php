<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Stripe;

class CreditcardController extends Controller
{
    public function show() {
        return view('creditcard');
    }

    public function addCard(){

        $stripe_id = Auth::user()->stripe_id;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $token = $_POST['stripeToken'];

        $card = \Stripe\Customer::createSource(
          $stripe_id,
          [
            'source' => $token,
          ]
        );       

        return redirect('/account');
    }
}
