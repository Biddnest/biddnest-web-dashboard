<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

use App\Enums\BookingEnums;
use App\Enums\NotificationEnums;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Route as Router;
use App\Http\Controllers\VendorRouteController as VendorRouter;
use App\Http\Controllers\VendorWebApiRouteController as VendorApiRouter;
use App\Http\Controllers\WebController;
use App\Http\Controllers\VendorWebController;
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

    Route::post('/password/reset',[Router::class,'old_reset_password'])->name("old_reset_password");
    //services APIs
    Route::get('/services',[Router::class,'service'])->name("service");
    Route::post('/services',[Router::class,'service_add'])->name("service_add");
    Route::put('/services',[Router::class,'service_edit'])->name("service_edit");
    Route::put('/services/{id}',[Router::class,'status_update'])->name("status_update");
    Route::get('/services',[Router::class,'service_get'])->name("service_get");
    Route::delete('/services/{id}',[Router::class,'service_delete'])->name("service_delete");

    Route::get('/services/{id}/sub-services',[Router::class,'subservice_get_by_service'])->name("sub_service_get_by_service");

    //sub-services APIs
    Route::get('/sub-services',[Router::class,'subservice'])->name("sub_service");
    Route::post('/sub-services',[Router::class,'subservice_add'])->name("sub_service_add");
    Route::put('/sub-services',[Router::class,'subservice_edit'])->name("sub_service_edit");
    Route::put('/sub-services/{id}',[Router::class,'subservice_status_update'])->name("sub_service_status_update");
    Route::get('/sub-services',[Router::class,'subservice_get'])->name("sub_service_get");
    Route::delete('/sub-services/{id}',[Router::class,'subservice_delete'])->name("sub_service_delete");

    //inventory APIs
    Route::get('/inventories',[Router::class,'inventories'])->name("inventories");
    Route::post('/inventories',[Router::class,'inventories_add'])->name("inventories_add");
    Route::put('/inventories',[Router::class,'inventories_edit'])->name("inventories_edit");
    Route::put('/inventories/{id}',[Router::class,'inventory_status_update'])->name("inventory_status_update");
    Route::get('/inventories/{id}',[Router::class,'inventories_get'])->name("inventories_get");
    Route::delete('/inventories/{id}',[Router::class,'inventories_delete'])->name("inventories_delete");

    Route::post('/booking',[Router::class,'booking_add'])->name("add_booking");
    Route::put('/confirm',[Router::class,'booking_confirm'])->name("order_confirm");
    Route::put('/reject',[Router::class,'booking_reject'])->name("order_reject");

    //organization API's==>updated Vendor Api's
    Route::post('/vendors',[Router::class,'vendor_add'])->name("add_onvoard_vendor");
    Route::put('/vendors',[Router::class,'vendor_edit'])->name("edit_onvoard_vendor");
    Route::delete('/vendors/{id}',[Router::class,'vendor_delete'])->name("vendor_delete");

    Route::post('/vendors/branches',[Router::class,'branch_add'])->name("add_branch_vendor");
    Route::put('/vendors/branches',[Router::class,'branch_edit'])->name("edit_branch_vendor");
    Route::delete('/vendors/{parent_id}/branches/{organization_id}',[Router::class,'branch_delete'])->name("delete_branch");

    Route::post('/vendors/banking-details',[Router::class,'bank_add'])->name("bank_add");

    Route::post('/vendors/roles',[Router::class,'role_add'])->name("role_add");
    Route::put('/vendors/roles',[Router::class,'role_edit'])->name("role_edit");
    Route::delete('/vendors/{organization_id}/roles/{vendor_id}',[Router::class,'role_delete'])->name("delete-role");

    Route::post('/customer',[Router::class,'customer_add'])->name("customer_add");
    Route::put('/customer',[Router::class,'customer_edit'])->name("customer_edit");

    //zone APIs
    Route::get('/zones',[Router::class,'zones'])->name("zones");
    Route::post('/zones',[Router::class,'zones_add'])->name("zones_add");
    Route::put('/zones',[Router::class,'zones_edit'])->name("zones_edit");
    Route::put('/zones/{id}',[Router::class,'zone_status_update'])->name("zone_status_update");
    Route::get('/zones/{id}',[Router::class,'zones_get'])->name("zones_get");
    Route::delete('/zones/{id}',[Router::class,'zones_delete'])->name("zones_delete");

    //Sliders and Banners API
    Route::get('/sliders',[Router::class,'sliders'])->name("sliders");
    Route::post('/sliders',[Router::class,'sliders_add'])->name("sliders_add");
    Route::put('/sliders',[Router::class,'sliders_edit'])->name("sliders_edit");
    Route::put('/sliders/{id}',[Router::class,'slider_status_update'])->name("slider_status_update");
    Route::delete('/sliders/{id}',[Router::class,'sliders_delete'])->name("sliders_delete");

    Route::get('/banners',[Router::class,'banners'])->name("banners");
    Route::post('/banners',[Router::class,'banners_add'])->name("banners_add");
    Route::delete('/banners/{id}',[Router::class,'banners_delete'])->name("banners_delete");

    Route::post('/notification',[Router::class,'notification_add'])->name("notification_add");

    Route::post('/coupon',[Router::class,'coupon_add'])->name("coupon_add");
    Route::put('/coupon',[Router::class,'coupon_edit'])->name("coupon_edit");
    Route::delete('/coupon/{id}',[Router::class,'coupon_delete'])->name("coupon_delete");

    Route::post('/testimonial',[Router::class,'testimonial_add'])->name("testimonial_add");
    Route::put('/testimonial',[Router::class,'testimonial_edit'])->name("testimonial_edit");
    Route::delete('/testimonial/{id}',[Router::class,'testimonial_delete'])->name("testimonial_delete");

    Route::post('/user',[Router::class,'user_add'])->name("user_add");
    Route::put('/user',[Router::class,'user_edit'])->name("user_edit");
    Route::put('/user/{id}',[Router::class,'user_status_update'])->name("user_status_update");
    Route::put('/bank',[Router::class,'bank_edit'])->name("bank_edit");
    Route::delete('/delete/{id}',[Router::class,'user_delete'])->name("user_delete");

    Route::post('/payout',[Router::class,'payout_add'])->name("payout_add");
    Route::put('/payout',[Router::class,'payout_edit'])->name("payout_edit");

    Route::get('/endbid',[Router::class,'end_bid'])->name("end_bid");

    Route::get('user/search', [Router::class, 'searchUser'])->name("search_user");
    Route::get('vendor/search', [Router::class, 'searchVendor'])->name("search_vendor");
    Route::get('admin/search', [Router::class, 'searchadmin'])->name("search_admin");

    Route::post('/pages',[Router::class,'page_add'])->name("page_add");
    Route::put('/pages',[Router::class,'page_edit'])->name("page_edit");
    Route::delete('/pages/{id}',[Router::class,'page_delete'])->name("page_delete");

    Route::post('/faq',[Router::class,'faq_add'])->name("faq_add");
    Route::post('/contact-us',[Router::class,'contact_us'])->name("contact_add");
    Route::post('/api-settings',[Router::class,'api_settings_update'])->name("api_settings_update");

    Route::post('/reply-add',[Router::class,'reply_add'])->name("add_reply");
    Route::put('/{id}/change-status',[Router::class,'changeStatus'])->name("change_status");

    Route::prefix('vendor')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('/login', [VendorRouter::class, 'login'])->name("api.vendor_login");
            Route::post('/password/otp/send',[VendorRouter::class,'forgot_password_send_otp'])->name("api.vendor_send_otp");
            Route::post('/password/otp/verify',[VendorRouter::class,'forgot_password_verify_otp'])->name("api.vendor_verify_otp");
            Route::post('/password/reset',[VendorRouter::class,'reset_password'])->name("api.vendor_reset_password");
        });

        Route::post('/inventory-price',[VendorRouter::class,'addPrice']);
        Route::get('/inventory-price',[VendorRouter::class,'getInventoryprices']);
        Route::put('/inventory-price',[VendorRouter::class,'updateInventoryprices']);
        Route::delete('/inventory-price',[VendorRouter::class,'deleteInventoryprices']);
    });

});

Route::prefix('admin')->group(function () {
        Route::prefix('/auth')->middleware("redirectToDashboard")->group(function () {
            Route::get('/login',[WebController::class,'login'])->name("login");
            Route::get('/forgotpassword',[WebController::class,'forgotPassword'])->name("forgotpassword");
            Route::get('/verifyotp',[WebController::class,'verifyOtp'])->name("verifyotp");
            Route::get('/reset-password/{id}',[WebController::class,'resetPassword'])->name("reset-passwords");
        });
            Route::get('/reset-password',[WebController::class,'Passwordreset'])->name("password-reset");
            Route::get("/logout", [WebController::class, 'logout'])->name('logout');
            Route::get("/switch-zone", [WebController::class, 'switchToZone'])->name('switch-zone');

    Route::middleware("checkSession")->group(function(){
        Route::get('/dashboard',[WebController::class,'dashboard'])->name("dashboard");
        Route::get('/my-profile/{id}',[WebController::class,'details_user'])->name('my-profile');
        Route::get('/api-settings',[WebController::class,'apiSettings'])->name("api-settings");

        Route::get('/pages',[WebController::class,'pages'])->name("pages");
        Route::get('/pages/create',[WebController::class,'createpages'])->name("pages_create");
        Route::get('/{id}/pages',[WebController::class,'createpages'])->name("pages_edit");

        Route::get('/faq',[WebController::class,'faq'])->name("faq");
        Route::get('/contact-us',[WebController::class,'contact_us'])->name("contact_us");

        //booking and orders
        Route::prefix('booking')->group(function () {
            Route::get('/',[WebController::class,'ordersBookingsLive'])->name("orders-booking");
            Route::get('/past',[WebController::class,'ordersBookingsPast'])->name("orders-booking-past");

            Route::get('/{id}/details',[WebController::class,'orderDetailsCustomer'])->name("order-details");
            Route::get('/{id}/details/payment',[WebController::class,'orderDetailsPayment'])->name("order-details-payment");
            Route::get('/{id}/details/vendor',[WebController::class,'orderDetailsVendor'])->name("order-details-vendor");
            Route::get('/{id}/details/quotation',[WebController::class,'orderDetailsQuotation'])->name("order-details-quotation");
            Route::get('/{id}/details/bidding',[WebController::class,'orderDetailsBidding'])->name("order-details-bidding");
            Route::get('/{id}/details/review',[WebController::class,'orderDetailsReview'])->name("order-details-review");

            Route::get('/create',[WebController::class,'createOrder'])->name("create-order");
            Route::get('/{id}/confirm',[WebController::class,'confirmOrder'])->name("confirm-order");
            Route::get('/{id}/reject',[WebController::class,'rejectOrder'])->name("reject-order");
        });

        Route::prefix('customers')->group(function () {
            Route::get('/',[WebController::class,'customers'])->name("customers");
            Route::get('/create',[WebController::class,'createCustomers'])->name("create-customers");
            Route::get('/{id}/edit',[WebController::class,'createCustomers'])->name("edit-customers");
        });

        Route::prefix('vendors')->group(function () {
            Route::get('/',[WebController::class,'vendors'])->name("vendors");
            Route::get('/{id}/details',[WebController::class,'vendorsDetails'])->name("vendor-details");
            Route::get('/lead',[WebController::class,'leadVendors'])->name("lead-vendors");
            Route::get('/pending',[WebController::class,'pendingVendors'])->name("pending-vendors");
            Route::get('/verified',[WebController::class,'verifiedVendors'])->name("verified-vendors");

            Route::get('/onboard',[WebController::class,'createOnboardVendors'])->name("create-vendors");
            Route::get('/{id}/edit',[WebController::class,'onbaordEdit'])->name("onboard-edit-vendors");
            Route::get('/{id}/branch',[WebController::class,'onbaordBranch'])->name("onboard-branch-vendors");
            Route::get('/{id}/bank',[WebController::class,'onbaordBank'])->name("onboard-bank-vendors");
            Route::get('/{id}/role',[WebController::class,'onbaordUserRole'])->name("onboard-userrole-vendors");
        });

        Route::prefix('categories')->group(function () {
            Route::get('/',[WebController::class,'categories'])->name("categories");
            Route::get('/create',[WebController::class,'createCategories'])->name("create-categories");
            Route::get('/{id}/edit',[WebController::class,'createCategories'])->name("edit-categories");

            Route::get('/subcateories',[WebController::class,'subcateories'])->name("subcateories");
            Route::get('/subcateories/create',[WebController::class,'createSubcateories'])->name("create-subcateories");
            Route::get('/subcateories/{id}/edit',[WebController::class,'createSubcateories'])->name("edit-subcateories");

            Route::get('/inventories',[WebController::class,'inventories'])->name("inventories");
            Route::get('/inventories/create',[WebController::class,'createInventories'])->name("create-inventories");
            Route::get('/inventories/details',[WebController::class,'detailsInventories'])->name("details-inventories");
            Route::get('/inventories/{id}/edit',[WebController::class,'createInventories'])->name("edit-services");
        });

        Route::prefix('coupons')->group(function () {
            Route::get('/',[WebController::class,'coupons'])->name("coupons");
            Route::get('/create',[WebController::class,'createCoupons'])->name("create-coupons");
            Route::get('/{id}/edit',[WebController::class,'createCoupons'])->name("edit-coupons");
            Route::get('/details',[WebController::class,'detailsCoupons'])->name("details-coupons");
        });

        Route::prefix('zones')->group(function () {
            Route::get('/',[WebController::class,'zones'])->name("zones");
            Route::get('/create',[WebController::class,'createZones'])->name("create-zones");
            Route::get('/{id}/edit',[WebController::class,'createZones'])->name("edit-zones");
        });

        Route::prefix('slider')->group(function () {
            Route::get('/',[WebController::class,'slider'])->name("slider");
            Route::get('/testimonials',[WebController::class,'testimonials'])->name("testimonials");
            Route::get('/push-notification',[WebController::class,'pushNotification'])->name("push-notification");

            Route::get('/create',[WebController::class,'createSlider'])->name("create-slider");
            Route::get('/{id}/banner', [WebController::class, 'manageBanner'])->name("create-banner");
            Route::get('/{id}', [WebController::class, 'editSlider'])->name("edit-slider");


            Route::get('/push-notification/create',[WebController::class,'createPushNotification'])->name("create-push-notification");
            Route::get('/mail-notification',[WebController::class,'mailNotification'])->name("mail-notification");
            Route::get('/mail-notification/create',[WebController::class,'createMailNotification'])->name("create-mail-notification");

            Route::get('/testimonials/create',[WebController::class,'createTestimonials'])->name("create-testimonials");
            Route::get('/testimonials/{id}/edit',[WebController::class,'createTestimonials'])->name("edit-testimonials");
        });

        Route::prefix('review')->group(function () {
            Route::get('/',[WebController::class,'review'])->name("review");
            Route::get('/create',[WebController::class,'createReview'])->name("create-review");

            Route::get('/{id}/reply',[WebController::class,'reply'])->name("reply");

            Route::get('/complaints',[WebController::class,'complaints'])->name("complaints");
            Route::get('/complaints/create',[WebController::class,'createComplaints'])->name("create-complaint");

            Route::get('/tickets',[WebController::class,'serviceRequests'])->name("service-requests");
            Route::get('/tickets/create',[WebController::class,'createService'])->name("create-service");
        });

        Route::prefix('payout')->group(function () {
            Route::get('/',[WebController::class,'vendorPayout'])->name("vendor-payout");
            Route::get('/create',[WebController::class,'createVendorPayout'])->name("create-payout");
            Route::get('/{id}/edit',[WebController::class,'createVendorPayout'])->name("edit-payout");
            Route::get('/details',[WebController::class,'detailsVendorPayout'])->name("payout-details");
        });

        Route::prefix('users')->group(function () {
            Route::get('/',[WebController::class,'users'])->name("users");
            Route::get('/create',[WebController::class,'createUsers'])->name("create-users");
            Route::get('/{id}/edit',[WebController::class,'createUsers'])->name("edit-users");
            Route::get('/{id}/bank',[WebController::class,'createBank'])->name("create-bank");
            Route::get('/details/{id}',[WebController::class,'details_user'])->name('details_user');
        });

    });

    Route::prefix('sidebar')->group(function(){
        Route::get('/booking/{id}',[WebController::class,'sidebar_booking'])->name('sidebar.booking');
        Route::get('/vendors/{id}',[WebController::class,'sidebar_vendors'])->name('sidebar.vendors');
        Route::get('/coupons/{id}',[WebController::class,'sidebar_coupons'])->name('sidebar.coupon');
        Route::get('/customer/{id}',[WebController::class,'sidebar_customer'])->name('sidebar.customer');
        Route::get('/subcateories/{id}',[WebController::class,'sidebar_subcategory'])->name('sidebar.subcategory');
        Route::get('/slider/{id}',[WebController::class,'sidebar_slider'])->name('sidebar.slider');
        Route::get('/user/{id}',[WebController::class,'sidebar_user'])->name('sidebar.user');
        Route::get('/payout/{id}',[WebController::class,'sidebar_payout'])->name('sidebar.payout');
    });


});
Route::get('/debug/socket', function () {
    return view("debug.socket");
});


Route::prefix('vendor')->group(function(){
    Route::prefix('/auth')->group(function () {
        Route::get('/login',[VendorWebController::class,'login'])->name("vendor.login");
        Route::get('/forgot-password',[VendorWebController::class,'forgotPassword'])->name("vendor.forgotpassword");
        Route::get('/reset-password/{id}',[VendorWebController::class,'resetPassword'])->name("vendor.reset-passwords");
        Route::get('/{phone}/verify-otp',[VendorWebController::class,'verifyOtp'])->name("vendor.verifyotp");
    });
    Route::get('/dashboard',[VendorWebController::class,'dashboard'])->name("vendor.dashboard");


    Route::prefix('/booking')->group(function () {
        Route::get('/{type}',[VendorWebController::class,'bookingType'])->name("vendor.bookings");
    });

    Route::prefix('/users')->middleware("redirectToDashboard")->group(function () {
        Route::get('/create',[VendorWebController::class,'login'])->name("vendor.suer.create");
        Route::get('/{id}/view',[VendorWebController::class,'login'])->name("vendor.user.view");
        Route::get('/{id}/edit',[VendorWebController::class,'login'])->name("vendor.users.edit");

        Route::get('/sidebar',[VendorWebController::class,'login'])->name("vendor.users.sidebar");

        Route::get('/{role}',[VendorWebController::class,'login'])->name("vendor.users");
    });

    Route::get('/inventories/{id}/edit',[VendorWebController::class,'login'])->name("vendor.inventory.edit");
    Route::get('/inventories/sidebar',[VendorWebController::class,'login'])->name("vendor.inventory.sidebar");
    Route::get('/inventories/{category}',[VendorWebController::class,'login'])->name("vendor.inventory");


    Route::get('/branches',[VendorWebController::class,'login'])->name("vendor.branches");
    Route::get('/vehicles',[VendorWebController::class,'login'])->name("vendor.vehicles");
    Route::get('/payouts',[VendorWebController::class,'login'])->name("vendor.payouts");
    Route::get('/my-service-requests',[VendorWebController::class,'login'])->name("vendor.my-service-requests");
    Route::get('/reports',[VendorWebController::class,'login'])->name("vendor.reports");





});


Route::get('/debug/push/booking', function () {
    return NotificationController::sendTo("user", [202], "Your booking has been confirmed.", "We are get the best price you. You will be notified soon.", [
        "type" => NotificationEnums::$TYPE['booking'],
        "public_booking_id" => "BD606AD99B49C69",
        "booking_status" => BookingEnums::$STATUS['biding']
    ], null);
});
Route::get('/debug/push/url', function () {
    return NotificationController::sendTo("user", [202], "Your booking has been confirmed.", "We are get the best price you. You will be notified soon.", [
        "type" => NotificationEnums::$TYPE['link'],
        "url" => "https://google.com"
    ], null);

});

