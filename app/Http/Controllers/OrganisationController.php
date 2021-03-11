<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Organization;
use App\VendorEnums;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganisationController extends Controller
{
    public function __construct(){

    }

    public static function get($page)
    {
        $vendors=DB::table('organizations')->select('*')->where(['status'=> 1, 'deleted'=>0])->get();
        if(!$vendors)
            return Helper::response(false,"Records not exist", $vendors);
        else
            return Helper::response(true,"Data displayed successfully", $vendors);
    }

    public static function add($filename, $email, $phone, $org_name, $lat, $lng, $zone, $pincode, $city, $state, $service_type, $meta, $admin, $org_users)
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

        $vendor = new Vendor();
        $vendor->fname = $admin['fname'];
        $vendor->lname = $admin['fname'];
        $vendor->email = $admin['fname'];
        $vendor->phone = $admin['fname'];
        $vendor->pasword = $admin['fname'];
        $vendor->pin = null;
        $vendor->org_id = $organizations->id;
        $vendor->meta = json_encode($admin['meta']);
        $vendor->role = VendorEnums::$ROLES["admin"];
        $vendor->password = password_hash($admin['fname'].Helper::generateOTP(6));
        $vendor->save();

        foreach ($org_users as $users){
            $vendor = new Vendor();
            $vendor->fname = $users['fname'];
            $vendor->lname = $users['lname'];
            $vendor->email = $users['email'];
            $vendor->phone = $users['phone'];
            $vendor->password = $users['password'];
            $vendor->pin = null;
            $vendor->org_id = $organizations->id;
            $vendor->meta = json_encode($users['meta']);
            $vendor->role = $users['user_role'] == VendorEnums::$ROLES["admin"] ? VendorEnums::$ROLES["admin"] : VendorEnums::$ROLES["manager"];
            $vendor->password = password_hash($admin['fname'].Helper::generateOTP(6));
            $vendor->save();
        }

        if(!$result)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"save data successfully");
    }

    public static function getOne($id)
    {
        $result=DB::table('organizations')->select('*')->where('id', $id)->first();

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", $result);
    }

    public static function update($id, $filename, $email, $phone, $org_name, $lat, $lng, $zone, $pincode, $city, $state, $service_type, $meta)
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

    public static function delete($id)
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

}
