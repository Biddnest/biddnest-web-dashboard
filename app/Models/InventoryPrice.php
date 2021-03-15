<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryPrice extends Model
{
    protected $table = "inventory_price";
    protected $hidden =['created_at', 'updated_at','deleted'];
    use HasFactory;
}
