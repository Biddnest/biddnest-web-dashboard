@extends('layouts.app')
@section('title') Review @endsection
@section('content')


<div class="main-content grey-bg" data-barba="container" data-barba-namespace="review">
                    <div class="d-flex  flex-row justify-content-between">
                        <h3 class="page-head theme-text text-left p-4 f-20">Review & Ratings</h3>
                        <div class="mr-20">
                            <a href="{{route('create-review')}}">
                                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1"
                                        aria-hidden="true"></i> CREATE REVIEW
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
                            <h1 class="f-34">456</h1>
                        </div>
                        <div class="simple-card w-38">
                            <p class="f-13">DRAFT REVIEWS</p>
                            <h1 class="f-34">3,459</h1>
                        </div>
                        <div class="simple-card w-38">
                            <p class="f-13">ACTIVE REVIEWS</p>
                            <h1 class="f-34">2,300</h1>
                        </div>


                    </div>
                    <!-- Dashboard cards -->
                    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
                        <div class="col-lg-12">
                            <div class="card  h-auto p-0 pt-10">


                                <div class="row no-gutters">
                                    <div class="col-sm-8 p-3 ">
                                        <h3 class="f-18 pl-8 title">Review</h3 >
                                
                                    </div>
                                    <div class="col-sm-1 -mr-4 pt-3 pl-8 ">
                                        <a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i><img class="" src="{{asset('static/images/filter.svg')}}" alt="" srcset=""></i>
                                
                                    </a>
                                    <div class="dropdown-menu menu-lg">
                                        <a class="dropdown-item border-top-bottom" href="#">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="total-no-orders">
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










                                <!-- <div class="header-wrap">
                                    <h3 class="f-18 pl-1">Review & Ratings </h3>

                                    <div class="header-wrap p-0">
                                        <a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i><img src="./assets/images/filter.svg" alt="" srcset=""></i>

                                        </a>
                                        <div class="dropdown-menu menu-lg">
                                            <a class="dropdown-item border-top-bottom" href="#">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="total-no-orders">
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
                                        <form class="form-inline  input-group search-bar">

                                            <input class="form-control    icon-bg  br-5" type="search"
                                                placeholder="Search..." aria-label="Search">


                                        </form>
                                    </div>


                                </div> -->
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
                                            <tr class="tb-border cursor-pointer"
                                               >
                                                <td scope="row">SKU1234546</td>
                                                <td>Dhanush Kumar</td>
                                                <td>Wayne Pvt Ltd</td>
                                                <td>The best service given</td>
                                                <td class="">
                                                    <div class="status-badge light-bg">Active</div>
                                                </td>
                                                <td>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o bg-yellow" aria-hidden="true"></i>
                                                </td>
                                                <td> <a href="{{route('create-review')}}"><i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i> <i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                               >
                                                <td scope="row">SKU1234546</td>
                                                <td>Dhanush Kumar</td>
                                                <td>Wayne Pvt Ltd</td>
                                                <td>Good one and easy</td>

                                                <td class="">
                                                    <div class="status-badge p-color">Draft</div>
                                                </td>
                                                <td>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o bg-yellow" aria-hidden="true"></i>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                               >
                                                <td scope="row">SKU1234546</td>
                                                <td>Dhanush Kumar</td>
                                                <td>Wayne Pvt Ltd</td>
                                                <td>Not Bad</td>

                                                <td class="">
                                                    <div class="status-badge light-bg">Active</div>
                                                </td>
                                                <td>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o bg-yellow" aria-hidden="true"></i>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                               >
                                                <td scope="row">SKU1234546</td>
                                                <td>Dhanush Kumar</td>
                                                <td>Wayne Pvt Ltd</td>
                                                <td>Awesome Service</td>

                                                <td class="">
                                                    <div class="status-badge p-color">Draft</div>
                                                </td>
                                                <td>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o bg-yellow" aria-hidden="true"></i>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                               >
                                                <td scope="row">SKU1234546</td>
                                                <td>Dhanush Kumar</td>
                                                <td>Wayne Pvt Ltd</td>
                                                <td>Good One</td>

                                                <td class="">
                                                    <div class="status-badge light-bg">Active</div>
                                                </td>
                                                <td>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o bg-yellow" aria-hidden="true"></i>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                               >
                                                <td scope="row">SKU1234546</td>
                                                <td>Dhanush Kumar</td>
                                                <td>Wayne Pvt Ltd</td>
                                                <td>Good One</td>

                                                <td class="">
                                                    <div class="status-badge light-bg">Active</div>
                                                </td>
                                                <td>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o bg-yellow" aria-hidden="true"></i>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                               >
                                                <td scope="row">SKU1234546</td>
                                                <td>Dhanush Kumar</td>
                                                <td>Wayne Pvt Ltd</td>
                                                <td>Good One</td>

                                                <td class="">
                                                    <div class="status-badge light-bg">Active</div>
                                                </td>
                                                <td>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o bg-yellow" aria-hidden="true"></i>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                               >
                                                <td scope="row">SKU1234546</td>
                                                <td>Dhanush Kumar</td>
                                                <td>Wayne Pvt Ltd</td>
                                                <td>Good services</td>

                                                <td class="">
                                                    <div class="status-badge p-color">Draft</div>
                                                </td>
                                                <td>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o bg-yellow" aria-hidden="true"></i>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                               >
                                                <td scope="row">SKU1234546</td>
                                                <td>Dhanush Kumar</td>
                                                <td>Wayne Pvt Ltd</td>
                                                <td>Good services</td>

                                                <td class="">
                                                    <div class="status-badge light-bg">Active</div>
                                                </td>
                                                <td>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star-o bg-yellow" aria-hidden="true"></i>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                    <div class="pagination">
                                        <ul>
                                            <li class="p-1">Page</li>
                                            <li class="digit">1</li>
                                            <li class="label">of</li>
                                            <li class="digit">20</li>
                                            <li class="button"><a href="#"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                            </li>
                                            <li class="button"><a href="#"><img src="{{asset('static/images/forward.svg')}}"></a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
</div>
@endsection