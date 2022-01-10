<!DOCTYPE html>
<html lang="en">
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" max-scale="1">
        @include('website.layouts.includes.app-css')

        <style>

.navbar-nav .nav-item .nav-link{
    margin-right: 20px !important;
}
.ml-30{
margin-left: 18%;
}


    </style>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light header-navigation navigation-top">
        <div class="container">
            <a class="navbar-brand" style="" href="{{route('home')}}"><img src="{{ asset('static/website/images/images/Group 12527.png')}}" style="width: 122px; height: 46px;"/></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="header-controls ml-30 collapse navbar-collapse" id="navbarSupportedContent" >
                <ul class="navbar-nav ml-auto" style="    margin-right: 20px !important;">
                    <li class="nav-item  active" >
                        <a class="nav-link bec-vendor-purple f-14" href="{{route('join-vendor')}}"><img src="{{ asset('static/website/images/icons/Artboard – 6.svg')}}" /> Become a Vendor
                        </a>
                    </li>
                    @if(\Illuminate\Support\Facades\Session::get('account'))
                        <li class="nav-item  ml-2">
                            <a class="nav-link f-14"  href="{{route('my-bookings')}}"><img src="{{ asset('static/website/images/icons/Icon metro-truck2.svg')}}" class="mb-1 mr-1" /> MY BOOKINGS</a>
                        </li>
                    @endif
                    <li class="nav-item mr-1">
                        <a class="nav-link f-14" href="{{route('contact_us')}}"><i
                                class="icon-2 mr-1 pr-1 pt-1 dripicons-headset"></i>CONTACT US</a>
                    </li>
                    <li class="nav-item  dropdown theme-text  f-14" @if(!\Illuminate\Support\Facades\Session::get('account')) style="padding-top: 5px;" @endif>
                        @if(\Illuminate\Support\Facades\Session::get('account'))
                            <a class="nav-link f-14" >
                            <i class="icon-2 dripicons-user"></i>
                                <span class="ml-1 l-cap profile-name" >{{\Illuminate\Support\Facades\Session::get('account')['fname'] ?? 'Hello'}} {{\Illuminate\Support\Facades\Session::get('account')['lname'] ?? ''}}</span>
                            </a>
                        @else
                            <a data-toggle="modal" data-target="#Login-modal">
                            <i class="icon-2 mr-1 pr-1 pt-1 dripicons-enter"></i>

                                <span class="logged-in-username cursor-pointer l-cap f-14 ml-1  profile-name "  style="font-weight: 500 !important; letter-spacing: 1px;">login</span>
                            </a>
                        @endif
                        @if(\Illuminate\Support\Facades\Session::get('account'))
                                <div class="dropdown-content col-grey cursor-pointer">
                                    <ul class="d-content">
                                        <li class="drop-list" style="padding: 6px 15px;">
                                            <a class="menu" href="{{route('website.my-profile')}}"><img src="{{ asset('static/website/images/icons/Artboard – 10.svg')}}" /> <span class="ml-1">My Profile</span> </a>
                                        </li>
                                        <li class="drop-list" style="padding: 6px 15px;">
                                            <a class="menu" href="{{route('order-history')}}"><img src="{{ asset('static/website/images/icons/Artboard – 11.svg')}}" /><span class="ml-1"> Booking history </span></a>
                                        </li>
                                        <li class="drop-list" style="padding: 6px 15px;">
                                            <a class="menu" href="{{route('my-bookings')}}"><img src="{{ asset('static/website/images/icons/Artboard – 12.svg')}}" /><span class="ml-1"> Ongoing Booking </span></a>
                                        </li>
                                        <li class="drop-list" style="padding: 6px 15px;">
                                            <a class="menu" href="{{route('my-request')}}"><img src="{{ asset('static/website/images/icons/Artboard – 13.svg')}}" /> <span class="ml-1">My Request </span></a>
                                        </li>
                                        <li class="drop-list" style="padding: 6px 15px;">
                                            <a class="menu" href="#0" onclick="location.assign('{{route('logout')}}')"><img src="{{ asset('static/website/images/icons/Artboard – 14.svg')}}" /> <span class="ml-1">Logout </span></a>
                                        </li>
                                    </ul>
                                </div>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="join-as-vendor h-300">
        <div class="continer">
            <div class="row">
                <div class="col-lg-12 center d-flex ">
                    <h2 class="pt-100">@yield('header_title')</h2>
                </div>
            </div>
        </div>
    </header>
    <div data-barba="wrapper">
        @yield('content')
    </div>
    @include('website.layouts.includes.app-js')
</body>

</html>
