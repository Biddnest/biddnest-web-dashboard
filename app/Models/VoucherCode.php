<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherCode extends Model
{
    protected $table = "voucher_codes";
    use HasFactory;

    public function meta(){
        return $this->belongsTo(Voucher::class,"voucher_id","id");
    }
}
