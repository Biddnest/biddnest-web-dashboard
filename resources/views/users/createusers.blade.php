@extends('layouts.app')
@section('title') Users And Roles @endsection
@section('content')

 <!-- Main Content -->
 <div class="main-content grey-bg" data-barba="container" data-barba-namespace="createusersandroles">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4 theme-text">@if(!$users) Add New @else Edit @endif User</h3>
    </div>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left p-2 pt-0 pb-0">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('users')}}"> Users & Roles</a></li>
              <li class="breadcrumb-item active" aria-current="page">@if(!$users) Add New @else Edit @endif User</li>
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
                                <a class="nav-link active p-15" id="new-order-tab" data-toggle="tab" href="#order" role="tab" aria-controls="home" aria-selected="true">@if(!$users) Add New @else Edit @endif User</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15 @if(!$users) disabled @endif" id="quotation"
                                    href="@if(!$users) # @else{{route('create-bank', ['id'=>$users->id])}}@endif" >Banking Details</a>
                            </li>
                        </ul>
                    </h3>
                </div>
                <div class="tab-content margin-topneg-7 border-top" id="myTabContent">

                    <div class="tab-pane fade show active" id="order" role="tabpanel" aria-labelledby="new-order-tab">
                        <!-- form starts -->
                        <form action="@if(!$users){{route('user_add')}}@else{{route('user_edit')}}@endif" method="@if(isset($users)){{"PUT"}}@else{{"POST"}}@endif" data-next="redirect" data-redirect-type="hard" data-url="@if(!$users){{route('create-bank', ['id'=>':id'])}}@else{{route('create-bank', ['id'=>$users->id])}}@endif" data-alert="tiny" class="form-new-order pt-4 mt-3 input-text-blue" id="myForm" data-parsley-validate >
                            <div class="d-flex row p-20">
                                <div class="col-sm-6">
                                    <p class="img-label">Image</p>
                                    <div class="upload-section p-20 pt-0">
                                        <img class="upload-preview" src="@if(!$users){{asset('static/images/upload-image.svg')}}@else{{$users->image}}@endif" alt=""/>
                                        <div class="ml-1">
                                            <div class="file-upload">
                                                <input type="file" />
                                                <input type="hidden" class="base-holder" name="image" value="@if($users){{$users->image}}@endif" required />
                                                <button type="button" class="btn theme-bg white-text my-0" data-action="upload">
                                                    UPLOAD IMAGE
                                                </button>
                                            </div>
                                            <p class="text-black">Max File size: 1MB</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    @if($users)
                                        <input type="hidden" value="{{$users->id}}" name="id">
                                    @endif
                                   {{-- <p class="theme-text">Status</p>
                                    <div class="form-input">
                                        <div class="d-flex justify-content-start   margin-topneg-20 white-text small-switch">
                                            <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-width="100" data-height="35" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-on="YES" data-off="NO" id="">
                                        </div>
                                    </div>--}}
                                </div>
                            </div>

                            <div class="d-flex row p-20">
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Employee First Name</label>
                                        <input type="text" id="fullname" placeholder="David" name="fname" value="@if($users){{ucfirst(trans($users->fname))}}@endif" class="form-control" required>
                                        <span class="error-message">Please enter valid First Name</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Employee Last Name</label>
                                            <input type="text" id="fullname" placeholder="Jerome" value="@if($users){{ucfirst(trans($users->lname))}}@endif" name="lname" class="form-control" required>
                                            <span class="error-message">Please enter valid Last Name</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Employee ID/ Username</label>
                                        <input type="text" id="fullname" placeholder="0016" name="username" class="form-control" value="@if($users){{$users->username}}@endif" required>
                                        <span class="error-message">Please enter valid</span>
                                    </div>
                                </div>
                                @if(!$users || !$users->password)
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Employee Password</label>
                                            <input type="password" id="fullname" placeholder="Password" name="password" required class="form-control">
                                            <span class="error-message">Please enter valid Password</span>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Employee Role</label>
                                        <select id="role" name="role" class="form-control" required>
                                            <option value="">--Select--</option>
                                            @foreach(\App\Enums\AdminEnums::$ROLES as $key=>$role)
                                                <option value="{{$role}}" @if($users && ($users->role==$role)) Selected @endif >{{ucfirst(trans($key))}}</option>
                                            @endforeach
                                        </select>
                                        <span class="error-message">Please enter valid</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Zone</label>
                                        <select id="role" name="zone[]" class="form-control select-box" multiple required>
                                            <option value="">--Select--</option>
                                            @foreach(Illuminate\Support\Facades\Session::get('zones') as $zone)
                                                <option value="{{$zone->id}}"
                                                    @if($users && $users->zone_id)
                                                        @foreach($users->zone_id as $zone_id)
                                                            @if($zone_id == $zone->id) selected @endif
                                                        @endforeach
                                                    @endif>{{$zone->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="error-message">Please enter Zone</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Manager Name</label>
                                        <input type="text" id="fullname" placeholder="Anthony" name="meta[manager_name]" required class="form-control" value="@if($users){{json_decode($users->meta, true)['manager_name']}}@endif">
                                        <span class="error-message">Please enter valid</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="phone-num-lable">Phone Number</label>
                                            <input type="tel" id="phone" placeholder="987654321" name="phone" maxlength="10" minlength="10" class=" form-control" value="@if($users){{$users->phone}}@endif" required>
                                            <span class="error-message">Please enter valid
                                                Phone number</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="phone-num-lable">Alternate Phone Number</label>
                                            <input type="tel" id="phone-1" placeholder="987654321" name="meta[alt_phone]" maxlength="10" minlength="10" class=" form-control" value="@if($users){{json_decode($users->meta, true)['alt_phone']}}@endif" required>
                                            <span class="error-message">Please enter valid
                                                Phone number</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Email ID</label>
                                        <input type="email" id="email" placeholder="admin@gmail.com" value="@if($users){{$users->email}}@endif" class="form-control" name="email" required>
                                        <span class="error-message">Please enter valid</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="phone-num-lable">Gender</label>
                                        <select  id="" class="form-control" name="meta[gender]" required>
                                            <option value="">--Select--</option>
                                            <option value="male" @if($users && (json_decode($users->meta, true)['gender'] == "male")) selected @endif>Male</option>
                                            <option value="female" @if($users && (json_decode($users->meta, true)['gender'] == "female")) selected @endif>Female</option>
                                            <option value="other" @if($users && (json_decode($users->meta, true)['gender'] == "other")) selected @endif>Other</option>
                                        </select>
                                        <span class="error-message">Please enter valid Gender</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Date of Birth</label>
                                        <input type="date" class=" form-control br-5" value="@if($users){{$users->dob}}@endif" name="dob" required="required"  placeholder="15/02/2021"/>
                                        <span class="error-message">Please enter valid</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">PAN Card Number</label>
                                        <input type="text" id="fullname" placeholder="btech Mechanical" name="meta[pan_no]" class="form-control" value="@if($users){{json_decode($users->meta, true)['pan_no']}}@endif" required>
                                        <span class="error-message">Please enter valid</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Aadhar Card Number</label>
                                        <input type="text" id="fullname" name="meta[adhar_no]" placeholder="btech Mechanical" class="form-control" value="@if($users){{json_decode($users->meta, true)['aadha_no']}}@endif" required>
                                        <span class="error-message">Please enter valid</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Address Line 1</label>
                                        <input type="text" id="fullname" placeholder="" name="meta[address_line1]" required class="form-control" value="@if($users){{json_decode($users->meta, true)['address_line1']}}@endif">
                                        <span class="error-message">Please enter validAddress Line</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Address Line 2</label>
                                        <input type="text" id="fullname" placeholder="" name="meta[address_line2]" required  class="form-control" value="@if($users){{json_decode($users->meta, true)['address_line2']}}@endif">
                                        <span class="error-message">Please enter valid Address Line</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">State</label>
                                        <select id="" class="form-control" name="state" required>
                                            <option value="">--Select--</option>
                                            <option value="Andhra Pradesh" @if($users && ($users->state=="Andhra Pradesh")) selected @endif>Andhra Pradesh</option>
                                            <option value="Andaman and Nicobar Islands" @if($users && ($users->state=="Andaman and Nicobar Islands")) selected @endif>Andaman and Nicobar Islands</option>
                                            <option value="Arunachal Pradesh" @if($users && ($users->state=="Arunachal Pradesh")) selected @endif>Arunachal Pradesh</option>
                                            <option value="Assam" @if($users && ($users->state=="Assam")) selected @endif>Assam</option>
                                            <option value="Bihar" @if($users && ($users->state=="Bihar")) selected @endif>Bihar</option>
                                            <option value="Chandigarh" @if($users && ($users->state=="Chandigarh")) selected @endif>Chandigarh</option>
                                            <option value="Chhattisgarh" @if($users && ($users->state=="Chhattisgarh")) selected @endif>Chhattisgarh</option>
                                            <option value="Dadar and Nagar Haveli" @if($users && ($users->state=="Dadar and Nagar Haveli")) selected @endif>Dadar and Nagar Haveli</option>
                                            <option value="Daman and Diu" @if($users && ($users->state=="Daman and Diu")) selected @endif>Daman and Diu</option>
                                            <option value="Delhi" @if($users && ($users->state=="Delhi")) selected @endif>Delhi</option>
                                            <option value="Lakshadweep" @if($users && ($users->state=="Lakshadweep")) selected @endif>Lakshadweep</option>
                                            <option value="Puducherry" @if($users && ($users->state=="Puducherry")) selected @endif>Puducherry</option>
                                            <option value="Goa" @if($users && ($users->state=="Goa")) selected @endif>Goa</option>
                                            <option value="Gujarat" @if($users && ($users->state=="Gujarat")) selected @endif>Gujarat</option>
                                            <option value="Haryana" @if($users && ($users->state=="Haryana")) selected @endif>Haryana</option>
                                            <option value="Himachal Pradesh" @if($users && ($users->state=="Himachal Pradesh")) selected @endif>Himachal Pradesh</option>
                                            <option value="Jammu and Kashmir" @if($users && ($users->state=="Jammu and Kashmir")) selected @endif>Jammu and Kashmir</option>
                                            <option value="Jharkhand" @if($users && ($users->state=="Jharkhand")) selected @endif>Jharkhand</option>
                                            <option value="Karnataka" @if($users && ($users->state=="Karnataka")) selected @endif>Karnataka</option>
                                            <option value="Kerala" @if($users && ($users->state=="Kerala")) selected @endif>Kerala</option>
                                            <option value="Madhya Pradesh" @if($users && ($users->state=="Madhya Pradesh")) selected @endif>Madhya Pradesh</option>
                                            <option value="Maharashtra" @if($users && ($users->state=="Maharashtra")) selected @endif>Maharashtra</option>
                                            <option value="Manipur" @if($users && ($users->state=="Manipur")) selected @endif>Manipur</option>
                                            <option value="Meghalaya" @if($users && ($users->state=="Meghalaya")) selected @endif>Meghalaya</option>
                                            <option value="Mizoram" @if($users && ($users->state=="Mizoram")) selected @endif>Mizoram</option>
                                            <option value="Nagaland" @if($users && ($users->state=="Nagaland")) selected @endif>Nagaland</option>
                                            <option value="Odisha" @if($users && ($users->state=="Odisha")) selected @endif>Odisha</option>
                                            <option value="Punjab" @if($users && ($users->state=="Punjab")) selected @endif>Punjab</option>
                                            <option value="Rajasthan" @if($users && ($users->state=="Rajasthan")) selected @endif>Rajasthan</option>
                                            <option value="Sikkim" @if($users && ($users->state=="Sikkim")) selected @endif>Sikkim</option>
                                            <option value="Tamil Nadu" @if($users && ($users->state=="Tamil Nadu")) selected @endif>Tamil Nadu</option>
                                            <option value="Telangana" @if($users && ($users->state=="Telangana")) selected @endif>Telangana</option>
                                            <option value="Tripura" @if($users && ($users->state=="Tripura")) selected @endif>Tripura</option>
                                            <option value="Uttar Pradesh" @if($users && ($users->state=="Uttar Pradesh")) selected @endif>Uttar Pradesh</option>
                                            <option value="Uttarakhand" @if($users && ($users->state=="Uttarakhand")) selected @endif>Uttarakhand</option>
                                            <option value="West Bengal" @if($users && ($users->state=="West Bengal")) selected @endif>West Bengal</option>
                                        </select>
                                        <span class="error-message">Please enter valid Landmark</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">City</label>
                                        <input type="text" id="fullname" name="city" required placeholder="" class="form-control" value="@if($users){{$users->city}}@endif">
                                        <span class="error-message">Please enter valid Zone</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Pincode</label>
                                        <input type="text" id="fullname" placeholder="" name="pincode" maxlength="6" minlength="6" value="@if($users){{$users->pincode}}@endif" required class="form-control">
                                        <span class="error-message">Please enter valid Pincode</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Date of Joining</label>
                                            <input type="date" class=" form-control br-5" name="joinig_date" required="required"  value="@if($users){{$users->date_of_joining}}@endif"   placeholder="15/02/2021"/>
                                            <span class="error-message">Please enter valid Pincode</span>
                                    </div>
                                </div>

                            </div>
                            <div class="" id="comments">
                                <div class="d-flex  justify-content-between flex-row ml-20 p-10 py-0 " style="border-top: 1px solid #70707040;">
                                    <div class="w-50">
                                        <a class="white-text p-10 cancel" href="#">
                                            <button type="button" class="btn theme-br theme-text w-30 white-bg">Cancel</button>
                                        </a>
                                    </div>
                                    <div class="w-50 text-right">
                                        <a class="white-text p-10">
                                            <button class="btn theme-bg white-text w-30">Next</button>
                                        </a>
                                    </div>
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
