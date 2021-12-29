<div class="modal-header pb-0 border-none">
    <input type="hidden" value='@json($graph)' id="revenue_dataset">
    <h3 class="f-14">
        <ul class="nav nav-tabs pt-20 p-0" id="myTab" role="tablist">
            <li class="nav-item" style="margin-right: 0px;">
                <a class="nav-link active pl-4 p-15" id="new-order-tab" data-toggle="tab" href="#vendor" role="tab"
                   aria-controls="home" aria-selected="true">Vendor Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link p-15" id="quotation" data-toggle="tab" href="#customer" role="tab"
                   aria-controls="profile" aria-selected="false">Vendor Insights</a>
            </li>
            <li class="nav-item">
                <a class="nav-link p-15" id="quotation" data-toggle="tab" href="#price" role="tab"
                   aria-controls="profile" aria-selected="false">Item Price List</a>
            </li>
        </ul>
    </h3>

    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close"
            onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
        <i class="fa fa-times theme-text" aria-hidden="true"></i>
    </button>
</div>
<div class="modal-body border-top margin-topneg-7 vendor-modal p-1 ml-4">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="vendor" role="tabpanel" aria-labelledby="past-tab">

            <div class="row d-flex  pb-3 pl-3">
                <div class="col-lg-6 align-items-center">
                    <h1 class="f-14  bold">Vendor Name</h1>
                </div>
                <div class="col-lg-6 d-flex justify-content-between align-items-center edit">
                    <h1 class="side-popup-content">{{ucfirst(trans($organization->admin->fname))}} {{ucfirst(trans($organization->admin->lname))}}</h1>
                    <a href="{{route('onboard-edit-vendors', ["id"=>$organization->id])}}"><i class="icon dripicons-pencil pl-1 cursor-pointer theme-text" style="margin-right: 12px;" aria-hidden="true"></i></a>
                </div>
            </div>

            <div class="row d-flex pb-3 pl-3">
                <div class="col-lg-6 align-items-center">
                    <h1 class="f-14  bold">Org Name</h1>
                </div>
                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                    <h1 class="side-popup-content">{{ucfirst(trans($organization->org_name))}} {{ucfirst(trans($organization->org_type))}}</h1>


                </div>
            </div>
            <div class="row d-flex pb-3 pl-3">
                <div class="col-lg-6 align-items-center">
                    <h1 class="f-14  bold">Phone Number</h1>
                </div>
                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                    <h1 class="side-popup-content">+91 - {{$organization->phone}}</h1>
                </div>
            </div>
            <div class="row d-flex pb-3 pl-3">
                <div class="col-lg-6 align-items-center">
                    <h1 class="f-14  bold">Alt. Phone Number</h1>
                </div>
                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                    <h1 class="side-popup-content">+91 - {{json_decode($organization->meta, true)['secondory_phone']}}</h1>
                </div>
            </div>
            <div class="row d-flex pb-3 pl-3">
                <div class="col-lg-6 align-items-center">
                    <h1 class="f-14  bold">City</h1>
                </div>
                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                    <h1 class="side-popup-content">{{$organization->city}}</h1>
                </div>
            </div>
            <div class="row d-flex pb-3 pl-3">
                <div class="col-lg-6 align-items-center">
                    <h1 class="f-14  bold">Status</h1>
                </div>
                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                    @foreach(\App\Enums\OrganizationEnums::$STATUS as $key=>$status)
                        @if($status == $organization->status)
                            <div class="status-badge light-bg">{{ucfirst(trans($key))}}</div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="row d-flex pb-4 pl-3">
                <div class="col-lg-6 align-items-center">
                    <h1 class="f-14  bold">Zone</h1>
                </div>
                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                    <h1 class="side-popup-content">
                        @foreach($organization->cities as $city)
                            {{ucfirst(trans($city->name))}},
                        @endforeach
                    </h1>
                </div>
            </div>
           {{-- <div class="row pb-3 pl-3">
                <h3 class="f-18 mt-0">Revenue Trend</h3>
                <div class="revenue-chart">
                    <canvas id="myRevenueChart" height="230px" width="700px"></canvas>
                </div>
            </div>--}}


            <div class="d-flex justify-content-center p-20">
                <div class="">
                    <a class="white-text p-10" href="{{route('vendor-details', ["id"=>$organization->id])}}" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                        <button class="btn theme-bg white-text my-0" style="width: 127px;
                                    border-radius: 6px;">View More</button>
                    </a>
                </div>
            </div>



        </div>
        <div class="tab-pane fade  margin-topneg-15" id="customer" role="tabpanel" aria-labelledby="past-tab">
            <!-- form starts -->

            <div class="row d-flex  pb-3 pt-3 pl-3">
                <div class="col-lg-6 align-items-center">
                    <h1 class="f-14  bold">Service Type</h1>
                </div>
                <div class="col-lg-6 d-flex justify-content-between align-items-center edit">
                    @foreach(\App\Enums\OrganizationEnums::$SERVICES as $key=>$services)
                        @if($organization->service_type == $services)
                            <h1 class="side-popup-content">{{ucfirst(trans($key))}}</h1>
                        @endif
                    @endforeach
                    <a href="{{route('onboard-edit-vendors', ["id"=>$organization->id])}}"><i class="icon dripicons-pencil pl-1 cursor-pointer theme-text" style="margin-right: 12px;" aria-hidden="true"></i></a>
                </div>
            </div>

            <div class="row d-flex pb-3 pl-3">
                <div class="col-lg-6 align-items-center">
                    <h1 class="f-14  bold">Services Provided</h1>
                </div>
                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                    <h1 class="side-popup-content">
                        @foreach($organization->services as $services)
                            {{ucfirst(trans($services->name))}},
                        @endforeach
                    </h1>


                </div>
            </div>
            <div class="row d-flex pb-3 pl-3">
                <div class="col-lg-6 align-items-center">
                    <h1 class="f-14  bold">Alt. Phone Number</h1>
                </div>
                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                    <h1 class="side-popup-content">+91 - {{json_decode($organization->meta, true)['secondory_phone']}}</h1>
                </div>
            </div>
            <div class="row d-flex pb-3 pl-3">
                <div class="col-lg-6 align-items-center">
                    <h1 class="f-14  bold">No of branches</h1>
                </div>
                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                    <h1 class="side-popup-content">{{$branch}}</h1>
                </div>
            </div>


            <div class="d-flex row  p-20 border-top-pop">
                <div class="col-lg-6 pl-0">
                    <div class="theme-text ml-2 f-14 bold">
                        List of Payouts
                    </div>
                </div>
            </div>
            <table class="table text-center p-10 theme-text th-no-border">
                <thead class="secondg-bg p-0"  >
                <tr>
                    <th scope="col" class="text-left" style="padding-left: 14px !important;">Payout ID</th>
                    <th scope="col">Status</th>
                    <th scope="col">Payout Date</th>

                </tr>
                </thead>
                <tbody class="mtop-20">
                    @foreach($payouts as $payout)
                        <tr class="cursor-pointer">
                            <td scope="row" class="text-left" style="padding-left: 14px !important;">
                                <p style="text-decoration: underline;margin: 0;">{{$payout->public_payout_id}}</p>
                            </td>
                            <td class="">
                                @foreach(\App\Enums\PayoutEnums::$STATUS as $key=>$status)
                                    @if($status == $payout->status)
                                        <div class="status-badge green-bg">{{ucfirst(trans($key))}}</div>
                                    @endif
                                @endforeach
                            </td>
                            <td class="text-center">{{date('d M y', strtotime($payout->dispatch_at))}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if(count($payouts)== 0)
                <div class="row hide-on-data">
                    <div class="col-md-12 text-center p-20">
                        <p class="font14"><i>.This Vendor don't have any Payouts here..</i></p>
                    </div>
                </div>
            @endif
            <div class="d-flex   justify-content-center p-20">

                <div class=""><a class="white-text p-10" href="{{route('vendor-details', ["id"=>$organization->id])}}" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                        <button class="btn theme-bg white-text my-0" style="width: 127px;
                                border-radius: 6px;">View More</button>
                    </a></div>
            </div>
        </div>

        <div class="tab-pane fade  margin-topneg-15" id="price" role="tabpanel" aria-labelledby="past-tab"
             aria-labelledby="new-order-tab">
            <div class="row d-flex  pb-3 pt-3 pl-3">
                <div class="col-lg-6 align-items-center">
                    <h1 class="f-14  bold">Item Price List</h1>
                </div>
            </div>
            <div class="col-sm-12 p-0">
                    <table class="table  p-0">
                        <thead class="secondg-bg border-none p-0">
                        <tr class="text-left">
                            <th scope="col" >Item Details</th>
                            <th scope="col" class="text-center">Economic Price</th>
                            <th scope="col" class="text-center">Primium Price</th>
                        </tr>
                        </thead>
                        @foreach($service_types as $service_type)
                            <tbody class="mtop-20 ">
                            <tr class="tb-border"><td scope="row" style="font-size: 14px; font-weight: 700;">{{$service_type->service->name}}</td></tr>
                            @foreach($inventories as $inventory)
                                @if($service_type->service->id == $inventory->service_type)
                                    <tr class="tb-border">
                                        <td scope="row"> Size :{{$inventory->size}}
                                            <br>
                                            Material :{{$inventory->material}}
                                        </td>

                                        <td class="text-center">@if($inventory->price_economics)₹ {{$inventory->price_economics}} @else NA @endif</td>
                                        <td class="text-center">@if($inventory->price_premium)₹ {{$inventory->price_premium}} @else NA @endif</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        @endforeach
                    </table>
                    @if(count($inventories) == 0)
                        <div class="row hide-on-data">
                            <div class="col-md-12 text-center p-20">
                                <p class="font14"><i>. You didn't add any price on this Inventory.</i></p>
                            </div>
                        </div>
                    @endif
                </div>
        </div>

        <!--  -->
    </div>
</div>

