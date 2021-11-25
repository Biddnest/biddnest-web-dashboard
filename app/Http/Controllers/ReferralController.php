<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReferralHistory;
use App\Enums\ReferralHistoryEnums;
use App\Enums\ReferralEnums;
use App\Http\Controllers\RewardPointController;

class ReferralController extends Controller
{
    public static function update(Request $request/*$zone_id, $reward_type, $reward_points, $voucher_id, $trigger_on*/){

        ZoneReferralReward::where("zone_id",$request->zone_id)->delete();

        $referral = new ZoneReferralReward;
        $referral->zone_id = $request->zone_id;
        $referral->reward_type = $request->referrer->reward_type;
        $referral->reward_points = $request->referrer->reward_type == ReferralEnums::$TYPE['points'] ? $request->referrer->reward_points : null;
        $referral->referrer->voucher_id = $request->referrer->voucher_id == ReferralEnums::$TYPE['voucher'] ? $request->referrer->voucher_id : null;
        $referral->meta = null;
        $referral->trigger_on = $request->referrer->trigger_on

        $referee = new ZoneReferralReward;
        $referee->zone_id = $request->zone_id;
        $referee->reward_type = $request->referee->reward_type;
        $referee->reward_points = $request->referee->reward_type == ReferralEnums::$TYPE['points'] ? $request->referee->reward_points : null;
        $referee->referee->voucher_id = $request->referee->voucher_id == ReferralEnums::$TYPE['voucher'] ? $request->referee->voucher_id : null;
        $referee->meta = null;
        $referee->trigger_on = $request->referee->trigger_on;

        if($referral->save() && $referee->save())
            return Helper::response(true,"Referral System has been updated.", [ "referral_system" => $referral ]);
        else
            return Helper::response(false,"Could'nt update referral system. Something went wrong.");
    }

    public static function checkTrigger($trigger_type, $referee){
        $refs = ReferralHistory::where("status",ReferralHistoryEnums::$STATUS['reward_pending'])
            ->where("trigger_at",$trigger_type)
            ->with("referrer")
            ->with("referee")
            ->first();

        if($refs){
            $zone_ref_rules = ZoneReferralReward::where("zone_id",$refs->zone_id)->get();
            if($zone_ref_rules){
                foreach ($zone_ref_rules as $rule) {
                    if ($rule->refferal_role == ReferralEnums::$ROLES['referer']) {
                        switch($rule->reward_type){
                            case ReferralEnums::$TYPE["points"]:
                                RewardPointController::deposit($refs->referrer->id,$rule->reward_points, ["desc","Bonus for referring friend."]);
                            break;
                            case ReferralEnums::$TYPE["voucher"]:
                                VoucherController::assignToUser($rule->voucher_id,$refs->referrer->id);
                            break;
                        }


                    }
                    if ($rule->refferal_role == ReferralEnums::$ROLES['referee']) {
                        switch($rule->reward_type){
                            case ReferralEnums::$TYPE["points"]:
                                RewardPointController::deposit($refs->referee->id,$rule->reward_points, ["desc","Bonus for referring friend."]);
                                break;
                            case ReferralEnums::$TYPE["voucher"]:
                                VoucherController::assignToUser($rule->voucher_id,$refs->referee->id);
                                break;
                        }
                    }
                }
            }else
                return false;
        }
        else{
            return false;
        }

    }
}


