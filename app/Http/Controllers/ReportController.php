<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public static function getReport($organization_id)
    {
        $bid_id = Bid::where("organization_id", $organization_id);
    }
}
