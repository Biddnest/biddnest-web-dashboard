<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidInventory extends Model
{
    protected $table = "bid_inventory";
    use HasFactory;
    protected $hidden = ['created_at','updated_at'];
}
