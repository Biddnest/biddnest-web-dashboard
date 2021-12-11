@extends('layouts.app')
@section('title') Coupons And Offers @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="cupons">
     <div class="d-flex  flex-row justify-content-between vertical-center">
         <h3 class="page-head text-left p-4 f-20 theme-text">Coupons & offers </h3>
         <div class="mr-20">
             <a href="{{route('create-coupons')}}">
                 <button class="btn theme-bg white-text">
                     <i class="fa fa-plus p-1" aria-hidden="true"></i>CREATE NEW
                 </button>
             </a>
         </div>
    </div>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left  pt-0 pb-0 p-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('coupons')}}">Coupons & offers</a></li>
                    <li class="breadcrumb-item" >Manage Coupons</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="vender-all-details">
        <div class="simple-card min-width-30">
            <p>TOTAL NO OF COUPONS</p>
            <h1>{{count($coupons)}}</h1>
        </div>
        <div class="simple-card min-width-30">
            <p>ACTIVE COUPONS</p>
            <h1>{{count($coupons_active)}}</h1>
        </div>
        <div class="simple-card min-width-30">
            <p>INACTIVE COUPONS</p>
            <h1>{{count($coupons_inactive)}}</h1>
        </div>
    </div>
    <!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-sm-12 pl-0 pr-0">
            <div class="card  h-auto p-0 pt-10">
                <div class="header-wrap">
                    <div class="col-sm-8 p-3 ml-3">
                        <h3 class="f-18 mt-3">Coupons & Offers </h3>
                    </div>

                    <div class="header-wrap p-0 col-sm-1" style="display: flex; justify-content: flex-end;  margin-right: -28px;" >
                        <a href="#" class="margin-r-20 filter-icon" aria-haspopup="true"  aria-expanded="false"  data-toggle="collapse" data-target="#filter-menu">
                            <i><img class="" src="{{asset('static/images/filter.svg')}}" alt="" srcset=""></i>
                        </a>
                    </div>

                    <div class="card-head left col-sm-3">
                        <div class="search">
                            <input type="text" class="searchTerm table-search" data-url="{{route('coupons')}}" placeholder="Search...">
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
                                <label style="font-weight:500 !important;">Status</label>
                                <select class="form-control br-5 selectfilter" name="status" data-action="status">
                                    <option value="">--Select--</option>
                                    @foreach(\App\Enums\CouponEnums::$STATUS as $key=>$status)
                                       <option value="{{$status}}">{{ucfirst(trans($key))}}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label style="font-weight:500 !important;">Valid From</label>
                                <input type="text" id="dateselect" name="payout_date_from" class="singledate form-control br-5 fromdate" placeholder="23/Nov/2020" />
                            </div>
                            <div class="col">
                                <label style="font-weight:500 !important;">Valid To</label>
                                <input type="text" id="dateselect1" name="payout_date_to" class="singledate form-control br-5 todate" placeholder="23/Dec/2020" />
                            </div>
                        </div>
                    </div>
                    <table class="table text-center p-0 theme-text mb-0 f-14">
                        <thead class="secondg-bg  p-0">
                                                    <tr>
                                                        <th scope="col">Coupon  Name</th>
                                                        <th scope="col">Discount Type</th>
                                                        <th scope="col">Value</th>
                                                        <th scope="col">Coupon Usage</th>
                                                        <th scope="col">Coupon Description</th>
                                                        <th scope="col">Created By</th>
                                                        <th scope="col" style="text-align: center !important;">Status</th>
                                                        <th scope="col">View</th>
                                                        <th scope="col">Operations</th>
                                                    </tr>
                                                </thead>
                        <tbody class="mtop-20 f-13">
                            @foreach($coupons as $coupon)
                                <tr class="tb-border cursor-pointer coup_{{$coupon->id}}">
                                    <td scope="row">{{$coupon->name}}</td>
                                    <td>
                                        @switch($coupon->discount_type)
                                            @case(\App\Enums\CouponEnums::$DISCOUNT_TYPE["fixed"])
                                                Fixed
                                            @break

                                            @case(\App\Enums\CouponEnums::$DISCOUNT_TYPE["percentage"])
                                                Percentage
                                            @break

                                            @default
                                                Unknown
                                        @endswitch
                                    </td>
                                    <td>
                                        @switch($coupon->discount_type)
                                            @case(\App\Enums\CouponEnums::$DISCOUNT_TYPE["fixed"])
                                                &#8377;{{$coupon->discount_amount}}
                                            @break

                                            @case(\App\Enums\CouponEnums::$DISCOUNT_TYPE["fixed"])
                                                {{$coupon->discount_amount}}%
                                            @break

                                            @default
                                                Unknown
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="d-flex  vertical-center">

                                            <div class="progress">
                                                <div class="progress-bar bg-progress" role="progressbar" style="width: {{$coupon->usage*100/$coupon->max_usage}}%" aria-valuenow="{{$coupon->usage}}" aria-valuemin="0" aria-valuemax="{{$coupon->max_usage}}"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{!! $coupon->desc !!}</td>
                                    <td>@isset($coupon->created_by) {{ $coupon->created_by->fname }} {{ $coupon->created_by->lname }} @else - @endif</td>
                                    <td>
                                        @if($coupon->status != \App\Enums\CouponEnums::$STATUS['expired'])
                                            <input type="checkbox" {{($coupon->status == \App\Enums\CouponEnums::$STATUS['active']) ? 'checked' : ''}}  class="change_status cursor-pointer changeclick" data-url="{{route('coupon_status_update',['id'=>$coupon->id])}}">
                                        @else
                                            <span class="status-badge info-bg  text-center td-padding">Expired</span>
                                        @endif
                                    </td>
<td><a  class="inline-icon-button mr-4 sidebar-toggle-link" style="display: table-cell; transform: translate(8px, 0px); " href="#" data-sidebar="{{ route('sidebar.coupon',['id'=>$coupon->id]) }}"><i class="icon fa fa-eye p-1 mr-4" aria-hidden="true"></i></a></td>
                                    <td>

                                        <a  class="inline-icon-button mr-4" style="display: table-cell; transform: translate(8px, 0px); " href="{{route('edit-coupons', ['id'=>$coupon->id])}}"><i class="icon dripicons-pencil p-1 mr-4" aria-hidden="true"></i></a>
                                        <a href="#" style="display: table-cell; transform: translate(16px, 0px);" class="delete inline-icon-button ml-4" data-parent=".coup_{{$coupon->id}}" data-confirm="Are you sure, you want delete this Coupon permanently? You won't be able to undo this." data-url="{{route('coupon_delete',['id'=>$coupon->id])}}"><i class="icon dripicons-trash p-1" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($coupons)== 0)
                        <div class="row hide-on-data">
                            <div class="col-md-12 text-center p-20">
                                <p class="font14"><i>. You don't have any Coupon here.</i></p>
                            </div>
                        </div>
                    @endif
                    <div class="pagination">
                            <ul>
                                <li class="p-1">Page</li>
                                <li class="digit">{{$coupons->currentPage()}}</li>
                                <li class="label">of</li>
                                <li class="digit">{{$coupons->lastPage()}}</li>
                                @if(!$coupons->onFirstPage())
                                    <li class="button"><a href="{{$coupons->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                    </li>
                                @endif
                                @if($coupons->currentPage() != $coupons->lastPage())
                                    <li class="button"><a href="{{$coupons->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
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
