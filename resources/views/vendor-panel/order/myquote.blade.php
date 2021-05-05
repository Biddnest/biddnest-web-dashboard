@extends('vendor-panel.layouts.frame')
@section('title') Order Details @endsection
@section('body')
    <div class="main-content grey-bg">
        <div class="d-flex  flex-row justify-content-between vertical-center" data-barba="container" data-barba-namespace="orderquote">
            <h3 class="page-head text-left p-4 f-20 theme-text">Order Details</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page" ><a href="manage-bookings.html"> Manage Bookings</a></li>
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
                                <div class="steps-container mr-4 justify-content-center">
                                    <hr class="dash-line" style="width:11% !important;margin-left: 10%;">
                                    <div class="steps-status " style="margin: 0px 90px;">
                                        <div class="step-dot">
                                            <img src="{{asset('static/vendor/images/tick.png')}}">
                                        </div>
                                        <p class="step-title">Bidding</p>
                                    </div>
                                    <div class="steps-status ">
                                        <div class="step-dot">
                                            <div class="child-dot"></div>
                                        </div>
                                        <p class="step-title">My Quote</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex  border-bottom pb-0">
                            <ul class="nav nav-tabs pt-20 p-0 f-18" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="new-order-tab" data-toggle="tab" href="#order-details" role="tab" aria-controls="home" aria-selected="true">My Quote</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="requirments-tab" data-toggle="tab" href="{{route('vendor.my-bid', ['id'=>$booking->public_booking_id])}}">My Bid</a>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex p-15 ">
                            <div class="tab-content w-100" id="myTabContent">
                                <div class="tab-pane fade active show" id="order-details" role="tabpanel" aria-labelledby="order-details-tab">
                                    <div class="d-flex  row margin-topneg-15  p-60">
                                        <div class="col-sm-6    pt-10 p-60 text-center">
                                            <img src="{{asset('static/vendor/images/Group 14106.svg')}}">
                                            <div class="p-8 mt-2">
                                                <h4 class="f-20">Your quote has been Submitted !!</h4>
                                                <h3 class="f-24">BID PLACED</h3>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 pt-10 p-60 text-center">
                                            <h3 class="f-24 theme-text bold p-10">Time Left</h3>
                                            <div id="app"><span class="text-center timer f-24" data-time="{{$booking->bid_result_at}}" style="min-width: 0px !important;"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
