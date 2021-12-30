<?php

namespace App;

use Craftsys\Msg91\Exceptions\ResponseErrorException;
use Craftsys\Msg91\Exceptions\ValidationException;
use Craftsys\Msg91\Facade\Msg91;
use Exception;
use App\Models\Settings;
use App\Models\Booking;
use App\Enums\SmsEnums;

class Sms
{
    public static function sendOtp($phone, $otp)
    {
        try {
            $message = "Your OTP is {$otp}";
            $auth_key = Settings::where("key","msg91_key")->pluck('value')[0];
            $sender_id = Settings::where("key","msg91_sender_id")->pluck('value')[0];

            /* IN THE FOLLOWING SEND OTP ROUTE OF MSG91, COUNTRY CODE OF INDIA (91) IS HARD CODED. CHANGE IF REQUIRED*/
            $request_url = "http://api.msg91.com/api/sendotp.php?authkey={$auth_key}&mobile=91{$phone}&message={$message}&sender={$sender_id}&otp={$otp}";
            file_get_contents($request_url);
           return true;

            // return Msg91::sms()->to('91'.$phone)->flow(SmsEnums::$TEMPLATES['otp'])->variable('otp', $otp)->send();

        } catch (ValidationException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (ResponseErrorException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (Exception $e) {
            return [false, "error" => $e->getMessage()];
        }

    }

    public static function sendEnquiry($phone, $enquiryid){
        try {
            return Msg91::sms()->to('91'.$phone)->flow(SmsEnums::$TEMPLATES['enquiry_received'])->variable('enquiryid', $enquiryid)->send();
        } catch (ValidationException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (ResponseErrorException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (Exception $e) {
            return [false, "error" => $e->getMessage()];
        }
    }

    public static function sendFinalQuote($phone, $enquiryid, $paymenturl){
        try {
            return Msg91::sms()->to('91'.$phone)->flow(SmsEnums::$TEMPLATES['finalquote_ready'])->variable(['enquiryid'=>$enquiryid, 'paymenturl'=>$paymenturl])->send();
        } catch (ValidationException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (ResponseErrorException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (Exception $e) {
            return [false, "error" => $e->getMessage()];
        }
    }

    public static function sendBookingConfirm($phone, $movementdate, $vendorname){
        try {
            return Msg91::sms()->to('91'.$phone)->flow(SmsEnums::$TEMPLATES['booking_confirm'])->variable(['bookingdate'=>$movementdate, 'vendorname'=>$vendorname])->send();
        } catch (ValidationException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (ResponseErrorException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (Exception $e) {
            return [false, "error" => $e->getMessage()];
        }
    }

    public static function sendDriverAssign($phone, $drivername, $driverphone, $movementdate){
        try {
            return Msg91::sms()->to('91'.$phone)->flow(SmsEnums::$TEMPLATES['driver_assign'])->variable(['drivername'=>$drivername, 'driverphone'=>$driverphone, 'movementdate'=>$movementdate])->send();
        } catch (ValidationException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (ResponseErrorException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (Exception $e) {
            return [false, "error" => $e->getMessage()];
        }
    }

    public static function sendTripStart($phone, $bookingid, $drivername, $driverphone){
        try {
            return Msg91::sms()->to('91'.$phone)->flow(SmsEnums::$TEMPLATES['trip_start'])->variable(['bookingid'=>$bookingid, 'drivername'=>$drivername, 'driverphone'=>$driverphone])->send();
        } catch (ValidationException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (ResponseErrorException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (Exception $e) {
            return [false, "error" => $e->getMessage()];
        }
    }

    public static function sendOrderComplete($phone, $playstoreurl){
        try {
            return Msg91::sms()->to('91'.$phone)->flow(SmsEnums::$TEMPLATES['order_complete'])->variable('playstoreurl', $playstoreurl)->send();
        } catch (ValidationException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (ResponseErrorException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (Exception $e) {
            return [false, "error" => $e->getMessage()];
        }
    }

    public static function sendReferalLink($phone, $playstoreurl){
        try {
            return Msg91::sms()->to('91'.$phone)->flow(SmsEnums::$TEMPLATES['app_share'])->variable('storeurl', $playstoreurl)->send();
        } catch (ValidationException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (ResponseErrorException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (Exception $e) {
            return [false, "error" => $e->getMessage()];
        }
    }

    public static function sendOrderDetails($phone, $bookingid, $orderdetailurl){
        $booking =Booking::where("public_booking_id", $bookingid)->with('organization')->first();
        try {
            return Msg91::sms()->to('91'.$phone)->flow(SmsEnums::$TEMPLATES['booking_confirm'])->variable(['bookingdate'=>$movementdate, 'vendorname'=>$vendorname])->send();
        } catch (ValidationException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (ResponseErrorException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (Exception $e) {
            return [false, "error" => $e->getMessage()];
        }
    }
    public static function sendOrderCancel($phone, $reason){
        try {
            return Msg91::sms()->to('91'.$phone)->flow(SmsEnums::$TEMPLATES['order_cancel'])->variable(['reason'=>$reason])->send();
        } catch (ValidationException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (ResponseErrorException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (Exception $e) {
            return [false, "error" => $e->getMessage()];
        }
    }
}
