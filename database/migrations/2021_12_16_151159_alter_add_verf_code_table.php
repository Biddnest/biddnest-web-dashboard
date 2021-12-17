<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddVerfCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('bookings', function (Blueprint $table) {
            $table->integer('verf_code')->nullable();
            $table->tinyInteger('otp_verified')->default(0);
        });*/
        /*Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn('zone_id');
        });*/
        Schema::create('organizations_zone_mapping', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("organization_id")->index("organization_id");
            $table->foreign("organization_id")->on("organizations")->references("id");

            $table->unsignedBigInteger("zone_id")->index("zone_id");
            $table->foreign("zone_id")->on("zones")->references("id");

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
        Schema::table('bookings', function (Blueprint $table) {
            //
        });
    }
}
