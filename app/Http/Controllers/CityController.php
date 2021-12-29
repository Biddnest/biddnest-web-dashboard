<?php

namespace App\Http\Controllers;

use App\Enums\CommonEnums;
use App\Helper;
use App\Models\City;
use App\Models\Zone;
use App\Models\CityZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    public function addCity($name, $zones, $state){
        $exists = City::where(["name"=>$name, "state"=>$state])->first();

        if($exists)
            return Helper::response(false, "This city name already exists. Couldn't create city.");

        $city = new City();
        $city->name = ucwords($name);
        $city->state = $state;
        $result= $city->save();

        foreach($zones as $zone){
            $zones = new CityZone;
            $zones->city_id =$city->id;
            $zones->zone_id = $zone;
            $zones->save();

            Zone::where("id", $zone)->update(['city_id'=>$city->id]);
        }

        if(!$result)
            return Helper::response(false,"Couldn't save city.");

        return Helper::response(true,"City save Successfully",["city"=>City::findOrFail($city->id)]);
    }

    public function cities_edit($id, $name, $zones, $state){
        $exists = City::where(["id"=>$id])->first();

        if(!$exists)
            return Helper::response(false, "This city does not exists. Couldn't update city.");

        $result_update = City::where("id", $id)
            ->update([
                "name"=>$name,
                "state"=>$state
            ]);

        CityZone::where("city_id", $id)->delete();
        foreach($zones as $zone){
            $zones = new CityZone;
            $zones->city_id =$id;
            $zones->zone_id = $zone;
            $zones->save();

            Zone::where("id", $zone)->update(['city_id'=>$id]);
        }

        if(!$result_update)
            return Helper::response(false,"Couldn't update city.");

        return Helper::response(true,"City update Successfully",["city"=>City::findOrFail($id)]);

    }

    public function statusUpdateCity($id){
        $city = City::where("id", $id)->with('zones')->first;

        switch($city->status){
            case CommonEnums::$YES:
                $status = CommonEnums::$NO;
                break;

            case CommonEnums::$NO:
                $status = CommonEnums::$YES;
                break;

            default:
                break;
        }

        $update_status = City::where('id',$id)->update(["status"=>$status]);
        foreach($city->zones as $zone){
            Zone::where("id", $zone->zone_id)->update(['status'=>$status]);
        }

        if(!$update_status)
            return Helper::response(false, "failed to updated status");

        return Helper::response(true, "status updated successfully");
    }

    public function cities_delete($id){
        $exists = City::where(["id"=>$id, "deleted"=>CommonEnums::$NO])->with('zones')->first();

        if(!$exists)
            return Helper::response(false, "This city does not exists. Couldn't update city.");

        $result_update = City::where("id", $id)
            ->update([
                "deleted"=>CommonEnums::$YES
            ]);

        foreach($exists->zones as $zone){
            Zone::where("id", $zone->zone_id)->update(["deleted"=>CommonEnums::$YES]);
        }

        if(!$result_update)
            return Helper::response(false,"Couldn't delete city.");

        return Helper::response(true,"City delete Successfully");

    }
}
