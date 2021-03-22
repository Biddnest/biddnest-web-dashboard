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

        return VendorUserController::addBookmark($request->public_booking_id, $request->token_payload->organization_id, $request->token_payload->vendor_id);
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

        return BookingsController::reject($request->public_booking_id, $request->token_payload->organization_id);
    }

    public function addBid(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required',

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



}
