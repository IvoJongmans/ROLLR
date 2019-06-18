<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class StripeWebhookController extends Controller
{
    public function handle(Request $request) {

        return $request;
        // $stripe_id = $request->data['object']['customer'];
        // User::where('stripe_id', $stripe_id)->update(array('user_validated' => 'yes'));
    }
}
