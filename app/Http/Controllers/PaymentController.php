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
use Ramsey\Uuid\Uuid;
use \GuzzleHttp\Client;

class PaymentController extends Controller
{

    public static function intiatePayment($public_booking_id, $coupon_code)
    {
        $booking_exist = Booking::where(["public_booking_id"=>$public_booking_id, "status"=>BookingEnums::$STATUS['payment_pending']])->with('payment')->first();

        if(!$booking_exist)
            return Helper::response(false,"Order is not Exist Or not in Payment State");

        if(!$booking_exist->payment)
            return Helper::response(false, "Payment data not found in database. This is a critical error. Please contact the admin.");

        $coupon_valid = CouponController::checkIfValid($public_booking_id, $coupon_code);

        if(!is_array($coupon_valid))
            $coupon_valid = 0; return Helper::response(false, $coupon_valid);

            /*tax is always taken as percentage*/
        $grand_total = number_format(($booking_exist->payment->sub_total + $booking_exist->payment->other_charges) - $coupon_valid['coupon']['discount'],2);
        $tax = number_format($grand_total * (Settings::where("key", "tax")->pluck('value')[0]/100),2);
        $grand_total += $tax;

        $meta =['public_booking_id'=>$public_booking_id];

        $createorder = self::createOrder($meta, $grand_total);
        $exist_payment = Payment::where(['booking_id'=>$booking_exist['id']])->first();

            $payment_result = Payment::where('id', $exist_payment->id)
                ->update([
                    'other_charges'=>Settings::where("key", "surge_charge")->pluck('value')[0],
                    'discount_amount'=>$coupon_valid['coupon']['discount'],
                    'coupon_code' => $coupon_code,
                    'tax'=>Settings::where("key", "tax")->pluck('value')[0],
                    'sub_total'=>$sub_amount,
                    'rzp_order_id'=>$createorder['id'],
                    'grand_total'=>$grand_total,
                    'meta'=>json_encode($meta)
                ]);


        if(!$payment_result)
            return Helper::response(false, "Payment couldn't save successfully");

        return Helper::response(true, "Payment save successfully", ['payment'=>['grand_total'=>$grand_total, 'currency'=>"INR",'rzp_order_id'=>$createorder['id']]]);
    }

    private static function createOrder($meta, $amount)
    {
        $receipt = Uuid::uuid4();
        // $receipt = 1234;
        // $api = new Api(Settings::where("key", "razor_key")->pluck('value')[0], Settings::where("key", "razor_secret")->pluck('value')[0]);

        $client = new client();
        $request_url = 'https://api.razorpay.com/v1/orders/';
        $response = $client->request('POST', $request_url, ['auth' => [Settings::where("key", "razor_key")->pluck('value')[0], Settings::where("key", "razor_secret")->pluck('value')[0]], 'json'=>[
            'receipt' => $receipt,
            'amount' => $amount*100,
            'currency' => 'INR',
            'notes'=>$meta
        ]]);
        return json_decode($response->getBody(), true);
    }

    public static function webhook($order_id)
    {

    }
}
