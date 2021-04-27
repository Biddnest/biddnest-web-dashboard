@extends('layouts.app')
@section('title') Orders And Bookings @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="orderdetails">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4">Order Details</h3>
    </div>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left p-4 pt-0 pb-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="booking-orders.html">Booking & Orders</a></li>

                    <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                </ol>
            </nav>
        </div>
    </div>

              <!-- Dashboard cards -->

    <div class="row">
        <div class="col-md-12" style="padding: 0px 40px; border: none;">
            <div class="card" style="border:none;">
                <div class="card-body" style="padding: 20px;">
                    <hr class="dash-line">
                    <div class="steps-container">
                        @foreach(\App\Enums\BookingEnums::$STATUS as $key=>$status)
                            <div class="steps-status " style="width: 10%; text-align: center;">
                                <div class="step-dot">
                                    {{-- @foreach($booking->status_ids as $status_history)--}}
                                    @if(in_array($status, $booking->status_ids))
                                        <img src="{{ asset('static/images/tick.png')}}" />
                                    @else
                                        <div class="child-dot"></div>
                                    @endif
                                    {{--@endforeach--}}
                                </div>
                                <p class="step-title">{{ ucwords(str_replace("_"," ", $key))  }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-row  Dashboard-lcards  justify-content-center">
        <div class="col">
            <div class="card  h-auto p-0 " >
                <div class="card-head right text-center  pb-0 p-05" style="padding-top: 0">
                    <h3 class="f-18" style="margin-top: 0;">
                        <ul class="nav nav-tabs p-0 flex-row" id="myTab" role="tablist">
                            <li class="nav-item ">
                                <a class="nav-link active p-15" id="customer-details-tab" data-toggle="tab" href="{{route('order-details', ['id'=>$booking->id])}}" role="tab" aria-controls="home" aria-selected="true">Customer</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-vendor', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Vendor</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-quotation', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Quotation</a>
                            </li>
                           {{-- <li class="nav-item">
                                <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-bidding', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Bidding</a>
                            </li>--}}
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation-tab" data-toggle="tab" href="{{route('order-details-payment', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Payment</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="review-tab" data-toggle="tab" href="{{route('order-details-review', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Review</a>
                            </li>
                        </ul>
                    </h3>
                </div>
                <div class="tab-content border-top margin-topneg-7" id="myTabContent">
                    <div class="tab-pane fade show active" id="customer-details" role="tabpanel" aria-labelledby="customer-details-tab">
                        <div class="d-flex  row p-15 pb-0" >
                            <div class="col-sm-4 secondg-bg margin-topneg-15 pt-10">
                                <div class="theme-text f-14 bold p-15">
                                  Order ID
                                </div>
                                <div class="theme-text f-14 bold p-15">
                                  Vendor Name
                                </div>
                                <div class="theme-text f-14 bold p-15">
                                  Vendor Details
                                </div>
                                <div class="theme-text f-14 bold p-15">
                                  Driver Name
                                </div>
                                <div class="theme-text f-14 bold p-15">
                                  Driver Email
                                </div>
                                <div class="theme-text f-14 bold p-15">
                                  Timer Value
                                </div>
                                <div class="theme-text f-14 bold p-15">
                                  Order Status
                                </div>
                                <div class="theme-text f-14 bold p-15">
                                  Order Amount
                                </div>
                                <div class="theme-text f-14 bold p-15">
                                  Address
                                </div>
                            </div>

                            <div class="col-sm-7 white-bg  margin-topneg-15 pt-10">
                                <div class="theme-text f-14 p-15">
                                  {{$booking->public_booking_id}}
                                </div>
                                <div class="theme-text f-14 p-15">
                                 @if($booking->organization){{ucfirst(trans($booking->organization->org_name))}} {{ucfirst(trans($booking->organization->org_type))}} @endif
                                </div>
                                <div class="theme-text f-14 p-15">
                                    @if($booking->organization){{$booking->organization->email}}@endif
                                </div>
                                <div class="theme-text f-14 p-15">
                                    @if($booking->driver){{ucfirst(trans($booking->driver->fname))}} {{ucfirst(trans($booking->driver->lname))}} @endif
                                </div>
                                <div class="theme-text f-14 p-15">
                                    @if($booking->driver){{$booking->driver->email}}@endif
                                </div>
                                <div class="theme-text f-14 p-15">
                                    @if(\App\Enums\BookingEnums::$STATUS['biding']==$booking->status ||  \App\Enums\BookingEnums::$STATUS['rebiding']==$booking->status)
                                        {{\Carbon\Carbon::now()->diffForHumans($booking->bid_result_at)}}
                                    @else
                                        Bidding Done
                                    @endif
                                </div>
                                <div class="theme-text f-14 p-15 status-badge text-center  ">
                                  @foreach(\App\Enums\BookingEnums::$STATUS as $key=>$status)
                                      @foreach($booking->status_hist as $history)
                                          @if($status == $history->$status)
                                            {{ucfirst(trans($key))}}
                                          @endif
                                      @endforeach
                                  @endforeach
                                </div>
                                <div class="theme-text f-14 p-15 mt-2">
                                  ₹  @if($booking->final_quote){{$booking->final_quote}}@else{{$booking->final_estimated_quote}}@endif
                                </div>
                                <div class="theme-text f-14 p-15 ">
                                  {{json_decode($booking->source_meta, true)['address']}} To {{json_decode($booking->destination_meta, true)['address']}}
                                </div>
                            </div>

                           {{-- <div class="d-flex  mtop-5">
                                <i class="icon dripicons-pencil p-1 cursor-pointer " aria-hidden="true"></i> <a href="{{route('order-details',["id"=>$booking->id])}}" class="ml-1 text-decoration-none primary-text">Edit</a>
                            </div>--}}
                        </div>

                        <div class="d-flex  row  p-15 pt-0 ">
                            <div class="col-sm-12 border-top-pop">
                                <div class="theme-text f-14 bold pt-10">
                                  Inventory List
                                </div>
                            </div>
                        </div>
                        <table class="table text-center p-10 theme-text">
                            <thead class="secondg-bg  p-0 f-14">
                                <tr>
                                  <th scope="col">Item Name</th>
                                  <th scope="col" >Quantity</th>
                                  <th scope="col" >Size</th>
                                </tr>
                            </thead>
                            <tbody class="mtop-15">
                                @foreach($booking->inventories as $inventory)
                                    <tr class="tb-border  cursor-pointer">
                                      <th scope="row">{{$inventory->name}}</th>
                                      <td  class="text-center">{{$inventory->quantity}}</td>
                                      <td class=""><span class=" status-badge">{{$inventory->size}}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="border-top-3">
                            <div class="d-flex justify-content-between">
                                <div class="w-100">
                                    {{--<a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Back</button></a>--}}
                                </div>
                                <div class="w-100 margin-r-20">
                                    <div class="d-flex justify-content-end">
                                        <a class="white-text p-10" href="{{route('order-details-vendor', ['id'=>$booking->id])}}"><button  class="btn white-text theme-bg">Next</button></a>
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
