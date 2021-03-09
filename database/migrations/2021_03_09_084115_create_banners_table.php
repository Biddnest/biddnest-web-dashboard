<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slider_id')->index('slider_id');
            $table->foreign('slider_id')->references('id')->on('sliders');
            $table->string("name");
            $table->string("url");
            $table->date('from_date');
            $table->date('to_date');
            $table->tinyInteger('order');
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
        Schema::dropIfExists('banners');
    }
}
