<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\WebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Route as Router;
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
phpinfo();
});


Route::prefix('web/api')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('/login', [Router::class, 'login'])->name("admin_login");

        Route::post('/password/otp/send',[Router::class,'forgot_password_send_otp'])->name("send_otp");
        Route::post('/password/otp/verify',[Router::class,'forgot_password_verify_otp'])->name("verify_otp");
        Route::post('/password/reset',[Router::class,'reset_password'])->name("reset_password");

    });

    // Route::get('/dashboard', [Router::class,'dashboard'])->name("dashboard");

    //services APIs
    Route::get('/services',[Router::class,'service'])->name("service");
    Route::post('/services',[Router::class,'service_add'])->name("service_add");
    Route::put('/services',[Router::class,'service_edit'])->name("service_edit");
    Route::get('/services/{id}',[Router::class,'service_get'])->name("service_get");
    Route::delete('/services/{id}',[Router::class,'service_delete'])->name("service_delete");

    Route::get('/services/{id}/sub-services',[Router::class,'subservice_get_by_service'])->name("sub_service_get_by_service");


    //sub-services APIs
    Route::get('/sub-services',[Router::class,'sub_service'])->name("sub_service");
    Route::post('/sub-services',[Router::class,'sub_service_add'])->name("sub_service_add");
    Route::put('/sub-services',[Router::class,'sub_service_edit'])->name("sub_service_edit");
    Route::get('/sub-services/{id}',[Router::class,'sub_service_get'])->name("sub_service_get");
    Route::delete('/sub-services/{id}',[Router::class,'sub_service_delete'])->name("sub_service_delete");

    //inventory APIs
    Route::get('/inventories',[Router::class,'inventories'])->name("inventories");
    Route::post('/inventories',[Router::class,'inventories_add'])->name("inventories_add");
    Route::put('/inventories',[Router::class,'inventories_edit'])->name("inventories_edit");
    Route::get('/inventories/{id}',[Router::class,'inventories_get'])->name("inventories_get");
    Route::delete('/inventories/{id}',[Router::class,'inventories_delete'])->name("inventories_delete");

    //organization API's
    Route::get('/organizations',[Router::class,'vendors'])->name("vendors");
    Route::post('/organzations',[Router::class,'vendor_add'])->name("vendor_add");
    Route::put('/organizations',[Router::class,'vendor_edit'])->name("vendor_edit");
    Route::get('/organizations/{id}',[Router::class,'vendor_fetch'])->name("vendor_fetch");
    Route::delete('/organizations/{id}',[Router::class,'vendor_delete'])->name("vendor_delete");
});


Route::prefix('front')->group(function () {

        Route::get('/login',[WebController::class,'login'])->name("login");
        Route::get('/forgotpassword',[WebController::class,'forgotpassword'])->name("forgotpassword");
        Route::get('/verifyotp',[WebController::class,'verifyotp'])->name("verifyotp");
        Route::get('/reset_password',[WebController::class,'reset_password'])->name("verifyotp");

        Route::get('/dashboard',[WebController::class,'dashboard'])->name("dashboard");

});

