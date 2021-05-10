@extends('vendor-panel.layouts.frame')
@section('title') Manage Bookings @endsection
@section('body')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="orderlive">
        <div class="d-flex  flex-row justify-content-between" >
            <h3 class="page-head text-left p-4 f-20">Manage Bookings</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Manage Bookings</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Dashboard cards -->
        <div class="vender-all-details">
            <div class="simple-card">
                <p>NEW ORDERS</p>
                <h1>{{$count_booking}}</h1>
            </div>
            <div class="simple-card ">
                <p>Participated Orders</p>
                <h1>{{$participated_booking}}</h1>
            </div>
            <div class="simple-card ">
                <p>Scheduled Orders</p>
                <h1>{{$schedul_booking}}</h1>
            </div>
            <div class="simple-card">
                <p>Saved Orders</p>
                <h1>{{$save_booking}}</h1>
            </div>
            <div class="simple-card ">
                <p>Past Orders</p>
                <h1>{{$past_booking}}</h1>
            </div>


        </div>
        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
            <div class="col-sm-12">
                <div class="card  h-auto p-0 pt-10">
                    <div class="d-flex flex-row justify-content-between p-10">
                        <div class="card-head right text-left">
                            <h3 class=" f-18 pb-0">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @foreach(\App\Enums\BookingEnums::$BOOKING_FETCH_TYPE as $fetch_type)
                                        <li class="nav-item ">
                                            <a class="nav-link @if($type == $fetch_type) active @endif p-15"
                                               href="{{route('vendor.bookings', ['type'=>$fetch_type])}}" >
                                                @if($fetch_type == "live")
                                                    New Orders
                                                @elseif($fetch_type == "participated")
                                                    Participated Orders
                                                @elseif($fetch_type == "scheduled")
                                                    Scheduled Orders
                                                @elseif($fetch_type == "bookmarked")
                                                    Saved Orders
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </h3>
                        </div>
                        <div class="pt-1 card-head left col-sm-3 ">
                            <div class="search">
                                {{--<a href="#" class="margin-r-20 pt-2" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <i><img src="{{asset('static/vendor/images/filter.svg')}}" alt="" srcset=""></i>

                                </a>
                                <div class="dropdown-menu" x-placement="bottom-start">
                                    <a class="dropdown-item border-top-bottom" href="#">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                   id="total-no-orders">
                                            <label class="form-check-label" for="total-no-orders">
                                                From
                                            </label>
                                        </div>
                                    </a>
                                    <a class="dropdown-item border-top-bottom" href="#">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                   id="status">
                                            <label class="form-check-label" for="status">
                                                To
                                            </label>
                                        </div>
                                    </a>
                                    <a class="dropdown-item border-top-bottom" href="#">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                   id="city">
                                            <label class="form-check-label" for="city">
                                                Order
                                            </label>
                                        </div>
                                    </a>
                                </div>--}}
                                <input type="text" class="searchTerm" placeholder="Search...">
                                <button type="submit" class="searchButton">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="tab-content margin-topneg-42" id="myTabContent">

                        <div class="tab-pane fade show active" id="live" role="tabpanel"
                         aria-labelledby="live-tab">
                            <table class="table text-left p-0  theme-text ">
                                <thead class="secondg-bg  p-0 f-14">
                                    <tr>
                                        <th scope="col" class="text-left">Order ID</th>
                                        <th scope="col">From</th>
                                        <th scope="col">To</th>
                                        <th scope="col">Order Date</th>
                                        @if($type == "participated")
                                            <th scope="col">Bid Amount</th>
                                            <th scope="col">Bid Submit By</th>
                                        @endif
                                        @if($type != "scheduled")
                                            <th scope="col">Time Left</th>
                                        @endif
                                        @if($type == "participated")
                                            <th scope="col">Bid Status</th>
                                        @endif
                                        @if($type == "scheduled")
                                            <th scope="col">Submitted On</th>
                                            <th scope="col">Your Bid</th>
                                            <th scope="col" style="text-align: center;">Status</th>
                                        @endif
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="mtop-20 text-left f-13">
                                    @foreach($bookings as $booking)
                                        <tr class="tb-border book_{{$booking->id}}">
                                        <td scope="row" class="text-left"> <a href="order-details.html">
                                                {{$booking->public_booking_id}}</a> </td>
                                        <td>{{json_decode($booking->source_meta, true)['city']}}</td>
                                        <td>{{json_decode($booking->destination_meta, true)['city']}}</td>
                                        <td>{{$booking->created_at->format('d M Y')}}</td>
                                        @if($type == "participated")
                                            <td>{{$booking->bid->bid_amount}}</td>
                                            <td>{{ucfirst(trans($booking->bid->vendor->fname))}} {{ucfirst(trans($booking->bid->vendor->lname))}} </td>
                                        @endif
                                        @if($type != "scheduled")
                                            <td><span class="timer-bg text-center status-badge timer" data-time="{{$booking->bid_result_at}}" style="min-width: 0px !important;"></span>
                                            </td>
                                        @endif
                                        @if($type == "participated")
                                            <td style="text-align: center;">
                                                    @switch($booking->bid->status)
                                                        @case(\App\Enums\BidEnums::$STATUS['bid_submitted'])
                                                            @if($booking->status == \App\Enums\BookingEnums::$STATUS['biding'])
                                                                <span class="bg-light  text-center status-badge complete-bg">Bidding</span>
                                                            @elseif($booking->status == \App\Enums\BookingEnums::$STATUS['rebiding'])
                                                                <span class="badge-light text-center status-badge complete-bg">Re-Bidding</span>
                                                            @endif
                                                        @break

                                                        @case(\App\Enums\BidEnums::$STATUS['lost'])
                                                            <span class="red-bg  text-center status-badge complete-bg">Lost</span>
                                                        @break

                                                    @endswitch
                                            </td>
                                            <td class="">
                                                <a href="{{route('vendor.my-bid', ['id'=>$booking->public_booking_id])}}">
                                                    <i class="p-1">
                                                        <img src="{{asset('static/vendor/images/Icon material-remove-red-eye.svg')}}"
                                                             alt="">
                                                    </i>
                                                </a>
                                            </td>
                                        @endif
                                        @if($type == "bookmarked")
                                            <td class="">
                                                <a href="{{route('vendor.detailsbookings', ['id'=>$booking->public_booking_id])}}">
                                                    <i class="p-1">
                                                        <img src="{{asset('static/vendor/images/Icon material-remove-red-eye.svg')}}"
                                                         alt="">
                                                    </i>
                                                </a>
                                                <a href="#" class="booking inline-icon-button" data-url="{{route('api.booking.reject', ['id'=>$booking->public_booking_id])}}" data-confirm="Are you sure, you want reject this Booking? You won't be able to undo this."><i class="p-1"><img
                                                        src="{{asset('static/vendor/images/Icon ionic-md-close-circle.svg')}}"
                                                        alt="" data-toggle="tooltip" data-placement="top"
                                                        title="Reject"></i></a>

                                            </td>
                                        @endif
                                        @if($type == "live")
                                            <td class="cursor-pointer">
                                                <a href="{{route('vendor.detailsbookings', ['id'=>$booking->public_booking_id])}}">
                                                    <i class="tooltip-trigger">
                                                        <img src="{{asset('static/vendor/images/acceptmark.svg')}}" alt=""
                                                             data-toggle="tooltip" data-placement="top"
                                                             title="Accept">
                                                    </i>
                                                </a>
                                                <a href="#" class="bookings inline-icon-button" data-parent=".book_{{$booking->id}}" data-url="{{route('api.booking.reject', ['id'=>$booking->public_booking_id])}}" data-confirm="Are you sure, you want reject this Booking? You won't be able to undo this.">
                                                    <i class="tooltip-trigger"><img
                                                        src="{{asset('static/vendor/images/reject-mark.svg')}}" alt=""
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Reject"></i>
                                                </a>
                                                <a href="#" class="bookings inline-icon-button" data-url="{{route('api.booking.bookmark', ['id'=>$booking->public_booking_id])}}" data-confirm="Do you want add this booking in Bookmarked?">
                                                    <i class="tooltip-trigger">
                                                        @if($booking->bid->bookmarked == \App\Enums\CommonEnums::$NO)
                                                            <img src="{{asset('static/vendor/images/later-mark.svg')}}" alt=""
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Quote Later">
                                                        @else
                                                            <img src="{{asset('static/vendor/images/fill-mark.svg')}}" alt=""
                                                                 data-toggle="tooltip" data-placement="top"
                                                                 title="Quote Later">
                                                        @endif
                                                    </i>
                                                </a>
                                            </td>
                                        @endif
                                        @if($type == "scheduled")
                                            <td>{{date('d M Y', strtotime($booking->bid->submit_at))}}</td>
                                            <td>{{$booking->bid->bid_amount}}</td>
                                            <td style="text-align: center;">
                                                    @switch($booking->status)
                                                        @case(\App\Enums\BookingEnums::$STATUS['payment_pending'])
                                                        <span class="grey-bg  text-center status-badge complete-bg">Customer Confirmation Pending</span>
                                                        @break

                                                        @case(\App\Enums\BookingEnums::$STATUS['pending_driver_assign'])
                                                        <span class="badge-light  text-center status-badge complete-bg">Pending Driver Assign</span>
                                                        @break

                                                        @case(\App\Enums\BookingEnums::$STATUS['awaiting_pickup'])
                                                        <span class="green-bg  text-center status-badge complete-bg">Awaiting Pickup</span>
                                                        @break

                                                        @case(\App\Enums\BookingEnums::$STATUS['in_transit'])
                                                        <span class="grey-bg  text-center status-badge complete-bg">In Transit</span>
                                                        @break

                                                    @endswitch
                                                </td>
                                            <td class="">
                                                <i class="p-1">
                                                    @switch($booking->status)
                                                        @case(\App\Enums\BookingEnums::$STATUS['payment_pending'])
                                                        <a href="{{route('vendor.schedule-order',['id'=>$booking->public_booking_id])}}"><img src="{{asset('static/vendor/images/Icon material-remove-red-eye.svg')}}"
                                                                                                                                              alt=""></a>
                                                        @break

                                                        @case(\App\Enums\BookingEnums::$STATUS['pending_driver_assign'])
                                                        <a href="{{route('vendor.driver-details',['id'=>$booking->public_booking_id])}}"><img src="{{asset('static/vendor/images/Icon material-remove-red-eye.svg')}}"
                                                                                                                                              alt=""></a>
                                                        @break

                                                        @case(\App\Enums\BookingEnums::$STATUS['awaiting_pickup'])
                                                        <a href="{{route('vendor.driver-details',['id'=>$booking->public_booking_id])}}"><img src="{{asset('static/vendor/images/Icon material-remove-red-eye.svg')}}"
                                                                                                                                              alt=""></a>
                                                        @break

                                                        @case(\App\Enums\BookingEnums::$STATUS['in_transit'])
                                                        <a href="{{route('vendor.in-transit',['id'=>$booking->public_booking_id])}}"><img src="{{asset('static/vendor/images/Icon material-remove-red-eye.svg')}}"
                                                                                                                                              alt=""></a>
                                                        @break

                                                    @endswitch
                                                </i>
                                            </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if(count($bookings)== 0)
                                <div class="row hide-on-data">
                                    <div class="col-md-12 text-center p-20">
                                        <p class="font14"><i>. You don't have any Bookings here.</i></p>
                                    </div>
                                </div>
                            @endif
                        <div class="pagination">
                            <ul>
                                <li class="p-1">Page</li>
                                <li class="digit">{{$bookings->currentPage()}}</li>
                                <li class="label">of</li>
                                <li class="digit">{{$bookings->lastPage()}}</li>
                                @if(!$bookings->onFirstPage())
                                    <li class="button"><a href="{{$bookings->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                    </li>
                                @endif
                                @if($bookings->currentPage() != $bookings->lastPage())
                                    <li class="button"><a href="{{$bookings->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
