<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

namespace App\Http\Controllers\User;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SlideBanner;
use App\Models\Slider;
use App\Models\Banners;
use App\Sms;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;

class UserController extends Controller
{
    private static $publicData =['fname','lname','email','phone','dob','avatar','gender'];

    function __construct(){
    }

    /**
     * @param $phone
     * @return \Illuminate\Http\JsonResponse|object
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
        $data['otp'] = $otp;

        return Helper::response(true, "Otp has been sent to the phone.", $data);
    }

    /**
     * @param $phone
     * @param $otp
     * @return \Illuminate\Http\JsonResponse|object
     */
    public static function verifyLoginOtp($phone, $otp){
        $user = User::where("phone",$phone)->where(['deleted'=>0])->first();
        if(!$user)
                return Helper::response(false, "The phone number is not registered. Invalid Action",null,401);

        if($user->verf_code == null){
            return Helper::response(false, "No otp code was generated. This is an invalid action.", null, 401);
        }
        else if($user->verf_code == $otp) {
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
     * @return \Illuminate\Http\JsonResponse|object
     */
    public static function signupUser($id, $fname, $lname, $email, $gender, $ref_code){
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

        User::where("id",$id)->update([
            'fname'=>$fname,
            'lname'=>$lname,
            'email'=>$email,
            'gender'=>$gender,
            'avatar'=>Helper::saveFile(Helper::generateAvatar($fname." ".$lname),$avatar_file_name,"avatars"),
            'meta'=>json_encode(["refferal_code"=>$ref_code]),
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
     * @return \Illuminate\Http\JsonResponse|object
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


    /*slider and banners */
    public static function get()
    {
        $result=Slider::where(['status'=> 1, 'deleted'=>0])->with("banners")->get();

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", $result);
    }

    public static function getByZone($zones)
    {
        $result=Slider::where(['status'=> 1, 'deleted'=>0])->andWhereIn("zone_id",$zones)->with("banners")->get();

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", $result);
    }

    public static function add($name, $type, $position, $platform, $size, $from_date, $to_date, $zone_specific)
    {
        $slider=new Slider;
        $slider->name = $name;
        $slider->type = $type;
        $slider->position = $position;
        $slider->platform = $platform;
        $slider->size = $size;
        $slider->from_date = $from_date;
        $slider->to_date = $to_date;
        $slider->zone_specific = $zone_specific;
        $result= $slider->save();

        if(!$result)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"save data successfully");

    }

    public static function delete($id)
    {
        $delete_slider=Slider::where("id",$id)->update(["deleted" => 1]);
        $delete_banner=SlideBanner::where("slider_id", $id)->update(["deleted" => 1]);

        if(!$delete_slider)
            return Helper::response(false,"Couldn't Delete data");
        else
            return Helper::response(true,"Data Deleted successfully");
    }

    public static function banners()
    {
        $result=DB::table('banners')->select('*')->where(['status'=> 1, 'deleted'=>0])->get();

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", $result);
    }

    public static function addBanner($data)
    {
        $slider = Slider::findOrFail($data["id"]);
        if(!$slider)
            return Helper::response(false,"Incorrect slider id.");

        switch ($slider['size']){
            case SliderEnums::$SIZE['wide']:
                $width = SliderEnums::$BANNER_DIMENSIONS["wide"][0];
                $height = SliderEnums::$BANNER_DIMENSIONS["wide"][1];
                break;
            case "square":
                $width = SliderEnums::$BANNER_DIMENSIONS["square"][0];
                $height = SliderEnums::$BANNER_DIMENSIONS["square"][1];
                break;
            default:
                $width = SliderEnums::$BANNER_DIMENSIONS["wide"][0];
                $height = SliderEnums::$BANNER_DIMENSIONS["wide"][1];
        }


        $image = new ImageManager(array('driver' => 'gd'));

        $order = 0;

        SlideBanner::where("slider_id",$data["id"])->delete();

        foreach($data['banners'] as $banner) {
            $banner_file_name = "banner-".$banner['name']."-".uniqid().".png";
            $banners=new Banners;
            $banners->slider_id= $data['id'];
            $banners->image = Helper::saveFile($image->make($banner['image'])->resize($width,$height)->encode('png', 75),$banner_file_name,"slide-banners");
            $banners->name= $banner['name'];
            $banners->url= $banner['url'];
            $banners->from_date= $banner['date']['from'];
            $banners->to_date = $banner['date']['to'];
            $banners->order = $order;
            $result= $banners->save();
            $order++;
        }

        if(!$banner)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"Banner Saved successfully",["slider"=>Slider::with("banners")->findOrFail($data['id'])]);
    }

    public static function deleteBanner($id)
    {
        $result = SlideBanner::where("slider_id",$id)->destroy();


        if(!$result)
            return Helper::response(false,"Couldn't Delete data $result");
        else
            return Helper::response(true,"Data Deleted successfully");
    }


}
