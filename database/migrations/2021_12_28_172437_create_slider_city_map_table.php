<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderCityMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_city_map', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("slider_id")->index("slider_id");
            $table->foreign("slider_id")->on("sliders")->references("id");

            $table->unsignedBigInteger("city_id")->index("city_id");
            $table->foreign("city_id")->on("cities")->references("id");

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
        Schema::dropIfExists('slider_city_map');
    }
}
