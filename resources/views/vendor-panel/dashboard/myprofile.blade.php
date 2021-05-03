@extends('vendor-panel.layouts.frame')
@section('title') My Profile @endsection
@section('body')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="myprofile">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4">My Profile </h3>
    </div>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left p-2 pt-0 pb-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">User
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">My Profile
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Dashboard cards -->
    <div class="d-flex flex-row  Dashboard-lcards  justify-content-center">
        <div class=" col-sm-12">
            <!-- <div class="d-flex  flex-row text-left">
        <a href="zone-details.html" class="text-decoration-none">
            <h3 class="page-subhead text-left p-4 f-20 theme-text">
             <i class="p-1"> <img src="assets/images/Icon feather-chevrons-left.svg" alt="" srcset=""></i> Back to Zone Managment</h3></a>
     </div> -->
            <div class="card  h-auto p-0 pt-10 pb-0">
                <div class="card-head right text-center   pt-10">
                    <div class="d-flex justify-content-between">
                        <h3 class="f-18">
                            <ul class="nav nav-tabs pt-20 justify-content-start p-0 flex-row "
                                id="myTab" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link active p-15" id="customer-details-tab"
                                       data-toggle="tab" href="#customer-details" role="tab"
                                       aria-controls="home" aria-selected="true">Profile Details</a>
                                </li>
                               {{-- <li class="nav-item">
                                    <a class="nav-link p-15" id="vendor-tab" data-toggle="tab"
                                       href="#vendor-details" role="tab" aria-controls="profile"
                                       aria-selected="false">Change Password</a>
                                </li>--}}
                            </ul>
                        </h3>
                        <div class="theme-text margin-r-20 f-14 p-05">
                            <i class="icon dripicons-pencil p-1 cursor-pointer " aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="tab-content margin-topneg-7 border-top" id="myTabContent">
                    <div class="tab-pane fade show active" id="customer-details" role="tabpanel"
                         aria-labelledby="customer-details-tab">
                        <div class="d-flex  row p-15" style="padding-bottom: 0px;">
                            <div class="col-sm-4    left-section">
                                <div class="theme-text f-14 bold p-8">
                                    Organization Name
                                </div>
                                <div class="theme-text f-14 bold p-8">
                                    Vendor Type
                                </div>
                                <div class="theme-text f-14 bold p-8">
                                    Vendor ID
                                </div>
                                <div class="theme-text f-14 bold p-8">
                                    Vendor First Name
                                </div>
                                <div class="theme-text f-14 bold p-8">
                                    Vendor Last Name
                                </div>
                                <div class="theme-text f-14 bold p-8">
                                    Email ID
                                </div>
                                <div class="theme-text f-14 bold p-8 pb-20">
                                    Organization Description
                                </div>
                                <div class="theme-text f-14 bold p-8">
                                    Organization ID
                                </div>
                                <div class="theme-text f-14 bold p-8 ">
                                    Parent Branch
                                </div>
                                <div class="theme-text f-14 bold p-8">
                                    Contact Number
                                </div>
                                <div class="theme-text f-14 bold p-8">
                                    GSTIN Number
                                </div>
                                <div class="theme-text f-14 bold p-8">
                                    Address
                                </div>
                                <div class="theme-text f-14 bold p-8">
                                    Latitude
                                </div>
                                <div class="theme-text f-14 bold p-8">
                                    Longitude
                                </div>
                                <div class="theme-text f-14 bold p-8">
                                    Land Mark
                                </div>
                                <div class="theme-text f-14 bold p-8">
                                    CITY
                                </div>

                                <div class="theme-text f-14 bold p-8">
                                    Pincode
                                </div>
                                <div class="theme-text f-14 bold p-8">
                                    State
                                </div>
                                <div class="theme-text f-14 bold p-8">
                                    Zone ID
                                </div>
                                <div class="theme-text f-14 bold p-10">
                                    Categories Covered
                                </div>
                                <div class="theme-text f-14 bold p-8">
                                    Commission Rate
                                </div>

                                <div class="theme-text f-14 bold p-8">
                                    Status
                                </div>
                                <div class="theme-text f-14 bold p-8">
                                    Service Type
                                </div>
                                <div class="theme-text f-14 bold p-8">
                                    Vendor Status
                                </div>
                            </div>
                            <div class="col-sm-8 ">
                                <div class="theme-text f-14  p-8">
                                    {{ucwords($user->organization->org_name)}} {{ucwords($user->organization->org_type)}}
                                </div>
                                <div class="theme-text f-14  p-8">
                                    @foreach(\App\Enums\VendorEnums::$ROLES as $role=>$key)
                                        @if($user->user_role == $key)
                                            {{ucwords($role)}}
                                        @endif
                                    @endforeach
                                </div>
                                <div class="theme-text f-14  p-8">
                                    {{$user->id}}
                                </div>
                                <div class="theme-text f-14  p-8">
                                    {{ucwords($user->fname)}}
                                </div>
                                <div class="theme-text f-14 p-8">
                                    {{ucwords($user->lname)}}
                                </div>
                                <div class="theme-text f-14  p-8">
                                    {{$user->email}}
                                </div>
                                <div class="theme-text f-14  p-8 pb-20">
                                   {{json_decode($user->organization->meta, true)['org_description']}}
                                </div>
                                <div class="theme-text f-14  p-8">
                                    {{$user->organization->id}}
                                </div>
                                <div class="theme-text f-14  p-8">
                                    {{ucwords($branch->city)}} <span class="status-badge-3">Parent Branch</span>
                                </div>

                                <div class="theme-text f-14  p-8">
                                    {{$user->phone}}
                                </div>
                                <div class="theme-text f-14  p-8">
                                    {{json_decode($user->organization->meta, true)['gstin_no']}}
                                </div>
                                <div class="theme-text f-14  p-8">
                                    {{json_decode($user->organization->meta, true)['address']}}
                                </div>

                                <div class="theme-text f-14  p-8">
                                    {{$user->organization->lat}}
                                </div>
                                <div class="theme-text f-14  p-8">
                                    {{$user->organization->lng}}
                                </div>
                                <div class="theme-text f-14  p-8">
                                    {{json_decode($user->organization->meta, true)['landmark']}}
                                </div>
                                <div class="theme-text f-14  p-8">
                                    {{ucwords($user->organization->city)}}
                                </div>
                                <div class="theme-text f-14  p-8">
                                    {{$user->organization->pincode}}
                                </div>
                                <div class="theme-text f-14  p-8">
                                    {{ucwords($user->organization->state)}}
                                </div>
                                <div class="theme-text f-14  p-8">
                                    {{$user->organization->zone_id}}
                                </div>
                                <div class="theme-text f-14  p-8">
                                    <div class="d-flex justify-content-start">
                                        <span class="status-badge-3 grey-badge ml-0">
                                            @foreach($user->organization->services as $service)
                                                {{ucwords($service->name)}}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <div class="theme-text f-14  p-8">
                                    {{$user->organization->commission}}%
                                </div>
                                <div class="theme-text f-14  p-8">
                                    @foreach(\App\Enums\VendorEnums::$STATUS as $status=>$status_key)
                                        @if($user->status == $status_key)
                                            {{ucwords($status)}}
                                        @endif
                                    @endforeach
                                </div>
                                <div class="theme-text f-14  p-8">
                                    @foreach(\App\Enums\OrganizationEnums::$SERVICES as $service=>$service_key)
                                        @if($user->organization->service_type == $service_key)
                                            {{ucwords($service)}}
                                        @endif
                                    @endforeach
                                </div>
                                <div class="theme-text f-14  p-8">
                                    @if($user->organization->verification_status == \App\Enums\CommonEnums::$YES)
                                        Verified
                                    @else
                                        Unverified
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Tab-1 form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
