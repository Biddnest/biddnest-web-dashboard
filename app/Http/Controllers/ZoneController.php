<?php

namespace App\Http\Controllers;

use App\Enums\AdminEnums;
use App\Enums\CommonEnums;
use App\Helper;
use App\Models\Admin;
use App\Models\AdminZone;
use App\Models\Zone;

class ZoneController extends Controller
{

    public static function get(){
        $zones=Zone::where("deleted",CommonEnums::$NO)->where("status",CommonEnums::$YES)->get();
        return Helper::response(true, "zone shows successfully", ['zones'=>$zones]);
    }
    public static function getOne($id){
        return Zone::where("deleted",CommonEnums::$NO)->findOrFail($id);
    }

    public static function add($name, $lat, $lng, $city, $district, $state, $area){
        $zone = new Zone();
        $zone->name = ucwords($name);
        $zone->lat = $lat;
        $zone->lng = $lng;
        $zone->service_radius =10;
        $zone->area = json_encode($area);
        $zone->city = $city;
        $zone->district = $district;
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

    public static function update($id, $name, $lat, $lng, $city, $district, $state, $area)
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
                "city"=>$city,
                "district"=>$district,
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

}
