<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDataTypesInSubservicePrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subservice_price', function (Blueprint $table) {
            $table->decimal("mp_additional_distance_economic_price",10,2)->change();
            $table->decimal("mp_additional_distance_premium_price",10,2)->change();
            $table->decimal("bp_additional_distance_economic_price",10,2)->change();
            $table->decimal("bp_additional_distance_premium_price",10,2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subservice_price', function (Blueprint $table) {
            //
        });
    }
}
