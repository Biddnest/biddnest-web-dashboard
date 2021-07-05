@extends('website.layouts.frame')
@section('title')Enquiry @endsection
@section('header_title') Enquiry @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="ongoingbooking">
        <div class="container">
            <div class="quote responsive w-70 ontop p-4 bg-white">
                <div class="card-head right text-left p-8 pt-10 pb-0">
                    <h3 class="f-18">
                        <ul class="nav nav-tabs pt-10 p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15 pt-0" href="{{route('website.my-profile')}}">My Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab active p-15 pt-0" id="quotation" data-toggle="tab" href="#past" role="tab" aria-controls="profile" aria-selected="false">Enquiries</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15 pt-0" href="{{route('my-bookings')}}">Ongoing Booking</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15 pt-0" href="{{route('order-history')}}">Booking History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15 pt-0" href="{{route('my-request')}}">My Requests</a>
                            </li>
                        </ul>
                    </h3>
                </div>
                <div class="tab-content margin-topneg-7 border-top" id="myTabContent">
                    <div class="tab-pane fade show active " id="past" role="tabpanel" aria-labelledby="booking-tab">
                        <div class="row  pt-4">
                            @foreach($bookings as $booking)
                                <div class="col-md-6 col-sm-12 col-xs-12 mt-4">
                                    <div class="card view-left-text">
                                        <div class="card-body bg-card-book">
                                            <div class="d-flex pt-4 pb-2 justify-content-between" style="margin-right: 14px !important;">
                                                <div class="d-flex">
                                                    <img class="card-icons img-location" src="{{asset('static/website/images/icons/location.svg')}}" />
                                                    <div class="d-flex f-direction">
                                                        <p class="l-cap pl-2 mb-0">From</p>
                                                        <p class=" f-16 pl-1">{{ucwords(json_decode($booking->source_meta, true)['city'])}}</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <img class="card-icons img-location" src="{{asset('static/website/images/icons/location.svg')}}" />
                                                    <div class="d-flex f-direction">
                                                        <p class="l-cap pl-2 mb-0">To</p>
                                                        <p class=" f-16 pl-1">{{ucwords(json_decode($booking->destination_meta, true)['city'])}}</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="d-flex f-direction">
                                                        <p class="l-cap pl-2 mb-0">Distance</p>
                                                        <p class=" f-16 pl-1">{{json_decode($booking->meta, true)['distance']}} Km</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                        <div class="row d-flex mt-1 f-14 pt-1 justify-content-between row-mobile">
                                            <div class="col-md-6 col-mobile" style="width: auto;">
                                                    <p class="bold  pl-4 padding-view d-flex f-direction" >
                                                        <span> #{{$booking->public_enquiry_id}} </span>
                                                       <span class="light"> {{date('d M Y', strtotime($booking->created_at))}}</span>
                                                    </p>
                                                </div>
                                                <div class="col-md-6 " style="width: auto; margin-top: 8px; display: flex; justify-content: flex-end;    padding-right: 24px;     padding-bottom: 10px;">
                                                    @switch($booking->status)
                                                        @case(\App\Enums\BookingEnums::$STATUS['enquiry'])
                                                        @php $color = \App\Enums\BookingEnums::$COLOR_CODE['enquiry']; @endphp
                                                        <a class="white-text" href="{{route('estimate-booking', ['id'=>$booking->public_enquiry_id])}}">
                                                            <button class="btn f-12 white-bg" style="background-color:{{$color}}; font-weight: 700; color: #FFFFFF;">
                                                                Enquiry
                                                            </button>
                                                        </a>
                                                        @break
                                                        @case(\App\Enums\BookingEnums::$STATUS['placed'])
                                                        @php $color = \App\Enums\BookingEnums::$COLOR_CODE['placed']; @endphp
                                                        <a class="white-text" href="#">
                                                            <button class="btn f-12 white-bg" style="background-color:{{$color}}; font-weight: 700; color: #FFFFFF;">
                                                                Placed
                                                            </button>
                                                        </a>
                                                        @break

                                                        @case(\App\Enums\BookingEnums::$STATUS['biding'])
                                                        @php $color = \App\Enums\BookingEnums::$COLOR_CODE['biding']; @endphp
                                                        <a class="white-text" href="{{route('final-quote', ['id'=>$booking->public_enquiry_id])}}">
                                                            <button class="btn f-12 white-bg" style="background-color:{{$color}}; font-weight: 700; color: #FFFFFF;">
                                                                Biding
                                                            </button>
                                                        </a>
                                                        @break

                                                        @case(\App\Enums\BookingEnums::$STATUS['rebiding'])
                                                        @php $color = \App\Enums\BookingEnums::$COLOR_CODE['rebiding']; @endphp
                                                        <a class="white-text" href="{{route('final-quote', ['id'=>$booking->public_enquiry_id])}}">
                                                            <button class="btn f-12 white-bg" style="background-color:{{$color}}; font-weight: 700; color: #FFFFFF;">
                                                                Rebiding
                                                            </button>
                                                        </a>
                                                        @break

                                                        @case(\App\Enums\BookingEnums::$STATUS['payment_pending'])
                                                        @php $color = \App\Enums\BookingEnums::$COLOR_CODE['payment_pending']; @endphp
                                                        <a class="white-text" href="{{route('final-quote', ['id'=>$booking->public_enquiry_id])}}">
                                                            <button class="btn f-12 white-bg" style="background-color:{{$color}}; font-weight: 700; color: #FFFFFF;">
                                                                Payment Pending
                                                            </button>
                                                        </a>
                                                        @break

                                                        @case(\App\Enums\BookingEnums::$STATUS['hold'])
                                                        @php $color = \App\Enums\BookingEnums::$COLOR_CODE['biding']; @endphp
                                                        <a class="white-text" href="#">
                                                            <button class="btn f-12 white-bg" style="background-color:{{$color}}; font-weight: 700; color: #FFFFFF;">
                                                                Bidding
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
                                        <img class="img-res" src="{{asset('static/website/images/images/no-booking.svg')}}" />
                                    </div>
                                    <div class="italic theme-text">
                                        <h1 class="f-14 center"> You have no ongoing booking</h1>

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
                </div>
            </div>
        </div>
    </div>
@endsection
