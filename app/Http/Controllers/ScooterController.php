<?php

namespace App\Http\Controllers;

use App\Scooter;
use Illuminate\Http\Request;
use Stripe;
use Auth;
use Session;
use App\User;

class ScooterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->back(); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->back(); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect()->back(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Scooter  $scooter
     * @return \Illuminate\Http\Response
     */
    public function show(Scooter $scooter)
    {
        Session::put('scooter', $scooter);
        if(Auth::guest()) {
            return redirect('/login', 302, [], true);      //redirect('/', 302, [], true)
        }
        elseif (Auth::user()->sms_validated == "no") {
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
        elseif (Auth::user()->cc_validated == "no") {
            return view('creditcard');
        }
        else {
            return view('dashboard', compact('scooter'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Scooter  $scooter
     * @return \Illuminate\Http\Response
     */
    public function edit(Scooter $scooter)
    {
        return redirect()->back(); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Scooter  $scooter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Scooter $scooter)
    {
        return redirect()->back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Scooter  $scooter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scooter $scooter)
    {
        return redirect()->back(); 
    }
    public function map(){
        return view('scooter/map'); 
    }

    public function retrieve(Scooter $scooter){
        $scooterPositionInfo = $scooter->retrievePositionInfo();
        return $scooterPositionInfo;  
    }
}
