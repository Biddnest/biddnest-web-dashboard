@extends('layouts.app')
@section('title') Customer Management @endsection
@section('content')
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="create-customer">
                            <div class="d-flex  flex-row justify-content-between ">
                                <h3 class="page-head text-left p-4 f-20">Create Customer</h3>

                            </div>
                            <div class="d-flex  flex-row justify-content-between">
                                <div class="page-head text-left    pb-0 p-2">
                                  <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                      <li class="breadcrumb-item"><a href="customers.html">Customer Management</a></li>
                                      <li class="breadcrumb-item active" aria-current="page">Create Customer</li>
                                    </ol>
                                  </nav>
                                
                                
                                </div>
                          
                            </div>
                            <!-- <div class="d-flex  flex-row text-left ml-120">
                                <a href="customers.html" class="text-decoration-none">
                                    <h3 class="page-subhead text-left pl-4 pt-4 f-20 theme-text" style="text-decoration: underline;">
                                        <i class="p-1"> <img src="assets/images/Icon feather-chevrons-left.svg" alt=""
                                                srcset=""></i>Back to Customer Management
                                    </h3>
                                </a>

                            </div> -->
                            <!-- Dashboard cards -->


                            <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
                                <div class="col-lg-10">
                                    <div class="card  h-auto p-0 pt-10 ">

                                        <div class="create-customer">
                                            <header>
                                                <h3 class="f-18">
                                                    Create Customer
                                                </h3>
                                            </header>
                                            <div class="form-wrapper">
                                                <form action="">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-input">
                                                                <label class="full-name">Customer Name</label>
                                                                <span class="">
                                                                    <input type="text" id="fullname" placeholder="David" class="form-control">
                                                                    <span class="error-message">Please enter valid
                                                                        Customer Name</span>
                                                                </span>
                                                            </div>                                                                
                                                        </div>
                                         <div class="col-lg-6">
                                                            <div class="form-input">
                                                                <label class="full-name">Status</label>
                                                                <!-- <span class="">
                                                                    <div class="d-flex mt-2">
                                                                        <p>Blocked</p>
                                                                        <label class="switch mx-4">
                                                                            <input type="checkbox" id="">
                                                                            <span class="slider"></span>
                                                                          </label>
                                                                        <p>Unblocked</p>

                                                                    </div>
                                                       </span> -->
                                                       <div class="d-flex justify-content-start   margin-topneg-20 white-text small-switch">
                                                        <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-width="100" data-height="35" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-on="Active" data-off="Inactive" id="">
                                                    </div>
                         </div>                                                                
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-input">
                                                                <label class="phone-num-lable">Phone Number</label>
                                                                <span class="">
                                                                    <input type="tel" id="phone"
                                                                        placeholder="987654321"
                                                                        class=" form-control form-control-tel">
                                                                    <span class="error-message">Please enter valid
                                                                        Phone number</span>
                                                                </span>
                                                            </div> 
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-input">
                                                                <label class="full-name">Email ID</label>
                                                                <span class="">
                                                                    <input type="email" id="fullname" placeholder="David" class="form-control">
                                                                    <span class="error-message">Please enter valid
                                                                        Email ID</span>
                                                                </span>
                                                            </div>                                                                
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-input">
                                                                <label class="phone-num-lable">Gender</label>
                                                                <span class="">
                                     <select id="" class="form-control">
                                        <option>-Select Geneder-</option> 
                                         <option>Female</option> 
                                                                        <option>Male</option>
                                                                        </select>
                                                                    <span class="error-message">Please enter valid
                                                                        Phone number</span>
                                                                </span>
                                                            </div> 
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-input">
                                                                <label class="full-name">Date of Birth</label>
                                                                <span class="">
                                                                    <input type="text" id="fullname" placeholder="David" class="form-control">
                                                                    <span class="error-message">Please enter valid
                                                                        Date of Birth</span>
                                                                </span>
                                                            </div>                                                                
                                                        </div>
                                                        <!-- <div class="col-lg-6">
                                                            <div class="form-input">
                                                                <label class="full-name">Social Media Link Up</label>
                                                                <span class="">
                                                                    <input type="text" id="fullname" placeholder="David" class="form-control">
                                                                    <span class="error-message">Please enter valid
                                                                        Social Media Link Up</span>
                                                                </span>
                                                            </div>                                                                
                                                        </div> -->

                                                    </div>
                                                    <div class="d-flex  justify-content-between flex-row ml-20 p-10 py-0 " style="border-top: 1px solid #70707040;margin-top: 70px;">
                                                        <div class="w-50"><a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>
                                                        </div>
                                                        <div class="w-50 text-right"><a class="white-text p-10"><button class="btn theme-bg white-text w-30">Save</button></a>
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