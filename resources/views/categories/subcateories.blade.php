@extends('layouts.app')
@section('title') Sub-Categories @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="subcategory">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head theme-text text-left p-4 f-20">Subcategories</h3>
        <div class="mr-20">
            <a href="{{route('create-subcateories')}}">
                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1" aria-hidden="true"></i> CREATE NEW
                </button>
            </a>
        </div>
    </div>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left  pt-0 pb-0 p-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Categories & Subcategories</li>
                    <li class="breadcrumb-item">Subcategory Management</li>
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
                        <h3 class="f-18 pl-3 ml-3">
                            Subcategory
                        </h3>
                    </header>
                    <div class="p-10 card-head left col-sm-3">
                        <div class="search">
                            <input type="text" class="searchTerm table-search" data-url="{{route('subcateories')}}" placeholder="Search...">
                            <button type="submit" class="searchButton">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="all-vender-details">
                    <table class="table text-center p-0 theme-text mb-0 f-14">
                        <thead class="secondg-bg p-0">
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col"> Name</th>
                                <th scope="col">Status</th>
{{--                                <th scope="col">Add Category</th>--}}
                                <th scope="col">Operation</th>
                            </tr>
                        </thead>
                        <tbody class="mtop-20 f-13">
                            @foreach($subcategories as $subcategory)
                                <tr class="tb-border cursor-pointer sub_{{$subcategory->id}} category-sidebar-toggle" data-sidebar="{{ route('sidebar.subcategory',['id'=>$subcategory->id]) }}">
                                    <td scope="row"> <img class="defau  lt-image" src="{{$subcategory->image}}" alt="" style="width: 100px;"></td>
                                    <td>{{$subcategory->name}}</td>
                                    <td>
                                       {{-- @switch($subcategory->status)
                                            @case(\App\Enums\CommonEnums::$YES)
                                                <span class="status-badge green-bg text-center">Enabled</span>
                                            @break

                                            @case(\App\Enums\CommonEnums::$NO)
                                                <span class="status-badge red-bg text-center"> Disabled</span>
                                            @break

                                            @default
                                                <span class="status-badge info-bg text-center">Unknown</span>
                                        @endswitch--}}
                                        <input type="checkbox" {{($subcategory->status == \App\Enums\CommonEnums::$YES) ? 'checked' : ''}}  class="change_status cursor-pointer" data-url="{{route('sub_service_status_update',['id'=>$subcategory->id])}}">
                                    </td>
                                    {{--<td class="">
                                        <a href="{{route('edit-subcateories', ['id'=>$subcategory->id])}}">
                                            <div class="status-badge #FEF6E0 text-center">
                                                <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                                Add
                                            </div>
                                        </a>
                                    </td>--}}
                                    <td>
                                        <a class="inline-icon-button mr-4" href="{{route('edit-subcateories', ['id'=>$subcategory->id])}}"><i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i></a>
                                        <a href="#" class="delete inline-icon-button" data-parent=".sub_{{$subcategory->id}}" data-confirm="Are you sure, you want delete this Sub-Category permenently? You won't be able to undo this." data-url="{{route('sub_service_delete', ['id'=>$subcategory->id])}}"><i class="icon dripicons-trash p-1" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    @if(count($subcategories)== 0)
                        <div class="row hide-on-data">
                            <div class="col-md-12 text-center p-20">
                                <p class="font14"><i>. You don't have any Sub-Categories here.</i></p>
                            </div>
                        </div>
                    @endif
                                    <div class="pagination">
                                        <ul>
                                            <li class="p-1">Page</li>
                                            <li class="digit">{{$subcategories->currentPage()}}</li>
                                            <li class="label">of</li>
                                            <li class="digit">{{$subcategories->lastPage()}}</li>
                                            @if(!$subcategories->onFirstPage())
                                                <li class="button"><a href="{{$subcategories->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                                </li>
                                            @endif
                                            @if($subcategories->currentPage() != $subcategories->lastPage())
                                                <li class="button"><a href="{{$subcategories->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
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
