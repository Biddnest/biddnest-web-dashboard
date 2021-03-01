<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterSubservicesInventoriesMap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        subservices_inventories_maps
        Schema::table('subservices_inventories_maps', function (Blueprint $table) {
            $table->dropColumn("size_material_id");
            $table->string('size')->after('inventory_id')->nullable();
            $table->string('material')->after('size')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
