<?php

namespace App\Http\Controllers;

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
use App\Helper;
use App\Enums\CommonEnums;
use App\Enums\BookingEnums;
use App\Enums\BidEnums;

use Carbon\CarbonImmutable;
use Carbon\Carbon;


class BidController extends Controller
{
    public static function addvendors($booking_id)
    {
        try {
            $vendorlist = Organization::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();

            $update_status = Booking::where("id", $booking_id)->update(["status"=>BookingEnums::$STATUS['biding']]);

            $bookingstatus = new BookingStatus;
            $bookingstatus->booking_id = $booking_id;
            $bookingstatus->status=BookingEnums::$STATUS['biding'];
            $result_status = $bookingstatus->save();

            foreach($vendorlist as $vendor)
            {
                $bid = new Bid;
                $bid->booking_id=$booking_id;
                $bid->organization_id=$vendor['id'];
                $bid->bid_type=BidEnums::$BID_TYPE['bid'];
                $bid->status=BidEnums::$STATUS['active'];
                $bid_result = $bid->save();
            }
            return true;

        } catch (\Exception $e) {
            return [false, "error"=>$e->getMessage()];
        }

    }

    public static function getbookings()
    {
        $current_time = Carbon::now()->format("Y-m-d H:i:s");

        $booking = Booking::whereIn("status", [BookingEnums::$STATUS['biding'], BookingEnums::$STATUS['rebiding']])
                            ->where("bid_result_at", "<=", "$current_time") ->get();

        foreach($booking as $bid)
        {
            // $meta = json_decode($bid['meta'], true);
            // $bid_end_time = $meta['timings']['bid_result'];
            // if($bid_end_time == $current_time)
            // {
               $bid_end = Self::updateStatus($bid['id']);
            // }
        }

        return true;
    }

    public static function updateStatus($book_id)
    {
        $min_amount = Bid::where("booking_id", $book_id)->min('bid_amount');

        if(!$min_amount || $min_amount >= 2)
        {
            $order = Booking::where("id", $book_id)->first();

            $timming = Settings::where("key", "rebid_time")->pluck('value')[0];
            $complete_time = Carbon::now()->addMinutes($timming);

            $meta = json_decode($order['meta'], true);
            $meta['timings']['bid_result']= $complete_time->format("Y-m-d H:i:s");

            $addrebidtime = Booking::where(["user_id"=>$order->user_id,
                                            "public_booking_id"=>$order->public_booking_id])
                                            ->update(["status"=>BookingEnums::$STATUS['rebiding'], "meta" => json_encode($meta), "bid_result_at"=>$complete_time->format("Y-m-d H:i:s")]);
            $update_bid_type = Bid::where("booking_id",$book_id)->update("bid_type", BidEnums::$BID_TYPE['rebid']);

            return true;
        }

        $won_vendor = Bid::where(["booking_id"=>$book_id, "bid_amount"=>$min_amount])
                            ->update(["status"=>BidEnums::$STATUS['won']]);

        $lost_vendor = Bid::where(["booking_id"=>$book_id, "status"=>BidEnums::$STATUS['bid_submitted']])
                            ->update(["status"=>BidEnums::$STATUS['lost']]);



        $expire_vendor = Bid::where(["booking_id"=>$book_id, "status"=>BidEnums::$STATUS['active']])
                            ->update(["status"=>BidEnums::$STATUS['expired']]);

        $booking_update_status = Booking::where("id", $book_id)
                                        ->whereIn("status", [BookingEnums::$STATUS['biding'], BookingEnums::$STATUS['rebiding']])
                                        ->update([
                                            "final_quote"=>$min_amount,
                                            "status"=>BookingEnums::$STATUS['payment_pending']
                                        ]);

        $bookingstatus = new BookingStatus;
        $bookingstatus->booking_id = $book_id;
        $bookingstatus->status=BookingEnums::$STATUS['payment_pending'];
        $result_status = $bookingstatus->save();

        return true;
    }

    public static function submitBid($data, $org_id, $vendor_id)
    {
        $vendor = Vendor::where("id", $vendor_id)->first();

        if(!password_verify($data['pin'], $vendor->pin))
            return Helper::response(false,"Incorrect Pin entered");

        $exist_bid = Bid::where("organization_id", $org_id)
                            ->where("booking_id", Booking::where(['public_booking_id'=>$data['public_booking_id']])->pluck('id')[0])
                            ->where(["status"=>BidEnums::$STATUS['active']])
                            ->first();
        if(!$exist_bid)
            return Helper::response(false,"Not in active state");

        foreach($data['inventory'] as $key)
        {
            $inventory_price = new BidInventory;
            $inventory_price->booking_inventory_id = $key['booking_inventory_id'];
            $inventory_price->bid_id= Booking::where(['public_booking_id'=>$data['public_booking_id']])->pluck('id')[0];
            $inventory_price->amount=$key['amount'];
            $inventory_result = $inventory_price->save();
        }

        $meta = ["type_of_movement"=>$data['type_of_movement'], "moving_date"=>$data['moving_date'], "vehicle_type"=>$data['vehicle_type'], "min_man_power"=>$data['man_power']['min'], "max_man_power"=>$data['man_power']['max']];

        $submit_bid = Bid::where(["organization_id"=>$org_id, "id"=>$exist_bid['id'],"status"=>BidEnums::$STATUS['active']])->update([
            "vendor_id"=>$vendor_id,
            "bid_amount"=>$data['bid_amount'],
            "meta"=>json_encode($meta),
            "status"=>BidEnums::$STATUS['bid_submitted']
        ]);

        if(!$submit_bid)
            return Helper::response(false,"Couldn't Submit Quotaion");

        return Helper::response(true,"updated data successfully",["bid"=>Bid::findOrFail($exist_bid['id'])]);
    }

    public static function getPriceList($public_booking_id, $organization_id){

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
                ])->get();

                $list_item["bid_inventory_id"] = $booking_inventory["inventory_id"];
                $list_item["name"] = Inventory::where("id",$booking_inventory["inventory_id"])->pluck("name")[0];
                $list_item["material"] = $booking_inventory["material"];
                $list_item["size"] = $booking_inventory["size"];
                $list_item["price"] = sizeof($inv) > 0 ? $inv->$price_type : 0.00;

                array_push($price_list, $list_item);

                $total += sizeof($inv) > 0 ? $inv->$price_type : 0.00;

            }
        }
        return Helper::response(true,"Here is the pricelist",["price_list"=>[
            "inventories" => $price_list,
            "total"=>$total
        ]]);
    }
}
