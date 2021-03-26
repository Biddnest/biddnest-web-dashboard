<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\OneSignalPlayer;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public static function createNotification($for, $id, $title, $message)
    {
    }

    public static function saveCustomerPlayer($player_id, $user_id)
    {
//        return "hai";
        $player = OneSignalPlayer::where("user_id", $user_id)->where("player_id", $player_id)->first();

        if (!$player) {
            $player = new OneSignalPlayer;
            $player->user_id = $user_id;
            $player->vendor_id = null;
            $player->player_id = $player_id;

            if (!$player->save())
                return Helper::response(false, "Player could not be added");
            else
                return Helper::response(true, "Player added successfully", ["player_id" => $player_id]);
        }

        return Helper::response(true, "Player already exists.", ["player_id" => $player_id]);

    }

    public static function saveVendorPlayer($player_id, $vendor_id)
    {
        $player = OneSignalPlayer::where("user_id", $vendor_id)->where("player_id", $player_id)->first();

        if (!$player) {
            $player = new OneSignalPlayer;
            $player->user_id = vendor_id;
            $player->vendor_id = null;
            $player->player_id = $player_id;

            if (!$player->save())
                return Helper::response(false, "Player could not be added");
            else
                return Helper::response(true, "Player added successfully", ["player_id" => $player_id]);
        }

        return Helper::response(true, "Player already exists.", ["player_id" => $player_id]);
    }

    public static function send(){
        
    }

}
