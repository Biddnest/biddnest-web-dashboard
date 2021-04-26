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
                          <div class="tab-pane fade  pt-20 " id="order-status" role="tabpanel" aria-labelledby="order-status-tab">



                              <div class="p-15  border-top-2">

                                  <div class="d-flex p-10">
                                      <!-- <ul class="steps">
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

                                      </ul> -->


                                      <hr class="dash-line">
                                      </hr>
                                      <div class="steps-container">
                                          <div class="steps-status ">
                                              <div class="step-dot">
                                                  <img src="{{ asset('static/images/tick.png')}}" />
                                              </div>
                                              <p class="step-title">Bidding</p>
                                          </div>
                                          <div class="steps-status ">
                                              <div class="step-dot">
                                                  <img src="{{ asset('static/images/tick.png')}}" />
                                              </div>
                                              <p class="step-title">Scheduled</p>
                                          </div>
                                          <div class="steps-status">
                                              <div class="step-dot">
                                                  <img src="{{ asset('static/images/tick.png')}}" />
                                              </div>
                                              <p class="step-title">Driver Assigned</p>
                                          </div>
                                          <div class="steps-status">
                                              <div class="step-dot">
                                                  <div class="child-dot"></div>
                                              </div>
                                              <p class="step-title">In Transit</p>
                                          </div>
                                          <div class="steps-status">
                                              <div class="step-dot">
                                                  <div class="child-dot"></div>
                                              </div>
                                              <p class="step-title">Canceled/Complete</p>
                                          </div>
                                      </div>
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
