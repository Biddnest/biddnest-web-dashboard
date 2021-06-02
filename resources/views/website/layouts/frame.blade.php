<!DOCTYPE html>
<html lang="en">
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" max-scale="1">
        @include('website.layouts.includes.app-css')
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light header-navigation navigation-top">
        <div class="container">
            <a class="navbar-brand" href="{{route('home')}}"><img src="{{ asset('static/website/images/images/b.png')}}" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="header-controls ml-30 collapse navbar-collapse" id="navbarSupportedContent" >
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item  active" style="margin-right: 24px;">
                        <a class="nav-link bec-vendor-purple f-14" href="{{route('join-vendor')}}"><img src="{{ asset('static/website/images/icons/Artboard – 6.svg')}}" /> Become a Vendor
                        </a>
                    </li>
                    @if(\Illuminate\Support\Facades\Session::get('account'))
                        <li class="nav-item mr-16 ml-20 ">
                            <a class="nav-link f-14"  href="{{route('my-bookings')}}"><img src="{{ asset('static/website/images/icons/Icon metro-truck2.svg')}}" class="mb-1 mr-1" /> MY BOOKINGS</a>
                        </li>
                    @endif
                    <li class="nav-item mr-16 ml-20">
                        <a class="nav-link f-14" href="{{route('contact_us')}}"><i
                                class="icon-2 mr-1 pr-1 pt-1 dripicons-headset"></i>CONTACT US</a>
                    </li>
                    <li class="account-settings dropdown theme-text mt-1 pt-1 ml-20 f-14">
                        @if(\Illuminate\Support\Facades\Session::get('account'))
                            <a>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15.071" height="15.071" viewBox="0 0 9.071 9.071">
                                    <defs>
                                        <style>
                                            .a {
                                                fill: #2a2386;
                                            }

                                            .b {
                                                clip-path: url(#a);
                                            }

                                            .c {
                                                clip-path: url(#b);
                                            }
                                        </style>
                                        <clipPath id="a">
                                            <path class="a"
                                                  d="M61.536-1844.464a2.267,2.267,0,0,0,2.268-2.268A2.267,2.267,0,0,0,61.536-1849a2.267,2.267,0,0,0-2.268,2.268A2.267,2.267,0,0,0,61.536-1844.464Zm0,1.134c-1.514,0-4.536.76-4.536,2.268v1.134h9.071v-1.134C66.071-1842.571,63.049-1843.33,61.536-1843.33Z"
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
                                <span class="ml-1">{{\Illuminate\Support\Facades\Session::get('account')['fname'] ?? 'Hello'}} {{\Illuminate\Support\Facades\Session::get('account')['lname'] ?? ''}}</span>
                            </a>
                        @else
                            <a data-toggle="modal" data-target="#Login-modal">
                                <span class="logged-in-username cursor-pointer l-cap ">login</span>
                            </a>
                        @endif
                        @if(\Illuminate\Support\Facades\Session::get('account'))
                            <div class="dropdown-content">
                            <ul class="d-content">
                                <li class="drop-list" style="padding: 5px 10px;">
                                    <a class="menu" href="{{route('website.my-profile')}}"><img src="{{ asset('static/website/images/icons/Artboard – 10.svg')}}" /><span class="ml-1">My Profile</span></a>
                                </li>
                                <li class="drop-list" style="padding: 5px 10px;">
                                    <a class="menu" href="{{route('order-history')}}"><img src="{{ asset('static/website/images/icons/Artboard – 11.svg')}}" /><span class="ml-1"> Booking history </span></a>
                                </li>
                                <li class="drop-list" style="padding: 5px 10px;">
                                    <a class="menu" href="{{route('my-bookings')}}"><img src="{{ asset('static/website/images/icons/Artboard – 12.svg')}}" /><span class="ml-1"> Ongoing Booking </span></a>
                                </li>
                                <li class="drop-list" style="padding: 5px 10px;">
                                    <a class="menu" href="{{route('my-request')}}"><img src="{{ asset('static/website/images/icons/Artboard – 13.svg')}}" /><span class="ml-1">My Request </span></a>
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
        <div class="modal fade" id="Login-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
        <div class="modal-dialog theme-text input-text-blue" role="document">
            <div class="modal-content w-70 m-0-auto w-1000 mt-20 right-25" style="margin-top:20% !important">
                <div class="modal-header p-0 br-5 ">
                    
                    <div style="width: -webkit-fill-available;   width: 100%; width: -moz-available; width: -webkit-fill-available;  width: fill-available;">
                        <header class="join-as-vendor">
                            <img src="{{ asset('static/website/images/icons/logo.png')}}" class="img-mar" style="    margin-left: 14px;" >
                            <button type="button" class="close text-white p-0" data-dismiss="modal" aria-label="Close" style="color: #FFF !important; transform: translate(-22px, 22px);">
                        <span>                         <i class="dripicons-cross" style="font-size: 25px;"></i></span>
                       
                        </button>
                        </header>

                    </div>
                    <!-- <span>                         <i class="dripicons-cross" style="font-size: 25px;"></i></span> -->

                    <!-- <div>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="color: #FFF !important; transform: translate(-13px, 26px);">
                        <span>                         <i class="dripicons-cross" style="font-size: 25px;"></i></span>
                       
                        </button>
                    </div> -->


                </div>

                <div class="modal-body  margin-topneg-7 pt-2">

                    <form action="{{ route('website.login') }}" data-await-input="#otp" method="POST" data-next="refresh" {{--data-url="{{route('home-logged')}}"--}} data-alert="mega" class="form-new-order mt-1 input-text-blue" data-parsley-validate>
                        <div class="d-flex f-direction text-justify center">
                            <h2 class="p-text" style="font-size: 24px !important;">Login</h2>
                            <div class="col-lg-12 col-xs-12 mt-2 hidden-space pl-0 pr-0">
                                <div class="form-group">
                                    <label for="formGroupExampleInput" style="color: #0F0C75 !important;">Phone Number</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="9990009990" maxlength="10" minlength="10" required>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4 col-xs-12 mt-1 otp hidden pl-0 pr-0"   id="otp">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">OTP</label>
                                    <input type="text" class="form-control" name="otp" id="formGroupExampleInput" maxlength="6" minlength="6" placeholder="Verify OTP">
                                </div>
                            </div>
                            {{-- <a class="weblogin" data-url="{{ route('website.login') }}">
                            <button type="button" class="btn btn-theme-bg   text-view-center mt-3 mb-4 padding-btn-res white-bg">
                                Next
                            </button>
                            </a>--}}
                            <div class="col-md-12 pl-0 pr-0">
                            <a class="weblogin" >
                                <button type="submit" class="btn btn-theme-bg   text-view-center mt-3 mb-4 padding-btn-res white-bg btn-max" style="width: -webkit-fill-available;">
                                    Submit
                                </button>
                            </a>
                            </div>
                           

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('website.layouts.includes.app-js')
</body>

</html>
