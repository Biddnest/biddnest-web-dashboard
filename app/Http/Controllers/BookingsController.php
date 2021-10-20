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
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManager;

//use App\Http\Controllers\BookingController;

class BookingsController extends Controller
{

    public static function createEnquiryForAdmin(Request $request)
    {
        $user = User::where("phone", $request->phone)
            ->orWhere("email", $request->email)
            ->first();
        if ($user) {
            $user_id = $user->id;

            $fname = explode($request->contact_details['name'], " ")[0];
            $lname = str_replace($fname, "", $request->contact_details['name']);

            UserController::directupdate($request->contact_details['phone'], $fname, $lname, $request->contact_details['email'], $user_id);
        } else {
            $fname = explode($request->contact_details['name'], " ")[0];
            $lname = str_replace($fname, "", $request->contact_details['name']);

            $newuser = UserController::directSignup($request->contact_details['phone'], $fname, $lname, $request->contact_details['email']);

            $user_id = $newuser->id;
        }
         $movement_dates = explode(",", $request->movement_dates);
//        $movement_dates =$request->movement_dates;

        return self::createEnquiry($request->all(), $user_id, $movement_dates, false, true);

    }

    public static function createEnquiry($data, $user_id, $movement_dates, $web = false, $created_by_support = false)
{
    /*if (App::environment('production')) {
        $exsist = Booking::where(["user_id" => $user_id,
            "deleted" => CommonEnums::$NO])
            ->where("status", "!=", BookingEnums::$STATUS["cancelled"])
            ->where("service_id", $data['service_id'])
            ->whereBetween("created_at", [Carbon::now()->subMinutes(30), Carbon::now()])
            ->get();

        if ($exsist) {
            return Helper::response(false, "You already have a pending order. You can not place further bookings in this service category.");
        }
    }*/
    DB::beginTransaction();

    $inventory_quantity_type = Service::where("id", $data['service_id'])->pluck('inventory_quantity_type')[0];
    if ($inventory_quantity_type != ServiceEnums::$INVENTORY_QUANTITY_TYPE["fixed"] && $inventory_quantity_type != ServiceEnums::$INVENTORY_QUANTITY_TYPE["range"]) {
        DB::rollBack();
        return Helper::response(false, "Unkown Service Type, Couldn't Proceed");
    }

    $booking = new Booking;
    $booking_id = "BDO-" . uniqid();
    $enquiry_id = "ENQ-" . uniqid();
    $booking->public_booking_id = strtoupper($booking_id);
    $booking->public_enquiry_id = strtoupper($enquiry_id);
    $booking->user_id = (int)$user_id;
    $booking->service_id = $data['service_id'];
    $booking->source_lat = $data['source']['lat'];
    $booking->source_lng = $data['source']['lng'];
    $booking->source_meta = json_encode(["geocode" => $data['source']['meta']['geocode'],
        "floor" => $data['source']['meta']['floor'],
        "address" => $data['source']['meta']['address_line1'] . " " . $data['source']['meta']['address_line2'],
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
        "address" => $data['destination']['meta']['address_line1'] . " " . $data['destination']['meta']['address_line2'],
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

    if ($web)
        $booking->created_through_channel = BookingEnums::$CREATED_THROUGH_CHANNEL['web'];

    if ($created_by_support)
        $booking->created_through_channel = BookingEnums::$CREATED_THROUGH_CHANNEL['support'];

    $images = [];
    $imageman = new ImageManager(array('driver' => 'gd'));
    if ($web || $created_by_support) {
        if ($data['meta']['images'][0] != "") { //need to remove [0]==> temp fixed
            foreach ($data['meta']['images'] as $key => $image) {
                $images[] = Helper::saveFile($imageman->make($image)->encode('png', 75), "BD" . uniqid() . $key . ".png", "bookings/" . $booking_id);
            }
        }
    } else {
        foreach ($data['meta']['images'] as $key => $image) {
            $images[] = Helper::saveFile($imageman->make($image)->encode('png', 75), "BD" . uniqid() . $key . ".png", "bookings/" . $booking_id);
        }
    }

    $zone_id = GeoController::getNearestZone($data['source']['lat'], $data['source']['lng']);

    $economic_price = 0;
    $primium_price = 0;
    $vendor_primium_price = 0;
    $vendor_economic_price = 0;

    $estimate_quote = json_encode(["economic" => $economic_price, "premium" => $primium_price]);
    $org_estimate_quote = json_encode(["economic" => $vendor_economic_price, "premium" => $vendor_primium_price]);

    $booking->quote_estimate = $estimate_quote;
    $distance = GeoController::distance($data['source']['lat'], $data['source']['lng'], $data['destination']['lat'], $data['destination']['lng']);
    $booking->meta = json_encode(["self_booking" => $data['meta']['self_booking'],
        "subcategory" => $data['meta']['subcategory'],
        "customer" => ["remarks" => $data['meta']['customer']['remarks']],
        "images" => $images,
        "timings" => null,
        "distance" => $distance]);
    $booking->status = BookingEnums::$STATUS['enquiry'];
    $booking->zone_id = $zone_id;
    $booking->organization_quote_estimate = $org_estimate_quote;
    $result = $booking->save();

    $result_status = self::statusChange($booking->id, BookingEnums::$STATUS['enquiry']);

//        Log::info("Booking Dates recieved from web- ",$movement_dates);
    foreach ($movement_dates as $dates) {
        $movementdates = new MovementDates;
        $movementdates->booking_id = $booking->id;
        $movementdates->date = Carbon::parse($dates)->format('Y-m-d');//date('', strtotime($dates));
        $result_date = $movementdates->save();
    }

    foreach ($data["inventory_items"] as $items) {

        if ($web || $created_by_support) {
            $quantity = $inventory_quantity_type == ServiceEnums::$INVENTORY_QUANTITY_TYPE['fixed'] ? $items['quantity'] : json_encode(["min" => explode(";", $items['quantity'])[0], "max" => explode(";", $items['quantity'])[1]]);
        } else {
            $quantity = $inventory_quantity_type == ServiceEnums::$INVENTORY_QUANTITY_TYPE['fixed'] ? $items['quantity'] : json_encode(["min" => $items['quantity']['min'], "max" => $items['quantity']['max']]);
        }

        $bookinginventory = new BookingInventory;
        $bookinginventory->booking_id = $booking->id;
        $bookinginventory->inventory_id = $items["inventory_id"];

        if ($items["inventory_id"] !== null)
            $bookinginventory->name = Inventory::where("id", $items['inventory_id'])->pluck('name')[0];
        else
            $bookinginventory->name = $items["name"];

        $bookinginventory->material = $items["material"];
        $bookinginventory->size = $items["size"];
        $bookinginventory->quantity = $quantity;
        $bookinginventory->quantity_type = $inventory_quantity_type;
        $bookinginventory->is_custom = $items["is_custom"];
        $result_items = $bookinginventory->save();
    }

    $booking_added = Booking::where("id", $booking->id)->first();
    try {

        $generate_prices = InventoryController::generateOrganizationBasePrices($data, $booking_added);
        if (!$generate_prices) {
            return Helper::response(false, "Couldn't generate prices.");
            DB::rollBack();
        }

        $estimate_quote = json_encode([
            "economic" => strtolower($data['meta']['subcategory']) == "custom" ? null : InventoryController::getEconomicPrice($data, $booking_added, $web, $created_by_support),
            "premium" => strtolower($data['meta']['subcategory']) == "custom" ? null : InventoryController::getPremiumPrice($data, $booking_added, $web, $created_by_support)
        ]);
        $org_estimate_quote = json_encode([
            "economic" => InventoryController::getEconomicPrice($data, $booking_added, true, $web, $created_by_support),
            "premium" => InventoryController::getPremiumPrice($data, $booking_added, true, $web, $created_by_support)
        ]);


    } catch (Exception $e) {
        DB::rollBack();
        return Helper::response(false, "Couldn't save data", ["error" => $e->getMessage()]);
    }

    $update_booking = Booking::where("id", $booking->id)
        ->update([
            "quote_estimate" => $estimate_quote,
            "organization_quote_estimate" => $org_estimate_quote,
        ]);

    if (!$result || !$result_date || !$result_items || !$result_status || !$update_booking) {
        DB::rollBack();
        return Helper::response(false, "Couldn't save data");
    }

    DB::commit();
    return Helper::response(true, "We received your enquiry.", ["booking" => Booking::with('movement_dates')->with('inventories')->with('status_history')->findOrFail($booking->id)]);
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

        $booking_type = $service_type == "economic" ? BookingEnums::$BOOKING_TYPE['economic'] : BookingEnums::$BOOKING_TYPE['premium'];

        $timing = Settings::where("key", "bid_time")->pluck('value')[0];
        $buffer = Settings::where("key", "buffer_time")->pluck('value')[0];
        $complete_time = Carbon::now()
            ->addMinutes($timing)
            ->addMinutes($buffer)
            ->roundMinutes()->format("Y-m-d H:i:s");

        $bid_end_time = Carbon::now()
            ->addMinutes($timing)
            ->roundMinutes()
            ->format("Y-m-d H:i:s");

        $meta = json_decode($exist['meta'], true);
        $meta['timings']['bid_result'] = $complete_time;
        $meta['timings']['bid_end'] = $bid_end_time;

        $confirmestimate = Booking::where(["user_id" => $exist->user_id,
            "public_booking_id" => $exist->public_booking_id])
            ->update([
                "final_estimated_quote" => round(json_decode($exist['quote_estimate'], true)[$service_type],2),
                "organization_rec_quote" => round(json_decode($exist['organization_quote_estimate'], true)[$service_type], 2),
                "booking_type" => $booking_type,
                "status" => BookingEnums::$STATUS['placed'],
                "meta" => json_encode($meta),
                "bid_result_at" => $complete_time,
                "bid_end_at" => $bid_end_time
            ]);

        $result_status = self::statusChange($exist->id, BookingEnums::$STATUS['placed']);

        if (!$confirmestimate && !$result_status) {
            return Helper::response(false, "Couldn't save data");
        }
        $booking_id = $exist->id;

        dispatch(function () use ($booking_id, $user_id, $complete_time, $public_booking_id) {
            NotificationController::sendTo("user", [$user_id], "Your booking has been recieved.", "We are getting the best price for you. You will be notified soon.", [
                "type" => NotificationEnums::$TYPE['booking'],
                "public_booking_id" => $public_booking_id,
                "booking_status" => BookingEnums::$STATUS['biding']
            ]);
            BidController::addvendors($booking_id);
        })->afterResponse();

        return Helper::response(true, "Thankyou for confirming.", ["booking" => Booking::with('movement_dates')->with('inventories')->with('status_history')->where("public_booking_id", $public_booking_id)->first()]);

    }

    public static function getBookingByPublicIdForApp($public_booking_id, $user_id, $web = false)
    {
        $booking = Booking::where("public_booking_id", $public_booking_id)
            //            ->where("user_id", $user_id)
            ->where("deleted", CommonEnums::$NO)->orderBy('id', 'DESC')
            ->with('movement_dates')
            ->with(['inventories' => function ($query) {
                $query->with('inventory');
            }])
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
            ->with(['bid' => function ($query) {
                $query->where('status', BidEnums::$STATUS['won']);
            }])
            ->first();

        if (!$booking) {
            return Helper::response(false, "Invalid Booking id");
        }

        if ($web)
            return $booking;
        else
            return Helper::response(true, "data fetched successfully", ["booking" => $booking]);
    }

    /*Duplicating above function cos its giving error in mobile app*/
    public static function getBookingByPublicIdForWeb($public_booking_id, $user_id, $web = true)
    {
        $booking = Booking::where("user_id", $user_id)
            ->where("deleted", CommonEnums::$NO)
            ->with('movement_dates')
            ->with(['inventories' => function ($query) {
                $query->with('inventory');
            }])
            ->with('status_history')
            ->with('organization')
            ->with('service')
            ->with('payment')
            ->with('driver')
            ->with('vehicle')
            ->with('review')
            ->with('payment')
            ->with(['movement_specifications' => function ($movement_specifications) use ($public_booking_id) {
                $movement_specifications->where('booking_id', Booking::where(['public_enquiry_id' => $public_booking_id])->orWhere("public_booking_id", $public_booking_id)->pluck('id')[0])
                    ->where('status', BidEnums::$STATUS['won']);
            }
            ])
            ->where(function ($query) use ($public_booking_id) {
                $query->where("public_enquiry_id", $public_booking_id)
                    ->orWhere("public_booking_id", $public_booking_id);
            })
            ->first();

        if (!$booking) {
            return abort(404);
        }

        return $booking;
    }

    public static function bookingHistoryEnquiry($user_id, $web = false)
    {

        $bookingorder = Booking::where(["deleted" => CommonEnums::$NO,
            "user_id" => $user_id])
            ->where(function($query){
            $query->where("status", "<=", BookingEnums::$STATUS["payment_pending"])
            ->orWhereIn("status", [BookingEnums::$STATUS['awaiting_bid_result'], BookingEnums::$STATUS['price_review_pending']]);
            })
            ->where("deleted", CommonEnums::$NO)
            ->with('movement_dates')
            ->with(['bid' => function ($query) {
                $query->where('status', BidEnums::$STATUS['won']);
            }])
//            ->with('status_history')
            ->with('service')
            ->orderBy('id', 'DESC')
            ->get();

        /*if (!$bookingorder) {
            return Helper::response(false, "No Booking Found");
        }*/
        if ($web)
            return $bookingorder;
        else
            return Helper::response(true, "Data fetched successfully", ["booking" => $bookingorder]);
    }

    public static function bookingHistoryPast($user_id, $web = false)
    {
        $bookingorder = Booking::where(["deleted" => CommonEnums::$NO,
            "user_id" => $user_id])
            ->whereIn("status", [BookingEnums::$STATUS["cancelled"], BookingEnums::$STATUS['completed'], BookingEnums::$STATUS['cancel_request']])
            ->where("deleted", CommonEnums::$NO)
            ->orderBy('id', 'DESC')
            ->with('movement_dates')
            ->with('inventories')->with('status_history')->with('service')
            ->with('payment')
            ->with('driver')
            ->with('vehicle')
            ->with('review')
            ->with(['bid' => function ($query) {
                $query->where('status', BidEnums::$STATUS['won']);
            }])
            ->get();

        if (!$bookingorder) {
            return Helper::response(false, "No Booking Found");
        }

        if ($web)
            return $bookingorder;
        else
            return Helper::response(true, "Data fetched successfully", ["booking" => $bookingorder]);
    }

    public static function bookingHistoryLive($user_id, $web = false)
    {
        $bookingorder = Booking::where(["deleted" => CommonEnums::$NO,
            "user_id" => $user_id])
            ->whereNotIn("status", [BookingEnums::$STATUS["cancelled"], BookingEnums::$STATUS['completed'], BookingEnums::$STATUS['bounced'], BookingEnums::$STATUS['hold'], BookingEnums::$STATUS['cancel_request'], BookingEnums::$STATUS['in_progress'], BookingEnums::$STATUS['awaiting_bid_result'], BookingEnums::$STATUS['price_review_pending']])
            ->where("status", ">", BookingEnums::$STATUS["payment_pending"])
            ->where("deleted", CommonEnums::$NO)
            ->with('movement_dates')
//            ->with('inventories')
//            ->with('status_history')
            ->with('service')
            ->with(['bid' => function ($query) {
                $query->where('status', BidEnums::$STATUS['won']);
            }])
            ->orderBy('id', 'DESC')
            ->get();

        /*if (!$bookingorder) {
            return Helper::response(false, "No Booking Found");
        }*/
        if ($web)
            return $bookingorder;
        else
            return Helper::response(true, "Data fetched successfully", ["booking" => $bookingorder]);
    }

    public static function reschedulBooking($public_booking_id, $date)
    {
        $exist = Booking::where(["public_booking_id" => $public_booking_id])->first();
        if (!$exist)
            return Helper::response(false, "Order is not Exist");

//        MovementDates::where("booking_id", $exist->id)->delete();


        $movementdates = new MovementDates;
        $movementdates->booking_id = $exist->id;
        $movementdates->date = $date;
        $result_date = $movementdates->save();

        $bid_exist = Bid::where(["booking_id" => $exist->id, "organization_id" => $exist->organization_id, "status" => BidEnums::$STATUS['won']])->first();
        $meta = json_decode($bid_exist['meta'], true);
        $meta['moving_date'] = $date;

        Bid::where(["booking_id" => $exist->id, "organization_id" => $exist->organization_id, "status" => BidEnums::$STATUS['won']])
            ->update([
                "meta" => json_encode($meta)
            ]);

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

    public static function getPaymentDetails($public_booking_id, $discount_amount = 0.00, $web = false)
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

        $dates = Bid::where(["organization_id" => $booking->organization_id, "booking_id" => $booking->id])->pluck("moving_dates")[0];

        if ($discount_amount > 0.00) {
            $grand_total = $booking->payment->sub_total - $discount_amount;
            $tax = $grand_total * ($tax_percentage / 100);
            $grand_total += $tax;
        }

        if ($web) {
            $summary = [
                "sub_total" => $booking->payment->sub_total,
                // "surge_charge" => $booking->payment->other_charges,
                "discount" => $discount_amount,
                "tax" => $tax,
                "tax_percentage" => $tax_percentage,
                "grand_total" => $grand_total,
                "dates" => $dates
            ];
            return $summary;
        } else
            return Helper::response(true, "Get payment data successfully", ["payment_details" => [
                "sub_total" => $booking->payment->sub_total + $booking->payment->other_charges,
//                "surge_charge" => $booking->payment->other_charges,
                "discount" => $discount_amount,
                "tax(" . $tax_percentage . "%)" => $tax,
                "grand_total" => $grand_total
            ], "dates" => $dates]);

    }

    public static function getBookingsForVendorApp(Request $request, $web = false)
    {
        // $limit=CommonEnums::$PAGE_LENGTH;
        // $offset=0;
        if ($web) {
            $organization_id = Session::get('organization_id');
            $vendor_id = Session::get('account')['id'];
        } else {
            $organization_id = $request->token_payload->organization_id;
            $vendor_id = $request->token_payload->id;
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
                $bid_id->whereIn("status", [BidEnums::$STATUS['bid_submitted'], BidEnums::$STATUS['lost']])->where(["vendor_id" => $vendor_id]);
                break;

            case "past":
                $bid_id->where("status", BidEnums::$STATUS['won']);
                break;

            case "rejected":
                $bid_id->where("status", BidEnums::$STATUS['rejected']);
                break;
        }

        $bookings = Booking::whereIn("id", $bid_id->pluck('booking_id'))
            ->whereNotIn('status', [BookingEnums::$STATUS['bounced'], BookingEnums::$STATUS['cancel_request'], BookingEnums::$STATUS['in_progress'], BookingEnums::$STATUS['cancel_request'],
//                BookingEnums::$STATUS['awaiting_bid_result'],
                BookingEnums::$STATUS['price_review_pending']
            ]);

        if ($web) {
            if (isset($request->search)) {
                $bookings = $bookings->where('public_booking_id', 'like', "%" . $request->search . "%")
                    ->orWhere('public_enquiry_id', 'like', "%" . $request->search . "%")
                    ->orWhere('source_meta', 'like', "%" . $request->search . "%")
                    ->orWhere('destination_meta', 'like', "%" . $request->search . "%");
            }
        }

        $bookings->orderBy('id', 'DESC')->with('user');
        if ($request->type == "participated" || $request->type == "past")
            $bookings->with('status_history');


        $bookings->where("status", "!=", BookingEnums::$STATUS['hold'])
            ->with('service')
            ->with('movement_dates')
            ->with(['bid' => function ($bid) use ($organization_id) {
                $bid->where("organization_id", $organization_id)
                    ->with('watched_by')
                    ->with('vendor')
                    ->with('bookmarked_by')
                    ->with('rejected_by');
            }]);

        if (isset($request->from) && isset($request->to)) {
            switch ($request->type) {
                case "live":
                    $booking_ids = MovementDates::whereDate('date', '>=', date("Y-m-d", strtotime($request->from)))->whereDate('date', '<=', date("Y-m-d", strtotime($request->to)))->groupBy('booking_id')->pluck('booking_id');
                    break;

                case "scheduled":
                    $booking_ids = Booking::whereDate('final_moving_date', '>=', date("Y-m-d", strtotime($request->from)))->whereDate('final_moving_date', '<=', date("Y-m-d", strtotime($request->to)))->groupBy('id')->pluck('id');
                    break;

                case "bookmarked":
                    $booking_ids = MovementDates::whereDate('date', '>=', date("Y-m-d", strtotime($request->from)))->whereDate('date', '<=', date("Y-m-d", strtotime($request->to)))->groupBy('booking_id')->pluck('booking_id');
                    break;
            }
            $bookings->whereIn('id', $booking_ids)->where('organization_id', $organization_id);
        }

        if (isset($request->status))
            $bookings->where('status', $request->status)->where('organization_id', $organization_id);
        else {
            if ($request->type == "live")
                $bookings->whereIn("status", [BookingEnums::$STATUS['biding'], BookingEnums::$STATUS['rebiding']]);

            if ($request->type == "past")
                $bookings->whereIn("status", [BookingEnums::$STATUS['completed'], BookingEnums::$STATUS['cancelled']]);

            if ($request->type == "scheduled")
                $bookings->whereNotIn("status", [BookingEnums::$STATUS['completed'], BookingEnums::$STATUS['cancelled']]);
        }

        if (isset($request->service_id))
            $bookings->where('service_id', $request->service_id)->where('organization_id', $organization_id);

        $bookings = $bookings->paginate(CommonEnums::$PAGE_LENGTH);

        if ($web)
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
            ->with('subservices')
            ->with('movement_dates')
            ->with('driver')
            ->with('vehicle')
            ->with(['bid' => function ($bid) use ($request) {
                $bid->where("organization_id", $request->token_payload->organization_id)
                    ->whereNotIn("status", [BidEnums::$STATUS['rejected'], BidEnums::$STATUS['expired']])
                    ->with('bookmarked_by')
                    ->with('rejected_by')
                    ->with('watched_by');
            }])->with('user')->first();

        if (isset($booking->bid) && $booking->bid->status == BidEnums::$STATUS['lost'])
            $booking->bid->statistics = self::getposition($request->token_payload->id, $request->public_booking_id);

        if (!$booking || !$booking->bid)
            return Helper::response(false, "Data Not Found", [], 404);

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

        $reject = Bid::where(['id' => $exist_bid['id']])->update(["status" => BidEnums::$STATUS['rejected'], "rejected_by" => $vendor_id]);

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
            ->update(["bookmarked" => $bookmarked, "bookmarked_by" => $vendor_id]);

        if (!$result)
            return Helper::response(false, "Couldn't Add to Bookmark");

        if ($exist_bid->bookmarked == CommonEnums::$YES)
            return Helper::response(true, "Book mark status removed successfully", ["bookmark" => Bid::where("id", $exist_bid['id'])->first()]);
        else
            return Helper::response(true, "Book mark status changed successfully", ["bookmark" => Bid::where("id", $exist_bid['id'])->first()]);

    }

    public static function assignDriver($public_booking_id, $driver_id, $vehicle_id)
    {

        $assign_driver = Booking::where("public_booking_id", $public_booking_id)->where("status", ">", BookingEnums::$STATUS['payment_pending'])->first();

        if (!$assign_driver)
            return Helper::response(false, "Not in active state");

        BookingDriver::where("booking_id", $assign_driver->id)->delete();

        $save_driver = new BookingDriver;
        $save_driver->booking_id = $assign_driver->id;
        $save_driver->driver_id = $driver_id;
        $save_driver->vehicle_id = $vehicle_id;
        $result_driver = $save_driver->save();

        $assign_driver_status = Booking::where(['public_booking_id' => $public_booking_id, 'id' => $assign_driver['id']])
            ->update(["status" => BookingEnums::$STATUS['awaiting_pickup']]);

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
                    "public_booking_id" => $booking->public_booking_id,
                    "booking_status" => BookingEnums::$STATUS['in_transit']
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
                    "public_booking_id" => $booking->public_booking_id,
                    "booking_status" => BookingEnums::$STATUS['completed']
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
            ->whereNotIn("status", [BookingEnums::$STATUS["bounced"], BookingEnums::$STATUS["hold"], BookingEnums::$STATUS["cancelled"], BookingEnums::$STATUS["cancel_request"], BookingEnums::$STATUS['completed']])->with('driver')->orderBy('id', 'DESC')->first();

        if (!$bookingorder)
            return Helper::response(false, "No Booking Found");

        return Helper::response(true, "Data fetched successfully", ["booking" => $bookingorder]);
    }

    public static function getposition($vendor_id, $public_booking_id)
    {
        $exist_booking = Booking::where('public_booking_id', $public_booking_id)->first();
        if (!$exist_booking)
            return Helper::response(false, "Booking is not Exist");

        $data = [];

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


            $data = array_reverse($data);
            $x = array_reverse($x);
            $y = array_reverse($y);
        }
        return ["rank" => $current_key + 1, "data" => $data, "axis" => ["x" => $x, "y" => $y]];

    }

    public static function rejectBooking($user_id, $public_booking_id, $reason, $desc, $request_callback = false)
    {
        $cancelled_meta = ["reason" => $reason, "desc" => $desc];

        $booking_id = Booking::where("public_booking_id", $public_booking_id)->pluck('id')[0];
        $status_change = Booking::where("id", $booking_id)
            ->update([
                "status" => BookingEnums::$STATUS['bounced'],
                "cancelled_meta" => json_encode($cancelled_meta)]);

        $status_add = BookingsController::statusChange($booking_id, BookingEnums::$STATUS['bounced']);

        if (!$status_change || !$status_add)
            return Helper::response(false, "Coudn't update status");

        if ($request_callback == true)
            TicketController::createRejectCall($user_id, 4, $public_booking_id);

        return Helper::response(true, "Booking Rejected Successfully", ["booking" => Booking::findOrFail($booking_id)]);
    }

    public static function statusChange($booking_id, $status)
    {
        $bookingstatus = new BookingStatus;
        $bookingstatus->booking_id = $booking_id;
        $bookingstatus->status = $status;
        $result_status = $bookingstatus->save();

        if (!$result_status)
            return Helper::response(false, "Couldn't change status");

        return true;
    }

    /*apis for websocket running in websocket.js*/

    public static function startVendorWatch($request)
    {
        $token = (object)Helper::validateAuthToken($request['token']);
        $vendor = Vendor::find($token->payload->id);
        if (!$token || !$vendor)
            return Helper::response(false, "Token validation failed.");

        Bid::where("booking_id", Booking::where('public_booking_id', $request['data']['public_booking_id'])->pluck('id')[0])
            ->where("organization_id", $token->payload->organization_id)
            ->update([
                "watcher_id" => $token->payload->id
            ]);

        return Helper::response(true, "Watching Started", ["booking" => Booking::where('public_booking_id', $request['data']['public_booking_id'])->with(["bid" => function ($query) use ($token) {
            $query->where("organization_id", $token->payload->organization_id)->with('watched_by');
        }])->first()]);


    }

    public static function stopVendorWatch($request)
    {
        $token = (object)Helper::validateAuthToken($request['token']);
        $vendor = Vendor::find($token->payload->id);
        if (!$token || !$vendor)
            return Helper::response(false, "Token validation failed.");

        Bid::where("booking_id", Booking::where('public_booking_id', $request['data']['public_booking_id'])->pluck('id')[0])
            ->where("watcher_id", $token->payload->id)
            ->where("organization_id", $token->payload->organization_id)
            ->update([
                "watcher_id" => null
            ]);

        return Helper::response(true, "Watching Ended", ["booking" => Booking::where('public_booking_id', $request['data']['public_booking_id'])->with(["bid" => function ($query) use ($token) {
            $query->where("organization_id", $token->payload->organization_id)->with('watched_by');
        }])->first()]);

    }

    /*This following api is not been used*/

    public static function sendDetailsToPhone($public_booking_id, $phone)
    {
        $booking = Booking::where("public_booking_id", $public_booking_id)
//            ->with('inventories')
            ->with('organization')
            ->with('service')
            ->with(['inventories' => function ($inve) {
                $inve->with('inventory');
            }])
            ->with('movement_dates')
            ->with('driver')
            ->with('vehicle')
            ->with('user')
            ->with(['bid' => function ($bid) {
                $bid->where("status", BidEnums::$STATUS['won']);
            }])
            ->first();

        if (!$booking)
            return Helper::response(false, "This booking doesn't exist. Could not proceed.");
        $inve = [];
        $inve1 = [];
        foreach ($booking->inventories as $key => $inventory) {
            $inve['0'] = $inventory->name;
            $inve['1'] = $inventory->size;
            $inve['2'] = $inventory->material;
            array_push($inve1, $inve);
        }

        $sms_body = "Hey there, I am shifting form " . json_decode($booking->source_meta, true)['address'] . " " . json_decode($booking->source_meta, true)['geocode'] . " to " . json_decode($booking->destination_meta, true)['address'] . " " . json_decode($booking->destination_meta, true)['geocode'] . " on " . json_decode($booking->bid->meta, true)['moving_date'] . "<br> Here are the details:  Vendor: " . $booking->organization->org_name;
//        $sms_body ="";
        dispatch(function () use ($phone, $sms_body) {
            Sms::send($phone, $sms_body);
        });


        return Helper::response(true, "Booking details have been send to $phone", ['sms' => $sms_body]);
    }

    /*End socket apis*/

    public static function getBookingsByUser($user_id, $count = 10, $web = false)
    {
        $bookings = Booking::where("user_id", $user_id)->orderBy("id", "DESC")->limit($count)->get();
        if ($web) {
            return $bookings;
        } else {
            return Helper::response(true, "Dropdown of Booking id's", ["bookings" => $bookings]);
        }
    }

    public static function getBookingsByVendor($org_id, $count = 10, $web = false)
    {
        $bookings = Booking::where("organization_id", $org_id)->orderBy("id", "DESC")->limit($count)->get();
        if ($web) {
            return $bookings;
        } else {
            return Helper::response(true, "Dropdown of Booking id's", ["bookings" => $bookings]);
        }
    }

    public static function trackCustomerData($data, $user_id, $web = false, $created_by_support = false)
    {
        DB::beginTransaction();

        /*
        $inventory_quantity_type = Service::where("id", $data['service_id'])->pluck('inventory_quantity_type')[0];
         if ($inventory_quantity_type != ServiceEnums::$INVENTORY_QUANTITY_TYPE["fixed"] && $inventory_quantity_type != ServiceEnums::$INVENTORY_QUANTITY_TYPE["range"]) {
             DB::rollBack();
             return Helper::response(false, "Unkown Service Type, Couldn't Proceed");
         }
        */

        $booking = new Booking;
        $booking_id = "BDO-" . uniqid();
        $enquiry_id = "ENQ-" . uniqid();
        $booking->public_booking_id = strtoupper($booking_id);
        $booking->public_enquiry_id = strtoupper($enquiry_id);
        $booking->user_id = (int)$user_id;
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

        if ($web)
            $booking->created_through_channel = BookingEnums::$CREATED_THROUGH_CHANNEL['web'];

        if ($created_by_support)
            $booking->created_through_channel = BookingEnums::$CREATED_THROUGH_CHANNEL['support'];


        $booking->meta = json_encode([
            "self_booking" => $data['meta']['self_booking'],
            "subcategory" => null,
            "customer" => null,
            "images" => [],
            "timings" => null,
            "distance" => null
        ]);
        $booking->status = BookingEnums::$STATUS['in_progress'];
        $result = $booking->save();

        $result_status = self::statusChange($booking->id, BookingEnums::$STATUS['in_progress']);

        if (!$result) {
            DB::rollBack();
            return Helper::response(false, "Couldn't save data");
        }

        DB::commit();
        return Helper::response(true, "Started booking tracking form successfully.", ["booking" => Booking::with('status_history')->findOrFail($booking->id)]);
    }

    /* Track Booking API's for Customer App */
    public static function trackSourceData($data, $user_id, $web = false, $created_by_support = false)
    {
        $booking_exist = Booking::where("public_booking_id", $data['public_booking_id'])->first();

        if (!$booking_exist)
            return Helper::response(false, "Booking is not exist");

        DB::beginTransaction();

        $inventory_quantity_type = Service::where("id", $data['service_id'])->pluck('inventory_quantity_type')[0];
        if ($inventory_quantity_type != ServiceEnums::$INVENTORY_QUANTITY_TYPE["fixed"] && $inventory_quantity_type != ServiceEnums::$INVENTORY_QUANTITY_TYPE["range"]) {
            DB::rollBack();
            return Helper::response(false, "Unkown Service Type, Couldn't Proceed");
        }

        $zone_id = GeoController::getNearestZone($data['source']['lat'], $data['source']['lng']);

        $update_source = Booking::where("public_booking_id", $data['public_booking_id'])
            ->update([
                "service_id" => $data['service_id'],
                "source_lat" => $data['source']['lat'],
                "source_lng" => $data['source']['lng'],
                "source_meta" => json_encode(["geocode" => $data['source']['meta']['geocode'],
                    "floor" => $data['source']['meta']['floor'],
                    "address" => $data['source']['meta']['address_line1'] . " " . $data['source']['meta']['address_line2'],
                    "address_line1" => $data['source']['meta']['address_line1'],
                    "address_line2" => $data['source']['meta']['address_line2'],
                    "city" => $data['source']['meta']['city'],
                    "state" => $data['source']['meta']['state'],
                    "pincode" => $data['source']['meta']['pincode'],
                    "lift" => $data['source']['meta']['lift'],
                    "shared_service" => null]),
                "zone_id" => $zone_id
            ]);


        if (!$update_source) {
            DB::rollBack();
            return Helper::response(false, "Couldn't save data");
        }

        DB::commit();
        return Helper::response(true, "We received your enquiry.", ["booking" => Booking::with('status_history')->findOrFail($booking_exist->id)]);
    }

    public static function trackDestinationData($data, $user_id, $web = false, $created_by_support = false)
    {
        $booking_exist = Booking::where("public_booking_id", $data['public_booking_id'])->first();

        if (!$booking_exist)
            return Helper::response(false, "Booking is not exist");

        DB::beginTransaction();

        $distance = GeoController::distance($booking_exist->source_lat, $booking_exist->source_lng, $data['destination']['lat'], $data['destination']['lng']);

        $meta = json_decode($booking_exist->meta, true);
        $meta['distance'] = $distance;


        $update_destination = Booking::where("public_booking_id", $data['public_booking_id'])
            ->update([
                "destination_lat" => $data['destination']['lat'],
                "destination_lng" => $data['destination']['lng'],
                "destination_meta" => json_encode(["geocode" => $data['destination']['meta']['geocode'],
                    "floor" => $data['destination']['meta']['floor'],
                    "address" => $data['destination']['meta']['address_line1'] . " " . $data['destination']['meta']['address_line2'],
                    "address_line1" => $data['destination']['meta']['address_line1'],
                    "address_line2" => $data['destination']['meta']['address_line2'],
                    "city" => $data['destination']['meta']['city'],
                    "state" => $data['destination']['meta']['state'],
                    "pincode" => $data['destination']['meta']['pincode'],
                    "lift" => $data['destination']['meta']['lift']]),
                "meta" => json_encode($meta)
            ]);


        if (!$update_destination) {
            DB::rollBack();
            return Helper::response(false, "Couldn't save data");
        }

        DB::commit();
        return Helper::response(true, "We received your enquiry.", ["booking" => Booking::with('status_history')->findOrFail($booking_exist->id)]);
    }

    public static function getDateTrack($data, $user_id, $movement_dates, $web = false, $created_by_support = false)
    {
        $booking_exist = Booking::where("public_booking_id", $data['public_booking_id'])->first();

        if (!$booking_exist)
            return Helper::response(false, "Booking is not exist");

        DB::beginTransaction();

        $meta = json_decode($booking_exist->source_meta, true);
        $meta['shared_service'] = $data['source']['meta']['shared_service'];


        $update_date = Booking::where("public_booking_id", $data['public_booking_id'])
            ->update([
                "source_meta" => json_encode($meta),
            ]);

        foreach ($movement_dates as $dates) {
            $movementdates = new MovementDates;
            $movementdates->booking_id = $booking_exist->id;
            $movementdates->date = Carbon::parse($dates)->format('Y-m-d');
            $result_date = $movementdates->save();
        }

        if (!$update_date) {
            DB::rollBack();
            return Helper::response(false, "Couldn't save data");
        }

        DB::commit();
        return Helper::response(true, "We received your enquiry.", ["booking" => Booking::with('movement_dates')->with('status_history')->findOrFail($booking_exist->id)]);
    }

    public static function trackInventoryData($data, $user_id, $web = false, $created_by_support = false)
    {
        $booking_exist = Booking::where("public_booking_id", $data['public_booking_id'])->first();

        if (!$booking_exist)
            return Helper::response(false, "Booking is not exist");

        DB::beginTransaction();

        $inventory_quantity_type = Service::where("id", $booking_exist->service_id)->pluck('inventory_quantity_type')[0];

        $images = [];
        $imageman = new ImageManager(array('driver' => 'gd'));

        if($data['meta']['images']) {
            foreach ($data['meta']['images'] as $key => $image) {
                $images[] = Helper::saveFile($imageman->make($image)->encode('png', 75), "BD" . uniqid() . $key . ".png", "bookings/" . $data['public_booking_id']);
            }
        }

        try {

            $generate_prices = InventoryController::generateOrganizationBasePrices($data, $booking_exist);
            if (!$generate_prices)
                return Helper::response(false, "Couldn't generate prices.");

            $estimate_quote = json_encode([
                "economic" => strtolower($data['meta']['subcategory']) == "custom" ? null : InventoryController::getEconomicPrice($data, $booking_exist, $web, $created_by_support),
                "premium" => strtolower($data['meta']['subcategory']) == "custom" ? null : InventoryController::getPremiumPrice($data, $booking_exist, $web, $created_by_support)
            ]);
            $org_estimate_quote = json_encode([
                "economic" => InventoryController::getEconomicPrice($data, $booking_exist, true, $web, $created_by_support),
                "premium" => InventoryController::getPremiumPrice($data, $booking_exist, true, $web, $created_by_support)
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Helper::response(false, "Couldn't save data", ["error" => $e->getMessage()]);
        }

        $distance = json_decode($booking_exist->meta, true)['distance'];
        $self_booking = json_decode($booking_exist->meta, true)['self_booking'];

        $update_inventory = Booking::where("public_booking_id", $data['public_booking_id'])
            ->update([
                "quote_estimate" => $estimate_quote,
                "organization_quote_estimate" => $org_estimate_quote,
                "meta" => json_encode(["self_booking" => $self_booking,
                    "subcategory" => $data['meta']['subcategory'],
                    "customer" => ["remarks" => $data['meta']['customer']['remarks']],
                    "images" => $images,
                    "timings" => null,
                    "distance" => $distance]),
                "status" => BookingEnums::$STATUS['enquiry']
            ]);

        foreach ($data["inventory_items"] as $items) {

            if ($web || $created_by_support) {
                $quantity = $inventory_quantity_type == ServiceEnums::$INVENTORY_QUANTITY_TYPE['fixed'] ? $items['quantity'] : json_encode(["min" => explode(";", $items['quantity'])[0], "max" => explode(";", $items['quantity'])[1]]);
            } else {
                $quantity = $inventory_quantity_type == ServiceEnums::$INVENTORY_QUANTITY_TYPE['fixed'] ? $items['quantity'] : json_encode(["min" => $items['quantity']['min'], "max" => $items['quantity']['max']]);
            }

            $bookinginventory = new BookingInventory;
            $bookinginventory->booking_id = $booking_exist->id;
            $bookinginventory->inventory_id = $items["inventory_id"];

            if ($items["inventory_id"] !== null)
                $bookinginventory->name = Inventory::where("id", $items['inventory_id'])->pluck('name')[0];
            else
                $bookinginventory->name = $items["name"];

            $bookinginventory->material = $items["material"];
            $bookinginventory->size = $items["size"];
            $bookinginventory->quantity = $quantity;
            $bookinginventory->quantity_type = $inventory_quantity_type;
            $bookinginventory->is_custom = $items['is_custom'] ? CommonEnums::$YES : CommonEnums::$NO;
            $result_items = $bookinginventory->save();
        }

        $result_status = self::statusChange($booking_exist->id, BookingEnums::$STATUS['enquiry']);

        if (!$update_inventory || !$result_status) {
            DB::rollBack();
            return Helper::response(false, "Couldn't save data");
        }

        DB::commit();
        return Helper::response(true, "We received your enquiry.", ["booking" => Booking::with('movement_dates')->with('inventories')->with('status_history')->findOrFail($booking_exist->id)]);
    }


    /*Track APIs for website*/
    public static function trackCustomerDataForWeb($data, $user_id, $web = false, $created_by_support = false)
    {
        DB::beginTransaction();

        if (!$data['public_booking_id']) {
            $booking = new Booking;
            $booking_id = "BDO-" . uniqid();
            $enquiry_id = "ENQ-" . uniqid();
            $booking->public_booking_id = strtoupper($booking_id);
            $booking->public_enquiry_id = strtoupper($enquiry_id);
            $booking->user_id = (int)$user_id;
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


            $booking->created_through_channel = BookingEnums::$CREATED_THROUGH_CHANNEL['web'];

            $booking->meta = json_encode([
                "self_booking" => $data['meta']['self_booking'],
                "subcategory" => null,
                "customer" => null,
                "images" => [],
                "timings" => null,
                "distance" => null
            ]);
            $booking->status = BookingEnums::$STATUS['in_progress'];
            $result = $booking->save();

            $result_status = self::statusChange($booking->id, BookingEnums::$STATUS['in_progress']);
            $id = $booking->id;
        } else {
            $booking_exist = Booking::where("public_booking_id", $data['public_booking_id'])->first();
            if ($data['meta']['self_booking'] === true) {
                $user = User::findOrfail($user_id);
                $name = $user['fname'] . ' ' . $user['lname'];
                $phone = $user['phone'];
                $email = $user['email'];
            } else {
                $name = $data['contact_details']['name'];
                $phone = $data['contact_details']['phone'];
                $email = $data['contact_details']['email'];
            }
            $meta = json_decode($booking_exist->meta, true);
            $meta['self_booking'] = $data['meta']['self_booking'];

            $result = Booking::where("public_booking_id", $data['public_booking_id'])
                ->update([
                    "contact_details" => json_encode(["name" => $name,
                        "phone" => $phone,
                        "email" => $email]),
                    "meta" => json_encode($meta)
                ]);

            $id = $booking_exist->id;
        }

        if (!$result && !$result_status) {
            DB::rollBack();
            return Helper::response(false, "Couldn't save data");
        }

        DB::commit();
        return Helper::response(true, "Started booking tracking form successfully.", ["booking" => Booking::with('status_history')->findOrFail($id)]);
    }

    /* Track Booking API's for Customer Website */
    public static function trackDeliveryDataForWeb($data, $user_id, $movement_dates, $web = false, $created_by_support = false)
    {
        $booking_exist = Booking::where("public_booking_id", $data['public_booking_id'])->first();

        if (!$booking_exist)
            return Helper::response(false, "Booking is not exist");

        DB::beginTransaction();

        $inventory_quantity_type = Service::where("id", $data['service_id'])->pluck('inventory_quantity_type')[0];
        if ($inventory_quantity_type != ServiceEnums::$INVENTORY_QUANTITY_TYPE["fixed"] && $inventory_quantity_type != ServiceEnums::$INVENTORY_QUANTITY_TYPE["range"]) {
            DB::rollBack();
            return Helper::response(false, "Unkown Service Type, Couldn't Proceed");
        }

        $zone_id = GeoController::getNearestZone($data['source']['lat'], $data['source']['lng']);

        $distance = GeoController::distance($data['source']['lat'], $data['source']['lng'], $data['destination']['lat'], $data['destination']['lng']);

        $meta = json_decode($booking_exist->meta, true);
        return $meta['distance'] = $distance;

        $update_source = Booking::where("public_booking_id", $data['public_booking_id'])
            ->update([
                "service_id" => $data['service_id'],
                "source_lat" => $data['source']['lat'],
                "source_lng" => $data['source']['lng'],
                "source_meta" => json_encode(["geocode" => $data['source']['meta']['geocode'],
                    "floor" => $data['source']['meta']['floor'],
                    "address" => $data['source']['meta']['address_line1'] . " " . $data['source']['meta']['address_line2'],
                    "address_line1" => $data['source']['meta']['address_line1'],
                    "address_line2" => $data['source']['meta']['address_line2'],
                    "city" => $data['source']['meta']['city'],
                    "state" => $data['source']['meta']['state'],
                    "pincode" => $data['source']['meta']['pincode'],
                    "lift" => $data['source']['meta']['lift'],
                    "shared_service" => $data['source']['meta']['shared_service']]),

                "destination_lat" => $data['destination']['lat'],
                "destination_lng" => $data['destination']['lng'],
                "destination_meta" => json_encode(["geocode" => $data['destination']['meta']['geocode'],
                    "floor" => $data['destination']['meta']['floor'],
                    "address" => $data['destination']['meta']['address_line1'] . " " . $data['destination']['meta']['address_line2'],
                    "address_line1" => $data['destination']['meta']['address_line1'],
                    "address_line2" => $data['destination']['meta']['address_line2'],
                    "city" => $data['destination']['meta']['city'],
                    "state" => $data['destination']['meta']['state'],
                    "pincode" => $data['destination']['meta']['pincode'],
                    "lift" => $data['destination']['meta']['lift']]),
                "meta" => json_encode($meta),

                "zone_id" => $zone_id
            ]);

        foreach ($movement_dates as $dates) {
            $movementdates = new MovementDates;
            $movementdates->booking_id = $booking_exist->id;
            $movementdates->date = Carbon::parse($dates)->format('Y-m-d');//date('', strtotime($dates));
            $result_date = $movementdates->save();
        }

        if (!$update_source && !$result_date) {
            DB::rollBack();
            return Helper::response(false, "Couldn't save data");
        }

        DB::commit();
        return Helper::response(true, "adding details in booking tracking form successfully.", ["booking" => Booking::with('status_history')->findOrFail($booking_exist->id)]);
    }

    public static function trackInventoryDataForWeb($data, $user_id, $web = false, $created_by_support = false)
    {
        $booking_exist = Booking::where("public_booking_id", $data['public_booking_id'])->first();

        if (!$booking_exist)
            return Helper::response(false, "Booking is not exist");

        DB::beginTransaction();

        $inventory_quantity_type = Service::where("id", $booking_exist->service_id)->pluck('inventory_quantity_type')[0];

        try {

            $generate_prices = InventoryController::generateOrganizationBasePrices($data, $booking_exist);
            if (!$generate_prices)
                return Helper::response(false, "Couldn't generate prices.");

            $estimate_quote = json_encode([
                "economic" => strtolower($data['meta']['subcategory']) == "custom" ? null : InventoryController::getEconomicPrice($data, $booking_exist, $web, $created_by_support),
                "premium" => strtolower($data['meta']['subcategory']) == "custom" ? null : InventoryController::getPremiumPrice($data, $booking_exist, $web, $created_by_support)
            ]);
            $org_estimate_quote = json_encode([
                "economic" => InventoryController::getEconomicPrice($data, $booking_exist, true, $web, $created_by_support),
                "premium" => InventoryController::getPremiumPrice($data, $booking_exist, true, $web, $created_by_support)
            ]);


        } catch (Exception $e) {
            DB::rollBack();
            return Helper::response(false, "Couldn't save data", ["error" => $e->getMessage()]);
        }

        $distance = json_decode($booking_exist->meta, true)['distance'];
        $self_booking = json_decode($booking_exist->meta, true)['self_booking'];

        $update_inventory = Booking::where("public_booking_id", $data['public_booking_id'])
            ->update([
                "quote_estimate" => $estimate_quote,
                "organization_quote_estimate" => $org_estimate_quote,
                "meta" => json_encode(["self_booking" => $self_booking,
                    "subcategory" => $data['meta']['subcategory'],
                    "customer" => null,
                    "images" => null,
                    "timings" => null,
                    "distance" => $distance])
            ]);

        foreach ($data["inventory_items"] as $items) {

            if ($web || $created_by_support) {
                $quantity = $inventory_quantity_type == ServiceEnums::$INVENTORY_QUANTITY_TYPE['fixed'] ? $items['quantity'] : json_encode(["min" => explode(";", $items['quantity'])[0], "max" => explode(";", $items['quantity'])[1]]);
            } else {
                $quantity = $inventory_quantity_type == ServiceEnums::$INVENTORY_QUANTITY_TYPE['fixed'] ? $items['quantity'] : json_encode(["min" => $items['quantity']['min'], "max" => $items['quantity']['max']]);
            }

            $bookinginventory = new BookingInventory;
            $bookinginventory->booking_id = $booking_exist->id;
            $bookinginventory->inventory_id = $items["inventory_id"];

            if ($items["inventory_id"] !== null)
                $bookinginventory->name = Inventory::where("id", $items['inventory_id'])->pluck('name')[0];
            else
                $bookinginventory->name = $items["name"];

            $bookinginventory->material = $items["material"];
            $bookinginventory->size = $items["size"];
            $bookinginventory->quantity = $quantity;
            $bookinginventory->quantity_type = $inventory_quantity_type;
            $bookinginventory->is_custom = $items["is_custom"];
            $result_items = $bookinginventory->save();
        }

        if (!$update_inventory || !$result_items) {
            DB::rollBack();
            return Helper::response(false, "Couldn't save data");
        }

        DB::commit();
        return Helper::response(true, "adding details in booking tracking form successfully.", ["booking" => Booking::with('movement_dates')->with('inventories')->with('status_history')->findOrFail($booking_exist->id)]);
    }

    public static function trackImgDataForWeb($data, $user_id, $web = false, $created_by_support = false)
    {
        $booking_exist = Booking::where("public_booking_id", $data['public_booking_id'])->first();

        if (!$booking_exist)
            return Helper::response(false, "Booking is not exist");

        DB::beginTransaction();

        $inventory_quantity_type = Service::where("id", $booking_exist->service_id)->pluck('inventory_quantity_type')[0];

        $images = [];
        $imageman = new ImageManager(array('driver' => 'gd'));


        if ($data['meta']['images'][0] != "") { //need to remove [0]==> temp fixed
            foreach ($data['meta']['images'] as $key => $image) {
                $images[] = Helper::saveFile($imageman->make($image)->encode('png', 75), "BD" . uniqid() . $key . ".png", "bookings/" . $booking_exist->id);
            }
        }


        $distance = json_decode($booking_exist->meta, true)['distance'];
        $self_booking = json_decode($booking_exist->meta, true)['self_booking'];
        $sub_cat = json_decode($booking_exist->meta, true)['subcategory'];

        $update_img = Booking::where("public_booking_id", $data['public_booking_id'])
            ->update([
                "meta" => json_encode(["self_booking" => $self_booking,
                    "subcategory" => $sub_cat,
                    "customer" => ["remarks" => $data['meta']['customer']['remarks']],
                    "images" => $images,
                    "timings" => null,
                    "distance" => $distance]),
                "status" => BookingEnums::$STATUS['enquiry']
            ]);

        $result_status = self::statusChange($booking_exist->id, BookingEnums::$STATUS['enquiry']);

        if (!$update_img || !$result_status) {
            DB::rollBack();
            return Helper::response(false, "Couldn't save data");
        }

        DB::commit();
        return Helper::response(true, "We received your enquiry.", ["booking" => Booking::with('movement_dates')->with('inventories')->with('status_history')->findOrFail($booking_exist->id)]);
    }

    public static function editEnquiryForAdmin(Request $request)
    {
        $user = User::where("phone", $request->phone)
            ->orWhere("email", $request->email)
            ->first();

        $user_id = $user->id;

        $movement_dates = explode(",", $request->movement_dates);

        return self::editEnquiry($request->all(), $user_id, $movement_dates);

    }

    public static function editEnquiry($data, $user_id, $movement_dates, $web = false, $created_by_support = false)
    {
        DB::beginTransaction();

        $booking = Booking::where("public_booking_id", $data['public_booking_id'])->first();

        if (!$booking)
            return Helper::response(false, "Booking is not exist.");

        $zone_id = GeoController::getNearestZone($data['source']['lat'], $data['source']['lng']);

        $inventory_quantity_type = Service::where("id", $data['service_id'])->pluck('inventory_quantity_type')[0];
        if ($inventory_quantity_type != ServiceEnums::$INVENTORY_QUANTITY_TYPE["fixed"] && $inventory_quantity_type != ServiceEnums::$INVENTORY_QUANTITY_TYPE["range"]) {
            DB::rollBack();
            return Helper::response(false, "Unkown Service Type, Couldn't Proceed");
        }
        $images = [];
        if (json_decode($booking->meta, true)['images'])
            $images = json_decode($booking->meta, true)['images'];


        try {

            $generate_prices = InventoryController::generateOrganizationBasePrices($data, $booking);
            if (!$generate_prices)
                return Helper::response(false, "Couldn't generate prices.");

            $estimate_quote = json_encode([
                "economic" => strtolower($data['meta']['subcategory']) == "custom" ? null : InventoryController::getEconomicPrice($data, $booking, $web, $created_by_support),
                "premium" => strtolower($data['meta']['subcategory']) == "custom" ? null : InventoryController::getPremiumPrice($data, $booking, $web, $created_by_support)
            ]);
            $org_estimate_quote = json_encode([
                "economic" => InventoryController::getEconomicPrice($data, $booking, true, $web, $created_by_support),
                "premium" => InventoryController::getPremiumPrice($data, $booking, true, $web, $created_by_support)
            ]);


        } catch (Exception $e) {
            DB::rollBack();
            return Helper::response(false, "Couldn't save data", ["error" => $e->getMessage()]);
        }

        if ($data['meta']['self_booking'] === true) {
            $user = User::findOrfail($user_id);
            $name = $user['fname'] . ' ' . $user['lname'];
            $phone = $user['phone'];
            $email = $user['email'];
        } else {
            $name = $data['contact_details']['name'];
            $phone = $data['contact_details']['phone'];
            $email = $data['contact_details']['email'];
        }

        $distance = GeoController::distance($data['source']['lat'], $data['source']['lng'], $data['destination']['lat'], $data['destination']['lng']);

        $result = Booking::where("public_booking_id", $data['public_booking_id'])
            ->update([
                "service_id" => $data['service_id'],
                "source_lat" => $data['source']['lat'],
                "source_lng" => $data['source']['lng'],
                "source_meta" => json_encode(["geocode" => $data['source']['meta']['geocode'],
                    "floor" => $data['source']['meta']['floor'],
                    "address" => $data['source']['meta']['address_line1'] . " " . $data['source']['meta']['address_line2'],
                    "address_line1" => $data['source']['meta']['address_line1'],
                    "address_line2" => $data['source']['meta']['address_line2'],
                    "city" => $data['source']['meta']['city'],
                    "state" => $data['source']['meta']['state'],
                    "pincode" => $data['source']['meta']['pincode'],
                    "lift" => $data['source']['meta']['lift'],
                    "shared_service" => $data['source']['meta']['shared_service']]),
                "destination_lat" => $data['destination']['lat'],
                "destination_lng" => $data['destination']['lng'],
                "destination_meta" => json_encode(["geocode" => $data['destination']['meta']['geocode'],
                    "floor" => $data['destination']['meta']['floor'],
                    "address" => $data['destination']['meta']['address_line1'] . " " . $data['destination']['meta']['address_line2'],
                    "address_line1" => $data['destination']['meta']['address_line1'],
                    "address_line2" => $data['destination']['meta']['address_line2'],
                    "city" => $data['destination']['meta']['city'],
                    "state" => $data['destination']['meta']['state'],
                    "pincode" => $data['destination']['meta']['pincode'],
                    "lift" => $data['destination']['meta']['lift']]),
                "contact_details" => json_encode(["name" => $name,
                    "phone" => $phone,
                    'email' => $email]),
                "quote_estimate" => $estimate_quote,
                "organization_quote_estimate" => $org_estimate_quote,
                "meta" => json_encode(["self_booking" => $data['meta']['self_booking'],
                    "subcategory" => $data['meta']['subcategory'],
                    "customer" => ["remarks" => $data['meta']['customer']['remarks']],
                    "images" => $images,
                    "timings" => null,
                    "distance" => $distance]),
                "zone_id" => $zone_id
            ]);

        MovementDates::where("booking_id", $booking->id)->delete();
        foreach ($movement_dates as $dates) {
            $movementdates = new MovementDates;
            $movementdates->booking_id = $booking->id;
            $movementdates->date = Carbon::parse($dates)->format('Y-m-d');//date('', strtotime($dates));
            $result_date = $movementdates->save();
        }

        BookingInventory::where("booking_id", $booking->id)->delete();
        foreach ($data["inventory_items"] as $items) {

            if ($web || $created_by_support) {
                $quantity = $inventory_quantity_type == ServiceEnums::$INVENTORY_QUANTITY_TYPE['fixed'] ? $items['quantity'] : json_encode(["min" => explode(";", $items['quantity'])[0], "max" => explode(";", $items['quantity'])[1]]);
            } else {
                $quantity = $inventory_quantity_type == ServiceEnums::$INVENTORY_QUANTITY_TYPE['fixed'] ? $items['quantity'] : json_encode(["min" => $items['quantity']['min'], "max" => $items['quantity']['max']]);
            }

            $bookinginventory = new BookingInventory;
            $bookinginventory->booking_id = $booking->id;
            $bookinginventory->inventory_id = $items["inventory_id"];

            if ($items["inventory_id"] !== null)
                $bookinginventory->name = Inventory::where("id", $items['inventory_id'])->pluck('name')[0];
            else
                $bookinginventory->name = $items["name"];

            $bookinginventory->material = $items["material"];
            $bookinginventory->size = $items["size"];
            $bookinginventory->quantity = $quantity;
            $bookinginventory->quantity_type = $inventory_quantity_type;
            $bookinginventory->is_custom = $items["is_custom"];
            $result_items = $bookinginventory->save();
        }

        if (!$result || !$result_date || !$result_items) {
            DB::rollBack();
            return Helper::response(false, "Couldn't save data");
        }

        DB::commit();
        return Helper::response(true, "Booking updated successful.", ["booking" => Booking::with('movement_dates')->with('inventories')->with('status_history')->findOrFail($booking->id)]);
    }

    public function validateVendorRoom($request)
    {
        $token = (object)Helper::validateAuthToken($request['token']);
        $vendor = Vendor::find($token->payload->id);
        if (!$token || !$vendor)
            return false;

        $booking = Booking::where("public_booking_id", $request['data']['public_booking_id'])
            ->with(['bid' => function ($query) use ($token) {
                $query->where("organization_id", $token->payload->organization_id);
            }])
            ->first();

        if (!$booking || !$booking->bid)
            return false;
        else
            return true;

    }

    public static function changeStatusBooking($id, $status){
        $booking_exist=Booking::where("id", $id)->first();

        if(!$booking_exist){
            return Helper::response(false,"Booking is not exist.");
        }
        $result_status = $result =false;
        if($booking_exist->status == BookingEnums::$STATUS['price_review_pending']) {
            $result = Booking::where("id", $id)->update(["status" => $status]);
            $result_status = self::statusChange($booking_exist->id, $status);
        }

        if($result || $result_status)
            return Helper::response(true,"Updated status successfully.");
        else
            return Helper::response(false,"Confirmation failed.");
    }

    public static function cancelBooking($public_booking_id)
    {
        $exist = Booking::where(["public_booking_id" => $public_booking_id])->first();
        if (!$exist) {
            return Helper::response(false, "Order is not Exist");
        }

        if ($exist['status'] == BookingEnums::$STATUS['cancelled']) {
            return Helper::response(false, "This order is already cancelled");
        }

        $cancelbooking = Booking::where(["user_id" => $exist->user_id,
            "public_booking_id" => $exist->public_booking_id])
            ->update(["status" => BookingEnums::$STATUS['cancelled']]);

        $result_status = self::statusChange($exist->id, BookingEnums::$STATUS['cancelled']);

        if (!$cancelbooking && !$result_status) {
            return Helper::response(false, "Couldn't Cancel Order");
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

    public static function cancelByAdmin($public_booking_id, $refund_amount = 0.00, $reason = null, $desc=null){
        $booking = Booking::where("public_booking_id",$public_booking_id)->with('payment')->first();
        if(!$booking)
            return Helper::response(false, "No booking found with this ID.");

        if(in_array($booking->status,[
            BookingEnums::$STATUS['completed'],
            BookingEnums::$STATUS['cancelled'],
            BookingEnums::$STATUS['bounced']
        ]))
            return Helper::response(false, "This booking cannot be cancelled as its is either cancelled or completed already.");

        if(isset($booking->payment->grand_total) && round($refund_amount,2) > round($booking->payment->grand_total,2))
            return Helper::response(false, "The refund amount cannot be greater than the total payment amount.");


        DB::beginTransaction();
        try {
        if(in_array($booking->status,[
            BookingEnums::$STATUS['biding'],
            BookingEnums::$STATUS['rebiding'],
            BookingEnums::$STATUS['hold']
        ]))
            Bid::where("booking_id",$booking->id)->update(["status"=>BidEnums::$STATUS['expired']]);

        if(in_array($booking->status,[
            BookingEnums::$STATUS['pending_driver_assign'],
            BookingEnums::$STATUS['awaiting_pickup'],
            BookingEnums::$STATUS['in_transit']
        ]))
            PaymentController::initBookingRefund($booking->id, $refund_amount);


        Booking::where("id",$booking->id)->update([
            "status" => BookingEnums::$STATUS['cancelled'],
            "cancelled_by" => BookingEnums::$AGENT['admin'],
            "cancelled_by_admin_id" => Session::get('account')['id'],
            "cancelled_meta" => json_encode(["reason"=>$reason, "desc"=>$desc])
            ]);
       }
        catch(Exception $e){
            DB::rollBack();
            return Helper::response(false, "Couldn't save data", ["error" => $e->getMessage()]);
        }

        $result_status = self::statusChange($booking->id, BookingEnums::$STATUS['cancelled']);
        DB::commit();
        return Helper::response(true, "Booking has been cancelled now.");

    }

    public static function initiateBidding(){

        $bookings = Booking::where("status", BookingEnums::$STATUS['placed'])->get();
        foreach($bookings as $booking){
            NotificationController::sendTo("user", [$booking['user_id']], "Your booking has been recieved.", "We are getting the best price for you. You will be notified soon.", [
                "type" => NotificationEnums::$TYPE['booking'],
                "public_booking_id" => $booking['public_booking_id'],
                "booking_status" => BookingEnums::$STATUS['biding']
            ]);
            BidController::addvendors($booking['id']);
        }
        return true;
    }
}
