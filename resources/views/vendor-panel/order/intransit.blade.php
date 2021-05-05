@extends('vendor-panel.layouts.frame')
@section('title') Order Details @endsection
@section('body')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="intransit">
        <div class="d-flex  flex-row justify-content-between vertical-center">
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
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
        <div class="col-lg-12">
            <!-- range slider -->
            <div class="card h-auto p-0 pt-20">
                <div class="tab-pane fade  active show" id="order-status" role="tabpanel" aria-labelledby="order-status-tab">
                    <div class="p-15  border-bottom">

                        <div class="d-flex p-10">
                            <div class="steps-container">
                                <hr class="dash-line">
                                <div class="steps-status">

                                    <div class="step-dot">
                                        <img src="{{asset('static/vendor/images/tick.png')}}">
                                        <!-- <div class="child-dot"></div> -->
                                    </div>
                                    <p class="step-title">Bidding</p>
                                </div>
                                <div class="steps-status">
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
                                        <div class="child-dot"></div>
                                        <!-- <img src="./assets/images/tick.png"> -->
                                    </div>
                                    <p class="step-title">In Transit</p>
                                </div>
                                <div class="steps-status">
                                    <div class="step-dot">
                                        <!-- <div class="child-dot"></div> -->
                                    </div>
                                    <p class="step-title">Canceled/Complete</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex p-15 justify-content-center row text-center">
                        <h5 class="col-sm-12">Your trip has been started</h5>
                        <div class="col-sm-12 intransit">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="bid-badge">
                                        <h4 class="">
                                            @if(json_decode($booking->source_meta, true)['city'] == json_decode($booking->destination_meta, true)['city'])
                                                {{json_decode($booking->source_meta, true)['address']}}
                                            @else
                                                {{json_decode($booking->source_meta, true)['city']}}
                                            @endif
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <img src="{{asset('static/vendor/images/graph/Group 14409.svg')}}" alt="">
                                </div>
                                <div class="col-sm-4">
                                    <div class="bid-badge">
                                        <h4 class="">
                                            @if(json_decode($booking->destination_meta, true)['city'] == json_decode($booking->source_meta, true)['city'])
                                                {{json_decode($booking->destination_meta, true)['address']}}
                                            @else
                                                {{json_decode($booking->destination_meta, true)['city']}}
                                            @endif
                                        </h4>
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
