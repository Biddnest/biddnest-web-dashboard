<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesCityMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_city_map', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("city_id");
            $table->foreign("city_id")->references("id")->on("cities");
            $table->unsignedBigInteger("services_id");
            $table->foreign("services_id")->references("id")->on("services");
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
        Schema::dropIfExists('category_city_map');
    }
}
