@extends('layouts.app')
@section('title') Orders And Bookings @endsection
@section('content')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="orderdetails" style="position: relative">
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
        <!-- Dashboard cards -->

        <div class="d-flex flex-row  Dashboard-lcards  justify-content-center">
            <div class="col">
                <div class="card  h-auto p-0 " >
                    <div class="card-head right text-center  pb-0 p-05" style="padding-top: 0">
                        <h3 class="f-18" style="margin-top: 0;">
                            <ul class="nav nav-tabs p-0 flex-row" id="myTab" role="tablist" style="font-weight: 600;">
                                <li class="nav-item ">
                                    <a class="nav-link p-15" id="customer-details-tab" data-toggle="tab" href="{{route('order-details', ['id'=>$booking->id])}}" role="tab" aria-controls="home" aria-selected="true">Customer Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-vendor', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Vendor Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-quotation', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Quotation</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active p-15" id="bidding-tab" data-toggle="tab" href="{{route('order-details-bidding', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Bidding</a>
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
                        <div class="tab-pane fade show active " id="bidding" role="tabpanel" aria-labelledby="quotation-tab">
                            @if($booking->status >= \App\Enums\BookingEnums::$STATUS['biding'])
                                <div class="view-more">
                                <div class="d-flex row p-15  ">
                                    <div class="col-sm-12 p-10 d-felx justify-content-center">
                                        <div class="text-center ">
                                            <h3 class="f-18 theme-text bold p-10">Time Left</h3>
                                            {{--<h1 class="timer" data-time="{{\Carbon\Carbon::parse($booking->bid_result_at)->format('Y-m-d h:i:s')}}"></h1>--}}
                                            <h1><span class="text-center timer" data-time="{{$booking->bid_result_at}}" style="min-width: 0px !important;"></span></h1>
                                        </div>
                                    </div>
                                    {{--<div class="col-sm-7 p-10">
                                        <div class=" text-center border-left-blue">
                                            <h3 class="text-center f-18 theme-text bold p-10">Quotation statitics</h3>
                                            <img src="{{asset('static/images/graph/graphbid.svg')}}" alt="" srcset="">
                                        </div>
                                    </div>--}}
                                </div>
                                <div class="d-flex  row  p-10 theme-text ml-20">
                                    @if($booking->status == \App\Enums\BookingEnums::$STATUS['biding'])
                                        <h4>Bidding in Progress: Results will be declared at {{\Carbon\Carbon::parse($booking->bid_result_at)->format("H:iA")}}</h4>
                                    @elseif($booking->status == \App\Enums\BookingEnums::$STATUS['rebiding'])
                                        <h4>Rebidding in Progress: Results will be declared at {{\Carbon\Carbon::parse($booking->bid_result_at)->format("H:iA")}}</h4>
                                    @endif
                                    @foreach($booking->biddings as $bidding)
                                        @if($bidding->status == \App\Enums\BidEnums::$STATUS['won'])
                                            <h4> Top Vendor: {{$bidding->organization->org_name}} | Total Price: ₹{{$bidding->bid_amount}}</h4>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="bidlist-table  border-pop">
                                    <div class="d-flex  row  p-10">
                                        <div class="col-sm-12 ">
                                            <div class="d-flex  p-10  justify-content-between ">
                                                <div class="vertical-center">
                                                    <div class="theme-text f-18 bold">
                                                        Venders Bid List
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
                                                        <th scope="col">Commission %</th>
                                                        <th scope="col">Quote</th>
                                                        <th scope="col">Bid Status</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="mtop-15">
                                                    @foreach($booking->biddings as $bidding)
                                                        <tr class="tb-border  cursor-pointer sidebar-toggle" data-sidebar="{{ route('sidebar.vendors',['id'=>$bidding->organization->id]) }}">
                                                            <td  class="text-center">{{$bidding->organization->org_name ?? "Vendor Name"}}</td>
                                                            <td class="">{{$bidding->organization->commission ?? 10}}%</td>
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
                                                            <td class="">
                                                                @if($bidding->status == \App\Enums\BidEnums::$STATUS['active'])
                                                                    <a class="modal-toggle" data-target="#add-role_{{$bidding->organization_id}}">
                                                                        <button class="btn white-text theme-bg">Assign</button>
                                                                    </a>
                                                                @endif
                                                            </td>
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
                                        <a href="{{route('order-details-payment', ['id'=>$booking->id])}}" ><button  class="btn white-text theme-bg" style="padding: 10px 60px;">Next</button></a>
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
                                        <div><p class="mt-2 ml-0">Expected Price</p></div>
                                        <div class="col-2">
                                            <input class="form-control border-purple ml-2" type="text" value="{{$booking->final_estimated_quote}}" placeholder="6000" readonly/>
                                            <input class="form-control border-purple ml-2" type="hidden" type="text" value="{{$booking->public_booking_id}}" name="public_booking_id" placeholder="6000" readonly/>
                                            <input class="form-control border-purple ml-2" type="hidden" type="text" value="{{$org_id->organization_id}}" name="organization_id" readonly/>
                                            <input class="form-control border-purple ml-2" type="hidden" type="text" value="{{$org_id->organization->admin->id ?? ''}}" name="vendor_id" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12  p-0  pb-0" >
                                        <div class="heading p-8 mtop-22">
                                            <p class="text-muted light ml-1 pl-1">
                                                <span class="bold">Note:</span>
                                                you can modify the old price for individual item OR you can directly set a new Total Price
                                            </p>
                                        </div>
                                        <table class="table text-left theme-text tb-border2" id="items" >
                                            <thead class="secondg-bg bx-shadowg p-0 f-14">
                                            <tr class="">
                                                <th scope="col" style="text-align: left; padding-left:18px!important;">Item Name</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col" style="text-align: left;">Size</th>
                                                <th scope="col" style="width: 120px;">Vendor's Price</th>
                                            </tr>
                                            </thead>
                                            <tbody class="mtop-20 f-13 calc-total" data-result=".calc-result">
                                            @foreach($booking->inventories as $inventory)
                                                <tr class="">
                                                    <th scope="row" style="text-align: left;">{{$inventory->name}}</th>
                                                    <td class="">
                                                        @if($inventory->quantity_type == \App\Enums\CommonEnums::$NO)
                                                            {{$inventory->quantity ?? ''}}
                                                        @else
                                                            {{json_decode($inventory->quantity, true)['min']}} - {{json_decode($inventory->quantity, true)['max']}}
                                                        @endif
                                                    </td>
                                                    <td class="text-left" >{{$inventory->size}}</td>
                                                    <td> <input class="form-control border-purple " style="width: 106px;" type="hidden" name="inventory[][booking_inventory_id]" value="{{$inventory->id}}" type="text" placeholder="2000"/>

                                                        @php $price = \App\Http\Controllers\BidController::getPriceList($booking->public_booking_id, $org_id->organization_id, true); @endphp
                                                        @foreach($price['inventories'] as $inv_price)
                                                            @if($inv_price['bid_inventory_id'] == $inventory->id)
                                                                <input class="form-control border-purple calc-total-input validate-input" style="width: 106px;" name="inventory[][amount]" value="{{$inv_price['price'] ?? '0'}}" id="amount_{{$inventory->id}}" type="number" placeholder="2000" required/>
                                                            @endif
                                                        @endforeach
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
                                            <input class="form-control border-purple ml-2 calc-result validate-input" type="text" value="{{$price['total']}}" name="bid_amount" id="bid_amount" required placeholder="4000" data-est-quote="{{$booking->final_estimated_quote}}" />
                                        </div>
                                    </div>
                                </div>
{{--                                <h3>Second</h3>--}}
                                <div class ="col-sm-12 bid-amount-2-admin ">
                                    <div class="d-flex flex-row p-10 justify-content-between secondg-bg heading status-badge">
                                        <div><p class="mt-2">Expected Price</p></div>
                                        <div class="col-2">
                                            <input class="form-control border-purple" type="text" value="{{$booking->final_estimated_quote}}" placeholder="6000" readonly/>
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
                                                    @foreach($booking->movement_dates as $mdate)
                                                        <label class="mr-2 move-add-date">
                                                            <input type="radio" name="moving_date" value="{{date("d M Y", strtotime($mdate->date))}}" class="card-input-element moving-date" data-parsley-errors-container="#err-date"
                                                                   required
                                                                   data-parsley-error-message="Mandatory Field. Please enter the value" style="display: none"/>
                                                            <span class="status-3 move-date cursor-pointer">{{date("d M Y", strtotime($mdate->date))}}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                                {{--<input type="text" class="form-control br-5" name="moving_date" id="date" data-selecteddate="{{$booking->movement_dates}}" required placeholder="15/02/2021">--}}
                                                <div class="error-wrapper" id="err-date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-input">
                                                <label class="full-name">Minimum and  Maximum Number Of Man Power</label>
                                                <div class="d-felx justify-content-between" style="margin-top: 20px;">
                                                        <input type="text" class="custom_slider custom_slider_1 range" name="man_power"  data-min="0" data-max="100" data-from="0" data-to="100" data-type="double" data-step="1" />

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


        <script type="application/javascript">
            var BID_END_TIME = "{{$booking->bid_end_at}}";
        </script>
    </div>
@endsection
