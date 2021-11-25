<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User as Customer;

class User extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:wallet {--make=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $users = Customer::all();
        foreach ($users as $u){
                $c = Customer::where("id",$u['id'])->first();
                $this->info("Creating Wallet for ".$u['fname']);

                if(!$c->hasWallet('reward-points')) {
                $c->createWallet([
                    'name' => 'Reward Points',
                    'slug' => 'reward-points',
                ]);

                $this->info("Wallet created");
            }
                else{
        $this->error("Skipped wallet creation.");
                }
        }
        $this->comment("Completed wallet creation.");

    }
}
