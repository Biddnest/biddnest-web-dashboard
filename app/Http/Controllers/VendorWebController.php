<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorWebController extends Controller
{
    public function login()
    {
        return view('vendor-panel.auth.login');
    }

    public function dashboard()
    {
        return view('vendor-panel.dashboard.dashboard');
    }
}
