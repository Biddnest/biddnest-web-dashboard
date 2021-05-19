<!DOCTYPE html>
<html lang="en">
    <head>
        @include('website.layouts.includes.app-css')
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light header-navigation navigation-top">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="{{ asset('static/website/images/images/b.png')}}" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="header-controls ml-30 collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mr-16 active">
                        <a class="nav-link bec-vendor-purple" href="{{route('join-vendor')}}"><img src="{{ asset('static/website/images/icons/Artboard – 6.svg')}}" /> Become a Vendor
                        </a>
                    </li>
                    <li class="nav-item mr-16">
                        <a class="nav-link" href="booking-history.html"><img src="{{ asset('static/website/images/icons/Icon metro-truck2.svg')}}" class="mb-1 mr-1" /> MY BOOKINGS</a>

                    </li>
                    <li class="nav-item mr-16">
                        <a class="nav-link" href="contact-us.html"><i
                                class="icon-2 mr-1 pr-1 pt-1 dripicons-headset"></i>CONTACT US</a>
                    </li>
                    <li class="account-settings dropdown theme-text mt-1 pt-1">
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
                            <span class="ml-1">Amith Raji</span>
                        </a>

                        <div class="dropdown-content">
                            <ul class="d-content">
                                <li>
                                    <img src="{{ asset('static/website/images/icons/Artboard – 10.svg')}}" /> My Profile
                                </li>
                                <li>
                                    <img src="{{ asset('static/website/images/icons/Artboard – 11.svg')}}" />Booking history
                                </li>
                                <li>
                                    <img src="{{ asset('static/website/images/icons/Artboard – 12.svg')}}" />Ongoing Booking
                                </li>
                                <li>
                                    <img src="{{ asset('static/website/images/icons/Artboard – 13.svg')}}" />My Request
                                </li>
                                <li>
                                    <img src="{{ asset('static/website/images/icons/Artboard – 14.svg')}}" />Logout
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div data-barba="wrapper">
        @yield('content')
    </div>
    @include('website.layouts.includes.app-js')
</body>

</html>
