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

    public function service_get(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => 'required|integer',
        ]);
        return ServiceController::getOne($request->id);
    }

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
    public function subservice_add(Request $request)
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
            return SubServiceController::add($request->service_id,ucwords($request->name), $request->image, $request->inventories);
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

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return SubServiceController::getOne($request->id);
    }

    public function subservice_get_by_service(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => 'required|integer',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

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

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

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

    public function inventories_get(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => 'required|integer',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return InventoryController::getOne($request->id);
    }

    public function inventories_delete(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => 'required|integer',
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return InventoryController::delete($request->id);
    }

    // public function vendors()
    // {
    //     return AdminController::vendorsList();
    // }


    /*Organization and Vendor*/
    public function vendor_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'image'=>'required|string',
            'fname' => 'required|string', 
            'lname' => 'required|string',
            'email' => 'required|string',          

            'phone.primary'=>'required|min:10|max:10',
            'phone.secondory'=>'nullable|min:10|max:10',

            'organization.org_name' => 'required|string',
            'organization.org_type' => 'required|string', 
            'organization.gstin' => 'required|string|min:15|max:15',
            'organization.description' =>'required|string',

            'address.address' => 'required|string', 
            'address.lat' => 'required|numeric', 
            'address.lng' => 'required|numeric',
            'address.landmark'=> 'required|string',
            'address.state' => 'required|string',
            'address.city' => 'required|string', 
            'address.pincode' => 'required|min:6|max:6',
            'zone' => 'required|integer',
            'service_type' =>'required|string',
            'service.*' =>'required',
            'commission' =>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        $meta = array("auth_fname"=>$request->fname, "auth_lname"=>$request->lname, "secondory_phone"=>$request->phone['secondory'],  "gstin_no"=>$request->organization['gstin'], "org_description"=>$request->organization['description'], "address"=>$request->address['address'], "landmark"=>$request->address['landmark']);

        $admin = array("fname"=>$request->fname, "lname"=>$request->lname, "email"=>$request->email, "phone"=>$request->phone['primary']);        
       
        return OrganisationController::add($request->all(), $meta, $admin);
    }

    public function vendor_edit(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'image'=>'required|string',
            'fname' => 'required|string', 
            'lname' => 'required|string',
            'email' => 'required|string',          

            'phone.primary'=>'required|min:10|max:10',
            'phone.secondory'=>'nullable|min:10|max:10',

            'organization.org_name' => 'required|string',
            'organization.org_type' => 'required|string', 
            'organization.gstin' => 'required|string|min:15|max:15',
            'organization.description' =>'required|string',

            'address.address' => 'required|string', 
            'address.lat' => 'required|numeric', 
            'address.lng' => 'required|numeric',
            'address.landmark'=> 'required|string',
            'address.state' => 'required|string',
            'address.city' => 'required|string', 
            'address.pincode' => 'required|min:6|max:6',
            'zone' => 'required|integer',
            'service_type' =>'required|string',
            'service.*' =>'required',
            'commission' =>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        $meta = array("auth_fname"=>$request->fname, "auth_lname"=>$request->lname, "secondory_phone"=>$request->phone['secondory'],  "gstin_no"=>$request->organization['gstin'], "org_description"=>$request->organization['description'], "address"=>$request->address['address'], "landmark"=>$request->address['landmark']);

        $admin = array("fname"=>$request->fname, "lname"=>$request->lname, "email"=>$request->email, "phone"=>$request->phone['primary']);        
       
        return OrganisationController::update($request->all(), $meta, $admin, $request->id);
    }

    public function vendor_fetch(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return OrganisationController::getOne($request->id);
    }

    public function branch_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'phone.primary'=>'required|min:10|max:10',

            'organization.org_name' => 'required|string',
            'organization.org_type' => 'required|string', 
            'organization.description' =>'required|string',
 
            'address.address' => 'required|string',
            'address.lat' => 'required|numeric', 
            'address.lng' => 'required|numeric',
            'address.landmark'=> 'required|string',
            'address.state' => 'required|string',
            'address.city' => 'required|string', 
            'address.pincode' => 'required|min:6|max:6',
            'zone' => 'required|integer',
            'service.*' =>'required|integer',
            'service_type' =>'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return OrganisationController::addBranch($request->all(), $request->id);
    }

    public function branch_edit(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'parent_org_id'=>'required',
            'phone.primary'=>'required|min:10|max:10',

            'organization.org_name' => 'required|string',
            'organization.org_type' => 'required|string', 
            'organization.description' =>'required|string',
 
            'address.address' => 'required|string',
            'address.lat' => 'required|numeric', 
            'address.lng' => 'required|numeric',
            'address.landmark'=> 'required|string',
            'address.state' => 'required|string',
            'address.city' => 'required|string', 
            'address.pincode' => 'required|min:6|max:6',
            'zone' => 'required|integer',
            'service.*' =>'required|integer',
            'service_type' =>'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return OrganisationController::updateBranch($request->all(), $request->id, $request->parent_org_id);

    }

    public function branch_delete(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'parent_org_id'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return OrganisationController::deleteBranch($request->id, $request->parent_org_id);

    }

    public function bank_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'bank_id'=>'nullable',
            'id' =>'required',
            'acc_no'=>'required',
            'banck_name'=>'required|string',
            'holder_name'=>'required|string',
            'ifcscode'=>'required|string',
            'branch_name'=>'required|string',
            'doc.aadhar_card' => 'required|string',
            'doc.gst_certificate' => 'required|string', 
            'doc.biddnest_agreement' =>'required|string',
            'doc.pan_card' =>'required|string',
            'doc.company_registration_certificate' =>'required|string',
        ]);
        
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        
        return OrganisationController::addBank($request->all(), $request->id, $request->bank_id);
    }

    public function role_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' =>'required',
            'fname' => 'required|string', 
            'lname' => 'required|string',
            'email' => 'required|string',        
            'phone'=>'required|min:10|max:10', 
            'branch' => 'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return OrganisationController::addNewRole($request->all(), $request->id);
    }

    public function role_edit(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' =>'required',
            'role_id'=>'required',
            'fname' => 'required|string', 
            'lname' => 'required|string',
            'email' => 'required|string',        
            'phone'=>'required|min:10|max:10', 
            'branch' => 'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return OrganisationController::editNewRole($request->all(), $request->id, $request->role_id);
    }

    public function role_delete(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'organization_id'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return OrganisationController::deleteRole($request->id, $request->organization_id);
    }

    /*Vendor login*/

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
