<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_price', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id')->index('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->unsignedBigInteger('service_type')->index('service_type')->nullable();
            $table->foreign('service_type')->references('id')->on('services');
            $table->unsignedBigInteger('inventory_id')->index('inventory_id')->nullable();
            $table->foreign('inventory_id')->references('id')->on('inventories');
            $table->string('size');
            $table->string('material');
            $table->decimal('price_economics', 3,2)->nullable();
            $table->decimal('price_premium', 3,2)->nullable();
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
        Schema::dropIfExists('inventory_price');
    }
}
