@extends('vendor-panel.layouts.frame')
@section('title') Order Details @endsection
@section('body')

    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="orderdetail">
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
            <div class="col-lg-10">
                <div class="card h-auto p-0 pt-20">
                    <div class="tab-pane fade  active show" id="order-status" role="tabpanel" aria-labelledby="order-status-tab">
                        <div class="p-15">
                            <div class="d-flex p-10" style="margin-bottom: 30px; margin-left: -40px; ">
                                <div class="steps-container mr-5 pr-5">
                                    <hr class="dash-line" style="width: 88%; margin-left: 78px;" >
                                    @foreach(array_slice(\App\Enums\BookingEnums::$STATUS, 0, 9) as $key=>$status)
                                        <div class="steps-status " style="width: 10%; text-align: center; padding-left: 35px;">
                                            <div class="step-dot">
                                                {{--                                @foreach($booking->status_ids as $status_history)--}}
                                                @if(in_array($status, $booking->status_ids))
                                                    <img src="{{ asset('static/images/tick.png')}}" />
                                                @else
                                                    <div class="child-dot"></div>
                                                @endif
                                                {{--                                @endforeach--}}
                                            </div>
                                            <p class="step-title">{{ ucwords(str_replace("_"," ", $key))  }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @if($booking->bid->status != \App\Enums\BidEnums::$STATUS['bid_submitted'] || $booking->bid->status != \App\Enums\BidEnums::$STATUS['active'])
                                <div class="d-felx justify-content-center pt-4 border-top row">
                                    <div class="bid-badge mr-4">
                                        <h4 class="step-title">₹ {{$booking->final_estimated_quote}}</h4>
                                        <p>Estimated Price</p>
                                    </div>
                                    <div class="bid-badge mr-4">
                                        <h4 class="step-title"><span class="text-center timer" data-time="{{$booking->bid_result_at}}" style="min-width: 0px !important;"></span></h4>
                                        <p>Time Left</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="d-flex  border-bottom pb-0">
                            <ul class="nav nav-tabs pt-20 p-0 f-18" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="new-order-tab" data-toggle="tab" href="{{route('vendor.detailsbookings',['id'=>$booking->public_booking_id])}}" role="tab" aria-controls="home" aria-selected="true">Order Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active show" id="requirments-tab" href="{{route('vendor.requirment-order',['id'=>$booking->public_booking_id])}}">Item List</a>
                                </li>
                                @if($booking->bid->status = \App\Enums\BidEnums::$STATUS['bid_submitted'])
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.my-quote',['id'=>$booking->public_booking_id])}}">My Quote</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.my-bid',['id'=>$booking->public_booking_id])}}">My Bid</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="requirments-tab" href="#">Schedule</a>
                                    </li>
                                @elseif($booking->bid->status == \App\Enums\BidEnums::$STATUS['payment_pending'])
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="requirments-tab" href="{{route('vendor.my-quote',['id'=>$booking->public_booking_id])}}">My Quote</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.my-bid',['id'=>$booking->public_booking_id])}}">My Bid</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " id="requirments-tab" href="{{route('vendor.schedule-order',['id'=>$booking->public_booking_id])}}">Schedule</a>
                                    </li>
                                    {{--<li class="nav-item">
                                        <a class="nav-link disabled" id="requirments-tab" href="#">Driver Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="requirments-tab" href="#">In Transit</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="requirments-tab" href="#">Complete/Cancel</a>
                                    </li>--}}
                                @elseif($booking->bid->status = \App\Enums\BidEnums::$STATUS['won'] && ($booking->status > \App\Enums\BookingEnums::$STATUS['payment_pending'] && $booking->status < \App\Enums\BookingEnums::$STATUS['in_transit'] ))
                                    {{-- <li class="nav-item">
                                         <a class="nav-link disabled" id="requirments-tab" href="{{route('vendor.requirment-order',['id'=>$booking->public_booking_id])}}">My Quote</a>
                                     </li>--}}
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.my-bid',['id'=>$booking->public_booking_id])}}">My Bid</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.schedule-order',['id'=>$booking->public_booking_id])}}">Schedule</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.driver-details',['id'=>$booking->public_booking_id])}}">Driver Details</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                         <a class="nav-link disabled" id="requirments-tab" href="#">In Transit</a>
                                     </li>
                                     <li class="nav-item">
                                         <a class="nav-link disabled" id="requirments-tab" href="#">Complete</a>
                                     </li>--}}

                                @elseif($booking->bid->status = \App\Enums\BidEnums::$STATUS['won'] && $booking->status == \App\Enums\BookingEnums::$STATUS['in_transit'])
                                    {{-- <li class="nav-item">
                                         <a class="nav-link disabled" id="requirments-tab" href="#">My Quote</a>
                                     </li>--}}
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.my-bid',['id'=>$booking->public_booking_id])}}">My Bid</a>
                                    </li>
                                    {{--<li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.requirment-order',['id'=>$booking->public_booking_id])}}">Schedule</a>
                                    </li>--}}
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="requirments-tab" href="{{route('vendor.driver-details',['id'=>$booking->public_booking_id])}}">Driver Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.in-transit',['id'=>$booking->public_booking_id])}}">In Transit</a>
                                    </li>
                                    {{--<li class="nav-item">
                                        <a class="nav-link disabled" id="requirments-tab" href="{{route('vendor.requirment-order',['id'=>$booking->public_booking_id])}}">Complete</a>
                                    </li>--}}
                                @elseif($booking->bid->status = \App\Enums\BidEnums::$STATUS['won'] && ($booking->status == \App\Enums\BookingEnums::$STATUS['completed'] || $booking->status == \App\Enums\BookingEnums::$STATUS['cancelled']))
                                    {{-- <li class="nav-item">
                                         <a class="nav-link disabled" id="requirments-tab" href="{{route('vendor.requirment-order',['id'=>$booking->public_booking_id])}}">My Quote</a>
                                     </li>--}}
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.my-bid',['id'=>$booking->public_booking_id])}}">My Bid</a>
                                    </li>
                                    {{--<li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.requirment-order',['id'=>$booking->public_booking_id])}}">Schedule</a>
                                    </li>--}}
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.driver-details',['id'=>$booking->public_booking_id])}}">Driver Details</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                         <a class="nav-link" id="requirments-tab" href="{{route('vendor.requirment-order',['id'=>$booking->public_booking_id])}}">In Transit</a>
                                     </li>--}}
                                    <li class="nav-item">
                                        <a class="nav-link" id="requirments-tab" href="{{route('vendor.complete-order',['id'=>$booking->public_booking_id])}}">Complete</a>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        <div class="d-flex">
                            <div class="tab-content w-100" id="myTabContent">
                                <div class="tab-pane fade show" id="requirements" role="tabpanel" aria-labelledby="requirments-tab">
                                    <div class="heading theme-text    p-10  row">
                                        <div class="col-sm-6 " style="margin:0px  !important">
                                            <div class="row ml-10 mt-2">Category:
                                                <div class="bold "> {{$booking->service->name}}</div> </div>
                                            <table class="table text-center  theme-text grey-br mtop-5 p-10">
                                                <thead class="secondg-bg  p-10 f-14">
                                                <tr>
                                                    <th scope="col">Item</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Size</th>
                                                </tr>
                                                </thead>
                                                <tbody class="mtop-15">
                                                @foreach($booking->inventories as $inventory)
                                                    <tr class="tb-border  cursor-pointer">
                                                        <th scope="row">{{$inventory->name}}</th>
                                                        <td class="text-center">
                                                            @if($inventory->quantity_type != \App\Enums\CommonEnums::$YES)
                                                                {{$inventory->quantity}}
                                                            @else
                                                                {{$inventory->quantity->min}}-{{$inventory->quantity->max}}
                                                            @endif
                                                        </td>
                                                        <td class=""><span class=" text-center w-100  ">{{$inventory->size}}</span></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-6  mt-2 ">
                                            Pictures uploaded by the customer
                                            <div class="row d-felx mr-2 justify-content-start  mt-2">
                                                @foreach(json_decode($booking->meta, true)['images'] as $image)
                                                    <div class="col-sm-3">
                                                        <img src="{{$image}}" style="width: 100%;">
                                                    </div>
                                                @endforeach
                                                @if(count(json_decode($booking->meta, true)['images'])== 0)
                                                    <div class="row hide-on-data">
                                                        <div class="col-md-12 text-center p-20">
                                                            <p class="font14"><i>. You don't have any Images here.</i></p>
                                                        </div>
                                                    </div>
                                                @endif
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
