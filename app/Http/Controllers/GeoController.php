<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeoController extends Controller
{
    public function distance($source_lat, $source_lng, $dest_lat, $dest_lng){
        return 100.00;
    }

    

    public function getZones($lat, $lng){}
}
