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
                                    <a class="nav-link active p-15" id="vendor-tab" data-toggle="tab" href="{{route('order-details-vendor', ['id'=>$booking->id])}}" role="tab" aria-controls="profile" aria-selected="false">Vendor</a>
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
