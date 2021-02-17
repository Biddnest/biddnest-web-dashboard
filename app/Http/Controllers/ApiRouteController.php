<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Middleware\VerifyJwtToken;
use App\StringFormatter;


class ApiRouteController extends Controller
{
    public function __construct(){
        $this->middleware(VerifyJwtToken::class)->except(['login','verifyLoginOtp','signupUser']);
    }

    public function login(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'phone' => 'required|string|min:10'
        ]);
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return UserController::login($request->phone);

    }

    public function verifyLoginOtp(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'phone' => 'required|string|min:10',
            'otp' => 'required|numeric'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return UserController::verifyLoginOtp($request->phone, $request->otp);

    }

    public function signupUser(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'phone' => 'required|string|max:12',
            'fname' => 'required|string|max:50',
            'lname' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'gender' => 'required|string|max:6',
            'referral_code' => 'required|string',
        ]);

        $formatedRequest = StringFormatter::format($request->all(),[
            'fname' => 'capitalizeFirst',
            'lname' => 'capitalizeFirst',
            'gender' => 'lowercase',
            'email' => 'lowercase'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return UserController::signupUser($request->phone, $formatedRequest->fname, $formatedRequest->lname, $formatedRequest->email, $formatedRequest->gender, $request->referral_code);

    }

}
