<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subservice;

class SubservicePrice extends Model
{
    protected $table = "subservice_price";
    use HasFactory;

    public function subservice(){
        return $this->belongsTo(Subservice::class);
    }
}
