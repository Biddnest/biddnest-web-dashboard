@extends('vendor-panel.layouts.frame')
@section('title') Manage Bookings @endsection
@section('body')
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="order-past">
    <div class="d-flex  flex-row justify-content-between vertical-center">
        <h3 class="page-head text-left p-4 f-20 theme-text">Past Orders</h3>
        <div class="mr-20">
            <!-- <a href="create-zones.html">
                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1"
                        aria-hidden="true"></i>CREATE New User</button>
            </a> -->

        </div>
    </div>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left  pt-0 pb-0 p-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Manage Bookings</li>
                    <li class="breadcrumb-item"><a href="#">Past orders </a></li>

                </ol>
            </nav>


        </div>

    </div>



    <!-- Dashboard cards -->


    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-sm-12">
            <div class="card  h-auto  pt-8 p-0">



                <!-- <div class="row no-gutters">
                    <div class="col-sm-8 p-3 ">
                        <h3 class="f-18">Past Orders </h3>

                    </div>
                    <div class="col-sm-1 -mr-4 pt-3 pl-8">
                        <a href="#"  data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i><img class="" src="./assets/images/filter.svg" alt="" srcset=""></i>

                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item border-top-bottom" href="#">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="total-no-orders">
                                <label class="form-check-label" for="total-no-orders">
                                    Total no of orders
                                </label>
                            </div>
                        </a>
                        <a class="dropdown-item border-top-bottom" href="#">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="statu">
                                <label class="form-check-label" for="status">
                                    Status
                                </label>
                            </div>
                        </a>
                        <a class="dropdown-item border-top-bottom" href="#">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="city">
                                <label class="form-check-label" for="city">
                                    City
                                </label>
                            </div>
                        </a>



                    </div>
                    </div>
                    <div class="card-head  pt-2  left col-sm-3">
                        <div class="search">
                           <input type="text" class="searchTerm" placeholder="Search...">
                           <button type="submit" class="searchButton">
                             <i class="fa fa-search"></i>
                          </button>
                        </div>
                </div>
                </div> -->










                <div class="header-wrap">
                    <h3 class="f-18 ml-1 theme_text">Past Orders </h1>

                        <div class="header-wrap p-0 filter-dropdown ">
                            <a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <i><img src="./assets/images/filter.svg" alt="" srcset=""></i>

                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item border-top-bottom" href="#">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value=""
                                               id="total-no-orders">
                                        <label class="form-check-label" for="total-no-orders">
                                            From
                                        </label>
                                    </div>
                                </a>
                                <a class="dropdown-item border-top-bottom" href="#">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="status">
                                        <label class="form-check-label" for="status">
                                            To
                                        </label>
                                    </div>
                                </a>
                                <a class="dropdown-item border-top-bottom" href="#">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="city">
                                        <label class="form-check-label" for="city">
                                            Order
                                        </label>
                                    </div>
                                </a>



                            </div>
                            <div class="search">
                                <input type="text" class="searchTerm" placeholder="Search...">
                                <button type="submit" class="searchButton">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>


                </div>





                <div class="all-vender-details">
                    <table class="table text-left p-0  theme-text ">
                        <thead class="secondg-bg  p-0 f-14">
                        <tr>
                            <th scope="col" class="text-left">Order ID</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Date of Movement</th>

                            <th scope="col">Amount</th>
                            <th scope="col">Order Status</th>
                        </tr>
                        </thead>
                        <tbody class="mtop-20 f-13">
                        <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                            <td scope="row" class="text-left">SKU123456</td>

                            <td>Gao</td>
                            <td>Bengaluru</td>
                            <td>28 Dec 2020</td>
                            <td>28 Dec 2020</td>
                            <td>5000</td>
                            <td class=""><span class="complete-bg  text-center td-padding">Completed</span></td>


                        </tr>
                        <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                            <td scope="row" class="text-left">SKU123456</td>

                            <td>Chennai</td>
                            <td>Mumbai</td>
                            <td>28 Dec 2020</td>
                            <td>28 Dec 2020</td>
                            <td>5000</td>
                            <td class=""><span class="complete-bg  text-center td-padding">Completed</span></td>
                        </tr>
                        <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                            <td scope="row" class="text-left">SKU123456</td>

                            <td>Guntur</td>
                            <td>Kolkata</td>
                            <td>28 Dec 2020</td>
                            <td>28 Dec 2020</td>
                            <td>5000</td>
                            <td class=""><span class="complete-bg text-center td-padding">Completed</span></td>
                        </tr>
                        <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                            <td scope="row" class="text-left">SKU123456</td>

                            <td>Hopete</td>
                            <td>Bengaluru</td>
                            <td>28 Dec 2020</td>
                            <td>28 Dec 2020</td>
                            <td>5000</td>
                            <td class=""><span class="complete-bg text-center td-padding">Completed</span></td>
                        </tr>
                        <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                            <td scope="row" class="text-left">SKU123456</td>

                            <td>Sringeri</td>
                            <td>Bengaluru</td>
                            <td>28 Dec 2020</td>
                            <td>28 Dec 2020</td>
                            <td>5000</td>
                            <td class=""><span class="complete-bg  text-center td-padding">Completed</span></td>
                        </tr>
                        <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                            <td scope="row" class="text-left">SKU123456</td>

                            <td>Mumbai</td>
                            <td>Chennai</td>
                            <td>27 Dec 2020</td>
                            <td>28 Dec 2020</td>
                            <td>5000</td>
                            <td class=""><span class="complete-bg  text-center td-padding">Completed</span></td>
                        </tr>
                        <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                            <td scope="row" class="text-left">SKU123456</td>

                            <td>Kozhikode</td>
                            <td>Bengaluru</td>
                            <td>27 Dec 2020</td>
                            <td>28 Dec 2020</td>
                            <td>5000</td>
                            <td class=""><span class="complete-bg   text-center td-padding">Completed</span></td>
                        </tr>
                        <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                            <td scope="row" class="text-left">SKU123456</td>

                            <td>Kovallam</td>
                            <td>kochi</td>
                            <td>26 Dec 2020</td>
                            <td>28 Dec 2020</td>
                            <td>5000</td>
                            <td class=""><span class="complete-bg   text-center td-padding">Completed</span></td>
                        </tr>
                        <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                            <td scope="row" class="text-left">SKU123456</td>

                            <td>Benguluru</td>
                            <td>Kochi</td>
                            <td>26 Dec 2020</td>
                            <td>28 Dec 2020</td>
                            <td>5000</td>
                            <td class=""><span class="complete-bg   text-center td-padding">Completed</span></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="pagination">
                        <ul>
                            <li class="p-1">Page</li>
                            <li class="digit">1</li>
                            <li class="label">of</li>
                            <li class="digit">20</li>
                            <li class="button"><a href="#"><img src="assets/images/Backward.svg"></a>
                            </li>
                            <li class="button"><a href="#"><img src="assets/images/forward.svg"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

    </div>




</div>
@endsection
