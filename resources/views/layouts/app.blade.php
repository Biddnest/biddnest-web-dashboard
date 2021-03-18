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
                        <form class="search-bar form-inline col-6 p-0">
                            <input class="form-control w-100 search-bar" type="search" placeholder="Search..."
                                aria-label="Search">
                        </form>
                        <div class="col-6">
                            <ul class="header-controls d-flex flex-row justify-content-end">
                                <li class="settings-icon"><a href="#"><span class="notification-icon"><i class="icon dripicons-toggles "height="15"></i></span> </a>

                                    <div class="dropdown settings" style="height: auto;">
                                        <ul>
                                            <!-- <li><a href="#">General Settings</a></li> -->
                                            <li><a href="{{route('api-settings')}}">API Settings</a></li>

                                        </ul>
                                    </div>
                                </li>
                                <li class="notifications"><a href="#"><span class="icon-navbar"><i class="icon dripicons-bell notification-icon"height="15"></i></span></a>
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
                                            <li><a href="{{route('details-users')}}">My Profile</a></li>
                                            <li><a href="{{route('reset-password')}}">Change Password</a></li>
                                            <li><a href="{{route('settings')}}">System Settings</a></li>
                                            <li><a href="#0" onclick="location.assign('{{route('logout')}}')">Logout</a></li>
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
                    <footer class="text-center b-purple">
                        <hr>
                        @php $year = date("Y"); @endphp
                        <p>Copyright © {{ $year }} All Rights Reserved by. <a href="https://admin-biddnest.dev.diginnovators.com/"
                                                                            target="_blank">BIDNEST</a>.</p>
                    </footer>
                </div>
            </div>


            <div class="side-bar-pop-up">
            </div>

            <div class="modal fade" id="add-new-role" tabindex="-1" role="dialog" aria-labelledby="add-new-role"
            aria-hidden="true">
                <div class="modal-dialog theme-text input-text-blue" role="document">
                    <div class="modal-content w-1000 right-25">
                        <div class="modal-header">
                            <h5 class="modal-title pl-3" id="exampleModalLongTitle">Add New Role</h5>
                            <button type="button" class="close theme-text pr-3 mr-1" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="d-flex row p-20 pt-0 pb-0">
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Employee First Name</label>
                                        <span class="">
                                            <input type="text" id="fullname" placeholder="David" value="David"
                                                class="form-control">
                                            <span class="error-message">Please enter valid
                                                First Name</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Employee Last Name</label>
                                        <span class="">
                                            <input type="text" id="fullname" placeholder="Jerome" value=""
                                                class="form-control">
                                            <span class="error-message">Please enter valid
                                                Last Name</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="phone-num-lable">Employee Contact Number</label>
                                        <span class="">
                                            <input type="tel" id="Employee" placeholder="9876543210" value=""
                                                class=" form-control form-control-tel">
                                            <span class="error-message">Please enter valid
                                                Phone number</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Role Type</label>
                                        <span class="">
                                            <select id="" class="form-control">
                                                <option>Junior Engineer</option>
                                                <option>Senior Engineer</option>
                                            </select>
                                            <span class="error-message">Please enter valid
                                                Service</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Vendor ID</label>
                                        <span class="">
                                            <input type="text" id="fullname" placeholder="V1234567" value=""
                                                class="form-control">
                                            <span class="error-message">Please enter valid
                                                Vendor ID</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Branch</label>
                                        <span class="">
                                            <select id="" class="form-control">
                                                <option>Delhi</option>
                                                <option>Mumbai</option>
                                            </select>
                                            <span class="error-message">Please enter valid
                                                Branch</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Organization ID</label>
                                        <span class="">
                                            <input type="text" id="fullname" placeholder="O123456" value="ORG123456"
                                                class="form-control">
                                            <span class="error-message">Please enter valid
                                                Organization ID</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Email ID</label>
                                        <span class="">
                                            <input type="email" id="fullname" placeholder="abc@email.com" value="davidjerome@mail.com"
                                                class="form-control">
                                            <span class="error-message">Please enter valid
                                                Email</span>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Password</label>
                                        <span class="">
                                            <input type="password" id="fullname" placeholder="Enter Password" value=""
                                                class="form-control">
                                            <span class="error-message">Please enter valid
                                                Password</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="w-50"><a class="white-text p-10" href="#" data-dismiss="modal"
                                    aria-label="Close"><button
                                        class="btn theme-br theme-text w-30 white-bg">Cancel</button></a></div>
                            <div class="w-50 text-right"><a class="white-text p-10" href="#" data-dismiss="modal"
                                    aria-label="Close"><button class="btn theme-bg white-text w-30">Save</button></a></div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
        @include('layouts.includes.app-js')
        @yield('scripts')
    </body>
</html>
