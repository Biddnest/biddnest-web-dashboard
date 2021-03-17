<?php

namespace App\Http\Controllers;
use App\Models\Inventory;
use App\StringFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Helper;
use Session;
use App\Http\Middleware\VerifyJwtToken;

class Route extends Controller
{
    public function __construct(){
        //$this->middleware(VerifyJwtToken::class)->except(['login','forgot_password_send_otp','forgot_password_verify_otp']);
    }

    /*Auth*/
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email' => 'required|string',
            'password' => 'required',
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return AdminController::login($request->email, $request->password);

    }

    public function forgot_password_send_otp(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'phone' => 'required|max:12|min:10',
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return AdminController::forgotPasswordSendOtp($request->phone);
    }

    public function forgot_password_verify_otp(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'otp' => 'required'
        ]);
        if($validation->fails())
          return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
         return AdminController::verifyOtp($request->otp, $request->bearer);
    }

    public function reset_password(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'password' => 'required',
            'password_confirmation' => 'required_with:password|same:password'
        ]);
        if($validation->fails())
          return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return AdminController::resetPassword($request->password, $request->bearer);
    }


    /*Services*/
    public function service_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required|string',
            'image' => 'required|string',
            'inventory_quantity_type' =>'required|integer'
        ]);

        if($validation->fails())
          return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return ServiceController::add(ucwords($request->name), $request->image, $request->inventory_quantity_type);
    }

    public function service(Request $request)
    {
            return ServiceController::get();
    }

    // public function service_get(Request $request)
    // {
    //     $validation = Validator::make($request->all(),[
    //         'id' => 'required|integer',
    //     ]);
    //     return ServiceController::serviceGet($request->id);
    // }

    public function service_edit(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required|srting',
            'image' => 'required|srting',
            'id' => 'required|integer',
            'inventory_quantity_type' =>'required|integer'
        ]);

        if($validation->fails())
          return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return ServiceController::update($request->id, ucwords($request->name), $request->image);
    }

    public function service_delete(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => 'required|integer'
        ]);
        return AdminController::serviceDelete($request->id);
    }


    /*Subservices*/
    public function sub_service_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required',
            'image' => 'required',
            'service_id'=>'required|integer',
            'inventories'=>'required|nullable'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return SubserviceController::add($request->service_id,ucwords($request->name), $request->image, $request->inventories);
    }

    public function subservice(Request $request)
    {
        return SubserviceController::get();
    }

    public function subservice_get(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => 'required|integer',
        ]);
        return SubServiceController::getOne($request->id);
    }

    public function subservice_get_by_service(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => 'required|integer',
        ]);
        return SubserviceController::getByService($request->id);
    }

    public function subservice_edit(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required',
            'image' => 'required',
            'id' => 'required|integer',
            'service_id'=>'required|integer'

        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return ServiceController::update($request->id, $request->service_id, ucwords($request->name), $request->image);
    }

    public function subservice_delete(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => 'required|integer'
        ]);
        return AdminController::serviceDelete($request->id);
    }

    /*Inventories*/

    public function inventories()
    {
        return AdminController::inventories();
    }

    public function inventories_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
                    //  'subservice_id' => 'required',
            'name' => 'required',
            'material' => 'required',
            'size' => 'required',
            'image' => 'required|string',
            'category'=> 'required|string',
            'icon' => 'required|string'
        ]);



        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        $formatedRequest = StringFormatter::format($request->all(),[
            'name' => 'capitalizeAll',
            'material' => 'json',
            'size' => 'json'
        ]);
            return InventoryController::add($formatedRequest->name, $formatedRequest->material, $formatedRequest->size, $request->image, $request->category, $request->icon);
    }

    public function inventories_edit(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'name' => 'required',
            'material' => 'required',
            'size' => 'required',
            'image' => 'required|string',
            'category'=> 'required|string',
            'icon' => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        $formatedRequest = StringFormatter::format($request->all(),[
            'name' => 'capitalizeAll',
            'material' => 'json',
            'size' => 'json'
        ]);

        return InventoryController::update($request->id, $formatedRequest->name, $formatedRequest->material, $formatedRequest->size, $request->image, $request->category, $request->icon);
    }

    public function inventories_get($id)
    {
        return InventoryController::getOne($id);
    }

    public function inventories_delete($id)
    {
        return InventoryController::delete($id);
    }

    public function vendors()
    {
        return AdminController::vendorsList();
    }

    public function vendorAdd(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'image'=>'required|string',
            'fname' => 'required|string', 
            'lname' => 'required|string',
            'email' => 'required|string', 
            'gender'=> 'required|string',          

            'phone.primary'=>'required|min:10|max:10',
            'phone.secondory'=>'nullable|min:10|max:10',

            'organization.org_name' => 'required|string',
            'organization.org_type' => 'required|string', 
            'organization.gstin' => 'required|string|min:15|max:15',
            'organization.description' =>'required|string',

            'address.add_line1' => 'required|string', 
            'address.add_line2' => 'required|string',
            'address.lat' => 'required||numeric', 
            'address.lng' => 'required||numeric',
            'address.landmark'=> 'required|string',
            'address.state' => 'required|string',
            'address.city' => 'required|string', 
            'address.pincode' => 'required|min:6|max:6',
            'zone' => 'required|integer',
            'service_type' =>'required|string',
            'service' =>'required|integer'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        $meta = array("auth_fname"=>$request->fname, "auth_lname"=>$request->lname, "secondory_phone"=>$request->phone['secondory'], "gender"=>$request->gender, "gstin_no"=>$request->organization['gstin'], "org_description"=>$request->organization['description'], "address_line_1"=>$request->address['add_line1'],"address_line_2"=>$request->address['add_line2'], "landmark"=>$request->address['landmark']);

        $admin = array("fname"=>$request->fname, "lname"=>$request->lname, "email"=>$request->email, "phone"=>$request->phone['primary'], "meta"=>["lat"=>$request->address['lat'], "lng"=>$request->address['lng']]);        
       
        return OrganisationController::add($request->all(), $meta, $admin);

        // $request->image, $request->email, $request->phone['primary'], $request->org_name, $request->address['lat'], $request->['lng'], $request->zone, $request->address['pincode'], $request->address['city'], $request->address['state'],  $request->service_type,
    }

    public function branchAdd(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
            'branch.*.phone.primary'=>'required|min:10|max:10',

            'branch.*.organization.org_name' => 'required|string',
            'branch.*.organization.org_type' => 'required|string', 
            'branch.*.organization.description' =>'required|string',

            'branch.*.address.add_line1' => 'required|string', 
            'branch.*.address.add_line2' => 'required|string',
            'branch.*.address.lat' => 'required||numeric', 
            'branch.*.address.lng' => 'required||numeric',
            'branch.*.address.landmark'=> 'required|string',
            'branch.*.address.state' => 'required|string',
            'branch.*.address.city' => 'required|string', 
            'branch.*.address.pincode' => 'required|min:6|max:6',
            'branch.*.zone' => 'required|integer',
            'branch.*.service' =>'required|string',
            'branch.*.service_type' =>'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return OrganisationController::addBranch($request->all(), $id);

    }

    public function vendor_fetch($id)
    {
        return AdminController::vendorFetch($id);
    }

    public function vendor_edit(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
            'fname' => 'required', 'email' => 'required',
            'lname' => 'required', 'phone' => 'required',
            'org_name' => 'required', 'gstin' => 'required',
            'add_line1' => 'required', 'add_line2' => 'required',
            'lat' => 'required', 'lng' => 'required',
            'zone' => 'required', 'state' => 'required',
            'city' => 'required', 'pincode' => 'required'
        ]);

        $filename="";
        if($request->hasfile('image')){
            $file=$request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('organization',$filename);
        }

        $meta = array("auth_fname"=>$request->fname, "auth_lname"=>$request->lname, "secondory_phone"=>$request->phone2, "gender"=>$request->gender, "gstin_no"=>$request->gstin, "org_description"=>$request->description, "address_line_1"=>$request->add_line1,"address_line_2"=>$request->add_line2);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return AdminController::vendorEdit($id, $filename, $request->email, $request->phone, $request->org_name, $request->lat, $request->lng, $request->zone, $request->pincode, $request->city, $request->state, $request->service_type, $meta);
    }

    public function vendor_delete($id)
    {
        return AdminController::vendorDelete($id);
    }

    public function vendors_kyc()
    {
        return AdminController::kycList();
    }

    public function vendor_add_kyc(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'account_no' => 'required',
            'bank' => 'required', 'name' => 'required',
            'ifsc' => 'required', 'branch' => 'required'
        ]);

        $filename_bidnest_agreement="";
        if($request->hasfile('bidnest_agreement')){
            $file=$request->file('bidnest_agreement');
            $extension=$file->getClientOriginalExtension();
            $filename_bidnest_agreement=time().'.'.$extension;
            $file->move('bidnest_agreement',$filename_bidnest_agreement);
        }

        $filename_adhaar_card="";
        if($request->hasfile('adhaar_card')){
            $file=$request->file('adhaar_card');
            $extension=$file->getClientOriginalExtension();
            $filename_adhaar_card=time().'.'.$extension;
            $file->move('adhaar_card',$filename_adhaar_card);
        }

        $filename_pan_card="";
        if($request->hasfile('pan_card')){
            $file=$request->file('pan_card');
            $extension=$file->getClientOriginalExtension();
            $filename_pan_card=time().'.'.$extension;
            $file->move('pan_card',$filename_pan_card);
        }

        $filename_gst_certificate="";
        if($request->hasfile('gst_certificate')){
            $file=$request->file('gst_certificate');
            $extension=$file->getClientOriginalExtension();
            $filename_gst_certificate=time().'.'.$extension;
            $file->move('gst_certificate',$filename_gst_certificate);
        }


        $company_reg_certificate="";
        if($request->hasfile('company_reg_certificate')){
            $file=$request->file('company_reg_certificate');
            $extension=$file->getClientOriginalExtension();
            $company_reg_certificate=time().'.'.$extension;
            $file->move('company_reg_certificate',$company_reg_certificate);
        }

        $banking_details = array("account_no"=>$request->account_no, "bank"=>$request->bank, "name"=>$request->name, "ifsc"=>$request->ifsc, "branch"=>$request->branch);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return AdminController::vendorAddKyc($filename_bidnest_agreement, $filename_adhaar_card, $filename_pan_card, $filename_gst_certificate, $company_reg_certificate, $banking_details);
    }

    public function vendor_edit_kyc(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
            'account_no' => 'required',
            'bank' => 'required', 'name' => 'required',
            'ifsc' => 'required', 'branch' => 'required'
        ]);

        $filename_bidnest_agreement="";
        if($request->hasfile('bidnest_agreement')){
            $file=$request->file('bidnest_agreement');
            $extension=$file->getClientOriginalExtension();
            $filename_bidnest_agreement=time().'.'.$extension;
            $file->move('bidnest_agreement',$filename_bidnest_agreement);
        }

        $filename_adhaar_card="";
        if($request->hasfile('adhaar_card')){
            $file=$request->file('adhaar_card');
            $extension=$file->getClientOriginalExtension();
            $filename_adhaar_card=time().'.'.$extension;
            $file->move('adhaar_card',$filename_adhaar_card);
        }

        $filename_pan_card="";
        if($request->hasfile('pan_card')){
            $file=$request->file('pan_card');
            $extension=$file->getClientOriginalExtension();
            $filename_pan_card=time().'.'.$extension;
            $file->move('pan_card',$filename_pan_card);
        }

        $filename_gst_certificate="";
        if($request->hasfile('gst_certificate')){
            $file=$request->file('gst_certificate');
            $extension=$file->getClientOriginalExtension();
            $filename_gst_certificate=time().'.'.$extension;
            $file->move('gst_certificate',$filename_gst_certificate);
        }


        $company_reg_certificate="";
        if($request->hasfile('company_reg_certificate')){
            $file=$request->file('company_reg_certificate');
            $extension=$file->getClientOriginalExtension();
            $company_reg_certificate=time().'.'.$extension;
            $file->move('company_reg_certificate',$company_reg_certificate);
        }

        $banking_details = array("account_no"=>$request->account_no, "bank"=>$request->bank, "name"=>$request->name, "ifsc"=>$request->ifsc, "branch"=>$request->branch);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return AdminController::vendorEditKyc($id, $filename_bidnest_agreement, $filename_adhaar_card, $filename_pan_card, $filename_gst_certificate, $company_reg_certificate, $banking_details);
    }

    public function vendor_fetch_kyc($id)
    {
        return AdminController::kycFetch($id);
    }

    public function vendor_delete_kyc($id)
    {
        return AdminController::kycDelete($id);
    }

    public function vendors_list()
    {
        return AdminController::vendorList();
    }

    public function vendors_get_record($id)
    {
        return AdminController::vendorsGetRecord($id);
    }

    public function vendors_delete_record($id)
    {
        return AdminController::vendorsDeleteRecord($id);
    }




    public function vendor_login(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email' => 'required|string',
            'password' => 'required'
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return VendorController::login($request->email, $request->password);
    }


     /*Sliders And Banners*/

     public function sliders()
     {
        return SliderController::get();
     }

     public function sliders_add(Request $request)
     {
        $validation = Validator::make($request->all(),[
            'name' => 'required|string', 'type' => 'required',
            'position' => 'required', 'platform' => 'required',
            'size' => 'required', 'from_date' => 'required',
            'to_date' => 'required', 'zone_specific' => 'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return SliderController::add($request->name, $request->type, $request->position, $request->platform, $request->size, $request->from_date, $request->to_date, $request->zone_specific);
     }

     public function sliders_delete($id)
     {
        return SliderController::delete($id);
     }

     public function banners()
     {
        return SliderController::banners();
     }

     public function banners_add(Request $request)
     {
        $validation = Validator::make($request->all(),[
            'id'=>"required|int",
            'banners.*.name' => 'required|string',
            'banners.*.date.from' => 'required|date',
            'banners.*.date.to' => 'required|date',
            //            'banners.*.order' => 'required|int',
            "banners.*.url" => 'required|url',
            "banners.*.image" => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return SliderController::addBanner($request->all());
     }

     public function banners_delete($id)
     {
        return SliderController::deleteBanner($id);
     }


}
