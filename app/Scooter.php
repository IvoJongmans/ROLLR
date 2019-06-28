<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scooter extends Model
{
    public function retrievePositionInfo(){
        $timecheck = Scooter::oldest('updated_at')->get();
        if(
            (time() - strtotime($timecheck[0]['updated_at'])) > 310
            ){

                    $json = json_decode(file_get_contents('https://portaallovetracking.com/api_po/1.php?api=pl&ver=1.5&key=' . env('API_KEY_TRACKER') . '&cmd=OBJECT_GET_POSITION,*'), true); 
                    foreach($json as $key => $tracker){
                        $scooterid = Scooter::where('imei', '=', $key)->first()->id;  
                        $scooterupdate = Scooter::find($scooterid);
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
