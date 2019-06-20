<?php

namespace App\Http\Controllers;

use App\Scooter;
use Illuminate\Http\Request;
use Stripe;

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
        
        return view('scooter', compact('scooter'));
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
    public function send(){
        return view('scooter/send');
    }
    public function storelocation(){
        $scooter = Scooter::find(1);
        $scooter->latitude = request('latitude');
        $scooter->longitude = request('longitude');  
        $scooter->save(); 
    }
    public function retrieve(){
        // $id = request('id');
        $scooter = Scooter::findOrFail(1);
        $returndata = response()->json([
            'lat' => $scooter->latitude,
            'lng' => $scooter->longitude,
        ]);
        return $returndata; 
    }
}
