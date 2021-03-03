<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        @include('layouts.app-css')

        @section('styles')
        <style>
            .nav-collapse .li{
                list-style-type: none !important;
            }
            .modal-body{
                margin-left: 6.5px;
            }
        </style>
        @endsection
    </head>
    <body data-barba="wrapper">
        @include('layouts.sidebar')
        @include('layouts.header')
        @yield('content')

        @include('layouts.footer')
        @include('layouts.app-js')
        @yield('scripts') 
    </body>
</html>