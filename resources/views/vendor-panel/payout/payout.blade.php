@extends('vendor-panel.layouts.frame')
@section('title') Vendor Payouts @endsection
@section('body')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="payout">
            <div class="d-flex  flex-row justify-content-between vertical-center">
                <h3 class="page-head text-left p-4 f-20 theme-text">Vendor Payout</h3>
            </div>
            <div class="vender-all-details">
                <div class="simple-card min-width-30">
                    <p>TOTAL PAYOUTS</p>
                    <h1>{{count($payouts)}}</h1>
                </div>
                <div class="simple-card min-width-30">
                    <p>SCHEDULED PAYOUTS</p>
                    <h1>{{$payout_schedule}}</h1>
                </div>
                <div class="simple-card min-width-30">
                    <p>FAILED PAYOUTS</p>
                    <h1>{{$payout_fail}}</h1>
                </div>
            </div>
            <!-- Dashboard cards -->
            <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
                <div class="col-sm-12">
                    <div class="card  h-auto p-0 pt-10">
                        <div class="row no-gutters">
                            <div class="col-sm-8 p-3 ml-4 ">
                                <h3 class="f-18 mt-3 ml-4">Vendor Payout </h3>
                            </div>
                            <div class="col-sm-1 -mr-4 pt-3 pl-8 ">
                               {{-- <a href="#" class="margin-r-20 relative" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <i><img class="" src="./assets/images/filter.svg" alt="" srcset=""></i>
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
                                            <input class="form-check-input" type="checkbox" value=""
                                                   id="todate">
                                            <label class="form-check-label" for="todate">
                                                To Date
                                            </label>
                                        </div>
                                    </a>
                                    <a class="dropdown-item border-top-bottom" href="#">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                   id="vendorName">
                                            <label class="form-check-label" for="vendorName">
                                                Vender Name
                                            </label>
                                        </div>
                                    </a>
                                    <a class="dropdown-item border-top-bottom" href="#">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                   id="Status">
                                            <label class="form-check-label" for="Status">
                                                Status
                                            </label>
                                        </div>
                                    </a>
                                </div>--}}
                            </div>
                            <div class="card-head ml-4 pl-4 pt-2 mt-1 ">
                                <div class="search">
                                    <input type="text" class="searchTerm table-search" data-url="{{route('vendor.payout')}}" placeholder="Search...">
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
                                    <th scope="col" style="padding: 14px;">Payout ID </th>
                                    <th scope="col" style="padding: 14px;">Description</th>
                                    <th scope="col" style="padding: 14px; text-align:center !important">Status</th>
                                    <th scope="col" style="padding: 14px; text-align:center !important"><b>  Date</b> <i class="fa fa-fw fa-sort"></i></th>
                                    <th scope="col" style="padding: 14px;" > Rate</th>
                                    <th scope="col" style="padding: 14px;">Amount</th>
                                    <th scope="col" style="padding: 14px;">Transaction ID</th>
                                </tr>
                                </thead>
                                <tbody class="mtop-20 f-13">
                                    @foreach($payouts as $payout)
                                        <tr class="tb-border cursor-pointer sidebar-toggle" data-sidebar="{{ route('vendor.sidebar.payout',['id'=>$payout->id]) }}">
                                            <td style="padding-top: 20px;" scope="row">{{$payout->public_payout_id}}</td>
                                            <td style="padding-top: 20px;">{{$payout->remarks ?? ''}}</td>
                                            <td style="padding: 14px; text-align:center !important;">
                                                @switch($payout->status)
                                                    @case(\App\Enums\PayoutEnums::$STATUS['transferred'])
                                                        <div class="status-badge green-bg" style=" font-size:600" >Completed</div>
                                                    @break

                                                    @case(\App\Enums\PayoutEnums::$STATUS['scheduled'])
                                                        <div class="status-badge green-bg" style=" font-size:600">Scheduled</div>
                                                    @break

                                                    @case(\App\Enums\PayoutEnums::$STATUS['processing'])
                                                        <div class="status-badge green-bg" style=" font-size:600">Processing</div>
                                                    @break

                                                    @case(\App\Enums\PayoutEnums::$STATUS['suspended'])
                                                        <div class="status-badge red-bg" style=" font-size:600">Suspended</div>
                                                    @break

                                                    @case(\App\Enums\PayoutEnums::$STATUS['cancelled'])
                                                        <div class="status-badge red-bg" style=" font-size:600">Cancelled</div>
                                                    @break

                                                @endswitch
                                            </td>
                                            <td style="padding-top: 20px; ">{{$payout->created_at->format('d M Y')}}</td>
                                            <td style="padding-top: 20px;">{{$payout->commission_percentage}}%</td>
                                            <td style="padding-top: 20px;"class="">₹{{$payout->final_payout}}</td>
                                            <td style="padding-top: 20px;">{{$payout->bank_transaction_id ?? ''}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            @if(count($payouts)== 0)
                                <div class="row hide-on-data">
                                    <div class="col-md-12 text-center p-20">
                                        <p class="font14"><i>. You don't any Bookings here.</i></p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="pagination mt-4 mb-3">
                        <ul>
                            <li class="p-1">Page</li>
                            <li class="digit">{{$payouts->currentPage()}}</li>
                            <li class="f-16 ml-2 mr-2" style="transform: translate(0px, 4px);">Of</li>
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
@endsection
