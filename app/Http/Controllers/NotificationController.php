<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

namespace App\Http\Controllers;

use App\Enums\CommonEnums;
use App\Enums\NotificationEnums;
use App\Helper;
use App\Models\Notification;
use App\Models\OneSignalPlayer;
use App\Models\User;
use App\Models\Vendor;
use App\PushNotification;
use http\Env\Response;

class NotificationController extends Controller
{
    public static function createNotification($title, $for, $desc, $selected_user=null, $selected_vendor=null)
    {

        switch ($for){
            case NotificationEnums::$RECEPIENT_TYPE['customer']:

                foreach ($selected_user as $singleUser){
                    $notification =new Notification;
                    $notification->title=$title;
                    $notification->for=$for;
                    $notification->desc=$desc;
                    $notification->vendor_id=$singleUser;
                    $notification->generated_by = NotificationEnums::$GENERATE_BY['admin'];
                    $push_notification = $notification->save();

                    if (!$push_notification)
                        return Helper::response(false, "Notification could not be added");
                }

                dispatch(NotificationController::sendTo("user", $selected_user, $title, $desc, ["type"=>NotificationEnums::$TYPE['general']]))->afterResponse();

            break;

            case NotificationEnums::$RECEPIENT_TYPE['active_customers']:

                $users = User::where(["status" => CommonEnums::$YES, "deleted" => CommonEnums::$NO])->pluck('id');

                $notification =new Notification;
                $notification->title=$title;
                $notification->for="active_customers";
                $notification->desc=$desc;
//                $notification->vendor_id=null;
                $notification->generated_by=NotificationEnums::$GENERATE_BY['admin'];
                $push_notification = $notification->save();

                if (!$push_notification)
                    return Helper::response(false, "Notification could not be added");

                dispatch(NotificationController::sendTo("user", $users, $title, $desc, ["type"=>NotificationEnums::$TYPE['general']]))->afterResponse();
            break;

            case NotificationEnums::$RECEPIENT_TYPE['vendor']:
                $vendors =Vendor::whereIn("organization_id", $selected_vendor)->where(['deleted'=>CommonEnums::$NO])->pluck('id');
                foreach ($vendors as $singleVendor){
                    $notification =new Notification;
                    $notification->title=$title;
                    $notification->for=$for;
                    $notification->desc=$desc;
                    $notification->vendor_id=$singleVendor;
                    $notification->generated_by = NotificationEnums::$GENERATE_BY['admin'];
                    $push_notification = $notification->save();

                    if (!$push_notification)
                        return Helper::response(false, "Notification could not be added");
                }

                dispatch(NotificationController::sendTo("vendor", $vendors, $title, $desc, ["type"=>NotificationEnums::$TYPE['general']]))->afterResponse();
            break;

            case NotificationEnums::$RECEPIENT_TYPE['active_vendors']:
                $vendors = Vendor::where(['deleted' => CommonEnums::$NO])->pluck('id');

                $notification =new Notification;
                $notification->title=$title;
                $notification->for="active_vendors";
                $notification->desc=$desc;
//                $notification->vendor_id=null;
                $notification->generated_by=NotificationEnums::$GENERATE_BY['admin'];
                $push_notification = $notification->save();

                if (!$push_notification)
                    return Helper::response(false, "Notification could not be added");

                dispatch(NotificationController::sendTo("vendor", $vendors, $title, $desc, ["type"=>NotificationEnums::$TYPE['general']]))->afterResponse();
            break;
            default:
                return Helper::response(false, "Incorrect Recipient type",null);
        }

        return Helper::response(true, "Notification will be sent under in a minute.");

    }

    public static function saveCustomerPlayer($player_id, $user_id)
    {
        $user = User::find($user_id);
        if(!$user)
            return Helper::response(true, "This user doesn't exist.",[],401);

        $player = OneSignalPlayer::where("user_id", $user_id)->where("player_id", $player_id)->first();

        if (!$player) {

            OneSignalPlayer::where('player_id', $player_id)->where("vendor_id", null)->where("user_id", "!=", $user_id)->delete();

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
        $vendor = Vendor::find($vendor_id);
        if(!$vendor)
            return Helper::response(true, "This vendor doesnot exist.",[],401);

        $player = OneSignalPlayer::where("vendor_id", $vendor_id)->where("player_id", $player_id)->first();

        OneSignalPlayer::where('player_id', $player_id)
            ->where("user_id", null)
            ->where("vendor_id", "!=", $vendor_id)
            ->delete();

        if (!$player) {
            $player = new OneSignalPlayer;
            $player->user_id = null;
            $player->vendor_id = $vendor_id;
            $player->player_id = $player_id;

            if (!$player->save())
                return Helper::response(false, "Player could not be added");
            else
                return Helper::response(true, "Player added successfully", ["player_id" => $player_id]);
        }

        return Helper::response(true, "Player already exists.", ["player_id" => $player_id]);
    }

    public static function sendTo($type, $user_id, $title, $desc, $data, $url = null){
        //$type = "user" / "vendor
           if(count($user_id) < 1)
               return false;

//           return $user_id;
           foreach ($user_id as $user)
           {
               if($user) {
                   $save_notification = new Notification;

                   if ($type == "user")
                       $save_notification->user_id = $user;
                   else
                       $save_notification->vendor_id = $user;

                   $save_notification->for = $type;
                   $save_notification->title = $title;
                   $save_notification->desc = $desc;
                   $save_notification->url = $url;
                   $save_notification->generated_by = NotificationEnums::$GENERATE_BY['system'];
                   $save_notification->save();
               }
           }

        $players=[];
        foreach($user_id as $user) {
//            $players[] = (string) $user;
            if ($type == "user") {
                $pids = OneSignalPlayer::where("user_id", $user)->pluck("player_id");
                foreach ($pids as $pid) {
                    $players[] = $pid;
                }
            } else {
                $pids = OneSignalPlayer::where("vendor_id", $user)->pluck("player_id");
                foreach ($pids as $pid) {
                    $players[] = $pid;
                }
            }
        }

        return PushNotification::sendToUsers("$type", $title, $desc, $players, $data,$url);
    }


}
