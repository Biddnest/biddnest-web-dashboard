@extends('vendor-panel.layouts.frame')
@section('title') Order Details @endsection
@section('body')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="intransit">
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
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-lg-12">
                <!-- range slider -->
                <div class="card h-auto p-0 pt-20">
                    <div class="tab-pane fade  active show" id="order-status" role="tabpanel" aria-labelledby="order-status-tab">
                        <div class="p-15  border-bottom">

                            <div class="d-flex p-10">
                                <div class="steps-container">
                                    <hr class="dash-line">
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
                        <div class="d-flex  border-bottom pb-0">
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
                                        <a class="nav-link " id="requirments-tab" href="{{route('vendor.schedule-order',['id'=>$booking->public_booking_id])}}">Schedule</a>
                                    </li>
                                  
                                @elseif($booking->bid->status == \App\Enums\BidEnums::$STATUS['won'] && (($booking->status > \App\Enums\BookingEnums::$STATUS['payment_pending']) && ($booking->status < \App\Enums\BookingEnums::$STATUS['in_transit'])))
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.my-bid',['id'=>$booking->public_booking_id])}}">My Bid</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.schedule-order',['id'=>$booking->public_booking_id])}}">Schedule</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " id="requirments-tab" href="{{route('vendor.driver-details',['id'=>$booking->public_booking_id])}}">Driver Details</a>
                                    </li>
                                @elseif($booking->bid->status == \App\Enums\BidEnums::$STATUS['won'] && ($booking->status == \App\Enums\BookingEnums::$STATUS['price_review_pending']))
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.my-bid',['id'=>$booking->public_booking_id])}}">My Bid</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.schedule-order',['id'=>$booking->public_booking_id])}}">Schedule</a>
                                    </li>
                                @elseif($booking->bid->status == \App\Enums\BidEnums::$STATUS['won'] && $booking->status == \App\Enums\BookingEnums::$STATUS['in_transit'])
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.my-bid',['id'=>$booking->public_booking_id])}}">My Bid</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.schedule-order',['id'=>$booking->public_booking_id])}}">Schedule</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="requirments-tab" href="{{route('vendor.driver-details',['id'=>$booking->public_booking_id])}}">Driver Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="requirments-tab" href="{{route('vendor.in-transit',['id'=>$booking->public_booking_id])}}">In Transit</a>
                                    </li>
                                @elseif($booking->bid->status = \App\Enums\BidEnums::$STATUS['won'] && ($booking->status == \App\Enums\BookingEnums::$STATUS['completed'] || $booking->status == \App\Enums\BookingEnums::$STATUS['cancelled']))
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.my-bid',['id'=>$booking->public_booking_id])}}">My Bid</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.schedule-order',['id'=>$booking->public_booking_id])}}">Schedule</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.driver-details',['id'=>$booking->public_booking_id])}}">Driver Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="requirments-tab" href="{{route('vendor.in-transit',['id'=>$booking->public_booking_id])}}">In Transit</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.complete-order',['id'=>$booking->public_booking_id])}}">Complete</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="d-flex p-15 justify-content-center row text-center">
                            <h5 class="col-sm-12">Your trip has been started</h5>
                            <div class="col-sm-12 intransit">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="bid-badge">
                                            <h4 class="">
                                                @if(json_decode($booking->source_meta, true)['city'] == json_decode($booking->destination_meta, true)['city'])
                                                    {{json_decode($booking->source_meta, true)['address']}}
                                                @else
                                                    {{json_decode($booking->source_meta, true)['city']}}
                                                @endif
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <img src="{{asset('static/vendor/images/graph/Group 14409.svg')}}" alt="">
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="bid-badge">
                                            <h4 class="">
                                                @if(json_decode($booking->destination_meta, true)['city'] == json_decode($booking->source_meta, true)['city'])
                                                    {{json_decode($booking->destination_meta, true)['address']}}
                                                @else
                                                    {{json_decode($booking->destination_meta, true)['city']}}
                                                @endif
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($booking->status == \App\Enums\BookingEnums::$STATUS['in_transit'])
                        <div class="row margin-topneg-15" style="float: right; margin-right: 30px;">
                            <a href="#" class="modal-toggle" data-toggle="modal" data-target="#end-trip-modal">
                                <button class="btn">End Trip</button>
                            </a>
                        </div>
                    @endif

                    </div>

                </div>

            </div>
        </div>

        <div class="fullscreen-modal" id="end-trip-modal">
            <div class="fullscreen-modal-body" role="document">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">End your trip</h5>
                    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-new-order pt-4 mt-3 onboard-vendor-branch input-text-blue" action="{{route('api.vendor.end-pin')}}"  data-next="redirect" data-redirect-type="hard" data-url="{{route('vendor.complete-order',['id'=>$booking->public_booking_id])}}"  method="PUT" data-alert="mega" data-parsley-validate>
                    <div class="modal-body" style="padding: 10px 9px;">
                        <div class="d-flex justify-content-center row ">
                            <div class="col-sm-6 p-60">
                                <div class="form-input">
                                    <h4 class="text-center bold">Enter Customer's End Pin</h4>
                                    <input class="form-control" name="pin" id="pin" type="number" maxlength="4" minlength="4" required/>
                                    <input class="form-control" name="public_booking_id" id="pin" type="hidden" value="{{$booking->public_booking_id}}" />
                                    <span class="error-message">Please enter valid OTP</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-15 ">
                        <div class="w-50">
                        </div>
                        <div class="w-50 text-right">
                            <a class="white-text p-10" href="#">
                                <button class="btn theme-bg white-text w-30 " id="submitbtn" style="margin-bottom: 20px;">END TRIP</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
