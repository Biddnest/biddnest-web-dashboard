<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponUser extends Model
{
    protected $hidden = ['created_at','updated_at'];
    use HasFactory;
    protected $table = "coupon_user_map";

}
