<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubCategoryItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subservices_extra_inventory',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('subservice_id')->index('subservice_id');
            $table->foreign('subservice_id')->references('id')->on('subservices');

            $table->unsignedBigInteger('inventory_id')->index('inventory_id');
            $table->foreign('inventory_id')->references('id')->on('inventories');
            $table->timestamps();
        });

        Schema::table('subservices',function (Blueprint $table){
            $table->integer("max_extra_items")->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {


    }
}
