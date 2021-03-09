@extends('layouts.app')
@section('title') Users And Roles @endsection
@section('content')

 <!-- Main Content -->

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="usersandroles">
                    <div class="d-flex  flex-row justify-content-between vertical-center">
                        <h3 class="page-head text-left p-4 f-20 theme-text">Users & Roles </h3>
                        <div class="mr-20">
                            <a href="{{route('create-users')}}">
                                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1"
                                        aria-hidden="true"></i>ADD NEW USER</button>
                            </a>

                        </div>
                    </div>


                    <!-- Dashboard cards -->


                    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
                        <div class="col-sm-12">
                            <div class="card  h-auto p-0 pt-10">


                                <div class="row no-gutters">
                                    <div class="col-sm-8 p-3 ">
                                        <h3 class="f-18 pl-2 title">User Roles</h3>
                                
                                    </div>
                                    <div class="col-sm-1 -mr-4 pt-3 pl-8 ">
                                        <a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i><img class="" src="{{asset('static/images/filter.svg')}}" alt="" srcset=""></i>
                                
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item border-top-bottom" href="#">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="date">
                                                <label class="form-check-label" for="date">
                                                    Date
                                                </label>
                                            </div>
                                        </a>
                                        <a class="dropdown-item border-top-bottom" href="#">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="zone">
                                                <label class="form-check-label" for="zone">
                                                    Zone
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
                                        <a class="dropdown-item border-top-bottom" href="#">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="couponName">
                                                <label class="form-check-label" for="couponName">
                                                    Coupon Name
                                                </label>
                                            </div>
                                        </a>
                                        <a class="dropdown-item border-top-bottom" href="#">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="couponType">
                                                <label class="form-check-label" for="couponType">
                                                    Coupon Type
                                                </label>
                                            </div>
                                        </a>
                                        <a class="dropdown-item border-top-bottom" href="#">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="status">
                                                <label class="form-check-label" for="status">
                                                    Status
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

                                    <div class="header-wrap p-0">
                                        <a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i><img src="./assets/images/filter.svg" alt="" srcset=""></i>

                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item border-top-bottom" href="#">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="date">
                                                    <label class="form-check-label" for="date">
                                                        Date
                                                    </label>
                                                </div>
                                            </a>
                                            <a class="dropdown-item border-top-bottom" href="#">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="zone">
                                                    <label class="form-check-label" for="zone">
                                                        Zone
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
                                            <a class="dropdown-item border-top-bottom" href="#">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="couponName">
                                                    <label class="form-check-label" for="couponName">
                                                        Coupon Name
                                                    </label>
                                                </div>
                                            </a>
                                            <a class="dropdown-item border-top-bottom" href="#">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="couponType">
                                                    <label class="form-check-label" for="couponType">
                                                        Coupon Type
                                                    </label>
                                                </div>
                                            </a>
                                            <a class="dropdown-item border-top-bottom" href="#">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="status">
                                                    <label class="form-check-label" for="status">
                                                        Status
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
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Zone</th>
                                                <th scope="col">User Role</th>
                                                <th scope="col">Operations</th>


                                            </tr>
                                        </thead>
                                        <tbody class="mtop-20 f-13">
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">David Jerome</td>
                                                <td>davidjerome@gmail.com</td>
                                                <td>Bengaluru urban</td>


                                                <td class="">
                                                    <div class="status-badge">Super Admin</div>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">Ann hency</td>
                                                <td>davidjerome@gmail.com</td>
                                                <td>Kolkata</td>


                                                <td class="">
                                                    <div class="status-badge"> Admin</div>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">Jay raj</td>
                                                <td>davidjerome@gmail.com</td>
                                                <td>Mumbai</td>


                                                <td class="">
                                                    <div class="status-badge">Virtual Assistant</div>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">David Jerome</td>
                                                <td>davidjerome@gmail.com</td>
                                                <td>Bengaluru urban</td>


                                                <td class="">
                                                    <div class="status-badge">Super Admin</div>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">Shankar</td>
                                                <td>davidjerome@gmail.com</td>
                                                <td>Bengaluru urban</td>


                                                <td class="">
                                                    <div class="status-badge">Admin</div>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">Mukud</td>
                                                <td>davidjerome@gmail.com</td>
                                                <td>Chennai</td>


                                                <td class="">
                                                    <div class="status-badge">Marketing Consultant</div>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>

                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">Dhanus rao</td>
                                                <td>davidjerome@gmail.com</td>
                                                <td>Bengaluru urban</td>


                                                <td class="">
                                                    <div class="status-badge">Super Admin</div>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">arvind rao</td>
                                                <td>davidjerome@gmail.com</td>
                                                <td>Bengaluru urban</td>


                                                <td class="">
                                                    <div class="status-badge">Super Admin</div>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">David Jerome</td>
                                                <td>davidjerome@gmail.com</td>
                                                <td>Bengaluru urban</td>


                                                <td class="">
                                                    <div class="status-badge">Super Admin</div>
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

                            <!-- <div class="text-right p-20" style="float: right;">
                                        <nav aria-label="Page navigation example border-none">
                                            <ul class="pagination ">
                                                <li class="page-item active-page"><a
                                                        class="page-link border-none  p-1 mtop-5 " href="#">1</a></li>
                                                <li class="page-item theme-text"><a
                                                        class="page-link border-none bg-transparent p-1 mtop-5"
                                                        aria-disabled="">Of</a></li>
                                                <li class="page-item "><a
                                                        class="page-link border-none bg-transparent p-1 mtop-5 "
                                                        href="#">20</a></li>
                                                <li class="page-item"><a
                                                        class="page-link border-none bg-transparent p-1 " href="#"><img
                                                            src="assets/images/Backward.svg"></a></li>
                                                <li class="page-item"><a
                                                        class="page-link border-none bg-transparent p-1 " href="#"><img
                                                            src="assets/images/forward.svg"></a></li>
                                            </ul>
                                        </nav>
                                    </div> -->
                        </div>

                    </div>




</div>

@endsection