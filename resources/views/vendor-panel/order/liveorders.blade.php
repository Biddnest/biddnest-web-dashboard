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
                                    <li class="nav-item ">
                                        <a class="nav-link @if($type == "live") active @endif p-15"
                                           href="{{route('vendor.bookings', ['type'=>"live"])}}" >New Orders</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link @if($type == "participated") active @endif p-15 hide-cards"
                                           href="{{route('vendor.bookings', ['type'=>"participated"])}}" role="tab"
                                        >Participated Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if($type == "scheduled") active @endif p-15" href="{{route('vendor.bookings', ['type'=>"scheduled"])}}">Scheduled Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if($type == "bookmarked") active @endif p-15" href="{{route('vendor.bookings', ['type'=>"bookmarked"])}}">Saved Orders</a>
                                    </li>
                                </ul>
                            </h3>
                        </div>
                        <div class="pt-1 card-head left col-sm-3 ">
                            <div class="search">
                                <a href="#" class="margin-r-20 pt-2" data-toggle="dropdown"
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
                                </div>
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
                                            <th scope="col">Bid Submit</th>
                                        @endif
                                        @if($type != "scheduled")
                                            <th scope="col">Time Left</th>
                                        @endif
                                        @if($type == "live" || $type == "bookmarked")
                                            <th scope="col">Actions</th>
                                        @endif
                                        @if($type == "scheduled")
                                            <th scope="col">Submitted On</th>
                                            <th scope="col">Your Bid</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="mtop-20 text-left f-13">
                                    @foreach($bookings as $booking)
                                        <tr class="tb-border ">
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
                                            <td><span class="timer-bg text-center status-badge timer" data-time="{{$booking->bid_result_at}}"></span>
                                            </td>
                                        @endif
                                        @if($type == "bookmarked")
                                            <td class="">
                                                <i class="p-1">
                                                    <img src="{{asset('static/vendor/images/Icon material-remove-red-eye.svg')}}"
                                                         alt="">


                                                </i>
                                                <i class="p-1"><img
                                                        src="{{asset('static/vendor/images/Icon ionic-md-close-circle.svg')}}"
                                                        alt="" data-toggle="tooltip" data-placement="top"
                                                        title="Reject"></i>

                                            </td>
                                        @endif
                                        @if($type == "live")
                                            <td class="">
                                                <i class=" tooltip-trigger">
                                                    <img src="{{asset('static/vendor/images/acceptmark.svg')}}" alt=""
                                                         data-toggle="tooltip" data-placement="top"
                                                         title="Accept">
                                                </i>
                                                <i data-toggle="modal" data-target="#for-friend"><img
                                                        src="{{asset('static/vendor/images/reject-mark.svg')}}" alt=""
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Reject"></i>
                                                <i><img src="{{asset('static/vendor/images/later-mark.svg')}}" alt=""
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Quote Later"></i>
                                            </td>
                                        @endif
                                        @if($type == "scheduled")
                                            <td>{{date('d M Y', strtotime($booking->bid->submit_at))}}</td>
                                            <td>{{$booking->bid->bid_amount}}</td>
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
