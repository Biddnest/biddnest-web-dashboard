<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Page;
use App\Models\Settings;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public static function update($slug, $content){
        Page::where("slug",$slug)->update(["content" => $content]);
        return Helper::response(true, "Page has been updated.");
    }

    public static function get($slug){
        return Helper::response(true, "Here is the data",["page"=> Page::where("slug",$slug)->first()]);
    }

    public static function contactUs()
    {
        return $contact = Settings::where("key", "contact_details")->pluck('value')[0]['contact_no'];

        return Helper::response(true, "Contact details dispaly successfully.", ["contact_no"=>$contact]);
    }
}
