
@extends('login_layout.app')
@section('title') Forgot Password @endsection
@section('content')
<main  data-barba="container" data-barba-namespace="forgotpassword">
<div class="loader"></div>
    <div class="container-fluid">
        <div class="row ">
            <!-- IMAGE CONTAINER BEGIN -->
            <div class="col-sm-6 p-0">
                <img src="{{ asset('static/images/Background.png') }}" width="90%" height="100%">
            </div>
            <!-- IMAGE CONTAINER END  login-graphics-->

            <!-- FORM CONTAINER BEGIN -->
            <div class="col-lg-6 col-md-6">
                <div class="d-flex flex-column justify-content-center h-100 login-wrapper">
                    <!-- Company Logo -->
                    <div class="brand-wrapper text-center mb-3 mt-1">
                        <div class="brand-logo">

                            <img class="logo" src="{{ asset('static/images/violet_logo.png') }}"  width="50%"/>
                        </div>
                        <hr class="logo-seprator">
                        <div class="tagline text-center"> <span>Make your move simple!</span></div>
                    </div>

                    <h3 class="text-center">Forgot Password</h3>
                <!-- Form -->
                    <form class="px-3 login vendor-pass-reset" data-alert="inline" action="{{route('api.vendor_send_otp')}}" method="POST" onsubmit="return false;" data-next="redirect" {{--data-redirect-type="hard"--}} data-url="{{route('vendor.verifyotp',["phone"=>":phone"])}}" data-parsley-validate>
                        <!-- Input Box -->
                        <div class="form-input">
                        <label>Phone</label>
                        <span>
                            <input type="phone" name="phone" placeholder="" tabindex="10" required class="form-control">
                            <span class="error-message">Please enter valid Phone</span>
                        </span>

                        </div>
{{--                        <a  class="btn  btn-block" href="#">SEND OTP</a>--}}
                        <button type="submit" class="btn btn-block">SEND OTP</button>
                    </form>
                </div>
            </div>
            <!-- FORM CONTAINER END -->
        </div>
    </div>
</main>

@endsection
