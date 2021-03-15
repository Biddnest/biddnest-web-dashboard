<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOrganizationDroppriceAddInvetoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropcolumn('service_economic');
            $table->dropcolumn('service_premium');
            $table->tinyInteger("service")->after("state");
            $table->decimal("commission", 3,2)->after("verification_status");
        });

        Schema::table('zones', function (Blueprint $table) {
            $table->text("area")->nullable()->change();
        });

        Schema::table('inventories', function (Blueprint $table) {
            $table->tinyInteger("category")->after("image");
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
