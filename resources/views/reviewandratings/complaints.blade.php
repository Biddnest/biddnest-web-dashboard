@extends('layouts.app')
@section('title') Complaints @endsection
@section('content')


<div class="main-content grey-bg" data-barba="container" data-barba-namespace="complainnts">
    <div class="d-flex  flex-row justify-content-between vertical-center">
        <h3 class="page-head text-left p-4 f-20 theme-text">Complaints</h3>
        <div class="mr-20">
            <a href="{{route('create-complaint')}}">
                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1" aria-hidden="true"></i>CREATE NEW</button>
            </a>
        </div>
    </div>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left p-2 pt-0 pb-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Complaint</li>
                    <li class="breadcrumb-item"><a href="{{route('service-requests')}}">Services</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="vender-all-details">
        <div class="simple-card min-width-30">
            <p> RESOLVED COMPLAINTS</p>
            <h1>{{$resolved_complaints}}</h1>
        </div>
        <div class="simple-card min-width-30">
            <p>UNRESOLVED COMPLAINTS</p>
            <h1>{{$open_complaints}}</h1>
        </div>
        <div class="simple-card min-width-30">
            <p>CREATE COMPLAINT</p>
            <h1>{{$open_complaints}}</h1>
        </div>
    </div>
    <!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-sm-12">
            <div class="card  h-auto p-0 pt-10">
                <div class="row no-gutters" style="margin-top: 5px;">
                    <div class="col-sm-8 p-3 ">
                        <h3 class="f-18 pl-8 title">Complaints</h3 >
                    </div>
                    <div class="col-sm-1 -mr-4 pt-3 pl-8 ">
                        <a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i><img class="" src="{{asset('static/images/filter.svg')}}" alt="" srcset=""></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="fdate">
                                    <label class="form-check-label" for="fdate">
                                        Order ID
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="todate">
                                    <label class="form-check-label" for="todate">
                                        Zone
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="vendorName">
                                    <label class="form-check-label" for="vendorName">
                                        City
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="Status">
                                    <label class="form-check-label" for="couponName">
                                        Type
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="Status">
                                    <label class="form-check-label" for="couponName">
                                        Date
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
                    <table class="table text-left p-0  mb-0">
                        <thead class="secondg-bg  p-0">
                            <tr>
                                <th scope="col" style="width: 2%;">Complaints ID </th>
                                <th scope="col" style="width: 8%;">Order ID</th>
                                <th scope="col" style="width: 15%;">Customer Name</th>
                                <th scope="col" style="width: 20%;">Complaint Type</th>
                                <th scope="col" style="width: 10%;">Created At</th>
{{--                                <th scope="col" style="width: 10%;">Created By</th>--}}
                                <th scope="col" style="width: 25%;">Description</th>
                                <th scope="col" style="width: 10%;">Status</th>
                                <th scope="col" style="width: 5%;">Operations</th>
                            </tr>
                        </thead>
                        <tbody class="mtop-20 f-13">
                            @foreach($complaints as $complaint)
                                <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                    <td scope="row">{{$complaint->id}}</td>
                                    <td>@if($complaint->booking){{$complaint->booking->public_booking_id}}@endif</td>
                                    <td>{{ucfirst(trans($complaint->user->fname))}} {{ucfirst(trans($complaint->user->lname))}}</td>
                                    <td >{{Illuminate\Support\Str::limit($complaint->heading, 10)}}</td>
                                    <td>{{date('d M y', strtotime($complaint->created_at))}}</td>
{{--                                    <td>{{$complaint->user->fname}} {{$complaint->user->lname}}</td>--}}
                                    <td>{{Illuminate\Support\Str::limit($complaint->desc, 10)}}</td>
                                    <td>
                                        @switch($complaint->status)
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
                                        <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i>
                                        <i class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination">
                        <ul>
                            <li class="p-1">Page</li>
                            <li class="digit">{{$complaints->currentPage()}}</li>
                            <li class="label">of</li>
                            <li class="digit">{{$complaints->lastPage()}}</li>
                            @if(!$complaints->onFirstPage())
                                <li class="button"><a href="{{$complaints->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                </li>
                            @endif
                            @if($complaints->currentPage() != $complaints->lastPage())
                                <li class="button"><a href="{{$complaints->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
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
