<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string("for");
            $table->unsignedBigInteger("user_id")->index("user_id")->nullable();
            $table->foreign('user_id')->references('id')->on('user');

            $table->unsignedBigInteger("admin_id")->index("admin_id")->nullable();
            $table->foreign('admin_id')->references('id')->on('admins');

            $table->unsignedBigInteger("vendor_id")->index("vendor_id")->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendors');

            $table->text("title");
            $table->text("desc");
            $table->tinyInteger("status")->default(1);
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
        Schema::dropIfExists('notifications');
    }
}
