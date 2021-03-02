<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function login()
    {
        return view('login.login');
    }

    public function forgotpassword()
    {
        return view('login.forgotpassword');
    }

    public function verifyotp()
    {
        return view('login.verifyotp');
    }

    public function reset_password()
    {
        return view('login.reset_password');
    }

    public function dashboard()
    {
        return view('index');
    }
}
