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
                                    <a class="nav-link disabled" id="new-order-tab">My Quote</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active show" id="requirments-tab" data-toggle="tab" href="#requirements" role="tab" aria-controls="profile" aria-selected="false">My Bid</a>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex p-15 ">
                            <div class="tab-content w-100" id="myTabContent">
                                <div class="tab-pane fade active show" id="requirements" role="tabpanel" aria-labelledby="requirments-tab">
                                    <div class="heading theme-text    p-10  d-felx justify-content-center text-center ">
                                        @if($bidding->status == \App\Enums\BidEnums::$STATUS['lost'])
                                            <div class="d-flex   justify-content-center  pb-0">
                                                <div class="alert">
                                                    <img src="{{asset('static/vendor/images/error.svg')}}">
                                                    <p>Sorry, you lost this bid.</p>
                                                </div>
                                            </div>
                                            <div class="d-flex  justify-content-center ">
                                                <div class="position-graph">
                                                    <h5>Below chart shows your position along with others</h5>
                                                    <img src="{{asset('static/vendor/images/Group 14409.svg')}}">
                                                    <div class="d-flex justify-content-between status-badge secondg-bg current-position">
                                                        <div > Your Position</div>
                                                        <div class="bold">4th </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border-top-3">
                                                <div class="d-flex justify-content-end p-15 pt-0">
                                                    <a href="{{route('vendor.dashboard')}}"><button class="btn">Go To Home</button></a>
                                                </div>
                                            </div>
                                        @elseif($bidding->status == \App\Enums\BidEnums::$STATUS['bid_submitted'])
                                            <div class=" d-flex justify-content-center status-badge info-message">
                                                <div class="">
                                                    <i class="p-1"><img src="{{asset('static/vendor/images/Icon feather-info.svg')}}" alt="" srcset=""></i>
                                                    Your Price is clashing with other bidders. We suggest you to rebid. </div>
                                            </div>
                                            <div class="p-15 ">
                                                <div class="d-felx justify-content-around row  ">
                                                    <div class="bid-badge">
                                                        <h4 class="">₹ {{$bidding->bid_amount}}</h4>
                                                        <p>Current Bid Price</p>
                                                    </div>
                                                    <div class="bid-badge">
                                                        <h4 class=""><span class="text-center timer f-24" data-time="{{$booking->bid_result_at}}" style="min-width: 0px !important;"></span></h4>
                                                        <p>Time Left</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between  detail-order">
                                                    <div class="data">ORDER ID</div>
                                                    <div class="value">#{{$booking->public_booking_id}}</div>
                                                </div>
                                                <div class="d-flex justify-content-between detail-order">
                                                    <div class="data">MOVING DATE</div>
                                                    <div class="value">{{date("d M Y", strtotime(json_decode($bidding->meta, true)['moving_date']))}}</div>
                                                </div>
                                                <div class="d-flex justify-content-between detail-order">
                                                    <div class="data">CATEGORY</div>
                                                    <div class="value">{{$booking->service->name}}</div>
                                                </div>
                                                {{-- <div class="d-flex justify-content-between detail-order  grand-total secondg-bg">
                                                                 <div class="data">LAST QUOTED PRICE</div>
                                                                 <div class="value">Rs. 5000</div>
                                                 </div>--}}
                                            </div>
                                            <div class="p-15 border-top">
                                                <div class="d-flex justify-content-end ">
                                                    <div class="w-30  d-flex justify-content-end">
                                                        <a href="{{route('vendor.detailsbookings', ['id'=>$booking->public_booking_id])}}"><button class="btn w-100" >Rebid</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
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
