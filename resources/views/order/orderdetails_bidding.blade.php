@extends('layouts.app')
@section('title') Orders And Bookings @endsection
@section('content')

    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="orderdetails">
        <div class="d-flex  flex-row justify-content-between">
            <h3 class="page-head text-left p-4">Order Details</h3>

        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left p-4 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="booking-orders.html">Booking & Orders</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                    </ol>
                </nav>
            </div>

        </div>
        <div class="row">

            <div class="col-md-12" style="padding: 0px 40px; border: none;">
                <div class="card" style="border:none;">

                    <div class="card-body" style="padding: 20px;">

                        <hr class="dash-line">
                        <div class="steps-container">
                            @foreach(\App\Enums\BookingEnums::$STATUS as $key=>$status)
                                <div class="steps-status " style="width: 10%; text-align: center;">
                                    <div class="step-dot">
                                        {{--                                @foreach($booking->status_ids as $status_history)--}}
                                        @if(in_array($status, $booking->status_ids))
                                            <img src="{{ asset('static/images/tick.png')}}" />
                                        @else
                                            <div class="child-dot"></div>
                                        @endif
                                        {{--                                @endforeach--}}
                                    </div>
                                    <p class="step-title">{{ ucwords(str_replace("_"," ", $key))  }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- Dashboard cards -->


        <div class="d-flex flex-row  Dashboard-lcards  justify-content-center">
            <div class="col">
                <!-- <div class="d-flex  flex-row text-left">
                    <a href="booking-orders.html" class="text-decoration-none">
                        <h3 class="page-subhead text-left p-4 f-20 theme-text">
                        <i class="p-1"> <img src="assets/images/Icon feather-chevrons-left.svg" alt="" srcset=""></i> Back to Bookings & Orders</h3></a>

                </div> -->
                <div class="card  h-auto p-0 " >

                    <div class="card-head right text-center  pb-0 p-05" style="padding-top: 0">
                        <h3 class="f-18" style="margin-top: 0;">
                            <ul class="nav nav-tabs p-0 flex-row" id="myTab" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link p-15" id="customer-details-tab" data-toggle="tab" href="{{route('order-details', ['id'=>$booking->id])}}" role="tab" aria-controls="home" aria-selected="true">Customer</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-vendor', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Vendor</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-quotation', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Quotation</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active p-15" id="bidding-tab" data-toggle="tab" href="{{route('order-details-bidding', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Bidding</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="quotation-tab" data-toggle="tab" href="{{route('order-details-payment', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Payment</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="review-tab" data-toggle="tab" href="{{route('order-details-review', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Review</a>
                                </li>

                            </ul>
                        </h3>

                    </div>
                    <div class="tab-content border-top margin-topneg-7" id="myTabContent">

                        <div class="tab-pane fade show active " id="bidding" role="tabpanel" aria-labelledby="quotation-tab">


                            <div class="view-more">

                                <div class="d-flex row p-15  ">
                                    <div class="col-sm-4 p-10 d-felx justify-content-center">


                                        <div class="text-center ">
                                            <h3 class="f-18 theme-text bold p-10">Time Left</h3>

                                            <h1 class="timer" data-time="{{\Carbon\Carbon::parse($booking->bid_result_at)->format('Y-m-d h:i:s')}}"></h1>

                                        </div>

                                    </div>
                                    <div class="col-sm-7 p-10">


                                        <div class=" text-center border-left-blue">
                                            <h3 class="text-center f-18 theme-text bold p-10">Quotation statitics</h3>

                                            <img src="{{asset('static/images/graph/graphbid.svg')}}" alt="" srcset="">

                                        </div>
                                    </div>

                                </div>

                                <div class="d-flex  row  p-10 theme-text ml-20">
                                    @if($booking->status == \App\Enums\BookingEnums::$STATUS['biding'])
                                        <h4>Bidding in Progress: Results will be declared at {{\Carbon\Carbon::parse($booking->bid_result_at)->format("H:iA")}}</h4>
                                    @elseif($booking->status == \App\Enums\BookingEnums::$STATUS['rebiding'])
                                        <h4>Rebidding in Progress: Results will be declared at {{\Carbon\Carbon::parse($booking->bid_result_at)->format("H:iA")}}</h4>
                                    @endif
                                    @foreach($booking->biddings as $bidding)
                                        @if($bidding->status == \App\Enums\BidEnums::$STATUS['won'])
                                    <h4> Top Vendor: {{$bidding->organization->org_name}} | Total Price: ₹{{$bidding->bid_amount}}</h4>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="bidlist-table  border-pop">

                                    <div class="d-flex  row  p-10">



                                        <div class="col-sm-12 ">
                                            <div class="d-flex  p-10  justify-content-between ">
                                                <div class="vertical-center">
                                                    <div class="theme-text f-18 bold">
                                                        Venders Bid List
                                                    </div>

                                                </div>
                                                <div class="vertical-center">
                                                    <a class="assign-btn" href="#"> <button class="btn btn-3">ASSIGN MANUALLY</button> </a>
                                                </div>



                                            </div>
                                            <table class="table text-center p-10 theme-text">
                                                <thead class="secondg-bg  p-0">
                                                <tr>
                                                    <th scope="col" >Vendors Name</th>
                                                    <th scope="col">Commission %</th>
                                                    <th scope="col">Quote</th>
                                                    <th scope="col">Bid Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                </thead>

                                                <tbody class="mtop-15">
                                                @foreach($booking->biddings as $bidding)
                                                <tr class="tb-border  cursor-pointer">
                                                    <td  class="text-center">{{$bidding->organization->org_name ?? "Vendor Name"}}</td>
                                                    <td class="">{{$bidding->organization->commission ?? 10}}%</td>
                                                    <td class="">&#8377;{{$bidding->bid_amount}}</td>
                                                    <td class="">
                                                        @switch($bidding->status)
                                                        @case(\App\Enums\BidEnums::$STATUS['active'])
                                                            <span class="green-bg text-center w-100  td-padding">Yet to Submit</span>
                                                        @break;
                                                        @case(\App\Enums\BidEnums::$STATUS['rejected'])
                                                            <span class="green-bg text-center w-100  td-padding">Rejected</span>
                                                        @break;
                                                        @case(\App\Enums\BidEnums::$STATUS['bid_submitted'])
                                                            <span class="green-bg text-center w-100  td-padding">Submitted</span>
                                                        @break;
                                                        @case(\App\Enums\BidEnums::$STATUS['lost'])
                                                            <span class="green-bg text-center w-100  td-padding">Lost</span>
                                                        @break;
                                                        @case(\App\Enums\BidEnums::$STATUS['won'])
                                                            <span class="green-bg text-center w-100  td-padding">Won</span>
                                                        @break;

                                                        @endswitch

                                                    </td>
                                                    <td class=""><button class="btn btn-primary">Assign</button></td>

                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>


                                    </div>
                                </div>
                                <div class="assign-manul-table  diplay-none border-pop">

                                    <div class="d-flex  row  p-10">



                                        <div class="col-sm-12">
                                            <div class="d-flex  p-10  justify-content-between ">
                                                <div class="vertical-center">
                                                    <div class="theme-text f-18 bold">
                                                        Venders Bid List
                                                    </div>

                                                </div>
                                                <div class="vertical-center">
                                                    <a class="back-btn" href="#"> <button class="white-bg btn btn-3  w-150">BacK</button> </a>
                                                </div>



                                            </div>
                                            <!-- <div class="d-flex  p-10 flex-row
                                            justify-content-between border-pop   br-5
                                            ">
                                             <div class="vertical-center">
                                               <div class="theme-text f-18 bold">
                                                 Venders Bid List
                                               </div>

                                             </div>
                                            <div class="vertical-center">
                                             <button class="back-btn theme-br  white-bg btn   btn-1 w-150"> Back </button>
                                            </div>



                                           </div> -->
                                            <table class="table text-center p-10 theme-text">
                                                <thead class="secondg-bg  p-0">
                                                <tr>
                                                    <th scope="col">Vendors ID</th>
                                                    <th scope="col" >Vendors Name</th>
                                                    <th scope="col" > Total Qoute</th>
                                                    <th scope="col" >Discount from Vendor</th>
                                                    <th scope="col" >ASSIGN MANUALLY</th>

                                                </tr>
                                                </thead>
                                                <tbody class="mtop-15">
                                                <tr class="tb-border  cursor-pointer">
                                                    <th scope="row">V0123456</th>

                                                    <td  class="text-center">Wayne Pvt Ltd <span class=""> Re-Bid</span></td>
                                                    <td class="">₹ 2,300</td>
                                                    <td class="">10%</td>
                                                    <td class=""><button class="white-text   btn-1 m-0 btn">ASSIGN MANUALLY</button></td>

                                                </tr>
                                                <tr class="tb-border  cursor-pointer">
                                                    <th scope="row">V0123456</th>

                                                    <td  class="text-center">Wayne Pvt Ltd <span class=""> Re-Bid</span></td>
                                                    <td class="">₹ 2,300</td>
                                                    <td class="">10%</td>
                                                    <td class=""><button class="white-text   btn-1 m-0 btn">ASSIGN MANUALLY</button></td>

                                                </tr>
                                                <tr class="tb-border  cursor-pointer">
                                                    <th scope="row">V0123456</th>

                                                    <td  class="text-center">Wayne Pvt Ltd <span class=""> Re-Bid</span></td>
                                                    <td class="">₹ 2,300</td>
                                                    <td class="">10%</td>
                                                    <td class=""><button class="white-text   btn-1 m-0 btn">ASSIGN MANUALLY</button> </td>

                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>


                                    </div>
                                </div>

                            </div>



                            <div class="border-top-3">
                                <div class="d-flex justify-content-start">
                                    <div class="w-50">
                                        <a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>
                                    </div>
                                    <div class="w-50 margin-r-20">
                                        <div class="d-flex justify-content-end">
                                            <button  class="btn theme-text white-bg theme-br w-30 mr-20">Back</button>
                                            <button  class="btn white-text theme-bg w-30" >Next</button>
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

    <script type="application/javascript">
        var BID_END_TIME = "{{$booking->bid_end_at}}";
    </script>

@endsection
