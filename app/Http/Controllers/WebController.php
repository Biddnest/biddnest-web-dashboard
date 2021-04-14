<?php

namespace App\Http\Controllers;

use App\Enums\BookingEnums;
use App\Enums\CommonEnums;
use App\Enums\ServiceEnums;
use App\Enums\VendorEnums;
use App\Enums\OrganizationEnums;
use App\Models\Banners;
use App\Models\Booking;
use App\Models\Coupon;
use App\Models\Inventory;
use App\Models\Org_kyc;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Subservice;
use App\Models\Organization;
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
           ->orWhere("deleted", CommonEnums::$NO)
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
        return view('customer.customer',[
            "users"=>User::orderBy("id","DESC")->paginate(15)
        ]);
    }

    public function createCustomers()
    {
        return view('customer.createcustomer');
    }

    public function vendors(Request $request)
    {
        $vendors = Organization::where(["status"=>OrganizationEnums::$STATUS["active"], "deleted"=>CommonEnums::$NO, "parent_org_id"=>null])
            ->with(['admin'=> function ($query) {
            $query->where(["status"=>VendorEnums::$STATUS["active"], "user_role"=>VendorEnums::$ROLES['admin'], "deleted"=>CommonEnums::$NO]);
        }])
            ->paginate(CommonEnums::$PAGE_LENGTH);
        $count_vendors = Organization::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->count();
        $count_verified_vendors = Organization::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO, "verification_status"=>CommonEnums::$YES])->count();
        $count_unverifide_vendors = Organization::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO, "verification_status"=>CommonEnums::$NO])->count();
        return view('vendor.vendor',['vendors'=>$vendors, 'vendors_count'=>$count_vendors, 'verifide_vendors'=>$count_verified_vendors, 'unverifide_vendors'=>$count_unverifide_vendors]);
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
        $branch = Organization::where(["parent_org_id"=>$request->id, "status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->with('services')->get();
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

    public function vendorsDetails()
    {

        return view('vendor.vendordetails');
    }

    public function leadVendors()
    {
        $leads = Organization::where(["status"=>OrganizationEnums::$STATUS["lead"], "deleted"=>CommonEnums::$NO])
            ->with(['vendor'=> function ($query) {
                $query->where(["status"=>VendorEnums::$STATUS["lead"], "user_role"=>VendorEnums::$ROLES['admin'], "deleted"=>CommonEnums::$NO]);
            }])->with('zone')
            ->paginate(CommonEnums::$PAGE_LENGTH);
        return view('vendor.lead',['leads'=>$leads]);
    }

    public function pendingVendors()
    {
        return view('vendor.pending');
    }

    public function verifiedVendors()
    {
        $vendors = Organization::where(["verification_status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])
            ->with(['vendor'=> function ($query) {
                $query->where(["user_role"=>VendorEnums::$ROLES['admin'], "deleted"=>CommonEnums::$NO]);
            }])->with('zone')
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

    public function createCategories()
    {

        return view('categories.createcategories');
    }

    public function subcateories()
    {
        return view('categories.subcateories',[
            "subcategories"=>Subservice::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->paginate(CommonEnums::$PAGE_LENGTH)
        ]);
    }

    public function createSubcateories()
    {
        $categories = Service::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        $inventory = Inventory::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        return view('categories.createsubcateories', ['categories'=>$categories, 'inventories'=>$inventory]);
    }

    public function inventories()
    {
        return view('categories.inventories',[
            "inventories"=>Inventory::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->paginate(CommonEnums::$PAGE_LENGTH)
        ]);
    }

    public function createInventories()
    {
        return view('categories.createinventories');
    }

    public function detailsInventories()
    {
        return view('categories.detailsinventories');
    }

    public function coupons()
    {
        $coupons = Coupon::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->orderBy('id','DESC')->paginate(CommonEnums::$PAGE_LENGTH);
        return view('coupons.coupons',[
            "coupons"=>$coupons
        ]);
    }

    public function createCoupons()
    {
        return view('coupons.createcoupons', ['organizations'=>Organization::whereIn('zone_id', Session::get('admin_zones'))->orWhere(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get()]);
    }

    public function detailsCoupons()
    {
        return view('coupons.detailscoupons');
    }

    public function zones()
    {
        return view('zones.zones',[
            "zones"=>Zone::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->paginate(CommonEnums::$PAGE_LENGTH)
        ]);
    }

    public function createZones()
    {
        return view('zones.createzones');
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
        return view('sliderandbanner.testimonials');
    }

    public function createTestimonials()
    {
        return view('sliderandbanner.createtestimonials');
    }

    public function review()
    {
        return view('reviewandratings.review');
    }

    public function createReview()
    {
        return view('reviewandratings.createreview');
    }

    public function complaints()
    {
        return view('reviewandratings.complaints');
    }

    public function createComplaints()
    {
        return view('reviewandratings.createcomplaints');
    }

    public function serviceRequests()
    {
        return view('reviewandratings.servicerequests');
    }

    public function createService()
    {
        return view('reviewandratings.createservice');
    }

    public function vendorPayout()
    {
        return view('vendorpayout.payout');
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
        return view('users.users');
    }

    public function createUsers()
    {
        return view('users.createusers');
    }

    public function detailsUsers()
    {
        return view('users.detailseusers');
    }

}
