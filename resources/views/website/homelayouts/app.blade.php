<!doctype html>
<html lang="en">
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" max-scale="1">
        <!-- Required meta tags -->
        @include('website.homelayouts.includes.app-css')
        <style>
            .dropdown-content{
    padding: 0 !important;
}

.d-content .drop-list .menu:hover{
    color: #fdc403 !important;
}


a.menu:hover{
    color: #fdc403 !important;
}
        </style>
    </head>
    <body>

        <nav class="navbar navbar-default navbar-fixed-top header-fixed">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand -mt-10" href="{{route('home')}}"><img class="logo-small" src="{{ asset('static/website/images/images/logo.png')}}" /></a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="mar-vendor">
                            <a class="bec-vendor mr-2 " href="{{route('join-vendor')}}">
                                <img src="{{ asset('static/website/images/icons/Artboard – 6.svg')}}" class="res-nav" />
                                <span class="nav-menu-link l-cap">Become A Vendor</span>
                            </a>
                        </li>
                        @if(\Illuminate\Support\Facades\Session::get('account'))
                            <li>
                               <a href="{{route('my-bookings')}}"><img src="{{ asset('static/website/images/icons/Artboard – 7.svg')}}" />
                                    <span class="nav-menu-link l-cap">My Bookings</span></a>
                            </li>
                        @endif
                        <li>
                            <a href="{{route('contact_us')}}">
                                <img src="{{ asset('static/website/images/icons/Artboard – 8.svg')}}" class="mb-icon" />
                                <span class="nav-menu-link l-cap">Contact Us</span></a>
                        </li>
                        <li class=" nav-item  dropdown theme-text  f-14  m-dropdown cursor-pointer">
                            @if(\Illuminate\Support\Facades\Session::get('account'))
                            <a class="nav-link f-14" >
                            <i class="icon-2 dripicons-user"></i>
                                <span class="pl-1  l-cap " style="letter-spacing: 1px; ">{{\Illuminate\Support\Facades\Session::get('account')['fname'] ?? 'Hello'}} {{\Illuminate\Support\Facades\Session::get('account')['lname'] ?? ''}}</span>
                            </a>
                            @else
                            <a class="nav-link f-14"  data-toggle="modal" data-target="#Login-modal">
                            <i class="icon-2  dripicons-enter"></i>
                                <span class="cursor-pointer l-cap f-14 pl-1"  style="letter-spacing: 1px;">login</span>
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
        <div class="banner-carousel-container">
            <div id="myCarousel" class="carousel slide" data-ride="carousel" style="min-height: 580px">
                <div class="carousel-inner carousel-images">
                        @foreach($slider->banners as $banner)
                            <div class="item @if($loop->iteration == 1) active @endif">
                                 <img src="{{$banner->image}}" class="color-overlay" alt="BannerImage1" style="width: 100%" />
                                <div class="intro-container">
                                    <div class="intro-text pb-10">
                                        <h1 class="text-center view-small mb-2" style="font-size: 6rem">{{ucwords($banner->name)}}</h1>
                                        <a href="{{$banner->url}}">
                                            <p class="mb-4 ml-2" style="font-size: 18px; color: #fff; opacity: 1;">
                                                {{$banner->desc}}
                                            </p>
                                        </a>
                                        @if($banner->url && $banner->url != "")
                                            <div class="text-center">
                                            <a href="{{$banner->url}}" class="page-scroll btn btn-xl d-content" style="display: block;">
                                                <button type="button" class="btn btn-primary m-60">Get Started</button>
                                            </a>
                                        </div>
                                        @endif
                                        @if(\Illuminate\Support\Facades\Session::get('account'))
                                            <a href="{{route('add-booking')}}" class="page-scroll btn btn-xl d-content">
                                                <!-- <button type="button" class="btn btn-primary m-60 view-none">Book Now</button> -->
                                            </a>
                                        @else
                                            <a data-toggle="modal" data-target="#Login-modal" class="page-scroll btn btn-xl d-content">
                                                <!-- <button type="button" class="btn btn-primary m-60 view-none">Book Now</button> -->
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                </div>
                <a class="left carousel-control carousel-arrows" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left carousel-arrows-icon"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control carousel-arrows" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right carousel-arrows-icon"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div data-barba="wrapper">
            @yield('content')
        </div>
        <!-- footer -->

        <footer class="bg-purple">
            <div class="container">
                    <div class="footer-phone row around  center mt-3 mb-2 ">

                        <div class="col-md-3 col-xs-3 br-r">
                            <a href="{{route('terms.page', ["slug"=>"about-us"])}}" class="footer-text f-18 footer-quick-links cursor-pointer">About Us</a>
                        </div>
                        <div class="col-md-3 col-xs-3 br-r">
                            <a href="{{route('terms.page', ["slug"=>"terms-and-conditions"])}}" class="footer-text f-18 footer-quick-links cursor-pointer">T&C</a>
                        </div>
                        <div class="col-md-3 col-xs-3 br-r">
                            <a href="{{route('terms.page', ["slug"=>"privacy-policies"])}}" class="footer-text f-18 footer-quick-links cursor-pointer">Privacy</a>
                        </div>
                        <div class="col-md-3 col-xs-3 br-r" style="border:none !important;">
                            <a href="{{route('faq')}}" class="footer-text f-18 footer-quick-links cursor-pointer">FAQ</a>
                        </div>
                    </div>
                    <div class="row mt-30 footer-row border-bottom border-top pt-3 pb-3">
                        <div class="col-md-4 col-sm-12 br-r" style="padding-left: 0px !important;">
                            <div class="footer-text text-view-center -m-36">
                                <img class="-mb-20" style="transform: translate(-16px, 10px);" src="{{ asset('static/website/images/icons/logo.png')}}" />
                                <p>
                                    @foreach(json_decode($contact_details, true)['email_id'] as $email)
                                        <i class="fa fa-envelope pl-2 pr-25 f-18 mb-1"></i>{{$email}}
                                        @break
                                    @endforeach
                                </p>
                                <p class="ml-p">
                                    @foreach(json_decode($contact_details, true)['contact_no'] as $phone)
                                        <i class="fa fa-phone pl-2 pr-25 f-18 mb-1"></i>{{$phone}}
                                        @break
                                    @endforeach
                                </p>
                            </div>
                            <div class="input-group pl-2 mt-30 m-auto-view">
                                <input type="tel" class="form-control -mr-4" id="contact_no" placeholder="Request a call back" maxlength="10" minlength="10"/>
                                <div class="input-group-append">
                                    <button class="btn btn-secondary input-button f-4 call-request" type="button" data-url="{{route('request-callback')}}">
                                        <i class="fa fa f-12 p-0"><span class="p-1 f-14">Submit</span></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4  col-sm-12 footer-view br-r">
                            <div class="footer-text text-left mt-4">
                                <p class="text-view-center text-center">WE ARE AVAILABLE IN</p>
                            </div>
                            <img src="{{ asset('static/website/images/icons/chennai.png')}}" />
                            <p class="w-text f-16"> Chennai</p>

                            <div>

                            </div>
                            <ul class="list-inline footer-phone d-flex center">

                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="footer-text">
                                <p class="mt-4  ml-2">EXPERIENCE OUR APP ON MOBILE</p>
                            </div>
                            <div class="d-flex  text-view-center social-btns ml-2 ml-2-0">
                                <a class="app-btn bg-white flex vert app-btn-view mr-2-0 mr-2" href="#services">
                                    <i class="fa fa-apple theme-text"></i>
                                    <p class="theme-text mt-1">
                                        <span class="fade f-9">Download on</span> <br />
                                        <span class="big-txt">Apple Store</span>
                                    </p>
                                </a>
                                <a class="app-btn ml-10 bg-white flex vert app-btn-view" href="#services">
                                    <img class="g-play" src="{{ asset('static/website/images/icons/google-play.svg')}}" />
                                    <p class="theme-text mt-1">
                                        <span class="fade f-9">Get it on</span> <br />
                                        <span class="big-txt">Google Play</span>
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 mb-4">
                        <div class="col-md-6 text-left">
                                    <span class=" copyright footer-text  text-view-center view-block " style="color: #fff;">
                                     Copyright © {{date("Y", time())}} All Rights Reserved by. <a href="#"
                                                                                                  target="_blank">BIDNEST</a>.</span>
                        </div>
                        <div class="col-md-6 around">
                            <ul class="list-inline social-buttons">
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="#"><img class="y-icon" src="{{ asset('static/website/images/icons/youtube.svg')}}" /></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

        </footer>
        @include('website.homelayouts.includes.app-js')
    </body>
</html>
