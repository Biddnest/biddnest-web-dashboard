@extends('vendor-panel.layouts.frame')
@section('title') Manage User Roles @endsection
@section('body')

    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="newuserroles">
        <div class="d-flex  flex-row justify-content-between">
            <h3 class="page-head text-left p-4 theme-text">@if($roles)Edit @else Add New @endif User</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left p-2 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('vendor.managerusermgt', ['type'=>"admin"])}}"> Users & Roles</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@if($roles)Edit @else Add New @endif User</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-sm-10">
                <div class="card  h-auto p-0 pt-10 ">
                    <form class="form-new-order  onboard-vendor-branch input-text-blue mt-0 pt-0" action="@if($roles){{route('api.user.edit')}} @else {{route('api.user.add')}}@endif" data-next="redirect" data-url="{{route('vendor.managerusermgt', ['type'=>"admin"])}}" data-alert="mega" method="@if($roles){{"PUT"}}@else{{"POST"}}@endif" autocomplete="off" data-parsley-validate>
                        <div class="card-head right text-left  p-8 ">
                            @if($roles)
                                <input type="hidden" name="role_id" value="{{$roles->id}}">
                            @endif
                            @if($roles && ($roles->user_role == \App\Enums\VendorEnums::$ROLES['admin'] ))
                                <div class="d-flex row p-15 pt-0 pb-0">
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="">Select Role</label>
                                            <span class="select-role">
                                                <select  id="select-role" name="role" class="form-control" required>
                                                    <option  value="">--select--</option>
                                                   @foreach(\App\Enums\VendorEnums::$ROLES as $role=>$key)
                                                        <option  value="{{$key}}" @if($roles && ($roles->user_role == $key)) selected @endif>{{ucwords($role)}}</option>
                                                    @endforeach
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="">Branch Name</label>
                                            <select class="form-control" name="branch" required>
                                                <option value="">--Select--</option>
                                                @foreach($branches as $branch)
                                                    <option value="{{$branch->id}}" @if($roles && ($branch->id == $roles->organization_id)) selected @endif>{{$branch->city}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-message">Please enter valid
                                                    Phone number</span>
                                        </div>
                                    </div>
                                </div>
                            @elseif($roles && ($roles->user_role == \App\Enums\VendorEnums::$ROLES['admin'] ))
                                <div class="d-flex row p-15 pt-0 pb-0">
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="">Select Role</label>
                                            <span class="select-role">
                                                <select  id="select-role" name="role" class="form-control" required>
                                                    <option  value="">--select--</option>
                                                   @foreach(\App\Enums\VendorEnums::$ROLES as $role=>$key)
                                                        <option  value="{{$key}}" >{{ucwords($role)}}</option>
                                                    @endforeach
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
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
                            @endif
                        </div>
                        <div class="new-user-form border-top">
                        <!-- form starts -->
                            <div class="d-flex row p-15 pb-0">
                                <div class="col-sm-6">
                                    <p class="img-label">Image</p>
                                    <div class="upload-section p-20 pt-0">
                                        <img class="upload-preview"
                                             src="@if(!$roles){{asset('static/images/upload-image.svg')}}@else{{$roles->image}}@endif"
                                             alt="" style="width: 63px !important;"/>
                                        <div class="ml-1">
                                            <div class="file-upload">
                                                <input type="hidden" class="base-holder" name="image" value="@if(!$roles){{asset('static/images/upload-image.svg')}}@else{{$roles->image}}@endif" required />
                                                <button type="button" class="btn theme-bg white-text my-0" data-action="upload">
                                                    UPLOAD IMAGE
                                                </button>
                                                <input type="file" @if(!$roles) required @endif/>
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
                                                   placeholder="David" value="{{$roles->fname ?? ''}}"
                                                   class="form-control" required>
                                            <span class="error-message">Please enter valid
                                                First Name</span>
                                        </div>
                                </div>

                                <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name"> Last Name</label>
                                            <input type="text" id="fullname" name="lname"
                                                   placeholder="Jerome" value="{{$roles->lname ?? ''}}"
                                                   class="form-control" required>
                                            <span class="error-message">Please enter valid First Name</span>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="phone-num-lable">Phone Number</label>
                                            <input type="tel" id="phone" placeholder="987654321" class="form-control phone" name="phone" value="{{$roles->phone ?? ''}}" autocomplete="off" placeholder="9990009990" maxlength="10" minlength="10" required>

                                            <span class="error-message">Please enter valid
                                                Phone number</span>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="phone-num-lable">Alternate Phone Number</label>
                                        <input type="tel" id="phone"
                                               placeholder="987654321" name="secondary_phone" value="@if($roles && $roles->meta){{json_decode($roles->meta, true)['secondary_phone'] ?? ''}}@endif"
                                               class=" form-control phone" maxlength="10" minlength="10">
                                        <span class="error-message">Please enter valid Phone number</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="phone-num-lable">Gender</label>
                                        <select class="form-control" name="gender" required>
                                            <option>--Select--</option>
                                            <option value="female" @if($roles && ($roles->gender == "female")) Selected @endif>Female</option>
                                            <option value="male" @if($roles && ($roles->gender == "male")) Selected @endif>Male</option>
                                            <option value="3rd gender" @if($roles && ($roles->gender == "3rd gender")) Selected @endif>3rd Gender</option>
                                        </select>
                                        <span class="error-message">Please enter valid Phone number</span>
                                    </div>
                                </div>

                                @if($roles && ($roles->user_role == \App\Enums\VendorEnums::$ROLES['admin'] ))
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Modules under this roles</label>
                                            <select class="form-control select-box" name="assign_module[]" multiple required>
                                                <option value="">--Select--</option>
                                                @foreach(\App\Enums\RoleGroupEnums::$MODUlES as $key_module=>$module)
                                                    <option value="{{$module}}"
                                                            @if($roles && $roles->assign_module)
                                                                @foreach(json_decode($roles->assign_module, true) as $assigned)
                                                                    @if($assigned == $module)
                                                                        selected
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                    >{{ucfirst(trans(str_replace("_", " ", $key_module)))}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-message">Please enter valid Service</span>
                                        </div>
                                    </div>
                                @else
                                    @if($roles->user_role == \App\Enums\VendorEnums::$ROLES['admin'] )
                                        <div class="col-lg-6">
                                            <div class="form-input">
                                                <label class="full-name">Modules under this roles</label>
                                                <select class="form-control select-box" name="assign_module[]" multiple required>
                                                    <option value="">--Select--</option>
                                                    @foreach(\App\Enums\RoleGroupEnums::$MODUlES as $key_module=>$module)
                                                        <option value="{{$module}}">{{ucfirst(trans(str_replace("_", " ", $key_module)))}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="error-message">Please enter valid Service</span>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Email ID</label>
                                            <input type="email" id="email" name="email"
                                                   placeholder="davidjerome@gmail.com" value="{{$roles->email ?? ''}}"
                                                   class="form-control">
                                            <span class="error-message">Please enter valid</span>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="">Date Of Birth</label>
                                            <input type="text" id="fullname" name="dob" value="{{$roles->dob ?? ''}}" autocomplete="off" placeholder="dd/mm/yyyy" class="form-control singledate dateselect birthdate" required>
                                            <span class="error-message">Please enter valid Date of Birth</span>
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
                                        <label class="">Date Of Joining</label>
                                        <input type="text" id="fullname" name="doj" value="{{$roles->doj ?? ''}}" placeholder="dd/mm/yyyy" class="form-control filterdate dateselect" required>
                                        <span class="error-message">Please enter valid Date of Joining</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="">Date Of Relieving</label>
                                        <input type="text" id="fullname" name="dor" value="{{$roles->dor ?? ''}}" placeholder="dd/mm/yyyy" class="form-control filterdate dateselect">
                                        <span class="error-message">Please enter valid Date of Relieving</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Address Line 1</label>
                                        <input type="text" id="fullname" name="address1" value="@if($roles){{json_decode($roles->meta, true)['address_line1'] ?? ''}}@endif" placeholder="Flat no, Street no" class="form-control" required>
                                        <span class="error-message">Please enter valid
                                        Address Line 1</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Address Line 2</label>
                                        <span class="">
                                        <input type="text" id="fullname"  name="address2" value="@if($roles){{json_decode($roles->meta, true)['address_line2'] ?? ''}}@endif" placeholder="Landmark, Area" class="form-control" required>
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
                                            <option value="Andhra Pradesh" @if($roles && ($roles->state=="Andhra Pradesh")) selected @endif>Andhra Pradesh</option>
                                            <option value="Andaman and Nicobar Islands" @if($roles && ($roles->state=="Andaman and Nicobar Islands")) selected @endif>Andaman and Nicobar Islands</option>
                                            <option value="Arunachal Pradesh" @if($roles && ($roles->state=="Arunachal Pradesh")) selected @endif>Arunachal Pradesh</option>
                                            <option value="Assam" @if($roles && ($roles->state=="Assam")) selected @endif>Assam</option>
                                            <option value="Bihar" @if($roles && ($roles->state=="Bihar")) selected @endif>Bihar</option>
                                            <option value="Chandigarh" @if($roles && ($roles->state=="Chandigarh")) selected @endif>Chandigarh</option>
                                            <option value="Chhattisgarh" @if($roles && ($roles->state=="Chhattisgarh")) selected @endif>Chhattisgarh</option>
                                            <option value="Dadar and Nagar Haveli" @if($roles && ($roles->state=="Dadar and Nagar Haveli")) selected @endif>Dadar and Nagar Haveli</option>
                                            <option value="Daman and Diu" @if($roles && ($roles->state=="Daman and Diu")) selected @endif>Daman and Diu</option>
                                            <option value="Delhi" @if($roles && ($roles->state=="Delhi")) selected @endif>Delhi</option>
                                            <option value="Lakshadweep" @if($roles && ($roles->state=="Lakshadweep")) selected @endif>Lakshadweep</option>
                                            <option value="Puducherry" @if($roles && ($roles->state=="Puducherry")) selected @endif>Puducherry</option>
                                            <option value="Goa" @if($roles && ($roles->state=="Goa")) selected @endif>Goa</option>
                                            <option value="Gujarat" @if($roles && ($roles->state=="Gujarat")) selected @endif>Gujarat</option>
                                            <option value="Haryana" @if($roles && ($roles->state=="Haryana")) selected @endif>Haryana</option>
                                            <option value="Himachal Pradesh" @if($roles && ($roles->state=="Himachal Pradesh")) selected @endif>Himachal Pradesh</option>
                                            <option value="Jammu and Kashmir" @if($roles && ($roles->state=="Jammu and Kashmir")) selected @endif>Jammu and Kashmir</option>
                                            <option value="Jharkhand" @if($roles && ($roles->state=="Jharkhand")) selected @endif>Jharkhand</option>
                                            <option value="Karnataka" @if($roles && ($roles->state=="Karnataka")) selected @endif>Karnataka</option>
                                            <option value="Kerala" @if($roles && ($roles->state=="Kerala")) selected @endif>Kerala</option>
                                            <option value="Madhya Pradesh" @if($roles && ($roles->state=="Madhya Pradesh")) selected @endif>Madhya Pradesh</option>
                                            <option value="Maharashtra" @if($roles && ($roles->state=="Maharashtra")) selected @endif>Maharashtra</option>
                                            <option value="Manipur" @if($roles && ($roles->state=="Manipur")) selected @endif>Manipur</option>
                                            <option value="Meghalaya" @if($roles && ($roles->state=="Meghalaya")) selected @endif>Meghalaya</option>
                                            <option value="Mizoram" @if($roles && ($roles->state=="Mizoram")) selected @endif>Mizoram</option>
                                            <option value="Nagaland" @if($roles && ($roles->state=="Nagaland")) selected @endif>Nagaland</option>
                                            <option value="Odisha" @if($roles && ($roles->state=="Odisha")) selected @endif>Odisha</option>
                                            <option value="Punjab" @if($roles && ($roles->state=="Punjab")) selected @endif>Punjab</option>
                                            <option value="Rajasthan" @if($roles && ($roles->state=="Rajasthan")) selected @endif>Rajasthan</option>
                                            <option value="Sikkim" @if($roles && ($roles->state=="Sikkim")) selected @endif>Sikkim</option>
                                            <option value="Tamil Nadu" @if($roles && ($roles->state=="Tamil Nadu")) selected @endif>Tamil Nadu</option>
                                            <option value="Telangana" @if($roles && ($roles->state=="Telangana")) selected @endif>Telangana</option>
                                            <option value="Tripura" @if($roles && ($roles->state=="Tripura")) selected @endif>Tripura</option>
                                            <option value="Uttar Pradesh" @if($roles && ($roles->state=="Uttar Pradesh")) selected @endif>Uttar Pradesh</option>
                                            <option value="Uttarakhand" @if($roles && ($roles->state=="Uttarakhand")) selected @endif>Uttarakhand</option>
                                            <option value="West Bengal" @if($roles && ($roles->state=="West Bengal")) selected @endif>West Bengal</option>
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
                                        <input type="text" id="fullname" placeholder="Chandigarh" value="{{$roles->city ?? ''}}" name="city"  class="form-control" required>
                                        <span class="error-message">Please enter valid
                                            City</span>
                                        </span>
                                    </div>
                                </div>

                            </div>

                            <div class="d-flex  justify-content-between flex-row  p-10 border-top" >
                                <div class="w-50"><a class="white-text p-10" href="{{route('vendor.managerusermgt', ['type'=>"admin"])}}"><button type="button"
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
        <script>
            var myDropzone = new Dropzone("div#dropzone", {
                url: "/file/post",
                dictDefaultMessage: 'Drop file here or click to upload<br><span> Max File Size 2MB</span>',
                maxFilesize: 2,
            });
        </script>
    </div>

@endsection
