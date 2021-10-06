<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PaymentTableAddCommission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_organization_generated_prices', function (Blueprint $table) {
            $table->decimal('base_price_economic')->default(0.00);
            $table->decimal('base_price_premium')->default(0.00);
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->decimal('commission')->default(0.00);
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
