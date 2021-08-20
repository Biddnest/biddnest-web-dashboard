<?php

namespace App\Exports;

use App\Models\Booking;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;

class SaleExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $from;
    public  $to;
    public $org;
    public $zone;
    public $service;
    public function __construct($from, $to, $org, $zone, $service)
    {
        $this->from=$from;
        $this->to=$to;
        $this->org=$org;
        $this->zone=$zone;
        $this->service=$service;
    }

    public function collection()
    {

        $bookings = Booking::whereDate("created_at",">=", (string) date("Y-m-d", strtotime($this->from)))
                ->whereDate("created_at","<=", (string) date("Y-m-d", strtotime($this->to)));

        if(isset($this->org) && $this->org != "all")
            $bookings->where("organization_id",$this->org);

        if(isset($this->zone) && $this->zone != "all")
            $bookings->where("zone_id",$this->zone);

        if(isset($this->service) && $this->service != "all")
            $bookings->where("service_id",$this->service);

       /* $bookings->with(["payment"=>function($query){
            $query->select(['other_charges', 'discount_amount', 'tax', 'sub_total', 'grand_total', ]);
        }]);*/
//        $output = $bookings->get();
        $output = Booking::get();
        Log::info($this->from);
        return $output;
        //date, sale
    }
}
