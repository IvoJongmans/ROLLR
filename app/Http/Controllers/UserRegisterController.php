<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Scooter;
use App\User;
use Stripe;
use Session;
use Nexmo\Laravel\Facade\Nexmo;

class UserRegisterController extends Controller
{
    public function index(Scooter $scooter) {

        return view('register');
    }

    public function store(Request $request) {

        function generatePIN($digits = 4){
            $i = 0; //counter
            $pin = ""; //our default pin is blank.
            while($i < $digits){
                //generate a random number between 0 and 9.
                $pin .= mt_rand(0, 9);
                $i++;
            }
            return $pin;
        }
         
        //If I want a 4-digit PIN code.
        $pin = generatePIN();

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = \Stripe\Customer::create([
            "phone" => $request->cell_number,
            "description" => "Customer for stepup.com",
          ]);

        $user = User::create([
            'cell_number' => $request->cell_number,
            'password' => bcrypt($request->password),
            'stripe_id' => $customer->id,
            'pin' => bcrypt($pin),
        ]);      

        $database_password = User::where('cell_number', $request->cell_number)->value('password');
        $user_id = User::where('cell_number', $request->cell_number)->value('id');
        $cell_number = ltrim($user->cell_number, '+');

        if(env('APP_ENV') == "local"){
    
            //for local testing instead of sending SMS
            mail('ivojongmans@gmail.com', 'SMS Verification', $pin);
        }

        elseif(env('APP_ENV') == "production") {
        //for production send SMS
        Nexmo::message()->send([
            'to'   =>  $cell_number,
            'from' => 'NEXMO',
            'text' => 'Welcome to ROLLR! This is your personal verification code: '.$pin
        ]);
        }
        
        if (Hash::check($request->password, $database_password)) {
            Auth::loginUsingId($user_id);
            if (Auth::check()) {
                return view('verifysms');
            }            
        }


    // return view('verify_user', compact('scooter', 'user'));
    
       // return redirect('scooter/'.$scooter.'/verify/'.$local_customer_id);
    }
}
