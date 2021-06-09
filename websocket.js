const app = require('express')();
const server = require('http').Server(app);
const io = require('socket.io')(server, {
    cors: {
        origin: "*",
    },
});
const axios = require('axios');
require('dotenv').config();

const API_ENDPOINT = process.env.APP_URL;
// const API_ENDPOINT = "http://127.0.0.1:8000";

app.get('/', function(req, res) {
    res.send("Websocket is up and running");
});

/* functions */
watchStart = (payload) =>{

    return axios({
        method: 'POST',
        url: `${API_ENDPOINT}/api/vendor/v1/webhook/for-socket/booking/watch`,
        data: payload,
        headers: {
            'Content-Type': 'application/json',
            'Content-Length': payload.length,
            'Authorization': `Bearer ${payload.token}`
        }
    });

};

watchEnd = (payload) =>{
    return axios({
        method: 'delete',
        url: `${API_ENDPOINT}/api/vendor/v1/webhook/for-socket/booking/watch`,
        data: payload,
        headers: {
            'Content-Type': 'application/json',
            'Content-Length': payload.length,
            'Authorization': `Bearer ${payload.token}`
        }
    }).stat;
};

// console.log(`${API_ENDPOINT}/api/vendor/v1/webhook/for-socket/booking/watch`);
// console.log(watchStart({}));

io.on("connection", (socket) => {
    console.log("Client Connected");

    io.emit("info.debug",{
        status: "success",
        message: "You are now connected to the socket server",
        data: null
    });

    socket.on("booking.listen.start", (request) => {
        io.join(request.data.public_booking_id);
    });

    socket.on("booking.listen.stop", (request) => {
        io.leave(request.data.public_booking_id);
    });

    socket.on("booking.watch.start", (request) => {
        let start_listen = watchStart(request);
        console.log(start_listen);
        io.emit('booking.watch.start',{
            status:"success",
            message: "Booking has been started for this booking.",
            data: null
        });

        if(start_listen.body.status == "success")
            io.to(request.data.public_booking_id).emit('info.debug',{
                status: "success",
                message: "You are now connected to the socket server",
                data: start_listen.body
            });


    });

    socket.on("booking.watch.stop", (request) => {
        let stop_listen = watchStop(request);

        console.log(stop_listen);

        io.emit('booking.watch.start',{
            status:"success",
            message: "Booking has been started for this booking.",
            data: null
        });

        if(stop_listen.body.status == "success")
            io.to(request.data.public_booking_id).emit('info.debug',{
                status: "success",
                message: "You are now connected to the socket server",
                data: stop_listen.body
            });
    });
});

server.listen(6001);
