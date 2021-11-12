@extends('vendor-panel.layouts.frame')
@section('title') Dashboard @endsection
@section('body')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="dashboard">
        <input type="hidden" value='@json($graph)' id="revenue_dataset">
        @php $dataset = []; $final = []; @endphp
        @foreach($graph['order_distribution'] as $od)
            @switch($od['status'])
               {{-- @case(\App\Enums\BookingEnums::$STATUS['biding'])
                @php
                    $dataset['label'] = "Biding";
                    $dataset['value'] = $od['count'];
                @endphp
                @break

                @case(\App\Enums\BookingEnums::$STATUS['payment_pending'])
                @php
                    $dataset['label'] = "Pending to Confirm from Customer";
                    $dataset['value'] = $od['count'];
                @endphp
                @break--}}

                @case(\App\Enums\BookingEnums::$STATUS['pending_driver_assign'])
                @php
                    $dataset['label'] = "Pending Assign Driver";
                    $dataset['value'] = $od['count'];
                @endphp
                @break

                @case(\App\Enums\BookingEnums::$STATUS['awaiting_pickup'])
                @php
                    $dataset['label'] = "Awaiting Pickup";
                    $dataset['value'] = $od['count'];
                @endphp
                @break

                @case(\App\Enums\BookingEnums::$STATUS['in_transit'])
                @php
                    $dataset['label'] = "In Transit";
                    $dataset['value'] = $od['count'];
                @endphp
                @break

                @case(\App\Enums\BookingEnums::$STATUS['completed'])
                @php
                    $dataset['label'] = "Completed";
                    $dataset['value'] = $od['count'];
                @endphp
                @break

                @case(\App\Enums\BookingEnums::$STATUS['cancelled'])
                @php
                    $dataset['label'] = "Cancelled";
                    $dataset['value'] = $od['count'];
                @endphp
                @break
            @endswitch
            @if(count($dataset)>0) @php array_push($final, $dataset); $dataset = []; @endphp @endif

        @endforeach

        <input type="hidden" value='@json($final)' id="order_dist_dataset_vendor">



        <h3 class="page-head text-left p-4 f-20">Dashboard
            <i class="icon dripiconmeter"></i>
        </h3>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Last login at</li>
                        <li class="breadcrumb-item"><a href="#">11:55:02 AM</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Dashboard cards -->
        <div class="vender-all-details dashboard-cards flex-row">
            <div class="simple-card">
                <p> LIVE ORDERS</p>
                <h1 style="font-size: 30px;">{{$count_live}}</h1>
            </div>
            <div class="simple-card">
                <p>ONGOING ORDERS</p>
                <h1 style="font-size: 30px;">{{$count_ongoing}}</h1>
            </div>
            <div class="simple-card">
                <p>ORDERS WON</p>
                <h1 style="font-size: 30px;">{{$count_won}}</h1>
            </div>
            <div class="simple-card">
                <p>TOTAL BRANCHES</p>
                <h1 style="font-size: 30px;">{{$count_branch}}</h1>
            </div>
            <div class="simple-card">
                <p>TOTAL EMPLOYEES</p>
                <h1 style="font-size: 30px;">{{$count_emp}}</h1>
            </div>
            <div class="simple-card">
                <p>TOTAL REVENUE</p>
                <h1 style="font-size: 30px;"> ₹{{round($total_revenue/1000)}}K</h1>
            </div>
        </div>
        <!--  dashboard Columns -->
        <div class="d-flex flex-row justify-content-between Dashboard-lcards">
            <div class="col-sm-8 p-0">
                <div class="card p-10 pl-0 pr-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="p-10 card-head right text-left">
                            <h3 class="f-18 mt-0 ml-4">Live Orders</h3>
                        </div>
                        <div class="p-10 card-head left mr-4">
                            <a><i><img src="{{asset('static/vendor//images/filter1.svg')}}" alt="" srcset=""></i></a>
                            <!-- <a><i><img src="./assets/images/filter.svg" alt="" srcset=""></i> -->
                            <div class="dropdown-menu ">
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
                        </div>

                    </div>
                    <table class="table text-center p-0">
                        <thead class="secondg-bg border-none p-0 f-14">
                        <tr>
                            <th scope="col" style="padding: 14px;">Order ID</th>
                            <th scope="col" style="text-align: center; padding: 14px;">Time Left</th>
                            <th scope="col" style="text-align: center; padding: 14px;">Order Amount</th>
                        </tr>
                        </thead>
                        <tbody class="mtop-20">
                            @foreach($booking_live as $booking)
                                <tr class="tb-border">
                                    <th scope="row" style="text-decoration: underline; padding: 14px;"><a  href="{{route('vendor.detailsbookings', ['id'=>$booking->public_booking_id])}}">{{$booking->public_enquiry_id}}</a></th>

                                    <td class="text-center " style="padding: 14px;"><span class="timer-bg text-center timer" data-time="{{$booking->bid_result_at}}"></span></td>
                                    <td class="text-center" style="padding: 14px;">₹{{$booking->organization_rec_quote}}</td>
                                </tr>
                            @endforeach
                       </tbody>
                    </table>
                    @if(count($booking_live)== 0)
                        <div class="row hide-on-data">
                            <div class="col-md-12 text-center p-20">
                                <p class="font14"><i>. You don't have any Bookings here.</i></p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-sm-4 p-0">
                <div class="d-flex card ">
                    <div class="p-10 ">
                        <h3 class="f-18 mt-0">Live Orders Distribution</h3>
                    </div>
                    <div class="canvas-con">
{{--                        <div class="total-user">Orders</div>--}}
                        <div class="canvas-con-inner">
                            <canvas id="mychart" height="130px" width="152px" ></canvas>
                        </div>
                        <div id="my-legend-con_vendor" class="legend-con mt-4"></div>
                    </div>                            </div>
            </div>
        </div>
        <div class="d-flex h-auto  Dashboard-lcards">
            <div class="col-sm-12 h-auto p-0">
                <div class="d-flex  card ">
                    <div class="p-10 d-flex justify-content-between ">
                        <h3 class="f-18 mt-0">Revenue Trend</h3>

                    </div>
                    <div class="revenue-chart">
                        <canvas id="myRevenueChart" height="230px" width="700px"></canvas>
                    </div>
                </div>
            </div>
            <!-- <div class="col-sm-4 p-0">
                <div class="d-flex justify-content-between  card ">
                    <div class="p-10 card-head">
                        <h3 class="f-18">Users by Zones</h3>

                    </div>
                    <div id="myzonechart" class="chart--container">
                    </div>
                </div>
            </div> -->
        </div>
    </div>
@endsection
