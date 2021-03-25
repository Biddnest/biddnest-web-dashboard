<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingDriverMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('vehicle_type');
            $table->string('number');
            $table->timestamps();
        });

        Schema::create('booking_driver_map', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id')->index('booking_id');
            $table->foreign("booking_id")->references('id')->on("bookings");
            $table->unsignedBigInteger('driver_id')->index('driver_id');
            $table->foreign("driver_id")->references('id')->on("vendors");
            $table->unsignedBigInteger('vehicle_id')->index('vehicle_id');
            $table->foreign("vehicle_id")->references('id')->on("vehicle");
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
        Schema::dropIfExists('booking_driver_map');
    }
}
