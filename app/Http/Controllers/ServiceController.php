<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public static function add($name)
    {
        $service=new Service;
        $service->name=$name;
        $result= $service->save();

        if(!$result)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"save data successfully");
    }

    public static function get($page)
    {
        $service=DB::table('services')->select('*')->where(['status'=> 1, 'deleted'=>0])->get();
        if(!$service)
            return Helper::response(false,"Records not exist");
        else
            return Helper::response(true,"Data displayed successfully", $service);
    }

    public static function update($name, $id)
    {
        $result=DB::update(
            'update services set name = ? where id = ?',
            [$name, $id]
        );

        if(!$result)
            return Helper::response(false,"Couldn't update data");
        else
            return Helper::response(true,"Data updated successfully");
    }

    public static function getOne($id)
    {
        $result=DB::table('services')->select('*')->where('id', $id)->first();

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", $result);
    }

    public static function delete($id)
    {
        $result=DB::update(
            'update services set deleted = ? where id = ?',
            [1, $id]
        );

        if(!$result)
            return Helper::response(false,"Couldn't Delete data $result");
        else
            return Helper::response(true,"Data Deleted successfully");
    }
}
