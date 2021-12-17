<?php

namespace App\Http\Controllers;

use App\Enums\BidEnums;
use App\Helper;
use App\Models\Bid;

class ReportController extends Controller
{
    public static function getReport($organization_id, $web=false)
    {
        $bid_won = Bid::where(["organization_id"=>$organization_id, "status"=>BidEnums::$STATUS['won']])->count();
        $bid_lost = Bid::where(["organization_id"=>$organization_id, "status"=>BidEnums::$STATUS['lost']])->count();
        $bid_participated = Bid::where(["organization_id"=>$organization_id, "status"=>BidEnums::$STATUS['bid_submitted']])->count();

        if($web)
            return ['won'=>$bid_won, 'lost'=>$bid_lost, 'participated'=>$bid_participated];
        else
            return Helper::response(true,"Show data successfully",['reports'=>['won'=>$bid_won, 'lost'=>$bid_lost, 'participated'=>$bid_participated]]);
    }
}
