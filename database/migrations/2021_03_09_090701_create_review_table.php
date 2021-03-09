<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('booking_id')->index('booking_id');
            $table->foreign('booking_id')->references('id')->on('bookings');           
            $table->text("desc");
            $table->text("ratings");
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->tinyInteger('deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review');
    }
}
