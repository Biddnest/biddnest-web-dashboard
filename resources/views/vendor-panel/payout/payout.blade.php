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
                    <h1>{{sizeof(array_keys((array)$payouts, (string)\App\Enums\PayoutEnums::$STATUS['scheduled']))}}</h1>
                </div>
                <div class="simple-card min-width-30">
                    <p>FAILED PAYOUTS</p>
                    <h1>{{sizeof(array_keys((array)$payouts, (string)\App\Enums\PayoutEnums::$STATUS['suspended']))}}</h1>
                </div>
            </div>
            <!-- Dashboard cards -->
            <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
                <div class="col-sm-12">
                    <div class="card  h-auto p-0 pt-10">
                        <div class="row no-gutters">
                            <div class="col-sm-8 p-3 ">
                                <h3 class="f-18">Vendor Payout </h3>
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
                            <div class="card-head  pt-2 mt-1 left col-sm-3">
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
                                    <th scope="col">Payout ID </th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"><b> Date</b> <i class="fa fa-fw fa-sort"></i></th>
                                    <th scope="col" > Rate</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Transaction ID</th>
                                </tr>
                                </thead>
                                <tbody class="mtop-20 f-13">
                                    @foreach($payouts as $payout)
                                        <tr class="tb-border cursor-pointer sidebar-toggle" data-sidebar="{{ route('vendor.sidebar.payout',['id'=>$payout->id]) }}">
                                            <td scope="row">{{$payout->public_payout_id}}</td>
                                            <td>{{$payout->remarks ?? ''}}</td>
                                            <td>
                                                @switch($payout->status)
                                                    @case(\App\Enums\PayoutEnums::$STATUS['transferred'])
                                                        <div class="status-badge green-bg">Completed</div>
                                                    @break

                                                    @case(\App\Enums\PayoutEnums::$STATUS['scheduled'])
                                                        <div class="status-badge green-bg">Scheduled</div>
                                                    @break

                                                    @case(\App\Enums\PayoutEnums::$STATUS['processing'])
                                                        <div class="status-badge green-bg">Processing</div>
                                                    @break

                                                    @case(\App\Enums\PayoutEnums::$STATUS['suspended'])
                                                        <div class="status-badge red-bg">Suspended</div>
                                                    @break

                                                    @case(\App\Enums\PayoutEnums::$STATUS['cancelled'])
                                                        <div class="status-badge red-bg">Cancelled</div>
                                                    @break

                                                @endswitch
                                            </td>
                                            <td>{{$payout->created_at->format('d M Y')}}</td>
                                            <td>{{$payout->commission_percentage}}%</td>
                                            <td class="">₹{{$payout->final_payout}}</td>
                                            <td>{{$payout->bank_transaction_id ?? ''}}</td>
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
                    </div>

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
@endsection
