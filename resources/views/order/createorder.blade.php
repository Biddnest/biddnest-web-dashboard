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
                  <li class="breadcrumb-item"><a href="{{route('orders-booking')}}">Booking & Orders</a></li>
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
                        <a class="nav-link p-15" id="quotation"  href="{{route('confirm-order')}}" >Quotations</a>
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
                                <input type="tel" id="phone" placeholder="987654321" class=" form-control" name="contact_details[phone]" required>
                                <span class="error-message">Please enter valid Phone number</span>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-input">
                              <label class="full-name">Full Name</label>
                                <input type="text" id="fullname" placeholder="David Jerome" name="contact_details[name]" class="form-control" required>
                                <span class="error-message">Please enter valid Phone number</span>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-input">
                              <label class="email-label">Email</label>
                                <input type="email" placeholder="abc@mail.com" name="contact_details[email]" id="E-mail" class="form-control" required>
                                <span class="error-message">Please enter valid Email</span>
                            </div>
                          </div>
                          <div class="col-sm-6 ">
                              <input type="hidden" value="0" name="meta[self_booking]" id="slef">
                              <input type="checkbox" checked class="check-toggle" data-value="1" data-target=".toggle-input" name="select_letter" value="1" id="slef1"
                                     onchange="document.getElementById('slef').value = this.checked ? 1 : 0">
                            {{--<div class="d-flex  flex-row small-switch mtop-20">
                              <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-width="110"
                                data-height="35" data-onstyle="outline-primary" data-offstyle="outline-secondary"
                                data-on="For Me" data-off="For Others" id="switch">
                            </div>--}}
                          </div>
                            <!-- Toggle -->
                          <div class="col-sm-6 toggle-input hidden">
                            <div class="form-input">
                                <label class="phone-num-">Friend's Phone Number</label>
                                <input type="tel" id="phonefriend" placeholder="987654321" name="friend_details[phone]" class=" form-control form-control-tel">
                                <span class="error-message">Please enter valid Phone number</span>
                            </div>
                          </div>
                          <div class="col-sm-6 toggle-input hidden">
                            <div class="form-input">
                                <label class="full-name">Full Name</label>
                                <input type="text" id="fullname" placeholder="David Jerome" name="friend_details[name]" class="form-control">
                                <span class="error-message">Please enter valid Phone number</span>
                            </div>
                          </div>
                          <div class="col-sm-6 toggle-input hidden">
                            <div class="form-input">
                                <label class="email-label">Email</label>
                                <input type="email" placeholder="abc@mail.com" name="friend_details[email]" id="E-mail" class="form-control">
                                <span class="error-message">Please enter valid Email</span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="d-flex flex-row p-10  secondg-bg heading" href="#delivery-details" role="button" aria-expanded="false"
                        aria-controls="delivery-details">
                        <div> Delivery Details</div>
                      </div>
                      <div class="" id="delivery-details">
                        <div class="d-flex  row  p-20">
                          <div class="col-sm-6">
                            <div class="form-input">
                              <label>From Address </label>
                              <input type="text" placeholder="SVM Complex,indiranagar,Benguluru" name="source[meta][geocode]" id="" class="form-control">
                              <span class="error-message">Please enter valid</span>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-input">
                              <label>From Adress line 1</label>
                              <input type="text" placeholder="SVM Complex,indiranagar,Benguluru" name="source[meta][address_line1]" id="" class="form-control" required>
                              <input type="text"  name="source[lat]" id="" class="form-control" required>
                              <input type="text"  name="source[lng]" id="" class="form-control" required>
                              <span class="error-message">Please enter valid</span>
                            </div>
                          </div>

                          <div class="col-sm-6 mtop-22">
                            <!--Map -->
                            <!-- <div class="mapouter"><div class="gmap_canvas"><iframe width="85%" height="350px" id="gmap_canvas" src="https://maps.google.com/maps?q=Benguluru%20indiranagar,svm%20complex&t=&z=7&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://grantorrent-es.com">grantorrent</a><br><style>.mapouter{position:relative;text-align:left;height:250px;width:118%;}</style><a href="https://www.embedgooglemap.net">google map on your website</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:131px;width:100%;}</style></div></div> -->
                            <div id="frommap" style="width: 100%; height: 155px;"></div>
                          </div>
                          <div class="col-sm-6">
                            <div class="d-flex  row justify-content-between">
                                <div class="col-sm-12">
                                    <div class="form-input">
                                        <label>From Adress line 2</label>
                                        <input type="text" placeholder="SVM Complex,indiranagar,Benguluru" name="source[meta][address_line2]" id="" class="form-control" required>
                                        <span class="error-message">Please enter valid</span>
                                    </div>
                                </div>
                              <div class="col-sm-6">
                                <div class="form-input">
                                  <label>From City</label>
                                    <input type="text" placeholder="Benguluru" id="" class="form-control" name="source[meta][city]" required>
                                    <input type="text"  id="" class="form-control" name="source[meta][state]">
                                    <span class="error-message">Please enter valid</span>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-input">
                                  <label>From Pincode</label>
                                  <input type="text" placeholder="530000" id="" class="form-control" name="source[meta][pincode]" required>
                                  <span class="error-message">Please enter valid</span>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-input">
                                  <label>From Floor</label>
                                  <input type="number" placeholder="3rd Floor" id="" value="0" name="source[meta][floor]" class="form-control" required>
                                  <span class="error-message">Please enter valid</span>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-inputs ">
                                    <label class="container" style="margin-top: 36px;">
                                        <input type="hidden" value="0" name="source[meta][lift]" id="letter">
                                        <input type="checkbox" name="select_letter" value="1" id="Lift1"
                                               onchange="document.getElementById('letter').value = this.checked ? 1 : 0">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="form-check-box mb-0" style="margin-top: 1px;" for="Lift1">Do you have lift</label>
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
                                <input type="text" placeholder="Srm colony,Chennai" id="" class="form-control">
                                    <input type="text"  name="destination[lat]" id="" class="form-control" required>
                                    <input type="text"  name="destination[lng]" id="" class="form-control" required>
                                <span class="error-message">Please enter valid</span>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-input">
                              <label>To Adress line 1</label>
                              <input type="text" placeholder="Srm colony,Chennai" id="" class="form-control">
                              <span class="error-message">Please enter valid</span>
                            </div>
                          </div>
                          <div class="col-sm-6 mtop-22">
                            <!--Map -->
                            <!-- <div class="mapouter"><div class="gmap_canvas"><iframe width="85%" height="auto" id="gmap_canvas" src="https://maps.google.com/maps?q=Benguluru%20indiranagar,svm%20complex&t=&z=7&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://grantorrent-es.com">grantorrent</a><br><style>.mapouter{position:relative;text-align:left;height:131px;width:118%;}</style><a href="https://www.embedgooglemap.net">google map on your website</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:131px;width:100%;}</style></div></div> -->
                            <div id="tomap" style="width: 100%; height: 155px;"></div>
                          </div>
                          <div class="col-sm-6">
                            <div class="d-flex row justify-content-between">
                                <div class="col-sm-12">
                                    <div class="form-input">
                                        <label>From Adress line 2</label>
                                        <input type="text" placeholder="SVM Complex,indiranagar,Benguluru" id="" class="form-control">
                                        <span class="error-message">Please enter valid</span>
                                    </div>
                                </div>
                              <div class="col-sm-6">
                                <div class="form-input">
                                  <label>To City</label>
                                  <input type="text" placeholder="Chennai" id="" class="form-control">
                                  <span class="error-message">Please enter valid</span>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-input">
                                  <label>To Pincode</label>
                                  <input type="text" placeholder="530001" id="" class="form-control">
                                  <span class="error-message">Please enter valid</span>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-input">
                                  <label>To Floor </label>
                                    <input type="text" placeholder="1st floor" id="" class="form-control">
                                    <span class="error-message">Please enter valid</span>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-inputs">
                                  <label class="container " style="margin-top: 36px;">
                                      <input type="hidden" value="0" name="destination[meta][lift]" id="letter2">
                                      <input type="checkbox" name="select_letter" value="1" id="Lift2"
                                             onchange="document.getElementById('letter2').value = this.checked ? 1 : 0">
                                    <span class="checkmark"></span>
                                  </label>
                                  <label class="form-check-box"   style="margin-top: 1px;" for="Lift2">Do you have lift</label>
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
                                <input type="text" id="dateselect" class="dateselect form-control br-5" required="required" placeholder="15/02/2021" />
                                <span class="error-message">please enter valid date</span>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-inputs">
                                <label class="container"  style="margin-top: 36px;">
                                  <input type="checkbox" id="need1">
                                  <span class="checkmark"></span>
                                </label>
                                <label class="form-check-box" for="need1"  style="margin-top: 1px;">Need dedicated movement</label>
                                <span class="error-message">Please enter valid</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex flex-row p-10  secondg-bg heading" href="#requirments" role="button" aria-expanded="false" aria-controls="requirments">
                        <div>Requirements</div>
                      </div>
                      <div class="" id="requirments">
                        <div class="d-flex  row p-20">
                          <div class="col-sm-6">
                            <div class="form-input">
                            <label>Category</label>
                                <select  id="" class="form-control">
                                  <option >  Residential</option>
                                  <option>  Commercial</option>
                                  <option>  Office</option>
                                  </select>
                              <span class="error-message">Please enter  valid</span>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-input">
                              <label>Room Selection</label>
                                <select id="" class="form-control">
                                  <option> 2 BHK</option>
                                  <option> 3 BHK</option>
                                  <option> 1 BHK</option>
                                  <option> Villa</option>
                                </select>
                                <span class="error-message">Please enter valid</span>
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
                      <div class="d-flex flex-row p-10 secondg-bg heading" href="#comments" role="button" aria-expanded="false" aria-controls="comments">
                        <div> Comments</div>
                      </div>
                      <div class="" id="comments">
                        <div class="d-flex  flex-row  p-10 border-bottom">
                          <div class="col-sm-12" style="margin-left: -5px;">
                            <div class="form-input">
                              <label>Comments from Customers</label>
                              <textarea placeholder="Need to Include bike" id="" class="form-control" rows="4"
                                  cols="50"></textarea>
                              <span class="error-message">Please enter valid</span>
                            </div>
                          </div>
                        </div>
                        <div class="d-flex  justify-content-between flex-row  p-10 ">
                          <div class="w-50">
                              <a class="white-text p-10" href="#">
                                  <button type="button" class="btn  w-30 white-text">Cancel</button>
                              </a>
                          </div>
                          <div class="w-50 text-right">
                              <a class="white-text p-10" data-toggle="modal" data-target="#for-friend">
                                  <button class="btn theme-bg white-text w-30">Next</button>
                              </a>
                          </div>
                        </div>
                      </div>
                    </form>
                    <!-- Tab-1 form -->
                  </div>
                  <!--  -->
            </div>
        </div>
    </div>

    </div>
</div>
@endsection
