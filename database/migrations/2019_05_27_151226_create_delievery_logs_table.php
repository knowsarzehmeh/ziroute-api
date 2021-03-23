<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDelieveryLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delievery_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('by_customer_id')->nullable();
            $table->string('pickup_address')->nullable();
            $table->string('delievery_address')->nullable();
            $table->string('customer_longitude')->nullable();
            $table->string('customer_latitude')->nullable();
            $table->string('rider_longitude')->nullable();
            $table->string('rider_latitude')->nullable();
            $table->string('item_description_json')->nullable();
            $table->string('by_rider_id')->nullable();
            
            $table->string('close_riders_id')->nullable();

            $table->string('status')->nullable();

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
        Schema::dropIfExists('delievery_logs');
    }
}
