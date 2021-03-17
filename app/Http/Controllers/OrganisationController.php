<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Organization;
use App\Models\Vendor;
use App\Models\OrganizationService;
use App\Enums\VendorEnums;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;

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

    public static function add($data, $meta, $admin)
    {
        // return json_encode($meta);
        $imageman = new ImageManager(array('driver' => 'gd'));

        $organizations=new Organization;
        $image = $data['image'];
        $uniq = uniqid();
        $organizations->image=Helper::saveFile($imageman->make($image)->encode('png', 75),"BD".$uniq,"vendors/".$uniq.$data['organization']['org_name']);
        $organizations->email=$data['email'];
        $organizations->phone=$data['phone']['primary'];
        $organizations->org_name=$data['organization']['org_name'];
        $organizations->org_type=$data['organization']['org_type'];
        $organizations->lat =$data['address']['lat'];
        $organizations->lng =$data['address']['lng'];
        $organizations->zone_id =$data['zone'];
        $organizations->pincode =$data['address']['pincode'];
        $organizations->city =$data['address']['city'];
        $organizations->state =$data['address']['state'];
        $organizations->service_type =$data['service_type'];
        // $organizations->service =json_encode($data['service']);
        $organizations->meta =json_encode($meta);
        $organizations->commission = $data['commission'];
        $result_organization= $organizations->save();

        // return $organizations->id;
        // return json_decode($data['service'], true);
        foreach($data['service'] as $value)
        {
           $service=new OrganizationService;
           $service->organization_id=$organizations->id;
           $service->service_id=$value;
           $result_service= $service->save();
        }

        // return $result_organization;
        $vendor = new Vendor;
        $vendor->fname = $admin['fname'];
        $vendor->lname = $admin['lname'];
        $vendor->email = $admin['email'];
        $vendor->phone = $admin['phone'];
        $vendor->pin = null;
        $vendor->organization_id = $organizations->id;
        $vendor->meta = json_encode($admin['meta']);
        $vendor->user_role = VendorEnums::$ROLES["admin"];
        $vendor->password = password_hash($admin['fname'].Helper::generateOTP(6), PASSWORD_DEFAULT);
        $vendor->save();

        if(!$vendor && !$result_organization)
            return Helper::response(false,"Couldn't save data");
        
        return Helper::response(true,"save data successfully", ["Orgnization"=>Organization::with('vendors')->findOrFail($organizations->id)]);
    }


    public static function addBranch($data, $id)
    {
        $exist = Organization::findOrFail($id);
        if(!$exist)
            return Helper::response(false,"Incorrect slider id.");
        $meta = json_decode($exist['meta'], true);

        foreach($data['branch'] as $branch) {
            $organizations=new Organization;
            $organizations->parent_org_id = $id;

            $meta['org_description']= $branch['organization']['org_type'];
            $meta['address']= $branch['address']['address'];
            $meta['landmark']= $branch['address']['landmark'];
            $organizations->image = $exist['image'];
            $organizations->email = $exist['email'];
            $organizations->org_name =$branch['organization']['org_name'];
            $organizations->org_type =$branch['organization']['org_type'];
            $organizations->phone =$branch['phone']['primary'];
            $organizations->lat =$branch['address']['lat'];
            $organizations->lng =$branch['address']['lng'];
            $organizations->zone_id =$branch['zone'];
            $organizations->pincode =$branch['address']['pincode'];
            $organizations->city =$branch['address']['city'];
            $organizations->state =$branch['address']['state'];
            $organizations->service_type =$branch['service_type'];
            // $organizations->service =json_encode($branch['service']);
            $organizations->meta =json_encode($meta);
            $organizations->commission =$exist['commission'];
            $result_organization= $organizations->save();
        }

        if(!$result_organization)
            return Helper::response(false,"Couldn't save data");
            
        return Helper::response(true,"save data successfully", ["Orgnization"=>Organization::with('branch')->findOrFail($id)]);
        
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
