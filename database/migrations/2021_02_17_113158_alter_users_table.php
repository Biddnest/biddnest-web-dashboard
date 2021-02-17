<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('otp_verified')->default(0);
            $table->string('avatar')->default(0);
            $table->string('fname')->nullable()->change();
            $table->string('lname')->nullable()->change();
            $table->string('gender')->nullable()->change();
            $table->string('email')->nullable()->change();
//            $table->tinyInteger('signup_status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
