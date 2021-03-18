<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubserviceInventory extends Model
{
    protected $table = "subservices_inventories_maps";
    use HasFactory;

    public function meta(){
        return $this->hasOne(Inventory::class,"id","subservice_id");
    }
}
