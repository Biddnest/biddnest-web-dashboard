<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\GeoUserController;
use App\StringFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class WebsiteRouteController extends Controller
{
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'phone' => 'required|string|min:10',
            'otp' => 'nullable|numeric'
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        if($request->otp == "")
            return UserController::login($request->phone, true);
        else
            return UserController::verifyLoginOtp($request->phone, $request->otp, true);
    }

    public function signup(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'fname' => 'required|string|max:50',
            'lname' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'gender' => 'required|string|max:6'
        ]);

        $formatedRequest = StringFormatter::format($request->all(),[
            'fname' => 'capitalizeFirst',
            'lname' => 'capitalizeFirst',
            'gender' => 'lowercase',
            'email' => 'lowercase'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
            return UserController::signupUser(Session::get('account')['id'], $formatedRequest->fname, $formatedRequest->lname, $formatedRequest->email, $formatedRequest->gender, $request->referral_code);

    }

    public function addVendor(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|string',
//            'role' => 'required',

            'phone.primary'=>'required|min:10|max:10',

            'organization.org_name' => 'required|string',
            'organization.org_type' => 'required|string',
            'organization.gstin' => 'required|string|min:15|max:15',

            'address.address' => 'required|string',
            'address.state' => 'required|string',
            'address.city' => 'required|string',
            'address.pincode' => 'required|min:6|max:6',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        $meta = array("auth_fname"=>$request->fname, "auth_lname"=>$request->lname, "secondory_phone"=>null,  "gstin_no"=>$request->organization['gstin'], "org_description"=>null, "address"=>$request->address['address'], "landmark"=>null);

        $admin = array("fname"=>$request->fname, "lname"=>$request->lname, "email"=>$request->email, "phone"=>$request->phone['primary']);

        return OrganisationController::addForWeb($request->all(), $meta, $admin);
    }

    public function editProfile(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required',
            'fname'=>'required|string',
            'lname'=>'required|string',
            'phone'=>'required|string',
            'email'=>'required',
            'gender'=>'required|string',
            'dob'=>'required',
//            'image'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return UserController::update($request->id, $request->fname, $request->lname, $request->email, $request->gender, $request->dob, $request->image, $request->phone);
    }

    public function addTicket(Request $request)
    {
        $validation = Validator::make($request->all(),[
//            'public_booking_id'=>"required|string",
            'category'=>'required|string',
            'heading' => 'required|string',
            'desc' => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return TicketController::createForWeb(Session::get('account')['id'], $request->category, ["public_booking_id"=>$request->public_booking_id], $request->heading, $request->desc);
    }

    public function raiseTicket(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'data' => 'required',
            //'heading' => 'required|string',
            //'desc' => 'required|string',
            // 'ticket_type'=>'required|integer'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return TicketController::createCallBackBooking(Session::get('account')['id'], $request->data);
    }

    public function addRejectTicket(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required|string',
             'heading' => 'required|string',
             'desc' => 'required|string',
             'request_callback'=>'nullable'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return BookingsController::rejectBooking(Session::get('account')['id'], $request->public_booking_id, $request->reason, $request->desc, $request->request_callback);
    }

    public function addCancelTicket(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required|string',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return TicketController::create(Session::get('account')['id'], 2,  ["public_booking_id"=>$request->public_booking_id]);
    }

    public function addReschedulTicket(Request $request)
    {
            $validation = Validator::make($request->all(),[
                'public_booking_id' => 'required|string',
            ]);

            if($validation->fails())
                return Helper::response(false,"validation failed", $validation->errors(), 400);

            return TicketController::create(Session::get('account')['id'], 3,  ["public_booking_id"=>$request->public_booking_id]);
    }

    public function requestCallback(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'data' => 'required',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return TicketController::createCallBack(4, $request->data);
    }

    public function bookingConfirmEstimate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'service_type' => 'required|string',
            'public_booking_id' => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return BookingsController::confirmBooking($request->public_booking_id, $request->service_type, Session::get('account')['id']);
    }

    public function verifiedCoupon(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required|string',
            'coupon' =>'string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        $valid= CouponController::checkIfValid($request->public_booking_id, $request->coupon, true);

        if(is_array($valid))
            return Helper::response(true,"valid Coupon", $valid);
        else
            return Helper::response(false,$valid);

    }

    public function initiatePayment(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => 'required|string',
            'code' =>'string|nullable'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return PaymentController::intiatePayment($request->id, $request->code);
    }

    public function statusComplete(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'booking_id' => 'required|string',
            'payment_id' => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return PaymentController::statusComplete(Session::get('account')['id'], $request->booking_id, $request->payment_id);
    }

    public static function updateMobile(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'phone' => 'required|string|min:10',
            'otp' => 'nullable|numeric'
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        if($request->otp == "")
            return UserController::updateMobile(Session::get('account')['id'], $request->phone, true);
        else
            return UserController::verifyMobile(Session::get('account')['id'], $request->phone, $request->otp, true);
    }

    public function getSubServices(Request $request){
        $validation = Validator::make($request->all(),[
            'service_id' => 'required|integer'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
            return SubServiceController::getSubservicesForApp($request->service_id);
    }

    public function getInventories(Request $request){
        $validation = Validator::make($request->all(),[
            'subservice_id' => 'required|integer'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
            return InventoryController::getBySubserviceForApp($request->subservice_id);
    }

    public function serachItem(Request $request){
        $validation = Validator::make($request->all(),[
            'search' => 'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);

        return InventoryController::search($request->search);
    }

    public function addBookMove(Request $request){
        $validation = Validator::make($request->all(),[
            'service_id' => 'required|integer',

            'source.lat' => 'required|numeric',
            'source.lng' => 'required|numeric',

            'source.meta.geocode' => 'nullable|string',
            'source.meta.floor' => 'required',
            'source.meta.address_line1' => 'required|string',
            'source.meta.address_line2' => 'required|string',
            'source.meta.city' => 'required|string',
            'source.meta.state' => 'required|string',
            'source.meta.pincode' => 'required|min:6|max:6',
            'source.meta.lift' => 'required|boolean',

            'destination.lat' => 'required|numeric',
            'destination.lng' => 'required|numeric',

            'destination.meta.geocode' => 'nullable|string',
            'destination.meta.floor' => 'required',
            'destination.meta.address_line1' => 'required|string',
            'destination.meta.address_line2' => 'required|string',
            'destination.meta.city' => 'required|string',
            'destination.meta.state' => 'required|string',
            'destination.meta.pincode' => 'required|min:6|max:6',
            'destination.meta.lift' => 'required|boolean',

            'contact_details' => "nullable",
            'contact_details.name'  => 'nullable|string',
            'contact_details.phone'  => 'nullable|min:10|max:10',
            'contact_details.email'  => 'nullable|string',

            'meta.self_booking' => 'required|boolean',
            'meta.subcategory' => 'nullable|string',

            'movement_dates.*' =>'required|date',

            'inventory_items.*.inventory_id' =>'nullable|integer',
            'inventory_items.*.name' =>'nullable|string',
            'inventory_items.*.material' =>'required|string',
            'inventory_items.*.size' =>'required|string',
            'inventory_items.*.quantity' =>'required',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        $req=$request->all();
        $req['meta']['images']=!isset($req['meta']['images']) ? [''] : $req['meta']['images'];

        return BookingsController::createEnquiry($req, Session::get('account')['id'], explode(",", $request->movement_dates), true);
    }

    public function sendToPhone(Request $request){
        $validation = Validator::make($request->all(),[
            'phone' => 'required|min:10|max:10',
            'public_booking_id' => 'string|required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);

        return BookingsController::sendDetailsToPhone($request->public_booking_id, $request->phone);
    }

    public function addReview(Request $request){
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required|string',
            'review.*.question' =>'string|required',
            'review.*.rating' =>'nullable',
            'suggestion'=>'nullable'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);

        return ReviewController::add(Session::get('account')['id'],$request->public_booking_id, $request->review, $request->suggestion);
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

    public function referalSend(Request $request){
        $validation = Validator::make($request->all(),[
            'phone' => 'required|min:10|max:10',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);

        return UserController::sendReferalToPhone(Session::get('account')['id'], $request->phone);
    }
}
