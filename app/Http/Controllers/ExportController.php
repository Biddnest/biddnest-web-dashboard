<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Exports\SaleExport;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
class ExportController extends Controller
{
    public function exoprtSale(){
      $export = Excel::download(new SaleExport, 'export.csv');

       if($export)
           return Helper::response(true, "Successfully Downloaded");
       else
           return Helper::response(false, "fail to download");

    }

    public function downloadCsv($file)
    {
        return Storage::download('public/sale-reports/'.$file);
    }
}


