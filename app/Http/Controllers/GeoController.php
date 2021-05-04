<?php

namespace App\Http\Controllers;

use App\Models\Zone;
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

        /*$theta = $latitudeFrom - $longitudeTo;
        $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $kms = $dist * 60 * 1.1515 * 1.609344;
        return number_format($kms, 2);*/
    }

    public static function displacement($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
        $theta = $latitudeFrom - $longitudeTo;
        $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $kms = $dist * 60 * 1.1515 * 1.609344;
        return number_format($kms, 2);
    }

    public static function getNearestZone($lat, $lng){
        $zone = 0;
        $distance = 10000;

        foreach (Zone::all() as $zone){
            $tempDis  = self::displacement($lat, $lng, $zone['lat'],$zone['lng']);
            $zone = $tempDis < $distance ? $zone->id : 0;
        }
        return $zone;
    }

    public function getZones($lat, $lng){

    }

}
