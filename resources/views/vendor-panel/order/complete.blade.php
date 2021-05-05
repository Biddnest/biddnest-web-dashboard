@extends('vendor-panel.layouts.frame')
@section('title') Order Details @endsection
@section('body')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="complete">
        <div class="d-flex  flex-row justify-content-between vertical-center" >
            <h3 class="page-head text-left p-4 f-20 theme-text">Order Details</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page" ><a href="{{route('vendor.bookings', ['type'=>"live"])}}"> Manage Bookings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-lg-12">
                <!-- range slider -->
                <div class="card h-auto p-0 pt-20">
                    <div class="tab-pane fade  active show" id="order-status" role="tabpanel" aria-labelledby="order-status-tab">
                        <div class="p-15">
                            <div class="d-flex p-10">
                                <div class="steps-container   ">
                                    <hr class="dash-line" >
                                    <div class="steps-status ">
                                        <div class="step-dot">
                                            <img src="{{asset('static/vendor/images/tick.png')}}">
                                            <!-- <div class="child-dot"></div> -->
                                        </div>
                                        <p class="step-title">Bidding</p>
                                    </div>
                                    <div class="steps-status ">
                                        <div class="step-dot">
                                            <img src="{{asset('static/vendor/images/tick.png')}}">
                                        </div>
                                        <p class="step-title">My Quote</p>
                                    </div>
                                    <div class="steps-status">
                                        <div class="step-dot">
                                            <img src="{{asset('static/vendor/images/tick.png')}}">
                                            <!-- <div class="child-dot"></div> -->
                                        </div>
                                        <p class="step-title">Scheduled</p>
                                    </div>
                                    <div class="steps-status">
                                        <div class="step-dot">
                                            <img src="{{asset('static/vendor/images/tick.png')}}">
                                        </div>
                                        <p class="step-title">Driver Details</p>
                                    </div>
                                    <div class="steps-status">
                                        <div class="step-dot">
                                            <!-- <div class="child-dot"></div> -->
                                            <img src="{{asset('static/vendor/images/tick.png')}}">
                                        </div>
                                        <p class="step-title">In Transit</p>
                                    </div>
                                    <div class="steps-status">
                                        <div class="step-dot">
                                            <div class="child-dot"></div>
                                        </div>
                                        <p class="step-title">Canceled/Complete</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex p-15 ">
                            <div class="tab-content w-100" id="myTabContent">
                                <div class="tab-pane fade active show" id="order-details" role="tabpanel" aria-labelledby="order-details-tab">
                                    <div class="d-flex  row margin-topneg-15 justify-content-center">
                                        <div class="col-sm-6    pt-10 text-center p-20">
                                            @if($booking->status == \App\Enums\BookingEnums::$STATUS['completed'])
                                                <img src="{{asset('static/vendor/images/graph/Image 7.svg')}}" width="60%">
                                                <h3>This order has been Completed!</h3>
                                            @elseif($booking->status == \App\Enums\BookingEnums::$STATUS['cancelled'])
                                                <img src="{{asset('static/vendor/images/cancel.svg')}}" width="60%" style="padding-bottom: 100px;">
                                                <h3>This order has been Cancelled!</h3>
                                            @endif
                                            {{--<h5>
                                                You will receive amount <span class="bold">
                                                        Rs. 4000
                                                    </span>  on <span class="bold">20th Jan 2021</span>
                                            </h5>--}}
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
