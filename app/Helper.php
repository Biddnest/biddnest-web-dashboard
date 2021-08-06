<?php

namespace App;
use App\Enums\AdminEnums;
use App\Enums\VendorEnums;
use Carbon\CarbonImmutable;
use Faker\Provider\File;
use \Firebase\JWT\JWT;
use http\Env\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Fabito\AvatarGenerator\Avatar;
use Illuminate\Foundation\Inspiring;

class Helper
{
    public static function response($status, $message, $data=null, $http_code=200){
//        $stat =$status ? "success" : "fail";
        if($status === true)
           $stat = "success";

        if($status === false)
           $stat = "fail";

        if($status === "await")
           $stat = "await";

        if($status === "login")
           $stat = "login";

        return response()->json(["status" => $stat, "message"=>ucwords($message), "data"=>$data])->setStatusCode($http_code);
    }

    public static function generateOTP($length){
        $generator = "1357902468";
        $result = "";
        for ($i = 1; $i <= $length; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }
        return $result;
    }

    public static function generateAuthToken($data){
        return JWT::encode([
            "iss" => config('app.url'),
            "aud" => "APP_USER",
            "iat" => CarbonImmutable::now()->timestamp,
            "nbf" => CarbonImmutable::now()->timestamp,
            "exp" => CarbonImmutable::now()->add(365, 'day')->timestamp,
            "payload" => $data
        ], config('jwt.secret'));
    }

    public static function validateAuthtoken($token){
        if ($data = JWT::decode($token, config('jwt.secret'),['HS256']))
            return $data;
        else
            return false;
    }

    public static function saveFile($file,$filename,$folderName){
        return Storage::disk('local')->put("public/".$folderName."/".$filename, $file) ? asset("storage/".$folderName."/".$filename) : false;
    }

    public static function generateAvatar($name){
        $generator = new Avatar();
        return $generator->name($name)->font("../resources/fonts/Gilroy-Medium.ttf")->backgroundColor('#FFBC1E')->size(100)->toPng();

    }

    public static function is($role, $vendor=false){

        if(!$vendor) {
            switch ($role) {

                case "admin":
                    if (Session::get('user_role') === AdminEnums::$ROLES['admin'])
                        return true;
                    break;

                case "zone_admin":
                    if (Session::get('user_role') === AdminEnums::$ROLES['zone_admin'])
                        return true;
                    break;

                case "marketing":
                    if (Session::get('user_role') === AdminEnums::$ROLES['marketing'])
                        return true;
                    break;

            }

        }
        else
        {
            switch ($role) {

                case "admin":
                    if (Session::get('user_role') === VendorEnums::$ROLES['admin'])
                        return true;
                    break;

                case "manager":
                    if (Session::get('user_role') === VendorEnums::$ROLES['zone_admin'])
                        return true;
                    break;
            }
        }
            return false;
    }

    public static function datesBetween($strDateFrom, $strDateTo)
    {
        $aryRange = [];

        $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
        $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

        if ($iDateTo >= $iDateFrom) {
            array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
            while ($iDateFrom<$iDateTo) {
                $iDateFrom += 86400; // add 24 hours
                array_push($aryRange, date('Y-m-d', $iDateFrom));
            }
        }
        return $aryRange;
    }

}
