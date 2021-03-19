<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\MovementDates;
use App\Models\BookingInventory;
use App\Models\BookingStatus;
use App\Models\Organization;
use App\Models\Bid;
use App\Models\BidInventory;
use App\Helper;
use App\Enums\CommonEnums;
use App\Enums\BookingEnums;
use App\Enums\ServiceEnums;
use App\Enums\BidEnums;


class BidController extends Controller
{
    public static function addvendors($booking_id)
    {
        try {
            $vendorlist = Organization::where(["status"=>CommonEnums::$YES, "deleted"=>CommonEnums::$NO])->get();

            $update_status = Booking::where("id", $booking_id)->update("status", BookingEnums::$STATUS['biding']);

            foreach($vendorlist as $vendor)
            {
                $bid = new Bid;
                $bid->booking_id=$booking_id;
                $bid->org_id=$vendor['id'];
                $bid->bid_type=BidEnums::$BID_TYPE['bid'];
                $bid->status=BidEnums::$STATUS['active'];
                $bid_result = $bid->save();
            }

            return true;

        } catch (\Exception $e) {
            return [false, "error"=>$e->getMessage()];
        }

    }
}
