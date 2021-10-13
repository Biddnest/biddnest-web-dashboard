@extends('layouts.app')
@section('title') Orders And Bookings @endsection
@section('content')

    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="orderdetails">
        <div class="d-flex  flex-row justify-content-between">
            <h3 class="page-head text-left p-4">Order Details</h3>
            @if(($booking->status == \App\Enums\BookingEnums::$STATUS['enquiry']) || ($booking->status == \App\Enums\BookingEnums::$STATUS['in_progress']))
                <div class="mr-20">
                    <a href="{{ route('edit-order', ['id'=>$booking->public_booking_id])}}">
                        <button class="btn theme-bg white-text" ><i class="fa fa-plus p-1" aria-hidden="true"></i> Edit order</button>
                    </a>
                </div>
            @endif
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left p-4 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('orders-booking')}}">Booking & Orders</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                    </ol>
                </nav>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12" style="padding: 0px 40px; border: none;">
                <div class="card" style="border:none;">
                    <div class="card-body" style="padding: 20px;">

                        <hr class="dash-line">
                        <div class="steps-container">
                            @foreach(\App\Enums\BookingEnums::$STATUS as $key=>$status)
                                @if(in_array($status, $booking->status_ids) && $key != "in_progress" )
                                    <div class="steps-status " style="width: 10%; text-align: center;">
                                        <div class="step-dot">
                                            <img src="{{ asset('static/images/tick.png')}}" />
                                        </div>
                                        <p class="step-title">{{ ucwords(str_replace("_"," ", $key))  }}</p>
                                    </div>
                                @elseif($key != "in_progress" && $key != "rebiding" && $key != "cancelled" && $key != "bounced" && $key != "hold" && $key != "cancel_request" )
                                    <div class="steps-status " style="width: 10%; text-align: center;">
                                        <div class="step-dot">
                                            <div class="child-dot"></div>
                                        </div>
                                        <p class="step-title">{{ ucwords(str_replace("_"," ", $key))  }}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Dashboard cards -->


        <div class="d-flex flex-row  Dashboard-lcards  justify-content-center">
            <div class="col">
                <!-- <div class="d-flex  flex-row text-left">
                    <a href="booking-orders.html" class="text-decoration-none">
                        <h3 class="page-subhead text-left p-4 f-20 theme-text">
                        <i class="p-1"> <img src="assets/images/Icon feather-chevrons-left.svg" alt="" srcset=""></i> Back to Bookings & Orders</h3></a>

                </div> -->
                <div class="card  h-auto p-0 " >

                    <div class="card-head right text-center  pb-0 p-05" style="padding-top: 0">
                        <h3 class="f-18" style="margin-top: 0;">
                            <ul class="nav nav-tabs p-0 flex-row" id="myTab" role="tablist" style="font-weight: 600;">
                                <li class="nav-item ">
                                    <a class="nav-link p-15" id="customer-details-tab" data-toggle="tab" href="{{route('order-details', ['id'=>$booking->id])}}" role="tab" aria-controls="home" aria-selected="true">Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-estimate', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Action</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-vendor', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Vendor Details</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-quotation', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Quotation</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-bidding', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Bidding</a>
                                </li>

                                @if($booking->status == \App\Enums\BookingEnums::$STATUS['price_review_pending'])
                                    <li class="nav-item">
                                        <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-bidding-review', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Bidding Review</a>
                                    </li>
                                @endif

                                <li class="nav-item">
                                    <a class="nav-link p-15" id="quotation-tab" data-toggle="tab" href="{{route('order-details-payment', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Payment</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link p-15" id="review-tab" data-toggle="tab" href="{{route('order-details-review', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Review</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active p-15" id="cancel-tab" data-toggle="tab" href="{{route('order-details-cancel', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Cancel</a>
                                </li>

                            </ul>
                        </h3>

                    </div>
                    <div class="tab-content " id="myTabContent">
                        <!-- form starts -->
                        <div class="w-100">
                            <div class="tab-pane show text-center" style="min-height: 50vh; padding-top: 35px;">

                                <i class="icon dripicons-warning" style="font-size: 100px; color: #fdc403;"></i>
                                    <p class="font14">

                                    @if(!in_array($booking->status, [\App\Enums\BookingEnums::$STATUS['cancelled'],\App\Enums\BookingEnums::$STATUS['bounced']]))
                                        @if($booking->status > \App\Enums\BookingEnums::$STATUS['payment_pending'] && $booking->status > \App\Enums\BookingEnums::$STATUS['completed'])
                                        <i>This booking can be cancelled. You can choose to make a full or partial refund on proceeding.</i>
                                        @else
                                        <i>This enquiry can be cancelled. Since no payment was done yet, no refund will be issued.</i>
                                        @endif
                                    @endif

                                    </p>
                                    {{-- <a class="white-text p-10" href="{{route("onboard-bank-vendors", ['id'=>$id])}}">
                                         <button type="button" class="btn theme-bg theme-text w-30 white-bg">Convert To Vendor</button></a>--}}

                                @if(!in_array($booking->status, [\App\Enums\BookingEnums::$STATUS['cancelled'],\App\Enums\BookingEnums::$STATUS['bounced']]))
                                    @if($booking->status > \App\Enums\BookingEnums::$STATUS['payment_pending'] && $booking->status > \App\Enums\BookingEnums::$STATUS['completed'])
                                        <a class="white-text p-10 vendor-status-change" data-url="{{route("onboard-action-status", ['id'=>$id?? 0, 'status'=>\App\Enums\OrganizationEnums::$STATUS["active"]])}}">
                                            <button type="button" class="btn theme-bg theme-text w-30 white-bg">Cancel and refund</button>
                                        </a>
                                    @else
                                        <a class="white-text p-10 vendor-status-change" data-url="{{route("onboard-action-status", ['id'=>$id?? 0, 'status'=>\App\Enums\OrganizationEnums::$STATUS["active"]])}}">
                                            <button type="button" class="btn theme-bg theme-text w-30 white-bg">Cancel this enquiry</button></a>
                                    @endif
                                @endif



                            </div>
                            <div class="d-flex  justify-content-between flex-row  p-10 py-0"
                                 style="border-top: 1px solid #70707040;">
                            </div>
                            <div class="w-100 text-right">

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
