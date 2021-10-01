<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlertAddColumnAdditionSubservicePrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subservice_price', function (Blueprint $table) {
            $table->renameColumn('additional_distance_economic_price', 'mp_additional_distance_economic_price');
            $table->renameColumn('additional_distance_premium_price', 'mp_additional_distance_premium_price');
        });

        Schema::table('subservice_price', function (Blueprint $table) {
            $table->tinyInteger('bp_additional_distance_economic_price')->nullable()->after('mp_additional_distance_premium_price');
            $table->tinyInteger('bp_additional_distance_premium_price')->nullable()->after('bp_additional_distance_economic_price');
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
