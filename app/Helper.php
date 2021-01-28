<?php 

namespace App;

class Helper
{
    public static function response($status, $message, $data=[], $http_code=200){
        $stat=$status ? "success" : "fail";
        return["status" => $stat, "message"=>ucwords($message), "data"=>$data];
    }

    public static function generateOTP($length){
        $generator = "1357902468";
        $result = ""; 
        for ($i = 1; $i <= $length; $i++) { 
            $result .= substr($generator, (rand()%(strlen($generator))), 1); 
        } 
        return $result;
        
    }

}
