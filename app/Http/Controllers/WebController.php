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

    public function ordersBookings()
    {
        return view('order.ordersbookings');
    }

    public function orderDetails()
    {
        return view('order.orderdetails');
    }
}
