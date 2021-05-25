<?php

namespace App\Http\Controllers;

use App\Enums\BookingEnums;
use App\Enums\CommonEnums;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Coupon;
use App\Models\Faq;
use App\Models\Service;
use App\Models\Settings;
use App\Models\Testimonials;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WebsiteController extends Controller
{
    public function home()
    {
        $testimonial=Testimonials::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        $categories=Service::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        $contact_details=Settings::where("key", "contact_details")->pluck('value')[0];
        return view('website.home', ["testimonials"=>$testimonial, "categories"=>$categories, 'contact_details'=>$contact_details]);
    }

    public function logout()
    {
        Session::flush();
        return response()->redirectToRoute('home');
    }

    public function joinVendor()
    {
        return view('website.vendor');
    }

    public function contactUs()
    {
        $booking=[];
        if(Session::get('account'))
           $booking=Booking::where("user_id", Session::get('account')['id'])->whereNotIn("status", [BookingEnums::$STATUS['completed'], BookingEnums::$STATUS['cancelled']])->latest()->limit(1)->get();

        $contact_details=Settings::where("key", "contact_details")->pluck('value')[0];
        return view('website.contactus', ['bookings'=>$booking, 'contact_details'=>$contact_details]);
    }

    public function completeContactUs()
    {
        $booking=Booking::where("user_id", Session::get('account')['id'])->whereNotIn("status", [BookingEnums::$STATUS['completed'], BookingEnums::$STATUS['cancelled']])->latest()->limit(1)->first();
        $contact_details=Settings::where("key", "contact_details")->pluck('value')[0];
         $ticket_details=Ticket::where("booking_id", $booking->id)->with(['reply'=>function($query){
            $query->where("user_id", null)->latest()->limit(1);
        }])->with('admin')->first();
        return view('website.completecontactus', ['booking'=>$booking, 'contact_details'=>$contact_details, 'ticket_detail'=>$ticket_details]);
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
        $booking = Booking::where(["public_booking_id"=>$request->id, "user_id"=>Session::get('account')['id']])->first();
        return view('website.booking.estimatebooking',['booking'=>$booking]);
    }

    public function placeBooking(Request $request)
    {
        $booking = Booking::where(["public_booking_id"=>$request->id, "user_id"=>Session::get('account')['id']])->first();
        return view('website.booking.placebooking',['booking'=>$booking]);
    }

    public function myBookings(Request $request)
    {
        $bookings=BookingsController::bookingHistoryLive(Session::get('account')['id'], true);
        return view('website.booking.mybooking', ['bookings'=>$bookings]);
    }

    public function myBookingsEnquiries(Request $request)
    {
        $bookings=BookingsController::bookingHistoryEnquiry(Session::get('account')['id'], true);
        return view('website.booking.mybookingenquiries', ['bookings'=>$bookings]);
    }

    public function finalQuote(Request $request)
    {
        $reject_resions=json_decode(Settings::where("key", "cancellation_reason_options")->pluck('value')[0], true);
        $booking=BookingsController::getBookingByPublicIdForApp($request->id, Session::get('account')['id'], true);
        return view('website.booking.finalquote', ['booking'=>$booking, 'resions'=>$reject_resions]);
    }

    public function payment(Request $request)
    {
        $payment_summary=BookingsController::getPaymentDetails($request->id, 0.00, true);
        $coupons=Coupon::where(['status'=>CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])->get();
        return view('website.booking.payment', ['payment_summary'=>$payment_summary, 'coupons'=>$coupons, "public_booking_id"=>$request->id]);
    }

    /*public function verifiedPayment(Request $request)
    {
        $coupon_veridied=BookingsController::getPaymentDetails($request->id, 0.00, true);
        $coupons=Coupon::where(['status'=>CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])->get();
        return view('website.booking.payment', ['payment_summary'=>$coupon_veridied, 'coupons'=>$coupons, "public_booking_id"=>$request->id]);
    }*/

    public function orderDetails(Request $request)
    {
        $booking=BookingsController::getBookingByPublicIdForApp($request->id, Session::get('account')['id'], true);
        return view('website.booking.orderdetails', ['booking'=>$booking]);
    }

    public function bookingHistory(Request $request)
    {
        $bookings=BookingsController::bookingHistoryPast(Session::get('account')['id'], true);
        return view('website.booking.bookinghistory', ['bookings'=>$bookings]);
    }

    public function myProfile(Request $request)
    {
        $user = User::where('id', Session::get('account')['id'])->first();
        return view('website.myprofile', ['user'=>$user]);
    }
    public function myRequest(Request $request)
    {
        $tickets=TicketController::get(Session::get('account')['id'], true);
        return view('website.myrequest', ['tickets'=>$tickets]);
    }

}
