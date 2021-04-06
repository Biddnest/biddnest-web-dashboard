<?php

namespace App\Http\Controllers;

use App\Enums\CommonEnums;
use App\Helper;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\Organization;
use App\Models\OrganizationService;
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

    public static function getUser(Request $request)
    {
        $org = Organization::find($request->token_payload->organization_id);

        if(!$org)
            return Helper::response(false, "Invalid organization id.");

        if (isset($request->branch)) {
            $user_id = Vendor::where('organization_id', Organization::where("id", $request->branch)->pluck("id"));
        }
        else {
            if (!$org->parent_org_id) {
                $organization_id = $request->token_payload->organization_id;
                $user_id = Vendor::where(function ($query) use ($organization_id) {
                    $query->where("organization_id", $organization_id);
                    $query->orWhereIn('organization_id', Organization::where("parent_org_id", $organization_id)->pluck("id"));
                });
            }
            else
                $user_id = Vendor::where("organization_id", $request->token_payload->organization_id);
        }
        switch ($request->type) {
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

        if (isset($request->status))
            $user_id->where('status',$request->status);


        $users = $user_id->with('organization')->paginate(CommonEnums::$PAGE_LENGTH);

        return Helper::response(true, "Show data successfully", ["user_role" => $users->items(), "paging" => [
            "current_page" => $users->currentPage(), "total_pages" => $users->lastPage(), "next_page" => $users->nextPageUrl(), "previous_page" => $users->previousPageUrl()
        ]]);
    }

    public static function updateStatus(Request $request)
    {
         $update_status = Vendor::where('id',$request->id)->update(["status"=>$request->status]);
         if(!$update_status)
             return Helper::response(false, "failed to updated status");

         return Helper::response(true, "status updated successfully");
    }

    public static function updateOrganization($vendor_id, $orgnization_id, $orgnization_name, $organization_desc, $secondory_cont_no, $gstin_no)
    {
        $vendor_role = Vendor::where('id', $vendor_id)->pluck('user_role')[0];

        if($vendor_role == VendorEnums::$ROLES['admin'])
        {
            $exist = Organization::where('id', $orgnization_id)->first();

            if (!$exist)
                return Helper::response(false, "organization is not Exist");

            $meta = json_decode($exist['meta'], true);
            $meta['org_description'] = $organization_desc;
            $meta['secondory_phone'] = $secondory_cont_no;
            $meta['gstin_no'] = $gstin_no;

            $update = Organization::where('id', $orgnization_id)
                ->update([
                   'org_name'=> $orgnization_name,
                    'meta'=>json_encode($meta)
                ]);

            if (!$update)
                return Helper::response(false, "Couldn't update data");

            return Helper::response(true, "updated data successfully", ["orgnization" => Organization::findOrFail($orgnization_id)]);
        }
    }

    public static function updateLocation($vendor_id, $orgnization_id, $address_line1, $address_line2, $landmark, $city, $state, $pincode)
    {
        $vendor_role = Vendor::where('id', $vendor_id)->pluck('user_role')[0];

        if($vendor_role == VendorEnums::$ROLES['admin'])
        {
            $exist = Organization::where('id', $orgnization_id)->first();

            if (!$exist)
                return Helper::response(false, "organization is not Exist");

            $meta = json_decode($exist['meta'], true);
            $meta['address_line_1'] = $address_line1;
            $meta['address_line_2'] = $address_line2;
            $meta['landmark'] = $landmark;

            $update = Organization::where('id', $orgnization_id)
                ->update([
                    'city'=> $city,
                    'state'=> $state,
                    'pincode'=> $pincode,
                    'meta'=>json_encode($meta)
                ]);

            if (!$update)
                return Helper::response(false, "Couldn't update data");

            return Helper::response(true, "updated data successfully", ["orgnization" => Organization::findOrFail($orgnization_id)]);
        }
    }

    public static function updateDetails($vendor_id, $orgnization_id, $services, $commission, $status, $service_type, $vendor_status)
    {
        $vendor_role = Vendor::where('id', $vendor_id)->pluck('user_role')[0];

        if($vendor_role == VendorEnums::$ROLES['admin'])
        {
            $exist = Organization::where('id', $orgnization_id)->first();

            if (!$exist)
                return Helper::response(false, "organization is not Exist");

            $update = Organization::where('id', $orgnization_id)
                ->update([
                    'commission'=> $commission,
                    'status'=> $status,
                    'service_type'=> $service_type,
                    'verification_status'=>$vendor_status
                ]);

            $exist_services = OrganizationService::where('organization_id', $orgnization_id)->get();
            foreach ($exist_services as $service)
            {
                OrganizationService::where('id', $service['id'])->delete();
            }

            foreach($services as $value)
            {
                $service=new OrganizationService;
                $service->organization_id=$orgnization_id;
                $service->service_id=$value;
                $result_service= $service->save();
            }

            if (!$update && !$result_service)
                return Helper::response(false, "Couldn't update data");

            return Helper::response(true, "updated data successfully", ["orgnization" => Organization::findOrFail($orgnization_id)]);
        }
    }

    public static function updateProfile($vendor_id, $fname, $lname, $email, $phone)
    {
        $exist = Vendor::where('id', $vendor_id)->first();

        if (!$exist)
            return Helper::response(false, "Vendor is not Exist");

        $update = Vendor::where('id', $vendor_id)
            ->update([
                'fname'=> $fname,
                'lname'=> $lname,
                'email'=> $email,
                'phone'=>$phone
            ]);

        if (!$update)
            return Helper::response(false, "Couldn't update data");

        return Helper::response(true, "updated data successfully", ["orgnization" => Vendor::findOrFail($vendor_id)]);
    }
}
