@extends('layouts.app')
@section('title') Coupons And Offers @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="cupons">
     <div class="d-flex  flex-row justify-content-between vertical-center">
                                <h3 class="page-head text-left p-4 f-20 theme-text">Coupons & offers </h3>
                                <div class="mr-20">
                                    <a href="{{route('create-coupons')}}">
                                        <button class="btn theme-bg white-text"><i class="fa fa-plus p-1"
                                            aria-hidden="true"></i>CREATE NEW</button>
                                    </a>

                                </div>
    </div>
    <div class="d-flex  flex-row justify-content-between">
                                <div class="page-head text-left  pt-0 pb-0 p-2">
                                  <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active" aria-current="page">Coupons & offers</li>
                                      <li class="breadcrumb-item"><a href="#"> Manage Coupons</a></li>

                                    </ol>
                                  </nav>


                                </div>

    </div>

    <div class="vender-all-details">
                                <div class="simple-card min-width-30">
                                    <p>TOTAL NO OF COUPONS</p>
                                    <h1>{{$total_coupons}}</h1>
                                </div>
                                <div class="simple-card min-width-30">
                                    <p>ACTIVE COUPONS</p>
                                    <h1>{{$active_coupons}}</h1>
                                </div>
                                <div class="simple-card min-width-30">
                                    <p>INACTIVE COUPONS</p>
                                    <h1>{{$inactive_coupons}}</h1>
                                </div>


    </div>
                            <!-- Dashboard cards -->


    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-sm-12">
            <div class="card  h-auto p-0 pt-10">
                <div class="header-wrap">
                    <div class="col-sm-8 p-3 ">
                        <h3 class="f-18">Coupons & Offers </h3>
                    </div>

                    <div class="header-wrap p-0 col-sm-1" >
                        <a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i><img src="{{asset('static/images/filter.svg')}}" alt="" srcset="" ></i>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="date">
                                    <label class="form-check-label" for="date">
                                        Date
                                    </label>
                            </div></a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="zone">
                                    <label class="form-check-label" for="zone">
                                        Zone
                                    </label>
                            </div></a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="city">
                                    <label class="form-check-label" for="city">
                                        City
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="couponName">
                                    <label class="form-check-label" for="couponName">
                                        Coupon Name
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="couponType">
                                    <label class="form-check-label" for="couponType">
                                        Coupon Type
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="status">
                                    <label class="form-check-label" for="status">
                                        Status
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
                    <table class="table text-center p-0 theme-text mb-0 primary-table">
                                                <thead class="secondg-bg  p-0">
                                                    <tr>
                                                        <th scope="col">Coupon  Name</th>
                                                        <th scope="col">Coupon Type</th>
                                                        <th scope="col">Value</th>
                                                        <th scope="col">Coupon Usage</th>
                                                        <th scope="col">Coupon Description</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Operations</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="mtop-20 f-13">
                                                @foreach($coupons as $coupon)
                                                    <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">{{$coupon->name}}</td>
                                                        <td>
                                                            @switch($coupon->type)
                                                                @case(\App\Enums\CouponEnums::$DISCOUNT_TYPE["fixed"])
                                                                Fixed
                                                                @break

                                                                @case(\App\Enums\CouponEnums::$DISCOUNT_TYPE["fixed"])
                                                                Percentage
                                                                @break

                                                                @default
                                                                Unknown
                                                            @endswitch
                                                        </td>
                                                        <td>
                                                            @switch($coupon->type)
                                                                @case(\App\Enums\CouponEnums::$DISCOUNT_TYPE["fixed"])
                                                                &#8377; {{$coupon->discount_amount}}
                                                                @break

                                                                @case(\App\Enums\CouponEnums::$DISCOUNT_TYPE["fixed"])
                                                                {{$coupon->discount_amount}}%
                                                                @break

                                                                @default
                                                                Unknown
                                                            @endswitch
                                                        </td></td>
                                                        <td>
                                                           <div class="d-flex justify-content-center vertical-center">

                                                            <div class="progress">
                                                                <div class="progress-bar bg-progress" role="progressbar" style="width: 30%" aria-valuenow="{{$coupon->usage}}" aria-valuemin="0" aria-valuemax="{{$coupon->max_usage}}"></div>
                                                              </div>
                                                           </div>

                                                            </td>
                                                        <td>{{$coupon->desc}}</td>
                                                        <td class="">
                                                            @switch($coupon->status)
                                                                @case(\App\Enums\CouponEnums::$STATUS['active'])
                                                                <span class="status-badge green-bg  text-center td-padding">Active</span>
                                                                @break
               @case(\App\Enums\CouponEnums::$STATUS['inactive'])
                                                                <span class="status-badge red-bg  text-center td-padding">Inactive</span>
                                                                @break
               @case(\App\Enums\CouponEnums::$STATUS['expired'])
                                                                <span class="status-badge info-bg  text-center td-padding">Expired</span>
                                                                @break

                                                            @endswitch


                                                        </td><td><i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i class="icon dripicons-trash p-1" aria-hidden="true"></i></td>
                                                    </tr>
                                                </tbody>
                                                @endforeach

                                            </table>
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
