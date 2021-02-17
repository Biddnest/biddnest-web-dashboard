<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public static function inventories()
    {
        $inventories=DB::table('inventories')->select('*')->where(['status'=> 1, 'deleted'=>0])->get();
        if(!$inventories)
            return Helper::response(false,"Records not exist");
        else
            return Helper::response(true,"Data displayed successfully", $inventories);
    }

    public static function inventoriesAdd($name, $subservice_id, $material, $image)
    {


        $inventory=new Inventory;
        $inventory->name=$name;
        $inventory->sub_service_id=$subservice_id;
        $inventory->material=$material;
        $inventory->image=$image;
        $result= $inventory->save();

        if(!$result)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"save data successfully");
    }

    public static function inventoriesEdit($name, $subservice_id, $material, $image, $id)
    {
        $result=DB::update(
            'update inventories set name = ?, sub_service_id=?, material=?, image=? where id = ?',
            [$name, $subservice_id, $material, $image, $id]
        );

        if(!$result)
            return Helper::response(false,"Couldn't update data");
        else
            return Helper::response(true,"Data updated successfully");
    }

    public static function inventoriesGet($id)
    {
        $result=DB::table('inventories')->select('*')->where('id', $id)->first();
        if(!$result)
            return Helper::response(false,"Couldn't Display data");
        else
            return Helper::response(true,"Data Display successfully", $result);
    }

    public static function inventoriesDelete($id)
    {
        $result=DB::update(
            'update inventories set deleted = ? where id = ?',
            [1, $id]
        );

        if(!$result)
            return Helper::response(false,"Couldn't Delete data $result");
        else
            return Helper::response(true,"Data Deleted successfully");
    }
}
