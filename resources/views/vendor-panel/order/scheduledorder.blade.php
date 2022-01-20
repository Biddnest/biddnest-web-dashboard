@extends('vendor-panel.layouts.frame')
@section('title') Order Details @endsection
@section('body')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="order-schedule">
        <div class="d-flex  flex-row justify-content-between vertical-center">
            <h3 class="page-head text-left p-4 f-20 theme-text">Order Details</h3>
            <div class="mr-20">
                <a href="#" class="goback">
                    <button class="btn theme-bg white-text mt-5">Back</button>
                </a>
            </div>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page" ><a href="{{route('vendor.bookings', ['type'=>"live"])}}"> Manage Bookings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-lg-12">
                <!-- range slider -->
                <div class="card h-auto p-0 pt-20">
                    <div class="tab-pane fade  active show" id="order-status" role="tabpanel" aria-labelledby="order-status-tab">
                        <div class="p-15">
                            <div class="d-flex p-10">
                                <div class="steps-container  ">
                                    <hr class="dash-line"  style="width: 88%; margin-left: 50px;" >
                                    @foreach(array_slice(\App\Enums\BookingEnums::$STATUS, 0, 9) as $key=>$status)
                                        <div class="steps-status " style="width: 10%; text-align: center; padding-left: 35px;">
                                            <div class="step-dot">
                                                {{--                                @foreach($booking->status_ids as $status_history)--}}
                                                @if(in_array($status, $booking->status_ids))
                                                    <img src="{{ asset('static/images/tick.png')}}" />
                                                @else
                                                    <div class="child-dot"></div>
                                                @endif
                                                {{--                                @endforeach--}}
                                            </div>
                                            <p class="step-title">{{ ucwords(str_replace("_"," ", $key))  }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="d-flex border-top  border-bottom pb-0">
                            <ul class="nav nav-tabs pt-20 p-0 f-18" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="new-order-tab" data-toggle="tab" href="{{route('vendor.detailsbookings',['id'=>$booking->public_booking_id])}}" role="tab" aria-controls="home" aria-selected="true">Order Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="requirments-tab" href="{{route('vendor.requirment-order',['id'=>$booking->public_booking_id])}}">Item List</a>
                                </li>
                                @if($booking->bid->status == \App\Enums\BidEnums::$STATUS['bid_submitted'])
                                    {{--<li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.my-quote',['id'=>$booking->public_booking_id])}}">My Quote</a>
                                    </li>--}}
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.my-bid',['id'=>$booking->public_booking_id])}}">My Bid</a>
                                    </li>

                                @elseif($booking->bid->status == \App\Enums\BidEnums::$STATUS['won'] && $booking->status == \App\Enums\BookingEnums::$STATUS['payment_pending'])
                                    {{-- <li class="nav-item">
                                         <a class="nav-link disabled" id="requirments-tab" href="{{route('vendor.my-quote',['id'=>$booking->public_booking_id])}}">My Quote</a>
                                     </li>--}}
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.my-bid',['id'=>$booking->public_booking_id])}}">My Bid</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="requirments-tab" href="{{route('vendor.schedule-order',['id'=>$booking->public_booking_id])}}">Schedule</a>
                                    </li>

                                @elseif($booking->bid->status == \App\Enums\BidEnums::$STATUS['won'] && (($booking->status > \App\Enums\BookingEnums::$STATUS['payment_pending']) && ($booking->status < \App\Enums\BookingEnums::$STATUS['in_transit'])))
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.my-bid',['id'=>$booking->public_booking_id])}}">My Bid</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="requirments-tab" href="{{route('vendor.schedule-order',['id'=>$booking->public_booking_id])}}">Schedule</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " id="requirments-tab" href="{{route('vendor.driver-details',['id'=>$booking->public_booking_id])}}">Driver Details</a>
                                    </li>
                                @elseif($booking->bid->status == \App\Enums\BidEnums::$STATUS['won'] && ($booking->status == \App\Enums\BookingEnums::$STATUS['price_review_pending']))
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.my-bid',['id'=>$booking->public_booking_id])}}">My Bid</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="requirments-tab" href="{{route('vendor.schedule-order',['id'=>$booking->public_booking_id])}}">Schedule</a>
                                    </li>
                                @elseif($booking->bid->status == \App\Enums\BidEnums::$STATUS['won'] && $booking->status == \App\Enums\BookingEnums::$STATUS['in_transit'])
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.my-bid',['id'=>$booking->public_booking_id])}}">My Bid</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="requirments-tab" href="{{route('vendor.schedule-order',['id'=>$booking->public_booking_id])}}">Schedule</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " id="requirments-tab" href="{{route('vendor.driver-details',['id'=>$booking->public_booking_id])}}">Driver Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.in-transit',['id'=>$booking->public_booking_id])}}">In Transit</a>
                                    </li>
                                @elseif($booking->bid->status = \App\Enums\BidEnums::$STATUS['won'] && ($booking->status == \App\Enums\BookingEnums::$STATUS['completed'] || $booking->status == \App\Enums\BookingEnums::$STATUS['cancelled']))
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.my-bid',['id'=>$booking->public_booking_id])}}">My Bid</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="requirments-tab" href="{{route('vendor.schedule-order',['id'=>$booking->public_booking_id])}}">Schedule</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.driver-details',['id'=>$booking->public_booking_id])}}">Driver Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.complete-order',['id'=>$booking->public_booking_id])}}">Complete</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="d-flex p-15 " style="padding-bottom: 0px !important;">
                            <div class="tab-content w-100" id="myTabContent">
                                <div class="tab-pane fade active show" id="order-details" role="tabpanel" aria-labelledby="order-details-tab">
                                    <div class="d-flex  row margin-topneg-15">
                                        <div class="col-sm-4 match-item  secondg-bg   pt-10">
                                            <div class="theme-text f-14 bold p-8">
                                                From
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                From Pincode
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                From Floor
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                To
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                To Pincode
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                To Floor
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                Distance
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                Type of Movement
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                Category
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                Order Price
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                Moving Date
                                            </div>
                                        </div>

                                        <div class="col-sm-5 match-item white-bg  pt-10">
                                            <div class="theme-text f-14 p-8">
                                                {{json_decode($booking->source_meta, true)['address']}}
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{json_decode($booking->source_meta, true)['pincode']}}
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{json_decode($booking->source_meta, true)['floor']}} @if(json_decode($booking->source_meta, true)['lift']==\App\Enums\CommonEnums::$YES)(Lift: Yes) @else (Lift: Yes) @endif
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{json_decode($booking->destination_meta, true)['address']}}
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{json_decode($booking->destination_meta, true)['pincode']}}
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{json_decode($booking->destination_meta, true)['floor']}} @if(json_decode($booking->destination_meta, true)['lift']==\App\Enums\CommonEnums::$YES)(Lift: Yes) @else (Lift: Yes) @endif
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{json_decode($booking->meta, true)['distance']}} KM
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{ucwords(json_decode($booking->bid->meta, true)['type_of_movement'])}}
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{$booking->service->name}}
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                Rs. {{$booking->bid->bid_amount ?? "-"}}
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                @foreach(json_decode($booking->bid->moving_dates, true) as $mdates)
                                                    <span class="status-3">{{$mdates}}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
