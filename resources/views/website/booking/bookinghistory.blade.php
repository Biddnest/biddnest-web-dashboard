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
                                <a class="nav-link light-nav-tab p-15" id="new-order-tab" data-toggle="tab" href="{{route('my-profile')}}">My Profile</a>
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
                                                <a class="white-text" href="#">
                                                    <button class="btn btn-green-bg f-10 white-bg" data-toggle="modal" data-target="#order-history-modal">
                                                        completed
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
                                                <a class="white-text" href="#">
                                                    <button class="btn btn-green-bg f-10 white-bg" data-toggle="modal" data-target="#order-history-modal">
                                                        completed
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
                                                <a class="white-text" href="#">
                                                    <button class="btn btn-green-bg f-10 white-bg" data-toggle="modal" data-target="#order-history-modal">
                                                        completed
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
                                                <a class="white-text" href="#">
                                                    <button class="btn btn-green-bg f-10 white-bg" data-toggle="modal" data-target="#order-history-modal">
                                                        completed
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="history-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                            <div class="modal-dialog para-head input-text-blue" role="document">
                                <div class="modal-content w-1000 mt-50 right-25">
                                    <div class="modal-header bg-purple">
                                        <h5 class="modal-title m-0-auto -mr-30 text-white" id="exampleModalLongTitle ">
                                            Order Details
                                        </h5>
                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body p-15 margin-topneg-2">
                                        <div>
                                            <div class="d-flex justify-content-between">
                                                <div class="ticket-id pt-3">
                                                    <h6 class="para-head light pl-3">
                                                        REQUEST ID <span class="bold">: #454567</span>
                                                    </h6>
                                                </div>
                                                <div class="status-badge white-text bg-green">
                                                    <a data-toggle="modal" data-target="#order-history-modal">completed</a>
                                                </div>
                                            </div>
                                            <div class="border-bottom pt-4">
                                                <h6 class="para-head pl-3 ">Demo Subject</h6>
                                                <p class="para mt-1 pl-3">
                                                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has.
                                                </p>
                                            </div>
                                            <div class="pt-4">
                                                <h6 class="para-head pl-3">Reply</h6>
                                                <p class="para mt-1 pl-3">
                                                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="order-history-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
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
                                            <p class="bg-blur f-18">Bengaluru</p>
                                        </div>
                                        <div class="mt-1 pt-3">
                                            <img src="{{asset('static/website/images/icons/moving-truck.svg')}}" />
                                        </div>
                                        <div>
                                            <p class="f-14">TO</p>
                                            <p class="bg-blur f-18">Chennai</p>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-1 pt-2 ml-3 mr-36 justify-content-between text-left ">
                                        <div>
                                            <h6 class="l-cap f-14">Date</h6>
                                            <h5 class="f-14">20 Jan 21</h5>
                                        </div>
                                        <div>
                                            <h6 class="l-cap f-14">Price</h6>
                                            <h5 class="f-14">Rs. 9,800</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-1 pt-2 ml-3 mr-36 justify-content-between text-left">
                                        <div>
                                            <h6 class="l-cap f-14">Order ID</h6>
                                            <h5 class="f-14">#312334</h5>
                                        </div>
                                        <div class="m-w-60">
                                            <h6 class="l-cap f-14">Distance</h6>
                                            <h5 class="f-14">314 KM</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-1 pt-2 ml-3 mr-36 justify-content-between text-left">
                                        <div>
                                            <h6 class="l-cap f-14">Status</h6>
                                            <h5 class="f-14">Booked</h5>
                                        </div>
                                        <div class="m-w-60 -mr-10">
                                            <h6 class="l-cap f-14">Category</h6>
                                            <h5 class="f-14">Commercial</h5>
                                        </div>
                                    </div>

                                    <div class="card text-left mt-1">
                                        <div class="details-card bg-blur">
                                            <div class="d-flex justify-content-between  pr-2">
                                                <div>
                                                    <p class="l-cap f-12 mb-0 pl-0 ">Driver</p>
                                                    <p class="mt-0 pl-0 f-14">Omkar Patel</p>
                                                </div>
                                                <div>
                                                    <div>
                                                        <p class="l-cap f-12 mb-0 pl-0">Vehicle Name</p>
                                                        <p class="f-14 mt-0 pl-0">Motor-X</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between  pr-2">
                                                <div>
                                                    <p class="l-cap f-12 mb-0 pl-0">Phone Number</p>
                                                    <p class="mt-0 pl-0 f-14">9099090999</p>
                                                </div>
                                                <div class="pr-1">
                                                    <p class="l-cap f-12 mb-0 pl-0">Vehicle Type</p>
                                                    <p class="mt-0 pl-0 f-14">Heavy</p>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end pr-2">
                                                <div class="pr-3">
                                                    <p class="l-cap f-12 mb-0 pl-0">Manpower</p>
                                                    <p class="mt-0 pl-0 f-14">5</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
