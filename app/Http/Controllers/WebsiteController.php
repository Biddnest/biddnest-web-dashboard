<?php

namespace App\Http\Controllers;

use App\Enums\BidEnums;
use App\Enums\BookingEnums;
use App\Enums\CommonEnums;
use App\Enums\SliderEnum;
use App\Enums\ServiceEnums;
use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\Booking;
use App\Models\Coupon;
use App\Models\Faq;
use App\Models\Inventory;
use App\Models\Page;
use App\Models\Service;
use App\Models\Settings;
use App\Models\Testimonials;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Zone;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class WebsiteController extends Controller
{
    public function home()
    {
        $testimonial=Testimonials::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        $categories=Service::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        $contact_details=Settings::where("key", "contact_details")->pluck('value')[0];
        $slider= Slider::where(["status"=> CommonEnums::$YES,
            "deleted"=> CommonEnums::$NO,
            "platform"=>SliderEnum::$PLATFORM['web'],
            "size"=>SliderEnum::$SIZE['web']])
            ->with(['banners'=>function($query){
                $query->whereDate("from_date","<=", date("Y-m-d", time()))
                ->whereDate("to_date",">=", date("Y-m-d", time()));
            }])
            ->whereDate("from_date","<=", date("Y-m-d", time()))
            ->whereDate("to_date",">=", date("Y-m-d", time()))
            ->first();

        return view('website.home', [
            "testimonials"=>$testimonial,
            "categories"=>$categories,
            'contact_details'=>$contact_details,
            "slider"=>$slider
        ]);
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
        $ticket_details=[];
        if(Session::get('account')) {
            $booking = Booking::where("user_id", Session::get('account')['id'])->whereNotIn("status", [BookingEnums::$STATUS['completed'], BookingEnums::$STATUS['cancelled']])->latest()->limit(1)->first();
           if($booking) {
               $ticket_details = Ticket::where("booking_id", $booking->id)->with(['reply' => function ($query) {
                   $query->where("user_id", null)->with('admin')->latest()->limit(1);
               }])->first();
           }
        }

        $contact_details=Settings::where("key", "contact_details")->pluck('value')[0];
        return view('website.contactus', ['booking'=>$booking, 'contact_details'=>$contact_details, 'ticket_detail'=>$ticket_details]);
    }

    /*public function completeContactUs()
    {
        $booking=Booking::where("user_id", Session::get('account')['id'])->whereNotIn("status", [BookingEnums::$STATUS['completed'], BookingEnums::$STATUS['cancelled']])->latest()->limit(1)->first();
        $contact_details=Settings::where("key", "contact_details")->pluck('value')[0];
         $ticket_details=Ticket::where("booking_id", $booking->id)->with(['reply'=>function($query){
            $query->where("user_id", null)->latest()->limit(1);
        }])->with('admin')->first();
        return view('website.completecontactus', ['booking'=>$booking, 'contact_details'=>$contact_details, 'ticket_detail'=>$ticket_details]);
    }*/

    public function faq()
    {
        $faqs=Faq::get();
        return view('website.faq', ['faqs'=>$faqs]);
    }

    public function termPage(Request $request)
    {
        $page=Page::where("slug", $request->slug)->first();
        return view('website.page', ['page'=>$page]);
    }

    public function addBooking(Request $request)
    {
        $categories=Service::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        $inventories=Inventory::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        $zone=(array)Zone::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->pluck('name')->toArray();

        return view('website.booking.addbooking', [
            'categories'=>$categories,
            'inventories'=>$inventories,
            'zones'=>$zone,
            'prifill'=>$request->all(),
            'inventory_quantity_type'=>Service::where("id",$request->service)->pluck("inventory_quantity_type")[0]
        ]);
    }

    public function estimateBooking(Request $request)
    {
        $booking = Booking::where(["public_enquiry_id"=>$request->id, "user_id"=>Session::get('account')['id']])->all();
        if(!$booking)
            abort(404);
        $reason = json_decode(Settings::where("key", "cancellation_reason_options")->pluck('value')[0], true);
        return view('website.booking.estimatebooking',['booking'=>$booking, 'reasons'=>$reason]);
    }

    public function placeBooking(Request $request)
    {
        $booking = Booking::where(["public_enquiry_id"=>$request->id, "user_id"=>Session::get('account')['id']])->first();
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
        $booking=BookingsController::getBookingByPublicIdForWeb($request->id, Session::get('account')['id'], true);
        if(!$booking)
            abort(404);
        return view('website.booking.finalquote', ['booking'=>$booking, 'resions'=>$reject_resions]);
    }

    public function payment(Request $request)
    {
        $user = User::where("id", Session::get('account')['id'])->first();
        $moving_date=Bid::where(["booking_id"=>(int)Booking::where("public_booking_id", $request->id)->pluck('id')[0], "status"=>BidEnums::$STATUS['won']])->pluck('meta')[0];
        $payment_summary=BookingsController::getPaymentDetails($request->id, 0.00, true);
        $coupons=Coupon::where(['status'=>CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])->get();
        return view('website.booking.payment', ['payment_summary'=>$payment_summary, 'coupons'=>$coupons, "public_booking_id"=>$request->id, "user"=>$user, "moving_date"=>json_decode($moving_date, true)['moving_date']]);
    }

    public function orderDetails(Request $request)
    {
//        exit;
//        return $booking=Booking::where("public_booking_id",$request->id)->all();

        $booking=BookingsController::getBookingByPublicIdForWeb($request->id, Session::get('account')['id'], true);
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
        $tickets=Ticket::where('user_id', Session::get('account')['id'])->orderBy('id', 'DESC')->paginate(5);
        return view('website.myrequest', ['tickets'=>$tickets]);
    }

}
