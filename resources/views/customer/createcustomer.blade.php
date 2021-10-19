@extends('layouts.app')
@section('title') Customer Management @endsection
@section('content')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="createcustomer">
        <div class="d-flex  flex-row justify-content-between ">
            <h3 class="page-head text-left p-4 f-20">Create Customer</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left    pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('customers')}}">Customer Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@if(!$users) Create @else Edit @endif Customer</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-lg-10">
                <div class="card  h-auto p-0 pt-10 ">
                    <div class="create-customer">
                        <header>
                            <h3 class="f-18 mt-0 mb-0">
                                @if(!$users) Create @else Edit @endif Customer
                            </h3>
                        </header>
                        <div class="form-wrapper">
                            <form action="@if(!$users){{route('customer_add')}}@else{{route('customer_edit')}}@endif" method="@if(isset($users)){{"PUT"}}@else{{"POST"}}@endif" data-next="refresh" data-redirect-type="hard" data-url="{{route('customers')}}" data-alert="mega" class="form-new-order mt-3 input-text-blue" id="myForm" data-parsley-validate >
                                <div class="row pr-3 pl-3">
                                    <div class="col-lg-6">
                                        <p class="img-label" style="padding-left: 0px;">Image</p>
                                        <div class="upload-section p-20 pt-0" style="padding-left: 0px;">
                                            <img class="upload-preview" src="@if(!$users){{asset('static/images/upload-image.svg')}}@else{{$users->avatar}}@endif" alt=""/>
                                            <div class="ml-1">
                                                <div class="file-upload">
                                                    <input type="hidden" class="base-holder" name="image" value="@if($users){{$users->avatar}}@endif" required />
                                                    <button type="button" class="btn theme-bg white-text my-0" data-action="upload">
                                                        UPLOAD IMAGE
                                                    </button>
                                                    <input type="file" accept=".png,.jpg,.jpeg" @if(!$users) required @endif/>

                                                </div>
                                                <p>Max File size: 1MB</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        @if($users)
                                            <input type="hidden" value="{{$users->id}}" name="id">
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Customer First Name</label>
                                            <input type="text" id="fullname" placeholder="David" class="form-control alphabet" value="@if($users){{$users->fname}}@endif" name="fname" pattern="[a-zA-Z]+" required>
                                            <span class="error-message">Please enter valid Customer First Name</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Customer Last Name</label>
                                            <input type="text" id="fullname" placeholder="Luis" class="form-control alphabet" value="@if($users){{$users->lname}}@endif" name="lname" pattern="[a-zA-Z]+" required>
                                            <span class="error-message">Please enter valid Customer Last Name</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="phone-num-lable">Phone Number</label>
                                            <input type="tel" id="phone" placeholder="987654321" class="form-control phone" name="phone" value="@if($users){{$users->phone}}@endif" autocomplete="off" placeholder="9990009990" maxlength="10" minlength="10" required>
                                            <span class="error-message">Please enter valid Phone number</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Email ID</label>
                                            <input type="email" id="fullname" placeholder="David" class="form-control" value="@if($users){{$users->email}}@endif" autocomplete="off" name="email" required>
                                            <span class="error-message">Please enter valid Email ID</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="phone-num-lable">Gender</label>
                                            <select class="form-control" name="gender" required>
                                                <option>--Select--</option>
                                                <option value="female" @if($users && ($users->gender == "female")) Selected @endif>Female</option>
                                                <option value="male" @if($users && ($users->gender == "male")) Selected @endif>Male</option>
                                                <option value="3rd gender" @if($users && ($users->gender == "3rd gender")) Selected @endif>3rd Gender</option>
                                            </select>
                                            <span class="error-message">Please enter valid Phone number</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Date of Birth</label>
                                            <input type="text" id="fullname" name="dob" value="@if($users){{$users->dob}}@endif" autocomplete="off" placeholder="dd/mm/yyyy" class="form-control dateselect birthdate date" required>
                                            <span class="error-message">Please enter valid Date of Birth</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex  justify-content-between flex-row  " style="border-top: 1px solid #70707040;margin-top: 70px;">
                                    <div class="w-50">
                                        <a class="white-text p-10 cancel" href="{{route('customers')}}">
                                            <button type="button" class="btn theme-br theme-text w-30 white-bg">Cancel</button>
                                        </a>
                                    </div>
                                    <div class="w-50 text-right">
                                        <a class="white-text p-10">
                                            <button class="btn theme-bg white-text w-30">@if(!$users) Save @else Update @endif</button>
                                        </a>
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
