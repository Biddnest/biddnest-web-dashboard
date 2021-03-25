<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $casts = ["sub_total"=>"decimal:2","grand_total"=>"decimal:2", "discount_amount"=>"decimal:2","tax"=>"decimal:2","other_charges"=>"decimal:2"];
    protected $table = "payments";
    protected $hidden =['created_at', 'updated_at'];
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function booking(){
        return $this->belongsTo(Booking::class);
    }
}


