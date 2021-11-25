<?php

namespace App\Models;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Traits\HasWallets;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Wallet
{

    protected $hidden = ['laravel_through_key','created_at','updated_at','deleted'];
    use HasWallet, HasWallets, HasFactory;

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function vouchers(){
        return $this->hasMany(VoucherCode::class);
    }
}
