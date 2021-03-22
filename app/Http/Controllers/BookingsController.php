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
use App\Models\BookingStatus;
use App\Models\Settings;
use App\Models\Bid;
use App\Helper;
use App\Sms;
use App\Http\Middleware\VerifyJwtToken;
use App\StringFormatter;
use Intervention\Image\ImageManager;
use App\Enums\CommonEnums;
use App\Enums\BookingEnums;
use App\Enums\BidEnums;
use App\Enums\ServiceEnums;
use Carbon\CarbonImmutable;
use Carbon\Carbon;

class BookingsController extends Controller
{
   
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
        DB::beginTransaction();

        $inventory_quantity_type = Service::where("id",$data['service_id'])->pluck('inventory_quantity_type')[0];
        if($inventory_quantity_type != ServiceEnums::$INVENTORY_QUANTITY_TYPE["fixed"] && $inventory_quantity_type != ServiceEnums::$INVENTORY_QUANTITY_TYPE["range"]){
            DB::rollBack();
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

        try{
            $economic_price = $cost_structure["surge_charge"] + $cost_structure["buffer_amount"];
             $economic_price += $economic_price*($cost_structure["tax"]/100);

            $primium_price = InventoryController::getPremiumPrice($data, $inventory_quantity_type);  
            $primium_price = $cost_structure["surge_charge"] + $cost_structure["buffer_amount"];
            $primium_price += $primium_price*($cost_structure["tax"]/100);
        }
        catch(Exception $e){
            DB::rollBack();
            return Helper::response(false,"Couldn't save data",["error"=>$e->getMessage()]);
        }

        $estimate_quote =json_encode(["economic"=>$economic_price, "premium"=>$primium_price]);
        $booking->quote_estimate=$estimate_quote;
        $distance=GeoController::distance($data['source']['lat'], $data['source']['lng'], $data['destination']['lat'], $data['destination']['lng']);
        $booking->meta=json_encode(["self_booking"=>$data['meta']['self_booking'],
                                    "subcategory"=>$data['meta']['subcategory'],
                                    "customer"=>json_encode(["remarks"=>$data['meta']['customer']['remarks']]),
                                    "images"=>$images,
                                    "timings"=>null,
                                    "distance"=>$distance]);
        $booking->status=BookingEnums::$STATUS['enquiry'];
        $result=$booking->save(); 

        $bookingstatus = new BookingStatus;
        $bookingstatus->booking_id = $booking->id;
        $bookingstatus->status=BookingEnums::$STATUS['enquiry'];
        $result_status = $bookingstatus->save();

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

       
        if(!$result && !$result_date && !$result_items && !$result_status)
        {
            DB::rollBack();
            return Helper::response(false,"Couldn't save data");
        }

        DB::commit();
        return Helper::response(true,"save data successfully",["booking"=>Booking::with('movement_dates')->with('inventories')->with('status_history')->findOrFail($booking->id)]);
    }

    public static function confirmBooking($public_booking_id, $service_type, $user_id)
    {
        
        $exist= Booking::where(["user_id"=>$user_id,
                                "public_booking_id"=>$public_booking_id])->first();
        if(!$exist){
            return Helper::response(false,"Order is not Exist");
        }

        if($exist['status']!=BookingEnums::$STATUS['enquiry']){
            return Helper::response(false,"This order is not in Enquiry Status");
        }

        $booking_type= $service_type==0 ? BookingEnums::$BOOKING_TYPE['economic'] : BookingEnums::$BOOKING_TYPE['premium'];

        $timming = Settings::where("key", "bid_time")->pluck('value')[0];
        $complete_time = Carbon::now()->addMinutes($timming);

        $meta = json_decode($exist['meta'], true);
        $meta['timings']['bid_result']= $complete_time->format("Y-m-d H:i");
    
        $confirmestimate = Booking::where(["user_id"=>$exist->user_id,
                                            "public_booking_id"=>$exist->public_booking_id])
                                            ->update(["final_estimated_quote"=>json_decode($exist['quote_estimate'], true)[$service_type],"booking_type"=>$booking_type,
                                            "status"=>BookingEnums::$STATUS['placed'],
                                             "meta" => json_encode($meta),
                                             "bid_result_at"=>$complete_time->format("Y-m-d H:i")]);

        $bookingstatus = new BookingStatus;
        $bookingstatus->booking_id = $exist->id;
        $bookingstatus->status=BookingEnums::$STATUS['placed'];
        $result_status = $bookingstatus->save();

        if(!$confirmestimate && !$result_status)
        {
            return Helper::response(false,"Couldn't save data");
        }
        $booking_id = $exist->id;
        dispatch(function() use($booking_id){
            BidController::addvendors($booking_id);
          })->afterResponse();
                
         return Helper::response(true,"updated data successfully",["booking"=>Booking::with('movement_dates')->with('inventories')->with('status_history')->where("public_booking_id", $public_booking_id)->first()]);
    }

    public static function cancelBooking($public_booking_id, $reason, $desc, $user_id)
    {
        $exist= Booking::where(["user_id"=>$user_id,
                                "public_booking_id"=>$public_booking_id])->first();
        if(!$exist){
            return Helper::response(false,"Order is not Exist");
        }

        if($exist['status']==BookingEnums::$STATUS['cancelled']){
            return Helper::response(false,"This order is already cancelled");
        }

        $cancelbooking = Booking::where(["user_id"=>$exist->user_id,
        "public_booking_id"=>$exist->public_booking_id])
        ->update(["status"=>BookingEnums::$STATUS['cancelled'], "cancelled_meta"=>json_encode(["reason"=>$reason, "desc"=>$desc], true)]);

        $bookingstatus = new BookingStatus;
        $bookingstatus->booking_id = $exist->id;
        $bookingstatus->status=BookingEnums::$STATUS['cancelled'];
        $result_status = $bookingstatus->save();

        if(!$cancelbooking && !$result_status)
        {
            return Helper::response(false,"Couldn't save data");
        }
                
         return Helper::response(true,"updated data successfully",["booking"=>Booking::with('movement_dates')->with('inventories')->with('status_history')->where("public_booking_id", $public_booking_id)->first()]);
    }

    public static function getBookingByPublicIdForApp($public_booking_id)
    {
        $bookingorder= Booking::where(["deleted"=>CommonEnums::$NO,
                                "public_booking_id"=>$public_booking_id])->first();

        if(!$bookingorder)
        {
            return Helper::response(false,"Couldn't Find data");
        }
                                        
        return Helper::response(true,"data fetched successfully",["booking"=>Booking::with('movement_dates')->with('inventories')->with('status_history')->with('vendor')->with('service')->where("public_booking_id", $public_booking_id)->first()]);
    }

    public static function bookingHistoryPast($user_id)
    {
        $bookingorder= Booking::where(["deleted"=>CommonEnums::$NO,
                                "user_id"=>$user_id])
                                ->whereIn("status",[BookingEnums::$STATUS["cancelled"],BookingEnums::$STATUS['completed']])
                                ->with('movement_dates')
                                ->with('inventories')->with('status_history')->with('service')
                                ->get();

        if(!$bookingorder)
        {
            return Helper::response(false,"No Booking Found");
        }
                                                                
        return Helper::response(true,"Data fetched successfully",["booking"=>$bookingorder]);
    }

    public static function bookingHistoryLive($user_id)
    {
        $bookingorder= Booking::where(["deleted"=>CommonEnums::$NO,
                                "user_id"=>$user_id])
                                ->whereNotIn("status",[BookingEnums::$STATUS["enquiry"],BookingEnums::$STATUS["cancelled"],BookingEnums::$STATUS['completed']])->with('movement_dates')
                                ->with('inventories')->with('status_history')->with('service')
                                ->get();

        if(!$bookingorder)
        {
            return Helper::response(false,"No Booking Found");
        }
                                                                
        return Helper::response(true,"Data fetched successfully",["booking"=>$bookingorder]);
    }

    public static function reschedulBooking($public_booking_id, $dates, $user_id)
    {
        $exist= Booking::where(["user_id"=>$user_id,
                                "public_booking_id"=>$public_booking_id])->first();
        if(!$exist)
            return Helper::response(false,"Order is not Exist");

        MovementDates::where("booking_id",$exist->id)->delete();

        foreach($dates as $value)
        {
            $movementdates=new MovementDates;
                $movementdates->booking_id = $exist->id;
                $movementdates->date = $value;
                $result_date=$movementdates->save();
        }

        return Helper::response(true,"save data successfully",["booking"=>Booking::with('movement_dates')->with('inventories')->with('status_history')->findOrFail($exist->id)]);
    }

    public static function getfinalquote($public_booking_id, $user_id)
    {
        $exist= Booking::where(["user_id"=>$user_id,
                                "public_booking_id"=>$public_booking_id])
                                ->where("status", BookingEnums::$STATUS['payment_pending'])->first();
        if(!$exist)
            return Helper::response(false,"Order is not Exist");

            return Helper::response(true,"save data successfully",["booking"=>Booking::with('movement_dates')->with('inventories')->with('status_history')->findOrFail($exist->id)]);
    }

    public static function getPaymentDetails($public_booking_id, $user_id)
    {
        $final_quote= Booking::where(["user_id"=>$user_id,
                                "public_booking_id"=>$public_booking_id])
                                ->where("status", BookingEnums::$STATUS['payment_pending'])->pluck('final_quote')[0];
        if(!$final_quote)
            return Helper::response(false,"Order is not Exist");

        $tax = Settings::where("key", "tax")->pluck('value')[0];
        $surge_charge = Settings::where("key", "surge_charge")->pluck('value')[0];

        $garnd_total = $final_quote + $tax + $surge_charge;

        return Helper::response(true,"Get payment data successfully",["payment_details"=>["sub_tatal"=>$final_quote, "tax"=>$tax, "surge_charge"=>$surge_charge, "grand_total"=>$garnd_total]]);
    }

    public static function getBookingsForVendorApp(Request $request)
    {
        // $limit=CommonEnums::$PAGE_LENGTH;
        // $offset=0;
        $bid_id = Bid::where("organization_id", $request->token_payload->organization_id);

        switch($request->type)
        {
            case "live":
                $bid_id->where("status", BidEnums::$STATUS['active']);
                break;

            case "scheduled":
                $bid_id->where("status", BidEnums::$STATUS['won']);
                break;
            
            case "scheduled":
                $bid_id->whereIn("bookmarked", CommonEnums::$YES);
                break;
        }

        
        $bookings = Booking::whereIn("id", $bid_id->distinct('booking_id')->pluck('booking_id'))->paginate(CommonEnums::$PAGE_LENGTH);

        return Helper::response(true,"Show data successfully",["bookings"=>$bookings->items(), "paging"=>[
            "current_page"=>$bookings->currentPage(), "total_pages"=>$bookings->lastPage(), "next_page"=>$bookings->nextPageUrl(), "previous_page"=>$bookings->previousPageUrl()
        ]]);
    }

}
