<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_org_id')->nullable()->index('parent_id_fk');
            $table->string('image', 100);
            $table->string('email', 50);
            $table->string('phone', 12);
            $table->string('org_name', 50);
            $table->double('lat');
            $table->double('lng');
            $table->unsignedBigInteger('zone_id')->index('zone_id');
            $table->string('pincode', 6);
            $table->string('city', 50);
            $table->string('state', 50);
            $table->boolean('service_economic');
            $table->boolean('service_premium');
            $table->tinyInteger('status')->default(0);
            $table->text('meta');
            $table->integer('verification_status')->default(0);
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('organizations');
    }
}
