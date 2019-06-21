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

        $created_time = strtotime(Trip::where('id', $trip->id)->value('created_at'));

        $updated_time = strtotime(Trip::where('id', $trip->id)->value('updated_at'));

        $trip_time = floor(($updated_time - $created_time) / 60);

        

        // $trip_time_minutes =  $trip_time->format('%s');

        $amount = 100 + (15 * $trip_time);
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
        \Stripe\Charge::create(array(
            "amount" => $amount,
            "currency" => "eur",
            "customer" => $stripe_id
          ));
        return 'Trip stopped';
    }
}
