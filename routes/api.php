<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiRouteController as ApiRouter;
use App\Http\Controllers\VendorApiRouteController as VendorApiRouter;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post("/login", [ApiRouter::class, 'login']);
        Route::post("/login/verify-otp", [ApiRouter::class, 'verifyLoginOtp']);
        Route::post("/signup", [ApiRouter::class, 'signupUser']);
    });
    Route::get("/configuration",[ApiRouter::class, 'config']);

    Route::put("/profile/update",[ApiRouter::class, 'updateProfile']);

    Route::get('/sliders',[ApiRouter::class,'getAppSliders']);
    Route::get('/services',[ApiRouter::class,'getServices']);
    Route::get('/subservices',[ApiRouter::class,'getSubServices']);
    Route::get('/inventories',[ApiRouter::class,'getInventories']);
    Route::get('/inventories/all',[ApiRouter::class,'getAllInventories']);

    //bookings APIs
    Route::prefix('bookings')->group(function () {
        Route::get('/',[ApiRouter::class,'getBookingByPublicId']);
        Route::post('/enquiry',[ApiRouter::class,'createEnquiry']);
        Route::post('/confirm',[ApiRouter::class,'confirmBooking']);
        Route::delete('/cancel',[ApiRouter::class,'cancelBooking']);
        Route::get('/finalquote',[ApiRouter::class,'finalquote']);
        
        Route::post('/reschedul',[ApiRouter::class,'reschedul']);
        Route::get('/history/past',[ApiRouter::class,'getBookingHistoryPast']);
        Route::get('/history/live',[ApiRouter::class,'getBookingHistoryLive']);
    });
});


Route::prefix('vendors')->group(function () {

    Route::post('/vendor/login',[Router::class,'vendor_login'])->name("vendor_login");

    Route::post('/inventory-price',[VendorApiRouter::class,'addPrice']);
    Route::get('/inventory-price',[VendorApiRouter::class,'getInventoryprices']);
    Route::put('/inventory-price',[VendorApiRouter::class,'updateInventoryprices']);
    Route::delete('/inventory-price',[VendorApiRouter::class,'deleteInventoryprices']);

    
    //Biding API's
    Route::get('/bidlist',[VendorApiRouter::class,'getBidList']);
    Route::put('/bookmark',[VendorApiRouter::class,'addBookmark']);
    Route::get('/bookmark',[VendorApiRouter::class,'getBookmark']);
    Route::put('/bidsubmit',[VendorApiRouter::class,'addbid']);
    Route::put('/reject',[VendorApiRouter::class,'reject']);

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
