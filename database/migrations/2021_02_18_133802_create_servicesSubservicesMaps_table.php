<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesSubservicesMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_subservices_maps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id')->index('service_id');
            $table->foreign('service_id')->references('id')->on('services')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->unsignedBigInteger('subservice_id')->index('subservice_id');
            $table->foreign('subservice_id')->references('id')->on('subservices')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->tinyInteger('deleted')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicesSubservicesMaps');
    }
}
