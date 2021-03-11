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

    
    //slider and banners
    public function sliders()
     {
        return UserController::get();
     }

    public function sliders_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required|string', 'type' => 'required',
            'position' => 'required', 'platform' => 'required',
            'size' => 'required', 'from_date' => 'required',
            'to_date' => 'required', 'zone_specific' => 'required'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return UserController::add($request->name, $request->type, $request->position, $request->platform, $request->size, $request->from_date, $request->to_date, $request->zone_specific);
    }

    public function sliders_delete($id)
    {
        return UserController::delete($id);
    }

    public function banners()
    {
        return UserController::banners();
    }

    public function banners_add(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id'=>"required|int",
            'banners.*.name' => 'required|string',
            'banners.*.date.from' => 'required|date',
            'banners.*.date.to' => 'required|date',
            "banners.*.url" => 'required|url',
            "banners.*.image" => 'required|string'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return UserController::addBanner($request->all());
    }

    public function banners_delete($id)
    {
        return UserController::deleteBanner($id);
    }






    public static function config(Request $request){
        return CustomerApp\SettingsController::getSettings();
    }

}
