@extends('layouts.app')
@section('title') Sub-Categories @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="subcategory">
                    <div class="d-flex  flex-row justify-content-between">
                        <h3 class="page-head theme-text text-left p-4 f-20">Subcategories</h3>
                        <div class="mr-20">
                            <a href="{{route('create-subcateories')}}">
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
                              <li class="breadcrumb-item"><a href="#">Subcategory Management</a></li>

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
                                        <h3 class="f-18">
                                            Subcategory
                                        </h3>
                                    </header>

                                    <div class="p-10 card-head left col-sm-3">
                                        <div class="search">
                                            <input type="text" class="searchTerm" placeholder="Search...">
                                            <button type="submit" class="searchButton">
                                              <i class="fa fa-search"></i>
                                           </button>
                                         </div>

                                    </div>
                                </div>
                                <div class="all-vender-details">
                                    <table class="table text-center p-0 theme-text mb-0 primary-table">
                                        <thead class="secondg-bg p-0">
                                            <tr>
                                                <th scope="col">Image</th>
                                                <th scope="col"> Name</th>

                                                <th scope="col">Status</th>

                                                <th scope="col">Operation</th>
                                            </tr>
                                        </thead>
                                        <tbody class="mtop-20 f-13">
                                        @foreach($subcategories as $subcategory)
                                            <tr class="tb-border cursor-pointer sub_{{$subcategory->id}}">
                                                <td scope="row" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');"> <img class="defau  lt-image" src="{{$subcategory->image}}" alt=""></td>
                                                <td onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">{{$subcategory->name}}</td>

                                                <td class="" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                    @switch($subcategory->status)
                                                        @case(\App\Enums\CommonEnums::$YES)
                                                        <span class="status-badge green-bg">Enabled</span>
                                                        @break

                                                        @case(\App\Enums\CommonEnums::$NO)
                                                        <span class="status-badge red-bg"> Disabled</span>
                                                        @break

                                                        @default
                                                        <span class="status-badge info-bg">Unknown</span>
                                                    @endswitch
                                                </td>

                                                <td>
                                                    <a href="{{route('edit-subcateories', ['id'=>$subcategory->id])}}"><i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i></a>
                                                    <a href="#" class="delete" data-parent=".sub_{{$subcategory->id}}" data-confirm="Are you sure, you want delete this Sub-Category permenently? You won't be able to undo this." data-url="{{route('sub_service_delete',['id'=>$subcategory->id])}}"><i class="icon dripicons-trash p-1" aria-hidden="true"></i>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
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
