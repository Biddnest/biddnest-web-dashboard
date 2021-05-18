<?php

namespace App\Http\Controllers;

use App\Enums\CommonEnums;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Testimonials;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public static function home()
    {
        $testimonial=Testimonials::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        $categories=Service::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        return view('website.home', ["testimonials"=>$testimonial, "categories"=>$categories]);
    }
}
