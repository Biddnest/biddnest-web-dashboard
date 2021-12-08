@extends('layouts.app')
@section('title')Search Result @endsection
@section('content')
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="SearchResult">
    <div class="d-flex  flex-row justify-content-between vertical-center">
        <h3 class="page-head text-left p-4 f-20 theme-text">Search Result</h3>
        <div class="mr-20">
            <!-- <a href="create-zones.html">
                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1"
                        aria-hidden="true"></i>CREATE New User</button>
            </a> -->

        </div>
    </div>
    



    <!-- Dashboard cards -->


    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-sm-12">
            <div class="card  h-auto  pt-8 p-0">
                <div class="header-wrap">
                    <h3 class="f-18 mt-0 ml-1 mb-0 theme_text">
                        <ul class="nav nav-tabs pt-10 p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link p-15 active"  href="#">Search Result</a>
                            </li>
                        </ul>
                    </h3>
                        <div class="header-wrap p-0 filter-dropdown ">
                            
                        </div>
                </div>

                <div class="all-vender-details">
                    <table class="table text-left p-0  theme-text ">
                        <thead class="secondg-bg  p-0 f-14">
                        <tr>
                            <th scope="col" style="padding: 14px;" class="text-left">Order ID</th>
                            <th scope="col" style="padding: 14px;">From</th>
                            <th scope="col" style="padding: 14px;">To</th>
                            <th scope="col" style="padding: 14px;">Order Date</th>
{{--                            <th scope="col" style="padding-left: 36px !important; padding: 14px;">Date of Movement</th>--}}
                            <th scope="col" style="padding-left: 36px !important; padding: 14px;">Amount</th>
                            <th scope="col" style="text-align: center !important; padding: 14px;">Order Status</th>
                            <th scope="col" style="padding: 14px;">Action</th>
                        </tr>
                        </thead>
                        <tbody class="mtop-20 f-13">
                            @foreach($bookings as $booking)
                                <tr class="tb-border">
                                    <td  scope="row" class="text-left" style="padding: 14px;">
                                            {{$booking->public_booking_id}}</td>
                                    <td style="padding: 14px;">{{json_decode($booking->source_meta, true)['city'] ?? ''}}</td>
                                    <td style="padding: 14px;">{{json_decode($booking->destination_meta, true)['city'] ?? ''}}</td>
                                    <td style="padding: 14px;" >{{$booking->created_at->format('d M Y')}}</td>
{{--                                    <td style="text-align: center !important; padding: 14px;">{{json_decode($booking->bid->meta, true)['moving_date']}}</td>--}}
                                    <td style="text-align: center !important; padding: 14px;">{{$booking->final_quote ?? "-"}}</td>
                                    <td class="" style="padding: 14px;">
                                        @switch($booking->status)
                                            @case(\App\Enums\BookingEnums::$STATUS['enquiry'])
                                                @php $color = \App\Enums\BookingEnums::$COLOR_CODE['enquiry']; @endphp
                                                <span class="grey-bg  text-center status-badge complete-bg" style="background-color:{{$color}}; font-weight: 600!important; color: #FFFFFF;">Enquiry</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['placed'])
                                                @php $color = \App\Enums\BookingEnums::$COLOR_CODE['placed']; @endphp
                                                <span class="badge-light  text-center status-badge complete-bg" style="background-color:{{$color}}; font-weight: 600!important; color: #FFFFFF;">Placed</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['biding'])
                                                @php $color = \App\Enums\BookingEnums::$COLOR_CODE['biding']; @endphp
                                                <span class="green-bg  text-center status-badge complete-bg" style="background-color:{{$color}}; font-weight: 600!important; color: #FFFFFF;">Biding</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['rebiding'])
                                                @php $color = \App\Enums\BookingEnums::$COLOR_CODE['rebiding']; @endphp
                                                <span class="grey-bg  text-center status-badge complete-bg" style="background-color:{{$color}}; font-weight: 600!important; color: #FFFFFF;">Rebiding</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['payment_pending'])
                                                @php $color = \App\Enums\BookingEnums::$COLOR_CODE['payment_pending']; @endphp
                                                <span class="grey-bg  text-center status-badge complete-bg" style="background-color:{{$color}}; font-weight: 600!important; color: #FFFFFF;">Payment Pending</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['pending_driver_assign'])
                                                @php $color = \App\Enums\BookingEnums::$COLOR_CODE['pending_driver_assign']; @endphp
                                                <span class="grey-bg  text-center status-badge complete-bg" style="background-color:{{$color}}; font-weight: 600!important; color: #FFFFFF;">Pending Driver Assign</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['awaiting_pickup'])
                                                @php $color = \App\Enums\BookingEnums::$COLOR_CODE['awaiting_pickup']; @endphp
                                                <span class="grey-bg  text-center status-badge complete-bg" style="background-color:{{$color}}; font-weight: 600!important; color: #FFFFFF;">Awaiting Pickup</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['in_transit'])
                                                @php $color = \App\Enums\BookingEnums::$COLOR_CODE['in_transit']; @endphp
                                                <span class="grey-bg  text-center status-badge complete-bg" style="background-color:{{$color}}; font-weight: 600!important; color: #FFFFFF;">In Transit</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['completed'])
                                                @php $color = \App\Enums\BookingEnums::$COLOR_CODE['completed']; @endphp
                                                <span class="grey-bg  text-center status-badge complete-bg" style="background-color:{{$color}}; font-weight: 600!important; color: #FFFFFF;">Completed</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['cancelled'])
                                                @php $color = \App\Enums\BookingEnums::$COLOR_CODE['cancelled']; @endphp
                                                <span class="grey-bg  text-center status-badge complete-bg" style="background-color:{{$color}}; font-weight: 600!important; color: #FFFFFF;">Cancelled</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['bounced'])
                                                @php $color = \App\Enums\BookingEnums::$COLOR_CODE['bounced']; @endphp
                                                <span class="grey-bg  text-center status-badge complete-bg" style="background-color:{{$color}}; font-weight: 600!important; color: #FFFFFF;">Bounced</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['hold'])
                                                @php $color = \App\Enums\BookingEnums::$COLOR_CODE['bounced']; @endphp
                                                <span class="text-center status-badge" style="background-color:{{$color}}; font-weight: 600!important; color: #FFFFFF;">Hold</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['cancel_request'])
                                                @php $color = \App\Enums\BookingEnums::$COLOR_CODE['cancelrequest']; @endphp
                                                <span class="grey-bg  text-center status-badge complete-bg" style="background-color:{{$color}}; font-weight: 600!important; color: #FFFFFF;">Cancel Request</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['in_progress'])
                                                @php $color = \App\Enums\BookingEnums::$COLOR_CODE['in_progress']; @endphp
                                                <span class="grey-bg  text-center status-badge complete-bg" style="background-color:{{$color}}; font-weight: 600!important; color: #FFFFFF;">In progress</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['awaiting_bid_result'])
                                                @php $color = \App\Enums\BookingEnums::$COLOR_CODE['awaiting_bid_result']; @endphp
                                                <span class="grey-bg  text-center status-badge complete-bg" style="background-color:{{$color}}; font-weight: 600!important; color: #FFFFFF;">Awaiting Bid Result</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['price_review_pending'])
                                                @php $color = \App\Enums\BookingEnums::$COLOR_CODE['price_review_pending']; @endphp
                                                <span class="text-center status-badge" style="background-color:{{$color}}; font-weight: 600!important; color: #FFFFFF;">Price Review Pending</span>
                                            @break

                                        @endswitch
                                    </td>
                                    <td style="padding: 14px;"><a href="{{route('order-details',['id'=>$booking->id])}}">
                                            <i class="tooltip-trigger">
                                                <img src="{{asset('static/vendor/images/Icon material-remove-red-eye.svg')}}" alt="" >
                                            </i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                     @if($bookings && (count($bookings) == 0))
                        <div class="row hide-on-data">
                            <div class="col-md-12 text-center p-20">
                                <p class="font14"><i>. You don't have any Bookings on this search.</i></p>
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
@endsection
