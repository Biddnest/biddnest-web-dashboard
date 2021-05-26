@extends('website.layouts.frame')
@section('title')Booking History @endsection
@section('header_title') Booking History @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="bookinghistory">
        <div class="container">
            <div class="quote responsive w-70 ontop p-4 bg-white">
                <div class="card-head right text-left p-8 pt-10 pb-0">
                    <h3 class="f-18">
                        <ul class="nav nav-tabs pt-10 p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15" id="new-order-tab" data-toggle="tab" href="{{route('website.my-profile')}}">My Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15" id="new-order-tab" data-toggle="tab" href="{{route('my-bookings-enquiries')}}">Enquiries</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15" id="quotation" data-toggle="tab" href="{{route('my-bookings')}}">Ongoing Booking</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab active p-15" id="booking-history" data-toggle="tab" href="#booking" role="tab" aria-controls="profile" aria-selected="false">Booking History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15" id="request-tab" data-toggle="tab" href="{{route('my-request')}}">My Requests</a>
                            </li>
                        </ul>
                    </h3>
                </div>
                <div class="tab-content margin-topneg-7 border-top" id="myTabContent">
                    <div class="tab-pane fade show active " id="booking" role="tabpanel" aria-labelledby="booking-tab">
                        <div class="row  pt-4">
                            @foreach($bookings as $booking)
                                <div class="col-md-6 col-sm-12 col-xs-12 mt-4">
                                    <div class="card view-left-text">
                                        <div class="card-body bg-card-book">
                                            <div class="d-flex pt-4 pb-2 justify-content-around">
                                                <div class="d-flex ">
                                                    <img class="card-icons img-location" src="{{asset('static/website/images/icons/location.svg')}}" />
                                                    <div class="d-flex f-direction">
                                                        <p class="l-cap pl-2 mb-0">From</p>
                                                        <p class=" f-16 pl-2">{{ucwords(json_decode($booking->source_meta, true)['city'])}}</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <img class="card-icons img-location" src="{{asset('static/website/images/icons/location.svg')}}" />
                                                    <div class="d-flex f-direction">
                                                        <p class="l-cap pl-2 mb-0">To</p>
                                                        <p class=" f-16 pl-2">{{ucwords(json_decode($booking->destination_meta, true)['city'])}}</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="d-flex f-direction">
                                                        <p class="l-cap pl-2 mb-0">Distance</p>
                                                        <p class=" f-16 pl-2">{{json_decode($booking->meta, true)['distance']}} Km</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="d-flex mt-1 f-14 pt-1 justify-content-between">
                                                <div>
                                                    <p class="bold mt-1 pl-4">
                                                        #{{$booking->public_booking_id}} <span class="light">| @if($booking->bid) {{date('d M Y', strtotime(json_decode($booking->bid->meta, true)['moving_date']))}} @endif </span>
                                                    </p>
                                                </div>
                                                <div>
                                                    @switch($booking->status)
                                                        @case(\App\Enums\BookingEnums::$STATUS['completed'])
                                                        @php $color = \App\Enums\BookingEnums::$COLOR_CODE['completed']; @endphp
                                                        <a class="white-text" href="#">
                                                            <button class="btn f-12 white-bg" data-toggle="modal" data-target="#order-history-modal_{{$booking->id}}" style="background-color:{{$color}}; font-weight: 700; color: #FFFFFF;">
                                                                Completed
                                                            </button>
                                                        </a>
                                                        @break

                                                        @case(\App\Enums\BookingEnums::$STATUS['cancelled'])
                                                        @php $color = \App\Enums\BookingEnums::$COLOR_CODE['cancelled']; @endphp
                                                        <a class="white-text" href="#">
                                                            <button class="btn f-12 white-bg" data-toggle="modal" data-target="#order-history-modal_{{$booking->id}}" style="background-color:{{$color}}; font-weight: 700; color: #FFFFFF;">
                                                                Cancelled
                                                            </button>
                                                        </a>
                                                        @break
                                                    @endswitch
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                @if(count($bookings)== 0)
                                    <div class="container" id="no-booking-show">
                                        <div class="">
                                            <img src="{{asset('static/website/images/images/no-booking.svg')}}" />
                                        </div>
                                        <div class="italic theme-text">
                                            <h1 class="f-14 center"> You have no History of Bookings</h1>

                                        </div>
                                        <div class=" center d-flex">
                                            <a class="white-text " href="{{route('add-booking')}}">
                                                <button class="btn mt-4 btn-theme-bg white-bg">Book Now</button>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                        </div>
                    </div>
                    @foreach($bookings as $booking)
                        <div class="modal fade" id="order-history-modal_{{$booking->id}}" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                        <div class="modal-dialog para-head input-text-blue" role="document">
                            <div class="modal-content w-1000 mt-50 right-25 w-90 ml-4">
                                <div class="modal-header bg-purple">
                                    <h5 class="modal-title m-0-auto -mr-30 text-white" id="exampleModalLongTitle ">
                                        Order Details
                                    </h5>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body p-15 margin-topneg-2">
                                    <!-- <div class="col-6 border-right pr-5 mt-4"> -->
                                    <div class="d-flex border-bottom justify-content-between">
                                        <div>
                                            <p class="f-14">FROM</p>
                                            <p class="bg-blur f-18">{{ucwords(json_decode($booking->source_meta, true)['city'])}}</p>
                                        </div>
                                        <div class="mt-1 pt-3">
                                            <img src="{{asset('static/website/images/icons/moving-truck.svg')}}" />
                                        </div>
                                        <div>
                                            <p class="f-14">TO</p>
                                            <p class="bg-blur f-18">{{ucwords(json_decode($booking->destination_meta, true)['city'])}}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-1 pt-2 ml-3 mr-36 justify-content-between text-left ">
                                        <div>
                                            <h6 class="l-cap f-14">Date</h6>
                                            <h5 class="f-14">@if($booking->bid){{date('d M Y', strtotime(json_decode($booking->bid->meta, true)['moving_date']))}}@endif</h5>
                                        </div>
                                        <div>
                                            <h6 class="l-cap f-14">Price</h6>
                                            <h5 class="f-14">{{$booking->final_quote}}</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-1 pt-2 ml-3 mr-36 justify-content-between text-left">
                                        <div>
                                            <h6 class="l-cap f-14">Order ID</h6>
                                            <h5 class="f-14">#{{$booking->public_booking_id}}</h5>
                                        </div>
                                        <div class="m-w-60">
                                            <h6 class="l-cap f-14">Distance</h6>
                                            <h5 class="f-14">{{json_decode($booking->meta, true)['distance']}} KM</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-1 pt-2 ml-3 mr-36 justify-content-between text-left">
                                        <div>
                                            <h6 class="l-cap f-14">Status</h6>
                                            <h5 class="f-14">
                                                @switch($booking->status)
                                                    @case(\App\Enums\BookingEnums::$STATUS['completed'])
                                                        Completed
                                                    @break;
                                                    @case(\App\Enums\BookingEnums::$STATUS['cancelled'])
                                                        Cancelled
                                                    @break;
                                                @endswitch
                                            </h5>
                                        </div>
                                        <div class="m-w-60 -mr-10">
                                            <h6 class="l-cap f-14">Category</h6>
                                            <h5 class="f-14">{{ucwords($booking->service->name)}}</h5>
                                        </div>
                                    </div>

                                    <div class="card text-left mt-1">
                                        <div class="details-card bg-blur">
                                            <div class="d-flex justify-content-between  pr-2">
                                                <div>
                                                    <p class="l-cap f-12 mb-0 pl-0 ">Driver</p>
                                                    <p class="mt-0 pl-0 f-14">@if($booking->driver){{ucwords($booking->driver->fname)}} {{ucwords($booking->driver->lname)}}@endif</p>
                                                </div>
                                                <div>
                                                    <div>
                                                        <p class="l-cap f-12 mb-0 pl-0">Vehicle Name</p>
                                                        <p class="f-14 mt-0 pl-0">@if($booking->vehicle){{ucwords($booking->vehicle->name)}} {{$booking->vehicle->number}}@endif</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between  pr-2">
                                                <div>
                                                    <p class="l-cap f-12 mb-0 pl-0">Phone Number</p>
                                                    <p class="mt-0 pl-0 f-14">@if($booking->driver){{$booking->driver->phone}}@endif</p>
                                                </div>
                                                <div class="pr-1">
                                                    <p class="l-cap f-12 mb-0 pl-0">Vehicle Type</p>
                                                    <p class="mt-0 pl-0 f-14">@if($booking->vehicle){{ucwords($booking->vehicle->vehicle_type)}}@endif</p>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end pr-2">
                                                <div class="pr-3">
                                                    <p class="l-cap f-12 mb-0 pl-0">Manpower</p>
                                                    <p class="mt-0 pl-0 f-14">@if($booking->bid){{json_decode($booking->bid->meta, true)['min_man_power']}}@endif</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
