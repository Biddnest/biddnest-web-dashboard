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
                    $this->alert('Bidsnest Socket server');
                    $this->info('Initiating socket server');

                    $port = $this->option('port') ? $this->option('port') : 3000;

                    $io = new SocketIO($port);

                $this->info("Socket listener is now running on port ".$this->option('port'));
                $this->comment('It is recommended to run this command in a daemon manager like PM2');

                $io->on('connection', function ($socket) use ($io) {
                    $this->comment("Client Connected");
                    $socket->on('message', function ($msg) use ($io) {
                        $io->emit('chat message', $msg);
                        $this->comment("chat received");
                    });
                });

                Worker::runAll();
                break;

            case "stop":
                Worker::stopAll();
        }
    }
}
