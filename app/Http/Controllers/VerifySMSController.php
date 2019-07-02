<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Nexmo\Laravel\Facade\Nexmo;

class VerifySMSController extends Controller
{
    public function verifysms(){
        return view('verifysms');
    }
    
    public function verifysmslogin(Request $request){

        
        $database_pin = Auth::user()->pin;

        if (Hash::check($request->pin, $database_pin)) {
            

            $id = Auth::user()->id;

            User::where('id', $id)->update(array('sms_validated' => 'yes'));
    
            return redirect('/account');
                       
        }
        else {
            return view('/verifysms');
        }

    }

    public function retryverifysms(){

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

        $pin = generatePIN();

        $id = Auth::user()->id;

        $cell_number = ltrim(Auth::user()->cell_number, '+');

        User::where('id', $id)->update(array('pin' => bcrypt($pin)));

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

        return view('retryverifysms');
    }
    
    public function retryverifysmscheck(Request $request){

            $database_pin = Auth::user()->pin;

            // if ($request->pin == $database_pin) {
            if (Hash::check($request->pin, $database_pin)) {    

            $id = Auth::user()->id;

            User::where('id', $id)->update(array('sms_validated' => 'yes'));
    
            return redirect('/account');
                       
        }
        else {
            return view('/retryverifysms');
        }

    }
}
