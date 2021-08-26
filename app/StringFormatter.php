<?php


namespace App;

use stdClass;

class StringFormatter
{

    public function __construct()
    {
    }

    public static function format($input,$rules){
        $formattedData = new stdClass();

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
                case "date":
                    $formattedData->$key = date("Y-m-d", strtotime($input[$key]));
                break;
                case "datetime":
                    $formattedData->$key = date("Y-m-d H:i:s", strtotime($input[$key]));
                break;
                case "json":
                    $formattedData->$key = json_encode($input[$key]);
                break;
                default:
                    $formattedData->$key = $input[$key];
            }
        }
        return $formattedData;
    }

}
