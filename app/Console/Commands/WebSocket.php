<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PHPSocketIO\SocketIO;
use Workerman\Worker;

class WebSocket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'websocket {action} {--port=}';

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
        switch ($this->argument('action')){
            case "start":
                    $this->comment('Starting server');

                    $port = $this->option('port') ? $this->option('port') : 3000;

                    $io = new SocketIO($port);

                $this->comment("Running on port ".$this->option('port'));

                $io->on('connection', function ($socket) use ($io) {
                    $this->comment("Client Connected");
                    $socket->on('message', function ($msg) use ($io) {

                        $io->emit('chat message', $msg);

                        $this->comment("chat received");

                    });
                });

                Worker::runAll();
                break;
        }
    }
}
