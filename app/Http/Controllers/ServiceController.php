<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Inventory;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use App\Enums\CommonEnums;

class ServiceController extends Controller
{
    private static $public_data = ["id","name","image","inventory_quantity_type"];
    public function __construct()
    {
    }

    public static function add($name,$image,$inventory_quantity_type)
    {
        $imageman = new ImageManager(array('driver' => 'imagick'));
        $imageman->configure(array('driver' => 'gd'));

        $image_name = "service".$name."-".uniqid().".png";
        $service=new Service;
        $service->name=$name;
        $service->inventory_quantity_type=$inventory_quantity_type;
        $service->image = Helper::saveFile($imageman->make($image)->resize(100,100)->encode('png', 75),$image_name,"services");
        $result= $service->save();

        if(!$result)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"Save data successfully",["service"=>Service::select(self::$public_data)->findOrFail($service->id)]);
    }

    public static function get()
    {
        $service=Service::select(self::$public_data)->get();
        if(!$service)
            return Helper::response(false,"Records not exist");
        else
            return Helper::response(true,"Data displayed successfully", ['services'=>$service]);
    }

    public static function update($id, $name, $image, $inventory_quantity_type)
    {
        $service_exist = Service::findOrFail($id);
        if(!$service_exist)
            return Helper::response(false,"Incorrect Service Id");

        $image_name = "subservice".$name."-".$id.".png";
        $imageman = new ImageManager(array('driver' => 'gd'));

        if(filter_var($image, FILTER_VALIDATE_URL) === FALSE)
            $update_data["image"] = Helper::saveFile($imageman->make($image)->resize(100,100)->encode('png', 75),$image_name,"services");


        $update_data=  ["name"=>$name,
            "inventory_quantity_type"=>$inventory_quantity_type];
        $service=Service::where("id", $id)->update($update_data);

        if(!$service)
            return Helper::response(false,"Couldn't Update data");
        else
            return Helper::response(true,"Update data successfully",["service"=>Service::select(self::$public_data)->findOrFail($id)]);
    }

    public static function getOne($id)
    {
        $result=Service::select(self::$public_data)->findOrFail($id);

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", ['services'=>$result]);
    }

    public static function delete($id)
    {
        $result=Service::where("id",$id)->update(["deleted"=>1]);

        if(!$result)
            return Helper::response(false,"Couldn't Delete data $result");
        else
            return Helper::response(true,"Service deleted successfully");
    }

    /*API For APP*/
    public static function getForApp($lat, $lng)
    {
        $service=Service::select(self::$public_data)->where(['status'=>CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])->get();
        if(!$service)
            return Helper::response(false,"Records not exist");
        else
            return Helper::response(true,"Data displayed successfully", ['services'=>$service]);
    }
}
