<?php

namespace App\Http\Controllers;

use App\Enums\BidEnums;
use App\Enums\BookingEnums;
use App\Enums\BookingInventoryEnums;
use App\Enums\CommonEnums;
use App\Enums\InventoryEnums;
use App\Enums\NotificationEnums;
use App\Enums\OrganizationEnums;
use App\Enums\VendorEnums;
use App\Helper;
use App\Models\Bid;
use App\Models\BidInventory;
use App\Models\Booking;
use App\Models\BookingOrganizationGeneratedPrice;
use App\Models\BookingStatus;
use App\Models\Inventory;
use App\Models\InventoryPrice;
use App\Models\Organization;
use App\Models\Payment;
use App\Models\Settings;
use App\Models\Vendor;
use App\Models\SubservicePrice;
use App\Models\Subservice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;


class BidController extends Controller
{
    public static function addvendors($booking_id)
    {
//        try {
           $vendorlist = Organization::where(["status"=>OrganizationEnums::$STATUS['active'], "deleted"=>CommonEnums::$NO])
            ->where('zone_id',Booking::where("id", $booking_id)->pluck('zone_id')[0])->get();

        if(!$vendorlist)
            return false;

        Booking::where("id", $booking_id)->update(["status"=>BookingEnums::$STATUS['biding']]);

        $vendor_ids = [];
        $vendor_notification_id=[];

        $public_booking_id = Booking::where('id', $booking_id)->pluck('public_booking_id')[0];
        $result_status = BookingsController::statusChange($booking_id, BookingEnums::$STATUS['biding']);

        foreach($vendorlist as $vendor) {
            $bid = new Bid;
            $bid->booking_id=$booking_id;
            $bid->organization_id=$vendor['id'];
            $bid->bid_type=BidEnums::$BID_TYPE['bid'];
            $bid->status=BidEnums::$STATUS['active'];
            $bid_result = $bid->save();
            $vendor_ids[] = $vendor['id'];

            foreach (Vendor::where('organization_id', $vendor['id'])->pluck('id') as $vendor_id) {
                $vendor_notification_id[]=$vendor_id;
            }
        }

        NotificationController::sendTo("vendor", $vendor_notification_id, "New booking request received.", "Tap to respond.", [
            "type" => NotificationEnums::$TYPE['booking'],
            "public_booking_id" =>$public_booking_id
        ]);

        return true;

        /* } catch (\Exception $e) {
             return [false, "error"=>$e->getMessage()];
         }*/

    }


    public static function getbookings($public_booking_id = null)
    {

        $current_time = Carbon::now()->roundMinutes()->format("Y-m-d H:i:s");

        if(!$public_booking_id) {
            $bookings = Booking::whereIn("status", [BookingEnums::$STATUS['biding'], BookingEnums::$STATUS['rebiding'], BookingEnums::$STATUS['awaiting_bid_result']])
                ->where("bid_result_at", "<=", "$current_time")->get();
            // return $bookings;
        } else {
            $bookings = Booking::whereIn("status", [BookingEnums::$STATUS['biding'], BookingEnums::$STATUS['rebiding']])
                ->where("public_booking_id", $public_booking_id)->get();
            // return $bookings;
        }

        $id =[];
        foreach($bookings as $booking) {
            $bid_end = self::updateStatus($booking['id']);

            /*tax is always taken as percentage*/


            $id[]=$booking['id'];
        }

        return ['total_bookings'=> count($bookings), 'booking_id'=>$id];
    }

    public static function endTimer(){
        $current_time = Carbon::now()->roundMinutes()->format("Y-m-d H:i:s");

        Booking::where("bid_end_at", "<=", "$current_time")
            ->whereIn("status",[BookingEnums::$STATUS['biding'],BookingEnums::$STATUS['rebiding']])
            ->update(['status'=>BookingEnums::$STATUS['awaiting_bid_result']]);

        return true;
    }

    private static function updateStatus($book_id)
    {
        $min_amount = Bid::where("booking_id", $book_id)
            ->where("status", BidEnums::$STATUS['bid_submitted'])
            ->min('bid_amount');

        $low_quoted_vendors = Bid::where(["booking_id"=>$book_id, "bid_amount"=>$min_amount])
            ->where("status", BidEnums::$STATUS['bid_submitted'])
            ->count();

        if(!$min_amount || $low_quoted_vendors > 1) {
            $count_rebid=BookingStatus::where(["booking_id"=>$book_id, "status"=>BookingEnums::$STATUS['biding']])->count();
            if($count_rebid >= (int)Settings::where('key', 'max_rebid_count')->pluck('value')[0]) {
                BookingsController::statusChange($book_id, BookingEnums::$STATUS['hold']);
                Booking::where("id", $book_id)->update(["status"=>BookingEnums::$STATUS['hold']]);
                return true;
            }

            $order = Booking::where("id", $book_id)->first();

            $timing = Settings::where("key", "rebid_time")->pluck('value')[0];
            $buffer = Settings::where("key", "buffer_time")->pluck('value')[0];
            $complete_time = Carbon::now()
                ->addMinutes($timing)
                ->addMinutes($buffer)
                ->roundMinutes()->format("Y-m-d H:i:s");

            $bid_end_time = Carbon::now()
                ->addMinutes($timing)
                ->roundMinutes()
                ->format("Y-m-d H:i:s");

            $meta = json_decode($order['meta'], true);
            $meta['timings']['bid_result']= $bid_end_time;


            if(!$min_amount) {
                $addrebidtime = Booking::where(["user_id" => $order->user_id,
                    "public_booking_id" => $order->public_booking_id])
                    ->update([
                        "status" => BookingEnums::$STATUS['biding'],
                        "meta" => json_encode($meta),
                        "bid_result_at" => $complete_time,
                        "bid_end_at" =>  $bid_end_time
                    ]);
                $result_status = BookingsController::statusChange($book_id, BookingEnums::$STATUS['biding']);
            }
            if($low_quoted_vendors > 1){
                $addrebidtime = Booking::where(["user_id" => $order->user_id,
                    "public_booking_id" => $order->public_booking_id])
                    ->update([
                        "status" => BookingEnums::$STATUS['rebiding'],
                        "meta" => json_encode($meta),
                        "bid_result_at" => $complete_time,
                        "bid_end_at" =>  $bid_end_time
                    ]);
                $result_status = BookingsController::statusChange($book_id, BookingEnums::$STATUS['rebiding']);
            }

            $vendor_id =  Bid::where("booking_id", $book_id)->whereNotIn("status", [BidEnums::$STATUS['rejected'], BidEnums::$STATUS['active']])->whereNotNull('vendor_id')->pluck('vendor_id');

            if($low_quoted_vendors > 1) {
                Bid::where("booking_id", $book_id)->whereNotIn("status", [BidEnums::$STATUS['rejected'], BidEnums::$STATUS['active']])
                    ->update([
                        "bid_type" => BidEnums::$BID_TYPE['rebid'],
                        "status" => BidEnums::$STATUS['active']
                    ]);

                NotificationController::sendTo("vendor", $vendor_id, "You need to re-bid on this booking.", "Tap to view.", [
                    "type" => NotificationEnums::$TYPE['booking'],
                    "public_booking_id" => Booking::where("id", $book_id)->pluck('public_booking_id')[0]
                ]);

            }


            return true;
        }

        $booking_data = Booking::find($book_id);
        if($booking_data->booking_type == BookingEnums::$BOOKING_TYPE['economic']) {
            $booking_type_column = 'bp_economic';
            $booking_type_percentage_column = 'economic_margin_percentage';
        }
        else {
            $booking_type_column = 'bp_premium';
            $booking_type_percentage_column = 'premium_margin_percentage';
        }

        $least_agent_price = BookingOrganizationGeneratedPrice::where('booking_id', $booking_data['id'])
            ->min($booking_type_column);

        $average_margin_percentage = BookingOrganizationGeneratedPrice::where('booking_id', $booking_data['id'])
            ->avg($booking_type_percentage_column);

        $average_margin_value = ($average_margin_percentage / 100) * $least_agent_price;

        $search_percentage = Settings::where("key", "tax")->pluck('value')[0];
        $final_bid_amount = 0.00;
        $commission = 0.00;
        $search_charges = (float) Settings::where("key", "surge_charge")->pluck('value')[0];
        if($min_amount <= $least_agent_price){
            /* BID CASE 1 */
            $commission = (0.7 * $average_margin_value);
            $final_bid_amount = $min_amount + $commission + $search_percentage;
            $sub_amount = (float) $min_amount + $commission + $search_charges;

        }else if($min_amount > $least_agent_price && $min_amount <= $booking_data->organization_rec_quote){
            $commission = (0.6 * $average_margin_value);
            $final_bid_amount = $min_amount + $commission + $search_percentage;
            $sub_amount = (float) $min_amount + $commission + $search_charges;
        }else{
            $final_bid_amount = null;
            $sub_amount = 0.00;
        }

        $public_booking_id = $booking_data->public_booking_id;


        $won_org_id = Bid::where(["booking_id"=>$book_id, "bid_amount"=>$min_amount])->pluck("organization_id")[0];
        $won_bid_details = Bid::where(["booking_id"=>$book_id, "organization_id"=>$won_org_id])->first();

        Bid::where(["booking_id"=>$book_id, "bid_amount"=>$min_amount])
            ->update(["status"=>BidEnums::$STATUS['won']]);

        Bid::where(["booking_id"=>$book_id, "status"=>BidEnums::$STATUS['bid_submitted']])
            ->update(["status"=>BidEnums::$STATUS['lost']]);

        Bid::where(["booking_id"=>$book_id, "status"=>BidEnums::$STATUS['active']])
            ->update(["status"=>BidEnums::$STATUS['expired']]);

        if($final_bid_amount)
            $final_status = BookingEnums::$STATUS['payment_pending'];
        else
            $final_status = BookingEnums::$STATUS['price_review_pending'];



        Booking::where("id", $book_id)
            ->whereIn("status", [BookingEnums::$STATUS['awaiting_bid_result']])
            ->update([
                "organization_id"=>$won_org_id,
                "final_quote"=>$final_bid_amount,
//                "final_moving_date"=>date("Y-m-d", strtotime(json_decode($won_bid_details->meta, true)['moving_date'])),
                "status"=>$final_status
            ]);
        $other_charges = (float) Settings::where("key", "surge_charge")->pluck('value')[0];
        $sub_total = (float) $final_bid_amount;
        $tax_percentage = (float) Settings::where("key", "tax")->pluck('value')[0];
        $tax = (float) ($tax_percentage/100) *  (float) ($sub_total + $other_charges);
        $grand_total = (float) $sub_total+$tax;

        $payment = new Payment;
        $payment->public_transaction_id = Uuid::uuid4();
        $payment->booking_id = $book_id;
        $payment->vendor_quote = $min_amount;
        $payment->other_charges = $other_charges;
        $payment->tax = $tax;
        $payment->commission = $commission;
        $payment->sub_total= $sub_amount;
        $payment->grand_total = $grand_total;
        $payment_result = $payment->save();

        $result_status = BookingsController::statusChange($book_id, $final_status);

        if($final_bid_amount){

            NotificationController::sendTo("user", [$booking_data->user_id], "Your final quote is ready.", "Tap to view.", [
                "type" => NotificationEnums::$TYPE['booking'],
                "public_booking_id" => Booking::where("id", $book_id)->pluck('public_booking_id')[0]
            ]);

            $won_vendor_id = Bid::where(["booking_id" => $book_id, "status" => BidEnums::$STATUS['won']])->whereNotNull("vendor_id")->pluck("vendor_id");
            NotificationController::sendTo("vendor", $won_vendor_id, "Hurrey ! You Won Bid On This Booking.", "Tap to respond.", [
                "type" => NotificationEnums::$TYPE['booking'],
                "public_booking_id" => Booking::where("id", $book_id)->pluck('public_booking_id')[0]
            ]);
        }

        $lost_vendor_id =Bid::where([ "booking_id"=>$book_id, "status"=>BidEnums::$STATUS['lost']])->whereNotNull("vendor_id")->pluck("vendor_id");
        NotificationController::sendTo("vendor", $lost_vendor_id,"Oops ! You Lost Bid On This Booking.", "Tap to respond.", [
            "type" => NotificationEnums::$TYPE['booking'],
            "public_booking_id" =>Booking::where("id", $book_id)->pluck('public_booking_id')[0]
        ]);

        $expired_vendor_id =Bid::where(["booking_id"=>$book_id, "status"=>BidEnums::$STATUS['expired'], "bookmarked"=>CommonEnums::$YES])->whereNotNull("vendor_id")->pluck("bookmarked_by");
        NotificationController::sendTo("vendor", $expired_vendor_id, "Oops ! This Booking Is Expired.", "Tap to respond.", [
            "type" => NotificationEnums::$TYPE['booking'],
            "public_booking_id" =>Booking::where("id", $book_id)->pluck('public_booking_id')[0]
        ] );

        return true;
    }

    public static function submitBid($data, $org_id, $vendor_id, $web=false)
    {

        if($web) {
            $min_power=explode(";",$data['man_power'])[0];
            $max_power=explode(";",$data['man_power'])[1];
        } else{
            $min_power=$data['man_power']['min'];
            $max_power=$data['man_power']['max'];
        }
        $vendor = Vendor::where("id", $vendor_id)->first();

        if(!password_verify($data['pin'], $vendor->pin))
            return Helper::response(false,"Incorrect Pin entered");

        $startTime = Carbon::now();
        $finishTime = Carbon::parse(Booking::where(['public_booking_id'=>$data['public_booking_id']])->pluck('bid_end_at')[0]);
        $totalDuration = $finishTime->diffInSeconds($startTime);
        if($totalDuration <= 3 || $startTime >= $finishTime)
            return Helper::response(false,"Bidding time has finished for this booking. Could not place your bid.");


        $exist_bid = Bid::where("organization_id", $org_id)
            ->where("booking_id", Booking::where(['public_booking_id'=>$data['public_booking_id']])->pluck('id')[0])
            ->with("rejected_by")
            ->with("watched_by")
//                            ->whereIn("status", [BidEnums::$STATUS['active']])
            ->first();

        /* here refresh_current_activity will refresh the page in mobile app if vendor tries to submit bid for an order her is not listed for */
        if(!$exist_bid)
            return Helper::response(false,"This Booking is not to assigned",["refresh_current_activity"=>true]);

        if($exist_bid->status == BidEnums::$STATUS['bid_submitted']){
            $submit_by = Vendor::where("id",$exist_bid->vendor_id)->first();

            if($submit_by->id == $vendor_id)
                $name = "you";
            else
                $name = $submit_by->fname." ".$submit_by->lname;

            /*Current activity will be refreshed in the app with the refresh_current_activity key*/
            return Helper::response(false,"Bid has already been submitted for this order by $name",["refresh_current_activity"=>true]);
        }

        if($exist_bid->status == BidEnums::$STATUS['rejected']){
            $submit_by = Vendor::where("id",$exist_bid->rejected_by)->first();

            if($submit_by->id == $vendor_id)
                $name = "you";
            else
                $name = $submit_by->fname." ".$submit_by->lname;

            /*Current activity will be refreshed in the app with the refresh_current_activity key*/
            return Helper::response(false,"This bid has been rejected by $name. Couldn't submit bid.",["refresh_current_activity"=>true]);
        }

        if($exist_bid->status != BidEnums::$STATUS['active'])
            return Helper::response(false,"Bidding has been closed for this order.",["refresh_current_activity"=>true]);

        foreach($data['inventory'] as $key) {

                $inventory_price = new BidInventory;
                $inventory_price->booking_inventory_id = $key['booking_inventory_id'];
                $inventory_price->bid_id= Bid::where(['booking_id'=>Booking::where('public_booking_id', $data['public_booking_id'])->pluck('id')[0], 'organization_id'=>$org_id])->pluck('id')[0];
                $inventory_price->amount = !$key['is_custom'] ? 0.00 : $key['amount'];

                $inventory_price->save();

        }

        $meta = ["type_of_movement"=>$data['type_of_movement'], "moving_date"=>null, "vehicle_type"=>$data['vehicle_type'], "min_man_power"=>$min_power, "max_man_power"=>$max_power];

        $submit_bid = Bid::where(["organization_id"=>$org_id, "id"=>$exist_bid['id']])
            ->whereIn("status", [BidEnums::$STATUS['active'], BidEnums::$STATUS['bid_submitted']])
            ->update([
                "vendor_id"=>$vendor_id,
                "bid_amount"=>$data['bid_amount'],
                "moving_dates"=>json_encode($data['moving_date']),
                "meta"=>json_encode($meta),
                "status"=>BidEnums::$STATUS['bid_submitted'],
                "submit_at"=>Carbon::now()->format("Y-m-d H:i:s")
            ]);

        if(!$submit_bid)
            return Helper::response(false,"Couldn't Submit Quotaion");

        return Helper::response(true,"Bid successfully submitted",["bid"=>Bid::findOrFail($exist_bid['id'])]);
    }

    public static function submitBidAdmin($data)
    {
        $verf_otp =Vendor::where(['organization_id'=>$data['organization_id'], 'user_role'=>VendorEnums::$ROLES['admin']])->pluck("verf_code")[0];

        if($data['otp'] == $verf_otp) {
            $min_power=explode(";",$data['man_power'])[0];
            $max_power=explode(";",$data['man_power'])[1];


            $exist_bid = Bid::where("organization_id", $data['organization_id'])
                ->where("booking_id", Booking::where(['public_booking_id'=>$data['public_booking_id']])->pluck('id')[0])
                ->whereIn("status", [BidEnums::$STATUS['active']])
                ->first();
            if(!$exist_bid)
                return Helper::response(false,"Not in active state");

            $startTime = Carbon::now();
            $finishTime = Carbon::parse(Booking::where(['public_booking_id'=>$data['public_booking_id']])->pluck('bid_end_at')[0]);
            $totalDuration = $finishTime->diffInSeconds($startTime);
            /* if($totalDuration <= 3 || $startTime >= $finishTime)
                 return Helper::response(false,"Bidding has been closed for this booking");*/

            foreach($data['inventory'] as $key) {
                $inventory_price = new BidInventory;
                $inventory_price->booking_inventory_id = $key['booking_inventory_id'];
                $inventory_price->bid_id= Booking::where(['public_booking_id'=>$data['public_booking_id']])->pluck('id')[0];
                $inventory_price->amount=$key['amount'];
                $inventory_result = $inventory_price->save();
            }

            $meta = ["type_of_movement"=>$data['type_of_movement'], "moving_date"=>null, "vehicle_type"=>$data['vehicle_type'], "min_man_power"=>$min_power, "max_man_power"=>$max_power];

            $submit_bid = Bid::where(["organization_id"=>$data['organization_id'], "id"=>$exist_bid['id']])
                ->whereIn("status", [BidEnums::$STATUS['active'], BidEnums::$STATUS['bid_submitted']])
                ->update([
                    "vendor_id"=>$data['vendor_id'],
                    "bid_amount"=>$data['bid_amount'],
                    "moving_dates"=>json_encode($data['moving_date']),
                    "meta"=>json_encode($meta),
                    "status"=>BidEnums::$STATUS['bid_submitted'],
                    "submit_at"=>Carbon::now()
                ]);

            if($submit_bid)
                $bid_end = self::bidEndByAdmin($exist_bid['booking_id'], $data['organization_id'], $data['vendor_id'], $data['bid_amount']);

            if(!$submit_bid)
                return Helper::response(false,"Couldn't Submit Quotaion");

            return Helper::response(true,"updated data successfully",["bid"=>Bid::findOrFail($exist_bid['id'])]);

        } else{
            return Helper::response(false,"OTP is incorrect");
        }
    }

    private static function bidEndByAdmin($booking_id, $org_id, $vendor_id, $amount)
    {

        $won_vendor = Bid::where(["booking_id"=>$booking_id, "organization_id"=>$org_id])
            ->update(["status"=>BidEnums::$STATUS['won']]);


        /*$lost_vendor_id =Bid::where(["booking_id"=>$book_id, "status"=>BidEnums::$STATUS['bid_submitted']])->pluck("vendor_id")[0];*/
        $lost_vendor = Bid::where(["booking_id"=>$booking_id, "status"=>BidEnums::$STATUS['bid_submitted']])
            ->update(["status"=>BidEnums::$STATUS['lost']]);


        $expire_vendor = Bid::where(["booking_id"=>$booking_id, "status"=>BidEnums::$STATUS['active']])
            ->update(["status"=>BidEnums::$STATUS['expired']]);

        $bid_details = Bid::where(["booking_id"=>$booking_id, "organization_id"=>$org_id])->first();



        $booking_data = Booking::find($booking_id);
        if($booking_data->booking_type == BookingEnums::$BOOKING_TYPE['economic']) {
            $booking_type_column = 'bp_economic';
            $booking_type_percentage_column = 'economic_margin_percentage';
        }
        else {
            $booking_type_column = 'bp_premium';
            $booking_type_percentage_column = 'premium_margin_percentage';
        }


        $least_agent_price = BookingOrganizationGeneratedPrice::where('booking_id', $booking_data['id'])
            ->min($booking_type_column);

        $average_margin_percentage = BookingOrganizationGeneratedPrice::where('booking_id', $booking_data['id'])
            ->avg($booking_type_percentage_column);

        $average_margin_value = ($average_margin_percentage / 100) * $least_agent_price;

        $final_bid_amount = 0.00;
        $commission = 0.00;
        if($amount <= $least_agent_price){
            /* BID CASE 1 */
            $commission = (0.7 * $average_margin_value);
            $final_bid_amount = $least_agent_price + $commission;

        }else if($amount > $least_agent_price && $amount <= $booking_data->organization_rec_quote){
            $commission = (0.6 * $average_margin_value);
            $final_bid_amount = $least_agent_price + $commission;
        }else{
            $final_bid_amount = null;
        }

        $sub_total = (float) $final_bid_amount;
        $other_charges = (float) Settings::where("key", "surge_charge")->pluck('value')[0];
        $tax_percentage = (float) Settings::where("key", "tax")->pluck('value')[0];
        $tax = (float) ($tax_percentage/100) *  (float) ($sub_total + $other_charges);
        $grand_total = (float) $sub_total+$other_charges+$tax;

        $payment = new Payment;
        $payment->public_transaction_id = Uuid::uuid4();
        $payment->booking_id = $booking_id;
        $payment->other_charges = $other_charges;
        $payment->tax = $tax;
        $payment->sub_total= $sub_total;
        $payment->commission = $commission;
        $payment->grand_total = $grand_total;
        $payment_result = $payment->save();

        $booking_update_status = Booking::where("id", $booking_id)
            ->whereIn("status", [BookingEnums::$STATUS['biding'], BookingEnums::$STATUS['rebiding']])
            ->update([
                "organization_id"=>$org_id,
                "final_quote"=>$final_bid_amount,
                "final_moving_date"=>date("Y-m-d", strtotime(json_decode($bid_details->meta, true)['moving_date'])),
                "status"=>BookingEnums::$STATUS['payment_pending']
            ]);

        $result_status = BookingsController::statusChange($booking_id, BookingEnums::$STATUS['payment_pending']);

        /* $won_vendor_id = Bid::where(["booking_id"=>$booking_id, "status"=>BidEnums::$STATUS['won']])->pluck("vendor_id");
          NotificationController::sendTo( "vendor", $won_vendor_id, "Hurrey ! You Won Bid On This Booking.", "Tap to respond.", [
              "type" => NotificationEnums::$TYPE['booking'],
              "public_booking_id" =>Booking::where("id", $booking_id)->pluck('public_booking_id')[0]
          ]);

          $lost_vendor_id =Bid::where(["booking_id"=>$booking_id, "status"=>BidEnums::$STATUS['lost']])->pluck("vendor_id");
          NotificationController::sendTo("vendor", $lost_vendor_id, "Oops ! You Lost Bid On This Booking.", "Tap to respond.", [
              "type" => NotificationEnums::$TYPE['booking'],
              "public_booking_id" =>Booking::where("id", $booking_id)->pluck('public_booking_id')[0]
          ]);

          $expired_vendor_id =Bid::where(["booking_id"=>$booking_id, "status"=>BidEnums::$STATUS['expired'], "bookmarked"=>CommonEnums::$YES])->pluck("vendor_id");
          NotificationController::sendTo("vendor", $expired_vendor_id, "Oops ! This Booking Is Expired.", "Tap to respond.", [
              "type" => NotificationEnums::$TYPE['booking'],
              "public_booking_id" =>Booking::where("id", $booking_id)->pluck('public_booking_id')[0]
          ] );*/

        return true;
    }

    public static function getPriceList($public_booking_id, $organization_id, $web=false){

        $booking = Bid::whereIn("booking_id", Booking::where("public_booking_id", $public_booking_id)->pluck("id"))->with("booking_inventories")->with('booking')->first();
        if(!$booking)
            return Helper::response(false,"Invalied Booking Id");

        $vendor = Organization::find($organization_id);

        $query = SubservicePrice::where(
            "organization_id", $organization_id)
            ->where('subservice_id', Subservice::where("name", json_decode($booking->booking->meta, true)['subcategory'])->pluck('id')[0])
            ->first();

        $price_list = [];
        $total = 0.00;

        $price_type = $booking->booking->booking_type == BookingEnums::$BOOKING_TYPE["economic"] ? "bp_economic" : "bp_premium";
        $ad_price_type = $booking->booking->booking_type == BookingEnums::$BOOKING_TYPE["economic"] ? "bp_additional_distance_economic_price" : "bp_additional_distance_premium_price";

        $additional_distance = (float)json_decode($booking->booking->meta, true)['distance'] - $vendor->base_distance;

        if ($additional_distance < 0.00)
            $additional_distance = 0.00;

        $vendor_base_price = 0.00;


        if(strtolower(json_decode($booking->booking->meta, true)['subcategory']) != "custom"){
            $vendor_base_price = $query ? $query->$price_type + (($additional_distance / $vendor->additional_distance) * $query->$ad_price_type) : 0.00;
        }

        if($booking->booking_inventories){
            foreach($booking->booking_inventories as $booking_inventory){
                $list_item = [];


                $list_item["bid_inventory_id"] = $booking_inventory["id"];

                if(!$booking_inventory["inventory_id"])
                    $list_item["name"] = $booking_inventory["name"];
                else
                    $list_item["name"] = Inventory::where("id",$booking_inventory["inventory_id"])->pluck("name")[0];

                $list_item["material"] = $booking_inventory["material"];
                $list_item["size"] = $booking_inventory["size"];


                if($booking_inventory['is_custom'] == 1){
                    $inv = InventoryPrice::where([
                        "inventory_id"=>$booking_inventory["inventory_id"],
                        "material"=>$booking_inventory["material"],
                        "size"=>$booking_inventory["size"],
                        "service_type"=> $booking->service_id,
                        "organization_id"=>$organization_id
                    ])->where(["status"=>InventoryEnums::$STATUS['active'], "deleted"=>CommonEnums::$NO])->first();


                    $base_price = 0.00;
                    $ad_price = 0.00;
                    if ($inv)
                        $base_price = (float)$inv->$price_type;

                    if ($query)
                        $ad_price = (float)$query->$ad_price_type;


                    if ($booking_inventory["quantity_type"] == BookingInventoryEnums::$QUANTITY['fixed'])
                        $list_item["price"] = round($booking_inventory['quantity'] * ($base_price + (($additional_distance / (float)$vendor['additional_distance']) * $ad_price)), 2);
                    else
                        $list_item["price"] = round(json_decode($booking_inventory['quantity'], true)['max'] * ($base_price + (($additional_distance / (float)$vendor['additional_distance']) * $ad_price)), 2);
                }
                else{
                    $list_item["price"] = 0.00;
                }

                /*custom item flag*/
                $list_item["is_custom"] = $booking_inventory->is_custom ? true : false;

                $total += (float)$list_item['price'];
                array_push($price_list, $list_item);
            }
        }

        $booking_type = Booking::where("public_booking_id", $public_booking_id)->pluck('booking_type')[0];
        $booking_id = Booking::where("public_booking_id", $public_booking_id)->pluck('id')[0];

        $column = $booking_type == BookingEnums::$BOOKING_TYPE['economic'] ? 'base_price_economic' : 'base_price_premium';

        $base_price = BookingOrganizationGeneratedPrice::where(["organization_id"=>$organization_id, "booking_id"=>$booking_id])->pluck($column)[0];

        if($web)
            return [ "inventories" => $price_list, "total"=>$total,"base_price"=> $base_price];
        else
            return Helper::response(true,"Here is the pricelist",["price_list"=>[
                "inventories" => $price_list,
                "total" => round((float)$total,2),
                "base_price" => round((float)$vendor_base_price,2),
                "grand_total"=>round((float)$total + (float)$vendor_base_price,2)
            ]]);

    }

}
