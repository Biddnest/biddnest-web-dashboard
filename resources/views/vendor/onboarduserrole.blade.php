@extends('layouts.app')
@section('title') Vendor Management @endsection
@section('content')

<!-- Main Content -->
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createuserRole">
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
                                <a class="nav-link p-15" href="{{route("onboard-edit-vendors",["id"=>$id ?? ""])}}">Edit Onboard Vendor</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" href="{{route("onboard-branch-vendors",["id"=>$id ?? ""])}}">Add Branch</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" href="{{route("onboard-bank-vendors",["id"=>$id ?? ""])}}"
                                >Vendor Banking Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active p-15" id="quotation" href="#">Vendor Roles</a>
                            </li>
                        </ul>
                    </h3>
                </div>
                <div class="tab-content" id="myTabContent">
                    <!-- form starts -->
                    <div class="tab-pane show">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="user-profile-snip">

                                    <img src="{{asset('static/images/upload-image.svg')}}" class="profile-img" />
                                    <div class="profile-meta">
                                        <h5>David Malan</h5>
                                        <span>Admin</span>
                                        <span>amith@gmail.com</span>
                                        <span>+91 9843326118</span>
                                    </div>
                                    <div class="action">
                                        <a class="modal-toggle inline-icon-button" data-target="#user_"><i class="icon dripicons-pencil"></i></a>
                                        <a href="#" class="inline-icon-button"><i class="icon dripicons-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="user-profile-snip">

                                    <img src="{{asset('static/images/upload-image.svg')}}" class="profile-img" />
                                    <div class="profile-meta">
                                        <h5>David Malan</h5>
                                        <span>Admin</span>
                                        <span>amith@gmail.com</span>
                                        <span>+91 9843326118</span>
                                    </div>
                                    <div class="action">
                                        <a class="modal-toggle inline-icon-button" data-target="#user_"><i class="icon dripicons-pencil"></i></a>
                                        <a href="#" class="inline-icon-button"><i class="icon dripicons-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="user-profile-snip">

                                    <img src="{{asset('static/images/upload-image.svg')}}" class="profile-img" />
                                    <div class="profile-meta">
                                        <h5>David Malan</h5>
                                        <span>Admin</span>
                                        <span>amith@gmail.com</span>
                                        <span>+91 9843326118</span>
                                    </div>
                                    <div class="action">
                                        <a class="modal-toggle inline-icon-button" data-target="#user_"><i class="icon dripicons-pencil"></i></a>
                                        <a href="#" class="inline-icon-button"><i class="icon dripicons-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex  justify-content-between flex-row  p-10 py-0"
                         style="border-top: 1px solid #70707040;">
                        <div class="w-50"> </div>
                        <div class="w-50 text-right">
                            <a class="white-text p-10 modal-toggle" data-target="#add-role">
                                <button class="btn theme-bg white-text w-30">Add Branch</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')

<div class="fullscreen-modal" id="add-role">
    <div class="fullscreen-modal-body" role="document">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="#" method="POST">
            <div class="modal-body" style="padding: 10px 9px;">

                <div class="d-flex row p-20 pt-0 pb-0">
                    <div class="col-lg-6">
                        <div class="form-input">
                            <label class="full-name">Employee First Name</label>
                            <span class="">
                                        <input type="text" id="fullname" placeholder="First Name" value=""
                                               class="form-control">
                                        <span class="error-message">Please enter valid
                                            First Name</span>
                                    </span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-input">
                            <label class="full-name">Employee Last Name</label>
                            <span class="">
                                        <input type="text" id="fullname" placeholder="Last Name" value=""
                                               class="form-control">
                                        <span class="error-message">Please enter valid
                                            Last Name</span>
                                    </span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-input">
                            <label class="phone-num-lable">Employee Contact Number</label>
                            <span class="">
                                        <input type="tel" id="Employee" placeholder="9876543210" value=""
                                               class=" form-control form-control-tel">
                                        <span class="error-message">Please enter valid
                                            Phone number</span>
                                    </span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-input">
                            <label class="full-name">Role Type</label>
                            <select id="role" name="role" class="form-control">
                                <option value="">--Select--</option>
                                @foreach(\App\Enums\VendorEnums::$ROLES as $key=>$type)
                                    <option value="{{$type}}">{{$key}}</option>
                                @endforeach
                            </select>
                            <span class="error-message">Please enter valid Service</span>
                        </div>
                    </div>

{{--                    <div class="col-lg-6">--}}
{{--                        <div class="form-input">--}}
{{--                            <label class="full-name">Vendor ID</label>--}}
{{--                            <input type="text" id="fullname" placeholder="V1234567" value=""--}}
{{--                                               class="form-control">--}}
{{--                            <span class="error-message">Please enter valid Vendor ID</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-lg-6">
                        <div class="form-input">
                            <label class="full-name">Branch</label>
                            <span class="">
                                        <select id="" class="form-control">
                                            <option>Delhi</option>
                                            <option>Mumbai</option>
                                        </select>
                                        <span class="error-message">Please enter valid
                                            Branch</span>
                                    </span>
                        </div>
                    </div>
{{--                    <div class="col-lg-6">--}}
{{--                        <div class="form-input">--}}
{{--                            <label class="full-name">Organization ID</label>--}}
{{--                            <span class="">--}}
{{--                                        <input type="text" id="fullname" placeholder="O123456" value="ORG123456"--}}
{{--                                               class="form-control">--}}
{{--                                        <span class="error-message">Please enter valid--}}
{{--                                            Organization ID</span>--}}
{{--                                    </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-lg-6">
                        <div class="form-input">
                            <label class="full-name">Email ID</label>
                            <span class="">
                                        <input type="email" id="fullname" placeholder="role@email.com" value=""
                                               class="form-control">
                                        <span class="error-message">Please enter valid
                                            Email</span>
                                    </span>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-input">
                            <label class="full-name">Password</label>
                            <span class="">
                                        <input type="password" id="fullname" placeholder="Enter Password" value=""
                                               class="form-control">
                                        <span class="error-message">Please enter valid
                                            Password</span>
                                    </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-15 " style="padding: 0px 5px;">
                <div class="w-50" style="text-align: left !important;"><a class="white-text p-10" href="#" data-dismiss="modal"
                                                                          aria-label="Close"><button
                            class="btn theme-br theme-text w-30 white-bg">Cancel</button></a></div>
                <div class="w-50 text-right"><a class="white-text p-10" href="#" data-dismiss="modal"
                                                aria-label="Close"><button class="btn theme-bg white-text w-30">Save</button></a></div>
            </div>
        </form>
    </div>
</div>
@endsection
