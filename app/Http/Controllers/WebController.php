<?php

namespace App\Http\Controllers;

use App\Enums\BookingEnums;
use App\Enums\CommonEnums;
use App\Enums\ServiceEnums;
use App\Models\Booking;
use App\Models\Coupon;
use App\Models\Inventory;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Subservice;
use App\Models\Organization;
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

    public function ordersBookingsLive()
    {
        $bookings = Booking::whereNotIn("status",[BookingEnums::$STATUS["cancelled"],BookingEnums::$STATUS['completed']])
            ->with('service')
            ->with('organization')
            ->orderBy("id","DESC")
            ->paginate(CommonEnums::$PAGE_LENGTH);

        return view('order.ordersbookings_live',[
            "bookings" => $bookings
        ]);
    }

    public function ordersBookingsPast()
    {
       $bookings = Booking::whereIn("status",[BookingEnums::$STATUS["cancelled"],BookingEnums::$STATUS['completed']])
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
    public function customers()
    {
        return view('customer.customer',[
            "users"=>User::orderBy("id","DESC")->paginate(15)
        ]);
    }

    public function createCustomers()
    {
        return view('customer.createcustomer');
    }

    public function vendors()
    {
        return view('vendor.vendor');
    }

    public function createOnboardVendors()
    {
        return view('vendor.createvendor');
    }

    public function vendorsDetails()
    {
        return view('vendor.vendordetails');
    }

    public function leadVendors()
    {
        return view('vendor.lead');
    }

    public function pendingVendors()
    {
        return view('vendor.pending');
    }

    public function verifiedVendors()
    {
        return view('vendor.verified');
    }

    public function categories()
    {
        return view('categories.categories',[
            "categories"=>Service::paginate(CommonEnums::$PAGE_LENGTH),
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
            "subcategories"=>Subservice::paginate(CommonEnums::$PAGE_LENGTH)
        ]);
    }

    public function createSubcateories()
    {
        return view('categories.createsubcateories');
    }

    public function inventories()
    {
        return view('categories.inventories',[
            "inventories"=>Inventory::paginate(CommonEnums::$PAGE_LENGTH)
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
        $coupons = Coupon::orderBy('id','DESC')->paginate(CommonEnums::$PAGE_LENGTH);
        return view('coupons.coupons',[
            "coupons"=>$coupons
        ]);
    }

    public function createCoupons()
    {
        return view('coupons.createcoupons', ['organizations'=>Organization::whereIn('zone_id', Session::get('admin_zones'))->get()]);
    }

    public function detailsCoupons()
    {
        return view('coupons.detailscoupons');
    }

    public function zones()
    {
        return view('zones.zones',[
            "zones"=>Zone::paginate(CommonEnums::$PAGE_LENGTH)
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
            "sliders"=>Slider::with('banners')->paginate(CommonEnums::$PAGE_LENGTH)
        ]);
    }

    public function createSlider()
    {
        return view('sliderandbanner.createslider');
    }

    public function editSlider(Request $request)
    {
        // return Slider::with('zones')->findOrFail($request->id);
        return view('sliderandbanner.createslider', ['id'=>$request->id, 
        'slider'=>Slider::with('zones')->findOrFail($request->id)]);
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

    public function onbaordVendor()
    {
        return view('vendor.onboardvendor');
    }

    public function onbaordEditr()
    {
        return view('vendor.editonboard');
    }

    public function onbaordBranch()
    {
        return view('vendor.onboardaddbranch');
    }

    public function onbaordBank()
    {
        return view('vendor.onboardbank');
    }

    public function onbaordUserRole()
    {
        return view('vendor.onboarduserrole');
    }

    
}
