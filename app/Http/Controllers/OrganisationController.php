<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Organization;
use App\Models\Vendor;
use App\Models\OrganizationService;
use App\Models\Org_kyc;
use App\Enums\VendorEnums;
use App\Enums\CommonEnums;
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
        $vendor_result = $vendor->save();

        if(!$vendor_result && !$result_organization)
            return Helper::response(false,"Couldn't save data");
        
        return Helper::response(true,"save data successfully", ["Orgnization"=>Organization::with('vendors')->with('services')->findOrFail($organizations->id)]);
    }


    public static function addBranch($data, $id)
    {
        $exist = Organization::findOrFail($id);
        if(!$exist)
            return Helper::response(false,"Incorrect Organization id.");
        
        $meta = json_decode($exist['meta'], true);
        $meta['org_description']= $data['organization']['org_type'];
        $meta['address']= $data['address']['address'];
        $meta['landmark']= $data['address']['landmark'];

        $organizations=new Organization;
        $organizations->parent_org_id = $id;
        $organizations->image = $exist['image'];
        $organizations->email = $exist['email'];
        $organizations->org_name =$data['organization']['org_name'];
        $organizations->org_type =$data['organization']['org_type'];
        $organizations->phone =$data['phone']['primary'];
        $organizations->lat =$data['address']['lat'];
        $organizations->lng =$data['address']['lng'];
        $organizations->zone_id =$data['zone'];
        $organizations->pincode =$data['address']['pincode'];
        $organizations->city =$data['address']['city'];
        $organizations->state =$data['address']['state'];
        $organizations->service_type =$data['service_type'];
        $organizations->meta =json_encode($meta);
        $organizations->commission =$exist['commission'];
        $result_organization= $organizations->save();
        
        foreach($data['service'] as $value)
        {
           $service=new OrganizationService;
           $service->organization_id=$organizations->id;
           $service->service_id=$value;
           $result_service= $service->save();
        }

        if(!$result_organization && !$result_service)
            return Helper::response(false,"Couldn't save data");
            
        return Helper::response(true,"save data successfully", ["organization"=>Organization::with('branch')->with('services')->findOrFail($id)]);
        
    }


    public static function deleteBranch($id)
    {
        $delete_branch=Organization::where("id",$id)->update(["deleted" => CommonEnums::$YES]);

        // $delete_service=Organization::where("organization_id",$id)->update(["deleted" => 1]);

        if(!$delete_branch)
            return Helper::response(false,"Couldn't Delete branch");
       
        return Helper::response(true,"Branch Deleted successfully");
    }

    public static function addBank($data, $id)
    {
        $exist = Organization::findOrFail($id);
        if(!$exist)
            return Helper::response(false,"Incorrect Organization id.");

        $imageman = new ImageManager(array('driver' => 'gd'));
        $meta =["account_no"=>$data['acc_no'],"banck_name"=>$data['banck_name'], "holder_name"=>$data['holder_name'], "ifcscode"=>$data['ifcscode'], "branch_name"=>$data['branch_name']];
        $bank = new Org_kyc;
        $bank->organization_id = $id;
        $bank->aadhar_card =Helper::saveFile($imageman->make($data['doc']['aadhar_card'])->encode('png', 75),"BD".uniqid(),"vendors/bank/".$id.$exist['org_name']);
        $bank->pan_card =Helper::saveFile($imageman->make($data['doc']['pan_card'])->encode('png', 75),"BD".uniqid(),"vendors/bank/".$id.$exist['org_name']);
        $bank->gst_certificate =Helper::saveFile($imageman->make($data['doc']['gst_certificate'])->encode('png', 75),"BD".uniqid(),"vendors/bank/".$id.$exist['org_name']);
        $bank->company_reg_certificate =Helper::saveFile($imageman->make($data['doc']['company_registration_certificate'])->encode('png', 75),"BD".uniqid(),"vendors/bank/".$id.$exist['org_name']);
        $bank->bidnest_agreement =Helper::saveFile($imageman->make($data['doc']['biddnest_agreement'])->encode('png', 75),"BD".uniqid(),"vendors/bank/".$id.$exist['org_name']);
        $bank->banking_details = json_encode($meta);
        $result_bank = $bank->save();

        if(!$result_bank)
            return Helper::response(false,"Couldn't save data");
        
        return Helper::response(true,"save data successfully", ["Orgnization"=>Organization::with('services')->with('bank')->findOrFail($id)]);
    }

    public static function addNewRole($data, $id)
    {
        $organization_exist = Organization::findOrFail($id);
        $vendor_exist = Vendor::where("organization_id", $id)->first();
        if(!$organization_exist && !$vendor_exist)
            return Helper::response(false,"Incorrect Organization id.");

       
        $meta = array("vendor_id"=>$vendor_exist->id, "branch"=>$data['branch'], "assigned_module"=>json_encode($data['assigned_module']));

        $vendor = new Vendor;
        $vendor->fname = $data['fname'];
        $vendor->lname = $data['lname'];
        $vendor->email = $data['email'];
        $vendor->phone = $data['phone'];
        $vendor->pin = null;
        $vendor->organization_id = $id;
        $vendor->meta = json_encode($meta);
        $vendor->user_role = VendorEnums::$ROLES["manager"];
        $vendor->password = password_hash($data['fname'].Helper::generateOTP(6), PASSWORD_DEFAULT);
        $vendor_result = $vendor->save();

        if(!$vendor_result)
            return Helper::response(false,"Couldn't save data");
        
        return Helper::response(true,"save data successfully", ["Orgnization"=>Organization::with('vendors')->with('services')->findOrFail($id)]);
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

}
