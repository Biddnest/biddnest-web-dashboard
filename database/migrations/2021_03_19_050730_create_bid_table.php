<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bid', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("booking_id")->index('booking_id');
            $table->foreign("booking_id")->references('id')->on("bookings");
            $table->unsignedBigInteger("organization_id")->index('organization_id');
            $table->foreign("organization_id")->references('id')->on("organizations");
            $table->tinyInteger("bid_type")->default(0);
            $table->tinyInteger("status")->default(0);
            $table->unsignedBigInteger("vendor_id")->index('vendor_id')->nullable();
            $table->foreign("vendor_id")->references('id')->on("vendors");
            $table->double("bid_amount")->nullable();
            $table->text("meta")->default(json_encode(["type_of_movement"=>null, "moving_date"=>null, "vehicle_type"=>null, "min_man_power"=>null, "max_man_power"=>null]));
            $table->tinyInteger("bookmarked")->nullable();
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
        Schema::dropIfExists('bid');
    }
}
