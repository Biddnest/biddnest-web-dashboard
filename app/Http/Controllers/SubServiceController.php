<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Inventory;
use App\Models\Service;
use App\Models\Subservice;
use App\Models\ServiceSubservice;
use App\Models\SubserviceInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use App\Enums\CommonEnums;

class SubServiceController extends Controller
{
    private static $public_data = ["id","name","image"];
    public function __construct()
    {
    }

    public static function add($data)
    {

        $imageman = new ImageManager(array('driver' => 'imagick'));
        $imageman->configure(array('driver' => 'gd'));

        $image_name = "subservice".$data['name']."-".uniqid().".png";
        $subservice=new Subservice();
        $subservice->name=$data['name'];
        // $subservice->service_id=$service_id;
        $subservice->image = Helper::saveFile($imageman->make($data['image'])->resize(256,256)->encode('png', 100),$image_name,"subservices");
        $result= $subservice->save();

        $service=new ServiceSubservice;
        $service->service_id = $data['category'];
        $service->subservice_id = $subservice->id;
        $service_result = $service->save();

        if($data['inventories']) {
            foreach ($data['inventories'] as $filds) {
                $inventory =new SubserviceInventory();
                $inventory->subservice_id=$subservice->id;
                $inventory->inventory_id=$filds["name"];
                $inventory->size=$filds['size'];
                $inventory->material=$filds['material'];
                $inventory->quantity=$filds['quantity'];
                $inventory_result=$inventory->save();
            }
        }

        if(!$result && !$service_result && !$inventory_result)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"Save data successfully",["subservice"=>Subservice::select(self::$public_data)->with("inventories")->findOrFail($subservice->id)]);
    }

    public static function get()
    {
        $subservice=Subservice::select(self::$public_data)->get();
        if(!$subservice)
            return Helper::response(false,"Records not exist");
        else
            return Helper::response(true,"Data displayed successfully", $subservice);
    }

    public static function getByService($service_id)
    {
        //        $service_id = is_array($service_id) :
        $subservice=Subservice::select(self::$public_data)->where("service_id",$service_id)->get();
        if(!$subservice)
            return Helper::response(false,"Records not exist");
        else
            return Helper::response(true,"Data displayed successfully", $subservice);
    }

    public static function update($id, $service_id, $name, $image, $data)
    {
        $image_man = new ImageManager(array('driver' => 'gd'));
        $image_name = "subservice".$name."-".$id.".png";

        $update_data = ["name"=>$name];
        if(filter_var($image, FILTER_VALIDATE_URL) !== FALSE)
            $update_data["image"] = Helper::saveFile($image_man->make($image)->resize(256,256)->encode('png', 75),$image_name,"subservices");

        $subservice=Subservice::where("id", $id)->update($update_data);

        $subservice_exist=ServiceSubservice::where("id", $id)->first();
        if($subservice_exist)
            $service_result=ServiceSubservice::where('subservice_id', $id)->update([
                'service_id'=>$service_id
            ]);
        else{
            /* ServiceSubservice::where('service_id', $service_id)->delete();*/
            $service=new ServiceSubservice;
            $service->service_id = $service_id;
            $service->subservice_id = $id;
            $service_result = $service->save();
        }


        if($data) {
            SubserviceInventory::where('subservice_id', $id)->delete();
            foreach ($data as $filds) {
                $inventory =new SubserviceInventory();
                $inventory->subservice_id=$id;
                $inventory->inventory_id=$filds["name"];
                $inventory->size=$filds['size'];
                $inventory->material=$filds['material'];
                $inventory->quantity=$filds['quantity'];
                $inventory->save();
            }
        }

        if(!$subservice && !$service_result)
            return Helper::response(false,"Couldn't Update data");

        return Helper::response(true,"Update data successfully",["subservice"=>Subservice::select(self::$public_data)->findOrFail($id)]);
    }

    public static function getOne($id)
    {
        $result=Subservice::select(self::$public_data)->with("inventories")->findOrFail($id);

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", $result);
    }

    public static function delete($id)
    {
        $result=Subservice::where("id",$id)->update(["deleted"=>1]);

        if(!$result)
            return Helper::response(false,"Couldn't Delete Sub-Services");
        else
            return Helper::response(true,"Sub-Services deleted successfully");
    }

    public static function getSubservicesForApp($id, $web=false)
    {
        $subservice=Subservice::select(self::$public_data)
        ->where(['status'=>CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])
        ->whereIn("id", ServiceSubservice::where('service_id', $id)->pluck('subservice_id'))
        ->get();

        if(!$subservice)
            return Helper::response(false,"Records not exist");

        return Helper::response(true,"Data displayed successfully", ['subservices'=>$subservice]);
    }

    public static function statusUpdate($id)
    {
        $subservice = Subservice::find($id);

        switch($subservice->status){
            case CommonEnums::$YES:
                $status = CommonEnums::$NO;
                break;

            case CommonEnums::$NO:
                $status = CommonEnums::$YES;
                break;

            default:
                return Helper::response([false, "This user is supended. Please use the vendor panel to enable."]);
                break;
        }

        $update_status = Subservice::where('id',$id)->update(["status"=>$status]);
        if(!$update_status)
            return Helper::response(false, "failed to updated status");

        return Helper::response(true, "status updated successfully");
    }
}
