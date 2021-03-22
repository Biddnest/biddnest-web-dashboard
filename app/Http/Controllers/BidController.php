<?php

namespace App\Http\Controllers;

use App\Models\BookingInventory;
use App\Models\Inventory;
use App\Models\InventoryPrice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\BookingStatus;
use App\Models\Organization;
use App\Models\Bid;
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
        $current_time = Carbon::now()->format("Y-m-d H:i");

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
            $meta['timings']['bid_result']= $complete_time->format("Y-m-d H:i");

            $addrebidtime = Booking::where(["user_id"=>$order->user_id,
                                            "public_booking_id"=>$order->public_booking_id])
                                            ->update(["status"=>BookingEnums::$STATUS['rebiding'], "meta" => json_encode($meta), "bid_result_at"=>$complete_time->format("Y-m-d H:i")]);
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

    public function getPriceList($public_booking_id, $organization_id){

        $booking = Bid::where(["booking_id",Booking::where("public_booking_id")->pluck("id")[0]])->with("inventories")->first();
        if(!$booking)
            return false;

        $price_list = [];
        $total = 0;
        $price_type = $booking->booking_type == BookingEnums::$BOOKING_TYPE["economic"] ? "price_economics" : "price_premium" ;
        if($booking->booking_inventory){
        foreach($booking->inventories as $booking_inventory){
            $inv = InventoryPrice::where([
                "inventory_id"=>$booking_inventory["inventory_id"],
                "material"=>$booking_inventory["material"],
                "size"=>$booking_inventory["size"],
                "organizaton_id"=>$organization_id
            ])->get();

            $price_list[]["bid_inventory_id"] = $booking_inventory["inventory_id"];
            $price_list[]["name"] = Inventory::where("id",$booking_inventory["inventory_id"])->pluck("name")[0];
            $price_list[]["material"] = $booking_inventory["material"];
            $price_list[]["size"] = $booking_inventory["size"];
            $price_list[]["price"] = $inv ? $inv[$price_type] : 0.00;

            $total += $inv ? $inv[$price_type] : 0.00;

            }
        }
        return Helper::response(true,"Here is the pricelist",["price_list"=>[
            "inventories" => $price_list,
            "total"=>$total
        ]]);
    }
}
