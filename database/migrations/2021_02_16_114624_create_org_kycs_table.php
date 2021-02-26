<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgKycsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_kycs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('org_id')->index('org_fk_id');
            $table->string('aadhar_card', 100)->nullable();
            $table->string('pan_card', 100)->nullable();
            $table->string('gst_certificate', 100)->nullable();
            $table->string('company_reg_certificate', 100)->nullable();
            $table->string('bidnest_agreement', 100)->nullable();
            $table->text('banking_details')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('org_kycs');
    }
}
