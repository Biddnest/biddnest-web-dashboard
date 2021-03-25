<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $casts = ["sub_total"=>"float","grand_total"=>"float", "discount_amount"=>"float","tax"=>"float"];
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


