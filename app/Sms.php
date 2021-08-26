<?php

namespace App;

use Craftsys\Msg91\Exceptions\ResponseErrorException;
use Craftsys\Msg91\Exceptions\ValidationException;
use Craftsys\Msg91\Facade\Msg91;
use Exception;

class Sms
{
    public static function sendOtp($phone, $otp)
    {
        try {
            Msg91::otp($otp)->to($phone)->send();
            return true;
        } catch (ValidationException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (ResponseErrorException $e) {
            return [false, "error" => $e->getMessage()];
        } catch (Exception $e) {
            return [false, "error" => $e->getMessage()];
        }

    }


}
