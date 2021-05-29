<!doctype html>
<html lang="en">

<head>

    <title>@yield('title')</title>
    @include('vendor-panel.layouts.includes.app-css')

</head>
<body>
<main class="dashboard grey-bg">
    @include('vendor-panel.layouts.includes.sidebar')
    <div class="content-wrapper" data-barba="wrapper">
        <div class="floating-btn">
            <img src="{{asset('static/vendor/images/graph/Group 14372.svg')}}" alt="">
        </div>
        <!-- top_nav_bar -->
        <div class="h-auto">
            <nav class="navbar navbar-light theme-bg h-70  d-felx felx-row justify-content-between navigation-top header-navigation">
                <form class="col-7 p-0 margin-topneg-10">
                    <div class="search ">
                        <input type="text" class="searchTerm" placeholder="Search...">
                        <button type="submit" class="searchButton">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>

                <div class="col-5">
                    <ul class="header-controls d-flex flex-row justify-content-end">
                        <li class="notifications"><a href="#"><span class="icon-navbar"><i class="icon dripicons-bell notification-icon"height="15"></i></span></a>
                            <div class="dropdown">
                                <ul>
                                    @foreach(\App\Models\Notification::where('vendor_id', \Illuminate\Support\Facades\Session::get('organization_id'))->latest()->limit(15)->get() as $notification)
                                        <li><a href="{{$notification->url ?? '#'}}">
                                                <div class="d-flex notification-msg ">
                                                    <div class="order-icon">
                                                        <i class="icon dripicons-bell h-auto" ></i>
                                                    </div>
                                                    <div class="notification-details">
                                                        <h6>{{$notification->title}}</h6>
                                                        <p class="">{{$notification->desc}}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        </li>
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
                                    <li><a href="{{route('vendor.myprofile', ['id'=>\Illuminate\Support\Facades\Session::get('account')['id']])}}">My Profile</a></li>
                                    <li><a href="{{route('vendor.password-reset' , ['id'=>\Illuminate\Support\Facades\Session::get("account")['id']])}}">Change Password</a></li>

                                    <li><a href="#0" onclick="location.assign('{{route('vendor.logout')}}')">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Main Content -->
            @yield('body')

            <footer class="text-center b-purple">
                <hr>
                <p>Copyright © {{date("Y", time())}} All Rights Reserved by. <a href="#"
                                                               target="_blank">BIDNEST</a>.</p>
            </footer>
        </div>
        <!-- footer -->
    </div>

    <div class="side-bar-pop-up">
    </div>
    @yield('modal')
</main>


@include('vendor-panel.layouts.includes.app-js')


<!-- Optional JavaScript -->


{{--
<script src="./assets/js/sidebarCollapse.js">

</script>--}}
</body>
</html>
