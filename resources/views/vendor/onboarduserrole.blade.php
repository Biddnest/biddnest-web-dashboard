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
                    <li class="breadcrumb-item"><a href="vendor-management.html"> Vendors Management</a>
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
                                <a class="nav-link p-15" href="{{route("onboard-edit-vendors",["id"=>$id])}}">Edit Onboard Vendor</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" href="{{route("onboard-branch-vendors",["id"=>$id])}}">Add Branch</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" href="{{route("onboard-bank-vendors",["id"=>$id])}}"
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
                        <div class="row" style="padding: 20px 25px;">
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
                            <a class="white-text p-10" href="{{route("onboard-bank-vendors", ['id'=>$id])}}">
                                <button class="btn theme-br theme-text w-30 white-bg">Back</button></a></a>
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
            <form class="form-new-order pt-4 mt-3 onboard-vendor-branch input-text-blue" action="{{route('role_add')}}" data-next="redirect" data-url="{{route('onboard-userrole-vendors', ['id'=>$id])}}" data-alert="mega" method="POST" data-parsley-validate>
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
                                        <input type="file" />
                                        <input type="hidden" class="base-holder" name="image" value="" required />
                                        <button type="button" class="btn theme-bg white-text my-0" data-action="upload">
                                            UPLOAD IMAGE
                                        </button>
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
                                <input type="text" id="fullname" placeholder="First Name" name="fname" class="form-control" required>
                                <span class="error-message">Please enter valid First Name</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Employee Last Name</label>
                                <input type="text" id="fullname" placeholder="Last Name" name="lname" class="form-control" required>
                                <span class="error-message">Please enter valid Last Name</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="phone-num-lable">Employee Contact Number</label>
                                <input type="tel" id="Employee" placeholder="9876543210" name="phone" class=" form-control" required>
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
                    </div>
                </div>
                <div class="modal-footer p-15 ">
                    <div class="w-50"> </div>
                    <div class="w-50 text-right">
                        <a class="white-text p-10" href="#" data-dismiss="modal" aria-label="Close">
                            <button class="btn theme-bg white-text w-30">Save</button>
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
                            <h5 class="modal-title" id="exampleModalLabel">Add New Role</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-new-order pt-4 mt-3 onboard-vendor-branch input-text-blue" action="{{route('role_edit')}}" data-next="redirect" data-url="{{route('onboard-userrole-vendors', ['id'=>$id])}}" data-alert="mega" method="PUT" data-parsley-validate>
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
                                            <input type="text" id="fullname" placeholder="First Name" name="fname" value="{{$role->fname}}" class="form-control" required>
                                            <span class="error-message">Please enter valid First Name</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Employee Last Name</label>
                                            <input type="text" id="fullname" placeholder="Last Name" value="{{$role->lname}}" name="lname" class="form-control" required>
                                            <span class="error-message">Please enter valid Last Name</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="phone-num-lable">Employee Contact Number</label>
                                            <input type="tel" id="Employee" placeholder="9876543210" value="{{$role->phone}}" name="phone" class=" form-control" required>
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
                                            <input type="password" id="fullname" placeholder="Enter Password" name="password" class="form-control">
                                            <span class="error-message">Please enter valid Password</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer p-15 ">
                                <div class="w-50"> </div>
                                <div class="w-50 text-right">
                                    <a class="white-text p-10" href="#" data-dismiss="modal" aria-label="Close">
                                        <button class="btn theme-bg white-text w-30">Save</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
    @endforeach
@endsection
