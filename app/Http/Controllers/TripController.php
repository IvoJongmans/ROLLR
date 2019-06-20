<?php

namespace App\Http\Controllers;

use App\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Scooter;
use App\User;
use Stripe;

class TripController extends Controller
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
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        //
    }

    public function start_trip(Scooter $scooter, User $user){
        
        $trip = Trip::create(['scooter_id' => $scooter->id, 'user_id' => $user->id]);
        return $trip->id;
    }

    public function stop_trip(Scooter $scooter, User $user, Trip $trip){
        
        Trip::where('id', $trip->id)->update(['updated_at' => \Carbon\Carbon::now()]);        
        $stripe_id = User::where('id', $user->id)->value('stripe_id');

        // $trip_time = Trip::where("id", $trip->id)->select(DB::raw("EXTRACT(EPOCH FROM (created_at - updated_at))"));
        
        // $seconds = ($trip_time[0]);
        // $minutes = floor($seconds / 60);
        // $amount = 100 + ($minutes * 15);
        
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
        \Stripe\Charge::create(array(
            "amount" => 100,
            "currency" => "eur",
            "customer" => $stripe_id
          ));
        return 'Trip stopped';
    }
}
