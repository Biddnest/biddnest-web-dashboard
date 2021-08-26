@extends('layouts.app')
@section('title') Orders And Bookings @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="orderBookingspast">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4 f-20">Bookings & Orders</h3>
        <div class="mr-20">
            <a href="{{ route('create-order')}}">
                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1" aria-hidden="true"></i> Create New order</button>
            </a>
        </div>
    </div>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left  pt-0 pb-0 p-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('orders-booking-past')}}">Bookings & Orders</a></li>
                    <li class="breadcrumb-item">Manage Bookings</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-sm-12">
            <div class="card  h-auto p-0 pt-10">
                <div class="d-flex flex-row justify-content-between p-10">
                    <div class=" card-head right text-left">
                        <h3 class=" f-18 pb-0" style="margin-top: 0px !important;">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="live-tab"  href="{{route('enquiry-booking')}}" aria-controls="home" aria-selected="true">Enquiries</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="live-tab"  href="{{route('orders-booking')}}" aria-controls="home" aria-selected="true">Confirmed</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active p-15" id="past-tab" data-toggle="tab" href="#past" role="tab" aria-controls="profile" aria-selected="false">Past</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="live-tab"  href="{{route('orders-booking-hold')}}" aria-controls="home" aria-selected="true">On Hold</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="live-tab"  href="{{route('orders-booking-bounced')}}" aria-controls="home" aria-selected="true">Bounced</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="live-tab"  href="{{route('orders-booking-cancelled')}}" aria-controls="home" aria-selected="true">Cancelled</a>
                                </li>
                            </ul>
                        </h3>
                    </div>
                    <div class="p-1 card-head left col-sm-3">
                        <div class="search">
                            <input type="text" class="searchTerm table-search1" data-url="{{route('orders-booking-past')}}" placeholder="Search...">
                            <button type="submit" class="searchButton1">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Table -->
                <div class="tab-content margin-topneg-42" id="myTabContent">
                    <div class="tab-pane fade show active" id="past" role="tabpanel" aria-labelledby="past-tab">
                        <table class="table text-center p-0   theme-text  ">
                            <thead class="secondg-bg  p-0 f-14">
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">From</th>
                                <th scope="col">To</th>
                                <!-- <th scope="col">Service Type</th> -->
                                <th scope="col" style="width: 22%; ">Order Date</th>
                                <th scope="col" style="width: 23%; ">Assigned Vendor</th>
                                <th scope="col" style="text-align: center !important;">Order Status</th>
                                <th scope="col">Operations</th>
                            </tr>
                            </thead>
                            <tbody class="mtop-20  f-13">
                            @foreach($bookings as $booking)
                                <tr class="tb-border  cursor-pointer sidebar-toggle" data-sidebar="{{ route('sidebar.booking',['id'=>$booking->id]) }}"  {{--onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');"--}}>
                                    <td scope="row">{{$booking->public_booking_id}}</td>
                                    <td>{{json_decode($booking->source_meta, true)['city']}}</td>
                                    <td>{{json_decode($booking->destination_meta, true)['city']}}</td>
                                    <!-- <td>
                                        @switch($booking->service_type)
                                            @case(\App\Enums\BookingEnums::$BOOKING_TYPE['economic'])
                                            {{$booking->service->name}} - Economic
                                            @break

                                            @case(\App\Enums\BookingEnums::$BOOKING_TYPE['premium'])
                                            {{$booking->service->name}} - Premium
                                            @break

                                            @default
                                            {{$booking->service->name}} - Unknown
                                        @endswitch
                                    </td> -->
                                    <td>{{$booking->created_at->format('d M Y')}}</td>
                                    <td>
                                        @if($booking->organization_id)
                                            {{$booking->organization->org_name}} {{$booking->organization->org_type}}
                                        @else
                                            Not Assigned
                                        @endif
                                    </td>
                                    <td class="">

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
                                            <span class="status-badge light-bg  text-center td-padding">Rebidding</span>
                                            @break

                                            @case(\App\Enums\BookingEnums::$STATUS['payment_pending'])
                                            <span class="status-badge secondg-bg  text-center td-padding">Payment Pending</span>
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
                                        @endswitch
                                    </td>

                                    <td class="no-toggle">
                                        <a href="{{route('order-details',["id"=>$booking->id])}}" class="inline-icon-button ml-4"  style="display: flex;"><i class="icon fa fa-eye pb-2" aria-hidden="true"></i></a>
{{--                                        <a href="{{route('order-details',["id"=>$booking->id])}}" class="inline-icon-button"><i class="icon dripicons-trash p-1" aria-hidden="true"></i></a>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(count($bookings)== 0)
                            <div class="row hide-on-data">
                                <div class="col-md-12 text-center p-20">
                                    <p class="font14"><i>. You don't have any Past Orders here.</i></p>
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
