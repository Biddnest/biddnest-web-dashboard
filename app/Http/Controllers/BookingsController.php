<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\MovementDates;
use App\Models\BookingInventory;
use App\Models\Inventory;
use App\Models\Service;
use App\Models\User;
use App\Models\Settings;
use App\Helper;
use App\Sms;
use App\Http\Middleware\VerifyJwtToken;
use App\StringFormatter;
use Intervention\Image\ImageManager;
use App\Enums\CommonEnums;
use App\Enums\BookingEnums;
use App\Enums\ServiceEnums;
use Carbon\CarbonImmutable;
use Carbon\Carbon;

class BookingsController extends Controller
{
    public static function get()  
    {
        $result=Booking::where(['status'=> CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])->with("user")->with("Organization")->get();

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", $result);
    }

    public static function createEnquiry($data, $user_id)
    {
        if(App::environment('production'))
        {
            $exsist = Booking::where(["user_id"=>$user_id,
                                    "deleted"=>CommonEnums::$NO])
                                    ->where("status","!=",BookingEnums::$STATUS["cancelled"])
                                    ->whereBetween("created_at", [Carbon::now()->subMinutes(30),Carbon::now()])
                                    ->get();
            
            if($exsist){
                return  Helper::response(false,"You have pending order");
            }
        }

        $inventory_quantity_type = Service::where("id",$data['service_id'])->pluck('inventory_quantity_type')[0];
        if($inventory_quantity_type != ServiceEnums::$INVENTORY_QUANTITY_TYPE["fixed"] && $inventory_quantity_type != ServiceEnums::$INVENTORY_QUANTITY_TYPE["range"]){
            return Helper::response(false,"Unkown Service Type, Couldn't Proceed");
        }

        $booking=new Booking;
        $booking_id = "BD".uniqid();
        $booking->public_booking_id= $booking_id;
        $booking->user_id=(int)$user_id ;
        $booking->service_id=$data['service_id'];
        $booking->source_lat=$data['source']['lat'];
        $booking->source_lng=$data['source']['lng'];
        $booking->source_meta=json_encode(["geocode"=>$data['source']['meta']['geocode'],
                                            "floor"=>$data['source']['meta']['floor'],
                                            "address"=>$data['source']['meta']['address'],
                                            "city"=>$data['source']['meta']['city'],
                                            "state"=>$data['source']['meta']['state'],
                                            "pincode"=>$data['source']['meta']['pincode'],
                                            "lift"=>$data['source']['meta']['lift']]);
        $booking->destination_lat=$data['destination']['lat'];
        $booking->destination_lng=$data['destination']['lng'];
        $booking->destination_meta=json_encode(["geocode"=>$data['destination']['meta']['geocode'],
                                            "floor"=>$data['destination']['meta']['floor'],
                                            "address"=>$data['destination']['meta']['address'],
                                            "city"=>$data['destination']['meta']['city'],
                                            "state"=>$data['destination']['meta']['state'],
                                            "pincode"=>$data['destination']['meta']['pincode'],
                                            "lift"=>$data['destination']['meta']['lift']]);
        if($data['meta']['self_booking']===true)
        {
            $user = User::findOrfail($user_id);
            $booking->contact_details=json_encode(["name"=> $user['fname'].' '.$user['lname'],
                                                    "phone"=> $user['phone'],
                                                    'email'=>$user['email']]);
        }
        else{
            $booking->contact_details=json_encode(["name"=> $data['contact_details']['name'],
                                                    "phone"=>$data['contact_details']['phone'],
                                                    'email'=>$data['contact_details']['email']]);
        }

        $images=[];
        $imageman = new ImageManager(array('driver' => 'gd'));
        foreach( $data['meta']['images'] as $key=>$image)
        {
            $images[]= Helper::saveFile($imageman->make($image)->encode('png', 75),"BD".uniqid().$key,"bookings/".$booking_id);
        }
        

        $booking->meta=json_encode(["self_booking"=>$data['meta']['self_booking'],
                                    "subcategory"=>$data['meta']['subcategory'],
                                    "customer"=>json_encode(["remarks"=>$data['meta']['customer']['remarks']]),
                                    "images"=>$images]);
       
        $cost_structure=[];
        foreach(Settings::get() as $setting)
        {
            switch($setting['key']){
                case "tax": 
                    $cost_structure['tax']=$setting['value'];
                    break;
                            
                case "surge_charge":
                    $cost_structure['surge_charge']=$setting['value'];
                    break;
                            
                case "buffer_amount":
                    $cost_structure['buffer_amount']=$setting['value'];
                    break;                    
            }
        }

        $economic_price = InventoryController::getEconomicPrice($data, $inventory_quantity_type);
        $economic_price = $cost_structure["surge_charge"] + $cost_structure["buffer_amount"];
        $economic_price += $economic_price*($cost_structure["tax"]/100);

        $primium_price = InventoryController::getPremiumPrice($data, $inventory_quantity_type);  
        $primium_price = $cost_structure["surge_charge"] + $cost_structure["buffer_amount"];
        $primium_price += $primium_price*($cost_structure["tax"]/100);

        $estimate_quote =json_encode(["economic"=>$economic_price, "premium"=>$primium_price]);
        $booking->quote_estimate=$estimate_quote;
        $booking->status=BookingEnums::$STATUS['enquiry'];
        $result=$booking->save(); 

        foreach($data["movement_dates"] as $dates)
        {
            $movementdates=new MovementDates;
            $movementdates->booking_id = $booking->id;
            $movementdates->date = $dates;
            $result_date=$movementdates->save();
        }


        foreach($data["inventory_items"] as $items)
        {
            $bookinginventory=new BookingInventory;
            $bookinginventory->booking_id = $booking->id;
            $bookinginventory->inventory_id = $items["inventory_id"];
            $bookinginventory->name = Inventory::where("id", $items['inventory_id'])->pluck('name')[0];
            $bookinginventory->material = $items["material"];
            $bookinginventory->size = $items["size"];
            $bookinginventory->quantity = $inventory_quantity_type ==  ServiceEnums::$INVENTORY_QUANTITY_TYPE['fixed'] ? $items['quantity'] : json_encode(["min"=>$items['quantity']['min'], "max"=>$items['quantity']['max']]);   
            $bookinginventory->quantity_type = $inventory_quantity_type;
            $result_items=$bookinginventory->save();
        }       

        
        if(!$result && !$result_date && !$result_items)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"save data successfully",["booking"=>Booking::with('movement_dates')->with('inventories')->findOrFail($booking->id)]);
    }

    public static function add()
    {
        
    }
}
