@extends('vendor-panel.layouts.frame')
@section('title') Manage Inventory @endsection
@section('body')

    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="inventoryservices">
        <div class="d-flex  flex-row justify-content-between vertical-center">
            <h3 class="page-head text-left p-4 f-20 theme-text">Inventory Management</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('vendor.inventorymgt')}}">Inventory Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Inventory</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-lg-10">
                <div class="card h-auto p-0 pt-10">
                    <div class="card-head right text-left  p-10 pt-20 pb-0">
                        <h3 class="f-18 mb-0 theme-text pl-4 ml-4">
                            Selelect Category
                        </h3>
                    </div>
                    <div class="d-flex pa-20 row p-20 ml-3 justify-content-start ">
                        @foreach($services as $service)
                            <div class="simple-card category-card mt-3 mb-4">
                                <a href="{{route('vendor.inventory.add',['id'=>$service->id])}}">
                                    <img src="{{$service->image}}">
                                    <p class="p-1">{{ucwords($service->name)}}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
