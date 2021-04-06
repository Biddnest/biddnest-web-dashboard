<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

namespace App\Http\Controllers;

use App\Enums\CommonEnums;
use App\Models\Payout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helper;

class PayoutController extends Controller
{
    public static function schedule()
    {
        $schedule_from = Carbon::parse('last sunday')->format("Y-m-d H:i:s");
        $schedule_to = Carbon::parse('last saturday')->format("Y-m-d H:i:s");

        $bookings = Booking::where("created_at", ">=", $schedule_from)
            ->where("created_at", ">=", $schedule_from)
            ->get();


    }

    public static function getByOrganization(Request $request)
    {
        $payouts = Payout::where("organization_id", $request->token_payload->organization_id)->paginate(CommonEnums::$PAGE_LENGTH);

        return Helper::response(true, "Show data successfully", ["payouts" => $payouts->items(), "paging" => [
            "current_page" => $payouts->currentPage(), "total_pages" => $payouts->lastPage(), "next_page" => $payouts->nextPageUrl(), "previous_page" => $payouts->previousPageUrl()
        ]]);
    }


}
