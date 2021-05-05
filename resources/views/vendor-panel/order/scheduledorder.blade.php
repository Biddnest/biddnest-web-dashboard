@extends('vendor-panel.layouts.frame')
@section('title') Order Details @endsection
@section('body')
    <div class="main-content grey-bg">
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
        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-lg-12">
                <!-- range slider -->
                <div class="card h-auto p-0 pt-20">
                    <div class="tab-pane fade  active show" id="order-status" role="tabpanel" aria-labelledby="order-status-tab">
                        <div class="p-15">
                            <div class="d-flex p-10">
                                <div class="steps-container  ">
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
                                            <!-- <img src="./assets/images/tick.png"> -->
                                            <div class="child-dot"></div>
                                        </div>
                                        <p class="step-title">Scheduled</p>
                                    </div>
                                    <div class="steps-status">
                                        <div class="step-dot">
                                            <!-- <img src="./assets/images/tick.png"> -->
                                        </div>
                                        <p class="step-title">Driver Details</p>
                                    </div>
                                    <div class="steps-status">
                                        <div class="step-dot">
                                            <!-- <div class="child-dot"></div> -->
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
                        <div class="d-flex  border-bottom pb-0">
                            <ul class="nav nav-tabs pt-20 p-0 f-18" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="new-order-tab" data-toggle="tab" href="#order-details" role="tab" aria-controls="home" aria-selected="true">Order Details</a>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex p-15 " style="padding-bottom: 0px !important;">
                            <div class="tab-content w-100" id="myTabContent">
                                <div class="tab-pane fade active show" id="order-details" role="tabpanel" aria-labelledby="order-details-tab">
                                    <div class="d-flex  row margin-topneg-15">
                                        <div class="col-sm-4  secondg-bg   pt-10">
                                            <div class="theme-text f-14 bold p-8">
                                                From
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                From Pincode
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                From Floor
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                To
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                To Pincode
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                To Floor
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                Distance
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                Type of Movement
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                Category
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                Order Price
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                Moving Date
                                            </div>
                                        </div>

                                        <div class="col-sm-5 white-bg  pt-10">
                                            <div class="theme-text f-14 p-8">
                                                {{json_decode($booking->source_meta, true)['address']}}
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{json_decode($booking->source_meta, true)['pincode']}}
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{json_decode($booking->source_meta, true)['floor']}} @if(json_decode($booking->source_meta, true)['lift']==\App\Enums\CommonEnums::$YES)(Lift: Yes) @else (Lift: Yes) @endif
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{json_decode($booking->destination_meta, true)['address']}}
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{json_decode($booking->destination_meta, true)['pincode']}}
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{json_decode($booking->destination_meta, true)['floor']}} @if(json_decode($booking->destination_meta, true)['lift']==\App\Enums\CommonEnums::$YES)(Lift: Yes) @else (Lift: Yes) @endif
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{json_decode($booking->meta, true)['distance']}} KM
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                @if(json_decode($booking->source_meta, true)['shared_service']== true)Dedicated @else Shared @endif
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{$booking->service->name}}
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                Rs. {{$booking->final_estimated_quote}}
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                @foreach($booking->movement_dates as $mdate)
                                                    <span class="status-3">{{date("d M Y", strtotime($mdate->date))}}</span>
                                                @endforeach
                                            </div>
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
