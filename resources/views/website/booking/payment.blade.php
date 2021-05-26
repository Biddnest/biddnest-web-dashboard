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
                        <h4 class="f-30">Rs {{$payment_summary['grand_total']}}</h4>
                    </div>
                    <div>
                        <p class="bold">PAYMENT SUMMARY</p>
                        <div class="d-flex justify-content-between">
                            <p class="text-muted">Sub Total </p>
                            <p>{{$payment_summary['sub_total']}}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="text-muted">Surge Charges</p>
                            <p>{{$payment_summary['surge_charge']}}</p>
                        </div>
                        <div class="d-flex justify-content-between ">
                            <p class="text-muted"> Discount</p>
                            -<p class="discount">{{$payment_summary['discount']}}</p>
                        </div>
                        <div class="d-flex justify-content-between border-bottom">
                            <p class="text-muted"> Tax ({{$payment_summary['tax_percentage']}}%)</p>
                            <p>{{$payment_summary['tax']}}</p>
                        </div>
                        <div class="mt-1 pt-1 pl-2 d-flex justify-content-between bold border-bottom">
                            <h6 class="pl-1">Grand Total</h6>
                            <h5 class="grand-total">{{$payment_summary['grand_total']}}</h5>

                        </div>
                    </div>
{{--                    <form action="{{route('verifiedcoupon')}}" method="POST" data-next="redirect" data-redirect-type="hard" data-url="{{route('verifiedpayment', ['id'=>$public_booking_id])}}" data-alert="mega" class="form-new-order mt-3 input-text-blue" data-parsley-validate>--}}
                        <div class="row d-flex justify-content-between mt-2">
                            <div class="col-md-2 col-sm-12 col-xs-12 center">
                                <p class=" mb-view pl-0">Apply Coupon Code</p>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-8">
                                <div class="input-group mb-view ">
                                    <input type="text" class="form-control h-content mb-view" name="coupon" id="coupon"  placeholder="Enter Coupon Code if any">
                                    <input type="hidden" class="form-control h-content mb-view" name="public_booking_id" id="public_booking_id" value="{{$public_booking_id}}">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2 ">
                                <button type="button" class="btn btn-theme-bg white-bg verify-coupon" id="padding-apply" data-url="{{route('verifiedcoupon')}}" data-remove-url="{{route('payment',['id'=>$public_booking_id])}}">Apply
                                    </button>
                            </div>
                        </div>
{{--                    </form>--}}

                    <!-- coupon -->
                    <div class="border-bottom ">
                        <p class="para-head mt-2 pl-1 ml-1">Available Coupons</p>
                        <div class="d-flex direction-col mb-4">
                            @foreach($coupons as $coupon)
                                <div class="coupon ml-2">
                                    <div class="d-flex mt-1 justify-content-center">
                                        <h5 class="coupon-code center d-flex">
                                            {{$coupon->code}}
                                        </h5>
                                        <a href="#" class="copy" data-code="{{$coupon->code}}"><img class="m-0" src="{{asset('static/website/images/icons/copy.svg')}}" /></a>
                                    </div>
                                    <p style="white-space:normal !important;">{!! $coupon->desc !!}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Payment -->
                    <div class="mt-2">
                        <h6 class="ml-1 "> Select the payment method:</h6>
                        <div class="d-flex row  justify-content-between mr-1 pl-3 ">
                            <div class="col-md-2.5  card  bg-turnblue card-method" data-method="upi" style="width: 22%;">
                                <img style="width: 90px;" class="mt-1" src="{{asset('static/website/images/icons/upi.svg')}}" />
                                <p class=" center p-2 -mt-10 text-white">UPI Payment</p>
                            </div>
                            <div class="card col-md-2.5    bg-turnblue card-method" data-method="netbanking" style="width: 22%;">
                                <img class="mt-1" src="{{asset('static/website/images/icons/upi1.svg')}}" />
                                <p class=" center  p-2 text-white">Net Banking</p>
                            </div>
                            <div class="card col-md-2.5   bg-turnblue card-method " data-method="card" style="width: 22%;">
                                <img class="mt-1 pt-2" src="{{asset('static/website/images/icons/upi2.svg')}}" />
                                <p class=" center p-2 text-white">Debit Card</p>
                            </div>
                            <div class="card col-md-2.5   bg-turnblue card-method " data-method="card" style="width: 22%;">
                                <img class="mt-1 pt-2" src="{{asset('static/website/images/icons/upi3.svg')}}" />
                                <p class=" center p-2 text-white">Credit Card</p>
                            </div>
                        </div>
                    </div>
                    <div style="float: right;" class="btn-proceed mr-2 mt-2 ">
                        <a class="payment" data-url="{{route('my-bookings')}}" data-amount="{{$payment_summary['grand_total']}}" data-booking="{{$public_booking_id}}" data-payment="{{route('initiate-payment')}}" data-status="{{route('complete-status')}}" data-user-name="{{ucwords($user->fname)}} {{ucwords($user->lname)}}" data-user-email="{{$user->email}}" data-user-email="{{$user->phone}}">
                            <button  class="btn btn-theme-bg  white-bg">Proceed</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
