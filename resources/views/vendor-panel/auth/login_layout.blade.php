<!Doctype html>
<html lang="en">
<head>


    <title>@yield('title')</title>

    @include('vendor-panel.layouts.includes.css')
</head>
<body>
<main>

    <div class="container-fluid">
        <div class="row ">
            <!-- IMAGE CONTAINER BEGIN  login-graphics-->
            <div class="col-sm-6 p-0">
                <img src="{{ asset('static/vendor/images/Background.png') }}" width="90%" height="100%">
            </div>
            <!-- IMAGE CONTAINER END -->

            <!-- FORM CONTAINER BEGIN -->
            <div class="col-lg-6 col-md-6 right-section">
                @yield('body')
            </div>
            <!-- FORM CONTAINER END -->
        </div>
    </div>
</main>
<!-- Optional JavaScript -->

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
@include('vendor-panel.layouts.includes.js')
</body>
</html>
