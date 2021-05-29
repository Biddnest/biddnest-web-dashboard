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

        $inv = Inventory::where("name",$row[0])->first();

        if($inv){
            $material = json_decode($inv->material, true);
            $size = json_decode($inv->size, true);
        }
        else{
            $material = [];
            $size = [];
        }
        $material = !in_array($row[1],$material) ? array_push($material, $row[1]) : $material;
        $size = !in_array($row[2], $size) ? array_push($size, $row[2]) : $size;

        return new Inventory([
            "name"=>$row[0],
            "material"=>json_encode($material),
            "size"=>json_encode($size),
            "image"=>"abcd.jpg",
            "icon"=>"abcd.jpg",
            "category"=>$row[3]
        ]);
    }
}
