<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnesignalPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onesignal_players', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->index("user_id")->nullable();
            $table->foreign("user_id")->references("id")->on("users");

            $table->unsignedBigInteger("vendor_id")->index()->nullable();
            $table->foreign("vendor_id")->references("id")->on("vendors");

            $table->string("player_id");
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
        Schema::dropIfExists('onesignal_players');
    }
}
