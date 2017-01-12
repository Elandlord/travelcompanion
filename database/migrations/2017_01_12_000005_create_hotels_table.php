<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     * @table hotels
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('location_id', 45)->nullable();
            $table->longText('description')->nullable();
            $table->string('name', 45)->nullable();
            $table->string('road_name', 45)->nullable();
            $table->string('house_number', 45)->nullable();
            $table->string('phone_number', 45)->nullable();
            $table->string('email_address', 45)->nullable();
            $table->string('zip_code', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('hotels');
     }
}
