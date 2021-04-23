<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payout', function (Blueprint $table) {
            $table->id();
            $table->string("public_payout_id");
            $table->unsignedBigInteger("organization_id")->index("organization_id");
            $table->foreign("organization_id")->references('id')->on("organizations");
            $table->decimal("amount", 10,2);
            $table->decimal("commission", 10,2);
            $table->integer("commission_percentage");
            $table->decimal("final_payout", 10,2);
            $table->timestamp("dispatch_at");
            $table->string("rzp_payout_id")->nullable();
            $table->string("bank_transaction_id")->nullable();
            $table->text("meta")->default(json_encode(["total_bookings"=>"", "from_date"=>"", " to_date"=>"", "affected_bookings"=>""]));
            $table->string("remarks")->nullable();
            $table->tinyInteger("status")->default(0);
            $table->timestamps();
        });

        Schema::table('vendors', function (Blueprint $table) {
            $table->string('image')->after('organization_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payout');
    }
}
