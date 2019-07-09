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
        $scooters = Scooter::all()->sortBy('id');   
        return view('/scooter/index', compact('scooters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/scooter/create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Scooter $scooter)
    {  
        // $validatedRequest = $request->validate([
        //     'imei' => 'required',
        //     'brand' => 'required',
        //     'trade' => 'required',
        //     'type' => 'required',
        //     'serial' => 'required',
        //     'image.*' => 'required|mimes:jpg,jpeg,bmp,png,gif'
        // ]);
        $scooter->storeNewScooter($request); 
        return redirect()->route('admin'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Scooter  $scooter
     * @return \Illuminate\Http\Response
     */
    public function show(Scooter $scooter)
    {
        return view ('/scooter/show', compact('scooter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Scooter  $scooter
     * @return \Illuminate\Http\Response
     */
    public function edit(Scooter $scooter)
    {
        return view ('/scooter/edit', compact('scooter'));
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
        $scooter->updateScooter($request, $scooter); 
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
        $scooter->deletePictures(); 
        $scooter->delete(); 
        return redirect()->route('indexscooters'); 
    }
    // public function map(){
    //     return view('scooter/map'); 
    // }

    // public function retrieve(Scooter $scooter){
    //     $scooterPositionInfo = $scooter->retrievePositionInfo();
    //     return $scooterPositionInfo;  
    // }
}
