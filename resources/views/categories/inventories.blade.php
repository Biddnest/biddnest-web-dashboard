@extends('layouts.app')
@section('title') Inventory @endsection
@section('content')


<div class="main-content grey-bg" data-barba="container" data-barba-namespace="inventories">
                    <div class="d-flex  flex-row justify-content-between">
                        <h3 class="page-head theme-text text-left p-4 f-20">Categories & Subcategories</h3>
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
                                <li class="breadcrumb-item active" aria-current="page">Categories & Subcategories
                                </li>
                              <li class="breadcrumb-item"><a href="#">Inventory List</a></li>
                              
                            </ol>
                          </nav>
                        
                        
                        </div>
                  
                    </div>
                    <!-- Dashboard cards -->
                    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
                        <div class="col-sm-12" style="padding-right: 0px;">
                            <div class="card h-auto p-0 pt-10">
                                <div class="header-wrap" style="padding: 5px 20px;">
                                    <h3 class="f-18">Inventory List</h3>
                                    <div class="p-10 card-head left col-sm-3">
                                        <!-- <div class="">
                                            <form class="form-inline  input-group search-bar">

                                                <input class="form-control    icon-bg " type="search" placeholder="Search..." aria-label="Search">


                                            </form>
                                        </div> -->
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
                                        <thead class="secondg-bg p-0">
                                            <tr>
                                                <th scope="col">Image</th>
                                                <th scope="col">Item Name</th>
                                                <th scope="col">Material</th>
                                                <th scope="col">Parent Subcategory</th>
                                                <th scope="col">Ratings</th>
                                                <th scope="col">Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody class="mtop-20 f-13">
                                            <tr class="tb-border cursor-pointer"
                                                >
                                                <td scope="row"> <img class="default-image"
                                                        src="{{asset('static/images/default-image.svg')}}" alt=""></td>
                                                <td>Cupboards</td>
                                                <td>Polycarbonate</td>
                                                <td class="">
                                                    <div class="status-badge">1 BHK</div>
                                                </td>
                                                <td>
                                                    <!-- <div class="d-flex justify-content-center">
                                                        <p class="font-inactive f-12 zone-status">Inactive</p>
                                                        <label class="switch-small ml-5"
                                                            onchange="$('.zone-status').toggleClass('font-inactive')">
                                                            <input type="checkbox" id="switch">
                                                            <span class="slider"></span>
                                                        </label>
                                                        <p class="ml-5 zone-status f-12"> Active</p>
                                                    </div> -->
                                                    <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-width="110"data-height="35" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-on="Active" data-off="Inactive" id="switch">
                                                </td>
                                                <td> <i onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');" class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                               >
                                                <td scope="row"> <img class="default-image"
                                                        src="{{asset('static/images/default-image.svg')}}" alt=""></td>
                                                <td>Bed</td>
                                                <td>Wood</td>
                                                <td class="">
                                                    <div class="status-badge">1 BHK</div>
                                                </td>
                                                <td>
                                                    <!-- <div class="d-flex justify-content-center">
                                                        <p class="font-inactive f-12 zone-status">Inactive</p>
                                                        <label class="switch-small ml-5"
                                                            onchange="$('.zone-status').toggleClass('font-inactive')">
                                                            <input type="checkbox" id="switch">
                                                            <span class="slider"></span>
                                                        </label>
                                                        <p class="ml-5 zone-status f-12"> Active</p>
                                                    </div> -->
                                                    <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-width="110"data-height="35" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-on="Active" data-off="Inactive" id="switch">
                                                </td>
                                                <td> <i onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');" class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                              >
                                                <td scope="row"> <img class="default-image"
                                                        src="{{asset('static/images/default-image.svg')}}" alt=""></td>
                                                <td>Study Table</td>
                                                <td>Polycarbonate</td>
                                                <td class="">
                                                    <div class="status-badge">1 BHK</div>
                                                </td>
                                                <td>
                                                    <!-- <div class="d-flex justify-content-center">
                                                        <p class="font-inactive f-12 zone-status">Inactive</p>
                                                        <label class="switch-small ml-5"
                                                            onchange="$('.zone-status').toggleClass('font-inactive')">
                                                            <input type="checkbox" id="switch">
                                                            <span class="slider"></span>
                                                        </label>
                                                        <p class="ml-5 zone-status f-12"> Active</p>
                                                    </div> -->
                                                    <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-width="110"data-height="35" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-on="Active" data-off="Inactive" id="">
                                                </td>
                                                <td> <i onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');" class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                               >
                                                <td scope="row"> <img class="default-image"
                                                        src="{{asset('static/images/default-image.svg')}}" alt=""></td>
                                                <td>Dining Table</td>
                                                <td>Acrylic</td>
                                                <td class="">
                                                    <div class="status-badge">1 BHK</div>
                                                </td>
                                                <td>
                                                    <!-- <div class="d-flex justify-content-center">
                                                        <p class="font-inactive f-12 zone-status">Inactive</p>
                                                        <label class="switch-small ml-5"
                                                            onchange="$('.zone-status').toggleClass('font-inactive')">
                                                            <input type="checkbox" id="switch">
                                                            <span class="slider"></span>
                                                        </label>
                                                        <p class="ml-5 zone-status f-12"> Active</p>
                                                    </div> -->
                                                    <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-width="110"data-height="35" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-on="Active" data-off="Inactive" id="">
                                                </td>
                                                <td> <i onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');" class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                           >
                                                <td scope="row"> <img class="default-image"
                                                        src="{{asset('static/images/default-image.svg')}}" alt=""></td>
                                                <td>Sofa</td>
                                                <td>Leather</td>
                                                <td class="">
                                                    <div class="status-badge">1 BHK</div>
                                                </td>
                                                <td>
                                                    <!-- <div class="d-flex justify-content-center">
                                                        <p class="font-inactive f-12 zone-status">Inactive</p>
                                                        <label class="switch-small ml-5"
                                                            onchange="$('.zone-status').toggleClass('font-inactive')">
                                                            <input type="checkbox" id="switch">
                                                            <span class="slider"></span>
                                                        </label>
                                                        <p class="ml-5 zone-status f-12"> Active</p>
                                                    </div> -->
                                                    <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-width="110"data-height="35" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-on="Active" data-off="Inactive" id="">
                                                </td>
                                                <td> <i onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');" class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
</div>

@endsection

