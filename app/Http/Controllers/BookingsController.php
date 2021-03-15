<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\MovementDates;
use App\Models\BookingInventory;
use App\Models\Inventory;
use App\Helper;
use App\Sms;
use App\Http\Middleware\VerifyJwtToken;
use App\StringFormatter;
use Intervention\Image\ImageManager;
use App\Enums\CommonEnums;
use App\Enums\BookingEnums;

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

    public static function getQuote($data)
    {
        $bookings=new Booking;
        $bookings->public_booking_id= "BD".uniqid();
        $booking->user_id=$data['token_payload']['id'];
        $booking->service_id=$data['service_id'];
        $booking->source_lat=$data['source']['lat'];
        $booking->source_lng=$data['source']['lng'];
        $booking->source_meta=json_encode(["geocode">$data['source']['meta']['geocode'],
                                            "floor"=>$data['source']['meta']['floor'],
                                            "address"=>$data['source']['meta']['address'],
                                            "city"=>$data['source']['meta']['city'],
                                            "state"=>$data['source']['meta']['state'],
                                            "pincode"=>$data['source']['meta']['pincode'],
                                            "lift"=>$data['source']['meta']['lift']]);
        $booking->destination_lat=$data['destination']['lat'];
        $booking->destination_lng=$data['destination']['lng'];
        $booking->destination_meta=json_encode(["geocode">$data['destination']['meta']['geocode'],
                                            "floor"=>$data['destination']['meta']['floor'],
                                            "address"=>$data['destination']['meta']['address'],
                                            "city"=>$data['destination']['meta']['city'],
                                            "state"=>$data['destination']['meta']['state'],
                                            "pincode"=>$data['destination']['meta']['pincode'],
                                            "lift"=>$data['destination']['meta']['lift']]);
        $booking->contact_details=$data['contact_details'];
        $booking->meta=json_encode(["self_booking">$data['meta']['self_booking'],
                                    "subcategory"=>$data['meta']['subcategory'],
                                    "customer"=>json_encode(["remarks"=>$data['meta']['customer']['remarks']]),
                                    "images"=>$data['meta']['images']]);
        $result['result']=$booking->save();  
        
        foreach($data["movement_dates"] as $dates)
        {
            $movementdates=new MovementDates;
            $movementdates->booking_id = $booking->id;
            $movementdates->date = $dates["date"];
            $result['result_date']=$movementdates->save();
        }

        foreach($data["inventory_items"] as $items)
        {
            $bookinginventory=new BookingInventory;
            $bookinginventory->booking_id = $booking->id;
            $bookinginventory->inventory_id = $items["inventory_id"];
            $bookinginventory->name = Inventory::select('name')->where("inventory_id", $items['inventory_id'],)->first();
            $bookinginventory->material = $items["material"];
            $bookinginventory->material = $items["size"];
            $result['result_items']=$bookinginventory->save();
        }

        $economic_price = InventoryController :: getEconomicPrice($data);
        $primium_price = InventoryController :: getPremiumPrice($data);       
        
        if(!$result)
            return Helper::response(false,"Couldn't save data");
        else
            return Helper::response(true,"save data successfully", ['economic_price'=>$economic_price, 'primium_price'=>$primium_price,$result]);
    }

    public static function add($data)
    {
        
    }
}
