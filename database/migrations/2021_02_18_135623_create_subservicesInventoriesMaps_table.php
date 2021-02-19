<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubservicesInventoriesMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subservices_inventories_maps', function (Blueprint $table) {
            $table->id();
            $table->integer('subservice_id')->index('subservice_id');
            $table->foreign('subservice_id')->references('id')->on('subservices')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->integer('inventory_id')->index('inventory_id');
            $table->foreign('inventory_id')->references('id')->on('inventories')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->string('size_material_id')->nullable();
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
        Schema::dropIfExists('subservicesInventoriesMaps');
    }
}
