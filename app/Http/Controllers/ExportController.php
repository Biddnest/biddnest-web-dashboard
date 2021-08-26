<?php

namespace App\Http\Controllers;

use App\Exports\SaleExport;
use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exoprtSale(Request $request){
        Log::info($request->from);
        $org = !isset($request->organization_id) ? "all" : $request->organization_id;
        $file_name='public/sale-reports/export'.date('d-m-Y').'.csv';
        $sale = new SaleExport();
        $export = Excel::store($sale->setData($request->from, $request->to, $org, $request->zone, $request->service), $file_name);

        if($export)
            return Helper::response(true, "Successfully Downloaded", ['file_name'=>$file_name]);
        else
            return Helper::response(false, "fail to download");

    }

    public function downloadCsv(Request $request)
    {
        return Response::download(storage_path($request->file));
    }
}


