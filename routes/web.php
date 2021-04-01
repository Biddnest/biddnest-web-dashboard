<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\BidController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Carbon\CarbonImmutable;
use Carbon\Carbon;

use App\Http\Controllers\Route as Router;
use App\Http\Controllers\VendorController as VendorRouter;
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
Route::get('/', function () {

    return response()->redirectToRoute('login');
});

Route::get('/debug',function(){
    abort(500);
});


Route::prefix('web/api')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('/login', [Router::class, 'login'])->name("admin_login");

        Route::post('/password/otp/send',[Router::class,'forgot_password_send_otp'])->name("send_otp");
        Route::post('/password/otp/verify',[Router::class,'forgot_password_verify_otp'])->name("verify_otp");
        Route::post('/password/reset',[Router::class,'reset_password'])->name("reset_password");

    });

    //services APIs
    Route::get('/services',[Router::class,'service'])->name("service");
    Route::post('/services',[Router::class,'service_add'])->name("service_add");
    Route::put('/services',[Router::class,'service_edit'])->name("service_edit");
    Route::get('/services',[Router::class,'service_get'])->name("service_get");
    Route::delete('/services',[Router::class,'service_delete'])->name("service_delete");

    Route::get('/services/{id}/sub-services',[Router::class,'subservice_get_by_service'])->name("sub_service_get_by_service");


    //sub-services APIs
    Route::get('/sub-services',[Router::class,'subservice'])->name("sub_service");
    Route::post('/sub-services',[Router::class,'subservice_add'])->name("sub_service_add");
    Route::put('/sub-services',[Router::class,'subservice_edit'])->name("sub_service_edit");
    Route::get('/sub-services',[Router::class,'subservice_get'])->name("sub_service_get");
    Route::delete('/sub-services',[Router::class,'subservice_delete'])->name("sub_service_delete");

    //inventory APIs
    Route::get('/inventories',[Router::class,'inventories'])->name("inventories");
    Route::post('/inventories',[Router::class,'inventories_add'])->name("inventories_add");
    Route::put('/inventories',[Router::class,'inventories_edit'])->name("inventories_edit");
    Route::get('/inventories/{id}',[Router::class,'inventories_get'])->name("inventories_get");
    Route::delete('/inventories/{id}',[Router::class,'inventories_delete'])->name("inventories_delete");

    //organization API's==>updated Vendor Api's
    Route::post('/vendors',[Router::class,'vendor_add'])->name("add_onvoard_vendor");
    Route::put('/vendors',[Router::class,'vendor_edit'])->name("edit_onvoard_vendor");
    Route::get('/vendors',[Router::class,'vendor_fetch'])->name("vendor_fetch");

    Route::post('/vendors/branches',[Router::class,'branch_add'])->name("add_branch_vendor");
    Route::put('/vendors/branches',[Router::class,'branch_edit'])->name("edit_branch_vendor");
    Route::delete('/vendors/branches',[Router::class,'branch_delete'])->name("branch_delete");

    Route::post('/vendors/banking-details',[Router::class,'bank_add'])->name("bank_add");
    Route::put('/vendors/banking-details',[Router::class,'bank_add'])->name("bank_edit");

    Route::post('/vendors/roles',[Router::class,'role_add'])->name("role_add");
    Route::put('/vendors/roles',[Router::class,'role_edit'])->name("role_edit");
    Route::delete('/vendors/roles/delete',[Router::class,'role_delete'])->name("role_delete");


    // Route::delete('/organizations/{id}',[Router::class,'vendor_delete'])->name("vendor_delete");

    //zone APIs
    Route::get('/zones',[Router::class,'zones'])->name("zones");
    Route::post('/zones',[Router::class,'zones_add'])->name("zones_add");
    Route::put('/zones',[Router::class,'zones_edit'])->name("zones_edit");
    Route::get('/zones/{id}',[Router::class,'zones_get'])->name("zones_get");
    Route::delete('/zones/{id}',[Router::class,'zones_delete'])->name("zones_delete");


    //Sliders and Banners API
    Route::get('/sliders',[Router::class,'sliders'])->name("sliders");
    Route::post('/sliders',[Router::class,'sliders_add'])->name("sliders_add");
    Route::put('/sliders/{id}',[Router::class,'sliders_edit'])->name("sliders_edit");
    Route::delete('/sliders/{id}',[Router::class,'sliders_delete'])->name("sliders_delete");

    Route::get('/banners',[Router::class,'banners'])->name("banners");
    Route::post('/banners',[Router::class,'banners_add'])->name("banners_add");
    Route::delete('/banners/{id}',[Router::class,'banners_delete'])->name("banners_delete");

    Route::post('/coupon',[Router::class,'coupon_add'])->name("coupon_add");

    Route::get('/endbid',[Router::class,'end_bid'])->name("end_bid");

    Route::get('user/search', [Router::class, 'searchUser'])->name("search_user");

});

Route::prefix('vendors')->group(function () {
    Route::post('/inventory-price',[VendorRouter::class,'addPrice']);
    Route::get('/inventory-price',[VendorRouter::class,'getInventoryprices']);
    Route::put('/inventory-price',[VendorRouter::class,'updateInventoryprices']);
    Route::delete('/inventory-price',[VendorRouter::class,'deleteInventoryprices']);
});

Route::prefix('admin')->group(function () {
        Route::prefix('/auth')->middleware("redirectToDashboard")->group(function () {
            Route::get('/login',[WebController::class,'login'])->name("login");
            Route::get('/forgotpassword',[WebController::class,'forgotPassword'])->name("forgotpassword");
            // Route::get('/verifyotp',[WebController::class,'verifyOtp'])->name("verifyotp");
            Route::get('/reset-password',[WebController::class,'resetPassword'])->name("reset-password");
        });
            Route::get("/logout", [WebController::class, 'logout'])->name('logout');

    Route::middleware("checkSession")->group(function(){
        Route::get('/dashboard',[WebController::class,'dashboard'])->name("dashboard");
        Route::get('/settings',[WebController::class,'settings'])->name("settings");
        Route::get('/api-settings',[WebController::class,'apiSettings'])->name("api-settings");


        //booking and orders
        Route::prefix('booking')->group(function () {
            Route::get('/',[WebController::class,'ordersBookingsLive'])->name("orders-booking");
            Route::get('/past',[WebController::class,'ordersBookingsPast'])->name("orders-booking-past");
            Route::get('/details',[WebController::class,'orderDetails'])->name("order-details");
            Route::get('/create',[WebController::class,'createOrder'])->name("create-order");
        });

        Route::prefix('customers')->group(function () {
            Route::get('/',[WebController::class,'customers'])->name("customers");
            Route::get('/create',[WebController::class,'createCustomers'])->name("create-customers");
        });

        Route::prefix('vendors')->group(function () {
            Route::get('/',[WebController::class,'vendors'])->name("vendors");
            Route::get('/details',[WebController::class,'vendorsDetails'])->name("vendor-details");
            Route::get('/create',[WebController::class,'createOnboardVendors'])->name("create-vendors");
            Route::get('/lead',[WebController::class,'leadVendors'])->name("lead-vendors");
            Route::get('/pending',[WebController::class,'pendingVendors'])->name("pending-vendors");
            Route::get('/verified',[WebController::class,'verifiedVendors'])->name("verified-vendors");


            Route::get('/onboard',[WebController::class,'onbaordVendor'])->name("onboard-vendors");
            Route::get('/onboard/edit',[WebController::class,'onbaordEditr'])->name("onboard-edit-vendors");
            Route::get('/onboard/branch',[WebController::class,'onbaordBranch'])->name("onboard-branch-vendors");
            Route::get('/onboard/bank',[WebController::class,'onbaordBank'])->name("onboard-bank-vendors");
            Route::get('/onboard/role',[WebController::class,'onbaordUserRole'])->name("onboard-userrole-vendors");
        });

        Route::prefix('categories')->group(function () {
            Route::get('/',[WebController::class,'categories'])->name("categories");
            Route::get('/create',[WebController::class,'createCategories'])->name("create-categories");

            Route::get('/subcateories',[WebController::class,'subcateories'])->name("subcateories");
            Route::get('/subcateories/create',[WebController::class,'createSubcateories'])->name("create-subcateories");

            Route::get('/inventories',[WebController::class,'inventories'])->name("inventories");
            Route::get('/inventories/create',[WebController::class,'createInventories'])->name("create-inventories");
            Route::get('/inventories/details',[WebController::class,'detailsInventories'])->name("details-inventories");
            Route::get('/inventories/services/edit',[WebController::class,'editServices'])->name("edit-services");
        });

        Route::prefix('coupons')->group(function () {
            Route::get('/',[WebController::class,'coupons'])->name("coupons");
            Route::get('/create',[WebController::class,'createCoupons'])->name("create-coupons");
            Route::get('/details',[WebController::class,'detailsCoupons'])->name("details-coupons");
        });

        Route::prefix('zones')->group(function () {
            Route::get('/',[WebController::class,'zones'])->name("zones");
            Route::get('/create',[WebController::class,'createZones'])->name("create-zones");
            Route::get('/details',[WebController::class,'detailsZones'])->name("details-zones");
        });

        Route::prefix('slider')->group(function () {
            Route::get('/',[WebController::class,'slider'])->name("slider");
            Route::get('/create',[WebController::class,'createSlider'])->name("create-slider");
            Route::get('/{id}/banner', [WebController::class, 'manageBanner'])->name("create-banner");
            Route::get('/{id}', [WebController::class, 'editSlider'])->name("edit-slider");

            Route::get('/push-notification',[WebController::class,'pushNotification'])->name("push-notification");
            Route::get('/push-notification/create',[WebController::class,'createPushNotification'])->name("create-push-notification");
            Route::get('/mail-notification',[WebController::class,'mailNotification'])->name("mail-notification");
            Route::get('/mail-notification/create',[WebController::class,'createMailNotification'])->name("create-mail-notification");

            Route::get('/testimonials',[WebController::class,'testimonials'])->name("testimonials");
            Route::get('/testimonials/create',[WebController::class,'createTestimonials'])->name("create-testimonials");
        });

        Route::prefix('review')->group(function () {
            Route::get('/',[WebController::class,'review'])->name("review");
            Route::get('/create',[WebController::class,'createReview'])->name("create-review");

            Route::get('/complaints',[WebController::class,'complaints'])->name("complaints");
            Route::get('/complaints/create',[WebController::class,'createComplaints'])->name("create-complaint");

            Route::get('/service-requests',[WebController::class,'serviceRequests'])->name("service-requests");
            Route::get('/service-requests/create',[WebController::class,'createService'])->name("create-service");
        });

        Route::prefix('payout')->group(function () {
            Route::get('/',[WebController::class,'vendorPayout'])->name("vendor-payout");
            Route::get('/create',[WebController::class,'createVendorPayout'])->name("create-payout");
            Route::get('/details',[WebController::class,'detailsVendorPayout'])->name("payout-details");
        });

        Route::prefix('users')->group(function () {
            Route::get('/',[WebController::class,'users'])->name("users");
            Route::get('/create',[WebController::class,'createUsers'])->name("create-users");
            Route::get('/details',[WebController::class,'detailsUsers'])->name("details-users");
        });

        Route::prefix('sidebar')->group(function(){
            /*sample route below*/
//            Route::get('/customer',[WebController::class,'users'])->name("sidebar_users");
        });

    });

});

