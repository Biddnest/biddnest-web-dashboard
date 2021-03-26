<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type');
            $table->string("heading");
            $table->text("desc");
            $table->unsignedBigInteger('order_id')->index('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('bookings');

            $table->unsignedBigInteger('user_id')->index('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('vendor_id')->index('vendor_id')->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendors');
            $table->text("meta");
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
        Schema::dropIfExists('ticket');
    }
}
