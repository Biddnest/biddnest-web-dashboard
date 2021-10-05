<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string("public_booking_id");

            $table->unsignedBigInteger("user_id")->index("user_id");

            $table->unsignedBigInteger("organization_id")->index("organization_id")->nullable();

            $table->foreign('user_id')->references("id")->on('users');

            $table->foreign('organization_id')->references("id")->on('organizations');

            $table->string("movement_type");
            $table->string("source_lat");
            $table->string("source_lng");
            $table->text("source_meta")->nullable();
            $table->string("destination_lat");
            $table->string("destination_lng");
            $table->string("destination_meta")->nullable();
            $table->text("contact_details")->nullable();
            $table->text("meta")->default(json_encode(["self_booking"=>null, "subcategory"=>null,"customer"=>["remarks"=>null],"images"=>null,"timings"=>[]]));
            $table->double("estimated_quote")->default(0.00);
            $table->double("final_quote")->nullable();
            $table->tinyInteger("status")->default("1");
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
        Schema::dropIfExists('bookings');
    }
}
