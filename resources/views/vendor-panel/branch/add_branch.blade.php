@extends('vendor-panel.layouts.frame')
@section('title') Branches @endsection
@section('body')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="newbranch">
        <div class="d-flex  flex-row justify-content-between">
            <h3 class="page-head text-left p-4 theme-text">Create New Branch</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left p-2 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('vendor.branches')}}">Branches</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create New Branch</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-sm-10">
                <div class="card  h-auto p-0 pt-10 ">
                    <div class="new-user-form">
                        <!-- form starts -->
                        <form class="form-new-order pt-4 mt-3 onboard-vendor-form input-text-blue" action="@if($branch){{route('api.branch.edit')}}@else{{route('api.branch.add')}}@endif" data-next="redirect" data-redirect-type="hard" data-url="{{route('vendor.branches')}}" data-alert="mega" method="@if($branch){{"PUT"}}@else{{"POST"}}@endif" id="myForm" data-parsley-validate>
                            <div class="modal-body p-15 margin-topneg-7">
                                <input type="hidden" name="parent_org_id" value="{{$id}}">
                                <input type="hidden" name="id" value="@if($branch){{$branch->id}}@endif">
                                <div class="d-flex row">
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Authorizer First Name</label>
                                            <input type="text" id="fullname" placeholder="First Name"
                                                   class="form-control alphabet" name="fname" pattern="[a-zA-Z]+" required value="@if($branch && $branch->meta){{ucfirst(trans(json_decode($branch->meta, true)['auth_fname']))}}@endif">
                                            <span class="error-message">Please enter valid
                                            Organization Name</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="phone-num-lable">Authorizer Last Name</label>
                                            <input type="text" id="fullname" placeholder="Last Name"
                                                   class="form-control alphabet" name="lname" pattern="[a-zA-Z]+" required value="@if($branch && $branch->meta){{ucfirst(trans(json_decode($branch->meta, true)['auth_lname']))}}@endif">
                                            <span class="error-message">Please enter valid
                                            Organization Type</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Organization Name</label>
                                            <input type="text" id="fullname" placeholder="Wayne Packing Pvt Ltd" value="{{$organization->org_name}}"
                                                   class="form-control" name="organization[org_name]" readonly required>
                                            <span class="error-message">Please enter valid
                                            Organization Name</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="phone-num-lable">Organization Type</label>
                                            <input type="text" id="fullname" placeholder="Pvt Ltd"
                                                   class="form-control" name="organization[org_type]" value="{{$organization->org_type}}" readonly required>
                                            <span class="error-message">Please enter valid
                                            Organization Type</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Email ID</label>
                                            <input type="email" id="email" placeholder="abc@email.com"
                                                   class="form-control" name="email"  value="@if($branch){{$branch->email}}@endif" autocomplete="off" required>
                                            <span class="error-message">Please enter valid
                                                                Email ID</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="phone-num-lable"> Contact Number</label>
                                            <input type="tel" id="input-blue" placeholder="9876543210" value="@if($branch){{$branch->phone}}@endif"
                                                   class=" form-control" name="phone[primary]" maxlength="10" minlength="10" required>
                                            <span class="error-message">Please enter valid
                                            Phone number</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Cities</label>
                                            {{--<select  class="form-control br-5" name="zone" required>
                                                <option value="">--Select--</option>
                                                @foreach($zones as $zone)
                                                    <option value="{{$zone->id}}" @if($zone->id == ($branch->zone_id ?? '')) selected @endif>{{$zone->name}}</option>
                                                @endforeach
                                            </select>--}}
                                            <select id="role" name="cities[]" class="form-control select-box" multiple>
                                                <option value="">--Select--</option>
                                                @foreach($cities as $city)
                                                    <option value="{{$city->id}}"
                                                            @if($branch && $branch->cities)
                                                            @foreach($branch->cities as $admin_cities)
                                                            @if($admin_cities->city_id == $city->id) selected @endif
                                                        @endforeach
                                                        @endif
                                                    >{{$city->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-message">Please enter valid
                                            Zone</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Address</label>
                                            <input type="text" id="fullname" placeholder="Lorem ipsum dolor sit amet, consetetur sadip" value="@if($branch){{json_decode($branch->meta, true)['address']}}@endif" class="form-control" name="address[address]" required>
                                            <span class="error-message">Please enter valid
                                            Address</span>
                                        </div>
                                    </div>

                                    {{--<div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Lattitude</label>
                                            <input type="text" id="fullname" placeholder="57.2046° N" value="@if($branch){{$branch->lat}}@endif"
                                                   class="form-control" name="address[lat]" required>
                                            <span class="error-message">Please enter valid
                                            Lattitude</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Longitude</label>
                                            <input type="text" id="fullname" placeholder="77.7907° E" value="@if($branch){{$branch->lng}}@endif"
                                                   class="form-control" name="address[lng]" required>
                                            <span class="error-message">Please enter valid
                                            Longitude</span>
                                        </div>
                                    </div>--}}
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Landmark</label>
                                            <input type="text" id="fullname" placeholder="Pheonix Market City" value="@if($branch){{json_decode($branch->meta, true)['landmark']}}@endif"
                                                   class="form-control" name="address[landmark]" required>
                                            <span class="error-message">Please enter valid
                                            Landmark</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">City</label>
                                            <input type="text" id="fullname" placeholder="Bengaluru" value="@if($branch){{$branch->city}} @endif"
                                                   class="form-control" name="address[city]" required>
                                            <span class="error-message">Please enter valid
                                            City</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label>State</label>
                                            <select id="" class="form-control" name="address[state]" required>
                                                <option value="">--Select--</option>
                                                <option value="Andhra Pradesh" @if("Andhra Pradesh" == ($branch->state ?? '')) selected @endif>Andhra Pradesh</option>
                                                <option value="Andaman and Nicobar Islands" @if("Andaman and Nicobar Islands" == ($branch->state ?? '')) selected @endif>Andaman and Nicobar Islands
                                                </option>
                                                <option value="Arunachal Pradesh" @if("Arunachal Pradesh" == ($branch->state ?? '')) selected @endif>Arunachal Pradesh</option>
                                                <option value="Assam" @if("Assam" == ($branch->state ?? '')) selected @endif>Assam</option>
                                                <option value="Bihar" @if("Bihar" == ($branch->state ?? '')) selected @endif>Bihar</option>
                                                <option value="Chandigarh" @if("Chandigarh" == ($branch->state ?? '')) selected @endif>Chandigarh</option>
                                                <option value="Chhattisgarh" @if("Chhattisgarh" == ($branch->state ?? '')) selected @endif>Chhattisgarh</option>
                                                <option value="Dadar and Nagar Haveli" @if("Dadar and Nagar Haveli" == ($branch->state ?? '')) selected @endif>Dadar and Nagar Haveli</option>
                                                <option value="Daman and Diu" @if("Daman and Diu" == ($branch->state ?? '')) selected @endif>Daman and Diu</option>
                                                <option value="Delhi" @if("Delhi" == ($branch->state ?? '')) selected @endif>Delhi</option>
                                                <option value="Lakshadweep" @if("Lakshadweep" == ($branch->state ?? '')) selected @endif>Lakshadweep</option>
                                                <option value="Puducherry" @if("Puducherry" == ($branch->state ?? '')) selected @endif>Puducherry</option>
                                                <option value="Goa" @if("Goa" == ($branch->state ?? '')) selected @endif>Goa</option>
                                                <option value="Gujarat" @if("Gujarat" == ($branch->state ?? '')) selected @endif>Gujarat</option>
                                                <option value="Haryana" @if("Haryana" == ($branch->state ?? '')) selected @endif>Haryana</option>
                                                <option value="Himachal Pradesh" @if("Himachal Pradesh" == ($branch->state ?? '')) selected @endif>Himachal Pradesh</option>
                                                <option value="Jammu and Kashmir" @if("Jammu and Kashmir" == ($branch->state ?? '')) selected @endif>Jammu and Kashmir</option>
                                                <option value="Jharkhand" @if("Jharkhand" == ($branch->state ?? '')) selected @endif>Jharkhand</option>
                                                <option value="Karnataka" @if("Karnataka" == ($branch->state ?? '')) selected @endif>Karnataka</option>
                                                <option value="Kerala" @if("Kerala" == ($branch->state ?? '')) selected @endif>Kerala</option>
                                                <option value="Madhya Pradesh" @if("Madhya Pradesh" == ($branch->state ?? '')) selected @endif>Madhya Pradesh</option>
                                                <option value="Maharashtra" @if("Maharashtra" == ($branch->state ?? '')) selected @endif>Maharashtra</option>
                                                <option value="Manipur" @if("Manipur" == ($branch->state ?? '')) selected @endif>Manipur</option>
                                                <option value="Meghalaya" @if("Meghalaya" == ($branch->state ?? '')) selected @endif>Meghalaya</option>
                                                <option value="Mizoram" @if("Mizoram" == ($branch->state ?? '')) selected @endif>Mizoram</option>
                                                <option value="Nagaland" @if("Nagaland" == ($branch->state ?? '')) selected @endif>Nagaland</option>
                                                <option value="Odisha" @if("Odisha" == ($branch->state ?? '')) selected @endif>Odisha</option>
                                                <option value="Punjab" @if("Punjab" == ($branch->state ?? '')) selected @endif>Punjab</option>
                                                <option value="Rajasthan" @if("Rajasthan" == ($branch->state ?? '')) selected @endif>Rajasthan</option>
                                                <option value="Sikkim" @if("Sikkim" == ($branch->state ?? '')) selected @endif>Sikkim</option>
                                                <option value="Tamil Nadu" @if("Tamil Nadu" == ($branch->state ?? '')) selected @endif>Tamil Nadu</option>
                                                <option value="Telangana" @if("Telangana" == ($branch->state ?? '')) selected @endif>Telangana</option>
                                                <option value="Tripura" @if("Tripura" == ($branch->state ?? '')) selected @endif>Tripura</option>
                                                <option value="Uttar Pradesh" @if("Uttar Pradesh" == ($branch->state ?? '')) selected @endif>Uttar Pradesh</option>
                                                <option value="Uttarakhand" @if("Uttarakhand" == ($branch->state ?? '')) selected @endif>Uttarakhand</option>
                                                <option value="West Bengal" @if("West Bengal" == ($branch->state ?? '')) selected @endif>West Bengal</option>
                                            </select>
                                            <span class="error-message">Please enter valid</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Pincode</label>
                                            <input type="text" id="fullname" placeholder="560097" value="@if($branch){{$branch->pincode}}@endif"
                                                   class="form-control" name="address[pincode]" required>
                                            <span class="error-message">Please enter valid
                                            Pincode</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Service Type</label>
                                            <select id="" class="form-control" name="service_type" required>
                                                <option value=""> -Select- </option>
                                                @foreach(\App\Enums\OrganizationEnums::$SERVICES as $service_type=>$value)
                                                    <option value="{{$value}}" @if($value == ($branch->service_type ?? '')) selected @endif>{{ucfirst(trans($service_type))}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-message">Please enter valid
                                                                Service Type</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Service</label>
                                            <select id="" class="form-control select-box" name="service[]" multiple required>
                                                <option value=""> -Select- </option>
                                                @foreach($services as $service)
                                                    <option value="{{$service->id}}"
                                                            @if($branch && $branch->services)
                                                            @foreach($branch->services as $org_service)
                                                            @if($service->id == $org_service->id) selected                                                                 @endif
                                                        @endforeach @endif>{{ucfirst(trans($service->name))}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-message">Please enter valid
                                                                Service</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Base distance in km</label>
                                            <span class="">
                                            <input type="text" name="basedist" placeholder="Distance"
                                                   class="form-control number" value="{{$organization->base_distance}}" required>
                                            <span class="error-message">Please enter valid Distance</span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Extra Base distance in km</label>
                                            <span class="">
                                            <input type="text" name="extrabasedist" placeholder="Extra Distance"
                                                   class="form-control number" required value="{{$organization->additional_distance}}">
                                            <span class="error-message">Please enter valid Distance</span>
                                            </span>
                                        </div>
                                    </div>
                                    @if($branch && ($branch->ticket_status == CommonEnums::$YES))
                                        <div class="col-lg-6">
                                            <div class="form-input">
                                                <label class="full-name">Status</label>
                                                @foreach(OrganizationEnums::$STATUS as $status=>$key)
                                                    <option value="{{$key}}" @if($branch && ($branch->status == $org_service->id)) selected @endif>{{ucfirst(trans($status))}}</option>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-lg-12">
                                        <div class="form-input">
                                            <label class="full-name">Branch Description</label>
                                            <textarea placeholder="Need to Include bike" style="resize: none;" id=""
                                                      class="form-control" rows="4" cols="50" spellcheck="false" name="organization[description]" required>@if($branch){{json_decode($branch->meta, true)['org_description']}}@endif
                                          </textarea>
                                            <span class="error-message">Please enter valid Description</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer p-15 " style="padding: 0px 5px;">
                                <div class="w-50" style="text-align: left !important;"><a class="white-text p-10 cancel" href="{{route('vendor.managerusermgt', ['type'=>"admin"])}}" data-dismiss="modal"
                                                                                          aria-label="Close"><button
                                            class="btn theme-br theme-text w-30 white-bg">Cancel</button></a></div>
                                <div class="w-50 text-right"><a class="white-text p-10" href="#" data-dismiss="modal"
                                                                aria-label="Close"><button class="btn theme-bg white-text w-30">Save</button></a></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
