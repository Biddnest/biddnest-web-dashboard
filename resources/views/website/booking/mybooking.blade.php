@extends('website.layouts.frame')
@section('title')Ongoing Book @endsection
@section('header_title') Ongoing Book @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="ongoingbooking">
        <div class="container">
            <div class="quote responsive w-70 ontop p-4 bg-white">
                <div class="card-head right text-left p-8 pt-10 pb-0">
                    <h3 class="f-18">
                        <ul class="nav nav-tabs pt-10 p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15" id="new-order-tab" data-toggle="tab" href="{{route('my-profile')}}">My Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab active p-15" id="quotation" data-toggle="tab" href="#past" role="tab" aria-controls="profile" aria-selected="false">Ongoing Booking</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15" id="booking-history" data-toggle="tab" href="{{route('order-history')}}">Booking History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15" id="request-tab" data-toggle="tab" href="{{route('my-request')}}">My Requests</a>
                            </li>
                        </ul>
                    </h3>
                </div>
                <div class="tab-content margin-topneg-7 border-top" id="myTabContent">
                    <div class="tab-pane fade show active " id="past" role="tabpanel" aria-labelledby="booking-tab">
                        <div class="row  pt-4">
                            <div class="col-md-6 col-sm-12 col-xs-12 mt-4">
                                <div class="card view-left-text">
                                    <div class="card-body bg-card-book">
                                        <div class="d-flex pt-4 pb-2 justify-content-around">
                                            <div class="d-flex ">
                                                <img class="card-icons" src="{{asset('static/website/images/icons/location.svg')}}" />
                                                <div class="d-flex f-direction">
                                                    <p class="l-cap pl-2 mb-0">From</p>
                                                    <p class=" f-18 pl-2">Bangaluru</p>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <img class="card-icons" src="{{asset('static/website/images/icons/location.svg')}}" />
                                                <div class="d-flex f-direction">
                                                    <p class="l-cap pl-2 mb-0">To</p>
                                                    <p class=" f-18 pl-2">Chennai</p>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="d-flex f-direction">
                                                    <p class="l-cap pl-2 mb-0">Distance</p>
                                                    <p class=" f-18 pl-2">314Km</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex mt-1 f-14 pt-1 justify-content-between">
                                            <div>
                                                <p class="bold mt-1 pl-4">
                                                    #312334 <span class="light">| 12 Dec 21</span>
                                                </p>
                                            </div>
                                            <div>
                                                <a class="white-text" href="{{route('final-quote')}}">
                                                    <button class="btn btn-red-bg f-10 white-bg">
                                                        Bidding
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 mt-4">
                                <div class="card view-left-text">
                                    <div class="card-body bg-card-book">
                                        <div class="d-flex pt-4 pb-2 justify-content-around">
                                            <div class="d-flex ">
                                                <img class="card-icons" src="{{asset('static/website/images/icons/location.svg')}}" />
                                                <div class="d-flex f-direction">
                                                    <p class="l-cap pl-2 mb-0">From</p>
                                                    <p class=" f-18 pl-2">Bangaluru</p>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <img class="card-icons" src="{{asset('static/website/images/icons/location.svg')}}" />
                                                <div class="d-flex f-direction">
                                                    <p class="l-cap pl-2 mb-0">To</p>
                                                    <p class=" f-18 pl-2">Chennai</p>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="d-flex f-direction">
                                                    <p class="l-cap pl-2 mb-0">Distance</p>
                                                    <p class=" f-18 pl-2">314Km</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex mt-1 f-14 pt-1 justify-content-between">
                                            <div>
                                                <p class="bold mt-1 pl-4">
                                                    #312334 <span class="light">| 12 Dec 21</span>
                                                </p>
                                            </div>
                                            <div>
                                                <a class="white-text" href="{{route('final-quote')}}">
                                                    <button class="btn btn-green-bg f-10 white-bg">
                                                        Payment Pending
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 mt-4">
                                <div class="card view-left-text">
                                    <div class="card-body bg-card-book">
                                        <div class="d-flex pt-4 pb-2 justify-content-around">
                                            <div class="d-flex ">
                                                <img class="card-icons" src="{{asset('static/website/images/icons/location.svg')}}" />
                                                <div class="d-flex f-direction">
                                                    <p class="l-cap pl-2 mb-0">From</p>
                                                    <p class=" f-18 pl-2">Bangaluru</p>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <img class="card-icons" src="{{asset('static/website/images/icons/location.svg')}}" />
                                                <div class="d-flex f-direction">
                                                    <p class="l-cap pl-2 mb-0">To</p>
                                                    <p class=" f-18 pl-2">Chennai</p>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="d-flex f-direction">
                                                    <p class="l-cap pl-2 mb-0">Distance</p>
                                                    <p class=" f-18 pl-2">314Km</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex mt-1 f-14 pt-1 justify-content-between">
                                            <div>
                                                <p class="bold mt-1 pl-4">
                                                    #312334 <span class="light">| 12 Dec 21</span>
                                                </p>
                                            </div>
                                            <div>
                                                <a class="white-text" href="{{route('order-details')}}">
                                                    <button class="btn btn-green-bg f-10 white-bg">
                                                        Assign Driver Pending
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 mt-4">
                                <div class="card view-left-text">
                                    <div class="card-body bg-card-book">
                                        <div class="d-flex pt-4 pb-2 justify-content-around">
                                            <div class="d-flex ">
                                                <img class="card-icons" src="{{asset('static/website/images/icons/location.svg')}}" />
                                                <div class="d-flex f-direction">
                                                    <p class="l-cap pl-2 mb-0">From</p>
                                                    <p class=" f-18 pl-2">Bangaluru</p>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <img class="card-icons" src="{{asset('static/website/images/icons/location.svg')}}" />
                                                <div class="d-flex f-direction">
                                                    <p class="l-cap pl-2 mb-0">To</p>
                                                    <p class=" f-18 pl-2">Chennai</p>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="d-flex f-direction">
                                                    <p class="l-cap pl-2 mb-0">Distance</p>
                                                    <p class=" f-18 pl-2">314Km</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex mt-1 f-14 pt-1 justify-content-between">
                                            <div>
                                                <p class="bold mt-1 pl-4">
                                                    #312334 <span class="light">| 12 Dec 21</span>
                                                </p>
                                            </div>
                                            <div>
                                                <a class="white-text" href="{{route('order-details')}}">
                                                    <button class="btn btn-green-bg f-10 white-bg" data-toggle="modal" data-target="#order-history-modal">
                                                        Awaiting Pickup
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container" id="no-booking-show">
                            <div class="">
                                <img src="{{asset('static/website/images/images/no-booking.svg')}}" />
                            </div>
                            <div class="italic theme-text">
                                <h1 class="f-14 center"> You have no ongoing booking</h1>

                            </div>
                            <div class=" center d-flex">
                                <a class="white-text " href="#">
                                    <button class="btn mt-4 btn-theme-bg white-bg">Book Now</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
