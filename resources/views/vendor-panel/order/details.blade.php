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
                            <div class="d-flex p-10" style="margin-bottom: 30px;">
                                <div class="steps-container p-15 mr-5 pr-5">
                                    <hr class="dash-line" style="width: 80%;     margin-left: 50px;" >
                                    @foreach(\App\Enums\BookingEnums::$STATUS as $key=>$status)
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
                            @if($booking->bid->status == \App\Enums\BidEnums::$STATUS['bid_submitted'] || $booking->bid->status == \App\Enums\BidEnums::$STATUS['active'])
                                <div class="d-felx justify-content-center pt-4 border-top row">
                                    <div class="bid-badge mr-4">
                                        <h4 class="step-title" style="padding: 12px 34px;">₹ {{$booking->final_estimated_quote}}</h4>
                                        <p>Estimated Price</p>
                                    </div>
                                    <div class="bid-badge mr-4">
                                        <h4 class="step-title " style="padding: 12px 34px;"><span class="text-center timer" data-time="{{$booking->bid_result_at}}" style="min-width: 0px !important;"></span></h4>
                                        <p>Time Left</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="d-flex  border-bottom pb-0">
                            <ul class="nav nav-tabs pt-20 p-0 f-18" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="new-order-tab" data-toggle="tab" href="#order-details" role="tab" aria-controls="home" aria-selected="true">Order Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="requirments-tab" href="{{route('vendor.requirment-order',['id'=>$booking->public_booking_id])}}">Item List</a>
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
                                        <a class="nav-link " id="requirments-tab" href="{{route('vendor.driver-details',['id'=>$booking->public_booking_id])}}">Driver Details</a>
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
                                <div class="tab-pane fade active show" id="order-details" role="tabpanel" aria-labelledby="order-details-tab">
                                    <div class="d-flex  row pt-3 pr-4 pl-3 margin-topneg-15">
                                        <div class="col-sm-4  secondg-bg  mt-2 ml-2 pt-10">
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

                                        <div class="col-sm-5 mt-2  pt-10">
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
                                <div class="border-top">
                                    <div class="d-flex pb-2 pt-1 justify-content-end button-section">
                                        @if($booking->bid->status != \App\Enums\BidEnums::$STATUS['bid_submitted'])
                                            <a href="#" class="bookings inline-icon-button" data-url="{{route('api.booking.bookmark', ['id'=>$booking->public_booking_id])}}" data-confirm="Do you want add this booking in Bookmarked?">
                                                <button class="btn theme-br theme-text  white-bg  justify-content-center">Quote Later</button>
                                            </a>
                                        @endif
                                        <a class="modal-toggle" data-toggle="modal" data-target="#add-role">
                                            <button class="btn theme-br theme-text">Accept</button>
                                        </a>
                                        @if($booking->bid->status != \App\Enums\BidEnums::$STATUS['bid_submitted'])
                                            <a href="#" class="bookings inline-icon-button" data-url="{{route('api.booking.reject', ['id'=>$booking->public_booking_id])}}" data-confirm="Are you sure, you want reject this Booking? You won't be able to undo this.">
                                                <button class="btn">Reject</button>
                                            </a>
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

        <div class="fullscreen-modal" id="add-role" >
            <div class="fullscreen-modal-body" role="document">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Your Bid</h5>
                    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-new-order pt-4 mt-3 onboard-vendor-branch input-text-blue" action="{{route('api.booking.bid')}}" data-next="redirect" data-url="{{route('vendor.my-quote',['id'=>$booking->public_booking_id])}}" data-alert="mega" method="POST" data-parsley-validate>
                    <div class="modal-body" style="padding: 10px 9px;">
                        <div class="d-flex justify-content-center row ">
                            <div class="col-sm-12 bid-amount">
                                <div class="d-flex flex-row p-10 justify-content-between secondg-bg heading status-badge">
                                    <div><p class="mt-2">Expected Price</p></div>
                                    <div class="col-2">
                                        <input class="form-control border-purple" type="text" value="{{$booking->final_estimated_quote}}" placeholder="6000" readonly/>
                                        <input class="form-control border-purple" type="hidden" type="text" value="{{$booking->public_booking_id}}" name="public_booking_id" placeholder="6000" readonly/>
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
                                                <td> <input class="form-control border-purple w-88" type="hidden" name="inventory[][booking_inventory_id]" value="{{$inventory->id}}" type="text" placeholder="2000"/>

                                                    @php $price = \App\Http\Controllers\BidController::getPriceList($booking->public_booking_id, \Illuminate\Support\Facades\Session::get('organization_id'), true); @endphp
                                                    @foreach($price['inventories'] as $inv_price)
                                                        @if($inv_price['bid_inventory_id'] == $inventory->inventory_id)
                                                            <input class="form-control border-purple w-88 calc-total-input validate-input" name="inventory[][amount]" id="amount_{{$inventory->id}}" value="{{$inv_price['price']}}" type="number" placeholder="2000"/>
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
                                        <input class="form-control border-purple calc-result validate-input" type="number" value="{{$price['total']}}" name="bid_amount" id="bid_amount" required placeholder="4000" />
                                    </div>
                                </div>
                            </div>

                            <div class ="col-sm-12 bid-amount-2">
                                <div class="d-flex flex-row p-10 pr-4 justify-content-between secondg-bg heading status-badge">
                                    <div><p class="mt-2">Expected Price</p></div>
                                    <div class="col-2">
                                        <input class="form-control border-purple" type="text" value="{{$booking->final_estimated_quote}}" placeholder="6000" readonly/>
                                    </div>
                                </div>
                                <div class="d-flex row p-10">
                                    <div class="col-lg-6 ">
                                        <div class="form-input">
                                            <label class="full-name mb-4">Type of Movement</label>
                                            <select id="" class="form-control mt-2" name="type_of_movement" required>
                                                <option value="">--select--</option>
                                                @if(json_decode($booking->source_meta, true)['shared_service']== true)
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
                                            <div>
                                                @foreach($booking->movement_dates as $mdate)
                                                    <span class="status-3">{{date("d M Y", strtotime($mdate->date))}}</span>
                                                @endforeach
                                            </div>
                                            <input type="text" class="form-control br-5 filterdate selectdate validate-input" name="moving_date" id="date" data-selecteddate="{{$booking->movement_dates}}" required placeholder="15/02/2021">
                                            <span class="error-message">Please enter valid</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-5">
                                            <label class="full-name">Minimum and  Maximum Number Of Man Power</label>
                                            <div class="d-felx justify-content-between" style="margin-top: 10px !important; ">
                                                <div class="d-flex range-input-group justify-content-between flex-row">
                                                    <input type="text" class="custom_slider custom_slider_1 range validate-input" name="man_power"  data-min="0" data-max="5" data-from="0" data-to="5" data-type="double" data-step="1" />
                                                </div>
                                            </div>
                                            <span class="error-message">Please enter valid </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input mt-5">
                                            <label class="full-name mb-4">Name of Vehicle</label>
                                            <select id="" class="form-control mt-2" name="vehicle_type">
                                                <option value="">--select--</option>
                                                @foreach($vehicles as $vehicle)
                                                    <option value="{{$vehicle->vehicle_type}}">{{$vehicle->name}}-{{$vehicle->vehicle_type}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-message"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 enter-pin p-60">
                                <div class="form-input">
                                    <h4 class="text-center bold">Enter Your Pin</h4>
                                    <input class="form-control" name="pin" type="number" maxlength="4" minlength="4" required/>
                                    <span class="error-message">Please enter valid OTP</span>
                                </div>
                                <div class="text-center">
                                    <span class="text-center">Forgot Pin?</span>
                                    <a class="modal-toggle" href="#" data-target="#reset-pin">
                                        Reset
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-15 ">
                        <div class="w-50">
                        </div>
                        <div class="w-50 text-right"><a class="white-text p-10" href="#"><button
                                    type="button" class="btn theme-bg white-text w-30 next-btn-1" id="next-btn-1" style="margin-bottom: 20px;">Next</button>
                                <button type="button"
                                        class="btn theme-bg white-text w-30 next-btn-2" id="next-btn-2" style="margin-bottom: 20px;">Next</button>
                                <button
                                    class="btn theme-bg white-text w-30 submitbtn" id="submitbtn" style="margin-bottom: 20px;">Submit</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="fullscreen-modal" id="reset-pin">
            <div class="fullscreen-modal-body" role="document">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Reset Your Pin</h5>
                    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-new-order pt-4 mt-3 onboard-vendor-branch input-text-blue" action="{{route('api.vendor.reset-pine')}}" method="PUT" data-next="modal" data-modal-id="#reset-pin" data-alert="mega" data-parsley-validate>
                    <div class="modal-body" style="padding: 10px 9px;">
                        <div class="d-flex justify-content-center row ">
                            <div class="col-sm-6 enter-pin p-60">
                                <div class="form-input">
                                    <h4 class="text-center bold">Enter Your Password</h4>
                                    <input class="form-control" name="password" id="password" type="password" required/>
                                    <span class="error-message">Please enter valid Password</span>
                                </div>
                                <div class="form-input">
                                    <h4 class="text-center bold">Enter Your Pin</h4>
                                    <input class="form-control" name="pin" id="pin" type="number" maxlength="4" minlength="4" required/>
                                    <span class="error-message">Please enter valid OTP</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-15 ">
                        <div class="w-50">
                        </div>
                        <div class="w-50 text-right">
                            <a class="white-text p-10" href="#">
                                <button class="btn theme-bg white-text w-30 " id="submitbtn" style="margin-bottom: 20px;">Submit</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('modal')

@endsection
