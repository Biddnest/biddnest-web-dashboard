@extends('layouts.app')
@section('title') Vendor Payout @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="vendorpayout">
    <div class="d-flex  flex-row justify-content-between vertical-center">
        <h3 class="page-head text-left p-4 f-20 theme-text">Vendor Payout</h3>
        <div class="mr-20">
            <a href="{{route('create-payout')}}">
                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1" aria-hidden="true"></i>CREATE PAYOUT</button>
            </a>
        </div>
    </div>
    <div class="vender-all-details">
        <div class="simple-card min-width-30">
            <p>TOTAL PAYOUTS</p>
            <h1>{{count($payouts)}}</h1>
        </div>
        <div class="simple-card min-width-30">
            <p>SCHEDULED PAYOUTS</p>
            <h1>{{$scheduled}}</h1>
        </div>
        <div class="simple-card min-width-30">
            <p>FAILED PAYOUTS</p>
            <h1>{{$failed}}</h1>
        </div>
    </div>
    <!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-sm-12 pl-0 pr-0">
            <div class="card  h-auto p-0 pt-10">
            <div class="header-wrap">
                    <div class="col-sm-8 p-3 ml-3">
                        <h3 class="f-18 ml-2 mt-3">Vendor Payout </h3>
                    </div>
                    <div class="header-wrap p-0 col-sm-1 " style="display: flex; justify-content: flex-end;  margin-right: -18px;">
                        <a href="#" class="margin-r-20 filter-icon" aria-haspopup="true"  aria-expanded="false"  data-toggle="collapse" data-target="#filter-menu">
                            <i><img class="" src="{{asset('static/images/filter.svg')}}" alt="" srcset=""></i>
                        </a> 
                    </div>
                    <div class="card-head  mt-1 left col-sm-3">
                        <div class="search">
                            <input type="text" class="searchTerm table-search" data-url="{{route('vendor-payout')}}" placeholder="Search...">
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
                                <label style="font-weight:500 !important;">Organization</label>
                                <select id="" class="form-control searchvendor single selectfilter" data-action="id" name="organization_id">
                                </select>
                            </div>
                            <div class="col">
                                <label style="font-weight:500 !important;">Status</label>
                                <select class="form-control br-5 selectfilter" name="status" data-action="status">
                                    <option value="">--Select--</option>
                                    @foreach(\App\Enums\PayoutEnums::$STATUS as $key=>$status)
                                       <option value="{{$status}}">{{ucfirst(trans($key))}}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label style="font-weight:500 !important;">Payout From</label>
                                <input type="text" id="dateselect" name="payout_date_from" class="singledate form-control br-5 fromdate" placeholder="23/Nov/2020" />
                            </div>
                            <div class="col">
                                <label style="font-weight:500 !important;">Payout To</label>
                                <input type="text" id="dateselect1" name="payout_date_to" class="singledate form-control br-5 todate" placeholder="23/Dec/2020" />
                            </div>
                        </div>
                    </div>
                    <table class="table text-left p-0 theme-text mb-0 primary-table">
                        <thead class="secondg-bg  p-0">
                            <tr>
                                <th scope="col">Payout ID </th>
{{--                                <th scope="col">Description</th>--}}
                                <th scope="col">Vendor ID </th>
                                <th scope="col" style="text-align: center !important;" >Status</th>
                                <th scope="col">Pay out Date</th>
                                <th scope="col">Commission Rate</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Operations</th>
                            </tr>
                        </thead>
                        <tbody class="mtop-20 f-13">
                            @foreach($payouts as $payout)
                                <tr class="tb-border cursor-pointer sidebar-toggle" data-sidebar="{{ route('sidebar.payout',['id'=>$payout->id]) }}">
                                    <td scope="row">{{$payout->public_payout_id}}</td>
    {{--                                <td>Payment for BLR movers</td>--}}
                                    <td>{{$payout->organization->org_name}}</td>
                                    <td style="text-align: center !important;">
                                        @switch($payout->status)
                                            @case(\App\Enums\PayoutEnums::$STATUS['scheduled'])
                                            <span class="status-badge green-bg text-center">Scheduled</span>
                                            @break

                                            @case(\App\Enums\PayoutEnums::$STATUS['suspended'])
                                            <span class="status-badge red-bg text-center">Suspended</span>
                                            @break

                                            @case(\App\Enums\PayoutEnums::$STATUS['transferred'])
                                            <span class="status-badge green-bg text-center">Transferred</span>
                                            @break

                                            @case(\App\Enums\PayoutEnums::$STATUS['processing'])
                                            <span class="status-badge green-bg text-center">Processing</span>
                                            @break

                                            @case(\App\Enums\PayoutEnums::$STATUS['cancelled'])
                                            <span class="status-badge red-bg text-center">Cancelled</span>
                                            @break

                                            @case(\App\Enums\PayoutEnums::$STATUS['temporary_hold'])
                                            <span class="status-badge red-bg text-center">Temporary Hold</span>
                                            @break

                                            @case(\App\Enums\PayoutEnums::$STATUS['queued'])
                                            <span class="status-badge green-bg text-center">Queued</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>{{date('d M y', strtotime($payout->dispatch_at))}}</td>
                                    <td>{{$payout->commission_percentage}}%</td>
                                    <td class="">₹{{$payout->commission_percentage}}
                                    </td>
                                    <td>
                                        <a  class = "inline-icon-button" href="{{route('edit-payout', ['id'=>$payout->id])}}"><i class="fa fa-pencil p-1 mr-3" aria-hidden="true"></i></a>
                                        <a href="#"  class = "inline-icon-button">
                                        <i class="fa fa-ban" aria-hidden="true" style="cursor: no-drop !important;"></i>
                                        </a>
                                       
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($payouts)== 0)
                        <div class="row hide-on-data">
                            <div class="col-md-12 text-center p-20">
                                <p class="font14"><i>. You don't have any Payout records here.</i></p>
                            </div>
                        </div>
                    @endif
                    <div class="pagination">
                        <ul>
                            <li class="p-1">Page</li>
                            <li class="digit">{{$payouts->currentPage()}}</li>
                            <li class="label">of</li>
                            <li class="digit">{{$payouts->lastPage()}}</li>
                            @if(!$payouts->onFirstPage())
                                <li class="button"><a href="{{$payouts->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                </li>
                            @endif
                            @if($payouts->currentPage() != $payouts->lastPage())
                                <li class="button"><a href="{{$payouts->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
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
