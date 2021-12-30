<?php

namespace App\Http\Controllers;
use App\Helper;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\BookingsController;
use App\StringFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

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
            'phone'=>'required',
            'otp' => 'required'
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return AdminController::verifyOtp($request->otp, $request->phone);
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

    public function old_reset_password(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'old_password'=> 'required',
            'password' => 'required',
            'password_confirmation' => 'required_with:password|same:password'
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return AdminController::OldResetPassword($request->old_password, $request->password, $request->bearer);
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
            'name' => 'required',
            'image' => 'required',
            'id' => 'required|integer',
            'inventory_quantity_type' =>'required|integer'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return ServiceController::update($request->id, ucwords($request->name), $request->image, $request->inventory_quantity_type);
    }

    public function status_update(Request $request)
    {
        return ServiceController::statusUpdate($request->id);
    }

    public function service_delete(Request $request)
    {
        return ServiceController::delete($request->id);
    }

    /*Subservices*/
    public function subservice_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required',
            'image' => 'required',
            'category'=>'required|integer',
            'inventories.*.id'=>'required',
            'inventories.*.material'=>'required',
            'inventories.*.size'=>'required',
            'inventories.*.quantity'=>'required',
            'extra_inventories.*'=>'required',
            'max_extra_items'=>'required',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return SubServiceController::add($request->all());
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

    public function subservice_status_update(Request $request)
    {
        return SubServiceController::statusUpdate($request->id);
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
            'category'=>'required|integer',
            'inventories.*.id'=>'required',
            'inventories.*.material'=>'required',
            'inventories.*.size'=>'required',
            'inventories.*.quantity'=>'required',
            'extra_inventories.*'=>'required',
            'max_extra_items'=>'required',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return SubServiceController::update($request->id, $request->category, ucwords($request->name), $request->image, $request->inventories, $request->max_extra_items, $request->extra_inventories);
    }

    public function subservice_delete(Request $request)
    {
        return SubServiceController::delete($request->id);
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

    public function inventory_status_update(Request $request)
    {
        return InventoryController::statusUpdate($request->id);
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
            'organization.regi_no' => 'required|string|min:21|max:21',
            'organization.description' =>'required|string',

            'address.address' => 'required|string',
           /* 'address.lat' => 'required|numeric',
            'address.lng' => 'required|numeric',*/
            'address.landmark'=> 'required|string',
            'address.state' => 'required|string',
            'address.city' => 'required|string',
            'address.pincode' => 'required|min:6|max:6',
            'cities' => 'required',
            'service_type' =>'required|string',
            'service.*' =>'required',
            'commission' =>'required',
            'basedist'=>'required|numeric',
            'extrabasedist'=>'required|numeric'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        $meta = array("auth_fname"=>$request->fname, "auth_lname"=>$request->lname, "secondory_phone"=>$request->phone['secondory'],  "gstin_no"=>$request->organization['gstin'], "register_no"=>$request->organization['regi_no'], "org_description"=>$request->organization['description'], "address"=>$request->address['address'], "landmark"=>$request->address['landmark']);

        $admin = array("fname"=>$request->fname, "lname"=>$request->lname, "email"=>$request->email, "phone"=>$request->phone['primary']);

        return OrganisationController::add($request->all(), $meta, $admin);
    }

    public function vendor_edit(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'vendor_id'=>'required',
            'image'=>'required|string',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|string',

            'phone.primary'=>'required|min:10|max:10',
            'phone.secondory'=>'nullable|min:10|max:10',

            'organization.org_name' => 'required|string',
            'organization.org_type' => 'required|string',
            'organization.gstin' => 'required|string|min:15|max:15',
            'organization.regi_no' => 'required|string|min:21|max:21',
            'organization.description' =>'required|string',

            'address.address' => 'required|string',
           /* 'address.lat' => 'required|numeric',
            'address.lng' => 'required|numeric',*/
            'address.landmark'=> 'required|string',
            'address.state' => 'required|string',
            'address.city' => 'required|string',
            'address.pincode' => 'required|min:6|max:6',
            'cities' => 'required',
            'service_type' =>'required',
            'service.*' =>'required',
            'commission' =>'required',
            'basedist'=>'required|integer',
            'extrabasedist'=>'required|numeric'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        $meta = array("auth_fname"=>$request->fname, "auth_lname"=>$request->lname, "secondory_phone"=>$request->phone['secondory'],  "gstin_no"=>$request->organization['gstin'], "register_no"=>$request->organization['regi_no'], "org_description"=>$request->organization['description'], "address"=>$request->address['address'], "landmark"=>$request->address['landmark']);

        $admin = array("fname"=>$request->fname, "lname"=>$request->lname, "email"=>$request->email, "phone"=>$request->phone['primary']);

        return OrganisationController::update($request->all(), $meta, $admin, $request->id, $request->vendor_id);
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

    public function vendor_delete(Request $request)
    {
        return OrganisationController::delete($request->id);
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
            /*'address.lat' => 'required|numeric',
            'address.lng' => 'required|numeric',*/
            'address.landmark'=> 'required|string',
            'address.state' => 'required|string',
            'address.city' => 'required|string',
            'address.pincode' => 'required|min:6|max:6',
            'cities.*' => 'required|integer',
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
            /*'address.lat' => 'required|numeric',
            'address.lng' => 'required|numeric',*/
            'address.landmark'=> 'required|string',
            'address.state' => 'required|string',
            'address.city' => 'required|string',
            'address.pincode' => 'required|min:6|max:6',
            'cities.*' => 'required|integer',
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
            'organization_id'=>'required',
            'parent_id'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return OrganisationController::deleteBranch($request->organization_id, $request->parent_id);

    }

    public function prices_add(Request $request){
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'subservice.id'=>'required',
            'subservice.bidnest.price.economy'=>'required',
            'subservice.bidnest.price.premium'=>'required',
            'subservice.market.price.economy'=>'required',
            'subservice.market.price.premium'=>'required',
            'subservice.mp_additional.price.economy'=>'required',
            'subservice.mp_additional.price.premium'=>'required',
            'subservice.bp_additional.price.economy'=>'required',
            'subservice.bp_additional.price.premium'=>'required',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return OrganisationController::addPrices($request->all(), $request->id, $request->pricing_id);
    }

    public function prices_update(Request $request){
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'subservice.id'=>'required',
            'subservice.bidnest.price.economy'=>'required',
            'subservice.bidnest.price.premium'=>'required',
            'subservice.market.price.economy'=>'required',
            'subservice.market.price.premium'=>'required',
            'subservice.mp_additional.price.economy'=>'required',
            'subservice.mp_additional.price.premium'=>'required',
            'subservice.bp_additional.price.economy'=>'required',
            'subservice.bp_additional.price.premium'=>'required',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return OrganisationController::updatePrices($request->all(), $request->id);
    }

    public function bank_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'bank_id'=>'nullable',
            'id' =>'required',
            'acc_no'=>'required',
            'bank_name'=>'required|string',
            'holder_name'=>'required|string',
            'ifcscode'=>'required|string',
            'branch_name'=>'required|string',
            'doc.aadhar_card' => 'required|string',
            'doc.gst_certificate' => 'required|string',
            'doc.biddnest_agreement' =>'required|string',
            'doc.pan_card' =>'required|string',
            'doc.company_registration_certificate' =>'required|string',
            'doc.additional_file' =>'required|string',
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
            'branch' => 'required',
            'role'=>'required',
            'image'=>'required',
            'dob'=>'required',
            'doj'=>'required',
            'dor'=>'required',
            'state'=>'required',
            'city'=>'required',
            'address1'=>'required',
            'address2'=>'required',
            'assign_module.*'=>'required'
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
            'branch' => 'required',
            'role'=>'required',
            'image'=>'required',
            'dob'=>'required',
            'doj'=>'required',
            'dor'=>'required',
            'state'=>'required',
            'city'=>'required',
            'address1'=>'required',
            'address2'=>'required',
            'assign_module.*'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return OrganisationController::editNewRole($request->all(), $request->id, $request->role_id);
    }

    public function role_delete(Request $request)
    {
        return OrganisationController::deleteRole($request->vendor_id, $request->organization_id);
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
            'to_date' => 'required', 'city_scope' => 'required',
            'cities'=>"nullable"
        ]);

        $formatedRequest = StringFormatter::format($request->all(),[
            'to_date' => 'date',
            'from_date' => 'date',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return SliderController::add($request->name, $request->type, $request->position, $request->platform, $request->size, $formatedRequest->from_date, $formatedRequest->to_date, $request->city_scope, $request->cities);
    }

    public function sliders_edit(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required|integer',
            'name' => 'required|string', 'type' => 'required',
            'position' => 'required', 'platform' => 'required',
            'size' => 'required', 'from_date' => 'required',
            'to_date' => 'required', 'zone_scope' => 'required',
            'cities'=>"nullable"
        ]);

        $formatedRequest = StringFormatter::format($request->all(),[
            'to_date' => 'date',
            'from_date' => 'date',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return SliderController::edit($request->id, $request->name, $request->type, $request->position, $request->platform, $request->size, $formatedRequest->from_date, $formatedRequest->to_date, $request->zone_scope, $request->zones);
    }

    public function slider_status_update(Request $request)
    {
        return SliderController::statusUpdate($request->id);
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
            'banners.*.desc' => 'nullable|string',
            'banners.*.date.from' => 'required|date',
            'banners.*.date.to' => 'required|date',
            "banners.*.url" => 'nullable|url',
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

    public function coupon_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name'=>'required|string',
            'desc'=>'required|string',
            'code'=>'required|string',
            'type'=>'required|integer',
            'discount_type'=>'required|integer',
            'discount_amount'=>'required',
            'max_discount_amount'=>'nullable',
            'min_order_amount'=>'required',
            'deduction_source'=>'required|integer',
            'max_usage'=>'required|integer',
            'max_usage_per_user'=>'required|integer',
            'organization_scope'=>'required|integer',
            'zone_scope'=>'required|integer',
            'user_scope'=>'required|integer',
            'valid_from'=>'required',
            'valid_to'=>'required',
            'orgnizations.*'=>'required',
            'zones.*'=>'required',
            'users.*'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return CouponController::add($request->all());
    }

    public function coupon_edit(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'name'=>'required|string',
            'desc'=>'required|string',
            'code'=>'required|string',
            'type'=>'required|integer',
            'discount_type'=>'required|integer',
            'discount_amount'=>'required',
            'max_discount_amount'=>'nullable',
            'min_order_amount'=>'required',
            'deduction_source'=>'required|integer',
            'max_usage'=>'required|integer',
            'max_usage_per_user'=>'required|integer',
            'organization_scope'=>'required|integer',
            'zone_scope'=>'required|integer',
            'user_scope'=>'required|integer',
            'valid_from'=>'required',
            'valid_to'=>'required',
            'orgnizations.*'=>'required',
            'zones.*'=>'required',
            'users.*'=>'required',
            'status'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return CouponController::update($request->all(), $request->id);
    }

    public function coupon_delete(Request $request)
    {
        return CouponController::delete($request->id);
    }

    public function zones_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name'=>'required|string',
//            'lat'=>'required|numeric',
//            'lng'=>'required|numeric',
            'coordinates'=>'required|string',
            'city'=>'nullable|integer',
            'district'=>'required|string',
            'service_radius'=>'required|numeric',
            'state'=>'required|string',
            'area'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        $coordinate_grp = str_replace(
            array('(',')'), array('[','] '),
            $request->coordinates);

        $coordinate = explode(" ,",$coordinate_grp);

        $final_coords = [];
        $count = 0;
        foreach ($coordinate as $coordinates){
            $final_coords[$count]['latitude'] = explode(",",str_replace(
            array('[',']'), array('',''),
            $coordinates))[0];

           $final_coords[$count]['longitude'] = explode(",",str_replace(
                array('[',']'), array('',''),
            $coordinates))[1];
            $count ++;
        }
        return ZoneController::add($request->name, $final_coords, $request->city, $request->district, $request->state, $request->area);
    }

    public function zones_edit(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'name'=>'required|string',
//            'lat'=>'required|numeric',
//            'lng'=>'required|numeric',
            'coordinates'=>'required|string',
            'city'=>'nullable|integer',
            'district'=>'required|string',
            'service_radius'=>'required|numeric',
            'state'=>'required|string',
            'area'=>'required'
        ]);

        $coordinate_grp = str_replace(
            array('(',')'), array('[','] '),
            $request->coordinates);

        $coordinate = explode(" ,",$coordinate_grp);

        $final_coords = [];
        $count = 0;
        foreach ($coordinate as $coordinates){
            $final_coords[$count]['latitude'] = explode(",",str_replace(
                array('[',']'), array('',''),
                $coordinates))[0];

            $final_coords[$count]['longitude'] = explode(",",str_replace(
                array('[',']'), array('',''),
                $coordinates))[1];
            $count ++;
        }

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return ZoneController::update($request->id, $request->name, $final_coords, $request->city, $request->district, $request->state, $request->area);
    }

    public function zone_status_update(Request $request)
    {
        return ZoneController::statusUpdate($request->id);
    }

    public function zones_delete(Request $request)
    {
        return ZoneController::delete($request->id);
    }

    public function end_bid(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id'=> 'string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return BidController::getbookings($request->public_booking_id);

    }

    public function searchUser(Request $request)
    {
//         return $request->query;
        return UserController::search($request);
    }

    public function searchVendor(Request $request)
    {
//         return $request->query;
        return OrganisationController::search($request);
    }

    public function searchadmin(Request $request)
    {
//         return $request->query;
        return AdminController::search($request);
    }

    public function searchitem(Request $request)
    {
//         return $request->query;
        return InventoryController::searchItem($request);
    }

    public function serachOrder(Request $request)
    {
        return BookingsController::serachOrder($request);
    }

    public function testimonial_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name'=>'required|string',
            'designation'=>'required|string',
            'image'=>'required',
            'heading'=>'required|string',
            'desc'=>'required|string',
            'rating'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return TestimonialController::add($request->name, $request->designation, $request->image, $request->heading, $request->desc, $request->rating);
    }

    public function testimonial_edit(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'name'=>'required|string',
            'designation'=>'required|string',
            'image'=>'required',
            'heading'=>'required|string',
            'desc'=>'required|string',
            'rating'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return TestimonialController::update($request->id, $request->name, $request->designation, $request->image, $request->heading, $request->desc, $request->rating);
    }

    public function testimonial_delete(Request $request)
    {
        return TestimonialController::delete($request->id);
    }

    public function customer_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'fname'=>'required|string',
            'lname'=>'required|string',
            'phone'=>'required|string',
            'email'=>'required',
            'gender'=>'required|string',
            'dob'=>'required',
            'image'=>'required',
            'city'=>'required|nullable'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return UserController::add($request->fname, $request->lname, $request->phone, $request->email, $request->gender, $request->dob, $request->image,$request->city);
    }

    public function customer_edit(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'fname'=>'required|string',
            'lname'=>'required|string',
            'phone'=>'required|string',
            'email'=>'required',
            'gender'=>'required|string',
            'dob'=>'required|date',
            'image'=>'required',
            'city'=>"required|nullable"
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return UserController::update($request->id, $request->fname, $request->lname, $request->email, $request->gender, $request->dob, $request->image, $request->phone, $request->city);
    }

    public function user_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'image'=>'required',
            'fname'=>'required|string',
            'lname'=>'required|string',
            'username'=>'required',
            'password'=>'required',
            'role'=>'required',
            'cities'=>'nullable',
            'phone'=>'required',
            'email'=>'required',
            'dob'=>'required',
            'state'=>'required',
            'city'=>'required',
            'pincode'=>'required',
            'joinig_date'=>'required',
            'meta.manager_name'=>'required|string',
            'meta.alt_phone'=>'required',
            'meta.gender'=>'required',
            'meta.pan_no'=>'required',
            'meta.adhar_no'=>'required',
            'meta.address_line1'=>'required',
            'meta.address_line2'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return AdminController::add($request->all());
    }

    public function user_edit(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'image'=>'required',
            'fname'=>'required|string',
            'lname'=>'required|string',
            'username'=>'required',
            'role'=>'required',
            'cities'=>'nullable',
            'phone'=>'required',
            'email'=>'required',
            'dob'=>'required',
            'state'=>'required',
            'city'=>'required',
            'pincode'=>'required',
            'joinig_date'=>'required',
            'meta.manager_name'=>'required|string',
            'meta.alt_phone'=>'required',
            'meta.gender'=>'required',
            'meta.pan_no'=>'required',
            'meta.adhar_no'=>'required',
            'meta.address_line1'=>'required',
            'meta.address_line2'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return AdminController::update($request->all());
    }

    public function user_status_update(Request $request)
    {
        return AdminController::statusUpdate($request->id);
    }

    public function bank_edit(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'acc_no'=>'required',
            'bank_name'=>'required|string',
            'holder_name'=>'required|string',
            'ifsc'=>'required',
            'branch_name'=>'required|string',
            'aadhar_image'=>'required',
            'pan_image'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return AdminController::addBank($request->all());
    }

    public function user_delete(Request $request)
    {
        return AdminController::delete($request->id);
    }

    public function payout_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'orgnizations'=>'required',
            'payout_date'=>'required',
            'amount'=>'required',
            'no_of_orders'=>'required',
            'commission'=>'required',
            'commission_amount'=>'required',
            'status'=>'required',
            'payout_amount'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return PayoutController::add($request->all());
    }

    public function payout_edit(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'orgnizations'=>'required',
            'payout_date'=>'required',
            'amount'=>'required',
            'no_of_orders'=>'required',
            'commission'=>'required',
            'commission_amount'=>'required',
            'status'=>'required',
            'payout_amount'=>'required',
            'desc'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return PayoutController::update($request->all());
    }

    public function page_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name'=>'required',
            'slug'=>'required',
            'contents'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return PageController::add($request->name, $request->slug, $request->contents);
    }

    public function page_edit(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'name'=>'required',
            'slug'=>'required',
            'contents'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return PageController::updatePage($request->id, $request->name, $request->slug, $request->contents);
    }

    public function page_delete(Request $request)
    {
        return PageController::delete($request->id);
    }

    public function faq_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'category'=>'required',
            'ques'=>'required',
            'answer'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return FaqController::add($request->ques, $request->answer, $request->category);
    }

    public function faq_edit(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'category'=>'required',
            'ques'=>'required',
            'answer'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return FaqController::update($request->id, $request->ques, $request->answer, $request->category);
    }

    public function faq_delete(Request $request){
        return FaqController::delete($request->id);
    }

    public function contact_us(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'phone'=>'required',
            'email'=>'required',
            'address'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return SettingController::update_contact($request->phone, $request->email, $request->address);
    }

    public function api_settings_general(Request $request)
    {
        return SettingController::update_api_general($request->all());
    }

    public function api_settings_update(Request $request)
    {
        return SettingController::update_api($request->all());
    }

    public function reply_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'ticket_id'=>'required',
            'reply'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return TicketReplyController::addReplyFromAdmin(\Illuminate\Support\Facades\Session::get('account')['id'], $request->ticket_id, $request->reply);
    }

    public function changeStatus(Request $request)
    {
        return TicketReplyController::changeStatus($request->id, $request->data);
    }

    public function changeStatusPrice(Request $request)
    {
        return InventoryController::changeStatus($request->id, $request->org_id, $request->cat_id, $request->status);
    }

    public function changeStatusBranch(Request $request)
    {
        return OrganisationController::changeStatus($request->id, $request->status);
    }

    public function notification_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name'=>'required',
            'for'=>'required',
            'desc'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return NotificationController::createNotification($request->name, $request->for, $request->desc, $request->user, $request->vendor);
    }

    public function booking_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'service_id' => 'required|integer',

            'source.lat' => 'required|numeric',
            'source.lng' => 'required|numeric',

            'source.meta.geocode' => 'nullable|string',
            'source.meta.floor' => 'required|integer',
            'source.meta.address_line1' => 'required|string',
            'source.meta.address_line2' => 'required|string',
            'source.meta.city' => 'required|string',
            'source.meta.state' => 'required|string',
            'source.meta.pincode' => 'required|min:6|max:6',
            'source.meta.lift' => 'required|boolean',

            'destination.lat' => 'required|numeric',
            'destination.lng' => 'required|numeric',

            'destination.meta.geocode' => 'nullable|string',
            'destination.meta.floor' => 'required|integer',
            'destination.meta.address_line1' => 'required|string',
            'destination.meta.address_line2' => 'required|string',
            'destination.meta.city' => 'required|string',
            'destination.meta.state' => 'required|string',
            'destination.meta.pincode' => 'required|min:6|max:6',
            'destination.meta.lift' => 'required|boolean',

            'contact_details.name'  => 'required|string',
            'contact_details.phone'  => 'required|min:10|max:10',
            'contact_details.email'  => 'required|string',

            'friend_details' => "nullable",
            'friend_details.name'  => 'nullable|string',
            'friend_details.phone'  => 'nullable|min:10|max:10',
            'friend_details.email'  => 'nullable|string',

            'meta.self_booking' => 'required|boolean',
            'meta.subcategory' => 'nullable|string',

            'movement_dates' =>'required',

            'inventory_items.*.inventory_id' =>'required|integer',
            'inventory_items.*.material' =>'required|string',
            'inventory_items.*.size' =>'required|string',
            'inventory_items.*.quantity' =>'required',
            'inventory_items.*.is_custom' =>'required|boolean',

            'otp'=>'required|min:6|max:6'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return BookingsController::createEnquiryForAdmin($request);
    }

    public function booking_confirm(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'service_type' => 'required|string',
            'public_booking_id' => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return BookingsController::confirmBooking($request->public_booking_id, $request->service_type, $request->id);
    }

     public function booking_reject(Request $request)
     {
         $validation = Validator::make($request->all(),[
             'reason' => 'required|string',
             'desc' => 'required|string',
             'public_booking_id' => 'required|string'
         ]);

         if($validation->fails())
             return Helper::response(false,"validation failed", $validation->errors(), 400);
         else
             return BookingsController::cancelBooking($request->public_booking_id, $request->reason, $request->desc);
     }

    public function booking_add_bid(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required',
            'organization_id' => 'required',
            'vendor_id'=>'required',
            'inventory.*.booking_inventory_id'=>'required|integer',
            'inventory.*.amount'=>'required',

            'bid_amount'=>'required',
            'type_of_movement'=>'required|string',
            'moving_date'=>'required',
            'vehicle_type'=>'required|string',

            'man_power'=>'required',
            'otp'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return BidController::submitBidAdmin($request->all());
    }

    public function rescheduleOrder(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => 'required',
            'data' => 'required',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return BookingsController::reschedulBooking($request->id, $request->data);
    }

    public function cancelOrder(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'amount' => 'numeric|nullable',
            'reason' => 'string|nullable',
            'desc' => 'string|nullable',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return BookingsController::cancelByAdmin($request->id, $request->amount, $request->reason, $request->desc);
    }

    public function send_otp_bid(Request $request)
    {
        return OrganisationController::sendOtpForBid($request->id);
    }

    public function send_otp_booking(Request $request)
    {
        return BookingsController::sendOtpForBooking($request);
    }

    public function sendInvoiceMail(Request $request)
    {
        return MailController::invoice_email($request->booking_id);
    }

    public function checkServiceable(Request $request){
        $validation = Validator::make($request->all(),[
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);

        return Helper::response(true, "Here is the result.",["serviceable"=>GeoController::isServiceable($request->latitude, $request->longitude)]);
    }

    public function addContact(Request $request){
        return PayoutController::registerFundAccount($request->id);
    }

    public function vendor_action(Request $request){
        return OrganisationController::changeStatusVendor($request->id, $request->status);
    }

    /* public function export_csv(Request $request){
         return ExportController::exoprtSale();
     }*/

     public function inventories_import(Request $request){
         return InventoryController::import($request->file('file'));
     }

     public function subservice_items(Request $request){
         return SubServiceController::getDefaultItems($request->id, $request->service);
     }

     public function booking_edit(Request $request){
         $validation = Validator::make($request->all(),[
             'public_booking_id'=>'required',
             'service_id' => 'required|integer',

             'source.lat' => 'required|numeric',
             'source.lng' => 'required|numeric',

             'source.meta.geocode' => 'nullable|string',
             'source.meta.floor' => 'required|integer',
             'source.meta.address_line1' => 'required|string',
             'source.meta.address_line2' => 'required|string',
             'source.meta.city' => 'required|string',
             'source.meta.state' => 'required|string',
             'source.meta.pincode' => 'required|min:6|max:6',
             'source.meta.lift' => 'required|boolean',

             'destination.lat' => 'required|numeric',
             'destination.lng' => 'required|numeric',

             'destination.meta.geocode' => 'nullable|string',
             'destination.meta.floor' => 'required|integer',
             'destination.meta.address_line1' => 'required|string',
             'destination.meta.address_line2' => 'required|string',
             'destination.meta.city' => 'required|string',
             'destination.meta.state' => 'required|string',
             'destination.meta.pincode' => 'required|min:6|max:6',
             'destination.meta.lift' => 'required|boolean',

             'contact_details.name'  => 'required|string',
             'contact_details.phone'  => 'required|min:10|max:10',
             'contact_details.email'  => 'required|string',

             'friend_details' => "nullable",
             'friend_details.name'  => 'nullable|string',
             'friend_details.phone'  => 'nullable|min:10|max:10',
             'friend_details.email'  => 'nullable|string',

             'meta.self_booking' => 'required|boolean',
             'meta.subcategory' => 'nullable|string',

             'movement_dates' =>'required',

             'inventory_items.*.inventory_id' =>'required|integer',
             'inventory_items.*.material' =>'required|string',
             'inventory_items.*.size' =>'required|string',
             'inventory_items.*.quantity' =>'required',
         ]);

         if($validation->fails())
             return Helper::response(false,"validation failed", $validation->errors(), 400);

         return BookingsController::editEnquiryForAdmin($request);
     }

     public function booking_fianl_bid_edit(Request $request)
     {
         $validation = Validator::make($request->all(),[
             'booking_id'=>'required',

             'bid_amount'=>'required|numeric',
             'commission' => 'required|numeric',
             'sub_total' => 'required|numeric',

             'other_charges' => 'nullable|numeric',
             'discount_amount' => 'required|numeric',
             'tax' => 'required|numeric',
             'grand_total' => 'required|numeric'
         ]);

         if($validation->fails())
             return Helper::response(false,"validation failed", $validation->errors(), 400);

         return PaymentController::updateBookingPaymentData($request->booking_id, $request->bid_amount, $request->sub_total, $request->commission, $request->other_charges, $request->tax, $request->discount_amount, $request->grand_total, $request->confirm);
     }

     public function bookinStatusChange(Request $request){
         return BookingsController::changeStatusBooking($request->id, $request->status);
     }

     public function getSubserviceInventories(Request $request)
     {
         $validation = Validator::make($request->all(),[
             'subservice_id'=>'required',
         ]);

         if($validation->fails())
             return Helper::response(false,"validation failed", $validation->errors(), 400);

         return InventoryController::getBySubserviceForApp($request->subservice_id);
     }

     public function assignVirtualAssistant(Request $request)
     {
         $validation = Validator::make($request->all(),[
             'admin_id'=>'required',
             'booking_id'=>'required',
         ]);

         if($validation->fails())
             return Helper::response(false,"validation failed", $validation->errors(), 400);

         return BookingsController::assignVirtualAssistant($request->booking_id, $request->admin_id);
     }

     public function voucherCreate(Request $request){

        $validation = Validator::make($request->all(),[
            'image'=>'required|string',
            'name'=>'required|string',
            'title'=>'required|string',
            'desc'=>'required|string',
            'provider'=>'required|string',
            'provider_url'=>'required|string',
            'max_redemptions'=>'required|integer',
            'type'=>'required|integer',
            'codes.*.code'=>'required',
            'codes.*.expires_at'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return VoucherController::create($request->image, $request->name, $request->title, $request->desc, $request->provider, $request->provider_url, $request->max_redemptions, $request->type, $request->codes);
     }

     public function voucherEdit(Request $request){

        $validation = Validator::make($request->all(),[
            'id'=> 'required|integer',
            'image'=>'required|string',
            'name'=>'required|string',
            'title'=>'required|string',
            'desc'=>'required|string',
            'provider'=>'required|string',
            'provider_url'=>'required|string',
            'max_redemptions'=>'required|integer',
            'type'=>'required|integer',
            'codes.*.code'=>'required',
            'codes.*.expires_at'=>'required',
            'status'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return VoucherController::edit($request->id, $request->image, $request->name, $request->title, $request->desc, $request->provider, $request->provider_url, $request->max_redemptions, $request->type, $request->codes, $request->status);
     }

     public function voucherDelete(Request $request){
        return VoucherController::delete($request->id);
     }

     public function zones_referal(Request $request){
        $validation = Validator::make($request->all(),[
            'zone_id'=> 'required|integer',
            'referrer.reward_type'=>'required|integer',
            'referrer.reward_points'=>'integer',
            'referrer.voucher_id'=>'numeric|nullable',
            'referrer.trigger_on'=>'required|integer',
            'referee.reward_type'=>'required|integer',
            'referee.voucher_id'=>'numeric|nullable',
            'referee.trigger_on'=>'required|integer'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return ReferralController::update($request);
     }

     public function redeemPoints(Request $request){
        $validation = Validator::make($request->all(),[
            'user_id'=> 'required|integer',
            'points'=>'required|integer',
            'voucher_id'=>'required|integer',
            'comments'=>'nullable|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return RewardPointController::redeem($request->user_id, $request->points, $request->voucher_id, $request->comments);
     }

     public function addPoints(Request $request){
        $validation = Validator::make($request->all(),[
            'user_id'=> 'required|integer',
            'points'=>'required|integer',
            'comments'=>'nullable|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return RewardPointController::deposit($request->user_id, $request->points, $request->comments);
     }

     public function autofill_customer_data(Request $request){
        $validation = Validator::make($request->all(),[
            'phone'=> 'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return UserController::getByPhone($request->phone);
     }

    public function coupon_status_update(Request $request)
    {
        return CouponController::statusUpdate($request->id);
    }

    public function complaintAdd(Request $request){
        $validation = Validator::make($request->all(),[
            'heading'=> 'required',
            'category'=> 'required',
            'status'=> 'required',
            'desc'=> 'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        $ticket_images = null;

        if($request->search_user_id){
            $id = $request->search_user_id;
        }
        else{
            $id =$request->user_id;
        }

        return TicketController::create($id, $request->category, ["public_booking_id"=>$request->public_booking_id], $ticket_images, $request->heading, $request->desc, $request->status);
    }

    public function cities_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name'=>'required|string',
            'zones.*'=>'required',
            'state'=>'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return CityController::addCity($request->name, $request->zones, $request->state);
    }

    public function cities_edit(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'name'=>'required|string',
            'zones.*'=>'required',
            'state'=>'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return CityController::updateCity($request->id, $request->name, $request->zones, $request->state);
    }

    public function city_status_update(Request $request)
    {
        return CityController::statusUpdateCity($request->id);
    }

    public function cities_delete(Request $request)
    {
        return CityController::cities_delete($request->id);
    }

    public function getAllZones(Request $request)
    {
        return ZoneController::get();
    }

}
