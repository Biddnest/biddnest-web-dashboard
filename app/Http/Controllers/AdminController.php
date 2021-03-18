<?php
namespace App\Http\Controllers;

use App\Models\AdminZone;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Service;
use App\Models\Subservice;
use App\Models\Inventory;
use App\Models\Organization;
use App\Models\Org_kyc;
use App\Helper;
use App\Sms;


use  App\Jobs\SendOtp;


class AdminController extends Controller
{
    /**
     * @param $username
     * @param $password
     * @return \Illuminate\Http\JsonResponse|object
     */
    public static function login($username, $password)
    {
        $admin_user=Admin::where(['username'=>$username])
            ->OrWhere(['email'=>$username])
            ->where([ 'status'=>1, 'deleted'=>0])
            ->with("zones")
            ->first();

        if(!$admin_user)
            return Helper::response(false,"Incorrect username or password");

        // return password_verify($password, $admin_user->password) ? Helper::response(true, "Login was successfull", ["token"=>Helper::generateAuthToken(["email"=>$admin_user->email,"password"=>$password]),"expiry"=>CarbonImmutable::now()->add(365, 'day')]) : Helper::response(false, "password is incorrect");


        if(password_verify($password, $admin_user->password))
        {
           Session::put(["account"=>['id'=>$admin_user->id,
                        'name'=>$admin_user->fname.' '.$admin_user->lname,
                        'email'=>$admin_user->email]]);
            Session::put('sessionActive', true);
            Session::put('user_role', $admin_user->role);
            $zone = [];
            if(!$admin_user->zones){
                foreach($admin_user->zones as $zone){
                    $zones[] = $zone;
                }
            }
            Session::put('zones', $zones);

           return Helper::response(true, "Login was successfull");
        }
        else{
            return Helper::response(false, "password is incorrect");
        }

    }

    /**
     * @param $phone
     * @return \Illuminate\Http\JsonResponse|object
     */
    public static function forgotPasswordSendOtp($phone)
    {
        $user_phone=Admin::where('phone',$phone)->first();
        if(!$user_phone)
            return Helper::response(false,"Phone number is not registered");

        $otp = Helper::generateOTP(6);
//          $msg= SendOtp::dispatch($otp, $phone)->delay(Carbon::now()->addSecond(10))->afterResponse();
            dispatch(function() use($otp, $phone){
                Sms::sendOtp($phone, $otp);
                Admin::where('phone',$phone)->update(['otp' => $otp, 'forgot_pwd'=>1]);
            })->afterResponse();

            return Helper::response(true,"Otp has been sent successfully.");
    }

    /**
     * @param $otp
     * @param $bearer
     * @return \Illuminate\Http\JsonResponse|object
     */
    public static function verifyOtp($otp, $bearer)
    {
        $admin_user=DB::table('admins')->where(['id'=> $bearer, 'forgot_pwd'=>1])->first();
        if(!$admin_user){
            return Helper::response(false,"user not found");
        }
        return $otp == $admin_user->otp ? Helper::response(true, "otp has been verified") : Helper::response(false, "otp is incorrect");
    }

    /**
     * @param $password
     * @param $bearer
     * @return \Illuminate\Http\JsonResponse|object
     */
    public static function resetPassword($password, $bearer)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $update_password=DB::table('admins')->where('id',$bearer)->update(['password' => $hash]);
        return !$update_password ? Helper::response(false,"Reset password failed") : Helper::response(true,"Password reset successfully");
    }

    public static function kycList()
    {
        $result=DB::table('org_kycs')->select('*')->where(['status'=> 1, 'deleted'=>0])->get();

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", $result);
    }

   public static function update($id, $fname, $lname, $email, $phone, $role, $zones){

       $exist= Admin::findOrFail($id);
       if(!$exist){
           return Helper::response(false,"Order is not Exist");
       }

        $update = Admin::where("id",$id)->update([
            "fname"=>$fname,
            "lname"=>$lname,
            "email"=>$email,
            "phone"=>$phone,
            "role"=>$role
        ]);

        foreach($zones as $zone){
            $zone = new AdminZone;
            $zone->admin_id = $id;
            $zone->zone_id = $zone;
            $zone->save();
        }

       if(!$update)
           return Helper::response(false,"Could not update admin.");
       else
           return Helper::response(true,"Data updated successfully", ["admin"=>Admin::with("zones")->findOrFail($id)]);
   }
}
