<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
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


