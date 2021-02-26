<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBookingInventories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("booking_id")->index("booking_id");
            $table->unsignedBigInteger("inventory_id")->index("inventory_id");

            $table->foreign('booking_id' )->references("id")->on('bookings')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('inventory_id')->references("id")->on('inventories')->onUpdate('RESTRICT')->onDelete('RESTRICT');

            $table->string("name");
            $table->string("material");
            $table->string("size");
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
        Schema::dropIfExists('table_booking_inventories');
    }
}
