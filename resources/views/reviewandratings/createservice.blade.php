@extends('layouts.app')
@section('title') Service And Request @endsection
@section('content')

<div class="main-content grey-bg">
                             <div class="main-content grey-bg mt-4">
                                <div class="d-flex flex-row justify-content-between">
                                  <h3 class="heading1 ml-4 pl-2">Categories & Subcategories</h3>
                              </div>
                              <div class="page-head text-left  pt-0 pb-0 p-4 mt-2">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('service-requests')}}">Service Requests</a></li>
                                        <li class="breadcrumb-item active" aria-current="page"> Create Service</li>


                                    </ol>
                                </nav>


                                </div>
                                 <div class="d-flex flex-row text-left ml-120">
                                     <a href="{{route('service-requests')}}" class="text-decoration-none">
                                         <h3 class="page-subhead text-left f-18" style="margin-top: 10px; !important; color: #2e0789;">
                                             <i class="p-1">
                                                 <img src="{{asset('static/images/Icon feather-chevrons-left.svg')}}" alt="" srcset="">
                                             </i> Back to Service Requests
                                         </h3>
                                     </a>
                                 </div>
                            <!-- Dashboard cards -->
                            <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
                                <div class="col-lg-10">
                                    <div class="card h-auto p-0 pt-10">
                                        <div class="card-head right text-left border-bottom-2 p-10 pt-20 pb-0">
                                            <h3 class="f-18 mb-0 mt-2  theme-text">
                                               Create Service
                                            </h3>
                                        </div>
                                        <form
                                        class="form-new-order onboard-vendor-form input-text-blue">
                                        <div class="d-flex pa-20 mr-1 ml-1 row p-10">

                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <label class="full-name"> Enter Service ID</label>
                                                    <span class="">
                                                        <input type="text" placeholder="S123456" id="customer-desig"
                                                            class="form-control br-5" />
                                                        <span class="error-message">please enter valid
                                                            id</span>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <label class="full-name"> Created By</label>
                                                    <span class="">
                                                        <input type="text" placeholder="S123456" id="customer-desig"
                                                            class="form-control br-5" />
                                                        <span class="error-message">please enter valid
                                                            id</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <label class="full-name">Vendor ID</label>
                                                    <span class="">
                                                        <input type="text" placeholder="V012567" id="vend-id"
                                                            class="form-control br-5" />
                                                        <span class="error-message">please enter valid
                                                            id</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                  <label class="full-name">Created At</label>
                                                  <input
                                                    type="text"
                                                    class=" form-control br-5"
                                                    required="required"
                                                  />
                                                  <span class="error-message"
                                                    >please enter valid date</span
                                                  >
                                                </div>
                                              </div>



                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <label class="full-name">Category ID</label>
                                                    <span class="">
                                                        <input type="text" placeholder="C123456" id="zone"
                                                            class="form-control br-5" />
                                                        <span class="error-message">please enter valid
                                                            zone</span>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <label class="full-name">Item ID</label>
                                                    <span class="">
                                                        <input type="text" placeholder="C123456" id="zone"
                                                            class="form-control br-5" />
                                                        <span class="error-message">please enter valid
                                                            zone</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <label class="full-name">Item Rate</label>
                                                    <span class="">
                                                        <input type="text" placeholder="C123456" id="zone"
                                                            class="form-control br-5" />
                                                        <span class="error-message">please enter valid
                                                            zone</span>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                  <label class="full-name">Status</label>
                                                  <select id="ban-type" class="form-control br-5">
                                                    <option>Viewed</option>
                                                    <option></option>
                                                    <option></option>
                                                  </select>


                                                  <span class="error-message"
                                                    >Please enter a valid banner type</span
                                                  >
                                                </div>
                                              </div>
                                              <div class="col-lg-12">
                                                <div class="form-group theme-text">
                                                    <label class="pt-4">Description</label>
                                                    <textarea  class="form-control  br-5" id="testim-description"
                                                        rows="3">
                                                      </textarea>
                                                    <span class="error-message">Please enter valid
                                                        Description</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion" id="comments">
                                            <div class="d-flex justify-content-between flex-row p-10 py-0"
                                                style="border-top: 1px solid #70707040">
                                                <div class="w-50">
                                                    <a class="white-text p-10" href="#"><button
                                                            class="btn theme-br theme-text w-30  br-5 white-bg">
                                                            Discard
                                                        </button></a>
                                                </div>
                                                <div class="w-50 text-right">
                                                    <a class="white-text p-10"><button
                                                            class="btn theme-bg br-5 white-text w-30">
                                                            Save
                                                        </button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
</div>

@endsection
