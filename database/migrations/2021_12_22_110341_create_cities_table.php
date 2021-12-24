<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("meta")->nullable();
            $table->tinyInteger("deleted")->default(0);
            $table->timestamps();
        });

        Schema::create('city_zone_map', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("city_id");
            $table->foreign("city_id")->references("id")->on("cities");
            $table->unsignedBigInteger("zone_id");
            $table->foreign("zone_id")->references("id")->on("zones");
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
        Schema::dropIfExists('cities');
    }
}
