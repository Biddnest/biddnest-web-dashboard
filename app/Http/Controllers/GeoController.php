<?php

namespace App\Http\Controllers;

use App\Enums\CommonEnums;
use App\Models\Zone;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Log;

class GeoController extends Controller
{
    public static function distance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
        $response = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=$latitudeFrom,$longitudeFrom&destinations=$latitudeTo,$longitudeTo&mode=driving&language=en&sensor=false&key=".Settings::where("key", "google_api_key")->pluck('value')[0]);
        $data = json_decode($response, true);
        if($data['status'] == "OK"){
            if($data['rows'][0]['elements'][0]['status'] == "ZERO_RESULTS")
                return 0.00;

            $distance_in_km = $data['rows'][0]['elements'][0]['distance']['value'];
            $distance_in_km = $distance_in_km/1000;
            return (double)$distance_in_km;
//            return (float)number_format($distance_in_km, 2);
        }
        else
            return 0.00;
    }

    public static function displacement($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
        $theta = $latitudeFrom - $longitudeTo;
        $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $kms = $dist * 60 * 1.1515 * 1.609344;
        return (double)$kms;
    }

    public static function getNearestZone($lat, $lng){
        $zone_id = 0;
        $distance = 10000;

        foreach (Zone::where("status", CommonEnums::$YES)->get() as $zone){
            $tempDis  = self::distance($lat, $lng, $zone->lat,$zone->lng);
            $zone_id = $tempDis < $distance ? $zone->id : $zone_id;
            $distance =$tempDis;
        }
        return $zone_id;
    }

    public static function isServiceable($lat, $lng){

        $serviceable = false;
        $activeZones = Zone::where("status", CommonEnums::$YES)->get();

        foreach ( $activeZones as $zone){
                $tempDis = self::distance($lat, $lng, $zone['lat'], $zone['lng']);
                if ((double)$tempDis <= (double)$zone['service_radius'])
                    return $serviceable = true;
        }
        return $serviceable;
    }

}
