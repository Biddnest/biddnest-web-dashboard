<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddAdditionalPriceColumnInventoryPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_price', function (Blueprint $table) {
            $table->decimal("mp_additional_economic",10,2)->nullable()->after('bp_premium_margin_percentage');
            $table->decimal("mp_additional_premium",10,2)->nullable()->after('mp_additional_economic');

            $table->decimal("bp_additional_economic",10,2)->nullable()->after('mp_additional_premium');
            $table->decimal("bp_additional_premium",10,2)->nullable()->after('bp_additional_economic');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_price', function (Blueprint $table) {
            //
        });
    }
}
