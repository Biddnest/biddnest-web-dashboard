<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_reply', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id')->index('ticket_id');
            $table->foreign("ticket_id")->references('id')->on("ticket");

            $table->unsignedBigInteger('admin_id')->index('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins');

            $table->unsignedBigInteger('user_id')->index('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('vendor_id')->index('vendor_id')->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendors');

            $table->text('chat');
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
        Schema::dropIfExists('ticket_reply');
    }
}
