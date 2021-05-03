@extends('vendor-panel.layouts.frame')
@section('title') Manage User Roles @endsection
@section('body')

    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="newuserroles">
        <div class="d-flex  flex-row justify-content-between">
            <h3 class="page-head text-left p-4 theme-text">Add New User</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left p-2 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('vendor.managerusermgt', ['type'=>"admin"])}}"> Users & Roles</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add New User</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-sm-10">
                <div class="card  h-auto p-0 pt-10 ">
                    <form class="form-new-order pt-4 mt-3 onboard-vendor-branch input-text-blue" action="{{route('role_add')}}" data-next="redirect" data-url="{{route('onboard-userrole-vendors', ['id'=>$id])}}" data-alert="mega" method="POST" data-parsley-validate>
                        <div class="card-head right text-left  p-8 ">
                            <div class="d-flex row p-15 pb-0">
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="">Select Role</label>
                                        <span class="select-role">
                                            <select  id="select-role" name="role" class="form-control" required>
                                                <option  value="">--select--</option>
                                               @foreach(\App\Enums\VendorEnums::$ROLES as $role=>$key)
                                                    <option  value="$key">{{ucwords($role)}}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="new-user-form border-top">
                        <!-- form starts -->
                            <div class="d-flex row p-15 pb-0">
                                <div class="col-sm-6">
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
                                <div class="col-sm-6">

                                </div>
                            </div>
                            <div class="d-flex row p-15">
                                <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class=""> First Name</label>
                                            <input type="text" id="fullname" name="fname"
                                                   placeholder="David"
                                                   class="form-control" required>
                                            <span class="error-message">Please enter valid
                                                First Name</span>
                                        </div>
                                </div>

                                <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name"> Last Name</label>
                                            <input type="text" id="fullname" name="lname"
                                                   placeholder="Jerome"
                                                   class="form-control" required>
                                            <span class="error-message">Please enter valid First Name</span>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="phone-num-lable">Phone Number</label>
                                            <input type="tel" id="phone"
                                                   placeholder="987654321" name="phone"
                                                   class=" form-control" required>
                                            <span class="error-message">Please enter valid
                                                Phone number</span>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Email ID</label>
                                            <input type="email" id="email"
                                                   placeholder="davidjerome@gmail.com"
                                                   class="form-control">
                                            <span class="error-message">Please enter valid</span>
                                        </div>
                                </div>
                                <div class="col-lg-6 toggle-input">
                                        <div class="form-input">
                                            <label class="">Branch Name</label>
                                            <select class="form-control" name="branch" required>
                                                <option value="">--Select--</option>
                                                @foreach($branches as $branch)
                                                    <option value="{{$branch->id}}">{{$branch->city}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-message">Please enter valid
                                                Phone number</span>
                                        </div>
                                </div>

                            </div>

                            <div class="d-flex  justify-content-between flex-row  p-10 border-top" >
                                <div class="w-50"><a class="white-text p-10" href="#"><button type="button"
                                                class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>
                                </div>
                                    <div class="w-50 text-right"><a class="white-text p-10"><button
                                                class="btn theme-bg white-text w-30">Save</button></a>
                                    </div>
                            </div>
                        <!-- Tab-1 form -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
