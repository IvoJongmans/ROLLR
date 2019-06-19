<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeCreditcardVerifyController extends Controller
{
    public function handle(Request $request) {
        
        $stripe_id = $request->data['object']['customer'];
        User::where('stripe_id', $stripe_id)->update(array('cc_validated' => 'yes'));
        // return "Creditcard was validated";

        return $stripe_id;
    }
}
