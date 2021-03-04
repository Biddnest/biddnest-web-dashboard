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
                    <nav class="navbar navbar-light theme-bg h-70  d-felx felx-row justify-content-between navigation-top header-navigation">
                        <form class="search-bar form-inline col-6 p-0">
                            <input class="form-control w-100 search-bar" type="search" placeholder="Search..."
                                aria-label="Search">
                        </form>
                        <div class="col-6">
                            <ul class="header-controls d-flex flex-row justify-content-end">
                                <li class="settings-icon"><a href="#"><span class="notification-icon"><i class="icon dripicons-toggles "height="15"></i></span> </a>
                                    <div class="dropdown settings">
                                        <ul>
                                            <li><a href="#">General Settings</a></li>
                                            <li><a href="#">API Settings</a></li>
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
                                    <span>Amith Raji</span>
                                    <div class="dropdown">
                                        <ul>
                                            <li><a href="#">My Profile</a></li>
                                            <li><a href="#">Change Password</a></li>
                                            <li><a href="#">System Settings</a></li>
                                            <li><a href="#">Logout</a></li>
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

            <!--dashboard Pop-ups -->
            <div class="side-bar-pop-up" id="dashboard">
                <div class="modal-header">
                    <div class="theme-text heading f-18">Order Details</div>
                    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close"
                            onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                        <!-- <span aria-hidden="true" >&times;</span> -->
                        <i class="fa fa-times theme-text" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active margin-topneg-15" id="customer" role="tabpanel"
                            aria-labelledby="new-order-tab">
                            <!-- form starts -->
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


                        <!--  -->
                    </div>
                </div>
            </div>

            <!-- Order Booking Pop-ups -->
            <div class="side-bar-pop-up" id="orderbooking">
                <div class="modal-header pb-0 border-none">
                    <h3 class="f-14">
                        <ul class="nav nav-tabs  p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active p-15" id="new-order-tab" data-toggle="tab" href="#customer" role="tab" aria-controls="home" aria-selected="true">Customer Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" data-toggle="tab" href="#vendor" role="tab" aria-controls="profile" aria-selected="false">Vendor Details</a>
                            </li>

                        </ul>
                    </h3>

                    <button type="button" class="close theme-text margin-topneg-10" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                        <!-- <span aria-hidden="true" >&times;</span> -->
                        <i class="fa fa-times theme-text" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body border-top margin-topneg-7">
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active " id="customer" role="tabpanel" aria-labelledby="new-order-tab">
                            <!-- form starts -->
                            <div class="d-flex  row  p-10">
                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Customer Name
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="theme-text f-14">
                                        David Jerome
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="theme-text f-14">
                                        <i class="icon dripicons-pencil p-1 cursor-pointer" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex  row  p-10">
                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        From Address
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex  row  p-10">
                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        To Address
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex  row  p-10 border-top-pop">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Items to be moved
                                    </div>

                                </div>




                            </div>
                            <table class="table text-center p-10 theme-text">
                                <thead class="secondg-bg  p-0">
                                <tr>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Size</th>

                                </tr>
                                </thead>
                                <tbody class="mtop-20">
                                <tr class="tb-border  cursor-pointer">
                                    <th scope="row">Bed</th>

                                    <td class="text-center">02</td>
                                    <td class=""><span class="red-bg text-center w-100  td-padding">Large</span></td>

                                </tr>
                                <tr class="tb-border  cursor-pointer">
                                    <th scope="row">Cupbords</th>

                                    <td>04</td>
                                    <td class=""><span class="green-bg text-center td-padding-2 w-100">Medium</span></td>

                                </tr>
                                <tr class="tb-border  cursor-pointer">
                                    <th scope="row">Books</th>

                                    <td>03</td>
                                    <td class=""><span class=" light-bg text-center td-padding w-100">Small</span></td>

                                </tr>
                                </tbody>
                            </table>
                            <div class="d-flex   justify-content-center p-10">
                                <div class=""><a class="white-text p-10" href="{{route('order-details',["id"=>1])}}"><button class="btn theme-bg white-text">View More</button></a></div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="vendor" role="tabpanel" aria-labelledby="past-tab">
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Assigned Vendor
                                    </div>

                                </div>
                                <div class="col-sm-5">
                                    <div class="theme-text f-14">
                                        Wayne Pvt Ltd
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="theme-text f-14">
                                        <i class="icon dripicons-pencil p-1 cursor-pointer" aria-hidden="true"></i>
                                    </div>
                                </div>


                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Assigned Vehicle
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        KA03 B 1165
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Assigned Driver
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        Abhi Ram
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Driver Phone Number
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        +91 - 9725364758
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Commission Amount
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        ₹ 2,300
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Discount From Vendor
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        30% Off
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex   justify-content-center p-10">

                                <div class=""><a class="white-text p-10" href="{{route('order-details',["id"=>1])}}"><button class="btn theme-bg white-text">View More</button></a></div>




                            </div>
                        </div>
                        <!--  -->
                    </div>
                </div>
            </div>

            <!-- customer Pop-ups -->
            <div class="side-bar-pop-up" id="customer">
                <div class="modal-header pb-0 border-none">
                    <h3 class="f-14">
                        <ul class="nav nav-tabs pt-20 p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active pb-3" id="new-order-tab" data-toggle="tab" href="#vendor" role="tab"
                                aria-controls="home" aria-selected="true">Users Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pb-3" id="quotation" data-toggle="tab" href="#customer" role="tab"
                                aria-controls="profile" aria-selected="false">Users Insights</a>
                            </li>

                        </ul>
                    </h3>

                    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close"
                            onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                        <i class="fa fa-times theme-text" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body border-top margin-topneg-7">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="vendor" role="tabpanel" aria-labelledby="past-tab">

                            <div class="row d-flex  pb-4 pl-3">
                                <div class="col-lg-12 ">
                                    <div class="profile-section">
                                        <figure>
                                            <img src="assets/images/big-profile.svg" alt="">
                                        </figure>
                                        <div class="profile-details-side-pop">
                                            <ul>
                                                <li>
                                                    <h1>David Jerome</h1>
                                                    <i class="fa fa-pencil pr-1 mr-1 " style="color: #3BA3FB;" aria-hidden="true"></i>
                                                </li>
                                                <li>
                                                    <h2>davidjerome@ymail.com</h2>
                                                    <a href="#">
                                                        <i class="fa fa-star-o pr-1 mr-1" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <p>+91-9739823457</p>

                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row d-flex pb-4 pl-3">
                                <div class="col-lg-6 align-items-center">
                                    <h1 class="side-popup-heading">Date of Birth</h1>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                                    <h1 class="side-popup-content">30 / 07 / 1995</h1>
                                </div>
                            </div>
                            <div class="row d-flex pb-4 pl-3">
                                <div class="col-lg-6 align-items-center">
                                    <h1 class="side-popup-heading">Gender</h1>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                                    <h1 class="side-popup-content">Male</h1>
                                </div>
                            </div>
                            <div class="row d-flex pb-4 pl-3">
                                <div class="col-lg-6 align-items-center">
                                    <h1 class="side-popup-heading">Zone</h1>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                                    <h1 class="side-popup-content">Bengaluru Urban</h1>
                                </div>
                            </div>
                            <div class="row d-flex pb-4 pl-3">
                                <div class="col-lg-6 align-items-center">
                                    <h1 class="side-popup-heading">No of Orders</h1>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                                    <h1 class="side-popup-content">10</h1>
                                </div>
                            </div>
                            <div class="row d-flex pb-4 pl-3">
                                <div class="col-lg-6 align-items-center">
                                    <h1 class="side-popup-heading">Status</h1>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                                    <div class="status-badge">Enquiry</div>
                                </div>
                            </div>



                            <div class="d-flex justify-content-center p-20">
                                <!-- <div class="">
                                    <a class="white-text p-10" href="#">
                                        <button class="btn theme-bg white-text my-0" style="width: 127px;
                                        border-radius: 6px;">View More</button>
                                    </a>
                                </div> -->
                            </div>



                        </div>
                        <div class="tab-pane fade  margin-topneg-15" id="customer" role="tabpanel"
                            aria-labelledby="new-order-tab">
                            <!-- form starts -->
                            <div class="d-flex row pt-3 p-20">
                                <div class="col-lg-6">
                                    <div class="theme-text f-14 bold">
                                        List of Orders
                                    </div>
                                </div>
                            </div>
                            <table class="table text-center p-10 theme-text th-no-border">
                                <thead class="secondg-bg p-0" >
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Order Date</th>

                                </tr>
                                </thead>
                                <tbody class="mtop-20">
                                <tr class="cursor-pointer">
                                    <td scope="row">
                                        <p style="text-decoration: underline;margin: 0;">SKU12345</p>
                                    </td>
                                    <td class="">
                                        <div class="status-badge">Bidding</div>
                                    </td>
                                    <td class="text-center">23 Dec 20</td>

                                </tr>
                                <tr class="cursor-pointer">
                                    <td scope="row">
                                        <p style="text-decoration: underline;margin: 0;">SKU12335</p>
                                    </td>
                                    <td class="">
                                        <div class="status-badge">In Transit</div>
                                    </td>
                                    <td class="text-center">23 Dec 20</td>

                                </tr>
                                <tr class="cursor-pointer" style="border-bottom: 1px solid #dee2e6;">
                                    <td scope="row">
                                        <p style="text-decoration: underline;margin: 0;">SKU12348</p>
                                    </td>
                                    <td class="">
                                        <div class="status-badge">Awaiting Packup</div>
                                    </td>
                                    <td class="text-center">26 Dec 20</td>
                                </tr>

                                </tbody>
                            </table>

                            <div class="d-flex row pt-3 p-20">
                                <div class="col-lg-6">
                                    <div class="theme-text f-14 bold">
                                        List of Coupons
                                    </div>
                                </div>
                            </div>
                            <table class="table text-center p-10 theme-text th-no-border">
                                <thead class="secondg-bg p-0" >
                                <tr>
                                    <th scope="col">Coupon Code</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Order Date</th>

                                </tr>
                                </thead>
                                <tbody class="mtop-20">
                                <tr class="cursor-pointer">
                                    <td scope="row">
                                        <p style="text-decoration: underline;margin: 0;">SKU12348</p>
                                    </td>
                                    <td class="">
                                        30%
                                    </td>
                                    <td class="text-center">23 Dec 20</td>

                                </tr>
                                <tr class="cursor-pointer">
                                    <td scope="row">
                                        <p style="text-decoration: underline;margin: 0;">SKU12448</p>
                                    </td>
                                    <td class="">
                                        45%
                                    </td>
                                    <td class="text-center">23 Dec 20</td>

                                </tr>
                                <tr class="cursor-pointer" style="border-bottom: 1px solid #dee2e6;">
                                    <td scope="row">
                                        <p style="text-decoration: underline;margin: 0;">SKU12349</p>
                                    </td>
                                    <td class="">
                                        60%
                                    </td>
                                    <td class="text-center">26 Dec 20</td>
                                </tr>

                                </tbody>
                            </table>

                            <div class="d-flex   justify-content-center p-20">

                                <!-- <div class=""><a class="white-text p-10" href="#">
                                    <button class="btn theme-bg white-text my-0" style="width: 127px;
                                    border-radius: 6px;">View More</button>
                                        </a></div> -->




                            </div>
                        </div>


                        <!--  -->
                    </div>
                </div>
            </div>

            <!--create customer Pop-ups -->
            <div class="modal fade" id="for-friend" tabindex="-1" role="dialog" aria-labelledby="for-friend"
                aria-hidden="true">
                <div class="modal-dialog theme-text input-text-blue" role="document">
                    <div class="modal-content w-1000 right-25">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Branch</h5>
                            <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="d-flex row p-20">
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Branch Name</label>
                                        <span class="">
                                            <input type="text" id="fullname"
                                                placeholder="" value="Wayne Packing Pvt Ltd"
                                                class="form-control">
                                            <span class="error-message">Please enter valid
                                                Branch Name</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="phone-num-lable">Branch Type</label>
                                        <span class="">
                                            <select  id="" class="form-control">
                                                <option >Pvt Ltd</option>
                                                <option>Pub Ltd</option>
                                                </select>
                                            <span class="error-message">Please enter valid
                                                Branch Type</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="phone-num-lable">Secondary Contact Number</label>
                                        <span class="">
                                            <input type="tel" id="input-blue"
                                                placeholder="" value="987654321"
                                                class=" form-control form-control-tel">
                                            <span class="error-message">Please enter valid
                                                Phone number</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Zone</label>
                                        <span class="">
                                            <input type="text" id="fullname"
                                                placeholder="" value="Bengaluru Urban"
                                                class="form-control">
                                            <span class="error-message">Please enter valid
                                                Zone</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Address Line 1</label>
                                        <span class="">
                                            <input type="text" id="fullname"
                                                placeholder="" value="Lorem ipsum dolor sit amet, consetetur sadip"
                                                class="form-control">
                                            <span class="error-message">Please enter valid
                                                Address Line</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Address Line 2</label>
                                        <span class="">
                                            <input type="text" id="fullname"
                                                placeholder="" value="Lorem ipsum dolor sit amet, consetetur sadip"
                                                class="form-control">
                                            <span class="error-message">Please enter valid
                                                Address Line</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Lattitude</label>
                                        <span class="">
                                            <input type="text" id="fullname"
                                                placeholder="" value="57.2046° N"
                                                class="form-control">
                                            <span class="error-message">Please enter valid
                                                Lattitude</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Longitude</label>
                                        <span class="">
                                            <input type="text" id="fullname"
                                                placeholder="" value="77.7907° E"
                                                class="form-control">
                                            <span class="error-message">Please enter valid
                                                Longitude</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Landmark</label>
                                        <span class="">
                                            <input type="text" id="fullname"
                                                placeholder="" value="Pheonix Market City"
                                                class="form-control">
                                            <span class="error-message">Please enter valid
                                                Landmark</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">City</label>
                                        <span class="">
                                            <input type="text" id="fullname"
                                                placeholder="" value="Bengaluru"
                                                class="form-control">
                                            <span class="error-message">Please enter valid
                                                City</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label>State</label>
                                        <span class="">
                                            <select id="" class="form-control">
                                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands
                                                </option>
                                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                <option value="Assam">Assam</option>
                                                <option value="Bihar">Bihar</option>
                                                <option value="Chandigarh">Chandigarh</option>
                                                <option value="Chhattisgarh">Chhattisgarh</option>
                                                <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                                <option value="Daman and Diu">Daman and Diu</option>
                                                <option value="Delhi">Delhi</option>
                                                <option value="Lakshadweep">Lakshadweep</option>
                                                <option value="Puducherry">Puducherry</option>
                                                <option value="Goa">Goa</option>
                                                <option value="Gujarat">Gujarat</option>
                                                <option value="Haryana">Haryana</option>
                                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                                <option value="Jharkhand">Jharkhand</option>
                                                <option value="Karnataka" selected>Karnataka</option>
                                                <option value="Kerala">Kerala</option>
                                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                <option value="Maharashtra">Maharashtra</option>
                                                <option value="Manipur">Manipur</option>
                                                <option value="Meghalaya">Meghalaya</option>
                                                <option value="Mizoram">Mizoram</option>
                                                <option value="Nagaland">Nagaland</option>
                                                <option value="Odisha">Odisha</option>
                                                <option value="Punjab">Punjab</option>
                                                <option value="Rajasthan">Rajasthan</option>
                                                <option value="Sikkim">Sikkim</option>
                                                <option value="Tamil Nadu">Tamil Nadu</option>
                                                <option value="Telangana">Telangana</option>
                                                <option value="Tripura">Tripura</option>
                                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                <option value="Uttarakhand">Uttarakhand</option>
                                                <option value="West Bengal">West Bengal</option>
                                            </select>
                                            <span class="error-message">Please enter valid</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Pincode</label>
                                        <span class="">
                                            <input type="text" id="fullname"
                                                placeholder="" value="560097"
                                                class="form-control">
                                            <span class="error-message">Please enter valid
                                                Pincode</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Service Type</label>
                                        <span class="">
                                            <select  id="" class="form-control">
                                                <option >Economic</option>
                                                <option>Service 2</option>
                                                <option>Service 3</option>
                                                </select>
                                            <span class="error-message">Please enter valid
                                                Service</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Service</label>
                                        <span class="">
                                            <select  id="" class="form-control">
                                                <option >Residential</option>
                                                <option>Service 2</option>
                                                <option>Service 3</option>
                                                </select>
                                            <span class="error-message">Please enter valid
                                                Service</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-input">
                                        <label class="full-name">Branch Description</label>
                                        <span class="">
                                            <textarea placeholder="Need to Include bike" style="resize: none;" id="" class="form-control green-bg" rows="4" cols="50" spellcheck="false">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                                            </textarea>
                                        <span class="error-message">Please enter  valid Description</span>
                                        </span>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="w-50"><a class="white-text p-10" href="#"  data-dismiss="modal" aria-label="Close"><button
                                        class="btn theme-br theme-text w-30 white-bg">Cancel</button></a></div>
                            <div class="w-50 text-right"><a class="white-text p-10" href="#"  data-dismiss="modal" aria-label="Close"><button
                                        class="btn theme-bg white-text w-30">Save</button></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="add-new-role" tabindex="-1" role="dialog" aria-labelledby="add-new-role"
                    aria-hidden="true">
                <div class="modal-dialog theme-text input-text-blue" role="document">
                    <div class="modal-content w-1000 right-25">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add New Role</h5>
                            <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="d-flex row p-20 pt-0">
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Employee First Name</label>
                                        <span class="">
                                        <input type="text" id="fullname"
                                            placeholder="" value="David"
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
                                        <input type="text" id="fullname"
                                            placeholder="" value="Jerome"
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
                                        <input type="tel" id="input-blue"
                                            placeholder="" value="987654321"
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
                                        <select  id="" class="form-control">
                                            <option >Junior Engineer</option>
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
                                        <input type="text" id="fullname"
                                            placeholder="" value="davidjerome123"
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
                                        <select  id="" class="form-control">
                                            <option >Delhi</option>
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
                                        <input type="text" id="fullname"
                                            placeholder="" value="ORG123456"
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
                                        <input type="email" id="fullname"
                                            placeholder="" value="davidjerome@mail.com"
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
                                        <input type="password" id="fullname"
                                            placeholder="" value=""
                                            class="form-control">
                                        <span class="error-message">Please enter valid
                                            Password</span>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="w-50"><a class="white-text p-10" href="#"  data-dismiss="modal" aria-label="Close"><button
                                        class="btn theme-br theme-text w-30 white-bg">Cancel</button></a></div>
                            <div class="w-50 text-right"><a class="white-text p-10" href="#"  data-dismiss="modal" aria-label="Close"><button
                                        class="btn theme-bg white-text w-30">Save</button></a></div>
                        </div>
                    </div>
                </div>

            </div>


           <!-- inventories -->
           <div class="side-bar-pop-up h-100" id="inventory">
                <div class="modal-header pb-0">
                    <h3 class="theme-text p-2 mb-2 f-14"> Inventory Details</h3>

                    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close"
                        onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                        <i class="fa fa-times theme-text" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex  pb-4 pl-3">
                        <div class="col-lg-12 ">
                            <div class="profile-section">
                                <figure>
                                    <img src="assets/images/big-profile.svg" alt="">
                                </figure>
                                <div class="profile-details-side-pop">
                                    <ul>
                                        <li>
                                            <h1>Cupboards</h1>
                                            <i class="icon dripicons-pencil pr-1 mr-1 " style="color: #3BA3FB;"
                                            aria-hidden="true"></i>
                                        </li>
                                        <li>
                                            <h2>Polycarbonate</h2>
                                            <label class="switch mb-0" style="transform: scale(0.7);">
                                                <input type="checkbox" id="switch">
                                                <span class="slider"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex  pb-4 pl-3">
                        <div class="col-lg-6 align-items-center">
                            <h1 class="side-popup-heading">Item ID</h1>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-between align-items-center">
                            <h1 class="side-popup-content">IT1234445</h1>
                        </div>
                    </div>
                    <div class="row d-flex pb-4 pl-3">
                        <div class="col-lg-6 align-items-center">
                            <h1 class="side-popup-heading">Category ID</h1>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-between align-items-center">
                            <h1 class="side-popup-content">C1234098</h1>
                        </div>
                    </div>
                    <div class="row d-flex pb-4 pl-3">
                        <div class="col-lg-6 align-items-center">
                            <h1 class="side-popup-heading">Vendor ID</h1>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-between align-items-center">
                            <h1 class="side-popup-content">V0912374</h1>
                        </div>
                    </div>
                    <div class="row d-flex pb-4 pl-3">
                        <div class="col-lg-6 align-items-center">
                            <h1 class="side-popup-heading">Zone </h1>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-between align-items-center">
                            <h1 class="side-popup-content">Bengaluru Urban</h1>
                        </div>
                    </div>
                    <div class="row d-flex pb-4 pl-3">
                        <div class="col-lg-6 align-items-center">
                            <h1 class="side-popup-heading">Transport Vehicle</h1>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-between align-items-center">
                            <h1 class="side-popup-content">KA03 B 1176</h1>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center p-20">
                        <div class="">
                            <a class="white-text p-10" href="{{ route('details-inventories')}}">
                                <button class="btn theme-bg white-text my-0" style="width: 127px;
                                border-radius: 6px;">View More</button>
                            </a>
                        </div>
                    </div>
               

            <!-- Cupons Pop-up -->
            <div class="side-bar-pop-up" id="coupons">
                <div class="modal-header">
                <div class="theme-text heading f-18">Coupons Details </div>
                    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close"
                        onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                        <!-- <span aria-hidden="true" >&times;</span> -->
                        <i class="fa fa-times theme-text" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active margin-topneg-15" id="customer" role="tabpanel"
                            aria-labelledby="new-order-tab">
                            <!-- form starts -->
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Coupons Code
                                    </div>

                                </div>
                                <div class="col-sm-5">
                                    <div class="theme-text f-14">
                                        SKU1234456 
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
                                        Coupon ID 
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14 d-flex justify-content-between">
                                        Discount123456 
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Coupon Type 
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        Discount
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Coupon Usage 
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        <div class="d-flex vertical-center">
                                            10
                                        <div class="progress  ">
                                            <div class="progress-bar bg-progress" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Coupon Description 
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        Get sale offer of 30%  on your
                                        next order
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Zone 
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        Bengaluru Urban
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10 border-top-pop">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Coupon List
                                    </div>

                                </div>




                            </div>
                            <table class="table text-center p-10 theme-text">
                                <thead class="secondg-bg  p-0">
                                    <tr>
                                        <th scope="col">Coupon</th>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Order Date</th>

                                    </tr>
                                </thead>
                                <tbody class="mtop-20">
                                    <tr class="tb-border  cursor-pointer">
                                        <th scope="row">PACK12345</th>

                                        <td class="text-center">SKU124672</td>
                                        <td class="">23 Dec 20
                                        </td>

                                    </tr>
                                    <tr class="tb-border  cursor-pointer">
                                        <th scope="row">PACK12345</th>

                                        <td class="text-center">SKU124672</td>
                                        <td class="">23 Dec 20
                                        </td>

                                    </tr>
                                    <tr class="tb-border  cursor-pointer">
                                        <th scope="row">PACK12345</th>

                                        <td class="text-center">SKU124672</td>
                                        <td class="">23 Dec 20
                                        </td>

                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex   justify-content-center p-10">

                                <div class=""><a class="white-text p-10" href="{{ route('details-coupons')}}"><button
                                            class="btn theme-bg white-text">View More</button></a></div>




                            </div>
                        </div>
                    

                        <!--  -->
                    </div>
                </div>
            </div>

            <!-- Create Cupons Pop-up -->
            <div class="modal fade" id="for-friend" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                <div class="modal-dialog theme-text" role="document">
                    <div class="modal-content w-1000 right-25">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">For a friend</h5>
                        <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="d-flex  row  p-20" >

                        <div class="col-sm-6">
                            <div class="form-input">
                            <label class="phone-num-lable">Phone Number</label>
                            <span class="">
                                <input type="tel" id="phone-pop-up" placeholder="987654321" class=" form-control form-control-tel">
                            <span class="error-message">Please enter  valid Phone number</span>
                            </span>
                            
                            
                        </div>
                            
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input">
                            <label class="full-name">Full Name</label>
                            <span class="">
                                <input type="text" id="fullname" placeholder="David Jerome"  class="form-control">
                            <span class="error-message">Please enter  valid Phone number</span>
                            </span>
                            
                            
                        </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-input">
                            <label class="email-label">Email</label>
                            <span class="">
                                <input type="email"  placeholder="abc@mail.com" id="E-mail" class="form-control">
                            <span class="error-message">Please enter  valid Email</span>
                            </span>
                            
                            
                        </div>
                            
                        </div>

                        <div class="col-sm-6">
                            <div class="form-input">
                            <label>Gender</label>
                            <span class="">
                                <select  id="" class="form-control">
                                <option >  Male</option>
                                <option>  Female</option>
                                
                                </select>
                            <span class="error-message">Please enter  valid</span>
                            </span>
                            
                            
                        </div>
                            
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input">
                            <label>From Adress line 1</label>
                            <span class="">
                                <input type="text"  placeholder="SVM Complex,indiranagar,Benguluru" id="" class="form-control">
                            <span class="error-message">Please enter  valid</span>
                            </span>
                            
                            
                        </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input">
                            <label>From Adress line 2</label>
                            <span class="">
                                <input type="text"  placeholder="SVM Complex,indiranagar,Benguluru" id="" class="form-control">
                            <span class="error-message">Please enter  valid</span>
                            </span>
                            
                            
                        </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input">
                            <label>State</label>
                            <span class="">
                                <select  id="" class="form-control">
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                    <option value="Assam">Assam</option>
                                    <option value="Bihar">Bihar</option>
                                    <option value="Chandigarh">Chandigarh</option>
                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                    <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                    <option value="Daman and Diu">Daman and Diu</option>
                                    <option value="Delhi">Delhi</option>
                                    <option value="Lakshadweep">Lakshadweep</option>
                                    <option value="Puducherry">Puducherry</option>
                                    <option value="Goa">Goa</option>
                                    <option value="Gujarat">Gujarat</option>
                                    <option value="Haryana">Haryana</option>
                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                    <option value="Jharkhand">Jharkhand</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Kerala">Kerala</option>
                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                    <option value="Manipur">Manipur</option>
                                    <option value="Meghalaya">Meghalaya</option>
                                    <option value="Mizoram">Mizoram</option>
                                    <option value="Nagaland">Nagaland</option>
                                    <option value="Odisha">Odisha</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Rajasthan">Rajasthan</option>
                                    <option value="Sikkim">Sikkim</option>
                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                    <option value="Telangana">Telangana</option>
                                    <option value="Tripura">Tripura</option>
                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                    <option value="Uttarakhand">Uttarakhand</option>
                                    <option value="West Bengal">West Bengal</option>
                                
                                
                                </select>
                            <span class="error-message">Please enter  valid</span>
                            </span>
                            
                            
                        </div>
                            
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input">
                            <label>City</label>
                            <span class="">
                                <input type="text"  placeholder="Benguluru" id="" class="form-control">
                            <span class="error-message">Please enter  valid</span>
                            </span>
                            
                            
                        </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input">
                            <label>Pincode</label>
                            <span class="">
                                <input type="text"  placeholder="530000" id="" class="form-control">
                            <span class="error-message">Please enter  valid</span>
                            </span>
                            
                            
                        </div>
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-50"><a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Cancel</button></a></div>
                        <div class="w-50 text-right"><a class="white-text p-10" href="#"><button class="btn theme-bg white-text w-30">Send Otp</button></a></div>
                    </div>
                    </div>
                </div>
            </div> 

        
        </main>
        @include('layouts.includes.app-js')
        @yield('scripts')
    </body>
</html>
