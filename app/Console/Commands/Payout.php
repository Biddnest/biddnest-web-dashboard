<?php

namespace App\Console\Commands;

use App\Http\Controllers\PayoutController;
use Illuminate\Console\Command;

class Payout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payout {action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Payout cron commands';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        switch ($this->argument('action')){
            case "schedule":
                PayoutController::schedulePayouts();
                break;
            case "dispatch":
                PayoutController::disburse();
                break;

            default:
                $this->error("Invalid Option. Should be schedule|dispatch");
        }
    }
}
