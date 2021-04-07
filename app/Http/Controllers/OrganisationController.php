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
            $imageman = new ImageManager(array('driver' => 'gd'));

            $organizations=new Organization;
            $image = $data['image'];
            $uniq = uniqid();
            $organizations->image=Helper::saveFile($imageman->make($image)->encode('png', 75),"BD".$uniq.".png","vendors/".$uniq.$data['organization']['org_name']);
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
            $organizations->meta =json_encode($meta);
            $organizations->commission = $data['commission'];
            $result_organization= $organizations->save();

            foreach($data['service'] as $value)
            {
            $service=new OrganizationService;
            $service->organization_id=$organizations->id;
            $service->service_id=$value;
            $result_service= $service->save();
            }

            $admin_meta=["vendor_id"=>null, "branch"=>null, "assigned_module"=>null];

            $vendor = new Vendor;
            $vendor->fname = ucwords(strtolower($admin['fname']));
            $vendor->lname = ucwords(strtolower($admin['lname']));
            $vendor->email = strtolower($admin['email']);
            $vendor->phone = $admin['phone'];
            $vendor->pin = null;
            $avatar_file_name = $admin['fname']."-".$admin['lname']."-".uniqid().".png";
            $vendor->image = Helper::saveFile(Helper::generateAvatar(strtoupper($admin['fname'])." ".strtoupper($admin['lname'])),$avatar_file_name,"avatars");
            $vendor->organization_id = $organizations->id;
            $vendor->meta = json_encode($admin_meta);
            $vendor->user_role = VendorEnums::$ROLES["admin"];
            $vendor->password = password_hash($admin['fname'].Helper::generateOTP(6), PASSWORD_DEFAULT);
            $vendor_result = $vendor->save();

        if(!$vendor_result && !$result_organization)
            return Helper::response(false,"Couldn't save data");

        return Helper::response(true,"save data successfully", ["organization"=>Organization::with('vendors')->with('services')->findOrFail($id)]);
    }

    public static function update($data, $meta, $admin, $id)
    {
            $organization_exist = Organization::findOrFail($id);
            $vendor_exist = Vendor::where(["organization_id"=>$id, "user_role"=>VendorEnums::$ROLES["admin"]])->first();
            if(!$organization_exist && !$vendor_exist)
                return Helper::response(false,"Incorrect Organization id.");

            $imageman = new ImageManager(array('driver' => 'gd'));

            $image = $data['image'];
            $uniq = uniqid();
            $result_organization =Organization::where(["id"=>$id])
            ->update([
                "image"=>Helper::saveFile($imageman->make($image)->encode('png', 75),"BD".$uniq."png","vendors/".$uniq.$data['organization']['org_name']),
                "email"=>$data['email'],
                "phone"=>$data['phone']['primary'],
                "org_name"=>$data['organization']['org_name'],
                "org_type"=>$data['organization']['org_type'],
                "lat"=>$data['address']['lat'],
                "lng"=>$data['address']['lng'],
                "zone_id"=>$data['zone'],
                "pincode"=>$data['address']['pincode'],
                "city"=>$data['address']['city'],
                "state"=>$data['address']['state'],
                "service_type"=>$data['service_type'],
                "meta"=>json_encode($meta),
                "commission"=>$data['commission']
            ]);

            foreach($data['service'] as $value)
            {
                $service=OrganizationService::where("organization_id", $id)
                ->update(["service_id"=>$value]);
            }

            $vendor_result =Vendor::where("id", $vendor_exist->id)
            ->update([
                "fname"=>$admin['fname'],
                "lname"=>$admin['lname'],
                "email"=>$admin['email'],
                "phone"=>$admin['phone'],
                "meta"=>$vendor_exist->meta,
            ]);

        if(!$vendor_result && !$result_organization)
            return Helper::response(false,"Couldn't save data");

        return Helper::response(true,"save data successfully", ["organization"=>Organization::with('vendors')->with('services')->findOrFail($id)]);
    }

    public static function getOne($id)
    {
        $get_vendor=Organization::where(["id"=>$id, "deleted"=>CommonEnums::$NO])->first();

        if(!$get_vendor)
            return Helper::response(false,"Couldn't Delete branch");

        return Helper::response(true,"save data successfully", ["organization"=>Organization::with('vendors')->with('services')->findOrFail($id)]);
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

    public static function getBranch($id)
    {
        $branches = Organization::where("id", $id)->orWhere("parent_org_id", $id)->first();
        if(!$branches)
            return Helper::response(false,"Invilid Branch Organization");

        return Helper::response(true, "Here are the available coupons", ['branches'=>$branches]);
    }

    public static function updateBranch($data, $id, $parent_org_id)
    {
        $exist = Organization::where(["id"=>$id, "parent_org_id"=>$parent_org_id])->first();
        if(!$exist)
            return Helper::response(false,"Incorrect Organization id.");

        $meta = json_decode($exist['meta'], true);
        $meta['org_description']= $data['organization']['org_type'];
        $meta['address']= $data['address']['address'];
        $meta['landmark']= $data['address']['landmark'];

        $result_organization =Organization::where(["id"=>$id])
        ->update([
            "org_name"=>$data['organization']['org_name'],
            "org_type"=>$data['organization']['org_type'],
            "phone"=>$data['phone']['primary'],
            "lat"=>$data['address']['lat'],
            "lng"=>$data['address']['lng'],
            "zone_id"=>$data['zone'],
            "pincode"=>$data['address']['pincode'],
            "city"=>$data['address']['city'],
            "state"=>$data['address']['state'],
            "service_type"=>$data['service_type'],
            "meta" =>json_encode($meta)
        ]);

        foreach($data['service'] as $value)
        {
            $result_service=OrganizationService::where("organization_id", $id)
            ->update(["service_id"=>$value]);
        }

        if(!$result_organization && !$result_service)
            return Helper::response(false,"Couldn't save data");

        return Helper::response(true,"save data successfully", ["organization"=>Organization::with('branch')->with('services')->findOrFail($id)]);
    }

    public static function deleteBranch($id, $parent_org_id)
    {
        $delete_branch=Organization::where(["id"=>$id, "parent_org_id"=>$parent_org_id])->update(["deleted" => CommonEnums::$YES]);

        // $delete_service=Organization::where("organization_id",$id)->update(["deleted" => 1]);

        if(!$delete_branch)
            return Helper::response(false,"Couldn't Delete branch");

        return Helper::response(true,"Branch Deleted successfully");
    }

    public static function addBank($data, $id, $bank_id)
    {
        if(!$bank_id)
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
        }
        else
        {
            $exist = Org_kyc::where(["id"=>$bank_id, "organization_id"=>$id])->first();
            if(!$exist)
                return Helper::response(false,"Invalide or incorrect Organization id or Bank id ");

            $imageman = new ImageManager(array('driver' => 'gd'));
            $meta =["account_no"=>$data['acc_no'],"banck_name"=>$data['banck_name'], "holder_name"=>$data['holder_name'], "ifcscode"=>$data['ifcscode'], "branch_name"=>$data['branch_name']];

            $result_bank= Org_kyc::where("id", $bank_id)
            ->update([
                "aadhar_card"=>Helper::saveFile($imageman->make($data['doc']['aadhar_card'])->encode('png', 75),"BD".uniqid(),"vendors/bank/".$id.$exist['org_name']),
                "pan_card"=>Helper::saveFile($imageman->make($data['doc']['pan_card'])->encode('png', 75),"BD".uniqid(),"vendors/bank/".$id.$exist['org_name']),
                "gst_certificate"=>Helper::saveFile($imageman->make($data['doc']['gst_certificate'])->encode('png', 75),"BD".uniqid(),"vendors/bank/".$id.$exist['org_name']),
                "company_reg_certificate"=>Helper::saveFile($imageman->make($data['doc']['company_registration_certificate'])->encode('png', 75),"BD".uniqid(),"vendors/bank/".$id.$exist['org_name']),
                "bidnest_agreement"=>Helper::saveFile($imageman->make($data['doc']['biddnest_agreement'])->encode('png', 75),"BD".uniqid(),"vendors/bank/".$id.$exist['org_name']),
                "banking_details"=>$meta
            ]);
        }

        if(!$result_bank)
            return Helper::response(false,"Couldn't save data");

        return Helper::response(true,"save data successfully", ["Orgnization"=>Organization::with('services')->with('bank')->findOrFail($id)]);
    }

    public static function getBank($id, $organization_id)
    {
        $exist = Org_kyc::where(["id"=>$id, "organization_id"=>$organization_id])->first();
        if(!$exist)
            return Helper::response(false,"Invalide Data");

        return $getbranch = Org_kyc::findOrFail($id);

    }

    public static function addNewRole($data, $id)
    {
        $organization_exist = Organization::findOrFail($id);
        $vendor_exist = Vendor::where("organization_id", $id)->first();
        if(!$organization_exist && !$vendor_exist)
            return Helper::response(false,"Incorrect Organization id.");


        $meta = array(["branch"=>$data['branch']]);

        if(!$data['password'])
            $password=password_hash($data['fname'].Helper::generateOTP(6), PASSWORD_DEFAULT);
        else
            $password = $data['password'];

        $vendor = new Vendor;
        $vendor->fname = $data['fname'];
        $vendor->lname = $data['lname'];
        $vendor->email = $data['email'];
        $vendor->phone = $data['phone'];
        $vendor->pin = null;
        $vendor->organization_id = $id;
        $vendor->meta = json_encode($meta);
        $vendor->user_role = VendorEnums::$ROLES["manager"];
        $vendor->password = $password;
        $vendor_result = $vendor->save();

        if(!$vendor_result)
            return Helper::response(false,"Couldn't save data");

        return Helper::response(true,"save data successfully", ["Orgnization"=>Organization::with('vendors')->with('services')->findOrFail($id)]);
    }

    public static function getRole($id , $organization_id)
    {
        $exist =Vendor::where(["id"=>$id, "organization_id"=>$organization_id])->first();
        if(!$exist)
            return Helper::response(false,"Invalide Data");

        return Vendor::findOrFail($id);

    }

    public static function editNewRole($data, $id, $role_id)
    {
        $exist =Vendor::where(["id"=>$role_id, "organization_id"=>$id])->first();
        if(!$exist)
            return Helper::response(false,"Incorrect Role or Organization id");

        $meta = array(["branch"=>$data['branch']]);

        if(!$data['password'])
            $password=password_hash($data['fname'].Helper::generateOTP(6), PASSWORD_DEFAULT);
        else
            $password = $exist['password'];

        $vendor_result = Vendor::where(["id"=>$role_id, "organization_id"=>$id])
        ->update([
            "fname"=>$data['fname'],
            "lname"=>$data['lname'],
            "email"=>$data['email'],
            "phone"=>$data['phone'],
            "meta"=>$meta,
            "password"=>$password
        ]);

        if(!$vendor_result)
            return Helper::response(false,"Couldn't save data");

        return Helper::response(true,"save data successfully", ["Orgnization"=>Organization::with('vendors')->with('services')->findOrFail($id)]);
    }

    public static function deleteRole($id, $organization_id)
    {
        $delete_role=Vendor::where(["id"=>$id, "organization_id"=>$organization_id])->update(["deleted" => CommonEnums::$YES]);

        if(!$delete_role)
            return Helper::response(false,"Couldn't Delete branch");

        return Helper::response(true,"Role Deleted successfully");
    }

    public static function getBranches($id){
        $branches = Organization::where("parent_org_id",$id)->orWhere("id",$id)->get();
        return Helper::response(true,"Here are the branches",["branches"=>$branches]);
    }

}
