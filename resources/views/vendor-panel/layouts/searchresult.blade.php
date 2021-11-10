@extends('vendor-panel.layouts.frame')
@section('title')Search Result @endsection
@section('body')
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="order-past">
    <div class="d-flex  flex-row justify-content-between vertical-center">
        <h3 class="page-head text-left p-4 f-20 theme-text">Search Result</h3>
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
                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Search Result</a></li>
                </ol>
            </nav>


        </div>

    </div>



    <!-- Dashboard cards -->


    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-sm-12">
            <div class="card  h-auto  pt-8 p-0">


                <div class="header-wrap">
                    <h3 class="f-18 mt-0 ml-1 mb-0 theme_text">
                        <ul class="nav nav-tabs pt-10 p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link p-15 active"  href="#">Search Result</a>
                            </li>
                        </ul>
                    </h3>

                        <div class="header-wrap p-0 filter-dropdown ">
                            
                            
                        </div>


                </div>

                <div class="all-vender-details">
                    <table class="table text-left p-0  theme-text ">
                        <thead class="secondg-bg  p-0 f-14">
                        <tr>
                            <th scope="col" style="padding: 14px;" class="text-left">Order ID</th>
                            <th scope="col" style="padding: 14px;">From</th>
                            <th scope="col" style="padding: 14px;">To</th>
                            <th scope="col" style="padding: 14px;">Order Date</th>
{{--                            <th scope="col" style="padding-left: 36px !important; padding: 14px;">Date of Movement</th>--}}
                            <th scope="col" style="padding-left: 36px !important; padding: 14px;">Amount</th>
                            <th scope="col" style="text-align: center !important; padding: 14px;">Order Status</th>
                            <th scope="col" style="padding: 14px;">Action</th>
                        </tr>
                        </thead>
                        <tbody class="mtop-20 f-13">
                            @foreach($bookings as $booking)
                                <tr class="tb-border">
                                    <td  scope="row" class="text-left" style="padding: 14px;">
                                            {{$booking->public_booking_id}}</td>
                                    <td style="padding: 14px;">{{json_decode($booking->source_meta, true)['city']}}</td>
                                    <td style="padding: 14px;">{{json_decode($booking->destination_meta, true)['city']}}</td>
                                    <td style="padding: 14px;" >{{$booking->created_at->format('d M Y')}}</td>
{{--                                    <td style="text-align: center !important; padding: 14px;">{{json_decode($booking->bid->meta, true)['moving_date']}}</td>--}}
                                    <td style="text-align: center !important; padding: 14px;">{{$booking->final_quote}}</td>
                                    <td class="" style="padding: 14px;">
                                        @switch($booking->status)
                                            @case(\App\Enums\BookingEnums::$STATUS['payment_pending'])
                                                <span class="grey-bg  text-center status-badge complete-bg" style="font-weight: 600!important;">Customer Confirmation Pending</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['pending_driver_assign'])
                                                <span class="badge-light  text-center status-badge complete-bg" style="font-weight: 600!important;">Pending Driver Assign</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['awaiting_pickup'])
                                                <span class="green-bg  text-center status-badge complete-bg" style="font-weight: 600!important;">Awaiting Pickup</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['in_transit'])
                                                <span class="grey-bg  text-center status-badge complete-bg" style="font-weight: 600!important;"> In Transit</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['price_review_pending'])
                                                <span class="grey-bg  text-center status-badge complete-bg" style="font-weight: 600!important;">Price Review Pending</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['completed'])
                                                <span class="grey-bg  text-center status-badge complete-bg" style="font-weight: 600!important;">Completed</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['cancelled'])
                                                <span class="grey-bg  text-center status-badge complete-bg" style="font-weight: 600!important;">Cancelled</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['awaiting_bid_result'])
                                                <span class="grey-bg  text-center status-badge complete-bg" style="font-weight: 600!important;">Awaiting Bid Result</span>
                                            @break

                                        @endswitch
                                    </td>
                                    <td style="padding: 14px;"><a href="{{route('vendor.complete-order',['id'=>$booking->public_booking_id])}}">
                                            <i class="tooltip-trigger">
                                                <img src="{{asset('static/vendor/images/Icon material-remove-red-eye.svg')}}" alt="" data-toggle="tooltip" data-placement="top" title="View Order Detail">
                                            </i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($bookings)== 0)
                        <div class="row hide-on-data">
                            <div class="col-md-12 text-center p-20">
                                <p class="font14"><i>. You don't have any Bookings on this search.</i></p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </div>




</div>
@endsection
