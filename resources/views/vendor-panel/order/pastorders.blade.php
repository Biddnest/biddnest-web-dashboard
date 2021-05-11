@extends('vendor-panel.layouts.frame')
@section('title') Manage Bookings @endsection
@section('body')
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="order-past">
    <div class="d-flex  flex-row justify-content-between vertical-center">
        <h3 class="page-head text-left p-4 f-20 theme-text">Past Orders</h3>
        <div class="mr-20">
            <!-- <a href="create-zones.html">
                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1"
                        aria-hidden="true"></i>CREATE New User</button>
            </a> -->

        </div>
    </div>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left  pt-0 pb-0 p-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Manage Bookings</li>
                    <li class="breadcrumb-item"><a href="#">Past orders </a></li>

                </ol>
            </nav>


        </div>

    </div>



    <!-- Dashboard cards -->


    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-sm-12">
            <div class="card  h-auto  pt-8 p-0">


                <div class="header-wrap">
                    <h3 class="f-18 ml-1 theme_text">Past Orders </h1>

                        <div class="header-wrap p-0 filter-dropdown ">
                            {{--<a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <i><img src="{{asset('static/vendor/images/filter.svg')}}" alt="" srcset=""></i>

                            </a>
                            <div class="dropdown-menu">
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
                                        <input class="form-check-input" type="checkbox" value="" id="status">
                                        <label class="form-check-label" for="status">
                                            To
                                        </label>
                                    </div>
                                </a>
                                <a class="dropdown-item border-top-bottom" href="#">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="city">
                                        <label class="form-check-label" for="city">
                                            Order
                                        </label>
                                    </div>
                                </a>



                            </div>--}}
                            <div class="search">
                                <input type="text" class="searchTerm table-search" data-url="{{route('vendor.pastbookings', ['type'=>"past"])}}" placeholder="Search...">
                                <button type="submit" class="searchButton">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>


                </div>





                <div class="all-vender-details">
                    <table class="table text-left p-0  theme-text ">
                        <thead class="secondg-bg  p-0 f-14">
                        <tr>
                            <th scope="col" class="text-left">Order ID</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Date of Movement</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Order Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody class="mtop-20 f-13">
                            @foreach($bookings as $booking)
                                <tr class="tb-border">
                                    <td scope="row" class="text-left"> <a href="order-details.html">
                                            {{$booking->public_booking_id}}</a> </td>
                                    <td>{{json_decode($booking->source_meta, true)['city']}}</td>
                                    <td>{{json_decode($booking->destination_meta, true)['city']}}</td>
                                    <td>{{$booking->created_at->format('d M Y')}}</td>
                                    <td>{{json_decode($booking->bid->meta, true)['moving_date']}}</td>
                                    <td>{{$booking->final_quote}}</td>
                                    <td class=""><span class="complete-bg  text-center td-padding">
                                            @if($booking->status == \App\Enums\BookingEnums::$STATUS['completed'])
                                                Completed
                                            @elseif($booking->status ==\App\Enums\BookingEnums::$STATUS['cancelled'])
                                                cancelled
                                            @endif
                                        </span></td>
                                    <td><a href="{{route('vendor.complete-order',['id'=>$booking->public_booking_id])}}"><img src="{{asset('static/vendor/images/Icon material-remove-red-eye.svg')}}"
                                                                                                                          alt=""></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($bookings)== 0)
                        <div class="row hide-on-data">
                            <div class="col-md-12 text-center p-20">
                                <p class="font14"><i>. You don't any Bookings here.</i></p>
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
