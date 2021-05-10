
@extends('login_layout.app')
@section('title') Verify OTP @endsection
@section('content')
 <main data-barba="container" data-barba-namespace="verifyotp">
    <div class="loader"></div>
    <div class="container-fluid" >
        <div class="row ">
            <!-- IMAGE CONTAINER BEGIN login-graphics -->

            <div class="col-sm-6 p-0">
                <img src="{{ asset('static/images/Background.png') }}" width="90%" height="100%">
            </div>
            <!-- IMAGE CONTAINER END -->

            <!-- FORM CONTAINER BEGIN -->
            <div class="col-lg-6 col-md-6">
                <div class="d-flex flex-column justify-content-center h-100 login-wrapper">
                    <!-- Company Logo -->
                    <div class="brand-wrapper text-center mb-3 mt-1">
                        <div class="brand-logo">

                            <img class="logo" src="{{ asset('static/images/violet_logo.png') }}"  width="50%"/>
                        </div>
                        <hr class="logo-seprator">
                        <div class="tagline text-center"> <span>Make your move simple</span></div>
                    </div>

                    <h3 class="text-center">Forgot Password?</h3>


                <!-- Form -->
                    <form class="px-3 login form-new-order verify-otp-form" data-alert="inline" action="{{ route('api.vendor_verify_otp') }}" method="POST" onsubmit="return false;" data-next="redirect" data-redirect-type="hard" data-url="{{route('vendor.reset-passwords',['id'=>':id'])}}" data-parsley-validate>
                        <!-- Input Box -->
                        <div class="form-input">
                        <label>Phone</label>
                        <span>
                            <input type="tel" name="phone" value="{{$phone}}" placeholder="Enter Registered mobile no" maxlength="10" minlength="10" tabindex="10" required readonly class="form-control">
                        </span>

                            <span class="error-message">Please enter valid Phone</span>
                        </div>


                        <div class="form-input">
                            <label>Verify OTP</label>
                            <input class="form-control" type="number" name="otp" maxlength="6" minlength="6"/>

                            <span class="error-message">Please enter valid OTP</span>
                        </div>

                            <button type="submit" class="btn  btn-block">SUBMIT</button>


                        <div class="text-center">

                        <span class="text-center theme_text font14">Did not receive OTP?</span><a class="link-regular" href="#"> Resend</a>
                        </div>

                    </form>

                </div>
            </div>
            <!-- FORM CONTAINER END -->
        </div>
    </div>
</main>
@endsection
