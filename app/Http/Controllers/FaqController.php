<?php

namespace App\Http\Controllers;

use App\Enums\FaqEnums;
use App\Helper;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public static function add($title, $desc, $category){
        $faq = Faq::where("title", $title)->orWhere("desc",$desc)->first();

        if($faq)
            return Helper::response(false,"Title Description is already used.");

        $faq = new Faq();
        $faq->title = $title;
        $faq->desc = $desc;
        $faq->category = $category;

        if(!$faq->save())
            return Helper::response(false,"Couldn't save faq. Something went wrong. Contact Administrator");

        return Helper::response(true,"Faq has been added.",["faq"=>Faq::findOrFail($faq->id)]);
    }

    public static function update($id, $title, $desc, $category){
        $faq = Faq::find($id);

        if(!$faq)
            return Helper::response(false,"Invalid FAQ Id.");

        $update = Faq::where("id",$id)->update([
            "title"=>$title,
            "desc"=>$desc,
            "category"=>$category
        ]);

        if(!$update)
            return Helper::response(false,"Couldn't update faq. Something went wrong. Contact Administrator");

        return Helper::response(true,"Faq has been added.",["faq"=>Faq::findOrFail($faq->id)]);
    }

    public static function get(){
        return Helper::response(true,"Here are the FAQs",["faqs"=>Faq::all()]);
    }
    public static function getCategories(){
        return Helper::response(true,"Here are the FAQs",["faqs"=>["categories"=>FaqEnums::$CATEGORY_POOL]]);
    }

    public static function getByCategory($category){
        return Helper::response(true,"Here is the category.",["faqs"=>Faq::where("category",$category)->get()]);
    }

    public static function delete(){}
}
