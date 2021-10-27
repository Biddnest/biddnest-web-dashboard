@extends('layouts.app')
@section('title') Vendor Management @endsection
@section('content')

    <!-- Main Content -->
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="createVendor">
        <div class="d-flex  flex-row justify-content-between p-10">
            <h3 class="heading1 ml-4 pl-2">Onboard Vendor</h3>

        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left p-4 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('vendors')}}"> Vendors Management</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Onboard Vendor</li>
                    </ol>
                </nav>


            </div>

        </div>
        <div class="d-flex  flex-row text-left ml-120">
            <!-- <a href="vendor-management.html" class="text-decoration-none">
                        <h3 class="page-subhead text-left p-4 f-20 theme-text">
                            <i class="p-1"> <img src="assets/images/Icon feather-chevrons-left.svg" alt=""
                                    srcset=""></i>Back to Vendors
                        </h3>
                    </a> -->

        </div>
        <!-- Dashboard cards -->


        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-lg-10">
                <div class="card  h-auto p-0 pt-10 ">

                    <div class="card-head right text-left border-bottom-2 p-10 pt-10 pb-0">
                        <h3 class="f-18 mb-0 mt-0">
                            <ul class="nav nav-tabs  p-0" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active p-15" id="new-order-tab" data-toggle="tab"
                                       href="#order" role="tab" aria-controls="home"
                                       aria-selected="true">Onboard Vendor</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="quotation" href="#">Pricing</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15 disabled" id="quotation" href="#">Branch</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15 disabled" id="quotation" href="#"
                                    >Banking Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15 disabled" id="quotation" href="#"
                                    >Actions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15 disabled" id="quotation" href="#">Roles</a>
                                </li>
                            </ul>
                        </h3>
                    </div>
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active margin-topneg-15" id="order" role="tabpanel"
                             aria-labelledby="new-order-tab">
                            <!-- form starts -->
                            <form class="form-new-order pt-4 mt-3 onboard-vendor-form input-text-blue"
                                  action="{{route('add_onvoard_vendor')}}" method="POST" data-next="redirect"
                                  data-url="{{route("onboard-base-price", ['id'=>':id'])}}" data-alert="mega"
                                  id="myForm" data-parsley-validate>

                                <div class="d-flex row p-20">
                                    <div class="col-lg-6">
                                        <p class="img-label">Image</p>
                                        <div class="upload-section p-20 pt-0">
                                            <img class="upload-preview"
                                                 src="{{asset('static/images/upload-image.svg')}}"
                                                 alt=""
                                            />
                                            <div class="ml-1">
                                                <div class="file-upload">
                                                    <input type="hidden" class="base-holder" name="image" value=""
                                                           required/>
                                                    <button type="button" class="btn theme-bg white-text my-0"
                                                            data-action="upload">
                                                        UPLOAD IMAGE
                                                    </button>
                                                    <input type="file" accept=".png,.jpg,.jpeg" required/>
                                                </div>
                                                <p class="text-black">Max File size: 1MB</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Authorizer First Name</label>
                                            <input type="text" id="fullname" placeholder="First Name"
                                                   class="form-control alphabet" name="fname" pattern="[a-zA-Z]+" required>
                                            <span class="error-message">Please enter valid
                                                                First Name</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Authorizer Last Name</label>
                                            <input type="text" id="fullname" placeholder="Last Name"
                                                   class="form-control alphabet" name="lname" pattern="[a-zA-Z]+" required>
                                            <span class="error-message">Please enter valid
                                                                Last Name</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Email ID</label>
                                            <input type="email" id="email" placeholder="abc@email.com"
                                                   class="form-control" name="email" autocomplete="off" required>
                                            <span class="error-message">Please enter valid
                                                                Email ID</span>
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="phone-num-lable">Primary Contact Number</label>
                                            <input type="text" id="phone" placeholder="9876543210"
                                                   class="form-control phone" name="phone[primary]" maxlength="10" minlength="10"
                                                   aria-valuemax="10" required>
                                            <span class="error-message">Please enter valid
                                                                Phone number</span>
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="phone-num-lable">Secondary Contact Number</label>
                                            <input type="text" id="phone-pop-up" placeholder="9876543210"
                                                   class="form-control phone" name="phone[secondory]" maxlength="10"
                                                   minlength="10" required>
                                            <span class="error-message">Please enter valid
                                                                Phone number</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Organization Name</label>
                                            <input type="text" id="fullname" placeholder="Wayne Pvt Ltd"
                                                   class="form-control" name="organization[org_name]" required>
                                            <span class="error-message">Please enter valid
                                                                Organization Name</span>
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="phone-num-lable">Organisation Type</label>
                                            {{--<input type="text" id="fullname" placeholder="Pvt Ltd"
                                                   class="form-control" name="organization[org_type]" required>--}}
                                            <select class="form-control" name="organization[org_type]">
                                                <option value="">--Select--</option>

                                                @foreach(\App\Enums\OrganizationEnums::$REGISTRATION_TYPE as $type)
                                                <option value="{{$type}}">{{$type}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-message">Please enter valid
                                                                Organization Type</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">GSTIN Number of Organisation</label>
                                            <input type="text" id="fullname" placeholder="GST12355464"
                                                   class="form-control" name="organization[gstin]" maxlength="15"
                                                   minlength="15" required>
                                            <span class="error-message">Please enter valid
                                                                Organization Name</span>
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="form-input">
                                            <label class="full-name">Organization Description</label>
                                            <textarea class="form-control" rows="4"
                                                      placeholder="Add Organization Description" spellcheck="false"
                                                      name="organization[description]" required></textarea>

                                            <!-- <textarea placeholder="Add Organization Description"
                                                 id="" class="form-control"
                                                rows="4" cols="50" spellcheck="false" name="organization[description]" required>
                                                          </textarea> -->
                                            <span class="error-message">Please enter valid
                                                                Description</span>
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Address</label>
                                            <input type="text" id="fullname" placeholder="Enter address here"
                                                   class="form-control" name="address[address]" required>
                                            <span class="error-message">Please enter valid
                                                                Address Line</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Landmark</label>
                                            <input type="text" id="fullname" placeholder="Enter Landmark here"
                                                   class="form-control" name="address[landmark]" required>
                                            <span class="error-message">Please enter valid
                                                                Landmark</span>
                                        </div>
                                    </div>

                                    {{--<div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Lattitude</label>
                                            <input type="text" id="fullname" placeholder="13.0332428"
                                                   class="form-control" name="address[lat]" required>
                                            <span class="error-message">Please enter valid
                                                                Lattitude</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Longitude</label>
                                            <input type="text" id="fullname" placeholder="80.0477609"
                                                   class="form-control" name="address[lng]" required>
                                            <span class="error-message">Please enter valid
                                                                Longitude</span>
                                        </div>
                                    </div>--}}

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Zone</label>
                                            <select class="form-control br-5" name="zone" required>
                                                <option value="">--Select--</option>
                                                @foreach(Illuminate\Support\Facades\Session::get('zones') as $zone)
                                                    <option value="{{$zone->id}}">{{$zone->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-message">Please enter valid Zone</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">State</label>
                                            <select id="state" class="form-control" name="address[state]" required>
                                                <option value="">--Select--</option>
                                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                <option value="Andaman and Nicobar Islands">Andaman and Nicobar
                                                    Islands
                                                </option>
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
                                            <span class="error-message">Please enter valid
                                                                Landmark</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">City</label>
                                            <input type="text" id="city-name" placeholder="Bengaluru"
                                                   class="form-control" name="address[city]" required>
                                            <span class="error-message">Please enter valid
                                                                City</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Pincode</label>
                                            <input type="text" id="pincode" placeholder="530000"
                                                   class="form-control number" name="address[pincode]" maxlength="6"
                                                   minlength="6" required>
                                            <span class="error-message">Please enter valid
                                                                Pincode</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Service</label>
                                            <select id="" class="form-control select-box field-toggle" name="service[]" data-target=".subservices" multiple
                                                    required>
                                                <option value=""> -Select-</option>
                                                @foreach($services as $service=>$value)
                                                    <option
                                                        value="{{$value->id}}">{{ucfirst(trans($value->name))}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-message">Please enter valid
                                                                Service</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 subservices hidden">
                                        <div class="form-input">
                                            <label class="full-name">Subservice Service</label>
                                            <select id="" class="form-control select-box" name="subservice[]" multiple
                                                    required>
                                                <option value=""> -Select-</option>
                                                @foreach($subservices as $subservice=>$subservicevalue)
                                                    <option
                                                        value="{{$subservicevalue->id}}">{{ucfirst(trans($subservicevalue->name))}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-message">Please enter valid
                                                                Service</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Service Type</label>
                                            <select id="" class="form-control" name="service_type" required>
                                                <option value=""> -Select-</option>
                                                @foreach(\App\Enums\OrganizationEnums::$SERVICES as $service_type=>$value)
                                                    <option
                                                        value="{{$value}}">{{ucfirst(trans($service_type))}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-message">Please enter valid
                                                                Service Type</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 d-none" >
                                        <div class="form-input">
                                            <label class="full-name">Commission</label>
                                            <input type="hidden" id="commission" placeholder="Commission"
                                                   class="form-control" name="commission" min="1" required value="0">
                                            <span class="error-message">Please enter valid
                                                                Commission</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Base distance in km</label>
                                            <span class="">
                                            <input type="text" name="basedist" placeholder="Distance"
                                                   class="form-control number">
                                            <span class="error-message">Please enter valid Distance</span>
                                        </span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Extra Base distance in km</label>
                                            <span class="">
                                            <input type="text" name="extrabasedist" placeholder="Extra Distance"
                                                   class="form-control number">
                                            <span class="error-message">Please enter valid Distance</span>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div id="comments">
                                    <div class="d-flex  justify-content-between flex-row  p-10 py-0 "
                                         style="border-top: 1px solid #70707040;">
                                        <div class="w-50"><a class="white-text p-10 cancel" href="{{route('vendors')}}">
                                                <button class="btn theme-br theme-text w-30 white-bg">Cancel</button>
                                            </a>
                                        </div>
                                        <div class="w-50 text-right"><a class="white-text p-10">
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
