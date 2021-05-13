<div class="modal-header">
    <div class="theme-text heading f-18">Order Details</div>
    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close"
                            onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
        <!-- <span aria-hidden="true" >&times;</span> -->
        <i class="fa fa-times theme-text" aria-hidden="true"></i>
    </button>
</div>
<div class="modal-body">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active margin-topneg-15" id="customer" role="tabpanel"
                            aria-labelledby="new-order-tab">
                            <!-- form starts -->
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Order ID
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="theme-text f-14">
                        {{$booking->public_booking_id}}
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="theme-text f-14">
                       {{-- <i class="icon dripicons-pencil p-1 cursor-pointer"
                                        aria-hidden="true"></i>--}}
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Vendor Name
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 d-flex justify-content-between">
                        @if($booking->organization)
                            {{$booking->organization->org_name}} {{$booking->organization->org_type}}
                        @else
                            Vendor not assigned
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Vendor Details
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        @if($booking->organization)
                            {{$booking->organization->email}}
                        @endif
                    </div>
                    <div class="theme-text f-14">
                        @if($booking->organization)
                           +91 {{$booking->organization->phone}}
                        @else
                            Vendor not assigned
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                                        Driver name
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        <div class="d-flex vertical-center">
                            @if($booking->driver)
                                {{$booking->driver->fname}} {{$booking->driver->lname}}
                            @else
                                Driver not assigned
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Driver Details
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        @if($booking->driver)
                            {{$booking->driver->email}}
                        @endif
                    </div>
                    <div class="theme-text f-14">
                        @if($booking->driver)
                            +91 {{$booking->driver->phone}}
                        @else
                            Driver not assigned
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                                        Time value
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        <span class="timer-bg text-center status-badge timer" data-time="{{$booking->bid_result_at}}" style="min-width: 0px !important;"></span>
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10 ">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                                        Order Status
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text status-badge f-14 bold">
                        @switch($booking->status)
                            @case(\App\Enums\BookingEnums::$STATUS['enquiry'])
                                Enquiry
                            @break

                            @case(\App\Enums\BookingEnums::$STATUS['placed'])
                                Placed
                            @break

                            @case(\App\Enums\BookingEnums::$STATUS['biding'])
                                Biding
                            @break

                            @case(\App\Enums\BookingEnums::$STATUS['rebiding'])
                                Rebiding
                            @break

                            @case(\App\Enums\BookingEnums::$STATUS['payment_pending'])
                                Payment Pending
                            @break

                            @case(\App\Enums\BookingEnums::$STATUS['pending_driver_assign'])
                            Pending Driver Assign
                            @break

                            @case(\App\Enums\BookingEnums::$STATUS['awaiting_pickup'])
                            Awaiting Pickup
                            @break

                            @case(\App\Enums\BookingEnums::$STATUS['in_transit'])
                            In Transit
                            @break

                            @case(\App\Enums\BookingEnums::$STATUS['completed'])
                            Completed
                            @break

                            @case(\App\Enums\BookingEnums::$STATUS['cancelled'])
                            Cancelled
                            @break

                        @endswitch
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10 ">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                                        Order Amount
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        @if($booking->final_quote)
                            RS. {{$booking->final_quote}}
                        @else
                            RS. {{$booking->final_estimated_quote}}
                        @endif
                    </div>
                </div>
            </div>

            <div class="d-flex  row  p-10 ">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                                        Inventory
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        @foreach($booking->inventories as $inventory)
                            {{$inventory->name}},
                        @endforeach
                    </div>
                </div>
            </div>
            {{--<div class="d-flex  row  p-10 ">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                                        Payment
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                                        Lorem ipsum
                    </div>
                </div>
            </div>--}}
           {{-- <div class="d-flex   justify-content-center p-10">
                <div class=""><a class="white-text p-10" href="payout-details.html"><button
                                            class="btn theme-bg white-text" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">View More</button></a></div>
            </div>--}}
        </div>
    </div>
</div>
