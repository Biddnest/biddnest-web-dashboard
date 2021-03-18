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

    <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
        <div class="col-lg-10">
            <div class="card  h-auto p-0 pt-10 ">
                <div class="card-head right text-left border-bottom-2 p-10 pt-10 pb-0">
                    <h3 class="f-18 mb-0">
                        <ul class="nav nav-tabs  p-0" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link p-15" id="new-order-tab" data-toggle="tab"
                                                    href="#order" role="tab" aria-controls="home"
                                                    aria-selected="true">Onboard Vendor</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link p-15" id="quotation" data-toggle="tab" href="#past"
                                                    role="tab" aria-controls="profile" aria-selected="false">Add Branch</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link p-15" id="quotation" data-toggle="tab" href="#past"
                                                    role="tab" aria-controls="profile" aria-selected="false">Vendor
                                                    Banking Details</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active p-15" id="quotation" data-toggle="tab"
                                                    href="#vendor-role" role="tab" aria-controls="profile"
                                                    aria-selected="false">Vendor Roles</a>
                                            </li>
                        </ul>
                    </h3>
                </div>
                
                <div class="tab-content" id="myTabContent">
                                        <form class="form-new-order onboard-vendor-form input-text-blue">
                                            <div class="row p-20 pb-0">
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Employee First Name</label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="David"
                                                                value="" class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Employee First Name</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Employee Last Name </label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="Jerome"
                                                                value="" class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Employee Last Name</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Role Type</label>
                                                        <span class="">
                                                            <select id="" class="form-control">
                                                                <option>Manager</option>
                                                                <option>Manager 2</option>
                                                                <option>Manager 3</option>
                                                            </select>
                                                            <span class="error-message">Please enter valid
                                                                Role Type</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Modules under this role </label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="Enter Modules here" value=""
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Modules under this role</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="phone-num-lable">Primary Contact Number</label>
                                                        <span class="">
                                                            <input type="tel" id="phone1" placeholder="9876543210"
                                                                class=" form-control form-control-tel">
                                                            <span class="error-message">Please enter valid
                                                                Contact number</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Branch</label>
                                                        <span class="">
                                                            <select id="" class="form-control">
                                                                <option>Delhi</option>
                                                                <option>Mumbai</option>
                                                                <option>Pune</option>
                                                            </select>
                                                            <span class="error-message">Please enter valid
                                                                Role Type</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Vendor ID </label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="V123456" value=""
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Vendor ID</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Email ID </label>
                                                        <span class="">
                                                            <input type="email" id="fullname" placeholder="abc@email.com" value=""
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Email ID</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Organization ID </label>
                                                        <span class="">
                                                            <input type="text" id="fullname" placeholder="O1234456" value=""
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Organization ID</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name">Password</label>
                                                        <span class="">
                                                            <input type="password" id="fullname" placeholder="Password" value=""
                                                                class="form-control">
                                                            <span class="error-message">Please enter valid
                                                                Organization ID</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-input">
                                                        <label class="full-name ">Status</label>
                                                   <div class="">
                                                        <div class="d-flex justify-content-start   margin-topneg-20 white-text vendor-switch2">
                                                        <input type="checkbox" checked data-toggle="toggle"
                                                        data-size="xs" data-width="100" data-height="30" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-on="Active" data-off="Inactive" id="">
                                                                                                           </div>
                                                   </div>
                                                            
                                     

                                                          
                                                      



                                                    </div>
                                                   
                                                </div>
                                                <div class="col-sm-6 mtop-20">
                                                    <a class="white-text p-10" data-toggle="modal"
                                                        data-target="#add-new-role">
                                                        <button class="btn theme-bg white-text float-right">Add New Role</button></a>
                                                </div>
                                            </div>
                                            <div class="d-flex  justify-content-between flex-row  p-10 py-0"
                                                style="border-top: 1px solid #70707040;">
                                                <div class="w-50"><a class="white-text p-10" href="#"><button
                                                            class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>
                                                </div>
                                                <div class="w-50 text-right">
                                                    <a class="white-text p-10" href="#"><button
                                                            class="btn theme-br theme-text w-30 white-bg">Back</button></a>
                                                    <a class="white-text p-10"><button
                                                            class="btn theme-bg white-text w-30">Save</button></a>
                                                </div>
                                            </div>
                                        </form> 
                </div>

            </div>
        </div>
    </div>
</div>

@endsection