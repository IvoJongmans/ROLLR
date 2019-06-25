<?php

namespace App\Http\Controllers;

use App\Scooter;
use Illuminate\Http\Request;
use Stripe;
use Auth;
use Session;

class ScooterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            return redirect('/login');
        }
        else {
        return view('scooter', compact('scooter'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Scooter  $scooter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scooter $scooter)
    {
        //
    }
    public function map(){
        return view('scooter/map'); 
    }
    // public function send(){
    //     return view('scooter/send');
    // }
    // public function storelocation(){
    //     $scooter = Scooter::find(1);
    //     $scooter->latitude = request('latitude');
    //     $scooter->longitude = request('longitude');  
    //     $scooter->save(); 
    // }
    public function retrieve(){
        $timecheck = Scooter::oldest('updated_at')->get();
        if(
            (time() - strtotime($timecheck[0]['updated_at'])) > 310
            ){
        $json = json_decode(file_get_contents('https://portaallovetracking.com/api_po/1.php?api=pl&ver=1.5&key=' . env('API_KEY_TRACKER') . '&cmd=OBJECT_GET_POSITION,*'), true);
        foreach($json as $tracker){
            $scooterupdate = Scooter::find(1); 
            $scooterupdate->latitude = $tracker['lat'];
            $scooterupdate->longitude = $tracker['lng'];
            $scooterupdate->save(); 
        };
        $scooter = Scooter::all();
        return response()->json($scooter);
    } else {
        $scooter = Scooter::all();
        return response()->json($scooter);
    }
    }
}
