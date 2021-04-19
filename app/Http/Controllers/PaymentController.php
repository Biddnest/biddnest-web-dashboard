<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

namespace App\Http\Controllers;

use App\Enums\BookingEnums;
use App\Enums\CommonEnums;
use App\Enums\NotificationEnums;
use App\Enums\PaymentEnums;
use App\Helper;
use App\Models\Booking;
use App\Models\BookingStatus;
use App\Models\Coupon;
use App\Models\Payment;
use App\Models\Settings;
use App\Razorpay;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public static function intiatePayment($public_booking_id, $coupon_code = null)
    {
        $booking_exist = Booking::where(["public_booking_id" => $public_booking_id, "status" => BookingEnums::$STATUS['payment_pending']])->with('payment')->first();

        if (!$booking_exist)
            return Helper::response(false, "Order is not Exist Or not in Payment State");

        if (!$booking_exist->payment)
            return Helper::response(false, "Payment data not found in database. This is a critical error. Please contact the admin.");

        $discount_value = 0.00;
        if ($coupon_code && trim($coupon_code) != "") {
            $coupon_valid = CouponController::checkIfValid($public_booking_id, $coupon_code);
            if (!is_array($coupon_valid)) {
                $discount_value = 0.00;
                return Helper::response(false, $coupon_valid);
            } else {
                $discount_value = $coupon_valid['coupon']['discount'];
            }
        }

            /*tax is always taken as percentage*/
        $grand_total = (float) $booking_exist->payment->sub_total + (float)$booking_exist->payment->other_charges - (float)$discount_value;
        $tax = $grand_total * (Settings::where("key", "tax")->pluck('value')[0]/100);
        $grand_total += $tax;


        $meta =['public_booking_id'=>$public_booking_id];
        $grand_total = (float) $grand_total;
        if($grand_total < 1.00)
            return Helper::response(false, "Minimum transaction value is one. Could'nt proceed with payment. Contact Admin.");

        // $exist_payment = Payment::where(['booking_id'=>$booking_exist['id']])->first();
        if($booking_exist->payment->grand_total == $grand_total &&  $booking_exist->payment->rzp_order_id !== null)
            $order_id = $booking_exist->payment->rzp_order_id;
        else
            $order_id = self::createOrder($booking_exist->payment->public_transaction_id, $meta, $grand_total)['id'];

        $update_data =[
            'discount_amount'=>$discount_value,
            'coupon_code' => $coupon_code,
            'tax'=> $tax,
            'rzp_order_id'=>$order_id ,
            'grand_total'=>$grand_total,
            'meta'=>json_encode($meta)
        ];

        if($coupon_code && trim($coupon_code) != "")
            $update_data['coupon_id'] = Coupon::where("code", $coupon_code)->pluck('id')[0]

        $payment_result = Payment::where('id', $booking_exist->payment->id)
            ->update($update_data);

        if(!$payment_result)
            return Helper::response(false, "Payment couldn't save successfully");

        return Helper::response(true, "Payment save successfully", ['payment'=>['grand_total'=>$grand_total, 'currency'=>"INR",'rzp_order_id'=>$order_id, 'auto_captured'=>1]]);
    }

    private static function createOrder($receipt, $meta, $amount)
    {
        $client = new client();
        $request_url = 'https://api.razorpay.com/v1/orders/';
        $response = $client->request('POST', $request_url, ['auth' => [Settings::where("key", "razor_key")->pluck('value')[0], Settings::where("key", "razor_secret")->pluck('value')[0]], 'json'=>[
            'receipt' => $receipt,
            'amount' => $amount*100,
            'currency' => 'INR',
            'notes'=>$meta,
            'payment_capture'=>CommonEnums::$YES
        ]]);
        return json_decode($response->getBody(), true);
    }

    public function webhook(Request $request)
    {
        $body = $request->all();
        if($body['entity'] == 'event' && ($body['event']=='payment.captured' || $body['event']=='payment.authorized'))
        {
            $order_id_exist = Payment::where(["rzp_order_id"=>$body['payload']['payment']['entity']['order_id']])->first();

            Payment::where(["rzp_order_id"=>$body['payload']['payment']['entity']['order_id']])
            ->update([
                'rzp_payment_id'=>$body['payload']['payment']['entity']['id'],
                'status'=> PaymentEnums::$STATUS['completed']
            ]);

            $meta = json_decode(Booking::where("id",$order_id_exist->booking_id)->pluck("meta")[0],true);
            $meta["start_pin"] = Helper::generateOTP(4);

            Booking::where(["id"=>$order_id_exist->booking_id])
                                ->update([
                                    "status"=>BookingEnums::$STATUS['pending_driver_assign'],
                                    "meta"=>$meta
                                ]);
            $status=BookingStatus::where(['booking_id'=>$order_id_exist->booking_id, 'status'=>BookingEnums::$STATUS['pending_driver_assign']])->first();
            if(!$status)
            {
                $result_status = BookingsController::statusChange($order_id_exist->booking_id, BookingEnums::$STATUS['awaiting_pickup']);
            }

            if($order_id_exist->coupon_code)
                    Coupon::where('code',$order_id_exist->coupon_code)->update([
                        "usage"=>Coupon::where("code", $order_id_exist->coupon_code)->pluck("usage")[0] + 1
                        ]);


            dispatch(function () use ($order_id_exist) {

                $booking = Booking::find($order_id_exist->booking_id);
                NotificationController::sendTo("user", [$booking->user_id], "We have received your payment for booking id " . $booking->public_booking_id, "Your order has been confirmed and a driver will be assigned soon.", [
                    "type" => NotificationEnums::$TYPE['booking'],
                    "public_booking_id" => $booking->public_booking_id
                ]);

            })->afterResponse();
            return Helper::response(true, "Payment successfull");
        }
        else
        {
            $update_webhook = Payment::where(["rzp_order_id"=>$body['payload']['payment']['entity']['order_id']])
            ->update([
                'rzp_payment_id'=>$body['payload']['payment']['entity']['id'],
                'status'=> PaymentEnums::$STATUS['failed']
            ]);

            return Helper::response(true, "Payment failed");
        }
    }

    public static function statusComplete($user_id, $public_booking_id, $payment_id)
    {
        $booking_exist = Booking::where(["public_booking_id"=>$public_booking_id, 'user_id'=>$user_id])->with('payment')->first();

        if(!$booking_exist)
            return Helper::response(false, "Booking is not exist");

        $api = new Razorpay(Settings::where("key", "razor_key")->pluck('value')[0], Settings::where("key", "razor_secret")->pluck('value')[0]);

        $payment_data = $api->fetch($payment_id);

        if($payment_data['error_code'])
            return Helper::response(false, "Payment does not exist");

        $order_id = $payment_data['order_id'];

        $order_exist = Payment::where(['booking_id'=>$booking_exist['id'], 'rzp_order_id'=>$order_id])->first();

        if(!$order_exist)
            return Helper::response(false, "Payment order is not exist");

        $payment_exist = Payment::where(['booking_id'=>$booking_exist['id'], 'rzp_order_id'=>$order_id])
                                ->update([
                                    'rzp_payment_id'=>$payment_id,
                                    'status'=> PaymentEnums::$STATUS['completed']
                                ]);

        $meta = json_decode(Booking::where("id",$order_exist->booking_id)->pluck("meta")[0],true);
        $meta["start_pin"] = Helper::generateOTP(4);

        Booking::where(["id"=>$order_exist->booking_id])
                ->update([
                    "status"=>BookingEnums::$STATUS['pending_driver_assign'],
                    "meta"=>$meta
                ]);

        // $bookingstatus = new BookingStatus;
        // $bookingstatus->booking_id = $order_exist->booking_id;
        // $bookingstatus->status=BookingEnums::$STATUS['awaiting_pickup'];
        // $result_status = $bookingstatus->save();

        $result_status = BookingsController::statusChange($order_exist->booking_id, BookingEnums::$STATUS['pending_driver_assign']);

        if($order_exist->coupon_code) {
            Coupon::where('code', $order_exist->coupon_code)->update([
                "usage" => Coupon::where("code", $order_exist->coupon_code)->pluck("usage")[0] + 1
            ]);
        }

        return Helper::response(true, "Payment successful");
    }


}
