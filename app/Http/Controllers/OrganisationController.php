<?php

namespace App\Http\Controllers;

use App\Enums\OrganizationEnums;
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
            $image_man = new ImageManager(array('driver' => 'gd'));
            $avatar_file_name = ucwords(strtolower($admin['fname']))."-".ucwords(strtolower($admin['lname']))."-".".png";
            $vendor->image = Helper::saveFile($image_man->make($image)->resize(100,100)->encode('png', 75),$avatar_file_name,"avatars");
            $vendor->organization_id = $organizations->id;
            $vendor->meta = json_encode($admin_meta);
            $vendor->user_role = VendorEnums::$ROLES["admin"];
            $vendor->password = password_hash($admin['fname'].Helper::generateOTP(6), PASSWORD_DEFAULT);
            $vendor_result = $vendor->save();

        if(!$vendor_result && !$result_organization)
            return Helper::response(false,"Couldn't save data");

        return Helper::response(true,"save data successfully", ["organization"=>Organization::with('vendors')->with('services')->findOrFail($organizations->id)]);
    }

    public static function update($data, $meta, $admin, $id)
    {
//            $organization_exist = Organization::findOrFail($id);
            $vendor_exist = Vendor::where(["organization_id"=>$id, "user_role"=>VendorEnums::$ROLES["admin"]])->first();
            if(!$vendor_exist)
                return Helper::response(false,"Incorrect Vendor id.");

            $imageman = new ImageManager(array('driver' => 'gd'));

            $image = $data['image'];
            $uniq = uniqid();

            $update_data = [

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
            ];

        if(filter_var($image, FILTER_VALIDATE_URL) === FALSE)
            $update_data["image"] = Helper::saveFile($imageman->make($image)->encode('png', 75),"BD".$uniq."png","vendors/".$uniq.$data['organization']['org_name']);

            $result_organization =Organization::where(["id"=>$id])
            ->update($update_data);

            OrganizationService::where("organization_id", $id)->delete();
            foreach($data['service'] as $value)
            {
                $service=new OrganizationService;
                $service->organization_id=$id;
                $service->service_id =$value;
                $result_service = $service->save();
            }

            $vendor_result =Vendor::where(["id"=>$vendor_exist->id, "organization_id"=>$id])
            ->update([
                "fname"=>$admin['fname'],
                "lname"=>$admin['lname'],
                "email"=>$admin['email'],
                "phone"=>$admin['phone'],
                "meta"=>$vendor_exist->meta,
            ]);

        if(!$vendor_result || !$result_organization)
            return Helper::response(false,"Couldn't update data");

        return Helper::response(true,"update data successfully", ["organization"=>Organization::with('vendors')->with('services')->findOrFail($id)]);
    }

    public static function delete($id)
    {
        $delete_vendor=Organization::where(["id"=>$id])->orWhere("parent_org_id", $id)->update(["deleted" => CommonEnums::$YES, "status"=>OrganizationEnums::$STATUS['suspended']]);

        if(!$delete_vendor)
            return Helper::response(false,"Couldn't Delete Organization");

        return Helper::response(true,"Organization Deleted successfully");
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
        $organizations->verification_status = $exist['verification_status'];
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
        $branches = Organization::where("id", $id)->orWhere("parent_org_id", $id)->get();
        if(!$branches)
            return Helper::response(false,"Invalid Branch Organization");

        return Helper::response(true, "Here are Branches", ['branches'=>$branches]);
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

        OrganizationService::where("organization_id", $id)->delete();
        foreach($data['service'] as $value)
        {
            $service=new OrganizationService;
            $service->organization_id=$id;
            $service->service_id =$value;
           $result_service = $service->save();
        }

        if(!$result_organization && !$result_service)
            return Helper::response(false,"Couldn't save data");

        return Helper::response(true,"Update data successfully", ["organization"=>Organization::with('branch')->with('services')->findOrFail($id)]);
    }

    public static function deleteBranch($organization_id, $parent_id)
    {
        $delete_branch=Organization::where(["id"=>$organization_id, "parent_org_id"=>$parent_id])->update(["deleted" => CommonEnums::$YES]);

        if(!$delete_branch)
            return Helper::response(false,"Couldn't Delete branch");

        return Helper::response(true,"Branch Deleted successfully");
    }

    public static function addBank($data, $id, $bank_id)
    {
        $exist = Organization::findOrFail($id);
        if(!$bank_id)
        {
            if(!$exist)
                return Helper::response(false,"Incorrect Organization id.");

//            $imageman = new ImageManager(array('driver' => 'gd'));


            $meta =["account_no"=>$data['acc_no'],"bank_name"=>$data['bank_name'], "holder_name"=>$data['holder_name'], "ifcscode"=>$data['ifcscode'], "branch_name"=>$data['branch_name']];
            $bank = new Org_kyc;
            $bank->organization_id = $id;
            $bank->aadhar_card =Helper::saveFile(base64_decode($data['doc']['aadhar_card']),"BD".uniqid().explode('/', mime_content_type($data['doc']['aadhar_card']))[1],"vendors/bank/".$id.$exist['org_name']);
            $bank->pan_card =Helper::saveFile(base64_decode($data['doc']['pan_card']),"BD".uniqid().explode('/', mime_content_type($data['doc']['pan_card']))[1],"vendors/bank/".$id.$exist['org_name']);
            $bank->gst_certificate =Helper::saveFile(base64_decode($data['doc']['gst_certificate']),"BD".uniqid().explode('/', mime_content_type($data['doc']['gst_certificate']))[1],"vendors/bank/".$id.$exist['org_name']);
            $bank->company_reg_certificate =Helper::saveFile(base64_decode($data['doc']['company_registration_certificate']),"BD".uniqid().explode('/', mime_content_type($data['doc']['company_registration_certificate']))[1],"vendors/bank/".$id.$exist['org_name']);
            $bank->bidnest_agreement =Helper::saveFile(base64_decode($data['doc']['biddnest_agreement']),"BD".uniqid().explode('/', mime_content_type($data['doc']['biddnest_agreement']))[1],"vendors/bank/".$id.$exist['org_name']);
            $bank->banking_details = json_encode($meta);
            $result_bank = $bank->save();

            Organization::where("id", $id)->orWhere("parent_org_id", $id)->update(["verification_status"=>CommonEnums::$YES]);
        }
        else
        {
            $exist = Org_kyc::where(["id"=>$bank_id, "organization_id"=>$id])->first();
            if(!$exist)
                return Helper::response(false,"Invalide or incorrect Organization id or Bank id ");

            $meta =["account_no"=>$data['acc_no'],"bank_name"=>$data['bank_name'], "holder_name"=>$data['holder_name'], "ifcscode"=>$data['ifcscode'], "branch_name"=>$data['branch_name']];

            $update_data = ["banking_details"=>$meta];

            $aadhar_card = $data['doc']['aadhar_card'];
            $pan_card = $data['doc']['pan_card'];
            $gst_certificate = $data['doc']['pan_card'];
            $company_reg_certificate = $data['doc']['gst_certificate'];
            $bidnest_agreement = $data['doc']['biddnest_agreement'];

            if(filter_var($aadhar_card, FILTER_VALIDATE_URL) === FALSE)
                $update_data["aadhar_card"] = Helper::saveFile(base64_decode($aadhar_card),"BD".uniqid().explode('/', mime_content_type($aadhar_card))[1],"vendors/bank/".$id.$exist['org_name']);

            if(filter_var($pan_card, FILTER_VALIDATE_URL) === FALSE)
                $update_data["pan_card"] = Helper::saveFile(base64_decode($pan_card),"BD".uniqid().explode('/', mime_content_type($pan_card))[1],"vendors/bank/".$id.$exist['org_name']);

            if(filter_var($gst_certificate, FILTER_VALIDATE_URL) === FALSE)
                $update_data["gst_certificate"] = Helper::saveFile(base64_decode($gst_certificate),"BD".uniqid().explode('/', mime_content_type($gst_certificate))[1],"vendors/bank/".$id.$exist['org_name']);

            if(filter_var($company_reg_certificate, FILTER_VALIDATE_URL) === FALSE)
                $update_data["company_reg_certificate"] = Helper::saveFile(base64_decode($company_reg_certificate),"BD".uniqid().explode('/', mime_content_type($company_reg_certificate))[1],"vendors/bank/".$id.$exist['org_name']);

            if(filter_var($bidnest_agreement, FILTER_VALIDATE_URL) === FALSE)
                $update_data["bidnest_agreement"] = Helper::saveFile(base64_decode($bidnest_agreement),"BD".uniqid().explode('/', mime_content_type($bidnest_agreement))[1],"vendors/bank/".$id.$exist['org_name']);

            $result_bank= Org_kyc::where("id", $bank_id)
                ->update($update_data);

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
        $imageman = new ImageManager(array('driver' => 'gd'));
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
        $image =$data['image'];
        $uniq = uniqid();
        $vendor->image =Helper::saveFile($imageman->make($image)->resize(100,100)->encode('png', 75),"BD".$uniq.".png","vendors/".$uniq.$data['fname']);
        $vendor->fname = $data['fname'];
        $vendor->lname = $data['lname'];
        $vendor->email = $data['email'];
        $vendor->phone = $data['phone'];
        $vendor->pin = null;
        $vendor->organization_id = $data['branch'];
        $vendor->meta = json_encode($meta);
        $vendor->user_role = $data['role'];
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
        $exist =Vendor::where(["id"=>$role_id])->first();
        if(!$exist)
            return Helper::response(false,"Incorrect Role or Organization id");

        $meta = array(["branch"=>$data['branch']]);
        $imageman = new ImageManager(array('driver' => 'gd'));

        $image = $data['image'];
        $uniq = uniqid();

        if(!$data['password'])
            $password=$exist['password'];
        else
            $password = $data['password'];

        $update_data =[
            "fname"=>$data['fname'],
            "lname"=>$data['lname'],
            "email"=>$data['email'],
            "phone"=>$data['phone'],
            "meta"=>$meta,
            "password"=>$password,
            "user_role"=>$data['role'],
            "organization_id"=>$data['branch']
        ];

        if(filter_var($image, FILTER_VALIDATE_URL) === FALSE)
            $update_data["image"] = Helper::saveFile($imageman->make($image)->resize(100,100)->encode('png', 75),"BD".$uniq."png","vendors/".$uniq.$data['fname']);

        $vendor_result = Vendor::where(["id"=>$role_id])
        ->update($update_data);

        if(!$vendor_result)
            return Helper::response(false,"Couldn't Update data");

        return Helper::response(true,"Update data successfully", ["Orgnization"=>Organization::with('vendors')->with('services')->findOrFail($id)]);
    }

    public static function deleteRole($vendor_id, $organization_id)
    {
        $delete_role=Vendor::where(["id"=>$vendor_id, "organization_id"=>$organization_id])->update(["deleted" => CommonEnums::$YES]);

        if(!$delete_role)
            return Helper::response(false,"Couldn't Delete branch");

        return Helper::response(true,"Role Deleted successfully");
    }

    public static function getBranches($id){
        $branches = Organization::where("parent_org_id",$id)->orWhere("id",$id)->get();
        return Helper::response(true,"Here are the branches",["branches"=>$branches]);
    }

}
