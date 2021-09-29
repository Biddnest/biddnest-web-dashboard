<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRenameColumnSubserviceprice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subservice_price', function (Blueprint $table) {
            $table->renameColumn('mp_economic_margin_percentage','economic_margin_percentage');
            $table->renameColumn('bp_premium_margin_percentage','premium_margin_percentag');
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
