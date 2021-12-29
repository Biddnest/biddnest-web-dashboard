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
        <div class="d-flex flex-row text-left ml-120">
            <a href="{{route('vendors')}}" class="text-decoration-none">
                <h3 class="page-subhead text-left f-18" style="margin-top: 10px; !important; color: #2e0789;">
                    <i class="p-1">
                        <img src="{{asset('static/images/Icon feather-chevrons-left.svg')}}" alt="" srcset="">
                    </i> Back to Vendors
                </h3>
            </a>
        </div>
        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-lg-10">
                <div class="card  h-auto p-0 pt-10 ">
                    <div class="card-head right text-left border-bottom-2 p-10 pt-10 pb-0">
                        <h3 class="f-18 mb-0">
                            <ul class="nav nav-tabs  p-0" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active p-15" id="new-order-tab" data-toggle="tab"
                                       href="#order" role="tab" aria-controls="home"
                                       aria-selected="true">Edit Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="quotation" href="{{route("onboard-base-price", ['id'=>$id])}}"
                                    >Pricing</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="quotation" href="{{route("onboard-branch-vendors", ['id'=>$id])}}">Branch</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="quotation" href="{{route("onboard-bank-vendors", ['id'=>$id])}}"
                                    >Banking Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="quotation" href="{{route("onboard-action", ['id'=>$id])}}"
                                    >Actions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="quotation" href="{{route("onboard-userrole-vendors", ['id'=>$id])}}">Roles</a>
                                </li>
                            </ul>
                        </h3>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active margin-topneg-15" id="order" role="tabpanel"
                             aria-labelledby="new-order-tab">
                            <!-- form starts -->
                            <form class="form-new-order pt-4 mt-3 input-text-blue" action="{{route('edit_onvoard_vendor')}}" data-alert="mega" method="PUT" data-next="redirect" data-url="{{route('onboard-branch-vendors', ['id'=>$organization->id])}}" id="myForm" data-parsley-validate>

                                <div class="d-flex row p-20">
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <p class="img-label">Image</p>
                                            <div class="upload-section p-20 pt-0">
                                                <img class="upload-preview" src="{{$organization->image}}" alt="">
                                                <div class="ml-1">
                                                    <!-- <button class="btn theme-bg white-text my-0">UPLOAD IMAGE</button> -->
                                                    <div class="file-upload">
                                                        <input type="hidden" class="base-holder" name="image" value="{{$organization->image}}" required />
                                                        <button type="button" class="btn theme-bg white-text my-0" data-action="upload">UPLOAD IMAGE</button>
                                                        <input type="file" accept=".png,.jpg,.jpeg" />
                                                    </div>
                                                    <p>Max File size: 1MB</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="hidden" name="id" value="{{$id}}">
                                        <input type="hidden" name="vendor_id" value="{{$organization->admin->id}}">
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Authorizer First Name</label>
                                            <input type="text" id="fullname" name="fname" placeholder="David" value="{{ucfirst(trans(json_decode($organization->meta, true)['auth_fname'])) ?? ''}}" class="form-control alpha" required>
                                            <span class="error-message">Please enter valid First Name</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Authorizer Last Name</label>
                                            <input type="text" id="fullname" name="lname" placeholder="Jerome" value="{{ucfirst(trans(json_decode($organization->meta, true)['auth_lname'])) ?? ''}}" class="form-control alpha" required>
                                            <span class="error-message">Please enter valid Last Name</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Email ID</label>
                                            <input type="email" id="fullname" name="email" placeholder="abc@email.com" value="{{$organization->email}}" class="form-control" required>
                                            <span class="error-message">Please enter valid Email ID</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="phone-num-lable">Primary Contact Number</label>
                                            <input type="tel" id="phone" placeholder="9876543210" name="phone[primary]" value="{{$organization->phone}}" class=" form-control phone" maxlength="10" minlength="10" required>
                                            <span class="error-message">Please enter valid Phone number</span>
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="phone-num-lable">Secondary Contact Number</label>
                                            <input type="tel" id="phone-pop-up" value="{{json_decode($organization->meta, true)['secondory_phone'] ?? ''}}" placeholder="9876543210" class="form-control phone" name="phone[secondory]" maxlength="10" minlength="10" required>
                                            <span class="error-message">Please enter valid Phone number</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Organization Name</label>
                                            <input type="text" id="fullname" value="{{ucfirst(trans($organization->org_name))}}" placeholder="Wayne Pvt Ltd" class="form-control" name="organization[org_name]" data-parsley-type="alphanum" required>
                                            <span class="error-message">Please enter valid Organization Name</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="phone-num-lable">Organisation Type</label>
                                            <input type="text" id="fullname" placeholder="Pvt Ltd"
                                                   class="form-control" name="organization[org_type]" value="{{$organization->org_type}}" required>
                                            <span class="error-message">Please enter valid
                                                                Organization Type</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">GSTIN Number of Organisation</label>
                                            <input type="text" id="fullname" value="{{json_decode($organization->meta, true)['gstin_no'] ?? ''}}" placeholder="GST12355464" class="form-control" name="organization[gstin]" maxlength="15" minlength="15" data-parsley-type="alphanum" required>
                                            <span class="error-message">Please enter valid GST Name</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Register/License Number of Organisation</label>
                                            <input type="text" id="fullname" value="{{json_decode($organization->meta, true)['register_no'] ?? ''}}" placeholder="L21091KA2019OPC141331" class="form-control" name="organization[regi_no]" data-parsley-type="alphanum" maxlength="21" minlength="21" required>
                                            <span class="error-message">Please enter valid Register/License Number</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-input">
                                            <label class="full-name">Organization Description</label>
                                            <textarea placeholder="Need to Include bike" style="resize: none;" id="" class="form-control " rows="4" cols="50" spellcheck="false" name="organization[description]" required>{!! json_decode($organization->meta, true)['org_description'] ?? '' !!}</textarea>
                                            <span class="error-message">Please enter valid Description</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Address</label>
                                            <input type="text" id="fullname" value="{{json_decode($organization->meta, true)['address'] ?? ''}}" placeholder="Enter address here" class="form-control" name="address[address]" required>
                                            <span class="error-message">Please enter valid Address Line</span>
                                        </div>
                                    </div>

                                   {{-- <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Lattitude</label>
                                            <input type="text" id="fullname" value="{{$organization->lat}}" placeholder="Lattitude" class="form-control" name="address[lat]" required>
                                            <span class="error-message">Please enter valid Lattitude</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Longitude</label>
                                            <input type="text" id="fullname" value="{{$organization->lng}}" placeholder="Longitude" class="form-control" name="address[lng]" required>
                                            <span class="error-message">Please enter valid Longitude</span>
                                        </div>
                                    </div>--}}

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Landmark</label>
                                            <input type="text" id="fullname" value="{{json_decode($organization->meta, true)['landmark'] ?? ''}}" placeholder="Enter Landmark here" class="form-control" name="address[landmark]" required>
                                            <span class="error-message">Please enter valid Landmark</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Zone</label>
                                            <select id="role" name="cities[]" class="form-control select-box" multiple>
                                                <option value="">--Select--</option>
                                                @foreach(Illuminate\Support\Facades\Session::get('cities') as $city)
                                                    <option value="{{$city->id}}"
                                                            @if($organization && $organization->cities)
                                                            @foreach($organization->cities as $admin_cities)
                                                            @if($admin_cities->city_id == $city->id) selected @endif
                                                        @endforeach
                                                        @endif
                                                    >{{$city->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-message">Please enter valid Zone</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">State</label>
                                            <select id="" class="form-control" name="address[state]" required>
                                                <option value="">--Select--</option>
                                                <option value="Andhra Pradesh" @if("Andhra Pradesh" == ($organization->state ?? '')) selected @endif>Andhra Pradesh</option>
                                                <option value="Andaman and Nicobar Islands" @if("Andaman and Nicobar Islands" == ($organization->state ?? '')) selected @endif>Andaman and Nicobar Islands
                                                </option>
                                                <option value="Arunachal Pradesh" @if("Arunachal Pradesh" == ($organization->state ?? '')) selected @endif>Arunachal Pradesh</option>
                                                <option value="Assam" @if("Assam" == ($organization->state ?? '')) selected @endif>Assam</option>
                                                <option value="Bihar" @if("Bihar" == ($organization->state ?? '')) selected @endif>Bihar</option>
                                                <option value="Chandigarh" @if("Chandigarh" == ($organization->state ?? '')) selected @endif>Chandigarh</option>
                                                <option value="Chhattisgarh" @if("Chhattisgarh" == ($organization->state ?? '')) selected @endif>Chhattisgarh</option>
                                                <option value="Dadar and Nagar Haveli" @if("Dadar and Nagar Haveli" == ($organization->state ?? '')) selected @endif>Dadar and Nagar Haveli</option>
                                                <option value="Daman and Diu" @if("Daman and Diu" == ($organization->state ?? '')) selected @endif>Daman and Diu</option>
                                                <option value="Delhi" @if("Delhi" == ($organization->state ?? '')) selected @endif>Delhi</option>
                                                <option value="Lakshadweep" @if("Lakshadweep" == ($organization->state ?? '')) selected @endif>Lakshadweep</option>
                                                <option value="Puducherry" @if("Puducherry" == ($organization->state ?? '')) selected @endif>Puducherry</option>
                                                <option value="Goa" @if("Goa" == ($organization->state ?? '')) selected @endif>Goa</option>
                                                <option value="Gujarat" @if("Gujarat" == ($organization->state ?? '')) selected @endif>Gujarat</option>
                                                <option value="Haryana" @if("Haryana" == ($organization->state ?? '')) selected @endif>Haryana</option>
                                                <option value="Himachal Pradesh" @if("Himachal Pradesh" == ($organization->state ?? '')) selected @endif>Himachal Pradesh</option>
                                                <option value="Jammu and Kashmir" @if("Jammu and Kashmir" == ($organization->state ?? '')) selected @endif>Jammu and Kashmir</option>
                                                <option value="Jharkhand" @if("Jharkhand" == ($organization->state ?? '')) selected @endif>Jharkhand</option>
                                                <option value="Karnataka" @if("Karnataka" == ($organization->state ?? '')) selected @endif>Karnataka</option>
                                                <option value="Kerala" @if("Kerala" == ($organization->state ?? '')) selected @endif>Kerala</option>
                                                <option value="Madhya Pradesh" @if("Madhya Pradesh" == ($organization->state ?? '')) selected @endif>Madhya Pradesh</option>
                                                <option value="Maharashtra" @if("Maharashtra" == ($organization->state ?? '')) selected @endif>Maharashtra</option>
                                                <option value="Manipur" @if("Manipur" == ($organization->state ?? '')) selected @endif>Manipur</option>
                                                <option value="Meghalaya" @if("Meghalaya" == ($organization->state ?? '')) selected @endif>Meghalaya</option>
                                                <option value="Mizoram" @if("Mizoram" == ($organization->state ?? '')) selected @endif>Mizoram</option>
                                                <option value="Nagaland" @if("Nagaland" == ($organization->state ?? '')) selected @endif>Nagaland</option>
                                                <option value="Odisha" @if("Odisha" == ($organization->state ?? '')) selected @endif>Odisha</option>
                                                <option value="Punjab" @if("Punjab" == ($organization->state ?? '')) selected @endif>Punjab</option>
                                                <option value="Rajasthan" @if("Rajasthan" == ($organization->state ?? '')) selected @endif>Rajasthan</option>
                                                <option value="Sikkim" @if("Sikkim" == ($organization->state ?? '')) selected @endif>Sikkim</option>
                                                <option value="Tamil Nadu" @if("Tamil Nadu" == ($organization->state ?? '')) selected @endif>Tamil Nadu</option>
                                                <option value="Telangana" @if("Telangana" == ($organization->state ?? '')) selected @endif>Telangana</option>
                                                <option value="Tripura" @if("Tripura" == ($organization->state ?? '')) selected @endif>Tripura</option>
                                                <option value="Uttar Pradesh" @if("Uttar Pradesh" == ($organization->state ?? '')) selected @endif>Uttar Pradesh</option>
                                                <option value="Uttarakhand" @if("Uttarakhand" == ($organization->state ?? '')) selected @endif>Uttarakhand</option>
                                                <option value="West Bengal" @if("West Bengal" == ($organization->state ?? '')) selected @endif>West Bengal</option>
                                            </select>
                                            <span class="error-message">Please enter valid Landmark</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">City</label>
                                            <input type="text" id="fullname" placeholder="Bengaluru" value="{{ucfirst(trans($organization->city))}}" class="form-control" name="address[city]" required>
                                            <span class="error-message">Please enter valid Zone</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Pincode</label>
                                            <input type="text" id="fullname" value="{{$organization->pincode}}" placeholder="530000" class="form-control number" name="address[pincode]" maxlength="6" minlength="6" required>
                                            <span class="error-message">Please enter valid Pincode</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Service</label>
                                            <select id="" class="form-control select-box" name="service[]" multiple required>
                                                <option value=""> -Select- </option>
                                                @foreach($services as $service)
                                                    <option value="{{$service->id}}"
                                                            @foreach($organization->services as $org_service)
                                                            @if($service->id == $org_service->id) selected                                                                 @endif
                                                        @endforeach>{{ucfirst(trans($service->name))}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-message">Please enter valid Service</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Service Type</label>
                                            <select id="" class="form-control" name="service_type" required>
                                                <option value=""> -Select- </option>
                                                @foreach(\App\Enums\OrganizationEnums::$SERVICES as $service_type=>$value)
                                                    <option value="{{$value}}" @if($value == ($organization->service_type ?? '')) selected @endif>{{ucfirst(trans($service_type))}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-message">Please enter valid Service</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Base distance in km</label>
                                            <span class="">
                                            <input type="text" name="basedist" placeholder="Distance" value="{{$organization->base_distance}}"
                                                   class="form-control number" required>
                                            <span class="error-message">Please enter valid Distance</span>
                                        </span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Extra Base distance in km</label>
                                            <span class="">
                                            <input type="text" name="extrabasedist" placeholder="Extra Distance" value="{{$organization->additional_distance}}"
                                                   class="form-control number" required>
                                            <span class="error-message">Please enter valid Distance</span>
                                        </span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Commission</label>
                                            <input type="text" id="commission" value="{{$organization->commission}}" placeholder="Commission" class="form-control" name="commission" required>
                                            <span class="error-message">Please enter valid Commission</span>
                                        </div>
                                    </div>

                                </div>
                                <div id="comments">
                                    <div class="d-flex  justify-content-between flex-row  p-10 py-0 "
                                         style="border-top: 1px solid #70707040;">
                                        <div class="w-50"><a class="white-text p-10 cancel" href="{{route('vendors')}}"><button
                                                    class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>
                                        </div>
                                        <div class="w-50 text-right">
                                            <button class="btn theme-bg white-text w-30">Update</button>
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
