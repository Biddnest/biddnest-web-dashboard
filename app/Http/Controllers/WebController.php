<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function login()
    {
        return view('login.login');
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

    public function ordersBookingsLive()
    {
        return view('order.ordersbookings_live');
    }

    public function ordersBookingsPast()
    {
        return view('order.ordersbookings_past');
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
        return view('customer.customer');
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
        return view('categories.categories');
    }

    public function createCategories()
    {
        return view('categories.createcategories');
    }

    public function subcateories()
    {
        return view('categories.subcateories');
    }

    public function createSubcateories()
    {
        return view('categories.createsubcateories');
    }

    public function inventories()
    {
        // return "success";
        return view('categories.inventories');
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
        return view('coupons.coupons');
    }

    public function createCoupons()
    {
        return view('coupons.createcoupons');
    }

    public function detailsCoupons()
    {
        return view('coupons.detailscoupons');
    }

    public function zones()
    {
        return view('zones.zones');
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
        return view('sliderandbanner.slider');
    }

    public function createSlider()
    {
        return view('sliderandbanner.createslider');
    }

    public function pushNotification()
    {
        return view('sliderandbanner.pushnotification');
    }
}
