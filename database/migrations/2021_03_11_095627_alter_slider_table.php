<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->unsignedBigInteger("zone_id")->index("zone_id")->after("id")->nullable();
            $table->foreign('zone_id')->references('id')->on('zones');

            $table->tinyInteger("type")->after("name")->nullable();
            $table->tinyInteger("position")->after("type");
            $table->tinyInteger("platform")->after("position");
            $table->tinyInteger("size")->after("platform");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sliders', function (Blueprint $table) {
            //
        });
    }
}
