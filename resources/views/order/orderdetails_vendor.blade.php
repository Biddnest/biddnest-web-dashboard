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
                                    <a class="nav-link active p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-vendor', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Vendor Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-quotation', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Quotation</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-bidding', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Bidding</a>
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

                      <div class="tab-pane fade  show active" id="vendor-details" role="tabpanel" aria-labelledby="vendor-tab">
                        @if(!$booking->organization)
                                <div class="row hide-on-data">
                                    <div class="col-md-12 text-center p-20">
                                        <p class="font14"><i>. No any vendore won bid yet, Vendor not assigned.</i></p>
                                    </div>
                                </div>
                        @else
                              <div class="d-flex  row p-15 pb-0 " >
                          <div class="col-sm-4  secondg-bg  margin-topneg-15 pt-10">
                            <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 5px;">
                              Assigned Vendor
                            </div>
                            <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 5px;">
                              Assigned Vehicle
                            </div>
                            <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 5px;">
                              Assigned Driver
                            </div>
                            <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 5px;">
                              Driver Phone Number
                            </div>
                            <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 5px;">
                              Commission Amount
                            </div>
                            <div class="theme-text f-14 bold p-15 pl-2" style="padding-top: 5px;">
                              Discount
                            </div>



                          </div>

                            <div class="col-sm-7 white-bg  margin-topneg-15 pt-10">

                              <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                  {{ucfirst(trans($booking->organization->org_name))}} {{ucfirst(trans($booking->organization->org_type))}}
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                    @if($booking->vehicle){{ucfirst(trans($booking->vehicle->name))}} {{ucfirst(trans($booking->vehicle->number))}} @else Vehicle is not assigned @endif
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                    @if($booking->driver){{ucfirst(trans($booking->driver->fname))}} {{ucfirst(trans($booking->driver->lname))}} @else Driver is not assigned  @endif
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                   @if($booking->driver) +91 -{{ucfirst(trans($booking->driver->phone))}} @else Driver is not assigned @endif
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                    @if($booking->payment) ₹{{ucfirst(trans($booking->payment->grand_total))}}@else Payment Pending @endif
                                </div>
                                <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                    @if($booking->payment)@if($booking->payment->coupon)@if($booking->payment->coupon->coupon_type == \App\Enums\CouponEnums::$DISCOUNT_TYPE['fixed'])₹@endif{{ucfirst(trans($booking->payment->coupon->discount_amount))}} @if($booking->payment->coupon->coupon_type == \App\Enums\CouponEnums::$DISCOUNT_TYPE['percentage'])% Off @endif @else Coupon not Applied @endif @else Payment Pending @endif
                                </div>

                            </div>


                         {{-- <div class="d-flex flex-row  mtop-5">
                            <i class="icon dripicons-pencil p-1 cursor-pointer theme-text " aria-hidden="true"></i> <a href="{{route('order-details',["id"=>$booking->id])}}" class="ml-1 text-decoration-none primary-text">Edit</a>
                          </div>--}}
                        @endif


                        </div>
                            <div class="border-top-3">
                              <div class="d-flex justify-content-start">
                                  <div class="w-50">
                                      {{-- <a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>--}}
                                  </div>
                                  <div class="w-50 margin-r-20">
                                      <div class="d-flex justify-content-end">
                                          <a   href="{{route('order-details', ['id'=>$booking->id])}}" ><button  class="btn theme-text white-bg theme-br mr-20" style="padding: 10px 60px;">Back</button></a>
                                          <a href="{{route('order-details-quotation', ['id'=>$booking->id])}}" ><button  class="btn white-text theme-bg" style="padding: 10px 60px;">Next</button></a>
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
