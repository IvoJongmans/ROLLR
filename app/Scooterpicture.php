<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scooter; 

class Scooterpicture extends Model
{
    public function scooter(){
        return $this->belongsTo(Scooter::class); 
    }
}
