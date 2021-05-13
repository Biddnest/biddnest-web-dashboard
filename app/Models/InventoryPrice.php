<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryPrice extends Model
{
    protected $table = "inventory_price";
    protected $hidden =['created_at', 'updated_at','deleted'];
    use HasFactory;

    public  function vendor(){
        $this->belongsToMany(Organization::class);
    }

    public  function services(){
        $this->belongsToMany(Service::class);
    }

    public  function inventory(){
        $this->belongsToMany(Inventory::class);
    }

}
