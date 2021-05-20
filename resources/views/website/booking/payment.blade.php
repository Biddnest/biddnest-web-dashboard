@extends('website.layouts.frame')
@section('title')Payment @endsection
@section('header_title') Payment @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="payment">
        <div class="container">
            <div class="quote responsive w-70 br-5 ontop bg-white">
                <div class="card-body ">
                    <div class="card-title border-bottom d-flex justify-content-between pl-3 mt-4 pb-10">
                        <h5>Here is your final bill</h5>
                        <h4 class="f-30">Rs 4000</h4>
                    </div>
                    <div>
                        <p class="bold">PAYMENT SUMMARY</p>
                        <div class="d-flex justify-content-between">
                            <p class="text-muted">Item Total </p>
                            <p>3900</p>
                        </div>
                        <div class="d-flex justify-content-between border-bottom">
                            <p class="text-muted"> Tax and Charges</p>
                            <p>100</p>
                        </div>
                        <div class="mt-1 pt-1 pl-2 d-flex justify-content-between bold border-bottom">
                            <h6 class="pl-1">Grand Total</h6>
                            <h5>4000</h5>

                        </div>
                    </div>
                    <div class="row d-flex justify-content-between mt-2">
                        <div class="col-md-2 col-sm-12 col-xs-12 center">
                            <p class=" mb-view pl-0">Apply Coupon Code</p>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <div class="input-group mb-view ">
                                <input type="text" class="form-control h-content mb-view" placeholder="Enter Coupon Code if any">

                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2 ">
                            <button type="submit" class="btn btn-theme-bg white-bg" id="padding-apply">Apply
                                <a class="white-text " href="#"></a>

                            </button>
                        </div>

                    </div>


                    <!-- coupon -->
                    <div class="border-bottom ">
                        <p class="para-head mt-2 pl-1 ml-1">Available Coupons</p>
                        <div class="d-flex direction-col mb-4">
                            <div class="coupon ml-2">
                                <div class="d-flex mt-1 justify-content-center">

                                    <h5 class="coupon-code center d-flex">
                                        LMN2020
                                    </h5>
                                    <img class="m-0" src="{{asset('static/website/images/icons/copy.svg')}}" />
                                </div>
                                <p>Dummy text of the printing and life setting industry</p>
                            </div>
                            <div class="coupon">
                                <div class="d-flex mt-1 justify-content-center">
                                    <h5 class="coupon-code center d-flex">
                                        LMN2020
                                    </h5>
                                    <img class="m-0" src="{{asset('static/website/images/icons/copy.svg')}}" />
                                </div>
                                <p>Dummy text of the printing and life setting industry</p>
                            </div>
                        </div>
                    </div>
                    <!-- Payment -->
                    <div class="mt-2">
                        <h6 class="ml-1 "> Select the payment method:</h6>
                        <div class="d-flex row  justify-content-between p-2 mr-1 pl-3 ">
                            <div class="col-md-2.5  card  bg-turnblue card-methord ">
                                <img style="width: 90px;" class="mt-1" src="{{asset('static/website/images/icons/upi.svg')}}" />
                                <p class=" center p-2 -mt-10 text-white">UPI Payment</p>


                            </div>
                            <div class="card col-md-2.5    bg-turnblue card-methord p-2">
                                <img class="mt-1" src="{{asset('static/website/images/icons/upi1.svg')}}" />
                                <p class=" center  p-2 text-white">Net Banking</p>

                            </div>
                            <div class="card col-md-2.5   bg-turnblue card-methord ">
                                <img class="mt-1 pt-2" src="{{asset('static/website/images/icons/upi2.svg')}}" />
                                <p class=" center p-2 text-white">Debit Card</p>


                            </div>
                            <div class="card col-md-2.5   bg-turnblue card-methord ">
                                <img class="mt-1 pt-2" src="{{asset('static/website/images/icons/upi3.svg')}}" />
                                <p class=" center p-2 text-white">Credit Card</p>
                            </div>
                        </div>
                    </div>
                    <div style="float: right;" class="btn-proceed mr-2 mt-2 ">
                        <a href="{{route('my-bookings')}}">
                            <button type="submit" class="btn btn-theme-bg  white-bg">Proceed

                            </button>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
