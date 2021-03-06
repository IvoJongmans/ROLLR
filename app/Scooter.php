<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scooterpicture;
use Illuminate\Support\Facades\Storage;

class Scooter extends Model
{
    public function scooterpictures(){
        return $this->hasMany(Scooterpicture::class);
    }

    public function deletePictures(){
        $pictureArray = []; 
        $collectionPictures = $this->scooterpictures;
        foreach($collectionPictures as $picture){
            Storage::delete($picture->url);
            $picture->delete();  
        }
 
    }

    public function updateScooter($request, $scooter){
        $validatedRequest = $request->validate([
            'imei' => 'required',
            'brand' => 'required',
            'trade' => 'required',
            'type' => 'required',
            'serial' => 'required',
            'image.*' => 'mimes:jpg,jpeg,bmp,png,gif'
        ]);
        $scooter->imei = $validatedRequest['imei'];
        $scooter->brand = $validatedRequest['brand'];
        $scooter->tradename = $validatedRequest['trade'];
        $scooter->type = $validatedRequest['type'];
        $scooter->serialnumber = $validatedRequest['serial']; 
        $scooter->save(); 
        if(isset($validatedRequest['image']))
        foreach($validatedRequest['image'] as $image){
            $imageurl = $image->store(''); 
            $scooterpicture = new ScooterPicture;
            $scooterpicture->url = $imageurl; 
            $scooterpicture->scooter_id = $scooter->id; 
            $scooterpicture->save(); 
        }       
    }
    

    public function storeNewScooter($request){
        $validatedRequest = $request->validate([
            'imei' => 'required',
            'brand' => 'required',
            'trade' => 'required',
            'type' => 'required',
            'serial' => 'required',
            'image.*' => 'required|mimes:jpg,jpeg,bmp,png,gif'
        ]);
        $scooter = new Scooter; 
        $scooter->imei = $validatedRequest['imei'];
        $scooter->brand = $validatedRequest['brand'];
        $scooter->tradename = $validatedRequest['trade'];
        $scooter->type = $validatedRequest['type'];
        $scooter->serialnumber = $validatedRequest['serial']; 
        $scooter->save(); 
        if (!empty($validatedRequest['image'])){
        foreach($validatedRequest['image'] as $image){
            $imageurl = $image->store(''); 
            $scooterpicture = new ScooterPicture;
            $scooterpicture->url = $imageurl; 
            $scooterpicture->scooter_id = $scooter->id; 
            $scooterpicture->save(); 
        }
    }       
    }

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
                        $scooterupdate->battery = $tracker['params']['batl'];
                        $scooterupdate->save(); 
                    };
                    $scooter = Scooter::all();
                    return response()->json($scooter);

        } else {   
          $scooter = Scooter::all();
          return response()->json($scooter);
        }
    }
    public function retrievePositionInfoOne($id){
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
                        $scooterupdate->battery = $tracker['params']['batl'];
                        $scooterupdate->save(); 
                    };
                    $scooter = Scooter::findOrFail($id);
                    return response()->json($scooter);

        } else {   
          $scooter = Scooter::findOrFail($id);
          return response()->json($scooter);
        }
    }
}
