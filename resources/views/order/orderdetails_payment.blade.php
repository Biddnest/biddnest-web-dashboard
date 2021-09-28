@extends('layouts.app')
@section('title') Orders And Bookings @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="orderdetails">
              <div class="d-flex  flex-row justify-content-between">
                  <h3 class="page-head text-left p-4">Order Details</h3>
                  @if(($booking->status == \App\Enums\BookingEnums::$STATUS['enquiry']) || ($booking->status == \App\Enums\BookingEnums::$STATUS['in_progress']))
                      <div class="mr-20">
                          <a href="{{ route('edit-order', ['id'=>$booking->public_booking_id])}}">
                              <button class="btn theme-bg white-text" ><i class="fa fa-plus p-1" aria-hidden="true"></i> Edit order</button>
                          </a>
                      </div>
                  @endif
              </div>
              <div class="d-flex  flex-row justify-content-between">
                <div class="page-head text-left p-4 pt-0 pb-0">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('orders-booking')}}">Booking & Orders</a></li>

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
                            @if(in_array($status, $booking->status_ids) && $key != "in_progress" )
                                <div class="steps-status " style="width: 10%; text-align: center;">
                                    <div class="step-dot">
                                        <img src="{{ asset('static/images/tick.png')}}" />
                                    </div>
                                    <p class="step-title">{{ ucwords(str_replace("_"," ", $key))  }}</p>
                                </div>
                            @elseif($key != "in_progress" && $key != "rebiding" && $key != "cancelled" && $key != "bounced" && $key != "hold" && $key != "cancel_request" )
                                <div class="steps-status " style="width: 10%; text-align: center;">
                                    <div class="step-dot">
                                        <div class="child-dot"></div>
                                    </div>
                                    <p class="step-title">{{ ucwords(str_replace("_"," ", $key))  }}</p>
                                </div>
                            @endif
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
                            <ul class="nav nav-tabs p-0 flex-row" id="myTab" role="tablist" style="font-weight: 600; margin-left: -6px;">
                                <li class="nav-item ">
                                    <a class="nav-link p-15" id="customer-details-tab" data-toggle="tab" href="{{route('order-details', ['id'=>$booking->id])}}" role="tab" aria-controls="home" aria-selected="true">Customer Details</a>
                                </li>
                                @if($booking->status == \App\Enums\BookingEnums::$STATUS['enquiry'])
                                    <li class="nav-item">
                                        <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-estimate', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Action</a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-vendor', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Vendor Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-quotation', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Quotation</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-bidding', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Bidding</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active p-15" id="quotation-tab" data-toggle="tab" href="{{route('order-details-payment', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Payment</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="review-tab" data-toggle="tab" href="{{route('order-details-review', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Review</a>
                                </li>

                            </ul>
                        </h3>

                      </div>
                      <div class="tab-content border-top margin-topneg-7" id="myTabContent">

                      <div class="tab-pane fade show active" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                          @if(!$booking->payment)
                              <div class="row hide-on-data">
                                  <div class="col-md-12 text-center p-20">
                                      <p class="font14"><i>. Payment Pending From Customer.</i></p>
                                  </div>
                              </div>
                          @else
                          <div class="d-flex  row p-15 pb-0 " >
                              <div class="col-sm-4  secondg-bg  margin-topneg-15 pt-10">
                                  <div class="theme-text f-14 bold p-15 pl-0" style="padding-top: 5px;">
                                      Quote By Vendor
                                  </div>
                                  <div class="theme-text f-14 bold p-15 pl-0" style="padding-top: 5px;">
                                      Buffer Amount
                                  </div>
                                  <div class="theme-text f-14 bold p-15 pl-0" style="padding-top: 5px;">
                                      Sub Total
                                  </div>
                                  <div class="theme-text f-14 bold p-15 pl-0" style="padding-top: 5px;">
                                      Discount
                                  </div>
                                  <div class="theme-text f-14 bold p-15 pl-0" style="padding-top: 5px;">
                                      Final Payable
                                  </div>

                              </div>

                              <div class="col-sm-7 white-bg  margin-topneg-15 pt-10">

                                  <div class="theme-text f-14 p-15 pl-0" style="padding-top: 5px;">
                                      ₹{{$booking->payment->sub_total}}
                                  </div>
                                  <div class="theme-text f-14 p-15 pl-0" style="padding-top: 5px;">
                                      ₹{{$booking->payment->other_charges}}
                                  </div>
                                  <div class="theme-text f-14 p-15 pl-0" style="padding-top: 5px;">
                                      ₹{{number_format($booking->payment->sub_total + $booking->payment->other_charges, 2)}}
                                  </div>
                                  <div class="theme-text f-14 p-15 pl-0" style="padding-top: 5px;">
                                      - ₹{{$booking->payment->discount_amount}}
                                  </div>
                                  <div class="theme-text f-14 p-15 pl-0" style="padding-top: 5px;">
                                      ₹{{$booking->payment->grand_total}}
                                  </div>
                                 {{-- <div class="theme-text f-14 p-15 pl-0" style="padding-top: 5px;">
                                      @php $commision_amount = ($booking->organization->commission/100)* $booking->payment->grand_total; @endphp
                                      ₹ {{$commision_amount}}
                                  </div>
                                  <div class="theme-text f-14 p-15 pl-0" style="padding-top: 5px;">
                                      ₹{{$booking->payment->grand_total + $commision_amount}}
                                  </div>--}}

                              </div>

                          </div>
                      @endif

                  <!-- Buttons -->
                      <div class="border-top-3">
                              <div class="d-flex justify-content-start">
                                  <div class="w-50">
{{--                                      <a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>--}}
                                  </div>
                                  <div class="w-50 margin-r-20">
                                      <div class="d-flex justify-content-end">
                                          <a   href="{{route('order-details-bidding', ['id'=>$booking->id])}}" ><button  class="btn theme-text white-bg theme-br mr-20" style="padding: 10px 60px;">Back</button></a>
                                          <a href="{{route('order-details-review', ['id'=>$booking->id])}}" ><button  class="btn white-text theme-bg" style="padding: 10px 60px;">Next</button></a>
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
