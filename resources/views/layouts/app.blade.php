<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        @include('layouts.includes.app-css')
    </head>
    <body>
        <main class="dashboard grey-bg">
            @include('layouts.sidebar')
            <div class="content-wrapper">
                <!-- top_nav_bar -->
                <div class="h-auto">
                    <nav class="navbar navbar-light theme-bg h-70  d-felx felx-row justify-content-between navigation-top header-navigation header">
                        <form class="col-6 p-0 margin-topneg-10">
                            <div class="search ">
                                <input type="text"  class="searchTerm table-search" data-url="{{route('admin.searchresult')}}" placeholder="Search...">
                                <button type="submit" class="searchButton searchResultButton">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                        <div class="col-6">
                            <ul class="header-controls d-flex flex-row justify-content-end">
                                @if(\App\Helper::is("admin") || \App\Helper::is('zone_admin'))
                                <li class="settings-icon"><a href="#"><span class="notification-icon"><i class="icon dripicons-web "height="15"></i></span> </a>

                                    <div class="dropdown settings" style="height: auto;">
                                        <ul>
                                            <li style="cursor: pointer;" onclick="location.assign('{{ route('switch-zone') }}')"><a>All Zones @if(!\Illuminate\Support\Facades\Session::get('active_zone')) (Showing Now) @endif</a></li>

                                            @foreach(\Illuminate\Support\Facades\Session::get('zones') as $zone)
                                                <li style="cursor: pointer;" onclick="location.assign('{{ route('switch-zone') }}?zone={{$zone->id}}');"><a >{{$zone->name}}
                                                    @if(\Illuminate\Support\Facades\Session::get('active_zone') && \Illuminate\Support\Facades\Session::get('active_zone') == $zone->id) (selected) @endif</a></li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </li>
                                @endif

                                    @if(\App\Helper::is("admin") || \App\Helper::is('zone_admin'))
                                    <li class="settings-icon"><a href="#"><span class="notification-icon"><i class="icon dripicons-toggles "height="15"></i></span> </a>

                                    <div class="dropdown settings" style="height: auto;">
                                        <ul>
                                            <li><a href="{{route('pages')}}">General Pages</a></li>
                                            <li><a href="{{route('admin.faq')}}">FAQ</a></li>
                                            <li><a href="{{route('admin.contact_us')}}">Contact-Us</a></li>
                                            <li><a href="{{route('api-settings')}}">API Settings</a></li>

                                        </ul>
                                    </div>
                                </li>
                                    @endif
                                {{--<li class="notifications"><a href="#"><span class="icon-navbar"><i class="icon dripicons-bell notification-icon"height="15"></i></span></a>
                                    <div class="dropdown">
                                        <ul>
                                            <li><a href="#">
                                                    <div class="d-flex notification-msg ">
                                                        <div class="order-icon">
                                                            <i class="icon dripicons-bell h-auto" ></i>
                                                        </div>
                                                        <div class="notification-details">
                                                            <h6> Your order is placed</h6>
                                                            <p class="">Lorem ipsum, dolor sit amet consectetur adipisicing
                                                                elit.</p>


                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li><a href="#">
                                                    <div class="d-flex notification-msg ">
                                                        <div class="order-icon">
                                                            <i class="icon dripicons-bell h-auto" ></i>
                                                        </div>
                                                        <div class="notification-details">
                                                            <h6> Your order is placed</h6>
                                                            <p class="">Lorem ipsum, dolor sit amet consectetur adipisicing
                                                                elit.</p>


                                                        </div>
                                                    </div>
                                                </a></li>
                                            <li><a href="#">
                                                    <div class="d-flex notification-msg ">
                                                        <div class="order-icon">
                                                            <i class="icon dripicons-bell h-auto" ></i>
                                                        </div>
                                                        <div class="notification-details">
                                                            <h6> Your order is placed</h6>
                                                            <p class="">Lorem ipsum, dolor sit amet consectetur adipisicing
                                                                elit.</p>


                                                        </div>
                                                    </div>
                                                </a></li>
                                            <li><a href="#">
                                                    <div class="d-flex notification-msg ">
                                                        <div class="order-icon">
                                                            <i class="icon dripicons-bell h-auto" ></i>
                                                        </div>
                                                        <div class="notification-details">
                                                            <h6> Your order is placed</h6>
                                                            <p class="">Lorem ipsum, dolor sit amet consectetur adipisicing
                                                                elit.</p>


                                                        </div>
                                                    </div>
                                                </a></li>
                                        </ul>
                                    </div>

                                </li>--}}
                                <li class="account-settings">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="15.071" height="15.071" viewBox="0 0 9.071 9.071">
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
                                    <span>{{\Illuminate\Support\Facades\Session::get("account")['name']}}</span>

                                    <div class="dropdown">
                                        <ul>
                                            <li><a href="{{route('my-profile', ['id'=>\Illuminate\Support\Facades\Session::get("account")['id']])}}">My Profile</a></li>
                                            <li><a href="{{route('password-reset', ['id'=>\Illuminate\Support\Facades\Session::get("account")['id']])}}">Change Password</a></li>
                                            <li><a href="#0" onclick="location.assign('{{route('admin.logout')}}')">Logout</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div data-barba="wrapper">
                    @yield('content')
                    </div>
                    <!-- footer -->
                    {{--<footer class="text-center b-purple">
                        <hr>

                        <p>Copyright © {{ date("Y") }} All Rights Reserved by. <a href="https://admin-biddnest.dev.diginnovators.com/"
                                                                            target="_blank">BIDNEST</a>.</p>
                    </footer>--}}
                </div>
            </div>
            <div class="side-bar-pop-up">

            </div>
            @yield('modal')
        </main>


        @include('layouts.includes.app-js')
        @yield('scripts')



    </body>
</html>
