<?php

namespace App\Http\Controllers;

use App\Http\Controllers\VendorUserController;
use App\Enums\AdminEnums;
use App\Enums\BidEnums;
use App\Enums\BookingEnums;
use App\Enums\CommonEnums;
use App\Enums\CouponEnums;
use App\Enums\NotificationEnums;
use App\Enums\OrganizationEnums;
use App\Enums\PaymentEnums;
use App\Enums\ServiceEnums;
use App\Enums\SliderEnum;
use App\Enums\TicketEnums;
use App\Enums\UserEnums;
use App\Enums\VendorEnums;
use App\Enums\VoucherEnums;
use App\Enums\PayoutEnums;
use App\Models\Admin;
use App\Models\AdminZone;
use App\Models\Banners;
use App\Models\Booking;
use App\Models\Coupon;
use App\Models\CouponZone;
use App\Models\CouponCity;
use App\Models\Faq;
use App\Models\Inventory;
use App\Models\InventoryPrice;
use App\Models\Notification;
use App\Models\Org_kyc;
use App\Models\Organization;
use App\Models\Page;
use App\Models\Payment;
use App\Models\Payout;
use App\Models\Report;
use App\Models\Review;
use App\Models\Service;
use App\Models\Settings;
use App\Models\Slider;
use App\Models\SliderZone;
use App\Models\Subservice;
use App\Models\SubserviceInventory;
use App\Models\SubservicePrice;
use App\Models\Testimonials;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Zone;
use App\Models\CityZone;
use App\Models\City;
use App\Models\Voucher;
use App\Models\BookingOrganizationGeneratedPrice;
use App\Models\MovementDates;
use App\Models\OrganizationZone;
use App\Models\OrganizationCity;
use Bavix\Wallet\Models\Transaction;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\ZoneReferralReward;
use App\Enums\ReferralEnums;

class WebController extends Controller
{


    public function login()
    {
        return view('login.login');
    }

    public function logout()
    {
        /*Session::forget('sessionActive');
        Session::forget('logged_in');
        Session::forget('account');
        Session::forget('user_role');*/

        Session::flush();
//        session_unset();
        return response()->redirectToRoute('login');
    }

    public function forgotPassword()
    {
        return view('login.forgotpassword');
    }

    public function verifyOtp()
    {
        return view('login.verifyotp');
    }

    public function resetPassword(Request $request)
    {
        $admin=Admin::where('id', Crypt::decryptString($request->id))->first();
        return view('login.reset_password', ['admin'=>$admin]);
    }

    public function Passwordreset(Request $request)
    {
        $admin=Admin::where('id', Session::get("id"))->first();
        return view('reset_password', ['admin'=>$admin]);
    }

    //index.php
    public function dashboard(Request $request)
    {

//        return "hai";
        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');

        $count_orders =Booking::where('deleted', CommonEnums::$NO)->whereIn("zone_id",$zone);

        if(Session::get('user_role') == AdminEnums::$ROLES['virtual_assistant'])
            $count_orders->where('virtual_assistant_id', Session::get('account')['id']);

        $id_org_zone = OrganizationZone :: whereIn("zone_id", $zone)->groupBy("organization_id")->pluck('organization_id');
        $count_vendors=Organization::where(['status'=>OrganizationEnums::$STATUS['active'], 'deleted'=>CommonEnums::$NO])->whereIn("id",$id_org_zone)->count();
        $count_users=User::where(['status'=>UserEnums::$STATUS['active'], 'deleted'=>CommonEnums::$NO])->count();

        $count_zones=Zone::where(['status'=>CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])->whereIn("id",$zone)->count();

        $count_live_orders=Booking::where(['deleted'=>CommonEnums::$NO])->whereNotIn('status', [BookingEnums::$STATUS['enquiry'], BookingEnums::$STATUS['completed'], BookingEnums::$STATUS['cancelled']])->whereIn("zone_id",$zone);

        if(Session::get('user_role') == AdminEnums::$ROLES['virtual_assistant'])
            $count_live_orders->where('virtual_assistant_id', Session::get('account')['id']);


        $days = 7;
        if($request->period == "monthly")
            $days = 30;

        if($request->period == "quarterly")
            $days = 90;


        $dataset = [];
        $this_week = CarbonPeriod::create( Carbon::now()->subDays($days)->format("Y-m-d"),Carbon::now()->format("Y-m-d"))->toArray();

        $last_week = CarbonPeriod::create( Carbon::now()->subDays($days*2)->format("Y-m-d"), Carbon::now()->subDays(7)->format("Y-m-d"))->toArray();

        $this_week_sale = [];
        $last_week_sale = [];
        foreach ($this_week as $key=>$date){
            $date1 = $date->format('Y-m-d');
            $this_week[$key] = $date->format('d M');
            $sale_bookings = Booking::whereDate("created_at",$date1)
                                       ->whereDate("status",">=",BookingEnums::$STATUS['pending_driver_assign']);
            if(Session::get('user_role') == AdminEnums::$ROLES['virtual_assistant'])
                $sale_bookings->where('virtual_assistant_id', Session::get('account')['id']);

            $this_week_sale[] = $sale_bookings->sum("final_quote");
        }
        foreach ($last_week as $key=>$date){
            $date1 = $date->format('Y-m-d');
//            $last_week[$key] = $date->format('d M');
             $week_booking = Booking::whereDate("created_at",$date1)
                                       ->whereDate("status",">=",BookingEnums::$STATUS['pending_driver_assign']);

            if(Session::get('user_role') == AdminEnums::$ROLES['virtual_assistant'])
                $week_booking->where('virtual_assistant_id', Session::get('account')['id']);

            $last_week_sale[] = $week_booking->sum("final_quote");
        }
        $booking = Booking::where(['deleted'=>CommonEnums::$NO])->whereIn("zone_id",$zone)->orderBy("updated_at","DESC")->limit(3)->get();


        return view('index', ['count_orders'=>$count_orders->count(),
            'count_vendors'=>$count_vendors,
            'count_users'=>$count_users,
            'count_zones'=>$count_zones,
            'count_live_orders'=>$count_live_orders->count(),
            'bookings'=>$booking,
            'graph'=>[
                "revenue"=>[
                    "this_week"=>[
                    "dates"=>$this_week,
                    "sales"=>$this_week_sale
                ],
                    "last_week"=>[
                    "dates"=>$this_week,
                     "sales"=>$last_week_sale
                ],
                    ],
                "order_distribution"=>Booking::select('status', DB::raw("count(*) AS count"))->groupBy('status')->get(),
                "vendor_statewise"=>Organization::select('state', DB::raw("count(*) AS count"))->groupBy('state')->get()
            ],
        ]);
    }

    public function apiSettings()
    {
        $setting =Settings::whereNotIn('key', ["contact_details", "msg91_key", "google_api_key", "razor_key", "razor_secret", "razor_webhook_secret", "onesignal_user_app_creds", "onesignal_vendor_app_creds", "razorpayx_key", "razorpayx_secret", "msg91_sender_id"])->get();
        return view('system_setting.all_setting', ['settings'=>$setting]);
    }

    public function apiSettingsapi()
    {
        $setting =Settings::whereNotIn('key', ["contact_details"])->whereIn('key', ["msg91_key", "google_api_key", "razor_key", "razor_secret", "razor_webhook_secret", "onesignal_user_app_creds", "onesignal_vendor_app_creds", "razorpayx_key", "razorpayx_secret", "msg91_sender_id"])->get();

        return view('system_setting.api_setting', ['settings'=>$setting]);
    }

    public function faq()
    {
        $faq = Faq::get();
        return view('system_setting.faq', ['faqs'=>$faq]);
    }

    public function faq_by_category(Request $request)
    {
        $faq = Faq::where('category', $request->type)->get();
        return view('system_setting.faqcategory', ['faqs'=>$faq, 'type'=>$request->type]);
    }

    public function addfaq(){
        return view('system_setting.createfaq', ['faq'=>[]]);
    }

    public function editfaq(Request $request){
        $faqs = Faq::where(["id"=>$request->id, "deleted"=>CommonEnums::$NO])->first();
        return view('system_setting.createfaq', ['faq'=>$faqs]);
    }

    public function contact_us()
    {
        $contact_us =Settings::where('key', ["contact_details"])->pluck('value')[0];
        return view('system_setting.contact_us', ['contact_us'=>json_decode($contact_us, true)]);
    }

    public function pages()
    {
        $pages=Page::where('deleted', CommonEnums::$NO)->paginate(CommonEnums::$PAGE_LENGTH);
        return view('system_setting.pages', ['pages'=>$pages]);
    }

    public function createpages(Request $request)
    {
        $pages=Page::where('id', $request->id)->first();
        return view('system_setting.createpage', ['pages'=>$pages]);
    }

    public function ordersBookingsLive(Request $request)
    {
        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');

        if(Session::get('user_role') == AdminEnums::$ROLES['virtual_assistant'])
            $zone = Zone::pluck('id');

        $bookings = Booking::whereNotIn("status",[BookingEnums::$STATUS["cancelled"],BookingEnums::$STATUS['completed'], BookingEnums::$STATUS['hold'], BookingEnums::$STATUS['bounced'], BookingEnums::$STATUS['cancel_request'], BookingEnums::$STATUS['in_progress'], BookingEnums::$STATUS['awaiting_bid_result'], BookingEnums::$STATUS['price_review_pending']])
            ->where("deleted", CommonEnums::$NO)->where("status", ">", BookingEnums::$STATUS['payment_pending'])->whereIn("zone_id", $zone);

        if(Session::get('user_role') == AdminEnums::$ROLES['virtual_assistant'])
            $bookings->where('virtual_assistant_id', Session::get('account')['id']);

        $confirm_count = $bookings->count();

        if($request->search){
          $bookings->where('public_booking_id', 'like', $request->search."%")
                ->orWhere('source_meta', 'like', "%".$request->search."%")
                ->orWhere('destination_meta', 'like', "%".$request->search."%");
        }

        $bookings->with('service')
            ->with('organization')
            ->orderBy("id","DESC");

        $booking_count =  Booking::where("status", "<=", BookingEnums::$STATUS['payment_pending'])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();
        $past_count =  Booking::whereIn("status",[BookingEnums::$STATUS["cancelled"],BookingEnums::$STATUS['completed']])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();
        $hold_count= Booking::whereIn("status",[BookingEnums::$STATUS["hold"]])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();
        $bounced_count = Booking::whereIn("status",[BookingEnums::$STATUS["bounced"]])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();
        $cancelled_count = Booking::whereIn("status",[BookingEnums::$STATUS["cancel_request"]])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();

        return view('order.ordersbookings_live',[
            "bookings" => $bookings->paginate(CommonEnums::$PAGE_LENGTH), "booking_count"=>$booking_count, "confirm_count"=>$confirm_count, "past_count"=>$past_count, "hold_count"=>$hold_count, "bounced_count"=>$bounced_count, "cancelled_count"=>$cancelled_count
        ]);
    }

    public function ordersBookingsEnquiry(Request $request)
    {
        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');

        if(Session::get('user_role') == AdminEnums::$ROLES['virtual_assistant'])
            $zone = Zone::pluck('id');

        $bookings = Booking::where(function($query){
            $query->where("status", "<=", BookingEnums::$STATUS['payment_pending'])
                ->orWhereIn('status', [BookingEnums::$STATUS['awaiting_bid_result'], BookingEnums::$STATUS['price_review_pending']]);
        })
            ->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone);

        if(Session::get('user_role') == AdminEnums::$ROLES['virtual_assistant'])
            $bookings->where('virtual_assistant_id', Session::get('account')['id']);

        $booking_count = $bookings->count();

        if($request->search){
            $bookings->where(function($query) use ($request){
                $query->where('public_booking_id', 'LIKE', $request->search."%")
                    ->orWhere('public_enquiry_id', 'LIKE', $request->search."%")
                    ->orWhere('source_meta', 'like', "%".$request->search."%")
                    ->orWhere('destination_meta', 'like', "%".$request->search."%");
            });
        }

        $bookings->with('service')
            ->with('organization')
            ->orderBy("id","DESC");

        $confirm_count =Booking::whereNotIn("status",[BookingEnums::$STATUS["cancelled"],BookingEnums::$STATUS['completed'], BookingEnums::$STATUS['hold'], BookingEnums::$STATUS['bounced'], BookingEnums::$STATUS['cancel_request'], BookingEnums::$STATUS['in_progress'], BookingEnums::$STATUS['price_review_pending']])
            ->where("deleted", CommonEnums::$NO)->where("status", ">", BookingEnums::$STATUS['payment_pending'])->whereIn("zone_id", $zone)->count();
        $past_count =  Booking::whereIn("status",[BookingEnums::$STATUS["cancelled"],BookingEnums::$STATUS['completed']])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();
        $hold_count= Booking::whereIn("status",[BookingEnums::$STATUS["hold"]])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();
        $bounced_count = Booking::whereIn("status",[BookingEnums::$STATUS["bounced"]])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();
        $cancelled_count = Booking::whereIn("status",[BookingEnums::$STATUS["cancel_request"],BookingEnums::$STATUS["cancelled"]])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();

        return view('order.ordersbooking_enquiry',[
            "bookings" => $bookings->paginate(CommonEnums::$PAGE_LENGTH), "booking_count"=>$booking_count, "confirm_count"=>$confirm_count, "past_count"=>$past_count, "hold_count"=>$hold_count, "bounced_count"=>$bounced_count, "cancelled_count"=>$cancelled_count,
            "search"=>$request->search ?: ""
        ]);
    }

    public function ordersBookingsPast(Request $request)
    {
        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');

        if(Session::get('user_role') == AdminEnums::$ROLES['virtual_assistant'])
            $zone = Zone::pluck('id');

       $bookings = Booking::whereIn("status",[BookingEnums::$STATUS["cancelled"],BookingEnums::$STATUS['completed']])
           ->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone);

        if(Session::get('user_role') == AdminEnums::$ROLES['virtual_assistant'])
           $bookings->where('virtual_assistant_id', Session::get('account')['id']);

        $past_count=$bookings->count();

        if(isset($request->search)){
         $bookings->where('public_booking_id', 'like', $request->search."%")
                ->orWhere('source_meta', 'like', "%".$request->search."%")
                ->orWhere('destination_meta', 'like', "%".$request->search."%");
        }

        $bookings->with("service")
           ->with('organization')
           ->orderBy("id","DESC");

        $booking_count =  Booking::where("status", "<=", BookingEnums::$STATUS['payment_pending'])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();
        $confirm_count =Booking::whereNotIn("status",[BookingEnums::$STATUS["cancelled"],BookingEnums::$STATUS['completed'], BookingEnums::$STATUS['hold'], BookingEnums::$STATUS['bounced'], BookingEnums::$STATUS['cancel_request'], BookingEnums::$STATUS['in_progress'], BookingEnums::$STATUS['price_review_pending']])
            ->where("deleted", CommonEnums::$NO)->where("status", ">", BookingEnums::$STATUS['payment_pending'])->whereIn("zone_id", $zone)->count();
        $hold_count= Booking::whereIn("status",[BookingEnums::$STATUS["hold"]])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();
        $bounced_count = Booking::whereIn("status",[BookingEnums::$STATUS["bounced"]])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();
        $cancelled_count = Booking::whereIn("status",[BookingEnums::$STATUS["cancel_request"],BookingEnums::$STATUS["cancelled"]])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();

        return view('order.ordersbookings_past',[
            "bookings" => $bookings->paginate(CommonEnums::$PAGE_LENGTH), "booking_count"=>$booking_count, "confirm_count"=>$confirm_count, "past_count"=>$past_count, "hold_count"=>$hold_count, "bounced_count"=>$bounced_count, "cancelled_count"=>$cancelled_count, "search"=>$request->search ?: ""
        ]);
    }

    public function ordersBookingsHold(Request $request)
    {
        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');

        if(Session::get('user_role') == AdminEnums::$ROLES['virtual_assistant'])
            $zone = Zone::pluck('id');

       $bookings = Booking::whereIn("status",[BookingEnums::$STATUS["hold"]])
           ->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone);

        if(Session::get('user_role') == AdminEnums::$ROLES['virtual_assistant'])
           $bookings->where('virtual_assistant_id', Session::get('account')['id']);

        $hold_count=$bookings->count();

        if(isset($request->search)){
            $bookings=$bookings->where('public_booking_id', 'like', $request->search."%")
                ->orWhere('source_meta', 'like', "%".$request->search."%")
                ->orWhere('destination_meta', 'like', "%".$request->search."%");
        }

        $bookings->with("service")
           ->with('organization')
           ->orderBy("id","DESC");

        $booking_count =  Booking::where("status", "<=", BookingEnums::$STATUS['payment_pending'])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();
        $confirm_count =Booking::whereNotIn("status",[BookingEnums::$STATUS["cancelled"],BookingEnums::$STATUS['completed'], BookingEnums::$STATUS['hold'], BookingEnums::$STATUS['bounced'], BookingEnums::$STATUS['cancel_request'], BookingEnums::$STATUS['in_progress'], BookingEnums::$STATUS['price_review_pending']])
            ->where("deleted", CommonEnums::$NO)->where("status", ">", BookingEnums::$STATUS['payment_pending'])->whereIn("zone_id", $zone)->count();
        $past_count =  Booking::whereIn("status",[BookingEnums::$STATUS["cancelled"],BookingEnums::$STATUS['completed']])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();
        $bounced_count = Booking::whereIn("status",[BookingEnums::$STATUS["bounced"]])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();
        $cancelled_count = Booking::whereIn("status",[BookingEnums::$STATUS["cancel_request"],BookingEnums::$STATUS["cancelled"]])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();

        return view('order.ordersbookings_hold',[
            "bookings" => $bookings->paginate(CommonEnums::$PAGE_LENGTH), "booking_count"=>$booking_count, "confirm_count"=>$confirm_count, "past_count"=>$past_count, "hold_count"=>$hold_count, "bounced_count"=>$bounced_count, "cancelled_count"=>$cancelled_count, "search"=>$request->search ?: ""
        ]);
    }

    public function ordersBookingsBounced(Request $request)
    {
        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');

        if(Session::get('user_role') == AdminEnums::$ROLES['virtual_assistant'])
            $zone = Zone::pluck('id');

       $bookings = Booking::whereIn("status",[BookingEnums::$STATUS["bounced"]])
           ->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone);

        if(Session::get('user_role') == AdminEnums::$ROLES['virtual_assistant'])
           $bookings->where('virtual_assistant_id', Session::get('account')['id']);

        $bounced_count=$bookings->count();

        if(isset($request->search)){
            $bookings=$bookings->where('public_booking_id', 'like', $request->search."%")
                ->orWhere('source_meta', 'like', "%".$request->search."%")
                ->orWhere('destination_meta', 'like', "%".$request->search."%");
        }

        $bookings->with("service")
           ->with('organization')
           ->orderBy("id","DESC");

        $booking_count =  Booking::where("status", "<=", BookingEnums::$STATUS['payment_pending'])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();
        $confirm_count =Booking::whereNotIn("status",[BookingEnums::$STATUS["cancelled"],BookingEnums::$STATUS['completed'], BookingEnums::$STATUS['hold'], BookingEnums::$STATUS['bounced'], BookingEnums::$STATUS['cancel_request'], BookingEnums::$STATUS['in_progress'], BookingEnums::$STATUS['price_review_pending']])
            ->where("deleted", CommonEnums::$NO)->where("status", ">", BookingEnums::$STATUS['payment_pending'])->whereIn("zone_id", $zone)->count();
        $past_count =  Booking::whereIn("status",[BookingEnums::$STATUS["cancelled"],BookingEnums::$STATUS['completed']])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();
        $hold_count= Booking::whereIn("status",[BookingEnums::$STATUS["hold"]])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();
        $cancelled_count = Booking::whereIn("status",[BookingEnums::$STATUS["cancel_request"],BookingEnums::$STATUS["cancelled"]])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();

        return view('order.ordersbookings_bounced',[
            "bookings" => $bookings->paginate(CommonEnums::$PAGE_LENGTH), "booking_count"=>$booking_count, "confirm_count"=>$confirm_count, "past_count"=>$past_count, "hold_count"=>$hold_count, "bounced_count"=>$bounced_count, "cancelled_count"=>$cancelled_count, "search"=>$request->search ?: ""
        ]);
    }

    public function ordersBookingsCancelled(Request $request)
    {
        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');

        if(Session::get('user_role') == AdminEnums::$ROLES['virtual_assistant'])
            $zone = Zone::pluck('id');

        $bookings = Booking::whereIn("status",[BookingEnums::$STATUS["cancel_request"],BookingEnums::$STATUS["cancelled"]])
            ->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone);

        if(Session::get('user_role') == AdminEnums::$ROLES['virtual_assistant'])
            $bookings->where('virtual_assistant_id', Session::get('account')['id']);

        $cancelled_count=$bookings->count();

        if(isset($request->search)){
            $bookings=$bookings->where('public_booking_id', 'like', $request->search."%")
                ->orWhere('source_meta', 'like', "%".$request->search."%")
                ->orWhere('destination_meta', 'like', "%".$request->search."%");
        }

        $bookings->with("service")
            ->with('organization')
            ->orderBy("id","DESC");

        $booking_count =  Booking::where("status", "<=", BookingEnums::$STATUS['payment_pending'])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();

        $confirm_count =Booking::whereNotIn("status",[BookingEnums::$STATUS["cancelled"],BookingEnums::$STATUS['completed'], BookingEnums::$STATUS['hold'], BookingEnums::$STATUS['bounced'], BookingEnums::$STATUS['cancel_request'], BookingEnums::$STATUS['in_progress'], BookingEnums::$STATUS['price_review_pending']])
            ->where("deleted", CommonEnums::$NO)->where("status", ">", BookingEnums::$STATUS['payment_pending'])->whereIn("zone_id", $zone)->count();

        $past_count =  Booking::whereIn("status",[BookingEnums::$STATUS["cancelled"],BookingEnums::$STATUS['completed']])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();

        $hold_count= Booking::whereIn("status",[BookingEnums::$STATUS["hold"]])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();

        $bounced_count = Booking::whereIn("status",[BookingEnums::$STATUS["bounced"]])->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone)->count();

        return view('order.ordersbookings_cancel',[
            "bookings" => $bookings->paginate(CommonEnums::$PAGE_LENGTH), "booking_count"=>$booking_count, "confirm_count"=>$confirm_count, "past_count"=>$past_count, "hold_count"=>$hold_count, "bounced_count"=>$bounced_count, "cancelled_count"=>$cancelled_count
        ]);
    }

    public function ordersBookingsInProgress(Request $request)
    {
        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');

        if(Session::get('user_role') == AdminEnums::$ROLES['virtual_assistant'])
            $zone = Zone::pluck('id');

        $bookings = Booking::whereIn("status",[BookingEnums::$STATUS["in_progress"]])
            ->where("deleted", CommonEnums::$NO)->whereIn("zone_id", $zone);

        if(Session::get('user_role') == AdminEnums::$ROLES['virtual_assistant'])
            $bookings->where('virtual_assistant_id', Session::get('account')['id']);

        if(isset($request->search)){
            $bookings->where('public_booking_id', 'like', $request->search."%")
                ->orWhere('public_enquiry_id', 'like', $request->search."%")
                ->orWhere('source_meta', 'like', "%".$request->search."%")
                ->orWhere('destination_meta', 'like', "%".$request->search."%");
        }

        $bookings->with("service")
            ->with('organization')
            ->orderBy("id","DESC");

        return view('order.ordersbookings_progress',[
            "bookings" => $bookings->paginate(CommonEnums::$PAGE_LENGTH),
            "search"=>$request->search ?: ""
        ]);
    }

    public function orderDetailsCustomer(Request $request)
    {

        $booking = Booking::with(['status_history'])->with(['status_hist'=>function($query){
            $query->limit(1)->orderBy("id","DESC");
        }])->with('movement_dates')->with('inventories')->with('driver')->with('organization')->with('user')->with("virtual_assistant")->with(["bid"=>function($query){
            $query->where("status",BidEnums::$STATUS['won']);
        }])->with('service')->findOrFail($request->id);

        $hist = [];

        foreach ($booking->status_history as $status){
            if(!in_array($status->status, $hist))
                $hist[] = $status->status;
        }

        $booking->status_ids = $hist;

        return view('order.orderdetails_customer',[
            "booking" => $booking,
            "virtual_assistants"=>Admin::where("role",AdminEnums::$ROLES["virtual_assistant"])->get()
        ]);
    }

    public function orderDetailsPayment(Request $request)
    {
        $booking = Booking::with('status_history')->findOrFail($request->id);

        $hist = [];

        foreach ($booking->status_history as $status){
            if(!in_array($status->status, $hist))
                $hist[] = $status->status;
        }

        $booking->status_ids = $hist;
        return view('order.orderdetails_payment',[
            "booking" => $booking
        ]);
    }

    public function orderDetailsVendor(Request $request)
    {
        $booking = Booking::with(['status_history'])->with(['status_hist'=>function($query){
            $query->limit(1)->orderBy("id","DESC");
        }])->with('inventories')->with('driver')->with('vehicle')->with('organization')->with(['payment'=>function($q){
            $q->with('coupon');
        }])->findOrFail($request->id);

        $hist = [];

        foreach ($booking->status_history as $status){
            if(!in_array($status->status, $hist))
                $hist[] = $status->status;
        }

        $booking->status_ids = $hist;
        return view('order.orderdetails_vendor',[
            "booking" => $booking
        ]);
    }

    public function orderDetailsAction(Request $request)
    {
        $booking = Booking::where("id", $request->id)->with(['status_history'])->with(['status_hist'=>function($query){
            $query->limit(1)->orderBy("id","DESC");
        }])->with('inventories')->first();

        $hist = [];

        foreach ($booking->status_history as $status){
            if(!in_array($status->status, $hist))
                $hist[] = $status->status;
        }

        $booking->status_ids = $hist;
        return view('order.orderdetails_action',[
            "booking" => $booking
        ]);
    }

    public function orderDetailsCancel(Request $request)
    {
        $booking = Booking::where("id", $request->id)->with(['status_history'])->with(['status_hist'=>function($query){
            $query->limit(1)->orderBy("id","DESC");
        }])->with('inventories')->with('payment')->first();

        $hist = [];

        foreach ($booking->status_history as $status){
            if(!in_array($status->status, $hist))
                $hist[] = $status->status;
        }

        $booking->status_ids = $hist;
        return view('order.orderdetails_cancel',[
            "booking" => $booking,
            "cancellation_reasons"=>json_decode(Settings::where("key","cancellation_reason_options")->pluck('value')[0], true)
        ]);
    }

    public function orderDetailsQuotation(Request $request)
    {
        $booking = Booking::with(['status_history'])->with(['status_hist'=>function($query){
            $query->limit(1)->orderBy("id","DESC");
        }])->with('inventories')->with('driver')
            ->with('vehicle')->with('organization')
            ->with(['payment'=>function($q){
                $q->with('coupon');
            }])->findOrFail($request->id);

        $hist = [];

        foreach ($booking->status_history as $status){
            if(!in_array($status->status, $hist))
                $hist[] = $status->status;
        }

        $booking->status_ids = $hist;

        return view('order.orderdetails_quotation',[
            "booking" => $booking
        ]);
    }

    public function orderDetailsBidding(Request $request)
    {
       $booking = Booking::with('status_history')->with(['biddings'=>function($bid){
            $bid->orderBy('updated_at')->orderBy('status')->with(['organization'=>function($query){
                $query->with('vehicle')->with('admin');
            }])->with('vendor');
        }])->with(['payment'=>function($q){
           $q->with('coupon');
       }])
           ->findOrFail($request->id);

        $hist = [];

        foreach ($booking->status_history as $status){
            if(!in_array($status->status, $hist))
                $hist[] = $status->status;
        }

        $booking->status_ids = $hist;

        $price_type = $booking->booking_type == BookingEnums::$BOOKING_TYPE["economic"] ? "bp_economic" : "bp_premium";

        $least_agent_price = BookingOrganizationGeneratedPrice::where('booking_id', $request->id)->where($price_type, ">", 0.00)
            ->min($price_type);

        return view('order.orderdetails_bidding',[
            "booking" => $booking,
            "least_agent_price"=> $least_agent_price
        ]);
    }

    public function orderBiddingReview(Request $request)
    {
        $booking = Booking::with(['status_history'])->with(['status_hist'=>function($query){
            $query->limit(1)->orderBy("id","DESC");
        }])->with('payment')->findOrFail($request->id);

        $hist = [];

        foreach ($booking->status_history as $status){
            if(!in_array($status->status, $hist))
                $hist[] = $status->status;
        }

        $booking->status_ids = $hist;
        return view('order.orderbidding_review',[
            "booking" => $booking
        ]);
    }

    public function orderDetailsReview(Request $request)
    {
        $booking = Booking::with(['status_history'])->with(['status_hist'=>function($query){
            $query->limit(1)->orderBy("id","DESC");
        }])->with('inventories')->with('user')->with('driver')->with('vehicle')->with('organization')->with(['payment'=>function($q){
            $q->with('coupon');
        }])->with('review')->findOrFail($request->id);

        $hist = [];

        foreach ($booking->status_history as $status){
            if(!in_array($status->status, $hist))
                $hist[] = $status->status;
        }

        $booking->status_ids = $hist;
        return view('order.orderdetails_review',[
            "booking" => $booking
        ]);
    }

    /*end order details subpages*/

    public function createOrder()
    {
        $category = Service::where(['status' => CommonEnums::$YES, 'deleted' => CommonEnums::$NO])
            ->with(['subservices' => function ($query) {
                $query->where(['subservices.status' => CommonEnums::$YES, 'subservices.deleted' => CommonEnums::$NO]);
            }])->get();

        $inventory = Inventory::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        return view('order.createorder', ['categories'=>$category, 'inventories'=>$inventory]);
    }

    public function confirmOrder(Request $request)
    {
        $booking =Booking::where('id', $request->id)->first();
        return view('order.confirmorder', ['booking'=>$booking]);
    }

    public function rejectOrder(Request $request)
    {
        $booking =Booking::where('id', $request->id)->first();
        $reason=Settings::where('key', "cancellation_reason_options")->pluck('value')[0];
        return view('order.reject', ['booking'=>$booking, 'reasons'=>$reason]);
    }

    public function customers(Request $request)
    {
        $user=User::where("deleted", CommonEnums::$NO)->with("zone");



        if($request->search){
            $user->where('fname', 'like', "%".$request->search."%")
                ->orWhere('lname', 'like', "%".$request->search."%")
                ->orWhere('phone', 'like', $request->search."%");
        }

        if(isset($request->status)){
           $user->where('status', $request->status);
        }
        if(isset($request->from) && isset($request->to)){
            $user->where('created_at', '>=', $request->from)->where('created_at', '<=', $request->to);
        }

        if($request->zone){
            $user->where('zone_id', $request->zone);
        }

        if($request->city){
            $user->where('city', 'like', "%".$request->city."%");
        }

        if($request->sort)
            $user->where('status', UserEnums::$STATUS[$request->sort]);
        else
           $user->where("status","!=", UserEnums::$STATUS['verification_pending']);


        $user->orderBy("id","DESC");
        $total_user =User::where("deleted", CommonEnums::$NO)->count();
        $active_user =User::where(["deleted"=>CommonEnums::$NO, "status"=>UserEnums::$STATUS['active']])->count();
        $inactive_user =User::where(["deleted"=>CommonEnums::$NO, "status"=>UserEnums::$STATUS['suspended']])->count();
        $pending_user =User::where(["deleted"=>CommonEnums::$NO, "status"=>UserEnums::$STATUS['verification_pending']])->count();
        return view('customer.customer',[
            "users"=>$user->paginate(15),
            "total_user"=>$total_user, "active_user"=>$active_user, "inactive_user"=>$inactive_user, "pending_user"=>$pending_user
        ]);
    }

    public function createCustomers(Request $request)
    {
        $user =User::where("id", $request->id)->first();
        return view('customer.createcustomer', ["users"=>$user]);
    }

    public function customerRewardPoints(Request $request)
    {
        $user = User::where("id", $request->id)->with("wallet")->first();
        $user->wallet->transactions = Transaction::where("wallet_id",$user->wallet->id)->orderBy("id","DESC")->paginate(CommonEnums::$PAGE_LENGTH);

        return view('customer.customerwallet', [
            "users"=>$user,
            "vouchers"=>Voucher::where(['status'=>VoucherEnums::$STATUS['active'], "deleted"=>CommonEnums::$NO])->get()
            ]);
    }

    public function customerVouchers(Request $request)
    {
        $user = User::where("id", $request->id)->with(["vouchers"=>function($query){
                $query->with("meta");
            }])->first();
//        return $user->vouchers[0];
        return view('customer.customervouchers', [
            "users"=>$user
            ]);
    }

    public function sidebar_customer(Request $request)
    {
        $user =User::where("id", $request->id)->with(['bookings'=>function($query){
            $query->with(['payment'=>function($coupon){
                $coupon->with('coupon');
            }]);
        }])->first();
        $count_orders=Booking::where("user_id", $request->id)->count();
        $status_orders=Booking::where("user_id", $request->id)->orderBy("id","DESC")->limit(1)->pluck('status');
        return view('sidebar.customer', ["users"=>$user, "count_orders"=>$count_orders, "status_orders"=>$status_orders]);
    }

    public function vendors(Request $request)
    {
        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');

        $id_org_zone = OrganizationZone :: whereIn("zone_id", $zone)->groupBy("organization_id")->pluck('organization_id');

        $vendors = Organization::where(["deleted"=>CommonEnums::$NO, "parent_org_id"=>null])->whereIn("id", $id_org_zone);

        if(isset($request->search)){
            $vendors->where('org_name', 'like', "%".$request->search."%");
        }

        if(isset($request->status)){
            $vendors->where('status', $request->status);
        }

        if(isset($request->cities)){
            $vendor_ids= OrganizationCity :: where("city_id", $request->cities)->groupBy("organization_id")->pluck('organization_id');
            $vendors->whereIn('id', $vendor_ids);
        }
        if(isset($request->service)){
            $vendors->where('service_type', $request->service);
        }

        if(isset($request->from) && isset($request->to)){
             $vendors->where('created_at', '>=', $request->from)->where('created_at', '<=', $request->to);
        }

//        return OrganizationEnums::$STATUS[$request->sort];

        if($request->sort)
            $vendors->where('status', OrganizationEnums::$STATUS[$request->sort]);


        $vendors->with('admin');

        $count_vendors = Organization::where(["deleted"=>CommonEnums::$NO, "parent_org_id"=>null])->whereIn("id", $id_org_zone)->count();

        $count_verified_vendors = Organization::where(["deleted"=>CommonEnums::$NO, "status"=>OrganizationEnums::$STATUS['pending_approval'], "parent_org_id"=>null])->whereIn("id", $id_org_zone)->count();

        $count_active_vendors = Organization::where(["status"=>OrganizationEnums::$STATUS['active'], "deleted"=>CommonEnums::$NO, "parent_org_id"=>null])->whereIn("id", $id_org_zone)->count();

        $count_lead_vendors = Organization::where(["status"=>OrganizationEnums::$STATUS['lead'], "deleted"=>CommonEnums::$NO, "parent_org_id"=>null])->whereIn("id", $id_org_zone)->count();

        $count_suspended_vendors = Organization::where(["status"=>OrganizationEnums::$STATUS['suspended'], "deleted"=>CommonEnums::$NO, "parent_org_id"=>null])->whereIn("id", $id_org_zone)->count();

//        return $vendors->paginate(CommonEnums::$PAGE_LENGTH);
        return view('vendor.vendor',[
            'vendors'=>$vendors->paginate(CommonEnums::$PAGE_LENGTH),
            'vendors_count'=>$count_vendors,
            'verifide_vendors'=>$count_verified_vendors,
            'active_vendors'=>$count_active_vendors,
            'lead_vendors'=>$count_lead_vendors,
            'suspended_vendors'=>$count_suspended_vendors
        ]);
    }

    public function sidebar_vendors(Request $request)
    {
        $vendor = Organization::where("id", $request->id)->with('admin')->with('services')->with('zone')->with('cities')->first();
        $branch = Organization::where("parent_org_id", $request->id)->count();
        $payouts = Payout::where("organization_id", $request->id)->get();

        $dataset = [];
        $this_week = CarbonPeriod::create( Carbon::now()->subDays(7)->format("Y-m-d"),Carbon::now()->format("Y-m-d"))->toArray();
        $last_week = CarbonPeriod::create( Carbon::now()->subDays(14)->format("Y-m-d"), Carbon::now()->subDays(7)->format("Y-m-d"))->toArray();

        $this_week_sale = [];
        $last_week_sale = [];
        foreach ($this_week as $key=>$date){
            $date1 = $date->format('Y-m-d');
            $this_week[$key] = $date->format('d M');
            $this_week_sale[] = Booking::whereDate("created_at",$date1)->where('organization_id', $request->id)
                ->whereDate("status",">=",BookingEnums::$STATUS['pending_driver_assign'])
                ->sum("final_quote");
        }
        foreach ($last_week as $key=>$date){
            $date1 = $date->format('Y-m-d');
//            $last_week[$key] = $date->format('d M');
            $last_week_sale[] = Booking::whereDate("created_at",$date1)->where('organization_id', $request->id)
                ->whereDate("status",">=",BookingEnums::$STATUS['pending_driver_assign'])
                ->sum("final_quote");
        }
        $inventory=InventoryPrice::where(['organization_id'=>$request->id])->with('inventory')->with('service')->get();

        return view('sidebar.vendors', ['organization'=>$vendor, 'branch'=>$branch, 'payouts'=>$payouts, 'inventories'=>$inventory, "service_types"=>$inventory,
            'graph'=>[
                "revenue"=>[
                    "this_week"=>[
                        "dates"=>$this_week,
                        "sales"=>$this_week_sale
                    ],
                    "last_week"=>[
                        "dates"=>$this_week,
                        "sales"=>$last_week_sale
                    ],
                ]]]);
    }

    public function vendorsDetails(Request $request)
    {
        $vendor = Organization::where("id", $request->id)->with('admin')->with('services')->with('zone')->with('cities')
            ->with(['vendors'=>function($query){
                $query->where('user_role', VendorEnums::$ROLES['driver']);
            }])->first();
        $branch = Organization::where("parent_org_id", $request->id)->count();
        $payouts = Payout::where("organization_id", $request->id)->get();

        $dataset = [];
        $this_week = CarbonPeriod::create( Carbon::now()->subDays(7)->format("Y-m-d"),Carbon::now()->format("Y-m-d"))->toArray();
        $last_week = CarbonPeriod::create( Carbon::now()->subDays(14)->format("Y-m-d"), Carbon::now()->subDays(7)->format("Y-m-d"))->toArray();

        $this_week_sale = [];
        $last_week_sale = [];
        foreach ($this_week as $key=>$date){
            $date1 = $date->format('Y-m-d');
            $this_week[$key] = $date->format('d M');
            $this_week_sale[] = Booking::whereDate("created_at",$date1)->where('organization_id', $request->id)
                ->whereDate("status",">=",BookingEnums::$STATUS['pending_driver_assign'])
                ->sum("final_quote");
        }
        foreach ($last_week as $key=>$date){
            $date1 = $date->format('Y-m-d');
//            $last_week[$key] = $date->format('d M');
            $last_week_sale[] = Booking::whereDate("created_at",$date1)->where('organization_id', $request->id)
                ->whereDate("status",">=",BookingEnums::$STATUS['pending_driver_assign'])
                ->sum("final_quote");
        }

        return view('vendor.vendordetails', ['organization'=>$vendor, 'branch'=>$branch, 'payouts'=>$payouts,
            'graph'=>[
                "revenue"=>[
                    "this_week"=>[
                        "dates"=>$this_week,
                        "sales"=>$this_week_sale
                    ],
                    "last_week"=>[
                        "dates"=>$this_week,
                        "sales"=>$last_week_sale
                    ],
                ]
            ] ]);
    }

    public function createOnboardVendors()
    {
        $services = Service::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        $subservices = Subservice::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        return view('vendor.createvendor', ['services'=>$services, 'subservices'=>$subservices, 'cities'=>City::get()]);
    }

    public function onbaordEdit(Request  $request)
    {
        $organization = Organization::where(["id"=>$request->id, "deleted"=>CommonEnums::$NO])->with('admin')->with('services')->with("cities")->first();
        $services = Service::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        return view('vendor.editonboard', ['id'=>$request->id, 'services'=>$services, 'organization'=>$organization]);
    }

    public function onbaordBasePrice(Request $request){
        $subservices = Subservice::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->whereNotIn("name", ["custom"])
             ->get();

        $vendor_price = SubservicePrice::where("organization_id", $request->id)->with('subservice')->get();

        $add_subservices = Subservice::whereNotIn("id", SubservicePrice::where("organization_id", $request->id)->pluck('subservice_id'))->whereNotIn("name", ["custom"])->where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();

        return view('vendor.onboardbaseprice', ['id'=>$request->id, 'subservices'=>$subservices, "prices"=>$vendor_price, "add_subservices"=>$add_subservices]);
    }

    public function onbaordExtraBasePrice(Request $request){
        $subservices = Subservice::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->whereNotIn("name", ["custom"])
            ->get();

        $vendor_price = SubservicePrice::where("organization_id", $request->id)->with('subservice')->get();

        $add_subservices = Subservice::whereNotIn("id", SubservicePrice::where("organization_id", $request->id)->pluck('subservice_id'))->whereNotIn("name", ["custom"])->where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();

        return view('vendor.onboardbaseprice', ['id'=>$request->id, 'subservices'=>$subservices, "prices"=>$vendor_price, "add_subservices"=>$add_subservices]);

    }

    public function onbaordBranch(Request $request)
    {
        $branch = Organization::where(["parent_org_id"=>$request->id, "deleted"=>CommonEnums::$NO])->with('cities')->with('services')->get();
        $organization = Organization::where(["id"=>$request->id, "deleted"=>CommonEnums::$NO])->first();
        $services = Service::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        return view('vendor.onboardbranch', ['id'=>$request->id, 'services'=>$services, 'branches'=>$branch, 'organization'=>$organization]);
    }

    public function onbaordUserRole(Request $request)
    {
        $roles =Organization::where(["parent_org_id"=>$request->id, "status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->orWhere("id", $request->id)->pluck("id");
        $users = Vendor::whereIn("organization_id", $roles)->where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        $branch = Organization::where(["parent_org_id"=>$request->id, "status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->orWhere("id", $request->id)->get();
        return view('vendor.onboarduserrole',['id'=>$request->id, 'roles'=>$users, 'branches'=>$branch]);
    }

    public function onbaordBank(Request $request)
    {
        $bank=Org_kyc::where("organization_id", $request->id)->first();
        return view('vendor.onboardbank', ['bank'=>$bank, 'id'=>$request->id]);
    }

    public function onbaordAction(Request $request){
        $organization = Organization::where(["id"=>$request->id, "deleted"=>CommonEnums::$NO])->first();
        return view('vendor.action', ['id'=>$request->id, 'organization'=>$organization]);
    }

    public function leadVendors()
    {
        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');
        $id_org_zone = OrganizationZone :: whereIn("zone_id", $zone)->groupBy("organization_id")->pluck('organization_id');

        $leads = Organization::where(["status"=>OrganizationEnums::$STATUS["lead"], "deleted"=>CommonEnums::$NO, "parent_org_id"=>null])->whereIn("id", $id_org_zone);
            if(isset($request->search)){
                $leads=$leads->where('org_name', 'like', "%".$request->search."%");
            }

        $leads->with('admin')->with('zone_map');

        return view('vendor.lead',['vendors'=>$leads->paginate(CommonEnums::$PAGE_LENGTH)]);
    }

    public function pendingVendors()
    {
        return view('vendor.pending');
    }

    public function verifiedVendors()
    {
        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');
        $id_org_zone = OrganizationZone :: whereIn("zone_id", $zone)->groupBy("organization_id")->pluck('organization_id');

        $vendors = Organization::where(["verification_status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO, "parent_org_id"=>null])->whereIn("id", $id_org_zone);
            if(isset($request->search)){
                $vendors=$vendors->where('org_name', 'like', "%".$request->search."%");
            }

        $vendors->with('admin')->with('zone_map');

        return view('vendor.verified',['vendors'=>$vendors->paginate(CommonEnums::$PAGE_LENGTH)]);
    }

    public function categories(Request $request)
    {
        $category =Service::where(["deleted"=>CommonEnums::$NO]);
        if(isset($request->search)){
            $category=$category->where('name', 'like', "%".$request->search."%");
        }

        return view('categories.categories',[
            "categories"=>$category->paginate(CommonEnums::$PAGE_LENGTH),
            "inventory_quantity_type"=>ServiceEnums::$INVENTORY_QUANTITY_TYPE
        ]);
    }

    public function createCategories(Request $request)
    {
        $category = Service::where('id', $request->id)->first();
        return view('categories.createcategories', ['category'=>$category]);
    }

    public function subcateories(Request $request)
    {   $subcategories=Subservice::where(["deleted"=>CommonEnums::$NO])->where("name","!=","custom");
        if(isset($request->search)){
            $subcategories=$subcategories->where('name', 'like', "%".$request->search."%");
        }
        return view('categories.subcateories',[
            "subcategories"=>$subcategories->paginate(CommonEnums::$PAGE_LENGTH)
        ]);
    }

    public function createSubcateories(Request $request)
    {
        $sub_category = Subservice::where('id', $request->id)->with('services')->with(['inventorymap'=>function($query){
            $query->with('meta');
        }])->with(['extraitems'=>function($query){
            $query->with('meta');
        }])->first();
        $categories = Service::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        $inventory = Inventory::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();

        return view('categories.createsubcateories', ['categories'=>$categories, 'inventories'=>$inventory, 'subcategory'=>$sub_category]);
    }

    public function sidebar_subcategory(Request $request)
    {
        $subcategory=Subservice::where("id", $request->id)->with('services')->with('inventories')->first();
        return view('sidebar.subcategory', ['subcategory'=>$subcategory]);
    }

    public function inventories(Request $request)
    {
        $inventories=Inventory::where(["deleted"=>CommonEnums::$NO]);
        if(isset($request->search)){
            $inventories=$inventories->where('name', 'like', "%".$request->search."%");
        }
        return view('categories.inventories',[
            "inventories"=>$inventories->paginate(CommonEnums::$PAGE_LENGTH)
        ]);
    }

    public function createInventories(Request $request)
    {
        $inventory = Inventory::where('id', $request->id)->first();
        return view('categories.createinventories', ['inventory'=>$inventory]);
    }

    public function detailsInventories()
    {
        return view('categories.detailsinventories');
    }

    public function coupons(Request $request)
    {
        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');

       $coupons = Coupon::where("deleted", CommonEnums::$NO);

        if(Session::get('user_role') == AdminEnums::$ROLES['city_admin'])
            $coupons->whereIn('id', CouponZone::whereIn("zone_id", $zone)->pluck('coupon_id'))->where("zone_scope", CouponEnums::$ZONE_SCOPE['custom']);

        if(Session::get('user_role') == AdminEnums::$ROLES['admin'])
        {
                $coupons->whereIn("zone_scope", [CouponEnums::$ZONE_SCOPE['all'], CouponEnums::$ZONE_SCOPE['custom']]);
        }

        if(isset($request->city)){
            $cities_id = CouponCity::where('city_id', $request->city)->pluck('coupon_id');
            $coupons->whereIn('id', $cities_id);
        }

        if(isset($request->type)){
            $coupons->where('discount_type', $request->type);
        }

        if(isset($request->search)){
            $coupons=$coupons->where('name', 'like', "%".$request->search."%");
        }
        if(isset($request->status)){
            $coupons=$coupons->where('status', $request->status);
        }
        if(isset($request->from) && isset($request->to)){
            $coupons=$coupons->where('valid_from', '>=', $request->from)->where('valid_to', '<=', $request->to);
        }

        $coupons_active= Coupon::where(['status'=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO]);
        if(Session::get('user_role') == AdminEnums::$ROLES['city_admin'])
            $coupons_active->whereIn('id', CouponZone::whereIn("zone_id", $zone)->pluck('coupon_id'))->where("zone_scope", CouponEnums::$ZONE_SCOPE['custom']);

        if(Session::get('user_role') == AdminEnums::$ROLES['admin'])
        {
            $coupons_active->whereIn("zone_scope", [CouponEnums::$ZONE_SCOPE['all'], CouponEnums::$ZONE_SCOPE['custom']]);
        }


        $coupons_inactive= Coupon::where(['status'=>CommonEnums::$NO, "deleted"=>CommonEnums::$NO]);
        if(Session::get('user_role') == AdminEnums::$ROLES['city_admin'])
            $coupons_inactive->whereIn('id', CouponZone::whereIn("zone_id", $zone)->pluck('coupon_id'))->where("zone_scope", CouponEnums::$ZONE_SCOPE['custom']);

        if(Session::get('user_role') == AdminEnums::$ROLES['admin'])
        {
            $coupons_inactive->whereIn("zone_scope", [CouponEnums::$ZONE_SCOPE['all'], CouponEnums::$ZONE_SCOPE['custom']]);
        }


                $coupons->with('created_by')->orderBy('id','DESC');

        return view('coupons.coupons',["coupons"=>$coupons->paginate(CommonEnums::$PAGE_LENGTH), "coupons_active"=>$coupons_active->paginate(CommonEnums::$PAGE_LENGTH), "coupons_inactive"=>$coupons_inactive->paginate(CommonEnums::$PAGE_LENGTH)]);
    }

    public function sidebar_coupons(Request $request)
    {
        $coupons = Coupon::where(["id"=>$request->id])->with('zones')->with('payment')->first();
        return view('sidebar.coupons', ['coupons'=>$coupons]);
    }

    public function createCoupons(Request $request)
    {
        $coupons = Coupon::where(["id"=>$request->id])->with('zones')->with('cities')->with('organizations')->with('users')->first();
        return view('coupons.createcoupons', ['organizations'=>Organization::whereIn('zone_id', Session::get('admin_zones'))->orWhere(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get(), 'coupons'=>$coupons]);
    }

    public function detailsCoupons()
    {
        return view('coupons.detailscoupons');
    }

    public function vouchers(Request $request)
    {
      /*  if(Session::get('active_zone'))
            $zone = [Session::get('active_zone')];
        else
            $zone = Session::get('admin_zones');*/

        $vouchers = Voucher::where("deleted", CommonEnums::$NO);

        if($request->search){
          $vouchers->where('name', 'like', "%".$request->search."%");
        }

        $vouchers_active= Voucher::where(['status'=>VoucherEnums::$STATUS['active'], "deleted"=>CommonEnums::$NO]);

        $vouchers_inactive= Voucher::where(['status'=>VoucherEnums::$STATUS['inactive'], "deleted"=>CommonEnums::$NO]);


        return view('vouchers.vouchers',["vouchers"=>$vouchers->paginate(CommonEnums::$PAGE_LENGTH), "vouchers_active"=>$vouchers_active->paginate(CommonEnums::$PAGE_LENGTH), "vouchers_inactive"=>$vouchers_inactive->paginate(CommonEnums::$PAGE_LENGTH)]);
    }

    public function createVoucher(Request $request)
    {
        $vouchers = Voucher::where(["id"=>$request->id])->with('codes')->first();
        return view('vouchers.createvouchers', ['vouchers'=>$vouchers]);
    }

    public function zones(Request $request)
    {
        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');

        $zones =Zone::where(["deleted"=>CommonEnums::$NO]);

        if(Session::get('user_role') != AdminEnums::$ROLES['admin'])
            $zones->whereIn('id', $zone);

        if(isset($request->search)){
            $zones=$zones->where('name', 'like', "%".$request->search."%");
        }

        if(isset($request->city)){
            $zones=$zones->where('city_id', $request->city);
        }

        if(isset($request->status)){
            $zones=$zones->where('status', $request->status);
        }

            $total=Zone::where(["deleted"=>CommonEnums::$NO])->count();
            $active=Zone::where(["deleted"=>CommonEnums::$NO])->where(["status"=>CommonEnums::$YES])->count();
            $inactive=Zone::where(["deleted"=>CommonEnums::$NO])->where(["status"=>CommonEnums::$NO])->count();
        return view('zones.zones',[
            "zones"=>$zones->with('city')->paginate(CommonEnums::$PAGE_LENGTH),
            'total'=>$total,
            'active'=>$active,
            'inactive'=>$inactive
        ]);
    }

    public function createZones(Request $request)
    {

        $all_zones = Zone::with("coordinates")->get();
        $zone = Zone::where('id',$request->id)->first();
        $cities = City::where(["deleted"=>CommonEnums::$NO, "status"=>CommonEnums::$YES])->get();


        return view('zones.createzones', ['zones'=>$zone, 'cities'=>$cities]);
    }

    public function zoneReferralSystem(Request $request)
    {

        $zone = Zone::where('id',$request->id)->first();
        /*return [
            'zones'=>$zone,
            "vouchers"=>Voucher::where("status",VoucherEnums::$STATUS['active'])->get(),
            "referrer"=>ZoneReferralReward::where("referral_role",ReferralEnums::$ROLE['referrer'])->where("zone_id",$zone->id)->first(),
            "referee"=>ZoneReferralReward::where("referral_role",ReferralEnums::$ROLE['referee'])->where("zone_id",$zone->id)->first()
        ];*/
        return view('zones.referralsystem', [
            'zones'=>$zone,
            "vouchers"=>Voucher::where("status",VoucherEnums::$STATUS['active'])->get(),
            "referrer"=>ZoneReferralReward::where("referral_role",ReferralEnums::$ROLE['referrer'])->where("zone_id",$zone->id)->first(),
            "referee"=>ZoneReferralReward::where("referral_role",ReferralEnums::$ROLE['referee'])->where("zone_id",$zone->id)->first()
            ]);
    }

    public function slider(Request $request)
    {
        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');

        $slider=Slider::where(["deleted"=>CommonEnums::$NO]);

        if(Session::get('user_role') == AdminEnums::$ROLES['city_admin'])
            $slider->whereIn('id', SliderZone::whereIn("zone_id", $zone)->pluck('slider_id'));

        if(Session::get('user_role') == AdminEnums::$ROLES['admin'])
            $slider->where("zone_scope", SliderEnum::$ZONE['all'])->orWhere("zone_scope", SliderEnum::$ZONE['custom']);

        if(isset($request->search)){
            $slider=$slider->where('name', 'like', "%".$request->search."%");
        }

        $slider->with('banners');
        return view('sliderandbanner.slider',[
            "sliders"=>$slider->paginate(CommonEnums::$PAGE_LENGTH)
        ]);
    }

    public function sidebar_slider(Request $request)
    {
        $slider = Slider::where(["id"=>$request->id])->with('banners')->with('zones')->first();
        return view('sidebar.slider', ['sliders'=>$slider]);
    }

    public function createSlider()
    {
        return view('sliderandbanner.createslider');
    }

    public function editSlider(Request $request)
    {
        return view('sliderandbanner.createslider', ['id'=>$request->id,
        'slider'=>Slider::with('zones')->findOrFail($request->id)]
        );
    }

    public function manageBanner(Request $request)
    {
        // return Slider::with('zones')->findOrFail($request->id);
        return view('sliderandbanner.createbanner', [
         'id'=>$request->id,
         'banners'=>Banners::where("slider_id",$request->id)->get(),
         'slider'=>Slider::findOrFail($request->id)
        ]);
    }

    public function pushNotification()
    {
        $notification =Notification::where(['status'=>CommonEnums::$YES, 'deleted'=>CommonEnums::$NO, 'generated_by'=>NotificationEnums::$GENERATE_BY['admin']])->with('user')->with('admin')->with('vendor')->paginate(CommonEnums::$PAGE_LENGTH);
        return view('sliderandbanner.pushnotification', ['notifications'=>$notification]);
    }

    public function createPushNotification()
    {
        return view('sliderandbanner.createpush');
    }

    public function mailNotification()
    {
        return view('sliderandbanner.mailnotification');
    }

    public function createMailNotification()
    {
        return view('sliderandbanner.createmail');
    }

    public function testimonials()
    {
        $testimonials=Testimonials::where(["deleted"=>CommonEnums::$NO, "status"=>CommonEnums::$YES])->orderBy("id","DESC")->paginate(CommonEnums::$PAGE_LENGTH);
        return view('sliderandbanner.testimonials', ['testimonials'=>$testimonials]);
    }

    public function createTestimonials(Request $request)
    {
        $testimonials=Testimonials::where("id", $request->id)->first();
        return view('sliderandbanner.createtestimonials', ['testimonials'=>$testimonials]);
    }

    public function review(Request $request)
    {
        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');

        $review=Review::whereIn('user_id', Booking::whereIn("zone_id", $zone)->pluck('user_id'))->where("deleted", CommonEnums::$NO);

        if(isset($request->search)){
            $review->where('desc', 'like', "%".$request->search."%");
        }

        if($request->ratings){
            $review->where('star', $request->ratings);
        }

        if($request->id) {
            $review->whereIn('booking_id', Booking::where("organization_id", $request->id)->pluck("id"));
        }

        $review->with(['booking'=>function($query){
            $query->with('organization');
        }])->with('user')->orderBy("id","DESC");
//        return $review->paginate(CommonEnums::$PAGE_LENGTH);
        $total_review=Review::whereIn('user_id', Booking::whereIn("zone_id", $zone)->pluck('user_id'))->where("deleted", CommonEnums::$NO)->count();
        $active_review=Review::whereIn('user_id', Booking::whereIn("zone_id", $zone)->pluck('user_id'))->where(["deleted"=>CommonEnums::$NO, "status"=>CommonEnums::$YES])->count();
        $inactive_review=Review::whereIn('user_id', Booking::whereIn("zone_id", $zone)->pluck('user_id'))->where(["deleted"=>CommonEnums::$NO, "status"=>CommonEnums::$NO])->count();

//        return $review->paginate(CommonEnums::$PAGE_LENGTH);
        return view('reviewandratings.review', ['reviews'=>$review->paginate(CommonEnums::$PAGE_LENGTH), 'total_review'=>$total_review, 'active_review'=>$active_review, 'inactive_review'=>$inactive_review]);
    }

    public function createReview(Request $request)
    {
        return view('reviewandratings.createreview');
    }

    public function complaints(Request $request)
    {
        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');

        $complaints=Ticket::where("type", TicketEnums::$TYPE['complaint']);

        if(isset($request->search)){
             $complaints=$complaints->where('heading', 'like', "%".$request->search."%");
        }
        $complaints->with('user')->with('vendor')->with('booking')->orderBy("id","DESC");

        $resolved_complaints=Ticket::where(["type"=>TicketEnums::$TYPE['complaint'], "status"=>TicketEnums::$STATUS['resolved']])->count();
        $open_complaints=Ticket::where(["type"=>TicketEnums::$TYPE['complaint'], "status"=>TicketEnums::$STATUS['open']])->count();
        $total_complaints= Ticket::where(["type"=>TicketEnums::$TYPE['complaint']])->count();
        return view('reviewandratings.complaints', ['complaints'=>$complaints->paginate(CommonEnums::$PAGE_LENGTH), 'resolved_complaints'=>$resolved_complaints, 'open_complaints'=>$open_complaints, 'total_complaints'=>$total_complaints]);
    }

    public function reply(Request $request)
    {
        $service_status=[];
        $ticket_info=[];
        $ticket=Ticket::where('id', $request->id)
            ->with(["booking"=>function($query){
                $query->with('user')->with('vendor');
            }])
            ->with('reply')->with('user')->with('vendor')->first();
        $replies=TicketReply::where('ticket_id', $request->id)->with('admin')->with('user')->with('vendor')->get();

        if($ticket->type == TicketEnums::$TYPE['order_cancellation'] || $ticket->type == TicketEnums::$TYPE['order_reschedule'])
        {
            $ticket_info=Booking::where('public_booking_id', json_decode($ticket->meta, true)['public_booking_id'])->with('organization')->with('driver')->first();
        }
        elseif ($ticket->type == TicketEnums::$TYPE['new_branch'])
        {
            $ticket_info=Organization::where('id', json_decode($ticket->meta, true)['Branch_id'])->first();
            $service_status=$ticket_info->ticket_status;
        }
        elseif ($ticket->type == TicketEnums::$TYPE['price_update'])
        {
            $ticket_info=InventoryPrice::where(['organization_id'=>json_decode($ticket->meta, true)['parent_org_id'], 'inventory_id'=>json_decode($ticket->meta, true)['inventory_id']])->with('inventory')->with('organization')->first();
            $service_status=$ticket_info->ticket_status;
        }
        elseif ($ticket->type == TicketEnums::$TYPE['call_back'])
        {
            if(json_decode($ticket->meta, true)['public_booking_id']) {
                $ticket_info = Booking::where(['public_booking_id' => json_decode($ticket->meta, true)['public_booking_id']])->with('user')->with('organization')->first();
                $service_status = [];
            }

        }
        elseif ($ticket->type == TicketEnums::$TYPE['complaint'])
        {
            if(json_decode($ticket->meta, true)['public_booking_id']) {
                $ticket_info = Booking::where(['public_booking_id' => json_decode($ticket->meta, true)['public_booking_id']])->with('user')->with('organization')->first();
                $service_status = [];
            }
            else{
                $ticket_info['user'] = User::where(['id' => $ticket->user_id])->first();
            }
        }
        elseif ($ticket->type == TicketEnums::$TYPE['service_request'])
        {
            $ticket_info = Organization::where(['id' => $ticket->vendor_id])->first();
        }
        return view('reviewandratings.replies', ['tickets'=>$ticket, 'replies'=>$replies, 'service'=>$service_status, 'ticket_info'=>$ticket_info]);
    }

    public function serviceRequests(Request $request)
    {
        $service=Ticket::whereNotIn("type", [TicketEnums::$TYPE['complaint']]);
        if(isset($request->search)){
            $service=$service->where('heading', 'like', "%".$request->search."%");
        }
            $service->with('user')->with('vendor')->orderBy("id","DESC");
        return view('reviewandratings.servicerequests', ['services'=>$service->paginate(CommonEnums::$PAGE_LENGTH)]);
    }

    public function createService()
    {
        return view('reviewandratings.createservice');
    }

    public function vendorPayout(Request $request)
    {
        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');
        $id_org_zone = OrganizationZone :: whereIn("zone_id", $zone)->groupBy("organization_id")->pluck('organization_id');

        $payout =Payout::whereIn('organization_id', Organization::whereIn("id", $id_org_zone)->pluck('id'));
        if(isset($request->search)){
            $payout=$payout->where('public_payout_id', 'like', "%".$request->search."%");
        }

        if(isset($request->id)){
            $payout=$payout->where('organization_id', $request->id);
        }

        if(isset($request->status)){
            $payout=$payout->where('status', $request->status);
        }

        if(isset($request->from) && isset($request->to)){
            $payout=$payout->where('dispatch_at', '>=', $request->from)->where('dispatch_at', '<=', $request->to);
        }
        $payout->with('organization')->orderBy("id","DESC");

        $scheduled = Payout::where('status', PayoutEnums::$STATUS['scheduled'])->count();
        $failed = Payout::where('status', PayoutEnums::$STATUS['suspended'])->count();

        return view('vendorpayout.payout', ['payouts'=>$payout->paginate(CommonEnums::$PAGE_LENGTH), 'failed'=>$failed, 'scheduled'=>$scheduled]);
    }

    public function sidebar_payout(Request $request)
    {
        $payout=Payout::where("id", $request->id)->with(['organization'=>function($query){
            $query->with('booking');
        }])->first();
        return view('sidebar.payout', ['payout'=>$payout]);
    }

    public function createVendorPayout(Request $request)
    {
        $id_org_zone = OrganizationZone :: whereIn("zone_id", Session::get('admin_cities'))->groupBy("organization_id")->pluck('organization_id');

        $organizations =Organization::whereIn('id', $id_org_zone)->orWhere(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        $payout =Payout::where('id', $request->id)->first();
        return view('vendorpayout.createpayout', ['payout'=>$payout, 'organizations'=>$organizations]);
    }

    public function detailsVendorPayout()
    {
        return view('vendorpayout.detailspayout');
    }

    public function users(Request $request)
    {
        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');

        $users=Admin::whereIn('id', AdminZone::whereIn("zone_id", $zone)->pluck('admin_id'))->where(["deleted"=>CommonEnums::$NO, "status"=>CommonEnums::$YES]);
        if(isset($request->search)){
            $users=$users->where('fname', 'like', "%".$request->search."%");
        }
        $users->with('zones')->with('cities')->orderBy("id","DESC");
        return view('users.users', ['users'=>$users->paginate(CommonEnums::$PAGE_LENGTH)]);
    }

    public function sidebar_user(Request $request)
    {
        $user=Admin::where("id", $request->id)->with('zones')->first();
        return view('sidebar.users', ['users'=>$user]);
    }

    public function details_user(Request $request)
    {
        $user=Admin::where("id", $request->id)->with('zones')->with('cities')->first();
        return view('users.detailsusers', ['users'=>$user]);
    }

    public function createUsers(Request $request)
    {
        $user=Admin::where("id", $request->id)->with('zones')->first();

        return view('users.createusers', ['users'=>$user]);
    }

    public function createBank(Request $request)
    {
        $user=Admin::where("id", $request->id)->with('zones')->first();
        return view('users.userbank', ['users'=>$user]);
    }

    public function detailsUsers()
    {
        return view('users.detailseusers');
    }

    public function sidebar_booking(Request $request){

        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');

        return view('sidebar.orderbooking',[
            "booking"=>Booking::where('id',$request->id)
                ->whereIn("zone_id",$zone)
                ->with('organization')
                ->with('payment')
                ->with('status_history')
                ->with('inventories')
                ->with('user')
                ->with('vehicle')
                ->with('driver')
                ->first()
        ]);
    }

    public function switchToZone(Request $request){

        if(isset($request->zone)) {
         if(in_array($request->zone, Session::get('admin_cities')))
            Session::put('active_city', $request->zone);
        }
        else{
            if(Session::get('active_city'))
                Session::forget('active_city');
        }

        Session::flash('redirect','City has been toggled');
        return back();

    }

   /* public function sidebar_dashboard(Request $request)
    {
        $booking=Booking::where('id', $request->id)->with('organization')->with('driver')->with('inventories')->with('payment')->first();
        return view('sidebar.dashboard',['booking'=>$booking]);
    }*/

    public function sidebar_branch(Request $request)
    {
        $branch=Organization::where('id', $request->id)->with('zone')->with('services')->first();
        return view('sidebar.branch',['branch'=>$branch]);
    }

    public function sidebar_inventory(Request $request)
    {
        $inventory=InventoryPrice::where(['inventory_id'=>$request->id, 'organization_id'=>$request->org_id, 'service_type'=>$request->cat_id])->with('inventory')->get();
        $service_types=InventoryPrice::select('service_type')->where(['inventory_id'=>$request->id, 'deleted'=>CommonEnums::$NO])->where('organization_id', $request->org_id)->groupBy('service_type')->with('service')->get();

        return view('sidebar.inventory',['inventories'=>$inventory, "service_types"=>$service_types]);
    }

    public static function sidebar_reviews(Request $request)
    {
        $reviews=Review::where('id', $request->id)->with('Booking')->with('user')->first();
        return view('sidebar.reviews',['reviews'=>$reviews]);
    }

    public static function reports_summary(Request $request)
    {
        return view('reports.report_summary',[
            "report"=>Report::orderBy('id', 'DESC')->first()
        ]);
    }

    public static function sales_report(Request $request)
    {

        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');

        $bookings = Booking::whereIn("zone_id",$zone);
        if(isset($request->from) && isset($request->to))
            $bookings->whereIn("status", [BookingEnums::$STATUS['pending_driver_assign'], BookingEnums::$STATUS['in_transit'], BookingEnums::$STATUS['completed']])
                ->whereDate("created_at",">=", (string) date("Y-m-d", strtotime($request->from)))
                ->whereDate("created_at","<=", (string) date("Y-m-d", strtotime($request->to)));

        //return date("Y-m-d", strtotime($request->from));
        if(isset($request->org) && $request->org != "all")
        $bookings->where("organization_id",$request->org);

        if(isset($request->zone) && $request->zone != "all")
            $bookings->where("zone_id",$request->zone);

        if(isset($request->service) && $request->service != "all")
           $bookings->where("service_id",$request->service);

        $this_week_sale = [];
        $this_week=[];

        $this_week_sale1 = [];
        $this_week1=[];

        if(isset($request->from) && isset($request->to))
        {
            $this_week = CarbonPeriod::create( Carbon::parse($request->from)->format("Y-m-d"),Carbon::parse($request->to)->format("Y-m-d"))->toArray();

            foreach ($this_week as $key=>$date){
                $this_week[$key] = $date->format('d M');
                $this_week_sale[] = Payment::where("status", PaymentEnums::$STATUS['completed'])
                    ->whereDate("created_at", (string) date("Y-m-d", strtotime($date)))->sum('grand_total');
            }

            foreach ($this_week_sale as $k=>$sale){
                if($sale != 0){
                    array_push($this_week_sale1, $this_week_sale[$k]);
                    array_push($this_week1, $this_week[$k]);
                }
            }
        }

        if(isset($request->from))
            extract($request->all());

        return view('reports.sales',[
            "booking"=>$bookings->get(),  "params"=>isset($request->from) ? compact('from', 'to', 'organization_id', 'zone', 'service') : null,
            "zones"=>Zone::get(),
            "services"=>Service::where("deleted",CommonEnums::$NO)->get(),
            "organization"=>Organization::get(),
            'graph'=>[
                "revenue"=>[
                    "this_week"=>[
                        "dates"=>$this_week1,
                        "sales"=>$this_week_sale1
                    ],
                ]
            ]
        ]);
    }

    public function editOrder(Request $request){
        $moving_dates=[];
        $booking = Booking::where("public_booking_id", $request->id)->with(['inventories' => function ($q){
            $q->with('inventory');
        }])->with('movement_dates')->with('status_history')->with('service')->first();
        $category = Service::where(['status' => CommonEnums::$YES, 'deleted' => CommonEnums::$NO])
            ->with(['subservices' => function ($query) {
                $query->where(['subservices.status' => CommonEnums::$YES, 'subservices.deleted' => CommonEnums::$NO]);
            }])->get();
        $inventory = Inventory::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();
        foreach ($booking->movement_dates as $key=>$dates){
           array_push($moving_dates, date("d M", strtotime($dates->date)));
        }
        $moving_dates = implode(",", $moving_dates);
        return view('order.editorder', ['categories'=>$category, 'inventories'=>$inventory, 'booking'=>$booking, 'moving_dates'=>$moving_dates]);
    }

    public function impersonateVendor(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'org'=>'required',
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);

        return VendorUserController::impersonate($request->org);
    }

    public function searchResult(Request $request)
    {
        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');

        $bookings = Booking::where("deleted", CommonEnums::$NO)->where('public_booking_id', 'like', $request->search."%")
            ->orWhere('public_enquiry_id', 'like', $request->search."%");

        return view('layouts.searchresult', ['bookings'=>$bookings->paginate(CommonEnums::$PAGE_LENGTH)]);
    }

    public function filterResult(Request $request)
    {
        if(Session::get('active_city'))
            $city = [Session::get('active_city')];
        else
            $city = Session::get('admin_cities');

        $zone = CityZone::whereIn('city_id', $city)->pluck('zone_id');

        $bookings = Booking::where("deleted", CommonEnums::$NO);

        if(isset($request->zones))
        {
            $bookings->where("zone_id",$request->zones);
        }

        if(isset($request->status))
        {
            $bookings->where("status",$request->status);
        }

        if(isset($request->category))
        {
            $bookings->where("service_id",$request->category);
        }

        if(isset($request->booking_type))
        {
            $bookings->where("booking_type",$request->booking_type);
        }

        if(isset($request->from) && isset($request->to)){
            $movement_dates= MovementDates::where('date', '>=', $request->from)->where('date', '<=', $request->to)->groupBy("booking_id")->pluck("booking_id");
            $bookings->whereIn("id",$movement_dates);
        }

        return view('layouts.searchresult', ['bookings'=>$bookings->paginate(CommonEnums::$PAGE_LENGTH)]);
    }

    public function createComplaints(){
        return view('reviewandratings.createcomplaints');
    }

    public function zonesCity(Request $request){
        $cities = City::where(['deleted'=>CommonEnums::$NO]);

        if(isset($request->search)){
            $cities =$cities->where('name', 'like', "%".$request->search."%");
        }

        if(isset($request->state)){
            $cities = $cities->where('state', 'like', "%".$request->state."%");
        }

        if(isset($request->status)){
            $cities =$cities->where('status', $request->status);
        }

        $total=City::where(["deleted"=>CommonEnums::$NO])->count();
        $active=City::where(["deleted"=>CommonEnums::$NO])->where(["status"=>CommonEnums::$YES])->count();
        $inactive=City::where(["deleted"=>CommonEnums::$NO])->where(["status"=>CommonEnums::$NO])->count();
        return view('zones.cities',[
            "cities"=>$cities->paginate(CommonEnums::$PAGE_LENGTH),
            'total'=>$total,
            'active'=>$active,
            'inactive'=>$inactive
        ]);
    }

    public function createCities(Request $request)
    {
        $zone = Zone::where(["deleted"=>CommonEnums::$NO, "status"=>CommonEnums::$YES])->get();
        $city = City::where('id',$request->id)->with('zones')->first();
        return view('zones.createcities', ['zones'=>$zone, 'cities'=>$city]);
    }
}
