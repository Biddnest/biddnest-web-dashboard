@extends('website.layouts.frame')
@section('title')Ongoing Book @endsection
@section('header_title') Ongoing Booking @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="finalbooking">
        <div class="container">
            <div class="quote responsive w-70 ontop p-4 bg-white">
                <div class="card-head right text-left p-8 pt-10 pb-0">
                    <h3 class="f-18">
                        <ul class="nav nav-tabs pt-10 p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15 pt-0" href="{{route('website.my-profile')}}">My Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab active p-15 pt-0" href="{{route('my-bookings-enquiries')}}">Enquiries</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15 pt-0" id="quotation" data-toggle="tab" href="#past" role="tab" aria-controls="profile" aria-selected="false">Ongoing Booking</a>
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
                    <div class="tab-pane fade show active" id="past" role="tabpanel" aria-labelledby="past-tab">
                        @if(($booking->status == \App\Enums\BookingEnums::$STATUS['biding']) || ($booking->status == \App\Enums\BookingEnums::$STATUS['rebiding']))
                            <span class="center successful-icon mt-2 view-block text-view-center">
                                <img class="w-150" src="{{ asset('static/website/images/images/gifs/4.gif')}}" alt="some-picture" />
                            </span>
                            <div class="text-center" id="timer" data-count="{{\Carbon\Carbon::now()->diffInSeconds($booking->bid_result_at)}}">
                                <h4 class="border-bottom p-4">ENQUIRY ID <span>#{{$booking->public_enquiry_id}}</span></h4>
                                <p class="text-muted pt-4 italic">
                                    You will get the estimated price once the time is up
                                </p>
                                <h3 class="f-18 pb-4 bold mt-2 time">Time Left</h3>

                                <span class="text-center timer" data-time="{{$booking->bid_result_at}}" style="font-size: 20px !important;"></span>

{{--                                <div id="app" style="margin-bottom: 60px;"></div>--}}
                            </div>
                        @elseif(($booking->status == \App\Enums\BookingEnums::$STATUS['payment_pending']))
                            <div id="proceed" {{--style="display: none"--}}>
                                <div class="container">
                                    <div class="row mt-2 border-bottom">
                                        <div class="col-12 d-flex justify-content-around center ml-4">
                                            <div class="pr-3">
                                                <p class="para-head">FROM</p>
                                                <p class="bg-blur para-head" style="width: 150px; text-align:center ">{{ucwords(json_decode($booking->source_meta, true)['city'])}}</p>
                                            </div>
                                            <div class="pr-3 a-self-center">
                                                <img src="{{asset('static/website/images/icons/moving-truck.svg')}}" />
                                            </div>
                                            <div class="pr-5">
                                                <p class="para-head">TO</p>
                                                <p class="bg-blur para-head" style="width: 150px; text-align:center">{{ucwords(json_decode($booking->destination_meta, true)['city'])}}</p>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-2 final-price center f-direction">
                                            <h4 class="d-flex center">Final Bidding</h4>
                                            <div class="price-circle mt-2 theme-text" style="display:table !important; height: 200px !important; width: 200px !important;">
                                                <h4 class="m-10" style="dispaly:table-cell !important; verticle-align:middle !important; text-align:center !important;">₹ {{$booking->final_quote}}</h4>
                                                <p class="final-price" style="dispaly:table-cell !important; verticle-align:middle !important; text-align:center !important;">Final Price</p>
                                            </div>
                                            <h5 class="theme-text mt-2 f-16">
                                                @if($booking->booking_type == \App\Enums\BookingEnums::$BOOKING_TYPE['premium'])
                                                    Premium
                                                @elseif($booking->booking_type == \App\Enums\BookingEnums::$BOOKING_TYPE['economic'])
                                                    Economic
                                                @endif
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row d-flex center border-bottom mt-4">
                                        <div class="pr-3">
                                            <p><b>OREDR ID</b></p>
                                            <p class="text-center f-14">{{$booking->public_booking_id ?? ''}}</p>
                                        </div>
                                        <div class="pr-3">
                                            <p><b>INITIAL QUOTE</b></p>
                                            <p class="text-center f-14">{{$booking->final_estimated_quote ?? ''}}</p>
                                        </div>
                                        <div class="pr-3">
                                            <p><b>FINAL QUOTE</b></p>
                                            <p class="text-center f-14">{{$booking->final_quote ?? ''}}</p>
                                        </div>
                                    </div>
                                    <div class="row d-flex center mt-4">
                                        <div class="pr-3">
                                            <p><b>VEHICLE TYPE</b></p>
                                            <p class="text-center f-14">@if($booking->movement_specifications->meta){{ucwords(json_decode($booking->movement_specifications->meta, true)['vehicle_type']) ?? ''}}@endif</p>
                                        </div>
                                        <div class="pr-3">
                                            <p><b>MANPOWER</b></p>
                                            <p class="text-center f-14"> @if($booking->movement_specifications->meta){{json_decode($booking->movement_specifications->meta, true)['min_man_power'] ?? ''}} - {{json_decode($booking->movement_specifications->meta, true)['max_man_power'] ?? ''}}@endif</p>
                                        </div>
                                        <div class="pr-3">
                                            <p><b>MOVEMENT TYPE</b></p>
                                            <p class="text-center f-14"> @if($booking->movement_specifications->meta){{ucwords(json_decode($booking->movement_specifications->meta, true)['type_of_movement']) ?? ''}}@endif</p>
                                        </div>
                                    </div>
                                </div>
                                    <div class="accordion" id="comments">
                                        <div class="d-flex justify-content-center">
                                            <div class="form-groups">
                                                <label class="container-01">
                                                    <input type="checkbox" id="Lift1" required/>
                                                    <span class="checkmark-agree -mt-10"></span>
                                                </label>

                                                <span class="error-message">Please enter valid</span>
                                            </div>
                                            <p class="text-muted center mt-2 pl-0">
                                                By proceeding, you agree to our Terms & Conditions
                                            </p>
                                        </div>

                                        <div class="button-bottom d-flex justify-content-between pt-4">
                                            <div class="">
                                                <a class="white-text" data-toggle="modal" data-target="#reject-modal"><button
                                                        class="btn btn-theme-w-bg">Reject</button></a>
                                            </div>
                                            <div class="">
                                                <a href="{{route('payment',['id'=>$booking->public_booking_id])}}">
                                                    <button class="btn btn-theme-bg white-bg">
                                                        Pay & Confirm
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        @endif
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
                                        <form action="{{route('add_cancel_ticket')}}" method="POST" data-next="redirect" data-redirect-type="hard" data-url="{{route('my-bookings')}}"  data-alert="mega" class="form-new-order mt-3 input-text-blue" data-parsley-validate>
                                            <div class="col-12">
                                                <input type="hidden" name="public_booking_id" value="{{$booking->public_booking_id}}">
                                                <div class="form-input">
                                                    <select id="" class="form-control" name="heading" required>
                                                      <option value="">--Select Reason--</option>
                                                        @foreach($resions as $resion)
                                                            <option value="{{$resion}}">{{ucwords($resion)}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="error-message">Please enter valid Phone number</span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-input">
                                                    <textarea class="form-control" rows="3" placeholder="Please tell more" name="desc"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex center mt-2 mb-2">
                                                <div class="form-groups">
                                                    <label class="container-01 p-1 pl-6 m-0">
                                                        <input type="checkbox" id="Lift1" name="request_callback" value="true"/>
                                                        <span class="checkmark-agree -mt-10"></span>
                                                    </label>
                                                </div>
                                                <p class="text-muted" style="padding-left: 20px;">Talk to our agent</p>
                                            </div>
                                            <button type="submit" class="btn btn-theme-bg button-modal ml-5 text-view-center mt-2 padding-btn-res white-bg">
                                                Cancel Booking
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
