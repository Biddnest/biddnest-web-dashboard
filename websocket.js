const app = require('express')();
const server = require('http').Server(app);
const cors = require('cors')
const io = require('socket.io')(server, {
    cors: {
        origin: "*",
    },
});
app.use(cors());
const axios = require('axios');
require('dotenv').config();

const API_ENDPOINT = process.env.APP_URL;
// const API_ENDPOINT = "http://127.0.0.1:8000";

app.get('/', function(req, res) {
    res.send("Websocket is up and running");
});

/* functions */
/*watchStart = (payload) => {

    return

};*/
/*
watchEnd = (payload) =>{
    return
};*/

io.on("connection", (socket) => {
    console.log("Client Connected");

    io.emit("info.debug",{
        status: "success",
        message: "You are now connected to the socket server",
        data: null
    });

    socket.on("booking.listen.start", (request) => {
        console.log("listen start", request);
        socket.join(request.data.public_booking_id);
    });

    socket.on("booking.listen.stop", (request) => {
        console.log("listen stop", request);
        socket.leave(request.data.public_booking_id);
    });

    socket.on("booking.watch.start", (request) => {
        console.log("watch start", request);
        axios({
            method: 'POST',
            url: `${API_ENDPOINT}/api/vendor/v1/webhook/for-socket/booking/watch`,
            data: request,
            headers: {
                'Content-Type': 'application/json',
                'Content-Length': request.length,
                'Authorization': `Bearer ${request.token}`
            }
        }).then((start_listen)=>{

            console.log("resp from start api",start_listen.body);

            io.to(request.data.public_booking_id).emit('booking.watch.start',{
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

        }).catch((e)=>{
            console.log("Exception caught=>", e);
        });



    });

    socket.on("booking.watch.stop", (request) => {
        console.log("watch stop", request);
        axios({
            method: 'DELETE',
            url: `${API_ENDPOINT}/api/vendor/v1/webhook/for-socket/booking/watch`,
            data: request,
            headers: {
                'Content-Type': 'application/json',
                'Content-Length': request.length,
                'Authorization': `Bearer ${request.token}`
            }
        }).then((stop_listen)=>{
            console.log("resp from stop api",stop_listen.body);

            io.to(request.data.public_booking_id).emit('booking.watch.stop',{
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
        }).catch((e)=>{
            console.log("Exception caught=>", e);
        });


    });
});

server.listen(process.env.DEFAULT_SOCKET_SERVER_PORT);
