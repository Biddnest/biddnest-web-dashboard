
@extends('layouts.app')
@section('title') Review @endsection
@section('content')


<div class="main-content grey-bg" data-barba="container" data-barba-namespace="review">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head theme-text text-left p-4 f-20">Review & Ratings</h3>
        {{--<div class="mr-20">
            <a href="{{route('create-review')}}">
                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1" aria-hidden="true"></i> CREATE REVIEW
                </button>
            </a>
        </div>--}}
    </div>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left p-2 pt-0 pb-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('review')}}">Review & Ratings</a></li>
                    <li class="breadcrumb-item">Manage Reviews</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="vender-all-details">
        <div class="simple-card w-38">
            <p class="f-13">TOTAL NO OF REVIEWS</p>
            <h1 class="f-34">{{$total_review}}</h1>
        </div>
        <div class="simple-card w-38">
            <p class="f-13">AVERAGE REVIEWS</p>
            <h1 class="f-34">{{$total_review}}</h1>
        </div>
        <div class="simple-card w-38">
            <p class="f-13">ACTIVE REVIEWS</p>
            <h1 class="f-34">{{$active_review}}</h1>
        </div>
    </div>
    <!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-lg-12 pr-0 pl-0">
            <div class="card  h-auto p-0 pt-10">
                <div class="header-wrap">
                    <div class="col-sm-8 p-3 ">
                        <h3 class="f-18 ml-2 mt-3 ">Review & Ratings</h3 >
                    </div>
                    <div class="header-wrap p-0 col-sm-1"  style="display: flex; justify-content: flex-end;  margin-right: -18px;" >
                        <a href="#" class="margin-r-20 filter-icon" aria-haspopup="true"  aria-expanded="false"  data-toggle="collapse" data-target="#filter-menu">
                            <i><img class="" src="{{asset('static/images/filter.svg')}}" alt="" srcset=""></i>
                        </a>
                    </div>
                    <div class="card-head left col-sm-3">
                        <div class="search">
                            <input type="text" class="searchTerm table-search" data-url="{{route('review')}}" placeholder="Search by desc...">
                            <button type="submit" class="searchButton">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="all-vender-details">
                    <div class="collapse" id="filter-menu">
                        <a href="#" class="btn theme-bg white-text clear-filter" id="clear">Clear</a>
                        <div class="row f-14">
                            <div class="col">
                                <label style="font-weight:500 !important;">Organization</label>
                                <select id="" class="form-control searchvendor single selectfilter" data-action="id" name="organization_id">
                                </select>
                            </div>
                            <div class="col">
                                <label style="font-weight:500 !important;">Ratings</label>
                                <select class="form-control br-5 selectfilter" name="status" data-action="ratings">
                                    <option value="">--Select--</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <table class="table text-left p-0 theme-text mb-0 f-14">
                        <thead class="secondg-bg  p-0">
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Organisation Name</th>
                                <th scope="col">Reviewed On</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ratings</th>
                                <th scope="col">Operations</th>
                            </tr>
                        </thead>
                        <tbody class="mtop-20 f-12">
                            @foreach($reviews as $review)
                                <tr class="tb-border cursor-pointer">
                                    <td scope="row">@if($review->booking){{$review->booking->public_booking_id}} @else - @endif</td>
                                    <td>
                                        <a href="#0" data-sidebar="{{ route('sidebar.customer',['id'=>$review->user->id]) }}" class="sidebar-toggle-link cursor-pointer underline">{{ucfirst(trans($review->user->fname))}} {{ucfirst(trans($review->user->lname))}}</a>
                                    </td>
                                    <td>@if($review->booking && $review->booking->organization)
                                            <a href="#0" data-sidebar="{{ route('sidebar.customer',['id'=> $review->booking->organization->id]) }}" class="sidebar-toggle-link cursor-pointer underline">{{ucfirst(trans($review->booking->organization->org_name))}} {{$review->booking->organization->org_type}}</a>
                                        @else - @endif</td>
                                    <td>{{\Carbon\Carbon::parse($review->created_at)->format("d M Y")}}</td>
                                    <td class="">
                                        <div class="status-badge light-bg text-center">
                                            @if(\App\Enums\ReviewEnums::$STATUS['active'] == $review->status)
                                                Active
                                            @else
                                                Draft
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @php $ratings = 0; @endphp
                                        @foreach(json_decode($review->ratings, true) as $rating)
                                            @php $ratings += is_numeric($rating['rating']) ? (integer)$rating['rating'] : 0; @endphp
                                        @endforeach
                                        @php $ratings = number_format($ratings/count(json_decode($review->ratings, true)), 2); @endphp
                                        @for($star=$ratings; $star > 0; $star--)
                                            @if($star < 1)
                                                <i class="fa fa-star-half-o checked bg-yellow" aria-hidden="true"></i>
                                            @else
                                                <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                            @endif
                                        @endfor
                                        @php $blank_star = floor(5 - $ratings); @endphp

                                        @for($star_o=$blank_star; $star_o >= 1; $star_o--)
                                            <i class="fa fa-star-o bg-yellow" aria-hidden="true"></i>
                                        @endfor
                                    </td>
                                    <td class="no-toggle sidebar-toggle_booking" style="text-align: center !important;" data-sidebar="{{ route('sidebar.reviews',['id'=>$review->id]) }}">
                                        <a href="#0" class="inline-icon-button ml-4" style="display: flex;"><i class="icon fa fa-eye pb-2" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if(count($reviews)== 0)
                        <div class="row hide-on-data">
                            <div class="col-md-12 text-center p-20">
                                <p class="font14"><i>. You don't have any Reviews here.</i></p>
                            </div>
                        </div>
                    @endif
                    <div class="pagination">
                        <ul>
                            <li class="p-1">Page</li>
                            <li class="digit">{{$reviews->currentPage()}}</li>
                            <li class="label">of</li>
                            <li class="digit">{{$reviews->lastPage()}}</li>
                            @if(!$reviews->onFirstPage())
                                <li class="button"><a href="{{$reviews->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                </li>
                            @endif
                            @if($reviews->currentPage() != $reviews->lastPage())
                                <li class="button"><a href="{{$reviews->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
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
