<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;

class InventoryController extends Controller
{
    private static $public_data = ["id","name","image","icon","status"];
    public static function get()
    {
        $inventories=Inventory::all();
        if(!$inventories)
            return Helper::response(false,"Records not exist");
        else
            return Helper::response(true,"Data displayed successfully", $inventories);
    }

    public static function add($name, $material, $size, $image, $icon)
    {

        $image_name = "inventory-image".$name."-".uniqid().".png";
        $icon_name = "inventory-icon".$name."-".uniqid().".png";
        $imageman = new ImageManager(array('driver' => 'imagick'));
        $imageman->configure(array('driver' => 'gd'));

        $inventory=new Inventory;
        $inventory->name=$name;
        $inventory->size=$size;
        $inventory->material=$material;
        $inventory->image=Helper::saveFile($imageman->make($image)->resize(480,480)->encode('png', 75),$image_name,"inventories");
        $inventory->icon=Helper::saveFile($imageman->make($icon)->resize(100,100)->encode('png', 75),$icon_name,"inventories");
        $result= $inventory->save();

        if(!$result)
            return Helper::response(false,"Couldn't save data");

        /*foreach($subservice_ids as $service_id){
            DB::table("subservices_inventories_maps")->insert([
                "subservice_id"=>$service_id,
                "inventory_id"=>$inventory->id
            ]);
        }*/
            return Helper::response(true,"save data successfully",["inventory"=>Inventory::select(self::$public_data)->findOrFail($inventory->id)]);
    }

    public static function update($id, $name, $material, $size, $image, $icon)
    {
        $image_name = "inventory-image-".$name."-".uniqid().".png";
        $icon_name = "inventory-icon-".$name."-".uniqid().".png";
        $imageman = new ImageManager(array('driver' => 'imagick'));
        $imageman->configure(array('driver' => 'gd'));

        $result = Inventory::where("id",$id)->update([
        "name"=>$name,
        "size"=>$size,
        "material"=>$material,
        "image"=>Helper::saveFile($imageman->make($image)->resize(480,480)->encode('png', 75),$image_name,"inventories"),
        "icon"=>Helper::saveFile($imageman->make($icon)->resize(100,100)->encode('png', 75),$icon_name,"inventories")
        ]);

        if(!$result)
            return Helper::response(false,"Couldn't save data");


        return Helper::response(true,"save data successfully",["inventory"=>Inventory::select(self::$public_data)->findOrFail($id)]);
    }

    public static function getOne($id)
    {
        $result=Inventory::select(self::$public_data)->where('id', $id)->first();
        if(!$result)
            return Helper::response(false,"Couldn't Display data");
        else
            return Helper::response(true,"Data Display successfully", $result);
    }

    public static function getBySubservice($id)
    {
        $result=Inventory::whereIn("id", function($ids){
            return DB::table("subservices_inventories_maps")->pluck("subservice_id");
        })->get();

        if(!$result)
            return Helper::response(false,"Couldn't Display data");
        else
            return Helper::response(true,"Data Display successfully", $result);
    }

    public static function delete($id)
    {
        $result=Inventory::where("id",$id)->update(["deleted"=>1]);

        if(!$result)
            return Helper::response(false,"Couldn't Delete data");
        else
            return Helper::response(true,"Data Deleted successfully");
    }

}
