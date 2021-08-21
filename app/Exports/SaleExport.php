<?php

namespace App\Exports;

use App\Models\Booking;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Enums\BookingEnums;
class SaleExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    /*public $from;
    public $to;
    public $org;
    public $zone;
    public $service;*/

    /*public function __construct($from, $to, $org, $zone, $service)
    {
        $this->from=$from;
        $this->to=$to;
        $this->org=$org;
        $this->zone=$zone;
        $this->service=$service;
    }*/

    public function setData(string $from, string $to, string $org, string $zone, string $service)
    {
        $this->from=$from;
        $this->to=$to;
        $this->org=$org;
        $this->zone=$zone;
        $this->service=$service;

        return $this;
    }

    public function query()
    {
         $bookings = Booking::query()->select(['public_booking_id','contact_details', 'booking_type', 'source_meta', 'destination_meta', 'meta', 'bid_result_at', 'quote_estimate', 'final_estimated_quote', 'final_quote', 'cancelled_meta'])->whereIn("status", [BookingEnums::$STATUS['pending_driver_assign'], BookingEnums::$STATUS['in_transit'], BookingEnums::$STATUS['completed']])->whereDate("created_at",">=", (string) date("Y-m-d", strtotime($this->from)))
                ->whereDate("created_at","<=", (string) date("Y-m-d", strtotime($this->to)));

        if(isset($this->org) && $this->org != "all")
            $bookings->where("organization_id",$this->org);

        if(isset($this->zone) && $this->zone != "all")
            $bookings->where("zone_id",$this->zone);

        if(isset($this->service) && $this->service != "all")
            $bookings->where("service_id",$this->service);

      /*  $bookings->with(["payment"=>function($query){
            $query->select(['other_charges', 'discount_amount', 'tax', 'sub_total', 'grand_total']);
        }]);*/

        return $bookings;
    }
}
