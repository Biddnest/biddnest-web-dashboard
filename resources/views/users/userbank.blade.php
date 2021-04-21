@extends('layouts.app')
@section('title') Users And Roles @endsection
@section('content')

    <!-- Main Content -->
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="createusersandroles">
        <div class="d-flex  flex-row justify-content-between">
            <h3 class="page-head text-left p-4 theme-text">Add New User</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left p-2 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="users-roles.html"> Users & Roles</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add New User</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-sm-10">
                <div class="card  h-auto p-0 pt-10 ">
                    <div class="card-head right text-left  p-8 pt-10 pb-0">
                        <h3 class="f-18">
                            <ul class="nav nav-tabs pt-10 p-0" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link p-15" href="#" >Add New User</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active p-15" id="quotation" data-toggle="tab"
                                       href="#past" role="tab" aria-controls="profile"
                                       aria-selected="false">Banking Details</a>
                                </li>
                            </ul>
                        </h3>
                    </div>
                    <div class="tab-content margin-topneg-7 border-top" id="myTabContent">

                        <div class="tab-pane fade " id="past" role="tabpanel" aria-labelledby="past-tab">
                            <form class="form-new-order onboard-vendor-form input-text-blue">
                                <div class="row p-20">
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Account Number </label>
                                            <input type="text" id="fullname"
                                                   placeholder="" value="6231248590"
                                                   class="form-control">
                                            <span class="error-message">Please enter valid
                                                Account Number</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Bank Name </label>
                                            <input type="text" id="fullname"
                                                   placeholder="" value="ICICI Bank"
                                                   class="form-control">
                                            <span class="error-message">Please enter valid
                                                Bank Name</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Account Holder Name </label>
                                            <input type="text" id="fullname"
                                                   placeholder="" value="David Jerome"
                                                   class="form-control">
                                            <span class="error-message">Please enter valid
                                                Account Holder Name</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">IFSC Code </label>
                                            <input type="text" id="fullname"
                                                   placeholder="" value="ICI0012145"
                                                   class="form-control">
                                            <span class="error-message">Please enter valid
                                                IFSC Code</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Branch Name </label>
                                            <input type="text" id="fullname"
                                                   placeholder="" value="Indiranagar"
                                                   class="form-control">
                                            <span class="error-message">Please enter valid
                                                Branch Name</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="img-label">Aadhaar Card</p>
                                        <div class="upload-section p-20 pt-0">
                                            <img src="{{asset('static/images/upload-ing.svg')}}" alt="">
                                            <div class="ml-1">
                                                <div class="file-upload">
                                                    <input type="file">
                                                    <button class="btn theme-bg white-text my-0">UPLOAD FILE</button>
                                                </div>
                                                <p>Max File size: 2MB</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <p class="img-label">PAN Card</p>
                                        <div class="upload-section p-20 pt-0">
                                            <img src="{{asset('static/images/upload-ing.svg')}}" alt="">
                                            <div class="ml-1">
                                                <div class="file-upload">
                                                    <input type="file">
                                                    <button class="btn theme-bg white-text my-0">UPLOAD FILE</button>
                                                </div>
                                                <p>Max File size: 2MB</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex  justify-content-between flex-row ml-20 p-10 py-0" style="border-top: 1px solid #70707040;">
                                    <div class="w-50">
                                        <a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>
                                    </div>
                                    <div class="w-50 text-right">
                                        <a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Back</button></a>
                                        <a class="white-text p-10"><button class="btn theme-bg white-text w-30">Next</button></a>
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
