<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class StripeWebhookController extends Controller
{
    public function handle(Request $request) {

        
        $stripe_id = $request->data['object']['id'];
        return $stripe_id;
        // User::where('stripe_id', $stripe_id)->update(array('user_validated' => 'yes'));
    }
}
