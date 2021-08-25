@extends('layouts.app')
@section('title') Orders And Bookings @endsection
@section('content')


<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createorders">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4">Create New Order</h3>
    </div>
    <div class="d-flex  flex-row justify-content-betwee">
        <div class="page-head text-left p-4 pt-0 pb-0">
            <nav aria-label="breadcrumb " style="margin-left:-10px">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('orders-booking')}}">Booking & Orders</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Create New Order</li>
                </ol>
            </nav>
        </div>

    </div>

    <div class="d-flex  flex-row text-left ml-120">
           <!--
           <a href="booking-orders.html" class="text-decoration-none">
           <h3 class="page-subhead text-left p-4 f-20 theme-text">
           <i class="p-1"> <img src="assets/images/Icon feather-chevrons-left.svg" alt="" srcset=""></i> Back to Bookings & Orders</h3></a>
           -->
    </div>
    <!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-center Dashboard-lcards " >
        <div class="col-sm-10">
            <div class="card  h-auto p-0 pt-10 ">
                <div class="card-head right text-left  p-8">
                  <h3 class="f-18 mt-2">
                    <ul class="nav nav-tabs pt-10 p-0" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active p-15 pl-2" id="new-order-tab" data-toggle="tab" href="#order" role="tab"
                          aria-controls="home" aria-selected="true">Create New Order</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link p-15 disabled" id="quotation"  href="#" >Quotations</a>
                      </li>
                    </ul>
                  </h3>
                </div>
                <div class="tab-content  margin-topneg-15" id="myTabContent">
                  <div class="tab-pane fade show active" id="order" role="tabpanel" aria-labelledby="new-order-tab">
                    <!-- form starts -->
                      <form class="form-new-order order_create input-text-blue" action="{{route('add_booking')}}" method="POST" data-next="redirect" data-url="{{route('confirm-order', ['id'=>':id'])}}" data-alert="mega" id="myForm" data-parsley-validate autocomplete="off" onsubmit="return false">
                      <div class="d-flex flex-row p-10  secondg-bg heading">
                        <div> Customer Details</div>
                      </div>
                      <div class="" id="customer-details">
                        <div class="d-flex  row  p-20">
                          <div class="col-sm-6">
                            <div class="form-input">
                              <label class="phone-num-lable">Phone Number</label>
                                <input type="tel" id="phone" placeholder="987654321" class=" form-control" name="contact_details[phone]" maxlength="10" minlength="10" required>
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

                            <div class="col-sm-6">
                                <div class="form-inputs ">
                                <label class="form-check-box mb-0" style="margin-top: 10px;margin-left:8px" for="Lift1">For Youself</label>
                                    <label class="container" style="margin-top: 10px;margin-left:-30px">
                                        <input type="hidden" value="true" name="meta[self_booking]:boolean" id="slef">
                                        <input type="checkbox" checked class="check-toggle" data-value="1" data-target=".toggle-input" name="select_letter" value="1" id="slef1" onchange="document.getElementById('slef').value = this.checked ? true : false">
                                        <!-- <span class="checkmark"></span> -->
                                    </label>

                                    <span class="error-message">Please enter valid</span>
                                </div>
                            </div>
                            <!-- Toggle -->
                          <div class="col-sm-6 toggle-input hidden">
                            <div class="form-input">
                                <label class="phone-num-">Friend's Phone Number</label>
                                <input type="tel" id="phonefriend" placeholder="987654321" name="friend_details[phone]" class=" form-control">
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

                      <div class="d-flex flex-row p-10  secondg-bg heading" >
                        <div> Delivery Details</div>
                      </div>
                      <div class="" id="delivery-details">
                        <div class="d-flex  row  p-20">
                          <div class="col-sm-6">
                            <div class="form-input">
                              <label>From Address </label>
                              <input type="text" placeholder="Choose on map" name="source[meta][geocode]" class="form-control source-autocomplete" required>
                              <span class="error-message">Please enter valid</span>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-input">
                              <label>From Adress line 1</label>
                              <input type="text" placeholder="Flat no, Street no" name="source[meta][address_line1]"  class="form-control" required>
                              <input type="hidden"  name="source[lat]" id="source-lat" class="form-control" required>
                              <input type="hidden"  name="source[lng]" id="source-lng" class="form-control" required>
                              <span class="error-message">Please enter valid</span>
                            </div>
                          </div>

                          <div class="col-sm-6 mtop-22">
                            <!--Map -->
                            <!-- <div class="mapouter"><div class="gmap_canvas"><iframe width="85%" height="350px" id="gmap_canvas" src="https://maps.google.com/maps?q=Benguluru%20indiranagar,svm%20complex&t=&z=7&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://grantorrent-es.com">grantorrent</a><br><style>.mapouter{position:relative;text-align:left;height:250px;width:118%;}</style><a href="https://www.embedgooglemap.net">google map on your website</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:131px;width:100%;}</style></div></div> -->
                            <div style="width: 100%; height: 280px;" class="source-map-picker"></div>
                          </div>
                          <div class="col-sm-6">
                            <div class="d-flex  row justify-content-between">
                                <div class="col-sm-12">
                                    <div class="form-input">
                                        <label>From Adress line 2</label>
                                        <input type="text" placeholder="Landmark, Area" name="source[meta][address_line2]" class="form-control source-autocomplete" required readonly>
                                        <span class="error-message">Please enter valid</span>
                                    </div>
                                </div>
                              <div class="col-sm-6">
                                <div class="form-input">
                                  <label>From City</label>
                                    <input type="text" placeholder="City" id="source-city" class="form-control" name="source[meta][city]" required>
                                    <span class="error-message">Please enter valid</span>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-input">
                                  <label>From State</label>
                                    <input type="text" placeholder="State" id="source-state" class="form-control" name="source[meta][state]" required>
                                    <span class="error-message">Please enter valid</span>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-input">
                                  <label>From Pincode</label>
                                  <input type="text" placeholder="560097" id="source-pin" class="form-control" name="source[meta][pincode]" required onkeydown="return ( event.ctrlKey || event.altKey
												|| (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
												|| (95<event.keyCode && event.keyCode<106)
												|| (event.keyCode==8) || (event.keyCode==9)
												|| (event.keyCode>34 && event.keyCode<40)
												|| (event.keyCode==46) )">
                                  <span class="error-message">Please enter valid</span>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-input">
                                  <label>From Floor</label>
                                  <input type="number" placeholder="3rd Floor" id="" value="0" min="-3" max="99" name="source[meta][floor]" class="form-control" required oninput="$(this).val(parseInt($(this).val()));">
                                  <span class="error-message">Please enter valid</span>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                <label class="form-check-box mb-0" style="margin-top: 10px; margin-left:8px" for="Lift1">Flat/APARTMENT has SERVICE Lift?</label>
                                    <label class="container" style="margin-top: 10px; margin-left:-30px">
                                        <input type="hidden" value="0" name="source[meta][lift]" id="letter">
                                        <input type="checkbox" name="select_letter" value="1" id="Lift1"
                                               onchange="document.getElementById('letter').value = this.checked ? 1 : 0">
                                        <!-- <span class="checkmark"></span> -->
                                    </label>

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
                                <input type="text" placeholder="Choose on map" name="destination[meta][geocode]" class="form-control dest-autocomplete">
                                    <input type="hidden"  name="destination[lat]" id="dest-lat" class="form-control" required>
                                    <input type="hidden"  name="destination[lng]" id="dest-lng" class="form-control" required>
                                <span class="error-message">Please enter valid</span>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-input">
                              <label>To Adress line 1</label>
                              <input type="text" placeholder="Flat no, Street no" name="destination[meta][address_line1]" id="" class="form-control" required>
                              <span class="error-message">Please enter valid</span>
                            </div>
                          </div>
                          <div class="col-sm-6 mtop-22">
                            <!--Map -->
                            <!-- <div class="mapouter"><div class="gmap_canvas"><iframe width="85%" height="auto" id="gmap_canvas" src="https://maps.google.com/maps?q=Benguluru%20indiranagar,svm%20complex&t=&z=7&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://grantorrent-es.com">grantorrent</a><br><style>.mapouter{position:relative;text-align:left;height:131px;width:118%;}</style><a href="https://www.embedgooglemap.net">google map on your website</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:131px;width:100%;}</style></div></div> -->
                              <div style="width: 100%; height: 280px;" class="dest-map-picker"></div>
                          </div>
                          <div class="col-sm-6">
                            <div class="d-flex row justify-content-between">
                                <div class="col-sm-12">
                                    <div class="form-input">
                                        <label>To Adress line 2</label>
                                        <input type="text" name="destination[meta][address_line2]" placeholder="Landmark, Area" id="" class="form-control dest-autocomplete" required readonly>
                                        <span class="error-message">Please enter valid</span>
                                    </div>
                                </div>
                              <div class="col-sm-6">
                                <div class="form-input">
                                  <label>To City</label>
                                  <input type="text" placeholder="City" id="dest-city"  name="destination[meta][city]" class="form-control" required>
                                  <span class="error-message">Please enter valid</span>
                                </div>
                              </div>
                                <div class="col-sm-6">
                                <div class="form-input">
                                  <label>To State</label>
                                    <input type="text" placeholder="State" id="dest-state"  name="destination[meta][state]" class="form-control" required>
                                  <span class="error-message">Please enter valid</span>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-input">
                                  <label>To Pincode</label>
                                  <input type="text" placeholder="620001" name="destination[meta][pincode]"  id="dest-pin" class="form-control" maxlength="6" minlength="6" required onkeydown="return ( event.ctrlKey || event.altKey
												|| (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
												|| (95<event.keyCode && event.keyCode<106)
												|| (event.keyCode==8) || (event.keyCode==9)
												|| (event.keyCode>34 && event.keyCode<40)
												|| (event.keyCode==46) )">
                                  <span class="error-message">Please enter valid</span>
                                </div>
                              </div>

                              <div class="col-sm-6">
                                <div class="form-input">
                                  <label>To Floor </label>
                                    <input type="number" placeholder="5" min="-3" max="99" value="0" name="destination[meta][floor]" id="" class="form-control" required oninput="$(this).val(parseInt($(this).val()));">
                                    <span class="error-message">Please enter valid</span>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-inputs">
                                <label class="form-check-box"   style="margin-top: 10px; margin-left:8px" for="Lift2">Flat/APARTMENT has SERVICE Lift?</label>
                                  <label class="container " style="margin-top: 10px; margin-left:-30px">
                                      <input type="hidden" value="0" name="destination[meta][lift]" id="letter2">
                                      <input type="checkbox" name="select_letter" value="1" id="Lift2"
                                             onchange="document.getElementById('letter2').value = this.checked ? 1 : 0">
                                    <!-- <span class="checkmark"></span> -->
                                  </label>

                                  <span class="error-message">Please enter valid</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="border-bottom"></div>
                        <div class="d-flex  row  p-20" >
                          <div class="col-sm-6" >
                            <div class="form-input" >
                              <label class="start-date">Choose a Date</label>
                              <div id="my-modal">
                                <input type="text" id="dateselect" name="movement_dates" class="form-control br-5 date bookdate cursor-pointer" required="required" placeholder="15 Jan"  />
                                <span class="error-message">please enter valid date</span>
                                  <input type="hidden" name="meta[images][]">
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-inputs">
                            <label class="form-check-box" for="need1"  style="margin-top: 10px;margin-left:8px">Interested in shared services?</label>
                                <label class="container"  style="margin-top: 10px; margin-left:-30px">
                                    <input type="hidden" value="false" name="source[meta][shared_service]:boolean" id="m_type">
                                    <input type="checkbox" name="select_letter" value="1" id="movemnt"
                                           onchange="document.getElementById('m_type').value = this.checked ? true : false">
                                    <!-- <span class="checkmark"></span> -->
                                  <!-- <span class="checkmark"></span> -->
                                </label>

                                <span class="error-message">Please enter valid</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex flex-row p-10  secondg-bg heading" >
                        <div>Requirements</div>
                      </div>
                      <div class="" id="requirments">
                        <div class="d-flex  row p-20">
                          <div class="col-sm-6">
                            <div class="form-input">
                            <label>Movement Type</label>
                                <select  id="" name="service_id" class="form-control category-select " data-target=".range" required>
                                    <option value="">--select--</option>
                                 @foreach($categories as $category)

                                        <option id="sub_{{$category->id}}" data-type="{{$category->inventory_quantity_type}}" value="{{$category->id}}" data-subcategory="{{$category->subservices}}">{{$category->name}}</option>
                                    @endforeach
                                  </select>
                              <span class="error-message">Please enter  valid</span>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-input">
                              <label>Room Selection</label>
                                <select name="meta[subcategory]" class="form-control subservices">
                                </select>
                                <span class="error-message">Please enter valid</span>
                            </div>
                          </div>
                          <div class="col-sm-12 mtop-20  p-15   pb-0" >
                            <div class="heading p-10 border-around " style="padding-left: 26px;">
                              Item List
                            </div>
                            <table class="table text-center p-10  theme-text tb-border2" id="items" >
                                <thead class="secondg-bg bx-shadowg p-0 f-14">
                                  <tr class="">
                                    <th scope="col">Item Name</th>
                                      <th scope="col">Material</th>
                                        <th scope="col">Size</th>
                                      <th scope="col">Quantity</th>
                                    <th scope="col">Actions</th>
                                  </tr>
                                </thead>
                                <tbody class="mtop-20 f-13" id="add-inventory-wrapper">
                                    <tr class="inventory-snip">
                                    <td scope="row" class="text-left">
                                        <select class="form-control br-5 inventory-select" name="inventory_items[][inventory_id]" required>
                                            <option value="">--Select--</option>
                                            @foreach($inventories as $inventory)
                                                <option id="inventory_{{$inventory->id}}" value="{{$inventory->id}}" data-size="{{$inventory->size}}" data-material="{{$inventory->material}}">{{$inventory->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td class="">
                                        <select class="form-control br-5 material" name="inventory_items[][material]" required>
                                            <option value="">-- Select --</option>

                                        </select>
                                    </td>

                                    <td class="">
                                        <select class="form-control br-5 size" name="inventory_items[][size]" id="size" required>
                                            <option value="">-- Select --</option>

                                        </select>
                                    </td>

                                    <td class="" style="width: 20%;">
                                        <input class="form-control br-5 fixed " type="number" placeholder="0" name="inventory_items[][quantity]" >
                                        <span class="hidden"> <input type="text" class="custom_slider custom_slider_1 range" name="inventory_items[][quantity]"  data-min="0" data-max="1000" data-from="0" data-to="1000" data-type="double" data-step="1" /></span>

                                    </td>

                                    <td>
                                        <span class="closer" data-parent=".inventory-snip"><i class="fa fa-trash p-1 cursor-pointer" aria-hidden="true"></i></span>
                                    </td>
                                </tr>


                                </tbody>
                            </table>
                          </div>
                          <div class="col-sm-12 mtop-20 w-30">
                              <a class="float-right btn theme-bg white-text repeater" data-content="#add-inventory-row" data-container="#add-inventory-wrapper"  id="addnew-btn" >
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
                              <label>Comments/Instructions from Customers</label>
                              <textarea placeholder="Add note/comment here..." id="" name="meta[customer][remarks]" class="form-control" rows="4"
                                  cols="50"></textarea>
                              <span class="error-message">Please enter valid</span>
                            </div>
                          </div>
                        </div>
                        <div class="d-flex  justify-content-between flex-row  p-10 ">
                          <div class="w-50">
                              <a class="white-text p-10" href="{{route('orders-booking')}}">
                                  <button type="button" class="btn  w-30 white-text">Cancel</button>
                              </a>
                          </div>
                          <div class="w-50 text-right">
                              <a class="white-text p-10" href="#">
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
    <script type="text/html" id="add-inventory-row">
        <tr class="inventory-snip">
            <th scope="row" class="text-left">
                <select class="form-control br-5 inventory-select" name="inventory_items[][inventory_id]" required>
                    <option value="">--Select--</option>
                    @foreach($inventories as $inventory)
                        <option id="inventory_{{$inventory->id}}" value="{{$inventory->id}}" data-size="{{$inventory->size}}" data-material="{{$inventory->material}}" >{{$inventory->name}}</option>
                    @endforeach
                </select>
            </th>

            <td class="">
                <select class="form-control br-5 material" name="inventory_items[][material]" required>
                    <option value="">-- Select --</option>
                </select>
            </td>

            <td class="">
                <select class="form-control br-5 size" name="inventory_items[][size]" id="size" required>
                    <option value="">-- Select --</option>
                </select>
            </td>

            <td class="" style="width: 20%;">
                <input class="form-control br-5 fixed" type="number" name="inventory_items[][quantity]" placeholder="0" >

                <span class="hidden"><input type="text" class="custom_slider custom_slider_1 range" name="inventory_items[][quantity]"  data-min="0" data-max="1000" data-from="0" data-to="1000" data-type="double" data-step="1" /></span>
            </td>

            <td>
                <span class="closer" data-parent=".inventory-snip"><i class="fa fa-trash p-1 cursor-pointer" aria-hidden="true"></i></span>
            </td>
        </tr>

    </script>
</div>


@endsection
