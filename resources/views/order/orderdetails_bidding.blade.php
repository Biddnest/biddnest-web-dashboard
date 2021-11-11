@extends('layouts.app')
@section('title') Orders And Bookings @endsection
@section('content')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="orderdetails" style="position: relative">
        <div class="d-flex  flex-row justify-content-between">
            <h3 class="page-head text-left p-4">Order Details</h3>
            @if(($booking->status == \App\Enums\BookingEnums::$STATUS['enquiry']) || ($booking->status == \App\Enums\BookingEnums::$STATUS['in_progress']))
                <div class="mr-20">
                    <a href="{{ route('edit-order', ['id'=>$booking->public_booking_id])}}">
                        <button class="btn theme-bg white-text" ><i class="fa fa-plus p-1" aria-hidden="true"></i> Edit order</button>
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
        <!-- Dashboard cards -->

        <div class="d-flex flex-row  Dashboard-lcards  justify-content-center">
            <div class="col">
                <div class="card  h-auto p-0 " >
                    <div class="card-head right text-center  pb-0 p-05" style="padding-top: 0">
                        <h3 class="f-18" style="margin-top: 0;">
                            <ul class="nav nav-tabs p-0 flex-row" id="myTab" role="tablist" style="font-weight: 600;">
                                <li class="nav-item ">
                                    <a class="nav-link p-15" id="customer-details-tab" data-toggle="tab" href="{{route('order-details', ['id'=>$booking->id])}}" role="tab" aria-controls="home" aria-selected="true">Details</a>
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
                                    <a class="nav-link active p-15" id="bidding-tab" data-toggle="tab" href="{{route('order-details-bidding', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Bidding</a>
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
                        <div class="tab-pane fade show active " id="bidding" role="tabpanel" aria-labelledby="quotation-tab">
                            @if($booking->status >= \App\Enums\BookingEnums::$STATUS['biding'])
                                <div class="view-more">
                                <div class="d-flex row p-15  ">
                                    <div class="col-sm-4 p-10 d-felx justify-content-center">
                                        <div class="text-center ">
                                            <h3 class="f-18 theme-text bold p-10">Time Left</h3>
                                            {{--<h1 class="timer" data-time="{{\Carbon\Carbon::parse($booking->bid_result_at)->format('Y-m-d h:i:s')}}"></h1>--}}
                                            <h1><span class="text-center timer" data-time="{{$booking->bid_result_at}}" style="min-width: 0px !important;"></span></h1>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 p-10">
                                        <div class=" text-center border-left-blue">
                                            <h3 class="text-center f-18 theme-text bold p-10">Recommended to Vendors</h3>
                                            <h1><span class="text-center" style="min-width: 0px !important;">&#8377;{{$booking->organization_rec_quote}}</span></h1>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 p-10">
                                        <div class=" text-center border-left-blue">
                                            <h3 class="text-center f-18 theme-text bold p-10">Recommended to Customer</h3>
                                            <h1><span class="text-center" style="min-width: 0px !important;">&#8377;{{$booking->final_estimated_quote}}</span></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex  row  p-10 theme-text ml-20">
                                    @if($booking->status == \App\Enums\BookingEnums::$STATUS['biding'])
                                        <h4>Bidding in Progress: Results will be declared at {{\Carbon\Carbon::parse($booking->bid_result_at)->format("H:iA")}}</h4>
                                    @elseif($booking->status == \App\Enums\BookingEnums::$STATUS['rebiding'])
                                        <h4>Rebidding in Progress: Results will be declared at {{\Carbon\Carbon::parse($booking->bid_result_at)->format("H:iA")}}</h4>
                                    @endif



                                    @foreach($booking->biddings as $bidding)
                                        @if($bidding->status == \App\Enums\BidEnums::$STATUS['won'])
                                                <div class="branch-wrapper col-lg-12">

                                                    <div class="alert alert-success" role="alert">
                                                        @if($bidding->bid_amount <= $least_agent_price)
                                                        The submitted price (&#8377; {{$bidding->bid_amount}}) is less than the least agent price (&#8377; {{$least_agent_price}}). So this booking has been confirmed based on CASE 1 formulae.
                                                        @elseif($bidding->bid_amount > $least_agent_price && $bidding->bid_amount <= $booking->organization_rec_quote)
                                                            The submitted price (&#8377; {{$bidding->bid_amount}}) is more than the least agent price (&#8377; {{$least_agent_price}}) but less than recommended price to vendors (&#8377; {{$booking->organization_rec_quote}}). So this booking has been confirmed based on CASE 1 formulae.
                                                        @elseif($bidding->bid_amount > $booking->organization_rec_quote)
                                                            The submitted price (&#8377; {{$bidding->bid_amount}}) is more than the recommended price to vendors (&#8377; {{$booking->organization_rec_quote}}). So this booking is temporarily held and a price review is required.
                                                        @endif
                                                    </div>

                                                    <div class="branch-snip d-flex flex-row justify-content-around" style="border-color: #02ad5a !important">
                                                        <div class="data-group" style="border-color: #02ad5a !important">
                                                            <h1 style="font-size: 18px;text-align: center">Won by:</h1>
                                                            <p style="text-align: center; color: #2E0789">
                                                                <img src="{{$bidding->organization->image}}" style="max-height: 80px" />
                                                                <br />
                                                                <br />
                                                                <span class="cursor-pointer modal-toggle" style="color: #2E0789">{{$bidding->organization->org_name}}</span>
                                                            </p>
                                                        </div>
                                                        <div class="data-group">
                                                            <h5 style="font-size: 14px;">Final Bid Amount</h5>
                                                            <p>&#8377; {{ $bidding->bid_amount  }}</p>

                                                            <br />
                                                            <h5 style="font-size: 14px;">Submitted At</h5>
                                                            <p>{{ $bidding->submit_at }}</p>
                                                        </div>

                                                        <div class="data-group">
                                                            <h5 style="font-size: 14px;">Submitted by</h5>
                                                            <p>{{$bidding->vendor->fname}} {{$bidding->vendor->lname}}</p>
                                                            <br />
                                                            <h5 style="font-size: 14px;">Least Agent Price</h5>
                                                            <p>&#8377; {{ $least_agent_price }}</p>
                                                        </div>

                                                        <div class="data-group">

                                                            <h5 style="font-size: 14px;">Type Of Movement</h5>
                                                            <p>{{json_decode($bidding->meta,true)['type_of_movement']}}</p>
                                                            <br />
                                                            <h5 style="font-size: 14px;">Man Power</h5>
                                                            <p>{{json_decode($bidding->meta,true)['min_man_power']}} - {{json_decode($bidding->meta,true)['max_man_power']}}</p>
                                                        </div>
                                                        <div class="data-group">

                                                            <h5 style="font-size: 14px;">Moving Date</h5>
                                                            <p>{{json_decode($bidding->meta,true)['moving_date'] ?: implode(", ",json_decode($bidding->moving_dates, true))}}</p>

                                                            <br />
                                                            <h5 style="font-size: 14px;">Vehicle Type</h5>
                                                            <p>{{json_decode($bidding->meta,true)['vehicle_type']}}</p>

                                                        </div>
                                                    </div>
                                                </div>
                                                {{--<h4> Won Vendor: <b>{{$bidding->organization->org_name}}</b> | Quote Submitted: <b>₹{{$bidding->bid_amount}}</b></h4>--}}
                                        @endif
                                    @endforeach
                                </div>
                                <div class="bidlist-table  border-pop">
                                    <div class="d-flex  row  p-10">
                                        <div class="col-sm-12 ">
                                            <div class="d-flex  p-10  justify-content-between ">
                                                <div class="vertical-center">
                                                    <div class="theme-text f-18 bold">
                                                        All vendor quotes
                                                    </div>
                                                </div>
                                                {{--<div class="vertical-center">
                                                    <a class="assign-btn" href="#"> <button class="btn btn-3">ASSIGN MANUALLY</button> </a>
                                                </div>--}}
                                            </div>
                                            <table class="table text-center p-10 theme-text">
                                                <thead class="secondg-bg  p-0">
                                                    <tr>
                                                        <th scope="col" >Vendors Name</th>
                                                        <th scope="col">Submitted At</th>
                                                        <th scope="col">Quote</th>
                                                        <th scope="col">Bid Status</th>

                                                            <th scope="col">Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody class="mtop-15">
                                                    @foreach($booking->biddings as $bidding)
                                                        <tr class="tb-border  cursor-pointer sidebar-toggle" data-sidebar="{{ route('sidebar.vendors',['id'=>$bidding->organization->id]) }}">
                                                            <td  class="text-center">{{$bidding->organization->org_name ?? "Vendor Name"}}</td>
                                                            <td class="">{{$bidding->submit_at ?? "Not Submitted"}}</td>
                                                            <td class="">&#8377;{{$bidding->bid_amount}}</td>
                                                            <td class="">
                                                                @switch($bidding->status)
                                                                @case(\App\Enums\BidEnums::$STATUS['active'])
                                                                    <span class="green-bg text-center w-100  td-padding">Yet to Submit</span>
                                                                @break;
                                                                @case(\App\Enums\BidEnums::$STATUS['rejected'])
                                                                    <span class="red-bg text-center w-100  td-padding">Rejected</span>
                                                                @break;
                                                                @case(\App\Enums\BidEnums::$STATUS['bid_submitted'])
                                                                    <span class="green-bg text-center w-100  td-padding">Submitted</span>
                                                                @break;
                                                                @case(\App\Enums\BidEnums::$STATUS['lost'])
                                                                    <span class="red-bg text-center w-100  td-padding">Lost</span>
                                                                @break;
                                                                @case(\App\Enums\BidEnums::$STATUS['expired'])
                                                                    <span class="red-bg text-center w-100  td-padding">Expired</span>
                                                                @break;
                                                                @case(\App\Enums\BidEnums::$STATUS['won'])
                                                                    <span class="green-bg text-center w-100  td-padding">Won</span>
                                                                @break;
                                                                @endswitch
                                                            </td>
                                                            @if($bidding->status == \App\Enums\BidEnums::$STATUS['active'])
                                                                <td class="">
                                                                    <a class="modal-toggle" data-target="#add-role_{{$bidding->organization_id}}">
                                                                        <button class="btn white-text theme-bg">Assign</button>
                                                                    </a>
                                                                </td>
                                                            @else
                                                                <td class="">
                                                                    @if($bidding->status == \App\Enums\BidEnums::$STATUS['won'] && $booking->status == \App\Enums\BookingEnums::$STATUS['price_review_pending'] && $booking->status == \App\Enums\BookingEnums::$STATUS['payment_pending'])
                                                                        <a class="modal-toggle" data-target="#change_bid_amt">
                                                                            <button class="btn white-text theme-bg">Edit Quote</button>
                                                                        </a>
                                                                        @endif
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                                <div class="row hide-on-data">
                                    <div class="col-md-12 text-center p-20">
                                        <p class="font14"><i>. Confirmation Pending From Customer.</i></p>
                                    </div>
                                </div>
                            @endif

                            <div class="border-top-3">
                                <div class="d-flex justify-content-start">
                                    <div class="w-50">
                                        {{--<a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>--}}
                                    </div>
                                    <div class="d-flex justify-content-end w-50" style="float: right; margin-right: 20px;">
                                        <a   href="{{route('order-details-quotation', ['id'=>$booking->id])}}" ><button  class="btn theme-text white-bg theme-br mr-20" style="padding: 10px 60px;">Back</button></a>
                                        <a href="{{route('order-details-review', ['id'=>$booking->id])}}" ><button  class="btn white-text theme-bg" style="padding: 10px 60px;">Next</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @foreach($booking->biddings as $org_id)
            <div class="fullscreen-modal" id="add-role_{{$org_id->organization_id}}" >
                <div class="fullscreen-modal-body" role="document">
                    <div class="modal-header">
                        <h5 class="modal-title  ml-4 pl-2" id="exampleModalLongTitle">Your Bid</h5>
                        <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="form-new-order pt-4 mt-3 onboard-vendor-branch input-text-blue" action="{{route('add_booking_bid')}}" data-next="redirect" data-redirect-type="hard"  data-url="{{route('order-details-bidding', ['id'=>$booking->id])}}" data-alert="mega" method="POST" data-parsley-validate>
                        <div class="modal-body" style="padding: 10px 9px;">
                            <div class="d-flex justify-content-center row " data-org="{{$org_id->organization_id}}">
{{--                                <h3>First</h3>--}}
                                <div class="col-sm-12 bid-amount-admin mr-2 ">
                                    <div class="d-flex flex-row p-10 justify-content-between secondg-bg heading status-badge">
                                        <div><p class="mt-2">Expected Price</p></div>
                                        <div class="col-2">
                                            <input class="form-control border-purple" type="text" value="{{$booking->organization_rec_quote}}" placeholder="6000" readonly/>
                                            <input class="form-control border-purple" type="hidden" type="text" value="{{$booking->public_booking_id}}" name="public_booking_id" placeholder="6000" readonly/>
                                            <input class="form-control border-purple ml-2" type="hidden" type="text" value="{{$org_id->organization_id}}" name="organization_id" readonly/>
                                            <input class="form-control border-purple ml-2" type="hidden" type="text" value="{{$org_id->organization->admin->id ?? ''}}" name="vendor_id" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12  p-0  pb-0" >
                                        <div class="heading p-8 mtop-22">
                                            <p class="text-muted light">
                                                <span class="bold">Note:</span>
                                                you can modify the old price for individual item OR you can directly set a new Total Price
                                            </p>
                                        </div>
                                        <table class="table text-left theme-text tb-border2" id="items" >
                                            <thead class="secondg-bg bx-shadowg p-0 f-14">
                                            <tr class="">
                                                <th scope="col">Item Name</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Size</th>
                                                <th scope="col" style="width: 120px;">Old Price</th>
                                            </tr>
                                            </thead>
                                            <tbody class="mtop-20 f-13 calc-total" data-result=".calc-result">
                                            @php
                                                $price = \App\Http\Controllers\BidController::getPriceList($booking->public_booking_id, $org_id->organization_id, true);
    Debugbar::info($price);
                                            @endphp
                                            @if($price['base_price'] != 0)
                                                <tr>
                                                    <td>Base Price</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>
                                                        <input class="form-control disabled border-purple w-88 calc-total-input validate-input" name="base_amount:number" id="amount_0" value="{{$price['base_price']}}" type="number" placeholder="0.00"/>
                                                    </td>
                                                </tr>
                                            @endif
                                            @foreach($booking->inventories as $inventory)
                                                <tr class="">

                                                    <th scope="row">{{$inventory->name}}</th>
                                                    <td class="">
                                                        @if($inventory->quantity_type == \App\Enums\CommonEnums::$NO)
                                                            {{$inventory->quantity ?? ''}}
                                                        @else
                                                            {{$inventory->quantity->min ?? ''}}-{{$inventory->quantity->max ?? ''}}
                                                        @endif
                                                    </td>
                                                    <td class="">{{$inventory->size}}</td>
                                                    <td>

                                                        <input class="form-control border-purple w-88" type="hidden" name="inventory[][booking_inventory_id]" value="{{$inventory->id}}" type="text" placeholder="2000"/>
                                                        @if($inventory->is_custom)
                                                            @foreach($price['inventories'] as $inv_price)
                                                                @if($inv_price['bid_inventory_id'] == $inventory->id)
                                                                   <input type="hidden" name="inventory[][is_custom]" value="{{$inv_price['bid_inventory_id']}}:boolean"/>

                                                                    <input class="form-control border-purple w-88 calc-total-input validate-input" name="inventory[][amount]:number" id="amount_{{$inventory->id}}" value="{{$inv_price['price'] ?? '0'}}" type="number" placeholder="2000"/>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <input type="hidden" name="inventory[][is_custom]:boolean" value="false"/>

                                                            <input class="form-control disabled border-purple w-88 validate-input" name="inventory[][amount]:number" id="amount_{{$inventory->id}}" value="0.00" type="number" placeholder="0.00" readonly/>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr id='addr1'></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex mtop-22 mb-4 flex-row p-10 justify-content-between secondg-bg status-badge heading">
                                        <div><p class="mt-2">Total Price</p></div>
                                        <div class="col-2">
                                            <input class="form-control border-purple calc-result validate-input" type="number" value="{{$price['total']}}" name="bid_amount" id="bid_amount" required placeholder="4000" data-est-quote="{{str_replace(",", "", $booking->final_estimated_quote)}}" />
                                        </div>
                                    </div>
                                </div>
{{--                                <h3>Second</h3>--}}
                                <div class ="col-sm-12 bid-amount-2-admin ">
                                    <div class="d-flex flex-row p-10 justify-content-between secondg-bg heading status-badge">
                                        <div><p class="mt-2">Expected Price</p></div>
                                        <div class="col-2">
                                            <input class="form-control border-purple bid-expt" type="text" value="{{$price['total']}}" placeholder="6000" readonly/>
                                        </div>
                                    </div>
                                    <div class="d-flex row p-10">
                                        <div class="col-lg-6">
                                            <div class="form-input">
                                                <label class="full-name">Type of Movement</label>
                                                <select id="" class="form-control" name="type_of_movement" required>
                                                    <option value="">--select--</option>
                                                    @if(json_decode($booking->source_meta, true)['shared_service']== false)
                                                        <option value="dedicated">Dedicated</option>
                                                    @else
                                                        <option value="shared">Shared</option>
                                                        <option value="dedicated">Dedicated</option>
                                                    @endif
                                                </select>
                                                <span class="error-message"></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-input">
                                                <label class="full-name">Moving Date</label>
                                                <div class="select-date">
                                                    @php $count=1; @endphp
                                                    @foreach($booking->movement_dates as $mdate)
                                                        <label class="mr-2 move-add-date" id="moving_date">
                                                            <input type="checkbox" name="moving_date[]" value="{{date("d M Y", strtotime($mdate->date))}}" class="card-input-element moving-date_{{$count}}" data-parsley-errors-container="#err-date"
                                                                   required
                                                                   data-parsley-error-message="Mandatory Field. Please enter the value" style="display: none"/>
                                                            <span class="status-3 move-date mdate_{{$count}} cursor-pointer">{{date("d M Y", strtotime($mdate->date))}}</span>
                                                        </label>
                                                        @php $count++; @endphp
                                                    @endforeach
                                                </div>
                                                {{--<input type="text" class="form-control br-5" name="moving_date" id="date" data-selecteddate="{{$booking->movement_dates}}" required placeholder="15/02/2021">--}}
                                                <span class="error-message" id="err-date">
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-input">
                                                <label class="full-name">Minimum and  Maximum Number Of Man Power</label>
                                                <div class="" style="margin-top: 20px;">
                                                        <input type="text" class="custom_slider range validate-input" name="man_power"  data-min="0" data-max="100" data-from="0" data-to="100" data-type="double" data-step="1" />

                                                </div>
                                                <span class="error-message">Please enter valid </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-input">
                                                <label class="full-name">Name of Vehicle</label>
                                                <select id="" class="form-control" name="vehicle_type" required>
                                                    <option value="">--select--</option>
                                                    @foreach($org_id->organization->vehicle as $vehicle)
                                                        <option value="{{$vehicle->vehicle_type}}">{{$vehicle->name}}-{{$vehicle->vehicle_type}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 bid-amount-3-admin hidden p60">
                                    <div class="form-input">
                                        <h4 class="text-center bold">Enter Vendor's OTP</h4>
                                        <input class="form-control otp-bid" name="otp" type="number" maxlength="6" minlength="6" required/>
                                        <span class="error-message">Please enter valid OTP</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer p-15 ">
                            <div class="w-50">
                            </div>
                            <div class="w-50 text-right"><a class="white-text p-10" href="#">
                                    <button type="button" class="btn theme-bg white-text w-30 next-btn-1-admin" data-direction="next" id="next-btn-1-admin" {{--onclick="steps_api_{{$org_id->organization_id}}.next();"--}} style="margin-bottom: 20px;">Next</button>
                                    <button type="button" class="btn theme-bg white-text w-30 hidden next-btn-back-2-admin" data-direction="next2-back" id="next-btn-back-2-admin"  style="margin-bottom: 20px;">Back</button>
                                    <button type="button" class="btn theme-bg white-text w-30 next-btn-2-admin" data-direction="next2" id="next-btn-2-admin" data-url="{{route('send_bid_otp', ['id'=>$org_id->organization_id])}}" {{--onclick="steps_api_{{$org_id->organization_id}}.next();"--}} style="margin-bottom: 20px;">Next</button>
                                    <button  class="btn theme-bg white-text w-30 submitbtn-admin" id="submitbtn-admin" style="margin-bottom: 20px;">Submit</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

        @if($booking->payment)
            <div class="fullscreen-modal" id="change_bid_amt" >
                <div class="fullscreen-modal-body" role="document" style="width: 60% !important; transform: translateX(30%) !important;">
                    <div class="modal-header">
                        <h5 class="modal-title  ml-4 pl-2" id="exampleModalLongTitle">Edit Bid Amount</h5>
                        <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="form-new-order pt-4 mt-3 onboard-vendor-branch input-text-blue" action="{{route('edit_booking_final_bid')}}" data-next="redirect" data-redirect-type="hard"  data-url="{{route('order-details-quotation', ['id'=>$booking->id])}}" data-alert="mega" method="POST" data-parsley-validate>
                        <div class="modal-body" style="padding: 10px 9px; margin-bottom: 0px !important;">
                            <div class="d-flex match-height row p-15 quotation-main pb-0" >
                                <div class="col-sm-4 secondg-bg margin-topneg-15 pt-10">
                                    <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 15px;">
                                        Vendor amount
                                    </div>
                                    <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 15px;">
                                        Commision
                                    </div>
                                    <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 20px;">
                                        <b>Sub Total</b>
                                    </div>
                                    <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 20px;">
                                        Other Charges
                                    </div>
                                    <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 20px;">
                                        Discount
                                    </div>
                                    <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 15px;">
                                        Tax
                                    </div>
                                    <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 20px;">
                                        Grand Amount
                                    </div>
                                    <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 20px;">
                                        Confirm Amount
                                    </div>
                                </div>
                                <div class="col-sm-7 white-bg  margin-topneg-15 pt-10">
                                    <div class="theme-text f-14  p-15" style="padding-top: 5px;">
                                        <input type="text" class="form-control bid-amount" value="{{$booking->payment->vendor_quote}}" name="bid_amount" min="0.00" required>
                                        <input type="hidden" class="form-control" value="{{$booking->id}}" name="booking_id" required>
                                    </div>
                                    <div class="theme-text f-14 p-15" style="padding-top: 5px;" >
                                        <input type="text" class="form-control  commission" value="{{$booking->payment->commission}}" name="commission" min="0.00" required>
                                    </div>
                                    <div class="theme-text f-14 p-15" style="padding-top: 5px;" >
                                        <input type="number" class="form-control  sub-total" value="{{$booking->payment->sub_total}}" name="sub_total" min="0.00" required readonly>
                                    </div>
                                    <div class="theme-text f-14 p-15" style="padding-top: 5px;" >
                                        <input type="text" class="form-control  other_charges" value="{{$booking->payment->other_charges}}" name="other_charges" min="0.00" required>
                                    </div>
                                    <div class="theme-text f-14 p-15"  style="padding-top: 5px;">
                                        <input type="text" class="form-control  discount_amount" value="{{$booking->payment->discount_amount}}" name="discount_amount" min="0.00" required>
                                    </div>
                                    <div class="theme-text f-14 p-15" style="padding-top: 5px;" >
                                        <input type="text" class="form-control  tax" value="{{$booking->payment->tax}}" name="tax" min="0.00" required readonly>
                                    </div>
                                    <div class="theme-text f-14 p-15" style="padding-top: 5px;" >
                                        <input type="text" class="form-control  grand_total" value="{{$booking->payment->grand_total}}" name="grand_total" min="0.00" readonly required>
                                    </div>
                                    <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                        <input type="checkbox" name="confirm:boolean" value="true"/>
                                    </div> 
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="modal-footer p-15 ">
                            <div class="w-50">
                            </div>
                            <div class="w-50 text-right"><a class="white-text p-10" href="#">
                                    <button  class="btn theme-bg white-text w-40" style="margin-bottom: 20px;">Submit</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif


        <script type="application/javascript">
            var BID_END_TIME = "{{$booking->bid_end_at}}";
        </script>
    </div>
@endsection
