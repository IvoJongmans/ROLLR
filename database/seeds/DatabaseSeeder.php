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
            'location' => 'Assen',
            'latitude' => 0,
            'longitude' => 0,
        ]);
    }
}
