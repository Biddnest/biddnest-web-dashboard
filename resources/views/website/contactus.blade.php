@extends('website.layouts.frame')
@section('title') Contact Us @endsection
@section('header_title') Support @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="contactus">
        <section class="mb-500">
            <div class="container">
                <div class="quote responsive br-5 w-70 ontop bg-white ">
                    <div class="card-body f-14">
                        <h5 class="card-title -mt-10  pb-1">Contact Details</h5>
                        <div class="row f-initial border-bottom m-20 pb-3 mt-0">
                            <div class="col-md-4  col-sm-12">
                                <div class="d-flex justify-content-around">
                                    <div class="">
                                        <img class="-mt-10" src="{{ asset('static/website/images/icons/location.svg')}}" />
                                    </div>
                                    <div class="">
                                        <p>{{json_decode($contact_details, true)['address']}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4  col-sm-12">
                                <div class="d-flex -mt-10 justify-content-center a-item min-view theme-text">
                                    <div class="">
                                        <img src="{{ asset('static/website/images/icons/mail.svg')}}" />
                                    </div>
                                    <div class="">
                                        @foreach(json_decode($contact_details, true)['email_id'] as $email)
                                            <p class="f-14 underline">
                                                {{$email}}
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 -mt-10  col-sm-12">
                                <div class="d-flex  a-item min-view  justify-content-center">
                                    <div class="mb-1 -mr-10">
                                        <img src="{{ asset('static/website/images/icons/call.svg')}}" />
                                    </div>
                                    <div class="">
                                        @foreach(json_decode($contact_details, true)['contact_no'] as $phone)
                                            <p>
                                                {{$phone}}
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(\Illuminate\Support\Facades\Session::get('account'))
                                <h5 class="card-title  pb-10">Latest Orders</h5>

                                <div class="card view-content p-4">
                                    @foreach($bookings as $booking)
                                    <div class="row f-initial ">
                                        <div class="col-md-5 col-sm-12 br-rg">

                                            <div class="d-flex justify-content-between ">
                                                <div class=" p-0">
                                                    <p>From</p>
                                                    <p class="bg-blur">{{ucwords(json_decode($booking->source_meta, true)['city'])}}</p>
                                                </div>
                                                <div class=" mt-1 pt-3 pr-2 a-self-center">
                                                    <img class="-ml-10" src="{{ asset('static/website/images/icons/moving-truck.svg')}}" />
                                                </div>
                                                <div class="">
                                                    <p>To</p>
                                                    <p class="bg-blur">{{ucwords(json_decode($booking->destination_meta, true)['city'])}}</p>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-4  col-sm-12 br-rg">
                                            <div class="d-flex justify-content-between  ">
                                                <div class="">
                                                    <div>
                                                        <p class="mb-0">Order Id </p>
                                                        <p> #{{$booking->public_booking_id}} </p>
                                                    </div>
                                                    <div>
                                                        <p class="mb-0">Date</p>
                                                        <p> {{date('d M Y', strtotime($booking->created_at))}} </p>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div>
                                                        <p class="mb-0">Price </p>
                                                        <p> Rs.@if($booking->final_quote)
                                                                   {{$booking->final_quote}}
                                                            @else
                                                                {{$booking->final_estimated_quote}}
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p class="mb-0">Status </p>
                                                        @switch($booking->status)
                                                            @case(\App\Enums\BookingEnums::$STATUS['enquiry'])
                                                                <p>Enquiry</p>
                                                            @break

                                                            @case(\App\Enums\BookingEnums::$STATUS['placed'])
                                                                    <p>Placed</p>
                                                            @break

                                                            @case(\App\Enums\BookingEnums::$STATUS['biding'])
                                                                    <p>Biding</p>
                                                            @break

                                                            @case(\App\Enums\BookingEnums::$STATUS['rebiding'])
                                                                    <p>Rebiding</p>
                                                            @break

                                                            @case(\App\Enums\BookingEnums::$STATUS['payment_pending'])
                                                                    <p>Payment Pending</p>
                                                            @break

                                                            @case(\App\Enums\BookingEnums::$STATUS['pending_driver_assign'])
                                                                    <p>Pending Driver Assign</p>
                                                            @break

                                                            @case(\App\Enums\BookingEnums::$STATUS['awaiting_pickup'])
                                                                    <p>Awaiting Pickup</p>
                                                            @break

                                                            @case(\App\Enums\BookingEnums::$STATUS['in_transit'])
                                                                    <p>In Transit</p>
                                                            @break

                                                            @case(\App\Enums\BookingEnums::$STATUS['completed'])
                                                                    <p>Completed</p>
                                                            @break

                                                            @case(\App\Enums\BookingEnums::$STATUS['cancelled'])
                                                                    <p>Cancelled</p>
                                                            @break

                                                            @case(\App\Enums\BookingEnums::$STATUS['bounced'])
                                                                    <p>Bounced</p>
                                                            @break
                                                        @endswitch
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3  col-sm-12">
                                            <div>
                                                <div class="d-flex center"><a class="white-text " data-toggle="modal" data-target="#for-friend" href="#"><button
                                                            class="btn btn-theme-bg mt-2  white-bg">Get support</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                    @if(count($bookings) <= 0)
                                        <h6 class="card-title  pb-10">You Don't Have Any Latest Orders</h6>
                                    @endif
                                </div>
                        @endif
                    </div>
                </div>
                @if(\Illuminate\Support\Facades\Session::get('account'))
                        @foreach($bookings as $booking)
                            <div class="modal fade" id="for-friend" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                                <div class="modal-dialog col-grey input-text-blue" role="document">
                                    <div class="modal-content  w-1000 mt-50  right-25">
                                        <div class="modal-header  bg-purple">
                                            <h5 class="modal-title m-0-auto -mr-30 text-white" id="exampleModalLongTitle ">Confirmation
                                            </h5>
                                            <button type="button" class="close text-white  " data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-5 margin-topneg-7">
                                            <div class="d-flex center">
                                                <p class="model-text ">Are you sure you want to avail support for this order ? </p>
                                            </div>
                                            <div class="d-flex justify-around  button-bottom pt-4">

                                                <div class=""><a class="white-text" href="{{route('contact_us')}}"><button
                                                            class="btn btn-theme-w-bg btn-confirm-padding padding-btn-res">No</button></a>
                                                </div>
                                                <div class=""><a class="white-text raised" data-booking="{{$booking->public_booking_id}}" data-url="{{route('raise_support')}}" href="#"><button
                                                            class="btn btn-theme-bg  white-bg btn-confirm-padding padding-btn-res">Yes</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                @endif
            </div>
        </section>
        {{--<script>
            $(document).ready(function() {

                var showHeaderAt = 150;

                var win = $(window),
                    body = $('body');
                if (win.width() > 400) {
                    win.on('scroll', function(e) {
                        if (win.scrollTop() > showHeaderAt) {
                            body.addClass('fixed');
                        } else {
                            body.removeClass('fixed');
                        }
                    });
                }
            });
        </script>--}}
    </div>
@endsection
