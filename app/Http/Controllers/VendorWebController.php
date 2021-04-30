<?php

namespace App\Http\Controllers;

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
        return response()->redirectToRoute('vendor-panel.login.login');
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

    public function dashboard()
    {
        return view('vendor-panel.dashboard.dashboard');
    }
}
