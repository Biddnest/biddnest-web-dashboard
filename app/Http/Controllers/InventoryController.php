<?php

namespace App\Http\Controllers;

use App\Enums\CommonEnums;
use App\Enums\InventoryEnums;
use App\Enums\OrganizationEnums;
use App\Enums\ServiceEnums;
use App\Helper;
use App\Imports\InventoryImport;
use App\Imports\InventoryPriceImport;
use App\Models\Inventory;
use App\Models\InventoryPrice;
use App\Models\Organization;
use App\Models\Service;
use App\Models\SubserviceInventory;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Maatwebsite\Excel\Facades;

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
        return Helper::response(true,"Here are the inventories.", ["inventories"=>$result]);
    }

    public static function getInventoriesForApp()
    {
        $result=Inventory::select(self::$public_data)->where(['status'=>CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])->orderBy("name", "ASC")->get();

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
            $inventoryprice->bp_economic= $price['bidnest']['price']['economics'];
            $inventoryprice->bp_premium= $price['bidnest']['price']['premium'];
            $inventoryprice->mp_economic= $price['market']['price']['economics'];
            $inventoryprice->mp_premium= $price['market']['price']['premium'];
            if($web) {
                $inventoryprice->ticket_status = CommonEnums::$TICKET_STATUS['open'];
                $inventoryprice->status = InventoryEnums::$STATUS['pending_approval'];
            }
            $result= $inventoryprice->save();
        }

        if(!$result)
            return Helper::response(false,"Couldn't save data");

        if($web) {
            TicketController::createForVendor(Session::get('account')['id'], 6, ["parent_org_id" => Session::get('organization_id'), "inventory_id" => $data['inventory_id'], "service_type" => $data['service_type']]);

            return Helper::response(true, "Price Saved successfully");
        } else
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
                "bp_economic" => $price['bidnest']['price']['economics'],
                "bp_premium" => $price['bidnest']['price']['premium'],
                "mp_economic" => $price['market']['price']['economics'],
                "mp_premium" => $price['market']['price']['premium'],
            ];


            if($web && ($Inventory['ticket_status'] != CommonEnums::$TICKET_STATUS['need_modification'])){
                $updateColumns['ticket_status']= CommonEnums::$TICKET_STATUS['open'];
                $updateColumns['status']= InventoryEnums::$STATUS['pending_approval'];
            }

            $InventoryPrice = InventoryPrice::where(['id'=>$price['id'], 'inventory_id'=>$data["inventory_id"], 'organization_id'=>Session::get('organization_id')])->update($updateColumns);
        }

        if($web && ($Inventory['ticket_status'] != CommonEnums::$TICKET_STATUS['need_modification']))
            TicketController::createForVendor(Session::get('account')['id'], 6, ["parent_org_id" => Session::get('organization_id'), "inventory_id" => $data['inventory_id'], "service_type" => $service_type]);

        if(!$InventoryPrice)
            return Helper::response(false, "Couldn't Update Price");

        if($web)
            return Helper::response(true, "Price Update successfully");
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

    public static function getEconomicPrice($data, $inventory_quantity_type,  $zone_id, $web=false, $created_by_support=false)
    {

        $least_agent_price = SubservicePrice::whereIn(
            "organization_id",Organization::where("zone_id",GeoController::getNearestZone($data['source']['lat'], $data['source']['lng']))->where('status',OrganizationEnums::$STATUS['active'])
                ->pluck('id'))
            ->where('subservice_id',Subservice::where('name',$data['meta']['subcategory'])->pluck('id')[0])
            ->min('bp_economic');

        $average_margin_percentage = SubservicePrice::whereIn(
            "organization_id",Organization::where("zone_id",GeoController::getNearestZone($data['source']['lat'], $data['source']['lng']))->where('status',OrganizationEnums::$STATUS['active'])
            ->pluck('id'))
            ->where('subservice_id',Subservice::where('name',$data['meta']['subcategory'])->pluck('id')[0])
            ->avg('economic_margin_percentage');
        //extra_km * extra rate -> average

        /* s -> d = 100 | b -> 25, extra-> 75
         * va | ed -> 5, edp -> 100 | extp -> 15*100 = 1500 | finalest = base_price +1500
         * vb | ed -> 3, edp -> 70 | extp -> 25*70 = 1750 | finalest = base_price +1750
         * vb | ed -> 20, edp -> 200 | extp -> 4*200 = 800 | finalest = base_price +800
         * avrextraprice = 1500+1750+800/3 = 4050/3 = 1350rs
         * */

        $total_distance = GeoController::distance($data['source']['lat'], $data['source']['lng'], $data['destination']['lat'], $data['destination']['lng']);



        $eligible_vendors = Organization::where("zone_id",GeoController::getNearestZone($data['source']['lat'], $data['source']['lng']))->where('status',OrganizationEnums::$STATUS['active'])
        ->get();

        $all_vendor_extra_price=[];
        foreach($eligible_vendors as $vendor){
            $extra_distance = $total_distance - $vendor['base_distance'];

            $extra_distance_price = SubservicePrice::where(
                "organization_id",$vendor['id'])
                ->where('subservice_id',Subservice::where('name',$data['meta']['subcategory'])
                ->pluck('id')[0])
                ->pluck('additional_distance_economic_price')[0];

            $all_vendor_extra_price[] = ceil($extra_distance/$vendor['additional_distance']) * $extra_distance_price;
        }

        $avg_extra_km_price = array_sum($all_vendor_extra_price) ?: 0.00;


        return $initial_customer_quote = $least_agent_price+(($average_margin_percentage/100)*$least_agent_price) + $avg_extra_km_price;

    }

    public static function getPremiumPrice($data , $inventory_quantity_type,  $zone_id, $web=false, $created_by_support=false)
    {


        $least_agent_price = SubservicePrice::whereIn(
            "organization_id",Organization::where("zone_id",GeoController::getNearestZone($data['source']['lat'], $data['source']['lng']))->where('status',OrganizationEnums::$STATUS['active'])
            ->pluck('id'))
            ->where('subservice_id',Subservice::where('name',$data['meta']['subcategory'])->pluck('id')[0])
            ->min('bp_premium');

        $average_margin_percentage = SubservicePrice::whereIn(
            "organization_id",Organization::where("zone_id",GeoController::getNearestZone($data['source']['lat'], $data['source']['lng']))->where('status',OrganizationEnums::$STATUS['active'])
            ->pluck('id'))
            ->where('subservice_id',Subservice::where('name',$data['meta']['subcategory'])->pluck('id')[0])
            ->avg('premium_margin_percentage');

       /* //extra_km * extra rate -> average

        /* s -> d = 100 | b -> 25, extra-> 75
         * va | ed -> 5, edp -> 100 | extp -> 15*100 = 1500 | finalest = base_price +1500
         * vb | ed -> 3, edp -> 70 | extp -> 25*70 = 1750 | finalest = base_price +1750
         * vb | ed -> 20, edp -> 200 | extp -> 4*200 = 800 | finalest = base_price +800
         * avrextraprice = 1500+1750+800/3 = 4050/3 = 1350rs
         * */

        $total_distance = GeoController::distance($data['source']['lat'], $data['source']['lng'], $data['destination']['lat'], $data['destination']['lng']);



        $eligible_vendors = Organization::where("zone_id",GeoController::getNearestZone($data['source']['lat'], $data['source']['lng']))->where('status',OrganizationEnums::$STATUS['active'])
            ->get();

        $all_vendor_extra_price=[];
        foreach($eligible_vendors as $vendor){
            $extra_distance = $total_distance - $vendor['base_distance'];

            $extra_distance_price = SubservicePrice::where(
                "organization_id",$vendor['id'])
                ->where('subservice_id',Subservice::where('name',$data['meta']['subcategory'])
                    ->pluck('id')[0])
                ->pluck('additional_distance_premium_price')[0];

            $all_vendor_extra_price[] = ceil($extra_distance/$vendor['additional_distance']) * $extra_distance_price;
        }

        $avg_extra_km_price = array_sum($all_vendor_extra_price) ?: 0.00;

        return $initial_customer_quote = $least_agent_price+(($average_margin_percentage/100)*$least_agent_price) + $avg_extra_km_price;

    }

    public static function getOrganizationEconomicPrice($data, $inventory_quantity_type,  $zone_id, $web=false, $created_by_support=false)
    {

        $least_agent_price = SubservicePrice::whereIn(
            "organization_id",Organization::where("zone_id",GeoController::getNearestZone($data['source']['lat'], $data['source']['lng']))->where('status',OrganizationEnums::$STATUS['active'])
            ->pluck('id'))
            ->where('subservice_id',Subservice::where('name',$data['meta']['subcategory'])->pluck('id')[0])
            ->min('bp_economic');

        $average_margin_percentage = SubservicePrice::whereIn(
            "organization_id",Organization::where("zone_id",GeoController::getNearestZone($data['source']['lat'], $data['source']['lng']))->where('status',OrganizationEnums::$STATUS['active'])
            ->pluck('id'))
            ->where('subservice_id',Subservice::where('name',$data['meta']['subcategory'])->pluck('id')[0])
            ->avg('economic_margin_percentage');
        //extra_km * extra rate -> average

        /* s -> d = 100 | b -> 25, extra-> 75
         * va | ed -> 5, edp -> 100 | extp -> 15*100 = 1500 | finalest = base_price +1500
         * vb | ed -> 3, edp -> 70 | extp -> 25*70 = 1750 | finalest = base_price +1750
         * vb | ed -> 20, edp -> 200 | extp -> 4*200 = 800 | finalest = base_price +800
         * avrextraprice = 1500+1750+800/3 = 4050/3 = 1350rs
         * */

        $total_distance = GeoController::distance($data['source']['lat'], $data['source']['lng'], $data['destination']['lat'], $data['destination']['lng']);



        $eligible_vendors = Organization::where("zone_id",GeoController::getNearestZone($data['source']['lat'], $data['source']['lng']))->where('status',OrganizationEnums::$STATUS['active'])
            ->get();

        $all_vendor_extra_price=[];
        foreach($eligible_vendors as $vendor){
            $extra_distance = $total_distance - $vendor['base_distance'];

            $extra_distance_price = SubservicePrice::where(
                "organization_id",$vendor['id'])
                ->where('subservice_id',Subservice::where('name',$data['meta']['subcategory'])
                    ->pluck('id')[0])
                ->pluck('additional_distance_economic_price')[0];

            $all_vendor_extra_price[] = ceil($extra_distance/$vendor['additional_distance']) * $extra_distance_price;
        }

        $avg_extra_km_price = array_sum($all_vendor_extra_price) ?: 0.00;


        return $initial_org_quote = $least_agent_price+((0.25 * (($average_margin_percentage/100)*$least_agent_price)) - 1) + $avg_extra_km_price;

    }

    public static function getOrganizationPremiumPrice($data, $inventory_quantity_type,  $zone_id, $web=false, $created_by_support=false)
    {

        $least_agent_price = SubservicePrice::whereIn(
            "organization_id",Organization::where("zone_id",GeoController::getNearestZone($data['source']['lat'], $data['source']['lng']))->where('status',OrganizationEnums::$STATUS['active'])
            ->pluck('id'))
            ->where('subservice_id',Subservice::where('name',$data['meta']['subcategory'])->pluck('id')[0])
            ->min('bp_premium');

        $average_margin_percentage = SubservicePrice::whereIn(
            "organization_id",Organization::where("zone_id",GeoController::getNearestZone($data['source']['lat'], $data['source']['lng']))->where('status',OrganizationEnums::$STATUS['active'])
            ->pluck('id'))
            ->where('subservice_id',Subservice::where('name',$data['meta']['subcategory'])->pluck('id')[0])
            ->avg('premium_margin_percentage');
        //extra_km * extra rate -> average

        /* s -> d = 100 | b -> 25, extra-> 75
         * va | ed -> 5, edp -> 100 | extp -> 15*100 = 1500 | finalest = base_price +1500
         * vb | ed -> 3, edp -> 70 | extp -> 25*70 = 1750 | finalest = base_price +1750
         * vb | ed -> 20, edp -> 200 | extp -> 4*200 = 800 | finalest = base_price +800
         * avrextraprice = 1500+1750+800/3 = 4050/3 = 1350rs
         * */

        $total_distance = GeoController::distance($data['source']['lat'], $data['source']['lng'], $data['destination']['lat'], $data['destination']['lng']);



        $eligible_vendors = Organization::where("zone_id",GeoController::getNearestZone($data['source']['lat'], $data['source']['lng']))->where('status',OrganizationEnums::$STATUS['active'])
            ->get();

        $all_vendor_extra_price=[];
        foreach($eligible_vendors as $vendor){
            $extra_distance = $total_distance - $vendor['base_distance'];

            $extra_distance_price = SubservicePrice::where(
                "organization_id",$vendor['id'])
                ->where('subservice_id',Subservice::where('name',$data['meta']['subcategory'])
                    ->pluck('id')[0])
                ->pluck('additional_distance_premium_price')[0];

            $all_vendor_extra_price[] = ceil($extra_distance/$vendor['additional_distance']) * $extra_distance_price;
        }

        $avg_extra_km_price = array_sum($all_vendor_extra_price) ?: 0.00;


        return $initial_org_quote = $least_agent_price+((0.25 * (($average_margin_percentage/100)*$least_agent_price)) - 1) + $avg_extra_km_price;

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
        if($status == CommonEnums::$TICKET_STATUS['open'])
            $change_status =InventoryPrice::where(['inventory_id'=>$id, 'organization_id'=>$org_id, 'service_type'=>$service_id])->update([
                "ticket_status"=>$status
            ]);
        elseif($status == CommonEnums::$TICKET_STATUS['need_modification'])
            $change_status =InventoryPrice::where(['inventory_id'=>$id, 'organization_id'=>$org_id, 'service_type'=>$service_id])->update([
                "ticket_status"=>$status
            ]);
        elseif($status == CommonEnums::$TICKET_STATUS['approve'])
            $change_status =InventoryPrice::where(['inventory_id'=>$id, 'organization_id'=>$org_id, 'service_type'=>$service_id])->update([
                "ticket_status"=>$status,
                "status"=>InventoryEnums::$STATUS['active']
            ]);

        if(!$change_status)
            return Helper::response(false,"Couldn't Update status");

        return Helper::response(true,"Status Updated successfully");
    }

    public static function import($file = false, $decode_base64 = false){

        if($file){
            $fileContent = $file;
            DB::transaction(function () use ($fileContent){

                try {
                    Facades\Excel::import(new InventoryImport, $fileContent);
                } catch (Exception $e) {
                    return $e->getMessage();
                }
            });
            return "done";
        } else{
            foreach (Storage::files("/public/imports/inventories") as $file){
                $filename = explode("/","$file");
                $imported_files =  DB::table("import_migrations")->pluck('file');
                if(!in_array($file, (array)$imported_files)){
                    Facades\Excel::import(new InventoryImport, $file);
                    DB::table("import_migrations")->insert([
                        "file"=>$file
                    ]);
                } else
                    return "This file is already imported";

            }

        }


    }

    public static function importPrice($file = false, $decode_base64 = false){

        if($file){
            $fileContent = $file;
            DB::transaction(function () use ($fileContent){
                try {
                    Facades\Excel::import(new InventoryPriceImport, $fileContent);
                } catch (Exception $e) {
                    return $e->getMessage();
                }
            });
            return "done";
        } else{
            foreach (Storage::files("/public/imports/inventory_prices") as $file){

                $filename = explode("/","$file");
                $imported_files =  DB::table("import_migrations")->pluck('file');
                if(!in_array($file, (array)$imported_files)){

                    Facades\Excel::import(new InventoryPriceImport, $file);

                    DB::table("import_migrations")->insert([
                        "file"=>$file
                    ]);

                } else
                    return "This file is already imported";

            }

        }


    }

    public static function search($search){
        $inventory = Inventory::where('name', 'LIKE', "%".$search."%")->limit(20)->get();

        return Helper::response(true,"Here are the Matching Items", ['inventories'=>$inventory]);
    }
}
