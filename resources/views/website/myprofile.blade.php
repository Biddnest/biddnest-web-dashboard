@extends('website.layouts.frame')
@section('title')My Profile @endsection
@section('header_title') My Profile @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="myprofile">
        <div class="container">
            <div class="quote responsive w-70 ontop p-4 bg-white">
                <div class="card-head right text-left p-8 pt-10 pb-0">
                    <h3 class="f-18">
                        <ul class="nav nav-tabs pt-10 p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active p-15" id="new-order-tab" data-toggle="tab" href="#order" role="tab" aria-controls="home" aria-selected="true">My Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15"   href="{{route('my-bookings-enquiries')}}">Enquiries</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15"   href="{{route('my-bookings')}}">Ongoing Booking</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15"   href="{{route('order-history')}}">Booking History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15"  href="{{route('my-request')}}">My Requests</a>
                            </li>
                        </ul>
                    </h3>
                </div>
                <div class="tab-content margin-topneg-7 border-top" id="myTabContent">
                    <div class="tab-pane fade show active" id="order" role="tabpanel" aria-labelledby="new-order-tab">
                        <div class="row">
                            <div class="col-md-2 col-xs-12 col-sm-12 mt-5 margin-pro">
                                    @if($user->avatar)
                                        <img class="default-image" src="{{$user->avatar}}" style="border-radius: 50%">
                                    @else
                                        <div class="profile-picture">
                                            <i class="fa fa-user fa-4x"></i>
                                        </div>
                                    @endif
                            </div>
                            <div class="col-md-9 f-16 mt-1 ">
                                <div class="top-aliments  d-flex justify-content-between">
                                    <div class="col">
                                        <div>
                                            <p class="mb-0 l-cap">
                                                First Name
                                            </p>
                                            <p class="fw-500 f-18">
                                               {{ucwords($user->fname)}}
                                            </p>

                                        </div>
                                        <div>
                                            <p class="mt-2 mb-0  l-cap">
                                                Email Id</p>
                                            <p class="fw-500 f-18">
                                                {{$user->email}}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="mt-2 mb-0  l-cap">
                                                Gender
                                            </p>
                                            <p class="fw-500 f-18">
                                                {{$user->gender}}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            <p class="mt-2 mb-0 l-cap">Last Name</p>
                                            <p class="fw-500 f-18">{{ucwords($user->lname)}}</p>
                                        </div>
                                        <div>
                                            <p class="mt-2 mb-0  l-cap">Phone Number </p>
                                            <p class="fw-500 f-18">{{$user->phone}}</p>
                                        </div>
                                        <div>
                                            <p class="mt-2 mb-0  l-cap">Date of Birth </p>
                                            <p class="fw-500 f-18">{{date('d M Y', strtotime($user->dob))}}</p>
                                        </div>
                                    </div>
                                    <div class="col d-flex justify-content-end">
                                        <div class=" mt-2">
                                            <i data-toggle="modal" data-target="#edit-profile" class="icon dripicons-pencil cursor-pointer"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>



                            <div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                                <div class="modal-dialog para-head input-text-blue" role="document">
                                    <div class="modal-content w-90 w-1000 mt-50 right-25 ml-4 ">
                                        <div class="modal-header bg-purple">
                                            <h5 class="modal-title m-0-auto -mr-30 text-white" id="exampleModalLongTitle ">
                                                Edit Profile
                                            </h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-15 margin-topneg-7">
                                            <form action="{{route('profile_edit')}}" method="PUT" data-next="redirect" data-redirect-type="hard" data-url="{{route('website.my-profile')}}" data-alert="mega" class="form-new-order  input-text-blue" data-parsley-validate >
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="hor-center mb-2"  style=" display: flex !important; justify-content: center  !important; flex-direction: column  !important; align-items: center  !important;">
                                                            <p class="img-label">Image</p>
                                                            <div class="upload-section p-20 pt-0">
                                                                <img style="border-radius: 50%; margin-left: 10px; margin-bottom: 10px;" src="@if($user->avatar){{$user->avatar}}@else{{asset('static/website/images/icons/profile-circle.svg')}}@endif" />
                                                                <div class="ml-1">
                                                                    <div class="file-upload">
                                                                        <input type="hidden" class="base-holder" id="image" name="image" value="{{$user->avatar}}" required/>
                                                                        <button class="btn f-10 btn-theme-bg white-text my-0"> UPLOAD IMAGE</button>
                                                                        <input type="file" accept=".png,.jpg,.jpeg" @if(!$user->avatar) required @endif/>
                                                                    </div>

                                                                    <p class="text-muted pl-0">Max File size: 1MB</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-xs-12 mt-1">
                                                        <div class="form-group">
                                                            <input type="hidden" value="{{$user->id}}" name="id">
                                                            <label for="formGroupExampleInput">First Name</label>
                                                            <input type="text" class="form-control" id="formGroupExampleInput" name="fname" value="@if($user->fname){{$user->fname}}@endif" placeholder="David" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-xs-12 mt-1">
                                                        <div class="form-group">
                                                            <label for="formGroupExampleInput2">Last Name</label>
                                                            <input type="text" class="form-control" id="formGroupExampleInput2" name="lname" value="@if($user->lname){{$user->lname}}@endif" placeholder="Jeromi" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="formGroupExampleInput">Email ID</label>
                                                            <input type="email" class="form-control" id="formGroupExampleInput" name="email" value="@if($user->lname){{$user->email}}@endif" placeholder="davidjeromi@gmail.com" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="formGroupExampleInput2">Phone Number</label>
                                                            <input type="number" class="form-control" id="formGroupExampleInput2" name="phone" value="@if($user->phone){{$user->phone}}@endif" placeholder="9739912345" readonly/>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 -mt-10">
                                                        <div class="form-input">
                                                            <label class="phone-num-lable f-14">Gender</label>
                                                            <select id="" class="form-control" name="gender" required>
                                                                <option value="">--Select--</option>
                                                                <option value="male" @if($user->gender == "male") Selected @endif>Male</option>
                                                                <option value="female" @if($user->gender == "female") Selected @endif>Female</option>
                                                                <option value="other" @if($user->gender == "other") Selected @endif>Other</option>
                                                            </select>
                                                        <span class="error-message">Please enter valid Gender</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="start-date">Date of Birth</label>
                                                            <div id="my-modal">
                                                                <input type="text" id="dateselect" name="dob" value="@if($user->dob){{$user->dob}}@endif" class="filterdate dateselect form-control br-5" placeholder=" 15/02/2021" />
                                                                <span class="error-message">please enter valid date</span>
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="accordion" id="comments">
                                                    <div class="button-bottom d-flex justify-content-between pt-4">
                                                        <div class="">
                                                            <a class="white-text" href="{{route('website.my-profile')}}">
                                                                <button type="button" class="btn btn-theme-w-bg f-14">
                                                                    cancel
                                                                </button>
                                                            </a>
                                                        </div>
                                                        <div class="">
                                                            <button type="submit" class="btn btn-theme-bg white-bg f-14">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
