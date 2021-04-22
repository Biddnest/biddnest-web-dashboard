@extends('layouts.app')
@section('title') Users And Roles @endsection
@section('content')

 <!-- Main Content -->

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="usersandroles">
    <div class="d-flex  flex-row justify-content-between vertical-center">
        <h3 class="page-head text-left p-4 f-20 theme-text">Users & Roles </h3>
        <div class="mr-20">
            <a href="{{route('create-users')}}">
                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1" aria-hidden="true"></i>ADD NEW USER</button>
            </a>
        </div>
    </div>
    <!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-sm-12">
            <div class="card  h-auto p-0 pt-10">
                <div class="row no-gutters" style="margin-top: 5px;">
                    <div class="col-sm-8 p-3 ">
                        <h3 class="f-18 pl-2 title">User Roles</h3>
                    </div>
                    <div class="col-sm-1 -mr-4 pt-3 pl-8 ">
                        <a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i><img class="" src="{{asset('static/images/filter.svg')}}" alt="" srcset=""></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="date">
                                    <label class="form-check-label" for="date">
                                        Date
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="zone">
                                    <label class="form-check-label" for="zone">
                                        Zone
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="city">
                                    <label class="form-check-label" for="city">
                                        City
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="couponName">
                                    <label class="form-check-label" for="couponName">
                                        Coupon Name
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="couponType">
                                    <label class="form-check-label" for="couponType">
                                        Coupon Type
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="status">
                                    <label class="form-check-label" for="status">
                                        Status
                                    </label>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="card-head  pt-2  left col-sm-3">
                        <div class="search">
                            <input type="text" class="searchTerm" placeholder="Search...">
                            <button type="submit" class="searchButton">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="all-vender-details">
                    <table class="table text-left p-0 theme-text mb-0 primary-table">
                        <thead class="secondg-bg  p-0">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Zone</th>
                                <th scope="col">User Role</th>
                                <th scope="col">Operations</th>
                            </tr>
                        </thead>
                        <tbody class="mtop-20 f-13">
                            @foreach($users as $user)
                                <tr class="tb-border cursor-pointer user_{{$user->id}}">
                                    <td scope="row">{{ucfirst(trans($user->fname))}} {{ucfirst(trans($user->lname))}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>@foreach($user->zones as $zone)
                                            {{ucfirst(trans($zone->name))}},
                                        @endforeach
                                    </td>
                                    <td class="">
                                        @foreach(\App\Enums\AdminEnums::$ROLES as $key=>$roles)
                                            @if($user->role == $roles)
                                                <div class="status-badge text-center">{{ucfirst(trans($key))}}</div>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{route('edit-users', ["id"=>$user->id])}}"><i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i></a>
                                        <a href="#" class="delete" data-parent=".user_{{$user->id}}" data-confirm="Are you sure, you want delete this Organization permenently? You won't be able to undo this." data-url="{{route('user_delete',['id'=>$user->id])}}"><i class="icon dripicons-trash p-1" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

@endsection
