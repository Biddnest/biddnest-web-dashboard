@extends('layouts.app')
@section('title') Vendor Management @endsection
@section('content')

<!-- Main Content -->
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createVendor">
    <div class="d-flex  flex-row justify-content-between p-10">
        <h3 class="heading1 ml-4 pl-2">Onboard Vendor</h3>
    </div>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left p-4 pt-0 pb-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('vendors')}}"> Vendors Management</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Onboard Vendor</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="d-flex flex-row text-left ml-120">
        <a href="{{route('vendors')}}" class="text-decoration-none">
            <h3 class="page-subhead text-left f-18" style="margin-top: 10px; !important; color: #2e0789;">
                <i class="p-1">
                    <img src="{{asset('static/images/Icon feather-chevrons-left.svg')}}" alt="" srcset="">
                </i> Back to Vendors
            </h3>
        </a>
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
                        </ul>
                    </h3>
                </div>
                <div class="tab-content" id="myTabContent">
                        <!-- form starts -->
                        <form class="form-new-order pt-4 mt-3 onboard-vendor-form input-text-blue" id="myForm">
                            <p class="img-label">Image</p>
                            <div class="upload-section p-20 pt-0">
                                <img src="{{asset('static/images/upload-image.svg')}}" alt="">
                                <div class="ml-1">
                                    <!-- <button class="btn theme-bg white-text my-0">UPLOAD IMAGE</button> -->
                                    <div class="file-upload">
                                        <button class="btn theme-bg white-text my-0">UPLOAD
                                                            IMAGE</button>
                                        <input type="file" required/>
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
                                                                class="form-control number">
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
                                            <div class="d-flex justify-content-start   margin-topneg-15 white-text">
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

                            </div>


                                <div class="d-flex  justify-content-between flex-row  p-10 py-0 "
                                                    style="border-top: 1px solid #70707040;">
                                    <div class="w-50"><a class="white-text p-10 cancel" href="#"><button
                                                                class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>
                                    </div>
                                    <div class="w-50 text-right"><a class="white-text p-10"><button
                                                                class="btn theme-bg white-text w-30">Next</button></a>
                                    </div>
                                </div>

                        </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
