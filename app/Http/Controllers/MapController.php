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
    public function retrieveOne(Scooter $scooter, Request $request){
        $id = $request['id'];
        $scooterPositionInfo = $scooter->retrievePositionInfoOne($id);
        return $scooterPositionInfo;  
    }
}
