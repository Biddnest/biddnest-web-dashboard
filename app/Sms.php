<?php

namespace App;

use Craftsys\Msg91\Exceptions\ResponseErrorException;
use Craftsys\Msg91\Exceptions\ValidationException;
use Craftsys\Msg91\Facade\Msg91;
use Exception;
use App\Models\Settings;
use App\Enums\SmsEnums;

class Sms
{
    public static function sendOtp($phone, $otp)
    {
        try {
            /*$message = "Your OTP is {$otp}";
            $auth_key = Settings::where("key","msg91_key")->pluck('value')[0];
            $sender_id = Settings::where("key","msg91_sender_id")->pluck('value')[0];*/

            /* IN THE FOLLOWING SEND OTP ROUTE OF MSG91, COUNTRY CODE OF INDIA (91) IS HARD CODED. CHANGE IF REQUIRED*/
            /*$request_url = "http://api.msg91.com/api/sendotp.php?authkey={$auth_key}&mobile=91{$phone}&message={$message}&sender={$sender_id}&otp={$otp}";
            file_get_contents($request_url);
           return true;*/

            return Msg91::sms()->to('91'.$phone)->flow(SmsEnums::$TEMPLATES['otp'])->variable('otp', $otp)->send();

        } catch (ValidationException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (ResponseErrorException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (Exception $e) {
            return [false, "error" => $e->getMessage()];
        }

    }

    public static function send($phone, $message){
        return true;
    }


}
