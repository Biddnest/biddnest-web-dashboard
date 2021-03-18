<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_zone_map', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("admin_id")->index('admin_id');
            $table->foreign("admin_id")->references('id')->on("admins");

            $table->unsignedBigInteger("zone_id")->index('zone_id');
            $table->foreign("zone_id")->references('id')->on("zones");

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
        Schema::table('admin_zone_map', function (Blueprint $table) {
            //
        });
    }
}
