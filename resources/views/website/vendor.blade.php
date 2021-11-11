@extends('website.layouts.frame')
@section('title') Join Vendor @endsection
@section('header_title') Join as a Vendor @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="joinvendor">
        <section>
            <div class="container">
                <div class="quote responsive w-70 ontop p-4 bg-white">
                    <div class="card-body">
                        <h5 class="card-title border-bottom theme-text fw-500 pb-10">Your Details</h5>
                        <form class="form-new-order mt-2 onboard-vendor-form input-text-blue" action="{{route('add_vendor')}}" method="POST" data-next="redirect" data-redirect-type="hard" data-url="{{route('web.vendor.success')}}" data-alert="mega" data-parsley-validate>
                            <div class="row">

                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">First Name</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" name="fname" placeholder="David" required data-parsley-pattern="^[a-zA-Z]+$">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Last Name</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput2" name="lname" placeholder="Jeromi" required data-parsley-pattern="^[a-zA-Z]+$">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Email Id</label>
                                        <input type="email" class="form-control" id="formGroupExampleInput" name="email" placeholder="davidjeromi@gmail.com" required>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="phone-num-lable">Phone Number</label>
                                        <input type="text" id="phone" placeholder="9990009900" name="phone[primary]" class=" form-control form-control-tel phone" required maxlength="10" minlength="10" data-parsley-type="number">
                                        <span class="error-message">Please enter valid Phone number</span>
                                    </div>
                                </div>
                                {{--<div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="phone-num-lable">Designation</label>
                                        <select id="role" name="role" class="form-control" required>
                                            <option value="">--Select--</option>
                                            @foreach(\App\Enums\VendorEnums::$ROLES as $role=>$key)
                                                <option value="{{$key}}">{{ucwords($role)}}</option>
                                            @endforeach
                                        </select>
                                        <span class="error-message">Please enter valid Designation</span>
                                    </div>
                                </div>--}}
                            </div>
                            <h5 class="card-title border-bottom theme-text fw-500 pt-3  pb-10 mt-20">Organization Details
                            </h5>
                            <div class="row">

                                <div class="col-lg-6 col-xs-12 mt-1 pt-2">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Organization Name</label>
                                        <input type="text" class="form-control" name="organization[org_name]" id="formGroupExampleInput" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12 mt-1 pt-2">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Organization Type</label>
                                        <select class="form-control" name="organization[org_type]" required>
                                            <option>-- Select --</option>
                                            @foreach(\App\Enums\OrganizationEnums::$REGISTRATION_TYPE as $reg)
                                            <option value="{{$reg}}">{{$reg}}</option>
                                            @endforeach
                                        </select>
                                        {{--<input type="text" class="form-control" name="organization[org_type]" id="formGroupExampleInput" required>--}}
                                        <span class="error-message">Please enter valid
                                            Organisation Type</span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">GSTIN Number</label>
                                        <input type="text" class="form-control" name="organization[gstin]" maxlength="15" minlength="15" id="formGroupExampleInput" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Address</label>
                                        <input type="text" class="form-control" name="address[address]" id="formGroupExampleInput2" required>
                                    </div>
                                </div>
                                {{--<div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Address Line 2</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput2" required>
                                    </div>
                                </div>--}}
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">City </label>
                                        <input type="text" class="form-control" name="address[city]" id="formGroupExampleInput2" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">State</label>
                                        <select id="state" class="form-control" name="address[state]" required>
                                            <option value="">--Select--</option>
                                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                            <option value="Assam">Assam</option>
                                            <option value="Bihar">Bihar</option>
                                            <option value="Chandigarh">Chandigarh</option>
                                            <option value="Chhattisgarh">Chhattisgarh</option>
                                            <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                            <option value="Daman and Diu">Daman and Diu</option>
                                            <option value="Delhi">Delhi</option>
                                            <option value="Lakshadweep">Lakshadweep</option>
                                            <option value="Puducherry">Puducherry</option>
                                            <option value="Goa">Goa</option>
                                            <option value="Gujarat">Gujarat</option>
                                            <option value="Haryana">Haryana</option>
                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                            <option value="Jharkhand">Jharkhand</option>
                                            <option value="Karnataka">Karnataka</option>
                                            <option value="Kerala">Kerala</option>
                                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                                            <option value="Maharashtra">Maharashtra</option>
                                            <option value="Manipur">Manipur</option>
                                            <option value="Meghalaya">Meghalaya</option>
                                            <option value="Mizoram">Mizoram</option>
                                            <option value="Nagaland">Nagaland</option>
                                            <option value="Odisha">Odisha</option>
                                            <option value="Punjab">Punjab</option>
                                            <option value="Rajasthan">Rajasthan</option>
                                            <option value="Sikkim">Sikkim</option>
                                            <option value="Tamil Nadu">Tamil Nadu</option>
                                            <option value="Telangana">Telangana</option>
                                            <option value="Tripura">Tripura</option>
                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                            <option value="Uttarakhand">Uttarakhand</option>
                                            <option value="West Bengal">West Bengal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Pincode</label>
                                        <input type="text" class="form-control" name="address[pincode]" maxlength="6" minlength="6" id="formGroupExampleInput2" required onkeydown="return ( event.ctrlKey || event.altKey
												|| (47<event.keyCode && event.keyCode<58 && event.shiftKey==false)
												|| (95<event.keyCode && event.keyCode<106)
												|| (event.keyCode==8) || (event.keyCode==9)
												|| (event.keyCode>34 && event.keyCode<40)
												|| (event.keyCode==46) )">
                                    </div>
                                </div>
                            </div>
                            <div class="" id="comments">
                                <div class="button-bottom d-flex justify-content-between pt-4">
                                    <div class=""><a class="white-text " href="{{route('home')}}"><button type="button" class="btn btn-theme-w-bg">cancel</button></a>
                                    </div>
                                    <button class="btn btn-theme-bg  white-bg">submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade" id="Login-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
            <div class="modal-dialog theme-text input-text-blue" role="document">
                <div class="modal-content w-80 m-0-auto w-1000 mt-20 right-25" style="margin-top:20% !important">
                    <div class="modal-header p-0 br-5 ">
                        <div style="width: -webkit-fill-available;   width: 100%; width: -moz-available; width: -webkit-fill-available;  width: fill-available;">
                            <header class="join-as-vendor">
                                <img src="{{ asset('static/website/images/icons/logo.png')}}" class="img-mar" style="margin-left: 14px;" >
                                <button type="button" class="close text-white p-0" data-dismiss="modal" aria-label="Close" style="color: #FFF !important; transform: translate(-22px, 22px);">
                                    <span>                         <i class="dripicons-cross" style="font-size: 25px;"></i></span>
                                </button>
                            </header>
                        </div>
                    </div>

                    <div class="modal-body  margin-topneg-7 pt-2">
                        <form action="{{ route('website.login') }}" data-await-input="#otp" method="POST" data-next="redirect" data-redirect-type="hard" data-url='{{route('join-vendor')}}' data-alert="mega" class="form-new-order mt-1 input-text-blue" data-parsley-validate>
                            <div class="d-flex f-direction text-justify center">
                                <h2 class="p-text" style="font-size: 24px !important;">Login</h2>
                                <div class="col-lg-12 col-xs-12 mt-2 hidden-space pl-0 pr-0">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" style="color: #0F0C75 !important;">Phone Number</label>
                                        <input type="text" class="form-control phone" name="phone" id="phone" placeholder="9990009990" autocomplete="off" maxlength="10" minlength="10" required >
                                    </div>
                                </div>
                                <div class="col-lg-12  col-xs-12 mt-1 otp hidden pl-0 pr-0"   id="otp">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">OTP</label>
                                        <input type="text" class="form-control" name="otp" id="formGroupExampleInput" maxlength="6" autocomplete="off" minlength="6" placeholder="Verify OTP">
                                    </div>
                                </div>
                                {{-- <a class="weblogin" data-url="{{ route('website.login') }}">
                                <button type="button" class="btn btn-theme-bg   text-view-center mt-3 mb-4 padding-btn-res white-bg">
                                    Next
                                </button>
                                </a>--}}
                                <div class="col-md-12" style="width: 100%;">
                                    {{--                                <p class="mt-2 mb-0" style="text-align: center; color:#3B4B58; font-size:14px">Waiting for OTP</p>--}}

                                    <div class="col-12 d-flex center">
                                        <div class="form-groups">
                                            <label class="container-01 m-0">
                                                <input type="checkbox" id="Lift1" data-parsley-error-message="Please Agree to the Terms & Conditions" required/>
                                                <span class="checkmark-agree" style="height: 14px !important; width: 14px !important;top: 2px !important;"></span>
                                                <p class="text-muted f-14"> I agree to the <b style="cursor: pointer;" onclick="location.assign('{{route('terms.page', ["slug"=>"terms-and-conditions"])}}')">Terms & Conditions</b></p>
                                            </label>
                                        </div>
                                    </div>

                                    <a class="weblogin" >
                                        <button type="submit" class="btn btn-theme-bg  mt-2 mb-4 text-view-center padding-btn-res white-bg width-max login-web" style="width: -webkit-fill-available !important; ">
                                            Submit
                                        </button>
                                    </a>
                                    <!-- <p class="mt-2 " style="text-align: center; color:#3B4B58; font-size:14px">Did not receive OTP? <button class="unstyled-button login-web"><span class="theme-text bold"> Resend</span></button></p> -->
                                </div>


                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="Signup-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
            <div class="modal-dialog theme-text input-text-blue" role="document">
                <div class="modal-content w-80 m-0-auto w-1000 mt-20 right-25" style="margin-top:20% !important">
                    <div class="modal-header p-0 br-5 ">
                        <div style="width: -webkit-fill-available;   width: 100%; width: -moz-available; width: -webkit-fill-available;  width: fill-available;">
                            <header class="join-as-vendor">
                                <img src="{{ asset('static/website/images/icons/logo.png')}}" class="img-mar" style="margin-left: 14px;" >
                                <button type="button" class="close text-white p-0" onclick="location.assign('{{route('home')}}')" data-dismiss="modal" aria-label="Close" style="color: #FFF !important; transform: translate(-22px, 22px);">
                                    <span>                         <i class="dripicons-cross" style="font-size: 25px;"></i></span>
                                </button>
                            </header>
                        </div>
                    </div>

                    <div class="modal-body  margin-topneg-7 pt-2">
                        <form action="{{ route('website.signup') }}" data-await-input="#otp" method="PUT" data-next="redirect" {{--data-url="{{route('home-logged')}}"--}} data-redirect-type="hard" data-url="{{route('join-vendor')}}" data-alert="mega" class="form-new-order mt-1 input-text-blue" data-parsley-validate>
                            <div class="row">
                                <h2 class="p-text" style="font-size: 16px !important;padding-left: 130px;padding-bottom: 20px;">CREATE AN ACCOUNT</h2>
                                <div class="col-lg-6 hidden-space">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">First Name*</label>
                                        <input type="text" class="form-control" name="fname" id="fname" autocomplete="off" placeholder="John" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 hidden-space">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Last Name*</label>
                                        <input type="text" class="form-control" name="lname" id="lname" autocomplete="off" placeholder="Doe" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 hidden-space">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Email ID*</label>
                                        <input type="email" class="form-control" name="email" id="email" autocomplete="off" placeholder="example@domain.com" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 hidden-space">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Gender*</label>
                                        <select id="" class="form-control" name="gender" required>
                                            <option value="">--Select--</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="3rd gender">3rd Gender</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 hidden-space">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">Referral Code</label>
                                        <input type="text" class="form-control" name="referral_code" id="referral_code" autocomplete="off" placeholder="ABC123">
                                    </div>
                                </div>

                                <div class="col-md-12" style="width: 100%;">
                                    <div class="col-12 d-flex center">
                                        <div class="form-groups">
                                            <label class="container-01 m-0 p-0" style="margin-top: 30px !important;">
                                                <input type="checkbox" id="Lift1" data-parsley-error-message="Please Agree to the Terms & Conditions" required/>
                                                <span class="checkmark-agree" style="height: 14px !important; width: 14px !important;top: 2px !important;"></span>
                                                <p class="text-muted f-14" style="margin-left: 20px;"> I agree to the <b style="cursor: pointer;" onclick="location.assign('{{route('terms.page', ["slug"=>"terms-and-conditions"])}}')">Terms & Conditions</b></p>
                                            </label>
                                        </div>
                                    </div>

                                    <a class="weblogin" >
                                        <button type="submit" class="btn btn-theme-bg mb-5 text-view-center padding-btn-res white-bg width-max login-web" style="width: -webkit-fill-available !important; ">
                                            GET STARTED
                                        </button>
                                    </a>
                                    <!-- <p class="mt-2 " style="text-align: center; color:#3B4B58; font-size:14px">Did not receive OTP? <button class="unstyled-button login-web"><span class="theme-text bold"> Resend</span></button></p> -->
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
