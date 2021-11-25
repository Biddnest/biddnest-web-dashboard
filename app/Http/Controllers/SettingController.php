<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Settings;

class SettingController extends Controller
{
    public static function update_contact($phone, $email, $address)
    {
        $contact =json_encode(["contact_no"=>$phone, "email_id"=>$email, "address"=>$address]);

        $update =Settings::where('key', "contact_details")->update([
           "value"=>$contact
        ]);

        if(!$update)
            return Helper::response(false,"Couldn't update contact details Something went wrong.");

        return Helper::response(true,"contact details has been updated.");
    }

    public static function update_api_general($data)
    {
        $api_settings=Settings::whereNotIn('key', ["contact_details", "msg91_key", "google_api_key", "razor_key", "razor_secret", "razor_webhook_secret", "onesignal_user_app_creds", "onesignal_vendor_app_creds", "razorpayx_key", "razorpayx_secret", "msg91_sender_id"])->pluck('id');

        foreach ($api_settings as $key)
        {
            $update =Settings::where('id', "$key")->update([
                "value"=>$data['key_'.$key]
            ]);
        }

        if(!$update)
            return Helper::response(false,"Couldn't update API keys Something went wrong.");

        return Helper::response(true,"API keys has been updated.");

    }

    public static function update_api($data)
    {
        $api_settings=Settings::whereNotIn('key', ["contact_details"])->whereIn('key', ["msg91_key", "google_api_key", "razor_key", "razor_secret", "razor_webhook_secret", "onesignal_user_app_creds", "onesignal_vendor_app_creds", "razorpayx_key", "razorpayx_secret", "msg91_sender_id"])->pluck('id');

        foreach ($api_settings as $key)
        {
            $update =Settings::where('id', "$key")->update([
                "value"=>$data['key_'.$key]
            ]);
        }

        if(!$update)
            return Helper::response(false,"Couldn't update API keys Something went wrong.");

        return Helper::response(true,"API keys has been updated.");

    }
}
