<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Scooter;

class MapController extends Controller
{
    public function map(){
        return view('map/map'); 
    }

    public function retrieve(Scooter $scooter){
        $scooterPositionInfo = $scooter->retrievePositionInfo();
        return $scooterPositionInfo;  
    }
}
