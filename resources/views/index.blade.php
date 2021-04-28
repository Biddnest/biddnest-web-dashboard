@extends('layouts.app')
@section('title') Dashboard @endsection
@section('content')

 <!-- Main Content -->
 <div class="main-content grey-bg" data-barba="container" data-barba-namespace="dashboard">
    <h3 class="page-head text-left p-4 f-20">Dashboard
        <i class="icon dripiconmeter"></i>
    </h3>
    {{--<div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left  pt-0 pb-0 p-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Last login at</li>
                    <li class="breadcrumb-item"><a href="#">11:55:02 AM</a></li>
                </ol>
            </nav>
        </div>
    </div>--}}
    <!-- Dashboard cards -->
    <div class="vender-all-details dashboard-cards flex-row">
        <div class="simple-card">
            <p>ORDER</p>
            <h1>{{$count_orders}}</h1>
        </div>
        <div class="simple-card">
            <p>VENDORS</p>
            <h1>{{$count_vendors}}</h1>
        </div>
        <div class="simple-card">
            <p>USERS</p>
            <h1>{{$count_users}}</h1>
        </div>
        <div class="simple-card">
            <p>ZONES</p>
            <h1>{{$count_zones}}</h1>
        </div>
        <div class="simple-card">
            <p>LIVE ORDERS</p>
            <h1>{{$count_live_orders}}</h1>
        </div>
        {{--<div class="simple-card">
            <p>SALES</p>
            <h1>2,248</h1>
        </div>--}}
    </div>
    <!--  dashboard Columns -->
    <div class="d-flex flex-row justify-content-between Dashboard-lcards">
        <div class="col-sm-8 p-0">
            <div class="card p-10" style="">
                <div class="d-flex flex-row justify-content-between">
                    <div class="p-10 card-head right text-left">
                        <h3 class="f-18 mt-0">Recent Orders</h3>
                    </div>
                    {{--<div class="p-10 card-head left">
                        <a><i><img src="{{asset('static/images/filter.svg') }}" alt="" srcset=""></i>
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
                                    <input class="form-check-input" type="checkbox" value="" id="status">
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
                    </div>--}}
                </div>
                <table class="table text-center p-0">
                    <thead class="secondg-bg border-none p-0">
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Order Status</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Order Amount</th>
                        </tr>
                    </thead>
                    <tbody class="mtop-20">
                        @foreach($bookings as $booking)
                            <tr class="tb-border cursor-pointer sidebar-toggle" data-sidebar="{{ route('sidebar.booking',['id'=>$booking->id]) }}">
                                <th scope="row" style="text-decoration: underline;">{{$booking->public_booking_id}}</th>
                                <td class="">
                                    @switch($booking->status)
                                        @case(\App\Enums\BookingEnums::$STATUS['enquiry'])
                                            <span class=" text-center status-badge ">Enquiry</span>
                                        @break;

                                        @case(\App\Enums\BookingEnums::$STATUS['placed'])
                                        <span class=" text-center status-badge ">Placed</span>
                                        @break;

                                        @case(\App\Enums\BookingEnums::$STATUS['biding'])
                                        <span class=" text-center status-badge light-bg">Biding</span>
                                        @break;

                                        @case(\App\Enums\BookingEnums::$STATUS['rebiding'])
                                        <span class=" text-center status-badge light-bg">Rebiding</span>
                                        @break;

                                        @case(\App\Enums\BookingEnums::$STATUS['payment_pending'])
                                        <span class=" text-center status-badge red-bg">Payment Pending</span>
                                        @break;

                                        @case(\App\Enums\BookingEnums::$STATUS['pending_driver_assign'])
                                        <span class=" text-center status-badge ">Pending Driver Assign</span>
                                        @break;

                                        @case(\App\Enums\BookingEnums::$STATUS['awaiting_pickup'])
                                        <span class=" text-center status-badge red-bg">Awaiting Pickup</span>
                                        @break;

                                        @case(\App\Enums\BookingEnums::$STATUS['in_transit'])
                                        <span class=" text-center status-badge ">In Transit</span>
                                        @break;

                                        @case(\App\Enums\BookingEnums::$STATUS['completed'])
                                        <span class=" text-center status-badge green-bg">Completed</span>
                                        @break;

                                        @case(\App\Enums\BookingEnums::$STATUS['cancelled'])
                                        <span class=" text-center status-badge red-bg">Cancelled</span>
                                        @break;
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    @if(\App\Enums\BookingEnums::$STATUS['biding']==$booking->status ||  \App\Enums\BookingEnums::$STATUS['rebiding']==$booking->status)
                                        {{\Carbon\Carbon::now()->diffForHumans($booking->bid_result_at)}}
                                    @else
                                        Bidding Done
                                    @endif
                                </td>
                                <td class="text-center">₹ @if($booking->final_quote){{$booking->final_quote}} @else {{$booking->final_estimated_quote}} @endif</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
         <div class="col-sm-4 p-0">
            <div class="d-flex card ">
                <div class="p-10 ">
                    <h3 class="f-18 mt-0">Live Orders Distribution</h3>
                </div>
                <div class="canvas-con">
                    <div class="total-user">Orders</div>
                        <div class="canvas-con-inner">
                            <canvas id="mychart" height="150px" width="150px" ></canvas>
                        </div>
                        <div id="my-legend-con" class="legend-con"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex h-auto  Dashboard-lcards">
            <div class="col-sm-8 h-auto p-0">
                <div class="d-flex  card ">
                    <div class="p-10 d-flex justify-content-between ">
                        <h3 class="f-18 mt-0">Revenue Trend</h3>
                        <div class="d-flex ">
                            <div class="d-felx flex-column ml-20">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle btn-dropdown mr-0 ml-10 Weekly"
                                                    type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    Weekly
                                    </button>
                                    <div class="dropdown-menu bx-rev" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Daily</a>
                                        <a class="dropdown-item" href="#">Weekly</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="revenue-chart">
                        <canvas id="myRevenueChart" height="230px" width="700px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 p-0">
                <div class="d-flex justify-content-between  card ">
                    <div class="p-10 card-head">
                        <h3 class="f-18 mt-0">Users by Zones</h3>
                    </div>
                    <!-- <div id="myzonechart" class="chart--container"> -->
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/json" id="revenue_dataset">
    {{--{
        labels: ["21 Dec", "22 Dec", "23 Dec", "24 Dec", "25 Dec", "26 Dec", "27 Dec"],
        datasets: [{
            label: 'Last Week',
            data: [0, 1.5, 1, 0.5, 3, 2.5, 3.5],

            backgroundColor: [
                'rgba(231,230,241,0.7)',

            ],
            borderColor: [
                'rgba(45,43,135,1)',
                'rgba(45,43,135,1)',
                'rgba(45,43,135,1)',
                'rgba(45,43,135,1)',
                'rgba(45,43,135,1)',
                'rgba(45,43,135,1)',
                'rgba(45,43,135,1)',


            ],
            borderWidth: 1
        },
            {
                label: 'This Week',
                data: [0, 1.2, 0.4, 2.1, 1.3, 2.3, 0],
                borderDash: [10,5],

                backgroundColor: [
                    'rgba(255,252,242,0.7)',

                ],
                borderColor: [
                    'rgba(248,204,72,1)',
                    'rgba(248,204,72,1)',
                    'rgba(248,204,72,1)',
                    'rgba(248,204,72,1)',
                    'rgba(248,204,72,1)',
                    'rgba(248,204,72,1)',


                ],
                borderWidth: 1
            }
        ]
    }--}}
</script>



@endsection
