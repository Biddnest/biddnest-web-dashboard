@extends('layouts.app')
@section('title') Vendor Management @endsection
@section('content')

 <!-- Main Content -->
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="create-vendor">
                    <div class="d-flex  flex-row justify-content-between p-10">
                        <h3 class="heading1 ml-4 pl-2">Onboard Vendor</h3>

                    </div>
                    <div class="d-flex  flex-row justify-content-between">
                        <div class="page-head text-left p-4 pt-0 pb-0">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="vendor-management.html"> Vendors Management</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Onboard Vendor</li>
                                </ol>
                            </nav>


                        </div>

                    </div>
                    <div class="d-flex  flex-row text-left ml-120">
                        <!-- <a href="vendor-management.html" class="text-decoration-none">
                                    <h3 class="page-subhead text-left p-4 f-20 theme-text">
                                        <i class="p-1"> <img src="assets/images/Icon feather-chevrons-left.svg" alt=""
                                                srcset=""></i>Back to Vendors
                                    </h3>
                                </a> -->

                    </div>
                    <!-- Dashboard cards -->


                    <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
                        <div class="col-lg-10">
                            <div class="card  h-auto p-0 pt-10 ">

                                <div class="card-head right text-left border-bottom-2 p-10 pt-10 pb-0">
                                    <h3 class="f-18 mb-0">
                                        <ul class="nav nav-tabs  p-0" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active p-15" id="new-order-tab" data-toggle="tab"
                                                    href="#order" role="tab" aria-controls="home"
                                                    aria-selected="true">Onboard Vendor</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link p-15" id="quotation" data-toggle="tab" href="#past"
                                                    role="tab" aria-controls="profile" aria-selected="false">Vendor
                                                    Banking Details</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link p-15" id="quotation" data-toggle="tab"
                                                    href="#vendor-role" role="tab" aria-controls="profile"
                                                    aria-selected="false">Vendor Roles</a>
                                            </li>
                                        </ul>

                                    </h3>





                                </div>
                                <div class="tab-content" id="myTabContent">

                                    <div class="tab-pane fade show active margin-topneg-15" id="order" role="tabpanel"
                                        aria-labelledby="new-order-tab">
                                        <!-- form starts -->
                                        <form class="form-new-order pt-4 mt-3 onboard-vendor-form input-text-blue">

                                            <p class="img-label">Image</p>
                                            <div class="upload-section p-20 pt-0">
                                                <img src="{{asset('static/images/upload-image.svg')}}" alt="">
                                                <div class="ml-1">
                                                    <!-- <button class="btn theme-bg white-text my-0">UPLOAD IMAGE</button> -->

                                                    <div class="file-upload">
                                                        <input type="file">
                                                        <button class="btn theme-bg white-text my-0">UPLOAD
                                                            IMAGE</button>
                                                    </div>


                                                    <p>Max File size: 1MB</p>
                                                </div>
                                            </div>


                                            <div class="d-flex row p-20">
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Authorizer First Name</label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="David"
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                First Name</span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Authorizer Last Name</label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="Jerome"
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                First Name</span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Vendor Role</label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="Vendor role"
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Vendor Role</span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Email ID</label>
                                                        <span class="">
                                                            <input type="email" id="fullname" placeholder="abc@email.com"
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Email ID</span>
                                                        </span>
                                                    </div>
                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="phone-num-lable">Primary Contact Number</label>
                                                        <span class="">
                                                            <input type="tel" id="phone" placeholder="9876543210"
                                                                class=" form-control form-control-tel">
                                                            <span class="error-message">Please enter valid
                                                                Phone number</span>
                                                        </span>
                                                    </div>
                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="phone-num-lable">Secondary Contact Number</label>
                                                        <span class="">
                                                            <input type="tel" id="phone-pop-up" placeholder="9876543210"
                                                                class=" form-control form-control-tel">
                                                            <span class="error-message">Please enter valid
                                                                Phone number</span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="phone-num-lable">Gender</label>
                                                        <span class="">
                                                            <select id="" class="form-control">
                                                                <option>Female</option>
                                                                <option>Male</option>
                                                                <option>Other</option>
                                                            </select>
                                                            <span class="error-message">Please enter valid
                                                                Phone number</span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Organization Name</label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="Wayne Pvt Ltd"
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Organization Name</span>
                                                        </span>
                                                    </div>
                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="phone-num-lable">Organisation Type</label>
                                                        <span class="">
                                                            <select id="" class="form-control">
                                                                <option>type 1</option>
                                                                <option>type 2</option>
                                                                <option>type 3</option>
                                                            </select>
                                                            <span class="error-message">Please enter valid
                                                                Phone number</span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">GSTIN Number of Organisation</label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="GST12355464"
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Organization Name</span>
                                                        </span>
                                                    </div>
                                                </div>


                                                <div class="col-lg-12">
                                                    <div class="form-input">
                                                        <label class="full-name">Organization Description</label>
                                                        <span class="">
                                                            <textarea placeholder="Need to Include bike"
                                                                style="resize: none;" id="" class="form-control "
                                                                rows="4" cols="50" spellcheck="false">
                                                                          </textarea>
                                                            <span class="error-message">Please enter valid
                                                                Description</span>
                                                        </span>
                                                    </div>
                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Address Line 1</label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="Enter address here"
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Address Line</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Address Line 2</label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="Enter Address here"
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Address Line</span>
                                                        </span>
                                                    </div>
                                                </div>



                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Lattitude</label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="Lattitude"
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Lattitude</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Longitude</label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="Longitude"
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Longitude</span>
                                                        </span>
                                                    </div>
                                                </div>



                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Landmark</label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="Enter Landmark here"
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Landmark</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Zone</label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="Bengaluru Urban"
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Zone</span>
                                                        </span>
                                                    </div>
                                                </div>


                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">State</label>
                                                        <span class="">
                                                            <select id="" class="form-control">
                                                                <option>State 1</option>
                                                                <option>State 2</option>
                                                                <option>State 3</option>
                                                            </select>
                                                            <span class="error-message">Please enter valid
                                                                Landmark</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">City</label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="Bengaluru"
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Zone</span>
                                                        </span>
                                                    </div>
                                                </div>



                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Pincode</label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="530000"
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Pincode</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Service</label>
                                                        <span class="">
                                                            <select id="" class="form-control">
                                                                <option>Service 1</option>
                                                                <option>Service 2</option>
                                                                <option>Service 3</option>
                                                            </select>
                                                            <span class="error-message">Please enter valid
                                                                Service</span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Service Type</label>
                                                        <span class="">
                                                            <select id="" class="form-control">
                                                                <option>Service 1</option>
                                                                <option>Service 2</option>
                                                                <option>Service 3</option>
                                                            </select>
                                                            <span class="error-message">Please enter valid
                                                                Service</span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Do you have a subsidiary
                                                            branch?</label>
                                                        <span class="">

                                                        
                                                            <div
                                                                class="d-flex justify-content-start   margin-topneg-15 white-text">
                                                                <input type="checkbox" checked data-toggle="toggle"
                                                                    data-size="xs" data-width="100" data-height="30"
                                                                    data-onstyle="outline-primary"
                                                                    data-offstyle="outline-secondary" data-on="YES"
                                                                    data-off="NO" id="">
                                                            </div>


                                                            <span class="error-message">Please enter valid
                                                                Service</span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <span class="">
                                                            <a class="white-text" data-toggle="modal"
                                                                data-target="#for-friend"><button
                                                                    class="btn theme-bg white-text  my-0">Add
                                                                    Branch</button></a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion" id="comments">
                                                <div class="d-flex  justify-content-between flex-row  p-10 py-0 "
                                                    style="border-top: 1px solid #70707040;">
                                                    <div class="w-50"><a class="white-text p-10" href="#"><button
                                                                class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>
                                                    </div>
                                                    <div class="w-50 text-right"><a class="white-text p-10"><button
                                                                class="btn theme-bg white-text w-30">Next</button></a>
                                                    </div>
                                                </div>
                                            </div>


                                        </form>

                                        <!-- Tab-1 form -->
                                    </div>
                                    <div class="tab-pane fade " id="past" role="tabpanel" aria-labelledby="past-tab">
                                        <form class="form-new-order onboard-vendor-form input-text-blue">
                                            <div class="row p-20">
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Account Number </label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="BANK123456"
                                                                value="6231248590" class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Account Number</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Bank Name </label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="ICICI Bank"
                                                                value="ICICI Bank" class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Bank Name</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Account Holder Name </label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="David Jerome"
                                                                value="" class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Account Holder Name</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">IFSC Code </label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="ICI0012145"
                                                                value="" class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                IFSC Code</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Branch Name </label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="Indiranagar"
                                                                value="" class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Branch Name</span>
                                                        </span>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <p class="img-label">Aadhaar Card</p>
                                                    <div class="upload-section p-20 pt-0">
                                                        <img  src="{{asset('static/images/upload-ing.svg')}}" alt="">
                                                        <div class="ml-1">
                                                            <div class="file-upload cursor-pointer">
                                                                <input id="aadhar-upload" type="file" class="cursor-pointer" >
                                                                <!-- <img id="aadhar-preview" class="uploaded-img-preview" src="#" /> -->
                                                                <button id="upload-btn"
                                                                    class="btn theme-bg white-text my-0 cursor-pointer">UPLOAD
                                                                    FILE</button>
                                                            </div>


                                                            <p id="file-aadhar">Max File size: 2MB</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <p class="img-label">GST Certificate</p>
                                                    <div class="upload-section p-20 pt-0">
                                                        <img src="{{asset('static/images/upload-ing.svg')}}" alt="">
                                                        <div class="ml-1">
                                                            <div class="file-upload">
                                                                <input type="file">
                                                                <button class="btn theme-bg white-text my-0">UPLOAD
                                                                    FILE</button>
                                                            </div>


                                                            <p>Max File size: 2MB</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <p class="img-label">Agreement with Biddnest</p>
                                                    <div class="upload-section p-20 pt-0">
                                                        <img src="{{asset('static/images/upload-ing.svg')}}" alt="">
                                                        <div class="ml-1">
                                                            <div class="file-upload">
                                                                <input type="file">
                                                                <button class="btn theme-bg white-text my-0">UPLOAD
                                                                    FILE</button>
                                                            </div>


                                                            <p>Max File size: 2MB</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <p class="img-label">PAN Card</p>
                                                    <div class="upload-section p-20 pt-0">
                                                        <img src="{{asset('static/images/upload-ing.svg')}}" alt="">
                                                        <div class="ml-1">
                                                            <div class="file-upload">
                                                                <input type="file">
                                                                <button class="btn theme-bg white-text my-0">UPLOAD
                                                                    FILE</button>
                                                            </div>


                                                            <p>Max File size: 2MB</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <p class="img-label">Company Registration Certificate</p>
                                                    <div class="upload-section p-20 pt-0">
                                                        <img src="{{asset('static/images/upload-ing.svg')}}" alt="">
                                                        <div class="ml-1">
                                                            <div class="file-upload">
                                                                <input type="file">
                                                                <button class="btn theme-bg white-text my-0">UPLOAD
                                                                    FILE</button>
                                                            </div>


                                                            <p>Max File size: 2MB</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex  justify-content-between flex-row  p-10 py-0"
                                                style="border-top: 1px solid #70707040;">
                                                <div class="w-50"><a class="white-text p-10" href="#"><button
                                                            class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>
                                                </div>
                                                <div class="w-50 text-right">
                                                    <a class="white-text p-10" href="#"><button
                                                            class="btn theme-br theme-text w-30 white-bg">Back</button></a>
                                                    <a class="white-text p-10"><button
                                                            class="btn theme-bg white-text w-30">Next</button></a>
                                                </div>
                                            </div>
                                        </form>

                                    </div>

                                    <!--  -->
                                    <div class="tab-pane fade" id="vendor-role" role="tabpanel"
                                        aria-labelledby="past-tab">
                                        <form class="form-new-order onboard-vendor-form input-text-blue">
                                            <div class="row p-20 pb-0">
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Employee First Name</label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="David"
                                                                value="" class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Employee First Name</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Employee Last Name </label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="Jerome"
                                                                value="" class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Employee Last Name</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Role Type</label>
                                                        <span class="">
                                                            <select id="" class="form-control">
                                                                <option>Manager</option>
                                                                <option>Manager 2</option>
                                                                <option>Manager 3</option>
                                                            </select>
                                                            <span class="error-message">Please enter valid
                                                                Role Type</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Modules under this role </label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="Enter Modules here" value=""
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Modules under this role</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="phone-num-lable">Primary Contact Number</label>
                                                        <span class="">
                                                            <input type="tel" id="phone1" placeholder="9876543210"
                                                                class=" form-control form-control-tel">
                                                            <span class="error-message">Please enter valid
                                                                Contact number</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Branch</label>
                                                        <span class="">
                                                            <select id="" class="form-control">
                                                                <option>Delhi</option>
                                                                <option>Mumbai</option>
                                                                <option>Pune</option>
                                                            </select>
                                                            <span class="error-message">Please enter valid
                                                                Role Type</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Vendor ID </label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="V123456" value=""
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Vendor ID</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Email ID </label>
                                                        <span class="">
                                                            <input type="email" id="fullname" placeholder="abc@email.com" value=""
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Email ID</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Organization ID </label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="O1234456" value=""
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Organization ID</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Password</label>
                                                        <span class="">
                                                            <input type="password" id="fullname" placeholder="Password" value=""
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Organization ID</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name ">Status</label>
                                                   <div class="">
                     <div class="d-flex justify-content-start   margin-topneg-20 white-text vendor-switch2">
                                                        <input type="checkbox" checked data-toggle="toggle"
                                                        data-size="xs" data-width="100" data-height="30" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-on="Active" data-off="Inactive" id="">
                                                                                                           </div>
                                                   </div>
                                                            
                                     

                                                          
                                                      



                                                    </div>
                                                   
                                                </div>
                                                <div class="col-sm-6 mtop-20">
                                                    <a class="white-text p-10" data-toggle="modal"
                                                        data-target="#add-new-role">
                <button class="btn theme-bg white-text float-right">Add New Role</button></a>
                                                </div>
                                            </div>
                                            <div class="d-flex  justify-content-between flex-row  p-10 py-0"
                                                style="border-top: 1px solid #70707040;">
                                                <div class="w-50"><a class="white-text p-10" href="#"><button
                                                            class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>
                                                </div>
                                                <div class="w-50 text-right">
                                                    <a class="white-text p-10" href="#"><button
                                                            class="btn theme-br theme-text w-30 white-bg">Back</button></a>
                                                    <a class="white-text p-10"><button
                                                            class="btn theme-bg white-text w-30">Save</button></a>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>




</div>

@endsection