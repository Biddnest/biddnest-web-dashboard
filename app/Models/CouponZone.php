<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponZone extends Model
{
    protected $hidden = ['created_at','updated_at'];
    use HasFactory;
    protected $table = "coupon_zone_map";

}
