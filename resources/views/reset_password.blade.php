@extends('layouts.app')
@section('title') General Pages Settings @endsection
@section('content')

    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="passwordreset">
        <div class="d-flex  flex-row justify-content-between">
            <h3 class="page-head text-left p-4 theme-text">General Settings</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left p-4 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('pages')}}">General Settings</li>
                        <li class="breadcrumb-item active" aria-current="page">Reset Password</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-sm-10">
                <div class="card  h-auto p-0 pt-10 ">
                    <div class="card-head right text-left border-bottom-2 p-10 pt-20">
                        <h3 class="f-18 theme-text pl-2 ml-1 mt-1 mb-2">
                            Reset Password
                        </h3>
                    </div>
                    <form action="{{route('old_reset_password')}}" method="POST" data-next="redirect" data-redirect-type="hard" data-url="{{route('login')}}" data-alert="tiny" class="form-new-order" id="myForm" autocomplete="off" data-parsley-validate style="width: 50%; align-self: center;">
                        <input type="hidden" value="{{\Illuminate\Support\Facades\Session::get('account')['id']}}" name="bearer" required class="form-control">
                        <div class="form-input">
                            <label>Old Password</label>
                            <input type="password" id="old_password" name="old_password" placeholder="Old Password" tabindex="10" required class="form-control">
                            <span class="error-message">Please enter the correct password</span>
                        </div>
                        <div class="form-input">
                            <label>New Password</label>
                            <input type="password" id="password" name="password" placeholder="New Password" tabindex="10" required class="form-control">
                            <span class="error-message">Please enter the correct password</span>
                        </div>
                        <div class="form-input isinvalid">
                            <label>Confirm New Password</label>
                            <input type="password" name="password_confirmation" placeholder="Confirm Password" id="confirm_password" required class="form-control" data-parsley-equalto="#password" data-parsley-error-message="Password doesn't match!">

                        </div>
                        <a href="#" class="text-decoration-none"><button type="submit" class="btn  btn-block">Submit</button></a>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
