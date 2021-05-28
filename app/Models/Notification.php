<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = "notifications";
    use HasFactory;
    protected $hidden = ['deleted'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
}
