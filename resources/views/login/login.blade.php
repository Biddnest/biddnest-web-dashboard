@extends('login_layout.app')

@section('content')
<main data-barba="container" data-barba-namespace="login">
    <div class="loader"></div>
    <div class="container-fluid" >
        <div class="row ">
            <!-- IMAGE CONTAINER BEGIN  login-graphics-->
            <div class="col-sm-6 p-0">
                <img src="{{ asset('static/images/Background.png') }}" width="90%" height="100%">
            </div>
            <!-- IMAGE CONTAINER END -->

            <!-- FORM CONTAINER BEGIN -->
            <div class="col-lg-6 col-md-6">				
                <div class="d-flex flex-column justify-content-center h-100 login-wrapper">
                    <!-- Company Logo -->
                    <div class="brand-wrapper text-center mb-3 mt-1">
                    <div class="brand-logo ">
                        
                        <img class="logo" src="{{ asset('static/images/violet_logo.png') }}" width="50%" />
                    </div>
                    <hr class="logo-seprator">
                <div class="tagline text-center"> <span>Make your move simple</span></div>
                    </div>

                    <h3 class="text-center">Login</h3>
                    
                    
                <!-- Form -->
                    <form class="px-3 login" action="{{route('admin_login')}}" method="POST" onsubmit="return false;" data-next="redirect" data-url="{{route('dashboard')}}" data-parsley-validate>
                        <!-- Input Box -->
                        <div class="form-input">
                        <label>E-mail</label>
                        <span class="">
                            <input type="email" name="email" placeholder="error@gmail.com" tabindex="10" required class="form-control ">
                            <span class="error-message">Please enter  valid Email</span>
                        </span>
                        
                            
                        </div>
                        <div class="form-input isinvalid">
                        <label>Password</label>
                        <span>
                            <input type="password" name="password" placeholder="Password" required class="form-control" >
                            <span class="error-message">Please enter the correct password</span>
                        </span>
                            
                        </div>

                        
                        <!-- <a type="submit" href="{{ route('dashboard') }}" class="btn btn-block">Login</a> -->
                        <button type="submit" class="btn btn-block">Login</button>
                        
                        <div class="text-center"> 
                        <a class="link-regular" href="{{ route('forgotpassword') }}">Forgot Password?</a>
                        </div>

                    </form>

                </div>					
            </div>
            <!-- FORM CONTAINER END -->
        </div>
    </div>
    
</main>

@endsection