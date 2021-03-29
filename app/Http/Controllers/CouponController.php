<?php

namespace App\Http\Controllers;

use App\Enums\CouponEnums;
use App\Enums\PaymentEnums;
use App\Helper;
use App\Models\Booking;
use App\Models\Coupon;
use App\Models\CouponOrganization;
use App\Models\CouponUser;
use App\Models\CouponZone;
use App\Models\Payment;
use App\Models\Settings;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
   public function __construct(){}

   public static function add($data){
    /*$name,$desc, $code, $type, $discount_type, $discount_amount, $max_discount, $min_order_value, $deduction_source, $orgnization_id, $max_usage, $max_usage_user, $scope, $eligibiity_type, $valid_from, $valid_to*/
    $exist = Coupon::where("code",strtoupper($data['code']))->first();

    if($exist)
        return false;

    $coupon = new Coupon;
    $coupon->name = $data['name'];
    $coupon->desc = $data['desc'];
    $coupon->code = strtoupper($data['code']);
    $coupon->coupon_type = $data['type'] == CouponEnums::$COUPON_TYPE['discount'] ? CouponEnums::$COUPON_TYPE['discount'] : 0;
    $coupon->discount_type = in_array($data['discount_type'], CouponEnums::$DISCOUNT_TYPE) ? $data['discount_type'] : null;

    $coupon->discount_amount = $data['discount_amount'];
    $coupon->max_discount_amount = $data['max_discount_amount'];
    $coupon->min_order_amount = $data['min_order_amount'];
    $coupon->deduction_source = in_array($data['deduction_source'], CouponEnums::$DEDUCTION_SOURCE) ? $data['deduction_source'] : null;
    //    $coupon->organization_id = $data['organization_id'];
    $coupon->max_usage = $data['max_usage'];
    $coupon->max_usage_per_user = $data['max_usage_per_user'];
    $coupon->usage = 0; //initially set to zero
    $coupon->organization_scope = in_array($data['organization_scope'], CouponEnums::$ORGANIZATION_SCOPE) ? $data['organization_scope'] : null;
    $coupon->zone_scope = in_array($data['zone_scope'], CouponEnums::$ZONE_SCOPE) ? $data['zone_scope'] : null;
    $coupon->user_scope = in_array($data['user_scope'], CouponEnums::$USER_SCOPE) ? $data['user_scope'] : null;
    $coupon->valid_from = date("Y-m-d", strtotime($data['valid_from']));
    $coupon->valid_to = date("Y-m-d", strtotime($data['valid_to']));
    $coupon->status = CouponEnums::$STATUS['active'];
    if(!$coupon->save())
        return Helper::response(false, "couldn't save");

    if($data['organization_scope']== CouponEnums::$ORGANIZATION_SCOPE['custom']){
        if(count($data['organizations']) > 0){
            foreach($data['organizations'] as $organization) {
                $coupon_organizaton = new CouponOrganization;
                $coupon_organizaton->organization_id = $organization;
                $coupon_organizaton->coupon_id = $coupon->id;
                $coupon_organizaton->save();
            }
    }
    }

    if($data['zone_scope']== CouponEnums::$ZONE_SCOPE['custom']){
        if(count($data['zones']) > 0){
            foreach($data['zones'] as $zone) {
                $coupon_zone = new CouponZone;
                $coupon_zone->zone_id = $zone;
                $coupon_zone->coupon_id = $coupon->id;
                $coupon_zone->save();
            }
    }
    }

    if($data['user_scope']== CouponEnums::$USER_SCOPE['custom']){
        if(count($data['users']) > 0){
            foreach($data['users'] as $user) {
                $coupon_user = new CouponUser;
                $coupon_user->user_id = $user;
                $coupon_user->coupon_id = $coupon->id;
                $coupon_user->save();
            }
    }
    }

    return Helper::response(true, "Coupon Added Successfully", ["coupon"=>Coupon::with('users')->with('organizations')->with('zones')->findorFail($coupon->id)]);


   }

   public static function checkIfValid($public_booking_id, $coupon_code){

       $coupon = Coupon::where("code",$coupon_code)->with('users')->with('organizations')->with('zones')->first();

       if(!$coupon || $coupon->status == CouponEnums::$STATUS['inactive'])
           return "Coupon code doesn't exist."; //invalid coupon code

       $booking = Booking::where('public_booking_id',$public_booking_id)->with("organization")->with("payment")->first();

       if(!$booking)
           return "Invalid Booking id"; //invalid coupon code

       if(Carbon::now()->format("Y-m-d") <= $coupon->valid_from && Carbon::now()->format("Y-m-d") >= $coupon->valid_to)
           return "This coupon is not yet active or has expired.";

       if($coupon->usage >= $coupon->max_usage)
           return "This coupon has exceeded its maxumum usage limit.";

       $usage_by_current_user = Payment::whereIn(
           "booking_id", Booking::where([
               "user_id"=>$booking->user_id
       ])->pluck("id")
       )->where('coupon_code',$coupon_code)
           ->where("status","!=",PaymentEnums::$STATUS['failed'])
            ->count();

       if($coupon->max_usage_per_user <= $usage_by_current_user)
           return "You have exceeded the maximum usage for this coupon.";

       if($coupon->min_order_amount >= $booking->final_quote)
           return "You have exceeded the maximum amount for this coupon.";

       if($coupon->zone_scope == CouponEnums::$ZONE_SCOPE['custom']){
           $coupon_valid = false;
           foreach ($coupon->zone as $zone){
               if($zone->id == $booking->organization->id){
                   $coupon_valid = true;
               }
           }
           if(!$coupon_valid)
               return "This coupon is not valid in your city.";
       }

       if($coupon->organization_scope == CouponEnums::$ORGANIZATION_SCOPE['custom']){
           $coupon_valid = false;
           foreach ($coupon->organizations as $org){
               if($org->id == $booking->organization_id){
                   $coupon_valid = true;
               }
           }
           if(!$coupon_valid)
               return "This coupon is not applicable o on this vendor.";
       }

       if($coupon->user_scope == CouponEnums::$USER_SCOPE['custom']){
           $coupon_valid = false;
           foreach ($coupon->users as $user){
               if($user->id == $booking->user_id){
                   $coupon_valid = true;
               }
           }
           if(!$coupon_valid)
               return "This coupon is not applicable for you.";
       }

       $discount_amount = $coupon->discount_type == CouponEnums::$DISCOUNT_TYPE['fixed'] ? number_format($coupon->discount_amount,2) :  number_format($booking->final_quote * ($coupon->discount_amount / 100),2);

       $discount_amount = $discount_amount > $coupon->max_discount_amount ? $coupon->max_discount_amount : $discount_amount;

       $tax_percentage = Settings::where("key", "tax")->pluck('value')[0];

       $grand_total = ($booking->payment->sub_total + $booking->payment->other_charges) - $discount_amount;
       $tax =  $grand_total * ($tax_percentage/100);
       $grand_total += $tax;


       return (array) ["coupon"=>["discount"=>number_format($discount_amount,2)], "payment_details"=>[
           "sub_total" => $booking->payment->sub_total,
           "surge_charge"=>$booking->payment->other_charges,
           "discount"=>$discount_amount,
           "tax(".$tax_percentage."%)"=>$tax,
           "grand_total" => $grand_total
       ]];

        // return $discount_amount;
   }
}
