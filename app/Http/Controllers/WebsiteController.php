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

    public function termsAndCondition()
    {
        return view('website.termsandcondition');
    }

    public function addBooking()
    {
        $categories=Service::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        return view('website.booking.addbooking', ['categories'=>$categories]);
    }
    public function estimateBooking(Request $request)
    {
        $id=$request->booking_id;
        return view('website.booking.estimatebooking');
    }

    public function placeBooking(Request $request)
    {
        $id=$request->booking_id;
        return view('website.booking.placebooking');
    }

    public function myBookings(Request $request)
    {
        $bookings=BookingsController::bookingHistoryLive(214, true);
        return view('website.booking.mybooking', ['bookings'=>$bookings]);
    }

    public function finalQuote(Request $request)
    {
        return view('website.booking.finalquote');
    }

    public function payment(Request $request)
    {
        $id=$request->booking_id;
        return view('website.booking.payment');
    }

    public function orderDetails(Request $request)
    {
        return view('website.booking.orderdetails');
    }

    public function bookingHistory(Request $request)
    {
        return view('website.booking.bookinghistory');
    }

    public function myProfile(Request $request)
    {
        return view('website.myprofile');
    }
    public function myRequest(Request $request)
    {
        return view('website.myrequest');
    }

}
