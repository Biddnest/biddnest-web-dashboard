<?php

namespace App\Http\Controllers;

use App\Enums\AdminEnums;
use App\Enums\CommonEnums;
use App\Helper;
use App\Models\Admin;
use App\Models\AdminZone;
use App\Models\Zone;
use App\Models\City;
use App\Models\CityZone;

class ZoneController extends Controller
{

    public static function get(){
        $zones=Zone::where("deleted",CommonEnums::$NO)->where("status",CommonEnums::$YES)->get();
        return Helper::response(true, "zone shows successfully", ['zones'=>$zones]);
    }
    public static function getOne($id){
        return Zone::where("deleted",CommonEnums::$NO)->findOrFail($id);
    }

    public static function add($name, $lat, $lng, $city, $district, $state, $area, $radius){
        $exists = Zone::where("name", $name)->first();

        if($exists)
            return Helper::response(false, "This zone name already exists. Couldn't create city.");

        $zone = new Zone();
        $zone->name = ucwords($name);
        $zone->lat = $lat;
        $zone->lng = $lng;
        $zone->service_radius =10;
        $zone->area = json_encode($area);
        $zone->city_id = $city;
        $zone->district = $district;
        $zone->service_radius = $radius;
        $zone->state = $state;
        $result= $zone->save();

        $admins=Admin::where("role", AdminEnums::$ROLES['admin'])->pluck('id');
        foreach($admins as $admin){
            $zones = new AdminZone;
            $zones->admin_id =$admin;
            $zones->zone_id = $zone->id;
            $zones->save();
        }

        if(!$result)
            return Helper::response(false,"Couldn't save zones.");

        return Helper::response(true,"Zone save Successfully",["zone"=>Zone::findOrFail($zone->id)]);
    }

    public static function update($id, $name, $lat, $lng, $city, $district, $state, $area, $radius)
    {
        $exist =Zone::where(['id'=>$id, "deleted"=>CommonEnums::$NO])->first();
        if(!$exist)
            return Helper::response(false, "zone not exist");

        $zone_update=Zone::where('id', $id)
            ->update([
                "name"=>$name,
                "lat"=>$lat,
                "lng"=>$lng,
                "area"=>json_encode($area),
                "city_id"=>$city,
                "district"=>$district,
                "service_radius"=>$radius,
                "state"=>$state
            ]);

        if(!$zone_update)
            return Helper::response(false, "Couldn't update zone");

        return Helper::response(true, "Zone updated Successfully", ["zone"=>Zone::findOrFail($id)]);
    }

    public static function delete($id)
    {
        $exist =Zone::where(['id'=>$id, "deleted"=>CommonEnums::$NO])->first();
        if(!$exist)
            return Helper::response(false, "zone not exist");

        $zone_delete=Zone::where('id', $id)
            ->update(["deleted"=>CommonEnums::$YES]);

        if(!$zone_delete)
            return Helper::response(false, "Couldn't delete zone");

        return Helper::response(true, "Zone deleted Successfully");
    }

    public static function statusUpdate($id)
    {
        $zone = Zone::find($id);

        switch($zone->status){
            case CommonEnums::$YES:
                $status = CommonEnums::$NO;
                break;

            case CommonEnums::$NO:
                $status = CommonEnums::$YES;
                break;

            default:
                return Helper::response([false, "This user is supended. Please use the vendor panel to enable."]);
                break;
        }

        $update_status = Zone::where('id',$id)->update(["status"=>$status]);
        if(!$update_status)
            return Helper::response(false, "failed to updated status");

        return Helper::response(true, "status updated successfully");
    }


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
