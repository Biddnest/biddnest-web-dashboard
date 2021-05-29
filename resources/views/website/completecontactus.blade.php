@extends('website.layouts.frame')
@section('title') Contact Us @endsection
@section('header_title') Support @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="completecontactus">
            <div class="container">
                <div class="quote responsive br-5 w-70 ontop bg-white">
                    <div class="card-body f-14">
                        <h5 class="card-title -mt-10  pb-1">Contact Details</h5>
                        <div class="row f-initial border-bottom m-20 pb-3 mt-0">
                            <div class="col-md-4  col-sm-12">
                                <div class="d-flex justify-content-around">
                                    <div class="">
                                        <img class="-mt-10" src="{{ asset('static/website/images/icons/location.svg')}}" />
                                    </div>
                                    <div class="">
                                        <h6 class="pl-2">{{json_decode($contact_details, true)['address']}}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4  col-sm-12">
                                <div class="d-flex -mt-10 justify-content-start a-item min-view theme-text">
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
                                <div class="d-flex  a-item min-view  justify-content-start">
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
                        <h5 class="card-title pb-10">Latest Orders</h5>
                        <div class="card view-content p-4 ">
                            <div class="row f-initial">
                                <div class="col-md-5 col-sm-12 br-rg">
                                    <div class="d-flex justify-content-between ">
                                        <div class=" p-0">
                                            <p>From</p>
                                            <p class="bg-blur" style="text-align: center; width: fit-content;"> {{ucwords(json_decode($booking->source_meta, true)['city'])}}</p>
                                        </div>
                                        <div class=" mt-1 pt-3 pb-3 pr-2">
                                            <img class="-ml-10" src="{{ asset('static/website/images/icons/moving-truck.svg')}}" />
                                        </div>
                                        <div class="">
                                            <p>To</p>
                                            <p class="bg-blur" style="text-align: center; width: fit-content;">{{ucwords(json_decode($booking->destination_meta, true)['city'])}}</p>
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
                                                <p class="mb-0">Date </p>
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
                                    <div class="">
                                        <p class="center text-center f-14">Ticket has already been raised</p>
                                        <a id="more" class="d-flex center" href="#" onclick="toggle_visibility('view_more_content');"> View more </a>
                                    </div>
                                </div>
                            </div>
                            <div id="view_more_content" class="togglenone">
                                <div class="ticket-id d-flex pt-4  border-top justify-content-between">
                                    <p class="para-head l-cap">Ticket Id : <span>#{{$ticket_detail->id}}</span></p>
                                    <p class="bg-blur col-orange l-cap">In process</p>
                                </div>
                                <div class="ticket-id border-top pt-4">
                                    <h6 class="para-head ml-1">Subject</h6>
                                    <p class="l-cap col-grey pl-1">{{$ticket_detail->heading}}</p>
                                    <p class="para pl-1"> {{$ticket_detail->desc}}</p>
                                </div>
                                <div class="reply border-top pt-4">
                                    <h5 class="para-head mb-3">Reply</h5>
                                    <div class="d-flex">
                                        <i class="fa fa-square f-52"></i>
                                        <!-- <i class="fas fa-stop"></i> -->
                                        @foreach($ticket_detail->reply as $reply)
                                            <div class="mt-1">
                                                <h6 class="para-text bold ml-3 mb-0">Customer Support</h6>
                                                <p class="text-muted ml-1">{{\Carbon\Carbon::now()->diffForHumans($reply->created_at)}}</p>
                                                <p class="para ml-1"> {{$reply->chat}}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <script type="text/javascript">
            function toggle_visibility(id) {
                var e = document.getElementById(id);
                if (e.style.display == 'block') {
                    e.style.display = 'none';
                    document.getElementById("more").innerText = "View More";
                } else {
                    e.style.display = 'block';
                    document.getElementById("more").innerText = "View Less";
                }
            }
        </script>
        <script>
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
        </script>
    </div>
@endsection
