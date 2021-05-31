@extends('website.layouts.frame')
@section('title')Ongoing Book @endsection
@section('header_title') Ongoing Book @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="orderdetails">
        <div class="container">
            <div class="quote responsive w-70 ontop p-4 bg-white">
                <div class="card-head right text-left  p-8 pt-10 pb-0">
                    <h3 class="f-18">
                        <ul class="nav nav-tabs pt-10 p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15" href="{{route('website.my-profile')}}">My Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15" href="{{route('my-bookings-enquiries')}}">Enquiries</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab active p-15" id="quotation" data-toggle="tab" href="#past" role="tab" aria-controls="profile" aria-selected="false">Ongoing Booking</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15" href="{{route('order-history')}}">Booking History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15" href="{{route('my-request')}}">My Requests</a>
                            </li>
                        </ul>
                    </h3>
                </div>
                <div class="tab-content margin-topneg-7 border-top" id="myTabContent">
                    <div class="tab-pane fade show active " id="past" role="tabpanel" aria-labelledby="past-tab">
                        <div class="container " id="booking-show">
                            <div class=" d-flex justify-content-between direction-col   mt-4 pb-4 border-bottom ">
                                <div class="center mt-1">
                                    <h5>Booking Details</h5>
                                </div>
                                <div class="d-flex direction-col  ">
                                    <div>
                                        <button class="btn btn-booking d-flex theme-text f-14 center mr-3 "><img
                                                src="{{asset('static/website/images/icons/call-button.svg')}}" />Virtual
                                            Assistance</button>
                                    </div>
                                    <div>
                                        <button data-toggle="modal" data-target="#order-detail-modal" class="btn btn-booking d-flex theme-text f-14 center  mr-3"><img
                                                src="{{asset('static/website/images/icons/page.svg')}}" />Order Details</button>
                                    </div>
                                    <div>
                                        <button class="btn btn-booking d-flex theme-text f-14 center  mr-3"><img
                                                src="{{asset('static/website/images/icons/share.svg')}}"
                                                class="share-margin" />Share</button>
                                    </div>
                                    <div>
                                        <button data-toggle="modal" data-target="#manage-modal" class="btn btn-booking d-flex theme-text f-14 center  mr-3"><img
                                                src="{{asset('static/website/images/icons/cross.svg')}}" />Manage Orders</button>
                                    </div>
                                    @if(\App\Enums\BookingEnums::$STATUS['awaiting_pickup'] == $booking->status)
                                        <div>
                                            <button data-toggle="modal" data-target="#pin-modal" class="btn btn-theme-bg padding-btn-res btn-padding">Start trip</button>
                                        </div>
                                    @elseif(\App\Enums\BookingEnums::$STATUS['in_transit'] == $booking->status)
                                        <div>
                                            <button data-toggle="modal" data-target="#pin-modal" class="btn btn-theme-bg padding-btn-res btn-padding">End trip</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row pb-4 border-bottom">

                                <div class="col-md-6 col-sm-12 col-xs-12 border-right pr-5 mt-4 pl-0">
                                    <div class=" d-flex justify-content-between">
                                        <div>
                                            <p class="f-14 ">FROM</p>
                                            <p class="bg-blur f-16"> {{ucwords(json_decode($booking->source_meta, true)['city'])}}</p>
                                        </div>
                                        <div class=" mt-1 pt-3">
                                            <img src="{{asset('static/website/images/icons/moving-truck.svg')}}" />
                                        </div>
                                        <div>
                                            <p class="f-14">TO</p>
                                            <p class="bg-blur f-16" style="width: 132px; text-align: center;">{{ucwords(json_decode($booking->destination_meta, true)['city'])}}</p>
                                        </div>
                                    </div>


                                    <div class="card text-left  details-card  bg-blur" style=" margin-top: 26px;">
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <div>
                                                    <p class="l-cap f-12 mb-0 p-0">Driver</p>
                                                    <p class="mt-0 f-14  p-0">@if($booking->driver){{ucwords($booking->driver->fname)}} {{ucwords($booking->driver->lname)}}@endif</p>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div>
                                                    <p class="l-cap f-12 mb-0  p-0">Vehicle Name</p>
                                                    <p class="f-14  p-0">@if($booking->vehicle){{ucwords($booking->vehicle->name)}} {{$booking->vehicle->number}}@endif</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <div>
                                                    <p class="l-cap f-12 mb-0 p-0">Phone Number</p>
                                                    <p class="mt-0 f-14  p-0">@if($booking->driver){{$booking->driver->phone}}@endif</p>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="pr-1">
                                                    <p class="l-cap f-12 mb-0  p-0">Vehicle Type </p>
                                                    <p class="mt-0 f-14  p-0"> @if($booking->vehicle){{ucwords($booking->vehicle->vehicle_type)}}@endif</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <div>
                                                    <button data-toggle="modal" data-target="#detail-modal" class="btn btn-theme-bg  f-12 " style="padding: 6px 18px;">Send details to
                                                        phone</button>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="pr-3">
                                                    <p class="l-cap f-12 mb-0  p-0">Manpower</p>
                                                    <p class="mt-0 f-14  p-0">@if($booking->bid){{json_decode($booking->bid->meta, true)['min_man_power']}}@endif</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12  col-sm-12 mt-4 pl-4 text-left">
                                    <div class="d-flex justify-content-between" style="width: 94%;">
                                        <div>
                                            <h6 class="l-cap f-14 p-0">Date</h6>
                                            <h5 class="f-16">@if($booking->bid){{date('d M Y', strtotime(json_decode($booking->bid->meta, true)['moving_date']))}}@endif</h5>
                                        </div>
                                        <div>
                                            <h6 class="l-cap f-14">Price </h6>
                                            <h5 class="f-16">Rs. {{$booking->final_quote}}</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex  justify-content-between mt-2 " style="width: 97%;">
                                        <div>
                                            <h6 class="l-cap f-14">Order ID</h6>
                                            <h5 class="f-16">#{{$booking->public_booking_id}}</h5>
                                        </div>
                                        <div>
                                            <h6 class="l-cap f-14">Distance</h6>
                                            <h5 class="f-16">{{json_decode($booking->meta, true)['distance']}} KM</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between  mt-2 " style="width: 92%;">
                                        <div>
                                            <h6 class="l-cap f-14">Status</h6>
                                            <h5 class="f-16">
                                                @switch($booking->status)
                                                    @case(\App\Enums\BookingEnums::$STATUS['pending_driver_assign'])
                                                        Pending Driver Assign
                                                    @break;
                                                    @case(\App\Enums\BookingEnums::$STATUS['awaiting_pickup'])
                                                        Awaiting Pickup
                                                    @break;
                                                    @case(\App\Enums\BookingEnums::$STATUS['in_transit'])
                                                        In Transit
                                                    @break;
                                                    @case(\App\Enums\BookingEnums::$STATUS['completed'])
                                                        Completed
                                                    @break;
                                                    @case(\App\Enums\BookingEnums::$STATUS['cancelled'])
                                                        Cancelled
                                                    @break;
                                                @endswitch
                                            </h5>
                                        </div>
                                        <div class="margin-cat">
                                            <h6 class="l-cap f-14">Category</h6>
                                            <h5 class="f-16">{{ucwords($booking->service->name)}}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-4 ">
                                <h5 class="text-view-center m-auto">
                                    Order Tracking

                                </h5>

                            </div>
                            <div class="onbaording-flow-container mt-2 pb-100">
                                <div class="flow">
                                    <div class="flow__item">
                                        <span class="flow__item__circle " data-onboarding-step="" data-onboarding-step-text="Booked"><img
                                                src="{{asset('static/website/images/icons/check.svg')}}" /></span>
                                    </div>
                                    <div class="flow__item-line" data-onboarding-step="2"></div>
                                    <div class="flow__item">
                                        <div class="flow__item__circle" data-onboarding-step="" data-onboarding-step-text="Payment"><img src="{{asset('static/website/images/icons/card.svg')}}" /></div>
                                    </div>
                                    <div class="flow__item-line" data-onboarding-step="3"></div>
                                    @if(\App\Enums\BookingEnums::$STATUS['pending_driver_assign'] == $booking->status)
                                        <div class="flow__item">
                                            <div class="flow__item__circle bg-purple u-purple-color" data-onboarding-step="" data-onboarding-step-text="Pending Driver Assigned"><img src="{{asset('static/website/images/icons/person1.svg')}}" /></div>
                                        </div>
                                    @else
                                        <div class="flow__item">
                                            <div class="flow__item__circle" data-onboarding-step="" data-onboarding-step-text="Driver Assigned"><img src="{{asset('static/website/images/icons/person.svg')}}" /></div>
                                        </div>
                                    @endif

                                    <div class="flow__item-line" data-onboarding-step="4"></div>
                                    @if(\App\Enums\BookingEnums::$STATUS['awaiting_pickup'] == $booking->status)
                                        <div class="flow__item">
                                            <div class="flow__item__circle bg-purple u-purple-color" data-onboarding-step="" data-onboarding-step-text="Awaiting Pickup"><img src="{{asset('static/website/images/icons/truck1.svg')}}" /></div>
                                        </div>
                                    @else
                                        <div class="flow__item">
                                            <div class="flow__item__circle" data-onboarding-step="" data-onboarding-step-text="Awaiting Pickup"><img src="{{asset('static/website/images/icons/truck.svg')}}" /></div>
                                        </div>
                                    @endif
                                    <div class="flow__item-line" data-onboarding-step="5"></div>
                                    @if(\App\Enums\BookingEnums::$STATUS['in_transit'] == $booking->status)
                                        <div class="flow__item">
                                            <div class="flow__item__circle bg-purple u-purple-color" data-onboarding-step="" data-onboarding-step-text="In Transit"><img src="{{asset('static/website/images/icons/time-truck1.svg')}}" /></div>
                                        </div>
                                    @else
                                        <div class="flow__item">
                                            <div class="flow__item__circle" data-onboarding-step="" data-onboarding-step-text="In Transit"><img src="{{asset('static/website/images/icons/time-truck.svg')}}" /></div>
                                        </div>
                                    @endif
                                    <div class="flow__item-line" data-onboarding-step="6"></div>
                                    @if(\App\Enums\BookingEnums::$STATUS['in_transit'] == $booking->status)
                                        <div class="flow__item">
                                            <div class="flow__item__circle bg-purple u-purple-color" data-onboarding-step="" data-onboarding-step-text="Completed"><img src="{{asset('static/website/images/icons/pin-location1.svg')}}" /></div>
                                        </div>
                                    @else
                                        <div class="flow__item">
                                            <div class="flow__item__circle" data-onboarding-step="" data-onboarding-step-text="Completed"><img src="{{asset('static/website/images/icons/pin-location.svg')}}" /></div>
                                        </div>
                                    @endif
                                </div>
                                <!-- <button onclick="stepFlip()" style="margin-top: 50px;">move</button> -->
                            </div>

                            <!-- Modal Order Details -->
                            <div class="modal fade" id="order-detail-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                                <div class="modal-dialog para-head input-text-blue" role="document">
                                    <div class="modal-content  w-1000 mt-50  right-25">
                                        <div class="modal-header  bg-purple">
                                            <h5 class="modal-title m-0-auto -mr-30 text-white" id="exampleModalLongTitle ">
                                                Order Details</h5>
                                            <button type="button" class="close text-white  " data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body margin-topneg-2 pb-0 mt-0 pt-0">
                                            @foreach($booking->inventories as $inventory)
                                                <div class="row border-bottom d-flex center mt-2">
                                                <div class="col-2 ">
{{--                                                    <i class="icon-order-details fa fa-bed"></i>--}}
                                                    <img class="img-location" src="{{$inventory->inventory->icon ?? '' }}" alt="" style="border-radius: 50%; width: 50px;">
                                                </div>
                                                <div class="col-4">
                                                    <p class="pl-0 mb-0">{{$inventory->name}}</p>
                                                    <div>
                                                        <p class="bg-blur f-12 mb-4">{{$inventory->size}}</p>

                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <p>{{$inventory->material}}</p>
                                                </div>
                                                <div class="col-2">
                                                    <p class="bg-blur bg-blur-num">X
                                                        @if(\App\Enums\BookingInventoryEnums::$QUANTITY['fixed'] == $inventory->quantity_type)
                                                            {{$inventory->quantity}}
                                                        @else
                                                            {{json_decode($inventory->quantity, true)['min']}}-{{json_decode($inventory->quantity, true)['max']}}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="manage-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                                <div class="modal-dialog para-head input-text-blue" role="document">
                                    <div class="modal-content  w-1000 mt-50  right-25">
                                        <div class="modal-header  bg-purple">
                                            <h5 class="modal-title m-0-auto -mr-30 text-white" id="exampleModalLongTitle ">
                                                Manage Order</h5>
                                            <button type="button" class="close text-white  " data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-15 margin-topneg-2">
                                            <div>
                                                <p class="f-16 center text-view-center">How you do like to manage your order
                                                </p>
                                            </div>
                                            <div class="accordion" id="comments">
                                                <div class="button-bottom d-flex justify-content-between text-view-center mr-2-0 pt-4 mr-2 ml-4">
                                                    <div class="">
                                                        <a class="white-text">
                                                            <button data-toggle="modal" data-target="#cancel-modal" class="btn btn-theme-w-bg f-14 padding-btn-max">
                                                                cancel & Refund
                                                            </button>
                                                        </a>
                                                    </div>
                                                    <div class="">
                                                        <a class="reshcedule" data-id="{{$booking->public_booking_id}}" data-url="{{route('reshcedulel_ticket')}}" data-next-url="{{route('my-bookings')}}">
                                                            <button type="button" class="btn btn-theme-bg  f-14  white-bg padding-btn-max">
                                                                Reschedule
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- MOdal Get details on call -->
                            <div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                                <div class="modal-dialog para-head input-text-blue" role="document">
                                    <div class="modal-content  w-1000 mt-50  right-25">
                                        <div class="modal-header  bg-purple">
                                            <h5 class="modal-title m-0-auto -mr-30 text-white" id="exampleModalLongTitle ">
                                                Get details on phone</h5>
                                            <button type="button" class="close text-white  " data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-15 margin-topneg-2">
                                            <div>
                                                <form>
                                                    <div class="row d-flex justify-content-center">

                                                        <div class="col-lg-10 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="formGroupExampleInput" class="mb-0">Phone
                                                                    Number</label>
                                                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="9739912345">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>

                                                <div class="d-flex justify-content-center">
                                                    <a class="white-text " href="#">
                                                        <button class="btn mt-2 mt-1 btn-theme-bg full-width white-bg padding-btn-res">Send
                                                            Details</button>
                                                    </a>
                                                </div>
                                                <div class="mt-1 pt-1">
                                                    <!-- <p class="center light text-view-center mt-3">Did not receive pin?
                                                        <span class="theme-text pl-1 f-bolder">Resend</span></p> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           {{-- <!-- Modal  Reschedule -->
                            <div class="modal fade" id="reschedule-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                                <div class="modal-dialog para-head input-text-blue" role="document">
                                    <div class="modal-content  w-1000 mt-50  right-25">
                                        <div class="modal-header  bg-purple">
                                            <h5 class="modal-title m-0-auto -mr-30 text-white" id="exampleModalLongTitle ">
                                                Reschedule Order</h5>
                                            <button type="button" class="close text-white  " data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body f-w-400 p-15 margin-topneg-2">
                                            <div>
                                                <p class="f-14 center">Terms & Conditions</p>
                                            </div>
                                            <div>
                                                <ol>
                                                    <li class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim
                                                        id est laborum.</li>
                                                    <li class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim
                                                        id est laborum.</li>

                                                </ol>

                                            </div>
                                            <div class="accordion" id="comments">
                                                <div class="button-bottom d-flex justify-content-between mr-2 ml-4 pt-4">
                                                    <div class="">
                                                        <button type="submit" class="btn btn-theme-w-bg p-yes white-bg">No
                                                            <a class="white-text " href="./book-move.html"></a>
                                                        </button>
                                                    </div>
                                                    <div class=""><a class="white-text "><button
                                                                class="btn btn-theme-bg p-yes">Yes</button></a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>--}}
                            <!-- modal -->
                            <div class="modal fade" id="cancel-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                                <div class="modal-dialog para-head input-text-blue" role="document">
                                    <div class="modal-content  w-1000 mt-50  right-25">
                                        <div class="modal-header  bg-purple">
                                            <h5 class="modal-title m-0-auto -mr-30 text-white" id="exampleModalLongTitle ">
                                                Cancel Order</h5>
                                            <button type="button" class="close text-white  " data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body f-w-400 p-15 margin-topneg-2">
                                            <div>
                                                <p class="f-14 center">Terms & Conditions</p>
                                            </div>
                                            <div>
                                                <ol>
                                                    <li class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim
                                                        id est laborum.</li>
                                                    <li class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim
                                                        id est laborum.</li>
                                                </ol>
                                            </div>
                                            <div class="accordion" id="comments">
                                                <div class="button-bottom d-flex justify-content-between mr-2 ml-4 pt-4">
                                                    <div class="">
                                                        <a class="white-text" data-dismiss="modal" aria-label="Close">
                                                            <button class="btn btn-theme-w-bg">No</button>
                                                        </a>
                                                    </div>
                                                    <div class="">
                                                        <a class="white-text reject-booking" data-id="{{$booking->public_booking_id}}" data-url="{{route('cancel_ticket')}}" data-next-url="{{route('my-bookings')}}">
                                                            <button class="btn btn-theme-bg p-yes">Yes</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           {{-- <div class="modal fade" id="reject-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                                <div class="modal-dialog para-head input-text-blue" role="document">
                                    <div class="modal-content ml-4 w-90 mt-50 right-25">
                                        <div class="modal-header bg-purple">
                                            <h5 class="modal-title m-0-auto -mr-30 text-white" id="exampleModalLongTitle ">
                                                Reason for Rejection
                                            </h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-15 margin-topneg-2">
                                            <form>
                                                <div class="col-12">
                                                    <div class="form-input">
                                                        <span class="">
                                                            <select id="" class="form-control">
                                                                <option>High Price</option>
                                                                <option>Lower Quality</option>
                                                                <option>Bad Ideas</option>
                                                            </select>
                                                            <span class="error-message">Please enter valid Phone
                                                                number</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-input">
                                                        <textarea class="form-control" rows="3" placeholder="Enter your expected price here">
                                            </textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-12 d-flex center mt-2 mb-2">
                                                    <div class="form-groups">
                                                        <label class="container-01 p-1 pl-2 m-0">
                                              <input type="checkbox" id="Lift1" />
                                              <span class="checkmark-agree -mt-10"></span>
                                            </label>
                                                    </div>
                                                    <p class="text-muted f-10">Talk to our agend</p>
                                                </div> -->
                                                <button type="submit" class="btn btn-theme-bg button-modal ml-5 text-view-center mt-2 padding-btn-res white-bg">
                                                    Cancel Booking
                                                    <a class="white-text" href="#"></a>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>--}}
                            <!-- Modal -->
                            <div class="modal fade" id="pin-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                                <div class="modal-dialog para-head input-text-blue" role="document">
                                    <div class="modal-content  w-1000 mt-50  right-25">
                                        <div class="modal-header  bg-purple">
                                            <h5 class="modal-title m-0-auto -mr-30 text-white" id="exampleModalLongTitle ">
                                                Pin</h5>
                                            <button type="button" class="close text-white  " data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-15 margin-topneg-2">
                                            <div>
                                                <form>
                                                    @if(\App\Enums\BookingEnums::$STATUS['awaiting_pickup'] == $booking->status)
                                                        <div class="row d-flex justify-content-center">
                                                            @foreach(str_split(json_decode($booking->meta, true)['start_pin']) as $key)
                                                                <div class="col-lg-2 col-xs-2">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="formGroupExampleInput" value="{{$key}}" placeholder="3" readonly>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @elseif(\App\Enums\BookingEnums::$STATUS['in_transit'] == $booking->status)
                                                        <div class="row d-flex justify-content-center">
                                                            @foreach(str_split(json_decode($booking->meta, true)['start_pin']) as $key)
                                                                <div class="col-lg-2 col-xs-2">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" id="formGroupExampleInput" value="{{$key}}" placeholder="3" readonly>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </form>

                                                <div>
                                                    <!-- <p class="center light">Did not receive pin? <span class="theme-text pl-1">Resend</span></p> -->
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <a class="white-text " href="#" data-dismiss="modal" aria-label="Close">
                                                        <button class="btn mt-4 btn-theme-bg full-width white-bg">OKAY</button>
                                                    </a>
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
        </div>
    </div>
@endsection
