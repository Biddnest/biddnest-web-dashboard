<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Route as Router;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//forgotPassword forgot_password
Route::prefix('auth')->group(function () {
    Route::post('/login', [Router::class, 'login'])->name("admin_login");
    
    Route::post('/password/otp/send',[Router::class,'forgot_password_send_otp'])->name("send_otp");
    Route::post('/password/otp/verify',[Router::class,'forgot_password_verify_otp'])->name("verify_otp");
    Route::post('/password/reset',[Router::class,'reset_password'])->name("reset_password");

});

Route::prefix('dashboard')->group(function () {
    // Route::get('/dashboard', [Router::class,'dashboard'])->name("dashboard");

    //services APIs
    Route::get('/services',[Router::class,'service'])->name("service");
    Route::post('/services/add',[Router::class,'service_add'])->name("service_add");  
    Route::post('/services/edit/{id}',[Router::class,'service_edit'])->name("service_edit");  
    Route::get('/services/fetch/{id}',[Router::class,'service_fetch'])->name("service_fetch"); 
    Route::get('/services/delete/{id}',[Router::class,'service_delete'])->name("service_delete");

    //sub-services APIs
    Route::get('/subservices',[Router::class,'sub_service'])->name("sub_service");
    Route::post('/subservices/add',[Router::class,'sub_service_add'])->name("sub_service_add");
    Route::post('/subservices/edit/{id}',[Router::class,'sub_service_edit'])->name("sub_service_edit"); 
    Route::get('/subservices/fetch/{id}',[Router::class,'sub_service_fetch'])->name("sub_service_fetch");
    Route::get('/subservices/delete/{id}',[Router::class,'sub_service_delete'])->name("sub_service_delete");

    //inventory APIs
    Route::get('/inventories',[Router::class,'inventories'])->name("inventories");
    Route::post('/inventories/add',[Router::class,'inventories_add'])->name("inventories_add");
    Route::post('/inventories/edit/{id}',[Router::class,'inventories_edit'])->name("inventories_edit"); 
    Route::get('/inventories/fetch/{id}',[Router::class,'inventories_fetch'])->name("inventories_fetch");
    Route::get('/inventories/delete/{id}',[Router::class,'inventories_delete'])->name("inventories_delete");
});

Route::prefix('vendor')->group(function () {
    Route::get('/vendors',[Router::class,'vendors'])->name("vendors");
    Route::post('/vendors/add',[Router::class,'vendor_add'])->name("vendor_add");  
    Route::post('/vendors/edit/{id}',[Router::class,'vendor_edit'])->name("vendor_edit");  
    Route::get('/vendors/fetch/{id}',[Router::class,'vendor_fetch'])->name("vendor_fetch"); 
    Route::get('/vendors/delete/{id}',[Router::class,'vendor_delete'])->name("vendor_delete");

    // Route::get('/vendors/kyc',[Router::class,'vendors_kyc'])->name("vendors_kyc");
    Route::post('/vendors/add/kyc',[Router::class,'vendor_add_kyc'])->name("vendor_add_kyc");  
});