<?php

namespace App\Http\Controllers;

use App\Enums\VendorEnums;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
            return VendorUserController::verifyOtp($request->phone, $request->otp);
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
            return VendorUserController::passwordReset($request->password, $request->bearer);
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
            return VendorUserController::changePassword($request->bearer, $request->old_password, $request->password, $request->password_confirmation);
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

    public function addBid(Request $request){
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

        return BidController::submitBid($request->all(), Session::get('organization_id'), Session::get('id'));
    }

    public function reject(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return BookingsController::reject($request->public_booking_id, Session::get('organization_id'), Session::get('id'));
    }

    public function addBookmark(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return BookingsController::addBookmark($request->public_booking_id,Session::get('organization_id'), Session::get('id'));
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

    public function startTrip(Request $request){
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required',
            'pin' => 'required',
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return BookingsController::startTrip($request->public_booking_id, Session::get('organization_id'), $request->pin);
    }

    public function endTrip(Request $request){
        $validation = Validator::make($request->all(),[
            'public_booking_id' => 'required',
            'pin' => 'required',
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return BookingsController::endTrip($request->public_booking_id, Session::get('organization_id'), $request->pin);
    }

    public function createTickets(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'category' => 'required',
            'heading' => 'required|string',
            'desc' => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return TicketController::create(Session::get('id'), 1, ["category"=>$request->category], $request->heading, $request->desc);
    }

    public function userToggle(Request $request)
    {
        return VendorUserController::updateStatus($request,true);
    }

    public function addVehicle(Request $request){
        $validation = Validator::make($request->all(),[
            'name' => 'required|string',
            'type' => 'required',
            'number' => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return VehicleController::add($request->name,$request->number,$request->type,Session::get('organization_id'));

    }

    public function updateVehicle(Request $request){
        $validation = Validator::make($request->all(),[
            'id' => 'required',
            'name' => 'required|string',
            'type' => 'required',
            'number' => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return VehicleController::update($request->id, $request->name,$request->number,$request->type,Session::get('organization_id'));
    }

    public function deleteVehicle(Request $request)
    {
        return VehicleController::delete($request->id);
    }

    public function addReply(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'ticket_id'=>'required',
            'reply'=>'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return TicketReplyController::addReplyFromVendor(\Illuminate\Support\Facades\Session::get('account')['id'], $request->ticket_id, $request->reply);
    }

    public function adduser(Request $request)
    {
        $validation = Validator::make($request->all(),[
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

        return OrganisationController::addNewRole($request->all(), Session::get('organization_id'));
    }
    public function editUser(Request $request)
    {
        $validation = Validator::make($request->all(),[
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

        return OrganisationController::editNewRole($request->all(), Session::get('account')['id'], $request->role_id);
    }

    public function deleteUser(Request $request)
    {
        return OrganisationController::deleteRole($request->id, Session::get('organization_id'));
    }


    public function branch_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
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

        return OrganisationController::addBranch($request->all(), $request->parent_org_id);
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

}
