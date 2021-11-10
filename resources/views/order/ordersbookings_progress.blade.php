@extends('layouts.app')
@section('title') Orders And Bookings @endsection
@section('content')

    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="orderBookingspast">
        <div class="d-flex  flex-row justify-content-between">
            <h3 class="page-head text-left p-4 f-20">Bookings & Orders</h3>

        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('orders-booking-inprogress')}}">Bookings & Orders</a></li>
                        <li class="breadcrumb-item">Manage Bookings</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
            <div class="col-sm-12">
                <div class="card  h-auto p-0 pt-10">
                    <div class="row no-gutters">
                        <div class="col-sm-8 p-3 ">
                            <h3 class="f-18 pl-8 title" > In Progress Bookings</h3 >
                        </div>
                        <div class="col-sm-1 -mr-4 pt-4 pl-8 ">
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="all-vender-details">
                            <table class="table text-center p-0   theme-text  ">
                                <thead class="secondg-bg  p-0 f-14">
                                <tr>
                                    <th scope="col">Enquiry ID</th>
                                    <th scope="col">From</th>
                                    <th scope="col">To</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col" style="text-align: center !important;">Order Status</th>
                                    <th scope="col">View</th>
                                </tr>
                                </thead>
                                <tbody class="mtop-20  f-13">
                                @foreach($bookings as $booking)
                                    <tr class="tb-border">
                                        <td scope="row">{{$booking->public_enquiry_id}}</td>
                                        <td>@if($booking->source_meta){{json_decode($booking->source_meta, true)['city']}}@endif</td>
                                        <td>@if($booking->destination_meta){{json_decode($booking->destination_meta, true)['city']}}@endif</td>
                                        <td>{{$booking->created_at->format('d M Y')}}</td>
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

                                                @case(\App\Enums\BookingEnums::$STATUS['bounced'])
                                                <span class="status-badge red-bg  text-center td-padding">Bounced</span>
                                                @break

                                                @case(\App\Enums\BookingEnums::$STATUS['cancel_request'])
                                                <span class="status-badge red-bg  text-center td-padding">Request To Cancel</span>
                                                @break

                                                @case(\App\Enums\BookingEnums::$STATUS['in_progress'])
                                                <span class="status-badge red-bg  text-center td-padding">In Progress</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="no-toggle sidebar-toggle_booking" data-sidebar="{{ route('sidebar.booking',['id'=>$booking->id]) }}">
                                            <a href="#" class="inline-icon-button ml-4"  style="display: flex;"><i class="icon fa fa-eye pb-2" aria-hidden="true"></i></a>
                                            {{--                                        <a href="{{route('order-details',["id"=>$booking->id])}}" class="inline-icon-button"><i class="icon dripicons-trash p-1" aria-hidden="true"></i></a>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if(count($bookings)== 0)
                                <div class="row hide-on-data">
                                    <div class="col-md-12 text-center p-20">
                                        <p class="font14"><i>. No Orders Are in Progress.</i></p>
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
