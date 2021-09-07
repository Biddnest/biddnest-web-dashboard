<?php

namespace App\Imports;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\ToModel;

class InventoryImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Inventory([
            "name"=>$row[0] && trim($row[0]) !== "" ? ucfirst(strtolower($row[0])) : "Item Id ".uniqid(),
            "material"=>$row[1] != "" ? json_encode(explode(",",$row[1])) : json_encode(["Material not provided"]),
            "size"=>$row[2] != "" ? json_encode(explode(",",$row[2])) : json_encode(["Size not provided"]),
            "image"=>"https://uat-dashboard-biddnest.dev.diginnovators.com/storage/inventories/inventory-image-Couch-609de0f794b6f.png",
            "icon"=>"https://uat-dashboard-biddnest.dev.diginnovators.com/storage/inventories/inventory-image-Couch-609de0f794b6f.png",
            "category"=> $row[3] && trim($row[3]) !== "" ? strtolower($row[4]) : "other"
        ]);
    }
}
