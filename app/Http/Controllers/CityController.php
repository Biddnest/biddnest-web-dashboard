<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
  public static function create($name, $zones){
        DB::transaction();
        try{
            $exists = City::where("name", $name)->first();

            if($exists)
                return Helper::response(false, "This city name already exists. Couldn't create city.");

            $city = new City();
            $city->name = $name;
            $city->meta = null;

            if(!$save_city = $city->save()) {
                DB::rollBack();
                return Helper::response(false, "Something went wrong while creating city. Couldn't proceed.");
            }

            foreach($zones as $zone_id){
                $cityzone = new CityZone();
                $cityzone->city_id = $city->id();
                $cityzone->zone_id = $zone_id;
                $cityzone->save();

                if(!$save_cityzone = $city->save()) {
                    DB::rollBack();
                    return Helper::response(false, "Something went wrong while creating city. Couldn't proceed.");
                }
            }
        }
        catch(\Exception $e){
            DB::rollBack();
        }

      DB::commit();
        return Helper::response(true, "City has been successfully added.");

  }

  public function getZones($city_id){
      return City::where("id",$city_id)->pluck("zone_id");
  }

}
