{{--<script src="http://www.workerman.net/demos/phpsocketio-chat/socket.io-client/socket.io.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.1.2/socket.io.min.js" integrity="sha512-2ho+gY0H62N4Z9oxD422L2ZYXiOMq9l+Aub1QNz4Z4UDOtDVxz4vk6O6R3Hqqc9Y7qSvZFl7cy3+eZ/ITnUrLA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var socket = io('http://139.59.27.112:6001');
    socket.on('connect', function (){
        console.log('connected to server');
    });

    socket.on('info.debug', function (res){
        console.log('info message received', res);
    });
</script>
