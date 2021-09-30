<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubserviceGeneratedPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_organization_generated_price', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id')->index('booking_id');
            $table->foreign('booking_id')->references('id')->on('bookings');

            $table->unsignedBigInteger('organization_id')->index('organization_id');
            $table->foreign('organization_id')->references('id')->on('organizations');

            $table->decimal('mp_economic', 10, 2)->nullable();
            $table->decimal('mp_premium', 10, 2)->nullable();
            $table->decimal('bp_economic', 10, 2)->nullable();
            $table->decimal('bp_premium', 10, 2)->nullable();
            $table->decimal('economic_margin_percentage', 10, 2)->nullable();
            $table->decimal('premium_margin_percentage', 10, 2)->nullable();
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
        Schema::dropIfExists('subservice_generated_price');
    }
}
