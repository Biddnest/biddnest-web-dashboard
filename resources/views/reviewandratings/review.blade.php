
@extends('layouts.app')
@section('title') Review @endsection
@section('content')


<div class="main-content grey-bg" data-barba="container" data-barba-namespace="review">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head theme-text text-left p-4 f-20">Review & Ratings</h3>
        <div class="mr-20">
            <a href="{{route('create-review')}}">
                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1" aria-hidden="true"></i> CREATE REVIEW
                </button>
            </a>
        </div>
    </div>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left p-2 pt-0 pb-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Review & Ratings</li>
                    <li class="breadcrumb-item"><a href="{{route('review')}}">Manage Reviews</a></li>
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
            <p class="f-13">DRAFT REVIEWS</p>
            <h1 class="f-34">{{$inactive_review}}</h1>
        </div>
        <div class="simple-card w-38">
            <p class="f-13">ACTIVE REVIEWS</p>
            <h1 class="f-34">{{$active_review}}</h1>
        </div>
    </div>
    <!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-lg-12">
            <div class="card  h-auto p-0 pt-10">
                <div class="row no-gutters" style="margin-top: 5px;">
                    <div class="col-sm-8 p-3 ">
                        <h3 class="f-18 pl-8 title">Review</h3 >
                    </div>
                    <div class="col-sm-1 -mr-4 pt-3 pl-8 ">
                        <a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i><img class="" src="{{asset('static/images/filter.svg')}}" alt="" srcset=""></i>
                        </a>
                        <div class="dropdown-menu menu-lg">
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="total-no-orders">
                                    <label class="form-check-label" for="total-no-orders">
                                        Ratings
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="statu">
                                    <label class="form-check-label" for="status">
                                        Organisation name
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="city">
                                    <label class="form-check-label" for="city">
                                        Customer name
                                    </label>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="card-head  pt-2  left col-sm-3">
                        <div class="search">
                            <input type="text" class="searchTerm" placeholder="Search...">
                            <button type="submit" class="searchButton">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="all-vender-details">
                    <table class="table text-left p-0 theme-text mb-0 primary-table">
                        <thead class="secondg-bg  p-0">
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Organisation Name</th>
                                <th scope="col">Review Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ratings</th>
                                <th scope="col">Operations</th>
                            </tr>
                        </thead>
                        <tbody class="mtop-20 f-12">
                            @foreach($reviews as $review)
                                <tr class="tb-border cursor-pointer">
                                    <td scope="row">{{$review->booking->public_booking_id}}</td>
                                    <td>{{$review->user->fname}} {{$review->user->lname}}</td>
                                    <td>{{$review->booking->organization->org_name}} {{$review->booking->organization->org_type}}</td>
                                    <td>{{$review->desc}}</td>
                                    <td class="">
                                        <div class="status-badge light-bg">
                                            @if(\App\Enums\ReviewEnums::$STATUS['active'] == $review->status)
                                                Active
                                            @else
                                                Dreft
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @php $ratings = 0; @endphp
                                        @foreach(json_decode($review->ratings, true) as $rating)
                                            @php $ratings += $rating['rating']; @endphp
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
                                    <td>
                                        <a href="{{route('create-review')}}">
                                            <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i>
                                            <i class="icon dripicons-trash p-1" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
