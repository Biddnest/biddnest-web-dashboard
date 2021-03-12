<?php

namespace App\Http\Controllers;

use App\Models\SlideBanner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Banners;
use App\Helper;
use App\Sms;
use Intervention\Image\ImageManager;
use App\Enums\SliderEnum;

class SliderController extends Controller
{

    public static function get()
    {
        $result=Slider::where(['status'=> 1, 'deleted'=>0])->with("banners")->get();

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", $result);
    }

    public static function getByZone($zones)
    {
        $result=Slider::where(['status'=> 1, 'deleted'=>0])->andWhereIn("zone_id",$zones)->with("banners")->get();

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", $result);
    }

    public static function add($name, $type, $position, $platform, $size, $from_date, $to_date, $zone_specific)
    {
        $slider=new Slider;
        $slider->name = $name;
        $slider->type = $type;
        $slider->position = $position;
        $slider->platform = $platform;
        $slider->size = $size;
        $slider->from_date = $from_date;
        $slider->to_date = $to_date;
        $slider->zone_specific = $zone_specific;
        $result= $slider->save();

        if(!$result)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"save data successfully");

    }

    public static function delete($id)
    {
        $delete_slider=Slider::where("id",$id)->update(["deleted" => 1]);
        $delete_banner=SlideBanner::where("slider_id", $id)->update(["deleted" => 1]);

        if(!$delete_slider)
            return Helper::response(false,"Couldn't Delete data");
        else
            return Helper::response(true,"Data Deleted successfully");
    }

    public static function banners()
    {
        $result=DB::table('banners')->select('*')->where(['status'=> 1, 'deleted'=>0])->get();

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", $result);
    }

    public static function addBanner($data)
    {
        $slider = Slider::findOrFail($data["id"]);
        if(!$slider)
            return Helper::response(false,"Incorrect slider id.");

        switch ($slider['size']){
            case SliderEnum::$SIZE['wide']:
                $width = SliderEnum::$BANNER_DIMENSIONS["wide"][0];
                $height = SliderEnum::$BANNER_DIMENSIONS["wide"][1];
                break;
            case "square":
                $width = SliderEnum::$BANNER_DIMENSIONS["square"][0];
                $height = SliderEnum::$BANNER_DIMENSIONS["square"][1];
                break;
            default:
                $width = SliderEnum::$BANNER_DIMENSIONS["wide"][0];
                $height = SliderEnum::$BANNER_DIMENSIONS["wide"][1];
        }


        $image = new ImageManager(array('driver' => 'gd'));
//        $image->configure(array('driver' => 'gd'));

        $order = 0;

        SlideBanner::where("slider_id",$data["id"])->delete();

        foreach($data['banners'] as $banner) {
            $banner_file_name = "banner-".$banner['name']."-".uniqid().".png";
            $banners=new Banners;
            $banners->slider_id= $data['id'];
            $banners->image = Helper::saveFile($image->make($banner['image'])->resize($width,$height)->encode('png', 75),$banner_file_name,"slide-banners");
            $banners->name= $banner['name'];
            $banners->url= $banner['url'];
            $banners->from_date= $banner['date']['from'];
            $banners->to_date = $banner['date']['to'];
            $banners->order = $order;
            $result= $banners->save();
            $order++;
        }

        if(!$banner)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"Banner Saved successfully",["slider"=>Slider::with("banners")->findOrFail($data['id'])]);
    }

    public static function deleteBanner($id)
    {
        $result = SlideBanner::where("slider_id",$id)->destroy();


        if(!$result)
            return Helper::response(false,"Couldn't Delete data $result");
        else
            return Helper::response(true,"Data Deleted successfully");
    }
}
