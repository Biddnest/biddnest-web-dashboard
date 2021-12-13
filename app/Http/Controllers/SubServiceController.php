<?php

namespace App\Http\Controllers;

use App\Enums\CommonEnums;
use App\Helper;
use App\Models\ServiceSubservice;
use App\Models\Subservice;
use App\Models\SubServiceExtraInventory;
use App\Models\SubserviceInventory;
use Intervention\Image\ImageManager;

class SubServiceController extends Controller
{
    private static $public_data = ["id","name","image"];

    public function __construct()
    {
    }

    public static function add($data)
    {

        if(Subservice::where("name",$data['name'])->first())
            return  Helper::response(false, "This Sub Category already exists.");

        $imageman = new ImageManager(array('driver' => 'imagick'));
        $imageman->configure(array('driver' => 'gd'));

        $image_name = "subservice".$data['name']."-".uniqid().".png";
        $subservice=new Subservice();
        $subservice->name=$data['name'];
        $subservice->max_extra_items = $data['max_extra_items'];
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
                $inventory->inventory_id=$filds["id"];
                $inventory->size=$filds['size'];
                $inventory->material=$filds['material'];
                $inventory->quantity=$filds['quantity'];
                $inventory_result=$inventory->save();
            }
        }

        if($data['extra_inventories']) {
            foreach ($data['extra_inventories'] as $inv_id) {
                $extra_inventory =new SubServiceExtraInventory();
                $extra_inventory->subservice_id=$subservice->id;
                $extra_inventory->inventory_id=$inv_id;
                $extra_inventory_result=$extra_inventory->save();
            }
        }

        if(!$result && !$service_result && !$inventory_result)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"Save data successfully",["subservice"=>Subservice::select(self::$public_data)->with("inventories")
                ->with(['extraitems'=>function($query){ $query->with('meta'); }])
                ->findOrFail($subservice->id)]);
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

    public static function update($id, $service_id, $name, $image, $data, $max_extra_items, $extra_inventories)
    {
        $image_man = new ImageManager(array('driver' => 'gd'));
        $image_name = "subservice".$name.uniqid()."-".$id.".png";

        $update_data = ["name"=>$name,"max_extra_items"=>$max_extra_items];

        if(filter_var($image, FILTER_VALIDATE_URL) === FALSE)
            $update_data["image"] = Helper::saveFile($image_man->make($image)->resize(256,256)->encode('png', 75),$image_name,"subservices");

        $subservice=Subservice::where("id", $id)->update($update_data);

        $subservice_exist=ServiceSubservice::where(["subservice_id"=>$id, "service_id"=>$service_id])->first();
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
                $inventory->inventory_id=$filds["id"];
                $inventory->size=$filds['size'];
                $inventory->material=$filds['material'];
                $inventory->quantity=$filds['quantity'];
                $inventory->save();
            }
        }
        if($extra_inventories) {
            SubServiceExtraInventory::where('subservice_id', $id)->delete();
            foreach ($extra_inventories as $inv_id) {
                $extra_inventory =new SubServiceExtraInventory();
                $extra_inventory->subservice_id=$id;
                $extra_inventory->inventory_id=$inv_id;
                $extra_inventory_result=$extra_inventory->save();
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
        $subservice=Subservice::where(['status'=>CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])
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

    public static function getDefaultItems($id, $service){
        $subservice_exist = Subservice::where("id", $id)->first();

        if(!$subservice_exist)
            return Helper::response(false,"Sub-Services is not exist.");

        $get_items = SubserviceInventory::where(["subservice_id"=>$id])->with("meta")->get();

        if($get_items)
            return Helper::response(true,"Defalt Inventories.", ["items"=>$get_items]);
        else
            return Helper::response(false,"Defalt Inventories are not exist.");
    }
}
