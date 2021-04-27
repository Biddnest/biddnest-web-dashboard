@extends('layouts.app')
@section('title') General Pages Settings @endsection
@section('content')

    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="pages">
        <div class="d-flex  flex-row justify-content-between">
            <h3 class="page-head theme-text text-left p-4 f-20">General Pages Settings</h3>
            <div class="mr-20">
                <a href="{{route('pages_create')}}">
                    <button class="btn theme-bg white-text"><i class="fa fa-plus p-1" aria-hidden="true"></i> ADD NEW PAGE
                    </button>
                </a>
            </div>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">General Settings</li>
                        <li class="breadcrumb-item"><a href="#">Pages Settings</a></li>
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
                            <h3 class="f-18 title">
                                Pages
                            </h3>
                        </header>
                    </div>
                    <div class="all-vender-details">
                        <table class="table text-center p-0 theme-text mb-0 primary-table">
                            <thead class="secondg-bg p-0">
                            <tr>
                                <th scope="col thead">Title</th>
                                <th scope="col thead">Slug</th>
                                <th scope="col thead">Operations</th>
                            </tr>
                            </thead>
                            <tbody class="mtop-20 f-13">
                            @foreach($pages as $page)
                                <tr class="tb-border cursor-pointer page_{{$page->id}}">
                                    <td>{{$page->title}}</td>
                                    <td>{{$page->slug}}</td>
                                    <td>
                                        <a href="{{route('pages_edit', ['id'=>$page->id])}}"><i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i></a>
                                        <a href="#" class="delete" data-parent=".page_{{$page->id}}" data-confirm="Are you sure, you want delete this Page permenently? You won't be able to undo this." data-url="{{route('page_delete', ['id'=>$page->id])}}"><i class="icon dripicons-trash p-1" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        <div class="pagination">
                            <ul>
                                <li class="p-1">Page</li>
                                <li class="digit">{{$pages->currentPage()}}</li>
                                <li class="label" style="font-size: 14px;">of</li>
                                <li class="digit">{{$pages->lastPage()}}</li>
                                @if(!$pages->onFirstPage())
                                    <li class="button"><a href="{{$pages->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                    </li>
                                @endif
                                @if($pages->currentPage() != $pages->lastPage())
                                    <li class="button"><a href="{{$pages->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
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
