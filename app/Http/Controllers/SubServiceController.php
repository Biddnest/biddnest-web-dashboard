<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Subservice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubServiceController extends Controller
{
    public static function get($page)
    {
        $subservice=DB::table('subservices')->select('*')->where(['status'=> 1, 'deleted'=>0])->get();
        if(!$subservice)
            return Helper::response(false,"Records not exist");
        else
            return Helper::response(true,"Data displayed successfully", $subservice);
    }

    public static function add($name, $service_id)
    {
        $subservice=new Subservice;
        $subservice->name=$name;
        $subservice->service_id=$service_id;
        $result= $subservice->save();

        if(!$result)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"save data successfully");
    }

    public static function update($name, $service_id, $id)
    {
        $result=DB::update(
            'update subservices set name = ?, service_id=? where id = ?',
            [$name, $service_id, $id]
        );

        if(!$result)
            return Helper::response(false,"Couldn't update data");
        else
            return Helper::response(true,"Data updated successfully");
    }

    public static function getOne($id)
    {
        $result=DB::table('subservices')->select('*')->where('id', $id)->first();
        if(!$result)
            return Helper::response(false,"Couldn't display data");
        else
            return Helper::response(true,"Data display successfully", $result);
    }

    public static function delete($id)
    {
        $result=DB::update(
            'update subservices set deleted = ? where id = ?',
            [1, $id]
        );

        if(!$result)
            return Helper::response(false,"Couldn't Delete data $result");
        else
            return Helper::response(true,"Data Deleted successfully");
    }
}
