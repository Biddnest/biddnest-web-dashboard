<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\SubserviceInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManager;
use App\Models\Inventory;
use App\Models\InventoryPrice;
use App\Models\Organization;
use App\Models\Service;
use App\Enums\CommonEnums;
use App\Enums\InventoryEnums;
use App\Enums\ServiceEnums;

class InventoryController extends Controller
{
    private static $public_data = ["id","name","image","icon","size","material","category"];
    public static function get()
    {
        $inventories=Inventory::all();
        if(!$inventories)
            return Helper::response(false,"Records not exist");
        else
            return Helper::response(true,"Data displayed successfully",  ["inventories"=>$inventories]);
    }

    public static function add($name, $material, $size, $image, $category, $icon)
    {

        $image_name = "inventory-image".$name."-".uniqid().".png";
        $icon_name = "inventory-icon".$name."-".uniqid().".png";
        $imageman = new ImageManager(array('driver' => 'imagick'));
        $imageman->configure(array('driver' => 'gd'));

        $inventory=new Inventory;
        $inventory->name=$name;
        $inventory->size=$size;
        $inventory->material=$material;
        $inventory->category=$category;
        $inventory->image=Helper::saveFile($imageman->make($image)->resize(480,480)->encode('png', 100),$image_name,"inventories");
        $inventory->icon=Helper::saveFile($imageman->make($icon)->resize(256,256)->encode('png', 100),$icon_name,"inventories");
        $result= $inventory->save();

        if(!$result)
            return Helper::response(false,"Couldn't save data");

        /*foreach($subservice_ids as $service_id){
            DB::table("subservices_inventories_maps")->insert([
                "subservice_id"=>$service_id,
                "inventory_id"=>$inventory->id
            ]);
        }*/
            return Helper::response(true,"save data successfully",["inventory"=>Inventory::select(self::$public_data)->findOrFail($inventory->id)]);
    }

    public static function update($id, $name, $material, $size, $image, $category, $icon)
    {
        $image_man = new ImageManager(array('driver' => 'gd'));
        $image_name = "inventory-image-".$name."-".uniqid().".png";
        $icon_name = "inventory-icon-".$name."-".uniqid().".png";
        /*$imageman = new ImageManager(array('driver' => 'gd'));

        if(filter_var($image, FILTER_VALIDATE_URL) === FALSE)
            $update_data["image"] = Helper::saveFile($imageman->make($image)->resize(480,480)->encode('png', 100),$image_name,"inventories");

        if(filter_var($image, FILTER_VALIDATE_URL) === FALSE)
            $update_data["icon"] = Helper::saveFile($imageman->make($icon)->resize(256,256)->encode('png', 100),$icon_name,"inventories");*/

        $update_data = [
            "name"=>$name,
            "size"=>$size,
            "material"=>$material,
            "category"=>$category
        ];

        if(filter_var($image, FILTER_VALIDATE_URL) === FALSE)
            $update_data["image"] = Helper::saveFile($image_man->make($image)->resize(256,256)->encode('png', 100),$image_name,"inventories");

        if(filter_var($icon, FILTER_VALIDATE_URL) === FALSE)
            $update_data["icon"] = Helper::saveFile($image_man->make($icon)->resize(256,256)->encode('png', 100),$icon_name,"inventories");


        $result = Inventory::where("id",$id)->update($update_data);

        if(!$result)
            return Helper::response(false,"Couldn't save data");

        return Helper::response(true,"Update data successfully",["inventory"=>Inventory::select(self::$public_data)->findOrFail($id)]);
    }

    public static function getOne($id)
    {
        $result=Inventory::select(self::$public_data)->where('id', $id)->first();
        if(!$result)
            return Helper::response(false,"Couldn't Display data");
        else
            return Helper::response(true,"Data Display successfully",  ["inventory"=>$result]);
    }

    public static function getBySubservice($id)
    {
        $result=Inventory::whereIn("id", function($ids){
            return DB::table("subservices_inventories_maps")->pluck("subservice_id");
        })->get();

        if(!$result)
            return Helper::response(false,"Couldn't Display data");
        else
            return Helper::response(true,"Data Display successfully",  ["subservices"=>$result]);
    }

    public static function delete($id)
    {
        $result=Inventory::where("id",$id)->update(["deleted"=>1]);

        if(!$result)
            return Helper::response(false,"Couldn't Delete Inventory");
        else
            return Helper::response(true,"Inventory Deleted successfully");
    }

    //route controller => ApiRouteController
    public static function getBySubserviceForApp($id)
    {
        $result = SubserviceInventory::where("subservice_id", $id)->with("meta")->where(['status'=>CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])->get();
        return Helper::response(true,"Data Display successfully", ["inventories"=>$result]);
    }

    public static function getInventoriesForApp()
    {
        $result=Inventory::select(self::$public_data)->where(['status'=>CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])->get();

        if(!$result)
            return Helper::response(false,"Couldn't Display data");
        else
            return Helper::response(true,"Data Display successfully", ["inventories"=>$result]);

    }

    //route controller => VendorApiRouteController
    public static function addPrice($data, $web=false)
    {
        $Service = Service::findOrFail($data["service_type"]);
        if(!$Service)
            return Helper::response(false,"Incorrect service type.");

        $Inventory = Inventory::findOrFail($data["inventory_id"]);
        if(!$Inventory)
            return Helper::response(false,"Incorrect inventory id.");

        foreach($data['price'] as $price) {
            $inventoryprice=new InventoryPrice;
            $inventoryprice->organization_id= Session::get('organization_id');
            $inventoryprice->service_type= $data['service_type'];
            $inventoryprice->inventory_id= $data['inventory_id'];
            $inventoryprice->size= $price['size'];
            $inventoryprice->material= $price['material'];
            $inventoryprice->price_economics= $price['price']['economics'];
            $inventoryprice->price_premium= $price['price']['premium'];
            if($web)
                $inventoryprice->ticket_status= CommonEnums::$TICKE_STATUS['open'];
            $result= $inventoryprice->save();
        }

        if(!$result)
            return Helper::response(false,"Couldn't save data");

        if($web) {
            TicketController::createForVendor(Session::get('account')['id'], 6, ["parent_org_id" => Session::get('organization_id'), "inventory_id" => $data['inventory_id'], "service_type" => $data['service_type']]);

            return Helper::response(true, "Price Saved successfully");
        }
        else
            return Helper::response(true,"Price Saved successfully",["Price"=>Inventory::with("inventoryprice")->findOrFail($data['inventory_id'])]);
    }

    public static function getByInventory($id)
    {
        $result=InventoryPrice::whereIn("inventory_id", Inventory::where('id', $id)->pluck('id'))
        ->where(['status'=>CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])->get();

        if(!$result)
            return Helper::response(false,"Couldn't Display data");
        else
            return Helper::response(true,"Data Display successfully", ["InventoryPrice"=>$result]);
    }

    public static function updatePrice($data, $web=false)
    {
        // $Organization = Organization::findOrFail($data["organization_id"]);
        // if(!$Organization)
        //     return Helper::response(false,"Incorrect Organization id.");

       /* $Service = Service::findOrFail($data["service_type"]);
        if(!$Service)
            return Helper::response(false,"Incorrect service type.");*/

        $Inventory = Inventory::findOrFail($data["inventory_id"]);

        if(!$Inventory)
            return Helper::response(false,"Incorrect inventory id.");

        $service_type=$Inventory->service_type;
        foreach($data['price'] as $price) {
            $updateColumns = [
                "price_economics" => $price['price']['economics'],
                "price_premium" => $price['price']['premium'],
            ];

            if($web && ($Inventory['ticket_status'] != CommonEnums::$TICKE_STATUS['modify']))
                $updateColumns = ["ticket_status" => CommonEnums::$TICKE_STATUS['open']];

            $InventoryPrice = InventoryPrice::where(['id'=>$price['id'], 'inventory_id'=>$data["inventory_id"], 'organization_id'=>Session::get('organization_id')])->update($updateColumns);
        }

        if($web && ($Inventory['ticket_status'] != CommonEnums::$TICKE_STATUS['modify']))
            TicketController::createForVendor(Session::get('account')['id'], 6, ["parent_org_id" => Session::get('organization_id'), "inventory_id" => $data['inventory_id'], "service_type" => $service_type]);

        if($web)
            return Helper::response(true, "Price Saved successfully");
        else
            return Helper::response(true, "Inventory Price has been updated.");
    }

    public static function deletePrice($id)
    {
        $result=InventoryPrice::where(["inventory_id"=>$id, 'organization_id'=>Session::get('organization_id')])->update(["deleted"=>1]);

        if(!$result)
            return Helper::response(false,"Couldn't Delete data $result");
        else
            return Helper::response(true,"Service deleted successfully");
    }

    public static function getEconomicPrice($data, $inventory_quantity_type)
    {
        $finalprice=0.00;
        foreach($data['inventory_items'] as $item) {
            $minprice= InventoryPrice::where(["inventory_id"=>$item['inventory_id'],
                                                "size"=>$item['size'],
                                                "material"=>$item['material']])->min('price_economics'
                                            );
            $quantity = $inventory_quantity_type ==  ServiceEnums::$INVENTORY_QUANTITY_TYPE['fixed'] ? $item['quantity'] : $item['quantity']['max'];
           $finalprice += $minprice * $quantity * GeoController::distance($data['source']['lat'], $data['source']['lng'], $data['destination']['lat'], $data['destination']['lng']);
        }

        return $finalprice;

    }

    public static function getPremiumPrice($data , $inventory_quantity_type, $web)
    {
        $finalprice=0.00;
        foreach($data['inventory_items'] as $item) {
            $minprice= InventoryPrice::where(["inventory_id"=>$item['inventory_id'],
                                                "size"=>$item['size'],
                                                "material"=>$item['material']])->min('price_premium');

//            $quantity = $inventory_quantity_type == ServiceEnums::$INVENTORY_QUANTITY_TYPE['fixed'] ? $item['quantity'] : $item['quantity']['max'];
            if($web == true)
            {
                $quantity = $inventory_quantity_type == ServiceEnums::$INVENTORY_QUANTITY_TYPE['fixed'] ? $item['quantity'] : json_encode(["min" => explode(";",$item['quantity'])[0], "max" => explode(";",$item['quantity'])[1]]);
            }else{
                $quantity = $inventory_quantity_type == ServiceEnums::$INVENTORY_QUANTITY_TYPE['fixed'] ? $item['quantity'] : json_encode(["min" => $item['quantity']['min'], "max" => $item['quantity']['max']]);
            }
           $finalprice += $minprice ? $minprice * $quantity * GeoController::distance($data['source']['lat'], $data['source']['lng'], $data['destination']['lat'], $data['destination']['lng']) : 0.00;
        }

        return $finalprice;

    }

    public static function statusUpdate($id)
    {
        $inventory = Inventory::find($id);

        switch($inventory->status){
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

        $update_status = Inventory::where('id',$id)->update(["status"=>$status]);
        if(!$update_status)
            return Helper::response(false, "failed to updated status");

        return Helper::response(true, "status updated successfully");
    }

    public static function changeStatus($id, $org_id, $service_id, $status)
    {
        $change_status =InventoryPrice::where(['inventory_id'=>$id, 'organization_id'=>$org_id, 'service_type'=>$service_id])->update([
            "ticket_status"=>$status
        ]);

        if(!$change_status)
            return Helper::response(false,"Couldn't Update status");

        return Helper::response(true,"Status Updated successfully");
    }
}
