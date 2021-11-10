<div class="modal-header pb-0 border-none">
    <h3 class="f-18 p-15">
        Manage User Roles
    </h3>
    <button type="button" class="close theme-text margin-topneg-10" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
        <!-- <span aria-hidden="true" >&times;</span> -->
        <i class="icon dripicons-cross theme-text" aria-hidden="true"></i>
    </button>
</div>
<div class="modal-body border-top margin-topneg-7">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active " id="details" role="tabpanel"
             aria-labelledby="zone-tab">
            <!-- form starts -->
            <div class="d-flex  row  p-10">
                <div class="col-sm-12">
                    <div class="theme-text f-14 bold">
                        <div class="d-flex justify-content-around">
                            <figure>
                                <img src="{{$user->image ?? ''}}" alt="">
                            </figure>
                            <div class="profile-details ml-3">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex mb-0">
                                        <p class="profile-name mb-0">{{ucwords($user->fname)}} {{ucwords($user->lname)}}</p>
                                    </div>
                                </div>
                                <p class="profile-id  mb-0 mt-0 f-weight-400">{{ucwords($user->email)}}</p>
                                <p class="profile-num f-weight-400">{{ucwords($user->phone)}}</p>
                            </div>
                            <div class="profile-switch">
                                <div class="theme-text f-14 p-05">
                                   <a href="{{route('vendor.editusermgt', ['id'=>$user->id])}}"><i class="icon dripicons-pencil p-1 cursor-pointer " aria-hidden="true"></i></a>
                                </div>
                                <label class="switch-small">
                                    <input type="checkbox" id="switch"  class="change_status cursor-pointer"  data-url="{{route('api.user.status',['id'=>$user->id])}}">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-8">
                <div class="col-sm-6">
                    <div class="text-drawer f-14 ">
                        Employee Role
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        <div class="status-badge">
                            @foreach(\App\Enums\VendorEnums::$ROLES as $role=>$key)
                                @if($key == $user->user_role)
                                    {{ucwords($role)}}
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-8">
                <div class="col-sm-6">
                    <div class="text-drawer f-14 ">
                        Branch Name
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 d-flex justify-content-between">
                        {{ucwords($user->organization->city)}}
                    </div>
                </div>
            </div>

            <div class="d-flex  row  p-8">
                <div class="col-sm-6">
                    <div class="text-drawer f-14 ">
                        Date of Birth
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 d-flex justify-content-between">
                        {{date('dd/mm/Y', strtotime($user->dob)) ?? '-'}}
                    </div>
                </div>
            </div>

            <div class="d-flex  row  p-8">
                <div class="col-sm-6">
                    <div class="text-drawer f-14 ">
                        Date of Joining
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 d-flex justify-content-between">
                        {{date('d/M/Y', strtotime($user->doj)) ?? '-'}}
                    </div>
                </div>
            </div>

            <div class="d-flex  row  p-8">
                <div class="col-sm-6">
                    <div class="text-drawer f-14 ">
                        Date of Relieving
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 d-flex justify-content-between">
                        {{date('d/M/Y', strtotime($user->dor)) ?? '-'}}
                    </div>
                </div>
            </div>

            <div class="d-flex  row  p-8">
                <div class="col-sm-6">
                    <div class="text-drawer f-14 ">
                        Address
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 d-flex justify-content-between">
                        {{json_decode($user->meta, true)['address_line1'] ?? ''}}, {{json_decode($user->meta, true)['address_line2'] ?? ''}}
                    </div>
                </div>
            </div>

            <div class="d-flex  row  p-8">
                <div class="col-sm-6">
                    <div class="text-drawer f-14 ">
                        State,City
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        {{ucwords($user->state) ?? ''}}, {{ucwords($user->city) ?? ''}}
                    </div>
                </div>
            </div>

            {{--<div class="d-flex   justify-content-center p-10">

                <div class=""><a class="white-text p-10" href="{{route('vendor.userrole.details', ['id'=>$user->id])}}"><button
                            class="btn theme-bg white-text">View More</button></a></div>
            </div>--}}
        </div>
        <!--  -->
    </div>
</div>
