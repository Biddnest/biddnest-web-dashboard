<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Helper;
use App\Sms;

class UserController extends Controller
{
    public static function get()
    {
        $users=DB::table('users')->select('*')->where(['status'=> 1, 'deleted'=>0])->get();
        if(!$users)
            return Helper::response(false,"Records not exist");
        else              
            return Helper::response(true,"Data displayed successfully", $users);
    }

    public static function add($name, $email, $phone, $gender, $dob)
    {
        $user=new User;
        $user->name=$name;
        $user->email=$email;
        $user->phone=$phone;
        $user->gender=$gender;
        $user->dob=$dob;
        $result= $user->save();

        if(!$result)
            return Helper::response(false,"Couldn't save data");
        else              
            return Helper::response(true,"save data successfully");
    }

    public static function getOne($id)
    {
        $result=DB::table('users')->select('*')->where('id', $id)->first();
        if(!$result)
            return Helper::response(false,"Couldn't Display data");
        else            
            return Helper::response(true,"Data Display successfully", $result);
    }

    public static function update($name, $email, $phone, $gender, $dob, $id)
    {
        $result=DB::update(
            'update users set name = ?, email=?, phone=?, gender=?, dob=? where id = ?',
            [$name, $email, $phone, $gender, $dob, $id]
        );

        if(!$result)
            return Helper::response(false,"Couldn't update data");
        else            
            return Helper::response(true,"Data updated successfully");
    }

    public static function delete($id)
    {
        $result=DB::update(
            'update users set deleted = ? where id = ?',
            [1, $id]
        );

        if(!$result)
            return Helper::response(false,"Couldn't Delete data $result");
        else           
            return Helper::response(true,"Data Deleted successfully");
    }
}
