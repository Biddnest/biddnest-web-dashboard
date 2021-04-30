@extends('vendor-panel.auth.login_layout')
@section('title') Login @endsection
@section('body')
    <div class="d-flex flex-column justify-content-center h-100 login-wrapper">
        <!-- Company Logo -->
        <div class="brand-wrapper text-center mb-3 mt-1">
            <div class="brand-logo ">

                <img class="logo" src="{{ asset('static/vendor/images/violet_logo.png') }}" width="50%" />
            </div>
            <hr class="logo-seprator">
            <div class="tagline text-center"> <span>Make your move simple</span></div>
        </div>

        <h3 class="text-center">Login</h3>


        <!-- Form -->
        <form class="px-3 login">
            <!-- Input Box -->
            <div class="form-input">
                <label>E-mail</label>
                <input type="email" name="" placeholder="error@gmail.com" tabindex="10" required class="form-control ">
                <span class="error-message">Please enter  valid Email</span>
            </div>
            <div class="form-input isinvalid">
                <label>Password</label>
                <input type="password" name="" placeholder="Password" required class="form-control ">
                <span class="error-message">Please enter the correct password</span>
            </div>

            <button type="submit" class="btn btn-block">Login</button>
            <div class="text-center">
                <a class="link-regular" href="#">Forgot Password?</a>
            </div>

        </form>

    </div>
@endsection
