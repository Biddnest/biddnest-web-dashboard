<?php

namespace App\Http\Controllers;

use App\Enums\CommonEnums;
use App\Enums\SliderEnum;
use App\Helper;
use App\Models\Banners;
use App\Models\SlideBanner;
use App\Models\Slider;
use App\Models\City;
use App\Models\SliderZone;
use App\Models\SliderCity;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;

class SliderController extends Controller
{
    public static function get()
    {
        $result=Slider::where(['status'=> 1, 'deleted'=>0])->with("banners")->get();

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", ["sliders"=>$result]);
    }

    public static function getByZone($zones)
    {
        $result=Slider::where(['status'=> 1, 'deleted'=>0])
//            ->andWhereIn("zone_id",$zones)
            ->with("banners")->get();

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", ["sliders"=>$result]);
    }

    public static function add($name, $type, $position, $platform, $size, $from_date, $to_date, $city_scope, $cities)
    {
        $slider=new Slider;
        $slider->name = $name;
        $slider->type = $type;
        $slider->position = $position;
        $slider->platform = $platform;
        $slider->size = $size;
        $slider->from_date = date("Y-m-d", strtotime($from_date));
        $slider->to_date = date("Y-m-d", strtotime($to_date));
        $slider->$city_scope = $city_scope;
        $result= $slider->save();

        if($city_scope == SliderEnum::$ZONE['custom']){
            foreach($cities as $city){
                $slider_city = new SliderCity;
                $slider_city->slider_id = $slider->id;
                $slider_city->city_id = $city;
                $slider_city->save();

                $city_zones = City::where("id", $city)->with('zones')->get();
                foreach($city_zones->zones as $zone){
                    $slider_zone = new SliderZone;
                    $slider_zone->slider_id = $slider->id;
                    $slider_zone->zone_id = $zone->zone_id;
                    $slider_zone->save();
                }
            }
        }

        if(!$result)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"save data successfully", ['slider'=>Slider::findOrFail($slider->id)]);

    }

    public static function edit($id, $name, $type, $position, $platform, $size, $from_date, $to_date, $city_scope, $cities)
    {
        $slider=Slider::where('id', $id)
        ->update([
            'name'=>$name,
            'type'=>$type,
            'position'=>$position,
            'platform' => $platform,
            'size' => $size,
            'from_date' => date("Y-m-d", strtotime($from_date)),
            'to_date' => date("Y-m-d", strtotime($to_date)),
            'zone_scope' => $city_scope,
        ]);

        if($city_scope == SliderEnum::$ZONE['custom']){
            foreach($cities as $city){
                $slider_city = new SliderCity;
                $slider_city->slider_id = $slider->id;
                $slider_city->city_id = $city;
                $slider_city->save();

                $city_zones = City::where("id", $city)->with('zones')->get();
                foreach($city_zones->zones as $zone){
                    $slider_zone = new SliderZone;
                    $slider_zone->slider_id = $slider->id;
                    $slider_zone->zone_id = $zone->zone_id;
                    $slider_zone->save();
                }
            }
        }

        if(!$slider)
            return Helper::response(false,"Couldn't save data");

            return Helper::response(true,"Slider has been updated.", ['slider'=>Slider::findOrFail($id)]);

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
            return Helper::response(true,"Data fetched successfully", ["banners"=>$result]);
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
            case SliderEnum::$SIZE['square']:
                $width = SliderEnum::$BANNER_DIMENSIONS["square"][0];
                $height = SliderEnum::$BANNER_DIMENSIONS["square"][1];
            break;
            case SliderEnum::$SIZE['web']:
                $width = SliderEnum::$BANNER_DIMENSIONS["web"][0];
                $height = SliderEnum::$BANNER_DIMENSIONS["web"][1];
            break;
            default:
                $width = SliderEnum::$BANNER_DIMENSIONS["web"][0];
                $height = SliderEnum::$BANNER_DIMENSIONS["web"][1];
        }


        $image = new ImageManager(array('driver' => 'gd'));
//        $image->configure(array('driver' => 'gd'));

        $order = 0;

        SlideBanner::where("slider_id",$data["id"])->delete();
        $index = "banners";
        if (array_key_exists($index, $data)) {
            foreach ($data['banners'] as $banner) {
                $banner_file_name = "banner_" . uniqid() . ".png";
                $banners = new Banners;
                $banners->slider_id = $data['id'];
//                $banners->image = filter_var($banner['image'], FILTER_VALIDATE_URL) ? $banner['image'] : Helper::saveFile($image->make($banner['image'])->resize($width, $height)->encode('png', 100), $banner_file_name, "slide-banners");
                $banners->image = filter_var($banner['image'], FILTER_VALIDATE_URL) ? $banner['image'] :Helper::saveFile($image->make($banner['image'])->resize($width,$height)->encode('png', 100),$banner_file_name,"slide-banners");
                $banners->name = $banner['name'];
                $banners->desc = $banner['desc'];
                $banners->url = $banner['url'];
                $banners->from_date = date("Y-m-d", strtotime($banner['date']['from']));
                $banners->to_date = date("Y-m-d", strtotime($banner['date']['to']));
                $banners->order = $order;
                $result = $banners->save();
                $order++;
            }

            if(!$banner)
                return Helper::response(false,"Couldn't save data");
            else
                return Helper::response(true,"Banner Saved successfully",["slider"=>Slider::with("banners")->findOrFail($data['id'])]);
        }else{
            return Helper::response(false,"You dont have any banners here. Add a banner to get started.");
        }
    }

    public static function deleteBanner($id)
    {
        $result = SlideBanner::where("slider_id",$id)->destroy();


        if(!$result)
            return Helper::response(false,"Couldn't Delete data $result");
        else
            return Helper::response(true,"Data Deleted successfully");
    }

    public static function statusUpdate($id)
    {
        $slider = Slider::find($id);

        switch($slider->status){
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

        $update_status = Slider::where('id',$id)->update(["status"=>$status]);
        if(!$update_status)
            return Helper::response(false, "failed to updated status");

        return Helper::response(true, "status updated successfully");
    }

}
