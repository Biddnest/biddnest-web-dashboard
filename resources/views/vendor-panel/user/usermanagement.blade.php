@extends('vendor-panel.layouts.frame')
@section('title') Manage User Roles @endsection
@section('body')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="userroles">
        <div class="d-flex  flex-row justify-content-between">
            <h3 class="page-head text-left p-4 -ml-2 f-20">Manage User Roles</h3>
            <div class="mr-2">
                <a href="Add-New-Users.html">
                    <button class="btn theme-bg white-text"><i class="fa fa-plus p-1" aria-hidden="true"></i> Create New User</button>
                </a>
            </div>
        </div>
        <div class="d-flex  flex-row justify-content-between -ml-2">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Manage User Roles</li>
                        <li class="breadcrumb-item">Manage Users</li>
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
                            <h3 class=" f-18 pb-0">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item mr-5">
                                        <a class="nav-link @if($role == "manager")active @endif p-15"  href="{{route('vendor.managerusermgt', ['type'=>"manager"])}}" >Managers</a>
                                    </li>
                                    <li class="nav-item mr-5">
                                        <a class="nav-link @if($role == "admin")active @endif p-15"  href="{{route('vendor.managerusermgt', ['type'=>"admin"])}}">Admins</a>
                                    </li>
                                    <li class="nav-item mr-5">
                                        <a class="nav-link @if($role == "driver")active @endif p-15"  href="{{route('vendor.managerusermgt', ['type'=>"driver"])}}" >Drivers</a>
                                    </li>
                                </ul>
                            </h3>
                        </div>
                        <div class="p-1 card-head left col-sm-3">
                            <div class="search">
                                <input type="text" class="searchTerm" placeholder="Search...">
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
                                    <th scope="col" class="text-left">Name</th>
                                    <th scope="col"  >Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col" class="text-center">Branch</th>
                                    <th scope="col " class="text-center">Status</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody class="mtop-20  f-13 text-center">
                                    @foreach($users as $user)
                                        <tr class="tb-border  cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                            <td scope="row" class="text-left">{{ucfirst(trans($user->fname))}} {{ucfirst(trans($user->lname))}}</td>

                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{ucfirst(trans($user->organization->city))}}</td>

                                            <td class="text-center">
                                                    @if($user->status == \App\Enums\VendorEnums::$STATUS['inactive'])
                                                        <span class="red-bg  text-center status-badge complete-bg"> Deactive</span>
                                                    @elseif($user->status == \App\Enums\VendorEnums::$STATUS['active'])
                                                        <span class="green-bg  text-center status-badge complete-bg"> Active</span>
                                                    @endif
                                                </td>
                                            <td class="text-center"> <i class="icon dripicons-pencil p-1" aria-hidden="true"></i>
                                                <i class="icon dripicons-trash p-1" aria-hidden="true"></i>
                                            </td>
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
                                    <li class="label">of</li>
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
