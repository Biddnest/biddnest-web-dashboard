@extends('layouts.app')
@section('title') Customer Management @endsection
@section('content')



<div class="main-content grey-bg" data-barba="container" data-barba-namespace="customer">
    <div class="d-flex  flex-row justify-content-between vertical-center">
        <h3 class="page-head text-left p-4 f-20 theme-text">Customer Management</h3>
        <div class="mr-20">
            <a href="{{route('create-customers')}}">
                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1" aria-hidden="true"></i>CREATE CUSTOMER</button>
            </a>
        </div>
    </div>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left  pt-0 pb-0 p-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('customers')}}">Customer Management</a></li>
                    <li class="breadcrumb-item">Manage Customers</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="vender-all-details">
        <div class="simple-card w-24">
            <a href="{{route('customers')}}">
                <p>TOTAL CUSTOMERS</p>
                <h1>{{$total_user}}</h1>
            </a>
        </div>
        <div class="simple-card w-24">
            <a href="{{route('customers')}}?sort=active">
                <p>ACTIVE CUSTOMERS</p>
                <h1>{{$active_user}}</h1>
            </a>
        </div>
        <div class="simple-card w-24">
            <a href="{{route('customers')}}?sort=suspended">
                <p> INACTIVE CUSTOMERS</p>
                <h1>{{$inactive_user}}</h1>
            </a>
        </div>
        <div class="simple-card w-24">
            <a href="{{route('customers')}}?sort=verification_pending">
                <p> SIGNUP PENDING CUSTOMERS</p>
                <h1>{{$pending_user}}</h1>
            </a>
        </div>
    </div>
    <!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-lg-12 pr-0 pl-0">
            <div class="card  h-auto p-0 pt-10">

                <div class="row no-gutters">
                    <div class="col-sm-8 p-3 ">
                        <h3 class="f-18 pl-8 title" >Customers</h3 >

                    </div>
                    <div class="col-sm-1 -mr-4 pt-4 pl-8 " >
                        <a href="#" class="margin-r-20 filter-icon" aria-haspopup="true"  aria-expanded="false"  data-toggle="collapse" data-target="#filter-menu">
                            <i><img class="" src="{{asset('static/images/filter.svg')}}" alt="" srcset=""></i>
                        </a>
                    </div>
                    <div class="card-head  pt-3  left col-sm-3">
                        <div class="search">
                            <input type="text" class="searchTerm table-search" data-url="{{route('customers')}}" placeholder="Search...">
                            <button type="submit" class="searchButton">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="all-vender-details">
                    <div class="collapse" id="filter-menu">
                        <a href="#" class="btn theme-bg white-text clear-filter" id="clear">Clear</a>
                        <div class="row f-14">
                            <div class="col">
                                <label style="font-weight:500 !important;">Status</label>
                                <select class="form-control br-5 selectfilter" name="status" data-action="status">
                                    <option value="">--Select--</option>
                                    @foreach(\App\Enums\UserEnums::$STATUS as $key=>$status)
                                       <option value="{{$status}}">{{ucfirst(trans($key))}}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label style="font-weight:500 !important;">Joining From</label>
                                <input type="text" id="dateselect" name="date_from" class="singledate form-control br-5 fromdate" placeholder="23/Nov/2020" />
                            </div>
                            <div class="col">
                                <label style="font-weight:500 !important;">Joining To</label>
                                <input type="text" id="dateselect1" name="date_to" class="singledate form-control br-5 todate" placeholder="23/Dec/2020" />
                            </div>
                        </div>
                        <div class="row f-14 p-10">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <label style="font-weight:500 !important;">City</label>
                                <input type="text" id="dateselect" name="city" class="form-control br-5 filter-city" data-action="city" placeholder="Chennai" />
                            </div>
                            <div class="col-md-3">
                                <label style="font-weight:500 !important;">Zone</label>
                                <select class="form-control br-5 selectfilter" name="zones" data-action="zone">
                                    <option value="">--Select--</option>
                                    @foreach(Illuminate\Support\Facades\Session::get('zones') as $zone)
                                        <option value="{{$zone->id}}">{{$zone->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                    <table class="table text-center p-0 theme-text mb-0  f-14 left-col-table">
                        <thead class="secondg-bg  p-0">
                            <tr>
                                                <th scope="col">Customer Name</th>
                                                <th scope="col">Phone & Email</th>

                                                <th scope="col">Joining Date</th>
                                                <th scope="col">Zone</th>
                                                <th scope="col" style="text-align: center !important;width: 15%;">Status</th>
                                                <th scope="col" style="text-align: center !important;">Operations</th>
                            </tr>
                        </thead>
                        <tbody class="mtop-20">
                                           @foreach($users as $user)
                                            <tr class="tb-border cursor-pointer sidebar-toggle" data-sidebar="{{ route('sidebar.customer',['id'=>$user->id]) }}">
                                                <td scope="row">{{$user->fname}} {{$user->lname}}</td>
                                                <td>{{$user->phone}} <br /> {{$user->email}}</td>

                                                <td>{{date('d-m-Y', strtotime($user->created_at))}}</td>
                                                <td>{{$user->zone->name ?? "-"}}</td>
                                                <td class="" style="text-align: center;">
                                                    @if($user->status == 0)
                                                        <div class="status-badge red-bg text-center">Pending Signup</div>
                                                    @elseif($user->status == 1)
                                                        <div class="status-badge green-bg text-center">Active</div>
                                                    @else
                                                        <div class="status-badge red-bg text-center">Suspended</div>
                                                    @endif
                                                </td>

                                                <td style="text-align: center !important;">
                                                    <a class ="inline-icon-button mr-4" href="{{route('edit-customers', ['id'=>$user->id])}}"><i class="fa fa-pencil p-1 " aria-hidden="true"></i></a>
                                                    {{--<a href="#" class ="inline-icon-button" >
                                                    <i class="fa fa-ban" aria-hidden="true" style="cursor: no-drop !important;"></i>
                                                    </a>--}}
                                                </td>
                                            </tr>
                                           @endforeach
                        </tbody>
                    </table>
                    @if(count($users)== 0)
                        <div class="row hide-on-data">
                            <div class="col-md-12 text-center p-20">
                                <p class="font14"><i>. You don't have any Customer Added here.</i></p>
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

@endsection
