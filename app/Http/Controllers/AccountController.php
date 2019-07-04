<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class AccountController extends Controller
{
    public function index() {

        return view('account');

    }
}
