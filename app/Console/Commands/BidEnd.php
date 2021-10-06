<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Http\Controllers\BidController;
use App\Models\CronLog;

class BidEnd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bid:end {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bid end and show final Quotation';

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
        if($this->argument('id')=='all')
        {
            $output = BidController::getbookings();
            /*$cron_log = new CronLog;
            $cron_log->output = json_encode($output);
            $cron_log->save();*/
            $this->comment('Total orders '.$output['total_bookings']);
            $this->comment('Affected orders '.json_encode($output['booking_id']));
        }
        else if($this->argument('id') == 'timer')
        {
            $output = BidController::endTimer();
            /*$cron_log = new CronLog;
            $cron_log->output = json_encode($output);
            $cron_log->save();*/
            /*$this->comment('Total orders '.$output['total_bookings']);
            $this->comment('Affected orders '.json_encode($output['booking_id']));*/
        }
        else{
            $output = BidController::getbookings($this->argument('id'));
            $this->comment('Affected orders '.json_encode($output));
        }


        // $this->comment(json_encode($output));
    }
}
