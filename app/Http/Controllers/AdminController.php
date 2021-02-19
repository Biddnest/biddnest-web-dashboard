<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
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
            ->first();

        if(!$admin_user)
            return Helper::response(false,"Incorrect username or password");

        return password_verify($password, $admin_user->password) ? Helper::response(true, "Login was successfull", ["token"=>Helper::generateAuthToken(["email"=>$admin_user->email,"password"=>$password]),"expiry"=>CarbonImmutable::now()->add(365, 'day')]) : Helper::response(false, "password is incorrect");

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

    public static function vendorAddKyc($filename_bidnest_agreement, $filename_adhaar_card, $filename_pan_card, $filename_gst_certificate, $company_reg_certificate, $banking_details)
    {
        $last = DB::table('organizations')->latest()->first();

        $org_kyc=new Org_kyc;
        $org_kyc->org_id= $last->id;
        $org_kyc->aadhar_card=$filename_adhaar_card;
        $org_kyc->pan_card=$filename_pan_card;
        $org_kyc->gst_certificate=$filename_gst_certificate;
        $org_kyc->company_reg_certificate =$company_reg_certificate;
        $org_kyc->bidnest_agreement =$filename_bidnest_agreement;
        $org_kyc->banking_details =json_encode($banking_details);
        $result= $org_kyc->save();

        if(!$result)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"save data successfully");
    }

    public static function vendorEditKyc($id, $filename_bidnest_agreement, $filename_adhaar_card, $filename_pan_card, $filename_gst_certificate, $company_reg_certificate, $banking_details)
    {
        $result=DB::update(
            'update org_kycs set aadhar_card = ?, pan_card=?, gst_certificate=?, company_reg_certificate=?, bidnest_agreement=?,  banking_details=? where id = ?',
            [$filename_adhaar_card, $filename_pan_card, $filename_gst_certificate, $company_reg_certificate, $filename_bidnest_agreement, json_encode($banking_details), $id]
        );


        if(!$result)
            return Helper::response(false,"Couldn't update data", $result);
        else
            return Helper::response(true,"Data updated successfully", $result);
    }

    public static function kycFetch($id)
    {
        $result=DB::table('org_kycs')->select('*')->where(['status'=> 1, 'deleted'=>0, 'id'=>$id])->first();

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", $result);
    }

    public static function kycDelete($id)
    {
        $result=DB::update(
            'update org_kycs set deleted = ? where id = ?',
            [1, $id]
        );

        if(!$result)
            return Helper::response(false,"Couldn't Delete data $result");
        else
            return Helper::response(true,"Data Deleted successfully");
    }

    public static function vendorList()
    {
        $result=DB::table('organizations') ->join('org_kycs', 'organizations.id', '=', 'org_kycs.org_id')->select('*')->where(['org_kycs.status'=> 1, 'org_kycs.deleted'=>0, 'organizations.status'=> 1, 'organizations.deleted'=>0])->get();

        if(!$result)
            return Helper::response(false,"Couldn't Display data");
        else
            return Helper::response(true,"Data Display successfully", $result);
    }

    public static function vendorsGetRecord($id)
    {
        $result=DB::table('organizations') ->join('org_kycs', 'organizations.id', '=', 'org_kycs.org_id')->select('*')->where(['organizations.id'=>$id])->first();

        if(!$result)
            return Helper::response(false,"Couldn't fetch data");
        else
            return Helper::response(true,"Data fetch successfully", $result);
    }

    public static function vendorsDeleteRecord($id)
    {
        $result=DB::update(
            'update org_kycs set deleted = ? where org_id = ?',
            [1, $id]
        );

        $result1=DB::update(
            'update organizations set deleted = ? where id = ?',
            [1, $id]
        );

        if(!$result && !$result1)
            return Helper::response(false,"Couldn't Delete data",$result);
        else
            return Helper::response(true,"Data Deleted successfully");
    }

}
