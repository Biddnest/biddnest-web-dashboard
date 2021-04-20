@extends('layouts.app')
@section('title') Zones @endsection
@section('content')

<!-- Main Content -->
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="zones">
                    <div class="d-flex  flex-row justify-content-between vertical-center">
                        <h3 class="page-head text-left p-4 f-20 theme-text">Zone Management</h3>
                        <div class="mr-20">
                            <a href="{{ route('create-zones')}}">
                                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1"
                                        aria-hidden="true"></i>CREATE ZONE</button>
                            </a>

                        </div>
                    </div>
                    <div class="d-flex  flex-row justify-content-between">
                        <div class="page-head text-left  pt-0 pb-0 p-2">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">Zone Management</li>
                                    <li class="breadcrumb-item"><a href="#"> Manage Zones</a></li>

                                </ol>
                            </nav>


                        </div>

                    </div>


                    <div class="vender-all-details flex-row">
                        <div class="simple-card min-width-30">
                            <p>TOTAL NO OF ZONES</p>
                            <h1>{{$total}}</h1>
                        </div>
                        <div class="simple-card min-width-30">
                            <p>ACTIVE ZONES</p>
                            <h1>{{$active}}</h1>
                        </div>
                        <div class="simple-card min-width-30">
                            <p>INACTIVE ZONES</p>
                            <h1>{{$inactive}}</h1>
                        </div>


                    </div>
                    <!-- Dashboard cards -->


                    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
                        <div class="col-sm-12">
                            <div class="card  h-auto p-0 pt-10">
                                <div class="header-wrap">
                                    <div class="col-sm-8 p-3 ">
                                        <h3 class="f-18 title">Zone Management </h3>

                                    </div>

                                    <div class="header-wrap p-0 col-sm-1">
                                        <a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i><img src="{{ asset('static/images/filter.svg')}}" alt="" srcset=""></i>

                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item border-top-bottom" href="#">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="total-no-orders">
                                                    <label class="form-check-label" for="total-no-orders">
                                                        Total no of orders
                                                    </label>
                                                </div>
                                            </a>
                                            <a class="dropdown-item border-top-bottom" href="#">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="statu">
                                                    <label class="form-check-label" for="status">
                                                        Status
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
                                                <th scope="col">Zone Name</th>
                                                <th scope="col">City</th>
                                                <th scope="col">District</th>
                                                <th scope="col">State</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody class="mtop-20 f-13">
                                        @foreach($zones as $zone)
                                            <tr class="tb-border zone_{{$zone->id}}">
                                                <td scope="row" >{{$zone->name}}</td>
                                                <td >{{$zone->city}}</td>
                                                <td >{{$zone->district}}</td>
                                                <td>{{$zone->state}}</td>
                                                <td>
                                                    @switch($zone->status)
                                                        @case(\App\Enums\CommonEnums::$YES)
                                                            <span class="status-badge green-bg text-center">Active</span>
                                                        @break
                                                        @case(\App\Enums\CommonEnums::$NO)
                                                            <span class="status-badge red-bg text-center">Inactive</span>
                                                        @break
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <a href="{{route('edit-zones', ['id'=>$zone->id])}}"><i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i></a>
                                                    <a href="#" class="delete" data-parent=".zone_{{$zone->id}}" data-confirm="Are you sure, you want delete this Zone permenently? You won't be able to undo this." data-url="{{route('zones_delete',['id'=>$zone->id])}}"><i class="icon dripicons-trash p-1" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                    <div class="pagination">
                                        <ul>
                                            <li class="p-1">Page</li>
                                            <li class="digit">{{$zones->currentPage()}}</li>
                                            <li class="label">of</li>
                                            <li class="digit">{{$zones->lastPage()}}</li>
                                            @if(!$zones->onFirstPage())
                                                <li class="button"><a href="{{$zones->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                                </li>
                                            @endif
                                            @if($zones->currentPage() != $zones->lastPage())
                                                <li class="button"><a href="{{$zones->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
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
