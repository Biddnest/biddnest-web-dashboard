<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBiddingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bid', function (Blueprint $table) {
            $table->unsignedBigInteger("bookmarked_by")->index('bookmarked_by')->after('bookmarked')->nullable();
            $table->foreign("bookmarked_by")->references('id')->on("vendors");

            $table->unsignedBigInteger("rejected_by")->index('rejected_by')->after('bookmarked_by')->nullable();
            $table->foreign("rejected_by")->references('id')->on("vendors");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bid', function (Blueprint $table) {
            //
        });
    }
}
