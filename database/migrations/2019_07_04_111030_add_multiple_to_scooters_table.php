<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMultipleToScootersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scooters', function (Blueprint $table) {
            $table->string('brand')->default('brand');
            $table->string('tradename')->default('tradename');
            $table->string('type')->default('type');
            $table->string('serialnumber')->default('serialnumber');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scooters', function (Blueprint $table) {
            $table->dropColumn('brand');
            $table->dropColumn('tradename');
            $table->dropColumn('type');
            $table->dropColumn('serialnumber');
        });
    }
}
