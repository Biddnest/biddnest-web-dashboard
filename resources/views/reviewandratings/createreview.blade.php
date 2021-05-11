@extends('layouts.app')
@section('title') Review @endsection
@section('content')

<!-- Main Content -->
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createreview">
                            <div class="d-flex flex-row justify-content-between">
                                <h3 class="page-head theme-text text-left p-4 f-20 ml-4">Create Review for Customer</h3>

                            </div>
                            <div class="d-flex  flex-row justify-content-between ml-4 pl-1">
                                <div class="page-head text-left p-2 pt-0 pb-0">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{route('review')}}">Review & Ratings
                                            <li class="breadcrumb-item active" aria-current="page">Create Review for Customer</li>
                                            </a></li>
        
                                        </ol>
                                    </nav>
        
        
                                </div>
        
                            </div>
                            <!-- <div class="d-flex flex-row text-left ml-120">
                                <a href="Reviews.html" class="text-decoration-none">
                                    <h3 class="page-subhead text-left pb-3 pt-3 f-20 theme-text">
                                        <i class="p-1">
                                            <img src="assets/images/Icon feather-chevrons-left.svg" alt=""
                                                srcset="" /></i>Back to Reviews & Ratings
                                    </h3>
                                </a>
                            </div> -->
                            <!-- Dashboard cards -->
                            <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
                                <div class="col-lg-10">
                                    <div class="card h-auto p-0 pt-10">
                                        <div class="card-head right text-left border-bottom-2 p-10 pt-0 pb-0">
                                            <h3 class="f-18 mb-4 pl-2 ml-1 theme-text">
                                                Create Review for Customer
                                            </h3>
                                        </div>
                                        <form
                                        class="form-new-order  onboard-vendor-form input-text-blue">
                                        <div class="d-flex row  pl-4 pr-4 p-20">
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <label class="customer-name">Booking ID</label>
                                                    <span class="">
                                                        <input type="text" placeholder="SKU1234456"
                                                            id="constomer-name" class="form-control br-5" />
                                                        <span class="error-message">please enter valid
                                                            name</span>
                                                    </span>
                                                </div>
                                            </div>
                                            <!-- <div class="col-lg-6">
                                                <div class="form-input">
                                                    <label class="full-name">Customer Name</label>
                                                    <span class="">
                                                        <input type="text" placeholder="Dhanush Rao" id="customer-desig"
                                                            class="form-control br-5" />
                                                        <span class="error-message">please enter valid
                                                            Designation</span>
                                                    </span>
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-lg-6">
                                                <div class="form-input">
                                                    <label class="full-name">Vendor Name</label>
                                                    <span class="">
                                                        <input type="text" placeholder="Dhanush Rao" id="customer-desig"
                                                            class="form-control br-5" />
                                                        <span class="error-message">please enter valid
                                                            Designation</span>
                                                    </span>
                                                </div>
                                            </div> -->


                                            <div class="col-lg-6">
                                                <label class="full-name theme-text bold f-14 pt-4 -mt-10">Ratings</label>
                                                <div class="rating -mt-10">
                                                  <input type="radio" name="rating" id="rating-5">
                                                  <label for="rating-5"></label>
                                                  <input type="radio" name="rating" id="rating-4">
                                                  <label for="rating-4"></label>
                                                  <input type="radio" name="rating" id="rating-3">
                                                  <label for="rating-3"></label>
                                                  <input type="radio" name="rating" id="rating-2">
                                                  <label for="rating-2"></label>
                                                  <input type="radio" name="rating" id="rating-1">
                                                  <label for="rating-1"></label>
                                                </div>

                                            </div>

                                               
                                            <div class="col-lg-12">
                                                <div class="form-input">
                                                    <label class="">Description</label>
                                                        <textarea id="testim-description" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus erat at ligula auctor malesuada. Suspendisse potenti. Duis Bibendum arcu in consequat tempus." style="resize: none;" id="" class="form-control " rows="3" cols="50" spellcheck="false">                   
                                                          </textarea>
                                                       <span class="error-message">Please enter  valid Description</span>
                                                </div>
                                            </div> 
                                            <div class="col-lg-6">
                                                <div class="form-input">
                                                    <label class="full-name">Status</label>
                                                    <span class="">
                                                        <input type="text" placeholder="Completed" id="customer-desig"
                                                            class="form-control br-5" />
                                                        <span class="error-message">please enter valid
                                                            Designation</span>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="accordion bg-white pl-0 pr-0" id="comments">
                                            <div class="d-flex justify-content-between flex-row p-10 py-0"
                                                style="border-top: 1px solid #70707040">
                                                <div class="w-50">
                                                    <a class="white-text p-10" href="#"><button
                                                            class="btn br-5 theme-br theme-text w-30 white-bg">
                                                            Cancel
                                                        </button></a>
                                                </div>
                                                <div class="w-50 text-right">
                                                    <a class="white-text p-10"><button
                                                            class="btn br-5 theme-bg white-text w-30">
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