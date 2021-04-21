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

              <!-- Dashboard cards -->

    <div class="row">

        <div class="col-md-12" style="padding: 0px 40px; border: none;">
            <div class="card" style="border:none;">

                <div class="card-body" style="padding: 20px;">

                    <hr class="dash-line">
                    <div class="steps-container">
                        @foreach(\App\Enums\BookingEnums::$STATUS as $key=>$status)
                        <div class="steps-status ">
                            <div class="step-dot">
                                @foreach($booking->status_history as $status_history)
                                @if($status_history->status == $status)
                                    <img src="{{ asset('static/images/tick.png')}}" />
{{--                                 @else--}}
{{--                                        <div class="child-dot"></div>--}}
                                 @endif
                                @endforeach
                            </div>
                            <p class="step-title">{{ ucwords(str_replace("_"," ", $key))  }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

    </div>
              <div class="d-flex flex-row  Dashboard-lcards  justify-content-center">
                <div class="col">
                  <div class="card  h-auto p-0 " >
                      <div class="card-head right text-center  pb-0 p-05" style="padding-top: 0">
                        <h3 class="f-18" style="margin-top: 0;">
                          <ul class="nav nav-tabs p-0 flex-row" id="myTab" role="tablist">
                            <li class="nav-item ">
                              <a class="nav-link active p-15" id="customer-details-tab" data-toggle="tab" href="#customer-details" role="tab" aria-controls="home" aria-selected="true">Customer</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="#vendor-details" role="tab" aria-controls="profile" aria-selected="false">Vendor</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link p-15" id="quotation-tab" data-toggle="tab" href="#quotation" role="tab" aria-controls="profile" aria-selected="false">Payment</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link p-15" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="profile" aria-selected="false">Review</a>
                            </li>

                          </ul>
                        </h3>
                      </div>
                      <div class="tab-content border-top margin-topneg-7" id="myTabContent">

                        <div class="tab-pane fade show active" id="customer-details" role="tabpanel" aria-labelledby="customer-details-tab">

                            <div class="d-flex  row p-15 pb-0" >

                              <div class="col-sm-4 secondg-bg margin-topneg-15 pt-10">
                                <div class="theme-text f-14 bold p-15">
                                  Order ID
                                </div>
                                <div class="theme-text f-14 bold p-15">
                                  Vendor Name
                                </div>
                                <div class="theme-text f-14 bold p-15">
                                  Vendor Details
                                </div>
                                <div class="theme-text f-14 bold p-15">
                                  Driver Name
                                </div>
                                <div class="theme-text f-14 bold p-15">
                                  Driver Email
                                </div>
                                <div class="theme-text f-14 bold p-15">
                                  Timer Value
                                </div>
                                <div class="theme-text f-14 bold p-15">
                                  Order Status
                                </div>
                                <div class="theme-text f-14 bold p-15">
                                  Order Amount
                                </div>
                                <div class="theme-text f-14 bold p-15">
                                  Address
                                </div>
                              </div>

                              <div class="col-sm-7 white-bg  margin-topneg-15 pt-10">

                                <div class="theme-text f-14 p-15">
                                  SKU1234456
                                </div>
                                <div class="theme-text f-14 p-15">
                                  Wayne Pvt Ltd
                                </div>
                                <div class="theme-text f-14 p-15">
                                  support@wayne.com
                                </div>
                                <div class="theme-text f-14 p-15">
                                  David Jerome
                                </div>
                                <div class="theme-text f-14 p-15">
                                  davidjerome@ymail.com
                                </div>
                                <div class="theme-text f-14 p-15">
                                  00:03:20
                                </div>
                                <div class="theme-text f-14  status-badge text-center  ">
                                  Awaiting Pickup
                                </div>
                                <div class="theme-text f-14 p-15 mt-2">
                                  ₹ 2,300
                                </div>
                                <div class="theme-text f-14 p-15 ">
                                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero
                                </div>
                              </div>

                              <div class="d-flex  mtop-5">
                                <i class="icon dripicons-pencil p-1 cursor-pointer " aria-hidden="true"></i> <a href="#" class="ml-1 text-decoration-none primary-text">Edit</a>
                              </div>
                            </div>


                            <div class="d-flex  row  p-15 pt-0 ">

                              <div class="col-sm-12 border-top-pop">
                                <div class="theme-text f-14 bold pt-10">
                                  Inventory List
                                </div>

                              </div>




                            </div>
                            <table class="table text-center p-10 theme-text">
                              <thead class="secondg-bg  p-0 f-14">
                                <tr>
                                  <th scope="col">Item Name</th>
                                  <th scope="col" >Quantity</th>
                                  <th scope="col" >Size</th>

                                </tr>
                              </thead>
                              <tbody class="mtop-15">
                                <tr class="tb-border  cursor-pointer">
                                  <th scope="row">sku123456</th>

                                  <td  class="text-center">2</td>
                                  <td class=""><span class=" status-badge">Large</span></td>

                                </tr>
                                <tr class="tb-border  cursor-pointer">
                                  <th scope="row">sku123456</th>

                                  <td>4</td>
                                  <td class=""><span class="status-badge red-bg">Medium</span></td>

                                </tr>
                                <tr class="tb-border  cursor-pointer">
                                  <th scope="row">sku123456</th>

                                  <td>23</td>
                                  <td class=""><span class="status-badge light-bg">Small</span></td>

                                </tr>
                              </tbody>
                            </table>
                            <div class="border-top-3">
            <div class="d-flex justify-content-between">
                <div class="w-100">
                    <a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Back</button></a>
                </div>
                <div class="w-100 margin-r-20">
                    <div class="d-flex justify-content-end">
                     <div></div>
                        <button  class="btn white-text theme-bg w-30">Next</button>
                    </div>

                </div>
            </div>

                        </div>


                        <!-- Tab-1 form -->
                      </div>
                      <div class="tab-pane fade   " id="vendor-details" role="tabpanel" aria-labelledby="vendor-tab">



                        <div class="d-flex  row p-15 pb-0 " >

                          <div class="col-sm-4  secondg-bg  margin-topneg-15 pt-10">
                            <div class="theme-text f-14 bold p-15">
                              Assigned Vendor
                            </div>
                            <div class="theme-text f-14 bold p-15">
                              Assigned Vehicle
                            </div>
                            <div class="theme-text f-14 bold p-15">
                              Assigned Driver
                            </div>
                            <div class="theme-text f-14 bold p-15">
                              Driver Phone Number
                            </div>
                            <div class="theme-text f-14 bold p-15">
                              Commission Amount
                            </div>
                            <div class="theme-text f-14 bold p-15">
                              Discount From Vendor
                            </div>



                          </div>

                            <div class="col-sm-7 white-bg  margin-topneg-15 pt-10">

                              <div class="theme-text f-14 p-15">
                                  Wayne Pvt Ltd
                                </div>
                                <div class="theme-text f-14 p-15">
                                  KA03 B 1165
                                </div>
                                <div class="theme-text f-14 p-15">
                                  Abhi Ram
                                </div>
                                <div class="theme-text f-14 p-15">
                                  +91 - 9725364758
                                </div>
                                <div class="theme-text f-14 p-15">
                                  ₹ 2,300
                                </div>
                                <div class="theme-text f-14 p-15">
                                  30% Off
                                </div>



                            </div>

                          <div class="d-flex flex-row  mtop-5">
                            <i class="icon dripicons-pencil p-1 cursor-pointer theme-text " aria-hidden="true"></i> <a href="#" class="ml-1 text-decoration-none primary-text">Edit</a>
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
                      <div class="tab-pane fade  " id="quotation" role="tabpanel" aria-labelledby="quotation-tab">



                        <div class="d-flex  row p-15 quotation-main pb-0" >

                          <div class="col-sm-4 secondg-bg margin-topneg-15 pt-10">
                            <div class="theme-text f-14 bold p-15">
                              Assigned Vendor
                            </div>


                            <div class="theme-text f-14 bold p-15">
                              Commission Amount
                            </div>
                            <div class="theme-text f-14 bold p-15">
                              Discount From Vendor
                            </div>
                            <div class="theme-text f-14 bold p-15">
                              Base Price
                            </div>



                          </div>

                          <div class="col-sm-7 white-bg  margin-topneg-15 pt-10">

                              <div class="theme-text f-14 p-15">
                                  Wayne Pvt Ltd
                                </div>

                                <div class="theme-text f-14 p-15">
                                  ₹ 2,300
                                </div>
                                <div class="theme-text f-14 p-15">
                                  30% Off
                                </div>
                                <div class="theme-text f-14 p-15">
                                  ₹ 1,864
                                </div>
                                <div class="theme-text f-14 p-15">
                                  <a href="#" class="bold text-decoration-none q-viewmore">View More</a>
                                </div>



                            </div>

                            <div class="d-flex  mtop-5">
                              <i class="icon dripicons-pencil p-1 cursor-pointer theme-text" aria-hidden="true"></i> <a href="#" class="ml-1 text-decoration-none primary-text">Edit</a>
                            </div>


                        </div>
                        <!-- view more -->
                  <div class="diplay-none view-more">

                    <div class="d-flex row p-15  ">
                      <div class="col-sm-4 p-10 d-felx justify-content-center">


                        <div class="text-center ">
                          <h3 class="f-18 theme-text bold p-10">Time Left</h3>

                            <!-- <div class="pie degree">
                              <span class="block"></span>
                            <span id="time">30</span>
                            </div>  -->

                            <div id="app"></div>

                        </div>

                      </div>
                      <div class="col-sm-7 p-10">


                        <div class=" text-center border-left-blue">
                          <h3 class="text-center f-18 theme-text bold p-10">Quotation statitics</h3>

                      <img src="{{ asset('static/images/graph/graphbid.svg')}}" alt="" srcset="">

                        </div>
                      </div>

                            </div>

                            <div class="d-flex  row  p-10 theme-text ml-20">
                              <h4> Top Vendor: Wayne Pvt Ltd | Total Price: ₹ 2,300</h4>

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
                                        <th scope="col">Vendors ID</th>
                                        <th scope="col" >Vendors Name</th>
                                        <th scope="col" >  Total Qoute</th>
                                        <th scope="col" >Discount from Vendor</th>
                                        <th scope="col" >Commission Rate</th>

                                      </tr>
                                    </thead>
                                    <tbody class="mtop-15">
                                      <tr class="tb-border  cursor-pointer">
                                        <th scope="row">V0123456</th>

                                        <td  class="text-center">Wayne Pvt Ltd <span class=""> Re-Bid</span></td>
                                        <td class="">₹ 2,300</td>
                                        <td class="">10%</td>
                                        <td class="">10%</td>

                                      </tr>
                                      <tr class="tb-border  cursor-pointer">
                                        <th scope="row">V0123456</th>

                                        <td  class="text-center">Wayne Pvt Ltd <span class=""> Re-Bid</span></td>
                                        <td class="">₹ 2,300</td>
                                        <td class="">10%</td>
                                        <td class="">10%</td>

                                      </tr>
                                      <tr class="tb-border  cursor-pointer">
                                        <th scope="row">V0123456</th>

                                        <td  class="text-center">Wayne Pvt Ltd <span class=""> Re-Bid</span></td>
                                        <td class="">₹ 2,300</td>
                                        <td class="">10%</td>
                                        <td class="">10%</td>

                                      </tr>
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
                      <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">

                    <div class="m-auto w-50  f-14 theme-text pb-25 secondg-bg p-8">

                      <div class="d-flex p-10">
                        <ul class="steps">
                          <li class="step step--incomplete step--active step-1">
                            <span class="step__icon payment-card"></span>

                          </li>
                          <li class="step step--incomplete step--inactive ">
                            <span class="step__icon payment-edit step-2"></span>

                          </li>
                          <li class="step step--incomplete step--inactive ">
                            <span class="step__icon payment-done step-3"></span>

                          </li>

                        </ul>

                      </div>


                      <div class= "sub-total">
                        <div class="d-flex justify-content-between p-10 ">

                          <div class="col-sm-4"> Sub Total - 1</div>
                          <div></div>
                          </div>
                          <div class="d-flex  justify-content-between p-10">

                            <div class="col-sm-4">Sub Total - 1</div>
                            <div class="col-sm-4"> ₹ 5200</div>
                              </div>
                              <div class="d-flex flex-row justify-content-between p-10">

                              <div class="col-sm-4">Buffer Amount</div>
                              <div class="col-sm-4">₹ 520</div>
                                </div>
                                <div class="d-flex justify-content-between p-10">

                                <div class="col-sm-4">Sub Total - 1</div>
                                <div class="col-sm-4">₹ 5720</div>
                                  </div>
                                  <div class="d-flex justify-content-between p-10">

                                  <div class="col-sm-4">Commission</div>
                                  <div class="col-sm-4">      ₹ 1144</div>
                                    </div>

                                <div class="d-flex justify-content-between p-10 border-bottom border-top-3">

                                  <div class="col-sm-4"> Total</div>
                                  <div class="col-sm-4">₹ 6,864</div>
                                  </div>
                      </div>

                    <div class="payment-status diplay-none">
                      <div class="d-flex  justify-content-between p-10">

                        <div class="col-sm-4">Status</div>
                        <div class="col-sm-4 status-badge-2 danger-bg btn m-0 p-05"> Pending</div>
                        </div>
                        <div class="d-flex  justify-content-between p-10 white-space">

                          <div class="col-sm-4">Generate Payment Link </div>
                          <button class="col-sm-4  btn m-0 p-05 status-badge green-bg"> <img src="{{ asset('static/images/Icon metro-link.svg')}}" alt="" srcset="">
                            <span>Link</span> </button>
                          </div>
                          <div class="d-flex  justify-content-between p-10">

                            <div class="col-sm-4">Share via </div>
                            <button class="col-sm-4 status-badge-2 btn m-0 p-05 info-bg">  email/sms</button>
                            </div>
                    </div>
                    <div class="paid-status diplay-none">
                      <div class="d-flex  justify-content-between p-10">

                        <div class="col-sm-4">Status</div>
                        <div class="col-sm-4 status-badge-2">Paid</div>
                        </div>


                    </div>
                    <div class="payment-suscessful diplay-none d-felx justify-content-center">
                      <div class="d-flex p-10 vertical-center text-center ">

                        <div class="text-center p-10 margin-auto">
                          <img src="{{ asset('static/images/checkmark.svg')}}" alt="" srcset="">

                          <h3 class="text-center p-10">Payment Done Successfully !</h3>


                        </div>

                        </div>


                    </div>
                    </div>


                  <!-- Buttons -->
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
                      <div class="tab-pane fade  pt-20 " id="order-status" role="tabpanel" aria-labelledby="order-status-tab">



                          <div class="p-15  border-top-2">

                            <div class="d-flex p-10">
                              {{--<ul class="steps">
                                <li class="step step--incomplete step--active">
                                  <span class="step__icon"></span>

                                </li>
                                <li class="step step--incomplete step--active">
                                  <span class="step__icon"></span>

                                </li>
                                <li class="step step--incomplete step--active">
                                  <span class="step__icon"></span>

                                </li>
                                <li class="step step--incomplete step--inactive">
                                  <span class="step__icon"></span>

                                </li>
                                <li class="step step--incomplete step--inactive">
                                  <span class="step__icon"></span>

                                </li>

                              </ul>--}}


                                                                  </hr>

                            </div>
                          </div>
                          <div class="d-flex  border-bottom pb-0">
                            <ul class="nav nav-tabs pt-20 p-0" id="myTab" role="tablist">
                              <li class="nav-item">
                                  <a class="nav-link active" id="new-order-tab" data-toggle="tab" href="#order-details" role="tab" aria-controls="home" aria-selected="true">Order Details</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="requirments-tab" data-toggle="tab" href="#requirements" role="tab" aria-controls="profile" aria-selected="false">Requirements</a>
                                </li>

                            </ul>


                          </div>

                          <div class="d-flex p-15 ">
                            <div class="tab-content w-100" id="myTabContent">

                              <div class="tab-pane fade show active" id="order-details" role="tabpanel" aria-labelledby="order-details-tab">




                                <div class="d-flex  row margin-topneg-15" >

                                  <div class="col-sm-4  secondg-bg   pt-10">
                                    <div class="theme-text f-14 bold p-15">
                                      From
                                    </div>
                                    <div class="theme-text f-14 bold p-15">
                                      From Pincode
                                    </div>
                                    <div class="theme-text f-14 bold p-15">
                                      From Floor
                                    </div>
                                    <div class="theme-text f-14 bold p-15">
                                      To
                                    </div>
                                    <div class="theme-text f-14 bold p-15">
                                      To Pincode
                                    </div>
                                    <div class="theme-text f-14 bold p-15">
                                      To Floor
                                    </div>
                                    <div class="theme-text f-14 bold p-15">
                                      Distance
                                    </div>
                                    <div class="theme-text f-14 bold p-15">
                                      Type of Movement
                                    </div>
                                    <div class="theme-text f-14 bold p-15">
                                      Category
                                    </div>
                                    <div class="theme-text f-14 bold p-15">
                                      Order Price
                                    </div>
                                    <div class="theme-text f-14 bold p-15">
                                      Moving Date
                                    </div>
                                    <div class="theme-text f-14 bold p-15">
                                      Driver Assigned
                                    </div>






                                  </div>

                                  <div class="col-sm-5 white-bg  pt-10">

                                      <div class="theme-text f-14 p-15">
                                        ABC Studio, ABC Street, Chennai
                                        </div>
                                        <div class="theme-text f-14 p-15">
                                          560097
                                        </div>
                                        <div class="theme-text f-14 p-15">
                                          01 (Lift: Yes)
                                        </div>
                                        <div class="theme-text f-14 p-15">
                                          LMN Apartment, LMN Street, Bengaluru
                                        </div>
                                        <div class="theme-text f-14 p-15">
                                          560097
                                        </div>
                                        <div class="theme-text f-14 p-15">
                                          01 (Lift: Yes)
                                        </div>
                                        <div class="theme-text f-14 p-15">
                                          563 KM
                                        </div>
                                        <div class="theme-text f-14 p-15">
                                          Shared
                                        </div>
                                        <div class="theme-text f-14 p-15">
                                          1 BHK
                                        </div>
                                        <div class="theme-text f-14 p-15">
                                          Rs. 4000
                                        </div>
                                        <div class="theme-text f-14 p-15">
                                          25 Jan 20
                                        </div>
                                        <div class="theme-text f-14 p-15">
                                          Amit Patil
                                        </div>



                                    </div>




                                </div>
                                <div class="border-top-3">
                                  <div class="d-flex justify-content-start">
                                      <div class="w-50">
                                          <a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Back</button></a>
                                      </div>

                                  </div>

                          </div>
                                </div>
                              <div class="tab-pane fade " id="requirements" role="tabpanel" aria-labelledby="requirments-tab">

                              <div class="heading theme-text    p-10 ">

                                <div class="row ml-10">Category: <div class="bold"> 1 BHK</div> </div>

                                <!-- table-here -->
                                <table class="table text-center  theme-text grey-br mtop-5 p-10">
                                  <thead class="secondg-bg  p-10 f-14">
                                    <tr>
                                      <th scope="col">Item</th>
                                      <th scope="col" >Quantity</th>
                                      <th scope="col" >Size</th>

                                    </tr>
                                  </thead>
                                  <tbody class="mtop-15">
                                    <tr class="tb-border  cursor-pointer">
                                      <th scope="row">Cupboards</th>

                                      <td  class="text-center">2</td>
                                      <td class=""><span class=" text-center w-100  ">Large</span></td>

                                    </tr>
                                    <tr class="tb-border  cursor-pointer">
                                      <th scope="row">Chair</th>

                                      <td>4</td>
                                      <td class=""><span class="  text-center  w-100">Medium</span></td>

                                    </tr>
                                    <tr class="tb-border  cursor-pointer border-bottom">
                                      <th scope="row">TV</th>

                                      <td>1</td>
                                      <td class=""><span class="  text-center  w-100">Small</span></td>

                                    </tr>
                                  </tbody>
                                </table>
                              </div>

                              <div class="border-top-3">
                                <div class="d-flex justify-content-start">
                                    <div class="w-50">
                                        <a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Back</button></a>
                                    </div>

                                </div>

                        </div>

                              </div>

                              <!--  -->
                          </div>
                          </div>

                      </div>
                      <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">



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
                                SKU1234456
                                </div>
                                <div class="theme-text f-14 p-15">
                                  Dhanush Rao
                                </div>
                                <div class="theme-text f-14 p-15">
                                  Pradeep
                                </div>
                                <div class="theme-text f-14 p-15">
                                  The Best
                                </div>
                                <div class="theme-text f-14  text-center status-badge mtop-20">
                                  Completed
                                </div>
                                <div class="theme-text f-14 p-15 mt-2">
                                  <i> <img src="{{ asset('static/images/ratings.svg')}}" alt="" srcset=""> </i>
                                </div>



                            </div>

                            <div class="d-flex  mtop-5">
                              <i class="icon dripicons-pencil p-1 cursor-pointer theme-text" aria-hidden="true"></i> <a href="#" class="ml-1">Edit</a>
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
                      <div class="tab-pane fade" id="complaints" role="tabpanel" aria-labelledby="complaints-tab">



                        <div class="d-flex  row p-15" >

                          <div class="col-sm-4  secondg-bg margin-topneg-15 pt-10">
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
                              Date of movement
                            </div>
                            <div class="theme-text f-14 bold p-15">
                              Driver Name
                            </div>
                            <div class="theme-text f-14 bold p-15">
                              Vehicle Details
                            </div>
                            <div class="theme-text f-14 bold p-15">
                              Complaint type
                            </div>
                            <div class="theme-text f-14 bold p-15">
                              Description
                            </div>
                            <div class="theme-text f-14 bold p-15">
                              Status
                            </div>



                          </div>

                          <div class="col-sm-7 white-bg margin-topneg-15 pt-10">

                              <div class="theme-text f-14 p-15">
                                SKU1234456
                                </div>
                                <div class="theme-text f-14 p-15">
                                  Dhanush Rao
                                </div>
                                <div class="theme-text f-14 p-15">
                                  Pradeep
                                </div>
                                <div class="theme-text f-14 p-15">
                                  23 Dec 20
                                </div>
                                <div class="theme-text f-14 p-15">
                                  Rakesh
                                </div>
                                <div class="theme-text f-14 p-15">
                                  KA-42EF0012
                                </div>
                                <div class="theme-text f-14 p-15">
                                  Package
                                </div>
                                <div class="theme-text f-14 p-15">
                                  Un Pack
                                </div>
                                <div class="theme-text f-14  status-badge  mtop-20">
                                  Viewed
                                </div>




                            </div>

                            <!-- <div class="d-flex  mtop-5">
                              <i class="icon dripicons-pencil p-1 cursor-pointer theme-text" aria-hidden="true"></i> <a href="#" class="ml-1">Edit</a>
                            </div> -->


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

    </div>
    </div>








<!-- Pop-ups -->
<div class="modal fade" id="for-friend" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
  <div class="modal-dialog theme-text" role="document">
    <div class="modal-content w-1000 right-25">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">For a friend</h5>
        <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="d-flex  row  p-15" >

          <div class=" col-sm-4 col-sm-4">
            <div class="form-input">
              <label class="phone-num-lable">Phone Number</label>
              <span class="">
                <input type="tel" id="phone-pop-up" placeholder="987654321" class=" form-control form-control-tel">
               <span class="error-message">Please enter  valid Phone number</span>
              </span>


           </div>

          </div>
          <div class=" col-sm-4 col-sm-4">
            <div class="form-input">
              <label class="full-name">Full Name</label>
              <span class="">
                <input type="text" id="fullname" placeholder="David Jerome"  class="form-control">
               <span class="error-message">Please enter  valid Phone number</span>
              </span>


           </div>
          </div>

          <div class=" col-sm-4 col-sm-4">
            <div class="form-input">
              <label class="email-label">Email</label>
              <span class="">
                <input type="email"  placeholder="abc@mail.com" id="E-mail" class="form-control">
               <span class="error-message">Please enter  valid Email</span>
              </span>


           </div>

          </div>

          <div class=" col-sm-4 col-sm-4">
            <div class="form-input">
              <label>Gender</label>
              <span class="">
                <select  id="" class="form-control">
                  <option >  Male</option>
                  <option>  Female</option>

                  </select>
               <span class="error-message">Please enter  valid</span>
              </span>


           </div>

          </div>
          <div class=" col-sm-4 col-sm-4">
            <div class="form-input">
              <label>From Adress line 1</label>
              <span class="">
                <input type="text"  placeholder="SVM Complex,indiranagar,Benguluru" id="" class="form-control">
               <span class="error-message">Please enter  valid</span>
              </span>


           </div>
          </div>
          <div class=" col-sm-4 col-sm-4">
            <div class="form-input">
              <label>From Adress line 2</label>
              <span class="">
                <input type="text"  placeholder="SVM Complex,indiranagar,Benguluru" id="" class="form-control">
               <span class="error-message">Please enter  valid</span>
              </span>


           </div>
          </div>
          <div class=" col-sm-4 col-sm-4">
            <div class="form-input">
              <label>State</label>
              <span class="">
                <select  id="" class="form-control">
                  <option value="Andhra Pradesh">Andhra Pradesh</option>
<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
<option value="Arunachal Pradesh">Arunachal Pradesh</option>
<option value="Assam">Assam</option>
<option value="Bihar">Bihar</option>
<option value="Chandigarh">Chandigarh</option>
<option value="Chhattisgarh">Chhattisgarh</option>
<option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
<option value="Daman and Diu">Daman and Diu</option>
<option value="Delhi">Delhi</option>
<option value="Lakshadweep">Lakshadweep</option>
<option value="Puducherry">Puducherry</option>
<option value="Goa">Goa</option>
<option value="Gujarat">Gujarat</option>
<option value="Haryana">Haryana</option>
<option value="Himachal Pradesh">Himachal Pradesh</option>
<option value="Jammu and Kashmir">Jammu and Kashmir</option>
<option value="Jharkhand">Jharkhand</option>
<option value="Karnataka">Karnataka</option>
<option value="Kerala">Kerala</option>
<option value="Madhya Pradesh">Madhya Pradesh</option>
<option value="Maharashtra">Maharashtra</option>
<option value="Manipur">Manipur</option>
<option value="Meghalaya">Meghalaya</option>
<option value="Mizoram">Mizoram</option>
<option value="Nagaland">Nagaland</option>
<option value="Odisha">Odisha</option>
<option value="Punjab">Punjab</option>
<option value="Rajasthan">Rajasthan</option>
<option value="Sikkim">Sikkim</option>
<option value="Tamil Nadu">Tamil Nadu</option>
<option value="Telangana">Telangana</option>
<option value="Tripura">Tripura</option>
<option value="Uttar Pradesh">Uttar Pradesh</option>
<option value="Uttarakhand">Uttarakhand</option>
<option value="West Bengal">West Bengal</option>


                  </select>
               <span class="error-message">Please enter  valid</span>
              </span>


           </div>

          </div>
          <div class=" col-sm-4 col-sm-4">
            <div class="form-input">
              <label>City</label>
              <span class="">
                <input type="text"  placeholder="Benguluru" id="" class="form-control">
               <span class="error-message">Please enter  valid</span>
              </span>


           </div>
          </div>
          <div class=" col-sm-4 col-sm-4">
            <div class="form-input">
              <label>Pincode</label>
              <span class="">
                <input type="text"  placeholder="530000" id="" class="form-control">
               <span class="error-message">Please enter  valid</span>
              </span>


           </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="w-50"><a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Cancel</button></a></div>
        <div class="w-50 text-right"><a class="white-text p-10" href="#"><button class="btn theme-bg white-text w-30">Send Otp</button></a></div>
      </div>
    </div>
  </div>
 </div>
@endsection
