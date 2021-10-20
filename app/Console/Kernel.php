<?php

namespace App\Console;

use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Http\Controllers\Controller\BidController;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //this cron pushes any order that are in placed status to bidding status
        $schedule->command('bid:end init')->everyMinute();

        // ends bidding and pushes order to awaiting bid result status
        $schedule->command('bid:end timer')->everyMinute();

        // generates bid result
        $schedule->command('bid:end all')->everyMinute();

        $schedule->command('reports:generate')->everyThirtyMinutes();

        $schedule->command('payout schedule')->dailyAt(Carbon::parse("6:00:00")->format("H:i:s"));

        $schedule->command('payout dispatch')->dailyAt(Carbon::parse("7:00:00")->format("H:i:s"));

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
