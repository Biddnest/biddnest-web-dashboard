<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;

class GeoController extends Controller
{
    public static function distance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
       $response = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$latitudeFrom.",".$longitudeFrom."&destinations=".$latitudeTo.",".$longitudeTo."&mode=driving&language=en&sensor=false&key=".Settings::where("key", "google_api_key")->pluck('value')[0]);
        $data = json_decode($response, true);
        if($data['status'] == "OK"){
            $distance_in_km = $data['rows'][0]['elements'][0]['distance']['value'];
            $distance_in_km = $distance_in_km/1000;
            return number_format($distance_in_km, 2);
        }
        else{
            return 0.00;
        }
    }

    public function getZones($lat, $lng){}
}
