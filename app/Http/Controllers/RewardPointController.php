<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RewardPointController extends Controller
{
    public function deposit($user_id, $points, $comment = null){
        $user = User::with("wallet")->find($user_id);
        if(!$user)
            return Helper::response(false, "This user doesnt exist");

        $user->deposit($points, ["desc"=>$comment]);
        return Helper::response(true, "Money has been added.",["wallet"=>$user->getWallet("reward-points")]);
    }

    public function withdraw($user_id, $points, $comment=null, $output_bool = false){
        $user = User::with("wallet")->find($user_id);
        if(!$user)
            return $output_bool ? false: Helper::response(false, "This user doesnt exist");

        if($user->wallet->balance < $points)
            return $output_bool ? false: Helper::response(false, "There are no enough points in the users account to make this transaction.");


        $user->withdraw($points, ["desc"=>$comment]);

        return $output_bool ? true: Helper::response(true, "Money has been added.",["wallet"=>$user->getWallet("reward-points")]);
    }

    public function redeem($user_id, $points, $voucher_id, $comments = null){
        $withdraw = self::withdraw($user_id, $points, $comments, true);

        if($withdraw) {
             $assign_coupon = VoucherController::assignToUser($voucher_id, $user_id);
            return Helper::response(true, "Voucher has been assigned to this user.");
        }
        else
            return Helper::response(false, "There are no enough points in the users account to make this transaction.");
    }

}
