@extends('vendor-panel.layouts.frame')
@section('title') Manage Inventory @endsection
@section('body')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="inventorymgt">
        <div class="d-flex  flex-row justify-content-between vertical-center">
            <h3 class="page-head text-left p-4 f-20 theme-text">Inventory Management</h3>
            <div class="mr-20">
                <a href="{{route('vendor.inventory_services')}}">
                    <button class="btn theme-bg white-text"><i class="fa fa-plus p-1"
                                                               aria-hidden="true"></i>Add Item Price</button>
                </a>
            </div>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('vendor.inventorymgt')}}">Inventory Management</a></li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
        <div class="col-lg-12">
            <div class="card h-auto p-0 pt-20">
                <div class="card-head right text-left  p-15 pt-20 pb-0 row">
                    <div class="col-lg-8">
                        <h3 class="f-18 mb-4  mt-1 ml-4  theme-text">
                            Select Category
                        </h3>
                    </div>
                    <div class="card-head  pt-2  left col-lg-4" style="padding: 8px 10px; flex: 0 0 30% !important;">
                        <div class="search">
                            <input type="text" class="searchTerm table-search" data-url="{{route('vendor.inventorymgt')}}" placeholder="Search...">
                            <button type="submit" class="searchButton">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs p-15 f-16 secondg-bg pt-0 pb-0" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active p-15" id="live-tab" data-toggle="tab" href="#live" role="tab" aria-controls="home" aria-selected="true">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  p-15" id="driver-tab" href="{{route('vendor.inventorycat', ['type'=>"electronics"])}}" >Electronics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-15" id="past-tab"  href="{{route('vendor.inventorycat', ['type'=>"furniture"])}}">Furniture</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  p-15" id="driver-tab" href="{{route('vendor.inventorycat', ['type'=>"applience"])}}">Appliances</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  p-15" id="driver-tab" href="{{route('vendor.inventorycat', ['type'=>"electricle"])}}" >Electrical</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  p-15" id="driver-tab" href="{{route('vendor.inventorycat', ['type'=>"automobile"])}}">Automobile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  p-15" id="driver-tab" href="{{route('vendor.inventorycat', ['type'=>"others"])}}">Others</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="live" role="tabpanel" aria-labelledby="live-tab">
                        <div class="d-flex  row p-20 justify-content-start" style="margin-left: -2px; margin-right: -82px;">
                            @foreach($inventories as $inventory)
                                <div class="simple-card category-cards col-sm-2">
                                    <div class="card-title invsidebar" data-sidebar="{{route('vendor.inventory_sidebar', ['id'=>$inventory->id])}}" >{{ucfirst(trans($inventory->category))}}</div>
                                    <div class="card-body invsidebar" data-sidebar="{{route('vendor.inventory_sidebar', ['id'=>$inventory->id])}}" style="background-color: #FFFFFF !important;">
                                        <img src="{{$inventory->icon}}" style="width: 50%;">
                                    </div>
                                    <div class="card-footer d-felx  justify-content-between">
                                        <div class="item-name invsidebar" data-sidebar="{{route('vendor.inventory_sidebar', ['id'=>$inventory->id])}}" style="font-size: 12px;">{{$inventory->name}}</div>
                                        <div class="actions justify-content-between">
{{--                                            <i><img src="{{asset('static/vendor/images/Icon material-remove-red-eye.svg')}}" alt="" srcset=""></i>--}}
                                            <a href="{{route('vendor.inventory.edit',['id'=>$inventory->id])}}"><i><img src="{{asset('static/vendor/images/Icon material-edit.svg')}}" alt="" srcset=""></i></a>
                                            <a href="#" class="delete inline-icon-button" data-confirm="Are you sure, you want delete this Inventory's Prices permenently? You won't be able to undo this." data-url="{{route('api.deleteInventoryPrices', ["id"=>$inventory->id])}}">
                                                <i><img src="{{asset('static/vendor/images/Icon metro-bin.svg')}}" alt="" srcset=""></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if(count($inventories)== 0)
                                <div class="row hide-on-data"  style="margin-left: 35%;">
                                    <div class="col-md-12 text-center p-20">
                                        <p class="font14"><i>. There is no any item in inventory here.</i></p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>




    </div>

@endsection
