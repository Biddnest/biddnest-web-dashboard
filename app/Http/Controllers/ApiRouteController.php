<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\VerifyJwtToken;
use App\StringFormatter;
use App\Enums\TicketEnums;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Nullable;


/**
 * Class ApiRouteController
 * @package App\Http\Controllers
 */
class ApiRouteController extends Controller
{
    /**
     * ApiRouteController constructor.
     */
    public function __construct(){
        $this->middleware(VerifyJwtToken::class)->except(['config','login','verifyLoginOtp','vendorConfig']);
    }

    /**
     * @param Request $request
     * @return JsonResponse|object
     */
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'phone' => 'required|string|min:10'
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
            return UserController::login($request->phone);

    }

    /**
     * @param Request $request
     * @return JsonResponse|object
     */
    public function verifyLoginOtp(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'phone' => 'required|string|min:10',
            'otp' => 'required|numeric'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
            return UserController::verifyLoginOtp($request->phone, $request->otp);

    }

    /**
     * @param Request $request
     * @return JsonResponse|object
     */
    public function signupUser(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'phone' => 'required|string|max:12',
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
            return UserController::signupUser($request->token_payload->id, $formatedRequest->fname, $formatedRequest->lname, $formatedRequest->email, $formatedRequest->gender, $request->referral_code);

    }

    /**
     * @param Request $request
     * @return JsonResponse|object
     */
    public function updateProfile(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'fname' => 'required|string|max:50',
            'lname' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'gender' => 'required|string|max:6',
            'dob' => 'required|date',
            'avatar'=> 'nullable|string'
        ]);

        $formatedRequest = StringFormatter::format($request->all(),[
            'fname' => 'capitalizeFirst',
            'lname' => 'capitalizeFirst',
            'gender' => 'lowercase',
            'email' => 'lowercase',
            'dob' => 'date'
        ]);

        //        print_r($request->token_data_id);exit;
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->getMessageBag(), 400);
        else
            return UserController::update($request->token_payload->id, $formatedRequest->fname, $formatedRequest->lname, $formatedRequest->email, $formatedRequest->gender, $formatedRequest->dob, $request->avatar);

    }

    public function getAppSliders(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'lat' => 'required',
            'lng' => 'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
        {
            if($request->type=="app")
            {
                return UserController::getAppSliders($request->lat, $request->lng);
            }
            else{
                return UserController::getAppSliderstab($request->lat, $request->lng);
            }

        }

    }

    public function getServices(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'lat' => 'required',
            'lng' => 'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
            return ServiceController::getForApp($request->lat, $request->lng);
    }

    public function getSubServices(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'service_id' => 'required|integer'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
            return SubServiceController::getSubservicesForApp($request->service_id);
    }

    public function getInventories(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'subservice_id' => 'required|integer'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
            return InventoryController::getBySubserviceForApp($request->subservice_id);
    }

    public function getAllInventories()
    {
        return InventoryController::getInventoriesForApp();
    }

    public function createEnquiry(Request $request)
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

            'contact_details' => "nullable",
            'contact_details.name'  => 'nullable|string',
            'contact_details.phone'  => 'nullable|min:10|max:10',
            'contact_details.email'  => 'nullable|string',

            'meta.self_booking' => 'required|boolean',
            'meta.subcategory' => 'nullable|string',
            'meta.images.*' => 'required|string',

            'movement_dates.*' =>'required|date',

            'inventory_items.*.inventory_id' =>'nullable|integer',
            'inventory_items.*.name' =>'nullable|string',
            'inventory_items.*.material' =>'required|string',
            'inventory_items.*.size' =>'required|string',
            'inventory_items.*.quantity' =>'required',
            ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
            return BookingsController::createEnquiry($request->all(), $request->token_payload->id, $request->movement_dates);
    }

    public function confirmBooking(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'service_type' => 'required|string',
            'public_booking_id' => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
            return BookingsController::confirmBooking($request->public_booking_id, $request->service_type, $request->token_payload->id);
    }

    /*public function cancelBooking(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'reason' => 'required|string',
            'desc' => 'required|string',
            'public_booking_id' => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
            return BookingsController::cancelBooking($request->public_booking_id, $request->reason, $request->desc, $request->token_payload->id);
    }*/

    public function getBookingByPublicId(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
            return BookingsController::getBookingByPublicIdForApp($request->id,$request->token_payload->id);
    }

    /*public function reschedul(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required|string',
            'movement_dates.*' =>'required|date'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);

        return BookingsController::reschedulBooking($request->public_booking_id, $request->movement_dates, $request->token_payload->id);
    }*/

    public function getBookingHistoryEnquiry(Request $request)
    {
        return BookingsController::bookingHistoryEnquiry($request->token_payload->id);
    }

    public function getBookingHistoryPast(Request $request)
    {
        return BookingsController::bookingHistoryPast($request->token_payload->id);
    }

    public function getBookingHistoryLive(Request $request)
    {
        return BookingsController::bookingHistoryLive($request->token_payload->id);
    }

    public function finalquote(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
            return BookingsController::getfinalquote($request->public_booking_id, $request->token_payload->id);
    }

    public function paymentDetails(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
            return BookingsController::getPaymentDetails($request->public_booking_id);
    }

    public function verifyCoupon(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required|string',
            'coupon_code' =>'string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);

         $valid= CouponController::checkIfValid($request->public_booking_id, $request->coupon_code);

        if(is_array($valid))
            return Helper::response(true,"valid Coupon", $valid);
        else
            return Helper::response(false,$valid);
    }

    public function intiatePayment(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required|string',
            'coupon_code' =>'string|nullable',
            'moving_date' =>'date'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);

        return PaymentController::intiatePayment($request->public_booking_id, $request->moving_date, $request->coupon_code);
    }

    public function config(Request $request){
        return CustomerApp\SettingsController::getSettings();
    }

    public function getPage(Request $request){
        return PageController::get($request->slug);
    }

    public function addReview(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required|string',
            'review.*.question' =>'string|required',
            'review.*.rating' =>'nullable',
            'suggestion'=>'nullable'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);

        return ReviewController::add($request->token_payload->id,$request->public_booking_id, $request->review, $request->suggestion);
    }

    public function faqCategories(Request $request){
        return FaqController::getCategories();
    }

    public function faqByCategory(Request $request){
        return FaqController::getByCategory($request->category);
    }

    public function addNotificationUserPlayer(Request $request){
        $validation = Validator::make($request->all(),[
            'player_id' => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);


            return NotificationController::saveCustomerPlayer($request->player_id, $request->token_payload->id);
    }

    public function createRescheduleTicket(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required|string',
            // 'heading' => 'required|string',
            // 'desc' => 'required|string',
            // 'ticket_type'=>'required|integer'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);

        return TicketController::create($request->token_payload->id, 3,  ["public_booking_id"=>$request->public_booking_id]);
    }

    public function createCancellationTicket(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required|string',
             'reason' => 'required|string',
             'desc' => 'required|string',
            // 'ticket_type'=>'required|integer'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);

        return TicketController::create($request->token_payload->id,TicketEnums::$TYPE['order_cancellation'],  ["public_booking_id"=>$request->public_booking_id]);
    }

    public function createRejectedTicket(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required|string',
             'reason' => 'required|string',
             'desc' => 'required|string',
             'request_callback'=>'nullable'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);

        return BookingsController::rejectBooking($request->token_payload->id, $request->public_booking_id, $request->reason, $request->desc, $request->request_callback);
    }

    public function getTickets(Request $request)
    {
        return TicketController::get($request->token_payload->id);
    }

    public function createTickets(Request $request)
    {
        $validation = Validator::make($request->all(),[
//            'public_booking_id'=>"required|string",
            'category'=>'required',
            'heading' => 'required|string',
            'desc' => 'required|string',
            'images.*'=>'nullable'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);

        return TicketController::createForUserApp($request->token_payload->id, $request->category, ["public_booking_id"=>$request->public_booking_id], $request->images, $request->heading, $request->desc);
    }

    public function getRecentBooking(Request $request)
    {
        return BookingsController::getRecentBooking($request->token_payload->id);
    }

    public function callBack(Request $request)
    {
        return TicketController::create($request->token_payload->id, 4, ["public_booking_id"=>null]);
    }

    public function addReply(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'ticket_id'=>'required',
            'reply'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);

        return TicketController::addReplyFromUser($request->token_payload->id, $request->ticket_id, $request->reply);
    }

    public function getDetails(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);

        return TicketController::getOneForUserApp($request->token_payload->id, $request->id);
    }

    public function statusComplete(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required|string',
            'payment_id' => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);

        return PaymentController::statusComplete($request->token_payload->id, $request->public_booking_id, $request->payment_id);
    }

    public function contactUs(Request $request)
    {
        return PageController::contactUs();
    }

    public function getDistance(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'source.lat' => 'required',
            'source.lng' => 'required',
            'destination.lat' => 'required',
            'destination.lng' => 'required'
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);

        return Helper::response(true, "Here is the distance", ["distance" => GeoController::distance($request->source['lat'], $request->source['lng'], $request->destination['lat'], $request->destination['lng'])]);
    }

    public function getCouponsForBooking(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'public_booking_id' => 'required'
        ]);
        if ($validation->fails())
            return Helper::response(false, "validation failed", implode(",",$validation->messages()->all()), 400);

        return CouponController::getAvailableCouponsForBooking($request->public_booking_id);
    }

    public function verifyAuth(Request $request)
    {
        return UserController::verifyAuth($request->token_payload->id);
    }

    public function getZones(Request $request)
    {
        return ZoneController::get();
    }

    public function updateMobile(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'phone' => 'required'
        ]);
        if ($validation->fails())
            return Helper::response(false, "validation failed", implode(",",$validation->messages()->all()), 400);

        return UserController::updateMobile($request->token_payload->id, $request->phone);
    }

    public function verifyOtp(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'phone' => 'required',
            'otp' => 'required'
        ]);
        if ($validation->fails())
            return Helper::response(false, "validation failed", implode(",",$validation->messages()->all()), 400);

        return UserController::verifyMobile($request->token_payload->id, $request->phone, $request->otp);
    }

    public function getTestimonials()
    {
        return TestimonialController::get();
    }

    public function updateFreshChatRestoreID(Request $request){
        $validation = Validator::make($request->all(),[
            'freshchat_restore_id' => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);


        return UserController::updateFreshChatId($request->token_payload->id,$request->freshchat_restore_id);
    }

    public function getBookingDropdown(Request $request)
    {
        return BookingsController::getBookingsByUser($request->token_payload->id, 10);
    }

    public function getNotifications(Request $request)
    {
        return NotificationController::getNotifications($request->token_payload->id);
    }

    public function createBookingTrack(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'service_id' => 'integer',

            'source.lat' => 'nullable|numeric',
            'source.lng' => 'nullable|numeric',

            'source.meta.geocode' => 'nullable|string',
            'source.meta.floor' => 'nullable|integer',
            'source.meta.address_line1' => 'nullable|string',
            'source.meta.address_line2' => 'nullable|string',
            'source.meta.city' => 'nullable|string',
            'source.meta.state' => 'nullable|string',
            'source.meta.pincode' => 'nullable|min:6|max:6',
            'source.meta.lift' => 'nullable|boolean',

            'destination.lat' => 'nullable|numeric',
            'destination.lng' => 'nullable|numeric',

            'destination.meta.geocode' => 'nullable|string',
            'destination.meta.floor' => 'nullable|integer',
            'destination.meta.address_line1' => 'nullable|string',
            'destination.meta.address_line2' => 'nullable|string',
            'destination.meta.city' => 'nullable|string',
            'destination.meta.state' => 'nullable|string',
            'destination.meta.pincode' => 'nullable|min:6|max:6',
            'destination.meta.lift' => 'nullable|boolean',

            'contact_details' => "nullable",
            'contact_details.name'  => 'nullable|string',
            'contact_details.phone'  => 'nullable|min:10|max:10',
            'contact_details.email'  => 'nullable|string',

            'meta.self_booking' => 'required|boolean',
            'meta.subcategory' => 'nullable|string',
            'meta.images.*' => 'string',

            'movement_dates.*' =>'nullable|date',

            'inventory_items.*.inventory_id' =>'nullable|integer',
            'inventory_items.*.name' =>'nullable|string',
            'inventory_items.*.material' =>'nullable|string',
            'inventory_items.*.size' =>'nullable|string',
            'inventory_items.*.quantity' =>'nullable|integer',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
            return BookingsController::createTrack($request->all(), $request->token_payload->id, $request->movement_dates);
    }

    public function trackCustomer(Request $request){
        $validation = Validator::make($request->all(),[
            'contact_details' => "nullable",
            'contact_details.name'  => 'nullable|string',
            'contact_details.phone'  => 'nullable|min:10|max:10',
            'contact_details.email'  => 'nullable|string',

            'meta.self_booking' => 'required|boolean',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
            return BookingsController::trackCustomerData($request->all(), $request->token_payload->id);
    }

    public function trackSource(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'string',
            'service_id' => 'integer',

            'source.lat' => 'nullable|numeric',
            'source.lng' => 'nullable|numeric',

            'source.meta.geocode' => 'nullable|string',
            'source.meta.floor' => 'nullable|integer',
            'source.meta.address_line1' => 'nullable|string',
            'source.meta.address_line2' => 'nullable|string',
            'source.meta.city' => 'nullable|string',
            'source.meta.state' => 'nullable|string',
            'source.meta.pincode' => 'nullable|min:6|max:6',
            'source.meta.lift' => 'nullable|boolean',

        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
            return BookingsController::trackSourceData($request->all(), $request->token_payload->id);
    }

    public function trackDestination(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'string',

            'destination.lat' => 'nullable|numeric',
            'destination.lng' => 'nullable|numeric',

            'destination.meta.geocode' => 'nullable|string',
            'destination.meta.floor' => 'nullable|integer',
            'destination.meta.address_line1' => 'nullable|string',
            'destination.meta.address_line2' => 'nullable|string',
            'destination.meta.city' => 'nullable|string',
            'destination.meta.state' => 'nullable|string',
            'destination.meta.pincode' => 'nullable|min:6|max:6',
            'destination.meta.lift' => 'nullable|boolean',

        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
            return BookingsController::trackDestinationData($request->all(), $request->token_payload->id);
    }

    public function trackDates(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'string',
            'movement_dates.*' =>'nullable|date'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
            return BookingsController::getDateTrack($request->all(), $request->token_payload->id, $request->movement_dates);
    }

    public function trackInventory(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'string',

            'meta.subcategory' => 'nullable|string',
            'meta.images.*' => 'string',

            'inventory_items.*.inventory_id' =>'nullable|integer',
            'inventory_items.*.name' =>'nullable|string',
            'inventory_items.*.material' =>'nullable|string',
            'inventory_items.*.size' =>'nullable|string',
            'inventory_items.*.quantity' =>'nullable',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", implode(",",$validation->messages()->all()), 400);
        else
            return BookingsController::trackInventoryData($request->all(), $request->token_payload->id);
    }

    public function getRewardPointsBalance(Request $request){
        return RewardPointController::getUserBalance($request->token_payload->id);
    }

    public function getRewardPointsLedger(Request $request){
        return RewardPointController::getUserLedger($request);
    }

    public function getVouchers(Request $request){
        return VoucherController::getUserVouchers($request->token_payload->id);
    }

}
