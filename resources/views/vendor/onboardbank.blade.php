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
    </div>
    <!-- Dashboard cards -->

    <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
        <div class="col-lg-10">
            <div class="card  h-auto p-0 pt-10 ">
                <div class="card-head right text-left border-bottom-2 p-10 pt-10 pb-0">
                    <h3 class="f-18 mb-0">
                        <ul class="nav nav-tabs  p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link p-15" href="{{route("onboard-edit-vendors",['id'=> $id])}}">Edite Onboard Vendor</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" href="{{route("onboard-branch-vendors",['id'=> $id])}}">Add Branch</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active p-15" id="quotation" href="#">Vendor Banking Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" href="{{route("onboard-userrole-vendors",['id'=> $id])}}">Vendor Roles</a>
                            </li>
                        </ul>
                    </h3>
                </div>

                <div class="tab-content" id="myTabContent">
                    <form class="form-new-order input-text-blue" action="{{route('bank_add')}}" data-alert="mega" method="POST" data-next="redirect" data-url="{{route('onboard-userrole-vendors', ['id'=>$id])}}" data-parsley-validate>
                        <input type="hidden" name="bank_id" value="{{$bank->id ?? ''}}">
                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="row p-20">
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Account Number </label>
                                    <input type="text" id="fullname" placeholder="BANK123456" value="@if($bank) {{ json_decode($bank->banking_details, true)['account_no']}}@endif" name="acc_no" class="form-control">
                                    <span class="error-message">Please enter valid Account Number</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Bank Name </label>
                                    <input type="text" id="fullname" placeholder="ICICI Bank" value="@if($bank) {{json_decode($bank->banking_details, true)['bank_name']}}@endif" name="bank_name" class="form-control">
                                    <span class="error-message">Please enter valid Bank Name</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Account Holder Name </label>
                                    <input type="text" id="fullname" placeholder="David Jerome" value="@if($bank) {{json_decode($bank->banking_details, true)['holder_name']}}@endif" name="holder_name" class="form-control">
                                    <span class="error-message">Please enter valid Account Holder Name</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">IFSC Code </label>
                                    <input type="text" id="fullname" placeholder="ICI0012145" value="@if($bank) {{json_decode($bank->banking_details, true)['ifcscode']}}@endif" name="ifcscode" class="form-control">
                                    <span class="error-message">Please enter valid IFSC Code</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Branch Name </label>
                                    <input type="text" id="fullname" placeholder="Indiranagar" value="@if($bank) {{json_decode($bank->banking_details, true)['branch_name']}}@endif" name="branch_name" class="form-control">
                                    <span class="error-message">Please enter valid Branch Name</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <p class="img-label">Aadhaar Card</p>
                                <div class="upload-section p-20 pt-0">
                                    <img class="upload-preview" src="{{asset("static/images/upload-ing.svg")}}" alt="">
                                    <div class="ml-1">
                                        <div class="file-upload cursor-pointer">
                                            <input id="upload" type="file" accept=".pdf,.doc,.png,.jpg,.jpeg" class="cursor-pointer" >
                                            <input type="hidden" class="base-holder" name="doc[aadhar_card]" required value="{{$bank->aadhar_card ?? ''}}" />
                                            <button id="upload-btn" type="button" data-action="upload" class="btn theme-bg white-text my-0 cursor-pointer">@if($bank->aadhar_card) CHANGE @else UPLOAD FILE @endif</button>
                                        </div>
                                        <p class="file-name">Allowed: pdf, doc, image</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <p class="img-label">GST Certificate</p>
                                <div class="upload-section p-20 pt-0">
                                    <img class="upload-preview" src="{{asset("static/images/upload-ing.svg")}}" alt="">
                                    <div class="ml-1">
                                        <div class="file-upload">
                                            <input type="file" id="upload" accept=".pdf,.doc,.png,.jpg,.jpeg">
                                            <input type="hidden" class="base-holder" name="doc[gst_certificate]" value="{{$bank->gst_certificate ?? ''}}" required />
                                            <button type="button" class="btn theme-bg white-text my-0" data-action="upload">@if($bank->gst_certificate) CHANGE @else UPLOAD FILE @endif</button>
                                        </div>
                                        <p class="file-name">Allowed: pdf, doc, image</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <p class="img-label">Agreement with Biddnest</p>
                                <div class="upload-section p-20 pt-0">
                                    <img class="upload-preview" src="{{asset("static/images/upload-ing.svg")}}" alt="">
                                    <div class="ml-1">
                                        <div class="file-upload">
                                            <input type="file" id="upload" accept=".pdf,.doc,.png,.jpg,.jpeg">
                                            <input type="hidden" class="base-holder" name="doc[biddnest_agreement]" value="{{$bank->bidnest_agreement ?? ''}}" required />
                                            <button type="button" class="btn theme-bg white-text my-0" data-action="upload">@if($bank->bidnest_agreement) CHANGE @else UPLOAD FILE @endif</button>
                                        </div>
                                        <p class="file-name">Allowed: pdf, doc, image</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <p class="img-label">PAN Card</p>
                                <div class="upload-section p-20 pt-0">
                                    <img class="upload-preview" src="{{asset("static/images/upload-ing.svg")}}" alt="">
                                    <div class="ml-1">
                                        <div class="file-upload">
                                            <input type="file" id="upload" accept=".pdf,.doc,.png,.jpg,.jpeg">
                                            <input type="hidden" class="base-holder" name="doc[pan_card]" value="{{$bank->pan_card ?? ''}}" required />
                                            <button type="button" class="btn theme-bg white-text my-0" data-action="upload">@if($bank->pan_card) CHANGE @else UPLOAD FILE @endif</button>
                                        </div>
                                        <p class="file-name">Allowed: pdf, doc, image</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <p class="img-label">Company Registration Certificate</p>
                                <div class="upload-section p-20 pt-0">
                                    <img class="upload-preview" src="{{asset("static/images/upload-ing.svg")}}" alt="">
                                    <div class="ml-1">
                                        <div class="file-upload">
                                            <input type="file" id="upload" accept=".pdf,.doc,.png,.jpg,.jpeg">
                                            <input type="hidden" class="base-holder" name="doc[company_registration_certificate]" value="{{$bank->company_reg_certificate ?? ''}}" required />
                                            <button type="button" class="btn theme-bg white-text my-0" data-action="upload">@if($bank->company_reg_certificate) CHANGE @else UPLOAD FILE @endif</button>
                                        </div>
                                        <p class="file-name">Allowed: pdf, doc, image</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex  justify-content-between flex-row  p-10 py-0" style="border-top: 1px solid #70707040;">
                            <div class="w-50"><a class="white-text p-10" href="#">
                                    <button class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>
                            </div>
                            <div class="w-50 text-right">
                                <a class="white-text p-10" href="#">
                                    <button class="btn theme-br white-text w-30">Save</button></a>
                                <a class="white-text p-10">
                                    <button class="btn theme-bg theme-text w-30 white-bg">Next</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
