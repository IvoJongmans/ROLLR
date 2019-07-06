<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class IdealController extends Controller
{
    public function show() {

        $stripe_id = Auth::user()->stripe_id;

        return view('ideal', compact('stripe_id'));
    }

    public function chargeable(Request $request) {

        return "YOLO";

        // $source = $request->data['object']['id'];
        // $stripe_id = $request->data['object']['owner']['name'];
        // $amount = $request->data['object']['amount'];

        // \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // \Stripe\Charge::create([
        //     "amount" => $amount,
        //     "currency" => "eur",
        //     "source" => $source, // obtained with Stripe.js
        // ]);
    }

    public function charge_succeeded(Request $request) {

        if(substr($request['data']['object']['payment_method'], 0 , 4) == "card") {

            return "Card";
            
        }

        else{

        $stripe_id = $request['data']['object']['source']['owner']['name'];

        $current_credit = User::where('stripe_id', $stripe_id)->value('credit');
        
        $extra_credit = $request['data']['object']['amount'] / 100;

        User::where('stripe_id', $stripe_id)->update(array('credit' => ($current_credit + $extra_credit)));

        return "iDEAL";

        }
    }
}
