@extends('layouts.app')
@section('title') Referral Vouchers @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="cupons">
     <div class="d-flex  flex-row justify-content-between vertical-center">
         <h3 class="page-head text-left p-4 f-20 theme-text">Referral Vouchers</h3>
         <div class="mr-20">
             <a href="{{route('create-voucher')}}">
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
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('vouchers')}}">Referral Vouchers</a></li>
                    <li class="breadcrumb-item" >Manage Vouchers</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="vender-all-details">
        <div class="simple-card min-width-30">
            <p>TOTAL</p>
            <h1>{{count($vouchers)}}</h1>
        </div>
        <div class="simple-card min-width-30">
            <p>ACTIVE</p>
            <h1>{{count($vouchers_active)}}</h1>
        </div>
        <div class="simple-card min-width-30">
            <p>INACTIVE</p>
            <h1>{{count($vouchers_inactive)}}</h1>
        </div>
    </div>
    <!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-sm-12 pl-0 pr-0">
            <div class="card  h-auto p-0 pt-10">
                <div class="header-wrap">
                    <div class="col-sm-8 p-3 ml-3">
                        <h3 class="f-18 mt-3">All Vouchers</h3>
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
                    <table class="table text-center p-0 theme-text mb-0 f-14">
                        <thead class="secondg-bg  p-0">
                                                    <tr>
                                                        <th scope="col">Image</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Title</th>
                                                        <th scope="col">Provider</th>
                                                        <th scope="col" style="text-align: center !important;">Type</th>
                                                        <th scope="col" style="text-align: center !important;">Status</th>
                                                        <th scope="col">Operations</th>
                                                    </tr>
                                                </thead>
                        <tbody class="mtop-20 f-13">
                            @foreach($vouchers as $voucher)
                                <tr class="tb-border cursor-pointer coup_{{$voucher->id}} sidebar-toggle" {{--data-sidebar="{{ route('sidebar.coupon',['id'=>$voucher->id]) }}"--}}>
                                    <td scope="row"><img src="{{$voucher->image}}" class="img-responsive" style="width: 100px; height: 100px;"></td>
                                    <td scope="row">{{$voucher->name}}</td>
                                    <td scope="row">{{$voucher->title}}</td>
                                    <td>
                                        @switch($voucher->provider)
                                            @case(\App\Enums\VoucherEnums::$PROVIDER["amazon"])
                                                Amazon
                                            @break
                                            @default
                                                Unknown
                                        @endswitch
                                    </td>
                                    <td>
                                        @switch($voucher->type)
                                            @case(\App\Enums\VoucherEnums::$TYPE["predefined"])
                                                Predefined
                                            @break

                                            @case(\App\Enums\VoucherEnums::$DISCOUNT_TYPE["generated"])
                                                Generated
                                            @break
                                            @default
                                                Unknown
                                        @endswitch
                                    </td>
                                    <td >
                                        @switch($voucher->status)
                                            @case(\App\Enums\VoucherEnums::$STATUS['active'])
                                                <span class="status-badge green-bg  text-center td-padding">Active</span>
                                            @break
                                            @case(\App\Enums\VoucherEnums::$STATUS['inactive'])
                                                <span class="status-badge red-bg  text-center td-padding">Inactive</span>
                                            @break
                                            @case(\App\Enums\VoucherEnums::$STATUS['out_of_stock'])
                                                <span class="status-badge info-bg  text-center td-padding">Expired</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <a  class="inline-icon-button mr-4" style="display: table-cell; transform: translate(8px, 0px); " href="{{route('edit-voucher', ['id'=>$voucher->id])}}"><i class="icon dripicons-pencil p-1 mr-4" aria-hidden="true"></i></a>
                                        <a href="#" style="display: table-cell; transform: translate(16px, 0px);" class="delete inline-icon-button ml-4" data-parent=".coup_{{$voucher->id}}" data-confirm="Are you sure, you want delete this Voucher permanently? You won't be able to undo this." data-url="{{route('api.voucher.delete',['id'=>$voucher->id])}}"><i class="icon dripicons-trash p-1" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($vouchers)== 0)
                        <div class="row hide-on-data">
                            <div class="col-md-12 text-center p-20">
                                <p class="font14"><i>. You don't have any vouchers here. Create a new one instead.</i></p>
                            </div>
                        </div>
                    @endif
                    <div class="pagination">
                            <ul>
                                <li class="p-1">Page</li>
                                <li class="digit">{{$vouchers->currentPage()}}</li>
                                <li class="label">of</li>
                                <li class="digit">{{$vouchers->lastPage()}}</li>
                                @if(!$vouchers->onFirstPage())
                                    <li class="button"><a href="{{$vouchers->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                    </li>
                                @endif
                                @if($vouchers->currentPage() != $vouchers->lastPage())
                                    <li class="button"><a href="{{$vouchers->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
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
