<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_history', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("user_id")->index("user_id");
            $table->foreign("user_id")->on("users")->references("id");

            $table->unsignedBigInteger("referred_by_id")->index("referred_by_id");
            $table->foreign("referred_by_id")->on("users")->references("id");

            $table->tinyInteger("status")->default(0);
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
        Schema::dropIfExists('referral_history');
    }
}
