<?php

namespace App\Http\Controllers;

use App\Enums\BidEnums;
use App\Enums\BookingEnums;
use App\Enums\CommonEnums;
use App\Models\Bid;
use App\Models\Booking;
use App\Models\Inventory;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class VendorWebController extends Controller
{
    public function login()
    {
        return view('vendor-panel.login.login');
    }

    public function logout()
    {
        /*Session::forget('sessionActive');
        Session::forget('logged_in');
        Session::forget('account');
        Session::forget('user_role');*/

        Session::flush();
//        session_unset();
        return response()->redirectToRoute('vendor-panel.login.login');
    }

    public function forgotPassword()
    {
        return view('vendor-panel.login.forgotpassword');
    }

    public function verifyOtp(Request $request)
    {
        return view('vendor-panel.login.verifyotp', ['phone'=>$request->phone]);
    }

    public function resetPassword(Request $request)
    {
        $vendor=Vendor::where('id', Crypt::decryptString($request->id))->first();
        return view('vendor-panel.login.reset_password', ['vendor'=>$vendor]);
    }

    public function dashboard()
    {
        return view('vendor-panel.dashboard.dashboard');
    }

    public function bookingType(Request $request)
    {
        $count_booking=Bid::where(['organization_id'=>Session::get('organization_id')])->whereIn('status', [BidEnums::$STATUS['active']])->count();
        $participated_booking=Bid::where(['organization_id'=>Session::get('organization_id')])->whereIn('status', [BidEnums::$STATUS['bid_submitted'], BidEnums::$STATUS['lost']])->count();
        $schedul_booking=Bid::where(['organization_id'=>Session::get('organization_id')])->whereIn('status', [BidEnums::$STATUS['won']])->count();
        $save_booking=Bid::where(['organization_id'=>Session::get('organization_id'), 'bookmarked'=>CommonEnums::$YES])->count();

        $past_booking=Booking::whereIn('id', Bid::where(['organization_id'=>Session::get('organization_id'), 'status'=>BidEnums::$STATUS['won']])->pluck('booking_id'))->whereIn('status', [BookingEnums::$STATUS['completed'], BookingEnums::$STATUS['cancelled']])->count();

        $booking=BookingsController::getBookingsForVendorApp($request, true);

        return view('vendor-panel.order.liveorders', ['bookings'=>$booking, 'type'=>$request->type, 'count_booking'=>$count_booking, 'participated_booking'=>$participated_booking, 'schedul_booking'=>$schedul_booking, 'save_booking'=>$save_booking, 'past_booking'=>$past_booking]);
    }

    public function bookingPastType(Request $request)
    {
        $booking=BookingsController::getBookingsForVendorApp($request, true);

        return view('vendor-panel.order.pastorders', ['bookings'=>$booking]);
    }

    public function userManagement(Request $request)
    {
        $user=VendorUserController::getUser($request, true);

        return view('vendor-panel.user.usermanagement', ['users'=>$user, 'role'=>$request->type]);
    }

    public function inventoryManagement()
    {
        $inventory=Inventory::where(['status'=>CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])->get();
        return view('vendor-panel.inventory.inventorymanagement', ['inventory'=>$inventory]);
    }
}
