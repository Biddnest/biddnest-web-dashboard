@extends('layouts.app')
@section('title') Zones @endsection
@section('content')

<!-- Main Content -->
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="zones">
                    <div class="d-flex  flex-row justify-content-between vertical-center">
                        <h3 class="page-head text-left p-4 f-20 theme-text">Zone Management</h3>
                        <div class="mr-20">
                            <a href="{{ route('create-zones')}}">
                                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1"
                                        aria-hidden="true"></i>CREATE ZONE</button>
                            </a>

                        </div>
                    </div>
                    <div class="d-flex  flex-row justify-content-between">
                        <div class="page-head text-left  pt-0 pb-0 p-2">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">Zone Management</li>
                                    <li class="breadcrumb-item"><a href="#"> Manage Zones</a></li>

                                </ol>
                            </nav>


                        </div>

                    </div>


                    <div class="vender-all-details flex-row">
                        <div class="simple-card min-width-30">
                            <p>TOTAL NO OF ZONES</p>
                            <h1>456</h1>
                        </div>
                        <div class="simple-card min-width-30">
                            <p>ACTIVE ZONES</p>
                            <h1>3,459</h1>
                        </div>
                        <div class="simple-card min-width-30">
                            <p>INACTIVE ZONES</p>
                            <h1>2,300</h1>
                        </div>


                    </div>
                    <!-- Dashboard cards -->


                    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
                        <div class="col-sm-12">
                            <div class="card  h-auto p-0 pt-10">
                                <div class="header-wrap" style="margin-top: 5px;">
                                    <div class="col-sm-8 p-3 ">
                                        <h3 class="f-18 title">Zone Management </h3>
                                
                                    </div>

                                    <div class="header-wrap p-0 col-sm-1">
                                        <a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i><img src="{{ asset('static/images/filter.svg')}}" alt="" srcset=""></i>

                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item border-top-bottom" href="#">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="total-no-orders">
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
                                                <th scope="col">Zone Name</th>
                                                <th scope="col">City</th>
                                                <th scope="col">District</th>
                                                <th scope="col">State</th>
                                                <th scope="col">Status</th>

                                                <th scope="col">Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody class="mtop-20 f-13">
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">Whitefield</td>
                                                <td>Bengaluru</td>
                                                <td>Bengaluru Urban</td>

                                                <td>Karnataka</td>
                                                <td>
                                                    <input type="checkbox" checked data-toggle="toggle" data-size="xs"
                                                        data-width="110" data-height="35" data-onstyle="outline-primary"
                                                        data-offstyle="outline-secondary" data-on="Active"
                                                        data-off="Inactive" id="">
                                                    <!-- <div class="d-flex justify-content-center">
                         <p class="font-inactive f-12 zone-status">Inactive</p>  
                                     <label class="switch-small ml-5" onchange="
                         $('.zone-status').toggleClass('font-inactive')">
                                      <input type="checkbox" id="switch">
                                        <span class="slider"></span>
                                     </label>
                                     <p class="ml-5 zone-status f-12">   Active</p>
                                     </div> -->

                                                </td>

                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">Whitefield</td>
                                                <td>Bengaluru</td>
                                                <td>Bengaluru Urban</td>

                                                <td>Karnataka</td>
                                                <td>
                                                    <!-- <div class="d-flex justify-content-center">
                         <p class="font-inactive f-12 zone-status">Inactive</p>  
                                     <label class="switch-small ml-5" onchange="
                         $('.zone-status').toggleClass('font-inactive')">
                                      <input type="checkbox" id="switch">
                                        <span class="slider"></span>
                                     </label>
                                     <p class="ml-5 zone-status f-12">   Active</p>
                                                             
                                                            </div>  -->
                                                    <input type="checkbox" checked data-toggle="toggle" data-size="xs"
                                                        data-width="110" data-height="35" data-onstyle="outline-primary"
                                                        data-offstyle="outline-secondary" data-on="Active"
                                                        data-off="Inactive" id="">
                                                </td>

                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">Whitefield</td>
                                                <td>Bengaluru</td>
                                                <td>Bengaluru Urban</td>

                                                <td>Karnataka</td>
                                                <td>
                                                    <!-- <div class="d-flex justify-content-center">
                         <p class="font-inactive f-12 zone-status">Inactive</p>  
                                     <label class="switch-small ml-5" onchange="
                         $('.zone-status').toggleClass('font-inactive')">
                                      <input type="checkbox" id="switch">
                                        <span class="slider"></span>
                                     </label>
                                     <p class="ml-5 zone-status f-12">   Active</p>
                                                           </div>   -->
                                                    <input type="checkbox" checked data-toggle="toggle" data-size="xs"
                                                        data-width="110" data-height="35" data-onstyle="outline-primary"
                                                        data-offstyle="outline-secondary" data-on="Active"
                                                        data-off="Inactive" id="">


                                                </td>

                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">Whitefield</td>
                                                <td>Bengaluru</td>
                                                <td>Bengaluru Urban</td>

                                                <td>Karnataka</td>
                                                <td>
                                                    <!-- <div class="d-flex justify-content-center">
                         <p class="font-inactive f-12 zone-status">Inactive</p>  
                                     <label class="switch-small ml-5" onchange="
                         $('.zone-status').toggleClass('font-inactive')">
                                      <input type="checkbox" id="switch">
                                        <span class="slider"></span>
                                     </label>
                                     <p class="ml-5 zone-status f-12">   Active</p>
                                                             
                                     </div> -->

                                                    <input type="checkbox" checked data-toggle="toggle" data-size="xs"
                                                        data-width="110" data-height="35" data-onstyle="outline-primary"
                                                        data-offstyle="outline-secondary" data-on="Active"
                                                        data-off="Inactive" id="">

                                                </td>

                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">Whitefield</td>
                                                <td>Bengaluru</td>
                                                <td>Bengaluru Urban</td>

                                                <td>Karnataka</td>
                                                <td>
                                                                 
                                                    <input type="checkbox" checked data-toggle="toggle" data-size="xs"
                                                        data-width="110" data-height="35" data-onstyle="outline-primary"
                                                        data-offstyle="outline-secondary" data-on="Active"
                                                        data-off="Inactive" id="">
                                                </td>

                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">Whitefield</td>
                                                <td>Bengaluru</td>
                                                <td>Bengaluru Urban</td>

                                                <td>Karnataka</td>
                                                <td>
                                                    <!-- <div class="d-flex justify-content-center">
                         <p class="font-inactive f-12 zone-status">Inactive</p>  
                                     <label class="switch-small ml-5" onchange="
                         $('.zone-status').toggleClass('font-inactive')">
                                      <input type="checkbox" id="switch">
                                        <span class="slider"></span>
                                     </label>
                                     <p class="ml-5 zone-status f-12">   Active</p>
                                                             
                                                </div>             -->
                                                    <input type="checkbox" checked data-toggle="toggle" data-size="xs"
                                                        data-width="110" data-height="35" data-onstyle="outline-primary"
                                                        data-offstyle="outline-secondary" data-on="Active"
                                                        data-off="Inactive" id="">
                                                </td>

                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                            </tr>

                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">Whitefield</td>
                                                <td>Bengaluru</td>
                                                <td>Bengaluru Urban</td>

                                                <td>Karnataka</td>
                                                <td>
                                                    <!-- <div class="d-flex justify-content-center">
                         <p class="font-inactive f-12 zone-status">Inactive</p>  
                                     <label class="switch-small ml-5" onchange="
                         $('.zone-status').toggleClass('font-inactive')">
                                      <input type="checkbox" id="switch">
                                        <span class="slider"></span>
                                     </label>
                                     <p class="ml-5 zone-status f-12">   Active</p>
                                                             </div> -->

                                                    <input type="checkbox" checked data-toggle="toggle" data-size="xs"
                                                        data-width="110" data-height="35" data-onstyle="outline-primary"
                                                        data-offstyle="outline-secondary" data-on="Active"
                                                        data-off="Inactive" id="">

                                                </td>

                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">Whitefield</td>
                                                <td>Bengaluru</td>
                                                <td>Bengaluru Urban</td>

                                                <td>Karnataka</td>
                                                <td>
                                                    <!-- <div class="d-flex justify-content-center">
                         <p class="font-inactive f-12 zone-status">Inactive</p>  
                                     <label class="switch-small ml-5" onchange="
                         $('.zone-status').toggleClass('font-inactive')">
                                      <input type="checkbox" id="switch">
                                        <span class="slider"></span>
                                     </label>
                                     <p class="ml-5 zone-status f-12">   Active</p>
                                                </div>              -->
                                                    <input type="checkbox" checked data-toggle="toggle" data-size="xs"
                                                        data-width="110" data-height="35" data-onstyle="outline-primary"
                                                        data-offstyle="outline-secondary" data-on="Active"
                                                        data-off="Inactive" id="">
                                                </td>

                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">Whitefield</td>
                                                <td>Bengaluru</td>
                                                <td>Bengaluru Urban</td>

                                                <td>Karnataka</td>
                                                <td>
                                                    <!-- <div class="d-flex justify-content-center">
                         <p class="font-inactive f-12 zone-status">Inactive</p>  
                                     <label class="switch-small ml-5" onchange="
                         $('.zone-status').toggleClass('font-inactive')">
                                      <input type="checkbox" id="switch">
                                        <span class="slider"></span>
                                     </label>
                                     <p class="ml-5 zone-status f-12">   Active</p>
                                                             </div> -->

                                                    <input type="checkbox" checked data-toggle="toggle" data-size="xs"
                                                        data-width="110" data-height="35" data-onstyle="outline-primary"
                                                        data-offstyle="outline-secondary" data-on="Active"
                                                        data-off="Inactive" id="">

                                                </td>

                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                            </tr>
                                        </tbody>

                                    </table>
                                    <div class="pagination">
                                        <ul>
                                            <li class="p-1">Page</li>
                                            <li class="digit">1</li>
                                            <li class="label">of</li>
                                            <li class="digit">20</li>
                                            <li class="button"><a href="#"><img src="{{ asset('static/images/Backward.svg')}}"></a>
                                            </li>
                                            <li class="button"><a href="#"><img src="{{ asset('static/images/forward.svg')}}"></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>




</div>

@endsection