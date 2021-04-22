<?php

namespace App\Http\Controllers;
use App\Http\Controllers\User\UserController;
use App\Models\Inventory;
use App\StringFormatter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Helper;
use phpDocumentor\Reflection\Types\Nullable;
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
            'name' => 'required',
            'image' => 'required',
            'id' => 'required|integer',
            'inventory_quantity_type' =>'required|integer'
        ]);

        if($validation->fails())
          return Helper::response(false,"validation failed", $validation->errors(), 400);

        return ServiceController::update($request->id, ucwords($request->name), $request->image, $request->inventory_quantity_type);
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
            'inventories.*.name'=>'required',
            'inventories.*.material'=>'required',
            'inventories.*.size'=>'required',
            'inventories.*.quantity'=>'required'
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
            'category'=>'required|integer'

        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return SubServiceController::update($request->id, $request->category, ucwords($request->name), $request->image);
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
            'service_type' =>'required',
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
            'organization_id'=>'required',
            'parent_id'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return OrganisationController::deleteBranch($request->organization_id, $request->parent_id);

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
            'image'=>'required'
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
            'image'=>'required'
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
            'to_date' => 'required', 'zone_scope' => 'required',
            'zones'=>"nullable"
        ]);

         $formatedRequest = StringFormatter::format($request->all(),[
             'to_date' => 'date',
             'from_date' => 'date',
         ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return SliderController::add($request->name, $request->type, $request->position, $request->platform, $request->size, $formatedRequest->from_date, $formatedRequest->to_date, $request->zone_scope, $request->zones);
     }

     public function sliders_edit(Request $request)
     {
        $validation = Validator::make($request->all(),[
            'id'=>'required|integer',
            'name' => 'required|string', 'type' => 'required',
            'position' => 'required', 'platform' => 'required',
            'size' => 'required', 'from_date' => 'required',
            'to_date' => 'required', 'zone_scope' => 'required',
            'zones'=>"nullable"
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

     public function coupon_add(Request $request)
     {
        $validation = Validator::make($request->all(),[
            'name'=>'required|string',
            'desc'=>'required|string',
            'code'=>'required|string',
            'type'=>'required|integer',
            'discount_type'=>'required|integer',
            'discount_amount'=>'required',
            'max_discount_amount'=>'required',
            'min_order_amount'=>'required',
            'deduction_source'=>'required|integer',
            'max_usage'=>'required|integer',
            'max_usage_per_user'=>'required|integer',
            'organization_scope'=>'required|integer',
            'zone_scope'=>'required|integer',
            'user_scope'=>'required|integer',
            'valid_from'=>'required',
            'valid_to'=>'required',
            'organizations.*'=>'required',
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
             'max_discount_amount'=>'required',
             'min_order_amount'=>'required',
             'deduction_source'=>'required|integer',
             'max_usage'=>'required|integer',
             'max_usage_per_user'=>'required|integer',
             'organization_scope'=>'required|integer',
             'zone_scope'=>'required|integer',
             'user_scope'=>'required|integer',
             'valid_from'=>'required',
             'valid_to'=>'required',
             'organizations.*'=>'required',
             'zones.*'=>'required',
             'users.*'=>'required'
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
             'lat'=>'required|numeric',
             'lng'=>'required|numeric',
             'city'=>'required|string',
             'district'=>'required|string',
             'state'=>'required|string',
             'area'=>'required'
         ]);

         if($validation->fails())
             return Helper::response(false,"validation failed", $validation->errors(), 400);

         return ZoneController::add($request->name, $request->lat, $request->lng, $request->city, $request->district, $request->state, $request->area);
     }

     public function zones_edit(Request $request)
     {
         $validation = Validator::make($request->all(),[
             'id'=>'required',
             'name'=>'required|string',
             'lat'=>'required|numeric',
             'lng'=>'required|numeric',
             'city'=>'required|string',
             'district'=>'required|string',
             'state'=>'required|string',
             'area'=>'required'
         ]);

         if($validation->fails())
             return Helper::response(false,"validation failed", $validation->errors(), 400);

         return ZoneController::update($request->id, $request->name, $request->lat, $request->lng, $request->city, $request->district, $request->state, $request->area);
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

     public function testimonial_add(Request $request)
     {
         $validation = Validator::make($request->all(),[
             'name'=>'required|string',
             'designation'=>'required|string',
             'image'=>'required',
             'heading'=>'required|string',
             'desc'=>'required|string'
         ]);

         if($validation->fails())
             return Helper::response(false,"validation failed", $validation->errors(), 400);

         return TestimonialController::add($request->name, $request->designation, $request->image, $request->heading, $request->desc);
     }

    public function testimonial_edit(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'name'=>'required|string',
            'designation'=>'required|string',
            'image'=>'required',
            'heading'=>'required|string',
            'desc'=>'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return TestimonialController::update($request->id, $request->name, $request->designation, $request->image, $request->heading, $request->desc);
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
            'image'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return UserController::add($request->fname, $request->lname, $request->phone, $request->email, $request->gender, $request->dob, $request->image);
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
            'dob'=>'required',
            'image'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return UserController::update($request->id, $request->fname, $request->lname, $request->email, $request->gender, $request->dob, $request->image, $request->phone);
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
            'zone'=>'required',
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
            'zone'=>'required',
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
}
