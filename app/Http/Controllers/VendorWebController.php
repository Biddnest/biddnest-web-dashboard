<?php

namespace App\Http\Controllers;

use App\Enums\BidEnums;
use App\Enums\BookingEnums;
use App\Enums\CommonEnums;
use App\Models\Bid;
use App\Models\Booking;
use App\Models\Inventory;
use App\Models\Organization;
use App\Models\Payout;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\Vehicle;
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
        return response()->redirectToRoute('vendor.login');
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

    public function Passwordreset(Request $request)
    {
        $vendor=Vendor::where('id', Session::get("account")['id'])->first();
        return view('vendor-panel.dashboard.reset_password', ['vendor'=>$vendor]);
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
    public function sidebar_userManagement(Request $request)
    {
        $user=Vendor::where('id', $request->id)->with('organization')->first();
        return view('vendor-panel.user.userrole_sidebar', ['user'=>$user]);
    }

    public function inventoryManagement()
    {
        $inventory=Inventory::where(['status'=>CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])->get();
        return view('vendor-panel.inventory.inventorymanagement', ['inventories'=>$inventory]);
    }

    public function inventoryCetegory(Request $request)
    {
        $inventory=Inventory::where(['status'=>CommonEnums::$YES, 'deleted'=>CommonEnums::$NO, 'category'=>$request->type])->get();
        return view('vendor-panel.inventory.inventorybycategory', ['inventories'=>$inventory, 'type'=>$request->type]);
    }

    public function inventorySidebar(Request $request)
    {
        $inventory=Inventory::where('id', $request->id)->with(['prices'=>function($query){
            $query->where('organization_id', Session::get('organization_id'));
        }])->get();
        return view('vendor-panel.inventory.inventorysidebar', ['inventories'=>$inventory]);
    }

    public function getBranches()
    {
        $home_branch =Organization::where('id', Session::get('organization_id'))->with('admin')->first();

        if($home_branch->parent_org_id)
            $branch = Organization::where('parent_org_id', $home_branch->parent_org_id)->orWhere('id', $home_branch->parent_org_id)->where('id', '!=', $home_branch->id)->with('admin')->paginate(CommonEnums::$PAGE_LENGTH);
        else
            $branch =Organization::where("parent_org_id", $home_branch->id)->with('admin')->paginate(CommonEnums::$PAGE_LENGTH);

        return view('vendor-panel.branch.getbranch', ['branches'=>$branch, 'home_branch'=>$home_branch]);
    }

    public function getVehicle(Request $request)
    {
        $exist_vehicle=null;
        if($request->id)
        {
            $exist_vehicle=Vehicle::where('id', $request->id)->first();
        }
        $vehicle = Vehicle::where(['organization_id'=>Session::get('organization_id'), 'deleted'=>CommonEnums::$NO])->get();
        return view('vendor-panel.vehicle.getvehicle', ['vehicles'=>$vehicle, 'exist_vehicle'=>$exist_vehicle]);
    }

    public function payout(Request $request)
    {
        $payout=PayoutController::getByOrganization($request, true);
        return view('vendor-panel.payout.payout', ['payouts'=>$payout]);
    }

    public function payoutSidebar(Request $request)
    {
        $payout=Payout::where("id", $request->id)->with(['organization'=>function($query){
            $query->with('booking');
        }])->first();
        return view('vendor-panel.payout.sidebar', ['payout'=>$payout]);
    }

    public function serviceRequest(Request $request)
    {
        $tickets=Ticket::where(['vendor_id'=>Session::get('account')['id']])->paginate(CommonEnums::$PAGE_LENGTH);
        return view('vendor-panel.tickets.servicerequest', ['tickets'=>$tickets, 'type'=>$request->type]);
    }

    public function serviceSidebar(Request $request)
    {
        $ticket=Ticket::where('id', $request->id)->with('reply')->first();
        $replies=TicketReply::where('ticket_id', $request->id)->with('admin')->with('user')->with('vendor')->limit('2')->get();
        return view('vendor-panel.tickets.servicesidebar', ['tickets'=>$ticket, 'replies'=>$replies]);
    }

    public function profile(Request $request)
    {
        $user=Vendor::where('id', $request->id)->with(['organization'=>function($query) use($request){
            $query->with('services');
        }])->first();

        if($user->organization->parent_org_id)
            $parentbranch = Organization::where('id', $user->organization->parent_org_id)->first();
        else
            $parentbranch =Organization::where("id", $user->organization->id)->first();

        return view('vendor-panel.dashboard.myprofile', ['user'=>$user, 'branch'=>$parentbranch]);
    }
}
