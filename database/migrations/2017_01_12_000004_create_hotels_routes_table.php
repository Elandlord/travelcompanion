<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsRoutesTable extends Migration
{
    /**
     * Run the migrations.
     * @table hotels_routes
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_route', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('route_id')->nullable();
            $table->integer('hotel_id')->nullable();
            $table->date('arrival_date')->nullable();
            $table->date('departure_date')->nullable();
            $table->string('price', 45)->nullable();
            $table->string('amount_persons', 45)->nullable();
            $table->boolean('paid')->nullable();
            $table->string('bank_account_number', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('hotels_routes');
     }
}
