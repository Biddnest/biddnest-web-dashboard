<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id')->index('booking_id');
            $table->foreign('booking_id')->references('id')->on('bookings');
            $table->text('cancelled_meta')->default(json_encode(["reason"=>null, "desc"=>null]));
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('bookin_status');
    }
}
