<!doctype html>
<html lang="en">

<head>

    <title>@yield('title')</title>
    @include('vendor-panel.layouts.includes.css')

</head>
<body>
<main class="dashboard grey-bg">
    @include('vendor-panel.layouts.includes.sidebar')
    <div class="content-wrapper">
        <div class="floating-btn">
            <img src="./assets/images/graph/Group 14372.svg" alt="">
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
                            <span>Amith Raji</span>

                            <div class="dropdown">
                                <ul>
                                    <li><a href="my-profile.html">My Profile</a></li>
                                    <li><a href="#">Change Password</a></li>

                                    <li><a href="#">Logout</a></li>
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





    <!-- Pop-up -->



    <!-- <div class="side-bar-pop-up">
        <div class="modal-header">
           <div class="theme-text heading f-18">Order Details</div>
            <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close"
                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">

                <i class="fa fa-times theme-text" aria-hidden="true"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active margin-topneg-15" id="customer" role="tabpanel"
                    aria-labelledby="new-order-tab">

                    <div class="d-flex  row  p-10">

                        <div class="col-sm-6">
                            <div class="theme-text f-14 bold">
                                Order ID
                            </div>

                        </div>
                        <div class="col-sm-5">
                            <div class="theme-text f-14">
                                P012345698
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="theme-text f-14">
                             <i class="icon dripicons-pencil p-1 cursor-pointer"
                                    aria-hidden="true"></i>
                            </div>
                        </div>


                    </div>
                    <div class="d-flex  row  p-10">

                        <div class="col-sm-6">
                            <div class="theme-text f-14 bold">
                                Vendor Name
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="theme-text f-14 d-flex justify-content-between">
                                Wayne Pvt Ltd
                            </div>
                        </div>



                    </div>
                    <div class="d-flex  row  p-10">

                        <div class="col-sm-6">
                            <div class="theme-text f-14 bold">
                                Vendor Details
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="theme-text f-14">
                                support@wayne.com
                            </div>
                            <div class="theme-text f-14">
                                +91 9782435672
                            </div>
                        </div>



                    </div>
                    <div class="d-flex  row  p-10">

                        <div class="col-sm-6">
                            <div class="theme-text f-14 bold">
                                Driver name
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="theme-text f-14">
                                <div class="d-flex vertical-center">
                                 Davide Jerome

                                 </div>
                            </div>
                        </div>



                    </div>
                    <div class="d-flex  row  p-10">

                        <div class="col-sm-6">
                            <div class="theme-text f-14 bold">
                                Driver Details
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="theme-text f-14">
                                davidjerome@gmail.com
                            </div>
                            <div class="theme-text f-14">
                                +91 9782435672
                            </div>
                        </div>



                    </div>
                    <div class="d-flex  row  p-10">

                        <div class="col-sm-6">
                            <div class="theme-text f-14 bold">
                                Time value
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="theme-text f-14">
                                00:03:20
                            </div>
                        </div>



                    </div>
                    <div class="d-flex  row  p-10 ">

                        <div class="col-sm-6">
                            <div class="theme-text f-14 bold">
                                Order Status
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="theme-text status-badge f-14 bold">
                                Awaiting Pickup
                            </div>
                        </div>
                    </div>
                    <div class="d-flex  row  p-10 ">

                        <div class="col-sm-6">
                            <div class="theme-text f-14 bold">
                                Order Amount
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="theme-text f-14 bold">
                                Rs 2,300
                            </div>
                        </div>
                    </div>
                    <div class="d-flex  row  p-10 ">
                        <div class="col-sm-6">
                            <div class="theme-text f-14 bold">
                                Address
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="theme-text f-14 bold">
                                Lorem ipsum dolor sit
                            </div>
                        </div>
                    </div>
                    <div class="d-flex  row  p-10 ">
                        <div class="col-sm-6">
                            <div class="theme-text f-14 bold">
                                Inventory
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="theme-text f-14 bold">
                                Lorem ipsum
                            </div>

                        </div>
                    </div>
                    <div class="d-flex  row  p-10 ">
                        <div class="col-sm-6">
                            <div class="theme-text f-14 bold">
                                Payment
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="theme-text f-14 bold">
                                Lorem ipsum
                            </div>

                        </div>
                    </div>


                    <div class="d-flex   justify-content-center p-10">

                        <div class=""><a class="white-text p-10" href="payout-details.html"><button
                                    class="btn theme-bg white-text">View More</button></a></div>




                    </div>
                </div>



            </div>
        </div>
    </div> -->

</main>


@include('vendor-panel.layouts.includes.js')


<!-- Optional JavaScript -->



<script src="./assets/js/sidebarCollapse.js">

</script>
</body>
</html>
