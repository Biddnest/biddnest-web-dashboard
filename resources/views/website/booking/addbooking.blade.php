@extends('website.layouts.frame')
@section('title') Create a booking @endsection
@section('header_title')Create a booking @endsection
@section('content')
<div class="content-wrapper" data-barba="container" data-barba-namespace="addbooking">
    <div class="container ">
        <div class="book-move-screen responsive ontop-book ">
            <div class="card-body ">
                <div class="row d-flex ">
                    <div class="col-md-3 br-line view-none pt-4">
                        <div class="row steps-form-3 ">
                            <div class="col-md-8 setup-panel-3">
                                <div class="steps-step-1 color-purple">
                                    <p class="step-text text-right ">Customer Details
                                        <span class="text-muted "> Personal Info</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4 steps-row-3 setup-panel-3">
                                <div class="steps-step-3 card-block ">
                                    <a href="#step-1 " type="button" class="btn steps-icon rounded-icons btn-info btn-circle-3 waves-effect ml-0 turntheme text-muted completed-step-1 " data-toggle="tooltip " data-placement="top " title="Basic Information "><i class="fa fa-user " aria-hidden="true "></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="row steps-form-3 ">
                            <div class="col-md-8 setup-panel-3">
                                <div class="steps-step-2 ">
                                    <p class="step-text text-right ">Delivery Details<span class="text-muted ">
                                            Personal Info</span>
                                </div>
                            </div>
                            <div class="col-md-4 steps-row-3 setup-panel-3">
                                <div class="steps-step-3 card-block ">
                                    <a href="#step-2 " type="button" class="btn steps-icon rounded-icons btn-pink btn-circle-3 waves-effect p-3 card-block completed-step-2" data-toggle="tooltip " data-placement="top " title="Basic Information "><i class="fa fa-map-marker " aria-hidden="true "></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="row steps-form-3 ">
                            <div class="col-md-8 setup-panel-3">
                                <div class="steps-step-3 ">
                                    <p class="step-text text-right ">Requirements<span class="text-muted "> Personal
                                            Info</span></p>
                                </div>
                            </div>
                            <div class="col-md-4 steps-row-3 setup-panel-3">
                                <div class="steps-step-3 ">
                                    <a href="#step-3 " type="button" class="btn steps-icon rounded-icons btn-pink btn-circle-3 waves-effect step-todo completed-step-3" data-toggle="tooltip " data-placement="top " title="Basic Information "><i class="fa fa-list " aria-hidden="true "></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="row steps-form-3 ">
                            <div class="col-md-8 setup-panel-3">
                                <div class="steps-step-4 ">
                                    <p class="step-text text-right">Instructions<span class="text-muted ">
                                            Personal Info</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4 steps-row-3 setup-panel-3">
                                <div class="steps-step-3 ">
                                    <a href="#step-4 " type="submit" class="btn steps-icon rounded-icons btn-pink btn-circle-3 waves-effect p-3 step-todo completed-step-4" data-toggle="tooltip " data-placement="top " title="Basic Information "><i class="fa fa-comments " aria-hidden="true "></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="row steps-form-3 ">
                            <div class="col-md-8 setup-panel-3">
                                <div class="steps-step-5 ">
                                    <p class="step-text text-right ">Estimation Cost<span class="text-muted ">
                                            Personal Info</span>
                                </div>
                            </div>
                            <div class="col-md-4 steps-row-3 setup-panel-3">
                                <div class="steps-step-3 ">
                                    <a href="#step-5 " type="button " class="btn steps-icon rounded-icons btn-pink btn-circle-3 waves-effect p-3 step-todo completed-step-5" data-toggle="tooltip " data-placement="top " title="Basic Information "><i class="fa fa-tag " aria-hidden="true "></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="row steps-form-3 ">
                            <div class="col-md-8 setup-panel-3">
                                <div class="steps-step-6 ">
                                    <p class="step-text text-right ">Place Request<span class="text-muted ">
                                            Personal
                                            Info</span></p>
                                </div>
                            </div>
                            <div class="col-md-4 steps-row-3 setup-panel-3">
                                <div class="steps-step-3 ">
                                    <a href="#step-6 " type="button " class="btn steps-icon rounded-icons btn-pink btn-circle-3 waves-effect p-3 step-todo completed-step-6" data-toggle="tooltip " data-placement="top " title="Basic Information "><i class="fa fa-thumbs-up " aria-hidden="true "></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 book-move-questions-container">

                        <form id="wizard" class="move-booking order_create_web" action="{{route('add-bookmove')}}" method="POST" data-next="redirect" data-redirect-type="hard" data-url="{{route('estimate-booking', ['id'=>':id'])}}" data-alert="mega" id="myForm" data-parsley-validate>
                            <div class="row setup-content-3 step-1" id="step-1">
                                <div class="row ">
                                    <div class="col-md-12 ">
                                        <p class="text-muted ">Step 1/ 6</p>
                                        <h4 class=" border-bottom pl-0 pb-3 theme-text ">Lets start with your personal information
                                        </h4>
                                    </div>

                                    <div class="col-md-12 ">
                                        <div class="accordion ml-3 " id="customer-details ">
                                            <div class="d-flex row p-20 ">
                                                <div class="col-sm-12 " style="margin-bottom: 20px;">
                                                    <div class="small-switch ">
                                                        <label class="phone-num-lable">I am booking For Friend</label>
                                                        <div>
                                                            <label class="switch2">
                                                                <input type="hidden" value="true" name="meta[self_booking]:boolean" id="slef">
                                                                <input type="checkbox" class="switch" data-value="0" data-target=".toggle-input" name="select_letter" value="0" id="slef1" onchange="document.getElementById('slef').value = this.checked ? false : true" data-phone="{{\Illuminate\Support\Facades\Session::get('account')['phone']}}" data-name="{{\Illuminate\Support\Facades\Session::get('account')['fname']}} {{\Illuminate\Support\Facades\Session::get('account')['lname']}}" data-email="{{\Illuminate\Support\Facades\Session::get('account')['email']}}">
                                                                <span class="slider2"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-xs-12 ">
                                                    <div class="form-group ">
                                                        <label class="phone-num-lable">Phone Number</label>
                                                        <span class=" ">
                                                            <input type="tel" id="phone" placeholder="9099090909"  class="form-control phone" name="contact_details[phone]" value="{{\Illuminate\Support\Facades\Session::get('account')['phone']}}" maxlength="10" minlength="10" required>
                                                            <span class="error-message ">Please enter valid Phone
                                                                number</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <div class="form-group">
                                                        <label class="full-name">Full Name</label>
                                                        <span class=" ">
                                                            <input type="text" id="fullname" placeholder="David Jerome"  class="form-control" name="contact_details[name]" value="{{\Illuminate\Support\Facades\Session::get('account')['fname']}} {{\Illuminate\Support\Facades\Session::get('account')['lname']}}"  class="form-control" required>
                                                            <span class="error-message">Please enter valid
                                                                name</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <div class="form-group ">
                                                        <label class="email-label">Email</label>
                                                        <span class=" ">
                                                            <input type="email" placeholder="abc@mail.com" id="email"  name="contact_details[email]" value="{{\Illuminate\Support\Facades\Session::get('account')['email']}}" id="E-mail" class="form-control" required>
                                                            <span class="error-message">Please enter valid
                                                                Email</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="actionBtn alignone  actionBtn-mob-view border-top ">
                                            <a href="{{route('home')}}">
                                                <button type="button" class="btn btn-mdb-color mt-2 btn-rounded cancelBtn float-left ml-5 ">
                                                    Cancel
                                                </button>
                                            </a>
                                            <button type="button" class="btn btn-mdb-color btn-rounded nextBtn-3 float-right mt-2 mr-5 next1 " id="next1">Next
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- second step -->
                            <div class="row setup-content-3 step-2" id="step-2" style="display: none;">
                                <div class="col-md-12 col-paddingnon">
                                    <p class="text-muted ">Step 2 / 6</p>
                                    <h4 class=" border-bottom pl-0 pb-4 theme-text head-book-move  " style="margin-bottom: 10px !important;">Lets get the delivery details
                                    </h4>
                                    <div class="accordion mt-2" id="delivery-details ">
                                        <p class="address-category pl-0  ">Movement Type</p>
                                        <div class="row row-horizonal ml-0 border-bottom pb-3">
                                            @foreach($categories as $category)
                                            <div class="col-md-4 col-lg-4 col-sm-4 col-paddingnon pl-0">
                                                <label>
                                                    <input type="radio" name="service_id" id="service_{{$category->id}}" value="{{$category->id}}" data-quantity-type="{{$category->inventory_quantity_type}}" class="card-input-element web-category" data-url="{{route('get_subservices', ['service_id'=>$category->id])}}" @if($prifill['service'] && ($category->id == $prifill['service'])) chaecked @endif/>
                                                    <div class="panel panel-default card-width card-input address-name card-methord02 text-center h-100 py-2 px-3 card-methord  bg-turnblue cursor-pointer  @if($prifill['service'] && ($category->id == $prifill['service']))turntheme check-icon02 @endif" style="border-radius: 6px;">
                                                        <div class="panel-heading text-white f-direction" style="display: flex; justify-content-center;">
                                                            <img src="{{$category->image}}" class="img-width">
                                                            {{ucwords($category->name)}}
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="d-flex row p-20 ">
                                            <div class="col-sm-6 mt-2">
                                                <div class="form-group ">
                                                    <label class="address-details-input ">Search Near By Location</label>
                                                    <input type="text" placeholder="Choose on map" name="source[meta][geocode]" id="" class="form-control source-autocomplete" required>
                                                    <span class="error-message ">Please enter valid</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mt-2">
                                                <div class="form-group ">
                                                    <label class="address-details-input ">From Adress line 1</label>
                                                    <input type="text" placeholder="Flat no, Street no" name="source[meta][address_line1]" class="form-control" required>
                                                    <input type="hidden" name="source[lat]" id="source-lat" value="{{$prifill['source_lat']}}" class="form-control" required>
                                                    <input type="hidden" name="source[lng]" id="source-lng" value="{{$prifill['source_lng']}}" class="form-control" required>
                                                    <span class="error-message ">Please enter valid</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mtop-22 mb-view ">
                                                <div style="width: 100%; height: 280px;" class="source-map-picker_booking"></div>
                                                {{-- <div id="mapcomponent " class="dest-map-picker " style="width: 100%; height: 155px; "></div>--}}
                                                <!-- <div id="frommap " ></div> -->
                                                <div>
                                                    <label class="address-details-input ">We are Available In {{implode(", ", (array)$zones)}}.</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="d-flex row justify-content-between ">
                                                    <div class="col-sm-12">
                                                        <div class="form-group ">
                                                            <label class="address-details-input ">From Adress line 2</label>
                                                            <input type="text" placeholder="Landmark, Area" name="source[meta][address_line2]" id="" class="form-control source-autocomplete" required readonly>
                                                            <span class="error-message">Please enter valid</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <div class="form-group ">
                                                            <label class="address-details-input ">From City</label>
                                                            <input type="text" id="source-city" placeholder="City" class="form-control" name="source[meta][city]" required>
                                                            <span class="error-message ">Please enter valid</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <div class="form-group ">
                                                            <label class="address-details-input ">From State</label>
                                                            <input type="text" placeholder="State" id="source-state" class="form-control " name="source[meta][state]" required />
                                                            <span class="error-message ">Please enter valid</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <div class="form-group ">
                                                            <label class="address-details-input ">From Pincode</label>
                                                            <input type="text" placeholder="560097" maxlength="6" minlength="6" id="source-pin" class="form-control" name="source[meta][pincode]" required onkeydown="return ( event.ctrlKey || event.altKey
												|| (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
												|| (95<event.keyCode && event.keyCode<106)
												|| (event.keyCode==8) || (event.keyCode==9)
												|| (event.keyCode>34 && event.keyCode<40)
												|| (event.keyCode==46) )"/>
                                                            <span class="error-message ">Please enter valid</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 ">
                                                        <div class="form-group ">
                                                            <label class="address-details-input ">From Floor</label>
                                                            <input type="number" placeholder="3" min="-3" max="99" name="source[meta][floor]" class="form-control " required>
                                                            <span class="error-message ">Please enter valid</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 ">
                                                        <div class="form-group mt-1 ">
                                                            <label class="form-check-box ml-0" for="Lift1 ">My Flat/APARTMENT has SERVICE Lift?</label>
                                                            <div style="display:flex;">
                                                            <div class="col-sm-3">
                                                                <label class="switch2">
                                                                    <input type="hidden" value="0" name="source[meta][lift]" id="letter">
                                                                    <input type="checkbox" name="select_letter" value="1" id="Lift1" onchange="document.getElementById('letter').value = this.checked ? 1 : 0">
                                                                    <span class="slider2"></span>
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <span class="error-message ">Please enter valid</span>
                                                                <span class="text-muted">(This will help us to move your things in a better way.)</span>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-bottom pt-3 "></div>
                                        <div class="d-flex row p-20 mt-2 ">
                                            <div class="col-sm-6 ">
                                                <div class="form-group ">
                                                    <label class="address-details-input ">Search Near By Location</label>
                                                    <input type="text" placeholder="Choose on map" name="destination[meta][geocode]" id="" class="form-control dest-autocomplete">
                                                    <input type="hidden" name="destination[lat]" value="{{$prifill['dest_lat']}}" id="dest-lat" class="form-control" required>
                                                    <input type="hidden" name="destination[lng]" value="{{$prifill['dest_lng']}}" id="dest-lng" class="form-control" required>
                                                    <span class="error-message ">Please enter valid</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="form-group ">
                                                    <label class="address-details-input ">To Address line 1</label>
                                                    <input type="text" placeholder="Flat no, Street no" name="destination[meta][address_line1]" id="" class="form-control" required>
                                                    <span class="error-message ">Please enter valid</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mtop-22 mb-view ">
                                                {{-- <div id="mapcomponent " class="source-map-picker " style="width: 100%; height: 155px; "></div>--}}
                                                <!-- <div id="tomap " style="width: 100%; height: 155px; "></div> -->
                                                <div style="width: 100%; height: 280px;" class="dest-map-picker_booking"></div>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <div class="d-flex row justify-content-between ">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>From Adress line 2</label>
                                                            <input type="text" name="destination[meta][address_line2]" placeholder="Landmark, Area" id="" class="form-control dest-autocomplete" required readonly>
                                                            <span class="error-message">Please enter valid</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <div class="form-group ">
                                                            <label class="address-details-input ">To City</label>
                                                            <input type="text" placeholder="City" id="dest-city" name="destination[meta][city]" class="form-control" required>
                                                            <span class="error-message ">Please enter valid</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <div class="form-group ">
                                                            <label class="address-details-input ">To State</label>
                                                            <input type="text" placeholder="State" id="dest-state" name="destination[meta][state]" class="form-control" required>
                                                            <span class="error-message ">Please enter valid</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <div class="form-group ">
                                                            <label class="address-details-input ">To Pincode</label>
                                                            <input type="text" data-parsley-type="number" placeholder="620001" name="destination[meta][pincode]" id="dest-pin" class="form-control" maxlength="6" minlength="6" required onkeydown="return ( event.ctrlKey || event.altKey
												|| (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
												|| (95<event.keyCode && event.keyCode<106)
												|| (event.keyCode==8) || (event.keyCode==9)
												|| (event.keyCode>34 && event.keyCode<40)
												|| (event.keyCode==46) )">
                                                            <span class="error-message ">Please enter valid</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <div class="form-group ">
                                                            <label class="address-details-input ">To Floor </label>
                                                            <input type="number" placeholder="5" min="-3" max="99" name="destination[meta][floor]" id="" class="form-control" required >
                                                            <span class="error-message ">Please enter valid</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group mt-1">
                                                            <label class="form-check-box ml-0 " for="Lift1 ">My Flat/APARTMENT has SERVICE Lift?</label>
                                                            <div style="display:flex;">
                                                                <div class="col-sm-3">
                                                                    <label class="switch2">
                                                                        <input type="hidden" value="0" name="destination[meta][lift]" id="letter2">
                                                                        <input type="checkbox" name="select_letter" value="1" id="Lift2" onchange="document.getElementById('letter2').value = this.checked ? 1 : 0">
                                                                        <span class="slider2"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <span class="error-message ">Please enter valid</span>
                                                                    <span class="text-muted">(This will help us to move your things in a better way.)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-bottom pt-3 "></div>
                                        <div class="d-flex row p-20 pt-2 ">
                                            <div class="col-sm-6 ">
                                                <div class="form-group ">
                                                    <label class="start-date ">Choose a Date</label>
                                                    <div id="my-modal ">
                                                        <input type="text" id="dateselect" class="form-control br-5 bookdate dateselect" placeholder="15 Jan" value="{{$prifill['move_date']}}" name="movement_dates" required />
                                                        <span class="error-message ">please enter valid date</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 ">
                                                <div class="form-group ">
                                                    <label class="te ">Interested in shared services?</label>
                                                    <div>
                                                        <label class="switch2">
                                                            <input type="hidden" class="share" value=@if(count($share) > 1) "true" @else "false" @endif name="source[meta][shared_service]:boolean" id="m_type">
                                                            <input type="checkbox" name="select_letter" class="share_check" @if(count($share) > 1) checked @endif value="1" id="movemnt" onchange="document.getElementById('m_type').value = this.checked ? true : false" disabled>
                                                            <span class="slider2"></span>
                                                        </label>
                                                    </div>
                                                    <span class="error-message ">Please enter valid</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" actionBtn align actionBtn-view border-top move-btn">
                                        <a href="{{route('home')}}" class="view-none">
                                            <button type="button" class="btn btn-mdb-color mt-2 btn-rounded cancelBtn float-left ml-4 ">
                                                Cancel
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-mdb-color mt-2 btn-rounded nextBtn-3 float-right mr-4 next2" id="next2">
                                            Next
                                        </button>
                                        <button type="button" class="btn btn-mdb-color mt-2 btn-rounded cancelBtn float-right mr-3 back2 bview-btn">Back
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Third Step -->
                            <div class="setup-content-3 step-3" id="step-3" style="display: none;">
                                <div class="col-md-12 heading-view ">
                                    <p class="text-muted ">Step 3/ 6</p>
                                    <h4 class=" border-bottom pl-0 pb-4 theme-text head-book-move " style="margin-bottom: 10px !important;">Lets get your requirements</h4>
                                </div>
                                <div class="row d-flex justify-content-center row-horizonal subservices">

                                </div>
                                <input type="hidden" name="meta[subcategory]" id="subservice_id">
                                <div id="filter" class="bg-light">
                                    <ul class="nav nav-tabs " id="myTab " role="tablist ">
                                        <li class="nav-item ">
                                            <a class="nav-link active p-15 filter-button" id="live-tab " data-toggle="tab " href="#live " role="tab " aria-controls="home " aria-selected="true " data-filter="all">All</a>
                                        </li>
                                        @foreach(\App\Enums\InventoryEnums::$CATEGORY as $categories)
                                            <li class="nav-item ">
                                                <a class="nav-link p-15 filter-button" id="past-tab " data-toggle="tab " href="#past " role="tab " aria-controls="profile " aria-selected="false " data-filter="{{$categories}}">{{ucwords($categories)}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="row  mb-4 inventory">
                                    <div class="col-md-4" data-toggle="modal" data-target="#addItemModal" style="min-height: 40vh !important;">
                                        <div class="item-single-wrapper add-more" style="height: 100% !important;">
                                            <i class="icon dripicons-plus" ></i>
                                        </div>
                                    </div>
                                </div>

                                <div class=" actionBtn align actionBtn-view border-top move-btn">
                                    <a href="{{route('home')}}" class="view-none">
                                        <button type="button" class="btn btn-mdb-color mt-2 btn-rounded cancelBtn float-left ml-4 ">
                                            Cancel
                                        </button>
                                    </a>
                                    <button type="button" class="btn btn-mdb-color mt-2 btn-rounded nextBtn-3 float-right next3 mr-4" id="next3">
                                        Next
                                    </button>
                                    <button type="button" class="btn btn-mdb-color mt-2 btn-rounded cancelBtn float-right mr-3 back3 bview-btn">Back
                                    </button>
                                </div>
                                <!--Add Item Modal-->

                            </div>

                            <!-- Fourth Step -->
                            <div class=" setup-content-3 step-4" id="step-4" style="display: none;">
                                <div class="col-md-12 col-paddingnon">
                                    <p class="text-muted ">Step 4 / 6</p>
                                    <h4 class=" border-bottom pl-0 pb-4 theme-text ">Add Comments and Upload Photos
                                    </h4>
                                    <div class="form-group ">
                                        <label for="comments-area " class="comments ">Comments/Instructions</label>
                                        <textarea placeholder="Add note/comment here..." id="" name="meta[customer][remarks]" class="form-control" rows="4" cols="50"></textarea>
                                    </div>
                                </div>

                                <div>
                                    <h4 class="pl-2 pb-4 pt-3 comments ml-2">Upload Photos</h4>

                                    <div class="row d-flex uploaded-image mb-5 ml-2 pl-2 mr-0">
                                        <div class="col-md-2 pl-0 cursor-pointer">
                                            <input type="file" class="hidden custom-file-input upload-image" accept="image/*">
                                            <img src="https://cdn.iconscout.com/icon/premium/png-256-thumb/plus-square-1179806.png" onclick="$(this).parent().find('input').click();" alt="uploadedImage" class="image-upload-by-customer" style="width: 100%; height: 100%;"/>
                                        </div>
                                    </div>
                                </div>

                                <div class=" actionBtn align actionBtn-view border-top move-btn">
                                    <a href="{{route('home')}}" class="view-none">
                                        <button class="btn btn-mdb-color mt-2 btn-rounded cancelBtn float-left ml-4 " type="button" style="margin-left: 40px;">
                                            Cancel
                                        </button>
                                    </a>
                                    <button class="btn btn-mdb-color mt-2 btn-rounded nextBtn-3 float-right next4 mr-4"  id="next4" style="margin-right: 40px !important;">
                                        Next
                                    </button>
                                    <button class="btn btn-mdb-color mt-2 btn-rounded cancelBtn float-right mr-3 back4 bview-btn" type="button">Back
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal modal-background" id="addItemModal" >
        <div class="modal-dialog addItemModal item-modal-width" style=" top: 2vh">
            <div class="modal-content ">
                <!-- Modal Header -->
                <div class="modal-header border-bottom ">
                    <h4 class="modal-title add-item-title theme-text ">Add Item</h4>
                    <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div class="modal-body add-item-body show" style="display:block; padding: 2rem !important; overflow-y: scroll !important; max-height: 80vh;">

                        <div class="input-group mt-3 mb-3 search-bar-with-category " style="margin-top: 0rem !important;">
                            <input type="search" class="form-control search-item" data-url="{{route('search_item')}}" name="search" style="border: none !important;" placeholder="Search for item.. ">
                        </div>

                <!-- modal for desktop -->
                    <div class="items-display fade-enable">

                    </div>
                    <h5 style="margin-top: 20px;" class="fade-enable">Top Recommended Items</h5>
                    <div class="row f-row fade-enable">
                        @foreach($inventories as $inventory)
                            <div class="col-md-3" style="padding-right: 10px; padding-left: 10px;">
                                <div class="item-single-wrapper">
                                    <div class="item-image">
                                        <img src="{{$inventory->image}}" />
                                        <input type="hidden" name="meta_image" value="{{$inventory->image}}">
                                        <input type="hidden" name="meta_category" value="{{$inventory->category}}">
                                    </div>
                                    <div class="item-meta">
                                        <h5>{{ucwords($inventory->name)}}</h5>
                                        <input type="hidden" name="meta_name" value="{{$inventory->name}}">
                                        <input type="hidden" name="meta_id" value="{{$inventory->id}}">
                                        <div class="info-wrapper d-flex flex-row justify-content-between">
                                            <span class="info">
                                                <span>Material</span>
                                                <input type="hidden" name="material" value="" />
                                                <input type="hidden" name="meta_material" value="{{$inventory->material}}" />
                                                <div class="dropdown-content">
                                                  <ul class="d-content">
                                                     @foreach(json_decode($inventory->material, true) as $material)
                                                          <li class="drop-list" style="padding: 5px 10px;" data-value="{{$material}}">
                                                              <a class="menu"><span class="ml-1">{{ucwords($material)}}</span></a>
                                                          </li>
                                                      @endforeach
                                                  </ul>
                                                </div>
                                            </span>
                                            <span class="info">
                                                <span>Size</span>
                                                <input type="hidden" name="size" value="" />
                                                <input type="hidden" name="meta_size" value="{{$inventory->size}}" />
                                                <div class="dropdown-content">
                                                  <ul class="d-content">
                                                       @foreach(json_decode($inventory->size, true) as $size)
                                                          <li class="drop-list" style="padding: 5px 10px;" data-value="{{$size}}">
                                                              <a class="menu"><span class="ml-1">{{ucwords($size)}}</span></a>
                                                          </li>
                                                      @endforeach
                                                  </ul>
                                                </div>
                                            </span>
                                        </div>
                                        <div class="quantity-filed"></div>
                                    </div>
                                    <button class="btn btn-block add-btn add-item">Add to list</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Modal footer -->
                    {{--<div class="modal-footer d-flex justify-content-between ">
                        <a href="{{route('home')}}"><button class="btn cancelBtn " type="button " data-dismiss="modal ">
                                Cancel
                            </button></a>
                        <button class="btn nextBtn-3" type="button ">
                            Save
                        </button>
                    </div>--}}
                </div>
            </div>
        </div>
    </div>

    <div class="spcae" style=" height: 0px !important; margin-bottom: 50px !important;">
        <input type="hidden" value="{{$inventory_quantity_type}}" class="inventory-quantity-type">
    </div>

    <script id="entry-template" type="text/x-handlebars-template">
        @{{#if subservices}}
        <div class="col-md-12" style="margin: 20px !important;">
            <h6 class="text-center">What are you moving</h6>
        </div>
        @{{/if}}
        @{{#each subservices}}
            <div class="col-md-2 col-lg-2 col-sm-4 col-paddingnon">

                <label>
                    <input type="radio" name="subcategory" value="@{{name}}" class="card-input-element01 web-sub-category" data-url="{{route('get_inventories')}}?subservice_id=@{{id}}"/>

                    <div class="panel panel-default card-input disabled subservice-selector" style="box-shadow: none !important;  background:none !important; text-align: center;">
                            <div class="panel-heading">
                                <h3>
                                    <img src="@{{image}}" class="img-width  " >
                                </h3>
                            </div>
                            <div class="panel-body card-title room-type pl-0 l-cap cursor-pointer ml-1 margin-view" style="color: #00000">
                            @{{name}}
                            </div>
                    </div>

                </label>

            </div>
        @{{/each}}
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script id="entry-templateinventory" type="text/x-handlebars-template">
        @{{#each inventories}}
                <div class="col-md-4 filter item-remove  @{{#replace ' ' '-'}}@{{meta.name}}-@{{material}}-@{{size}}-@{{meta.id}}@{{/replace}}a @{{meta.category}}" style="padding-right: 10px; padding-left: 10px;">
                    <div class="item-single-wrapper">
                        <span class="closer" data-parent=".item-remove"><i class="icon dripicons-cross"></i></span>
                        <div class="item-image" style="">
                            <img src="@{{meta.image}}" />
                        </div>
                        <div class="item-meta">
                            <h5>@{{meta.name}}</h5>
                            <input type="hidden" name="inventory_items[][inventory_id]:null" value="@{{meta.id}}">
                            <input type="hidden" name="cutome_name" value="@{{meta.name}}">
                            <div class="info-wrapper d-flex flex-row justify-content-between">
                                <span class="info">
                                    <span>@{{material}}</span>
                                    <input type="hidden" name="inventory_items[][material]" value="@{{material}}" />
                                    <div class="dropdown-content">
                                      <ul class="d-content">
                                          @{{#meta.material}}
                                              <li class="drop-list" style="padding: 5px 10px;" data-value="@{{.}}">
                                                  <a class="menu"><span class="ml-1">@{{.}}</span></a>
                                              </li>
                                          @{{/meta.material}}
                                      </ul>
                                    </div>
                                </span>
                                <span class="info">
                                    <span>@{{size}}</span>
                                    <input type="hidden" name="inventory_items[][size]" value="@{{size}}" />
                                    <div class="dropdown-content">
                                      <ul class="d-content">
                                           @{{#meta.size}}
                                              <li class="drop-list" style="padding: 5px 10px;" data-value="@{{.}}">
                                                  <a class="menu"><span class="ml-1">@{{.}}</span></a>
                                              </li>
                                           @{{/meta.size}}
                                      </ul>
                                    </div>
                                </span>
                            </div>
                            <div class="quantity d-flex justify-content-between quantity-operator">
                                <span class="minus">-</span>
                                <input type="text" name="inventory_items[][quantity]" readonly value="@{{quantity}}" />
                                <span class="plus">+</span>
                            </div>
                        </div>
                    </div>
                </div>
        @{{/each}}
        <div class="col-md-4" data-toggle="modal" data-target="#addItemModal" style="min-height: 40vh !important;">
            <div class="item-single-wrapper add-more" style="height: 100% !important;">
                <i class="icon dripicons-plus" ></i>
            </div>
        </div>
        {{--<div class="col-md-4  mt-2 ">
            <div class=" mt-1 view-content border-add">
                <div class="">
                    <i class="icon-2 mr-1 dripicons-plus add-item-icon  " data-toggle="modal" data-target="#addItemModal"></i>
                </div>
            </div>
        </div>--}}
    </script>

    {{--serialize input show--}}
    <script id="entry-templateinventory_append" type="text/x-handlebars-template">
        <div class="col-md-4 item-remove filter custom-item  @{{#replace ' ' '-'}}@{{meta_name}}-@{{material}}-@{{size}}-@{{meta_id}}@{{/replace}}a @{{meta_category}}" style="padding-right: 10px; padding-left: 10px;">
            <div class="item-single-wrapper">
                <span class="closer" data-parent=".item-remove"><i class="icon dripicons-cross"></i></span>
                <div class="item-image" style="">
                    <img src="@{{meta_image}}" />
                </div>
                <div class="item-meta">
                    <h5>@{{meta_name}}</h5>
                    <input type="hidden" name="inventory_items[][inventory_id]:null" value="@{{meta_id}}">
                    <input type="hidden" name="inventory_items[][name]" value="@{{meta_name}}">
                    <div class="info-wrapper d-flex flex-row justify-content-between">
                        <span class="info">
                            <span>@{{material}}</span>
                            <input type="hidden" name="inventory_items[][material]" value="@{{material}}" />
                            <div class="dropdown-content">
                                <ul class="d-content">
                                    @{{#meta_material}}
                                    <li class="drop-list" style="padding: 5px 10px;" data-value="@{{.}}">
                                        <a class="menu"><span class="ml-1">@{{.}}</span></a>
                                    </li>
                                    @{{/meta_material}}
                                </ul>
                            </div>
                        </span>
                        <span class="info">
                            <span>@{{size}}</span>
                            <input type="hidden" name="inventory_items[][size]" value="@{{size}}" />
                            <div class="dropdown-content">
                                <ul class="d-content">
                                    @{{#meta_size}}
                                    <li class="drop-list" style="padding: 5px 10px;" data-value="@{{.}}">
                                        <a class="menu"><span class="ml-1">@{{.}}</span></a>
                                    </li>
                                           @{{/meta_size}}
                                      </ul>
                                    </div>
                                </span>
                            </div>
                            <div class="quantity d-flex justify-content-between quantity-operator">
                                <span class="minus">-</span>
                                <input type="text" name="inventory_items[][quantity]" readonly value="@{{quantity}}" />
                                <span class="plus">+</span>
                            </div>
                </div>
            </div>
        </div>

    </script>

    <script id="search_item" type="text/x-handlebars-template">
        <h5>Search Results</h5>
        <div class="row">
            @{{#each inventories}}
                <div class="col-md-3" style="padding-right: 10px; padding-left: 10px;">
                    <div class="item-single-wrapper">
                        <div class="item-image" style="">
                            <img src="@{{image}}" />
                            <input type="hidden" name="meta_image" value="@{{image}}">
                        </div>
                        <div class="item-meta">
                            <h5>@{{name}}</h5>
                            <input type="hidden" name="meta_name" value="@{{name}}">
                            <input type="hidden" name="meta_id" value="@{{id}}">
                            <div class="info-wrapper d-flex flex-row justify-content-between">
                                <span class="info">
                                    <span>Material</span>
                                    <input type="hidden" name="material" value="" />
                                    <input type="hidden" name="meta_material" value="@{{material}}" />
                                    <div class="dropdown-content">
                                        <ul class="d-content">
                                            @{{#material}}
                                            <li class="drop-list" style="padding: 5px 10px;" data-value="@{{.}}">
                                                <a class="menu"><span class="ml-1">@{{.}}</span></a>
                                            </li>
                                            @{{/material}}
                                        </ul>
                                    </div>
                                </span>
                                <span class="info">
                                    <span>Size</span>
                                    <input type="hidden" name="size" value="" />
                                    <input type="hidden" name="meta_size" value="@{{size}}" />
                                    <div class="dropdown-content">
                                        <ul class="d-content">
                                            @{{#size}}
                                            <li class="drop-list" style="padding: 5px 10px;" data-value="@{{.}}">
                                                <a class="menu"><span class="ml-1">@{{.}}</span></a>
                                            </li>
                                            @{{/size}}
                                        </ul>
                                    </div>
                                </span>
                            </div>
                            <div class="quantity d-flex justify-content-between quantity-operator">
                                <span class="minus">-</span>
                                <input type="text" name="quantity" readonly value="1" />
                                <span class="plus">+</span>
                            </div>
                        </div>
                    <button class="btn btn-block add-btn add-search-item">Add to list</button>
                </div>
            </div>
            @{{/each}}
        </div>
    </script>

    <script id="search_item_custome" type="text/html">
        <h5>No Result Found. Try Adding a custom item</h5>
            <div class="col-md-5" style="padding-right: 10px; padding-left: 10px;">
                <div class="item-single-wrapper">
                    <div class="item-image" style="">
                        <input type="hidden" name="meta_image" value="https://cdn.shopify.com/s/files/1/0533/2089/files/placeholder-images-image_large.png?format=jpg&quality=90&v=1530129081">
                    </div>
                    <div class="item-meta">
                        <h5> <input type="text" class="form-control" name="meta_name" value="" placeholder="Enter Items Name"></h5>
                        <input type="hidden" name="meta_id" value="">
                        <div class="info-wrapper d-flex flex-row justify-content-between">
                            <span class="info" style="border-bottom: transparent;">
                                <span><input type="text" class="form-control" name="material" placeholder="Enter Material" value="" /></span>
                                <input type="hidden" class="form-control" name="meta_material" placeholder="Enter Material" value="" />
                            </span>
                            <span class="info" style="border-bottom: transparent;">
                                <span><input type="text" class="form-control" name="size" placeholder="Enter Size" value="" /></span>
                                <input type="hidden" class="form-control" name="meta_size" placeholder="Enter Size" value="" />
                            </span>
                        </div>
                        <div class="quantity d-flex justify-content-between quantity-operator">
                            <span class="minus">-</span>
                            <input type="text" name="quantity" readonly value="1" />
                            <span class="plus">+</span>
                        </div>
                    </div>
                <button class="btn btn-block add-btn add-search-item">Add to list</button>
            </div>
        </div>
    </script>

    <script id="search_item_custome_range" type="text/html">
            <h5>No Result Found. Try Adding Custom Item.</h5>
            <div class="col-md-5" style="padding-right: 10px; padding-left: 10px;">
                <div class="item-single-wrapper">
                    <div class="item-image" style="">
                        <input type="hidden" name="meta_image" value="https://cdn.shopify.com/s/files/1/0533/2089/files/placeholder-images-image_large.png?format=jpg&quality=90&v=1530129081">
                    </div>
                    <div class="item-meta">
                        <h5> <input type="text" class="form-control" name="meta_name" value="" placeholder="Enter Items Name"></h5>
                        <input type="hidden" name="meta_id" value="">
                        <div class="info-wrapper d-flex flex-row justify-content-between">
                            <span class="info" style="border-bottom: transparent;">
                                <span><input type="text" class="form-control" name="material" placeholder="Enter Material" value="" /></span>
                                <input type="hidden" class="form-control" name="meta_material" placeholder="Enter Material" value="" />
                            </span>
                            <span class="info" style="border-bottom: transparent;">
                                <span><input type="text" class="form-control" name="size" placeholder="Enter Size" value="" /></span>
                                <input type="hidden" class="form-control" name="meta_size" placeholder="Enter Size" value="" />
                            </span>
                        </div>
                        <div class="quantity-2" style="padding: 5px 2px">

                            <input type="text" class="custom_slider range" name="quantity" value=""
                                   data-type="double"
                                   data-min="1"
                                   data-max="500"
                                   data-from="1"
                                   data-to="500"
                                   data-grid="false"/>
                        </div>
                    </div>
                <button class="btn btn-block add-btn add-search-item">Add to list</button>
            </div>
        </div>
    </script>

    {{--Range Input--}}
    <script id="entry-templateinventory_range" type="text/x-handlebars-template">
        @{{#each inventories}}
        <div class="col-md-4 filter item-remove @{{meta.category}} @{{#replace ' ' '-'}}@{{meta.name}}-@{{material}}-@{{size}}-@{{meta.id}}@{{/replace}}" style="padding-right: 10px; padding-left: 10px;">
            <div class="item-single-wrapper">
                <span class="closer" data-parent=".item-remove"><i class="icon dripicons-cross"></i></span>
                <div class="item-image" style="">
                    <img src="@{{meta.image}}" />
                </div>
                <div class="item-meta">
                    <h5>@{{meta.name}}</h5>
                    <input type="hidden" name="inventory_items[][inventory_id]:null" value="@{{meta.id}}">
                    <input type="hidden" name="cutome_name" value="@{{meta.name}}">
                    <div class="info-wrapper d-flex flex-row justify-content-between">
                                <span class="info">
                                    <span>@{{material}}</span>
                                    <input type="hidden" name="inventory_items[][material]" value="@{{material}}" />
                                    <div class="dropdown-content">
                                      <ul class="d-content">
                                          @{{#meta.material}}
                                              <li class="drop-list" style="padding: 5px 10px;" data-value="@{{.}}">
                                                  <a class="menu"><span class="ml-1">@{{.}}</span></a>
                                              </li>
                                          @{{/meta.material}}
                                      </ul>
                                    </div>
                                </span>
                        <span class="info">
                                    <span>@{{size}}</span>
                                    <input type="hidden" name="inventory_items[][size]" value="@{{size}}" />
                                    <div class="dropdown-content">
                                      <ul class="d-content">
                                           @{{#meta.size}}
                                              <li class="drop-list" style="padding: 5px 10px;" data-value="@{{.}}">
                                                  <a class="menu"><span class="ml-1">@{{.}}</span></a>
                                              </li>
                                           @{{/meta.size}}
                                      </ul>
                                    </div>
                                </span>
                    </div>
                    <div class="quantity-2" style="padding: 5px 2px">
                        <input type="text" class="custom_slider range" name="inventory_items[][quantity]" value=""
                               data-type="double"
                               data-min="1"
                               data-max="500"
                               data-from="@{{quantity_min}}"
                               data-to="@{{quantity_max}}"
                               data-grid="false"
                        />
                    </div>
                </div>
            </div>
        </div>
        @{{/each}}
        <div class="col-md-4" data-toggle="modal" data-target="#addItemModal" style="min-height: 40vh !important;">
            <div class="item-single-wrapper add-more" style="height: 100% !important;">
                <i class="icon dripicons-plus" ></i>
            </div>
        </div>
        {{--<div class="col-md-4  mt-2 ">
            <div class=" mt-1 view-content border-add">
                <div class="">
                    <i class="icon-2 mr-1 dripicons-plus add-item-icon  " data-toggle="modal" data-target="#addItemModal"></i>
                </div>
            </div>
        </div>--}}
    </script>

    <script id="entry-templateinventory_append_range" type="text/x-handlebars-template">
        <div class="col-md-4 item-remove filter custom-item @{{meta_category}} @{{#replace ' ' '-'}}@{{meta_name}}-@{{material}}-@{{size}}-@{{meta_id}}@{{/replace}}" style="padding-right: 10px; padding-left: 10px;">
            <div class="item-single-wrapper">
                <span class="closer" data-parent=".item-remove"><i class="icon dripicons-cross"></i></span>
                <div class="item-image" style="">
                    <img src="@{{meta_image}}" />
                </div>
                <div class="item-meta">
                    <h5>@{{meta_name}}</h5>
                    <input type="hidden" name="inventory_items[][inventory_id]:null" value="@{{meta_id}}">
                    <input type="hidden" name="inventory_items[][name]" value="@{{meta_name}}">
                    <div class="info-wrapper d-flex flex-row justify-content-between">
                        <span class="info">
                            <span>@{{material}}</span>
                            <input type="hidden" name="inventory_items[][material]" value="@{{material}}" />
                            <div class="dropdown-content">
                                <ul class="d-content">
                                    @{{#meta_material}}
                                    <li class="drop-list" style="padding: 5px 10px;" data-value="@{{.}}">
                                        <a class="menu"><span class="ml-1">@{{.}}</span></a>
                                    </li>
                                    @{{/meta_material}}
                                </ul>
                            </div>
                        </span>
                        <span class="info">
                            <span>@{{size}}</span>
                            <input type="hidden" name="inventory_items[][size]" value="@{{size}}" />
                            <div class="dropdown-content">
                                <ul class="d-content">
                                    @{{#meta_size}}
                                    <li class="drop-list" style="padding: 5px 10px;" data-value="@{{.}}">
                                        <a class="menu"><span class="ml-1">@{{.}}</span></a>
                                    </li>
                                           @{{/meta_size}}
                                      </ul>
                                    </div>
                                </span>
                    </div>
                    <div class="quantity-2" style="padding: 5px 2px">
                        <input type="text" class="custom_slider range" name="inventory_items[][quantity]" value=""
                               data-type="double"
                               data-min="1"
                               data-max="500"
                               data-from="@{{quantity_min}}"
                               data-to="@{{quantity_max}}"
                               data-grid="false"
                        />
                    </div>
                </div>
            </div>
        </div>

    </script>

    <script id="search_item_range" type="text/x-handlebars-template">
        <h5>Search Results</h5>
        <div class="row">
            @{{#each inventories}}
            <div class="col-md-3" style="padding-right: 10px; padding-left: 10px;">
                <div class="item-single-wrapper">
                    <div class="item-image" style="">
                        <img src="@{{image}}" />
                        <input type="hidden" name="meta_image" value="@{{image}}">
                    </div>
                    <div class="item-meta">
                        <h5>@{{name}}</h5>
                        <input type="hidden" name="meta_name" value="@{{name}}">
                        <input type="hidden" name="meta_id" value="@{{id}}">
                        <div class="info-wrapper d-flex flex-row justify-content-between">
                                <span class="info">
                                    <span>Material</span>
                                    <input type="hidden" name="material" value="" />
                                    <input type="hidden" name="meta_material" value="@{{material}}" />
                                    <div class="dropdown-content">
                                        <ul class="d-content">
                                            @{{#material}}
                                            <li class="drop-list" style="padding: 5px 10px;" data-value="@{{.}}">
                                                <a class="menu"><span class="ml-1">@{{.}}</span></a>
                                            </li>
                                            @{{/material}}
                                        </ul>
                                    </div>
                                </span>
                            <span class="info">
                                    <span>Size</span>
                                    <input type="hidden" name="size" value="" />
                                    <input type="hidden" name="meta_size" value="@{{size}}" />
                                    <div class="dropdown-content">
                                        <ul class="d-content">
                                            @{{#size}}
                                            <li class="drop-list" style="padding: 5px 10px;" data-value="@{{.}}">
                                                <a class="menu"><span class="ml-1">@}}</span></a>
                                            </li>
                                            @{{/size}}
                                        </ul>
                                    </div>
                                </span>
                        </div>
                        <div class="quantity-2" style="padding: 5px 2px">

                            <input type="text" class="custom_slider range" name="quantity" value=""
                                   data-type="double"
                                   data-min="1"
                                   data-max="500"
                                   data-from="1"
                                   data-to="500"
                                   data-grid="false"/>
                        </div>

                    </div>
                    <button class="btn btn-block add-btn add-search-item">Add to list</button>
                </div>
            </div>
            @{{/each}}
        </div>
    </script>

    {{--Image Input--}}
    <script id="image_upload_preview" type="text/x-handlebars-template">
        <div class="col-md-2 pl-0 upload-image-container">
            <input type="hidden" id="custId" value="@{{image}}" name="meta[images][]" >
            <img src="@{{image}}" alt="uploadedImage" class="image-upload-by-customer" style="width: 100%; height: 100%;"/>
            <i class="fa fa-close fa-2x" onclick="console.log('hello'); $(this).closest('.upload-image-container').fadeOut(100).remove()"></i>
        </div>
    </script>

    <script>
        /*function previewImages() {

            var preview = document.querySelector('.upload-image-container');

            if (this.files) {
                    [].forEach.call(this.files, readAndPreview);
            }

            function readAndPreview(file) {

                // Make sure `file.name` matches our extensions criteria
                if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                    return alert(file.name + " is not an image");
                } // else...

                var reader = new FileReader();
                reader.addEventListener("load", function() {
                        var image = new Image();
                        image.height = 100;
                        image.marginleft = '10px';
                        image.paddingleft = '10px';
                        image.title = file.name;
                        image.src = this.result;
                        preview.appendChild(image);
                });

                reader.readAsDataURL(file);

            }

        }

        document.querySelector('.custom-file-input').addEventListener("change", previewImages);*/

        function updateCount(type) {
            let currentValue = Number(document.getElementById('inc ').value)
            if (type == "increment") {
                    currentValue++
            } else {
                    if (currentValue > 0) {
                        currentValue--
                    }
            }
                document.getElementById('inc ').value = currentValue
        }





    </script>
    <script>

jQuery(document).ready(function($){

$('.panel.panel-default.card-input').on('click', function(){
            console.log("test")
    $('panel.panel-default.card-input.check-blue').removeClass('check-blue');
    $(this).addClass('check-blue');
});

});


    </script>

</div>
@endsection
