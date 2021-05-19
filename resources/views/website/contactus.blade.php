@extends('website.layouts.frame')
@section('title') Contact Us @endsection
@section('header_title') Support @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="contactus">
        <section class="mb-500">
            <div class="container">
                <div class="quote responsive br-5 w-70 ontop bg-white ">
                    <div class="card-body f-14">
                        <h5 class="card-title -mt-10  pb-1">Contact Details</h5>
                        <div class="row f-initial border-bottom m-20 pb-3 mt-0">
                            <div class="col-md-4  col-sm-12">
                                <div class="d-flex justify-content-around">
                                    <div class="">
                                        <img class="-mt-10" src="{{ asset('static/website/images/icons/location.svg')}}" />
                                    </div>
                                    <div class="">
                                        <p>ABC Studio, ABC Street, KBC Chennai, 490430</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4  col-sm-12">
                                <div class="d-flex -mt-10 justify-content-center a-item min-view theme-text">
                                    <div class="">
                                        <img src="{{ asset('static/website/images/icons/mail.svg')}}" />
                                    </div>
                                    <div class="">
                                        <p class="f-14 underline">support@gmail.com</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 -mt-10  col-sm-12">
                                <div class="d-flex  a-item min-view  justify-content-center">
                                    <div class="mb-1 -mr-10">
                                        <img src="{{ asset('static/website/images/icons/call.svg')}}" />
                                    </div>
                                    <div class="">
                                        <p> +91 - 8989898989</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5 class="card-title  pb-10">Latest Orders</h5>

                        <div class="card view-content p-4">
                            <div class="row f-initial ">
                                <div class="col-md-5 col-sm-12 br-rg">

                                    <div class="d-flex justify-content-between ">
                                        <div class=" p-0">
                                            <p>From</p>
                                            <p class="bg-blur"> Bangaluru</p>
                                        </div>
                                        <div class=" mt-1 pt-3 pr-2 a-self-center">
                                            <img class="-ml-10" src="{{ asset('static/website/images/icons/moving-truck.svg')}}" />
                                        </div>
                                        <div class="">
                                            <p>To</p>
                                            <p class="bg-blur">Chennai</p>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4  col-sm-12 br-rg">
                                    <div class="d-flex justify-content-between  ">
                                        <div class="">
                                            <div>
                                                <p class="mb-0">Order Id </p>
                                                <p> #31234 </p>
                                            </div>
                                            <div>
                                                <p class="mb-0">Date </p>
                                                <p> 20/Jan/21 </p>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div>
                                                <p class="mb-0">Price </p>
                                                <p> Rs.9,800 </p>
                                            </div>
                                            <div>
                                                <p class="mb-0">Status </p>
                                                <p>Completed </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3  col-sm-12">
                                    <div>
                                        <div class="d-flex center"><a class="white-text " data-toggle="modal" data-target="#for-friend" href="#"><button
                                                    class="btn btn-theme-bg mt-2  white-bg">Get support</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="for-friend" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                    <div class="modal-dialog col-grey input-text-blue" role="document">
                        <div class="modal-content  w-1000 mt-50  right-25">
                            <div class="modal-header  bg-purple">
                                <h5 class="modal-title m-0-auto -mr-30 text-white" id="exampleModalLongTitle ">Confirmation
                                </h5>
                                <button type="button" class="close text-white  " data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body p-5 margin-topneg-7">
                                <div class="d-flex center">
                                    <p class="model-text ">Are you sure you want to avail support for this order ? </p>
                                </div>
                                <div class="d-flex justify-around  button-bottom pt-4">

                                    <div class=""><a class="white-text" href="{{route('contact_us')}}"><button
                                                class="btn btn-theme-w-bg btn-confirm-padding padding-btn-res">No</button></a>
                                    </div>
                                    <div class=""><a class="white-text" href="{{route('complete_contact_us')}}"><button
                                                class="btn btn-theme-bg  white-bg btn-confirm-padding padding-btn-res">Yes</button></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            $(document).ready(function() {

                var showHeaderAt = 150;

                var win = $(window),
                    body = $('body');
                if (win.width() > 400) {
                    win.on('scroll', function(e) {
                        if (win.scrollTop() > showHeaderAt) {
                            body.addClass('fixed');
                        } else {
                            body.removeClass('fixed');
                        }
                    });
                }
            });
        </script>
    </div>
@endsection
