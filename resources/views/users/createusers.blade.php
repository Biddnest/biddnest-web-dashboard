@extends('layouts.app')
@section('title') Users And Roles @endsection
@section('content')

 <!-- Main Content -->
 <div class="main-content grey-bg" data-barba="container" data-barba-namespace="createusersandroles">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4 theme-text">Add New User</h3>
    </div>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left p-2 pt-0 pb-0">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="users-roles.html"> Users & Roles</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add New User</li>
            </ol>
          </nav>
        </div>
    </div>

    <!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
        <div class="col-sm-10">
            <div class="card  h-auto p-0 pt-10 ">
                <div class="card-head right text-left  p-8 pt-10 pb-0">
                    <h3 class="f-18">
                        <ul class="nav nav-tabs pt-10 p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active p-15" id="new-order-tab" data-toggle="tab" href="#order" role="tab" aria-controls="home" aria-selected="true">Add New User</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation"
                                    href="#" >Banking Details</a>
                            </li>
                        </ul>
                    </h3>
                </div>
                <div class="tab-content margin-topneg-7 border-top" id="myTabContent">

                    <div class="tab-pane fade show active" id="order" role="tabpanel" aria-labelledby="new-order-tab">
                        <!-- form starts -->
                        <form class="form-new-order pt-4 mt-3 onboard-vendor-form input-text-blue">
                            <div class="d-flex row p-20">
                                <div class="col-sm-6">
                                    <p class="img-label">Image</p>
                                    <div class="upload-section p-20 pt-0">
                                        <img src="{{asset('static/images/upload-image.svg')}}" alt="">
                                        <div class="ml-1">
                                            <!-- <button class="btn theme-bg white-text my-0">UPLOAD IMAGE</button> -->
                                            <div class="file-upload">
                                                <input type="file">
                                                <button class="btn theme-bg white-text my-0">UPLOAD IMAGE</button>
                                            </div>
                                            <p>Max File size: 1MB</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <p class="theme-text">Status</p>
                                    <div class="form-input">
                                        <div class="d-flex justify-content-start   margin-topneg-20 white-text small-switch">
                                            <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-width="100" data-height="35" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-on="YES" data-off="NO" id="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex row p-20">
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Employee First Name</label>
                                        <input type="text" id="fullname" placeholder="David" class="form-control">
                                        <span class="error-message">Please enter valid First Name</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Employee Last Name</label>
                                            <input type="text" id="fullname" placeholder="Jerome" class="form-control">
                                            <span class="error-message">Please enter valid Last Name</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Employee ID/ Username</label>
                                        <input type="text" id="fullname" placeholder="0016" class="form-control">
                                        <span class="error-message">Please enter valid</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Employee Password</label>
                                        <input type="password" id="fullname" placeholder="Password" class="form-control">
                                        <span class="error-message">Please enter valid Password</span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Employee Role</label>
                                        <select id="role" name="role" class="form-control" required>
                                            <option value="">--Select--</option>
                                            @foreach(\App\Enums\AdminEnums::$ROLES as $key=>$role)
                                                <option value="{{$role}}">{{ucfirst(trans($key))}}</option>
                                            @endforeach
                                        </select>
                                        <span class="error-message">Please enter valid</span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Manager Name</label>
                                    <input type="text" id="fullname" placeholder="0016" class="form-control">
                                    <span class="error-message">Please enter valid</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="phone-num-lable">Phone Number</label>
                                    <span class="">
                                        <input type="tel" id="phone"
                                            placeholder="987654321"
                                            class=" form-control form-control-tel">
                                        <span class="error-message">Please enter valid
                                            Phone number</span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="phone-num-lable">Alternate Phone Number</label>
                                    <span class="">
                                        <input type="tel" id="phone-1"
                                            placeholder="987654321"
                                            class=" form-control form-control-tel">
                                        <span class="error-message">Please enter valid
                                            Phone number</span>
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Email ID</label>
                                    <input type="email" id="email" placeholder="0016" class="form-control">
                                    <span class="error-message">Please enter valid</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="phone-num-lable">Gender</label>
                                    <select  id="" class="form-control">
                                        <option >Female</option>
                                        <option>Male</option>
                                        <option>Other</option>
                                    </select>
                                    <span class="error-message">Please enter valid Phone number</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Educational Details</label>
                                    <input type="text" id="fullname" placeholder="btech Mechanical" class="form-control">
                                    <span class="error-message">Please enter valid</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Date of Birth</label>
                                    <input type="text" class="dateselect form-control br-5" required="required"  placeholder="15/02/2021"/>
                                    <span class="error-message">Please enter valid</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">PAN Card Number</label>
                                    <input type="text" id="fullname" placeholder="btech Mechanical" class="form-control">
                                    <span class="error-message">Please enter valid</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Aadhar Card Number</label>
                                    <input type="text" id="fullname" placeholder="btech Mechanical" class="form-control">
                                    <span class="error-message">Please enter valid</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Address Line 1</label>
                                    <input type="text" id="fullname" placeholder="" class="form-control">
                                    <span class="error-message">Please enter validAddress Line</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Address Line 2</label>
                                    <input type="text" id="fullname" placeholder="" class="form-control">
                                    <span class="error-message">Please enter valid Address Line</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">State</label>
                                    <select  id="" class="form-control">
                                        <option >State 1</option>
                                        <option>State 2</option>
                                        <option>State 3</option>
                                    </select>
                                    <span class="error-message">Please enter valid Landmark</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">City</label>
                                    <input type="text" id="fullname" placeholder="" class="form-control">
                                    <span class="error-message">Please enter valid Zone</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Pincode</label>
                                    <input type="text" id="fullname" placeholder="" class="form-control">
                                    <span class="error-message">Please enter valid Pincode</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Date of Joining</label>
                                        <input type="text" class="dateselect form-control br-5" required="required"  placeholder="15/02/2021"/>
                                        <span class="error-message">Please enter valid Pincode</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Date of Relieving</label>
                                        <input type="text" class="dateselect form-control br-5" required="required"  placeholder="15/02/2021"/>
                                        <span class="error-message">Please enter valid Pincode</span>
                                </div>
                            </div>
                        </div>
                        <div class="" id="comments">
                            <div class="d-flex  justify-content-between flex-row ml-20 p-10 py-0 " style="border-top: 1px solid #70707040;">
                                <div class="w-50">
                                    <a class="white-text p-10" href="#">
                                        <button class="btn theme-br theme-text w-30 white-bg">Cancel</button>
                                    </a>
                                </div>
                                <div class="w-50 text-right">
                                    <a class="white-text p-10">
                                        <button class="btn theme-bg white-text w-30">Next</button>
                                    </a>
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

 @endsection
