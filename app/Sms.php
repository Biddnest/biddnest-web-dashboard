<?php 

namespace App;
use Craftsys\Msg91\Facade\Msg91;

use App\Helper;

class Sms
{
    public static function sendOtp($phone, $otp)
    {
        try {
            Msg91::otp($otp)->to($phone)->send();
            return true;
        } catch (\Craftsys\Msg91\Exceptions\ValidationException $e) {
            return [false, "error"=>$e->getMessage()];
        } catch (\Craftsys\Msg91\Exceptions\ResponseErrorException $e) {
            return [false, "error"=>$e->getMessage()];
        } catch (\Exception $e) {
            return [false, "error"=>$e->getMessage()];
        }
        
    }  


    
}