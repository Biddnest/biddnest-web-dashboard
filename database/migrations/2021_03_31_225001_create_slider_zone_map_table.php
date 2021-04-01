<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderZoneMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_zone_map', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("slider_id")->index("slider_id");
            $table->foreign("slider_id")->references("id")->on("sliders");
            $table->unsignedBigInteger("zone_id")->index("zone_id");
            $table->foreign("zone_id")->references("id")->on("zones");
            $table->timestamps();
        });


    Schema::table('sliders', function (Blueprint $table) {
            $table->renameColumn("zone_specific","zone_scope");
            $table->dropForeign("zone_id");
            $table->dropColumn("zone_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slider_zone_map');
    }
}
