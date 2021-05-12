@extends('layouts.app')
@section('title') Categories @endsection
@section('content')




    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="category">
        <div class="d-flex  flex-row justify-content-between">

            <h3 class="page-head text-left p-4 f-20">Categories</h3>
            <div class="mr-20">
                <a href="{{ route('create-categories')}}">
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
                        <li class="breadcrumb-item active" aria-current="page">Categories & Subcategories
                        </li>
                        <li class="breadcrumb-item"><a href="#">Category Management</a></li>

                    </ol>
                </nav>


            </div>

        </div>
        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
            <div class="col-sm-12" style="padding-right: 0px;">
                <div class="card h-auto p-0 pt-10">
                    <div class="header-wrap" style="padding: 5px 20px;">
                        <header>
                            <h3 class="f-18 ml-4 pl-2" >
                                Category
                            </h3>
                        </header>

                        <div class="p-10 card-head left col-sm-3">
                            <div class="search">
                                <input type="text" class="searchTerm table-search" data-url="{{route('categories')}}" placeholder="Search...">
                                <button type="submit" class="searchButton">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                    <div class="all-vender-details">
                        <table class="table  p-0 theme-text mb-0 f-14">
                            <thead class="secondg-bg p-0">
                            <tr>
                                <th scope="col" >Image</th>
                                <th scope="col">Category</th>
                                <th scope="col"> Inventory Quantity Type</th>
                                <th scope="col">Status</th>
{{--                                <th scope="col">Add Category</th>--}}
                                <th scope="col">Operations</th>
                            </tr>
                            </thead>
                            <tbody class="mtop-20 f-13">
                            @foreach($categories as $category)
                                <tr class="tb-border cat_{{$category->id}}">
                                    <td scope="row"> <img class="default-image"
                                                          src="{{$category->image}}" alt=""></td>
                                    <td>{{ucfirst(trans($category->name))}}</td>
                                    <td>
                                        @switch($category->inventory_quantity_type)
                                            @case($inventory_quantity_type['fixed'])
                                            Fixed
                                            @break

                                            @case($inventory_quantity_type['range'])
                                            Range
                                            @break

                                            @default
                                            Unknown
                                        @endswitch
                                    </td>

                                    <td>
                                        {{--@switch($category->status)
                                            @case(\App\Enums\CommonEnums::$YES)
                                            <span class="status-badge green-bg">Enabled</span>
                                            @break

                                            @case(\App\Enums\CommonEnums::$NO)
                                           <span class="status-badge red-bg"> Disabled</span>
                                            @break

                                            @default
                                            <span class="status-badge info-bg">Unknown</span>
                                        @endswitch--}}
                                        <input type="checkbox" {{($category->status == \App\Enums\CommonEnums::$YES) ? 'checked' : ''}}  class="change_status cursor-pointer" data-url="{{route('status_update',['id'=>$category->id])}}">
                                        {{-- <input type="checkbox" {{($category->status == \App\Enums\CommonEnums::$YES) ? 'checked' : ''}} data-toggle="toggle" data-size="xs" data-width="110" data-height="35" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-on="{{($category->status == \App\Enums\CommonEnums::$YES) ? "Active" : "Inactive"}}" data-off="{{($category->status == \App\Enums\CommonEnums::$NO) ? "Active" : "Inactive"}}" id="category_{{$category->id}}" class="change_status" data-url="{{route('status_update',['id'=>$category->id])}}">--}}
                                    </td>
                                    {{--<td class="cursor-pointer">
                                        <div class="btn btn-sm status-badge p-2 text-center green-bg #FEF6E0"> <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                            Add</div>
                                    </td>--}}

                                    <td class="cursor-pointer"> <a class ="inline-icon-button mr-4" href="{{route('edit-categories', ['id'=>$category->id])}}"><i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i></a>
                                        <a href="#" class="delete inline-icon-button" data-parent=".cat_{{$category->id}}" data-confirm="Are you sure, you want delete this Category permenently? You won't be able to undo this." data-url="{{route('service_delete',['id'=>$category->id])}}"><i class="icon dripicons-trash p-1" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(count($categories)== 0)
                            <div class="row hide-on-data">
                                <div class="col-md-12 text-center p-20">
                                    <p class="font14"><i>. You don't have any Category here.</i></p>
                                </div>
                            </div>
                        @endif
                        <div class="pagination">
                            <ul>
                                <li class="p-1">Page</li>
                                <li class="digit">{{$categories->currentPage()}}</li>
                                <li class="label">of</li>
                                <li class="digit">{{$categories->lastPage()}}</li>
                                @if(!$categories->onFirstPage())
                                    <li class="button"><a href="{{$categories->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                    </li>
                                @endif
                                @if($categories->currentPage() != $categories->lastPage())
                                    <li class="button"><a href="{{$categories->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
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
