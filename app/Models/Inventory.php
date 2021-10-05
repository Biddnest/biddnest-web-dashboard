<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $hidden = ['laravel_through_key','created_at','updated_at','deleted'];
    protected $fillable = [ "name", "material", "size", "image", "icon", "category"];


    public  function subservices(){
        $this->belongsToMany(Subservice::class);
    }

    public function prices(){
        return $this->hasMany(InventoryPrice::class);
    }

    public function extra_inventories(){
        return $this->belongsToMany(SubServiceExtraInventory::class);
    }
}
