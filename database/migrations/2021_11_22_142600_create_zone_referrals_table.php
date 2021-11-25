<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZoneReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zone_referral_rewards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("zone_id");
            $table->integer("reward_type")->nullable();
            $table->integer("reward_points")->nullable();

            $table->unsignedBigInteger("voucher_id")->index('voucher_id')->nullable();
            $table->foreign("voucher_id")->on("vouchers")->references("id");

            $table->text("meta")->nullable();
            $table->tinyInteger("trigger_on");
            $table->tinyInteger("status");
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
        Schema::dropIfExists('zone_referrals');
    }
}
