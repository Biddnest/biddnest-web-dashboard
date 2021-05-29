<?php

namespace App\Http\Controllers;

use App\Enums\CommonEnums;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Testimonials;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class TestimonialController extends Controller
{
    public static function add($name, $designation, $image, $heading, $desc, $ratings)
    {
        $image_man = new ImageManager(array('driver' => 'gd'));
        $uniq = uniqid();

        $testimonial=new Testimonials;
        $testimonial->image =Helper::saveFile($image_man->make($image)->resize(100,100)->encode('png', 100),"BD".$uniq.".png","Testimonials");
        $testimonial->name =$name;
        $testimonial->designation= $designation;
        $testimonial->heading =$heading;
        $testimonial->desc =$desc;
        $testimonial->ratings =$ratings;
        $save_result = $testimonial->save();

        if(!$save_result)
            return Helper::response(false,"Couldn't save Testimonials");

        return Helper::response(true,"save Testimonials successfully", ["testimonials"=>Testimonials::findOrFail($testimonial->id)]);
    }

    public static function update($id, $name, $designation, $image, $heading, $desc, $ratings)
    {
        $image_man = new ImageManager(array('driver' => 'gd'));
        $uniq = uniqid();

        $update_data =[
          "name"=>$name,
          "designation"=>$designation,
          "heading"=>$heading,
          "desc"=>$desc,
            "ratings" =>$ratings
        ];

        if(filter_var($image, FILTER_VALIDATE_URL) === FALSE)
            $update_data["image"] = Helper::saveFile($image_man->make($image)->resize(100,100)->encode('png', 100),"BD".$uniq.".png","Testimonials");

        $update_result=Testimonials::where("id", $id)->update($update_data);

        if(!$update_result)
            return Helper::response(false,"Couldn't update Testimonials");

        return Helper::response(true,"update Testimonials successfully", ["testimonials"=>Testimonials::findOrFail($id)]);
    }

    public static function delete($id)
    {
        $delete=Testimonials::where("id", $id)->update(["deleted" => CommonEnums::$YES]);

        if(!$delete)
            return Helper::response(false,"Couldn't Delete Testimonials");

        return Helper::response(true,"Testimonials Deleted successfully");
    }

    public static function get()
    {
        $testimonials = Testimonials::where(['status'=>CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])->get();

        return Helper::response(true,"Testimonials", ["testimonials"=>$testimonials]);
    }
}
