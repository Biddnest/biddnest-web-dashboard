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
                                        <h3 class="f-18">
                                            Category
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
                                    <table class="table  p-0 theme-text mb-0 primary-table">
                                        <thead class="secondg-bg p-0">
                                            <tr>
                                                <th scope="col" >Image</th>
                                                <th scope="col">Category</th>
                                                <th scope="col"> Inventory Quantity Type</th>

                                                <th scope="col">Add Category</th>

                                                <th scope="col">Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody class="mtop-20 f-13">
                                            <tr class="tb-border cursor-pointer">                                                <td scope="row"> <img class="default-image"
                                                        src="{{ asset('static/images/default-image.svg')}}" alt=""></td>
                                                <td>Cupboards</td>
                                                <td>Bengaluru</td>


                                                <td class="">
                                                    <div class="status-badge #FEF6E0"> <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                                       Add</div>
                                                </td>

                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer">                                                <td scope="row"> <img class="default-image"
                                                        src="{{ asset('static/images/default-image.svg')}}" alt=""></td>
                                                <td>Bed</td>
                                                <td>Chennai</td>


                                                <td class="">
                                                    <div class="status-badge #FEF6E0"> <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                                       Add</div>
                                                </td>

                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer">                                                <td scope="row"> <img class="default-image"
                                                        src="{{ asset('static/images/default-image.svg')}}" alt=""></td>
                                                <td>Study Table</td>
                                                <td>Kochi</td>


                                                <td class="">
                                                    <div class="status-badge #FEF6E0"> <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                                       Add</div>
                                                </td>

                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer">                                                <td scope="row"> <img class="default-image"
                                                        src="{{ asset('static/images/default-image.svg')}}" alt=""></td>
                                                <td>Dining Table</td>
                                                <td>Kolkata</td>


                                                <td class="">
                                                    <div class="status-badge #FEF6E0"> <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                                       Add</div>
                                                </td>

                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                            </tr>
                                            <!-- <tr class="tb-border cursor-pointer">                                                <td scope="row"> <img class="default-image"
                                                        src="assets/images/default-image.svg" alt=""></td>
                                                <td>Sofa</td>

                                                <td class="">
                                                    <div class="status-badge #FEF6E0">
                                                        <i class="fa fa-plus p-1" aria-hidden="true"></i>
                                                       Add
                                                    </div>
                                                </td>

                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                            </tr> -->
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
</div>


@endsection
