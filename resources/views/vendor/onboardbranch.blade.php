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
                    <li class="breadcrumb-item"><a href="vendor-management.html"> Vendors Management</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Onboard Vendor</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="d-flex  flex-row text-left ml-120">
    </div>
    <!-- Dashboard cards -->

    <div class="d-flex flex-row justify-content-center Dashboard-lcards " style="min-height: 100vh;">
        <div class="col-lg-10">
            <div class="card  h-auto p-0 pt-10 ">
                <div class="card-head right text-left border-bottom-2 p-10 pt-10 pb-0">
                    <h3 class="f-18 mb-0">
                        <ul class="nav nav-tabs  p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link p-15" href="{{route("onboard-edit-vendors")}}">Edite Onboard Vendor</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active p-15" id="quotation" href="#">Add Branch</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" href="{{route("onboard-bank-vendors")}}"
                                >Vendor Banking Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" href="{{route("onboard-userrole-vendors")}}">Vendor Roles</a>
                            </li>
                        </ul>
                    </h3>
                </div>
                <div class="tab-content" id="myTabContent">
                        <!-- form starts -->
                    <div class="tab-pane">

                    </div>
                    <div class="d-flex  justify-content-between flex-row  p-10 py-0"
                                                style="border-top: 1px solid #70707040;">
                        <div class="w-50"> </div>
                        <div class="w-50 text-right">
                            <a class="white-text p-10 modal-toggle" data-target="#add-branch">
                                <button class="btn theme-bg white-text w-30">Add Branch</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')

    <div class="fullscreen-modal" id="add-branch">
        <div class="fullscreen-modal-body" role="document">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Branch</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="#" method="POST">
                <div class="modal-body p-15 margin-topneg-7">

                    <div class="d-flex row">
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Branch Name</label>
                                        <input type="text" id="fullname" placeholder="Wayne Packing Pvt Ltd" value=""
                                               class="form-control">
                                        <span class="error-message">Please enter valid
                                            Branch Name</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="phone-num-lable">Branch Type</label>
                                        <select id="" class="form-control">
                                            <option>Pvt Ltd</option>
                                            <option>Pub Ltd</option>
                                        </select>
                                        <span class="error-message">Please enter valid
                                            Branch Type</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="phone-num-lable"> Contact Number</label>
                                        <input type="tel" id="input-blue" placeholder="9876543210" value=""
                                               class=" form-control form-control-tel">
                                        <span class="error-message">Please enter valid
                                            Phone number</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Zone</label>
                                        <input type="text" id="fullname" placeholder="Bengaluru Urban" value=""
                                               class="form-control">
                                        <span class="error-message">Please enter valid
                                            Zone</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Address Line 1</label>
                                        <input type="text" id="fullname" placeholder="Lorem ipsum dolor sit amet, consetetur sadip"
                                               value="Lorem ipsum dolor sit amet, consetetur sadip" class="form-control">
                                        <span class="error-message">Please enter valid
                                            Address Line</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Address Line 2</label>
                                        <input type="text" id="fullname" placeholder="Lorem ipsum dolor sit amet, consetetur sadip"
                                               value="" class="form-control">
                                        <span class="error-message">Please enter valid
                                            Address Line</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Lattitude</label>
                                        <input type="text" id="fullname" placeholder="57.2046° N" value=""
                                               class="form-control">
                                        <span class="error-message">Please enter valid
                                            Lattitude</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Longitude</label>
                                        <input type="text" id="fullname" placeholder="77.7907° E" value=""
                                               class="form-control">
                                        <span class="error-message">Please enter valid
                                            Longitude</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Landmark</label>
                                        <input type="text" id="fullname" placeholder="Pheonix Market City" value=""
                                               class="form-control">
                                        <span class="error-message">Please enter valid
                                            Landmark</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">City</label>
                                        <input type="text" id="fullname" placeholder="Bengaluru" value="Bengaluru"
                                               class="form-control">
                                        <span class="error-message">Please enter valid
                                            City</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label>State</label>
                                        <select id="" class="form-control">
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
                                               class="form-control">
                                        <span class="error-message">Please enter valid
                                            Pincode</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Service Type</label>
                                        <select id="" class="form-control">
                                            <option>Economic</option>
                                            <option>Service 2</option>
                                            <option>Service 3</option>
                                        </select>
                                        <span class="error-message">Please enter valid
                                            Service</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Service</label>
                                        <select id="" class="form-control">
                                            <option>Residential</option>
                                            <option>Service 2</option>
                                            <option>Service 3</option>
                                        </select>
                                        <span class="error-message">Please enter valid
                                            Service</span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-input">
                                <label class="full-name">Branch Description</label>
                                        <textarea placeholder="Need to Include bike" style="resize: none;" id=""
                                                  class="form-control" rows="4" cols="50" spellcheck="false">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                                          </textarea>
                                        <span class="error-message">Please enter valid Description</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-15 " style="padding: 0px 5px;">
                    <div class="w-50" style="text-align: left !important;"><a class="white-text p-10" href="#" data-dismiss="modal"
                                         aria-label="Close"><button
                                class="btn theme-br theme-text w-30 white-bg">Cancel</button></a></div>
                    <div class="w-50 text-right"><a class="white-text p-10" href="#" data-dismiss="modal"
                                                    aria-label="Close"><button class="btn theme-bg white-text w-30">Save</button></a></div>
                </div>
            </form>
        </div>
    </div>
@endsection
