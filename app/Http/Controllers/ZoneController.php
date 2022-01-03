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
use App\Models\ZoneCoordinate;

class ZoneController extends Controller
{

    public static function get($ignore_status = false){
        $zones=Zone::where("deleted",CommonEnums::$NO);

        if(!$ignore_status)
            $zones->where("status",CommonEnums::$YES);

        return Helper::response(true, "Zone shows successfully.", ['zones'=>$zones->with("coordinates")->get()]);
    }

    public static function getOne($id){
        return Zone::where("deleted",CommonEnums::$NO)->findOrFail($id);
    }

    public static function add($name, $coords, $city, $district, $state, $area){
        $exists = Zone::where("name", $name)->first();

        if($exists)
            return Helper::response(false, "This zone name already exists. Couldn't create city.");

        $zone = new Zone();
        $zone->name = ucwords($name);
        $zone->lat = 0;
        $zone->lng = 0;
        $zone->service_radius = 0;
        $zone->area = json_encode($area);
        $zone->city_id = $city;
        $zone->district = $district;
        $zone->state = $state;
        $result= $zone->save();

        foreach ($coords as $cor){
            $zc = new ZoneCoordinate();
            $zc->zone_id = $zone->id;
            $zc->lat = $cor['latitude'];
            $zc->lng = $cor['longitude'];
            $zc->save();
        }

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

    public static function update($id, $name, $coords, $city, $district, $state, $area)
    {
        $exist =Zone::where(['id'=>$id, "deleted"=>CommonEnums::$NO])->first();
        if(!$exist)
            return Helper::response(false, "zone not exist");

        $zone_update=Zone::where('id', $id)
            ->update([
                "name"=>$name,
                "lat"=>0,
                "lng"=>0,
                "area"=>json_encode($area),
                "city_id"=>$city,
                "district"=>$district,
                "service_radius"=>0,
                "state"=>$state
            ]);


        ZoneCoordinate::where("zone_id",$id)->delete();

        foreach ($coords as $cor){
            $zc = new ZoneCoordinate();
            $zc->zone_id = $id;
            $zc->lat = $cor['latitude'];
            $zc->lng = $cor['longitude'];
            $zc->save();
        }


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
}
