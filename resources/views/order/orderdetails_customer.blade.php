@extends('layouts.app')
@section('title') Orders And Bookings @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="orderdetails">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4">Order Details</h3>
        @if(($booking->status == \App\Enums\BookingEnums::$STATUS['enquiry']) || ($booking->status == \App\Enums\BookingEnums::$STATUS['in_progress']))
            <div class="mr-20">
                <a href="{{ route('edit-order', ['id'=>$booking->public_booking_id])}}">
                    <button class="btn theme-bg white-text" ><i class="fa fa-pencil p-1" aria-hidden="true"></i> Edit order</button>
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
    <div class="d-flex flex-row text-left ml-25 pb-25">
        <a href="{{route('orders-booking')}}" class="text-decoration-none">
            <h3 class="page-subhead text-left f-18" style="margin-top: 10px; !important; color: #2e0789;">
                <i class="p-1">
                    <img src="{{asset('static/images/Icon feather-chevrons-left.svg')}}" alt="" srcset="">
                </i> Back to Bookings & Orders
            </h3>
        </a>
    </div>
              <!-- Dashboard cards -->

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
    <div class="d-flex flex-row  Dashboard-lcards  justify-content-center">
                <div class="col">
                  <div class="card  h-auto p-0 " >
                      <div class="card-head right text-center  pb-0 p-05" style="padding-top: 0">
                        <h3 class="f-18" style="margin-top: 0;">
                          <ul class="nav nav-tabs p-0 flex-row" id="myTab" role="tablist" style="font-weight:600; margin-left: -6px;">
                            <li class="nav-item ">
                              <a class="nav-link active p-15" id="customer-details-tab" data-toggle="tab" href="#customer-details" role="tab" aria-controls="home" aria-selected="true">Details</a>
                            </li>
                              @if($booking->status == \App\Enums\BookingEnums::$STATUS['enquiry'])
                                  <li class="nav-item">
                                      <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-estimate', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Action</a>
                                  </li>
                              @endif
                            <li class="nav-item">
                                <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-vendor', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Vendor</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-quotation', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Payment</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-bidding', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Bidding</a>
                            </li>
                            {{-- @if($booking->status == \App\Enums\BookingEnums::$STATUS['price_review_pending'])
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-bidding-review', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Bidding Review</a>
                                </li>
                            @endif --}}
                           {{-- <li class="nav-item">
                                <a class="nav-link p-15" id="quotation-tab" data-toggle="tab" href="{{route('order-details-payment', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Payment</a>
                            </li>--}}
                            <li class="nav-item">
                                <a class="nav-link p-15" id="review-tab" data-toggle="tab" href="{{route('order-details-review', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Review</a>
                            </li>

                            <li class="nav-item">
                              <a class="nav-link p-15" id="cancel-tab" data-toggle="tab" href="{{route('order-details-cancel', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Cancel</a>
                          </li>

                        </ul>
                    </h3>
                </div>
                <div class="tab-content border-top margin-topneg-7" id="myTabContent">
                    <div class="tab-pane fade show active" id="customer-details" role="tabpanel" aria-labelledby="customer-details-tab">
                        <div class="d-flex  row  match-height  p-15 pb-0" >
                            <div class="col-sm-4 match-item secondg-bg margin-topneg-15 pt-10">
                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                  Assigned Virtual Assistant
                                </div>

                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                  Order ID
                                </div>


                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                  Booked On
                                </div>
                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                  Booked By
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
                                  Category
                                </div>
                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                  Package
                                </div>
                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                  Movement Type
                                </div>
                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                    User Provided Dates
                                </div>
                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                    Instructions/Notes by Customer
                                </div>
                                @if($booking->bid)
                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                    Confirmed Movement Date by Vendor
                                </div>
                                @endif
                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                  Price suggested to Customer
                                </div>
                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                  Booking Status
                                </div>

                                @if(in_array($booking->status,[\App\Enums\BookingEnums::$STATUS['cancel_request'],\App\Enums\BookingEnums::$STATUS['cancelled'],\App\Enums\BookingEnums::$STATUS['bounced']]))
                                <div class="theme-text f-14  bold p-15 pl-0" style="padding-top: 5px;">
                                  Cancellation Reason
                                </div>

                                <div class="theme-text f-14 bold p-15 pl-0" style="padding-top: 5px;">
                                  Cancellation Description
                                </div>
                                @endif

                            </div>

                            <div class="col-sm-8  match-item white-bg  margin-topneg-15 pt-10">
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">

                                    <form class="form-inline" method="POST" action="{{route("api.va.assign")}}" data-next="nothing" data-alert="tiny" data-parsley-validate>
                                        <input type="hidden" name="booking_id" value="{{$booking->id}}" />
                                        <select name="admin_id" class="form-control mb-2 mr-sm-2">
                                            <option value="">--Select--</option>

                                            @foreach($virtual_assistants as $va)

                                                <option value="{{$va->id}}" @if($booking->virtual_assistant && ($booking->virtual_assistant->id == $va->id)) selected @endif>{{$va->fname}} {{$va->lname}}</option>

                                            @endforeach
                                        </select>

                                        <button type="submit" class="btn theme-bg  mb-2" style="margin: 0;padding: 5px 9px;"><i class="icon dripicons-checkmark" style="font-size: 18px; font-weight: bold;"></i></button>
                                    </form>
                                </div>

                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                    @if(in_array($booking->status,[
                                        \App\Enums\BookingEnums::$STATUS['pending_driver_assign'],
                                        \App\Enums\BookingEnums::$STATUS['awaiting_pickup'],
                                        \App\Enums\BookingEnums::$STATUS['in_transit'],
                                        \App\Enums\BookingEnums::$STATUS['completed'],
                                        \App\Enums\BookingEnums::$STATUS['cancelled'],
                                    ]))
                                        {{$booking->public_booking_id}}
                                    @else
                                        {{$booking->public_enquiry_id}}
                                    @endif
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                  {{\Carbon\Carbon::parse($booking->created_at)->format("h:i A, d M Y")}}
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                 @if((bool)json_decode($booking->meta,true)['self_booking'])
                                 <a href="#0" data-sidebar="{{ route('sidebar.customer',['id'=>$booking->user->id]) }}" class="sidebar-toggle-link cursor-pointer underline">{{$booking->user->fname}} {{$booking->user->lname}}</a> (self)
                                 @else
                                        <a href="#0" data-sidebar="{{ route('sidebar.customer',['id'=>$booking->user->id]) }}" class="sidebar-toggle-link cursor-pointer underline">{{$booking->user->fname}} {{$booking->user->lname}}</a> (booked for friend)
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
                                    @if($booking->source_meta)
                                        @php $source =  json_decode($booking->source_meta,true); @endphp
                                        Floor: {{$source['floor'] ?? ''}}, {{$source['address'] ?? ''}}. @if($source['lift'] && $source['lift'] == 1) Lift is available.@else Lift is not available. @endif
                                    @else
                                    -
                                    @endif
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                    @if($booking->destination_meta)
                                        @php $dest =  json_decode($booking->destination_meta,true); @endphp
                                        Floor: {{$dest['floor'] ?? ''}}, {{$dest['address'] ?? ''}}. @if($dest['lift'] && $dest['lift'] == 1) Lift is available. @else Lift is not available. @endif
                                    @else - @endif
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                    {{ json_decode($booking->meta, true)['distance'] ?? '-'}}Kms
                                </div>

                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                    {{ $booking->service->name }} @isset(json_decode($booking->meta,
                                    true)['subcategory']) - {{json_decode($booking->meta,
                                    true)['subcategory']}} @endisset
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                    @isset($booking->booking_type)
                                        @if($booking->booking_type == \App\Enums\BookingEnums::$BOOKING_TYPE['economic'])
                                            Economic
                                        @else
                                            Premium
                                        @endif
                                    @else - @endif
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                    @if(json_decode($booking->source_meta, true)['shared_service']== false)Dedicated @else Shared @endif
                                </div>

                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                    @foreach(json_decode($booking->movement_dates, true) as $mdate)
                                        <span class="status-3" style="margin-right: 5px;">{{date("d M Y", strtotime($mdate['date']))}}</span>
                                    @endforeach
                                </div>

                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                    <i>"{{ json_decode($booking->meta, true)['customer']['remarks'] }}"</i>

                                </div>

                                @if($booking->bid)
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">

                                        {{date("d M Y", strtotime($booking->final_moving_date)}}
                                </div>
                                @endif

                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">

                                    @if($booking->final_quote)
                                        @if($booking->final_quote)&#8377;{{$booking->final_quote}} @else &#8377;{{$booking->final_estimated_quote}} @endif
                                    @else - @endif
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
                                        <span class="status-badge text-center td-padding" style="font-weight:bold !important">In Transit</span>
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

                                        @case(\App\Enums\BookingEnums::$STATUS['cancel_request'])
                                        <span class="status-badge red-bg  text-center td-padding" style="font-weight:bold !important">Request To Cancel</span>
                                        @break
                                        @case(\App\Enums\BookingEnums::$STATUS['in_progress'])
                                        <span class=" text-center status-badge red-bg">In Progress</span>
                                        @break;

                                        @case(\App\Enums\BookingEnums::$STATUS['awaiting_bid_result'])
                                        <span class=" text-center status-badge red-bg">Awaiting Bid Result</span>
                                        @break;

                                        @case(\App\Enums\BookingEnums::$STATUS['price_review_pending'])
                                        <span class=" text-center status-badge red-bg">Price Review Pending</span>
                                        @break;
                                    @endswitch
                                </div>

                                @if(in_array($booking->status,[\App\Enums\BookingEnums::$STATUS['cancel_request'],\App\Enums\BookingEnums::$STATUS['cancelled'],\App\Enums\BookingEnums::$STATUS['bounced']]))
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                    {{json_decode($booking->cancelled_meta, true)['reason'] ?? "-"}}
                                </div>

                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                    {{json_decode($booking->cancelled_meta, true)['desc'] ?? "-"}}
                                </div>
                                @endif

                           {{-- <div class="d-flex  mtop-5">
                                <i class="icon dripicons-pencil p-1 cursor-pointer " aria-hidden="true"></i> <a href="{{route('order-details',["id"=>$booking->id])}}" class="ml-1 text-decoration-none primary-text">Edit</a>
                            </div>--}}
                        </div>
                            <div class="col-sm-6 pl-0 pr-0 " style="padding:5px">
                                <div class="heading f-16 p-10 pl-4 border-around ">
                                  Inventory List
                                </div>
                        <table class="table text-center p-10 theme-text tb-border2">
                            <thead class="secondg-bg bx-shadowg p-0 f-14">
                                <tr>
                                  <th scope="col" style="width: 50%; padding-left: 15px !important;">Item Name</th>
                                  <th scope="col" style="width: 50%;" >Quantity</th>
                                  <th scope="col" style="text-align: center !important;">Size</th>
                                </tr>
                            </thead>
                            <tbody class="mtop-15">
                                @foreach($booking->inventories as $inventory)
                                    <tr class="tb-border">
                                      <th scope="row" style="padding-left: 15px !important;">{{$inventory->name}}</th>
                                      <td  class="text-center">
                                          @if($inventory->quantity_type == \App\Enums\BookingInventoryEnums::$QUANTITY['fixed'])
                                            {{$inventory->quantity}}
                                          @else
                                            {{json_decode($inventory->quantity, true)['min']}}-{{json_decode($inventory->quantity, true)['max']}}
                                          @endif
                                      </td>
                                      <td class=""><span class="status-badge text-center f-14" style="font-weight: bold !important;text-transform: capitalize;">{{$inventory->size}}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>

                            <div class="col-sm-6 pl-0 pr-0" style="padding:5px">
                                <div class="heading f-16 p-10 pl-4 border-around ">
                                  Images by Customer
                                </div>
                                <div class="row d-flex mr-2 justify-content-start  mt-2">
                                    @if(count(json_decode($booking->meta, true)['images']) === 0)
                                        <div class="col-sm-12 text-center" style="padding: 50px 0">
                                            <i>No image has been uploaded by the customer.</i>
                                        </div>
                                    @endif

                                    @foreach(json_decode($booking->meta, true)['images'] as $image)
                                        <div class="col-sm-3">
                                            <a href="{{$image}}" data-lightbox="image"><img src="{{$image}}" style="width: 100%;"></a>
                                        </div>
                                    @endforeach
                                </div>
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
