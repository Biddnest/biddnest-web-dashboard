<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PHPSocketIO\SocketIO;
use Workerman\Worker;
use App\Http\Controllers\BookingController;

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
                    $this->alert('Bidnest Socket server');
                    $this->info('Initiating socket server');

                    $port = $this->option('port') ? $this->option('port') : env('DEFAULT_SOCKET_SERVER_PORT');

                    $io = new SocketIO($port);

                $this->info("Socket listener is now running on port ".$this->option('port'));
                $this->comment('It is recommended to run this command in a daemon manager like PM2');

                /*Defined event:
                 * booking.listen.start
                 * booking.listen.end
                 * booking.bid.submitted
                 * booking.rejected
                 * booking.watch.start
                 * booking.watch.end
                 * info.debug
                */

            /*Structure of any incoming data:
             *{ "token": [general api token used across the aplication], "data": ["public_booking_id":"abc"] }
             *
            */

                $io->on('connection', function ($socket) use ($io) {
                    $this->comment("Client Connected");
                    $socket->emit('info.debug',["status"=>"success","message"=>"You are connected to server now.","data"=>null]);


                    $socket->on('booking.listen.start', function ($request) use ($io, $socket) {

                    if(BookingController::validateVendorRoom($request))
                        $socket->join($request->booking_id);
                    else
                        $this->info("Token validation failed");

                    $this->info("Listen Start Triggered wiht data: ".(string)json_encode($request));

                    });

                    $socket->on('booking.listen.end', function ($request) use ($io, $socket) {
                        $socket->leave($request->booking_id);
                        $this->info("Listen end Triggered with data: ".(string)json_encode($request));
                    });

                    $socket->on('booking.watch.start', function ($request) use ($io, $socket) {

                        $this->info("Watch Start Triggered wiht data: ".(string)json_encode($request));

                        $action = BookingController::startVendorWatch($request);

                        if(!$action)
                            return ["status"=>"fail", "message"=>"Invalid token or vendor"];

                        $socket->broadcast->to($request['data']['public_booking_id'])
                            ->emit("booking.watch.start",[
                                "status"=>"success",
                                "message"=>"Another user is watching this order.",
                                "data"=>$action
                            ]);

                    });

                    $socket->on('booking.watch.end', function ($request) use ($io, $socket) {

                        $action = BookingController::endVendorWatch($request);

                        if(!$action)
                            return ["status"=>"fail", "message"=>"Invalid token or vendor"];

                        $this->info("Watch end Triggered with data: ".(string)json_encode($request));

                        $socket->broadcast->to($request['data']['public_booking_id'])
                            ->emit("booking.watch.end",[
                                "status"=>"success",
                                "message"=>"This booking is now free to watch",
                                "data"=>$action
                            ]);
                    });

                });

                Worker::runAll();
                break;

            case "stop":
                Worker::stopAll();
                break;

            default:
                $this->error("Incorrect command provided -> ".$this->argument("action").". Instead try 'php artisan websocket start/stop --port={port_here}'");
        }
    }
}
