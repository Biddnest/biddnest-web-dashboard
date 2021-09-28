<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubServiceExtraInventory extends Model
{
    use HasFactory;
    protected $table="subservices_extra_inventory";
    
    public function meta(){
        return $this->hasMany(Inventory::class);
    }
}
