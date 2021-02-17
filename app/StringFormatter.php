<?php


namespace App;

use PhpParser\Builder\Class_;

class StringFormatter
{

    public function __construct()
    {
    }

    public static function format($input,$rules){
        $formattedData = new \stdClass();

        foreach($rules as $key=>$rule){
            switch ($rule){
                case "uppercase":
                    $formattedData->$key = strtoupper($input[$key]);
                break;
                case "lowercase":
                    $formattedData->$key = strtolower($input[$key]);
                break;
                case "capitalizeFirst":
                    $formattedData->$key = ucfirst($input[$key]);
                break;
                case "capitalizeAll":
                    $formattedData->$key = ucwords($input[$key]);
                break;
                default:
                    $formattedData->$key = $input[$key];
            }
        }
        return $formattedData;
    }

}
