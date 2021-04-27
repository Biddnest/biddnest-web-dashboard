@extends('layouts.app')
@section('title') Users And Roles @endsection
@section('content')

 <!-- Main Content -->
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="usersandroles">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4">User Details</h3>
    </div>

    <!-- Dashboard cards -->


    <div class="d-flex flex-row  Dashboard-lcards  justify-content-center">
        <div class=" col-sm-10" >
             <div class="card  h-auto p-0 pt-10 " >
                <div class="card-head right text-center  pt-10">
                    <div class="d-flex justify-content-between">
                        <h3>
                            <ul class="nav nav-tabs pt-20 justify-content-start p-0 flex-row f-18" id="myTab" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link active p-15" id="customer-details-tab" data-toggle="tab" href="#customer-details" role="tab" aria-controls="home" aria-selected="true">User Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="#vendor-details" role="tab" aria-controls="profile" aria-selected="false">Banking Details</a>
                                </li>
                            </ul>
                        </h3>
                        <div class="eidt-icon margin-r-20 vertical-center p-10">
                            <a href="{{route('edit-users', ["id"=>$users->id])}}"><i class="fa fa-pencil p-1 cursor-pointer theme-text" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="tab-content border-top margin-topneg-7" id="myTabContent">
                    <div class="tab-pane fade show active" id="customer-details" role="tabpanel" aria-labelledby="customer-details-tab">

                        <div class="d-flex  row p-15 pb-0" >

                            <div class="col-sm-4 secondg-bg margin-topneg-15 pt-10">
                                <div class="theme-text f-14 bold p-10">
                                    <div class="d-flex justify-content-between">
                                        <figure class="">
                                            <img src="{{$users->image}}" alt="">
                                        </figure>
                                        <div class="profile-details">
                                            <p class="profile-name">{{ucfirst(trans($users->fname))}} {{ucfirst(trans($users->lname))}}</p>
                                            <p class="profile-id">d{{$users->email}}</p>
                                            <p class="profile-num">{{$users->phone}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="theme-text f-14 bold p-10">
                                    Employee Role
                                </div>
                                <div class="theme-text f-14 bold p-10">
                                    Manager Name
                                </div>
                                <div class="theme-text f-14 bold p-10">
                                    Alternate Phone number
                                </div>
                                <div class="theme-text f-14 bold p-10">
                                    Gender
                                </div>
                                <div class="theme-text f-14 bold p-10">
                                    Date of Birth
                                </div>
                                <div class="theme-text f-14 bold p-10">
                                    PAN Card Number
                                </div>
                                <div class="theme-text f-14 bold p-10">
                                    Address
                                </div>
                            </div>

                            <div class="col-sm-7 white-bg  margin-topneg-15  pt-10">

                                <div class="theme-text f-14 p-10">
                                    <p class="theme-text">Status</p>
                                    <div class="form-input">

                                        <div class="d-flex justify-content-start vertical-center theme-text margin-topneg-15">
                                            <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-width="80" data-height="30" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-on="Active" data-off="Inactive" id="">
                                        </div>
                                    </div>
                                </div>

                                <div class="theme-text f-14 p-10">
                                    @foreach(\App\Enums\AdminEnums::$ROLES as $roles=>$key)
                                        @if($key == $users->role)
                                            <div class="status-badge">{{$roles}}</div>
                                        @endif
                                    @endforeach
                                </div>
                              <div class="theme-text f-14 p-10">
                                  @if(json_decode($users->meta, true)['manager_name']){{ucfirst(trans(json_decode($users->meta, true)['manager_name']))}}@endif
                              </div>
                              <div class="theme-text f-14 p-10">
                                +91 {{json_decode($users->meta, true)['alt_phone']}}
                              </div>
                              <div class="theme-text f-14 p-10">
                                  {{ucfirst(trans(json_decode($users->meta, true)['gender']))}}
                              </div>
                              <div class="theme-text f-14 p-10 ">
                                  {{date('d M y', strtotime($users->dob))}}
                              </div>
                              <div class="theme-text f-14 p-10">
                                  {{json_decode($users->meta, true)['pan_no']}}
                              </div>
                              <div class="theme-text f-14 p-10 ">
                                  {{json_decode($users->meta, true)['address_line1']}} {{json_decode($users->meta, true)['address_line2']}}
                              </div>
                            </div>

                        </div>

                        {{--<div class="border-top-3">
                            <div class="d-flex justify-content-between">
                                <div class="w-100">
        --}}{{--                            <a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Back</button></a>--}}{{--
                                </div>
                                <div class="w-100 margin-r-20">
                                    <div class="d-flex justify-content-end">
                                     <div></div>
                                        <button  class="btn white-text theme-bg w-30">Next</button>
                                    </div>

                                </div>
                            </div>

                        </div>--}}

                    </div>
                    <div class="tab-pane fade   " id="vendor-details" role="tabpanel" aria-labelledby="vendor-tab">

                        <div class="d-flex  row p-15 pb-0 " >
                        @if($users->bank_meta)
                            <div class="col-sm-4 secondg-bg  margin-topneg-15 pt-10">
                              <div class="theme-text f-14 bold p-10">
                                Account Number
                              </div>
                              <div class="theme-text f-14 bold p-10">
                                Bank Name
                              </div>
                              <div class="theme-text f-14 bold p-10">
                                Account Holder Name
                              </div>
                              <div class="theme-text f-14 bold p-10">
                                IFSC Code
                              </div>
                              <div class="theme-text f-14 bold p-10">
                                Branch Name
                              </div>
                            </div>

                            <div class="col-sm-7 white-bg  margin-topneg-15 pt-10">
                                <div class="theme-text f-14 p-10">
                                    {{json_decode($users->bank_meta, true)['acc_no'] ?? ''}}
                              </div>
                              <div class="theme-text f-14 p-10">
                                  {{json_decode($users->bank_meta, true)['bank_name'] ?? ''}}
                              </div>
                              <div class="theme-text f-14 p-10">
                                  {{json_decode($users->bank_meta, true)['holder_name'] ?? ''}}
                              </div>
                              <div class="theme-text f-14 p-10">
                                  {{json_decode($users->bank_meta, true)['ifsc'] ?? ''}}
                              </div>
                              <div class="theme-text f-14 p-10">
                                  {{json_decode($users->bank_meta, true)['branch_name'] ?? ''}}
                              </div>
                                @else
                                    <div class="row hide-on-data">
                                        <div class="col-md-12 text-center p-20">
                                            <p class="font14"><i>. Bank Details not availablt.</i></p>
                                        </div>
                                    </div>
                                @endif
                  </div>

                        </div>
                        {{--<div class="border-top-3">
                                <div class="d-flex justify-content-start">
                                    <div class="w-50">
                                        <a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>
                                    </div>
                                    <div class="w-50 margin-r-20">
                                        <div class="d-flex justify-content-end">
                                         <button  class="btn theme-text white-bg theme-br w-30 mr-20">Back</button>
                    --}}{{--                        <button  class="btn white-text theme-bg w-30" >Next</button>--}}{{--
                                        </div>

                                    </div>
                                </div>

                        </div>--}}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
