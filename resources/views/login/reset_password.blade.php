@extends('login_layout.app')

@section('content')

<main data-barba="container" data-barba-namespace="resetpassword">
<div class="loader"></div>
        <div class="container-fluid">
            <div class="row ">
                <!-- IMAGE CONTAINER BEGIN -->
                <div class="col-lg-6 col-md-6 login-graphics h-100"></div>
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

                           <h3 class="text-center">Change Password</h3>
                          
                        
                    <!-- Form -->
                        <form class="px-3 login">
                            <!-- Input Box -->
                            <div class="form-input">
                               <label>New Password</label>
                               <span class="">
                                <input type="password" name="" placeholder="New Password" tabindex="10" required class="form-control">
                                <span class="error-message">Please enter the correct password</span>
                               </span>
                              
                                
                            </div>
                            <div class="form-input isinvalid">
                               <label>Confirm New Password</label>
                               <span>
                                <input type="password" name="" placeholder="Confirm Password" required class="form-control ">
                                <span class="error-message">Please enter the correct password</span>
                               </span>
                                
                            </div>

                             
                               <a href="{{ route('verifyotp') }}" class="text-decoration-none"><button type="submit" class="btn  btn-block">Submit</button></a> 
                            
                            
                            <div class="text-center"> 
                               <a class="link-regular" href="{{ route('login') }}">Login now</a>
                            </div>

                        </form>

                    </div>					
                </div>
                <!-- FORM CONTAINER END -->
            </div>
        </div>
</main>

@endsection