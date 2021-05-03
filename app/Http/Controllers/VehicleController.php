<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public static function add($name, $number, $type, $organization_id){
        $exist = Vehicle::where("number",$number)
                ->where("organization_id",$organization_id)
            ->first();

        if($exist)
            Helper::response(false, "This vehicle was already added. Can't make duplicate entry.");

       $vehicle = new Vehicle();
       $vehicle->organization_id = $organization_id;
       $vehicle->name = $name;
       $vehicle->vehicle_type = $type;
       $vehicle->number = $number;

       if(!$vehicle->save())
           Helper::response(false, "Somethign went wrong could'nt save vehicle");

        Helper::response(false, "Vehicle saved.", ["vehicle"=>Vehicle::findOrFail($vehicle->id)]);
    }

    public static function update($id, $name, $number, $type, $organization_id){
        $exist = Vehicle::where("organization_id",$organization_id)->find($id);

        if(!$exist)
            Helper::response(false, "Invalid vehicle id");

       $update = Vehicle::where("id",$id)->update([
           "name" =>$name,
           "number"=>$number,
           "vehicle_type"=>$type
       ]);

       if(!$update)
           Helper::response(false, "Somethign went wrong could'nt save vehicle");

        Helper::response(false, "Vehicle saved.",["vehicle"=>Vehicle::findOrFail($id)]);
    }
}
