@extends('layouts.app')
@section('title') Service And Request @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="servicerequest">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head theme-text text-left p-4 f-20 ">Service Requests</h3>
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
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('create-service')}}">Services</a></li>
                    <li class="breadcrumb-item">Create Request</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-lg-12">
            <div class="card  h-auto p-0 pt-10">
                <div class="header-wrap">
                    <div class="col-sm-8 p-3 ">
                        <h3 class="f-18 ml-2 mt-3 ml-4">Service Requests </h3>
                    </div>
                    <div class="header-wrap p-0 col-sm-1 " style="display: flex; justify-content: flex-end;  margin-right: -18px;">
                        {{--<a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

                        </div>--}}
                    </div>
                    <div class="card-head  left col-sm-3">
                        <div class="search">
                            <input type="text" class="searchTerm table-search" data-url="{{route('service-requests')}}" placeholder="Search...">
                            <button type="submit" class="searchButton">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="all-vender-details">
                    <table class="table text-left p-0 theme-text mb-0 f-14">
                        <thead class="secondg-bg  p-0">
                            <tr>
                                <th scope="col" >Service Type</th>
                                <th scope="col" >Title</th>
                                <th scope="col" >Created By</th>
                                <th scope="col" >Created At</th>
                                <th scope="col" style="width: 10%; text-align: center !important;">Status</th>
                                <th scope="col" style="width: 10%; text-align: center !important;">Operations</th>
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
                                            {{ucfirst(trans($servic->vendor->fname)) ?? 'NA'}} {{ucfirst(trans($servic->vendor->lname)) ?? ''}}
                                        @elseif($servic->user)
                                            {{ucfirst(trans($servic->user->fname)) ?? 'NA'}} {{ucfirst(trans($servic->user->lname)) ?? ''}}
                                        @endif
                                    </td>
                                    <td>{{date('d M y', strtotime($servic->created_at))}}</td>
                                    <td class="">
                                        @switch($servic->status)
                                            @case(\App\Enums\TicketEnums::$STATUS['open'])
                                            <span class="status-badge green-bg text-center">Open</span>
                                            @break

                                            @case(\App\Enums\TicketEnums::$STATUS['rejected'])
                                            <span class="status-badge red-bg text-center">Rejected</span>
                                            @break

                                            @case(\App\Enums\TicketEnums::$STATUS['resolved'])
                                            <span class="status-badge green-bg text-center">Resolved</span>
                                            @break

                                            @case(\App\Enums\TicketEnums::$STATUS['closed'])
                                            <span class="status-badge red-bg text-center">Closed</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <a class = "inline-icon-button mr-4"style="display: flex;"  href="@if($servic->type == \App\Enums\TicketEnums::$TYPE['call_back'])#@else{{route('reply', ['id'=>$servic->id])}}@endif"><i class="fa fa-eye pb-2 mr-2" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($services)== 0)
                        <div class="row hide-on-data">
                            <div class="col-md-12 text-center p-20">
                                <p class="font14"><i>. You don't have any Tickets raised here.</i></p>
                            </div>
                        </div>
                    @endif
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
