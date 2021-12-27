<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

namespace App\Http\Controllers;

use App\Enums\BookingEnums;
use App\Enums\CommonEnums;
use App\Enums\CouponEnums;
use App\Enums\PayoutEnums;
use App\Helper;
use App\RazorpayX;
use App\Models\Booking;
use App\Models\Coupon;
use App\Models\Org_kyc;
use App\Models\Organization;
use App\Models\Payout;
use App\Models\Settings;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PayoutController extends Controller
{
    public static function disburse()
    {
        // $schedule_from = Carbon::parse('last sunday')->format("Y-m-d H:i:s");
        // $schedule_to = Carbon::parse('last saturday')->format("Y-m-d H:i:s");

      $payouts = Payout::where("dispatch_at", "<=", Carbon::now())->where("organization_id", 1)
            ->where("status", ">=", PayoutEnums::$STATUS['scheduled'])
            ->with(['organization'=>function($query){
                $query->with('kyc');
            }])
            ->get();

        if($payouts){

        $rx = new RazorpayX(Settings::where("key","razor_key")->pluck('value')[0], Settings::where("key","razor_secret")->pluck('value')[0]);

            foreach($payouts as $payout){

                if(!$payout->organization->parent_org_id){
                /*for parent organizations*/
                    $kyc = $payout->organization->kyc;
                    $fa = $payout->organization->rzp_fund_account_id;
                }else{
                    $kyc = Org_kyc::where('organization_id',$payout->organization->parent_org_id)->first();
                    $fa = Organization::where('id',$payout->organization->parent_org_id)->pluck("rzp_fund_account_id");
                }

                $payload = [
                    "account_number"=> "2323230021246890",
                    "fund_account_id"=> $fa,
                    "amount"=> $payout->final_payout * 100,
                    "currency"=> "INR",
                    "mode"=> "IMPS",
                    "purpose"=> "payout",
                    "queue_if_low_balance"=> true,
                    "reference_id"=> "Biddnest Payout ID #".$payout->public_payout_id,
                    "narration"=> $payout->remarks,
//                    "notes"=> $payout->meta
                    "notes"=> []
                ];

                /* $rx->payout();
                return $create = $rx->create($payload);*/
                $client = new client();
                $request_url = 'https://api.razorpay.com/v1/payouts/';
                try{
                    $response = $client->request('POST', $request_url, ['auth' => [Settings::where("key","razorpayx_key")->pluck('value')[0], Settings::where("key","razorpayx_secret")->pluck('value')[0]], 'json'=>$payload]);

                    if(json_decode($response->getBody(), true)['status']){

                        switch(json_decode($response->getBody(), true)['status']){
                            case "queued":
                                $status = PayoutEnums::$STATUS['queued'];
                                break;
                            default:
                                $status = PayoutEnums::$STATUS['processing'];
                                break;

                        }

                        $update_status = Payout::where("id",$payout->id)->update([
                            "status"=>$status
                        ]);

                    }
                } catch(ClientException $e){
                    return $e->getMessage();
                }
            }
            Helper::response(true, "payouts processed",['payouts'=>$payouts]);
        }

    }

    public static function schedulePayouts()
    {

        $distinct_orgs = Booking::where("status", BookingEnums::$STATUS['completed'])
            ->where("payout_processed", CommonEnums::$NO)
            ->whereNotNull('organization_id')
            ->distinct('organization_id')
            ->pluck('organization_id');

//        Log::critical((string)$distinct_orgs);


       foreach($distinct_orgs as $org_id){
           $bookings = Booking::where("status", BookingEnums::$STATUS['completed'])
               ->where("payout_processed", CommonEnums::$NO)
               ->where("organization_id", $org_id)
               ->with("payment")
               ->with('organization')
               ->get();


           if(count($bookings)){
               $payout_sub_total = 0.00;
               $payout_total = 0.00;


               foreach($bookings as $k=>$booking){
//               Log::critical("comm all bookings =====>>>>>>" . (string)$booking['organization']['commission']);

                   $commission = $booking['organization']['commission'];
                   $payout_sub_total += $booking['payment']['sub_total'];

                   $commission_amount = $booking['payment']['sub_total'] * ($commission/100);
                   $payout_total += $booking['payment']['sub_total'] - $commission_amount;
                   if($booking['payment']['coupon_code']){
                       $coupon = Coupon::where('code', $booking['payment']['coupon_code'])
//                       ->with('organizations')
                           ->first();
                       if($coupon->deduction_source == CouponEnums::$DEDUCTION_SOURCE['vendor']){
                           $discount_amount = CouponController::checkIfValid($booking['public_booking_id'],$coupon->code)['discount'];
                           $payout_total += $discount_amount;
                       }
                   }

                   Booking::where("id",$booking['id'])->update(["payout_processed"=> CommonEnums::$YES]);

               }

               if (isset($booking['payment'])){
                   $payout = new Payout();
                   $payout->dispatch_at = Carbon::now()->addMinutes(10)->format("Y-m-d H:i:s");
                   $payout_id = "BDPYT-".uniqid();
                   $payout->public_payout_id = strtoupper($payout_id);
                   $payout->organization_id=$org_id;
                   $payout->amount= $payout_sub_total;
                   $payout->commission= $payout_sub_total * ($commission/100);
                   $payout->commission_percentage = $commission;
                   $payout->final_payout=$payout_total*100;
                   $payout->meta = json_encode([
                       "total_bookings"=>count($bookings),
                       "affected_bookings"=>count($bookings),
                       "from_date"=>Carbon::parse("yesterday")->format("Y-m-d"),
                       "to_date"=>Carbon::parse("yesterday")->format("Y-m-d"),
                   ]);
                   $payout->status = PayoutEnums::$STATUS['scheduled'];
                   $payout->remarks = "Payout for ".Carbon::parse("yesterday")->format("Y-m-d");

                  if(!$payout->save())
                      return Helper::response(false, "Payouts not scheduled");
               }
           }
       }

       return Helper::response(true, "Payouts scheduled",['org_id'=>$distinct_orgs]);
    }

    public static function getByOrganization(Request $request, $web=false)
    {
        if($web)
            $organization_id = Session::get('organization_id');
        else
            $organization_id = $request->token_payload->organization_id;

        $payouts = Payout::where("organization_id", $organization_id);
        if($web)
        {
            if(isset($request->search)){
                $payouts=$payouts->where('public_payout_id', 'like', "%".$request->search."%");
            }
            if(isset($request->status)){
                $payouts=$payouts->where('status', $request->status);
            }
            if(isset($request->from) && isset($request->to)){
                $payouts->where('dispatch_at', '>=', $request->from)->where('dispatch_at', '<=', $request->to);
            }
        }
        $payouts=$payouts->paginate(CommonEnums::$PAGE_LENGTH);

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
        $payout_id = "BDPYT-".uniqid();

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

    /*RZP X Contorllers*/
    public static function registerContact($id){
        /*The $id here is the organization id*/
        $org = Organization::findOrFail($id);
        $payload = [
            "name"=>$org->org_name,
            "email"=>$org->email,
            "contact"=>$org->phone,
            "type"=>"employee",
            "reference_id" => "Vendor Organization ID #".$id,
            "notes" => json_decode($org->meta, true)
        ];

        $client = new client();
        $request_url = 'https://api.razorpay.com/v1/contacts/';
        try{
            $response = $client->request('POST', $request_url, ['auth' => [Settings::where("key","razorpayx_key")->pluck('value')[0], Settings::where("key","razorpayx_secret")->pluck('value')[0]], 'json'=>$payload]);

            Organization::where("id",$id)->update([
                "rzp_contact_id"=>json_decode($response->getBody(), true)['id']
            ]);

        } catch(ClientException $e){
            return $e->getMessage();
        }
    }

    public static function registerFundAccount($id){
        /*The $id here is the organization id*/
        $org = Organization::with('bank')->findOrFail($id);
        $payload = [
            "contact_id"=>$org->rzp_contact_id,
            "account_type"=>"bank_account",
            "bank_account"=>[
                "name"=>json_decode($org->bank->banking_details, true)['holder_name'],
                "ifsc"=>json_decode($org->bank->banking_details, true)['ifcscode'],
                "account_number"=>json_decode($org->bank->banking_details, true)['account_no']
            ],
        ];

        $client = new client();
        $request_url = 'https://api.razorpay.com/v1/fund_accounts/';
        try{
            $response = $client->request('POST', $request_url, ['auth' => [Settings::where("key","razorpayx_key")->pluck('value')[0], Settings::where("key","razorpayx_secret")->pluck('value')[0]], 'json'=>$payload]);

            Organization::where("id",$id)->update([
                "rzp_fund_account_id"=>json_decode($response->getBody(), true)['id']
            ]);

        } catch(ClientException $e){
            return $e->getMessage();
        }
    }
}
