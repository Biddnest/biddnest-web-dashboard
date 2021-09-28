@extends('vendor-panel.layouts.frame')
@section('title') Manage Inventory @endsection
@section('body')

    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="editinventory">
        <div class="d-flex  flex-row justify-content-between vertical-center">
            <h3 class="page-head text-left p-4 f-20 theme-text">Inventory Management</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('vendor.inventorymgt')}}">Inventory Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Item</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Dashboard cards -->
        <form class="form-new-order  input-text-blue" action="{{route('api.updateInventoryPrices')}}" method= "PUT" data-next="redirect" data-redirect-type="hard" data-url="{{route('vendor.inventorymgt')}}" data-alert="tiny" id="myForm" data-parsley-validate>

            <input type="hidden" name="inventory_id" value="{{$inventory_id}}">
            {{--<input type="hidden" value="{{$service_id}}" name="service_type">--}}
            @foreach($service_types as $service_type)
                <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
                    <div class="col-lg-12">
                        <div class="card h-auto p-0 pt-20 pb-0">
                            <ul class="nav nav-tabs p-0 flex-row" id="myTab" role="tablist" style="font-weight: 600;">
                                <li class="nav-item ">
                                    <a class="nav-link active p-15" href="#" style="font-size: 20px;">{{$service_type->service->name}}</a>
                                </li>
                            </ul>

                            <table class="table  text-left p-0 theme-text mb-0 primary-table p-15">
                                <thead class="secondg-bg p-0">
                                    <tr>
                                        <th scope="col" style="padding:14px">Item</th>
                                        <th scope="col" style="padding:14px">Size</th>
                                        <th scope="col" class="text-center" style="padding:14px">Material</th>
                                        <th scope="col" class="text-center" style="padding:14px">BD Economic Price</th>
                                        <th scope="col" class="text-center" style="padding:14px">BD Premium Price</th>
                                        <th scope="col" class="text-center" style="padding:14px">MP Economic Price</th>
                                        <th scope="col" class="text-center" style="padding:14px">MP Premium Price</th>
                                    </tr>
                                </thead>
                                <tbody class="mtop-20 inventory-snip">
                                    @if($inventories)
                                        @foreach($inventories as $inventory)
                                            @if($service_type->service->id == $inventory->service_type)
                                                        <tr class="tb-border">
                                                            <td scope="row" style="padding-top: 24px;">
                                                                <span>{{$item->name}}</span>
                                                                <input type="hidden" value="{{$inventory->id}}" name="price[][id]">
                                                            </td>
                                                            <td style="padding-top: 24px;">
                                                                <span>{{$inventory->size}}</span>
                                                                <input type="hidden" value="{{$inventory->size}}" name="price[][size]">
                                                            </td>
                                                            <td class="text-center" style="padding-top: 24px;">
                                                                <span>{{$inventory->material}}</span>
                                                                <input type="hidden" value="{{$inventory->material}}" name="price[][material]">
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center inventroy-price">
                                                                    <div class="currancy">₹</div>
                                                                    <div class="form-input table-input"><input type="number" class="form-control" name="price[][bidnest][price][economics]" value="{{$inventory->bp_economic}}" id="" placeholder="400"></div>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center inventroy-price">
                                                                    <div class="currancy">₹</div>
                                                                    <div class="form-input table-input"><input type="number" class="form-control" name="price[][bidnest][price][premium]" value="{{$inventory->bp_premium}}" id="" placeholder="500"></div>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center inventroy-price">
                                                                    <div class="currancy">₹</div>
                                                                    <div class="form-input table-input"><input type="number" class="form-control" name="price[][market][price][economics]" value="{{$inventory->mp_economic}}" id="" placeholder="400"></div>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center inventroy-price">
                                                                    <div class="currancy">₹</div>
                                                                    <div class="form-input table-input"><input type="number" class="form-control" name="price[][market][price][premium]" value="{{$inventory->mp_premium}}" id="" placeholder="500"></div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
            @if(count($inventories) == 0)
                <div class="row hide-on-data">
                    <div class="col-md-12 text-center p-20">
                        <p class="font14"><i>. You didn't add any price on this Inventory.</i></p>
                    </div>
                </div>
            @endif

            <div class="d-flex  justify-content-between flex-row  p-20 border-top pt-0 pb-0">
                <div class="w-50">
                    <a class="white-text p-10 cancel" href="{{route('vendor.inventorymgt')}}">
                        <button class="btn theme-br theme-text w-30 white-bg">Cancel</button>
                    </a>
                </div>
                <div class="w-50 text-right">
                    <a class="white-text p-10">
                        <button class="btn theme-bg white-text w-30">Update</button>
                    </a>
                </div>
            </div>
        </form>
    </div>

@endsection
