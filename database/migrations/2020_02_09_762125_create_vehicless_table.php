<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicless', function (Blueprint $table) {
            $table->increments('id');
  $table->text("by_driver_id")->nullable(); 
  $table->text("model")->nullable(); 
  $table->text("year")->nullable(); 
  $table->text("license_plate")->nullable(); 
  $table->text("color")->nullable(); 
  $table->text("booking_type")->nullable(); 



            $table->text("by_user_id")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicless');
    }
}




            