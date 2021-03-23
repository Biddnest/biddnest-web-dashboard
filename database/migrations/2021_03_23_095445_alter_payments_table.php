<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->double("sub_total",10,2)->default(0.00)->after('booking_id');
            $table->double("tax",10,2)->after('booking_id');
            $table->double("discount_amount",10,2)->default(0.00)->after('booking_id');
            $table->double("other_charges",10,2)->default(0.00)->after('booking_id');
            $table->string("coupon_code")->nullable();
            $table->renameColumn("amount","grand_total");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            //
        });
    }
}
