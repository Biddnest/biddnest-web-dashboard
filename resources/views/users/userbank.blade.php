@extends('layouts.app')
@section('title') Users And Roles @endsection
@section('content')

    <!-- Main Content -->
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="createusersandroles">
        <div class="d-flex  flex-row justify-content-between">
            <h3 class="page-head text-left p-4 theme-text">User Bank Detailes</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left p-2 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('users')}}"> Users & Roles</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User Bank Detailes</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="d-flex flex-row text-left ml-120">
            <a href="{{route('users')}}" class="text-decoration-none">
                <h3 class="page-subhead text-left f-18" style="margin-top: 10px; !important; color: #2e0789;">
                    <i class="p-1">
                        <img src="{{asset('static/images/Icon feather-chevrons-left.svg')}}" alt="" srcset="">
                    </i> Back to User Role
                </h3>
            </a>
        </div>

        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-sm-10">
                <div class="card  h-auto p-0 pt-10 ">
                    <div class="card-head right text-left  p-8 pt-10 pb-0">
                        <h3 class="f-18">
                            <ul class="nav nav-tabs pt-10 p-0" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link p-15" href="{{route('edit-users', ['id'=>$users->id])}}" >Edit User</a>
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

                        <div class="tab-pane fade show active " id="past" role="tabpanel" aria-labelledby="past-tab">
                            <form action="{{route('bank_edit')}}" method="PUT" data-next="redirect" data-redirect-type="hard" data-url="{{route('users')}}" data-alert="tiny" class="form-new-order pt-4 mt-3 input-text-blue" data-parsley-validate >
                                <input type="hidden" name="id" value="@if($users){{$users->id}}@endif">
                                <div class="row p-20">
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Account Number </label>
                                            <input type="text" id="fullname" placeholder="6231248590"  name="acc_no" value="@if($users){{json_decode($users->bank_meta, true)['acc_no'] ?? ''}}@endif" class="form-control" required>
                                            <span class="error-message">Please enter valid Account Number</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Bank Name </label>
                                            <input type="text" id="fullname" placeholder="ICICI Bank"  name="bank_name" value="@if($users){{json_decode($users->bank_meta, true)['bank_name'] ?? ''}}@endif" class="form-control" required>
                                            <span class="error-message">Please enter valid
                                                Bank Name</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Account Holder Name </label>
                                            <input type="text" id="fullname" placeholder="David Jerome"  name="holder_name" required value="@if($users){{json_decode($users->bank_meta, true)['holder_name'] ?? ''}}@endif" class="form-control">
                                            <span class="error-message">Please enter valid
                                                Account Holder Name</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">IFSC Code </label>
                                            <input type="text" id="fullname" placeholder="ICI0012145"  name="ifsc" required value="@if($users){{json_decode($users->bank_meta, true)['ifsc'] ?? ''}}@endif" class="form-control">
                                            <span class="error-message">Please enter valid
                                                IFSC Code</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Branch Name </label>
                                            <input type="text" id="fullname" placeholder="Indiranagar" name="branch_name" value="@if($users){{json_decode($users->bank_meta, true)['branch_name'] ?? ''}}@endif" class="form-control">
                                            <span class="error-message">Please enter valid
                                                Branch Name</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="img-label">Aadhaar Card</p>
                                        <div class="upload-section p-20 pt-0">
                                            <img class="upload-preview" src="@if(!$users->aadhar_img){{asset('static/images/upload-image.svg')}}@else{{$users->aadhar_img}}@endif" alt=""/>
                                            <div class="ml-1">
                                                <div class="file-upload">
                                                    <input type="hidden" class="base-holder" name="aadhar_image" value="@if($users){{$users->aadhar_img}}@endif" required />
                                                    <button type="button" class="btn theme-bg white-text my-0" data-action="upload">
                                                        UPLOAD IMAGE
                                                    </button>
                                                    <input type="file" accept=".png,.jpg,.jpeg" @if(!$users) required @endif/>
                                                </div>
                                                <p class="text-black">Max File size: 1MB</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <p class="img-label">PAN Card</p>
                                        <div class="upload-section p-20 pt-0">
                                            <img class="upload-preview" src="@if(!$users->pan_img){{asset('static/images/upload-image.svg')}}@else{{$users->pan_img}}@endif" alt=""/>
                                            <div class="ml-1">
                                                <div class="file-upload">
                                                    <input type="file" />
                                                    <input type="hidden" class="base-holder" name="pan_image" value="@if($users){{$users->pan_img}}@endif" required />
                                                    <button type="button" class="btn theme-bg white-text my-0" data-action="upload">
                                                        UPLOAD IMAGE
                                                    </button>
                                                </div>
                                                <p class="text-black">Max File size: 1MB</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex  justify-content-between flex-row ml-20 p-10 py-0" style="border-top: 1px solid #70707040;">
                                    <div class="w-50">
                                        <a class="white-text p-10" href="{{route('users')}}"><button type="button" class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>
                                    </div>
                                    <div class="w-50 text-right">
                                        <a class="white-text p-10"><button class="btn theme-bg white-text w-30">Save</button></a>
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
