@extends('layouts.app')
@section('title') Vendor Management @endsection
@section('content')

<!-- Main Content -->
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createbranch">

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
            <a class="modal-toggle" data-toggle="modal" data-target="#add-branch">
                <button class="btn theme-bg white-text w-10">Add Branch</button>
            </a>
        </div>
    </div>
    <!-- Dashboard cards -->

    <div class="d-flex flex-row justify-content-center Dashboard-lcards " style="min-height: 100vh;">
        <div class="col-lg-10">
            <div class="card  h-auto p-0 pt-10 ">
                <div class="card-head right text-left border-bottom-2 p-10 pt-10 pb-0">
                    <h3 class="f-18 mb-0">
                        <ul class="nav nav-tabs  p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link p-15" href="{{route("onboard-edit-vendors", ['id'=>$id])}}">Edit Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" href="{{route("onboard-base-price", ['id'=>$id])}}"
                                >Pricing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active p-15" id="quotation" href="#">Branch</a>
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
                <div class="tab-content " id="myTabContent">
                        <!-- form starts -->
                        <div class="w-100">
                            <div class="tab-pane show" style="min-height: 50vh">
                                @if(count($branches) == 0)
                                    <div class="row hide-on-data">
                                        <div class="col-md-12 text-center p-20">
                                            <p class="font14"><i>. You dont have any Branches here. <br />Add a Barnches to get started.</i></p>
                                        </div></div>
                                @endif
                                @foreach($branches as $branch=>$value)
                                <div class="branch-wrapper barnch_{{$value->id}}">
                                    <div class="branch-snip d-flex flex-row justify-content-around">
                                        <div class="data-group border-right">
                                            <h3 style="font-size: 18px;">Branch Name</h3>
                                            <p>{{ucfirst(trans($value->city))}}</p>
                                        </div>
                                        <div class="data-group border-right">
                                            <h3 style="font-size: 18px;">Address</h3>
                                            <p>{{json_decode($value->meta, true)['address']}} {{ucfirst(trans($value->city))}}, {{$value->pincode}}</p>
                                        </div>
                                        <div class="data-group border-right">
                                            <h3 style="font-size: 18px;">Phone</h3>
                                            <p>{{$value->phone}}</p>
                                        </div>
                                        <div class="data-group border-right">
                                            <h3 style="font-size: 18px;">City</h3>
                                            <p>{{ucfirst(trans($value->city))}}</p>
                                        </div>
                                        <div class="data-group">
                                            <div class="d-flex flex-column justify-content-center">
                                                <div>
                                                    <a href="#" class="modal-toggle inline-icon-button" data-target="#branch_{{$value->id}}"><i class="icon dripicons-pencil"></i></a>
                                                    <a href="#" class="delete inline-icon-button" data-parent=".barnch_{{$value->id}}" data-confirm="Are you sure, you want delete this Barnch permenently? You won't be able to undo this."  data-url="{{route('delete_branch', ["parent_id"=>$id, "organization_id"=>$value->id])}}"><i class="icon dripicons-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="d-flex  justify-content-between flex-row  p-10 py-0"
                                 style="border-top: 1px solid #70707040;">
                        </div>
                        <div class="w-100 text-right">

                        </div>
                    </div>
                </div>
                <div class="d-flex  justify-content-between flex-row  p-10 py-0" style="border-top: 1px solid #70707040;">
                    <div class="w-50"><a class="white-text p-10" href="{{route("onboard-base-price", ['id'=>$id])}}">
                            <button class="btn theme-br theme-text w-30 white-bg">Back</button></a>
                    </div>
                    <div class="w-50 text-right">
                        <a class="white-text p-10" href="{{route("onboard-bank-vendors", ['id'=>$id])}}">
                            <button type="button" class="btn theme-bg theme-text w-30 white-bg">Next</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fullscreen-modal" id="add-branch">
        <div class="fullscreen-modal-body" role="document">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Branch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-new-order pt-4 mt-3 onboard-vendor-branch input-text-blue" action="{{route('add_branch_vendor')}}" data-next="redirect" data-redirect-type="hard" data-url="{{route('onboard-branch-vendors', ['id'=>$id])}}" data-alert="mega" method="POST" id="myForm" data-parsley-validate>
                <div class="modal-body p-15 margin-topneg-7">
                    <input type="hidden" name="id" value="{{$id}}">
                    <div class="d-flex row">

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
                                <input type="text" id="fullname" placeholder="Wayne Packing Pvt Ltd" value="{{$organization->org_name}}"
                                       class="form-control" name="organization[org_name]" required>
                                <span class="error-message">Please enter valid
                                            Organization Name</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="phone-num-lable">Organization Type</label>
                                <select class="form-control" name="organization[org_type]" required>
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
                                <label class="phone-num-lable"> Contact Number</label>
                                <input type="tel" id="input-blue" placeholder="9876543210" value=""
                                       class=" form-control phone" name="phone[primary]" maxlength="10" minlength="10" required>
                                <span class="error-message">Please enter valid
                                            Phone number</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Zone</label>
                                <select  class="form-control br-5" name="zone" required>
                                    <option value="">--Select--</option>
                                    @foreach(Illuminate\Support\Facades\Session::get('zones') as $zone)
                                        <option value="{{$zone->id}}">{{$zone->name}}</option>
                                    @endforeach
                                </select>
                                <span class="error-message">Please enter valid
                                            Zone</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Address</label>
                                <input type="text" id="fullname" placeholder="Lorem ipsum dolor sit amet, consetetur sadip" value="" class="form-control" name="address[address]" required>
                                <span class="error-message">Please enter valid
                                            Address</span>
                            </div>
                        </div>

                        {{--<div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Lattitude</label>
                                <input type="text" id="fullname" placeholder="57.2046° N" value=""
                                       class="form-control" name="address[lat]" required>
                                <span class="error-message">Please enter valid
                                            Lattitude</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Longitude</label>
                                <input type="text" id="fullname" placeholder="77.7907° E" value=""
                                       class="form-control" name="address[lng]" required>
                                <span class="error-message">Please enter valid
                                            Longitude</span>
                            </div>
                        </div>--}}
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Landmark</label>
                                <input type="text" id="fullname" placeholder="Pheonix Market City" value=""
                                       class="form-control" name="address[landmark]" required>
                                <span class="error-message">Please enter valid
                                            Landmark</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">City</label>
                                <input type="text" id="fullname" placeholder="Bengaluru" value=""
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
                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands
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
                                    <option value="Karnataka" selected>Karnataka</option>
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
                                <span class="error-message">Please enter valid</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Pincode</label>
                                <input type="text" id="fullname" placeholder="560097" value=""
                                       class="form-control number" name="address[pincode]" maxlength="6"
                                       minlength="6" required>
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
                                        <option value="{{$value}}">{{ucfirst(trans($service_type))}}</option>
                                    @endforeach
                                </select>
                                <span class="error-message">Please enter valid
                                                                Service Type</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Service</label>
                                <select id="" class="form-control select-box field-toggle" name="service[]" data-target=".subservices" multiple
                                        required>
                                    <option value=""> -Select-</option>
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}">{{ucfirst(trans($service->name))}}</option>
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
                        <div class="col-lg-12">
                            <div class="form-input">
                                <label class="full-name">Branch Description</label>
                                <textarea placeholder="Need to Include bike" style="resize: none;" id=""
                                          class="form-control" rows="4" cols="50" spellcheck="false" name="organization[description]" required>
                                          </textarea>
                                <span class="error-message">Please enter valid Description</span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer p-15 " style="padding: 0px 5px;">
                    <div class="w-50" style="text-align: left !important;">
                        <a class="white-text p-10 cancel" href="#" data-dismiss="modal" aria-label="Close">
                            <button type="button" class="btn theme-br theme-text w-30 white-bg">Cancel</button>
                        </a>
                    </div>
                    <div class="w-50 text-right">
                        <a class="white-text p-10" href="#" data-dismiss="modal" aria-label="Close">
                            <button class="btn theme-bg white-text w-30">Save</button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @foreach($branches as $branch)
        <div class="fullscreen-modal" id="branch_{{$branch->id}}">
            <div class="fullscreen-modal-body" role="document">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Branch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form-new-order pt-4 mt-3 onboard-vendor-form input-text-blue" action="{{route('edit_branch_vendor')}}" data-next="redirect" data-redirect-type="hard" data-url="{{route('onboard-branch-vendors', ['id'=>$id])}}" data-alert="mega" method="PUT" id="myForm" data-parsley-validate>
                    <div class="modal-body p-15 margin-topneg-7">
                        <input type="hidden" name="parent_org_id" value="{{$id}}">
                        <input type="hidden" name="id" value="{{$branch->id}}">
                        <div class="d-flex row">
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Authorizer First Name</label>
                                    <input type="text" id="fullname" placeholder="First Name"
                                           class="form-control alphabet" name="fname" pattern="[a-zA-Z]+" required value="{{ucfirst(trans(json_decode($branch->meta, true)['auth_fname'])) ?? ''}}">
                                    <span class="error-message">Please enter valid
                                                                First Name</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Authorizer Last Name</label>
                                    <input type="text" id="fullname" placeholder="Last Name"
                                           class="form-control alphabet" name="lname" pattern="[a-zA-Z]+" required value="{{ucfirst(trans(json_decode($branch->meta, true)['auth_lname'])) ?? ''}}">
                                    <span class="error-message">Please enter valid
                                                                Last Name</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Email ID</label>
                                    <input type="email" id="email" placeholder="abc@email.com"
                                           class="form-control" name="email" autocomplete="off" required value="{{$branch->email}}">
                                    <span class="error-message">Please enter valid
                                                                Email ID</span>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="phone-num-lable">Primary Contact Number</label>
                                    <input type="text" id="phone" placeholder="9876543210"
                                           class="form-control phone" name="phone[primary]" maxlength="10" minlength="10"
                                           aria-valuemax="10" required value="{{$branch->phone}}">
                                    <span class="error-message">Please enter valid
                                                                Phone number</span>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="phone-num-lable">Secondary Contact Number</label>
                                    <input type="text" id="phone-pop-up" placeholder="9876543210"
                                           class="form-control phone" name="phone[secondory]" maxlength="10"
                                           minlength="10" required value="{{json_decode($branch->meta, true)['secondory_phone'] ?? ''}}">
                                    <span class="error-message">Please enter valid
                                                                Phone number</span>
                                </div>
                            </div>
                            <div class="col-lg-6">



                                <div class="form-input">
                                    <label class="full-name">Organization Name</label>
                                    <input type="text" id="fullname" placeholder="Wayne Packing Pvt Ltd" value="{{$organization->org_name}}"
                                           class="form-control" name="organization[org_name]" required readonly>
                                    <span class="error-message">Please enter valid
                                            Organization Name</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="phone-num-lable">Organization Type</label>
                                    <select class="form-control" name="organization[org_type]" required>
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
                                    <label class="phone-num-lable"> Contact Number</label>
                                    <input type="tel" id="input-blue" placeholder="9876543210" value="{{$branch->phone}}"
                                           class="form-control phone" name="phone[primary]" maxlength="10" minlength="10" required>
                                    <span class="error-message">Please enter valid
                                            Phone number</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Zone</label>
                                    <select  class="form-control br-5" name="zone" required>
                                        <option value="">--Select--</option>
                                        @foreach(Illuminate\Support\Facades\Session::get('zones') as $zone)
                                            <option value="{{$zone->id}}" @if($zone->id == ($branch->zone_id ?? '')) selected @endif>{{$zone->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="error-message">Please enter valid
                                            Zone</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Address</label>
                                    <input type="text" id="fullname" placeholder="Lorem ipsum dolor sit amet, consetetur sadip" value="{{json_decode($branch->meta, true)['address']}}" class="form-control" name="address[address]" required>
                                    <span class="error-message">Please enter valid
                                            Address</span>
                                </div>
                            </div>

                            {{--<div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Lattitude</label>
                                    <input type="text" id="fullname" placeholder="57.2046° N" value="{{$branch->lat}}"
                                           class="form-control" name="address[lat]" required>
                                    <span class="error-message">Please enter valid
                                            Lattitude</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Longitude</label>
                                    <input type="text" id="fullname" placeholder="77.7907° E" value="{{$branch->lng}}"
                                           class="form-control" name="address[lng]" required>
                                    <span class="error-message">Please enter valid
                                            Longitude</span>
                                </div>
                            </div>--}}
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Landmark</label>
                                    <input type="text" id="fullname" placeholder="Pheonix Market City" value="{{json_decode($branch->meta, true)['landmark']}}"
                                           class="form-control" name="address[landmark]" required>
                                    <span class="error-message">Please enter valid
                                            Landmark</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">City</label>
                                    <input type="text" id="fullname" placeholder="Bengaluru" value="{{$branch->city}}"
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
                                    <input type="text" id="fullname" placeholder="560097" value="{{$branch->pincode}}"
                                           class="form-control number" maxlength="6" minlength="6" name="address[pincode]" required>
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
                                                    @foreach($branch->services as $org_service)
                                                    @if($service->id == $org_service->id) selected                                                                 @endif
                                                @endforeach>{{ucfirst(trans($service->name))}}</option>
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
                                                   class="form-control number" value="{{$branch->base_distance}}" required>
                                            <span class="error-message">Please enter valid Distance</span>
                                        </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Extra Base distance in km</label>
                                    <span class="">
                                            <input type="text" name="extrabasedist" placeholder="Extra Distance"
                                                   class="form-control number" required value="{{$branch->additional_distance}}">
                                            <span class="error-message">Please enter valid Distance</span>
                                            </span>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-input">
                                    <label class="full-name">Branch Description</label>
                                    <textarea placeholder="Need to Include bike" style="resize: none;" id=""
                                              class="form-control" rows="4" cols="50" spellcheck="false" name="organization[description]" required>{{json_decode($branch->meta, true)['org_description']}}
                                          </textarea>
                                    <span class="error-message">Please enter valid Description</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer p-15 " style="padding: 0px 5px;">
                        <div class="w-50" style="text-align: left !important;">
                            <a class="white-text p-10 cancel" href="#" data-dismiss="modal" aria-label="Close">
                                <button type="button" class="btn theme-br theme-text w-30 white-bg" >Cancel</button>
                            </a>
                        </div>
                        <div class="w-50 text-right">
                            <a class="white-text p-10" href="#">
                                <button class="btn theme-bg white-text w-30" data-dismiss="modal" aria-label="Close">Update</button>
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
