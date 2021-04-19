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
            <h1>{{$total_count}}</h1>
        </div>
        <div class="simple-card min-width-30">
            <p>SCHEDULED PAYOUTS</p>
            <h1>{{$scheduled_payout}}</h1>
        </div>
        <div class="simple-card min-width-30">
            <p>FAILED PAYOUTS</p>
            <h1>{{$failed_payout}}</h1>
        </div>
    </div>
    <!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-sm-12">
            <div class="card  h-auto p-0 pt-10">
                <div class="row no-gutters" style="margin-top: 5px;">
                    <div class="col-sm-8 p-3 ">
                        <h3 class="f-18 title">Vendor Payout </h3>
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
                                        From Date
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="todate">
                                    <label class="form-check-label" for="todate">
                                        To Date
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="vendorName">
                                    <label class="form-check-label" for="vendorName">
                                        Vender Name
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="Status">
                                    <label class="form-check-label" for="couponName">
                                        Status
                                    </label>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="card-head  pt-2 mt-1 left col-sm-3">
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
                                <th scope="col">Payout ID </th>
{{--                                <th scope="col">Description</th>--}}
                                <th scope="col">Vendor ID </th>
                                <th scope="col">Status</th>
                                <th scope="col">Pay out Date</th>
                                <th scope="col">Commission Rate</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Operations</th>
                            </tr>
                        </thead>
                        <tbody class="mtop-20 f-13">
                            <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                <td scope="row">{{$payout->public_payout_id}}</td>
{{--                                <td>Payment for BLR movers</td>--}}
                                <td>{{$payout->organization_id}}</td>
                                <td>
                                    <div class="status-badge green-bg">Completed</div>
                                </td>
                                <td>{{date('d M y', strtotime($payout->dispatch_at))}}</td>
                                <td>{{$payout->commission_percentage}}%</td>
                                <td class="">₹{{$payout->commission_percentage}}
                                </td><td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="pagination">
                        <ul>
                            <li class="p-1">Page</li>
                            <li class="digit">{{$payout->currentPage()}}</li>
                            <li class="label">of</li>
                            <li class="digit">{{$payout->lastPage()}}</li>
                            @if(!$payout->onFirstPage())
                                <li class="button"><a href="{{$payout->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                </li>
                            @endif
                            @if($payout->currentPage() != $payout->lastPage())
                                <li class="button"><a href="{{$payout->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
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
