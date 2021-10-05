<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnExtraDistanceSubservicePrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subservice_price', function (Blueprint $table) {
            $table->tinyInteger('additional_distance_economic_price')->nullable()->after('premium_margin_percentage');
            $table->tinyInteger('additional_distance_premium_price')->nullable()->after('additional_distance_economic_price');
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
