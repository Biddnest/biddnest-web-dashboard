<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Inventory;
use App\Models\Service;
use App\Models\Subservice;
use App\Models\ServiceSubservice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use App\Enums\CommonEnums;

class SubServiceController extends Controller
{
    private static $public_data = ["id","name","image","status"];
    public function __construct()
    {
    }

    public static function add($service_id, $name,$image, $inventories)
    {

        $imageman = new ImageManager(array('driver' => 'imagick'));
        $imageman->configure(array('driver' => 'gd'));

        $image_name = "subservice".$name."-".uniqid().".png";
        $subservice=new Subservice();
        $subservice->name=$name;
        $subservice->service_id=$service_id;
        $subservice->image = Helper::saveFile($imageman->make($image)->resize(100,100)->encode('png', 75),$image_name,"subservices");
        $result= $subservice->save();

        if($inventories) {
            foreach ($inventories as $inventory) {
                DB::table("subservices_inventories_maps")->insert([
                    "subservice_id" => $subservice->id,
                    "inventory_id" => $inventory["id"],
                    "size" => $inventory["size"],
                    "material" => $inventory["material"],
                    "quantity" => $inventory["quantity"]
                ]);
            }
        }


        if(!$result)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"Save data successfully",["subservice"=>Subservice::select(self::$public_data)->with("inventories")->findOrFail($subservice->id)]);
    }

    public static function get()
    {
        $subservice=Subservice::select(self::$public_data)->get();
        if(!$subservice)
            return Helper::response(false,"Records not exist");
        else
            return Helper::response(true,"Data displayed successfully", $subservice);
    }

    public static function getByService($service_id)
    {
//        $service_id = is_array($service_id) :
        $subservice=Subservice::select(self::$public_data)->where("service_id",$service_id)->get();
        if(!$subservice)
            return Helper::response(false,"Records not exist");
        else
            return Helper::response(true,"Data displayed successfully", $subservice);
    }

    public static function update($id, $service_id, $name, $image)
    {

        $imageman = new ImageManager(array('driver' => 'imagick'));
        $imageman->configure(array('driver' => 'gd'));
        $image_name = "subservice".$name."-".$id.".png";
        $subservice=Subservice::where("id", $id)->update([
            "name"=>$name,
            "service_id"=>$service_id,
        "image"=>Helper::saveFile($imageman->make($image)->resize(100,100)->encode('png', 75),$image_name,"subservices")
        ]);

        if(!$subservice)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"Save data successfully",["subservice"=>Subservice::select(self::$public_data)->findOrFail($id)]);
    }

    public static function getOne($id)
    {
        $result=Subservice::select(self::$public_data)->with("inventories")->findOrFail($id);

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", $result);
    }

    public static function delete($id)
    {
        $result=Service::where("id",$id)->update(["deleted"=>1]);

        if(!$result)
            return Helper::response(false,"Couldn't Delete data $result");
        else
            return Helper::response(true,"Service deleted successfully");
    }


    public static function getSubservicesForApp($id)
    {
        $subservice=Subservice::select(self::$public_data)
        ->where(['status'=>CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])
        ->whereIn("id", ServiceSubservice::where('service_id', $id)->pluck('subservice_id'))
        ->get();
        
        if(!$subservice)
            return Helper::response(false,"Records not exist");
        else
            return Helper::response(true,"Data displayed successfully", ['subservices'=>$subservice]);
    }
}
