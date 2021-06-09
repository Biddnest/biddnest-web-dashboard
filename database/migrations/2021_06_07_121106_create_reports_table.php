<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string("avg_lead_to_opportunity")->comment("In Percentage");
            $table->string("avg_opportunity_to_order")->comment("In Percentage");
            $table->string("avg_order_value")->comment("In Rupees");
            $table->string("avg_revenue_per_customer")->comment("In Rupees");
            $table->string("avg_frt")->comment("In minutes");
            $table->string("avg_csat")->comment("In Percentage to Number.Eg: 35% as 35.");
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
        Schema::dropIfExists('reports');
    }
}
