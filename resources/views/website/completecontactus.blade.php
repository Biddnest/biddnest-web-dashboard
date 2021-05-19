@extends('website.layouts.frame')
@section('title') Contact Us @endsection
@section('header_title') Support @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="completecontactus">
            <div class="container">
                <div class="quote responsive br-5 w-70 ontop bg-white">
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
                        <h5 class="card-title pb-10">Latest Orders</h5>
                        <div class="card view-content p-4 ">
                            <div class="row f-initial">
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
                                    <div class="">
                                        <p class="center text-center f-14">Ticket has already been raised</p>
                                        <a id="more" class="d-flex center" href="#" onclick="toggle_visibility('view_more_content');"> View more </a>
                                    </div>
                                </div>
                            </div>
                            <div id="view_more_content" class="togglenone">
                                <div class="ticket-id d-flex pt-4  border-top justify-content-between">
                                    <p class="para-head l-cap">Ticket Id : <span>#454556</span></p>
                                    <p class="bg-blur col-orange l-cap">In process</p>
                                </div>
                                <div class="ticket-id border-top pt-4">
                                    <h6 class="para-head ml-1">Subject</h6>
                                    <p class="l-cap col-grey pl-1">Category</p>
                                    <p class="para pl-1"> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                </div>
                                <div class="reply border-top pt-4">
                                    <h5 class="para-head mb-3">Reply</h5>
                                    <div class="d-flex">
                                        <i class="fa fa-square f-52"></i>
                                        <!-- <i class="fas fa-stop"></i> -->
                                        <div class="mt-1">
                                            <h6 class="para-text bold ml-3 mb-0">Customer Support</h6>
                                            <p class="text-muted ml-1">2 days ago</p>
                                            <p class="para ml-1"> Dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer.Dummy text of the printing and typesetting industry. Ipsum
                                                has been the industry’s
                                            </p>
                                            <p class="para ml-1">
                                                industry’s standard dummy text ever since the 1500s, when an unknown
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <script type="text/javascript">
            function toggle_visibility(id) {
                var e = document.getElementById(id);
                if (e.style.display == 'block') {
                    e.style.display = 'none';
                    document.getElementById("more").innerText = "View More";
                } else {
                    e.style.display = 'block';
                    document.getElementById("more").innerText = "View Less";
                }
            }
        </script>
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
