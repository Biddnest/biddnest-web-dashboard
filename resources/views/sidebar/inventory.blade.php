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
                <div class="col-sm-12 p-0">
                    <table class="table  p-0">
                        <thead class="secondg-bg border-none p-0">
                        <tr class="text-left">
                            <th scope="col" >Item Details</th>
                            <th scope="col" class="text-center">Economic Price</th>
                            <th scope="col" class="text-center">Primium Price</th>
                        </tr>
                        </thead>
                        <tbody class="mtop-20 ">

                        @foreach($inventories as $inventory)
                            <tr class="tb-border">
                                <td scope="row"> Size :{{$inventory->size}}
                                    <br>
                                    Material :{{$inventory->material}}
                                </td>

                                <td class="text-center">₹ {{$inventory->price_economics}}</td>
                                <td class="text-center">₹ {{$inventory->price_premium}}</td>
                            </tr>
                        @endforeach
                        </tbody>
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
        </div>
    </div>
</div>
