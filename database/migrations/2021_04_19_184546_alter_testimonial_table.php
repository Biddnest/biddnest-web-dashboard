<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTestimonialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('testimonial', function (Blueprint $table) {
            $table->text("ratings")->nullable()->change();
            $table->text("image")->nullable()->change();
            $table->string("heading")->after("ratings");
        });

        Schema::table('users', function (Blueprint $table) {
            $table->text("avatar")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('testimonial', function (Blueprint $table) {
            //
        });
    }
}
