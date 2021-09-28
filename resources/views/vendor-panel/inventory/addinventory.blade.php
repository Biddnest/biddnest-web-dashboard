@extends('vendor-panel.layouts.frame')
@section('title') Manage Inventory @endsection
@section('body')

    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="addinventory">
        <div class="d-flex  flex-row justify-content-between vertical-center">
            <h3 class="page-head text-left p-4 f-20 theme-text">Inventory Management</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('vendor.inventorymgt')}}">Inventory Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Item</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-lg-12">
                <div class="card h-auto p-0 pt-20 pb-0">
                    <form class="form-new-order pt-4 mt-3 input-text-blue" action="{{route('api.addPrice')}}" method= "POST" data-next="redirect" data-redirect-type="hard" data-url="{{route('vendor.inventorymgt')}}" data-alert="tiny" id="myForm" data-parsley-validate>
                    <input type="hidden" value="{{$service_id}}" name="service_type">
                        <div class="header-wrap toal-header pb-0 " >
                            <div class="col-lg-6 toggle-input">
                                <div class="form-input">
                                    <label class="">Item Name</label>
                                    <select  id="" class="form-control js-example-basic-single inventory-item-select" data-url="{{route('vendor.inventory.add',['id'=>$service_id])}}" name="inventory_id">
                                        <option >--Select--</option>
                                        @foreach($inventories as $inventory)
                                            <option value="{{$inventory->id}}" @if($inventory_items && ($inventory_items->id == $inventory->id)) selected @endif>{{ucwords($inventory->name)}}</option>
                                        @endforeach
                                    </select>
                                    <span class="error-message">Please select valid Item</span>
                                </div>
                            </div>
                        </div>
                        <div class="header-wraps p-0" >
                            <table class="table  text-left p-0 theme-text mb-0 primary-table p-15">
                                <thead class="secondg-bg p-0">
                                <tr>
                                    <th scope="col" style="width: 132px; padding:14px">Item</th>
                                    <th scope="col">Size</th>
                                    <th scope="col" class="text-center" style="padding:14px">Material</th>
                                    <th scope="col" class="text-center" style="padding:14px">BD Economic Price</th>
                                    <th scope="col" class="text-center" style="padding:14px">BD Premium Price</th>
                                    <th scope="col" class="text-center" style="padding:14px">MP Economic Price</th>
                                    <th scope="col" class="text-center" style="padding:14px">MP Premium Price</th>
                                </tr>
                                </thead>
                                <tbody class="mtop-20 inventory-snip">
                                @if($inventory_items)
                                    @foreach(json_decode($inventory_items->size, true) as $key=>$size)
                                        @foreach(json_decode($inventory_items->material, true) as $key1=>$material)
                                            <tr class="tb-border">
                                                <td scope="row">
                                                    <span>{{$inventory_items->name}}</span>
                                                </td>
                                                <td>
                                                    <span>{{$size}}</span>
                                                    <input type="hidden" value="{{$size}}" name="price[][size]">
                                                </td>
                                                <td class="text-center">
                                                    <span>{{$material}}</span>
                                                    <input type="hidden" value="{{$material}}" name="price[][material]">
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center inventroy-price">
                                                        <div class="currancy">₹</div>
                                                        <div class="form-input table-input"><input type="number" class="form-control" name="price[][bidnest][price][economics]" id="" placeholder="400"></div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center inventroy-price">
                                                        <div class="currancy">₹</div>
                                                        <div class="form-input table-input"><input type="number" class="form-control" name="price[][bidnest][price][premium]" id="" placeholder="500"></div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center inventroy-price">
                                                        <div class="currancy">₹</div>
                                                        <div class="form-input table-input"><input type="number" class="form-control" name="price[][market][price][economics]" id="" placeholder="400"></div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center inventroy-price">
                                                        <div class="currancy">₹</div>
                                                        <div class="form-input table-input"><input type="number" class="form-control" name="price[][market][price][premium]" id="" placeholder="500"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex  justify-content-between flex-row  p-20 border-top pt-0 pb-0">
                            <div class="w-50">
                                <a class="white-text p-10 cancel" href="#">
                                    <button class="btn theme-br theme-text w-30 white-bg">Cancel</button>
                                </a>
                            </div>
                            <div class="w-50 text-right">
                                <a class="white-text p-10">
                                    <button class="btn theme-bg white-text w-30">Save</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>




    </div>

@endsection
