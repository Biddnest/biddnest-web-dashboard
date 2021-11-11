<div class="modal-header pb-0 border-none">
                    <h3 class="f-14">
                        <ul class="nav nav-tabs  p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active p-15"  data-toggle="tab" href="#book" role="tab" aria-controls="home" aria-selected="true">Customer</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" data-toggle="tab" href="#vendor" role="tab" aria-controls="profile" aria-selected="false">Vendor</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link p-15" data-toggle="tab" href="#payment" role="tab" aria-controls="profile" aria-selected="false">Payment</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" data-toggle="tab" href="#timeline" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
                            </li>

                        </ul>
                    </h3>

                    <button type="button" class="close theme-text margin-topneg-10" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                        <!-- <span aria-hidden="true" >&times;</span> -->
                        <i class="fa fa-times theme-text" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body border-top margin-topneg-7">
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active " id="book" role="tabpanel" aria-labelledby="new-order-tab">
                            <!-- form starts -->
                            <div class="d-flex  row  p-10">
                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Booking ID
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        @if($booking->status > \App\Enums\BookingEnums::$STATUS['payment_pending'])
                                            {{$booking->public_booking_id}}
                                        @else
                                            {{$booking->public_enquiry_id}}
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex  row  p-10">
                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Customer Name
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        {{$booking->user->fname}} {{$booking->user->lname}}
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex  row  p-10">
                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        From Address
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        @if(json_decode($booking->source_meta, true)){{json_decode($booking->source_meta, true)['address'] ?? '' }}@endif
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex  row  p-10">
                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        To Address
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        @if(json_decode($booking->destination_meta, true)) {{json_decode($booking->destination_meta, true)['address'] ?? '' }}@endif
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex  row  p-10">
                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Status
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">

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
                                            <span class="status-badge light-bg text-center td-padding">Rebidding</span>
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

                                            @case(\App\Enums\BookingEnums::$STATUS['hold'])
                                            <span class=" text-center status-badge red-bg">On Hold</span>
                                            @break;

                                            @case(\App\Enums\BookingEnums::$STATUS['bounced'])
                                            <span class=" text-center status-badge red-bg">Bounced</span>
                                            @break;

                                            @case(\App\Enums\BookingEnums::$STATUS['cancel_request'])
                                            <span class=" text-center status-badge red-bg">Request To Cancel</span>
                                            @break;

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
                                </div>
                            </div>
                            <div class="d-flex  row  p-10 border-top-pop">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Items to be moved
                                    </div>

                                </div>




                            </div>
                            <table class="table text-center p-10 theme-text">
                                <thead class="secondg-bg  p-0">
                                <tr>
                                    <th scope="col" style="text-align:left !important; padding-left: 12px !important;">Item Name</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Material</th>

                                </tr>
                                </thead>
                                <tbody class="mtop-20">

                                @foreach($booking->inventories as $inventory)
                                <tr class="tb-border">
                                    <th scope="row" style="text-align:left !important; padding-left: 12px !important;">{{$inventory->name}}</th>

                                    <td class="text-center">@if(json_decode($inventory->size,true)){{json_decode($inventory->size,true)['min']}} - {{json_decode($inventory->size,true)['max']}}@else {{$inventory->size}} @endif</td>
                                    <td class=""><span class="red-bg text-center w-100  td-padding">{{$inventory->material}}</span></td>

                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                            @if(count($booking->inventories)== 0)
                                <div class="row hide-on-data">
                                    <div class="col-md-12 text-center p-20">
                                        <p class="font14"><i>. This Booking don't have any Inventories.</i></p>
                                    </div>
                                </div>
                            @endif
                            <div class="d-flex   justify-content-center p-10">
                                @if($booking->status != \App\Enums\BookingEnums::$STATUS['in_progress'])
                                    <div class=""><a class="white-text p-10" href="{{route('order-details',["id"=>$booking->id])}}" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');"><button class="btn theme-bg white-text">View More</button></a></div>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="vendor" role="tabpanel" aria-labelledby="vendor">
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Assigned Vendor
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                       {{$booking->organization->org_name ?? 'Not Assigned'}}
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Assigned Vehicle
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        {{$booking->vehicle->number ?? 'Not Assigned'}}
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Assigned Driver
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        {{$booking->driver->fname ?? 'Not'}} {{$booking->driver->lname ?? 'Assigned'}}
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Driver Phone Number
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        {{$booking->driver->phone ?? 'Not Assigned'}}
                                    </div>
                                </div>



                            </div>


                            <div class="d-flex   justify-content-center p-10">

                                @if($booking->status != \App\Enums\BookingEnums::$STATUS['in_progress'])
                                    <div class=""><a class="white-text p-10" href="{{route('order-details',["id"=>$booking->id])}}" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');"><button class="btn theme-bg white-text">View More</button></a></div>
                                @endif




                            </div>
                        </div>

                        <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment">
                            <!-- form starts -->
                            <div class="d-flex  row  p-10">
                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Status
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        @if($booking->payment)
                                            @switch($booking->payment->status)
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
                                                <span class="status-badge light-bg text-center td-padding">Rebidding</span>
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

                                                @case(\App\Enums\BookingEnums::$STATUS['hold'])
                                                <span class=" text-center status-badge red-bg">On Hold</span>
                                                @break;

                                                @case(\App\Enums\BookingEnums::$STATUS['bounced'])
                                                <span class=" text-center status-badge red-bg">Bounced</span>
                                                @break;

                                                @case(\App\Enums\BookingEnums::$STATUS['cancel_request'])
                                                <span class=" text-center status-badge red-bg">Request To Cancel</span>
                                                @break;

                                                @case(\App\Enums\BookingEnums::$STATUS['in_progress'])
                                                <span class=" text-center status-badge red-bg">In Progress</span>
                                                @break;

                                                @case(\App\Enums\BookingEnums::$STATUS['awaiting_bid_result'])
                                                <span class=" text-center status-badge red-bg">Awaiting Bid Result</span>
                                                @break;

                                                @case(\App\Enums\BookingEnums::$STATUS['price_review_pending'])
                                                <span class=" text-center status-badge red-bg">Price Review Pending</span>
                                                @break;

                                            @default
                                            <span class="status-badge red-bg  text-center td-padding">Unknown</span>

                                        @endswitch
                                        @else Payment data will be generated after bidding is completed. @endif
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex  row  p-10">
                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Rzp Order ID
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        {{$booking->payment->rzp_order_id ?? 'Not generated'}}
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex  row  p-10">
                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Rzp Payment ID
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        {{$booking->payment->rzp_order_id ?? 'Not generated'}}
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="d-flex  row  p-10 border-top-pop">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Invoice Breakup
                                    </div>

                                </div>




                            </div>
                            <table class="table text-left p-10 theme-text">
                                <thead class="secondg-bg  p-0">
                                <tr>
                                    <th scope="col" style="text-align: left; padding-left: 14px !important;">Particular</th>
                                    <th scope="col" style="text-align: left; padding-left: 14px !important;">Amount</th>

                                </tr>
                                </thead>
                                <tbody class="mtop-20 text-left">
                                <tr>
                                    <td style="text-align: left; padding-left: 14px !important;">Subtotal</td>
                                    <td style="text-align: left; padding-left: 14px !important;">{{$booking->payment->sub_total ?? 'Not generated'}}</td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; padding-left: 14px !important;">Other Charges</td>
                                    <td style="text-align: left; padding-left: 14px !important;">{{$booking->payment->other_charges ?? 'Not generated'}}</td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; padding-left: 14px !important;">Discount <br /> @if($booking->payment && $booking->payment->coupon) {{$booking->payment->coupon->name}} @else {{'Not generated' }} @endif</td>
                                    <td style="text-align: left; padding-left: 14px !important;">@if($booking->payment && $booking->payment->discount_amount) {{$booking->payment->discount_amount}} @else {{'Not generated'}} @endif</td>
                                </tr>
                                <tr>
                                    <td style="text-align: left; padding-left: 14px !important;">Tax</td>
                                    <td style="text-align: left; padding-left: 14px !important;">{{$booking->payment->tax ?? 'Not generated'}}</td>
                                </tr>

                                <tr>
                                    <td style="text-align: left; padding-left: 14px !important;">Grand Total</td>
                                    <td style="text-align: left; padding-left: 14px !important;">{{$booking->payment->grand_total ?? 'Not generated'}}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="d-flex   justify-content-center p-10">
                                @if($booking->status != \App\Enums\BookingEnums::$STATUS['in_progress'])
                                    <div class=""><a class="white-text p-10" href="{{route('order-details',["id"=>$booking->id])}}" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');"><button class="btn theme-bg white-text">View More</button></a></div>
                                @endif
                            </div>
                        </div>


                        <div class="tab-pane fade" id="timeline" role="tabpanel" aria-labelledby="past-tab">
                            <div class="d-flex  row  p-10">
                                <div class="d-flex  row  p-10 border-top-pop">

                                    {{--<div class="col-sm-6">
                                        <div class="theme-text f-14 bold">

                                        </div>

                                    </div>--}}




                                </div>
                                <table class="table text-center p-10 theme-text">
                                    <thead class="secondg-bg  p-0">
                                    <tr>
                                        <th scope="col">Status</th>
                                        <th scope="col">Time</th>

                                    </tr>
                                    </thead>
                                    <tbody class="mtop-20">
                                    @foreach($booking->status_history as $status)

                                        <tr class="tb-border  cursor-pointer">

                                           <td>
                                               @switch($status->status)
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
                                                   <span class="status-badge light-bg text-center td-padding">Rebidding</span>
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

                                                   @case(\App\Enums\BookingEnums::$STATUS['hold'])
                                                   <span class=" text-center status-badge red-bg">On Hold</span>
                                                   @break;

                                                   @case(\App\Enums\BookingEnums::$STATUS['bounced'])
                                                   <span class=" text-center status-badge red-bg">Bounced</span>
                                                   @break;

                                                   @case(\App\Enums\BookingEnums::$STATUS['cancel_request'])
                                                   <span class=" text-center status-badge red-bg">Request To Cancel</span>
                                                   @break;

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
                                           </td>
                                            <td>{{\Carbon\Carbon::parse($status->created_at)->format("H:i A, D m Y")}}</td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                                @if(count($booking->status_history)== 0)
                                    <div class="row hide-on-data">
                                        <div class="col-md-12 text-center p-20">
                                            <p class="font14"><i>. This Booking don't have any History.</i></p>
                                        </div>
                                    </div>
                                @endif
                            </div>



                            <div class="d-flex   justify-content-center p-10">

                                @if($booking->status != \App\Enums\BookingEnums::$STATUS['in_progress'])
                                    <div class=""><a class="white-text p-10" href="{{route('order-details',["id"=>$booking->id])}}" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');"><button class="btn theme-bg white-text">View More</button></a></div>
                                    @endif




                            </div>
                        </div>

                    </div>
                </div>
