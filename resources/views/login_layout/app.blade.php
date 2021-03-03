<!doctype html>
<html lang="en">
    <head>
        @include('layouts.includes.app-css')
    </head>

    <body data-barba="wrapper">

        @yield('content')
        @include('layouts.includes.app-js')
        @yield('scripts')
    </body>
</html>
