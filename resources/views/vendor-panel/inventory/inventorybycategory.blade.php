@extends('vendor-panel.layouts.frame')
@section('title') Manage Inventory @endsection
@section('body')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="inventorycat">
        <div class="d-flex  flex-row justify-content-between vertical-center">
            <h3 class="page-head text-left p-4 f-20 theme-text">Inventory Management</h3>
            <div class="mr-20">
                <a href="{{route('vendor.inventory_services')}}">
                    <button class="btn theme-bg white-text"><i class="fa fa-plus p-1"
                                                               aria-hidden="true"></i>CREATE New Item</button>
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
                <div class="card-head right text-left  p-15 pt-20 pb-0 row justify-content-between d-felx">
                    <div class="col-lg-8">
                        <h3 class="f-18  theme-text">
                            Selelect Category
                        </h3>
                    </div>
                </div>
                <ul class="nav nav-tabs p-15 secondg-bg pt-0 pb-0" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link p-15" id="live-tab" href="{{route('vendor.inventorymgt')}}">All</a>
                    </li>
                    @foreach(\App\Enums\InventoryEnums::$CATEGORY as $category)
                        <li class="nav-item">
                            <a class="nav-link @if($type == $category) active @endif p-15" id="past-tab"  href="{{route('vendor.inventorycat', ['type'=>$category])}}">{{ucfirst(trans($category))}}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="live" role="tabpanel" aria-labelledby="live-tab">
                        <div class="d-flex  row p-20 justify-content-between">
                            @foreach($inventories as $inventory)
                                <div class="simple-card category-cards invsidebar col-sm-2" data-sidebar="{{route('vendor.inventory_sidebar', ['id'=>$inventory->id])}}">
                                <div class="card-title">{{ucfirst(trans($inventory->category))}}</div>
                                <div class="card-body">
                                    <img src="{{$inventory->icon}}">
                                </div>
                                <div class="card-footer d-felx  justify-content-between">
                                    <div class="item-name">{{ucfirst(trans($inventory->name))}}</div>
                                    <div class="actions justify-content-between">
                                        <i><img src="{{asset('static/vendor/images/Icon material-remove-red-eye.svg')}}" alt="" srcset=""></i>
                                        <i><img src="{{asset('static/vendor/images/Icon material-edit.svg')}}" alt="" srcset=""></i>
                                        <i><img src="{{asset('static/vendor/images/Icon metro-bin.svg')}}" alt="" srcset=""></i>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @if(count($inventories)== 0)
                                <div class="row hide-on-data" style="margin-left: 35%;">
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
