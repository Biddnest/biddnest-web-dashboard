<?php
/*
 * Copyright (c) 2021. This Project is built and maintained by Diginnovators Private Limited.
 */

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Middleware\VerifyJwtToken;
use App\StringFormatter;


/**
 * Class ApiRouteController
 * @package App\Http\Controllers
 */
class ApiRouteController extends Controller
{
    /**
     * ApiRouteController constructor.
     */
    public function __construct(){
        $this->middleware(VerifyJwtToken::class)->except(['config','login','verifyLoginOtp']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|object
     */
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|object
     */
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|object
     */
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
            return UserController::signupUser($request->token_payload->id, $formatedRequest->fname, $formatedRequest->lname, $formatedRequest->email, $formatedRequest->gender, $request->referral_code);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function updateProfile(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'fname' => 'required|string|max:50',
            'lname' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'gender' => 'required|string|max:6',
            'dob' => 'required|date',
            'avatar'=> 'nullable|string'
        ]);

        $formatedRequest = StringFormatter::format($request->all(),[
            'fname' => 'capitalizeFirst',
            'lname' => 'capitalizeFirst',
            'gender' => 'lowercase',
            'email' => 'lowercase',
            'dob' => 'date'
        ]);

        //        print_r($request->token_data_id);exit;
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->getMessageBag(), 400);
        else
            return UserController::update($request->token_payload->id, $formatedRequest->fname, $formatedRequest->lname, $formatedRequest->email, $formatedRequest->gender, $formatedRequest->dob, $request->avatar);

    }

    public function getAppSliders(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'lat' => 'required',
            'lng' => 'required'
        ]);
        
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return UserController::getAppSliders($request->lat, $request->lng);
    }

    public function getServices(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'lat' => 'required',
            'lng' => 'required'
        ]);
        
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return ServiceController::getForApp($request->lat, $request->lng);
    }
    

    public function getSubServices(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'service_id' => 'required|integer'
        ]);
        
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return SubServiceController::getSubservicesForApp($request->service_id);
    }

    
    public function getInventories(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'service_id' => 'required|integer'
        ]);
        
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return InventoryController::getBySubserviceForApp($request->subservice_id);
    }


    public static function config(Request $request){
        return CustomerApp\SettingsController::getSettings();
    }

}
