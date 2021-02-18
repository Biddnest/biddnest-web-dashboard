<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fname',30);
            $table->string('lname',30);
            $table->string('email',50)->unique();
            $table->string('phone',12)->unique();
            $table->text('password');
            $table->foreign('org_id')->references('id')->on('organizations')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->text('meta');
            $table->integer('user_role');
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
        Schema::dropIfExists('vendors');
    }
}
