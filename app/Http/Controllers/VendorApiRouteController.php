<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Middleware\VerifyJwtToken;
use App\StringFormatter;
use App\Helper;

class VendorApiRouteController extends Controller
{

    public function __construct(){
        $this->middleware(VerifyJwtToken::class)->except(['config','login','loginForApp','phoneVerification','verifyOtp','resetPassword']);
    }

    public function loginForApp(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'username' => 'required|string',
            'password' =>'required'
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return VendorUserController::loginForApp($request->username, $request->password);
    }

    public function resetPin(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'pin' => 'required|digits:4',
            'password' =>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return VendorUserController::resetPin($request->pin, $request->password, $request->token_payload->id);

    }

    public function checkPin(Request $request)
    {
        return VendorUserController::checkPin($request->token_payload->id);
    }

    public function phoneVerification(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'phone' => 'required|min:10'
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return VendorUserController::phoneVerification($request->phone);
    }

    public function verifyOtp(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'phone' => 'required|min:10',
            'otp' => 'required|numeric'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return VendorUserController::verifyOtp($request->phone, $request->otp);
    }

    public function resetPassword(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'phone' => 'required|min:10',
            'otp' => 'required|numeric',
            'new_password' => 'required',
            'confirm_password' => 'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return VendorUserController::resetPassword($request->phone, $request->otp, $request->new_password, $request->confirm_password);
    }

    public function changePassword(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return VendorUserController::changePassword($request->token_payload->id, $request->current_password, $request->new_password, $request->confirm_password);
    }
    /*bid API */

    public function getBookingsforApp(Request $request)
    {
        // $validation = Validator::make($request->all(),[
        //     // 'type'=> 'required|string'
        // ]);

        // if($validation->fails())
        //     return Helper::response(false,"validation failed", $validation->errors(), 400);

        return BookingsController::getBookingsForVendorApp($request);
    }

    public function getBookingsForDriverApp(Request $request)
    {
        return BookingsController::getBookingsForDriverApp($request);
    }

    public function addBookmark(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return BookingsController::addBookmark($request->public_booking_id, $request->token_payload->organization_id, $request->token_payload->id);
    }

    public function getBookingById(Request $request)
    {
            $validation = Validator::make($request->all(),[
                'public_booking_id' => 'required'
            ]);

            if($validation->fails())
                return Helper::response(false,"validation failed", $validation->errors(), 400);

        return BookingsController::getByIdForVendorApp($request);
    }

    public function reject(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return BookingsController::reject($request->public_booking_id, $request->token_payload->organization_id, $request->token_payload->id);
    }

    public function addBid(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required',
            'pin' =>'required|integer',
            'inventory.*.booking_inventory_id'=>'required|integer',
            'inventory.*.amount'=>'required',

            'bid_amount'=>'required',
            'type_of_movement'=>'required|string',
            'moving_date'=>'required',
            'vehicle_type'=>'required|string',

            'man_power.min'=>'required|integer',
            'man_power.max'=>'required|integer'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return BidController::submitBid($request->all(), $request->token_payload->organization_id, $request->token_payload->id);
    }

    public function getPriceList(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return BidController::getPriceList($request->public_booking_id, $request->token_payload->organization_id);
    }


    /*Need org_id check in below function*/
    public function assignDriver(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required',
            'driver_id' => 'required|integer',
            'vehicle_id' => 'required|integer'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

            return BookingsController::assignDriver($request->public_booking_id, $request->driver_id, $request->vehicle_id);
    }

    public function getDrivers(Request $request)
    {
        return VehicleController::getDrivers($request->token_payload->organization_id);
    }

    public function getVehicles(Request $request)
    {
        return VehicleController::getVehicles($request->token_payload->organization_id);
    }

    public function startTrip(Request $request){
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required',
            'pin' => 'required',
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return BookingsController::startTrip($request->public_booking_id, $request->token_payload->organization_id, $request->pin);
    }

    public function endTrip(Request $request){
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required',
            'pin' => 'required',
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return BookingsController::endTrip($request->public_booking_id, $request->token_payload->organization_id, $request->pin);
    }

    public function getReport(Request $request)
    {
        return ReportController::getReport($request->token_payload->organization_id);
    }

    public function createTickets(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id'=>"nullable|string",
            'category' => 'required',
            'heading' => 'required|string',
            'desc' => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return TicketController::create($request->token_payload->id, 1, ["category"=>$request->category, "public_booking_id"=>$request->public_booking_id], $request->heading, $request->desc);
    }

    public function getUser(Request $request)
    {
        return VendorUserController::getUser($request);
    }

    public function statusUpdate(Request $request)
    {
        return VendorUserController::updateStatus($request);
    }

    public function config(Request $request){
        return VendorApp\SettingsController::getSettings();
    }

    public function addNotificationVendorPlayer(Request $request){
        $validation = Validator::make($request->all(),[
            'player_id' => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);


        return NotificationController::saveVendorPlayer($request->player_id, $request->token_payload->id);
    }

    public function faqCategories(Request $request){
        return FaqController::getCategories();
    }

    public function faqByCategory(Request $request){
        return FaqController::getByCategory($request->category);
    }

    public function getPage(Request $request){
        return PageController::get($request->slug);
    }

    public function updateOrganization(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'organization_name' => 'required|string',
            'organization_desc' => 'required|string',
            'secondory_cont_no' => 'nullable|min:10|max:10',
            'gstin_no' => 'required|string|min:15|max:15'
        ]);

        //        print_r($request->token_data_id);exit;
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->getMessageBag(), 400);

        return VendorUserController::updateOrganization($request->token_payload->id, $request->token_payload->organization_id, $request->organization_name, $request->organization_desc, $request->secondory_cont_no, $request->gstin_no);
    }

    public function updateLocation(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'address_line1' => 'required|string',
            'address_line2' => 'required|string',
            'landmark' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'pincode'=> 'required|min:6|max:6'
        ]);

        //        print_r($request->token_data_id);exit;
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->getMessageBag(), 400);

        return VendorUserController::updateLocation($request->token_payload->id, $request->token_payload->organization_id, $request->address_line1, $request->address_line2, $request->landmark, $request->city, $request->state, $request->pincode);
    }

    public function updateDetails(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'commission' => 'required',
            'status' => 'required|integer',
            'service_type' => 'required|string'
        ]);

        //        print_r($request->token_data_id);exit;
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->getMessageBag(), 400);

        return VendorUserController::updateDetails($request->token_payload->id, $request->token_payload->organization_id, $request->commission, $request->status, $request->service_type, $request->vendor_status);
    }

    public function updateProfile(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'image' => 'nullable|string',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required',
            'phone' => 'required|min:10|max:10'
        ]);

        //        print_r($request->token_data_id);exit;
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->getMessageBag(), 400);

        return VendorUserController::updateProfile($request->image, $request->token_payload->id, $request->fname, $request->lname, $request->email, $request->phone);
    }

    public function getBranch(Request $request)
    {
        return OrganisationController::getBranch($request->token_payload->organization_id);
    }

    public function getPayout(Request $request)
    {
        return PayoutController::getByOrganization($request);
    }

    public function getposition(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required'
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->getMessageBag(), 400);

        return BookingsController::getposition($request->token_payload->id, $request->public_booking_id);
    }

    public function verifyAuth(Request $request)
    {
        return VendorUserController::verifyAuth($request->token_payload->id);
    }

    public function startWatchOnBookingSocket(Request $request)
    {
        return BookingsController::startVendorWatch($request->all());
    }

    public function stopWatchOnBookingSocket(Request $request)
    {
        return BookingsController::stopVendorWatch($request->all());
    }

    public function getBookingDropdown(Request $request)
    {
        return BookingsController::getBookingsByVendor($request->token_payload->id, 10);
    }

    public function getTickets(Request $request)
    {
        return TicketController::get($request->token_payload->id);
    }

    public function callBack(Request $request)
    {
        return TicketController::createForVendor($request->token_payload->id, 4, ["public_booking_id"=>null]);
    }
}
