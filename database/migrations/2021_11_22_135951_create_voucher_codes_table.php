<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoucherCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher_codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("voucher_id")->index('voucher_id');
            $table->foreign("voucher_id")->on("vouchers")->references("id");

            $table->unsignedBigInteger("user_id")->index('user_id')->nullable();
            $table->foreign("user_id")->on("users")->references("id");

            $table->string("voucher_code");
            $table->string("expires_at");
            $table->text("meta")->nullable();
            $table->tinyInteger("status")->default(0);
            $table->timestamps();
        });

        Schema::table('vouchers', function (Blueprint $table) {
            $table->integer("reward_point_cost");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voucher_codes');
    }
}
