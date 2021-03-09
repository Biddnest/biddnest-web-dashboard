<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePushNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_notificaton', function (Blueprint $table) {
            $table->id();
            $table->string('image')->default(null)->nullable();
            $table->text("title");
            $table->text("desc");
            $table->text("conditions");
            $table->dateTime("scheduled_at")->nullable();
            $table->string("channel");
            $table->string("url");
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->tinyInteger('deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('push_notificaton');
    }
}
