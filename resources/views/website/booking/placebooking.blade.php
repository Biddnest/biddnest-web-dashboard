@extends('website.layouts.frame')
@section('title') Book Move @endsection
@section('header_title')Book a Move @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="placebooking">
        <div class="container ">
            <div class="book-move-screen responsive ontop w-70 ">
                <div class="card-body ">
                    <div class="row d-flex ">
                        <div class="col-md-3 br-line view-none pt-4 ">
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
                                    <div class="steps-step-5 ">
                                        <p class="step-text text-right ">Estimation Cost<span class="text-muted ">
                                                Personal Info</span>
                                    </div>
                                </div>
                                <div class="col-md-4 steps-row-3 setup-panel-3">
                                    <div class="steps-step-3 ">
                                        <a href="#step-5 " type="button " class="btn steps-icon rounded-icons btn-pink btn-circle-3 waves-effect p-3 step-todo completed-step-5" data-toggle="tooltip " data-placement="top " title="Basic Information "><i
                                                class="fa fa-tag " aria-hidden="true "></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="row steps-form-3 ">
                                <div class="col-md-8 setup-panel-3">
                                    <div class="steps-step-6 color-purple">
                                        <p class="step-text text-right ">Place Request<span class="text-muted ">
                                                Personal
                                                Info</span></p>
                                    </div>
                                </div>
                                <div class="col-md-4 steps-row-3 setup-panel-3">
                                    <div class="steps-step-3 ">
                                        <a href="#step-6 " type="button " class="btn steps-icon rounded-icons btn-pink btn-circle-3 turntheme waves-effect p-3 step-todo completed-step-6" data-toggle="tooltip " data-placement="top " title="Basic Information "><i
                                                class="fa fa-thumbs-up " aria-hidden="true "></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 book-move-questions-container ">
                            <form id="wizard">
                                <div class="row setup-content-3 step-palce" id="step-6" >
                                    <div class="col-md-12">
                                        <div>
                                            <p class="text-muted">Step 6 / 6</p>
                                            <h5 class="border-bottom theme-text pb-4 text-view-center">Place Your Request!
                                            </h5>
                                        </div>
                                        <div class="border-bottom">
                                            <i class="fa fa-thumbs-up center successful-icon mt-2 view-block text-view-center"></i>
                                            <p class="text-muted f-16 center italic order-status-message text-view-center">
                                                Your Order has been submitted</p>
                                            <p class=" f-16 para-head center order-num text-view-center">ORDER ID
                                                <span>: #{{$booking->public_booking_id}}</span>
                                            </p>
                                        </div>
                                        <div>
                                            <div class="text-center ">
                                                <p class="text-muted f-14 pt-4 italic notification-message"> You will get the estimated price once the time is up</p>
                                                <h3 class="f-18 pb-4 theme-text bold ">Time Left</h3>
                                                <div id="app"></div>
                                            </div>
                                        </div>
                                        <div class="button-bottom d-flex justify-content-center pt-4">
                                            <div class="">
                                                <a class="white-text " href="{{route('my-bookings')}}">
                                                    <button type="submit" class="btn btn-theme-bg padding-btn-res white-bg">View my
                                                        bookings
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function updateCount(type) {
                let currentValue = Number(document.getElementById('inc ').value)
                if (type == "increment") {
                    currentValue++
                } else {
                    if (currentValue > 0) {
                        currentValue--
                    }
                }
                document.getElementById('inc ').value = currentValue
            }
        </script>
    </div>
@endsection
