@extends('vendor-panel.layouts.frame')
@section('title') Manage User Roles @endsection
@section('body')

    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="userroles">
        <div class="d-flex  flex-row justify-content-between">
            <h3 class="page-head text-left p-4 pl-0 f-20 ml-0" style="padding-left: 0px !important;">Manage User Roles</h3>
            <div class="mr-2 mt-4">
                <a href="{{route('vendor.addusermgt')}}">
                    <button class="btn theme-bg white-text"><i class="fa fa-plus p-1" aria-hidden="true"></i> Create New User</button>
                </a>
            </div>
        </div>
        <div class="d-flex  flex-row justify-content-between ">
            <div class="page-head text-left  pt-0 pb-0 p-2" style="padding-left: 0px !important;">
                <nav aria-label="breadcrumb" >
                    <ol class="breadcrumb" style="padding-left: 0px !important;">
                        <li class="breadcrumb-item active  ml-0"  aria-current="page">Manage User Roles</li>
                        <li class="breadcrumb-item  ml-0">Manage Users</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-between Dashboard-lcards m-card ">
            <div class="col-sm-12">
                <div class="card  h-auto p-0 pt-10">
                    <div class="d-flex flex-row justify-content-between p-10">
                        <div class=" card-head right text-left">
                            <h3 class=" f-18 pb-0 mt-0 ">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    @foreach(\App\Enums\VendorEnums::$ROLES as $key=>$fetch_role)
                                        <li class="nav-item">
                                            <a class="nav-link pt-2 @if($role == $key)active @endif p-15"  href="{{route('vendor.managerusermgt', ['type'=>$key])}}" >{{ucfirst(trans($key))}}s</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </h3>
                        </div>
                        <div class="p-1 card-head left col-sm-3">
                            <div class="search">
                                <input type="text" class="searchTerm table-search" data-url="{{route('vendor.managerusermgt', ['type'=>$role])}}" placeholder="Search...">
                                <button type="submit" class="searchButton">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Table -->
                    <div class="tab-content margin-topneg-42" id="myTabContent">
                        <div class="tab-pane fade show active" id="live" role="tabpanel" aria-labelledby="live-tab">
                            <table class="table text-left p-0   theme-text">
                                <thead class="secondg-bg  p-0 f-14 text-center">
                                <tr>
                                    <th scope="col" class="text-left" style="padding: 16px 26px;">Name</th>
                                    <th scope="col" style="padding: 16px 26px;" >Email</th>
                                    <th scope="col" style="padding: 16px 26px;">Phone</th>
                                    <th scope="col" class="text-left" style="padding: 16px 26px;">Branch</th>
                                    <th scope="col " class="text-center" style="padding: 16px 26px;">Status</th>
                                    @if(\App\Helper::is("admin", true))
                                        <th scope="col" class="text-center" style="padding: 16px 0px;">Actions</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody class="mtop-20  f-13 text-center">
                                    @foreach($users as $user)
                                        <tr class="tb-border user_{{$user->id}}  cursor-pointer sidebar-toggle" data-sidebar="{{ route('vendor.sidebar.userrole',['id'=>$user->id]) }}">
                                            <td scope="row" class="text-left" style="padding-top: 20px;">{{ucfirst(trans($user->fname))}} {{ucfirst(trans($user->lname))}}</td>

                                            <td style="text-align:left!important; padding-top: 20px;" >{{$user->email}}</td>
                                            <td style="text-align:left!important; padding-top: 20px">{{$user->phone}}</td>
                                            <td style="text-align:left!important; padding-top: 20px;">{{ucfirst(trans($user->organization->city))}}</td>

                                            <td class="text-center" style="padding: 14px;">
                                                @if($user->status == \App\Enums\VendorEnums::$STATUS['inactive'])
                                                    <span class="red-bg  text-center status-badge complete-bg" style="font-weight: 600 !important;"> Deactive</span>
                                                @elseif($user->status == \App\Enums\VendorEnums::$STATUS['active'])
                                                    <span class="green-bg  text-center status-badge complete-bg" style="font-weight: 600 !important;"> Active</span>
                                                @endif
                                            </td>
                                            @if(\App\Helper::is("admin", true))
                                                <td class="text-center" style="padding-top: 20px;">
                                                    <a href="{{route('vendor.editusermgt', ['id'=>$user->id])}}"><i class="icon dripicons-pencil p-1" aria-hidden="true"></i></a>
                                                    <a href="#" class="delete inline-icon-button" data-parent=".user_{{$user->id}}" data-confirm="Are you sure, you want delete this User permenently? You won't be able to undo this." data-url="{{route('api.user.delete',['id'=>$user->id])}}"><i class="icon dripicons-trash p-1" aria-hidden="true"></i>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            @if(count($users)== 0)
                                <div class="row hide-on-data">
                                    <div class="col-md-12 text-center p-20">
                                        <p class="font14"><i>. You don't any other Members here.</i></p>
                                    </div>
                                </div>
                            @endif
                            <div class="pagination">
                                <ul>
                                    <li class="p-1">Page</li>
                                    <li class="digit">{{$users->currentPage()}}</li>
                                    <li class="f-16 ml-2 mr-2" style="transform: translate(0px, 4px);">Of</li>
                                    <li class="digit">{{$users->lastPage()}}</li>
                                    @if(!$users->onFirstPage())
                                        <li class="button"><a href="{{$users->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                        </li>
                                    @endif
                                    @if($users->currentPage() != $users->lastPage())
                                        <li class="button"><a href="{{$users->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
