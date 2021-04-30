@extends('vendor-panel.layouts.frame')
@section('title') Manage Bookings @endsection
@section('body')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="order_participated">
        <div class="d-flex  flex-row justify-content-between" >
            <h3 class="page-head text-left p-4 f-20">Manage Bookings</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Manage Bookings</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Dashboard cards -->
        <div class="vender-all-details">
            <div class="simple-card">
                <p>NEW ORDERS</p>
                <h1>3,456</h1>
            </div>
            <div class="simple-card ">
                <p>Participated Orders</p>
                <h1>865</h1>
            </div>
            <div class="simple-card ">
                <p>Scheduled Orders</p>
                <h1>2,594</h1>
            </div>
            <div class="simple-card">
                <p>Saved Orders</p>
                <h1>2,300</h1>
            </div>
            <div class="simple-card ">
                <p>Past Orders</p>
                <h1>2,400</h1>
            </div>


        </div>
        <!-- Dashboard cards -->


        <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
            <div class="col-sm-12">

                <div class="card  h-auto p-0 pt-10">
                    <div class="d-flex flex-row justify-content-between p-10">
                        <div class="card-head right text-left">
                            <h3 class=" f-18 pb-0">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link p-15"
                                           href="{{route('vendor.bookings', ['type'=>"live"])}}" >New Orders</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link active p-15 hide-cards" id="past-tab" data-toggle="tab"
                                           href="#past" role="tab" aria-controls="profile"
                                           aria-selected="false">Participated Orders</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link  p-15 hide-cards"
                                           href="{{route('vendor.bookings', ['type'=>"scheduled"])}}" role="tab"
                                           >Scheduled Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link  p-15" href="{{route('vendor.bookings', ['type'=>"bookmarked"])}}">Saved Orders</a>
                                    </li>

                                </ul>
                            </h3>


                        </div>
                        <div class="pt-1 card-head left col-sm-3 ">

                            <div class="search">

                                <a href="#" class="margin-r-20 pt-2" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <i><img src="./assets/images/filter.svg" alt="" srcset=""></i>

                                </a>


                                <div class="dropdown-menu" x-placement="bottom-start">
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
                                            <input class="form-check-input" type="checkbox" value=""
                                                   id="status">
                                            <label class="form-check-label" for="status">
                                                To
                                            </label>
                                        </div>
                                    </a>
                                    <a class="dropdown-item border-top-bottom" href="#">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                   id="city">
                                            <label class="form-check-label" for="city">
                                                Order
                                            </label>
                                        </div>
                                    </a>



                                </div>
                                <input type="text" class="searchTerm" placeholder="Search...">
                                <button type="submit" class="searchButton">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Table -->

                    <div class="tab-content margin-topneg-42" id="myTabContent">

                        <div class="tab-pane fade show active" id="past" role="tabpanel" aria-labelledby="past-tab">
                            <table class="table text-left p-0  theme-text ">
                                <thead class="secondg-bg  p-0 f-14">
                                <tr>
                                    <th scope="col" class="text-left">Order ID</th>
                                    <th scope="col">From</th>
                                    <th scope="col">To</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Bid Amount</th>
                                    <th scope="col">Bid Submit</th>
                                    <th scope="col">Time Left</th>
                                </tr>
                                </thead>
                                <tbody class="mtop-20 f-13">
                                <tr class="tb-border  cursor-pointer"
                                    onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                    <td scope="row" class="text-left">SKU123456</td>

                                    <td>Gao</td>
                                    <td>Bengaluru</td>
                                    <td>28 Dec 2020</td>
                                    <td>5000</td>
                                    <td> davidjerome </td>
                                    <td><span class="timer-bg  f-weight-500 status-badge">5:00:00</span>
                                    </td>


                                </tr>
                                <tr class="tb-border  cursor-pointer"
                                    onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                    <td scope="row" class="text-left">SKU123456</td>

                                    <td>Chennai</td>
                                    <td>Mumbai</td>
                                    <td>28 Dec 2020</td>
                                    <td>5000</td>
                                    <td> Ann Hency </td>
                                    <td><span
                                            class="timer-bg  text-center f-weight-500 status-badge">5:00:00</span>
                                    </td>
                                </tr>
                                <tr class="tb-border  cursor-pointer"
                                    onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                    <td scope="row" class="text-left">SKU123456</td>

                                    <td>Guntur</td>
                                    <td>Kolkata</td>
                                    <td>28 Dec 2020</td>
                                    <td>5000</td>
                                    <td>Rohit kole </td>
                                    <td><span
                                            class="timer-bg  text-center f-weight-500 status-badge">5:00:00</span>
                                    </td>
                                </tr>
                                <tr class="tb-border  cursor-pointer"
                                    onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                    <td scope="row" class="text-left">SKU123456</td>

                                    <td>Hopete</td>
                                    <td>Bengaluru</td>
                                    <td>28 Dec 2020</td>
                                    <td>5000</td>
                                    <td>Jayraj Kollur </td>
                                    <td><span
                                            class="timer-bg  text-center f-weight-500 status-badge">5:00:00</span>
                                    </td>
                                </tr>
                                <tr class="tb-border  cursor-pointer"
                                    onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                    <td scope="row" class="text-left">SKU123456</td>

                                    <td>Sringeri</td>
                                    <td>Bengaluru</td>
                                    <td>28 Dec 2020</td>
                                    <td>5000</td>
                                    <td>Shankar Kumar </td>
                                    <td><span
                                            class="timer-bg  text-center f-weight-500 status-badge">5:00:00</span>
                                    </td>
                                </tr>
                                <tr class="tb-border  cursor-pointer"
                                    onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                    <td scope="row" class="text-left">SKU123456</td>

                                    <td>Mumbai</td>
                                    <td>Chennai</td>
                                    <td>27 Dec 2020</td>
                                    <td>5000</td>
                                    <td>Mukund P</td>
                                    <td><span
                                            class="timer-bg  text-center f-weight-500 status-badge">5:00:00</span>
                                    </td>
                                </tr>
                                <tr class="tb-border  cursor-pointer"
                                    onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                    <td scope="row" class="text-left">SKU123456</td>

                                    <td>Kozhikode</td>
                                    <td>Bengaluru</td>
                                    <td>27 Dec 2020</td>
                                    <td>5000</td>
                                    <td>Dhanush Rao </td>
                                    <td><span
                                            class="timer-bg  text-center f-weight-500 status-badge">5:00:00</span>
                                    </td>
                                </tr>
                                <tr class="tb-border  cursor-pointer"
                                    onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                    <td scope="row" class="text-left">SKU123456</td>

                                    <td>Kovallam</td>
                                    <td>kochi</td>
                                    <td>26 Dec 2020</td>
                                    <td>5000</td>
                                    <td>Arvind Wembar </td>
                                    <td><span
                                            class="timer-bg  text-center f-weight-500 status-badge">5:00:00</span>
                                    </td>
                                </tr>
                                <tr class="tb-border  cursor-pointer"
                                    onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                    <td scope="row" class="text-left">SKU123456</td>

                                    <td>Benguluru</td>
                                    <td>Kochi</td>
                                    <td>26 Dec 2020</td>
                                    <td>5000</td>
                                    <td>Arvind Wembar </td>
                                    <td><span
                                            class="timer-bg  text-center f-weight-500 status-badge">5:00:00</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="pagination">
                                <ul>
                                    <li class="p-1">Page</li>
                                    <li class="digit">1</li>
                                    <li class="label">of</li>
                                    <li class="digit">20</li>
                                    <li class="button"><a href="#"><img
                                                src="assets/images/Backward.svg"></a></li>
                                    <li class="button"><a href="#"><img src="assets/images/forward.svg"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>


                </div>

            </div>

        </div>




    </div>

@endsection
