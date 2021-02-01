<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Sms;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;

class SendOtp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $otp;
    private $phone;
    public function __construct($otp, $phone)
    {
        $this->otp = $otp;
        $this->phone = $phone;
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Sms::sendOtp($this->phone, $this->otp);
        Admin::where('phone',$this->phone)->update(['otp' => $this->otp, 'forgot_pwd'=>1]);

    }
}
