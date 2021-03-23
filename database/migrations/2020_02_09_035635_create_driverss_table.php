<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driverss', function (Blueprint $table) {
            $table->increments('id');
  $table->text("firstname")->nullable(); 
  $table->text("lastname")->nullable(); 
  $table->text("address")->nullable(); 
  $table->text("licenceno")->nullable(); 
  $table->text("license_photo")->nullable(); 
  $table->text("license_expiration_date")->nullable(); 
  $table->text("phonenumber")->nullable(); 
  $table->text("age")->nullable(); 
  $table->text("state_of_origin")->nullable(); 
  $table->text("qualification")->nullable(); 



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
        Schema::dropIfExists('driverss');
    }
}




            