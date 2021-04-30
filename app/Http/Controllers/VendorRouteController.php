<?php

namespace App\Http\Controllers;

use App\Enums\VendorEnums;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\StringFormatter;
use App\Helper;

class VendorRouteController extends Controller
{
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email' => 'required|string',
            'password' => 'required',
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return VendorUserController::login($request->email, $request->password);

    }

    public function forgot_password_send_otp(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'phone' => 'required|max:12|min:10',
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return VendorUserController::phoneVerification($request->phone);
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
            return VendorUserController::verifyOtp($request->otp, $request->phone);
    }

    public function addPrice(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'inventory_id'=>"required|int",
            // 'organization_id'=>"required|int",
            'service_type'=>"required|int",
            'price.*.size' => 'required|string',
            'price.*.material' => 'required|string',
            'price.*.price.economics' => 'nullable',
            'price.*.price.premium' => 'nullable'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return InventoryController::addPrice($request->all());
    }
    public function getInventoryprices(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'inventory_id' => 'required|integer'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return InventoryController::getByInventory($request->inventory_id);
    }

    public function updateInventoryprices(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'price_id' => 'required|integer',
            'inventory_id'=>"required|int",
            // 'organization_id'=>"required|int",
            'service_type'=>"required|int",
            'size' => 'required|string',
            'material' => 'required|string',
            'price.*.price.economics' => 'nullable',
            'price.*.price.premium' => 'nullable'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return InventoryController::updatePrice($request->all());
    }

    public function deleteInventoryprices(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => 'required|integer'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
        return InventoryController::deletePrice($request->id);
    }

    public static function getDrivers($organization_id)
    {
        $get_driver = Vendor::select(["id", "fname", "lname", "phone"])
            ->where("organization_id", $organization_id)
            ->where(["user_role" => VendorEnums::$ROLES['driver']])
            ->get();

        if (!$get_driver)
            return Helper::response(false, "Driver or vehicle data not available");

        return Helper::response(true, "Data fetched successfully", ['drivers' => $get_driver]);
    }

    public static function getVehicles($organization_id)
    {
        $get_vehicle = Vehicle::select(["id", "name", "vehicle_type", "number"])->where("organization_id", $organization_id)
            ->get();

        if (!$get_vehicle)
            return Helper::response(false, "Driver or vehicle data not available");

        return Helper::response(true, "Data fetched successfully", ['vehicles' => $get_vehicle]);
    }
}
