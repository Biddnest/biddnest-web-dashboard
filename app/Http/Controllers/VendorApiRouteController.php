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
    public function getBidList(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'org_id' => 'required|integer'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return VendorUserController::getBidList($request->org_id);
    }

    public function addBookmark(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'bid_id' => 'required|integer',
            'org_id' =>'required|integer',
            'vendor_id' =>'required|integer',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return VendorUserController::addBookmark($request->all());
    }

    public function getBookmark(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'org_id' => 'required|integer'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return VendorUserController::getBookmark($request->org_id);
    }

    public function reject(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'bid_id' => 'required|integer',
            'org_id' =>'required|integer',
            'vendor_id' =>'required|integer',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return VendorUserController::reject($request->bid_id, $request->org_id, $request->vendor_id);
    }

    public function addbid(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'bid_id' => 'required|integer',
            'org_id' =>'required|integer',
            'vendor_id' =>'required|integer',

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

        return VendorUserController::submitbid($request->all());
    }



}
