@extends('website.layouts.frame')
@section('title') Registration Complete @endsection
@section('header_title') Thankyou for registering with us @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="joinedvendor">
        <div class="container ">
            <div class="book-move-screen responsive ontop w-70 ">
                <div class="card-body ">
                    <div class="row d-flex ">
                        <div class="col-md-12 book-move-questions-container ">
                            <div class="row setup-content-3 step-palce" id="step-6" >
                                <div class="col-md-12">
                                    <div class="border-bottom">
                                        <i class="fa fa-thumbs-up center successful-icon mt-2 view-block text-view-center"></i>
                                        <p class="text-muted f-16 center italic order-status-message text-view-center">
                                            We have recieved your details and are glad to onboard you.</p>
                                    </div>
                                    <div>
                                        <div class="text-center ">
                                            <p class="text-muted f-14 pt-4 italic notification-message">Our virtual assitant will reach back to you soon!</p>
                                            {{--<div id="app"></div>--}}

                                        </div>
                                    </div>
                                    <div class="button-bottom d-flex justify-content-center pt-4">
                                        <div class="">
                                            <a class="white-text " href="{{route('home')}}">
                                                <button type="button" class="btn btn-theme-bg padding-btn-res white-bg">GO HOME
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
