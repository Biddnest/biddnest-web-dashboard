<!doctype html>
<html lang="en">
    <head>
        @include('layouts.app-css')
    </head>

    <body data-barba="wrapper">

        @yield('content')
        @include('layouts.app-js')
        @yield('scripts') 
    </body>
</html>