<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Booking;
use App\Helper;
use App\Enums\BookingEnums;
use App\Models\Settings;
use ramsey\uuid\uuid;

class PaymentController extends Controller
{

    public static function intiatePayment($public_booking_id, $coupon_code)
    {
        $booking_exist = Booking::where(["public_booking_id"=>$public_booking_id, "status"=>BookingEnums::$STATUS['payment_pending']])->first();

        if(!$booking_exist)
            return Helper::response(false,"Order is not Exist Or not in Payment State");

        $coupon_valid = $coupon_code;
        if($coupon_valid)
            return true;

        $createorder = Self::createOrder($public_booking_id, $booking_exist['final_quote']);

        
    }


    public static function createOrder($public_booking_id, $amount)
    {      
        $receipt = Uuid::uuid4();
        
        $api = new Api(Settings::where("key", "razor_key")->pluck('value')[0], Settings::where("key", "razor_secret")->pluck('value')[0]);
        
        $order = $api->order->create([
            'receipt' => $receipt,
            'amount' => $amount,
            'currency' => 'INR',
            'note' => json_encode(['public_booking_id'=>$public_booking_id])
        ]);

        return $order;
    }
}
