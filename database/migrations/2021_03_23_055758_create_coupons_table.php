<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("desc");
            $table->string("code");
            $table->tinyInteger("coupon_type");
            $table->tinyInteger("discount_type");
            $table->double("discount_amount",10,2);
            $table->double("max_discount_amount",10,2);
            $table->double("min_order_amount",10,2);
            $table->tinyInteger("deduction_source"); //enum 0/1
            $table->unsignedBigInteger("organization_id");
            $table->integer("max_usage");
            $table->integer("max_usage_per_user");
            $table->integer("usage");
            $table->tinyInteger("scope"); //0 all //1 specific organization
            $table->tinyInteger("eligibility_type"); //0 all //1 specific users //2 specific new users
            $table->date("valid_from");
            $table->date("valid_to");
            $table->tinyInteger("status")->default(1);
            $table->timestamps();
            $table->tinyInteger("deleted")->default(0);
        });

        Schema::create('coupon_zone_map', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("coupon_id")->index("coupon_id");

            $table->foreign("coupon_id")->references("id")->on("coupons");

            $table->unsignedBigInteger("zone_id")->index("zone_id");
            $table->foreign("zone_id")->references("id")->on("zones");

            $table->timestamps();
        });

        Schema::create('coupon_user_map', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("coupon_id")->index("coupon_id");

            $table->foreign("coupon_id")->references("id")->on("coupons");

            $table->unsignedBigInteger("user_id")->index("user_id");
            $table->foreign("user_id")->references("id")->on("users");

            $table->timestamps();
        });


        Schema::create('coupon_organization_map', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("coupon_id")->index("coupon_id");

            $table->foreign("coupon_id")->references("id")->on("coupons");

            $table->unsignedBigInteger("organization_id")->index("organization_id");
            $table->foreign("organization_id")->references("id")->on("organizations");

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
        Schema::dropIfExists('coupons');
    }
}
