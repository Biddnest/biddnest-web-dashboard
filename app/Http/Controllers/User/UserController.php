<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

namespace App\Http\Controllers\User;

use App\Enums\CommonEnums;
use App\Enums\SliderEnum;
use App\Enums\UserEnums;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\User;
use App\Sms;
use Carbon\CarbonImmutable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use PUGX\Shortid\Shortid;

class UserController extends Controller
{
    private static $publicData =['fname','lname','email','phone','dob','avatar','gender'];

    function __construct(){
    }

    /**
     * @param $phone
     * @return JsonResponse|object
     */
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
        } else{
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
        $data['otp'] = $otp;

        return Helper::response(true, "Otp has been sent to the phone.", $data);
    }

    /**
     * @param $phone
     * @param $otp
     * @return JsonResponse|object
     */
    public static function verifyLoginOtp($phone, $otp){
        $user = User::where("phone",$phone)->where(['deleted'=>0])->first();
        if(!$user)
            return Helper::response(false, "The phone number is not registered. Invalid Action",null,401);

        if($user->verf_code == null){
            return Helper::response(false, "No otp code was generated. This is an invalid action.", null, 401);
        } else if($user->verf_code == $otp) {
            User::where("phone",$phone)->update(["verf_code"=>null,"otp_verified"=>1]);

            $jwt_token = Helper::generateAuthToken(["phone"=>$user->phone,"id"=>$user->id]);

            $data = null;
            if($user->fname){
                $data = $user;
            }

            return Helper::response(true, "Otp has been verified",[
                "user"=>$data,
                "token"=>$jwt_token, "expiry_on"=>CarbonImmutable::now()->add(365, 'day')->format("Y-m-d h:i:s")
            ]);

        }else {
            return Helper::response(false, "Incorrect otp provided");
        }
    }

    /**
     * @param $id
     * @param $fname
     * @param $lname
     * @param $email
     * @param $gender
     * @param $ref_code
     * @return JsonResponse|object
     */
    public static function signupUser($id, $fname, $lname, $email, $gender, $refby_code){
        $user = User::where("id",$id)->where([ 'deleted'=>0])->first();
        if(!$user)
            return Helper::response(false, "The phone number is not registered. Invalid action",null,401);

        if($user->otp_verified === 0)
            return Helper::response(false, "OTP has not been verified. Invalid action.",null,401);

        if($user->fname !== null ||$user->lname !== null || $user->gender !== null )
            return Helper::response(false, "User is already signed up. Invalid action.",null,401);

        $emailExists = User::where("email",$email)->where("id","!=",$id)->first();
        if($emailExists)
            return Helper::response(false, "The email id $email is already linked to another account.",);

        $avatar_file_name = $fname."-".$lname."-".$user->id.".png";

        $short_id = Shortid::generate(6, null, true);
        $ref_code = strtoupper(substr($fname,0,3).$short_id);

        User::where("id",$id)->update([
            'fname'=>$fname,
            'lname'=>$lname,
            'email'=>$email,
            'gender'=>$gender,
            'avatar'=>Helper::saveFile(Helper::generateAvatar($fname." ".$lname),$avatar_file_name,"avatars"),
            'meta'=>json_encode(["refferal_code"=>$ref_code, "reffered_by"=>$refby_code]),
            "status"=>1
        ]);

        return Helper::response(true, "User has been signed up",[
            "user"=>User::select(self::$publicData)->findOrFail($user->id)
        ]);
    }

    /**
     * @param $id
     * @param $fname
     * @param $lname
     * @param $email
     * @param $gender
     * @param $dob
     * @param $avatar
     * @return JsonResponse|object
     */
    public static function update($id, $fname, $lname, $email, $gender, $dob, $avatar){
        $user = User::where("id",$id)->where([ 'deleted'=>0])->first();
        if(!$user)
            return Helper::response(false, "The phone number is not registered. Invalid action.",null,401);

        if($user->status !== 1)
            return Helper::response(false, "User is not verified or is banned. Invalid action.",null,401);

        $emailExists = User::where("email",$email)->where("id","!=",$id)->first();
        if($emailExists)
            return Helper::response(false, "The email id $email is already linked to another account.");

        $updateColumns = [
            'fname'=>$fname,
            'lname'=>$lname,
            'email'=>$email,
            'gender'=>$gender,
            'dob'=>$dob,
        ];
        if($avatar){
            $image = new ImageManager(array('driver' => 'imagick'));
            $image->configure(array('driver' => 'gd'));
            $avatar_file_name = $user->fname."-".$user->lname."-".$user->id.".png";
            $updateColumns["avatar"] = Helper::saveFile($image->make($avatar)->resize(100,100)->encode('png', 75),$avatar_file_name,"avatars");
        }

        User::where("id",$id)->update($updateColumns);

        return Helper::response(true, "Profile has been updated.",[
            "user"=>User::select(self::$publicData)->findOrFail($user->id)
        ]);

    }

    public static function getAppSliders($lat, $lng)
    {
        $date = date('Y-m-d');
        $result=Slider::where(['status'=> CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])
            ->where('from_date','<=', $date)
            ->where('to_date','>=', $date)
            ->where('platform', SliderEnum::$PLATFORM['app'])->with(["banners"=> function($banner) use($date){
                $banner->where(['status'=> CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])
                    ->where('from_date','<=', $date)
                    ->where('to_date','>=', $date)->orderBy('order');
            }])->get();

        foreach ($result as $slide_key=>$slide)
        {
            foreach ($slide->banners as $banner_key=>$banner)
            {
                $result[$slide_key]['banners'][$banner_key]['banner_size']=$slide['size'];
            }
        }

        return Helper::response(true,"Data fetched successfully", ["sliders"=>$result]);
    }

    public static function search(Request $request)
    {
//        return $request;
//        $query = $request->all()['query'];
        $query = $request->q;

        if (empty($query))
            return Helper::response(true, "Data fetched successfully", ["users" => []]);
//        return $query;
        $users = User::where("fname", "LIKE", $query . '%')->paginate(5);
        return Helper::response(true, "Data fetched successfully", ["users" => $users->items()]);
    }

    public static function verifyAuth($id)
    {
        $user = User::find($id);
        if ($user->status == UserEnums::$STATUS['active'])
            return Helper::response(true, "User authenticated successfully");
        elseif ($user->status == UserEnums::$STATUS['suspended'])
            return Helper::response(false, "You are suspended from using this application. Please contact the support.", null, 401);
        else
            return Helper::response(false, "Something went wrong in server. Please contact support.", null, 401);
    }
}
