<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bid_inventory', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("booking_inventory_id")->index('booking_inventory_id');
            $table->foreign("booking_inventory_id")->references('id')->on("booking_inventories");
            $table->unsignedBigInteger("bid_id")->index('bid_id');
            $table->foreign("bid_id")->references('id')->on("bid");
            $table->double("amount");
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
        Schema::dropIfExists('bid_inventory');
    }
}
