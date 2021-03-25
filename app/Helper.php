<?php

namespace App;
use Carbon\CarbonImmutable;
use Faker\Provider\File;
use \Firebase\JWT\JWT;
use http\Env\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Fabito\AvatarGenerator\Avatar;
use Illuminate\Foundation\Inspiring;

class Helper
{
    public static function response($status, $message, $data=null, $http_code=200){
        $stat =$status ? "success" : "fail";
        if($status === true)
            $message = Inspiring::quote();

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

    public static function saveFile($file,$filename,$folderName){
        return Storage::disk('local')->put("public/".$folderName."/".$filename, $file) ? asset("storage/".$folderName."/".$filename) : false;
    }

    public static function generateAvatar($name){
        $generator = new Avatar();
        return $generator->name($name)->font("../resources/fonts/Gilroy-Medium.ttf")->backgroundColor('#FFBC1E')->size(100)->toPng();

    }

}
