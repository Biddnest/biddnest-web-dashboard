<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Bid;
use App\Enums\BookingEnums;
use App\Enums\BidEnums;
use App\Helper;

class ReportController extends Controller
{
    public static function getReport($organization_id)
    {
        return $bid_won = Bid::where(["organization_id"=>$organization_id, "status"=>BidEnums::$STATUS['won']])->count();
        $bid_lost = Bid::where(["organization_id"=>$organization_id, "status"=>BidEnums::$STATUS['lost']])->count();
        $bid_participated = Bid::where(["organization_id"=>$organization_id, "status"=>BidEnums::$STATUS['bid_submitted']])->count();

        return Helper::response(true,"Show data successfully",['reports'=>['won'=>$bid_won, 'lost'=>$bid_lost, 'participated'=>$bid_participated]]);
    }
}
