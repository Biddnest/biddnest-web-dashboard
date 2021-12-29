<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationCityMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_city_map', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("organization_id");
            $table->foreign("organization_id")->references("id")->on("organizations");

            $table->unsignedBigInteger("city_id");
            $table->foreign("city_id")->references("id")->on("cities");

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
        Schema::dropIfExists('organization_city_map');
    }
}
