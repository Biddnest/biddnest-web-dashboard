<?php

namespace App\Http\Controllers;

use App\Enums\CommonEnums;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Service;
use App\Models\Testimonials;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function home()
    {
        $testimonial=Testimonials::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        $categories=Service::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        return view('website.home', ["testimonials"=>$testimonial, "categories"=>$categories]);
    }

    public function joinVendor()
    {
        return view('website.vendor');
    }

    public function contactUs()
    {
        return view('website.contactus');
    }

    public function completeContactUs()
    {
        return view('website.completecontactus');
    }

    public function faq()
    {
        $faqs=Faq::get();
        return view('website.faq', ['faqs'=>$faqs]);
    }

    public function termsAndConditions()
    {
        $faqs=Faq::get();
        return view('website.faq', ['faqs'=>$faqs]);
    }
}
