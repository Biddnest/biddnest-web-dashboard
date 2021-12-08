<?php

namespace App\Http\Controllers;

use App\Enums\CommonEnums;
use App\Models\User;
use App\Helper;
use Bavix\Wallet\Models\Transaction;
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
        $comments = $comments && $comments != "" ? $comments : null;
        $withdraw = self::withdraw($user_id, $points, $comments ?: "Redemption again voucher.", true);

        if($withdraw) {
             $assign_coupon = VoucherController::assignToUser($voucher_id, $user_id, true);
            if($assign_coupon)
             return Helper::response(true, "Voucher has been assigned to this user.");
            else {
                $deposit = self::deposit($user_id, $points, $comments ?: "Refund against failed voucher assignation.", true);
                return Helper::response(false, "No more voucher codes are available to use. Couldn't assign voucher to user.");
            }
        }
        else
            return Helper::response(false, "There are not enough points in the users account to make this transaction.");
    }

    public static function getUserBalance(int $user_id){
        $user = User::find($user_id);

        if(!$user)
            return Helper::response(false, "This user doesnt exist.");

        return Helper::response(true, "Here are the wallet details.",["wallet"=>$user->getWallet("reward-points")]);
    }

    public static function getUserLedger(Request $request){
        $user = User::with("wallet")->find($request->token_payload->id);

        if(!$user)
            return Helper::response(false, "This user doesnt exist.");
        $transactions =     Transaction::where("wallet_id",$user->wallet->id)->orderBy("id","DESC")->paginate(CommonEnums::$PAGE_LENGTH);

        return Helper::response(true, "Here are the wallet details.",["ledger" =>
            $transactions->items(), "paging" => [
            "current_page" => $transactions->currentPage(), "total_pages" => $transactions->lastPage(), "next_page" => $transactions->nextPageUrl(), "previous_page" => $transactions->previousPageUrl()
        ]
        ]);
    }

}
