<div class="modal-header pb-0">
    <div class="d-flex justify-content-between">
        <ul class="nav nav-tabs pt-20 justify-content-start p-0 flex-row f-18" id="myTab" role="tablist">
            <li class="nav-item ">
                <a class="nav-link active pb-15" id="customer-details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="home" aria-selected="true">User Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link pb-15" id="vendor-tab" data-toggle="tab" href="#Banking" role="tab" aria-controls="profile" aria-selected="false">Banking Details</a>
            </li>
        </ul>
    </div>
    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
        <!-- <span aria-hidden="true" >&times;</span> -->
        <i class="fa fa-times theme-text" aria-hidden="true"></i>
    </button>
</div>
<div class="modal-body">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active " id="details" role="tabpanel" aria-labelledby="zone-tab">
            <!-- form starts -->
            <div class="d-flex  row  p-10">
                <div class="col-sm-12">
                    <div class="theme-text f-14 bold">
                        <div class="d-flex justify-content-around ">
                            <figure>
                                <img src="{{$users->image}}" alt="">
                            </figure>
                            <div class="profile-details">
                                <p class="profile-name">{{ucfirst(trans($users->fname))}} {{ucfirst(trans($users->lname))}}</p>
                                <p class="profile-id">{{$users->email}}</p>
                                <p class="profile-num">{{$users->phone}}</p>
                            </div>
                            <div class="profile-switch">
                                <div class="theme-text f-14 p-05">
                                    <a href="{{route('edit-users', ["id"=>$users->id])}}"><i class="icon dripicons-pencil p-1 cursor-pointer " aria-hidden="true"></i></a>
                                </div>
                                <label class="switch-small">
                                    <input type="checkbox" id="switch" {{($users->status == \App\Enums\CommonEnums::$YES) ? 'checked' : ''}}  class="change_status cursor-pointer" data-url="{{route('user_status_update',['id'=>$users->id])}}">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Employee Role
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        @foreach(\App\Enums\AdminEnums::$ROLES as $roles=>$key)
                            @if($key == $users->role)
                                <div class="status-badge">{{$roles}}</div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Manager Name
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        <div class="d-flex vertical-center">
                            {{ucfirst(trans(json_decode($users->meta, true)['manager_name']))}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Alternate Phone number
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        +91 {{json_decode($users->meta, true)['alt_phone']}}
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Gender
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        {{ucfirst(trans(json_decode($users->meta, true)['gender']))}}
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Date of Birth
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        {{date('d M y', strtotime($users->dob))}}
                    </div>
                </div>
            </div>

            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        PAN Card Number
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        {{json_decode($users->meta, true)['pan_no']}}
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Address
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        {{json_decode($users->meta, true)['address_line1']}} {{json_decode($users->meta, true)['address_line2']}}
                    </div>
                </div>
            </div>
            <div class="d-flex   justify-content-center p-10">
                <div class="">
                    <a class="white-text p-10" href="{{route('details_user', ['id'=>$users->id])}}" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                        <button class="btn theme-bg white-text">View More</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="tab-pane fade  " id="Banking" role="tabpanel" aria-labelledby="zone-insight-tab">
            @if($users->bank_meta)
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Account Number
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="theme-text f-14">
                        {{json_decode($users->bank_meta, true)['acc_no'] ?? ''}}
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Bank Name
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        {{json_decode($users->bank_meta, true)['bank_name'] ?? ''}}
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Account Holder Name
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        {{json_decode($users->bank_meta, true)['holder_name'] ?? ''}}
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        IFSC Code
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        {{json_decode($users->bank_meta, true)['ifsc'] ?? ''}}
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Branch Name
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        {{json_decode($users->bank_meta, true)['branch_name'] ?? ''}}
                    </div>
                </div>
            </div>
            @else
                <div class="row hide-on-data">
                    <div class="col-md-12 text-center p-20">
                        <p class="font14"><i>. Bank Details not availablt.</i></p>
                    </div>
                </div>
            @endif

            <div class="d-flex   justify-content-center p-10">
                <div class="">
                    <a class="white-text p-10" href="{{route('details_user', ['id'=>$users->id])}}" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                        <button class="btn theme-bg white-text">View More</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
