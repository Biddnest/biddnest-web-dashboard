<script src="http://www.workerman.net/demos/phpsocketio-chat/socket.io-client/socket.io.js"></script>
<script>
    var socket = io('http://'+document.domain+':5000');
    socket.on('connection', function (){
        console.log('connected to server');
    });
</script>
