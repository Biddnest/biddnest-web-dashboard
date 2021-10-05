{{--@php print_r($inventories); exit; @endphp--}}


<div class="modal-header pb-0 border-none">
    <h3 class="f-18 p-10">
        Item Details
    </h3>
    <button type="button" class="close theme-text margin-topneg-10" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
        <!-- <span aria-hidden="true" >&times;</span> -->
        <i class="fa fa-times theme-text" aria-hidden="true"></i>
    </button>
</div>
<div class="modal-body border-top margin-topneg-7">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active " id="details" role="tabpanel"
             aria-labelledby="zone-tab">
            <!-- form starts -->
            <div class="d-flex  row justify-content-between p-8">
                <div class="col-sm-12 p-0">
                    @foreach($service_types as $service_type)
                        <label style="font-size: 14px; font-weight: 700;">{{ucwords($service_type->service->name)}}</label>
                        <table class="table  p-0">
                            <thead class="secondg-bg border-none p-0">
                                <tr class="text-left">
                                    <th scope="col" >Item Details</th>
                                    <th scope="col" class="text-center">BD Economic Price</th>
                                    <th scope="col" class="text-center">BD Primium Price</th>
                                    <th scope="col" class="text-center">MP Economic Price</th>
                                    <th scope="col" class="text-center">MP Primium Price</th>
                                </tr>
                            </thead>
                            <tbody class="mtop-20 ">
                                @foreach($inventories as $inventory)
                                    @if($service_type->service->id == $inventory->service_type)
                                        <tr class="tb-border">
                                            <td scope="row" style="font-weight: 500"> {{--Size :--}}{{ucwords($inventory->size)}}
                                                <br>
                                                {{--Material :--}}{{ucwords($inventory->material)}}
                                            </td>

                                            <td class="text-center">@if($inventory->bp_economic)₹ {{$inventory->bp_economic}} @else NA @endif</td>
                                            <td class="text-center">@if($inventory->bp_premium)₹ {{$inventory->bp_premium}} @else NA @endif</td>
                                            <td class="text-center">@if($inventory->mp_economic)₹ {{$inventory->mp_economic}} @else NA @endif</td>
                                            <td class="text-center">@if($inventory->mp_premium)₹ {{$inventory->price_premium}} @else NA @endif</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                    @if(count($inventories) == 0)
                        <div class="row hide-on-data">
                            <div class="col-md-12 text-center p-20">
                                <p class="font14"><i>. You didn't add any price on this Inventory.</i></p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
