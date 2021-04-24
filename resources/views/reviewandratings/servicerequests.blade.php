@extends('layouts.app')
@section('title') Service And Request @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="servicerequest">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head theme-text text-left p-4 f-20">Service Requests</h3>
        <div class="mr-20">
            <a href="{{route('create-review')}}">
                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1" aria-hidden="true"></i> CREATE REQUEST
                </button>
            </a>
        </div>
    </div>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left p-2 pt-0 pb-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Services</li>
                    <li class="breadcrumb-item"><a href="{{route('create-service')}}">Create Request</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-lg-12">
            <div class="card  h-auto p-0 pt-10">
                <div class="row no-gutters" style="margin-top: 5px;">
                    <div class="col-sm-8 p-3 ">
                        <h3 class="f-18 title">Service Requests </h3>
                    </div>
                    <div class="col-sm-1 -mr-4 pt-3 pl-8 ">
                        <a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i><img class="" src="{{asset('static/images/filter.svg')}}" alt="" srcset=""></i>
                        </a>
                        <div class="dropdown-menu f-14">
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="fdate">
                                    <label class="form-check-label" for="fdate">
                                        Org Name
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="todate">
                                    <label class="form-check-label" for="todate">
                                        Org Id
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="vendorName">
                                    <label class="form-check-label" for="vendorName">
                                        Date
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="Status">
                                    <label class="form-check-label" for="couponName">
                                        Zone
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="Status">
                                    <label class="form-check-label" for="couponName">
                                        City
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="Status">
                                    <label class="form-check-label" for="couponName">
                                        status
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
                                <th scope="col" style="width: 2%;">Service Type</th>
                                <th scope="col" style="width: 8%;">Title</th>
                                <th scope="col" style="width: 15%;">Created By</th>
                                <th scope="col" style="width: 20%;">Created At</th>
                                <th scope="col" style="width: 10%;">Status</th>
                                <th scope="col" style="width: 5%;">Operations</th>
                            </tr>
                        </thead>
                        <tbody class="mtop-20 f-12">
                            @foreach($services as $servic)
                                <tr class="tb-border cursor-pointer">
                                    <td>
                                        @foreach(\App\Enums\TicketEnums::$TYPE as $type=>$key)
                                            @if($key == $servic->type)
                                                {{ucfirst(trans($type))}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td scope="row">{{Illuminate\Support\Str::limit($servic->heading, 30)}}</td>
                                    <td>
                                        @if($servic->vendor)
                                            {{ucfirst(trans($servic->vendor->fname))}} {{ucfirst(trans($servic->vendor->lname))}}
                                        @else
                                            {{ucfirst(trans($servic->user->fname))}} {{ucfirst(trans($servic->user->lname))}}
                                        @endif
                                    </td>
                                    <td>{{date('d M y', strtotime($servic->created_at))}}</td>
                                    <td class="">
                                        @switch($servic->status)
                                            @case(\App\Enums\TicketEnums::$STATUS['open'])
                                            <span class="status-badge green-bg">Open</span>
                                            @break

                                            @case(\App\Enums\TicketEnums::$STATUS['rejected'])
                                            <span class="status-badge red-bg">Rejected</span>
                                            @break

                                            @case(\App\Enums\TicketEnums::$STATUS['resolved'])
                                            <span class="status-badge green-bg">Resolved</span>
                                            @break

                                            @case(\App\Enums\TicketEnums::$STATUS['closed'])
                                            <span class="status-badge red-bg">Closed</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <i class="fa fa-pencil p-1 mr-2" aria-hidden="true"></i>
                                        <i class="fa fa-trash p-1" aria-hidden="true"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination">
                        <ul>
                            <li class="p-1">Page</li>
                            <li class="digit">{{$services->currentPage()}}</li>
                            <li class="label">of</li>
                            <li class="digit">{{$services->lastPage()}}</li>
                            @if(!$services->onFirstPage())
                                <li class="button"><a href="{{$services->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                </li>
                            @endif
                            @if($services->currentPage() != $services->lastPage())
                                <li class="button"><a href="{{$services->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
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
