<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public function zones(){
        return $this->hasManyThrough(Zone::class, CouponZone::class,"zone_id","id","id","coupon_id");
    }

    public function organizations(){
        return $this->hasManyThrough(Organization::class, CouponZone::class,"organization_id","id","id","coupon_id");
    }

    public function users(){
        return $this->hasManyThrough(User::class, CouponUser::class,"user_id","id","id","coupon_id");
    }
}
