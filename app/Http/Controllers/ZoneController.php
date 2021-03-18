<?php

namespace App\Http\Controllers;

use App\Enums\CommonEnums;
use App\Helper;
use Illuminate\Http\Request;

class ZoneController extends Controller
{

    public static function get(){
        return Zone::where("deleted",CommonEnums::$NO)->get();
    }
    public static function getOne($id){
        return Zone::where("deleted",CommonEnums::$NO)->findOrFail($id);
    }

    public static function add($name, $lat, $lng, $radius, $area, $city, $district, $state){
        $zone = new Zone;
        $zone->name = ucwords($name);
        $zone->lat = $lat;
        $zone->lng = $lng;
        $zone->service_radius = $name;
        $zone->area = json_encode($area);
        $zone->city = $city;
        $zone->district = $district;
        $zone->state = $state;

        if(!$zone->save)
            return Helper::response(false,"Error adding zones.");
        
        return Helper::response(true,"Zone Added",["zone"=>Zone::findOrFail($zone->id)]);
    }

    public static function update($name, $lat, $lng, $radius, $area, $city, $district, $state)
    {
        
    }

    public static function delete($id){}

    }
