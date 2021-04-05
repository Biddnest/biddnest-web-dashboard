<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiRouteController as ApiRouter;
use App\Http\Controllers\VendorApiRouteController as VendorApiRouter;
use App\Http\Controllers\VendorController as VendorRouter;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PageController;

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

    Route::post('/coupon/verify',[ApiRouter::class,'verifyCoupon']);

    //bookings APIs
    Route::prefix('bookings')->group(function () {
        Route::get('/',[ApiRouter::class,'getBookingByPublicId']);
        Route::post('/enquiry',[ApiRouter::class,'createEnquiry']);
        Route::post('/confirm',[ApiRouter::class,'confirmBooking']);
        Route::delete('/cancel',[ApiRouter::class,'cancelBooking']);
        Route::get('/finalquote',[ApiRouter::class,'finalquote']);

        // Route::post('/reschedule',[ApiRouter::class,'reschedul']);
        Route::get('/history/past',[ApiRouter::class,'getBookingHistoryPast']);
        Route::get('/history/live',[ApiRouter::class,'getBookingHistoryLive']);

        Route::get('/recent',[ApiRouter::class,'getRecentBooking']);

        Route::prefix('payment')->group(function () {
            Route::get('/summary',[ApiRouter::class,'paymentDetails']);
            Route::post('/initiate',[ApiRouter::class, 'intiatePayment']);
            Route::post('/webhook',[PaymentController::class, 'webhook']);
            Route::post('/status/complete',[ApiRouter::class, 'statusComplete']);
        });
        Route::prefix('request')->group(function () {
            Route::post('/reschedule',[ApiRouter::class,'createRescheduleTicket']);
            Route::post('/canceled',[ApiRouter::class,'createCancellationTicket']);
        });
    });

    Route::get("/page/{slug}",[ApiRouter::class, 'getPage']);
    Route::post("/review",[ApiRouter::class, 'addReview']);

    Route::get("/contact-us",[ApiRouter::class, 'contactUs']);

    Route::get("/faq/categories",[ApiRouter::class, 'faqCategories']);
    Route::get("/faq/categories/{category}",[ApiRouter::class, 'faqByCategory']);

    Route::post("/notification/player",[ApiRouter::class, 'addNotificationUserPlayer']);

    Route::get("/tickets",[ApiRouter::class, 'getTickets']);
    Route::post("/tickets/create",[ApiRouter::class, 'createTickets']);

    Route::post("/tickets/callback",[ApiRouter::class, 'callBack']);
});


Route::prefix('vendors/v1')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('/login',[VendorApiRouter::class,'loginForApp']);
    });


    Route::post('/pin/reset',[VendorApiRouter::class,'resetPin']);
    Route::get('/pin/status',[VendorApiRouter::class,'checkPin']);

    //Biding API's
    Route::prefix('bookings')->group(function () {

        Route::post('/bookmark',[VendorApiRouter::class,'addBookmark']);

        Route::get('/details',[VendorApiRouter::class,'getBookingById']);

        Route::post('/submit',[VendorApiRouter::class,'addBid']);

        Route::post('/reject',[VendorApiRouter::class,'reject']);

        Route::get('/{type}',[VendorApiRouter::class,'getBookingsforApp']);

        Route::post('/driver',[VendorApiRouter::class,'assignDriver']);

        Route::get('/driver/get',[VendorApiRouter::class,'getDriver']);

        Route::post('/distance',[VendorApiRouter::class,'getDistance']);

//        Route::get('/tour/start',[VendorApiRouter::class,'getDriver']);

        Route::post('/trip/start',[VendorApiRouter::class,'startTrip']);
        Route::post('/trip/end',[VendorApiRouter::class,'endTrip']);

    });

    Route::prefix('bid')->group(function () {
        Route::get('/price-list',[VendorApiRouter::class,'getPriceList']);
    });

    Route::prefix('reports')->group(function () {
        Route::get('/',[VendorApiRouter::class,'getReport']);
    });
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
