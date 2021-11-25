<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public static function update($zone_id, $reward_type, $reward_points, $voucher_id, $trigger_on){

        ZoneReferralReward::where("zone_id",$zone_id)->delete();

        $referral = new ZoneReferralReward;
        $referral->zone_id = $zone_id;
        $referral->reward_type = $reward_type;
        $referral->reward_points = $reward_type == ReferralEnums::$TYPE['points'] ? $reward_points : null;
        $referral->voucher_id = $voucher_id == ReferralEnums::$TYPE['voucher'] ? $voucher_id : null;
        $referral->meta = null;
        $referral->trigger_on = $trigger_on;

        if($referral->save)
            return Helper::response(true,"Referral System has been updated.", [ "referral_system" => $referral ]);
        else
            return Helper::response(false,"Could'nt update referral system. Something went wrong.");
    }

    public static function checkTrigger($user_id){

    }
}


