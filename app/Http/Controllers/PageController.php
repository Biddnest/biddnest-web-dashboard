<?php

namespace App\Http\Controllers;

use App\Enums\CommonEnums;
use App\Helper;
use App\Models\Page;
use App\Models\Settings;

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
        $contact = json_decode(Settings::where("key", "contact_details")->pluck('value')[0], true);

        return Helper::response(true, "Contact details dispaly successfully.", ["details"=>$contact]);
    }

    public static function add($name, $slug, $content)
    {
        $page =new Page;
        $page->title=$name;
        $page->slug=$slug;
        $page->content=$content;
        $save_rsult =$page->save();

        if(!$save_rsult)
            return Helper::response(false, "couldn't add page");

        return Helper::response(true, "page added successfully", ['page'=>Page::findOrFail($page->id)]);
    }

    public static function updatePage($id, $name, $slug, $content)
    {
        $exist =Page::where('id', $id)->first();

        if(!$exist)
            return Helper::response(false, "review doesn't exist");

        $update_rsult=Page::where("id",$id)->update([
            "title"=>$name,
            "slug"=>$slug,
            "content" => $content
        ]);

        if(!$update_rsult)
            return Helper::response(false, "couldn't updated page");

        return Helper::response(true, "page updated successfully", ['page'=>Page::findOrFail($id)]);
    }

    public static function delete($id)
    {
        $update_rsult=Page::where("id",$id)->update([
            "deleted"=>CommonEnums::$YES
        ]);

        if(!$update_rsult)
            return Helper::response(false, "couldn't Delete page");

        return Helper::response(true, "page Deleted successfully");
    }
}
