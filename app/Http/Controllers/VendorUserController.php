<?php

namespace App\Http\Controllers;

use App\Enums\CommonEnums;
use App\Helper;
use App\Models\Vendor;
use App\Models\Organization;
use App\VendorEnums;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Bid;
use App\Models\BidInventory;
use App\Enums\BidEnums;

class VendorUserController extends Controller
{
    public function __construct(){

    }

    public static function login($username, $password)
    {
        $admin_user=Vendor::where(['email'=>$username])
            ->where(['deleted'=>CommonEnums::$NO])
            ->first();

        if(!$admin_user)
            return Helper::response(false,"Incorrect username or password");

        if($admin_user->status == VendorEnums::$STATUS['suspended'])
            return Helper::response(false,"Your account has been suspended by your organization. Please Contant your admin.");

            return password_verify($password, $admin_user->password) ? Helper::response(true, "Login was successfull", ["token"=>Helper::generateAuthToken(["email"=>$admin_user->email,"password"=>$password]),"expiry"=>CarbonImmutable::now()->add(365, 'day')]) : Helper::response(false, "password is incorrect");

    }

    public function logout(){}

    public static function getBidList($id)
    {
        $exist_bid = Bid::where("organization_id", $id)
                            ->get();
        return Helper::response(true,"Show data successfully",["bidlist"=>$exist_bid]);
    }

    public static function addBookmark($data)
    {
        $exist_bid = Bid::where("organization_id", $data['org_id'])
                            ->where("id", $data['bid_id'])
                            ->where(["status"=>BidEnums::$STATUS['active']])
                            ->get();
        if(!$exist_bid)
            return Helper::response(false,"Not in active state");
        
        $result = Bid::where(['id'=>$data['bid_id']])
                        ->update(["bookmarked"=>CommonEnums::$YES, "vendor_id"=>$data['vendor_id']]);
        
        if(!$result)
            return Helper::response(false,"Couldn't Add to Bookmark");

        return Helper::response(true,"updated data successfully",["bookmark"=>Bid::where("id", $data['bid_id'])->first()]);
    }

    public static function getBookmark($id)
    {
        $exist_bid = Bid::where(['organization_id'=>$id, 'bookmarked'=>CommonEnums::$YES])->get();

        if(!$exist_bid)
            return Helper::response(false,"Couldn't show to Bookmark");

        return Helper::response(true,"Show data successfully",["bookmark"=>$exist_bid]);
    }

    public static function reject($bid_id, $org_id, $vendor_id)
    {
        $exist_bid = Bid::where("organization_id", $org_id)
                            ->where("id", $bid_id)
                            ->where(["status"=>BidEnums::$STATUS['active']])
                            ->first();
        if(!$exist_bid)
            return Helper::response(false,"Not in active state");

        if($exist_bid['bookmarked'] == CommonEnums::$YES)
            $bookmark = Bid::where(['id'=>$exist_bid['id']])->update(["bookmarked"=>CommonEnums::$NO]);
        
        $reject = Bid::where(['id'=>$exist_bid['id']])->update(["status"=>BidEnums::$STATUS['rejected'], "vendor_id"=>$vendor_id]);
        
        if(!$reject)
            return Helper::response(false,"Couldn't Reject");

        return Helper::response(true,"updated data successfully",["bid"=>Bid::FindOrFail($exist_bid['id'])]);
    }

    public static function submitbid($data)
    {
        $exist_bid = Bid::where("organization_id", $data['org_id'])
                            ->where("id", $data['bid_id'])
                            ->where(["status"=>BidEnums::$STATUS['active']])
                            ->first();
        if(!$exist_bid)
            return Helper::response(false,"Not in active state");

        foreach($data['inventory'] as $key)
        {
            $inventory_price = new BidInventory;
            $inventory_price->booking_inventory_id = $key['booking_inventory_id'];
            $inventory_price->bid_id= $data['bid_id'];
            $inventory_price->amount=$key['amount'];
            $inventory_result = $inventory_price->save();
        }

        $meta = ["type_of_movement"=>$data['type_of_movement'], "moving_date"=>$data['moaving_date'], "vehicle_type"=>$data['vehicle_type'], "min_man_power"=>$data['man_power']['min'], "max_man_power"=>$data['man_power']['max']];

        $submit_bid = Bid::where(["organization_id"=>$data['org_id'], "id"=>$data['bid_id'],"status"=>BidEnums::$STATUS['active']])->update([
            "vendor_id"=>$data['vendor_id'],
            "bid_amount"=>$data['bid_amount'],
            "meta"=>json_encode($meta),
            "status"=>BidEnums::$STATUS['bid_submitted']
        ]);

        if(!$submit_bid)
            return Helper::response(false,"Couldn't Submit Quotaion");

        return Helper::response(true,"updated data successfully",["bid"=>Bid::FindOrFail($exist_bid['id'])]);
    }
}
