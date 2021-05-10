<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

namespace App\Http\Controllers;

use App\Enums\BidEnums;
use App\Enums\BookingEnums;
use App\Enums\CommonEnums;
use App\Enums\NotificationEnums;
use App\Enums\ServiceEnums;
use App\Enums\VendorEnums;
use App\Helper;
use App\Http\Controllers\User\UserController;
use App\Models\Bid;
use App\Models\Booking;
use App\Models\BookingDriver;
use App\Models\BookingInventory;
use App\Models\BookingStatus;
use App\Models\Inventory;
use App\Models\MovementDates;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Settings;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManager;

class BookingsController extends Controller
{

    public static function createEnquiryForAdmin(Request $request){
        $user = User::where("phone",$request->phone)
                ->orWhere("email",$request->email)
                ->first();
        if($user)
            $user_id = $user->id;
        else
        {
            $fname = explode($request->contact_details['name'], " ")[0];
            $lname = str_replace($fname, "", $request->contact_details['name']);

            $newuser = UserController::directSignup($request->contact_details['phone'], $fname, $lname, $request->contact_details['email']);

            $user_id = $newuser->id;
        }
        $movement_dates = explode(",",$request->movement_dates);

        return self::createEnquiry($request->all(), $user_id, $movement_dates, true);

    }

    public static function createEnquiry($data, $user_id, $movement_dates, $web=false)
    {
        if (App::environment('production')) {
            $exsist = Booking::where(["user_id" => $user_id,
                "deleted" => CommonEnums::$NO])
                ->where("status", "!=", BookingEnums::$STATUS["cancelled"])
                ->whereBetween("created_at", [Carbon::now()->subMinutes(30), Carbon::now()])
                ->get();

            if ($exsist) {
                return Helper::response(false, "You have pending order");
            }
        }
        DB::beginTransaction();

        $inventory_quantity_type = Service::where("id", $data['service_id'])->pluck('inventory_quantity_type')[0];
        if ($inventory_quantity_type != ServiceEnums::$INVENTORY_QUANTITY_TYPE["fixed"] && $inventory_quantity_type != ServiceEnums::$INVENTORY_QUANTITY_TYPE["range"]) {
            DB::rollBack();
            return Helper::response(false, "Unkown Service Type, Couldn't Proceed");
        }

        $booking = new Booking;
        $booking_id = "BD" . uniqid();
        $booking->public_booking_id = strtoupper($booking_id);
        $booking->user_id = (int)$user_id;
        $booking->service_id = $data['service_id'];
        $booking->source_lat = $data['source']['lat'];
        $booking->source_lng = $data['source']['lng'];
        $booking->source_meta = json_encode(["geocode" => $data['source']['meta']['geocode'],
            "floor" => $data['source']['meta']['floor'],
            "address" => $data['source']['meta']['address_line1']." ".$data['source']['meta']['address_line2'],
            "address_line1" => $data['source']['meta']['address_line1'],
            "address_line2" => $data['source']['meta']['address_line2'],
            "city" => $data['source']['meta']['city'],
            "state" => $data['source']['meta']['state'],
            "pincode" => $data['source']['meta']['pincode'],
            "lift" => $data['source']['meta']['lift'],
            "shared_service" => $data['source']['meta']['shared_service']]);
        $booking->destination_lat = $data['destination']['lat'];
        $booking->destination_lng = $data['destination']['lng'];
        $booking->destination_meta = json_encode(["geocode" => $data['destination']['meta']['geocode'],
            "floor" => $data['destination']['meta']['floor'],
            "address" => $data['destination']['meta']['address_line1']." ".$data['destination']['meta']['address_line2'],
            "address_line1" => $data['destination']['meta']['address_line1'],
            "address_line2" => $data['destination']['meta']['address_line2'],
            "city" => $data['destination']['meta']['city'],
            "state" => $data['destination']['meta']['state'],
            "pincode" => $data['destination']['meta']['pincode'],
            "lift" => $data['destination']['meta']['lift']]);
        if ($data['meta']['self_booking'] === true) {
            $user = User::findOrfail($user_id);
            $booking->contact_details = json_encode(["name" => $user['fname'] . ' ' . $user['lname'],
                "phone" => $user['phone'],
                'email' => $user['email']]);
        } else {
            $booking->contact_details = json_encode(["name" => $data['contact_details']['name'],
                "phone" => $data['contact_details']['phone'],
                'email' => $data['contact_details']['email']]);
        }

        $images = [];
        $imageman = new ImageManager(array('driver' => 'gd'));
        if($data['meta']['images'] != "") { //need to remove [0]==> temp fixed
            foreach ($data['meta']['images'] as $key => $image) {
                $images[] = Helper::saveFile($imageman->make($image)->encode('png', 75), "BD" . uniqid() . $key . ".png", "bookings/" . $booking_id);
            }
        }

        $cost_structure = [];
        foreach (Settings::get() as $setting) {
            switch ($setting['key']) {
                case "tax":
                    $cost_structure['tax'] = $setting['value'];
                    break;

                case "surge_charge":
                    $cost_structure['surge_charge'] = $setting['value'];
                    break;

                case "buffer_amount":
                    $cost_structure['buffer_amount'] = $setting['value'];
                    break;
            }
        }

        try {
            $economic_price = $cost_structure["surge_charge"] + $cost_structure["buffer_amount"];
            $economic_price += $economic_price * ($cost_structure["tax"] / 100);

            $primium_price = InventoryController::getPremiumPrice($data, $inventory_quantity_type);
            $primium_price = $cost_structure["surge_charge"] + $cost_structure["buffer_amount"];
            $primium_price += $primium_price * ($cost_structure["tax"] / 100);
        } catch (Exception $e) {
            DB::rollBack();
            return Helper::response(false, "Couldn't save data", ["error" => $e->getMessage()]);
        }

        $estimate_quote = json_encode(["economic" => $economic_price, "premium" => $primium_price]);
        $booking->quote_estimate = $estimate_quote;
        $distance = GeoController::distance($data['source']['lat'], $data['source']['lng'], $data['destination']['lat'], $data['destination']['lng']);
        $booking->meta = json_encode(["self_booking" => $data['meta']['self_booking'],
            "subcategory" => $data['meta']['subcategory'],
            "customer" => json_encode(["remarks" => $data['meta']['customer']['remarks']]),
            "images" => $images,
            "timings" => null,
            "distance" => $distance]);
        $booking->status = BookingEnums::$STATUS['enquiry'];
        $result = $booking->save();

        // $bookingstatus = new BookingStatus;
        // $bookingstatus->booking_id = $booking->id;
        // $bookingstatus->status=BookingEnums::$STATUS['enquiry'];
        // $result_status = $bookingstatus->save();

        $result_status = self::statusChange($booking->id, BookingEnums::$STATUS['enquiry']);

        foreach ($movement_dates as $dates) {
            $movementdates = new MovementDates;
            $movementdates->booking_id = $booking->id;
            $movementdates->date = $dates;
            $result_date = $movementdates->save();
        }

        foreach ($data["inventory_items"] as $items) {

            if($web)
            {
                $quantity = $inventory_quantity_type == ServiceEnums::$INVENTORY_QUANTITY_TYPE['fixed'] ? $items['quantity'] : json_encode(["min" => explode(";",$items['quantity'])[0], "max" => explode(";",$items['quantity'])[1]]);
            }else{
                $quantity = $inventory_quantity_type == ServiceEnums::$INVENTORY_QUANTITY_TYPE['fixed'] ? $items['quantity'] : json_encode(["min" => $items['quantity']['min'], "max" => $items['quantity']['max']]);
            }

            $bookinginventory = new BookingInventory;
            $bookinginventory->booking_id = $booking->id;
            $bookinginventory->inventory_id = $items["inventory_id"];
            $bookinginventory->name = Inventory::where("id", $items['inventory_id'])->pluck('name')[0];
            $bookinginventory->material = $items["material"];
            $bookinginventory->size = $items["size"];
            $bookinginventory->quantity = $quantity;
            $bookinginventory->quantity_type = $inventory_quantity_type;
            $result_items = $bookinginventory->save();
        }


        if (!$result || !$result_date || !$result_items || !$result_status) {
            DB::rollBack();
            return Helper::response(false, "Couldn't save data");
        }

        DB::commit();
        return Helper::response(true, "save data successfully", ["booking" => Booking::with('movement_dates')->with('inventories')->with('status_history')->findOrFail($booking->id)]);
    }

    public static function confirmBooking($public_booking_id, $service_type, $user_id)
    {

        $exist = Booking::where(["user_id" => $user_id,
            "public_booking_id" => $public_booking_id])->first();
        if (!$exist) {
            return Helper::response(false, "Order is not Exist");
        }

        if ($exist['status'] != BookingEnums::$STATUS['enquiry']) {
            return Helper::response(false, "This order is not in Enquiry Status");
        }

        $booking_type = $service_type == 0 ? BookingEnums::$BOOKING_TYPE['economic'] : BookingEnums::$BOOKING_TYPE['premium'];

        $timing = Settings::where("key", "bid_time")->pluck('value')[0];
        $complete_time = Carbon::now()->addMinutes($timing)->roundMinutes()->format("Y-m-d H:i:s");

        $meta = json_decode($exist['meta'], true);
        $meta = json_decode($exist['meta'], true);
        $meta['timings']['bid_result'] = $complete_time;

        $confirmestimate = Booking::where(["user_id" => $exist->user_id,
            "public_booking_id" => $exist->public_booking_id])
            ->update(["final_estimated_quote" => json_decode($exist['quote_estimate'], true)[$service_type], "booking_type" => $booking_type,
                "status" => BookingEnums::$STATUS['placed'],
                "meta" => json_encode($meta),
                "bid_result_at" => $complete_time
            ]);

        $result_status = self::statusChange($exist->id, BookingEnums::$STATUS['placed']);

        if (!$confirmestimate && !$result_status) {
            return Helper::response(false, "Couldn't save data");
        }
        $booking_id = $exist->id;

        dispatch(function() use($booking_id, $user_id,$complete_time, $public_booking_id) {
            BidController::addvendors($booking_id);
            NotificationController::sendTo("user", [$user_id], "Your booking has been confirmed.", "We are get the best price you. You will be notified soon.", [
                "type" => NotificationEnums::$TYPE['booking'],
                "public_booking_id" => $public_booking_id,
                "booking_status" => BookingEnums::$STATUS['biding']
            ]);
        })->afterResponse();

        return Helper::response(true, "updated data successfully", ["booking" => Booking::with('movement_dates')->with('inventories')->with('status_history')->where("public_booking_id", $public_booking_id)->first()]);

    }

    public static function cancelBooking($public_booking_id, $reason, $desc, $user_id)
    {
        $exist = Booking::where(["user_id" => $user_id,
            "public_booking_id" => $public_booking_id])->first();
        if (!$exist) {
            return Helper::response(false, "Order is not Exist");
        }

        if ($exist['status'] == BookingEnums::$STATUS['cancelled']) {
            return Helper::response(false, "This order is already cancelled");
        }

        $cancelbooking = Booking::where(["user_id" => $exist->user_id,
            "public_booking_id" => $exist->public_booking_id])
            ->update(["status" => BookingEnums::$STATUS['cancelled'], "cancelled_meta" => json_encode(["reason" => $reason, "desc" => $desc], true)]);

        // $bookingstatus = new BookingStatus;
        // $bookingstatus->booking_id = $exist->id;
        // $bookingstatus->status=BookingEnums::$STATUS['cancelled'];
        // $result_status = $bookingstatus->save();

        $result_status = self::statusChange($exist->id, BookingEnums::$STATUS['cancelled']);

        if (!$cancelbooking && !$result_status) {
            return Helper::response(false, "Couldn't save data");
        }

        dispatch(function () use ($exist) {

            NotificationController::sendTo("user", [$exist->user_id], "Your booking has been cancelled.", "You may place another request anytime.", [
                "type" => NotificationEnums::$TYPE['general'],
                "public_booking_id" => $exist->public_booking_id,
                "booking_status" => BookingEnums::$STATUS['cancelled']
            ]);

        })->afterResponse();

        return Helper::response(true, "updated data successfully", ["booking" => Booking::with('movement_dates')->with('inventories')->with('status_history')->where("public_booking_id", $public_booking_id)->first()]);
    }

    public static function getBookingByPublicIdForApp($public_booking_id, $user_id)
    {
        $booking = Booking::where("public_booking_id", $public_booking_id)
            //            ->where("user_id", $user_id)
            ->where("deleted", CommonEnums::$NO)->orderBy('id', 'DESC')
            ->with('movement_dates')
            ->with('inventories')
            ->with('status_history')
            ->with('organization')
            ->with('service')
            ->with('payment')
            ->with(['movement_specifications' => function ($movement_specifications) use ($public_booking_id) {
                $movement_specifications->where('booking_id', Booking::where(['public_booking_id' => $public_booking_id])->pluck('id')[0])
                    ->where('status', BidEnums::$STATUS['won']);
            }
            ])
            ->with('driver')
            ->with('vehicle')
            ->with('review')
            ->with(['bid'=>function($query){
                $query->where('status', BidEnums::$STATUS['won']);
            }])
            ->first();

        if (!$booking) {
            return Helper::response(false, "Invalid Booking id");
        }

        return Helper::response(true, "data fetched successfully", ["booking" => $booking]);
    }

    public static function bookingHistoryPast($user_id)
    {
        $bookingorder = Booking::where(["deleted" => CommonEnums::$NO,
            "user_id" => $user_id])
            ->whereIn("status", [BookingEnums::$STATUS["cancelled"], BookingEnums::$STATUS['completed']])
            ->orderBy('id', 'DESC')
            ->with('movement_dates')
            ->with('inventories')->with('status_history')->with('service')
            ->get();

        if (!$bookingorder) {
            return Helper::response(false, "No Booking Found");
        }

        return Helper::response(true, "Data fetched successfully", ["booking" => $bookingorder]);
    }

    public static function bookingHistoryLive($user_id)
    {
        $bookingorder = Booking::where(["deleted" => CommonEnums::$NO,
            "user_id" => $user_id])
            ->whereNotIn("status", [BookingEnums::$STATUS["enquiry"], BookingEnums::$STATUS["cancelled"], BookingEnums::$STATUS['completed']])
            ->orderBy('id', 'DESC')
            ->with('movement_dates')
            ->with('inventories')->with('status_history')->with('service')
            ->get();

        if (!$bookingorder) {
            return Helper::response(false, "No Booking Found");
        }

        return Helper::response(true, "Data fetched successfully", ["booking" => $bookingorder]);
    }

    public static function reschedulBooking($public_booking_id, $dates, $user_id)
    {
        $exist = Booking::where(["user_id" => $user_id,
            "public_booking_id" => $public_booking_id])->first();
        if (!$exist)
            return Helper::response(false, "Order is not Exist");

        MovementDates::where("booking_id", $exist->id)->delete();

        foreach ($dates as $value) {
            $movementdates = new MovementDates;
            $movementdates->booking_id = $exist->id;
            $movementdates->date = $value;
            $result_date = $movementdates->save();
        }

        dispatch(function () use ($exist) {

            NotificationController::sendTo("user", [$exist->user_id], "Your booking has been rescheduled.", "If you haven't requested this, contact our support.", [
                "type" => NotificationEnums::$TYPE['general'],
                "public_booking_id" => $exist->public_booking_id
            ]);

        })->afterResponse();

        return Helper::response(true, "save data successfully", ["booking" => Booking::with('movement_dates')->with('inventories')->with('status_history')->findOrFail($exist->id)]);
    }

    public static function getfinalquote($public_booking_id, $user_id)
    {
        $exist = Booking::where(["user_id" => $user_id,
            "public_booking_id" => $public_booking_id])
            ->where("status", BookingEnums::$STATUS['payment_pending'])->first();
        if (!$exist)
            return Helper::response(false, "Order is not Exist");

        return Helper::response(true, "save data successfully", ["booking" => Booking::with('movement_dates')->with('inventories')->with('status_history')->findOrFail($exist->id)]);
    }

    public static function getPaymentDetails($public_booking_id, $discount_amount = 0.00)
    {
        $booking = Booking::where("public_booking_id", $public_booking_id)
            ->where("status", BookingEnums::$STATUS['payment_pending'])->with('payment')->first();
        if (!$booking)
            return Helper::response(false, "Order is not Exist");

        if (!$booking->payment)
            return Helper::response(false, "Payment data not found in database. This is a critical error. Please contact the admin.");

        $tax_percentage = Settings::where("key", "tax")->pluck('value')[0];

        Payment::where('booking_id', $booking->id)
            ->update(['discount_amount' => 0.00, 'coupon_code' => null, 'tax' => ($booking->final_quote + $booking->payment->other_charges) * ($tax_percentage / 100),
                'grand_total' => ($booking->final_quote + $booking->payment->other_charges) + (($booking->final_quote + $booking->payment->other_charges) * ($tax_percentage / 100))]);

        $booking = Booking::where("public_booking_id", $public_booking_id)
            ->where("status", BookingEnums::$STATUS['payment_pending'])->with('payment')->first();

        $tax = $booking->payment->tax;
        $grand_total = $booking->payment->grand_total;

        if ($discount_amount > 0.00) {
            $grand_total = ($booking->payment->sub_total + $booking->payment->other_charges) - $discount_amount;
            $tax = $grand_total * ($tax_percentage / 100);
            $grand_total += $tax;
        }

        return Helper::response(true, "Get payment data successfully", ["payment_details" => [
            "sub_total" => $booking->payment->sub_total,
            "surge_charge" => $booking->payment->other_charges,
            "discount" => $discount_amount,
            "tax(" . $tax_percentage . "%)" => $tax,
            "grand_total" => $grand_total
        ]]);

    }

    public static function getBookingsForVendorApp(Request $request, $web=false)
    {
        // $limit=CommonEnums::$PAGE_LENGTH;
        // $offset=0;
        if($web) {
            $organization_id = Session::get('organization_id');
            $vendor_id = Session::get('account')['id'];
        }
        else {
            $organization_id = $request->token_payload->organization_id;
            $vendor_id = $request->token_payload->id;;
        }

        $bid_id = Bid::where("organization_id", $organization_id);

        switch ($request->type) {
            case "live":
                $bid_id->where("status", BidEnums::$STATUS['active']);
                break;

            case "scheduled":
                $bid_id->where("status", BidEnums::$STATUS['won'])->where("vendor_id", $vendor_id);
                break;

            case "bookmarked":
                $bid_id->where("bookmarked", CommonEnums::$YES);
                break;

            case "participated":
                $bid_id->whereIn("status", [BidEnums::$STATUS['bid_submitted'], BidEnums::$STATUS['lost']])->where(["vendor_id"=>$vendor_id]);
                break;

            case "past":
                $bid_id->where("status", BidEnums::$STATUS['won']);
                break;
        }

        $bookings = Booking::whereIn("id", $bid_id
            ->pluck('booking_id'));

        if($web)
        {
            if(isset($request->search)){
                $bookings=$bookings->where('public_booking_id', 'like', $request->search."%")
                    ->orWhere('source_meta', 'like', "%".$request->search."%")
                    ->orWhere('destination_meta', 'like', "%".$request->search."%");
            }
        }

        $bookings ->orderBy('id', 'DESC')
            ->with('user');
            if($request->type == "participated" || $request->type == "past")
                $bookings->with('status_history');

            if($request->type == "past")
                $bookings->whereIn("status", [BookingEnums::$STATUS['completed'], BookingEnums::$STATUS['cancelled']]);

            if($request->type == "scheduled")
                $bookings->whereNotIn("status", [BookingEnums::$STATUS['completed'], BookingEnums::$STATUS['cancelled']]);

        $bookings->with('service')
            ->with('movement_dates')
            ->with(['bid' => function ($bid) use ($organization_id) {
                $bid->where("organization_id", $organization_id)->with('vendor');
            }]);

        if (isset($request->from) && isset($request->to))
            $bookings->where('created_at', '>=', date("Y-m-d H:i:s", strtotime($request->from)))->where('created_at', '<=', date("Y-m-d H:i:s", strtotime($request->to)))->where('organization_id', $organization_id);

        if (isset($request->status))
            $bookings->orWhere('status', $request->status)->where('organization_id', $organization_id);

        if (isset($request->service_id))
            $bookings->where('service_id', $request->service_id)->where('organization_id', $organization_id);

        $bookings = $bookings->paginate(CommonEnums::$PAGE_LENGTH);

        if($web)
            return $bookings;
        else
            return Helper::response(true, "Show data successfully", ["bookings" => $bookings->items(), "paging" => [
            "current_page" => $bookings->currentPage(), "total_pages" => $bookings->lastPage(), "next_page" => $bookings->nextPageUrl(), "previous_page" => $bookings->previousPageUrl()
        ]]);
    }

    public static function getBookingsForDriverApp(Request $request)
    {
        $booking = Booking::whereIn('id', BookingDriver::where('driver_id', $request->token_payload->id)->pluck('booking_id'));

        switch ($request->type) {
            case "scheduled":
                $booking->whereIn("status", [BookingEnums::$STATUS['awaiting_pickup'], BookingEnums::$STATUS['in_transit']]);
                break;

            case "past":
                $booking->whereIn("status", [BookingEnums::$STATUS['completed'], BookingEnums::$STATUS['cancelled']]);
                break;
        }


        if (isset($request->from) && isset($request->to))
            $booking->where('created_at', '>=', date("Y-m-d H:i:s", strtotime($request->from)))->where('created_at', '<=', date("Y-m-d H:i:s", strtotime($request->to)))->where('organization_id', $request->token_payload->organization_id);

        if (isset($request->status))
            $booking->orWhere('status', $request->status)->where('organization_id', $request->token_payload->organization_id);

        if (isset($request->service_id))
            $booking->where('service_id', $request->service_id)->where('organization_id', $request->token_payload->organization_id);

        $booking->orderBy('id', 'DESC')
            ->with('user')
            ->with('status_history')
            ->with('service')
            ->with('movement_dates')
            ->with(['bid' => function ($bid) use ($request) {
                $bid->where("organization_id", $request->token_payload->organization_id)->with('vendor');
            }]);

        $booking = $booking->paginate(CommonEnums::$PAGE_LENGTH);

        return Helper::response(true, "Show data successfully", ["bookings" => $booking->items(), "paging" => [
            "current_page" => $booking->currentPage(), "total_pages" => $booking->lastPage(), "next_page" => $booking->nextPageUrl(), "previous_page" => $booking->previousPageUrl()
        ]]);
    }

    public static function getByIdForVendorApp(Request $request)
    {
        $organization_id = $request->token_payload->organization_id;
        $booking = Booking::where(["public_booking_id" => $request->public_booking_id])
            ->with('inventories')
            ->with('service')
            ->with('movement_dates')
            ->with('driver')
            ->with('vehicle')
            ->with(['bid' => function ($bid) use ($request) {
                $bid->where("organization_id", $request->token_payload->organization_id)
                    ->whereNotIn("status", [BidEnums::$STATUS['rejected'], BidEnums::$STATUS['expired']]);
            }])->with('user')->first();
        if($booking->bid->status == BidEnums::$STATUS['lost'])
            $booking->bid->statistics = self::getposition($request->token_payload->id, $request->public_booking_id);

        return Helper::response(true, "Show data successfully", ["booking" => $booking]);
    }

    public static function reject($id, $org_id, $vendor_id)
    {
        $exist_bid = Bid::where("organization_id", $org_id)
            ->where("booking_id", Booking::where(['public_booking_id' => $id])->pluck('id')[0])
            ->where(["status" => BidEnums::$STATUS['active']])
            ->first();
        if (!$exist_bid)
            return Helper::response(false, "Not in active state");

        if ($exist_bid['bookmarked'] == CommonEnums::$YES)
            $bookmark = Bid::where(['id' => $exist_bid['id']])->update(["bookmarked" => CommonEnums::$NO]);

        $reject = Bid::where(['id' => $exist_bid['id']])->update(["status" => BidEnums::$STATUS['rejected'], "vendor_id" => $vendor_id]);

        if (!$reject)
            return Helper::response(false, "Couldn't Reject");

        return Helper::response(true, "updated data successfully", ["bid" => Bid::FindOrFail($exist_bid['id'])]);
    }

    public static function addBookmark($id, $org_id, $vendor_id)
    {

        $exist_bid = Bid::where("organization_id", $org_id)
            ->where("booking_id", Booking::where(['public_booking_id' => $id])->pluck('id')[0])
            ->where(["status" => BidEnums::$STATUS['active']])
            ->first();
        if (!$exist_bid)
            return Helper::response(false, "Not in active state");


        if ($exist_bid->bookmarked == CommonEnums::$YES)
            $bookmarked = CommonEnums::$NO;
        else
            $bookmarked = CommonEnums::$YES;


        $result = Bid::where(['id' => $exist_bid['id']])
            ->update(["bookmarked" => $bookmarked, "vendor_id" => $vendor_id]);

        if (!$result)
            return Helper::response(false, "Couldn't Add to Bookmark");

        return Helper::response(true, "Book mark status changed to $bookmarked", ["bookmark" => Bid::where("id", $exist_bid['id'])->first()]);
    }

    public static function assignDriver($public_booking_id, $driver_id, $vehicle_id)
    {

        $assign_driver = Booking::where("public_booking_id", $public_booking_id)->where("status", ">", BookingEnums::$STATUS['payment_pending'])->first();

        if (!$assign_driver)
            return Helper::response(false, "Not in active state");

        $get_driver = BookingDriver::where("booking_id", $assign_driver['id'])->first();

        $save_driver = new BookingDriver;
        $save_driver->booking_id = $assign_driver['id'];
        $save_driver->driver_id = $driver_id;
        $save_driver->vehicle_id = $vehicle_id;
        $result_driver = $save_driver->save();

        $assign_driver_status = Booking::where(['public_booking_id' => $public_booking_id, 'id' => $assign_driver['id']])
            ->update(["status" => BookingEnums::$STATUS['awaiting_pickup']]);

        // $bookingstatus = new BookingStatus;
        // $bookingstatus->booking_id = $assign_driver->id;
        // $bookingstatus->status=BookingEnums::$STATUS['pending_driver_assign'];
        // $result_status = $bookingstatus->save();

        $result_status = self::statusChange($assign_driver->id, BookingEnums::$STATUS['awaiting_pickup']);

        dispatch(function () use ($assign_driver) {

            NotificationController::sendTo("user", [$assign_driver->user_id], "Driver has been assigned for your movement.", "Tap to view details.", [
                "type" => NotificationEnums::$TYPE['booking'],
                "public_booking_id" => $assign_driver->public_booking_id,
                "booking_status" => BookingEnums::$STATUS['pending_driver_assign']
            ]);

        })->afterResponse();

        if (!$result_driver && !$assign_driver_status)
            return Helper::response(false, "couldn't sanve");

        return Helper::response(true, "save successfully");
    }

    public static function startTrip($public_booking_id, $organization_id, $pin)
    {
        $booking = Booking::where([
            "public_booking_id" => $public_booking_id,
            "organization_id" => $organization_id,
            "status" => BookingEnums::$STATUS['awaiting_pickup']
        ])->first();

        if (!$booking)
            return Helper::response(false, "Invalid Order id");
        $meta = json_decode($booking->meta, true);
        if ($meta['start_pin'] == $pin) {
            $meta["end_pin"] = Helper::generateOTP(4);

            Booking::where("public_booking_id", $public_booking_id)->update([
                "status" => BookingEnums::$STATUS['in_transit'],
                "meta" => $meta
            ]);

            // $bookingstatus = new BookingStatus;
            // $bookingstatus->booking_id = $booking->id;
            // $bookingstatus->status=BookingEnums::$STATUS['in_transit'];
            // $result_status = $bookingstatus->save();

            $result_status = self::statusChange($booking->id, BookingEnums::$STATUS['in_transit']);

            dispatch(function () use ($booking) {

                NotificationController::sendTo("user", [$booking->user_id], "Hurray! Your trip has been started.", "Your home will be delivered safely.", [
                    "type" => NotificationEnums::$TYPE['booking'],
                    "public_booking_id" => $booking->public_booking_id
                ]);

            })->afterResponse();

            return Helper::response(true, "Your trip Has been started.");
        } else {
            return Helper::response(false, "You have entered a wrong pin");
        }

    }

    public static function endTrip($public_booking_id, $organization_id, $pin)
    {
        $booking = Booking::where([
            "public_booking_id" => $public_booking_id,
            "organization_id" => $organization_id,
            "status" => BookingEnums::$STATUS['in_transit']
        ])->first();

        if (!$booking)
            return Helper::response(false, "Invalid Order id");
        $meta = json_decode($booking->meta, true);
        if ($meta['end_pin'] == $pin) {

            Booking::where("public_booking_id", $public_booking_id)->update([
                "status" => BookingEnums::$STATUS['completed']
            ]);

            // $bookingstatus = new BookingStatus;
            // $bookingstatus->booking_id = $booking->id;
            // $bookingstatus->status=BookingEnums::$STATUS['completed'];
            // $result_status = $bookingstatus->save();

            $result_status = self::statusChange($booking->id, BookingEnums::$STATUS['completed']);

            dispatch(function () use ($booking) {

                NotificationController::sendTo("user", [$booking->user_id], "Your booking has been completed.", "Thankyou for choosing Biddnest.", [
                    "type" => NotificationEnums::$TYPE['booking'],
                    "public_booking_id" => $booking->public_booking_id
                ]);

            })->afterResponse();
            return Helper::response(true, "Your order has been completed.");
        } else {
            return Helper::response(false, "You have entered a wrong pin");
        }
    }

    public static function getRecentBooking($user_id)
    {
        $bookingorder = Booking::where(["deleted" => CommonEnums::$NO, "user_id" => $user_id])
            ->whereNotIn("status", [BookingEnums::$STATUS["enquiry"], BookingEnums::$STATUS["cancelled"], BookingEnums::$STATUS['completed']])->with('driver')->orderBy('id', 'DESC')->first();

        if (!$bookingorder)
            return Helper::response(false, "No Booking Found");

        return Helper::response(true, "Data fetched successfully", ["booking" => $bookingorder]);
    }

    public static function statusChange($booking_id, $status)
    {
        $bookingstatus = new BookingStatus;
        $bookingstatus->booking_id = $booking_id;
        $bookingstatus->status = $status;
        $result_status = $bookingstatus->save();

        if (!$result_status)
            return Helper::response(false, "couldn'd change status");

        return true;
    }

    public static function getposition($vendor_id, $public_booking_id)
    {
        $exist_booking = Booking::where('public_booking_id', $public_booking_id)->first();
        if (!$exist_booking)
            return Helper::response(false, "Booking is not Exist");

        $data = [];

        /*{
            "amount",
            "position"
        }*/

        $current_key = true;
        $bid_records = Bid::where('booking_id', $exist_booking['id'])->whereIn('status', [BidEnums::$STATUS['lost'], BidEnums::$STATUS['won']])->orderBy('bid_amount', 'ASC')->get();
        foreach ($bid_records as $key => $value) {
            if ($value['vendor_id'] == $vendor_id) {
                $current_key = $key;
                break;
            }
        }

        $x = [];
        $y = [];
        for ($i = $key; $i >= $i - 3; $i--) {

            if ($i >= 0) {
                $x[] = $i + 1;
                $y[] = $bid_records[$i]['bid_amount'];
                array_push($data, [
                    "amount" => $bid_records[$i]['bid_amount'],
                    "position" => $i + 1,
                ]);
            } else
                break;
        }

        $data = array_reverse($data);
        $x = array_reverse($x);
        $y = array_reverse($y);
        return ["rank" => $current_key + 1, "data" => $data, "axis" => ["x" => $x, "y" => $y]];

    }
}
