<?php

namespace App\Http\Controllers;

use App\Enums\BidEnums;
use App\Enums\BookingEnums;
use App\Enums\CommonEnums;
use App\Enums\PayoutEnums;
use App\Enums\VendorEnums;
use App\Models\Bid;
use App\Models\Booking;
use App\Models\BookingDriver;
use App\Models\Inventory;
use App\Models\InventoryPrice;
use App\Models\Organization;
use App\Models\Payout;
use App\Models\Service;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\Vehicle;
use App\Models\Vendor;
use App\Models\Zone;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
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
        $count_live=Bid::where(['status'=>BidEnums::$STATUS['active'], 'organization_id'=>Session::get('organization_id')])->count();
        $count_ongoing= Bid::where(['status'=>BidEnums::$STATUS['bid_submitted'], 'vendor_id'=>Session::get('account')['id']])->count();
        $count_won= Bid::where(['status'=>BidEnums::$STATUS['won'], 'vendor_id'=>Session::get('account')['id']])->count();
        $count_branch=Organization::where("id", Session::get('account')['id'])->orWhere("parent_org_id", Session::get('account')['id'])->count();
        $count_emp=Vendor::where('organization_id', Session::get('organization_id'))->count();
        $total_revenue =Payout::where('organization_id', Session::get('organization_id'))->sum('final_payout');

        $booking_live= Booking::whereIn('status', [BookingEnums::$STATUS['biding'], BookingEnums::$STATUS['rebiding']])->latest()->limit(3)->get();

        $dataset = [];
        $this_week = CarbonPeriod::create( Carbon::now()->subDays(7)->format("Y-m-d"),Carbon::now()->format("Y-m-d"))->toArray();
        $last_week = CarbonPeriod::create( Carbon::now()->subDays(14)->format("Y-m-d"), Carbon::now()->subDays(7)->format("Y-m-d"))->toArray();

        $this_week_sale = [];
        $last_week_sale = [];
        foreach ($this_week as $key=>$date){
            $date1 = $date->format('Y-m-d');
            $this_week[$key] = $date->format('d M');
            $this_week_sale[] = Booking::whereDate("created_at",$date1)->where('organization_id', Session::get('organization_id'))
                ->whereDate("status",">=",BookingEnums::$STATUS['pending_driver_assign'])
                ->sum("final_quote");
        }
        foreach ($last_week as $key=>$date){
            $date1 = $date->format('Y-m-d');
//            $last_week[$key] = $date->format('d M');
            $last_week_sale[] = Booking::whereDate("created_at",$date1)->where('organization_id', Session::get('organization_id'))
                ->whereDate("status",">=",BookingEnums::$STATUS['pending_driver_assign'])
                ->sum("final_quote");
        }

        $order_dist =  Booking::select('status', DB::raw("count(*) AS count"))->where('organization_id', Session::get('organization_id'))->groupBy('status')->get();
        return view('vendor-panel.dashboard.dashboard',['count_live'=>$count_live, 'count_ongoing'=>$count_ongoing, 'count_won'=>$count_won, 'count_branch'=>$count_branch, 'count_emp'=>$count_emp, 'total_revenue'=>$total_revenue, 'booking_live'=>$booking_live,
            'graph'=>[
                "revenue"=>[
                    "this_week"=>[
                        "dates"=>$this_week,
                        "sales"=>$this_week_sale
                    ],
                    "last_week"=>[
                        "dates"=>$this_week,
                        "sales"=>$last_week_sale
                    ],
                ],
                "order_distribution" => count($order_dist) ? $order_dist :
                    [
                        [
                    "status"=>5,
                    "count"=>0
                        ],[
                    "status"=>6,
                    "count"=>0
                        ],[
                    "status"=>7,
                    "count"=>0
                        ],[
                    "status"=>8,
                    "count"=>0
                        ],
                        [
                            "status"=>8,
                    "count"=>0
                        ]
                    ]
            ]]);
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

    public function bookingRejectType(Request $request)
    {
        $booking=BookingsController::getBookingsForVendorApp($request, true);

        return view('vendor-panel.order.rejectedorders', ['bookings'=>$booking]);
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

    public function inventoryManagement(Request $request)
    {
        $inventory = Inventory::where([ 'status' => CommonEnums::$YES, 'deleted' => CommonEnums::$NO ])
            ->whereIn("id", InventoryPrice::where("organization_id",Session::get('organization_id'))->groupBy("inventory_id")
                ->pluck("inventory_id"));

            if($request->search){
                $inventory =$inventory->where("name", 'like', "%".$request->search."%");
            }
        $inventory =$inventory->get();

        return view('vendor-panel.inventory.inventorymanagement', ['inventories'=>$inventory]);
    }

    public function inventoryCetegory(Request $request)
    {
        $inventory=Inventory::where(['status'=>CommonEnums::$YES, 'deleted'=>CommonEnums::$NO, 'category'=>$request->type])
            ->whereIn("id", InventoryPrice::where("organization_id",Session::get('organization_id'))
            ->groupBy("inventory_id")
            ->pluck("inventory_id"));

        if($request->search){
            $inventory =$inventory->where("name", 'like', "%".$request->search."%");
        }

        $inventory =$inventory->get();

        return view('vendor-panel.inventory.inventorybycategory', ['inventories'=>$inventory, 'type'=>$request->type]);
    }

    public function inventorySidebar(Request $request)
    {
        $inventory=Inventory::where(['id'=>$request->id, 'deleted'=>CommonEnums::$NO])->with(['prices'=>function($query){
            $query->where(['organization_id'=>Session::get('organization_id'),'deleted'=>CommonEnums::$NO]);
        }])->first();
        $service_types=InventoryPrice::select('service_type')->where(['inventory_id'=>$request->id, 'deleted'=>CommonEnums::$NO])->where('organization_id', Session::get('organization_id'))->groupBy('service_type')->with('service')->get();
        return view('vendor-panel.inventory.inventorysidebar', ['inventories'=>$inventory, "service_types"=>$service_types]);
    }

    public function getBranches(Request $request)
    {
        $home_branch =Organization::where('id', Session::get('organization_id'))->with('admin')->first();

        if($home_branch->parent_org_id) {
            $branch = Organization::where('parent_org_id', $home_branch->parent_org_id)->orWhere('id', $home_branch->parent_org_id)->where('id', '!=', $home_branch->id);
            if(isset($request->search)){
                $branch=$branch->where('phone', 'like', $request->search."%")
                    ->where('city', 'like', "%".$request->search."%");
            }
            $branch =$branch->with('admin')->paginate(CommonEnums::$PAGE_LENGTH);
        }
        else {
            $branch = Organization::where("parent_org_id", $home_branch->id);
            if(isset($request->search)){
                $branch=$branch->where('phone', 'like', $request->search."%")
                    ->where('city', 'like', "%".$request->search."%");
            }
            $branch = $branch->with('admin')->paginate(CommonEnums::$PAGE_LENGTH);
        }

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
        $payout_schedule=Payout::where(["organization_id"=>Session::get('organization_id'), "status"=>PayoutEnums::$STATUS['scheduled']])->count();
        $payout_fail=Payout::where(["organization_id"=>Session::get('organization_id'), "status"=>PayoutEnums::$STATUS['suspended']])->count();
        return view('vendor-panel.payout.payout', ['payouts'=>$payout, 'payout_schedule'=>$payout_schedule, 'payout_fail'=>$payout_fail]);
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
        $tickets=Ticket::where(['vendor_id'=>Session::get('account')['id']]);
        if(isset($request->search)){
            $tickets=$tickets->where('heading', 'like',"%".$request->search."%");
        }
        $tickets=$tickets->paginate(CommonEnums::$PAGE_LENGTH);
        return view('vendor-panel.tickets.servicerequest', ['tickets'=>$tickets, 'type'=>$request->type]);
    }

    public function serviceSidebar(Request $request)
    {
        $ticket=Ticket::where('id', $request->id)->with('reply')->orderBy('id', 'DESC')->first();
        $replies=TicketReply::where('ticket_id', $request->id)->with('admin')->with('vendor')->latest()->take(2)->get();

        return view('vendor-panel.tickets.servicesidebar', ['ticket'=>$ticket, 'replies'=>$replies]);
    }

    public function serviceSidebar_reply(Request $request)
    {
        $ticket=Ticket::where('id', $request->id)->with('reply')->first();
        $replies=TicketReply::where('ticket_id', $request->id)->with('admin')->with('vendor')->get();

        return view('vendor-panel.tickets.reply', ['tickets'=>$ticket, 'replies'=>$replies]);
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

   public function userAdd(Request $request)
    {
        $users = Vendor::where("id", $request->id)->first();
        $branch = Organization::where(["parent_org_id"=>Session::get('organization_id'), "status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->orWhere("id", Session::get('organization_id'))->get();
        return view('vendor-panel.user.add_user',['id'=>$request->id, 'roles'=>$users, 'branches'=>$branch]);
    }

    public function addBranch(Request $request)
    {
        $branch = Organization::where(["id"=>$request->id, "deleted"=>CommonEnums::$NO])->with('services')->first();
        $zones=Zone::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        $organization = Organization::where(["id"=>Session::get('organization_id'), "deleted"=>CommonEnums::$NO])->first();
        $services = Service::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        return view('vendor-panel.branch.add_branch', ['id'=>Session::get('organization_id'), 'services'=>$services, 'organization'=>$organization, 'zones'=>$zones, 'branch'=>$branch]);
    }

    public function serviceRequestAdd()
    {
        $past_bookings = BookingsController::getBookingsByVendor(Session::get('account')['id'], 15, true);
        return view('vendor-panel.tickets.add_ticket', ["past_bookings"=>$past_bookings]);
    }

    public function bookingDetails(Request $request)
    {
        $booking=Booking::where('public_booking_id', $request->id)->with('inventories')->with('service')->with(['movement_dates'=>function($query){
            $query->pluck('date');
        }])->with(['bid'=>function($q){
            $q->where(['organization_id'=>Session::get('organization_id')]);
        }])->first();
        $hist = [];

        foreach ($booking->status_history as $status){
            if(!in_array($status->status, $hist))
                $hist[] = $status->status;
        }

        $booking->status_ids = $hist;

        $vehicle=VehicleController::getVehicles(Session::get('organization_id'), true);
        return view('vendor-panel.order.details', ['booking'=>$booking, 'vehicles'=>$vehicle]);
    }

    public function bookingRequirment(Request $request)
    {
        $booking=Booking::where('public_booking_id', $request->id)->with('inventories')->with('service')->with(['movement_dates'=>function($query){
            $query->pluck('date');
        }])->with(['bid'=>function($q){
            $q->where(['organization_id'=>Session::get('organization_id')]);
        }])->first();
        $hist = [];

        foreach ($booking->status_history as $status){
            if(!in_array($status->status, $hist))
                $hist[] = $status->status;
        }

        $booking->status_ids = $hist;

        return view('vendor-panel.order.requirement', ['booking'=>$booking]);
    }

    public function myQuote(Request $request)
    {
        $booking=Booking::where('public_booking_id', $request->id)->first();
        $hist = [];

        foreach ($booking->status_history as $status){
            if(!in_array($status->status, $hist))
                $hist[] = $status->status;
        }

        $booking->status_ids = $hist;
        return view('vendor-panel.order.myquote', ['booking'=>$booking]);
    }

    public function myBid(Request $request)
    {
        $bidding_graph=[];
        $booking=Booking::where('public_booking_id', $request->id)->with('service')->first();
        $hist = [];

        foreach ($booking->status_history as $status){
            if(!in_array($status->status, $hist))
                $hist[] = $status->status;
        }

        $booking->status_ids = $hist;

        $bidding=Bid::where(['booking_id'=>$booking->id, 'organization_id'=>Session::get('organization_id')])->first();

        $bidding_graph_x=[];
        $bidding_graph_y=[];
        $rank=[];
        if($bidding->status == BidEnums::$STATUS['lost'])
        {
            $bidding_graph_x=BookingsController::getposition(Session::get('account')['id'], $request->id)['axis']['x'];
            $bidding_graph_y=BookingsController::getposition(Session::get('account')['id'], $request->id)['axis']['y'];
            $rank=BookingsController::getposition(Session::get('account')['id'], $request->id)['rank'];
        }

        return view('vendor-panel.order.mybid', ['booking'=>$booking, 'bidding'=>$bidding, 'rank'=>$rank,
            'graph'=>[
                "revenue"=>[
                    "this_week"=>[
                        "dates"=>$bidding_graph_x,
                        "sales"=>$bidding_graph_y
                    ],
                ]
            ]]);
    }

    public function scheduleOrder(Request $request)
    {
        $booking=Booking::where('public_booking_id', $request->id)->with('inventories')->with('service')->with(['movement_dates'=>function($query){
            $query->pluck('date');
        }])->with(['bid'=>function($q){
            $q->where(['organization_id'=>Session::get('organization_id')]);
        }])->first();
        $hist = [];

        foreach ($booking->status_history as $status){
            if(!in_array($status->status, $hist))
                $hist[] = $status->status;
        }

        $booking->status_ids = $hist;
        return view('vendor-panel.order.scheduledorder', ['booking'=>$booking]);
    }

    public function driverDetails(Request $request)
    {
        $driver=Vendor::select(["id", "fname", "lname", "phone"])
            ->where("organization_id", Session::get('organization_id'))
            ->where(["user_role" => VendorEnums::$ROLES['driver']])
            ->get();
        $vehicle=Vehicle::select(["id", "name", "vehicle_type", "number"])->where("organization_id", Session::get('organization_id'))
            ->get();
        $assigned_driver=BookingDriver::where('booking_id', Booking::where('public_booking_id', $request->id)->pluck('id')[0])->with('vehicle')->with('driver')->orderBy('id', 'DESC')->first();
        $booking=Booking::where('public_booking_id', $request->id)->first();
        $hist = [];

        foreach ($booking->status_history as $status){
            if(!in_array($status->status, $hist))
                $hist[] = $status->status;
        }

        $booking->status_ids = $hist;
        return view('vendor-panel.order.driverdetail', ['drivers'=>$driver, 'vehicles'=>$vehicle, 'assigned_driver'=>$assigned_driver, 'id'=>$request->id, 'booking'=>$booking]);
    }

    public function intransit(Request $request)
    {
        $booking=Booking::where('public_booking_id', $request->id)->first();
        $hist = [];

        foreach ($booking->status_history as $status){
            if(!in_array($status->status, $hist))
                $hist[] = $status->status;
        }

        $booking->status_ids = $hist;
        return view('vendor-panel.order.intransit', ['booking'=>$booking]);
    }

    public function completeOrder(Request $request)
    {
        $booking=Booking::where('public_booking_id', $request->id)->first();
        $hist = [];

        foreach ($booking->status_history as $status){
            if(!in_array($status->status, $hist))
                $hist[] = $status->status;
        }

        $booking->status_ids = $hist;
        return view('vendor-panel.order.complete', ['booking'=>$booking]);
    }

    public function getServices()
    {
        $services=Service::where(['status'=>CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])->get();
        return view('vendor-panel.inventory.services', ['services'=>$services]);
    }

    public function addInventory(Request $request)
    {
        $inventory_items=[];
        $inventory=Inventory::where(['status'=>CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])->whereNotIn('id', InventoryPrice::where(['organization_id'=>Session::get('organization_id'),"service_type"=>$request->id])->where("deleted", CommonEnums::$NO)->pluck('inventory_id'))->get();
        if(isset($request->item)) {
            $inventory_items =Inventory::where('id', $request->item)->first();
        }
        return view('vendor-panel.inventory.addinventory', ['inventories'=>$inventory, 'service_id'=>$request->id, 'inventory_items'=>$inventory_items]);
    }

    public function editInventory(Request $request)
    {
        $inventory=InventoryPrice::where(['inventory_id'=>$request->id, 'deleted'=>CommonEnums::$NO])->where('organization_id', Session::get('organization_id'))->get();
        $inventory_item=Inventory::where('id', $request->id)->first();
        $service_types=InventoryPrice::select('service_type')->where(['inventory_id'=>$request->id, 'deleted'=>CommonEnums::$NO])->where('organization_id', Session::get('organization_id'))->groupBy('service_type')->with('service')->get();
        return view('vendor-panel.inventory.editinventory', ['inventories'=>$inventory, 'item'=>$inventory_item, 'service_types'=>$service_types, 'inventory_id'=>$request->id]);
    }
}
