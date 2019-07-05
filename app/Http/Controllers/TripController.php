<?php

namespace App\Http\Controllers;

use App\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Scooter;
use App\User;
use Stripe;
use Auth;

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

    public function start_trip(Scooter $scooter){
        
        $trip = Trip::create(['scooter_id' => $scooter->id, 'user_id' => Auth::user()->id]);
        return $trip->id;
    }

    public function stop_trip(Scooter $scooter, Trip $trip){
        
        Trip::where('id', $trip->id)->update(['updated_at' => \Carbon\Carbon::now()]);     

        $created_time = strtotime(Trip::where('id', $trip->id)->value('created_at'));

        $updated_time = strtotime(Trip::where('id', $trip->id)->value('updated_at'));

        $trip_time = floor(($updated_time - $created_time) / 60);

        $trip_time_seconds = $updated_time - $created_time;

        $amount = 100 + (15 * $trip_time);

        $amount_euro = number_format($amount / 100, 2);

        $stripe_id = Auth::user()->stripe_id;

        if(Auth::user()->credit > 1.15) {

            $current_credit = User::where('stripe_id', $stripe_id)->value('credit');

            User::where('stripe_id', $stripe_id)->update(array('credit' => ($current_credit - $amount_euro)));

        }

        else {
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
        \Stripe\Charge::create(array(
            "amount" => $amount,
            "currency" => "eur",
            "customer" => $stripe_id
          ));
          
        }
        
        $trip->amount = $amount_euro;   
        $trip->time = $trip_time_seconds;
        
        return $trip;
    }
}
