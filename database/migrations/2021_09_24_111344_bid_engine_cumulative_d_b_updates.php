<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BidEngineCumulativeDBUpdates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("inventory_price", function (Blueprint $table){
            $table->decimal("mp_economic",10,2)->nullable();
            $table->decimal("mp_premium",10,2)->nullable();

            $table->decimal("bp_economic",10,2)->nullable();
            $table->decimal("bp_premium",10,2)->nullable();

            $table->decimal("mp_economic_margin_percentage",10,2)->nullable();
            $table->decimal("bp_premium_margin_percentage",10,2)->nullable();
        });

        Schema::create("subservice_price", function (Blueprint $table){
            $table->id();

            $table->unsignedBigInteger("subservice_id")->index("service_id");
            $table->foreign("subservice_id")->references("id")->on("subservices");

            $table->unsignedBigInteger("vendor_id")->index("vendor_id");
            $table->foreign("vendor_id")->references("id")->on("organizations");

            $table->decimal("mp_economic",10,2)->nullable();
            $table->decimal("mp_premium",10,2)->nullable();

            $table->decimal("bp_economic",10,2)->nullable();
            $table->decimal("bp_premium",10,2)->nullable();

            $table->decimal("mp_economic_margin_percentage",10,2)->nullable();
            $table->decimal("bp_premium_margin_percentage",10,2)->nullable();

            $table->tinyInteger("status")->default(1);
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
        //
    }
}
