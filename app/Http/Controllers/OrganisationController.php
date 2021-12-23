<?php

namespace App\Http\Controllers;

use App\Enums\CommonEnums;
use App\Enums\OrganizationEnums;
use App\Enums\VendorEnums;
use App\Helper;
use App\Models\Org_kyc;
use App\Models\Organization;
use App\Models\OrganizationService;
use App\Models\SubservicePrice;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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

        $org_email=Organization::where('email', $data['email'])->first();
        $vendor_email=Vendor::where('email', $admin['email'])->first();
        if($org_email || $vendor_email)
            return Helper::response(false,"Email id is already exist in system");

        $org_phone=Organization::where('phone', $data['phone']['primary'])->first();
        $vendor_phone=Vendor::where('phone',$admin['phone'])->first();
        if($org_phone || $vendor_phone)
            return Helper::response(false,"Phone no is already exist in system");


        $organizations=new Organization;
        $image = $data['image'];
        $uniq = uniqid();
        $organizations->image=Helper::saveFile($imageman->make($image)->encode('png', 75),"BD".$uniq.".png","vendors/".$uniq.$data['organization']['org_name']);
        $organizations->email=$data['email'];
        $organizations->phone=$data['phone']['primary'];
        $organizations->org_name=$data['organization']['org_name'];
        $organizations->org_type=$data['organization']['org_type'];
       /* $organizations->lat =$data['address']['lat'];
        $organizations->lng =$data['address']['lng'];*/
        $organizations->lat =0;
        $organizations->lng =0;
        $organizations->zone_id =$data['zone'];
        $organizations->pincode =$data['address']['pincode'];
        $organizations->city =$data['address']['city'];
        $organizations->state =$data['address']['state'];
        $organizations->service_type =$data['service_type'];
        $organizations->meta =json_encode($meta);
        $organizations->commission = $data['commission'];
        $organizations->base_distance = $data['basedist'];
        $organizations->additional_distance = $data['extrabasedist'];
        $result_organization= $organizations->save();

        foreach($data['service'] as $value) {
            $service=new OrganizationService;
            $service->organization_id=$organizations->id;
            $service->service_id=$value;
            $result_service= $service->save();
        }

        $models = [];
        foreach(RoleGroupEnums::$MODUlES as $model=>$model_key){
            array_push($model_key, $models);
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
        $vendor->assign_module = $models;
        $vendor->password = password_hash($admin['fname'].Helper::generateOTP(6), PASSWORD_DEFAULT);
        $vendor_result = $vendor->save();

        if(!$vendor_result && !$result_organization)
            return Helper::response(false,"Couldn't save data");

        return Helper::response(true,"save data successfully", ["organization"=>Organization::with('vendors')->with('services')->findOrFail($organizations->id)]);
    }

    public static function addForWeb($data, $meta, $admin)
    {
        $imageman = new ImageManager(array('driver' => 'gd'));

        $org_email=Organization::where('email', $data['email'])->first();
        $vendor_email=Vendor::where('email', $admin['email'])->first();
        if($org_email || $vendor_email)
            return Helper::response(false,"Email id is already exist in system");

        $org_phone=Organization::where('phone', $data['phone']['primary'])->first();
        $vendor_phone=Vendor::where('phone',$admin['phone'])->first();
        if($org_phone || $vendor_phone)
            return Helper::response(false,"Phone no is already exist in system");


        $organizations=new Organization;
        $avatar_file_name = ucwords(strtolower($admin['fname']))."-".ucwords(strtolower($admin['lname']))."-".".png";
        $uniq = uniqid();
//        $organizations->image=Helper::saveFile(Helper::generateAvatar($data['fname']." ".$data['lname']),$avatar_file_name,"vendors/".$uniq.$data['organization']['org_name']);
        $organizations->image=null;
        $organizations->email=$data['email'];
        $organizations->phone=$data['phone']['primary'];
        $organizations->org_name=$data['organization']['org_name'];
        $organizations->org_type=$data['organization']['org_type'];
        $organizations->lat =0;
        $organizations->lng =0;
        $organizations->zone_id =null;
        $organizations->pincode =$data['address']['pincode'];
        $organizations->city =$data['address']['city'];
        $organizations->state =$data['address']['state'];
        $organizations->service_type =2;
        $organizations->meta =json_encode($meta);
        $organizations->commission = 0;
        $result_organization= $organizations->save();

        /*foreach($data['service'] as $value)
        {
            $service=new OrganizationService;
            $service->organization_id=$organizations->id;
            $service->service_id=$value;
            $result_service= $service->save();
        }*/

        $models = [];
        foreach(RoleGroupEnums::$MODUlES as $model=>$model_key){
            array_push($model_key, $models);
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
//        $vendor->image = Helper::saveFile(Helper::generateAvatar($admin['fname']." ".$admin['lname']),$avatar_file_name,"vendors/".$uniq.$admin['fname']);
        $vendor->image = null;
        $vendor->organization_id = $organizations->id;
        $vendor->meta = json_encode($admin_meta);
        $vendor->user_role = VendorEnums::$ROLES["admin"];
        $vendor->assign_module = $models;
        $vendor->password = password_hash($admin['fname'].Helper::generateOTP(6), PASSWORD_DEFAULT);
        $vendor_result = $vendor->save();

        if(!$vendor_result && !$result_organization)
            return Helper::response(false,"Couldn't save data");

        return Helper::response(true,"Generated Lead successfully", ["organization"=>Organization::with('vendors')->with('services')->findOrFail($organizations->id)]);
    }

    public static function update($data, $meta, $admin, $id, $vendor_id)
    {
//            $organization_exist = Organization::findOrFail($id);
        $vendor_exist = Vendor::where(["organization_id"=>$id, "user_role"=>VendorEnums::$ROLES["admin"]])->first();
        if(!$vendor_exist)
            return Helper::response(false,"Incorrect Vendor id.");

        $imageman = new ImageManager(array('driver' => 'gd'));

        $image = $data['image'];
        $uniq = uniqid();

        if(filter_var($image, FILTER_VALIDATE_URL) !== FALSE)
            $update_data["image"] =  Helper::saveFile($imageman->make($image)->resize(256,256)->encode('png', 100),"BD".$uniq.".png","vendors/".$uniq.$data['organization']['org_name']);


        $update_data = [

            "email"=>$data['email'],
            "phone"=>$data['phone']['primary'],
            "org_name"=>$data['organization']['org_name'],
            "org_type"=>$data['organization']['org_type'],
          /*  "lat"=>$data['address']['lat'],
            "lng"=>$data['address']['lng'],*/
            "lat"=>0,
            "lng"=>0,
            "zone_id"=>$data['zone'],
            "pincode"=>$data['address']['pincode'],
            "city"=>$data['address']['city'],
            "state"=>$data['address']['state'],
            "service_type"=>$data['service_type'],
            "meta"=>json_encode($meta),
            "commission"=>$data['commission'],
            "base_distance"=>$data['basedist'],
            "additional_distance"=>$data['extrabasedist']
        ];

        $result_organization =Organization::where(["id"=>$id])->update($update_data);

        OrganizationService::where("organization_id", $id)->delete();
        foreach($data['service'] as $value) {
            $service=new OrganizationService;
            $service->organization_id=$id;
            $service->service_id =$value;
            $result_service = $service->save();
        }

        $vendor_result =Vendor::where(["id"=>$vendor_id, "organization_id"=>$id])
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

    public static function addBranch($data, $id, $vendor=false)
    {
        $exist = Organization::findOrFail($id);
        if(!$exist)
            return Helper::response(false,"Incorrect Organization id.");

//        $meta = json_decode($exist['meta'], true);
        $meta = ["auth_fname"=>$data['fname'] ?? '',
        "auth_lname"=>$data['lname'] ?? '',
        "secondory_phone"=>$data['phone']['secondary'] ?? '',
        "gstin_no"=>json_decode($exist['meta'], true)['gstin_no'] ?? ''
        ];

        $meta['org_description']= $data['organization']['description'];
        $meta['address']= $data['address']['address'];
        $meta['landmark']= $data['address']['landmark'];

        $organizations=new Organization;
        $organizations->parent_org_id = $id;
        $organizations->image = $exist['image'];
        $organizations->email = $exist['email'];
        $organizations->org_name =$data['organization']['org_name'];
        $organizations->org_type =$data['organization']['org_type'];
        $organizations->phone =$data['phone']['primary'];
       /* $organizations->lat =$data['address']['lat'];
        $organizations->lng =$data['address']['lng']; */
        $organizations->lat =0;
        $organizations->lng =0;
        $organizations->zone_id =$data['zone'];
        $organizations->pincode =$data['address']['pincode'];
        $organizations->city =$data['address']['city'];
        $organizations->state =$data['address']['state'];
        $organizations->service_type =$data['service_type'];
        $organizations->meta =json_encode($meta);
        $organizations->commission =$exist['commission'];
        $organizations->verification_status = $exist['verification_status'];
        if($vendor) {
            $organizations->status =OrganizationEnums::$STATUS['pending_approval'];
            $organizations->ticket_status = CommonEnums::$TICKET_STATUS['open'];
        } else
            $organizations->status =$exist['status'];

        $result_organization= $organizations->save();

        foreach($data['service'] as $value) {
            $service=new OrganizationService;
            $service->organization_id=$organizations->id;
            $service->service_id=$value;
            $result_service= $service->save();
        }

        if(!$result_organization && !$result_service)
            return Helper::response(false,"Couldn't save data");

        if($vendor) {
            TicketController::createForVendor(Session::get('account')['id'], 5,  ["Branch_id"=>$organizations->id]);
        }

        return Helper::response(true,"save data successfully", ["organization"=>Organization::with('branch')->with('services')->findOrFail($id)]);
    }

    public static function getBranch($id)
    {
        $branches = Organization::where("id", $id)->orWhere("parent_org_id", $id)->get();
        if(!$branches)
            return Helper::response(false,"Invalid Branch Organization");

        return Helper::response(true, "Here are Branches", ['branches'=>$branches]);
    }

    public static function updateBranch($data, $id, $parent_org_id, $vendor=false)
    {
        $exist = Organization::where("id", $id)->orWhere("parent_org_id", $parent_org_id)->first();
        if(!$exist)
            return Helper::response(false,"Incorrect Organization id.");

        $meta = ["auth_fname"=>$data['fname'] ?? '',
            "auth_lname"=>$data['lname'] ?? '',
            "secondory_phone"=>$data['phone']['secondary'] ?? '',
            "gstin_no"=>json_decode($exist['meta'], true)['gstin_no'] ?? ''
        ];

        $meta['org_description']= $data['organization']['description'];
        $meta['address']= $data['address']['address'];
        $meta['landmark']= $data['address']['landmark'];

        $result_organization =Organization::where(["id"=>$id])
            ->update([
                "org_name"=>$data['organization']['org_name'],
                "org_type"=>$data['organization']['org_type'],
                "phone"=>$data['phone']['primary'],
                /*"lat"=>$data['address']['lat'],
                "lng"=>$data['address']['lng'],*/
                "lat"=>0,
                "lng"=>0,
                "zone_id"=>$data['zone'],
                "pincode"=>$data['address']['pincode'],
                "city"=>$data['address']['city'],
                "state"=>$data['address']['state'],
                "service_type"=>$data['service_type'],
                "meta" =>json_encode($meta)
            ]);

        if($vendor && ($exist['ticket_status'] != CommonEnums::$TICKET_STATUS['modify'])) {
            Organization::where(["id" => $id])
                ->update([
                    'ticket_status' => CommonEnums::$TICKET_STATUS['open'],
                    'status'=>OrganizationEnums::$STATUS['pending_approval']
                ]);
        }

        OrganizationService::where("organization_id", $id)->delete();
        foreach($data['service'] as $value) {
            $service=new OrganizationService;
            $service->organization_id=$id;
            $service->service_id =$value;
            $result_service = $service->save();
        }

        if(!$result_organization && !$result_service)
            return Helper::response(false,"Couldn't save data");

        if($vendor && ($exist['ticket_status'] != CommonEnums::$TICKET_STATUS['modify']))
            TicketController::createForVendor(Session::get('account')['id'], 5,  ["Branch_id"=>$id]);


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
        if(!$bank_id) {
            if(!$exist)
                return Helper::response(false,"Incorrect Organization id.");

            //   $imageman = new ImageManager(array('driver' => 'gd'));


            $meta =["account_no"=>$data['acc_no'],"bank_name"=>$data['bank_name'], "holder_name"=>$data['holder_name'], "ifcscode"=>$data['ifcscode'], "branch_name"=>$data['branch_name']];
            $bank = new Org_kyc;
            $bank->organization_id = $id;
            $bank->aadhar_card =Helper::saveFile(base64_decode($data['doc']['aadhar_card']),"BD".uniqid().explode('/', mime_content_type($data['doc']['aadhar_card']))[1],"vendors/bank/".$id.$exist['org_name']);
            $bank->pan_card =Helper::saveFile(base64_decode($data['doc']['pan_card']),"BD".uniqid().explode('/', mime_content_type($data['doc']['pan_card']))[1],"vendors/bank/".$id.$exist['org_name']);
            $bank->gst_certificate =Helper::saveFile(base64_decode($data['doc']['gst_certificate']),"BD".uniqid().explode('/', mime_content_type($data['doc']['gst_certificate']))[1],"vendors/bank/".$id.$exist['org_name']);
            $bank->company_reg_certificate =Helper::saveFile(base64_decode($data['doc']['company_registration_certificate']),"BD".uniqid().explode('/', mime_content_type($data['doc']['company_registration_certificate']))[1],"vendors/bank/".$id.$exist['org_name']);
            $bank->bidnest_agreement =Helper::saveFile(base64_decode($data['doc']['biddnest_agreement']),"BD".uniqid().explode('/', mime_content_type($data['doc']['biddnest_agreement']))[1],"vendors/bank/".$id.$exist['org_name']);
            $bank->additional_file =Helper::saveFile(base64_decode($data['doc']['additional_file']),"BD".uniqid().explode('/', mime_content_type($data['doc']['additional_file']))[1],"vendors/bank/".$id.$exist['org_name']);
            $bank->banking_details = json_encode($meta);
            $result_bank = $bank->save();

            Organization::where("id", $id)->orWhere("parent_org_id", $id)->update(["verification_status"=>CommonEnums::$YES, "status"=>OrganizationEnums::$STATUS['pending_approval']]);
            PayoutController::registerContact($id);
            PayoutController::registerFundAccount($id);

            if(!$result_bank)
                return Helper::response(false,"Couldn't save data");

            return Helper::response(true,"save data successfully", ["Orgnization"=>Organization::with('services')->with('bank')->findOrFail($id)]);
        } else {
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
            $additional_file = $data['doc']['additional_file'];

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

            if(filter_var($additional_file, FILTER_VALIDATE_URL) === FALSE)
                $update_data["additional_file"] = Helper::saveFile(base64_decode($additional_file),"BD".uniqid().explode('/', mime_content_type($additional_file))[1],"vendors/bank/".$id.$exist['org_name']);

            $result_bank= Org_kyc::where("id", $bank_id)
                ->update($update_data);

            Organization::where("id", $id)->orWhere("parent_org_id", $id)->update(["verification_status"=>CommonEnums::$YES, "status"=>OrganizationEnums::$STATUS['pending_approval']]);

            if(!$result_bank)
                return Helper::response(false,"Couldn't Update data");

            return Helper::response(true,"Update data successfully", ["Orgnization"=>Organization::with('services')->with('bank')->findOrFail($id)]);
        }
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

        $vendor_email = Vendor::where('email', $data['email'])->first();
        if($vendor_email)
            return Helper::response(false,"Email Id is already exist in system.");

        $vendor_phone = Vendor::where('phone', $data['phone'])->first();
        if($vendor_phone)
            return Helper::response(false,"Phone no is already exist in system.");

        $meta = ["branch"=>$data['branch'], "address_line1"=>$data['address1'], "address_line2"=>$data['address2'],"secondary_phone"=>$data['secondary_phone'] ?? ""];

        if(!$data['password'])
            $password=password_hash($data['fname'].Helper::generateOTP(6), PASSWORD_DEFAULT);
        else
            $password = password_hash($data['password'], PASSWORD_DEFAULT);

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
        $vendor->assign_module = $data['assign_module'];
        $vendor->password = $password;
        $vendor->dob = date("Y-m-d", strtotime($data['dob']));
        $vendor->doj = date("Y-m-d", strtotime($data['doj']));
        if($data['dor']){
            $vendor->dor = date("Y-m-d", strtotime($data['dor']));
        }
        $vendor->state = $data['state'];
        $vendor->city = $data['city'];
        $vendor->gender = $data['gender'];
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

        $meta = [
            "branch"=>$data['branch'],
            "address_line1"=>$data['address1'],
            "address_line2"=>$data['address2'],
            "secondary_phone"=>$data['secondary_phone'] ?? ""
        ];

        $image = $data['image'];
        $uniq = uniqid();

        $image_man = new ImageManager(array('driver' => 'gd'));
        $image_name = "BD".$uniq.".png";


        if(!$data['password'])
            $password=$exist['password'];
        else
            $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $update_data =[
            "fname"=>$data['fname'],
            "lname"=>$data['lname'],
            "email"=>$data['email'],
            "phone"=>$data['phone'],
            "meta"=>json_encode($meta),
            "password"=>$password,
            "user_role"=>$data['role'],
            "assign_module"=>$data['assign_module'],
            "organization_id"=>$data['branch'],
            "dob"=>date("Y-m-d", strtotime($data['dob'])),
            "doj"=>date("Y-m-d", strtotime($data['doj'])),
            "state"=>$data['state'],
            "gender"=>$data['gender'],
            "city"=>$data['city']
        ];

        if($data['dor'])
            $update_data["dor"] =date("Y-m-d", strtotime($data['dor']));

        if(filter_var($image, FILTER_VALIDATE_URL) === FALSE)
            $update_data["image"] = Helper::saveFile($image_man->make($image)->resize(256,256)->encode('png', 100),$image_name,"vendors/".$data['fname']);


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

    public static function search(Request $request)
    {
        //        return $request;
        //        $query = $request->all()['query'];
        $query = $request->q;

        if (empty($query))
            return Helper::response(true, "Data fetched successfully", ["users" => []]);
        //        return $query;
        $users = Organization::where("org_name", "LIKE", $query . '%')->paginate(5);
        return Helper::response(true, "Data fetched successfully", ["users" => $users->items()]);
    }

    public static function changeStatus($id, $status)
    {
        if($status == CommonEnums::$TICKET_STATUS['open'])
            $change_status=Organization::where(["id"=>$id])->update(["ticket_status" => $status]);
        elseif($status == CommonEnums::$TICKET_STATUS['need_modification'])
            $change_status=Organization::where(["id"=>$id])->update(["ticket_status" => $status]);
        elseif($status == CommonEnums::$TICKET_STATUS['approve']) {
            $org_status=Organization::where("id", (int)Organization::where("id", $id)->pluck('parent_org_id')[0])->pluck('status')[0];
            $change_status = Organization::where(["id" => $id])->update(["ticket_status" => $status, "status" =>$org_status]);
        }

        if(!$change_status)
            return Helper::response(false,"Couldn't Update status");

        return Helper::response(true,"Status Updated successfully");
    }

    public static function sendOtpForBid($id)
    {
        $vendor=Organization::where(["id"=>$id])->orWhere("parent_org_id", $id)->first();
        $otp = Helper::generateOTP(6);
        $newvendor =Vendor::where(['phone'=>$vendor->phone, 'organization_id'=>$id, 'user_role'=>VendorEnums::$ROLES['admin']])
            ->update([
                'verf_code'=>$otp
            ]);

        if(!$newvendor)
            return Helper::response(false,"Couldn't sent OTP");

        return Helper::response(true,"OTP sent successfully", ['OTP'=>$otp]);
    }

    public static function changeStatusVendor($id, $status){
        $vendor_exist=Organization::where("id", $id)->first();
        $vendor_kyc = Org_kyc::where("organization_id", $id)->first();

        if(!$vendor_exist){
            return Helper::response(false,"Vendor is not exist.");
        }
        if($status != OrganizationEnums::$STATUS['suspended']) {
            if (!$vendor_kyc) {
                return Helper::response(false, "Details are not updated for this vendor, Please update bank details.");
            }
        }

        if($status == OrganizationEnums::$STATUS['pending_approval']){
            $result=Organization::where("id", $id)->update(["status"=>OrganizationEnums::$STATUS['pending_approval']]);
        }

        if($status == OrganizationEnums::$STATUS['active']){
            $result=Organization::where("id", $id)->update(["status"=>OrganizationEnums::$STATUS['active']]);
        }

        if($status == OrganizationEnums::$STATUS['suspended']){
            $result=Organization::where("id", $id)->update(["status"=>OrganizationEnums::$STATUS['suspended']]);
        }

        if($result)
            return Helper::response(true,"Updated status successfully.");
        else
            return Helper::response(false,"Updated status fail.");
    }

    public static function addPrices($data, $id){
        $exist = Organization::findOrFail($id);

        if(!$exist)
            return Helper::response(false,"Incorrect Organization id.");


            $pricing = new SubservicePrice();

            if($data['subservice']['market']['price']['economy'] == 0 && $data['subservice']['market']['price']['premium']== 0)
            {
                $economic_margin_percentage = 0;
                $premium_margin_percentag = 0;
            }else{
                $economic_margin_percentage = (($data['subservice']['market']['price']['economy'] - $data['subservice']['bidnest']['price']['economy'])/$data['subservice']['market']['price']['economy'])*100;
                $premium_margin_percentag = (($data['subservice']['market']['price']['premium'] - $data['subservice']['bidnest']['price']['premium'])/$data['subservice']['market']['price']['premium'])*100;
            }
            $pricing->organization_id = $id;
            $pricing->subservice_id = $data['subservice']['id'];
            $pricing->bp_economic = round($data['subservice']['bidnest']['price']['economy'],2);
            $pricing->bp_premium = round($data['subservice']['bidnest']['price']['premium'],2);
            $pricing->mp_economic = round($data['subservice']['market']['price']['economy'],2);
            $pricing->mp_premium = round($data['subservice']['market']['price']['premium'],2);
            $pricing->economic_margin_percentage = round($economic_margin_percentage,2);
            $pricing->premium_margin_percentage = round($premium_margin_percentag,2);
            $pricing->mp_additional_distance_economic_price = round($data['subservice']['mp_additional']['price']['economy'],2);
            $pricing->mp_additional_distance_premium_price = round($data['subservice']['mp_additional']['price']['premium'],2);
            $pricing->bp_additional_distance_economic_price = round($data['subservice']['bp_additional']['price']['economy'],2);
            $pricing->bp_additional_distance_premium_price = round($data['subservice']['bp_additional']['price']['premium'],2);
            $result_pricing = $pricing->save();


        if(!$result_pricing)
            return Helper::response(false,"Couldn't save data");

        return Helper::response(true,"save data successfully", ["Orgnization"=>Organization::with('subservicePrice')->findOrFail($id)]);

    }

    public static function updatePrices($data, $id){
        $exist = Organization::findOrFail($id);

        $pricing = SubservicePrice::where(["organization_id"=>$id, "id"=>$data['subservice']['id']])->first();
        if(!$pricing)
            return Helper::response(false,"Subservice prices dosen't exist.");

        if(!$exist)
            return Helper::response(false,"Incorrect Organization id.");



            if($data['subservice']['market']['price']['economy'] == 0 && $data['subservice']['market']['price']['premium']== 0)
            {
                $economic_margin_percentage = 0;
                $premium_margin_percentag = 0;
            }else{
                $economic_margin_percentage = (($data['subservice']['market']['price']['economy'] - $data['subservice']['bidnest']['price']['economy'])/$data['subservice']['market']['price']['economy'])*100;
                $premium_margin_percentag = (($data['subservice']['market']['price']['premium'] - $data['subservice']['bidnest']['price']['premium'])/$data['subservice']['market']['price']['premium'])*100;
            }

            $pricing_update = SubservicePrice::where(["organization_id"=>$id, "id"=>$data['subservice']['id']])
                ->update([
                    "bp_economic"=>round($data['subservice']['bidnest']['price']['economy'],2),
                    "bp_premium"=>round($data['subservice']['bidnest']['price']['premium'],2),
                    "mp_economic"=> round($data['subservice']['market']['price']['economy'],2),
                    "mp_premium"=>round($data['subservice']['market']['price']['premium'],2),
                    "economic_margin_percentage"=>round($economic_margin_percentage,2),
                    "premium_margin_percentage"=>round($premium_margin_percentag,2),
                    "mp_additional_distance_economic_price"=>round($data['subservice']['mp_additional']['price']['economy'],2),
                    "mp_additional_distance_premium_price"=>round($data['subservice']['mp_additional']['price']['premium'],2),
                    "bp_additional_distance_economic_price"=>round($data['subservice']['bp_additional']['price']['economy'],2),
                    "bp_additional_distance_premium_price"=>round($data['subservice']['bp_additional']['price']['premium'],2)
                ]);


        if(!$pricing_update)
            return Helper::response(false,"Couldn't update data");

        return Helper::response(true,"update data successfully", ["Orgnization"=>Organization::with('subservicePrice')->findOrFail($id)]);

    }

}
