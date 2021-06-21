<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\ToModel;

class InventoryPriceImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $inv_id = Inventory::where("name",$row[0])->pluck('id')[0];

        $inv_id = $inv_id ? $inv_id : 1;

        return new InventoryPrice([
        "organization_id"=> $row[0],
        "service_type"=>1,
        "inventory_id"=>$inv_id,
        "material"=>$row[1],
        "size"=>$row[2],
        "price_economics"=>$row[3]
    ]);
    }
}
