<?php

namespace App\Http\Controllers;

use App\Enums\BookingEnums;
use App\Enums\CommonEnums;
use App\Enums\CouponEnums;
use App\Enums\PayoutEnums;
use App\Enums\ServiceEnums;
use App\Enums\TicketEnums;
use App\Enums\VendorEnums;
use App\Enums\OrganizationEnums;
use App\Models\Admin;
use App\Models\Banners;
use App\Models\Booking;
use App\Models\Coupon;
use App\Models\Inventory;
use App\Models\Org_kyc;
use App\Models\Payout;
use App\Models\Review;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Subservice;
use App\Models\Organization;
use App\Models\Testimonials;
use App\Models\Ticket;
use App\Models\Vendor;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class WebController extends Controller
{
    public function login()
    {
        return view('login.login');
    }

    public function logout()
    {
        /*Session::forget('sessionActive');
        Session::forget('logged_in');
        Session::forget('account');
        Session::forget('user_role');*/

        Session::flush();
//        session_unset();
        return response()->redirectToRoute('login');
    }

    public function forgotPassword()
    {
        return view('login.forgotpassword');
    }

    public function verifyOtp()
    {
        return view('login.verifyotp');
    }

    public function resetPassword()
    {
        return view('login.reset_password');
    }

    //index.php
    public function dashboard()
    {
        return view('index');
    }

    public function apiSettings()
    {
        return view('system_settings');
    }

    public function settings()
    {
        return view('general_settings');
    }

    public function ordersBookingsLive(Request $request)
    {
        $bookings = Booking::whereNotIn("status",[BookingEnums::$STATUS["cancelled"],BookingEnums::$STATUS['completed']])
            ->orWhere("deleted", CommonEnums::$NO)
            ->with('service')
            ->with('organization')
            ->orderBy("id","DESC")
            ->paginate(CommonEnums::$PAGE_LENGTH);

        return view('order.ordersbookings_live',[
            "bookings" => $bookings
        ]);
    }

    public function ordersBookingsPast(Request $request)
    {
       $bookings = Booking::whereIn("status",[BookingEnums::$STATUS["cancelled"],BookingEnums::$STATUS['completed']])
           ->where("deleted", CommonEnums::$NO)
           ->with("service")
           ->with('organization')
           ->orderBy("id","DESC")
           ->paginate(CommonEnums::$PAGE_LENGTH);

        return view('order.ordersbookings_past',[
            "bookings" => $bookings
        ]);
    }

    public function orderDetails()
    {
        return view('order.orderdetails');
    }

    public function createOrder()
    {
        return view('order.createorder');
    }

    public function customers(Request $request)
    {
        $total_user =User::where("deleted", CommonEnums::$NO)->count();
        $active_user =User::where(["deleted"=>CommonEnums::$NO, "status"=>CommonEnums::$YES])->count();
        $inactive_user =User::where(["deleted"=>CommonEnums::$NO, "status"=>CommonEnums::$NO])->count();
        return view('customer.customer',[
            "users"=>User::orderBy("id","DESC")->paginate(15), "total_user"=>$total_user, "active_user"=>$active_user, "inactive_user"=>$inactive_user
        ]);
    }

    public function createCustomers()
    {
        return view('customer.createcustomer');
    }

    public function vendors(Request $request)
    {
        $vendors = Organization::where(["status"=>OrganizationEnums::$STATUS["active"], "deleted"=>CommonEnums::$NO, "parent_org_id"=>null])->whereIn("zone_id", Session::get("admin_zones"))
            ->with('admin')
            ->paginate(CommonEnums::$PAGE_LENGTH);
        $count_vendors = Organization::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->count();
        $count_verified_vendors = Organization::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO, "verification_status"=>CommonEnums::$YES])->count();
        $count_unverifide_vendors = Organization::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO, "verification_status"=>CommonEnums::$NO])->count();
        return view('vendor.vendor',['vendors'=>$vendors, 'vendors_count'=>$count_vendors, 'verifide_vendors'=>$count_verified_vendors, 'unverifide_vendors'=>$count_unverifide_vendors]);
    }

    public function sidebar_vendors(Request $request)
    {
        $vendor = Organization::where("id", $request->id)->with('admin')->with('services')->with('zone')->first();
        $branch = Organization::where("parent_org_id", $request->id)->count();
        $payouts = Payout::where("organization_id", $request->id)->get();
        return view('sidebar.vendors', ['organization'=>$vendor, 'branch'=>$branch, 'payouts'=>$payouts]);
    }

    public function vendorsDetails(Request $request)
    {
        $vendor = Organization::where("id", $request->id)->with('admin')->with('services')->with('zone')
            ->with(['vendors'=>function($query){
                $query->where('user_role', VendorEnums::$ROLES['driver']);
            }])->first();
        $branch = Organization::where("parent_org_id", $request->id)->count();
        $payouts = Payout::where("organization_id", $request->id)->get();
        return view('vendor.vendordetails', ['organization'=>$vendor, 'branch'=>$branch, 'payouts'=>$payouts]);
    }

    public function createOnboardVendors()
    {
        $services = Service::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        return view('vendor.createvendor', ['services'=>$services]);
    }

    public function onbaordEdit(Request  $request)
    {
        $organization = Organization::where(["id"=>$request->id, "status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->with('services')->first();
        $services = Service::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        return view('vendor.editonboard', ['id'=>$request->id, 'services'=>$services, 'organization'=>$organization]);
    }

    public function onbaordBranch(Request $request)
    {
        $branch = Organization::where(["parent_org_id"=>$request->id, "deleted"=>CommonEnums::$NO])->with('services')->get();
        $organization = Organization::where(["id"=>$request->id, "deleted"=>CommonEnums::$NO])->first();
        $services = Service::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        return view('vendor.onboardbranch', ['id'=>$request->id, 'services'=>$services, 'branches'=>$branch, 'organization'=>$organization]);
    }

    public function onbaordUserRole(Request $request)
    {
        $roles =Organization::where(["parent_org_id"=>$request->id, "status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->orWhere("id", $request->id)->pluck("id");
        $users = Vendor::whereIn("organization_id", $roles)->where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        $branch = Organization::where(["parent_org_id"=>$request->id, "status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->orWhere("id", $request->id)->get();
        return view('vendor.onboarduserrole',['id'=>$request->id, 'roles'=>$users, 'branches'=>$branch]);
    }

    public function onbaordBank(Request $request)
    {
        $bank=Org_kyc::where("organization_id", $request->id)->first();
        return view('vendor.onboardbank', ['bank'=>$bank, 'id'=>$request->id]);
    }

    public function leadVendors()
    {
        $leads = Organization::where(["status"=>OrganizationEnums::$STATUS["lead"], "deleted"=>CommonEnums::$NO, "parent_org_id"=>null])->whereIn("zone_id", Session::get("admin_zones"))
            ->with('admin')->with('zone')
            ->paginate(CommonEnums::$PAGE_LENGTH);
        return view('vendor.lead',['vendors'=>$leads]);
    }

    public function pendingVendors()
    {
        return view('vendor.pending');
    }

    public function verifiedVendors()
    {
        $vendors = Organization::where(["verification_status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO, "parent_org_id"=>null])->whereIn("zone_id", Session::get("admin_zones"))
            ->with('admin')->with('zone')
            ->paginate(CommonEnums::$PAGE_LENGTH);

        return view('vendor.verified',['vendors'=>$vendors]);
    }

    public function categories()
    {
        return view('categories.categories',[
            "categories"=>Service::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->paginate(CommonEnums::$PAGE_LENGTH),
            "inventory_quantity_type"=>ServiceEnums::$INVENTORY_QUANTITY_TYPE
        ]);
    }

    public function createCategories(Request $request)
    {
        $category = Service::where('id', $request->id)->first();
        return view('categories.createcategories', ['category'=>$category]);
    }

    public function subcateories()
    {
        return view('categories.subcateories',[
            "subcategories"=>Subservice::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->paginate(CommonEnums::$PAGE_LENGTH)
        ]);
    }

    public function createSubcateories(Request $request)
    {
        $sub_category = Subservice::where('id', $request->id)->with('services')->with(['inventorymap'=>function($query){
            $query->with('meta');
        }])->first();
        $categories = Service::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        $inventory = Inventory::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        return view('categories.createsubcateories', ['categories'=>$categories, 'inventories'=>$inventory, 'subcategory'=>$sub_category]);
    }

    public function inventories()
    {
        return view('categories.inventories',[
            "inventories"=>Inventory::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->paginate(CommonEnums::$PAGE_LENGTH)
        ]);
    }

    public function createInventories(Request $request)
    {
        $inventory = Inventory::where('id', $request->id)->first();
        return view('categories.createinventories', ['inventory'=>$inventory]);
    }

    public function detailsInventories()
    {
        return view('categories.detailsinventories');
    }

    public function coupons()
    {
        $coupons = Coupon::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->orderBy('id','DESC')->orWhere("zone_scope", CouponEnums::$ZONE_SCOPE['all'])
            ->with(['zones'=>function($query){
                $query->whereIn("zone_id", Session::get("admin_zones"));
            }])
            ->paginate(CommonEnums::$PAGE_LENGTH);
        $total_coupons = Coupon::where(["deleted"=>CommonEnums::$NO])->count();
        $active_coupons = Coupon::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->count();
        $inactive_coupons = Coupon::where(["status"=>CommonEnums::$NO, "deleted"=>CommonEnums::$NO])->count();
        return view('coupons.coupons',["coupons"=>$coupons, 'total_coupons'=>$total_coupons, 'active_coupons'=>$active_coupons, 'inactive_coupons'=>$inactive_coupons]);
    }

    public function sidebar_coupons(Request $request)
    {
        $coupons = Coupon::where(["id"=>$request->id])->with('zones')->with('payment')->first();
        return view('sidebar.coupons', ['coupons'=>$coupons]);
    }

    public function createCoupons(Request $request)
    {
        $coupons = Coupon::where(["id"=>$request->id])->with('zones')->with('organizations')->with('users')->first();
        return view('coupons.createcoupons', ['organizations'=>Organization::whereIn('zone_id', Session::get('admin_zones'))->orWhere(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get(), 'coupons'=>$coupons]);
    }

    public function detailsCoupons()
    {
        return view('coupons.detailscoupons');
    }

    public function zones()
    {
        $total = Zone::where(["deleted"=>CommonEnums::$NO])->count();
        $active = Zone::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->count();
        $inactive = Zone::where(["status"=>CommonEnums::$NO, "deleted"=>CommonEnums::$NO])->count();
        return view('zones.zones',[
            "zones"=>Zone::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->paginate(CommonEnums::$PAGE_LENGTH), 'total'=>$total, 'active'=>$active, 'inactive'=>$inactive
        ]);
    }

    public function createZones(Request $request)
    {
        $zone = Zone::where('id',$request->id)->first();
        return view('zones.createzones', ['zones'=>$zone]);
    }

    public function detailsZones()
    {
        return view('zones.detailszones');
    }

    public function slider()
    {
        return view('sliderandbanner.slider',[
            "sliders"=>Slider::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->with('banners')->paginate(CommonEnums::$PAGE_LENGTH)
        ]);
    }

    public function createSlider()
    {
        return view('sliderandbanner.createslider');
    }

    public function editSlider(Request $request)
    {
        return view('sliderandbanner.createslider', ['id'=>$request->id,
        'slider'=>Slider::with('zones')->findOrFail($request->id)]
        );
    }

    public function manageBanner(Request $request)
    {
        // return Slider::with('zones')->findOrFail($request->id);
        return view('sliderandbanner.createbanner', [
         'id'=>$request->id,
         'banners'=>Banners::where("slider_id",$request->id)->get(),
         'slider'=>Slider::findOrFail($request->id)
        ]);
    }

    public function pushNotification()
    {
        return view('sliderandbanner.pushnotification');
    }

    public function createPushNotification()
    {
        return view('sliderandbanner.createpush');
    }

    public function mailNotification()
    {
        return view('sliderandbanner.mailnotification');
    }

    public function createMailNotification()
    {
        return view('sliderandbanner.createmail');
    }

    public function testimonials()
    {
        $testimonials=Testimonials::where(["deleted"=>CommonEnums::$NO, "status"=>CommonEnums::$YES])->orderBy("id","DESC")->paginate(CommonEnums::$PAGE_LENGTH);
        return view('sliderandbanner.testimonials', ['testimonials'=>$testimonials]);
    }

    public function createTestimonials(Request $request)
    {
        $testimonials=Testimonials::where("id", $request->id)->first();
        return view('sliderandbanner.createtestimonials', ['testimonials'=>$testimonials]);
    }

    public function review()
    {
        $review=Review::where("deleted", CommonEnums::$NO)->with(['Booking'=>function($query){
            $query->with('organization');
        }])->with('user')->orderBy("id","DESC")->paginate(CommonEnums::$PAGE_LENGTH);
        $total_review=Review::where("deleted", CommonEnums::$NO)->count();
        $active_review=Review::where(["deleted"=>CommonEnums::$NO, "status"=>CommonEnums::$YES])->count();
        $inactive_review=Review::where(["deleted"=>CommonEnums::$NO, "status"=>CommonEnums::$NO])->count();
        return view('reviewandratings.review', ['reviews'=>$review, 'total_review'=>$total_review, 'active_review'=>$active_review, 'inactive_review'=>$inactive_review]);
    }

    public function createReview(Request $request)
    {
        return view('reviewandratings.createreview');
    }

    public function complaints()
    {
        $complaints=Ticket::where("type", TicketEnums::$TYPE['complaint'])->with('user')->with('booking')->orderBy("id","DESC")->paginate(CommonEnums::$PAGE_LENGTH);
        $resolved_complaints=Ticket::where(["type"=>TicketEnums::$TYPE['complaint'], "status"=>TicketEnums::$STATUS['resolved']])->count();
        $open_complaints=Ticket::where(["type"=>TicketEnums::$TYPE['complaint'], "status"=>TicketEnums::$STATUS['open']])->count();
        return view('reviewandratings.complaints', ['complaints'=>$complaints, 'resolved_complaints'=>$resolved_complaints, 'open_complaints'=>$open_complaints]);
    }

    public function createComplaints()
    {
        return view('reviewandratings.createcomplaints');
    }

    public function serviceRequests()
    {
        $service=Ticket::where("type", TicketEnums::$TYPE['service_request'])->with('vendor')->orderBy("id","DESC")->paginate(CommonEnums::$PAGE_LENGTH);
        return view('reviewandratings.servicerequests', ['services'=>$service]);
    }

    public function createService()
    {
        return view('reviewandratings.createservice');
    }

    public function vendorPayout()
    {
        $payout =Payout::orderBy("id","DESC")->paginate(CommonEnums::$PAGE_LENGTH);
        $scheduled_payout =Payout::where(["status"=>PayoutEnums::$STATUS['scheduled']])->count();
        $failed_payout =Payout::where(["status"=>PayoutEnums::$STATUS['suspended']])->count();
        return view('vendorpayout.payout', ['payouts'=>$payout, 'total_count'=>count($payout), 'scheduled_payout'=>$scheduled_payout, 'failed_payout'=>$failed_payout]);
    }

    public function createVendorPayout()
    {
        return view('vendorpayout.createpayout');
    }

    public function detailsVendorPayout()
    {
        return view('vendorpayout.detailspayout');
    }

    public function users()
    {
        $users=Admin::where(["deleted"=>CommonEnums::$NO, "status"=>CommonEnums::$YES])->with('zones')->orderBy("id","DESC")->paginate(CommonEnums::$PAGE_LENGTH);
        return view('users.users', ['users'=>$users]);
    }

    public function createUsers()
    {
        return view('users.createusers');
    }

    public function detailsUsers()
    {
        return view('users.detailseusers');
    }

    public function sidebar_booking(Request $request){
        return view('sidebar.orderbooking',[
            "booking"=>Booking::where('id',$request->id)
                ->with('organization')
                ->with('payment')
                ->with('status_history')
                ->with('inventories')
                ->with('user')
                ->with('vehicle')
                ->with('driver')
                ->first()
        ]);
    }

}
