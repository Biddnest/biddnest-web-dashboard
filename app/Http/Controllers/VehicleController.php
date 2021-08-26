<?php

namespace App\Http\Controllers;

use App\Enums\CommonEnums;
use App\Enums\VendorEnums;
use App\Helper;
use App\Models\Vehicle;
use App\Models\Vendor;

class VehicleController extends Controller
{
    public static function add($name, $number, $type, $organization_id){
        $exist = Vehicle::where("number",$number)
                ->where("organization_id",$organization_id)
            ->first();

        if($exist)
            return Helper::response(false, "This vehicle was already added. Can't make duplicate entry.");

       $vehicle = new Vehicle();
       $vehicle->organization_id = $organization_id;
       $vehicle->name = $name;
       $vehicle->vehicle_type = $type;
       $vehicle->number = $number;
       $result =$vehicle->save();

       if(!$result)
           return Helper::response(false, "Somethign went wrong could'nt save vehicle");

       return Helper::response(true, "Vehicle saved.", ["vehicle"=>Vehicle::findOrFail($vehicle->id)]);
    }

    public static function update($id, $name, $number, $type, $organization_id){
        $exist = Vehicle::where("organization_id",$organization_id)->find($id);

        if(!$exist)
            return Helper::response(false, "Invalid vehicle id");

       $update = Vehicle::where("id",$id)->update([
           "name" =>$name,
           "number"=>$number,
           "vehicle_type"=>$type
       ]);

       if(!$update)
           return Helper::response(false, "Somethign went wrong could'nt save vehicle");

       return Helper::response(true, "Vehicle saved.",["vehicle"=>Vehicle::findOrFail($id)]);
    }

    public static function delete($id)
    {
        $exist = Vehicle::where("id",$id)->first();

        if(!$exist)
            return Helper::response(false, "Invalid vehicle id");

        $update = Vehicle::where("id", $id)->update([
            "deleted" =>CommonEnums::$YES
        ]);

        if(!$update)
            return Helper::response(false, "Somethign went wrong could'nt delete vehicle");

        return Helper::response(true, "Vehicle deleted.");
    }

    public static function getDrivers($organization_id)
    {
        $get_driver = Vendor::select(["id", "fname", "lname", "phone"])
            ->where("organization_id", $organization_id)
            ->where(["user_role" => VendorEnums::$ROLES['driver']])
            ->get();

        if (!$get_driver)
            return Helper::response(false, "Driver or vehicle data not available");

        return Helper::response(true, "Data fetched successfully", ['drivers' => $get_driver]);
    }

    public static function getVehicles($organization_id, $web=false)
    {
        $get_vehicle = Vehicle::select(["id", "name", "vehicle_type", "number"])->where("organization_id", $organization_id)
            ->get();

        if (!$get_vehicle)
            return Helper::response(false, "Driver or vehicle data not available");

        if($web)
            return $get_vehicle;
        else
            return Helper::response(true, "Data fetched successfully", ['vehicles' => $get_vehicle]);
    }
}
