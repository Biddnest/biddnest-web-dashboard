<?php

namespace App\Http\Controllers\User;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Sms;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use PHPUnit\TextUI\Help;
use function MongoDB\BSON\toJSON;

class UserController extends Controller
{
    private static $publicData =['fname','lname','email','phone','dob','avatar'];

    function __construct(){
//    $this->publicData = ['fname','lname','email','phone','dob','avatar'];
    }
    public static function login($phone)
    {
        $user = User::where(['phone'=>$phone])
            ->where([ 'deleted'=>0])
            ->first();

        $otp = Helper::generateOTP(6);
        if(!$user) {
            $newuser = new User();
            $newuser->phone = $phone;
            $newuser->verf_code = $otp;
            $newuser->status = 0;
            $newuser->save();
            $data = ["new"=>true];
        }
        else{
            User::where("phone",$phone)
                  ->update(["verf_code"=>$otp]);

            if(($user->otp_verified === 0 || $user->status === 0))
                $data = ["new"=>true];
            else
                $data = ["new"=>false];

        }

        dispatch(function() use($phone, $otp){
            Sms::sendOtp($phone, $otp);
        })->afterResponse();

        return Helper::response(true, "Otp has been sent to the phone.", $data);
    }

    public static function verifyLoginOtp($phone, $otp){
        $user = User::where("phone",$phone)->where(['deleted'=>0])->first();
        if(!$user)
                return Helper::response(false, "The phone number is not registered. Invalid Action",null,401);

        if($user->verf_code == null){
            return Helper::response(false, "No otp code was generated. This is an invalid action.", null, 401);
        }
        else if($user->verf_code == $otp) {
            User::where("phone",$phone)->update(["verf_code"=>null,"otp_verified"=>1]);

            return Helper::response(true, "Otp has been verified");
        }else {
            return Helper::response(false, "Incorrect otp provided");
        }
    }

    public static function signupUser($phone, $fname, $lname, $email, $gender, $ref_code){
        $user = User::where("phone",$phone)->where([ 'deleted'=>0])->first();
        /*if(!$user)
            return Helper::response(false, "The phone number is not registered. Invalid Action",null,401);

        if($user->otp_verified === 0)
            return Helper::response(false, "OTP has not been verified. Invalid Action.",null,401);

        if($user->fname !== null ||$user->lname !== null || $user->gender !== null )
            return Helper::response(false, "User is already signed up. Invalid action.",null,401);*/

        $avatar_file_name = $fname."-".$lname."-".$user->id.".png";

        $updated_user = User::where("phone",$phone)->update([
            'fname'=>$fname,
            'lname'=>$lname,
            'email'=>$email,
            'gender'=>$gender,
            'avatar'=>Helper::saveFile(Helper::generateAvatar($fname." ".$lname),$avatar_file_name,"avatars"),
            'meta'=>json_encode(["refferal_code"=>$ref_code]),
            "status"=>1
        ]);

        $jwt_token = Helper::generateAuthToken(["phone"=>$user->phone,"id"=>$user->id]);

        return Helper::response(true, "User has been signed up",[
            "user"=>User::select(self::$publicData)->findOrFail($user->id),
            "token"=>$jwt_token, "expiry_on"=>CarbonImmutable::now()->add(365, 'day')->format("Y-m-d h:i:s")
        ]);
    }
}
