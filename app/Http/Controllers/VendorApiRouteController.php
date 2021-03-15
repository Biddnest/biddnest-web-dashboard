<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Middleware\VerifyJwtToken;
use App\StringFormatter;
use App\Helper;

class VendorApiRouteController extends Controller
{
    
    public function addPrice(Request $request)
    { 
        $validation = Validator::make($request->all(),[
            'inventory_id'=>"required|int",
            // 'organization_id'=>"required|int",
            'service_type'=>"required|int",
            'price.*.size' => 'required|string',
            'price.*.material' => 'required|string',
            'price.*.price.economics' => 'nullable',
            'price.*.price.premium' => 'nullable'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return InventoryController::addPrice($request->all());
    }
    public function getInventoryprices(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'inventory_id' => 'required|integer'
        ]);
        
        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return InventoryController::getByInventory($request->inventory_id);
    }

    public function updateInventoryprices(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'price_id' => 'required|integer',
            'inventory_id'=>"required|int",
            // 'organization_id'=>"required|int",
            'service_type'=>"required|int",
            'size' => 'required|string',
            'material' => 'required|string',
            'price.*.price.economics' => 'nullable',
            'price.*.price.premium' => 'nullable'
        ]);

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
            return InventoryController::updatePrice($request->all());
    }

    public function deleteInventoryprices(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'id' => 'required|integer'
        ]);        

        if($validation->fails())
            return Helper::response(false,"validation failed", $validation->errors(), 400);
        else
        return InventoryController::deletePrice($request->id);
    }
}
