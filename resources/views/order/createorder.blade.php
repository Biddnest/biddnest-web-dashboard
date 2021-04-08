@extends('layouts.app')
@section('title') Orders And Bookings @endsection
@section('content')



<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createorders">
          <div class="d-flex  flex-row justify-content-between">
            <h3 class="page-head text-left p-4">Create New Order</h3>

          </div>
          <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left p-4 pt-0 pb-0">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="booking-orders.html">Booking & Orders</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Create New Order</li>
                </ol>
              </nav>


            </div>

          </div>

          <div class="d-flex  flex-row text-left ml-120">
            <!-- <a href="booking-orders.html" class="text-decoration-none">
           <h3 class="page-subhead text-left p-4 f-20 theme-text">
            <i class="p-1"> <img src="assets/images/Icon feather-chevrons-left.svg" alt="" srcset=""></i> Back to Bookings & Orders</h3></a> -->

          </div>
          <!-- Dashboard cards -->


          <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-sm-10">
              <div class="card  h-auto p-0 pt-10 ">

                <div class="card-head right text-left  p-8">
                  <h3 class="f-18">
                    <ul class="nav nav-tabs pt-10 p-0" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active p-15" id="new-order-tab" data-toggle="tab" href="#order" role="tab"
                          aria-controls="home" aria-selected="true">Create New Order</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link p-15" id="quotation" data-toggle="tab" href="#past" role="tab"
                          aria-controls="profile" aria-selected="false">Quotations</a>
                      </li>

                    </ul>

                  </h3>





                </div>
                <div class="tab-content  margin-topneg-15" id="myTabContent">

                  <div class="tab-pane fade show active" id="order" role="tabpanel" aria-labelledby="new-order-tab">
                    <!-- form starts -->
                    <form class="form-new-order">
                      <div
                        class="d-flex flex-row p-10  secondg-bg heading"
                         href="#customer-details" role="button" aria-expanded="false"
                        aria-controls="customer-details">

                        <div> Customer Details</div>





                      </div>

                      <div class="" id="customer-details">



                        <div class="d-flex  row  p-20">

                          <div class="col-sm-6">
                            <div class="form-input">
                              <label class="phone-num-lable">Phone Number</label>
                              <span class="">
                                <input type="tel" id="phone" placeholder="987654321"
                                  class=" form-control form-control-tel">
                                <span class="error-message">Please enter valid Phone number</span>
                              </span>


                            </div>

                          </div>
                          <div class="col-sm-6">
                            <div class="form-input">
                              <label class="full-name">Full Name</label>
                              <span class="">
                                <input type="text" id="fullname" placeholder="David Jerome" class="form-control">
                                <span class="error-message">Please enter valid Phone number</span>
                              </span>


                            </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-input">
                              <label class="email-label">Email</label>
                              <span class="">
                                <input type="email" placeholder="abc@mail.com" id="E-mail" class="form-control">
                                <span class="error-message">Please enter valid Email</span>
                              </span>


                            </div>

                          </div>
                          <div class="col-sm-6">
                            <div class="d-flex  flex-row small-switch mtop-20">
                              <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-width="110"
                                data-height="35" data-onstyle="outline-primary" data-offstyle="outline-secondary"
                                data-on="For Me" data-off="For Others" id="switch">
                            </div>
                          </div>
                       <!-- Toggle -->
                       <div class="col-sm-6 toggle-input diplay-none">
                        <div class="form-input">
                          <label class="phone-num-">Friend's Phone Number</label>
                          <span class="">
                            <input type="tel" id="phonefriend" placeholder="987654321"
                              class=" form-control form-control-tel">
                            <span class="error-message">Please enter valid Phone number</span>
                          </span>



                        </div>

                      </div>
                      <div class="col-sm-6 toggle-input diplay-none">
                        <div class="form-input">
                          <label class="full-name">Full Name</label>
                          <span class="">
                            <input type="text" id="fullname" placeholder="David Jerome" class="form-control">
                            <span class="error-message">Please enter valid Phone number</span>
                          </span>


                        </div>
                      </div>

                      <div class="col-sm-6 toggle-input diplay-none ">
                        <div class="form-input">
                          <label class="email-label">Email</label>
                          <span class="">
                            <input type="email" placeholder="abc@mail.com" id="E-mail" class="form-control">
                            <span class="error-message">Please enter valid Email</span>
                          </span>


                        </div>

                      </div>
                        </div>

                      </div>

                      <div class="d-flex flex-row p-10  secondg-bg heading"
                         href="#delivery-details" role="button" aria-expanded="false"
                        aria-controls="delivery-details">

                        <div> Delivery Details</div>


                      </div>
                      <div class="" id="delivery-details">
                        <div class="d-flex  row  p-20">

                          <div class="col-sm-6">
                            <div class="form-input">
                              <label>From Address</label>
                              <span class="">
                                <input type="text" placeholder="SVM Complex,indiranagar,Benguluru" id=""
                                  class="form-control">

                                <span class="error-message">Please enter valid</span>
                              </span>


                            </div>

                          </div>
                          <div class="col-sm-6">
                            <div class="form-input">
                              <label>From Adress line 1</label>
                              <span class="">
                                <input type="text" placeholder="SVM Complex,indiranagar,Benguluru" id=""
                                  class="form-control">
                                <span class="error-message">Please enter valid</span>
                              </span>


                            </div>
                          </div>
                          <div class="col-sm-6 mtop-22">

                            <!--Map -->
                            <!-- <div class="mapouter"><div class="gmap_canvas"><iframe width="85%" height="350px" id="gmap_canvas" src="https://maps.google.com/maps?q=Benguluru%20indiranagar,svm%20complex&t=&z=7&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://grantorrent-es.com">grantorrent</a><br><style>.mapouter{position:relative;text-align:left;height:250px;width:118%;}</style><a href="https://www.embedgooglemap.net">google map on your website</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:131px;width:100%;}</style></div></div> -->
                            <div id="frommap" style="width: 100%; height: 155px;"></div>
                          </div>

                          <div class="col-sm-6">

                            <div class="d-flex  row justify-content-between">
                              <div class="col-sm-6">
                                <div class="form-input">
                                  <label>From City</label>
                                  <span class="">
                                    <input type="text" placeholder="Benguluru" id="" class="form-control">
                                    <span class="error-message">Please enter valid</span>
                                  </span>


                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-input">
                                  <label>From Pincode</label>
                                  <span class="">
                                    <input type="text" placeholder="530000" id="" class="form-control">
                                    <span class="error-message">Please enter valid</span>
                                  </span>


                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-input">
                                  <label>From Floor</label>
                                  <span class="">
                                    <input type="text" placeholder="3rd Floor" id=""
                                      class="form-control">
                                    <span class="error-message">Please enter valid</span>
                                  </span>


                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-inputs">
                                    <label class="container">
                                      <input type="checkbox" id="Lift1">
                                      <span class="checkmark"></span>
                                    </label>

                                    <label class="form-check-box" for="Lift1">Do you have lift</label>
                                    <span class="error-message">Please enter valid</span>


                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="d-flex  row  p-20">

                          <div class="col-sm-6">
                            <div class="form-input">
                              <label>To  Address</label>
                              <span class="">
                                <input type="text" placeholder="Srm colony,Chennai" id=""
                                  class="form-control">
                                <span class="error-message">Please enter valid</span>
                              </span>


                            </div>

                          </div>
                          <div class="col-sm-6">
                            <div class="form-input">
                              <label>To Adress line 1</label>
                              <span class="">
                                <input type="text" placeholder="Srm colony,Chennai" id=""
                                  class="form-control">
                                <span class="error-message">Please enter valid</span>
                              </span>


                            </div>
                          </div>
                          <div class="col-sm-6 mtop-22">

                            <!--Map -->
                            <!-- <div class="mapouter"><div class="gmap_canvas"><iframe width="85%" height="auto" id="gmap_canvas" src="https://maps.google.com/maps?q=Benguluru%20indiranagar,svm%20complex&t=&z=7&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://grantorrent-es.com">grantorrent</a><br><style>.mapouter{position:relative;text-align:left;height:131px;width:118%;}</style><a href="https://www.embedgooglemap.net">google map on your website</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:131px;width:100%;}</style></div></div> -->
                            <div id="tomap" style="width: 100%; height: 155px;"></div>
                          </div>

                          <div class="col-sm-6">

                            <div class="d-flex row justify-content-between">
                              <div class="col-sm-6">
                                <div class="form-input">
                                  <label>To City</label>
                                  <span class="">
                                    <input type="text" placeholder="Chennai" id="" class="form-control">
                                    <span class="error-message">Please enter valid</span>
                                  </span>


                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-input">
                                  <label>To Pincode</label>
                                  <span class="">
                                    <input type="text" placeholder="530001" id="" class="form-control">
                                    <span class="error-message">Please enter valid</span>
                                  </span>


                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-input">
                                  <label>To Floor </label>
                                  <span class="">
                                    <input type="text" placeholder="1st floor" id=""
                                      class="form-control">
                                    <span class="error-message">Please enter valid</span>
                                  </span>


                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-inputs">
                                    <label class="container">
                                      <input type="checkbox" id="Lift2">
                                      <span class="checkmark"></span>
                                    </label>

                                    <label class="form-check-box" for="Lift2">Do you have lift</label>
                                    <span class="error-message">Please enter valid</span>


                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="d-flex  row  p-20">

                          <div class="col-sm-6">
                            <div class="form-input" >

                              <label class="start-date">Start date</label>
                            <div id="my-modal">
                              <input type="text" id="dateselect" class="dateselect form-control br-5" required="required"
                                placeholder="15/02/2021" />
                              <span class="error-message">please enter valid
                                date</span>
                              </div>

                            </div>

                          </div>
                          <div class="col-sm-6">
                            <div class="form-inputs">
                                <label class="container">
                                  <input type="checkbox" id="need1">
                                  <span class="checkmark"></span>
                                </label>

                                <label class="form-check-box" for="need1">Need dedicated movement</label>
                                <span class="error-message">Please enter valid</span>


                            </div>
                          </div>



                        </div>
                      </div>

                      <div class="d-flex flex-row p-10  secondg-bg heading"
                         href="#requirments" role="button" aria-expanded="false"
                        aria-controls="requirments">

                        <div>Requirements</div>



                      </div>
                      <div class="" id="requirments">
                        <div class="d-flex  row p-20">

                          <div class="col-sm-6">
                            <div class="form-input">
                            <label>Category</label>
                            <span class="">
                                <select  id="" class="form-control">
                                  <option >  Residential</option>
                                  <option>  Commercial</option>
                                  <option>  Office</option>
                                  </select>
                              <span class="error-message">Please enter  valid</span>
                              </span>


                            </div>

                          </div>
                          <div class="col-sm-6">
                            <div class="form-input">
                              <label>Room Selection</label>
                              <span class="">
                                <select id="" class="form-control">
                                  <option> 2 BHK</option>
                                  <option> 3 BHK</option>
                                  <option> 1 BHK</option>
                                  <option> Villa</option>
                                </select>
                                <span class="error-message">Please enter valid</span>
                              </span>


                            </div>
                          </div>
                          <div class="col-sm-12 mtop-20  p-0  pb-0" >

                            <div class="heading p-8 border-around ">
                              Inventory
                            </div>
                            <table class="table text-center p-10 theme-text tb-border2" id="items" >

                                <thead class="secondg-bg bx-shadowg p-0 f-14">
                                  <tr class="">
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Actions</th>
                                  </tr>
                                </thead>


                              <tbody class="mtop-20 f-13">
                                <tr class="">
                                  <th scope="row">Bike</th>

                                  <td class="text-center">02</td>
                                  <td class=""><span class="light-bg text-center status-badge">Large</span></td>
                                  <td> <i class="icon dripicons-pencil  p-1 cursor-pointer" aria-hidden="true"></i>

                                    <i class="icon dripicons-trash p-1 cursor-pointer" aria-hidden="true"></i></i>
                                  </td>
                                </tr>
                                <tr class="">
                                  <th scope="row">Cupboard</th>

                                  <td>04</td>
                                  <td class=""><span class="  text-center status-badge">Medium</span>
                                  </td>
                                  <td> <i class="icon dripicons-pencil  p-1 cursor-pointer" aria-hidden="true"></i>

                                    <i class="icon dripicons-trash p-1 cursor-pointer" aria-hidden="true"></i></i>
                                  </td>
                                </tr>
                                <tr class="">
                                  <th scope="row">Table</th>

                                  <td>03</td>
                                  <td class=""><span class="info-bg  text-center status-badge">Small</span></td>
                                  <td> <i class="icon dripicons-pencil  p-1 cursor-pointer" aria-hidden="true"></i>

                                    <i class="icon dripicons-trash p-1 cursor-pointer" aria-hidden="true"></i></i>
                                  </td>
                                </tr>
                                <tr id='addr1'></tr>
                              </tbody>
                            </table>
                          </div>
                          <div class="col-sm-12 mtop-20 w-30">

                            <a class="float-right btn theme-bg white-text "  id="addnew-btn" >

                              <i class="fa fa-plus  m-1" aria-hidden="true"></i>
                              Add New Item</a>

                          </div>


                        </div>

                      </div>

                      <div class="d-flex flex-row p-10 secondg-bg heading"
                         href="#comments" role="button" aria-expanded="false"
                        aria-controls="comments">

                        <div> Comments</div>

                      </div>
                      <div class="" id="comments">
                        <div class="d-flex  flex-row  p-10 border-bottom">
                          <div class="col-sm-12" style="margin-left: -5px;">
                            <div class="form-input">
                              <label>Comments from Customers</label>
                              <span class="">
                                <textarea placeholder="Need to Include bike" id="" class="form-control" rows="4"
                                  cols="50">

                    </textarea>
                                <span class="error-message">Please enter valid</span>
                              </span>


                            </div>
                          </div>
                        </div>
                        <div class="d-flex  justify-content-between flex-row ml-20 p-10 ">
                          <div class="w-50"><a class="white-text p-10" href="#"><button
                                class="btn  w-30 white-text">Cancel</button></a></div>
                          <div class="w-50 text-right"><a class="white-text p-10" data-toggle="modal"
                              data-target="#for-friend"><button class="btn theme-bg white-text w-30">Next</button></a>
                          </div>
                        </div>


                      </div>


                    </form>

                    <!-- Tab-1 form -->
                  </div>
                  <div class="tab-pane fade  pt-20  border-top" id="past" role="tabpanel" aria-labelledby="past-tab">
                    <form class="quation-form">
                      <div class="p-0  border-top-2 order-cards">
                          <div class="d-flex justify-content-center f-14 theme-text text-center ">
                              Please note that this is the baseline price, you will be receiving the <br>Vendor bid list with the final quotations
                           </div>

                           <div class="d-flex flex-row justify-content-around f-14 theme-text text-center p-10 quotation">

                               <div class="flex-column justify-content-center test">
                                <div class="card m-20  card-price eco cursor-pointer"  >
                                  <div class="p-60 f-32 border-cicle eco-card" >
                                    <div>₹ 2,300</div>
                                    <div class="f-14 ">Base price</div>
                                 </div>
                                 <div class="p-10 f-18">  Economy</div>
                                </div>
                                <div class="radio-group">
                                  <div class="form-input radio-item ">

                                    <input type="radio" id="economy" name="economy-premium"
                                    class="radio-button__input cursor-pointer">
                                   <label class="" for="economy"></label>

                                 </div>
                                </div>


                               </div>


                              <div class="felx-column">

                                <div class="card m-20 card-price pre  cursor-pointer ">
                                  <div class="p-60 f-32  border-cicle pre-card  " >
                                    <div>₹ 3,300</div>
                                    <div class="f-14 p-1">Base price</div>

                                   </div>
                                   <div class="p-10 f-18">  Premium</div>
                                </div>

                                <div class="radio-group">
                                  <div class="form-input radio-item ">

                                    <input type="radio" id="premium" name="economy-premium"
                                    class="radio-button__input ">
                                   <label class="" for="premium"></label>

                                 </div>
                                </div>

                              </div>

                           </div>

                      </div>
                  <!-- Resaosn for rejaction -->
                  <div class="d-flex  justify-content-center">
                    <div class="w-50  f-14 theme-text text-left diplay-none  rejection-message">
                      <div ><h4 class="heading">Reason For Rejection</h4></div>
                      <div class="form-input">

                        <span class="">
                          <textarea  placeholder="Need to Include bike" id="" class="form-control" rows="4" cols="50">

                            </textarea>
                         <span class="error-message">Please enter  valid</span>
                        </span>


                     </div>
                     </div>
                  </div>

                  <!-- Order successfull -->
                  <div class="border-bottom-2 Order-sucess diplay-none">

                      <div class="d-flex justify-content-center p-60 ">
                        <i class=""> <img src="{{asset('static/images/checkmark.svg')}}" alt="" srcset="" class=""></i>
                      </div>



                    <h3 class="theme-text text-center">Order Placed successfully</h3>
                  </div>

                </form>
                     <!-- Buttons -->
                     <div class="d-flex justify-content-between flex-row p-8">
                      <div class="w-50"><button class="btn theme-br theme-text w-30 white-bg" id="backbtn">Back</button></div>
              <div class="w-50 text-right">
                <a class="white-text p-1 " href="#"><button class="btn   w-30  reject btn theme-br white-bg">REJECT</button> </a>
                <a class="white-text p-1 reject" href="#"><button class="btn theme-bg white-text w-30 reject-btn">Accept</button> </a>
              </div>
                   </div>
                  </div>

                  <!--  -->
                </div>

              </div>

            </div>

          </div>




</div>


@endsection
