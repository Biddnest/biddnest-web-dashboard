<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\OneSignalPlayer;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public static function createNotification($for, $id, $title, $message){}

    public static function saveCustomerPlayer($player_id, $user_id){
        $player = OneSignalPlayer::where("user_id",$user_id)->pluck("player_id");

        if(!in_array($player, $player_id)){
            $player = new OneSignalPlayer;
            $player->user_id = $user_id;
            $player->player_id = $player_id;

            if(!$player->save())
                return Helper::response(false, "Player could not be added");
            else
                return Helper::response(false, "Player added successfully");
        }

            return Helper::response(true, "Player already exists.");

    }

    public static function saveVendorPlayer($player_id, $vendor_id){
        $player = OneSignalPlayer::where("vendor_id",$vendor_id)->pluck("player_id");

        if(!in_array($player, $player_id)){
            $player = new OneSignalPlayer;
            $player->vendor_id = $vendor_id;
            $player->player_id = $player_id;

            if(!$player->save())
                return Helper::response(false, "Player could not be added");
            else
                return Helper::response(false, "Player added successfully");
        }

            return Helper::response(true, "Player already exists.");

    }
}
