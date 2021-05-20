@extends('website.layouts.frame')
@section('title') Book Move @endsection
@section('header_title')Book a Move @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="addbooking">
        <div class="container ">
            <div class="book-move-screen responsive ontop w-70 ">
                <div class="card-body ">
                    <div class="row d-flex ">
                        <div class="col-md-3 br-line view-none ">
                            <div class="row steps-form-3 ">
                                <div class="col-md-8 setup-panel-3">
                                    <div class="steps-step-1 ">
                                        <p class="step-text text-right ">Customer Details
                                            <span class="text-muted "> Personal Info</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 steps-row-3 setup-panel-3">
                                    <div class="steps-step-3 card-block ">
                                        <a href="#step-1 " type="button " class="btn steps-icon rounded-icons btn-info btn-circle-3 waves-effect ml-0 turntheme text-muted completed-step-1 " data-toggle="tooltip " data-placement="top " title="Basic Information "><i
                                                class="fa fa-user " aria-hidden="true "></i></a>
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
                                        <a href="#step-2 " type="button " class="btn steps-icon rounded-icons btn-pink btn-circle-3 waves-effect p-3 card-block completed-step-2" data-toggle="tooltip " data-placement="top " title="Basic Information "><i
                                                class="fa fa-map-marker " aria-hidden="true "></i></a>
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
                                        <a href="#step-3 " type="button " class="btn steps-icon rounded-icons btn-pink btn-circle-3 waves-effect step-todo completed-step-3" data-toggle="tooltip " data-placement="top " title="Basic Information "><i
                                                class="fa fa-list " aria-hidden="true "></i></a>
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
                                        <a href="#step-4 " type="button " class="btn steps-icon rounded-icons btn-pink btn-circle-3 waves-effect p-3 step-todo completed-step-4" data-toggle="tooltip " data-placement="top " title="Basic Information "><i
                                                class="fa fa-comments " aria-hidden="true "></i></a>
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
                                        <a href="#step-5 " type="button " class="btn steps-icon rounded-icons btn-pink btn-circle-3 waves-effect p-3 step-todo completed-step-5" data-toggle="tooltip " data-placement="top " title="Basic Information "><i
                                                class="fa fa-tag " aria-hidden="true "></i></a>
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
                                        <a href="#step-6 " type="button " class="btn steps-icon rounded-icons btn-pink btn-circle-3 waves-effect p-3 step-todo completed-step-6" data-toggle="tooltip " data-placement="top " title="Basic Information "><i
                                                class="fa fa-thumbs-up " aria-hidden="true "></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 book-move-questions-container ">
                            <form id="wizard">
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
                                                    <div class="col-sm-6 col-xs-12 ">
                                                        <div class="form-group ">
                                                            <label class="phone-num-lable ">Phone Number</label>
                                                            <span class=" ">
                                                                <input type="tel" id="phone" placeholder="9099090909" class=" form-control" name="contact_details[phone]" maxlength="10" minlength="10" required>
                                                                <span class="error-message ">Please enter valid Phone
                                                                    number</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <div class="form-group ">
                                                            <label class="full-name">Full Name</label>
                                                            <span class=" ">
                                                                <input type="text" id="fullname"
                                                                       placeholder="David Jerome" class="form-control" name="contact_details[name]" class="form-control" required>
                                                                <span class="error-message">Please enter valid
                                                                    name</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <div class="form-group ">
                                                            <label class="email-label">Email</label>
                                                            <span class=" ">
                                                                <input type="email" placeholder="abc@mail.com"
                                                                       id="email" name="contact_details[email]" id="E-mail" class="form-control" required>
                                                                <span class="error-message">Please enter valid
                                                                    Email</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 ">
                                                        <div class="d-flex flex-row small-switch ">
                                                            <h5 class="toggle-text">For Me</h5>
                                                            <label class="switch">
                                                                <input type="hidden" value="0" name="meta[self_booking]" id="slef">
                                                                <input type="checkbox" checked class="check-toggle" data-value="1" data-target=".toggle-input" name="select_letter" value="1" id="slef1" onchange="document.getElementById('slef').value = this.checked ? false : true">
                                                                <span class="slider"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 ">
                                                        <h4 class="toggle-input border-bottom mt-3 pb-3 theme-sub-text mb-view mt-20 ">
                                                            Contact Details</h4>
                                                    </div>
                                                    <div class="col-sm-6 col-xs-12 pt-2 toggle-input">
                                                        <div class="form-group">
                                                            <label class="phone-num-lable">Friend's Phone Number</label>
                                                            <span class=" ">
                                                                <input type="tel" id="phonefriend"
                                                                       placeholder="987654321"
                                                                       class=" form-control" name="friend_details[phone]">
                                                                <span class="error-message">Please enter valid Phone
                                                                    number</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 pt-2 toggle-input">
                                                        <div class="form-group ">
                                                            <label class="full-name">Full Name</label>
                                                            <span class=" ">
                                                                <input type="text" id="friendname"
                                                                       placeholder="David Jerome" class="form-control " name="friend_details[name]">
                                                                <span class="error-message ">Please enter valid name
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 pb-2 toggle-input">
                                                        <div class="form-group">
                                                            <label class="email-label">Email</label>
                                                            <span class=" ">
                                                                <input type="email" placeholder="abc@mail.com"
                                                                       id="friend-mail" class="form-control " name="friend_details[email]">
                                                                <span class="error-message ">Please enter valid
                                                                    Email</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="actionBtn actionBtn-mob-view border-top ">
                                                <a href="{{route('home')}}">
                                                    <button class="btn btn-mdb-color mt-2 btn-rounded cancelBtn float-left ml-5 ">
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
                                    <div class="col-md-12 ">
                                        <p class="text-muted ">Step 2 / 6</p>
                                        <h4 class=" border-bottom pl-0 pb-4 theme-text head-book-move ">Lets get the delivery details
                                        </h4>
                                        <div class="accordion " id="delivery-details ">
                                            <p class="address-category pl-0 ">Category</p>
                                            <div class="row my-3 address-details border-bottom d-flex justify-content-between ">
                                                @foreach($categories as $category)
                                                    <div class="col-md-4 col-sm-3 mb-4 view-content radio-inline">
                                                        <div class="card address-name card-methord02 text-center h-100 py-2 px-3 bg-turnblue cursor-pointer">
                                                            <div class="card-block ">
                                                                <img src="{{$category->image}}" alt="residential-building " class="address-icon mb-2 " style="width: 50px;"/>
                                                                <input type="radio" value="{{$category->id}}" name="service_id" class="cursor-pointer categoryweb-select" data-target=".range" required>
                                                                <p class="card-title pl-0 address-type text-white ">
                                                                {{ucwords($category->name)}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="d-flex row p-20 ">
                                                <div class="col-sm-6 ">
                                                    <div class="form-group ">
                                                        <label class="address-details-input ">From Address</label>
                                                        <<input type="text" placeholder="SVM Complex,indiranagar,Benguluru" name="source[meta][geocode]" id="source-autocomplete" class="form-control" required>
                                                        <span class="error-message ">Please enter valid</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <div class="form-group ">
                                                        <label class="address-details-input ">From Adress line 1</label>
                                                        <input type="text" placeholder="SVM Complex,indiranagar,Benguluru" name="source[meta][address_line1]"  class="form-control" required>
                                                        <input type="hidden"  name="source[lat]" id="source-lat" class="form-control" required>
                                                        <input type="hidden"  name="source[lng]" id="source-lng" class="form-control" required>
                                                        <span class="error-message ">Please enter valid</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mtop-22 mb-view ">
                                                    <div style="width: 100%; height: 280px;" class="source-map-picker"></div>
{{--                                                    <div id="mapcomponent " class="dest-map-picker " style="width: 100%; height: 155px; "></div>--}}
                                                    <!-- <div id="frommap " ></div> -->
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <div class="d-flex row justify-content-between ">
                                                        <div class="col-sm-12">
                                                            <div class="form-group ">
                                                                <label class="address-details-input ">From Adress line 2</label>
                                                                <input type="text" placeholder="SVM Complex,indiranagar,Benguluru" name="source[meta][address_line2]" id="" class="form-control" required>
                                                                <span class="error-message">Please enter valid</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 ">
                                                            <div class="form-group ">
                                                                <label class="address-details-input ">From City</label>
                                                                <input type="text" id="source-city" placeholder="Benguluru" class="form-control" name="source[meta][city]" required>
                                                                <span class="error-message ">Please enter valid</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 ">
                                                            <div class="form-group ">
                                                                <label class="address-details-input ">From State</label>
                                                                <input type="text" placeholder="Karnataka" id="source-state"  class="form-control " name="source[meta][state]" required/>
                                                                <span class="error-message ">Please enter valid</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 ">
                                                            <div class="form-group ">
                                                                <label class="address-details-input ">From Pincode</label>
                                                                <input type="text " placeholder="530000" maxlength="6" minlength="6" id="source-pin" class="form-control" name="source[meta][pincode]" required/>
                                                                <span class="error-message ">Please enter valid</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 ">
                                                        </div>
                                                        <div class="col-sm-6 ">
                                                            <div class="form-group ">
                                                                <label class="address-details-input ">From Floor</label>
                                                                <input type="number" placeholder="3rd Floor" value="0" name="source[meta][floor]" class="form-control " required>
                                                                <span class="error-message ">Please enter valid</span>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 ">
                                                            <div class="form-group ">
                                                                <label class="form-check-box " for="Lift1 ">Do you have lift</label>
                                                                <label class="switch">
                                                                    <input type="hidden" value="0" name="source[meta][lift]" id="letter">
                                                                    <input type="checkbox" name="select_letter" value="1" id="Lift1"
                                                                           onchange="document.getElementById('letter').value = this.checked ? 1 : 0">
                                                                    <span class="slider"></span>
                                                                </label>
                                                                <span class="error-message ">Please enter valid</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border-bottom pt-3 "></div>
                                            <div class="d-flex row p-20 mt-2 ">
                                                <div class="col-sm-6 ">
                                                    <div class="form-group ">
                                                        <label class="address-details-input ">To Address</label>
                                                        <input type="text" placeholder="Srm colony,Chennai" name="destination[meta][geocode]" id="dest-autocomplete" class="form-control">
                                                        <input type="hidden"  name="destination[lat]" id="dest-lat" class="form-control" required>
                                                        <input type="hidden"  name="destination[lng]" id="dest-lng" class="form-control" required>
                                                            <span class="error-message ">Please enter valid</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <div class="form-group ">
                                                        <label class="address-details-input ">To Address line 1</label>
                                                        <input type="text" placeholder="Srm colony,Chennai" name="destination[meta][address_line1]" id="" class="form-control" required>
                                                            <span class="error-message ">Please enter valid</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mtop-22 mb-view ">
{{--                                                    <div id="mapcomponent " class="source-map-picker " style="width: 100%; height: 155px; "></div>--}}
                                                    <!-- <div id="tomap " style="width: 100%; height: 155px; "></div> -->
                                                    <div style="width: 100%; height: 280px;" class="dest-map-picker"></div>
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <div class="d-flex row justify-content-between ">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label>From Adress line 2</label>
                                                                <input type="text" name="destination[meta][address_line2]" placeholder="SVM Complex,indiranagar,Benguluru" id="" class="form-control" required>
                                                                <span class="error-message">Please enter valid</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 ">
                                                            <div class="form-group ">
                                                                <label class="address-details-input ">To City</label>
                                                                <input type="text" placeholder="Chennai" id="dest-city"  name="destination[meta][city]" class="form-control" required>
                                                                <span class="error-message ">Please enter valid</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 ">
                                                            <div class="form-group ">
                                                                <label class="address-details-input ">To State</label>
                                                                <input type="text" placeholder="Chennai" id="dest-state"  name="destination[meta][state]" class="form-control" required>
                                                                <span class="error-message ">Please enter valid</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 ">
                                                            <div class="form-group ">
                                                                <label class="address-details-input ">To Pincode</label>
                                                                <input type="text" placeholder="530001" name="destination[meta][pincode]"  id="dest-pin" class="form-control" required>
                                                                <span class="error-message ">Please enter valid</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 ">
                                                        </div>
                                                        <div class="col-sm-6 ">
                                                            <div class="form-group ">
                                                                <label class="address-details-input ">To Floor </label>
                                                                <input type="number" placeholder="1st floor" value="0" name="destination[meta][floor]" id="" class="form-control" required>
                                                                <span class="error-message ">Please enter valid</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 ">
                                                            <div class="form-group ">
                                                                <label class="form-check-box " for="Lift1 ">Do you have lift</label>
                                                                <label class="switch">
                                                                    <input type="hidden" value="0" name="destination[meta][lift]" id="letter2">
                                                                    <input type="checkbox" name="select_letter" value="1" id="Lift2"
                                                                           onchange="document.getElementById('letter2').value = this.checked ? 1 : 0">
                                                                    <span class="slider"></span>
                                                                </label>
                                                                <span class="error-message ">Please enter valid</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border-bottom pt-3 "></div>
                                            <div class="d-flex row p-20 pt-2 ">
                                                <div class="col-sm-6 ">
                                                    <div class="form-group ">
                                                        <label class="start-date ">Start date</label>
                                                        <div id="my-modal ">
                                                            <input type="text" id="dateselect date" class="dateselect form-control br-5 " placeholder="15 Jan" name="movement_dates" required/>
                                                            <span class="error-message ">please enter valid  date</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 ">
                                                    <div class="form-group ">
                                                        <label class="te ">Interested in shared services?</label>
                                                        <div>
                                                            <label class="switch">
                                                                <input type="hidden" value="0" name="source[meta][shared_service]" id="m_type">
                                                                <input type="checkbox" name="select_letter" value="1" id="movemnt"
                                                                       onchange="document.getElementById('m_type').value = this.checked ? true : false">
                                                                <span class="slider"></span>
                                                            </label>
                                                        </div>
                                                        <span class="error-message ">Please enter valid</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" actionBtn actionBtn-view border-top ">
                                            <a href="{{route('home')}}">
                                                <button class="btn btn-mdb-color mt-2 btn-rounded cancelBtn float-left ml-4 ">
                                                    Cancel
                                                </button>
                                            </a>
                                            <button type="button" class="btn btn-mdb-color mt-2 btn-rounded nextBtn-3 float-right mr-4 next2" id="next2">
                                                Next
                                            </button>
                                            <button class="btn btn-mdb-color mt-2 btn-rounded cancelBtn float-right mr-3 ">Back
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Third Step -->

                                <div class="setup-content-3 step-3" id="step-3" style="display: none;">
                                    <div class="col-md-12 ">
                                        <p class="text-muted ">Step 3/ 6</p>
                                        <h4 class=" border-bottom pl-0 pb-4 theme-text head-book-move ">Lets get your requirements</h4>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <select name="meta[subcategory]" class="form-control subservices">
                                        </select>
                                        <div class="col-md-2 view-content ">
                                            <div class="room-req-count mb-1 text-center h-100 px-3 disabled ">
                                                <div class="card-block ">
                                                    <h3><i class="fa fa-home fa-2x "></i></h3>
                                                    <p class="card-title room-type pl-0 l-cap cursor-pointer ">1 bhk</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="filter" class="bg-light">
                                        <ul class="nav nav-tabs " id="myTab " role="tablist ">
                                            <li class="nav-item ">
                                                <a class="nav-link active p-15 " id="live-tab " data-toggle="tab " href="#live " role="tab " aria-controls="home " aria-selected="true ">All</a>
                                            </li>
                                            <li class="nav-item ">
                                                <a class="nav-link p-15 " id="past-tab " data-toggle="tab " href="#past " role="tab " aria-controls="profile " aria-selected="false ">Furniture</a>
                                            </li>
                                            <li class="nav-item ">
                                                <a class="nav-link p-15 " id="past-tab " data-toggle="tab " href="#past " role="tab " aria-controls="profile " aria-selected="false ">Electronics</a>
                                            </li>
                                            <li class="nav-item ">
                                                <a class="nav-link p-15 " id="past-tab " data-toggle="tab " href="#past " role="tab " aria-controls="profile " aria-selected="false ">Electrical</a>
                                            </li>
                                            <li class="nav-item ">
                                                <a class="nav-link p-15 " id="past-tab " data-toggle="tab " href="#past " role="tab " aria-controls="profile " aria-selected="false ">Appliances</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="row mb-4 mt-3">
                                        <div class="col-md-4 view-content ">
                                            <div class="card required-item ">
                                                <div class="container-image-item ">
                                                    <img class="card-img-top " src="{{asset('static/website/images/images/1.png')}}" alt="image " style="width:100% ">
                                                </div>
                                                <div class="close-item ">
                                                    <i class="icon-2 dripicons-cross "></i>
                                                </div>
                                                <div class="card-body requirements-field ">
                                                    <p class="card-title required-item-name mb-0 ">Bed</p>
                                                    <div class="row ">
                                                        <div class="col-md-6 requirements d-flex ">
                                                            <p class="card-text required-item-qty pr-1 br-r ">Wood
                                                            </p>
                                                            <p class="card-text required-item-qty pl-1 ">Small</p>
                                                        </div>
                                                        <div class="col-md-6 requirements ">
                                                            <div class="input-group ">
                                                                <span class="input-group-btn ">
                                                                    <button onClick="updateCount( 'dicrement'); " class="btn btn-default btn-number input-number " data-type="minus " data-field="quant[1] ">
                                                                        <span class="minus-icon "><i class="fa fa-minus "></i></span>
                                                                    </button>
                                                                </span>
                                                                <input type="text " id="inc " class="form-control input-number " value="1 " min="1 " max="10 ">
                                                                <span class="input-group-btn ">
                                                                    <button onClick="updateCount( 'increment'); " class="btn btn-default btn-number input-number " data-type="plus " data-field="quant[1] ">
                                                                        <span class="plus-icon "><i class="fa fa-plus "></i></span>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 view-content ">
                                            <div class="card required-item ml-10 ">
                                                <div class="container-image-item ">
                                                    <img class="card-img-top " src="{{asset('static/website/images/images/1.png')}}" alt="image " style="width:100% ">
                                                </div>
                                                <div class="close-item ">
                                                    <i class="icon-2 dripicons-cross "></i>
                                                </div>
                                                <div class="card-body requirements-field ">
                                                    <p class="card-title required-item-name mb-0 ">Bed</p>
                                                    <div class="row ">
                                                        <div class="col-md-6 requirements d-flex ">
                                                            <p class="card-text required-item-qty pr-1 br-r ">Wood</p>
                                                            <p class="card-text required-item-qty pl-1 ">Small</p>
                                                        </div>
                                                        <div class="col-md-6 requirements ">
                                                            <div class="input-group ">
                                                                <span class="input-group-btn ">
                                                                    <button onclick="buttonClickminus(); " class="btn btn-default btn-number input-number " data-type="minus " data-field="quant[1] ">
                                                                        <span class="minus-icon "><i class="fa fa-minus "></i></span>
                                                                    </button>
                                                                </span>
                                                                <input type="text " id="inc " class="form-control input-number " value="1 " min="1 " max="10 ">
                                                                <span class="input-group-btn ">
                                                                    <button onClick="updateCount( 'dicrement'); " class="btn btn-default btn-number input-number " data-type="plus " data-field="quant[1] ">
                                                                        <span class="plus-icon "><i class="fa fa-plus "></i></span>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 view-content ">
                                            <div class="card required-item ">
                                                <div class="container-image-item ">
                                                    <img class="card-img-top " src="{{asset('static/website/images/images/1.png')}}" alt="image " style="width:100% ">
                                                </div>
                                                <div class="close-item ">
                                                    <i class="icon-2 dripicons-cross "></i>
                                                </div>
                                                <div class="card-body requirements-field ">
                                                    <p class="card-title required-item-name mb-0 ">Bed</p>
                                                    <div class="row ">
                                                        <div class="col-md-6 requirements d-flex ">
                                                            <p class="card-text required-item-qty pr-1 br-r ">Wood</p>
                                                            <p class="card-text required-item-qty pl-1 ">Small</p>
                                                        </div>
                                                        <div class="col-md-6 requirements ">
                                                            <div class="input-group ">
                                                                <span class="input-group-btn ">
                                                                    <button onclick="buttonClickminus(); "  class="btn btn-default btn-number input-number " data-type="minus " data-field="quant[1] ">
                                                                        <span class="minus-icon "><i class="fa fa-minus "></i></span>
                                                                    </button>
                                                                </span>
                                                                <input type="text " id="inc " class="form-control input-number " value="1 " min="1 " max="10 ">
                                                                <span class="input-group-btn ">
                                                                    <button onclick="buttonClick(); " class="btn btn-default btn-number input-number " data-type="plus " data-field="quant[1] ">
                                                                        <span class="plus-icon "><i class="fa fa-plus "></i></span>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mt-4 mt-20 view-content ">
                                            <div class="card required-item ml-10 ">
                                                <div class="container-image-item ">
                                                    <img class="card-img-top " src="{{asset('static/website/images/images/1.png')}}" alt="image " style="width:100% ">
                                                </div>
                                                <div class="close-item ">
                                                    <i class="icon-2 dripicons-cross "></i>
                                                </div>
                                                <div class="card-body requirements-field ">
                                                    <p class="card-title required-item-name mb-0 ">Bed</p>
                                                    <div class="row ">
                                                        <div class="col-md-6 requirements d-flex ">
                                                            <p class="card-text required-item-qty pr-1 br-r ">Wood</p>
                                                            <p class="card-text required-item-qty pl-1 ">Small</p>
                                                        </div>
                                                        <div class="col-md-6 requirements ">
                                                            <div class="input-group ">
                                                                <span class="input-group-btn ">
                                                                    <button onclick="buttonClickminus(); " class="btn btn-default btn-number input-number " data-type="minus " data-field="quant[1] ">
                                                                        <span class="minus-icon "><i class="fa fa-minus "></i></span>
                                                                    </button>
                                                                </span>
                                                                <input type="text " id="inc " class="form-control input-number " value="1 " min="1 " max="10 ">
                                                                <span class="input-group-btn ">
                                                                    <button onclick="buttonClick(); " class="btn btn-default btn-number input-number " data-type="plus " data-field="quant[1] ">
                                                                        <span class="plus-icon "><i class="fa fa-plus "></i></span>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-4 mt-20 view-content ">
                                            <div class="card required-item ">
                                                <div class="container-image-item ">
                                                    <img class="card-img-top " src="{{asset('static/website/images/images/1.png')}}" alt="image " style="width:100% ">
                                                </div>
                                                <div class="close-item ">
                                                    <i class="icon-2 dripicons-cross "></i>
                                                </div>
                                                <div class="card-body requirements-field ">
                                                    <p class="card-title required-item-name mb-0 ">Bed</p>
                                                    <div class="row ">
                                                        <div class="col-md-6 requirements d-flex ">
                                                            <p class="card-text required-item-qty pr-1 br-r ">Wood</p>
                                                            <p class="card-text required-item-qty pl-1 ">Small</p>
                                                        </div>
                                                        <div class="col-md-6 requirements ">
                                                            <div class="input-group ">
                                                                <span class="input-group-btn ">
                                                                    <button onclick="buttonClickminus(); " class="btn btn-default btn-number input-number " data-type="minus " data-field="quant[1] ">
                                                                        <span class="minus-icon "><i class="fa fa-minus "></i></span>
                                                                    </button>
                                                                </span>
                                                                <input type="text " id="inc " class="form-control input-number " value="1 " min="1 " max="10 ">
                                                                <span class="input-group-btn ">
                                                                    <button onclick="buttonClick(); " class="btn btn-default btn-number input-number " data-type="plus " data-field="quant[1] ">
                                                                        <span class="plus-icon "><i class="fa fa-plus "></i></span>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-4 mt-20 view-content ">
                                            <div>
                                                <i class="icon-2 mr-1 dripicons-plus add-item-icon " data-toggle="modal" data-target="#addItemModal"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" actionBtn actionBtn-view border-top ">
                                        <a href="{{route('home')}}">
                                            <button type="button" class="btn btn-mdb-color mt-2 btn-rounded cancelBtn float-left ml-2 ">
                                                Cancel
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-mdb-color mt-2 btn-rounded nextBtn-3 float-right next3" id="next3">
                                            Next
                                        </button>
                                        <button class="btn btn-mdb-color mt-2 btn-rounded cancelBtn float-right mr-3 ">Back
                                        </button>
                                    </div>
                                    <!--Add Item Modal-->
                                    <div class="modal-container ">
                                        <!-- The Modal -->
                                        <div class="modal" id="addItemModal">
                                            <div class="modal-dialog addItemModal ">
                                                <div class="modal-content ">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header border-bottom ">
                                                        <h4 class="modal-title add-item-title theme-text ">Add Item</h4>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="modal-body add-item-body ">
                                                        <form class="requirements-modal ">
                                                            <div class="input-group mt-3 mb-3 search-bar-with-category ">
                                                                <input type="search " class="form-control " placeholder="Search for item.. ">
                                                                <div class="input-group-append ">
                                                                    <select class="select-item-choice select-category-btn ">
                                                                        <option value=" " disabled selected>-Select
                                                                            Category-
                                                                        </option>
                                                                        <option value="1 ">Option 1</option>
                                                                        <option value="2 ">Option 2</option>
                                                                        <option value="3 ">Option 3</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <div class="row modal-item-container pb-4 pt-4 ">
                                                            <div class="col-md-4 ">
                                                                <div class="row modal-item-inner-container ">
                                                                    <div class="col-md-6 modal-first-inner-column ">
                                                                        <img src="{{asset('static/website/images/images/1.png')}}" class="req-search-image " alt="ModalImage ">
                                                                    </div>
                                                                    <div class="col-md-6 modal-second-inner-column ">
                                                                        <p class="spec-name pl-0 pt-2 ">Bed</p>
                                                                        <div class="choose-your-material ">
                                                                            <select class="select-material ">
                                                                                <option value=" " disabled selected>
                                                                                    Steel
                                                                                </option>
                                                                                <option value="1 ">Option 1</option>
                                                                                <option value="2 ">Option 2</option>
                                                                                <option value="3 ">Option 3</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="choose-your-material ">
                                                                            <select class="select-material ">
                                                                                <option value=" " disabled selected>
                                                                                    Small
                                                                                </option>
                                                                                <option value="1 ">Option 1</option>
                                                                                <option value="2 ">Option 2</option>
                                                                                <option value="3 ">Option 3</option>
                                                                            </select>
                                                                        </div>
                                                                        <p class="spec-name p-0 mb-0 ">Quantity</p>
                                                                        <div class="input-group justify-content-around ">
                                                                            <span class="input-group-btn ">
                                                                                <button
                                                                                    class="btn btn-default btn-number input-number "
                                                                                    data-type="minus "
                                                                                    data-field="quant[1] ">
                                                                                    <span class="minus-icon "><i
                                                                                            class="fa fa-minus "></i></span>
                                                                            </button>
                                                                            </span>
                                                                            <input type="text " class="form-control input-number " value="1 " min="1 " max="10 ">
                                                                            <span class="input-group-btn ">
                                                                                <button
                                                                                    class="btn btn-default btn-number input-number "
                                                                                    data-type="plus "
                                                                                    data-field="quant[1] ">
                                                                                    <span class="plus-icon "><i
                                                                                            class="fa fa-plus "></i></span>
                                                                            </button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 ">
                                                                <div class="row modal-item-inner-container ">
                                                                    <div class="col-md-6 modal-first-inner-column ">
                                                                        <img src="{{asset('static/website/images/images/1.png')}}" class="req-search-image " alt="ModalImage ">
                                                                    </div>
                                                                    <div class="col-md-6 modal-second-inner-column ">
                                                                        <p class="spec-name pl-0 pt-2 ">Bed</p>
                                                                        <div class="choose-your-material ">
                                                                            <select class="select-material ">
                                                                                <option value=" " disabled selected>
                                                                                    Steel
                                                                                </option>
                                                                                <option value="1 ">Option 1</option>
                                                                                <option value="2 ">Option 2</option>
                                                                                <option value="3 ">Option 3</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="choose-your-material ">
                                                                            <select class="select-material ">
                                                                                <option value=" " disabled selected>
                                                                                    Small
                                                                                </option>
                                                                                <option value="1 ">Option 1</option>
                                                                                <option value="2 ">Option 2</option>
                                                                                <option value="3 ">Option 3</option>
                                                                            </select>
                                                                        </div>
                                                                        <p class="spec-name p-0 mb-0 ">Quantity</p>
                                                                        <div class="input-group justify-content-around ">
                                                                            <span class="input-group-btn ">
                                                                                <button
                                                                                    class="btn btn-default btn-number input-number "
                                                                                    data-type="minus "
                                                                                    data-field="quant[1] ">
                                                                                    <span class="minus-icon "><i class="fa fa-minus "></i></span>
                                                                                </button>
                                                                            </span>
                                                                            <input type="text " class="form-control input-number " value="1 " min="1 " max="10 ">
                                                                            <span class="input-group-btn ">
                                                                                <button
                                                                                    class="btn btn-default btn-number input-number "
                                                                                    data-type="plus "
                                                                                    data-field="quant[1] ">
                                                                                    <span class="plus-icon "><i class="fa fa-plus "></i></span>
                                                                                </button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 ">
                                                                <div class="row modal-item-inner-container ">
                                                                    <div class="col-md-6 modal-first-inner-column ">
                                                                        <img src="{{asset('static/website/images/images/1.png')}}" class="req-search-image " alt="ModalImage ">
                                                                    </div>
                                                                    <div class="col-md-6 modal-second-inner-column ">
                                                                        <p class="spec-name pl-0 pt-2 ">Bed</p>
                                                                        <div class="choose-your-material ">
                                                                            <select class="select-material ">
                                                                                <option value=" " disabled selected>
                                                                                    Steel
                                                                                </option>
                                                                                <option value="1 ">Option 1</option>
                                                                                <option value="2 ">Option 2</option>
                                                                                <option value="3 ">Option 3</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="choose-your-material ">
                                                                            <select class="select-material ">
                                                                                <option value=" " disabled selected>
                                                                                    Small
                                                                                </option>
                                                                                <option value="1 ">Option 1</option>
                                                                                <option value="2 ">Option 2</option>
                                                                                <option value="3 ">Option 3</option>
                                                                            </select>
                                                                        </div>
                                                                        <p class="spec-name p-0 mb-0 ">Quantity</p>
                                                                        <div class="input-group justify-content-around ">
                                                                            <span class="input-group-btn ">
                                                                                <button
                                                                                    class="btn btn-default btn-number input-number "
                                                                                    data-type="minus "
                                                                                    data-field="quant[1] ">
                                                                                    <span class="minus-icon "><i class="fa fa-minus "></i></span>
                                                                            </button>
                                                                            </span>
                                                                            <input type="text " class="form-control input-number " value="1 " min="1 " max="10 ">
                                                                            <span class="input-group-btn ">
                                                                                <button
                                                                                    class="btn btn-default btn-number input-number "
                                                                                    data-type="plus "
                                                                                    data-field="quant[1] ">
                                                                                    <span class="plus-icon "><i class="fa fa-plus "></i></span>
                                                                            </button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row modal-item-container pb-5 pt-4 ">
                                                            <div class="col-md-4 ">
                                                                <div class="row modal-item-inner-container ">
                                                                    <div class="col-md-6 modal-first-inner-column ">
                                                                        <img src="{{asset('static/website/images/images/1.png')}}" class="req-search-image " alt="ModalImage ">
                                                                    </div>
                                                                    <div class="col-md-6 modal-second-inner-column ">
                                                                        <p class="spec-name pl-0 pt-2 ">Bed</p>
                                                                        <div class="choose-your-material ">
                                                                            <select class="select-material ">
                                                                                <option value=" " disabled selected>
                                                                                    Steel
                                                                                </option>
                                                                                <option value="1 ">Option 1</option>
                                                                                <option value="2 ">Option 2</option>
                                                                                <option value="3 ">Option 3</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="choose-your-material ">
                                                                            <select class="select-material ">
                                                                                <option value=" " disabled selected>
                                                                                    Small
                                                                                </option>
                                                                                <option value="1 ">Option 1</option>
                                                                                <option value="2 ">Option 2</option>
                                                                                <option value="3 ">Option 3</option>
                                                                            </select>
                                                                        </div>
                                                                        <p class="spec-name p-0 mb-0 ">Quantity</p>
                                                                        <div class="input-group justify-content-around ">
                                                                            <span class="input-group-btn ">
                                                                                <button
                                                                                    class="btn btn-default btn-number input-number "
                                                                                    data-type="minus "
                                                                                    data-field="quant[1] ">
                                                                                    <span class="minus-icon "><i class="fa fa-minus "></i></span>
                                                                                </button>
                                                                            </span>
                                                                            <input type="text " class="form-control input-number " value="1 " min="1 " max="10 ">
                                                                            <span class="input-group-btn ">
                                                                                <button
                                                                                    class="btn btn-default btn-number input-number "
                                                                                    data-type="plus "
                                                                                    data-field="quant[1] ">
                                                                                    <span class="plus-icon "><i class="fa fa-plus "></i></span>
                                                                                </button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 ">
                                                                <div class="row modal-item-inner-container ">
                                                                    <div class="col-md-6 modal-first-inner-column ">
                                                                        <img src="{{asset('static/website/images/images/1.png')}}" class="req-search-image " alt="ModalImage ">
                                                                    </div>
                                                                    <div class="col-md-6 modal-second-inner-column ">
                                                                        <p class="spec-name pl-0 pt-2 ">Bed</p>
                                                                        <div class="choose-your-material ">
                                                                            <select class="select-material ">
                                                                                <option value=" " disabled selected>
                                                                                    Steel
                                                                                </option>
                                                                                <option value="1 ">Option 1</option>
                                                                                <option value="2 ">Option 2</option>
                                                                                <option value="3 ">Option 3</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="choose-your-material ">
                                                                            <select class="select-material ">
                                                                                <option value=" " disabled selected>
                                                                                    Small
                                                                                </option>
                                                                                <option value="1 ">Option 1</option>
                                                                                <option value="2 ">Option 2</option>
                                                                                <option value="3 ">Option 3</option>
                                                                            </select>
                                                                        </div>
                                                                        <p class="spec-name p-0 mb-0 ">Quantity</p>
                                                                        <div class="input-group justify-content-around ">
                                                                            <span class="input-group-btn ">
                                                                                <button type="button "
                                                                                        class="btn btn-default btn-number input-number "
                                                                                        data-type="minus "
                                                                                        data-field="quant[1] ">
                                                                                    <span class="minus-icon "><i
                                                                                            class="fa fa-minus "></i></span>
                                                                            </button>
                                                                            </span>
                                                                            <input type="text " class="form-control input-number " value="1 " min="1 " max="10 ">
                                                                            <span class="input-group-btn ">
                                                                                <button type="button "
                                                                                        class="btn btn-default btn-number input-number "
                                                                                        data-type="plus "
                                                                                        data-field="quant[1] ">
                                                                                    <span class="plus-icon "><i
                                                                                            class="fa fa-plus "></i></span>
                                                                            </button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div class="modal-footer d-flex justify-content-between ">
                                                        <a href="{{route('home')}}" ><button class="btn cancelBtn " type="button " data-dismiss="modal ">
                                                            Cancel
                                                            </button></a>
                                                        <button class="btn nextBtn-3" type="button ">
                                                            Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Fourth Step -->
                                <div class=" setup-content-3 step-4" id="step-4" style="display: none;">
                                    <div class="col-md-12 ">
                                        <p class="text-muted ">Step 4 / 6</p>
                                        <h4 class=" border-bottom pl-0 pb-4 theme-text ">Add Comments and Upload Photos
                                        </h4>
                                        <div class="form-group ">
                                            <label for="comments-area " class="comments ">Comments from Customer</label>
                                            <textarea class="form-control " id="comments-area " rows="4 " placeholder="Need to include movers for customer 's bike too"></textarea>
                                        </div>
                                        <h4 class="pl-0 pb-4 pt-3 comments">Upload Photos</h4>
                                    </div>
                                    <div class="row d-flex justify-content-around uploaded-image mb-5 ml-0 mr-0">
                                        <div class="col-md-2 pl-0 view-content upload-image-container">
                                            <img src="{{asset('static/website/images/images/1.png')}}" alt="uploadedImage" class="image-upload-by-customer" />
                                            <i class="fa fa-close fa-2x"></i>
                                        </div>
                                        <div class="col-md-2 pl-0 view-content upload-image-container">
                                            <img src="{{asset('static/website/images/images/1.png')}}" alt="uploadedImage" class="image-upload-by-customer" />
                                            <i class="fa fa-close fa-2x"></i>
                                        </div>
                                        <div class="col-md-2 pl-0 view-content upload-image-container">
                                            <img src="{{asset('static/website/images/images/1.png')}}" alt="uploadedImage" class="image-upload-by-customer" />
                                            <i class="fa fa-close fa-2x"></i>
                                        </div>
                                        <div class="col-md-2 pl-0 view-content upload-image-container">
                                            <img src="{{asset('static/website/images/images/1.png')}}" alt="uploadedImage" class="image-upload-by-customer" />
                                            <i class="fa fa-close fa-2x"></i>
                                        </div>
                                        <div class="col-md-2 pl-0  add-photos">
                                            <div class="custom-file" id="customFile">
                                                <input type="file" class="custom-file-input" id="exampleInputFile" aria-describedby="fileHelp">

                                                <label class="custom-file-label" for="exampleInputFile">

                                                </label>
                                                <i class="fa fa-plus fa-2x cursor-pointer"></i>

                                            </div>
                                        </div>
                                    </div>
                                    <div class=" actionBtn actionBtn-view border-top ">
                                        <a href="{{route('home')}}">
                                            <button class="btn btn-mdb-color mt-2 btn-rounded cancelBtn float-left ml-2 " type="button ">
                                                Cancel
                                            </button>
                                        </a>
                                        <button  class="btn btn-mdb-color mt-2 btn-rounded nextBtn-3 float-right next4" id="next4" type="button">
                                            Next
                                        </button>
                                        <button class="btn btn-mdb-color mt-2 btn-rounded cancelBtn float-right mr-3" type="button">Back
                                        </button>
                                    </div>
                                </div>
                                <!-- Fifth Step -->
                                <div class="row setup-content-3 step-5" id="step-5" style="display: none;">
                                    <div class="col-md-12">
                                        <div>
                                            <p class="text-muted">Step 5 / 6</p>
                                            <h5 class="border-bottom theme-text pb-4 text-view-center">Get The Estimated Cost </h5>
                                        </div>
                                        <form class="quation-form">
                                            <div class="p-0  border-top-2 order-cards">
                                                <div class="d-flex justify-content-center f-14  text-center  mt-2 mb-1">
                                                    Please note that this is the baseline price, you will be receiving the <br>Vendor bid list with the final quotations
                                                </div>
                                                <div class="d-flex flex-row flex-view-col justify-content-around f-14 theme-text text-center  quotation mb-3">
                                                    <div class="flex-column justify-content-center test">
                                                        <div class="card m-20  card-price eco cursor-pointer">
                                                            <div class="p-60 f-32 border-cicle eco-card">
                                                                <div>
                                                                    <div class="f-30">₹ 2,300</div>
                                                                    <div class="f-16 ">Base price</div>
                                                                </div>
                                                            </div>
                                                            <div class="p-eco f-18"> Economy
                                                                <p class="italic f-12 ">Economy Service include moving only
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="radio-group">
                                                            <div class="form-input radio-item ">
                                                                <input type="radio" id="economy" name="economy-premium" class="radio-button__input cursor-pointer economy">
                                                                <label class="" for="economy"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="felx-column">
                                                        <div class="card m-20 card-price pre  cursor-pointer ">
                                                            <div class="p-60 f-32  border-cicle pre-card  ">
                                                                <div class="f-30">₹ 3,300</div>
                                                                <div class="f-16 p-1">Base price</div>
                                                            </div>
                                                            <div class=" f-18"> Premium
                                                                <p class="italic f-12 ">Premium Service include Packing
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="radio-group">
                                                            <div class="form-input radio-item ">
                                                                <input type="radio" id="premium" name="economy-premium" class="radio-button__input premium">
                                                                <label class="" for="premium"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class=" actionBtn actionBtn-view border-top ">
                                            <a href="{{route('home')}}">
                                                <button class="btn btn-mdb-color mt-2 btn-rounded cancelBtn float-left ml-2 " type="button ">
                                                    Cancel
                                                </button>
                                            </a>
                                            <button class="btn btn-mdb-color mt-2 btn-rounded nextBtn-3 float-right next5" id="next5" type="button">
                                                Next
                                            </button>
                                            <button class="btn btn-mdb-color mt-2 btn-rounded cancelBtn float-right mr-3" type="button">Back
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Sixth Step -->
                                <div class="row setup-content-3 step-6" id="step-6" style="display: none;">
                                    <div class="col-md-12">
                                        <div>
                                            <p class="text-muted">Step 6 / 6</p>
                                            <h5 class="border-bottom theme-text pb-4 text-view-center">Place Your Request!
                                            </h5>
                                        </div>
                                        <div class="border-bottom">
                                            <i class="fa fa-thumbs-up center successful-icon mt-2 view-block text-view-center"></i>
                                            <p class="text-muted f-16 center italic order-status-message text-view-center">
                                                Your Order has been submitted</p>
                                            <p class=" f-16 para-head center order-num text-view-center">ORDER ID
                                                <span>: #323223</span>
                                            </p>
                                        </div>
                                        <div>
                                            <div class="text-center ">
                                                <p class="text-muted f-14 pt-4 italic notification-message"> You will get the estimated price once the time is up</p>
                                                <h3 class="f-18 pb-4 theme-text bold ">Time Left</h3>
                                                <div id="app"></div>
                                            </div>
                                        </div>
                                        <div class="button-bottom d-flex justify-content-center pt-4">
                                            <div class="">
                                                <a class="white-text " href="{{route('home')}}">
                                                    <button type="submit" class="btn btn-theme-bg padding-btn-res white-bg">View my
                                                        bookings
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>

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

    </div>
@endsection
