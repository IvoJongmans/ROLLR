<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeWebhookController extends Controller
{
    public function handle(Request $request) {
        return $request;
    }
}
