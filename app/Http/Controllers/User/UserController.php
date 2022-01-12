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
use App\Http\Controllers\GeoController;
use App\Http\Controllers\ReferralController;
use App\Models\Slider;
use App\Models\User;
use App\Models\ReferralHistory;
use App\Sms;
use Carbon\CarbonImmutable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManager;
use PUGX\Shortid\Shortid;

class UserController extends Controller
{
    private static $publicData =['fname','lname','email','phone','dob','avatar','gender', 'meta','freshchat_restore_id'];

    function __construct(){
    }

    /**
     * @param $phone
     * @return JsonResponse|object
     */
    public static function login($phone, $web=false)
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

//        $data['rsp'] = Sms::sendOtp($phone, $otp);
        dispatch(function() use($phone, $otp){
            Sms::sendOtp($phone, $otp);
        })->afterResponse();
        $data['otp'] = $otp;

        if($web)
            return Helper::response("await", "Otp has been sent to the phone.", $data);
        else
            return Helper::response(true, "Otp has been sent to the phone.", $data);
    }

    /**
     * @param $phone
     * @param $otp
     * @return JsonResponse|object
     */
    public static function verifyLoginOtp($phone, $otp, $web=false){
        $user = User::where("phone",$phone)->where(['deleted'=>0])->first();
        if(!$user)
            return Helper::response(false, "The phone number is not registered. Invalid Action",null,401);

        if($user->verf_code == null){
            return Helper::response(false, "No otp code was generated. This is an invalid action.", null, 401);
        } else if($user->verf_code == $otp) {

            User::where("phone",$phone)->update(["verf_code"=>null,"otp_verified"=>1]);

            $jwt_token = Helper::generateAuthToken(["phone"=>$user->phone,"id"=>$user->id]);

            $data = null;
            if($user->status == 0)
                $user["new"]=true;
            else
                $user["new"]=false;

            if($user->fname){
                $data = $user;
            }
            else{
                $data = $user;
            }

            if($web)
            {
                Session::put(["account" => ['id' => $user->id, 'fname'=>$user->fname, 'lname'=>$user->lname,'email'=>$user->email, 'phone'=>$user->phone]]);
                Session::put('sessionFor', "user");

                Session::save();
                return Helper::response("login", "Otp has been verified", ["user" => $data]);
            }
            else{
                return Helper::response(true, "Otp has been verified",[
                    "user"=>$data,
                    "token"=>$jwt_token, "expiry_on"=>CarbonImmutable::now()->add(365, 'day')->format("Y-m-d h:i:s")
                ]);
            }

        }else {
            return Helper::response(false, "Incorrect otp provided, ");
        }
    }

   /* public static function verifyLoginOtpWeb($phone, $otp){
        $user = User::where("phone",$phone)->where(['deleted'=>0])->first();
        if(!$user)
            return Helper::response(false, "The phone number is not registered. Invalid Action",null,401);

        if($user->verf_code == null){
            return Helper::response(false, "No otp code was generated. This is an invalid action.", null, 401);
        } else if($user->verf_code == $otp) {
            User::where("phone",$phone)->update(["verf_code"=>null,"otp_verified"=>1]);

//            $jwt_token = Helper::generateAuthToken(["phone"=>$user->phone,"id"=>$user->id]);

            $data = null;
            if($user->fname){
                $data = $user;
            }

            Session::put(["account" => ['id' => $user->id, 'fname'=>$user->fname, 'lname'=>$user->lname,'email'=>$user->email]]);
            Session::put('sessionFor', "user");
            return Helper::response(true, "Otp has been verified", ["user" => $data]);

        }else {
            return Helper::response(false, "Incorrect otp provided");
        }
    }*/

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
            'meta'=>json_encode(["refferal_code"=>$ref_code, "reffered_by"=>$refby_code, "city"=>$city]),
            "referral_code"=>$ref_code,
            "status"=>1
        ]);

        $user1 = User::where("id",$id)->where([ 'deleted'=>0])->first();
        Session::put(["account" => ['id' => $user1->id, 'fname'=>$user1->fname, 'lname'=>$user1->lname,'email'=>$user1->email, 'phone'=>$user1->phone]]);
        Session::put('sessionFor', "user");
        Session::save();

        /* Creating wallet for user */


        dispatch(function() use($user, $refby_code, $id){
            if(!$user->hasWallet('reward-points'))
                $wallet = $user->createWallet([
                    'name' => 'Reward Points',
                    'slug' => 'reward-points',
                ]);

            if($refby_code && $refby_code != ""){

                $referrer = User::where("referral_code",$refby_code)->first();
                $referal = new ReferralHistory();
                $referal->user_id = $id;
                $referal->referred_by_id = $referrer->id;
                $referal->zone_id = $referrer->zone_id;
                $referrer->save();

            }

            ReferralController::checkTrigger(ReferralEnums::$TRIGGER['signup']);

        })->afterResponse();


        return Helper::response(true, "User has been signed up",[
            "user"=> User::select(self::$publicData)->findOrFail($user->id)
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
    public static function update($id, $fname, $lname, $email, $gender, $dob, $avatar, $city=null, $phone=null){
        $user = User::where("id",$id)->where([ 'deleted'=>CommonEnums::$NO])->first();
        if(!$user)
            return Helper::response(false, "The phone number is not registered. Invalid action.",null,401);

        if($user->status != 1)
            return Helper::response(false, "User is not verified or is banned. Invalid action.",null,401);

        $emailExists = User::where("email",$email)->where("id","!=",$id)->first();
        if($emailExists)
            return Helper::response(false, "The email id $email is already linked to another account.");

        if($phone)
            $updateColumns["phone"] =$phone;

        $meta = json_decode($user['meta'], true);
        $meta['city'] = $city;

            $updateColumns = [
            'fname'=>$fname,
            'lname'=>$lname,
            'email'=>$email,
            'gender'=>$gender,
            'dob'=>$dob,
             "meta"=>json_encode($meta),
             "city"=>$city
        ];
        if($avatar){
            $image_man = new ImageManager(array('driver' => 'gd'));
            $avatar_file_name = $user->fname."-".$user->lname."-".$user->id.".png";
            if(filter_var($avatar, FILTER_VALIDATE_URL) === FALSE)
                $updateColumns["avatar"] = Helper::saveFile($image_man->make($avatar)->resize(100,100)->encode('png', 75),$avatar_file_name,"avatars");
        }

        User::where("id",$id)->update($updateColumns);

        $user1 = User::where("id",$id)->where([ 'deleted'=>0])->first();
        Session::put(["account" => ['id' => $user1->id, 'fname'=>$user1->fname, 'lname'=>$user1->lname,'email'=>$user1->email, 'phone'=>$user1->phone]]);
        Session::put('sessionFor', "user");

        Session::save();

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

    public static function getAppSliderstab($lat, $lng)
    {
        $date = date('Y-m-d');
        $result=Slider::where(['status'=> CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])
            ->where('from_date','<=', $date)
            ->where('to_date','>=', $date)
            ->where('platform', SliderEnum::$PLATFORM['tab'])->with(["banners"=> function($banner) use($date){
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

    public static function add($fname, $lname, $phone, $email, $gender, $dob, $avatar, $city)
    {
        $user_email=User::where('email', $email)->first();
        if($user_email)
            return Helper::response(false,"Email id is already exist in system");

        $user_phone=User::where('phone', $phone)->first();
        if($user_phone)
            return Helper::response(false,"Phone no is already exist in system");

        $image_man = new ImageManager(array('driver' => 'gd'));
        $uniq = uniqid();

        $image=Helper::saveFile($image_man->make($avatar)->resize(256,256)->encode('png', 100),"BD".$uniq.".png","Customer");

        $user = new User;
        $user->fname=$fname;
        $user->lname=$lname;
        $user->email=$email;
        $user->phone=$phone;
        $user->gender=$gender;
        $user->avatar=$image;
        $user->meta=json_encode(["refferal_code"=>"", "reffered_by"=>"", "city"=>$city]);
        $user->city=$city;
        $user->dob=date("Y-m-d", strtotime($dob));
        $save_result = $user->save();

        if(!$save_result)
            return Helper::response(false,"Couldn't save Customers");

        return Helper::response(true,"save Customers successfully", ["customer"=>User::findOrFail($user->id)]);
    }

    public static function directSignup($phone, $fname, $lname, $email, $gender=null, $refby_code=null){

        $avatar_file_name = $fname."-".$lname."-".uniqid().".png";

        $short_id = Shortid::generate(6, null, true);
        $ref_code = strtoupper(substr($fname,0,3).$short_id);

        $user = new User;
        $user->phone=$phone;
        $user->fname=$fname;
        $user->lname=$lname;
        $user->email=$email;
        $user->meta=json_encode(["refferal_code"=>$ref_code, "reffered_by"=>null]);
        $user->avatar=$avatar_file_name;
        $user->save();

        return $user;
    }

    public static function directupdate($phone, $fname, $lname, $email, $user_id, $gender=null, $refby_code=null){

        $avatar_file_name = $fname."-".$lname."-".uniqid().".png";

        $user= User::where('id', $user_id)->update([
            "fname"=>$fname,
            "lname"=>$lname,
            "avatar"=>$avatar_file_name
        ]);

        return $user;
    }

    public static function updateMobile($id, $phone, $web=false)
    {
        $otp = Helper::generateOTP(6);

        $phone_exist=User::where("phone",$phone)->first();

        if($phone_exist)
        {
            return Helper::response(false, "Phone number is exist.");
        }

        User::where("id",$id)->update(["verf_code"=>$otp]);

        dispatch(function() use($phone, $otp){
            Sms::sendOtp($phone, $otp);
        })->afterResponse();
        $data['otp'] = $otp;

        if($web)
            return Helper::response("await", "Otp has been sent to the new phone.", $data);
        else
            return Helper::response(true, "Otp has been sent to the new phone.", $data);
    }

    public static function verifyMobile($id, $phone, $otp, $web=false)
    {
        $user = User::where("id",$id)->where([ 'deleted'=>CommonEnums::$NO])->first();
        if($user->verf_code == $otp)
        {
            User::where("id",$id)->update(["phone"=>$phone, "verf_code"=>null,"otp_verified"=>1]);
            return Helper::response(true, "Contact number has been updated.",[
                "user"=>User::select(self::$publicData)->findOrFail($user->id)
            ]);
        }
        else {
            return Helper::response(false, "Incorrect otp provided");
        }
    }

    public static function updateFreshChatId($id,$freshchat_id)
    {
        $user = User::where("id",$id)->where([ 'deleted'=>CommonEnums::$NO])->first();

        if(!$user)
            return Helper::response(false, "Invalid user id.");

            if(User::where("id",$id)->update(["freshchat_restore_id"=>$freshchat_id]))
                return Helper::response(true, "FreshChat ID has been updated.",[
                    "user" => User::select(self::$publicData)->findOrFail($user->id)
                ]);
            else
                return Helper::response(false, "Couldn't update the FreshChat ID. This is a DB error. Please contact admin");

    }

    public static function sendReferalToPhone($id, $phone){
        $user = User::where("id",$id)->where([ 'deleted'=>CommonEnums::$NO])->first();

        $sms_body ="Hey there, I invite you to install this application using my refferal code-".json_decode($user->meta, true)['refferal_code']." to get ₹100 off on your first booking. Click here to install https://play.google.com/store";

        dispatch(function() use($phone, $sms_body){
            Sms::send($phone, $sms_body);
        });

        return Helper::response(true, "Refferal code have been send to $phone", ['sms'=>$sms_body]);
    }

    public static function sendLink($phone){
        $sms_body ="Hey there, I invite you to install. Click here to install For Android APP:- https://play.google.com/store, IOS APP:- https://play.google.com/store";

        $playstoreurl = "the app";
        dispatch(function() use($phone, $playstoreurl){
            Sms::sendReferalLink($phone, $playstoreurl);
        });

        return Helper::response(true, "Links have been send to $phone", ['sms'=>$sms_body]);
    }

    public static function addRewardPoints($user_id, $amount): bool{
        $user = User::find($user_id);

        if($user) {
            $user->deposit($amount);
            return true;
        }
        else
            return false;
    }

    public static function getByPhone($phone){

        $user = User::where("phone",$phone)->first();

        if(!$user)
         return Helper::response(false, "No user found");

         return Helper::response(true, "Here are the user details",[
            "user"=> $user
            ]);
    }

    public static function getReferralUrl($user_id){
        $user = User::find($user_id);

        if(!$user)
            return Helper::response(false, "No user found.");
        $referrer_code = $user->referral_code;
        $long_url = "https://play.google.com/store/apps/details?id=com.bidnest.customer&referrer={$referrer_code}";
        $response = Http::withToken(env("BITLY_TOKEN"))->acceptJson()->post('https://api-ssl.bitly.com/v4/shorten', [
            'long_url' => $long_url,
            "domain"=>'bit.ly'
        ]);

        if($response->successful())
            return Helper::response(true, "Here is the short url", [
                "short_url"=>$response->json()['link']
            ]);
        else
            return Helper::response(false, "Invalid Response from url shortner service.");
    }

    public function saveLocation($user_id, $lat, $long){

        $update = User::where("id",$user_id)->update([
            "zone_id"=>GeoController::getNearestZone($lat,$long)
        ]);

        if($update)
            return Helper::response(true,"Location has been captured.");
        else
            return Helper::response(false,"Could not update location.");

    }

}
