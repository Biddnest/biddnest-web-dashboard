@extends('layouts.app')

@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="orderBookings">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4 f-20">Bookings & Orders</h3>
        <div class="mr-20">
            <a href="Create-new-order.html">
                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1" aria-hidden="true"></i> Create New order</button>
            </a>
        </div>
    </div>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left  pt-0 pb-0 p-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Bookings & Orders</li>
                    <li class="breadcrumb-item"><a href="#"> Manage Bookings</a></li>   
                </ol>
            </nav>     
        </div>      
    </div>
    <!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-sm-12">
            <div class="card  h-auto p-0 pt-10">
                <div class="d-flex flex-row justify-content-between p-10">
                    <div class=" card-head right text-left">
                        <h3 class=" f-18 pb-0">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active p-15" id="live-tab" data-toggle="tab" href="#live" role="tab" aria-controls="home" aria-selected="true">Live Order</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="past-tab" data-toggle="tab" href="#past" role="tab" aria-controls="profile" aria-selected="false">Past Orders</a>
                                </li>
                            </ul>
                        </h3>
                    </div>
                    <div class="p-10 card-head left col-sm-3">
                        <div class="">
                            <form class="form-inline  input-group search-bar">
                                <input class="form-control    icon-bg " type="search" placeholder="Search..." aria-label="Search">
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Table -->
                <div class="tab-content margin-topneg-42" id="myTabContent">
                    <div class="tab-pane fade show active" id="live" role="tabpanel" aria-labelledby="live-tab">
                        <table class="table text-center p-0   theme-text  ">
                            <thead class="secondg-bg  p-0 f-14">
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">From</th>
                                    <th scope="col">To</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Assigned Vendor</th>
                                    <th scope="col">Order Status</th>
                                    <th scope="col">Operations</th>
                                </tr>
                            </thead>
                            <tbody class="mtop-20  f-13">
                                <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                    <td scope="row">SKU123456</td>
                                        <td>Gao</td>
                                        <td>Bengaluru</td>
                                        <td>28 Dec 2020</td>
                                        <td>Wayne Pvt Ltd</td>
                                        <td class=""><span class="green-bg  text-center td-padding">Completed</span></td>
                                        <td> <i class="icon dripicons-pencil p-1" aria-hidden="true"></i>
                                            <i class="icon dripicons-trash p-1" aria-hidden="true"></i>
                                        </td>
                                </tr>
                                <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                    <td scope="row">SKU123456</td>
                                    <td>Chennai</td>
                                    <td>Mumbai</td>
                                    <td>28 Dec 2020</td>
                                    <td>Wayne Pvt Ltd</td>
                                    <td class=""><span class="green-bg  text-center td-padding">Completed</span></td>
                                    <td><i class="icon dripicons-pencil p-1" aria-hidden="true"></i>
                                        <i class="icon dripicons-trash p-1" aria-hidden="true"></i>
                                    </td>
                                </tr>
                                <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                    <td scope="row">SKU123456</td>
                                    <td>Guntur</td>
                                    <td>Kolkata</td>
                                    <td>28 Dec 2020</td>
                                    <td>Wayne Pvt Ltd</td>
                                    <td class=""><span class="green-bg  text-center td-padding">Completed</span></td>
                                    <td> <i class="icon dripicons-pencil p-1" aria-hidden="true"></i>
                                        <i class="icon dripicons-trash p-1" aria-hidden="true"></i>
                                    </td>
                                </tr>
                                <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                    <td scope="row">SKU123456</td>
                                    <td>Hopete</td>
                                    <td>Bengaluru</td>
                                    <td>28 Dec 2020</td>
                                    <td>Wayne Pvt Ltd</td>
                                    <td class=""><span class="green-bg  text-center td-padding">Completed</span></td>
                                    <td> <i class="icon dripicons-pencil p-1" aria-hidden="true"></i>
                                        <i class="icon dripicons-trash p-1" aria-hidden="true"></i>
                                    </td>
                                </tr>
                                <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                    <td scope="row">SKU123456</td>
                                    <td>Sringeri</td>
                                    <td>Bengaluru</td>
                                    <td>28 Dec 2020</td>
                                    <td>Wayne Pvt Ltd</td>
                                    <td class=""><span class="green-bg  text-center td-padding">Completed</span></td>
                                    <td> <i class="icon dripicons-pencil p-1" aria-hidden="true"></i>
                                        <i class="icon dripicons-trash p-1" aria-hidden="true"></i>
                                     </td>
                                </tr>
                                <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up')toggleClass('display-pop-up');">
                                    <td scope="row">SKU123456</td>
                                    <td>Mumbai</td>
                                    <td>Chennai</td>
                                    <td>27 Dec 2020</td>
                                    <td>Wayne Pvt Ltd</td>
                                    <td class=""><span class="green-bg  text-center td-padding">Completed</span></td>
                                    <td> <i class="icon dripicons-pencil p-1" aria-hidden="true"></i>
                                        <i class="icon dripicons-trash p-1" aria-hidden="true"></i>
                                    </td>
                                </tr>
                                <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                    <td scope="row">SKU123456</td>
                                    <td>Kozhikode</td>
                                    <td>Bengaluru</td>
                                    <td>27 Dec 2020</td>
                                    <td>Wayne Pvt Ltd</td>
                                    <td class=""><span class="green-bg  text-center td-padding">Completed</span></td>
                                    <td> <i class="icon dripicons-pencil p-1" aria-hidden="true"></i>
                                        <i class="icon dripicons-trash p-1" aria-hidden="true"></i>
                                    </td>
                                </tr>
                                <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                    <td scope="row">SKU123456</td>
                                    <td>Kovallam</td>
                                    <td>kochi</td>
                                    <td>26 Dec 2020</td>
                                    <td>Wayne Pvt Ltd</td>
                                    <td class=""><span class="green-bg   text-center td-padding">Completed</span></td>
                                    <td> <i class="icon dripicons-pencil p-1" aria-hidden="true"></i>
                                        <i class="icon dripicons-trash p-1" aria-hidden="true"></i>
                                    </td>
                                </tr>
                                <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                    <td scope="row">SKU123456</td>
                                    <td>Benguluru</td>
                                    <td>Kochi</td>
                                    <td>26 Dec 2020</td>
                                    <td>Wayne Pvt Ltd</td>
                                    <td class=""><span class="green-bg   text-center td-padding">Completed</span></td>
                                    <td> <i class="icon dripicons-pencil p-1" aria-hidden="true"></i>
                                        <i class="icon dripicons-trash p-1" aria-hidden="true"></i>
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
                                <li class="button"><a href="#"><img src="{{ asset('static/images/Backward.svg')}}"></a></li>
                                <li class="button"><a href="#"><img src="{{ asset('static/images/forward.svg')}}"></a></li>
                            </ul>
                        </div>                                  
                    </div>
                    <div class="tab-pane fade" id="past" role="tabpanel" aria-labelledby="past-tab">
                        <table class="table text-center p-0  theme-text ">
                            <thead class="secondg-bg  p-0 f-14">
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">From</th>
                                    <th scope="col">To</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Assigned Vendor</th>
                                    <th scope="col">Order Status</th>
                                </tr>
                            </thead>
                            <tbody class="mtop-20 f-13">
                                <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up'').toggleClass('display-pop-up');">
                                    <td scope="row">SKU123456</td>
                                    <td>Gao</td>
                                    <td>Bengaluru</td>
                                    <td>28 Dec 2020</td>
                                    <td>Wayne Pvt Ltd</td>
                                    <td class=""><span class="green-bg  text-center td-padding">Completed</span></td>
                                </tr>
                                <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up'').toggleClass('display-pop-up');">
                                    <td scope="row">SKU123456</td>
                                    <td>Chennai</td>
                                    <td>Mumbai</td>
                                    <td>28 Dec 2020</td>
                                    <td>Wayne Pvt Ltd</td>
                                    <td class=""><span class="green-bg  text-center td-padding">Completed</span></td>
                                </tr>
                                <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up'').toggleClass('display-pop-up');">
                                    <td scope="row">SKU123456</td>
                                    <td>Guntur</td>
                                    <td>Kolkata</td>
                                    <td>28 Dec 2020</td>
                                    <td>Wayne Pvt Ltd</td>
                                    <td class=""><span class="green-bg text-center td-padding">Completed</span></td>
                                </tr>
                                <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up'').toggleClass('display-pop-up');">
                                        <td scope="row">SKU123456</td>
                                        <td>Hopete</td>
                                        <td>Bengaluru</td>
                                        <td>28 Dec 2020</td>
                                        <td>Wayne Pvt Ltd</td>
                                        <td class=""><span class="green-bg text-center td-padding">Completed</span></td>
                                </tr>
                                <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up'').toggleClass('display-pop-up');">
                                        <td scope="row">SKU123456</td>
                                        <td>Sringeri</td>
                                        <td>Bengaluru</td>
                                        <td>28 Dec 2020</td>
                                        <td>Wayne Pvt Ltd</td>
                                        <td class=""><span class="green-bg  text-center td-padding">Completed</span></td>
                                </tr>
                                <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up'').toggleClass('display-pop-up');">
                                    <td scope="row">SKU123456</td>
                                    <td>Mumbai</td>
                                    <td>Chennai</td>
                                    <td>27 Dec 2020</td>
                                    <td>Wayne Pvt Ltd</td>
                                    <td class=""><span class="green-bg  text-center td-padding">Completed</span></td>
                                </tr>
                                <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up'').toggleClass('display-pop-up');">
                                    <td scope="row">SKU123456</td>
                                    <td>Kozhikode</td>
                                    <td>Bengaluru</td>
                                    <td>27 Dec 2020</td>
                                    <td>Wayne Pvt Ltd</td>
                                    <td class=""><span class="green-bg   text-center td-padding">Completed</span></td>
                                </tr>
                                <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up'').toggleClass('display-pop-up');">
                                    <td scope="row">SKU123456</td>
                                    <td>Kovallam</td>
                                    <td>kochi</td>
                                    <td>26 Dec 2020</td>
                                    <td>Wayne Pvt Ltd</td>
                                    <td class=""><span class="green-bg   text-center td-padding">Completed</span></td>
                                </tr>
                                <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up'').toggleClass('display-pop-up');">
                                    <td scope="row">SKU123456</td>
                                    <td>Benguluru</td>
                                    <td>Kochi</td>
                                    <td>26 Dec 2020</td>
                                    <td>Wayne Pvt Ltd</td>
                                    <td class=""><span class="green-bg   text-center td-padding">Completed</span></td>
                                </tr>
                            </tbody>
                        </table> 
                        <div class="pagination">
                            <ul>
                                <li class="p-1">Page</li>
                                <li class="digit">1</li>
                                <li class="label">of</li>
                                <li class="digit">20</li>
                                <li class="button"><a href="#"><img src="{{ asset('static/images/Backward.svg')}}"></a></li>
                                <li class="button"><a href="#"><img src="{{ asset('static/images/forward.svg')}}"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection