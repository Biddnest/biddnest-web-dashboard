@extends('layouts.app')
@section('title') Inventory @endsection
@section('content')


<div class="main-content grey-bg" data-barba="container" data-barba-namespace="inventories">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head theme-text text-left p-4 f-20">Inventories</h3>
        <div class="mr-20">
            <a href="{{route('create-inventories')}}">
                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1"
                                        aria-hidden="true"></i> CREATE NEW
                </button>
            </a>
        </div>
    </div>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left  pt-0 pb-0 p-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('categories')}}">Categories & Subcategories
                                    </a></li>
                    <li class="breadcrumb-item pl-2"><a href="{{route('inventories')}}" style="cursor: default;">Inventory List</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-sm-12" style="padding-right: 0px;">
            <div class="card h-auto p-0 pt-10">
                <div class="header-wrap" style="padding: 5px 20px;">
                    <h3 class="f-18 pl-4">Inventory List</h3>
                    <div class="p-10 card-head left col-sm-3">
                        <div class="search">
                            <input type="text" class="searchTerm table-search" data-url="{{route('inventories')}}" placeholder="Search...">
                            <button type="submit" class="searchButton">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="all-vender-details">
                    <table class="table text-left p-0 theme-text mb-0 f-14">
                        <thead class="secondg-bg p-0">
                        <tr>
                                                <th scope="col">Image</th>
                                                <th scope="col">Item Name</th>
                                                <th scope="col">Material</th>
                                                <th scope="col">Size</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody class="mtop-20 f-13">
                                        @foreach($inventories as $inventory)
                                            <tr class="tb-border cursor-pointer inv_{{$inventory->id}}"
                                                >
                                                <td scope="row"> <img class="default-image"
                                                        src="{{$inventory->image}}" alt=""></td>
                                                <td>{{$inventory->name}}</td>
                                                <td>
                                                    @foreach(json_decode($inventory->material, true) as $material)
                                                        {{$material}},
                                                    @endforeach
                                                </td>
                                                <td class="">
                                                    @foreach(json_decode($inventory->size, true) as $size)
                                                        {{$size}},
                                                    @endforeach
                                                </td>
                                                <td>
                                                   {{-- @switch($inventory->status)
                                                        @case(\App\Enums\CommonEnums::$YES)
                                                        <span class="status-badge green-bg">Enabled</span>
                                                        @break

                                                        @case(\App\Enums\CommonEnums::$NO)
                                                        <span class="status-badge red-bg"> Disabled</span>
                                                        @break

                                                        @default
                                                        <span class="status-badge info-bg">Unknown</span>
                                                    @endswitch--}}
                                                    <input type="checkbox" {{($inventory->status == \App\Enums\CommonEnums::$YES) ? 'checked' : ''}}  class="change_status cursor-pointer changeclick" data-url="{{route('inventory_status_update',['id'=>$inventory->id])}}">
                                                </td>
                                                <td>
                                                    <a class="inline-icon-button mr-4" href="{{route('edit-services', ['id'=>$inventory->id])}}"><i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i></a>
                                                    <a href="#" class="delete inline-icon-button" data-parent=".inv_{{$inventory->id}}" data-confirm="Are you sure, you want delete this Inventory permenently? You won't be able to undo this." data-url="{{route('inventories_delete',['id'=>$inventory->id])}}"><i class="icon dripicons-trash p-1" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                    @if(count($inventories)== 0)
                                        <div class="row hide-on-data">
                                            <div class="col-md-12 text-center p-20">
                                                <p class="font14"><i>. You don't have any Inventories here.</i></p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="pagination">
                                        <ul>
                                            <li class="p-1">Page</li>
                                            <li class="digit">{{$inventories->currentPage()}}</li>
                                            <li class="label">of</li>
                                            <li class="digit">{{$inventories->lastPage()}}</li>
                                            @if(!$inventories->onFirstPage())
                                                <li class="button"><a href="{{$inventories->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                                </li>
                                            @endif
                                            @if($inventories->currentPage() != $inventories->lastPage())
                                                <li class="button"><a href="{{$inventories->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
</div>

@endsection

