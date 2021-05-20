@extends('website.layouts.frame')
@section('title')Ongoing Book @endsection
@section('header_title') Ongoing Book @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="finalbooking">
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
                    <div class="tab-pane fade show active" id="past" role="tabpanel" aria-labelledby="past-tab">
                        <div class="text-center" id="timer">
                            <h4 class="border-bottom p-4">ORDER ID <span>#232345</span></h4>
                            <p class="text-muted pt-4 italic">
                                You will get the estimated price once the time is up
                            </p>
                            <h3 class="f-18 pb-4 bold mt-2">Time Left</h3>

                            <div id="app"></div>
                        </div>

                        <div id="proceed" {{--style="display: none"--}}>
                            <div class="container">
                                <div class="row mt-2 border-bottom">
                                    <div class="col-12 d-flex justify-content-around center">
                                        <div class="pr-3">
                                            <p class="para-head">FROM</p>
                                            <p class="bg-blur para-head">BENGALURU</p>
                                        </div>
                                        <div class="pr-3 a-self-center">
                                            <img src="{{asset('static/website/images/icons/moving-truck.svg')}}" />
                                        </div>
                                        <div class="pr-5">
                                            <p class="para-head">TO</p>
                                            <p class="bg-blur para-head">CHENNAI</p>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-2 final-price center f-direction">
                                        <h4 class="d-flex center">Final Bidding</h4>
                                        <div class="price-circle mt-2 theme-text">
                                            <h4 class="m-10">₹ 3,301</h4>
                                            <p>Final Price</p>
                                        </div>
                                        <h5 class="theme-text mt-2 f-16">Premium</h5>
                                    </div>
                                </div>
                                <div class="row d-flex center border-bottom mt-4">
                                    <div class="pr-3">
                                        <p>VEHICLE NAME</p>
                                        <p>Motor-X</p>
                                    </div>
                                    <div class="pr-3">
                                        <p>VEHICLE TYPE</p>
                                        <p>Heavy</p>
                                    </div>
                                    <div class="pr-3">
                                        <p>MANPOWER</p>
                                        <p>5</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion" id="comments">
                                <div class="d-flex justify-content-center">
                                    <div class="form-groups">
                                        <label class="container-01">
                                            <input type="checkbox" id="Lift1" />
                                            <span class="checkmark-agree -mt-10"></span>
                                        </label>

                                        <span class="error-message">Please enter valid</span>
                                    </div>
                                    <p class="text-muted center mt-2 pl-0">
                                        I agree to the Terms & Conditions
                                    </p>
                                </div>

                                <div class="button-bottom d-flex justify-content-between pt-4">
                                    <div class="">
                                        <a class="white-text" data-toggle="modal" data-target="#reject-modal"><button
                                                class="btn btn-theme-w-bg">Reject</button></a>
                                    </div>
                                    <div class="">
                                        <a href="{{route('payment')}}">
                                            <button type="submit" class="btn btn-theme-bg white-bg">
                                                Place Order
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="reject-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                            <div class="modal-dialog para-head input-text-blue" role="document">
                                <div class="modal-content w-90 mt-50 right-25">
                                    <div class="modal-header bg-purple">
                                        <h5 class="modal-title m-0-auto -mr-30 text-white" id="exampleModalLongTitle ">
                                            Reason for Rejection
                                        </h5>
                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body p-15 margin-topneg-2">
                                        <form>
                                            <div class="col-12">
                                                <div class="form-input">
                                                    <span class="">
                                                    <select id="" class="form-control">
                                                      <option>High Price</option>
                                                      <option>Lower Quality</option>
                                                      <option>Bad Ideas</option>
                                                    </select>
                                                    <span class="error-message">Please enter valid Phone number</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-input">
                                                    <textarea class="form-control" rows="3" placeholder="Enter your expected price here">
                                                    </textarea>
                                                </div>
                                            </div>
                                            <!-- <div class="col-12 d-flex center mt-2 mb-2">
                                                            <div class="form-groups">
                                                                <label class="container-01 p-1 pl-2 m-0">
                                                      <input type="checkbox" id="Lift1" />
                                                      <span class="checkmark-agree -mt-10"></span>
                                                    </label>
                                                            </div>
                                                            <p class="text-muted f-10">Talk to our agend</p>
                                                        </div> -->
                                            <button type="submit" class="btn btn-theme-bg button-modal ml-5 text-view-center mt-2 padding-btn-res white-bg">
                                                Cancel Booking
                                                <a class="white-text" href="#"></a>
                                            </button>
                                        </form>
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
