@extends('layouts.app')
@section('title') Vendor Management @endsection
@section('content')
<!-- Main Content -->
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="vendorDetails">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4">Order Details</h3>
    </div>
    <div class="d-flex  flex-row justify-content-between">
      <div class="page-head text-left p-4 pt-0 pb-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Vendor Management</li>
            <li class="breadcrumb-item"><a href="{{ route('vendors')}}">Manage vendor</a></li>
            <li class="breadcrumb-item active" aria-current="page">Venor Details</li>
          </ol>
        </nav>
      </div>
  </div>

    <!-- Dashboard cards -->
    <div class="d-flex flex-row  Dashboard-lcards  justify-content-center">
        <div class=" col-sm-10" >
            <div class="card  h-auto p-0 pt-10 " >
                <div class="card-head right text-center   ptop-5">
                    <div class="d-flex justify-content-between">
                        <h3>
                            <ul class="nav nav-tabs pt-20 justify-content-start p-0 flex-row f-18" id="myTab" styele ="margin-left: 0px;" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link active p-15" id="customer-details-tab" data-toggle="tab" href="#customer-details" role="tab" aria-controls="home" aria-selected="true">Vendor Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="#vendor-details" role="tab" aria-controls="profile" aria-selected="false">Vendor Insights</a>
                                </li>
                            </ul>
                        </h3>
                        <div class="eidt-icon margin-r-20 vertical-center p-10" style="margin-top: 15px;">
                            <a href="{{route('onboard-edit-vendors', ["id"=>$organization->id])}}"><i class="fa fa-pencil p-1 cursor-pointer theme-text" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="tab-content border-top margin-topneg-7" id="myTabContent">
                    <div class="tab-pane fade show active" id="customer-details" role="tabpanel" aria-labelledby="customer-details-tab">
                        <div class="d-flex  row p-15 " >
                            <div class="col-sm-4  secondg-bg margin-topneg-15 pt-10">
                                <div class="theme-text f-14 bold p-20">
                                    Vendor Name
                                </div>
                                <div class="theme-text f-14 bold p-20">
                                    Org Name
                                </div>
                                <div class="theme-text f-14 bold p-20">
                                    Assigned Driver
                                </div>
                                <div class="theme-text f-14 bold p-20">
                                    Phone Number
                                </div>
                                <div class="theme-text f-14 bold p-20">
                                    City
                                </div>
                                <div class="theme-text f-14 bold p-20">
                                    Status
                                </div>
                                <div class="theme-text f-14 bold p-20">
                                    Org Description
                                </div>
                                <div class="theme-text f-14 bold p-20">
                                    State
                                </div>
                                <div class="theme-text f-14 bold p-20">
                                    Pin Code
                                </div>
                            </div>

                            <div class="col-sm-5 white-bg  margin-topneg-15 pt-10">
                                <div class="theme-text f-14 p-20">
                                    {{ucfirst(trans($organization->admin->fname))}} {{ucfirst(trans($organization->admin->lname))}}
                                </div>
                                <div class="theme-text f-14 p-20">
                                      {{ucfirst(trans($organization->org_name))}} {{ucfirst(trans($organization->org_type))}}
                                </div>
                                <div class="theme-text f-14 p-20">
                                      @foreach($organization->vendors as $driver)
                                          {{ucfirst(trans($driver->fname))}} {{ucfirst(trans($driver->lname))}},
                                      @endforeach
                                </div>
                                <div class="theme-text f-14 p-20">
                                    +91 - {{$organization->phone}}
                                </div>
                                <div class="theme-text f-14 p-20">
                                    {{$organization->city}}
                                </div>
                                <div class="theme-text f-14 p-20">
                                    <span class="status-badge">
                                        @foreach(\App\Enums\OrganizationEnums::$STATUS as $key=>$status)
                                            @if($status == $organization->status)
                                                <div class="status-badge light-bg">{{ucfirst(trans($key))}}</div>
                                            @endif
                                        @endforeach
                                    </span>
                                </div>
                                <div class="theme-text f-12 p-20 pb-0">
                                  <p class="">{{json_decode($organization->meta, true)['org_description']}}</p>
                                </div>
                                <div class="theme-text f-14 p-20 ">
                                    {{$organization->state}}
                                </div>
                                <div class="theme-text f-14 p-20 ">
                                    {{$organization->pincode}}
                                </div>
                            </div>

                            <div class="col-sm-6 mt-2">
                                <div class="theme-text f-14 bold">
                                    Vendor Revenue Trend
                                </div>
                            </div>
                            <div class="col-sm-12 p-20 mt-2">
                                <div class="theme-text f-14 bold text-center">
                                    <img src="{{asset('static/images/graph/graph-lg.svg')}}" width="95%">
                                </div>
                            </div>
                        </div>

                        {{--<div class="border-top-3">
                            <div class="d-flex justify-content-between">
                                <div class="w-100">
                                    <a class="white-text p-20" href="#"><button class="btn theme-br theme-text w-30 white-bg">Back</button></a>
                                </div>
                                <div class="w-100 margin-r-20">
                                    <div class="d-flex justify-content-end">
                                        <div></div>
                                        <button  class="btn white-text theme-bg w-30">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>--}}

                    <!-- Tab-1 form -->
                    </div>
                    <div class="tab-pane fade   " id="vendor-details" role="tabpanel" aria-labelledby="vendor-tab">

                        <div class="d-flex  row  p-15 pb-0">

                            <div class="col-sm-4  secondg-bg margin-topneg-15 pt-10">
                                <div class="theme-text f-14 bold p-20">
                                    Service Type
                                </div>
                                <div class="theme-text f-14 bold p-20">
                                    Services Provided
                                </div>
                                <div class="theme-text f-14 bold p-20">
                                    Alt. Phone Number
                                </div>
                                <div class="theme-text f-14 bold p-20">
                                    No of branches
                                </div>

                            </div>
                            <div class="col-sm-5 white-bg  margin-topneg-15 pt-10">

                                <div class="theme-text f-14 p-20">
                                    @foreach(\App\Enums\OrganizationEnums::$SERVICES as $key=>$services)
                                        @if($organization->service_type == $services)
                                            <h1 class="side-popup-content">{{ucfirst(trans($key))}}</h1>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="theme-text f-14 p-20">
                                    @foreach($organization->services as $services)
                                        {{ucfirst(trans($services->name))}},
                                    @endforeach
                                </div>
                                <div class="theme-text f-14 p-20">
                                    +91 - {{json_decode($organization->meta, true)['secondory_phone']}}
                                </div>
                                <div class="theme-text f-14 p-20">
                                    {{$branch}}
                                </div>
                            </div>
                        </div>

                        <div class="d-flex  row  p-20">

                            <div class="col-sm-6">
                              <div class="theme-text f-14 bold">
                                List of Payouts
                              </div>

                            </div>
                        </div>
                        <table class="table text-center p-20 theme-text">
                            <thead class="secondg-bg  p-0">
                                <tr>
                                    <th scope="col">Payout ID</th>
                                    <th scope="col" >Description</th>
                                    <th scope="col" >Status</th>
                                    <th scope="col" >Pay out Date</th>
                                    <th scope="col" >Amount</th>
                                    <th scope="col" >Commission Rate</th>
                                </tr>
                            </thead>
                            <tbody class="mtop-15">
                                @if(!$payouts)
                                    <tr class="cursor-pointer">
                                        <p> There is no any Payout Added</p>
                                    </tr>
                                @endif
                                @foreach($payouts as $payout)
                                    <tr class="tb-border  cursor-pointer">
                                        <th scope="row">{{$payout->public_payout_id}}</th>
                                        <td class=""><span class=" text-center ">Payment for BLR movers</span></td>
                                        <td  class="text-center">
                                            @switch($payout->status)
                                                @case(\App\Enums\PayoutEnums::$STATUS['scheduled']):
                                                <span class="status-badge red-bg">Scheduled</span>
                                                @break

                                                @case(\App\Enums\PayoutEnums::$STATUS['processing']):
                                                <span class="status-badge">Processing</span>
                                                @break

                                                @case(\App\Enums\PayoutEnums::$STATUS['transferred']):
                                                <span class="status-badge green-bg">Transferred</span>
                                                @break

                                                @case(\App\Enums\PayoutEnums::$STATUS['suspended']):
                                                <span class="status-badge red-bg">Suspended</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td class=""><span class=" text-center ">{{date('d M y', strtotime($payout->dispatch_at))}}</span></td>
                                        <td class=""><span class=" text-center ">₹{{$payout->amount}}</span></td>
                                        <td class=""><span class=" text-center ">{{$payout->commission_percentage}}%</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{--<div class="border-top-3">
                            <div class="d-flex justify-content-start">
                                <div class="w-50">
                                    <a class="white-text p-20" href="#"><button class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>
                                </div>
                                <div class="w-50 margin-r-20">
                                    <div class="d-flex justify-content-end">
                                        <button  class="btn theme-text white-bg theme-br w-30 mr-20">Back</button>
                                        <button  class="btn white-text theme-bg w-30" >Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>--}}
                    </div>
    <!--  -->
            </div>
        </div>
    </div>
</div>




</div>

@endsection
