@extends('layouts.app')
@section('title') Sliders And Banners @endsection
@section('content')

    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="slider">
        <div class="d-flex  flex-row justify-content-between">
            <h3 class="page-head theme-text text-left p-4 f-20">Sliders & Banners</h3>
            <div class="mr-20">
                <a href="{{route('create-slider')}}">
                    <button class="btn f-12 theme-bg white-text">
                        <i class="fa fa-plus p-1" aria-hidden="true"></i>Create Sliders & Banners
                    </button>
                </a>
            </div>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left p-2 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Sliders & Banners
                        </li>
                        <li class="breadcrumb-item">Manage Sliders</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
            <div class="col-lg-12">
                <div class="card h-auto p-0 pt-10">
                    <div class="header-wrap">
                        <div class="col-sm-8 p-3 ">
                            <h3 class="f-18 ml-2 mt-4">Sliders & Banners </h3>
                        </div>
                        <div class="header-wrap p-0 col-sm-1"  style="display: flex; justify-content: flex-end;  margin-right: -28px;">
                            {{--<a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                <i><img src="{{ asset('static/images/filter.svg')}}" alt="" srcset=""></i>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item border-top-bottom" href="#">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="total-no-orders">
                                        <label class="form-check-label" for="total-no-orders">
                                            Total no of orders
                                        </label>
                                    </div>
                                </a>
                                <a class="dropdown-item border-top-bottom" href="#">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="statu">
                                        <label class="form-check-label" for="status">
                                            Status
                                        </label>
                                    </div>
                                </a>
                                <a class="dropdown-item border-top-bottom" href="#">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="city">
                                        <label class="form-check-label" for="city">
                                            City
                                        </label>
                                    </div>
                                </a>
                            </div>--}}
                        </div>
                        <div class="card-head  left col-sm-3">
                            <div class="search">
                                <input type="text" class="searchTerm table-search" data-url="{{route('slider')}}" placeholder="Search...">
                                <button type="submit" class="searchButton">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="all-vender-details table-responsive-sm">
                        <table style="table-layout: fixed; word-wrap: break-word;" class="table text-center p-0 theme-text mb-0 primary-table">
                            <thead class="secondg-bg p-0">
                                <tr>
                                    <!-- <th scope="col" style="width: 4%;"></th> -->
                                    <th scope="col">Image</th>
                                    <th scope="col">Banner Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Platform</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col">Operations</th>
                                </tr>
                            </thead>
                            <tbody class="mtop-20 f-14">
                                @foreach($sliders as $slider)
                                    <tr class="tb-border cursor-pointer clickable-row slider_{{$slider->id}} sidebar-toggle" data-sidebar="{{ route('sidebar.slider',['id'=>$slider->id]) }}">
                                        <td scope="row" class="span3" style="width: 25%;">
                                            <div class="d-flex justify-content-center">
                                                <img class="p-2" onclick="$('.slick-container_{{$slider->id}}').slick('slickPrev')"
                                                                    src="{{asset('static/images/Backward.svg')}}">
                                                <div class="slick-container slick-container_{{$slider->id}}">
                                                    @foreach($slider->banners as $banner)
                                                        <img class="slick-image" src="{{$banner->image}}" alt="">
                                                    @endforeach
                                                </div>
                                                <img class="p-2" onclick="$('.slick-container_{{$slider->id}}').slick('slickNext')"
                                                                    src="{{asset('static/images/forward.svg')}}">
                                            </div>
                                        </td>
                                        <td class="span3" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                            {{$slider->name}}
                                        </td>
                                        <td onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');"
                                                            class="span2">
                                            @if($slider->status == 0)
                                                <div class="status-badge red-bg text-center">Inactive</div>
                                            @else
                                                <div class="status-badge green-bg text-center">Active</div>
                                            @endif
                                        </td>
                                        <td class="span1"
                                            onclick="/*$('.side-bar-pop-up').toggleClass('display-pop-up');*/">
                                            @if($slider->platform == 0)
                                                App
                                            @elseif($slider->platform == 1)
                                                Web
                                            @endif
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($slider->created_at)->format("d M Y") }}
                                        </td>
                                        <td>
                                            <a class="inline-icon-button" href="{{route('edit-slider', ['id'=>$slider->id])}}"><i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i></a>
                                            <a href="#" class="delete inline-icon-button" data-parent=".slider_{{$slider->id}}" data-confirm="Are you sure, you want delete this Slider permenently? You won't be able to undo this." data-url="{{route('sliders_delete',['id'=>$slider->id])}}"><i class="icon dripicons-trash p-1" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if(count($sliders)== 0)
                            <div class="row hide-on-data">
                                <div class="col-md-12 text-center p-20">
                                    <p class="font14"><i>. You don't have any Sliders here.</i></p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
