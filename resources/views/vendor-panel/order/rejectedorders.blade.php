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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('vendor.bookings', ['type'=>"live"])}}">Manage Bookings</a></li>
                        <li class="breadcrumb-item">Rejected orders</li>

                    </ol>
                </nav>


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
                                    <a class="nav-link p-15"  href="{{route('vendor.pastbookings', ['type'=>"past"])}}">Past Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15 active" id="quotation" href="#" >Rejected Orders</a>
                                </li>
                            </ul>
                        </h3>

                            <div class="header-wrap p-0 filter-dropdown ">
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
                                <th scope="col" style="padding: 14px;" class="text-left">Order ID</th>
                                <th scope="col" style="padding: 14px;">From</th>
                                <th scope="col" style="padding: 14px;">To</th>
                                <th scope="col" style="padding: 14px;">Order Date</th>
                            </tr>
                            </thead>
                            <tbody class="mtop-20 f-13">
                            @foreach($bookings as $booking)
                                <tr class="tb-border">
                                    <td  scope="row" class="text-left" style="padding: 14px;">
                                            {{$booking->public_booking_id}}</td>
                                    <td style="padding: 14px;">{{json_decode($booking->source_meta, true)['city']}}</td>
                                    <td style="padding: 14px;">{{json_decode($booking->destination_meta, true)['city']}}</td>
                                    <td style="padding: 14px;" >{{$booking->created_at->format('d M Y')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(count($bookings)== 0)
                            <div class="row hide-on-data">
                                <div class="col-md-12 text-center p-20">
                                    <p class="font14"><i>. You don't any Rejected Bookings here.</i></p>
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
