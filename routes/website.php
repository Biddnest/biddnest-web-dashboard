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

Route::prefix('web/api')->group(function () {
    Route::post('/add-vendor', [WebsiteRouter::class, 'addVendor'])->name("add_vendor");


});

Route::prefix('website')->group(function () {
    Route::get('/', [WebsiteController::class, 'home'])->name("home");
    Route::get('/join-vendor', [WebsiteController::class, 'joinVendor'])->name("join-vendor");
    Route::get('/contact-us', [WebsiteController::class, 'contactUs'])->name("contact_us");
    Route::get('/complete-contact-us', [WebsiteController::class, 'completeContactUs'])->name("complete_contact_us");
    Route::get('/FAQ', [WebsiteController::class, 'faq'])->name("faq");
    Route::get('/T&C', [WebsiteController::class, 'termsAndConditions'])->name("terms_and_conditions");

});



