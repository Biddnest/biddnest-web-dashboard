<?php
namespace App\Http\Controllers;

use App\Enums\AdminEnums;
use App\Enums\CommonEnums;
use App\Enums\CouponEnums;
use App\Models\AdminZone;
use App\Models\Zone;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Crypt;
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
use Intervention\Image\ImageManager;


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

        if(password_verify($password, $admin_user->password))
        {
           Session::put(["account"=>['id'=>$admin_user->id,
                        'name'=>$admin_user->fname.' '.$admin_user->lname,
                        'email'=>$admin_user->email]]);
            Session::put('sessionActive', true);
            Session::put('user_role', $admin_user->role);
            $zone = [];

            if($admin_user->zones){
                Session::put("zones",$admin_user->zones);
                foreach($admin_user->zones as $zone){
                    $zones[] = $zone->id;
                }
            }
            Session::put('admin_zones', $zones);

           return Helper::response(true, "Login was successfully");
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
        $admin_user=DB::table('admins')->where(['phone'=> $bearer, 'forgot_pwd'=>1])->first();
        if(!$admin_user){
            return Helper::response(false,"user not found");
        }

        $admin_user->id = Crypt::encryptString($admin_user->id);

        return $otp == $admin_user->otp ? Helper::response(true, "otp has been verified", ["otp"=>$admin_user]) : Helper::response(false, "otp is incorrect");
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

    public static function OldResetPassword($old_password, $password, $bearer)
    {
        $exist =Admin::where('id',$bearer)->first();
        if(password_verify($old_password, $exist->password)) {
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $update_password = DB::table('admins')->where('id', $bearer)->update(['password' => $hash]);
            return !$update_password ? Helper::response(false, "Reset password failed") : Helper::response(true, "Password reset successfully");
        }
        else
            return Helper::response(false, "Old Password Does not match!");
    }

    public static function kycList()
    {
        $result=DB::table('org_kycs')->select('*')->where(['status'=> 1, 'deleted'=>0])->get();

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", $result);
    }

    public static function add($data)
    {
        $image_man = new ImageManager(array('driver' => 'gd'));
        $uniq = uniqid();

        $meta =json_encode(["manager_name" => $data['meta']['manager_name'], "alt_phone" => $data['meta']['alt_phone'], "gender"=>$data['meta']['gender'], "pan_no"=>$data['meta']['pan_no'], "aadha_no"=>$data['meta']['adhar_no'], "address_line1"=>$data['meta']['address_line1'], "address_line2"=>$data['meta']['address_line2']]);

        $admin =new Admin;
        $admin->image=Helper::saveFile($image_man->make($data['image'])->resize(100,100)->encode('png', 75),"BD".$uniq.".png","admins/".$uniq.$data['fname']);
        $admin->fname=$data['fname'];
        $admin->lname=$data['lname'];
        $admin->username=$data['username'];
        $admin->password=password_hash($data['password'], PASSWORD_DEFAULT);
        $admin->role=$data['role'];
        $admin->phone=$data['phone'];
        $admin->email=$data['email'];
        $admin->dob=$data['dob'];
        $admin->state=$data['state'];
        $admin->city=$data['city'];
        $admin->pincode=$data['pincode'];
        $admin->date_of_joining=$data['joinig_date'];
        $admin->meta=$meta;
        $admin_result=$admin->save();

        if($data['role'] == AdminEnums::$ROLES['admin']){
            foreach(Zone::pluck('id') as $zone){
                $zones = new AdminZone;
                $zones->admin_id =$admin->id;
                $zones->zone_id = $zone;
                $zones->save();
            }
            } elseif($data['role'] == AdminEnums::$ROLES['zone_admin']){
            if(count($data['zone'])> 0) {
                foreach ($data['zone'] as $zone) {
                    $zones = new AdminZone;
                    $zones->admin_id = $admin->id;
                    $zones->zone_id = $zone;
                    $zones->save();
                }
            }
        }

        if(!$admin_result)
            return Helper::response(false,"Couldn't save data");

        return Helper::response(true,"save data successfully", ["admin"=>Admin::with('zones')->findOrFail($admin->id)]);
    }

   public static function update($data){

       $exist= Admin::findOrFail($data['id']);
       if(!$exist){
           return Helper::response(false,"User is not Exist");
       }

       $image_man = new ImageManager(array('driver' => 'gd'));
       $uniq = uniqid();

       $meta =json_encode(["manager_name" => $data['meta']['manager_name'], "alt_phone" => $data['meta']['alt_phone'], "gender"=>$data['meta']['gender'], "pan_no"=>$data['meta']['pan_no'], "aadha_no"=>$data['meta']['adhar_no'], "address_line1"=>$data['meta']['address_line1'], "address_line2"=>$data['meta']['address_line2']]);

       $update_data =[
            "fname"=>$data['fname'],
           "lname"=>$data['lname'],
           "username"=>$data['username'],
           "role"=>$data['role'],
           "phone"=>$data['phone'],
           "email"=>$data['email'],
           "dob"=>$data['dob'],
           "state"=>$data['state'],
           "city"=>$data['city'],
           "pincode"=>$data['pincode'],
           "date_of_joining"=>$data['joinig_date'],
           "meta"=>$meta
       ];

       if(filter_var($data['image'], FILTER_VALIDATE_URL) === FALSE)
           $update_data["image"]=Helper::saveFile($image_man->make($data['image'])->resize(100,100)->encode('png', 75),"BD".$uniq.".png","admins/".$uniq.$data['fname']);

        $update = Admin::where("id", $data['id'])->update($update_data);

        AdminZone::where('admin_id',$data['id'])->delete();

       if($data['role'] == AdminEnums::$ROLES['admin']){
           foreach(Zone::pluck('id') as $zone){
               $zones = new AdminZone;
               $zones->admin_id =$data['id'];
               $zones->zone_id = $zone;
               $zones->save();
           }
       } elseif($data['role'] == AdminEnums::$ROLES['zone_admin']){
           if(count($data['zone'] > 0)) {
               foreach ($data['zone'] as $zone) {
                   $zones = new AdminZone;
                   $zones->admin_id = $data['id'];
                   $zones->zone_id = $zone;
                   $zones->save();
               }
           }
       }

       if(!$update)
           return Helper::response(false,"Could not update user.");
       else
           return Helper::response(true,"Data updated successfully", ["admin"=>Admin::with("zones")->findOrFail($data['id'])]);
   }

   public static function addBank($data)
   {
       $exist= Admin::findOrFail($data['id']);
       if(!$exist){
           return Helper::response(false,"User is not Exist");
       }

       $image_man = new ImageManager(array('driver' => 'gd'));
       $uniq = uniqid();

       if(filter_var($data['aadhar_image'], FILTER_VALIDATE_URL) === FALSE)
           $update_data["aadhar_img"]=Helper::saveFile($image_man->make($data['aadhar_image'])->resize(100,100)->encode('png', 75),"BD".$uniq.".png","admins/".$uniq.$exist['fname']);

       if(filter_var($data['pan_image'], FILTER_VALIDATE_URL) === FALSE)
           $update_data["pan_img"]=Helper::saveFile($image_man->make($data['pan_image'])->resize(100,100)->encode('png', 75),"BD".$uniq.".png","admins/".$uniq.$exist['fname']);

       $update_data["bank_meta"] =json_encode(["acc_no" => $data['acc_no'], "bank_name" => $data['bank_name'], "holder_name"=>$data['holder_name'], "ifsc"=>$data['ifsc'], "branch_name"=>$data['branch_name']]);

       $update = Admin::where("id",$data['id'])->update($update_data);

       if(!$update)
           return Helper::response(false,"Could not update user.");
       else
           return Helper::response(true,"Data updated successfully", ["admin"=>Admin::with("zones")->findOrFail($data['id'])]);
   }

    public static function delete($id)
    {
        $exist= Admin::findOrFail($id);
        if(!$exist){
            return Helper::response(false,"User is not Exist");
        }

        $update = Admin::where("id",$id)->update([
            "deleted"=>CommonEnums::$YES
        ]);

        if(!$update)
            return Helper::response(false,"Could not Delete user.");

        return Helper::response(true,"Data Deleted successfully");
    }

    public static function statusUpdate($id)
    {
        $admin = Admin::find($id);

        switch($admin->status){
            case CommonEnums::$YES:
                $status = CommonEnums::$NO;
                break;

            case CommonEnums::$NO:
                $status = CommonEnums::$YES;
                break;

            default:
                return Helper::response([false, "This user is supended. Please use the vendor panel to enable."]);
                break;
        }

        $update_status = Admin::where('id',$id)->update(["status"=>$status]);
        if(!$update_status)
            return Helper::response(false, "failed to updated status");

        return Helper::response(true, "status updated successfully");
    }

    public static function search(Request $request)
    {
//        return $request;
//        $query = $request->all()['query'];
        $query = $request->q;

        if (empty($query))
            return Helper::response(true, "Data fetched successfully", ["users" => []]);
//        return $query;
        $users = Admin::where("fname", "LIKE", $query . '%')->paginate(5);
        return Helper::response(true, "Data fetched successfully", ["users" => $users->items()]);
    }
}
