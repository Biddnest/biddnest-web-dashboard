<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterChangeDatatypeOrgKycTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('org_kycs', function (Blueprint $table) {
            $table->text("aadhar_card")->nullable()->change();
            $table->text("pan_card")->nullable()->change();
            $table->text("gst_certificate")->nullable()->change();
            $table->text("company_reg_certificate")->nullable()->change();
            $table->text("bidnest_agreement")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('org_kycs', function (Blueprint $table) {
            //
        });
    }
}
