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
              <div class="d-flex flex-row  Dashboard-lcards  justify-content-center">
                <div class="col">
                  <div class="card  h-auto p-0 " >
                      <div class="card-head right text-center  pb-0 p-05" style="padding-top: 0">
                        <h3 class="f-18" style="margin-top: 0;">
                          <ul class="nav nav-tabs p-0 flex-row" id="myTab" role="tablist">
                            <li class="nav-item ">
                              <a class="nav-link active p-15" id="customer-details-tab" data-toggle="tab" href="{{route('order-details', ['id'=>$booking->id])}}" role="tab" aria-controls="home" aria-selected="true">Customer</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-vendor', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Vendor</a>
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
