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
                            <h3 class=" f-18 mt-0 pb-0">
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
                                <div class="header-wrap p-0 col-sm-1"  style="display: flex; justify-content: flex-end;  margin-right: -18px;" >
                                    <a href="#" class="margin-20 filter-icon" aria-haspopup="true"  aria-expanded="false"  data-toggle="collapse" data-target="#filter-menu">
                                        <i><img class="" src="{{asset('static/images/filter.svg')}}" alt="" srcset=""></i>
                                    </a>
                                </div>
                                <input type="text"  class="searchTerm table-search" data-url="{{route('vendor.bookings', ['type'=>$type])}}" placeholder="Search...">
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
                            <div class="collapse" id="filter-menu">
                                <a href="#" class="btn theme-bg white-text clear-filter" id="clear">Clear</a>
                                <div class="row f-14">
                                    <div class="col">
                                        <label style="font-weight:500 !important;">Status</label>
                                        <select class="form-control br-5 selectfilter" name="status" data-action="status">
                                            <option value="">--Select--</option>
                                            @foreach(\App\Enums\BookingEnums::$STATUS as $key=>$status)
                                                @if(($status != 0) && ($status != 1) && ($status != 9) && ($status != 10) && ($status != 11) && ($status != 12) && ($status != 13))
                                                    <option value="{{$status}}">{{ucfirst(trans(str_replace("_", " ", $key)))}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label style="font-weight:500 !important;">Moving Date From</label>
                                        <input type="text" id="dateselect" name="payout_date_from" class="singledate form-control br-5 fromdate" placeholder="23/Nov/2020" />
                                    </div>
                                    <div class="col">
                                        <label style="font-weight:500 !important;">Moving Date To</label>
                                        <input type="text" id="dateselect1" name="payout_date_to" class="singledate form-control br-5 todate" placeholder="23/Dec/2020" />
                                    </div>
                                </div>
                            </div>
                            <table class="table text-left p-0  theme-text ">
                                <thead class="secondg-bg  p-0 f-14">
                                    <tr>
                                        <th scope="col" class="text-left" style="padding: 14px;">{{--Order--}} ID</th>
                                        <th scope="col" style="padding: 14px;">From</th>
                                        <th scope="col" style="padding: 14px;">To</th>
                                        <th scope="col" style="padding: 14px;">Order Date</th>
                                        @if($type == "participated")
                                            <th scope="col" style="padding: 14px; text-align: center !important; ">Bid Amount</th>
{{--                                            <th scope="col" style="padding: 14px;">Bid Submit By</th>--}}
                                        @endif
                                        @if($type != "scheduled")
                                            <th scope="col" style="padding: 14px;">Time Left</th>
                                        @endif
                                        @if($type == "participated")
                                            <th scope="col" style="padding: 14px; text-align:center !important">Bid Status</th>
                                        @endif
                                        @if($type == "scheduled")
                                            <th scope="col" style="padding: 14px;">Submitted On</th>
                                            <th scope="col" style="padding: 14px; text-align: center !important; ">Your Bid</th>
                                            <th scope="col" style="text-align: center; padding: 14px; width:20%">Status</th>
                                        @endif
                                        <th scope="col"  style="text-align: center; padding: 14px; padding-left:0 !important">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="mtop-20 text-left f-13">
                                    @foreach($bookings as $booking)
                                        <tr class="tb-border reject_{{$booking->id}}">
                                        <td scope="row" class="text-left" style="padding: 14px;" >
                                            @if($booking->status > \App\Enums\BookingEnums::$STATUS['payment_pending'])
                                                {{$booking->public_booking_id}}
                                            @else
                                                {{$booking->public_enquiry_id}}
                                            @endif
                                        </td>
                                        <td style="padding: 14px;">{{json_decode($booking->source_meta, true)['city']}}</td>
                                        <td style="padding: 14px; " >{{json_decode($booking->destination_meta, true)['city']}}</td>
                                        <td style="padding: 14px; ">{{$booking->created_at->format('d M Y')}}</td>
                                        @if($type == "participated")
                                            <td style="padding: 14px; text-align: center !important; ">{{$booking->bid->bid_amount}}</td>
                                            {{--<td style="padding: 14px;">{{ucfirst(trans($booking->bid->vendor->fname))}} {{ucfirst(trans($booking->bid->vendor->lname))}} </td>--}}
                                        @endif
                                        @if($type != "scheduled")
                                            <td style="padding: 10px;"><span class="timer-bg text-center status-badge timer" data-time="{{$booking->bid_result_at}}" style="min-width: 0px !important;"></span>
                                            </td>
                                        @endif
                                        @if($type == "participated")
                                            <td style="text-align: center;" style="padding: 10px;">
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
                                                    <i class="p-1 tooltip-trigger">
                                                        <img src="{{asset('static/vendor/images/Icon material-remove-red-eye.svg')}}"
                                                             alt="" data-toggle="tooltip" data-placement="top" title="View Order Detail">
                                                    </i>
                                                </a>
                                            </td>
                                        @endif
                                        @if($type == "bookmarked")
                                           {{-- <td class="">
                                                <a href="{{route('vendor.detailsbookings', ['id'=>$booking->public_booking_id])}}">
                                                    <i class="p-1 tooltip-trigger">
                                                        <img src="{{asset('static/vendor/images/Icon material-remove-red-eye.svg')}}"
                                                         alt="" data-toggle="tooltip" data-placement="top"
                                                             title="View Order Detail">
                                                    </i>
                                            </td>--}}
                                                <td class="cursor-pointer" style="padding: 10px;">
                                                    <a  class="inline-icon-button" href="{{route('vendor.detailsbookings', ['id'=>$booking->public_booking_id])}}">
                                                        <i class="tooltip-trigger">
                                                            <img src="{{asset('static/vendor/images/acceptmark.svg')}}" alt=""
                                                                 data-toggle="tooltip" data-placement="top"
                                                                 title="Accept">
                                                        </i>
                                                    </a>
                                                    <a href="#" class="rejected inline-icon-button"  data-parent=".book_{{$booking->id}}" data-url="{{route('api.booking.reject', ['id'=>$booking->public_booking_id])}}" data-confirm="Are you sure, you want reject this Booking? You won't be able to undo this.">
                                                        <i class="tooltip-trigger"><img
                                                                src="{{asset('static/vendor/images/reject-mark.svg')}}" alt=""
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Reject"></i>
                                                    </a>
                                                    <a href="#" class="bookings inline-icon-button" data-url="{{route('api.booking.bookmark', ['id'=>$booking->public_booking_id])}}" data-confirm="Do you want add this booking in Bookmarked?">
                                                        <i class="tooltip-trigger">
                                                            @if($type != "bookmarked"))
                                                                <img src="{{asset('static/vendor/images/later-mark.svg')}}" alt=""
                                                                     data-toggle="tooltip" data-placement="top"
                                                                     title="Add To Bookmark">
                                                            @else
                                                                <img src="{{asset('static/vendor/images/fill-mark.svg')}}" alt=""
                                                                     data-toggle="tooltip" data-placement="top"
                                                                     title="Added To Bookmark">
                                                            @endif
                                                        </i>
                                                    </a>
                                                </td>
                                        @endif
                                        @if($type == "live")
                                            <td class="cursor-pointer" style="padding: 10px;">
                                                <a  class="inline-icon-button" href="{{route('vendor.detailsbookings', ['id'=>$booking->public_booking_id])}}">
                                                    <i class="tooltip-trigger">
                                                        <img src="{{asset('static/vendor/images/acceptmark.svg')}}" alt=""
                                                             data-toggle="tooltip" data-placement="top"
                                                             title="Accept">
                                                    </i>
                                                </a>
                                                <a href="#" class="rejected inline-icon-button"  data-parent=".book_{{$booking->id}}" data-url="{{route('api.booking.reject', ['id'=>$booking->public_booking_id])}}" data-confirm="Are you sure, you want reject this Booking? You won't be able to undo this.">
                                                    <i class="tooltip-trigger"><img
                                                        src="{{asset('static/vendor/images/reject-mark.svg')}}" alt=""
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Reject"></i>
                                                </a>
                                                <a href="#" class="bookings inline-icon-button" data-url="{{route('api.booking.bookmark', ['id'=>$booking->public_booking_id])}}" data-confirm="Do you want add this booking in Bookmarked?">
                                                    <i class="tooltip-trigger">
                                                           @if($type != "bookmarked"))
                                                                <img src="{{asset('static/vendor/images/later-mark.svg')}}" alt=""
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Add To Bookmark">
                                                            @else
                                                                <img src="{{asset('static/vendor/images/fill-mark.svg')}}" alt=""
                                                                     data-toggle="tooltip" data-placement="top"
                                                                     title="Added To Bookmark">
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
                                                        <span class="grey-bg  text-center status-badge complete-bg" style="font-weight: 600!important;">Customer Confirmation Pending</span>
                                                        @break

                                                        @case(\App\Enums\BookingEnums::$STATUS['pending_driver_assign'])
                                                        <span class="badge-light  text-center status-badge complete-bg" style="font-weight: 600!important;">Pending Driver Assign</span>
                                                        @break

                                                        @case(\App\Enums\BookingEnums::$STATUS['awaiting_pickup'])
                                                        <span class="green-bg  text-center status-badge complete-bg" style="font-weight: 600!important;">Awaiting Pickup</span>
                                                        @break

                                                        @case(\App\Enums\BookingEnums::$STATUS['in_transit'])
                                                        <span class="grey-bg  text-center status-badge complete-bg" style="font-weight: 600!important;"> In Transit</span>
                                                        @break

                                                        @case(\App\Enums\BookingEnums::$STATUS['price_review_pending'])
                                                        <span class="grey-bg  text-center status-badge complete-bg" style="font-weight: 600!important;">Price Review Pending</span>
                                                        @break

                                                    @endswitch
                                                </td>
                                            <td class="">
                                                <i class="p-1">
                                                    @switch($booking->status)
                                                        @case(\App\Enums\BookingEnums::$STATUS['payment_pending'])
                                                            <a href="{{route('vendor.schedule-order', ['id'=>$booking->public_booking_id])}}">
                                                                <i class="tooltip-trigger">
                                                                    <img src="{{asset('static/vendor/images/Icon material-remove-red-eye.svg')}}"
                                                                         alt="" data-toggle="tooltip" data-placement="top" title="View Order Detail">
                                                                </i>
                                                            </a>
                                                        @break

                                                        @case(\App\Enums\BookingEnums::$STATUS['pending_driver_assign'])
                                                            <a href="{{route('vendor.driver-details', ['id'=>$booking->public_booking_id])}}">
                                                                <i class="tooltip-trigger">
                                                                    <img src="{{asset('static/vendor/images/Icon material-remove-red-eye.svg')}}"
                                                                         alt="" data-toggle="tooltip" data-placement="top" title="View Order Detail">
                                                                </i>
                                                            </a>
                                                        @break

                                                        @case(\App\Enums\BookingEnums::$STATUS['awaiting_pickup'])
                                                            <a href="{{route('vendor.driver-details', ['id'=>$booking->public_booking_id])}}">
                                                                <i class="tooltip-trigger">
                                                                    <img src="{{asset('static/vendor/images/Icon material-remove-red-eye.svg')}}"
                                                                         alt="" data-toggle="tooltip" data-placement="top" title="View Order Detail">
                                                                </i>
                                                            </a>
                                                        @break

                                                        @case(\App\Enums\BookingEnums::$STATUS['in_transit'])
                                                            <a href="{{route('vendor.in-transit', ['id'=>$booking->public_booking_id])}}">
                                                                <i class="tooltip-trigger">
                                                                    <img src="{{asset('static/vendor/images/Icon material-remove-red-eye.svg')}}"
                                                                         alt="" data-toggle="tooltip" data-placement="top" title="View Order Detail">
                                                                </i>
                                                            </a>
                                                        @break

                                                        @case(\App\Enums\BookingEnums::$STATUS['awaiting_bid_result'])
                                                        <a href="{{route('vendor.in-transit', ['id'=>$booking->public_booking_id])}}">
                                                            <i class="tooltip-trigger">
                                                                <img src="{{asset('static/vendor/images/Icon material-remove-red-eye.svg')}}"
                                                                     alt="" data-toggle="tooltip" data-placement="top" title="View Order Detail">
                                                            </i>
                                                        </a>
                                                        @break

                                                        @case(\App\Enums\BookingEnums::$STATUS['price_review_pending'])
                                                        <a href="{{route('vendor.detailsbookings', ['id'=>$booking->public_booking_id])}}">
                                                            <i class="tooltip-trigger">
                                                                <img src="{{asset('static/vendor/images/Icon material-remove-red-eye.svg')}}"
                                                                     alt="" data-toggle="tooltip" data-placement="top" title="View Order Detail">
                                                            </i>
                                                        </a>
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
                                <li class="f-16 ml-2 mr-2" style="transform: translate(0px, 4px);">Of</li>
                                <li class="digit">{{$bookings->lastPage()}}</li>
                                @if(!$bookings->onFirstPage())
                                    <li class="button" style="transform: translate(0px, 1px);"><a href="{{$bookings->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                    </li>
                                @endif
                                @if($bookings->currentPage() != $bookings->lastPage())
                                    <li class="button" style="transform: translate(0px, 1px);"><a href="{{$bookings->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
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

{{--@section('modal')
    @foreach($bookings as $booking)
        <div class="fullscreen-modal" id="reject-order_{{$booking->id}}" style="min-height: 155%; top: 0px !important;">
    <div class="fullscreen-modal-body reject-order-pop-up" role="document"  style="width: 50% !important; left: 30% !important; top: 80px !important;">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle" style="font-size: 22px;">Reject Order</h5>
            <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close" style="margin-top: -10px !important;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body pb-0 border-none">
            <div class="d-flex  row justify-content-center">
                <h6 class="f-14"> Are you sure you want to REJECT the Order ?</h6>
            </div>
            <div class="modal-footer p-1 border-none">
                <div class="w-50">
                    <a class="white-text close" href="#"  data-dismiss="modal" aria-label="Close" style="opacity: 5; float: left;">
                        <button class="btn theme-br theme-text  white-bg p-button" style="float: left; margin-left: 10px;">NO</button>
                    </a>
                </div>
                <div class="w-50 text-right">
                    <a  href="#" class="white-text p-10 bookings" data-parent="reject_{{$booking->id}}" data-url="{{route('api.booking.reject', ['id'=>$booking->public_booking_id])}}">
                        <button class="btn theme-bg white-text p-button" data-dismiss="modal" >Yes</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
    @endforeach--}}
{{--@endsection--}}
