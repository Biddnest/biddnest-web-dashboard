<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('fname', 30);
            $table->string('lname', 30);
            $table->string('username', 50)->unique('username');
            $table->text('password');
            $table->integer('role');
            $table->string('phone', 12);
            $table->string('email', 50);
            $table->text('meta');
            $table->integer('otp')->nullable();
            $table->tinyInteger('forgot_pwd');
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->integer('deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
