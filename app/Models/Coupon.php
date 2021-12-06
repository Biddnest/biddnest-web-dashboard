<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $hidden = ['created_at','updated_at'];
    use HasFactory;

    public function zones(){
        return $this->belongsToMany(Zone::class,"coupon_zone_map","coupon_id","zone_id","id","id");
//        return $this->hasManyThrough(Zone::class, CouponZone::class,"zone_id","id","id","coupon_id");
    }

    public function organizations(){
        return $this->belongsToMany(Zone::class,"coupon_organization_map","coupon_id","organization_id","id","id");
//        return $this->hasManyThrough(Organization::class, CouponOrganization::class,"organization_id","id","id","coupon_id");
    }

    public function users(){
        return $this->belongsToMany(Zone::class,"coupon_user_map","coupon_id","user_id","id","id");
//        return $this->hasManyThrough(User::class, CouponUser::class,"user_id","id","id","coupon_id");
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function created_by(){
        return $this->belongsTo(Admin::class, "created_by","id");
    }
}
