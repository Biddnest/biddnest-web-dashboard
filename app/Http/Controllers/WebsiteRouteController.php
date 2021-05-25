<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\UserController;
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
            'image'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return UserController::update($request->id, $request->fname, $request->lname, $request->email, $request->gender, $request->dob, $request->image, $request->phone);
    }

    public function addTicket(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'category'=>'required',
            'heading' => 'required|string',
            'desc' => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return TicketController::createForUserApp(Session::get('account')['id'], $request->category, [], $request->heading, $request->desc);
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

        return TicketController::create(Session::get('account')['id'], 2,  ["public_booking_id"=>$request->data]);
    }

    public function addRejectTicket(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required|string',
             'heading' => 'required|string',
             'desc' => 'required|string',
            // 'ticket_type'=>'required|integer'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return TicketController::create(Session::get('account')['id'], 2,  ["public_booking_id"=>$request->public_booking_id], $request->heading, $request->desc);
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
}
