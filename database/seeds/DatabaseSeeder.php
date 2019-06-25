<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        App\Scooter::insert([            
            'latitude' => 0,
            'longitude' => 0,
            'imei' => '789456'
        ]);
        
    }
}
