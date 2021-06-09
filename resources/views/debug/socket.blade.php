<script src="http://www.workerman.net/demos/phpsocketio-chat/socket.io-client/socket.io.js"></script>
<script>
    var socket = io('http://'+document.domain+':6001');
    socket.on('connection', function (){
        console.log('connected to server');
    });

    socket.on('info.debug', function (res){
        console.log('info message received', res);
    });
</script>
