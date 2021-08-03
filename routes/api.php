<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

use App\Http\Controllers\ApiRouteController as ApiRouter;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\VendorApiRouteController as VendorApiRouter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post("/login", [ApiRouter::class, 'login']);
        Route::post("/login/verify-otp", [ApiRouter::class, 'verifyLoginOtp']);
        Route::post("/signup", [ApiRouter::class, 'signupUser']);
        Route::get("/verify", [ApiRouter::class, 'verifyAuth']);
    });

    Route::get("/configuration",[ApiRouter::class, 'config']);

    Route::put("/profile/update",[ApiRouter::class, 'updateProfile']);
    Route::put("/profile/update-mobile",[ApiRouter::class, 'updateMobile']);
    Route::put("/profile/verify-otp",[ApiRouter::class, 'verifyOtp']);

    Route::get('/sliders',[ApiRouter::class,'getAppSliders']);
    Route::get('/services',[ApiRouter::class,'getServices']);
    Route::get('/subservices',[ApiRouter::class,'getSubServices']);
    Route::get('/inventories',[ApiRouter::class,'getInventories']);
    Route::get('/inventories/all',[ApiRouter::class,'getAllInventories']);

    Route::post('/coupon/verify',[ApiRouter::class,'verifyCoupon']);
    Route::get('/coupon/get',[ApiRouter::class,'getCouponsForBooking']);

    Route::get('/testimonials',[ApiRouter::class,'getTestimonials']);

    Route::get('/zone',[ApiRouter::class,'getZones']);
    //bookings APIs
    Route::prefix('bookings')->group(function () {
        Route::get('/',[ApiRouter::class,'getBookingByPublicId']);
        Route::post('/enquiry',[ApiRouter::class,'createEnquiry']);
        Route::post('/confirm',[ApiRouter::class,'confirmBooking']);
//        Route::delete('/cancel',[ApiRouter::class,'cancelBooking']);
        Route::get('/finalquote',[ApiRouter::class,'finalquote']);

        Route::post('/distance',[ApiRouter::class,'getDistance']);

        // Route::post('/reschedule',[ApiRouter::class,'reschedul']);
        Route::get('/history/enquiry',[ApiRouter::class,'getBookingHistoryEnquiry']);
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
            Route::post('/rejected',[ApiRouter::class,'createRejectedTicket']);
        });
    });

    Route::get("/page/{slug}",[ApiRouter::class, 'getPage']);
    Route::post("/review",[ApiRouter::class, 'addReview']);

    Route::get("/contact-us",[ApiRouter::class, 'contactUs']);

    Route::get("/faq/categories",[ApiRouter::class, 'faqCategories']);
    Route::get("/faq/categories/{category}",[ApiRouter::class, 'faqByCategory']);

    Route::post("/notification/player",[ApiRouter::class, 'addNotificationUserPlayer']);

    Route::get("/tickets",[ApiRouter::class, 'getTickets']);
    Route::get("/tickets/bookings",[ApiRouter::class, 'getBookingDropdown']);

    Route::post("/tickets/create",[ApiRouter::class, 'createTickets']);

    Route::post("/tickets/callback",[ApiRouter::class, 'callBack']);
    Route::post("/tickets/reply",[ApiRouter::class, 'addReply']);
    Route::get("/tickets/details",[ApiRouter::class, 'getDetails']);

    Route::put("/freshchat/restore/id",[ApiRouter::class, 'updateFreshChatRestoreID']);

});


Route::prefix('vendors/v1')->group(function () {

    Route::get("/configuration",[VendorApiRouter::class, 'config']);

    Route::prefix('auth')->group(function () {
        Route::post('/login',[VendorApiRouter::class,'loginForApp']);
        Route::post("/verification/phone", [VendorApiRouter::class, 'phoneVerification']);
        Route::post("/verification/otp", [VendorApiRouter::class, 'verifyOtp']);
        Route::post("/reset-password", [VendorApiRouter::class, 'resetPassword']);
        Route::get("/verify", [VendorApiRouter::class, 'verifyAuth']);
    });

    Route::post("/change-password", [VendorApiRouter::class, 'changePassword']);

    Route::get("/user/{type}",[VendorApiRouter::class, 'getUser']);
    Route::get("/user",[VendorApiRouter::class, 'statusUpdate']);
    Route::get("/branch",[VendorApiRouter::class, 'getBranch']);
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

        Route::get('/bid/position',[VendorApiRouter::class,'getposition']);

        Route::post('/trip/start',[VendorApiRouter::class,'startTrip']);
        Route::post('/trip/end',[VendorApiRouter::class,'endTrip']);

        Route::get('/driver/{type}',[VendorApiRouter::class,'getBookingsForDriverApp']);

    });

    Route::prefix('bid')->group(function () {
        Route::get('/price-list',[VendorApiRouter::class,'getPriceList']);
    });

    Route::prefix('reports')->group(function () {
        Route::get('/',[VendorApiRouter::class,'getReport']);
    });

    Route::prefix('payouts')->group(function () {
        Route::get('/',[VendorApiRouter::class,'getPayout']);
    });

    Route::get('/drivers',[VendorApiRouter::class,'getDrivers']);

    Route::get('/vehicles',[VendorApiRouter::class,'getVehicles']);

    Route::post("/notification/player",[VendorApiRouter::class, 'addNotificationVendorPlayer']);

    Route::post("/tickets/create",[VendorApiRouter::class, 'createTickets']);
    Route::get("/tickets/bookings",[VendorApiRouter::class, 'getBookingDropdown']);

    Route::get("/page/{slug}",[VendorApiRouter::class, 'getPage']);

    Route::get("/faq/categories",[VendorApiRouter::class, 'faqCategories']);
    Route::get("/faq/categories/{category}",[VendorApiRouter::class, 'faqByCategory']);

    Route::put("/organization/update",[VendorApiRouter::class, 'updateOrganization']);
    Route::put("/location/update",[VendorApiRouter::class, 'updateLocation']);
    Route::put("/details/update",[VendorApiRouter::class, 'updateDetails']);

    Route::put("/profile/update",[VendorApiRouter::class, 'updateProfile']);

    //Webhooks for websocket server
    Route::post("/webhook/for-socket/booking/watch",[VendorApiRouter::class, 'startWatchOnBookingSocket']);
    Route::delete("/webhook/for-socket/booking/watch",[VendorApiRouter::class, 'stopWatchOnBookingSocket']);


});
