@extends('vendor-panel.layouts.frame')
@section('title') Service Request @endsection
@section('body')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="tickets">
        <div class="d-flex  flex-row justify-content-between vertical-center">
            <h3 class="page-head text-left p-4 f-20 theme-text">Service Request</h3>
            <div class="mr-20">
                <a href="{{route('vendor.service_request_add')}}">
                    <button class="btn theme-bg white-text"><i class="fa fa-plus p-1" aria-hidden="true"></i>CREATE New User</button>
                </a>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-breadcrum">
                        <li class="breadcrumb-item active" aria-current="page">Service Request</li>
                        <li class="breadcrumb-item"><a href="#">Create Request </a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
            <div class="col-sm-12">
                <div class="card  h-auto  pt-8 p-0">
                    <div class="header-wrap">
                        <h3 class="f-18 ml-1">Service Request</h3>
                        <div class="header-wrap p-0 filter-dropdown ">
                            <a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i><img src="{{asset('static/vendor/images/filter.svg')}}" alt="" srcset=""></i>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item border-top-bottom" href="#">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="total-no-orders">
                                        <label class="form-check-label" for="total-no-orders">
                                                    From
                                        </label>
                                    </div>
                                </a>
                                <a class="dropdown-item border-top-bottom" href="#">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="status">
                                        <label class="form-check-label" for="status">
                                                    To
                                        </label>
                                    </div>
                                </a>
                                <a class="dropdown-item border-top-bottom" href="#">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="city">
                                        <label class="form-check-label" for="city">
                                                    Order
                                        </label>
                                    </div>
                                </a>
                            </div>
                            <div class="search">
                                <input type="text" class="searchTerm" placeholder="Search...">
                                <button type="submit" class="searchButton">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="all-vender-details">
                        <table class="table text-center p-0  theme-text ">
                            <thead class="secondg-bg  p-0 f-14">
                                <tr class="f-weight-500">
                                    <th scope="col" class="text-left">Service ID</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Title</th>
                                    <th scope="col"> Status</th>
                                </tr>
                            </thead>
                            <tbody class="mtop-20 f-13">
                                @foreach($tickets as $ticket)
                                    <tr class="tb-border  cursor-pointer sidebar-toggle" data-sidebar="{{ route('vendor.service_sidebar',['id'=>$ticket->id]) }}">
                                        <td scope="row" class="text-left">{{$ticket->id}}</td>
                                        <td>
                                            @switch($ticket->type)
                                                @case(\App\Enums\TicketEnums::$TYPE['complaint'])
                                                    Complaint
                                                @break

                                                @case(\App\Enums\TicketEnums::$TYPE['service_request'])
                                                    Service Request
                                                @break

                                                @case(\App\Enums\TicketEnums::$TYPE['call_back'])
                                                    Call Back
                                                @break

                                            @endswitch
                                        </td>
                                        <td>{{$ticket->heading}}</td>
                                        <td class="">
                                            @switch($ticket->status)
                                                @case(\App\Enums\TicketEnums::$STATUS['open'])
                                                    <span class="complete-bg  text-center td-padding">Open</span>
                                                @break

                                                @case(\App\Enums\TicketEnums::$STATUS['rejected'])
                                                    <span class="red-bg  text-center td-padding">Rejected</span>
                                                @break

                                                @case(\App\Enums\TicketEnums::$STATUS['resolved'])
                                                    <span class="green-bg  text-center td-padding">Resolved</span>
                                                @break

                                                @case(\App\Enums\TicketEnums::$STATUS['closed'])
                                                    <span class="complete-bg  text-center td-padding">Closed</span>
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
                                <li class="label">of</li>
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
