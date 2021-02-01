<?php

namespace App;
use Carbon\CarbonImmutable;
use \Firebase\JWT\JWT;
use http\Env\Request;
use Carbon\Carbon;

class Helper
{
    public static function response($status, $message, $data=null, $http_code=200){
        $stat=$status ? "success" : "fail";
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
        ], config('jwt.secret'));
    }

}
