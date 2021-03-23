<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->nullable();
            $table->string('approved')->nullable();

            $table->string('passportImage')->nullable();
            $table->string('homeaddress')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('accountbank')->nullable();
            $table->string('accountnumber')->nullable();
            $table->string('accountname')->nullable();
            $table->string('driverlicense')->nullable();
            $table->string('push_notification_token')->nullable();
            $table->string('reg_via')->nullable();

            
     

            $table->text('user_photo');

            $table->rememberToken();

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
        Schema::dropIfExists('users');
    }
}
