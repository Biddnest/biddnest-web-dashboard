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
                            <li class="nav-item">
                                <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-bidding', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Bidding</a>
                            </li>
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
                                  Customer Name
                                </div>
                                <div class="theme-text f-14 bold p-15">
                                  Customer Phone
                                </div>
                                <br />
                                <div class="theme-text f-14 bold p-15">
                                  Customer Email
                                </div>

                                <div class="theme-text f-14 bold p-15">
                                  From Address
                                </div>
                                <br />
                                <div class="theme-text f-14 bold p-15">
                                  To Address
                                </div>
                                <br />
                                <div class="theme-text f-14 bold p-15">
                                    Delivery Distance
                                </div>

                                <div class="theme-text f-14 bold p-15">
                                  Order Amount
                                </div>

                                <div class="theme-text f-14 bold p-15">
                                  Booking Status
                                </div>
                            </div>

                            <div class="col-sm-7 white-bg  margin-topneg-15 pt-10">
                                <div class="theme-text f-14 p-15">
                                  {{$booking->public_booking_id}}
                                </div>
                                <div class="theme-text f-14 p-15">
                                 {{json_decode($booking->contact_details,true)['name'] }}
                                </div>
                                <div class="theme-text f-14 p-15">
                                 {{json_decode($booking->contact_details,true)['phone'] }}
                                </div>
                                <div class="theme-text f-14 p-15">
                                 {{json_decode($booking->contact_details,true)['email'] }}
                                </div>
                                <div class="theme-text f-14 p-15">
                                    @php $source =  json_decode($booking->source_meta,true); @endphp
                                    Floor: {{$source['floor']}}, {{$source['address']}}. @if($source['lift'] == 1) Lift is available.@else Lift is not available. @endif
                                </div>
                                <div class="theme-text f-14 p-15">
                                    @php $source =  json_decode($booking->destination_meta,true); @endphp
                                    Floor: {{$source['floor']}}, {{$source['address']}}. @if($source['lift'] == 1) Lift is available. @else Lift is not available. @endif
                                </div>
                                <div class="theme-text f-14 p-15">
                                    {{ json_decode($booking->meta, true)['distance'] }}Kms
                                </div>
                                <div class="theme-text f-14 p-15">
                                    &#8377;{{$booking->final_quote}}
                                </div>

                                <div class="theme-text f-14 p-15">
                                    @switch($booking->status)
                                        @case(\App\Enums\BookingEnums::$STATUS['enquiry'])
                                        <span class="status-badge info-bg  text-center td-padding">Enquiry</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['placed'])
                                        <span class="status-badge yellow-bg  text-center td-padding">Placed</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['biding'])
                                        <span class="status-badge green-bg  text-center td-padding">Bidding</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['rebiding'])
                                        <span class="status-badge grey-bg  text-center td-padding">Rebidding</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['payment_pending'])
                                        <span class="status-badge secondg-bg  text-center td-padding">Payment Pending</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['pending_driver_assign'])
                                        <span class="status-badge secondg-bg  text-center td-padding">Pending Driver Assign</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['awaiting_pickup'])
                                        <span class="status-badge blue-bg  text-center td-padding">Awaiting Pickup</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['in_transit'])
                                        <span class="status-badge icon-bg  text-center td-padding">In Transit</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['completed'])
                                        <span class="status-badge green-bg  text-center td-padding">Completed</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['cancelled'])
                                        <span class="status-badge red-bg  text-center td-padding">Cancelled</span>
                                        @break
                                    @endswitch
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
                        @if(count($booking->inventories)== 0)
                            <div class="row hide-on-data">
                                <div class="col-md-12 text-center p-20">
                                    <p class="font14"><i>. You don't have any Inventories here.</i></p>
                                </div>
                            </div>
                        @endif
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
