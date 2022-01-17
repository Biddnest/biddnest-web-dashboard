@extends('vendor-panel.layouts.frame')
@section('title') Order Details @endsection
@section('body')

    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="driverdetail">
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
                                    <hr class="dash-line" style="width: 85%;" >
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
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="requirments-tab" href="#">Schedule</a>
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
                                    <li class="nav-item">
                                        <a class="nav-link " id="requirments-tab" href="#">Driver Details</a>
                                    </li>
                                @elseif($booking->bid->status == \App\Enums\BidEnums::$STATUS['won'] && (($booking->status > \App\Enums\BookingEnums::$STATUS['payment_pending']) && ($booking->status < \App\Enums\BookingEnums::$STATUS['in_transit'])))
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.my-bid',['id'=>$booking->public_booking_id])}}">My Bid</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.schedule-order',['id'=>$booking->public_booking_id])}}">Schedule</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="requirments-tab" href="{{route('vendor.driver-details',['id'=>$booking->public_booking_id])}}">Driver Details</a>
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
                                        <a class="nav-link active show" id="requirments-tab" href="{{route('vendor.driver-details',['id'=>$booking->public_booking_id])}}">Driver Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.in-transit',['id'=>$booking->public_booking_id])}}">In Transit</a>
                                    </li>
                                @elseif($booking->bid->status = \App\Enums\BidEnums::$STATUS['won'] && ($booking->status == \App\Enums\BookingEnums::$STATUS['completed'] || $booking->status == \App\Enums\BookingEnums::$STATUS['cancelled']))
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.my-bid',['id'=>$booking->public_booking_id])}}">My Bid</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.schedule-order',['id'=>$booking->public_booking_id])}}">Schedule</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="requirments-tab" href="{{route('vendor.driver-details',['id'=>$booking->public_booking_id])}}">Driver Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.complete-order',['id'=>$booking->public_booking_id])}}">Complete</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="not-assign">
                            @if($assigned_driver)
                                @if($booking->status < \App\Enums\BookingEnums::$STATUS['in_transit'])
                                    <div class="row margin-topneg-15" style="float: right; margin-right: 30px;">
                                        <a href="#" class="modal-toggle" data-toggle="modal" data-target="#start-trip-modal">
                                            <button class="btn">Start Trip</button>
                                        </a>
                                    </div>
                                @endif
                                <div class="d-flex row margin-topneg-15" style="margin-left: 40px; margin-bottom: 20px;">
                                <div class="col-sm-4  secondg-bg   pt-10">
                                    <div class="theme-text f-14 bold p-8">
                                        Driver
                                    </div>
                                    <div class="theme-text f-14 bold p-8">
                                        Driver Phone Number
                                    </div>
                                    <div class="theme-text f-14 bold p-8">
                                        Vehicle Registration Number
                                    </div>
                                </div>
                                <div class="col-sm-5 white-bg  pt-10">
                                    <div class="theme-text f-14 p-8">
                                        {{ucwords($assigned_driver->driver->fname)}} {{ucwords($assigned_driver->driver->lname)}}
                                    </div>
                                    <div class="theme-text f-14 p-8">
                                        {{$assigned_driver->driver->phone}}
                                    </div>
                                    <div class="theme-text f-14 p-8">
                                        {{$assigned_driver->vehicle->number}}
                                    </div>
                                </div>
                            </div>
                            @else
                                <div class="d-flex p-0 border-top ">
                                    <div class="d-flex justify-content-center status-badge info-message">
                                        <div class="">
                                            <i class="p-1"><img src="{{asset('static/vendor/images/Icon feather-alert-triangle.svg')}}" alt="" srcset=""></i>
                                            ‘’No driver has been assigned yet to this order Please assign a driver to proceed further’’. </div>
                                    </div>
                                </div>
                            @endif
                            @if($booking->status < \App\Enums\BookingEnums::$STATUS['in_transit'])
                                <form action="{{route('api.driver.assign')}}" method="POST" redirect-type="hard" data-next="refresh" data-alert="mega" data-parsley-validate>
                                <div class="d-flex row" style="padding: 20px 25px;">
                                    <div class="col-lg-6 driver-input">
                                        <input type="hidden" name="public_booking_id" value="{{$id}}">
                                        <div class="form-input">
                                            <label class="">Driver Name</label>
                                            <select  id="" class="form-control" name="driver_id" required>
                                                <option >--Select--</option>
                                                @foreach($drivers as $driver)
                                                    <option value="{{$driver->id}}" @if($assigned_driver && ($assigned_driver->driver_id == $driver->id)) selected @endif>{{ucwords($driver->fname)}} {{ucwords($driver->lname)}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-message">Please enter valid
                                                            Phone number</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Vehicle</label>
                                            <select  id="" class="form-control" name="vehicle_id" required>
                                                <option >--Select--</option>
                                                @foreach($vehicles as $vehicle)
                                                    <option value="{{$vehicle->id}}" @if($assigned_driver && ($assigned_driver->vehicle_id == $vehicle->id)) selected @endif>{{ucwords($vehicle->name)}} - {{ucwords($vehicle->vehicle_type)}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-message">Please enter valid
                                                            First Name</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="w-100 mt-3" style="text-align: center;">
                                            <button class="btn assign-btn">@if($assigned_driver) Change @else Assign @endif</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fullscreen-modal" id="start-trip-modal">
            <div class="fullscreen-modal-body" role="document">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Start your trip</h5>
                    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-new-order pt-4 mt-3 onboard-vendor-branch input-text-blue" action="{{route('api.vendor.start-pin')}}"  data-next="redirect" data-redirect-type="hard" data-url="{{route('vendor.in-transit',['id'=>$booking->public_booking_id])}}"  method="PUT" data-alert="mega" data-parsley-validate>
                    <div class="modal-body" style="padding: 10px 9px;">
                        <div class="d-flex justify-content-center row ">
                            <div class="col-sm-6 p-60">
                                <div class="form-input">
                                    <h4 class="text-center bold">Enter Customer's Start Pin</h4>
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
                                <button class="btn theme-bg white-text w-30 " id="submitbtn" style="margin-bottom: 20px;">START</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
