@extends('website.layouts.frame')
@section('title') Book Move @endsection
@section('header_title')Book a Move @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="estimatebooking">
        <div class="container ">
            <div class="book-move-screen responsive ontop w-70 ">
                <div class="card-body ">
                    <div class="row d-flex ">
                        <div class="col-md-3 br-line view-none ">
                            <div class="row steps-form-3 ">
                                <div class="col-md-8 setup-panel-3">
                                    <div class="steps-step-1 ">
                                        <p class="step-text text-right ">Customer Details
                                            <span class="text-muted "> Personal Info</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 steps-row-3 setup-panel-3">
                                    <div class="steps-step-3 card-block ">
                                        <a href="#step-1 " type="button " class="btn steps-icon rounded-icons btn-info btn-circle-3 waves-effect ml-0 text-muted completed-step-1 " data-toggle="tooltip " data-placement="top " title="Basic Information "><i
                                                class="fa fa-user " aria-hidden="true "></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="row steps-form-3 ">
                                <div class="col-md-8 setup-panel-3">
                                    <div class="steps-step-2 ">
                                        <p class="step-text text-right ">Delivery Details<span class="text-muted ">
                                                Personal Info</span>
                                    </div>
                                </div>
                                <div class="col-md-4 steps-row-3 setup-panel-3">
                                    <div class="steps-step-3 card-block ">
                                        <a href="#step-2 " type="button " class="btn steps-icon rounded-icons btn-pink btn-circle-3 waves-effect p-3 card-block completed-step-2" data-toggle="tooltip " data-placement="top " title="Basic Information "><i
                                                class="fa fa-map-marker " aria-hidden="true "></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="row steps-form-3 ">
                                <div class="col-md-8 setup-panel-3">
                                    <div class="steps-step-3 ">
                                        <p class="step-text text-right ">Requirements<span class="text-muted "> Personal
                                                Info</span></p>
                                    </div>
                                </div>
                                <div class="col-md-4 steps-row-3 setup-panel-3">
                                    <div class="steps-step-3 ">
                                        <a href="#step-3 " type="button " class="btn steps-icon rounded-icons btn-pink btn-circle-3 waves-effect step-todo completed-step-3" data-toggle="tooltip " data-placement="top " title="Basic Information "><i
                                                class="fa fa-list " aria-hidden="true "></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="row steps-form-3 ">
                                <div class="col-md-8 setup-panel-3">
                                    <div class="steps-step-4 ">
                                        <p class="step-text text-right">Instructions<span class="text-muted ">
                                                Personal Info</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 steps-row-3 setup-panel-3">
                                    <div class="steps-step-3 ">
                                        <a href="#step-4 " type="button " class="btn steps-icon rounded-icons btn-pink btn-circle-3 waves-effect p-3 step-todo completed-step-4" data-toggle="tooltip " data-placement="top " title="Basic Information "><i
                                                class="fa fa-comments " aria-hidden="true "></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="row steps-form-3 ">
                                <div class="col-md-8 setup-panel-3">
                                    <div class="steps-step-5 color-purple">
                                        <p class="step-text text-right ">Estimation Cost<span class="text-muted ">
                                                Personal Info</span>
                                    </div>
                                </div>
                                <div class="col-md-4 steps-row-3 setup-panel-3">
                                    <div class="steps-step-3 ">
                                        <a href="#step-5 " type="button " class="btn steps-icon rounded-icons btn-pink btn-circle-3 turntheme waves-effect p-3 step-todo completed-step-5" data-toggle="tooltip " data-placement="top " title="Basic Information "><i
                                                class="fa fa-tag " aria-hidden="true "></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="row steps-form-3 ">
                                <div class="col-md-8 setup-panel-3">
                                    <div class="steps-step-6">
                                        <p class="step-text text-right ">Place Request<span class="text-muted ">
                                                Personal
                                                Info</span></p>
                                    </div>
                                </div>
                                <div class="col-md-4 steps-row-3 setup-panel-3">
                                    <div class="steps-step-3 ">
                                        <a href="#step-6 " type="button " class="btn steps-icon rounded-icons btn-pink btn-circle-3 waves-effect p-3 step-todo completed-step-6" data-toggle="tooltip " data-placement="top " title="Basic Information "><i
                                                class="fa fa-thumbs-up " aria-hidden="true "></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 book-move-questions-container ">
                                <div class="row setup-content-3 step-estimate" id="step-5">
                                    <div class="col-md-12">
                                        <div>
                                            <p class="text-muted">Step 5 / 6</p>
                                            <h5 class="border-bottom theme-text pb-4 text-view-center">Get The Estimated Cost </h5>
                                        </div>
                                        <form class="form-new-order  input-text-blue" action="{{route('order_estimate')}}" method="PUT" data-next="redirect" data-url="{{route('place-booking', ['id'=>$booking->public_booking_id])}}" data-alert="mega"  data-parsley-validate>
                                            <div class="p-0  border-top-2 order-cards">
                                                <div class="d-flex justify-content-center f-14  text-center  mt-2 mb-1">
                                                    Please note that this is the baseline price, you will be receiving the <br>Vendor bid list with the final quotations
                                                </div>
                                                <input type="hidden" name="public_booking_id" value="{{$booking->public_booking_id}}">
                                                <div class="d-flex flex-row flex-view-col justify-content-around f-14 theme-text text-center  quotation mb-3">
                                                    <div class="flex-column justify-content-center test">
                                                        <div class="card m-20  card-price eco cursor-pointer">
                                                            <div class="p-60 f-32 border-cicle eco-card">
                                                                <div>
                                                                    <div class="f-30">₹ {{json_decode($booking->quote_estimate, true)['economic']}}</div>
                                                                    <div class="f-16 ">Base price</div>
                                                                </div>
                                                            </div>
                                                            <div class="p-eco f-18"> Economy
                                                                <p class="italic f-12 ">Economy Service include moving only
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="radio-group">
                                                            <div class="form-input radio-item ">
                                                                <input type="radio" id="economy" value="economic" name="service_type" class="radio-button__input cursor-pointer">
                                                                <label class="" for="economy"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="felx-column">
                                                        <div class="card m-20 card-price pre  cursor-pointer ">
                                                            <div class="p-60 f-32  border-cicle pre-card  ">
                                                                <div class="f-30">₹ {{json_decode($booking->quote_estimate, true)['premium']}}</div>
                                                                <div class="f-16 p-1">Base price</div>
                                                            </div>
                                                            <div class=" f-18"> Premium
                                                                <p class="italic f-12 ">Premium Service include Packing
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="radio-group">
                                                            <div class="form-input radio-item ">
                                                                <input type="radio" id="premium" value="premium" name="service_type" class="radio-button__input ">
                                                                <label class="" for="premium"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class=" actionBtn actionBtn-view border-top ">
                                                <a href="{{route('home')}}">
                                                    <button class="btn btn-mdb-color mt-2 btn-rounded cancelBtn float-left ml-2 " type="button ">
                                                        Cancel
                                                    </button>
                                                </a>
                                                <button class="btn btn-mdb-color mt-2 btn-rounded nextBtn-3 float-right">
                                                    Next
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
