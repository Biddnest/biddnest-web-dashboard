<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Subservice;
use App\Models\Inventory;
use App\Models\Organization;
use App\Models\Org_kyc;
use App\Helper;
use App\Sms;


class AdminController extends Controller
{
    public static function login($username, $password)
    {
        $admin_user=DB::table('admins')->where(['username'=>$username, 'status'=>1])->first();
        if(!$admin_user){
            return Helper::response(false,"username is invalid or Deactivate");
        }
        return password_verify($password, $admin_user->password) ? Helper::response(true, "username has been loged in") : Helper::response(false, "password is incorrect");

    }

    public static function forgotPasswordSendOtp($phone)
    {
        $user_phone=DB::table('admins')->where('phone',$phone)->first();
        if(!$user_phone){
            return Helper::response(false,"Phone number is not registered");
        }
        if($phone == $user_phone->phone)
        {
            $otp = Helper::generateOTP(6);

            $insert_otp=DB::table('admins')->where('phone',$phone)->update(['otp' => $otp, 'forgot_pwd'=>1]);

            if(!$insert_otp){
                return Helper::response(false,"Couldn't save Otp");
            }
            $msg= Sms::sendOtp($phone,$otp);
            return !$msg[0] ? Helper::response(false,"Couldn't sent Otp",$msg["error"]) : Helper::response(true,"otp has been sent successfully");

        }
    }

    public static function verifyOtp($otp,$bearer)
    {
        $admin_user=DB::table('admins')->where(['id'=> $bearer, 'forgot_pwd'=>1])->first();
        if(!$admin_user){
            return Helper::response(false,"user not found");
        }
        return $otp == $admin_user->otp ? Helper::response(true, "otp has been verified") : Helper::response(false, "otp is incorrect");
    }

    public static function resetPassword($password, $bearer)
    {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $update_password=DB::table('admins')->where('id',$bearer)->update(['password' => $hash]);
        return !$update_password ? Helper::response(false,"Reset password failed") : Helper::response(true,"Password reset successfully");
    }

    // public static function dashboard()
    // {
    //     $record=DB::table('orders')->select('order_id','status','amount')->orderByRaw('created_at DESC')->limit(5)->get();
    //     return $record ;
    // }

    public static function serviceAdd($name)
    {
        $service=new Service;
        $service->name=$name;
        $result= $service->save();

        if(!$result)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"save data successfully");
    }

    public static function service()
    {
        $service=DB::table('services')->select('*')->where(['status'=> 1, 'deleted'=>0])->get();
        if(!$service)
            return Helper::response(false,"Records not exist");
        else
            return Helper::response(true,"Data displayed successfully", $service);
    }

    public static function serviceEdit($name, $id)
    {
        $result=DB::update(
            'update services set name = ? where id = ?',
            [$name, $id]
        );

        if(!$result)
            return Helper::response(false,"Couldn't update data");
        else
            return Helper::response(true,"Data updated successfully");
    }

    public static function serviceGet($id)
    {
        $result=DB::table('services')->select('*')->where('id', $id)->first();

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", $result);
    }

    public static function serviceDelete($id)
    {
        $result=DB::update(
            'update services set deleted = ? where id = ?',
            [1, $id]
        );

        if(!$result)
            return Helper::response(false,"Couldn't Delete data $result");
        else
            return Helper::response(true,"Data Deleted successfully");
    }

    public static function subService()
    {
        $subservice=DB::table('subservices')->select('*')->where(['status'=> 1, 'deleted'=>0])->get();
        if(!$subservice)
            return Helper::response(false,"Records not exist");
        else
            return Helper::response(true,"Data displayed successfully", $subservice);
    }

    public static function subServiceAdd($name, $service_id)
    {
        $subservice=new Subservice;
        $subservice->name=$name;
        $subservice->service_id=$service_id;
        $result= $subservice->save();

        if(!$result)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"save data successfully");
    }

    public static function subServiceEdit($name, $service_id, $id)
    {
        $result=DB::update(
            'update subservices set name = ?, service_id=? where id = ?',
            [$name, $service_id, $id]
        );

        if(!$result)
            return Helper::response(false,"Couldn't update data");
        else
            return Helper::response(true,"Data updated successfully");
    }

    public static function subServiceGet($id)
    {
        $result=DB::table('subservices')->select('*')->where('id', $id)->first();
        if(!$result)
            return Helper::response(false,"Couldn't display data");
        else
            return Helper::response(true,"Data display successfully", $result);
    }

    public static function subServiceDelete($id)
    {
        $result=DB::update(
            'update subservices set deleted = ? where id = ?',
            [1, $id]
        );

        if(!$result)
            return Helper::response(false,"Couldn't Delete data $result");
        else
            return Helper::response(true,"Data Deleted successfully");
    }

    public static function inventories()
    {
        $inventories=DB::table('inventories')->select('*')->where(['status'=> 1, 'deleted'=>0])->get();
        if(!$inventories)
            return Helper::response(false,"Records not exist");
        else
            return Helper::response(true,"Data displayed successfully", $inventories);
    }

    public static function inventoriesAdd($name, $subservice_id, $material, $image)
    {


        $inventory=new Inventory;
        $inventory->name=$name;
        $inventory->sub_service_id=$subservice_id;
        $inventory->material=$material;
        $inventory->image=$image;
        $result= $inventory->save();

        if(!$result)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"save data successfully");
    }

    public static function inventoriesEdit($name, $subservice_id, $material, $image, $id)
    {
        $result=DB::update(
            'update inventories set name = ?, sub_service_id=?, material=?, image=? where id = ?',
            [$name, $subservice_id, $material, $image, $id]
        );

        if(!$result)
            return Helper::response(false,"Couldn't update data");
        else
            return Helper::response(true,"Data updated successfully");
    }

    public static function inventoriesGet($id)
    {
        $result=DB::table('inventories')->select('*')->where('id', $id)->first();
        if(!$result)
            return Helper::response(false,"Couldn't Display data");
        else
            return Helper::response(true,"Data Display successfully", $result);
    }

    public static function inventoriesDelete($id)
    {
        $result=DB::update(
            'update inventories set deleted = ? where id = ?',
            [1, $id]
        );

        if(!$result)
            return Helper::response(false,"Couldn't Delete data $result");
        else
            return Helper::response(true,"Data Deleted successfully");
    }

    public static function vendorsList()
    {
        $vendors=DB::table('organizations')->select('*')->where(['status'=> 1, 'deleted'=>0])->get();
        if(!$vendors)
            return Helper::response(false,"Records not exist", $vendors);
        else
            return Helper::response(true,"Data displayed successfully", $vendors);
    }

    public static function vendorAdd($filename, $email, $phone, $org_name, $lat, $lng, $zone, $pincode, $city, $state, $service_type, $meta)
    {

        $organizations=new Organization;
        $organizations->image=$filename;
        $organizations->email=$email;
        $organizations->phone=$phone;
        $organizations->org_name=$org_name;
        $organizations->lat =$lat;
        $organizations->lng =$lng;
        $organizations->zone_id =$zone;
        $organizations->pincode =$pincode;
        $organizations->city =$city;
        $organizations->state =$state;
        $organizations->service_type =$service_type;
        $organizations->meta =json_encode($meta);
        $result= $organizations->save();
        if(!$result)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"save data successfully");
    }

    public static function vendorFetch($id)
    {
        $result=DB::table('organizations')->select('*')->where('id', $id)->first();

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", $result);
    }

    public static function vendorEdit($id, $filename, $email, $phone, $org_name, $lat, $lng, $zone, $pincode, $city, $state, $service_type, $meta)
    {

        $result=DB::update(
            'update organizations set image = ?, email=?, phone=?, org_name=?, lat=?, lng=?, zone_id=?, pincode=?, city=?, state=?, service_type=?, meta=? where id = ?',
            [$filename, $email, $phone, $org_name, $lat, $lng, $zone, $pincode, $city, $state, $service_type, json_encode($meta), $id]
        );


        if(!$result)
            return Helper::response(false,"Couldn't update data", $result);
        else
            return Helper::response(true,"Data updated successfully", $result);
    }

    public static function vendorDelete($id)
    {
        $result=DB::update(
            'update organizations set deleted = ? where id = ?',
            [1, $id]
        );

        if(!$result)
            return Helper::response(false,"Couldn't Delete data $result");
        else
            return Helper::response(true,"Data Deleted successfully");
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
