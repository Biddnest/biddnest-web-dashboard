<?php

namespace App\Http\Controllers;

use App\Enums\CommonEnums;
use App\Helper;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\Organization;
use App\Enums\VendorEnums;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Bid;
use App\Models\BidInventory;
use App\Enums\BidEnums;
use Illuminate\Support\Facades\Session;

class VendorUserController extends Controller
{
    public function __construct(){

    }

    public static function login($username, $password)
{
    $vendor_user=Vendor::where(['username'=>$username])
        ->OrWhere(['email'=>$username])
        ->where([ 'status'=>1, 'deleted'=>0])
        ->with("organization")
        ->first();

    if(!$vendor_user)
        return Helper::response(false,"Incorrect username or password");

    // return password_verify($password, $admin_user->password) ? Helper::response(true, "Login was successfull", ["token"=>Helper::generateAuthToken(["email"=>$admin_user->email,"password"=>$password]),"expiry"=>CarbonImmutable::now()->add(365, 'day')]) : Helper::response(false, "password is incorrect");


    if(password_verify($password, $vendor_user->password))
    {
        Session::put(["account"=>['id'=>$vendor_user->id,
            'name'=>$vendor_user->fname.' '.$vendor_user->lname,
            'email'=>$vendor_user->email]]);
        Session::put('sessionActive', true);
        Session::put('user_role', $vendor_user->user_role);

        Session::put('organization', $vendor_user->organization->id);

        return Helper::response(true, "Login was successfull");
    }
    else{
        return Helper::response(false, "password is incorrect");
    }

}

    public static function loginForApp($username, $password)
{
    // $vendor_user=Vendor::where(['username'=>$username])
    //     ->OrWhere(['email'=>$username])
    //     ->where([ 'status'=>1, 'deleted'=>0])
    //     ->with("organization")
    //     ->first();

    $vendor_user=Vendor::where(['email'=>$username])
    ->where([ 'status'=>1, 'deleted'=>0])
    ->with("organization")
    ->first();


    if(!$vendor_user)
        return Helper::response(false,"Incorrect username or password");


    if(password_verify($password, $vendor_user->password))
    {
        $jwt_token = Helper::generateAuthToken(["email"=>$vendor_user->email,"id"=>$vendor_user->id, "organization_id"=>$vendor_user->organization->id]);
        return Helper::response(true, "Login was successfull",["vendor"=>$vendor_user,
            "token"=>$jwt_token, "expiry_on"=>CarbonImmutable::now()->add(365, 'day')->format("Y-m-d h:i:s")
        ]);
    }
    else{
        return Helper::response(false, "Incorrect password entered.");
    }

}

    public function logout(){}

    public static function resetPin($pin, $password, $id)
    {
        $vendor_user=Vendor::where(['id'=>$id])->first();

        if(password_verify($password, $vendor_user->password))
        {
            $create_pin = Vendor::where("id", $id)->update(["pin"=>password_hash($pin, PASSWORD_DEFAULT)]);
        }
        else
        {
            return Helper::response(false, "Incorrect password entered.");
        }

        return Helper::response(true, "Pin has been set successfully.");
    }

    public static function checkPin($id)
    {
        $vendor_user=Vendor::where('id', $id)->first();

        if(!$vendor_user['pin'])
            $set = false;
        else
            $set = true;

        return Helper::response(true, "Here is the Pin status.", ["pin"=>['set'=>$set]]);
    }

    public static function getUser($organization_id, $type)
    {
        $org = Organization::find($organization_id);

        if(!$org)
            return Helper::response(false, "Invalid organization id.");

        if(!$org->parent_org_id)
            $user_id = Vendor::where(function($query) use($organization_id){
                $query->where("organization_id", $organization_id);
                $query->orWhereIn('organization_id', Organization::where("parent_org_id", $organization_id)->pluck("id"));
            });
        else
            $user_id = Vendor::where("organization_id", $organization_id);

        switch ($type) {
            case "admin":
                $user_id->where("user_role", VendorEnums::$ROLES['admin']);
                break;

            case "manager":
                $user_id->where("user_role", VendorEnums::$ROLES['manager']);
                break;

            case "driver":
                $user_id->where("user_role", VendorEnums::$ROLES['driver']);
                break;
        }

        $users = $user_id->with('organization')->paginate(CommonEnums::$PAGE_LENGTH);

        return Helper::response(true, "Show data successfully", ["user_role" => $users->items(), "paging" => [
            "current_page" => $users->currentPage(), "total_pages" => $users->lastPage(), "next_page" => $users->nextPageUrl(), "previous_page" => $users->previousPageUrl()
        ]]);
    }
}
