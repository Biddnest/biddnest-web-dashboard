@extends('layouts.app')
@section('title') Dashboard @endsection
@section('content')

 <!-- Main Content -->
 <div class="main-content grey-bg" data-barba="container" data-barba-namespace="dashboard">
     <input type="hidden" value='@json($graph)' id="revenue_dataset">


         @php $dataset = []; $final = []; @endphp
         @foreach($graph['order_distribution'] as $od)
             @switch($od['status'])
             @case(\App\Enums\BookingEnums::$STATUS['enquiry'])
             @php
                 $dataset['label'] = "Enquiry";
                 $dataset['value'] = $od['count'];
             @endphp
             @break

             {{--@case(\App\Enums\BookingEnums::$STATUS['placed'])
             @php
                 $dataset['label'] = "Placed";
                 $dataset['value'] = $od['count'];
             @endphp
             @break--}}

             @case(\App\Enums\BookingEnums::$STATUS['biding'])
             @php
                 $dataset['label'] = "Biding";
                 $dataset['value'] = $od['count'];
             @endphp
             @break

             {{--@case(\App\Enums\BookingEnums::$STATUS['rebiding'])
             @php
                 $dataset['label'] = "Rebiding";
                 $dataset['value'] = $od['count'];
             @endphp
             @break--}}

             {{--@case(\App\Enums\BookingEnums::$STATUS['payment_pending'])
             @php
                 $dataset['label'] = "Payment Pending";
                 $dataset['value'] = $od['count'];
             @endphp
             @break--}}

             @case(\App\Enums\BookingEnums::$STATUS['awaiting_pickup'])
             @php
                 $dataset['label'] = "Awaiting Pickup";
                 $dataset['value'] = $od['count'];
             @endphp
             @break

             {{--@case(\App\Enums\BookingEnums::$STATUS['in_transit'])
             @php
                 $dataset['label'] = "In Transit";
                 $dataset['value'] = $od['count'];
             @endphp
             @break--}}

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

     <input type="hidden" value='@json($final)' id="order_dist_dataset">

     @php $datasetzing = []; $finalzing = []; $zing_count=0; @endphp

     @foreach($graph['vendor_statewise'] as $zing)
         @switch($zing['state'])
             @case('Maharashtra')
             @php
                 $dataset['label'] = "Maharashtra";
                 $dataset['value'] = $zing['count'];
             @endphp
             @break

             @case('Karnataka')
             @php
                 $dataset['label'] = "Karnataka";
                 $dataset['value'] = $zing['count'];
             @endphp
             @break

             @case('Uttar Pradesh')
             @php
                 $dataset['label'] = "Uttar Pradesh";
                 $dataset['value'] = $zing['count'];
             @endphp
             @break

             @case('Punjab')
             @php
                 $dataset['label'] = "Punjab";
                 $dataset['value'] = $zing['count'];
             @endphp
             @break

             @default
             @php
                 $zing_count +=$zing['count'];
                  $dataset['label'] = "Others";
                  $dataset['value'] = $zing_count;
             @endphp
             @break
         @endswitch
         @if(count($datasetzing)>0) @php array_push($finalzing, $datasetzing); $datasetzing = []; @endphp
             @endif

     @endforeach
     <input type="hidden" value='@json($finalzing)' id="vendor_dist_dataset">


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
            <p>ORDERS</p>
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
            <div class="card p-10 pl-0 pr-0">
                <div class="d-flex flex-row justify-content-between">
                    <div class="p-10 card-head right text-left ml-3">
                        <h3 class="f-18 mt-0 ml-2">Recent Orders</h3>
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
                    <thead class="secondg-bg border-none p-0 f-14">
                        <tr style="color: #3c4b58;">
                            <th scope="col">ID</th>
                            <th scope="col" style="text-align: center !important; width:10%">Order Status</th>
                            <th scope="col"style="text-align: center !important;     width: 20%;">Time Left</th>
                            <th scope="col"  style="text-align: center !important;">Order Amount</th>
                        </tr>
                    </thead>
                    <tbody class="mtop-20">
                        @foreach($bookings as $booking)
                            <tr class="tb-border cursor-pointer sidebar-toggle" data-sidebar="{{ route('sidebar.booking',['id'=>$booking->id]) }}">
                                <th scope="row" style="text-decoration: underline; padding-left: 24px !important;">
                                    @if($booking->status > \App\Enums\BookingEnums::$STATUS['payment_pending'])
                                        {{$booking->public_booking_id}}
                                    @else
                                        {{$booking->public_enquiry_id}}
                                    @endif
                                </th>
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

                                        @case(\App\Enums\BookingEnums::$STATUS['hold'])
                                        <span class=" text-center status-badge red-bg">On Hold</span>
                                        @break;

                                        @case(\App\Enums\BookingEnums::$STATUS['bounced'])
                                        <span class=" text-center status-badge red-bg">Bounced</span>
                                        @break;

                                        @case(\App\Enums\BookingEnums::$STATUS['cancel_request'])
                                        <span class=" text-center status-badge red-bg">Bounced</span>
                                        @break;

                                        @case(\App\Enums\BookingEnums::$STATUS['in_progress'])
                                        <span class=" text-center status-badge red-bg">Bounced</span>
                                        @break;

                                        @case(\App\Enums\BookingEnums::$STATUS['awaiting_bid_result'])
                                        <span class=" text-center status-badge red-bg">Bounced</span>
                                        @break;

                                        @case(\App\Enums\BookingEnums::$STATUS['price_review_pending'])
                                        <span class=" text-center status-badge red-bg">Bounced</span>
                                        @break;

                                    @endswitch
                                </td>
                                <td class="text-center" style="text-align: center !important; ">
                                    @if(\App\Enums\BookingEnums::$STATUS['biding']==$booking->status ||  \App\Enums\BookingEnums::$STATUS['rebiding']==$booking->status)
                                        {{--{{\Carbon\Carbon::now()->diffForHumans($booking->bid_result_at)}}--}}
                                        <span class="timer-bg text-center status-badge timer" data-time="{{$booking->bid_result_at}}" style="min-width: 0px !important;"></span>
                                    @elseif(\App\Enums\BookingEnums::$STATUS['rebiding'] < $booking->status || (\App\Enums\BookingEnums::$STATUS['rebiding'] < $booking->status && \App\Enums\BookingEnums::$STATUS['in_progress']!=$booking->status))
                                        Bidding Done
                                    @else
                                        --:--:--
                                    @endif
                                </td>
                                <td class="text-center" style="text-align: center !important; ">₹ @if($booking->final_quote){{$booking->final_quote}} @else {{$booking->final_estimated_quote}} @endif</td>
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
                        <div id="my-legend-con" class="legend-con mt-4"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex h-auto  Dashboard-lcards">
            <div class="col-sm-8 h-auto p-0">
                <div class="d-flex  card ">
                    <div class="p-10 d-flex justify-content-between ">
                        <h3 class="f-18 mt-0">Revenue Trend</h3>

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
                    <div id="myzonechart" class="chart--container">
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
