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
                    <li class="breadcrumb-item"><a href="{{route('orders-booking')}}">Booking & Orders</a></li>

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
                          <ul class="nav nav-tabs p-0 flex-row" id="myTab" role="tablist" style="font-weight:600; margin-left: -6px;">
                            <li class="nav-item ">
                              <a class="nav-link active p-15" id="customer-details-tab" data-toggle="tab" href="#customer-details" role="tab" aria-controls="home" aria-selected="true">Customer Details</a>
                            </li>
                              @if($booking->status == \App\Enums\BookingEnums::$STATUS['enquiry'])
                                  <li class="nav-item">
                                      <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-estimate', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Action</a>
                                  </li>
                              @endif
                            <li class="nav-item">
                                <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-vendor', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Vendor Details</a>
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
                        <div class="d-flex  row  match-height  p-15 pb-0" >
                            <div class="col-sm-4 match-item secondg-bg margin-topneg-15 pt-10">
                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                  Order ID
                                </div>
                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                  Customer Name
                                </div>
                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                  Customer Phone
                                </div>
                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                  Customer Email
                                </div>
                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                  From Address
                                </div>
                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                  To Address
                                </div>
                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                    Delivery Distance
                                </div>
                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                  Order Amount
                                </div>
                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                  Booking Status
                                </div>
                            </div>

                            <div class="col-sm-8  match-item white-bg  margin-topneg-15 pt-10">
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                    @if($booking->status > \App\Enums\BookingEnums::$STATUS['payment_pending'])
                                        {{$booking->public_booking_id}}
                                    @else
                                        {{$booking->public_enquiry_id}}
                                    @endif
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                 {{json_decode($booking->contact_details,true)['name'] }}
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;"><span>+91</span>
                                 {{json_decode($booking->contact_details,true)['phone'] }}
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                 {{json_decode($booking->contact_details,true)['email'] }}
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                    @php $source =  json_decode($booking->source_meta,true); @endphp
                                    Floor: {{$source['floor']}}, {{$source['address']}}. @if($source['lift'] == 1) Lift is available.@else Lift is not available. @endif
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                    @php $source =  json_decode($booking->destination_meta,true); @endphp
                                    Floor: {{$source['floor']}}, {{$source['address']}}. @if($source['lift'] == 1) Lift is available. @else Lift is not available. @endif
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                    {{ json_decode($booking->meta, true)['distance'] }}Kms
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                    &#8377;@if($booking->final_quote){{$booking->final_quote}} @else {{$booking->final_estimated_quote}} @endif
                                </div>

                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                    @switch($booking->status)
                                        @case(\App\Enums\BookingEnums::$STATUS['enquiry'])
                                        <span class="status-badge info-bg  text-center td-padding" style="font-weight:bold !important">Enquiry</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['placed'])
                                        <span class="status-badge yellow-bg  text-center td-padding" style="font-weight:bold !important">Placed</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['biding'])
                                        <span class="status-badge green-bg  text-center td-padding" style="font-weight:bold !important">Bidding</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['rebiding'])
                                        <span class="status-badge light-bg  text-center td-padding" style="font-weight:bold !important">Rebidding</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['payment_pending'])
                                        <span class="status-badge secondg-bg  text-center td-padding" style="font-weight:bold !important">Payment Pending</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['pending_driver_assign'])
                                        <span class="status-badge secondg-bg  text-center td-padding" style="font-weight:bold !important">Pending Driver Assign</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['awaiting_pickup'])
                                        <span class="status-badge blue-bg  text-center td-padding" style="font-weight:bold !important">Awaiting Pickup</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['in_transit'])
                                        <span class="status-badge icon-bg  text-center td-padding" style="font-weight:bold !important">In Transit</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['completed'])
                                        <span class="status-badge green-bg  text-center td-padding" style="font-weight:bold !important">Completed</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['cancelled'])
                                        <span class="status-badge red-bg  text-center td-padding" style="font-weight:bold !important">Cancelled</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['hold'])
                                        <span class="status-badge red-bg  text-center td-padding" style="font-weight:bold !important">On Hold</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['bounced'])
                                        <span class="status-badge red-bg  text-center td-padding" style="font-weight:bold !important">Bounced</span>
                                        @break

                                        @case(\App\Enums\BookingEnums::$STATUS['cancelrequest'])
                                        <span class="status-badge red-bg  text-center td-padding" style="font-weight:bold !important">Request To Cancel</span>
                                        @break
                                    @endswitch
                                </div>



                           {{-- <div class="d-flex  mtop-5">
                                <i class="icon dripicons-pencil p-1 cursor-pointer " aria-hidden="true"></i> <a href="{{route('order-details',["id"=>$booking->id])}}" class="ml-1 text-decoration-none primary-text">Edit</a>
                            </div>--}}
                        </div>
                            <div class="col-sm-12 pl-0 pr-0 ">
                                <div class="heading f-16 p-10 pl-4 border-around ">
                                  Inventory List
                                </div>
                        <table class="table text-center p-10 theme-text tb-border2">
                            <thead class="secondg-bg bx-shadowg p-0 f-14">
                                <tr>
                                  <th scope="col" style="    width: 50%; padding-left: 15px !important;">Item Name</th>
                                  <th scope="col" style="    width: 50%;" >Quantity</th>
                                  <th scope="col" style="    text-align: center !important;">Size</th>
                                </tr>
                            </thead>
                            <tbody class="mtop-15">
                                @foreach($booking->inventories as $inventory)
                                    <tr class="tb-border  cursor-pointer">
                                      <th scope="row" style="padding-left: 15px !important;">{{$inventory->name}}</th>
                                      <td  class="text-center">
                                          @if($inventory->quantity_type == \App\Enums\BookingInventoryEnums::$QUANTITY['fixed'])
                                            {{$inventory->quantity}}
                                          @else
                                            {{json_decode($inventory->quantity, true)['min']}}-{{json_decode($inventory->quantity, true)['max']}}
                                          @endif
                                      </td>
                                      <td class=""><span class=" status-badge text-center f-14" style="font-weight: bold !important;text-transform: capitalize;">{{$inventory->size}}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>

                        @if(count($booking->inventories)== 0)
                            <div class="row hide-on-data">
                                <div class="col-md-12 text-center p-20">
                                    <p class="font14"><i>. You don't have any Inventories here.</i></p>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12 border-top-3">
                            <div class="d-flex justify-content-end">
                                @if($booking->status == \App\Enums\BookingEnums::$STATUS['enquiry'])
                                    <a class="white-text p-10" href="{{route('order-details-estimate', ['id'=>$booking->id])}}"><button  class="btn white-text theme-bg" style="padding: 10px 60px;">Next</button></a>
                                @else
                                    <a class="white-text p-10" href="{{route('order-details-vendor', ['id'=>$booking->id])}}"><button  class="btn white-text theme-bg" style="padding: 10px 60px;">Next</button></a>
                                @endif
                            </div>
                        </div>
                        <!-- <div class="border-top-3">
                            <div class="d-flex justify-content-between">
                                <div class="w-100">
                                    {{--<a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Back</button></a>--}}
                                </div>
                                <div class="margin-r-20">
                                    <div class="d-flex justify-content-end">
                                        <a class="white-text p-10" href="{{route('order-details-vendor', ['id'=>$booking->id])}}"><button  class="btn white-text theme-bg">Next</button></a>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
