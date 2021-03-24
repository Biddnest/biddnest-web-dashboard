<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Booking;
use App\Models\Payment;
use App\Helper;
use App\Enums\BookingEnums;
use App\Enums\PaymentEnums;
use App\Models\Settings;
use ramsey\uuid\uuid;

class PaymentController extends Controller
{

    public static function intiatePayment($public_booking_id, $coupon_code)
    {
        $booking_exist = Booking::where(["public_booking_id"=>$public_booking_id, "status"=>BookingEnums::$STATUS['payment_pending']])->first();

        if(!$booking_exist)
            return Helper::response(false,"Order is not Exist Or not in Payment State");

        $coupon_valid =CouponController::checkIfValid($public_booking_id, $coupon_code);
        $sub_amount = $booking_exist->final_quote;
        
        if(!$coupon_valid)
        {
            $coupon_valid = 0;
            return Helper::response(false, "Coupon code is not valid"); 
        }
        
        $discount_amount = $sub_amount-$coupon_valid;

        $grand_total = $discount_amount + Settings::where("key", "surge_charge")->pluck('value')[0] + Settings::where("key", "tax")->pluck('value')[0];

        $meta =['public_booking_id'=>$public_booking_id];

        $createorder = self::createOrder($meta, $grand_total);

        $exist_payment = Payment::where(['booking_id'=>$booking_exist['id']])->first();

        if($exist_payment)
        {
            $payment_result = Payment::where('id', $exist_payment->id)
                ->update([
                    'public_transaction_id'=>$createorder['receipt'],
                    'other_charges'=>Settings::where("key", "surge_charge")->pluck('value')[0],
                    'discount_amount'=>$coupon_valid,
                    'tax'=>Settings::where("key", "tax")->pluck('value')[0],
                    'sub_total'=>$sub_amount,
                    'rzp_order_id'=>$createorder['id'],
                    'grand_total'=>$grand_total,
                    'meta'=>json_encode($meta)
                ]);
        }
        else{

            $payment = new Payment;
            $payment->public_transaction_id = $createorder['receipt'];
            $payment->booking_id = $booking_exist->id;
            $payment->other_charges = Settings::where("key", "surge_charge")->pluck('value')[0];
            $payment->discount_amount = $coupon_valid;
            $payment->tax = Settings::where("key", "tax")->pluck('value')[0];
            $payment->sub_total= $sub_amount;
            $payment->rzp_order_id = $createorder['id'];
            $payment->grand_total = $grand_total;
            $payment->meta = json_encode($meta);
            $payment_result = $payment->save();
        }

        if(!$payment_result)
            return Helper::response(false, "Payment couldn't save successfully");
            
        return Helper::response(true, "Payment save successfully", ['payment'=>['rzp_order_id'=>$createorder['receipt']]]);
    }


    private static function createOrder($meta, $amount)
    {      
        $receipt = Uuid::uuid4();
        
        $api = new Api(Settings::where("key", "razor_key")->pluck('value')[0], Settings::where("key", "razor_secret")->pluck('value')[0]);
        
        $order = $api->order->create([
            'receipt' => $receipt,
            'amount' => $amount,
            'currency' => 'INR',
            'note' => json_encode($meta)
        ]);

        return $order;
    }

    public static function webhook($order_id)
    {
        
    }
}
