<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;

class ServiceController extends Controller
{
    private static $public_data = ["id","name","image","status"];
    public function __construct()
    {
    }

    public static function add($name,$image)
    {
        $imageman = new ImageManager(array('driver' => 'imagick'));
        $imageman->configure(array('driver' => 'gd'));

        $image_name = "service".$name."-".uniqid().".png";
        $service=new Service;
        $service->name=$name;
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
            return Helper::response(true,"Data displayed successfully", $service);
    }

    public static function update($id, $name, $image)
    {
        $image_name = "subservice".$name."-".$id.".png";

        $imageman = new ImageManager(array('driver' => 'imagick'));
        $imageman->configure(array('driver' => 'gd'));
        $service=Service::where("id", $id)->update([
            "name"=>$name,
            "image"=>Helper::saveFile($imageman->make($image)->resize(100,100)->encode('png', 75),$image_name,"services")
        ]);

        if(!$service)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"Save data successfully",["service"=>Service::select(self::$public_data)->findOrFail($id)]);
    }

    public static function getOne($id)
    {
        $result=Service::select(self::$public_data)->findOrFail($id);

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
}
