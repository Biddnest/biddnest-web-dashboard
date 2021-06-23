<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryPrice extends Model
{
    protected $table = "inventory_price";
    protected $hidden =['created_at', 'updated_at','deleted'];
    protected $fillable = ["organization_id",
        "service_type",
        "inventory_id",
        "material",
        "size",
        "price_economics"];

    use HasFactory;


    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function service(){
        return $this->belongsTo(Service::class,"service_type");
    }

    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }

}
