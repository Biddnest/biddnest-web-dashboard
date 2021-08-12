@extends('website.layouts.frame')
@section('title') Contact Us @endsection
@section('header_title') Support @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="contactus">
        <section class="mb-500">
            <div class="container">
                <div class="quote responsive br-5 w-70 ontop bg-white ">
                    <div class="card-body f-14">
                        <h5 class="card-title -mt-10 mb-4 f-24 pb-1">Contact Details</h5>
                        <div class="row f-initial border-bottom m-20 pb-3 mt-0">
                            <div class="col-md-4  col-sm-12 view-bottom">
                                <div class="d-flex justify-content-around">
                                    <div class="">
                                        <img class="-mt-10" style="margin-right: 12px;" src="{{ asset('static/website/images/icons/location.svg')}}" />
                                    </div>
                                    <div class="">
                                        <h6 class="pl-0 f-18">{{json_decode($contact_details, true)['address']}}</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4  col-sm-12 view-bottom">
                                <div class="d-flex -mt-10 justify-content-start a-item min-view theme-text">
                                    <div class="" style="margin-right: 12px;">
                                        <img src="{{ asset('static/website/images/icons/mail.svg')}}" />
                                    </div>
                                    <div class="" >
                                        @foreach(json_decode($contact_details, true)['email_id'] as $email)
                                            <p class="f-18 underline mb-0">
                                                {{$email}}
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 -mt-10  col-sm-12 view-bottom">
                                <div class="d-flex  a-item min-view  justify-content-start">
                                    <div class="mb-1 " style="margin-right: 12px;">
                                        <img src="{{ asset('static/website/images/icons/call.svg')}}" />
                                    </div>
                                    <div class="">
                                        @foreach(json_decode($contact_details, true)['contact_no'] as $phone)
                                            <p class="f-18  mb-0">
                                                {{$phone}}
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(\Illuminate\Support\Facades\Session::get('account') && $booking)
                                <h5 class="card-title  mb-4 pb-2 mt-2 f-24">Latest Orders</h5>

                                <div class="card view-content p-4">
                                <div class="row f-initial">
                                <div class="col-md-5 col-sm-12 br-rg view-bottom">
                                    <div class="d-flex justify-content-between ">
                                        <div class=" p-0">
                                            <p class="f-14">From</p>
                                            <p class="bg-blur f-18" style="text-align: center; width: fit-content ;"> {{ucwords(json_decode($booking->source_meta, true)['city'])}}</p>
                                        </div>
                                        <div class=" mt-1 pt-3 pb-3 pr-2">
                                            <img class="-ml-10" src="{{ asset('static/website/images/icons/moving-truck.svg')}}" />
                                        </div>
                                        <div class="">
                                            <p class="f-14"> To</p>
                                            <p class="bg-blur f-18" style="text-align: center; width: fit-content ;">{{ucwords(json_decode($booking->destination_meta, true)['city'])}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4  col-sm-12 br-rg view-bottom">
                                            <div class="d-flex justify-content-between  ">
                                                <div class="">
                                                    <div class="mb-3 view-bottom">
                                                        <p class="mb-0 f-14 l-cap ">Order Id </p>
                                                        <p class="f-18"> #{{$booking->public_booking_id}} </p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="mb-0 l-cap">Date</p>
                                                        <p class="f-18"> {{date('d M Y', strtotime($booking->created_at))}} </p>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class="mb-3 view-bottom">
                                                        <p class="mb-0 f-14 l-cap">Price </p>
                                                        <p class="f-18"> Rs.@if($booking->final_quote)
                                                                   {{$booking->final_quote}}
                                                            @else
                                                                {{$booking->final_estimated_quote}}
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="mb-3 view-bottom">
                                                        <p class="mb-0 f-14 l-cap">Status </p>
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
                                        @if($ticket_detail)
                                            <div class="col-md-3  col-sm-12 view-bottom">
                                                <div class="">
                                                    <p class="center text-center f-18">Ticket has already been raised</p>
                                                    <a id="more" class="d-flex center" href="#" onclick="toggle_visibility('view_more_content');"> View more </a>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-md-3  col-sm-12">
                                                <div>
                                                    <div class="d-flex center"><a class="white-text " data-toggle="modal" data-target="#for-friend" href="#"><button
                                                                class="btn btn-theme-bg mt-2  white-bg">Get support</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @if($ticket_detail)
                                        <div id="view_more_content" class="togglenone">
                                        <div class="ticket-id d-flex pt-4  border-top justify-content-between">
                                            <p class="para-head l-cap">Ticket Id : <span>#{{$ticket_detail->id }}</span></p>

                                                @switch($ticket_detail->status)
                                                    @case(\App\Enums\TicketEnums::$STATUS['open'])
                                                        <p class="bg-blur col-orange l-cap">Open</p>
                                                    @break

                                                    @case(\App\Enums\TicketEnums::$STATUS['rejected'])
                                                        <p class="bg-blur col-orange l-cap">Rejected</p>
                                                    @break

                                                    @case(\App\Enums\TicketEnums::$STATUS['resolved'])
                                                        <p class="bg-blur col-orange l-cap">Resolved</p>
                                                    @break

                                                    @case(\App\Enums\TicketEnums::$STATUS['closed'])
                                                        <p class="bg-blur col-orange l-cap">Closed</p>
                                                    @break
                                                @endswitch
                                        </div>
                                        <div class="ticket-id border-top pt-4">
                                            <h6 class="para-head ml-1">Subject</h6>
                                            <p class="l-cap col-grey pl-1">{{$ticket_detail->heading}}</p>
                                            <p class="para pl-1"> {{$ticket_detail->desc}}</p>
                                        </div>
                                        <div class="reply border-top pt-4">
                                            <h5 class="para-head mb-3">Reply</h5>
                                            <div class="d-flex">

                                                <!-- <i class="fas fa-stop"></i> -->
                                                @foreach($ticket_detail->reply as $reply)
                                                    <i class="fa fa-square f-52"></i>
                                                    <div class="mt-1">
                                                        <h6 class="para-text bold ml-3 mb-0">{{ucwords($reply->admin->fname)}} {{ucwords($reply->admin->lname)}}</h6>
                                                        <p class="text-muted ml-1">{{\Carbon\Carbon::now()->diffForHumans($reply->created_at)}}</p>
                                                        <p class="para ml-1"> {{$reply->chat}}
                                                        </p>
                                                    </div>
                                                @endforeach
                                                @if(count($ticket_detail->reply) >= 0)
                                                    <p class="para ml-1">You Don't Recieve Any Reply From Support.</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($booking == "")
                                        <h6 class="card-title  pb-10">You Don't Have Any Latest Orders</h6>
                                    @endif
                                </div>
                        @endif
                    </div>
                </div>
                @if(\Illuminate\Support\Facades\Session::get('account') && $booking)
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
                                                <div class=""><a class="white-text raised" data-booking="{{$booking->public_booking_id}}" data-url="{{route('raise_support')}}" href="{{route('contact_us')}}"><button
                                                            class="btn btn-theme-bg  white-bg btn-confirm-padding padding-btn-res">Yes</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                @endif
            </div>
        </section>
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

    </div>
@endsection
