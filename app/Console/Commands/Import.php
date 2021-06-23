<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\InventoryController;

class Import extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:excel {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to import excel sheets to db tables.';

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
        switch ($this->argument("model")){
            case "inventory":
                $this->info(InventoryController::import());
            break;

            case "inventory-price":
                $this->info(InventoryController::importPrice());
            break;
            default:
                $this->error("That was an invalid option. Get reference from following command:");
                $this->error('php artisan import:excel [inventory|prices]');
        }
    }
}
