<?php

namespace App\Http\Controllers\Vendor;

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

            Session::put('account', ['fname'=>$vendor->fname, 'lname'=>$vendor->lname,'email'=>$vendor->email]);
            return   Helper::response(true, "Login was successfull");
        }
        else{
            return Helper::response(false, "password is incorrect");
        }

    }

    public static function phoneVerification($phone)
    {
        $user = Vendor::where(['phone'=>$phone])
            ->where([ 'deleted'=>0])
            ->first();

        $otp = Helper::generateOTP(6);
            $newvendor =Vendor::where(['phone'=>$phone])
            ->update([
                'verf_code'=>$otp
            ]);

        dispatch(function() use($phone, $otp){
            Sms::sendOtp($phone, $otp);
        })->afterResponse();
        $data['otp'] = $otp;

        return Helper::response(true, "Otp has been sent to the phone.", $data);
    }

    public static function verifyOtp($phone, $otp)
    {
        $vendor = Vendor::where("phone",$phone)->where(['deleted'=>0])->first();
        if(!$vendor)
            return Helper::response(false, "The phone number is not registered. Invalid Action",null,401);

        if($vendor->verf_code == null){
            return Helper::response(false, "No otp code was generated. This is an invalid action.", null, 401);
        }
        else if($vendor->verf_code == $otp) {
            Vendor::where("phone",$phone)->update(["otp_verified"=>1]);

            $jwt_token = Helper::generateAuthToken(["phone"=>$vendor->phone,"id"=>$vendor->id]);

            $data = null;
            if($vendor->fname){
                $data = $vendor;
            }

            return Helper::response(true, "Otp has been verified",[
                "user"=>$data,
                "token"=>$jwt_token, "expiry_on"=>CarbonImmutable::now()->add(365, 'day')->format("Y-m-d h:i:s")
            ]);

        }else {
            return Helper::response(false, "Incorrect otp provided");
        }
    }

    public static function resetPassword($phone, $otp, $new_password, $confirm_password)
    {
        $vendor = Vendor::where("phone",$phone)->where(['deleted'=>0])->first();
        if(!$vendor)
            return Helper::response(false, "The phone number is not registered. Invalid Action",null,401);

        if($vendor->verf_code == null){
            return Helper::response(false, "No otp code was generated. This is an invalid action.", null, 401);
        }
        else if($vendor->verf_code == $otp) {
                Vendor::where("phone",$phone)->update(["verf_code"=>null,"otp_verified"=>1]);

                $jwt_token = Helper::generateAuthToken(["phone"=>$vendor->phone,"id"=>$vendor->id]);

                $data = null;
                if($vendor->fname){
                    $data = $vendor;
                }

                return Helper::response(true, "Otp has been verified",[
                    "user"=>$data,
                    "token"=>$jwt_token, "expiry_on"=>CarbonImmutable::now()->add(365, 'day')->format("Y-m-d h:i:s")
                ]);

                if($new_password == $confirm_password)
                {
                    $hash = password_hash($new_password, PASSWORD_BCRYPT);
                    Vendor::where("id",$vendor['id'])->update(['password'=>$hash]);
                }
                else
                {
                    return Helper::response(false, "Password not match with Confirm password");
                }
        }
        else {
            return Helper::response(false, "Incorrect otp provided");
        }


    }
}
