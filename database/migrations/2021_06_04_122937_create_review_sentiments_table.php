<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewSentimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_sentiments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("review_id")->index("review_id")->unique();
            $table->foreign("review_id")->references("id")->on("review");
            $table->decimal("negativity_score");
            $table->decimal("positivity_score");
            $table->decimal("neutrality_score");
            $table->decimal("compound_score");
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
        Schema::dropIfExists('review_sentiments');
    }
}
