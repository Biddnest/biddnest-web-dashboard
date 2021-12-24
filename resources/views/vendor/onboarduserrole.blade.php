@extends('layouts.app')
@section('title') Vendor Management @endsection
@section('content')

<!-- Main Content -->
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createuserRole">
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left p-4 pt-0 pb-0">
            <h3 class="page-head text-left p-4 f-20 theme-text">Onboard Vendor</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('vendors')}}"> Vendors Management</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Onboard Vendor</li>
                </ol>
            </nav>
        </div>
        <div class="mr-20">
            <a class="modal-toggle" data-target="#add-role">
                <button class="btn theme-bg white-text w-10">Add Role</button>
            </a>
        </div>
    </div>
    <!-- Dashboard cards -->

    <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
        <div class="col-lg-10">
            <div class="card  h-auto p-0 pt-10 ">
                <div class="card-head right text-left border-bottom-2 p-10 pt-10 pb-0">
                    <h3 class="f-18 mb-0">
                        <ul class="nav nav-tabs  p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link p-15" href="{{route("onboard-edit-vendors",["id"=>$id])}}">Edit Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" href="{{route("onboard-base-price", ['id'=>$id])}}"
                                >Pricing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" href="{{route("onboard-branch-vendors",["id"=>$id])}}">Branch</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" href="{{route("onboard-bank-vendors",["id"=>$id])}}"
                                >Banking Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" href="{{route("onboard-action", ['id'=>$id])}}"
                                >Actions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active p-15" id="quotation" href="#">Roles</a>
                            </li>
                        </ul>
                    </h3>
                </div>
                <div class="tab-content" id="myTabContent">
                    <!-- form starts -->
                    <div class="tab-pane show">
                        <div class="row" style="padding: 20px 25px;">
                            @if(count($roles) == 0)
                                <div class="row hide-on-data">
                                    <div class="col-md-12 text-center p-20">
                                        <p class="font14"><i>. You dont have any User roles here. <br />Add a Users to get started.</i></p>
                                    </div></div>
                            @endif
                            @foreach($roles as $role)
                                    <div class="col-md-4 p-0 m-0 role_{{$role->id}}">
                                    <div class="user-profile-snip">
                                        <img src="{{$role->image}}" class="profile-img" />
                                        <div class="profile-meta">
                                            <h5>{{ucfirst(trans($role->fname))}} {{ucfirst(trans($role->lname))}}</h5>
                                            <span>
                                                @foreach(\App\Enums\VendorEnums::$ROLES as $key=>$value)
                                                    @if($value == $role->user_role)
                                                        {{ucfirst(trans($key))}}
                                                    @endif
                                                @endforeach
                                            </span>
                                            <span>
                                                @foreach($branches as $branch)
                                                    @if($role->organization_id == $branch->id)
                                                        {{ucfirst(trans($branch->city))}}
                                                    @endif
                                                @endforeach
                                            </span>
                                            <span>{{$role->email}}</span>
                                            <span>+91 {{$role->phone}}</span>
                                            <div class="action">
                                                <a class="modal-toggle inline-icon-button" data-target="#role_{{$role->id}}"><i class="icon dripicons-pencil"></i></a>
                                                <a href="#" class="delete inline-icon-button" data-parent="role_{{$role->id}}" data-confirm="Are you sure, you want delete this User Role permenently? You won't be able to undo this." data-url="{{route('delete-role', ["organization_id"=>$id, "vendor_id"=>$role->id])}}"><i class="icon dripicons-trash"></i></a>
                                                <a href="#" class="impersonate inline-icon-button" data-parent="role_{{$role->id}}" data-confirm="You are about to login into vendor panel as this user?" data-url="{{route('impersonate.vendor')."?org=".$role->id}}"><i class="icon dripicons-enter"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="d-flex  justify-content-between flex-row  p-10 py-0" style="border-top: 1px solid #70707040;">
                        <div class="w-50">
                        </div>
                        <div class="w-50 text-right">
                            <a class="white-text p-10" href="{{route("onboard-bank-vendors",["id"=>$id])}}">
                                <button class="btn theme-br theme-text w-30 white-bg">Back</button></a></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fullscreen-modal" id="add-role">
        <div class="fullscreen-modal-body" role="document">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-new-order pt-4 mt-3 onboard-vendor-branch input-text-blue" action="{{route('role_add')}}" data-next="redirect" data-redirect-type="hard" data-url="{{route('onboard-userrole-vendors', ['id'=>$id])}}" data-alert="mega" method="POST" data-parsley-validate>
                <div class="modal-body" style="padding: 10px 9px;">
                    <div class="d-flex row p-20 pt-0 pb-0">
                        <div class="col-lg-6">
                            <p class="img-label">Image</p>
                            <div class="upload-section p-20 pt-0">
                                <img class="upload-preview"
                                     src="{{asset('static/images/upload-image.svg')}}"
                                     alt=""/>
                                <div class="ml-1">
                                    <div class="file-upload">
                                        <input type="hidden" class="base-holder" name="image" value="" required />
                                        <button type="button" class="btn theme-bg white-text my-0" data-action="upload">
                                            UPLOAD IMAGE
                                        </button>
                                        <input type="file" required/>
                                    </div>
                                    <p class="text-black">Max File size: 1MB</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <input type="hidden" name="id" value="{{$id}}">
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Employee First Name</label>
                                <input type="text" id="fullname" placeholder="First Name" name="fname" class="form-control alphabet" required>
                                <span class="error-message">Please enter valid First Name</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Employee Last Name</label>
                                <input type="text" id="fullname" placeholder="Last Name" name="lname" class="form-control alphabet" required>
                                <span class="error-message">Please enter valid Last Name</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="phone-num-lable">Gender</label>
                                <select class="form-control" name="gender" required>
                                    <option>--Select--</option>
                                    <option value="female">Female</option>
                                    <option value="male">Male</option>
                                    <option value="3rd gender">3rd Gender</option>
                                </select>
                                <span class="error-message">Please enter valid Phone number</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="phone-num-lable">Employee Contact Number</label>
                                <input type="tel" id="Employee" placeholder="9876543210" name="phone" class=" form-control phone" maxlength="10" minlength="10" required>
                                <span class="error-message">Please enter valid Phone number</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Role Type</label>
                                <select id="role" name="role" class="form-control" required>
                                    <option value="">--Select--</option>
                                    @foreach(\App\Enums\VendorEnums::$ROLES as $key=>$type)
                                        <option value="{{$type}}">{{ucfirst(trans($key))}}</option>
                                    @endforeach
                                </select>
                                <span class="error-message">Please enter valid Service</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Modules under this roles</label>
                                <select name="assign_module[]" class="form-control select-box-model" multiple required>
                                    <option value="">--Select--</option>
                                    @foreach(\App\Enums\RoleGroupEnums::$MODUlES as $key_module=>$module)
                                        <option value="{{$module}}">{{ucfirst(trans(str_replace("_", " ", $key_module)))}}</option>
                                    @endforeach
                                </select>
                                <span class="error-message">Please enter valid Service</span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Branch</label>
                                <select class="form-control" name="branch" required>
                                    <option value="">--Select--</option>
                                    @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->city}}</option>
                                    @endforeach
                                </select>
                                <span class="error-message">Please enter valid Branch</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Email ID</label>
                                <input type="email" id="fullname" placeholder="role@email.com" name="email" class="form-control" required>
                                <span class="error-message">Please enter valid Email</span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Password</label>
                                <input type="password" id="fullname" placeholder="Enter Password" name="password" class="form-control">
                                <span class="error-message">Please enter valid Password</span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="">Date Of Birth</label>
                                <input type="text" id="fullname" name="dob" placeholder="dd/mm/yyyy" autocomplete="off" class="form-control birthdate dateselect" required>
                                <span class="error-message">Please enter valid Date of Birth</span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="">Date Of Joining</label>
                                <input type="text" id="fullname" name="doj"  placeholder="dd/mm/yyyy" autocomplete="off" class="form-control filterdate dateselect" required>
                                <span class="error-message">Please enter valid Date of Joining</span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="">Date Of Relieving</label>
                                <input type="text" id="fullname" name="dor" placeholder="dd/mm/yyyy" autocomplete="off" class="form-control filterdate dateselect" required>
                                <span class="error-message">Please enter valid Date of Relieving</span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Address Line 1</label>
                                <input type="text" id="fullname" name="address1" placeholder="Flat no, Street no" class="form-control" required>
                                <span class="error-message">Please enter valid
                                        Address Line 1</span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Address Line 2</label>
                                <span class="">
                                        <input type="text" id="fullname"  name="address2" placeholder="Landmark, Area" class="form-control" required>
                                        <span class="error-message">Please enter valid
                                        Address Line 2</span>
                                        </span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">State</label>
                                <span class="">
                                        <select id="" class="form-control" name="state" required>
                                            <option value="">--Select--</option>
                                            <option value="Andhra Pradesh" >Andhra Pradesh</option>
                                            <option value="Andaman and Nicobar Islands" >Andaman and Nicobar Islands</option>
                                            <option value="Arunachal Pradesh" >Arunachal Pradesh</option>
                                            <option value="Assam" >Assam</option>
                                            <option value="Bihar" >Bihar</option>
                                            <option value="Chandigarh" >Chandigarh</option>
                                            <option value="Chhattisgarh">Chhattisgarh</option>
                                            <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                            <option value="Daman and Diu">Daman and Diu</option>
                                            <option value="Delhi">Delhi</option>
                                            <option value="Lakshadweep">Lakshadweep</option>
                                            <option value="Puducherry" >Puducherry</option>
                                            <option value="Goa" >Goa</option>
                                            <option value="Gujarat" >Gujarat</option>
                                            <option value="Haryana" >Haryana</option>
                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                            <option value="Jammu and Kashmir" >Jammu and Kashmir</option>
                                            <option value="Jharkhand" >Jharkhand</option>
                                            <option value="Karnataka" >Karnataka</option>
                                            <option value="Kerala" >Kerala</option>
                                            <option value="Madhya Pradesh" >Madhya Pradesh</option>
                                            <option value="Maharashtra" >Maharashtra</option>
                                            <option value="Manipur" >Manipur</option>
                                            <option value="Meghalaya" >Meghalaya</option>
                                            <option value="Mizoram" >Mizoram</option>
                                            <option value="Nagaland" >Nagaland</option>
                                            <option value="Odisha" >Odisha</option>
                                            <option value="Punjab">Punjab</option>
                                            <option value="Rajasthan" >Rajasthan</option>
                                            <option value="Sikkim" >Sikkim</option>
                                            <option value="Tamil Nadu" >Tamil Nadu</option>
                                            <option value="Telangana" >Telangana</option>
                                            <option value="Tripura">Tripura</option>
                                            <option value="Uttar Pradesh" >Uttar Pradesh</option>
                                            <option value="Uttarakhand" >Uttarakhand</option>
                                            <option value="West Bengal" >West Bengal</option>
                                        </select>
                                        <span class="error-message">Please enter valid
                                            State</span>
                                        </span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">City</label>
                                <span class="">
                                        <input type="text" id="fullname" placeholder="Chandigarh" name="city"  class="form-control" required>
                                        <span class="error-message">Please enter valid
                                            City</span>
                                        </span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer p-15 ">
                    <div class="w-50" style="text-align: left !important;">
                        <a class="white-text p-10 cancel" href="#" data-dismiss="modal" aria-label="Close">
                            <button type="button" class="btn theme-br theme-text w-30 white-bg">Cancel</button>
                        </a>
                    </div>
                    <div class="w-50 text-right">
                        <a class="white-text p-10" href="#" data-dismiss="modal" aria-label="Close">
                            <button class="btn theme-bg white-text w-30" data-dismiss="modal" aria-label="Close">Save</button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @foreach($roles as $role)
        <div class="fullscreen-modal" id="role_{{$role->id}}">
            <div class="fullscreen-modal-body" role="document">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Role User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-new-order pt-4 mt-3 onboard-vendor-branch input-text-blue" action="{{route('role_edit')}}" data-next="redirect" data-redirect-type="hard" data-url="{{route('onboard-userrole-vendors', ['id'=>$id])}}" data-alert="mega" method="PUT" data-parsley-validate>
                    <div class="modal-body" style="padding: 10px 9px;">
                        <div class="d-flex row p-20 pt-0 pb-0">
                            <div class="col-lg-6">
                                <p class="img-label">Image</p>
                                <div class="upload-section p-20 pt-0">
                                    <img class="upload-preview"
                                         src="{{$role->image}}"
                                         alt=""/>
                                    <div class="ml-1">
                                        <div class="file-upload">
                                            <input type="file" />
                                            <input type="hidden" class="base-holder" name="image" value="{{$role->image}}" required />
                                            <button type="button" class="btn theme-bg white-text my-0" data-action="upload">
                                                UPLOAD IMAGE
                                            </button>
                                        </div>
                                        <p class="text-black">Max File size: 1MB</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <input type="hidden" name="id" value="{{$role->organization_id}}">
                                <input type="hidden" name="role_id" value="{{$role->id}}">
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Employee First Name</label>
                                    <input type="text" id="fullname" placeholder="First Name" name="fname" value="{{$role->fname}}" class="form-control alphabet" required>
                                    <span class="error-message">Please enter valid First Name</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Employee Last Name</label>
                                    <input type="text" id="fullname" placeholder="Last Name" value="{{$role->lname}}" name="lname" class="form-control alphabet" required>
                                    <span class="error-message">Please enter valid Last Name</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="phone-num-lable">Gender</label>
                                    <select class="form-control" name="gender" required>
                                        <option>--Select--</option>
                                        <option value="female" @if($role && ($role->gender == "female")) Selected @endif>Female</option>
                                        <option value="male" @if($role && ($role->gender == "male")) Selected @endif>Male</option>
                                        <option value="3rd gender" @if($role && ($role->gender == "3rd gender")) Selected @endif>3rd Gender</option>
                                    </select>
                                    <span class="error-message">Please enter valid Phone number</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="phone-num-lable">Employee Contact Number</label>
                                    <input type="tel" id="Employee" placeholder="9876543210" value="{{$role->phone}}" name="phone" class=" form-control phone" maxlength="10" minlength="10" required>
                                    <span class="error-message">Please enter valid Phone number</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Role Type</label>
                                    <select id="role" name="role" class="form-control" required>
                                        <option value="">--Select--</option>
                                        @foreach(\App\Enums\VendorEnums::$ROLES as $key=>$type)
                                            <option value="{{$type}}" @if ($type == $role->user_role) selected @endif>{{ucfirst(trans($key))}}</option>
                                        @endforeach
                                    </select>
                                    <span class="error-message">Please enter valid Service</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Modules under this roles</label>
                                    <select class="form-control select-box-model" name="assign_module[]" multiple required>
                                        <option value="">--Select--</option>
                                        @foreach(\App\Enums\RoleGroupEnums::$MODUlES as $key_module=>$module)
                                            <option value="{{$module}}"
                                                    @if($role && $role->assign_module)
                                                        @foreach(json_decode($role->assign_module, true) as $assigned)
                                                            @if($assigned == $module)
                                                                selected
                                                            @endif
                                                        @endforeach
                                                    @endif>{{ucfirst(trans(str_replace("_", " ", $key_module)))}}</option>
                                        @endforeach
                                    </select>
                                    <span class="error-message">Please enter valid Service</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Branch</label>
                                    <select class="form-control" name="branch" required>
                                        <option value="">--Select--</option>
                                        @foreach($branches as $branch)
                                            <option value="{{$branch->id}}" @if ($branch->id == $role->organization_id) selected @endif>{{$branch->city}}</option>
                                        @endforeach
                                    </select>
                                    <span class="error-message">Please enter valid Branch</span>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Email ID</label>
                                    <input type="email" id="fullname" placeholder="role@email.com" name="email" class="form-control" value="{{$role->email}}" required>
                                    <span class="error-message">Please enter valid Email</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Password</label>
                                    <input type="password" id="fullname" placeholder="Enter new to update" name="password" class="form-control">
                                    <span class="error-message">Please enter valid Password</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="">Date Of Birth</label>
                                    <input type="text" id="fullname" name="dob" value="{{$role->dob ? \Carbon\Carbon::parse($role->dob)->format("Y-m-d") : ''}}" autocomplete="off" placeholder="dd/mm/yyyy" class="form-control birthdate dateselect" required>
                                    <span class="error-message">Please enter valid Date of Birth</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="">Date Of Joining</label>
                                    <input type="text" id="fullname" name="doj" value="{{$role->doj ? \Carbon\Carbon::parse($role->doj)->format("Y-m-d") : ''}}" autocomplete="off" placeholder="dd/mm/yyyy" class="form-control filterdate dateselect" required>
                                    <span class="error-message">Please enter valid Date of Joining</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="">Date Of Relieving</label>
                                    <input type="text" id="fullname" name="dor" value="{{$role->dob ? \Carbon\Carbon::parse($role->dob)->format("Y-m-d") : ''}}" autocomplete="off" placeholder="dd/mm/yyyy" class="form-control filterdate dateselect" required>
                                    <span class="error-message">Please enter valid Date of Relieving</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Address Line 1</label>
                                    <input type="text" id="fullname" name="address1" value="{{json_decode($role->meta, true)['address_line1'] ?? ''}}" placeholder="Flat no, Street no" class="form-control" required>
                                    <span class="error-message">Please enter valid
                                        Address Line 1</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Address Line 2</label>
                                    <span class="">
                                        <input type="text" id="fullname"  name="address2" value="{{json_decode($role->meta, true)['address_line2'] ?? ''}}" placeholder="Landmark, Area" class="form-control" required>
                                        <span class="error-message">Please enter valid
                                        Address Line 2</span>
                                        </span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">State</label>
                                    <span class="">
                                        <select id="" class="form-control" name="state" required>
                                            <option value="">--Select--</option>
                                            <option value="Andhra Pradesh" @if($role->state=="Andhra Pradesh") selected @endif>Andhra Pradesh</option>
                                            <option value="Andaman and Nicobar Islands" @if($role->state=="Andaman and Nicobar Islands") selected @endif>Andaman and Nicobar Islands</option>
                                            <option value="Arunachal Pradesh" @if($role->state=="Arunachal Pradesh") selected @endif>Arunachal Pradesh</option>
                                            <option value="Assam" @if($role->state=="Assam") selected @endif>Assam</option>
                                            <option value="Bihar" @if($role->state=="Bihar") selected @endif>Bihar</option>
                                            <option value="Chandigarh" @if($role->state=="Chandigarh") selected @endif>Chandigarh</option>
                                            <option value="Chhattisgarh" @if($role->state=="Chhattisgarh") selected @endif>Chhattisgarh</option>
                                            <option value="Dadar and Nagar Haveli" @if($role->state=="Dadar and Nagar Haveli") selected @endif>Dadar and Nagar Haveli</option>
                                            <option value="Daman and Diu" @if($role->state=="Daman and Diu") selected @endif>Daman and Diu</option>
                                            <option value="Delhi" @if($role->state=="Delhi") selected @endif>Delhi</option>
                                            <option value="Lakshadweep" @if($role->state=="Lakshadweep") selected @endif>Lakshadweep</option>
                                            <option value="Puducherry" @if($role->state=="Puducherry") selected @endif>Puducherry</option>
                                            <option value="Goa" @if($role->state=="Goa") selected @endif>Goa</option>
                                            <option value="Gujarat" @if($role->state=="Gujarat") selected @endif>Gujarat</option>
                                            <option value="Haryana" @if($role->state=="Haryana") selected @endif>Haryana</option>
                                            <option value="Himachal Pradesh" @if($role->state=="Himachal Pradesh") selected @endif>Himachal Pradesh</option>
                                            <option value="Jammu and Kashmir" @if($role->state=="Jammu and Kashmir") selected @endif>Jammu and Kashmir</option>
                                            <option value="Jharkhand" @if($role->state=="Jharkhand") selected @endif>Jharkhand</option>
                                            <option value="Karnataka" @if($role->state=="Karnataka") selected @endif>Karnataka</option>
                                            <option value="Kerala" @if($role->state=="Kerala") selected @endif>Kerala</option>
                                            <option value="Madhya Pradesh" @if($role->state=="Madhya Pradesh") selected @endif>Madhya Pradesh</option>
                                            <option value="Maharashtra" @if($role->state=="Maharashtra") selected @endif>Maharashtra</option>
                                            <option value="Manipur" @if($role->state=="Manipur") selected @endif>Manipur</option>
                                            <option value="Meghalaya" @if($role->state=="Meghalaya") selected @endif>Meghalaya</option>
                                            <option value="Mizoram" @if($role->state=="Mizoram") selected @endif>Mizoram</option>
                                            <option value="Nagaland" @if($role->state=="Nagaland") selected @endif>Nagaland</option>
                                            <option value="Odisha" @if($role->state=="Odisha") selected @endif>Odisha</option>
                                            <option value="Punjab" @if($role->state=="Punjab") selected @endif>Punjab</option>
                                            <option value="Rajasthan" @if($role->state=="Rajasthan") selected @endif>Rajasthan</option>
                                            <option value="Sikkim" @if($role->state=="Sikkim") selected @endif>Sikkim</option>
                                            <option value="Tamil Nadu" @if($role->state=="Tamil Nadu") selected @endif>Tamil Nadu</option>
                                            <option value="Telangana" @if($role->state=="Telangana") selected @endif>Telangana</option>
                                            <option value="Tripura" @if($role->state=="Tripura") selected @endif>Tripura</option>
                                            <option value="Uttar Pradesh" @if($role->state=="Uttar Pradesh") selected @endif>Uttar Pradesh</option>
                                            <option value="Uttarakhand" @if($role->state=="Uttarakhand") selected @endif>Uttarakhand</option>
                                            <option value="West Bengal" @if($role->state=="West Bengal") selected @endif>West Bengal</option>
                                        </select>
                                        <span class="error-message">Please enter valid
                                            State</span>
                                        </span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">City</label>
                                    <span class="">
                                        <input type="text" id="fullname" placeholder="Chandigarh" value="{{$role->city ?? ''}}" name="city"  class="form-control" required>
                                        <span class="error-message">Please enter valid
                                            City</span>
                                        </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer p-15 ">
                        <div class="w-50" style="text-align: left !important;">
                            <a class="white-text p-10 cancel" href="#" data-dismiss="modal" aria-label="Close">
                                <button type="button" class="btn theme-br theme-text w-30 white-bg">Cancel</button>
                            </a>
                        </div>
                        <div class="w-50 text-right">
                            <a class="white-text p-10" href="#" data-dismiss="modal" aria-label="Close">
                                <button class="btn theme-bg white-text w-30" data-dismiss="modal" aria-label="Close">Save</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
</div>

@endsection

@section('modal')


@endsection
