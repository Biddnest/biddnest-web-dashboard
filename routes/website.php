<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */


use App\Http\Controllers\WebsiteRouteController as WebsiteRouter;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('website/api')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post("/login", [WebsiteRouter::class, 'login'])->name('website.login');
        Route::post("/otp", [WebsiteRouter::class, 'verifyOtp'])->name('website.otp');

    });

    Route::put('/book-move-estimate', [WebsiteRouter::class, 'bookingConfirmEstimate'])->name("order_estimate");

    Route::post('/add-vendor', [WebsiteRouter::class, 'addVendor'])->name("add_vendor");
    Route::put('/my-profile', [WebsiteRouter::class, 'editProfile'])->name("profile_edit");


    Route::post('/add-ticket', [WebsiteRouter::class, 'addTicket'])->name("add_ticket");
    Route::post('/raise_support', [WebsiteRouter::class, 'raiseTicket'])->name("raise_support");
    Route::post('/add-reject-ticket', [WebsiteRouter::class, 'addRejectTicket'])->name("add_cancel_ticket");
    Route::post('/cancel-ticket', [WebsiteRouter::class, 'addCancelTicket'])->name("cancel_ticket");
    Route::post('/add-reschedule-ticket', [WebsiteRouter::class, 'addReschedulTicket'])->name("reshcedulel_ticket");

    Route::post('/verified-coupon', [WebsiteRouter::class, 'verifiedCoupon'])->name("verifiedcoupon");
    Route::post('/initiate-payment', [WebsiteRouter::class, 'initiatePayment'])->name("initiate-payment");
    Route::post('/status/complete',[WebsiteRouter::class, 'statusComplete'])->name("complete-status");
});

Route::prefix('site')->group(function () {
    Route::get('/', [WebsiteController::class, 'home'])->name("home");
    Route::get('/join-vendor', [WebsiteController::class, 'joinVendor'])->name("join-vendor");
    Route::get('/contact-us', [WebsiteController::class, 'contactUs'])->name("contact_us");
    Route::get('/FAQ', [WebsiteController::class, 'faq'])->name("faq");
    Route::get('/T&C', [WebsiteController::class, 'termsAndCondition'])->name("terms_and_conditions");

    Route::get('/book-move', [WebsiteController::class, 'addBooking'])->name("add-booking");
    Route::get('/book-move/{id}/extimate', [WebsiteController::class, 'estimateBooking'])->name("estimate-booking");
    Route::get('/book-move/{id}/place', [WebsiteController::class, 'placeBooking'])->name("place-booking");
    Route::get('/my-bookings', [WebsiteController::class, 'myBookings'])->name("my-bookings");
    Route::get('/my-bookings/{id}/quote', [WebsiteController::class, 'finalQuote'])->name("final-quote");
    Route::get('/my-bookings/{id}/payment', [WebsiteController::class, 'payment'])->name("payment");
    Route::get('/my-bookings/{id}/payment-verified', [WebsiteController::class, 'verifiedPayment'])->name("verifiedpayment");
    Route::get('/my-bookings/{id}/ongoing-order', [WebsiteController::class, 'orderDetails'])->name("website.order-details");
    Route::get('/my-bookings/order-history', [WebsiteController::class, 'bookingHistory'])->name("order-history");
    Route::get('/my-profile', [WebsiteController::class, 'myProfile'])->name("website.my-profile");
    Route::get('/my-request', [WebsiteController::class, 'myRequest'])->name("my-request");

    Route::get('/complete-contact-us', [WebsiteController::class, 'completeContactUs'])->name("complete_contact_us");

    Route::middleware("checkWebSession")->group(function(){
//        Route::get('/home', [WebsiteController::class, 'home'])->name("home-logged");
    });
});



