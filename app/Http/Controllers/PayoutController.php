<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

namespace App\Http\Controllers;

use App\Enums\CommonEnums;
use App\Models\Organization;
use App\Models\Payout;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helper;
use Illuminate\Support\Facades\Session;

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

    public static function getByOrganization(Request $request, $web=false)
    {
        if($web)
            $organization_id = Session::get('organization_id');
        else
            $organization_id = $request->token_payload->organization_id;

        $payouts = Payout::where("organization_id", $organization_id)->paginate(CommonEnums::$PAGE_LENGTH);

        if (isset($request->from) && isset($request->to))
            $payouts->where('created_at', '>=', date("Y-m-d H:i:s", strtotime($request->from)))->where('created_at', '<=', date("Y-m-d H:i:s", strtotime($request->to)));

        if (isset($request->status))
            $payouts->where('status', $request->status);

//        $payouts = $payouts->paginate(CommonEnums::$PAGE_LENGTH);
        if($web)
            return $payouts;
        else
            return Helper::response(true, "Show data successfully", ["payouts" => $payouts->items(), "paging" => [
                "current_page" => $payouts->currentPage(), "total_pages" => $payouts->lastPage(), "next_page" => $payouts->nextPageUrl(), "previous_page" => $payouts->previousPageUrl()
            ]]);
    }

    public static function add($data)
    {
        $commision = Organization::where('id', $data['orgnizations'])->pluck('commission')[0];
        $meta =json_encode(["total_bookings"=>$data['no_of_orders'], "from_date"=>null, "to_date"=>null, "affected_bookings"=>null]);
        $payout_id = "BDPAYOUT-".uniqid();

        $payout =new Payout;
        $payout->public_payout_id=strtoupper($payout_id);
        $payout->organization_id=$data['orgnizations'];
        $payout->amount=$data['amount'];
        $payout->commission=$data['commission_amount'];
        $payout->commission_percentage=$commision;
        $payout->final_payout=$data['payout_amount'];
        $payout->dispatch_at=$data['payout_date'];
        $payout->meta=$meta;
        $payout->status=$data['status'];
        $payout->remarks=$data['desc'];
        $save_result =$payout->save();

        if(!$save_result)
            return Helper::response(false, "couldn't add record");

        return Helper::response(true, "add record successfully", ['payout'=>Payout::findOrFail($payout->id)]);
    }

    public static function update($data)
    {
        $payout_exist =Payout::where('id', $data['id'])->first();
        if(!$payout_exist)
            return Helper::response(false, "Data doesn't exist");

        $commision = Organization::where('id', $data['orgnizations'])->pluck('commission')[0];
        $meta =json_encode(["total_bookings"=>$data['no_of_orders'], "from_date"=>null, "to_date"=>null, "affected_bookings"=>null]);

        $update_result =Payout::where('id', $data['id'])->update([
            "organization_id"=>$data['orgnizations'],
            "amount"=>$data['amount'],
            "commission"=>$data['commission_amount'],
            "commission_percentage"=>$commision,
            "final_payout"=>$data['payout_amount'],
            "dispatch_at"=>$data['payout_date'],
            "meta"=>$meta,
            "status"=>$data['status'],
            "remarks"=>$data['desc']
        ]);

        if(!$update_result)
            return Helper::response(false, "couldn't update record");

        return Helper::response(true, "Updated record successfully", ['payout'=>Payout::findOrFail($data['id'])]);
    }
}
