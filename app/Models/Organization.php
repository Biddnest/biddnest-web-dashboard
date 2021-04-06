<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $hidden = ['created_at','updated_at','deleted'];

    use HasFactory;

    public function kyc(){
        return $this->hasOne(Org_kyc::class);
    }
    public function vendors(){
        return $this->hasMany(Vendor::class);
    }

    public function InventoryPrice(){
        return $this->hasMany(InventoryPrice::class);
    }

    public function branch(){
        return $this->hasMany(Organization::class, "parent_org_id");
    }

    public function services()
    {
        return $this->hasMany(OrganizationService::class);
    }

    public function bank()
    {
        return $this->hasOne(Org_kyc::class);
    }

    public function bid()
    {
        return $this->hasMany(Bid::class);
    }

}
