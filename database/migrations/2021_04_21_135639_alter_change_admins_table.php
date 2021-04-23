<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterChangeAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->text("image")->nullable()->after('id');
            $table->date("dob")->after('email');
            $table->date("date_of_joining")->after('dob');
            $table->text("aadhar_img")->nullable()->after('date_of_joining');
            $table->text("pan_img")->nullable()->after('aadhar_img');
            $table->text("meta")->default(json_encode(["manager_name"=>null, "alt_phone"=>null, "gender"=>null, "pan_no"=>null, "aadha_no"=>null, "address_line1"=>null, "address_line2"=>null]))->change();
            $table->text("bank_meta")->default(json_encode(["acc_no"=>null, "bank_name"=>null, "holder_name"=>null, "ifsc"=>null, "branch_name"=>null]))->after('meta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            //
        });
    }
}
