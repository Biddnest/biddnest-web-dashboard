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
        $this->middleware(VerifyJwtToken::class)->except(['config','login','loginForApp']);
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

    public function getDriver(Request $request)
    {
        return BookingsController::getDriver($request->token_payload->organization_id);
    }

    public function startTrip(Request $request){
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required',
            'pin' => 'required|integer',
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return BookingsController::startTrip($request->public_booking_id, $request->token_payload->organization_id, $request->pin);
    }

    public function endTrip(Request $request){
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required',
            'pin' => 'required|integer',
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return BookingsController::endTrip($request->public_booking_id, $request->token_payload->organization_id, $request->pin);
    }

    public function getReport(Request $request)
    {
        return ReportController::getReport($request->token_payload->organization_id);
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
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return GeoController::distance($request->source['lat'], $request->source['lng'], $request->destination['lat'], $request->destination['lng']);
    }

    public function createTickets(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'category' => 'required|string',
            'heading' => 'required|string',
            'desc' => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return TicketController::create($request->token_payload->id, 1, ["category"=>$request->category], $request->heading, $request->desc);
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
}
