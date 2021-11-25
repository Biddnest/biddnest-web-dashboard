<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string("image")->nullable();
            $table->string("name");
            $table->text("title");
            $table->text("desc");
            $table->text("meta")->nullable();
            $table->integer("provider")->default(0);
            $table->text("provider_url")->nullable();
            $table->integer("max_redemptions")->nullable();
            $table->tinyInteger("type")->default(0);
            $table->tinyInteger("status")->default(0);
            $table->tinyInteger("deleted")->default(0);
            $table->timestamps();
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
