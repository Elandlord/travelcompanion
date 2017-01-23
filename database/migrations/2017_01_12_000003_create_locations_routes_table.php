<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsRoutesTable extends Migration
{
    /**
     * Run the migrations.
     * @table locations_routes
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_route', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('location_id')->nullable();
            $table->integer('route_id')->nullable();
            $table->date('arrival_date')->nullable();
            $table->date('departure_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('locations_routes');
     }
}
