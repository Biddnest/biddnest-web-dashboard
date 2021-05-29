<?php

namespace App\Http\Controllers;

use App\Enums\BookingInventoryEnums;
use App\Enums\InventoryEnums;
use App\Enums\NotificationEnums;
use App\Http\Controllers\BookingsController;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\BookingStatus;
use App\Models\Organization;
use App\Models\Bid;
use App\Models\BidInventory;
use App\Models\InventoryPrice;
use App\Models\Inventory;
use App\Models\Settings;
use App\Models\Vendor;
use App\Helper;
use App\Enums\CommonEnums;
use App\Enums\BookingEnums;
use App\Enums\BidEnums;

use Carbon\CarbonImmutable;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;


class BidController extends Controller
{
    public static function addvendors($booking_id)
    {
        try {
            $vendorlist = Organization::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])
                            ->where('zone_id',Booking::where("id", $booking_id)->pluck('zone_id')[0])->get();

            Booking::where("id", $booking_id)->update(["status"=>BookingEnums::$STATUS['biding']]);
            $vendor_ids = [];
            // $bookingstatus = new BookingStatus;
            // $bookingstatus->booking_id = $booking_id;
            // $bookingstatus->status=BookingEnums::$STATUS['biding'];
            // $result_status = $bookingstatus->save();
            $public_booking_id = Booking::where('id', $booking_id)->pluck('public_booking_id')[0];
            $result_status = BookingsController::statusChange($booking_id, BookingEnums::$STATUS['biding']);

            foreach($vendorlist as $vendor)
            {
                $bid = new Bid;
                $bid->booking_id=$booking_id;
                $bid->organization_id=$vendor['id'];
                $bid->bid_type=BidEnums::$BID_TYPE['bid'];
                $bid->status=BidEnums::$STATUS['active'];
                $bid_result = $bid->save();
                $vendor_ids[] = $vendor['id'];
            }

            NotificationController::sendTo("vendor", $vendor_ids, "New booking request received.", "Tap to respond.", [
                    "type" => NotificationEnums::$TYPE['booking'],
                    "public_booking_id" =>$public_booking_id
            ]);

            return true;

        } catch (\Exception $e) {
            return [false, "error"=>$e->getMessage()];
        }

    }

    public static function getbookings($public_booking_id = Null)
    {

        $current_time = Carbon::now()->roundMinutes()->format("Y-m-d H:i:s");

        if(!$public_booking_id)
        {
            $bookings = Booking::whereIn("status", [BookingEnums::$STATUS['biding'], BookingEnums::$STATUS['rebiding']])
            ->where("bid_result_at", "<=", "$current_time")->get();
            // return $bookings;
        }
        else
        {
            $bookings = Booking::whereIn("status", [BookingEnums::$STATUS['biding'], BookingEnums::$STATUS['rebiding']])
            ->where("public_booking_id", $public_booking_id)->get();
            // return $bookings;
        }

        $id =[];
        foreach($bookings as $booking)
        {
            $bid_end = self::updateStatus($booking['id']);

            /*tax is always taken as percentage*/


            $id[]=$booking['id'];
        }

        return ['total_bookings'=> count($bookings), 'booking_id'=>$id];
    }

    private static function updateStatus($book_id)
    {
        $min_amount = Bid::where("booking_id", $book_id)
                        ->where("status", BidEnums::$STATUS['bid_submitted'])
                        ->min('bid_amount');

        $low_quoted_vendors = Bid::where(["booking_id"=>$book_id, "bid_amount"=>$min_amount])
            ->where("status", BidEnums::$STATUS['bid_submitted'])
            ->count();

        if(!$min_amount || $low_quoted_vendors > 1)
        {
            $count_rebid=BookingStatus::where(["booking_id"=>$book_id, "status"=>BookingEnums::$STATUS['rebiding']])->count();
            if($count_rebid >= 3)
            {
                BookingsController::statusChange($book_id, BookingEnums::$STATUS['hold']);
            }

            $order = Booking::where("id", $book_id)->first();

            $timming = Settings::where("key", "rebid_time")->pluck('value')[0];
            $complete_time = Carbon::now()->addMinutes($timming)->roundMinutes();

            $meta = json_decode($order['meta'], true);
            $meta['timings']['bid_result']= $complete_time->format("Y-m-d H:i:s");

            $addrebidtime = Booking::where(["user_id"=>$order->user_id,
                                            "public_booking_id"=>$order->public_booking_id])
                                            ->update([
                                                "status"=>BookingEnums::$STATUS['rebiding'],
                                                "meta" => json_encode($meta),
                                                "bid_result_at"=>$complete_time->format("Y-m-d H:i:s")
                                            ]);

            $vendor_id =  Bid::where("booking_id", $book_id)->whereNotIn("status", [BidEnums::$STATUS['rejected'], BidEnums::$STATUS['active']])->whereNotNull('vendor_id')->pluck('vendor_id');

            Bid::where("booking_id", $book_id)->whereNotIn("status", [BidEnums::$STATUS['rejected'], BidEnums::$STATUS['active']])
                                ->update([
                                    "bid_type"=>BidEnums::$BID_TYPE['rebid'],
                                    "status"=>BidEnums::$STATUS['active']
                                    ]);

            NotificationController::sendTo('vendor', $vendor_id, "You need to re-bid on this booking.", "Tap to view.", [
                "type" => NotificationEnums::$TYPE['booking'],
                "public_booking_id" =>Booking::where("id", $book_id)->pluck('public_booking_id')[0]
            ]);

            $result_status = BookingsController::statusChange($book_id, BookingEnums::$STATUS['rebiding']);

            return true;
        }
        $public_booking_id = Booking::where('id', $book_id)->pluck('public_booking_id')[0];

        $won_org_id = Bid::where(["booking_id"=>$book_id, "bid_amount"=>$min_amount])->pluck("organization_id")[0];
        $won_vendor = Bid::where(["booking_id"=>$book_id, "bid_amount"=>$min_amount])
                            ->update(["status"=>BidEnums::$STATUS['won']]);

        $lost_vendor = Bid::where(["booking_id"=>$book_id, "status"=>BidEnums::$STATUS['bid_submitted']])
                            ->update(["status"=>BidEnums::$STATUS['lost']]);

        $expire_vendor = Bid::where(["booking_id"=>$book_id, "status"=>BidEnums::$STATUS['active']])
                            ->update(["status"=>BidEnums::$STATUS['expired']]);

        $booking_update_status = Booking::where("id", $book_id)
                                        ->whereIn("status", [BookingEnums::$STATUS['biding'], BookingEnums::$STATUS['rebiding']])
                                        ->update([
                                            "organization_id"=>$won_org_id,
                                            "final_quote"=>$min_amount,
                                            "status"=>BookingEnums::$STATUS['payment_pending']
                                        ]);

        $sub_total = (float) $min_amount;
        $other_charges = (float) Settings::where("key", "surge_charge")->pluck('value')[0];
        $tax_percentage = (float) Settings::where("key", "tax")->pluck('value')[0];
        $tax = (float) ($tax_percentage/100) *  (float) ($sub_total + $other_charges);
        $grand_total = (float) $sub_total+$other_charges+$tax;

        $payment = new Payment;
        $payment->public_transaction_id = Uuid::uuid4();
        $payment->booking_id = $book_id;
        $payment->other_charges = $other_charges;
        $payment->tax = $tax;
        $payment->sub_total= $sub_total;
        $payment->grand_total = $grand_total;
        $payment_result = $payment->save();

        $result_status = BookingsController::statusChange($book_id, BookingEnums::$STATUS['payment_pending']);

        $won_vendor_id = Bid::where(["booking_id"=>$book_id, "status"=>BidEnums::$STATUS['won']])->whereNotNull("vendor_id")->pluck("vendor_id");
        NotificationController::sendTo("vendor", $won_vendor_id, "Hurrey ! You Won Bid On This Booking.", "Tap to respond.", [
            "type" => NotificationEnums::$TYPE['booking'],
            "public_booking_id" =>Booking::where("id", $book_id)->pluck('public_booking_id')[0]
        ]);

        $lost_vendor_id =Bid::where([ "booking_id"=>$book_id, "status"=>BidEnums::$STATUS['lost']])->whereNotNull("vendor_id")->pluck("vendor_id");
        NotificationController::sendTo("vendor", $lost_vendor_id,"Oops ! You Lost Bid On This Booking.", "Tap to respond.", [
            "type" => NotificationEnums::$TYPE['booking'],
            "public_booking_id" =>Booking::where("id", $book_id)->pluck('public_booking_id')[0]
        ]);

        $expired_vendor_id =Bid::where(["booking_id"=>$book_id, "status"=>BidEnums::$STATUS['expired'], "bookmarked"=>CommonEnums::$YES])->whereNotNull("vendor_id")->pluck("vendor_id");
        NotificationController::sendTo("vendor", $expired_vendor_id, "Oops ! This Booking Is Expired.", "Tap to respond.", [
            "type" => NotificationEnums::$TYPE['booking'],
            "public_booking_id" =>Booking::where("id", $book_id)->pluck('public_booking_id')[0]
        ] );

        return true;
    }

    public static function submitBid($data, $org_id, $vendor_id, $web=false)
    {

        if($web)
        {
            $min_power=explode(";",$data['man_power'])[0];
            $max_power=explode(";",$data['man_power'])[1];
        }else{
            $min_power=$data['man_power']['min'];
            $max_power=$data['man_power']['max'];
        }
        $vendor = Vendor::where("id", $vendor_id)->first();

        if(!password_verify($data['pin'], $vendor->pin))
            return Helper::response(false,"Incorrect Pin entered");

        $exist_bid = Bid::where("organization_id", $org_id)
                            ->where("booking_id", Booking::where(['public_booking_id'=>$data['public_booking_id']])->pluck('id')[0])
                            ->whereIn("status", [BidEnums::$STATUS['active']])
                            ->first();
        if(!$exist_bid)
            return Helper::response(false,"Not in active state");

        $startTime = Carbon::now();
        $finishTime = Carbon::parse(Booking::where(['public_booking_id'=>$data['public_booking_id']])->pluck('bid_result_at')[0]);
        $totalDuration = $finishTime->diffInSeconds($startTime);
        if($totalDuration <= 3 || $startTime >= $finishTime)
            return Helper::response(false,"Bidding has been closed for this booking");

        foreach($data['inventory'] as $key)
        {
            $inventory_price = new BidInventory;
            $inventory_price->booking_inventory_id = $key['booking_inventory_id'];
//            $inventory_price->bid_id= Bid::where(['id'=>Booking::where(['public_booking_id'=>$data['public_booking_id']])->pluck('id')[0], 'organization_id'=>$org_id])->pluck('id')[0];
            $inventory_price->bid_id= Booking::where(['public_booking_id'=>$data['public_booking_id']])->pluck('id')[0];
            $inventory_price->amount=$key['amount'];
            $inventory_result = $inventory_price->save();
        }

        $meta = ["type_of_movement"=>$data['type_of_movement'], "moving_date"=>$data['moving_date'], "vehicle_type"=>$data['vehicle_type'], "min_man_power"=>$min_power, "max_man_power"=>$max_power];

        $submit_bid = Bid::where(["organization_id"=>$org_id, "id"=>$exist_bid['id']])
            ->whereIn("status", [BidEnums::$STATUS['active'], BidEnums::$STATUS['bid_submitted']])
            ->update([
            "vendor_id"=>$vendor_id,
            "bid_amount"=>$data['bid_amount'],
            "meta"=>json_encode($meta),
            "status"=>BidEnums::$STATUS['bid_submitted'],
            "submit_at"=>Carbon::now()
        ]);

        if(!$submit_bid)
            return Helper::response(false,"Couldn't Submit Quotaion");

        return Helper::response(true,"updated data successfully",["bid"=>Bid::findOrFail($exist_bid['id'])]);
    }

    public static function submitBidAdmin($data)
    {

            $min_power=explode(";",$data['man_power'])[0];
            $max_power=explode(";",$data['man_power'])[1];


        $exist_bid = Bid::where("organization_id", $data['organization_id'])
                            ->where("booking_id", Booking::where(['public_booking_id'=>$data['public_booking_id']])->pluck('id')[0])
                            ->whereIn("status", [BidEnums::$STATUS['active']])
                            ->first();
        if(!$exist_bid)
            return Helper::response(false,"Not in active state");

        $startTime = Carbon::now();
        $finishTime = Carbon::parse(Booking::where(['public_booking_id'=>$data['public_booking_id']])->pluck('bid_result_at')[0]);
        $totalDuration = $finishTime->diffInSeconds($startTime);
        if($totalDuration <= 3 || $startTime >= $finishTime)
            return Helper::response(false,"Bidding has been closed for this booking");

        foreach($data['inventory'] as $key)
        {
            $inventory_price = new BidInventory;
            $inventory_price->booking_inventory_id = $key['booking_inventory_id'];
            $inventory_price->bid_id= Booking::where(['public_booking_id'=>$data['public_booking_id']])->pluck('id')[0];
            $inventory_price->amount=$key['amount'];
            $inventory_result = $inventory_price->save();
        }

        $meta = ["type_of_movement"=>$data['type_of_movement'], "moving_date"=>$data['moving_date'], "vehicle_type"=>$data['vehicle_type'], "min_man_power"=>$min_power, "max_man_power"=>$max_power];

        $submit_bid = Bid::where(["organization_id"=>$data['organization_id'], "id"=>$exist_bid['id']])
            ->whereIn("status", [BidEnums::$STATUS['active'], BidEnums::$STATUS['bid_submitted']])
            ->update([
                "vendor_id"=>$data['vendor_id'],
                "bid_amount"=>$data['bid_amount'],
                "meta"=>json_encode($meta),
                "status"=>BidEnums::$STATUS['bid_submitted'],
                "submit_at"=>Carbon::now()
        ]);

        if($submit_bid)
            $bid_end = self::bidEndByAdmin($exist_bid['booking_id'], $data['organization_id'], $data['vendor_id'], $data['bid_amount']);

        if(!$submit_bid)
            return Helper::response(false,"Couldn't Submit Quotaion");

        return Helper::response(true,"updated data successfully",["bid"=>Bid::findOrFail($exist_bid['id'])]);
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



        $booking_update_status = Booking::where("id", $booking_id)
            ->whereIn("status", [BookingEnums::$STATUS['biding'], BookingEnums::$STATUS['rebiding']])
            ->update([
                "organization_id"=>$org_id,
                "final_quote"=>$amount,
                "status"=>BookingEnums::$STATUS['payment_pending']
            ]);

        $sub_total = (float) $amount;
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
        $payment->grand_total = $grand_total;
        $payment_result = $payment->save();

        $result_status = BookingsController::statusChange($booking_id, BookingEnums::$STATUS['payment_pending']);

       $won_vendor_id = Bid::where(["booking_id"=>$booking_id, "status"=>BidEnums::$STATUS['won']])->pluck("vendor_id");
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
        ] );

        return true;
    }

    public static function getPriceList($public_booking_id, $organization_id, $web=false){

        $booking = Bid::whereIn("booking_id", Booking::where("public_booking_id", $public_booking_id)->pluck("id"))->with("booking_inventories")->with('booking')->first();
        if(!$booking)
            return Helper::response(false,"Invalied Booking Id");

        $price_list = [];
        $total = 0;
        $price_type = $booking->booking->booking_type == BookingEnums::$BOOKING_TYPE["economic"] ? "price_economics" : "price_premium" ;
        if($booking->booking_inventories){
            foreach($booking->booking_inventories as $booking_inventory){
                $list_item = [];
                 $inv = InventoryPrice::where([
                    "inventory_id"=>$booking_inventory["inventory_id"],
                    "material"=>$booking_inventory["material"],
                    "size"=>$booking_inventory["size"],
                    "organization_id"=>$organization_id
                ])->where(["status"=>InventoryEnums::$STATUS['active'], "deleted"=>CommonEnums::$NO])->first();

                $list_item["bid_inventory_id"] = $booking_inventory["inventory_id"];

                if(!$booking_inventory["inventory_id"])
                    $list_item["name"] = $booking_inventory["name"];
                else
                    $list_item["name"] = Inventory::where("id",$booking_inventory["inventory_id"])->pluck("name")[0];

                $list_item["material"] = $booking_inventory["material"];
                $list_item["size"] = $booking_inventory["size"];
                if($booking_inventory["quantity_type"] == BookingInventoryEnums::$QUANTITY['fixed'])
                    $list_item["price"] = $inv ? $inv->$price_type * $booking_inventory['quantity'] : 0.00;
                else
                    $list_item["price"] = $inv ? $inv->$price_type * json_decode($booking_inventory['quantity'], true)['max'] : 0.00;

                array_push($price_list, $list_item);

                if($booking_inventory["quantity_type"] == BookingInventoryEnums::$QUANTITY['fixed'])
                    $total += $inv ? $inv->$price_type * $booking_inventory['quantity'] : 0.00;
                else
                    $total += $inv ? $inv->$price_type * json_decode($booking_inventory['quantity'], true)['max'] : 0.00;

            }
        }
        if($web)
            return [ "inventories" => $price_list, "total"=>$total ];
        else
            return Helper::response(true,"Here is the pricelist",["price_list"=>[
                "inventories" => $price_list,
                "total"=>$total
            ]]);

    }

}
