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
    Route::put('/services/edit/{id}',[Router::class,'service_edit'])->name("service_edit");  
    Route::get('/services/get/{id}',[Router::class,'service_get'])->name("service_get"); 
    Route::delete('/services/delete/{id}',[Router::class,'service_delete'])->name("service_delete");

    //sub-services APIs
    Route::get('/subservices',[Router::class,'sub_service'])->name("sub_service");
    Route::post('/subservices/add',[Router::class,'sub_service_add'])->name("sub_service_add");
    Route::put('/subservices/edit/{id}',[Router::class,'sub_service_edit'])->name("sub_service_edit"); 
    Route::get('/subservices/get/{id}',[Router::class,'sub_service_get'])->name("sub_service_get");
    Route::delete('/subservices/delete/{id}',[Router::class,'sub_service_delete'])->name("sub_service_delete");

    //inventory APIs
    Route::get('/inventories',[Router::class,'inventories'])->name("inventories");
    Route::post('/inventories/add',[Router::class,'inventories_add'])->name("inventories_add");
    Route::put('/inventories/edit/{id}',[Router::class,'inventories_edit'])->name("inventories_edit"); 
    Route::get('/inventories/get/{id}',[Router::class,'inventories_get'])->name("inventories_get");
    Route::delete('/inventories/delete/{id}',[Router::class,'inventories_delete'])->name("inventories_delete");
});

Route::prefix('vendor')->group(function () {
    //organization API's
    Route::get('/vendors',[Router::class,'vendors'])->name("vendors");
    Route::post('/vendors/add',[Router::class,'vendor_add'])->name("vendor_add");  
    Route::put('/vendors/edit/{id}',[Router::class,'vendor_edit'])->name("vendor_edit");  
    Route::get('/vendors/fetch/{id}',[Router::class,'vendor_fetch'])->name("vendor_fetch"); 
    Route::delete('/vendors/delete/{id}',[Router::class,'vendor_delete'])->name("vendor_delete");

    //org_kyc API's
    Route::get('/vendors/kyc',[Router::class,'vendors_kyc'])->name("vendors_kyc");
    Route::post('/vendors/add/kyc',[Router::class,'vendor_add_kyc'])->name("vendor_add_kyc");
    Route::post('/vendors/edit/kyc/{id}',[Router::class,'vendor_edit_kyc'])->name("vendor_edit_kyc");  
    Route::get('/vendors/fetch/kyc/{id}',[Router::class,'vendor_fetch_kyc'])->name("vendor_fetch_kyc");
    Route::get('/vendors/delete/kyc/{id}',[Router::class,'vendor_delete_kyc'])->name("vendor_delete_kyc");

    //join API's
    Route::get('/vendors/list',[Router::class,'vendors_list'])->name("vendors_list");
    Route::get('/vendors/org/fetch/{id}',[Router::class,'vendors_get_record'])->name("vendors_get_record");
    Route::get('/vendors/org/delete/{id}',[Router::class,'vendors_delete_record'])->name("vendors_delete_record");
});