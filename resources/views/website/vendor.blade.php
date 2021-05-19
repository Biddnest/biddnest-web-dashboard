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
                        <form class="form-new-order pt-4 mt-3 onboard-vendor-form input-text-blue" action="{{route('add_vendor')}}" method="POST" data-next="redirect" data-url="{{route('home')}}" data-alert="mega" data-parsley-validate>
                            <div class="row">

                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput">First Name</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" name="fname" placeholder="David" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput2">Last Name</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput2" name="lname" placeholder="Jeromi" required>
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
                                        <input type="number" id="phone" placeholder="9990009900" name="phone[primary]" class=" form-control form-control-tel" maxlength="10" minlength="10" required>
                                        <span class="error-message">Please enter valid Phone number</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
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
                                </div>
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
                                        <input type="text" class="form-control" name="organization[org_type]" id="formGroupExampleInput" required>
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
                                        <input type="number" class="form-control" name="address[pincode]" maxlength="6" minlength="6" id="formGroupExampleInput2" required>
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
    </div>

@endsection
