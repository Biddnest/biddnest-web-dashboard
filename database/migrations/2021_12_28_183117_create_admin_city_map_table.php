<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminCityMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_city_map', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("admin_id")->index("admin_id");
            $table->foreign("admin_id")->on("admins")->references("id");

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
        Schema::dropIfExists('admin_city_map');
    }
}
