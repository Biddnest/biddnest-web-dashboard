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
}
