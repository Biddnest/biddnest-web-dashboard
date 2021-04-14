<?php

namespace App\Http\Controllers\Vendor;

use App\Enums\OrganizationEnums;
use App\Enums\VendorEnums;
use App\Helper;
use App\VendorRoles;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Sms;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Session;

class VendorController extends Controller
{
    function __construct(){
    }

    public static function login($email, $password)
    {
        $vendor = Vendor::where(['email'=>$email])
        ->where([ 'deleted'=>0])
        ->first();

        if(!$vendor)
            return Helper::response(false, "The email id is not registered. Invalid Action");

        if(password_verify($password, $vendor->password)){
            if($vendor->status != VendorEnums::$STATUS['active'])
                return Helper::response(false, "Your Account is inactive or suspended. Please contact your Organization Admin.");
            Session::put('account', ['fname'=>$vendor->fname, 'lname'=>$vendor->lname,'email'=>$vendor->email]);
            return   Helper::response(true, "Login was successfull");
        }
        else{
            return Helper::response(false, "password is incorrect");
        }

    }
}
