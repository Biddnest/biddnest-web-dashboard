<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function subservices(){
        return $this->hasManyThrough(Services::class,ServiceSubservice::class,'service_id','id','id','subservice_id');
    }

    public function InventoryPrice(){
        return $this->hasMany(InventoryPrice::class);
    }
}
