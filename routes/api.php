<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiRouteController as ApiRouter;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::post("/auth/login",[ApiRouter::class, 'login']);
    Route::post("/auth/login/verify-otp",[ApiRouter::class, 'verifyLoginOtp']);
    Route::post("/auth/signup",[ApiRouter::class, 'signupUser']);


    Route::put("/profile/update",[ApiRouter::class, 'updateProfile']);
});


Route::prefix('vendors')->group(function () {

    Route::post('/vendor/login',[Router::class,'vendor_login'])->name("vendor_login");

    //org_kyc API's
    /*Route::get('/vendors/kyc',[Router::class,'vendors_kyc'])->name("vendors_kyc");
    Route::post('/vendors/add/kyc',[Router::class,'vendor_add_kyc'])->name("vendor_add_kyc");
    Route::post('/vendors/edit/kyc/{id}',[Router::class,'vendor_edit_kyc'])->name("vendor_edit_kyc");
    Route::get('/vendors/fetch/kyc/{id}',[Router::class,'vendor_fetch_kyc'])->name("vendor_fetch_kyc");
    Route::get('/vendors/delete/kyc/{id}',[Router::class,'vendor_delete_kyc'])->name("vendor_delete_kyc");*/

    //join API's
    /*Route::get('/vendors/list',[Router::class,'vendors_list'])->name("vendors_list");
    Route::get('/vendors/org/fetch/{id}',[Router::class,'vendors_get_record'])->name("vendors_get_record");
    Route::get('/vendors/org/delete/{id}',[Router::class,'vendors_delete_record'])->name("vendors_delete_record");*/
});
