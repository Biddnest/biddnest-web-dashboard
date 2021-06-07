<!DOCTYPE html>
<html lang="en">
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" max-scale="1">
        @include('website.layouts.includes.app-css')
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light header-navigation navigation-top">
        <div class="container">
            <a class="navbar-brand" style="" href="{{route('home')}}"><img src="{{ asset('static/website/images/images/b.png')}}" /></a>
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
                    <li class="nav-item  dropdown theme-text  f-14">
                        @if(\Illuminate\Support\Facades\Session::get('account'))
                            <a class="nav-link f-14" >
                            <i class="icon-2 dripicons-user"></i>
                                <span class="ml-1 l-cap " style="font-weight: 600;letter-spacing: 1px; ">{{\Illuminate\Support\Facades\Session::get('account')['fname'] ?? 'Hello'}} {{\Illuminate\Support\Facades\Session::get('account')['lname'] ?? ''}}</span>
                            </a>
                        @else
                            <a data-toggle="modal" data-target="#Login-modal">
                            <i class="icon-2 mr-1 pr-1 pt-1 dripicons-enter"></i>

                                <span class="logged-in-username cursor-pointer l-cap f-14 ml-1 "  style="font-weight: 600;letter-spacing: 1px;">login</span>
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
            <div class="modal-content w-80 m-0-auto w-1000 mt-20 right-25" style="margin-top:20% !important">
                <div class="modal-header p-0 br-5 ">
                    <div style="width: -webkit-fill-available;   width: 100%; width: -moz-available; width: -webkit-fill-available;  width: fill-available;">
                        <header class="join-as-vendor">
                            <img src="{{ asset('static/website/images/icons/logo.png')}}" class="img-mar" style="margin-left: 14px;" >
                            <button type="button" class="close text-white p-0" data-dismiss="modal" aria-label="Close" style="color: #FFF !important; transform: translate(-22px, 22px);">
                        <span>                         <i class="dripicons-cross" style="font-size: 25px;"></i></span>
                        </button>
                        </header>
                    </div>
                </div>

                <div class="modal-body  margin-topneg-7 pt-2">
                    <form action="{{ route('website.login') }}" data-await-input="#otp" method="POST" data-next="refresh" {{--data-url="{{route('home-logged')}}"--}} data-alert="mega" class="form-new-order mt-1 input-text-blue" data-parsley-validate>
                        <div class="d-flex f-direction text-justify center">
                            <h2 class="p-text" style="font-size: 24px !important;">Login</h2>
                            <div class="col-lg-12 col-xs-12 mt-2 hidden-space pl-0 pr-0">
                                <div class="form-group">
                                    <label for="formGroupExampleInput" style="color: #0F0C75 !important;">Phone Number</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="9990009990" maxlength="10" autocomplete="off" minlength="10" required>
                                </div>
                            </div>
                            <div class="col-lg-12  col-xs-12 mt-1 otp hidden pl-0 pr-0"   id="otp">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">OTP</label>
                                    <input type="text" class="form-control" name="otp" id="formGroupExampleInput" maxlength="6" autocomplete="off" minlength="6" placeholder="Verify OTP">
                                </div>
                            </div>
                            {{-- <a class="weblogin" data-url="{{ route('website.login') }}">
                            <button type="button" class="btn btn-theme-bg   text-view-center mt-3 mb-4 padding-btn-res white-bg">
                                Next
                            </button>
                            </a>--}}
                            <div class="col-md-12" style="width: 100%;">
                                {{--                                <p class="mt-2 mb-0" style="text-align: center; color:#3B4B58; font-size:14px">Waiting for OTP</p>--}}

                                <div class="col-12 d-flex center">
                                    <div class="form-groups">
                                        <label class="container-01 m-0">
                                            <input type="checkbox" id="Lift1" required/>
                                            <span class="checkmark-agree" style="height: 14px !important; width: 14px !important;"></span>
                                            <p class="text-muted f-12">I agree to the <b>Terms & conditions</b></p>
                                        </label>
                                    </div>
                                </div>

                                <a class="weblogin" >
                                    <button type="submit" class="btn btn-theme-bg  mt-2 text-view-center padding-btn-res white-bg width-max login-web" style="width: -webkit-fill-available !important; ">
                                        Submit
                                    </button>
                                </a>
                                <p class="mt-2 " style="text-align: center; color:#3B4B58; font-size:14px">Did not receive OTP? <button class="unstyled-button login-web"><span class="theme-text bold"> Resend</span></button></p>
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
