<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

use App\Http\Controllers\ExportController;
use App\Http\Controllers\Route as Router;
use App\Http\Controllers\VendorRouteController as VendorRouter;
use App\Http\Controllers\VendorWebController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\WebsiteRouteController as WebsiteRouter;
use Illuminate\Support\Facades\Artisan;
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
    return response()->redirectToRoute('home');
});

Route::prefix('jobs')->group(function () {
    Route::get('/debug/vendor-notification', function () {
        NotificationController::sendTo("vendor", [40,41,42,1], "Your booking has been recieved.", "We are getting the best price for you. You will be notified soon.", [
            "type" => 1,
            "public_booking_id" => "BDO-616EC45796669",
            "booking_status" => 2
        ]);

        echo "sent";
    });
    Route::get('/hard-reset-cache', function () {
        echo Artisan::call("optimize:clear");
        echo Artisan::call("view:cache");
        echo Artisan::call("config:cache");
//        echo Artisan::call("route:cache");
        echo Artisan::call("event:cache");
        echo "All cache reseted";
    });
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
    Route::get('/sub-services/items',[Router::class,'subservice_items'])->name("subservice-items");

    Route::get('/sub-services/category/inventories',[Router::class,'getSubserviceInventories'])->name("subservice-category-inventories");

    //inventory APIs
    Route::get('/inventories',[Router::class,'inventories'])->name("inventories");
    Route::post('/inventories',[Router::class,'inventories_add'])->name("inventories_add");
    Route::put('/inventories',[Router::class,'inventories_edit'])->name("inventories_edit");
    Route::put('/inventories/{id}',[Router::class,'inventory_status_update'])->name("inventory_status_update");
    Route::get('/inventories/{id}',[Router::class,'inventories_get'])->name("inventories_get");
    Route::delete('/inventories/{id}',[Router::class,'inventories_delete'])->name("inventories_delete");
    Route::post('/inventories/import',[Router::class,'inventories_import'])->name("inventories_import");

    Route::post('/booking',[Router::class,'booking_add'])->name("add_booking");
    Route::put('/confirm',[Router::class,'booking_confirm'])->name("order_confirm");
    Route::put('/reject',[Router::class,'booking_reject'])->name("order_reject");
    Route::post('/add-bid',[Router::class,'booking_add_bid'])->name("add_booking_bid");
    Route::get('/otp-bid/{id}',[Router::class,'send_otp_bid'])->name("send_bid_otp");
    Route::get('/otp-booking',[Router::class,'send_otp_booking'])->name("send_booking_otp");

    Route::put('/book/edit',[Router::class,'booking_edit'])->name("edit_booking");
    Route::post('/bid/edit',[Router::class,'booking_fianl_bid_edit'])->name("edit_booking_final_bid");

    Route::put("/booking/status",[Router::class, 'bookinStatusChange'])->name("status-change-booking");

    Route::get("/autofill",[Router::class, 'autofill_customer_data'])->name("autofill-customer-data");

    //organization API's==>updated Vendor Api's
    Route::post('/vendors',[Router::class,'vendor_add'])->name("add_onvoard_vendor");
    Route::put('/vendors',[Router::class,'vendor_edit'])->name("edit_onvoard_vendor");
    Route::post('/prices/add',[Router::class,'prices_add'])->name("add_pricing");
    Route::post('/prices/update',[Router::class,'prices_update'])->name("update_pricing");
    Route::delete('/vendors/{id}',[Router::class,'vendor_delete'])->name("vendor_delete");

    Route::post('/vendors/branches',[Router::class,'branch_add'])->name("add_branch_vendor");
    Route::put('/vendors/branches',[Router::class,'branch_edit'])->name("edit_branch_vendor");
    Route::delete('/vendors/{parent_id}/branches/{organization_id}',[Router::class,'branch_delete'])->name("delete_branch");

    Route::post('/vendors/banking-details',[Router::class,'bank_add'])->name("bank_add");
    Route::put('/vendors/action/{id}/{status}',[Router::class,'vendor_action'])->name("onboard-action-status");

    Route::post('/vendors/roles',[Router::class,'role_add'])->name("role_add");
    Route::put('/vendors/roles',[Router::class,'role_edit'])->name("role_edit");
    Route::delete('/vendors/{organization_id}/roles/{vendor_id}',[Router::class,'role_delete'])->name("delete-role");

    Route::post('/customer',[Router::class,'customer_add'])->name("customer_add");
    Route::put('/customer',[Router::class,'customer_edit'])->name("customer_edit");
    Route::post('/points/add',[Router::class,'addPoints'])->name("admin.add_points");
    Route::post('/points/reddem',[Router::class,'redeemPoints'])->name("admin.redeem_points");

    //zone APIs
    Route::get('/zones',[Router::class,'zones'])->name("zones");
    Route::post('/zones',[Router::class,'zones_add'])->name("zones_add");
    Route::put('/zones',[Router::class,'zones_edit'])->name("zones_edit");
    Route::put('/zones/{id}',[Router::class,'zone_status_update'])->name("zone_status_update");
    Route::get('/zones/{id}',[Router::class,'zones_get'])->name("zones_get");
    Route::delete('/zones/{id}',[Router::class,'zones_delete'])->name("zones_delete");
    Route::post('/zones/referal',[Router::class,'zones_referal'])->name("zones_save_referal");

    Route::post('/cities',[Router::class,'cities_add'])->name("cities_add");
    Route::put('/cities',[Router::class,'cities_edit'])->name("cities_edit");
    Route::put('/cities/{id}',[Router::class,'city_status_update'])->name("city_status_update");
    Route::delete('/cities/{id}',[Router::class,'cities_delete'])->name("cities_delete");

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

    Route::get('/mail/{booking_id}',[Router::class,'sendInvoiceMail']);

    Route::post('/coupon',[Router::class,'coupon_add'])->name("coupon_add");
    Route::put('/coupon',[Router::class,'coupon_edit'])->name("coupon_edit");
    Route::delete('/coupon/{id}',[Router::class,'coupon_delete'])->name("coupon_delete");
    Route::put('/coupon/{id}',[Router::class,'coupon_status_update'])->name("coupon_status_update");

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
    Route::get('/contact/{id}',[Router::class,'addContact'])->name("payout_contact");

    Route::get('/endbid',[Router::class,'end_bid'])->name("end_bid");

    Route::get('user/search', [Router::class, 'searchUser'])->name("search_user");
    Route::get('vendor/search', [Router::class, 'searchVendor'])->name("search_vendor");
    Route::get('admin/search', [Router::class, 'searchadmin'])->name("search_admin");
    Route::get('inventory/search', [Router::class, 'searchitem'])->name("search_inventory");
    Route::get('order/serach', [Router::class, 'serachOrder'])->name("search_order");

    Route::post('/pages',[Router::class,'page_add'])->name("page_add");
    Route::put('/pages',[Router::class,'page_edit'])->name("page_edit");
    Route::delete('/pages/{id}',[Router::class,'page_delete'])->name("page_delete");

    Route::post('/faq',[Router::class,'faq_add'])->name("faq_add");
    Route::put('/edit/faq',[Router::class,'faq_edit'])->name("faq_edit");
    Route::delete('/delete/{id}/faq',[Router::class,'faq_delete'])->name("faq_delete");
    Route::post('/contact-us',[Router::class,'contact_us'])->name("contact_add");
    Route::post('/api-settings',[Router::class,'api_settings_update'])->name("api_settings_update");
    Route::post('/api-settings-general',[Router::class,'api_settings_general'])->name("api_settings_general");
    Route::post('/add/complaint',[Router::class,'complaintAdd'])->name("complaint_add");

    Route::post('/reply-add',[Router::class,'reply_add'])->name("add_reply");
    Route::put('/{id}/change-status',[Router::class,'changeStatus'])->name("change_status");
    Route::put('/{id}/{org_id}/{cat_id}/change-price-status',[Router::class,'changeStatusPrice'])->name("change_priceticket_status");
    Route::put('/{id}/change-branch-status',[Router::class,'changeStatusBranch'])->name("change_Branchticket_status");
    Route::put('/{id}/reschedule-order',[Router::class,'rescheduleOrder'])->name("web.reschedule-order");
    Route::put('/{id}/cancel-order',[Router::class,'cancelOrder'])->name("cancel-order");

    Route::post('/reports/csv',[ExportController::class,'exoprtSale'])->name("export.csv");
    Route::get('/download/csv',[ExportController::class,'downloadCsv'])->name("download.csv");

    Route::post('/booking/assign-va',[Router::class,'assignVirtualAssistant'])->name("api.va.assign");


    Route::post('/voucher/add',[Router::class,'voucherCreate'])->name("api.voucher.add");
    Route::put('/voucher/edit',[Router::class,'voucherEdit'])->name("api.voucher.edit");
    Route::delete('/voucher/delete/{id}',[Router::class,'voucherDelete'])->name("api.voucher.delete");

    /*vendor web apis start*/
    Route::prefix('vendor')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::post('/login', [VendorRouter::class, 'login'])->name("api.vendor_login");
            Route::post('/password/otp/send',[VendorRouter::class,'forgot_password_send_otp'])->name("api.vendor_send_otp");
            Route::post('/password/otp/verify',[VendorRouter::class,'forgot_password_verify_otp'])->name("api.vendor_verify_otp");
            Route::post('/password/reset',[VendorRouter::class,'reset_password'])->name("api.vendor_reset_password");
        });

        Route::post('/password/reset',[VendorRouter::class,'old_reset_password'])->name("api.vendor_old_reset_password");

        Route::post('/inventory-price',[VendorRouter::class,'addPrice'])->name("api.addPrice");
        Route::get('/inventory-price',[VendorRouter::class,'getInventoryprices'])->name("api.getInventoryPrices");
        Route::put('/inventory-price',[VendorRouter::class,'updateInventoryprices'])->name("api.updateInventoryPrices");
        Route::delete('/inventory-price',[VendorRouter::class,'deleteInventoryprices'])->name("api.deleteInventoryPrices");

        Route::post('/booking/bid',[VendorRouter::class,'addBid'])->name("api.booking.bid");
        Route::put('/booking/{id}/reject',[VendorRouter::class,'reject'])->name("api.booking.reject");
        Route::put('/booking/{id}/bookmark',[VendorRouter::class,'addBookmark'])->name("api.booking.bookmark");
        Route::post('/booking/assign-driver',[VendorRouter::class,'assignDriver'])->name("api.driver.assign");


        Route::post('/tickets',[VendorRouter::class,'createTickets'])->name("api.tickets.create");
        Route::post('/add/reply',[VendorRouter::class,'addReply'])->name("api.ticket.addreply");
        Route::post('/tickets/add',[VendorRouter::class,'addTickets'])->name("api.ticket.addticket");

        Route::put('/user/status',[VendorRouter::class,'userToggle'])->name("api.user.status");
        Route::post('/user/add',[VendorRouter::class,'addUser'])->name("api.user.add");
        Route::put('/user/edit',[VendorRouter::class,'editUser'])->name("api.user.edit");
        Route::delete('/user/{id}',[VendorRouter::class,'deleteUser'])->name("api.user.delete");

        Route::post('/branch/add',[VendorRouter::class,'branch_add'])->name("api.branch.add");
        Route::put('/branch/edit',[VendorRouter::class,'branch_edit'])->name("api.branch.edit");

        Route::put('/reset-pin',[VendorRouter::class,'addPin'])->name("api.vendor.reset-pine");
        Route::put('/start-trip',[VendorRouter::class,'startTrip'])->name("api.vendor.start-pin");
        Route::put('/end-trip',[VendorRouter::class,'endTrip'])->name("api.vendor.end-pin");

        Route::post('/vehicle',[VendorRouter::class,'addVehicle'])->name("api.vehicle.create");
        Route::put('/vehicle',[VendorRouter::class,'updateVehicle'])->name("api.vehicle.update");
        Route::delete('/vehicle/{id}',[VendorRouter::class,'deleteVehicle'])->name("api.vehicle.delete");



    });
    /*vendor web apis end*/


});

/* Admin page routes */
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return response()->redirectToRoute('login');
    });
        Route::prefix('/auth')->middleware("redirectToDashboard")->group(function () {
            Route::get('/login',[WebController::class,'login'])->name("login");
            Route::get('/forgotpassword',[WebController::class,'forgotPassword'])->name("forgotpassword");
            Route::get('/verifyotp',[WebController::class,'verifyOtp'])->name("verifyotp");
            Route::get('/reset-password/{id}',[WebController::class,'resetPassword'])->name("reset-passwords");
        });
            Route::get('/reset-password',[WebController::class,'Passwordreset'])->name("password-reset");
            Route::get("/logout", [WebController::class, 'logout'])->name('admin.logout');
            Route::get("/switch-zone", [WebController::class, 'switchToZone'])->name('switch-zone');

    Route::middleware("checkSession")->group(function(){
        Route::get('/dashboard',[WebController::class,'dashboard'])->name("dashboard");
        Route::get('/my-profile/{id}',[WebController::class,'details_user'])->name('my-profile');
        Route::get('/api-settings',[WebController::class,'apiSettings'])->name("api-settings");
        Route::get('/api-settings-api',[WebController::class,'apiSettingsapi'])->name("api-settings-api");

        Route::get('/pages',[WebController::class,'pages'])->name("pages");
        Route::get('/pages/create',[WebController::class,'createpages'])->name("pages_create");
        Route::get('/{id}/pages',[WebController::class,'createpages'])->name("pages_edit");

        Route::get('/faq',[WebController::class,'faq'])->name("admin.faq");
        Route::get('/faq/{type}',[WebController::class,'faq_by_category'])->name("admin.type.faq");
        Route::get('/add/faq',[WebController::class,'addfaq'])->name("admin.addfaq");
        Route::get('/edit/{id}/faq',[WebController::class,'editfaq'])->name("admin.editfaq");
        Route::get('/contact-us',[WebController::class,'contact_us'])->name("admin.contact_us");

        Route::get('/zone/check-serviceability',[Router::class, 'checkServiceable'])->name("admin.zone.check-serviceability");

        Route::get('/search/result/',[WebController::class,'searchResult'])->name("admin.searchresult");
        Route::get('/filter/result/',[WebController::class,'filterResult'])->name("admin.filter-booking");
        //booking and orders
        Route::prefix('booking')->group(function () {
            Route::get('/enquiry',[WebController::class,'ordersBookingsEnquiry'])->name("enquiry-booking");
            Route::get('/live',[WebController::class,'ordersBookingsLive'])->name("orders-booking");
            Route::get('/past',[WebController::class,'ordersBookingsPast'])->name("orders-booking-past");
            Route::get('/hold',[WebController::class,'ordersBookingsHold'])->name("orders-booking-hold");
            Route::get('/bounced',[WebController::class,'ordersBookingsBounced'])->name("orders-booking-bounced");
            Route::get('/cancelled',[WebController::class,'ordersBookingsCancelled'])->name("orders-booking-cancelled");
            Route::get('/inprogress',[WebController::class,'ordersBookingsInProgress'])->name("orders-booking-inprogress");

            Route::get('/{id}/details',[WebController::class,'orderDetailsCustomer'])->name("order-details");
            Route::get('/{id}/details/payment',[WebController::class,'orderDetailsPayment'])->name("order-details-payment");
            Route::get('/{id}/details/vendor',[WebController::class,'orderDetailsVendor'])->name("order-details-vendor");
            Route::get('/{id}/details/action',[WebController::class,'orderDetailsAction'])->name("order-details-estimate");
            Route::get('/{id}/details/quotation',[WebController::class,'orderDetailsQuotation'])->name("order-details-quotation");
            Route::get('/{id}/details/bidding',[WebController::class,'orderDetailsBidding'])->name("order-details-bidding");
            Route::get('/{id}/details/bidding/review',[WebController::class,'orderBiddingReview'])->name("order-bidding-review");
            Route::get('/{id}/details/review',[WebController::class,'orderDetailsReview'])->name("order-details-review");
            Route::get('/{id}/details/cancel',[WebController::class,'orderDetailsCancel'])->name("order-details-cancel");

            Route::get('/create',[WebController::class,'createOrder'])->name("create-order");
            Route::get('/edit/{id}',[WebController::class,'editOrder'])->name("edit-order");
            Route::get('/{id}/confirm',[WebController::class,'confirmOrder'])->name("confirm-order");
            Route::get('/{id}/reject',[WebController::class,'rejectOrder'])->name("reject-order");
        });

        Route::prefix('customers')->group(function () {
            Route::get('/',[WebController::class,'customers'])->name("customers");
            Route::get('/create',[WebController::class,'createCustomers'])->name("create-customers");
            Route::get('/{id}/edit',[WebController::class,'createCustomers'])->name("edit-customers");
            Route::get('/{id}/reward-points',[WebController::class,'customerRewardPoints'])->name("rewards-customers");
            Route::get('/{id}/vouchers',[WebController::class,'customerVouchers'])->name("vouchers-customers");
        });

        Route::prefix('vendors')->group(function () {
            Route::get('/',[WebController::class,'vendors'])->name("vendors");
            Route::get('/{id}/details',[WebController::class,'vendorsDetails'])->name("vendor-details");
            Route::get('/lead',[WebController::class,'leadVendors'])->name("lead-vendors");
            Route::get('/pending',[WebController::class,'pendingVendors'])->name("pending-vendors");
            Route::get('/verified',[WebController::class,'verifiedVendors'])->name("verified-vendors");

            Route::get('/onboard',[WebController::class,'createOnboardVendors'])->name("create-vendors");
            Route::get('/{id}/edit',[WebController::class,'onbaordEdit'])->name("onboard-edit-vendors");
            Route::get('/{id}/base-price',[WebController::class,'onbaordBasePrice'])->name("onboard-base-price");
            Route::get('/{id}/extra-base-price',[WebController::class,'onbaordExtraBasePrice'])->name("onboard-base-extra-price");
            Route::get('/{id}/branch',[WebController::class,'onbaordBranch'])->name("onboard-branch-vendors");
            Route::get('/{id}/bank',[WebController::class,'onbaordBank'])->name("onboard-bank-vendors");
            Route::get('/{id}/action',[WebController::class,'onbaordAction'])->name("onboard-action");
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

        Route::prefix('refferal-vouchers')->group(function () {
            Route::get('/',[WebController::class,'vouchers'])->name("vouchers");
            Route::get('/create',[WebController::class,'createVoucher'])->name("create-voucher");
            Route::get('/{id}/edit',[WebController::class,'createVoucher'])->name("edit-voucher");
        });

        Route::prefix('zones')->group(function () {
            Route::get('/',[WebController::class,'zones'])->name("zones");
            Route::get('/create',[WebController::class,'createZones'])->name("create-zones");
            Route::get('/{id}/edit',[WebController::class,'createZones'])->name("edit-zones");
            Route::get('/{id}/referral-system',[WebController::class,'zoneReferralSystem'])->name("zone-referral-system");
            Route::prefix('cities')->group(function () {
                Route::get('/',[WebController::class,'zonesCity'])->name("zones-city");
                Route::get('/create',[WebController::class,'createCities'])->name("create-cities");
                Route::get('/{id}/edit',[WebController::class,'createCities'])->name("edit-cities");
            });
        });

        Route::prefix('slider')->group(function () {
            Route::get('/',[WebController::class,'slider'])->name("slider");
            Route::get('/testimonials',[WebController::class,'testimonials'])->name("testimonials");

            Route::get('/create',[WebController::class,'createSlider'])->name("create-slider");
            Route::get('/{id}/banner', [WebController::class, 'manageBanner'])->name("create-banner");
            Route::get('/{id}', [WebController::class, 'editSlider'])->name("edit-slider");

            Route::get('/testimonials/create',[WebController::class,'createTestimonials'])->name("create-testimonials");
            Route::get('/testimonials/{id}/edit',[WebController::class,'createTestimonials'])->name("edit-testimonials");
        });

        Route::prefix('notifications')->group(function () {
            Route::get('/',[WebController::class,'pushNotification'])->name("push-notification");
            Route::get('/create',[WebController::class,'createPushNotification'])->name("create-push-notification");
            Route::get('/mail-notification',[WebController::class,'mailNotification'])->name("mail-notification");
            Route::get('/mail-notification/create',[WebController::class,'createMailNotification'])->name("create-mail-notification");
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
        Route::prefix('reports')->group(function () {
            Route::get('/',[WebController::class,'reports_summary'])->name("report.summary");
            Route::get('/sales',[WebController::class,'sales_report'])->name("report.sales");
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
        Route::get('/reviews/{id}',[WebController::class,'sidebar_reviews'])->name('sidebar.reviews');
        Route::get('/branch/{id}',[WebController::class,'sidebar_branch'])->name('sidebar.branch');
        Route::get('/inventory_price/{id}/{org_id}/{cat_id}',[WebController::class,'sidebar_inventory'])->name('sidebar.inventory');
    });

    Route::get('/impersonate',[WebController::class,'impersonateVendor'])->name('impersonate.vendor');


});

/* Vendor page routes */
Route::prefix('vendor')->group(function(){
    Route::get('/', function () {
        return response()->redirectToRoute('vendor.login');
    });

    Route::prefix('/auth')->middleware('redirectToVendorDashboard')->group(function () {
        Route::get('/login',[VendorWebController::class,'login'])->name("vendor.login");
        Route::get('/forgot-password',[VendorWebController::class,'forgotPassword'])->name("vendor.forgotpassword");
        Route::get('/reset-password/{id}',[VendorWebController::class,'resetPassword'])->name("vendor.reset-passwords");
        Route::get('/{phone}/verify-otp',[VendorWebController::class,'verifyOtp'])->name("vendor.verifyotp");
    });

    Route::get("/logout", [VendorWebController::class, 'logout'])->name('vendor.logout');
    Route::get('/reset-password',[VendorWebController::class,'Passwordreset'])->name("vendor.password-reset");

    Route::middleware("CheckVendorSession")->group(function(){

        Route::get('/dashboard',[VendorWebController::class,'dashboard'])->name("vendor.dashboard");
        Route::get('/{id}/my-profile',[VendorWebController::class,'profile'])->name("vendor.myprofile");
        Route::get('/search/result/',[VendorWebController::class,'searchResult'])->name("vendor.searchresult");

        Route::prefix('/booking')->group(function () {
            Route::get('/{type}',[VendorWebController::class,'bookingType'])->name("vendor.bookings");
            Route::get('/past-booking/{type}',[VendorWebController::class,'bookingPastType'])->name("vendor.pastbookings");
            Route::get('/reject-booking/{type}',[VendorWebController::class,'bookingRejectType'])->name("vendor.rejectbookings");
            Route::get('/{id}/details',[VendorWebController::class,'bookingDetails'])->name("vendor.detailsbookings");
            Route::get('/{id}/requirment',[VendorWebController::class,'bookingRequirment'])->name("vendor.requirment-order");
            Route::get('/{id}/my-quote',[VendorWebController::class,'myQuote'])->name("vendor.my-quote");
            Route::get('/{id}/my-bid',[VendorWebController::class,'myBid'])->name("vendor.my-bid");
            Route::get('/{id}/scheduled',[VendorWebController::class,'scheduleOrder'])->name("vendor.schedule-order");
            Route::get('/{id}/driver-details',[VendorWebController::class,'driverDetails'])->name("vendor.driver-details");
            Route::get('/{id}/in-transit',[VendorWebController::class,'intransit'])->name("vendor.in-transit");
            Route::get('/{id}/complete',[VendorWebController::class,'completeOrder'])->name("vendor.complete-order");
        });

        Route::prefix('/user')->group(function () {
            Route::get('/add-role',[VendorWebController::class,'userAdd'])->name("vendor.addusermgt");
            Route::get('/{type}',[VendorWebController::class,'userManagement'])->name("vendor.managerusermgt");
            Route::get('/{id}/edit-role',[VendorWebController::class,'userAdd'])->name("vendor.editusermgt");
            Route::get('/{id}/sidebar',[VendorWebController::class,'sidebar_userManagement'])->name("vendor.sidebar.userrole");
        });

        Route::prefix('/inventory')->group(function () {
            Route::get('/',[VendorWebController::class,'inventoryManagement'])->name("vendor.inventorymgt");
            Route::get('/{type}',[VendorWebController::class,'inventoryCetegory'])->name("vendor.inventorycat");
            Route::get('/{id}/sidebar',[VendorWebController::class,'inventorySidebar'])->name("vendor.inventory_sidebar");
            Route::get('/get/services',[VendorWebController::class,'getServices'])->name("vendor.inventory_services");
            Route::get('/{id}/add',[VendorWebController::class,'addInventory'])->name("vendor.inventory.add");
            Route::get('/{id}/edit',[VendorWebController::class,'editInventory'])->name("vendor.inventory.edit");
        });

        Route::prefix('/branches')->group(function () {
            Route::get('/',[VendorWebController::class,'getBranches'])->name("vendor.branches");
            Route::get('/add-branch',[VendorWebController::class,'addBranch'])->name("vendor.addbranch");
            Route::get('/{id}/edit-branch',[VendorWebController::class,'addBranch'])->name("vendor.editbranch");
        });

        Route::get('/payout',[VendorWebController::class,'payout'])->name("vendor.payout");
        Route::get('/payout/sidebar/{id}',[VendorWebController::class,'payoutSidebar'])->name("vendor.sidebar.payout");

        Route::prefix('/vehicle')->group(function () {
            Route::get('/',[VendorWebController::class,'getVehicle'])->name("vendor.vehicle");
            Route::get('/{id}',[VendorWebController::class,'getVehicle'])->name("vendor.edit_vehicle");
        });

        Route::prefix('/service-request')->group(function () {
            Route::get('/',[VendorWebController::class,'serviceRequest'])->name("vendor.service_request");
            Route::get('/add',[VendorWebController::class,'serviceRequestAdd'])->name("vendor.service_request_add");
            Route::get('/{id}/sidebar',[VendorWebController::class,'serviceSidebar'])->name("vendor.service_sidebar");
            Route::get('/reply/{id}/detail',[VendorWebController::class,'serviceSidebar_reply'])->name("vendor.service_sidebar.reply");
        });


        Route::prefix('/users')->middleware("redirectToDashboard")->group(function () {
            Route::get('/create',[VendorWebController::class,'login'])->name("vendor.suer.create");
            Route::get('/{id}/view',[VendorWebController::class,'login'])->name("vendor.user.view");
            Route::get('/{id}/edit',[VendorWebController::class,'login'])->name("vendor.users.edit");

            Route::get('/sidebar',[VendorWebController::class,'login'])->name("vendor.users.sidebar");

            Route::get('/{role}',[VendorWebController::class,'login'])->name("vendor.users");
        });

        Route::get('/reports',[VendorWebController::class,'getReports'])->name("vendor.reports");

    });
});

Route::prefix('website/api')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post("/login", [WebsiteRouter::class, 'login'])->name('website.login');
        Route::post("/otp", [WebsiteRouter::class, 'verifyOtp'])->name('website.otp');

    });
    Route::put("/signup", [WebsiteRouter::class, 'signup'])->name('website.signup');

    Route::put('/book-move-estimate', [WebsiteRouter::class, 'bookingConfirmEstimate'])->name("order_estimate");

    Route::post('/add-vendor', [WebsiteRouter::class, 'addVendor'])->name("add_vendor");
    Route::post('/add-booking', [WebsiteRouter::class, 'addBookMove'])->name("add-bookmove");
    Route::put('/my-profile', [WebsiteRouter::class, 'editProfile'])->name("profile_edit");
    Route::post("/my-profile/update-mobile",[WebsiteRouter::class, 'updateMobile'])->name("update_phone");
    Route::post("/my-profile/verify-otp",[WebsiteRouter::class, 'verifyOtp'])->name("verify_phone");


    Route::post("/track/customer",[WebsiteRouter::class, 'trackCustomerData'])->name("customer-bookmove");
    Route::post("/track/delivery",[WebsiteRouter::class, 'trackDeliveryData'])->name("delivery-bookmove");
    Route::post("/track/inventory",[WebsiteRouter::class, 'trackInventoryData'])->name("inventory-bookmove");
    Route::post("/track/img",[WebsiteRouter::class, 'trackImgData'])->name("img-bookmove");

    Route::get('/subservices',[WebsiteRouter::class,'getSubServices'])->name("get_subservices");
    Route::get('/inventories',[WebsiteRouter::class,'getInventories'])->name("get_inventories");
    Route::get('/inventories/range',[WebsiteRouter::class,'getInventoriesRange'])->name("get_inventories_range");
    Route::get('/inventories/serach',[WebsiteRouter::class,'serachItem'])->name("search_item");

    Route::post('/add-ticket', [WebsiteRouter::class, 'addTicket'])->name("add_ticket");
    Route::post('/raise_support', [WebsiteRouter::class, 'raiseTicket'])->name("raise_support");
    Route::post('/add-reject-ticket', [WebsiteRouter::class, 'addRejectTicket'])->name("add_cancel_ticket");
    Route::post('/cancel-ticket', [WebsiteRouter::class, 'addCancelTicket'])->name("cancel_ticket");
    Route::post('/add-reschedule-ticket', [WebsiteRouter::class, 'addReschedulTicket'])->name("reshcedulel_ticket");
    Route::post('/request-callback', [WebsiteRouter::class, 'requestCallback'])->name("request-callback");
    Route::post('/request-link', [WebsiteRouter::class, 'requestLink'])->name("request-link");

    Route::post('/verified-coupon', [WebsiteRouter::class, 'verifiedCoupon'])->name("verifiedcoupon");
    Route::post('/initiate-payment', [WebsiteRouter::class, 'initiatePayment'])->name("initiate-payment");
    Route::post('/status/complete',[WebsiteRouter::class, 'statusComplete'])->name("complete-status");
    Route::post('/booking/send-to-phone',[WebsiteRouter::class, 'sendToPhone'])->name("website.api.send-to-phone");
    Route::post('/booking/add-review',[WebsiteRouter::class, 'addReview'])->name("website.api.booking.add-review");

    Route::post('/referal/send-to-phone',[WebsiteRouter::class, 'referalSend'])->name("website.api.reffrel_send-to-phone");

    Route::get('/zone/check-serviceability',[WebsiteRouter::class, 'checkServiceable'])->name("website.api.zone.check-serviceability");

});

/* Website page routes */
Route::prefix('site')->group(function () {
    Route::get('/', [WebsiteController::class, 'home'])->name("home");

    Route::get('/order-details/{public_booking_id}', [WebsiteController::class, 'getOrderDetails'])->name("getOrderDetails");

    Route::get('/join-vendor', [WebsiteController::class, 'joinVendor'])->name("join-vendor");
    Route::get('/vendor/success', [WebsiteController::class, 'getVendor'])->name("web.vendor.success");
    Route::get('/contact-us', [WebsiteController::class, 'contactUs'])->name("contact_us");
    Route::get('/FAQ', [WebsiteController::class, 'faq'])->name("faq");
    Route::get('/page/{slug}', [WebsiteController::class, 'termPage'])->name("terms.page");

    Route::middleware("CheckWebSession")->group(function(){
    Route::get("/logout", [WebsiteController::class, 'logout'])->name('logout');
    Route::get('/book-move', [WebsiteController::class, 'addBooking'])->name("add-booking");
    Route::get('/book-move/{id}/estimate', [WebsiteController::class, 'estimateBooking'])->name("estimate-booking");
    Route::get('/book-move/{id}/status', [WebsiteController::class, 'placeBooking'])->name("place-booking");
    Route::get('/my-bookings', [WebsiteController::class, 'myBookings'])->name("my-bookings");
    Route::get('/my-bookings/enquiry', [WebsiteController::class, 'myBookingsEnquiries'])->name("my-bookings-enquiries");
    Route::get('/my-bookings/{id}/quote', [WebsiteController::class, 'finalQuote'])->name("final-quote");
    Route::get('/my-bookings/{id}/payment', [WebsiteController::class, 'payment'])->name("payment");
    Route::get('/my-bookings/{id}/payment-verified', [WebsiteController::class, 'verifiedPayment'])->name("verifiedpayment");
    Route::get('/my-bookings/{id}/ongoing-order', [WebsiteController::class, 'orderDetails'])->name("website.order-details");
    Route::get('/my-bookings/order-history', [WebsiteController::class, 'bookingHistory'])->name("order-history");
    Route::get('/my-profile', [WebsiteController::class, 'myProfile'])->name("website.my-profile");
    Route::get('/my-request', [WebsiteController::class, 'myRequest'])->name("my-request");
    });
//    Route::get('/complete-contact-us', [WebsiteController::class, 'completeContactUs'])->name("complete_contact_us");


});
