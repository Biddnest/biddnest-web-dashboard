<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Banners;
use App\Helper;
use App\Sms;

class SliderController extends Controller
{

    public static function sliders()
    {
        $result=DB::table('sliders')->select('*')->where(['status'=> 1, 'deleted'=>0])->get();

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", $result);
    }

    public static function SliderAdd($name, $type, $position, $platform, $size, $from_date, $to_date, $zone_specific)
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

    public static function slidersDelete($id)
    {
        $result=DB::update(
            'update sliders set deleted = ? where id = ?',
            [1, $id]
        );

        $result=DB::update(
            'update banners set deleted = ? where slider_id = ?',
            [1, $id]
        );

        if(!$result)
            return Helper::response(false,"Couldn't Delete data $result");
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

    public static function BannerAdd($data)
    {
        $last = DB::table('sliders')->latest()->first();

        $name = $data['name'];
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $order = $data['order'];
        $url = $data['url'];
        $img = $data['file'];


        foreach($name as $key => $input) {
            $banners=new Banners;
            $banners->slider_id= $last->id;
            $banners->image= isset($img[$key]) ? $img[$key] : '';
            $banners->name=isset($name[$key]) ? $name[$key] : '';
            $banners->url=isset($url[$key]) ? $url[$key] : '';
            $banners->from_date=isset($from_date[$key]) ? $from_date[$key] : '';
            $banners->to_date =isset($to_date[$key]) ? $to_date[$key] : '';
            $banners->order =isset($order[$key]) ? $order[$key] : '';
            $result= $banners->save();
        }      

        if(!$result)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"save data successfully");
    }

    public static function bannersDelete($id)
    {
        $result=DB::update(
            'update banners set deleted = ? where id = ?',
            [1, $id]
        );

        if(!$result)
            return Helper::response(false,"Couldn't Delete data $result");
        else
            return Helper::response(true,"Data Deleted successfully");
    }
}
