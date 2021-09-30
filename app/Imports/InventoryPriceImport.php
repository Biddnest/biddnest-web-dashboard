<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Inventory;
use App\Models\InventoryPrice;
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
        $inv_id = Inventory::where("name",$row[0])->first();

        $inv_id = $inv_id ? $inv_id->id : 1;
        $deleted = $inv_id ? 0 : 1;

        return new InventoryPrice([
        "organization_id"=> 41,
        "service_type"=>1,
        "inventory_id"=>$inv_id,
        "material"=>$row[1] != "" ? $row[1] : "regular",
        "size"=>$row[2] != "" ? $row[2] : "regular",
        "price_economics"=>number_format((float) $row[3], 2),
        "deleted"=>$deleted
    ]);
    }
}
