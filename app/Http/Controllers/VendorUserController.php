<?php

namespace App\Http\Controllers;

use App\CommonEnums;
use App\Helper;
use App\Models\Vendor;
use App\Models\Organization;
use App\VendorEnums;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorUserController extends Controller
{
    public function __construct(){

    }

    public static function login($username, $password)
    {
        $admin_user=Vendor::where(['email'=>$username])
            ->where(['deleted'=>CommonEnums::$NO])
            ->first();

        if(!$admin_user)
            return Helper::response(false,"Incorrect username or password");

        if($admin_user->status == VendorEnums::$STATUS['suspended'])
            return Helper::response(false,"Your account has been suspended by your organization. Please Contant your admin.");

            return password_verify($password, $admin_user->password) ? Helper::response(true, "Login was successfull", ["token"=>Helper::generateAuthToken(["email"=>$admin_user->email,"password"=>$password]),"expiry"=>CarbonImmutable::now()->add(365, 'day')]) : Helper::response(false, "password is incorrect");

    }

    public function logout(){}



}
