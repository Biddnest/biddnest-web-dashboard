<!doctype html>
<html lang="en">
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" max-scale="1">
        <!-- Required meta tags -->
        @include('website.homelayouts.includes.app-css')
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
                                <span class="nav-menu-link">Become A Vendor</span>
                            </a>
                        </li>
                        @if(\Illuminate\Support\Facades\Session::get('account'))
                            <li>
                               <a href="{{route('my-bookings')}}"><img src="{{ asset('static/website/images/icons/Artboard – 7.svg')}}" />
                                    <span class="nav-menu-link">My Bookings</span></a>
                            </li>
                        @endif
                        <li>
                            <a href="{{route('contact_us')}}">
                                <img src="{{ asset('static/website/images/icons/Artboard – 8.svg')}}" class="mb-icon" />
                                <span class="nav-menu-link">Contact Us</span></a>
                        </li>
                        <li class="account-settings m-dropdown dropdown mt-0">
                            @if(\Illuminate\Support\Facades\Session::get('account'))
                            <a>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15.071" height="15.071" viewBox="0 0 9.071 9.071" style="margin-right: 10px; margin-left: -6px;
">
                                    <defs>
                                        <style>
                                            .a {
                                                fill: #fff;
                                            }

                                            .b {
                                                clip-path: url(#a);
                                            }

                                            .c {
                                                clip-path: url(#b);
                                            }
                                        </style>
                                        <clipPath id="a">
                                            <path class="a" d="M61.536-1844.464a2.267,2.267,0,0,0,2.268-2.268A2.267,2.267,0,0,0,61.536-1849a2.267,2.267,0,0,0-2.268,2.268A2.267,2.267,0,0,0,61.536-1844.464Zm0,1.134c-1.514,0-4.536.76-4.536,2.268v1.134h9.071v-1.134C66.071-1842.571,63.049-1843.33,61.536-1843.33Z"
                                                  transform="translate(-57 1849)" />
                                        </clipPath>
                                        <clipPath id="b">
                                            <path class="a" d="M0-1661.07H1015.959V-2607H0Z"
                                                  transform="translate(0 2607)" />
                                        </clipPath>
                                    </defs>
                                    <g class="b" transform="translate(0 0)">
                                        <g class="c" transform="translate(-20.682 -275.035)">
                                            <path class="a" d="M52-1854H64.7v12.7H52Z"
                                                  transform="translate(-33.132 2127.22)" />
                                        </g>
                                    </g>
                                </svg>
                                <span class="logged-in-username">{{\Illuminate\Support\Facades\Session::get('account')['fname'] ?? 'Hello'}} {{\Illuminate\Support\Facades\Session::get('account')['lname'] ?? ''}}</span>
                            </a>
                            @else
                                <a data-toggle="modal" data-target="#Login-modal">
                                    <span class="logged-in-username">Login</span>
                                </a>
                            @endif
                            @if(\Illuminate\Support\Facades\Session::get('account'))
                                <div class="dropdown-content col-grey cursor-pointer">
                                    <ul class="d-content">
                                        <li class="drop-list" style="padding: 5px 10px;">
                                            <a class="menu" href="{{route('website.my-profile')}}"><img src="{{ asset('static/website/images/icons/Artboard – 10.svg')}}" /> <span class="ml-1">My Profile</span> </a>
                                        </li>
                                        <li class="drop-list" style="padding: 5px 10px;">
                                            <a class="menu" href="{{route('order-history')}}"><img src="{{ asset('static/website/images/icons/Artboard – 11.svg')}}" /><span class="ml-1"> Booking history </span></a>
                                        </li>
                                        <li class="drop-list" style="padding: 5px 10px;">
                                            <a class="menu" href="{{route('my-bookings')}}"><img src="{{ asset('static/website/images/icons/Artboard – 12.svg')}}" /><span class="ml-1"> Ongoing Booking </span></a>
                                        </li>
                                        <li class="drop-list" style="padding: 5px 10px;">
                                            <a class="menu" href="{{route('my-request')}}"><img src="{{ asset('static/website/images/icons/Artboard – 13.svg')}}" /> <span class="ml-1">My Request </span></a>
                                        </li>
                                        <li class="drop-list" style="padding: 5px 10px;">
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
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner carousel-images">
                    @php $count=0; @endphp
                    @foreach(\App\Models\Slider::where(["status"=>\App\Enums\CommonEnums::$YES, "deleted"=>\App\Enums\CommonEnums::$NO, "platform"=>\App\Enums\SliderEnum::$PLATFORM['web'], "size"=>\App\Enums\SliderEnum::$SIZE['wide']])->with('banners')->get() as $slider )
                        @foreach($slider->banners as $banner)
                            @php $count++; @endphp
                            <div class="item @if($count == 1) active @endif">
                                 <img src="{{$banner->image}}" class="color-overlay" alt="BannerImage1" style="width: 100%" />
                                <div class="intro-container">
                                    <div class="intro-text pb-10">
                                        <h1 class="text-center view-small mb-2">{{ucwords($slider->name)}}</h1>
                                        <a href="{{$banner->url}}">
                                            <p class="mb-4 ml-2 ">
                                                {{ucwords($banner->name)}}
                                            </p>
                                        </a>
                                        {{--<a href="{{route('add-booking')}}" class="page-scroll btn btn-xl d-content">
                                            <button type="button" class="btn btn-primary m-60">Book Now</button>
                                        </a>--}}
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
                        <div class="col-md-3 col-xs-3 br-r">
                            <a href="{{route('faq')}}" class="footer-text f-20 footer-quick-links cursor-pointer">FAQ</a>
                        </div>
                    </div>
                    <div class="row mt-30 footer-row border-bottom border-top p-3">
                        <div class="col-md-4 col-sm-12 br-r">
                            <div class="footer-text text-view-center -m-36">
                                <img class="-mb-20" src="{{ asset('static/website/images/icons/logo.png')}}" />
                                <p>
                                    @foreach(json_decode($contact_details, true)['email_id'] as $email)
                                        <i class="fa fa-envelope pl-25 pr-25 f-18 mb-1"></i>{{$email}}
                                        @break
                                    @endforeach
                                </p>
                                <p class="ml-p">
                                    @foreach(json_decode($contact_details, true)['contact_no'] as $phone)
                                        <i class="fa fa-phone pl-25 pr-25 f-18 mb-1"></i>{{$phone}}
                                        @break
                                    @endforeach
                                </p>
                            </div>
                            <div class="input-group pl-25 mt-30 m-auto-view">
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
                    <div class="row mt-4 mb-1">
                        <div class="col-md-6 text-left">
                                    <span class="copyright footer-text fade text-view-center view-block ">
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
