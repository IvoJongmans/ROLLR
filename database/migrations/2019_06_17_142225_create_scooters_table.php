<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScootersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scooters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('location');
            $table->string('availability')->default('free');
            $table->timestamps();
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scooters');
    }
}
