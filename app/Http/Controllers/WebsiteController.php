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
        return view('website.booking.completecontactus');
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

    public function addBooking()
    {
        $categories=Service::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        return view('website.booking.addbooking', ['categories'=>$categories]);
    }
    public function estimateBooking()
    {
        return view('website.booking.estimatebooking');
    }
    public function placeBooking()
    {
        return view('website.booking.placebooking');
    }

    public function myBookings()
    {
        return view('website.booking.mybooking');
    }

    public function finalQuote()
    {
        return view('website.booking.finalquote');
    }

    public function payment()
    {
        return view('website.booking.payment');
    }

    public function orderDetails()
    {
        return view('website.booking.orderdetails');
    }

    public function bookingHistory()
    {
        return view('website.booking.bookinghistory');
    }

    public function myProfile()
    {
        return view('website.myprofile');
    }
    public function myRequest()
    {
        return view('website.myrequest');
    }

    public function termsAndCondition()
    {
        return view('website.termsandcondition');
    }
}
