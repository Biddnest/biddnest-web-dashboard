@extends('layouts.app')
@section('title') Vendor Management @endsection
@section('content')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="vendor">
        <div class="d-flex  flex-row justify-content-between vertical-center">
                                <h3 class="page-head text-left p-4 f-20 theme-text">Vendor Management</h3>
                                <div class="mr-20">
                                   <a href="{{ route('create-vendors')}}">
                                    <button class="btn theme-bg white-text"><i class="fa fa-plus p-1"
                                        aria-hidden="true"></i>ONBOARD VENDER</button>
                                   </a>
                                </div>
                            </div>
        <div class="d-flex  flex-row justify-content-between">
                                <div class="page-head text-left  pt-0 pb-0 p-2">
                                  <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active" aria-current="page">Vendor Management</li>
                                      <li class="breadcrumb-item"><a href="#"> Manage Vendor</a></li>

                                    </ol>
                                  </nav>


                                </div>

                            </div>
        <div class="vender-all-details">
                                <div class="simple-card" style="width: 30%;">
                                    <p>TOTAL VENDORS</p>
                                    <h1>{{$vendors_count }}</h1>
                                </div>
                                <div class="simple-card" style="width: 30%;">
                                    <p>UNVERIFIED VENDORS</p>
                                    <h1>{{$unverifide_vendors}}</h1>
                                </div>
                                <div class="simple-card" style="width: 30%;">
                                    <p> VERIFIED VENDORS</p>
                                    <h1>{{$verifide_vendors}}</h1>
                                </div>
{{--                                <div class="simple-card">--}}
{{--                                    <p> ECONOMIC VENDORS</p>--}}
{{--                                    <h1>2,594</h1>--}}
{{--                                </div>--}}
{{--                                <div class="simple-card">--}}
{{--                                    <p> PREMIUM VENDORS</p>--}}
{{--                                    <h1>2,248</h1>--}}
{{--                                </div>--}}
                            </div>
        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
                                <div class="col-lg-12 pr-0 pl-0">
                                    <div class="card  h-auto p-0  pt-10">
                                        <div class="header-wrap">
                                            <!-- <h3 class="f-18 pl-2">All Vendors</h3>
                                            <a href="#">
                                                <i><img src="{{ asset('static/images/filter.svg')}}" alt="" srcset=""></i>
                                            </a> -->
                                                <div class="col-sm-8 p-3 ">
                                                    <h3 class="f-18 pl-8 title " style="margin-bottom: 0px !important;">All Vendors</h3 >

                                                </div>
                                                {{--<div class="col-sm-1" style="margin-right: -11%;">
                                                    <a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                        <i><img class="" src="{{asset('static/images/filter.svg')}}" alt="" srcset=""></i>

                                                    </a>
                                                    <div class="dropdown-menu ">
                                                        <a class="dropdown-item border-top-bottom" href="#">
                                                            <div class="form-check f-14">
                                                                <input class="form-check-input" type="checkbox" value="" id="city">
                                                                <label class="form-check-label" for="city">
                                                                    City
                                                                </label>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item border-top-bottom" href="#">
                                                            <div class="form-check f-14">
                                                                <input class="form-check-input" type="checkbox" value=""
                                                                    id="Customer">
                                                                <label class="form-check-label" for=" Customer">
                                                                    Customer Status
                                                                </label>
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item border-top-bottom" href="#">
                                                            <div class="form-check f-14">
                                                                <input class="form-check-input" type="checkbox" value=""
                                                                    id="customerType">
                                                                <label class="form-check-label" for="customerType">
                                                                    Customer Type
                                                                </label>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>--}}
                                                <div class="card-head  pt-2  left col-sm-3" style="padding: 8px 20px;">
                                                    <div class="search">
                                                        <input type="text" class="searchTerm table-search" data-url="{{route('vendors')}}" placeholder="Search...">
                                                        <button type="submit" class="searchButton">
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 pr-0 pl-0">
                                    <div class="all-vender-details">
                                            <table class="table  p-0 theme-text mb-0 ">
                                                <thead class="secondg-bg bx-shadowg p-0 f-14" style="font-weight: 700 !important;">
                                                    <tr class="">
                                                        <th scope="col" >Vendor Name</th>
                                                        <th scope="col">Org Name</th>
                                                        <th scope="col">Zone</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Operations</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="mtop-20">
                                                    @foreach($vendors as $vendor)
                                                        <tr class="tb-border cursor-pointer org_{{$vendor->id}} sidebar-toggle" data-sidebar="{{ route('sidebar.vendors',['id'=>$vendor->id]) }}">
                                                            <td scope="row">
                                                                @if(isset($vendor->vendor))
                                                                {{ucfirst(trans($vendor->vendor->fname))}} {{ucfirst(trans($vendor->vendor->lname))}}
                                                                @else
                                                                    {{"NA"}}
                                                                @endif
                                                            </td>
                                                            <td >{{ucfirst(trans($vendor->org_name))}} {{$vendor->org_type}}</td>
                                                            <td  >{{ucfirst(trans($vendor->zone->name))}}</td>
                                                            <td >@switch($vendor->status)
                                                                    @case(\App\Enums\OrganizationEnums::$STATUS['active'])
                                                                    <span class="status-badge green-bg text-center">Active</span>
                                                                    @break

                                                                    @case(\App\Enums\OrganizationEnums::$STATUS['suspended'])
                                                                    <span class="status-badge red-bg text-center"> Suspended</span>
                                                                    @break
                                                                    @case(\App\Enums\OrganizationEnums::$STATUS['lead'])
                                                                    <span class="status-badge red-bg text-center"> Lead</span>
                                                                    @break

                                                                    @default
                                                                    <span class="status-badge info-bg text-center">Unknown</span>
                                                                @endswitch
                                                            </td>
                                 <td> <a  class = "inline-icon-button mr-4" href="{{route('onboard-edit-vendors', ["id"=>$vendor->id])}}"><i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i></a>
                                                                <a  class = "inline-icon-button" href="#" class="delete" data-parent=".org_{{$vendor->id}}" data-confirm="Are you sure, you want delete this Organization permenently? You won't be able to undo this." data-url="{{route('vendor_delete',['id'=>$vendor->id])}}"><i class="icon dripicons-trash p-1" aria-hidden="true"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @if($vendors_count == 0)
                                                <div class="row hide-on-data">
                                                    <div class="col-md-12 text-center p-20">
                                                        <p class="font14"><i>. You don't have any Vendors here.</i></p>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="pagination">
                                                <ul>
                                                    <li class="p-1">Page</li>
                                                    <li class="digit">{{$vendors->currentPage()}}</li>
                                                    <li class="label">of</li>
                                                    <li class="digit">{{$vendors->lastPage()}}</li>
                                                    @if(!$vendors->onFirstPage())
                                                        <li class="button"><a href="{{$vendors->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                                        </li>
                                                    @endif
                                                    @if($vendors->currentPage() != $vendors->lastPage())
                                                        <li class="button"><a href="{{$vendors->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
                                    </div>
                                </div>
                                </div>


                                    <!-- <div class="text-right p-20" style="float: right;">
                                        <nav aria-label="Page navigation example border-none">
                                            <ul class="pagination ">
                                                <li class="page-item active-page"><a
                                                        class="page-link border-none  p-1 mtop-5 " href="#">1</a></li>
                                                <li class="page-item theme-text"><a
                                                        class="page-link border-none bg-transparent p-1 mtop-5"
                                                        aria-disabled="">Of</a></li>
                                                <li class="page-item "><a
                                                        class="page-link border-none bg-transparent p-1 mtop-5 "
                                                        href="#">20</a></li>
                                                <li class="page-item"><a
                                                        class="page-link border-none bg-transparent p-1 " href="#"><img
                                                            src="assets/images/Backward.svg"></a></li>
                                                <li class="page-item"><a
                                                        class="page-link border-none bg-transparent p-1 " href="#"><img
                                                            src="assets/images/forward.svg"></a></li>
                                            </ul>
                                        </nav>
                                    </div> -->
                            </div>
                            </div>
    </div>
@endsection
