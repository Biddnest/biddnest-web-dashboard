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
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        List of Items
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 d-flex justify-content-end">
                      {{--  <i class="icon dripicons-pencil p-1" aria-hidden="true"></i>
                        <i class="icon dripicons-trash p-1" aria-hidden="true"></i>--}}
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
                                @foreach($inventories->prices as $inventory)
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
                    @if(count($inventories->prices) == 0)
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
