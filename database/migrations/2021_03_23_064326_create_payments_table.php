<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string("public_transaction_id")->unique();

            $table->unsignedBigInteger('booking_id')->index('booking_id');
            $table->foreign("booking_id")->references('id')->on("bookings");

            $table->string('rzp_order_id')->unique();
            $table->string('rzp_payment_id')->unique();

            $table->double('amount', 10,2);

            $table->text("meta");

            $table->tinyInteger('status')->default('0');
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
        Schema::dropIfExists('payments');
    }
}
