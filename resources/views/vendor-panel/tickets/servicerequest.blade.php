@extends('vendor-panel.layouts.frame')
@section('title') Service Request @endsection
@section('body')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="tickets">
        <div class="d-flex  flex-row justify-content-between vertical-center">
            <h3 class="page-head text-left p-4 f-20 theme-text">Service Request</h3>
            <div class="mr-20">
                <a href="{{route('vendor.service_request_add')}}">
                    <button class="btn theme-bg white-text mt-5"><i class="fa fa-plus p-1" aria-hidden="true"></i>CREATE SERVICE REQUEST</button>
                </a>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-breadcrum">
                        <li class="breadcrumb-item active" aria-current="page">Service Request</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
            <div class="col-sm-12">
                <div class="card  h-auto  pt-8 p-0">
                    <div class="header-wrap pt-4 pb-4">
                        <h3 class="f-18 mt-0 mb-0  ml-1">Service Request</h3>
                        <div class="header-wrap  p-0 filter-dropdown ">
                            <div class="header-wrap p-0 col-sm-1"  style="display: flex; justify-content: flex-end;  margin-right: -18px;" >
                                <a href="#" class="margin-20 filter-icon" aria-haspopup="true"  aria-expanded="false"  data-toggle="collapse" data-target="#filter-menu">
                                    <i><img class="" src="{{asset('static/images/filter.svg')}}" alt="" srcset=""></i>
                                </a>
                            </div>
                            <div class="search">
                                <input type="text" class="searchTerm table-search" data-url="{{route('vendor.service_request')}}" value="{{$search}}" placeholder="Search...">
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
                                    <label style="font-weight:500 !important;">Category</label>
                                    <select class="form-control br-5 selectfilter" name="status" data-action="category">
                                        <option value="">--Select--</option>
                                        @foreach(\App\Enums\TicketEnums::$TYPE as $key_type=>$type)
                                            <option value="{{$type}}">{{ucwords($key_type)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label style="font-weight:500 !important;">Status</label>
                                    <select class="form-control br-5 selectfilter" name="status" data-action="status">
                                        <option value="">--Select--</option>
                                        @foreach(\App\Enums\TicketEnums::$STATUS as $key=>$status)
                                            <option value="{{$status}}">{{ucwords($key)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table class="table text-center p-0  theme-text ">
                            <thead class="secondg-bg  p-0 f-14">
                                <tr class="f-weight-500">
                                    <th scope="col" class="text-left" style=" padding: 14px;">Service ID</th>
                                    <th scope="col" style="text-align: center; padding:14px; padding: 14px 24px;">Category</th>
                                    <th scope="col" style="text-align: left; padding:14px">Title</th>
                                    <th scope="col" style="text-align: center; padding:14px"> Status</th>
                                </tr>
                            </thead>
                            <tbody class="mtop-20 f-13">
                                @foreach($tickets as $ticket)
                                    <tr class="tb-border  cursor-pointer sidebar-toggle" data-sidebar="{{ route('vendor.service_sidebar',['id'=>$ticket->id]) }}">
                                        <td scope="row" style="padding: 14px; padding-left:50px!important" class="text-left">{{$ticket->id}}</td>
                                        <td style="text-align: center; padding: 14px;">
                                            @switch($ticket->type)
                                                @case(\App\Enums\TicketEnums::$TYPE['complaint'])
                                                    Complaint
                                                @break

                                                @case(\App\Enums\TicketEnums::$TYPE['service_request'])
                                                    Service Request
                                                @break

                                                @case(\App\Enums\TicketEnums::$TYPE['new_branch'])
                                                    New Branch
                                                @break

                                                @case(\App\Enums\TicketEnums::$TYPE['price_update'])
                                                    Price Update
                                                @break

                                                @case(\App\Enums\TicketEnums::$TYPE['call_back'])
                                                    Call Back
                                                @break

                                            @endswitch
                                        </td>
                                        <td style="text-align: left; padding: 14px;">{{$ticket->heading}}</td>
                                        <td class="" style="text-align: center; padding: 14px; ">
                                            @switch($ticket->status)
                                                @case(\App\Enums\TicketEnums::$STATUS['open'])
                                                    <span class=" text-center td-padding" style="background-color: #fde79a;    padding: 5px 50px;" >Open</span>
                                                @break

                                                @case(\App\Enums\TicketEnums::$STATUS['rejected'])
                                                    <span class="red-bg  text-center td-padding" style="background-color: #fbe5e5 !important; ">Rejected</span>
                                                @break

                                                @case(\App\Enums\TicketEnums::$STATUS['resolved'])
                                                    <span class="  text-center td-padding" style="background-color: #e5fcf1;">Resolved</span>
                                                @break

                                                @case(\App\Enums\TicketEnums::$STATUS['closed'])
                                                    <span class="complete-bg  text-center td-padding" style="padding: 5px 46px;">Closed</span>
                                                @break

                                            @endswitch
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if(count($tickets)== 0)
                            <div class="row hide-on-data">
                                <div class="col-md-12 text-center p-20">
                                    <p class="font14"><i>. You don't any Ticket Raised.</i></p>
                                </div>
                            </div>
                        @endif
                        <div class="pagination">
                            <ul>
                                <li class="p-1">Page</li>
                                <li class="digit">{{$tickets->currentPage()}}</li>
                            <li class="f-16 ml-2 mr-2" style="transform: translate(0px, 4px);">Of</li>
                                <li class="digit">{{$tickets->lastPage()}}</li>
                                @if(!$tickets->onFirstPage())
                                    <li class="button"><a href="{{$tickets->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                    </li>
                                @endif
                                @if($tickets->currentPage() != $tickets->lastPage())
                                    <li class="button"><a href="{{$tickets->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
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
