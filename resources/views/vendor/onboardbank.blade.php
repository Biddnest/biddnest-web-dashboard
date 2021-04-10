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
                    <li class="breadcrumb-item"><a href="vendor-management.html"> Vendors Management</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Onboard Vendor</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="d-flex  flex-row text-left ml-120">
    </div>
    <!-- Dashboard cards -->

    <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
        <div class="col-lg-10">
            <div class="card  h-auto p-0 pt-10 ">
                <div class="card-head right text-left border-bottom-2 p-10 pt-10 pb-0">
                    <h3 class="f-18 mb-0">
                        <ul class="nav nav-tabs  p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link p-15" href="{{route("onboard-edit-vendors",["id"=> $id ?? "0"])}}">Edite Onboard Vendor</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" href="{{route("onboard-branch-vendors",["id"=> $id ?? "0"])}}">Add Branch</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active p-15" id="quotation" href="#"
                                >Vendor Banking Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" href="{{route("onboard-userrole-vendors",["id"=> $id ?? "0"])}}">Vendor Roles</a>
                            </li>
                        </ul>
                    </h3>
                </div>

                <div class="tab-content" id="myTabContent">
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
                                                        <img  src="assets/images/upload-ing.svg" alt="">
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
                                                        <img src="assets/images/upload-ing.svg" alt="">
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
                                                        <img src="assets/images/upload-ing.svg" alt="">
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
                                                        <img src="assets/images/upload-ing.svg" alt="">
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
                                                        <img src="assets/images/upload-ing.svg" alt="">
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
            </div>

        </div>
    </div>
</div>

@endsection
