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
                            <ul class="nav nav-tabs p-0 flex-row" id="myTab" role="tablist" style="font-weight: 600;">
                                <li class="nav-item ">
                                    <a class="nav-link p-15" id="customer-details-tab" data-toggle="tab" href="{{route('order-details', ['id'=>$booking->id])}}" role="tab" aria-controls="home" aria-selected="true">Customer Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-vendor', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Vendor Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="quotation-tab" data-toggle="tab" href="{{route('order-details-quotation', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Quotation</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="bid-tab" data-toggle="tab" href="{{route('order-details-bidding', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Bidding</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="quotation-tab" data-toggle="tab" href="{{route('order-details-payment', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Payment</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active p-15" id="review-tab" data-toggle="tab" href="{{route('order-details-review', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Review</a>
                                </li>

                            </ul>
                        </h3>

                      </div>
                      <div class="tab-content border-top margin-topneg-7" id="myTabContent">

                      <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                          @if(!$booking->review)
                              <div class="row hide-on-data">
                                  <div class="col-md-12 text-center p-20">
                                      <p class="font14"><i>. Review is not submitted by Customer.</i></p>
                                  </div>
                              </div>
                          @else
                            <div class="d-flex  row p-15 pb-0" >

                                <div class="col-sm-4  secondg-bg margin-topneg-15 pt-10 ">
                                    <div class="theme-text f-14 bold p-15">
                                      Order ID
                                    </div>
                                    <div class="theme-text f-14 bold p-15">
                                      Customer Name
                                    </div>
                                    <div class="theme-text f-14 bold p-15">
                                      Vender Name
                                    </div>
                                    <div class="theme-text f-14 bold p-15">
                                      Review Description
                                    </div>
                                    <div class="theme-text f-14 bold p-15">
                                      Status
                                    </div>
                                    <div class="theme-text f-14 bold p-15">
                                      Ratings
                                    </div>
                                </div>

                                <div class="col-sm-7 white-bg  margin-topneg-15 pt-10">

                                    <div class="theme-text f-14 p-15">
                                      {{$booking->public_booking_id}}
                                    </div>
                                    <div class="theme-text f-14 p-15">
                                      {{ucfirst(trans($booking->user->fname))}} {{ucfirst(trans($booking->user->lname))}}
                                    </div>
                                    <div class="theme-text f-14 p-15">
                                        @if($booking->organization){{ucfirst(trans($booking->organization->org_name))}} {{ucfirst(trans($booking->organization->org_type))}} @endif
                                    </div>
                                    <div class="theme-text f-14 p-15">
                                      {{$booking->review->desc}}
                                    </div>
                                    <div class="theme-text f-14  text-center status-badge mtop-20">
                                      @foreach(\App\Enums\BookingEnums::$STATUS as $status=>$key)
                                          @if($key == $booking->$status)
                                            {{ucfirst(trans($status))}}
                                          @endif
                                      @endforeach
                                    </div>
                                    <div class="theme-text f-14 p-15 mt-2">
                                        @php $ratings = 0; @endphp
                                        @foreach(json_decode($booking->review->ratings, true) as $rating)
                                            @php $ratings += $rating['rating']; @endphp
                                        @endforeach
                                        @php $ratings = number_format($ratings/count(json_decode($booking->review->ratings, true)), 2); @endphp
                                        @for($star=$ratings; $star > 0; $star--)
                                            @if($star < 1)
                                                <i class="fa fa-star-half-o checked bg-yellow" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                            @endif
                                        @endfor
                                        @php $blank_star = floor(5 - $ratings); @endphp

                                        @for($star_o=$blank_star; $star_o >= 1; $star_o--)
                                            <i class="fa fa-star-o bg-yellow" aria-hidden="true"></i>
                                        @endfor
                                    </div>
                                </div>

                           {{-- <div class="d-flex  mtop-5">
                              <i class="icon dripicons-pencil p-1 cursor-pointer theme-text" aria-hidden="true"></i> <a href="#" class="ml-1">Edit</a>
                            </div>--}}


                            </div>
                          @endif

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

    </div>
    </div>



@endsection
