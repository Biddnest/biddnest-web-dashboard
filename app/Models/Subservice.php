<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subservice extends Model
{
    use HasFactory;
    protected $hidden = ['laravel_through_key'];

    public function inventories(){
       return $this->hasManyThrough(Inventory::class,SubserviceInventory::class,'subservice_id','id','id','inventory_id');
    }

    public function inventorymap(){
        return $this->hasMany(SubserviceInventory::class);
    }

    public function services()
    {
        return $this->hasOneThrough(Service::class,ServiceSubservice::class,'subservice_id','id','id','service_id');
    }

    public function items(){
        return $this->hasManyThrough(Inventory::class, SubserviceInventory::class, 'inventory_id','id','id','subservice_id');
    }

    public function extraitems(){
        return $this->hasManyThrough(Inventory::class, SubServiceExtraInventory::class, 'inventory_id','id','id','subservice_id');
    }
}
