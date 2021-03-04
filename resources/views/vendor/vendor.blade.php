@extends('layouts.app')
@section('title') Vendor Management @endsection
@section('content')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="vendor">
                            <div class="d-flex  flex-row justify-content-between vertical-center">
                                <h3 class="page-head text-left p-4 f-20 theme-text">Vendor Management</h3>
                                <div class="mr-20">
                                   <a href="{{ route('create-vendors')}}">
                                    <button class="btn theme-bg white-text"><i class="fa fa-plus p-1"
                                        aria-hidden="true"></i>ONBOARD VENDER</button>
                                   </a>
                                </div>
                            </div>
                            <div class="d-flex  flex-row justify-content-between">
                                <div class="page-head text-left  pt-0 pb-0 p-2">
                                  <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active" aria-current="page">Vendor Management</li>
                                      <li class="breadcrumb-item"><a href="#"> Manage Vendor</a></li>
                                      
                                    </ol>
                                  </nav>
                                
                                
                                </div>
                          
                            </div>

                            <div class="vender-all-details">
                                <div class="simple-card">
                                    <p>TOTAL VENDORS</p>
                                    <h1>3,459</h1>
                                </div>
                                <div class="simple-card">
                                    <p>UNVERIFIED VENDORS</p>
                                    <h1>865</h1>
                                </div>
                                <div class="simple-card">
                                    <p> VERIFIED VENDORS</p>
                                    <h1>2,594</h1>
                                </div>
                                <div class="simple-card">
                                    <p> ECONOMIC VENDORS</p>
                                    <h1>2,594</h1>
                                </div>
                                <div class="simple-card">
                                    <p> PREMIUM VENDORS</p>
                                    <h1>2,248</h1>
                                </div>
                            </div>
                            <!-- Dashboard cards -->


                            <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
                                <div class="col-lg-12">
                                    <div class="card  h-auto p-0  pt-10">
                                        <div class="header-wrap">
                                            <h3 class="f-18 pl-2">All Vendors</h3>
                                            <a href="#">
                                                <i><img src="{{ asset('static/images/filter.svg')}}" alt="" srcset=""></i>
                                            </a>
                                        </div>
                                        <div class="all-vender-details">
                                            <table class="table text-center p-0 theme-text mb-0 primary-table">
                                                <thead class="secondg-bg  p-0">
                                                    <tr>
                                                        <th scope="col" style="width: 132px;">Vendor Name</th>
                                                        <th scope="col">Org Name</th>
                                                        <th scope="col">City</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Operations</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="mtop-20">
                                                    <tr class="tb-border cursor-pointer"
                                                        onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">Mohan Kumar</td>
                                                        <td>Wayne Pvt Ltd</td>
                                                        <td>Bengaluru</td>
                                                        <td class="">
                                                            <div class="status-badge light-bg light-bg">In Process</div>
                                                        </td>
                                                        <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                                class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer"
                                                        onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">Mohan Kumar</td>
                                                        <td>Wayne Pvt Ltd</td>
                                                        <td>Bengaluru</td>
                                                        <td class="">
                                                            <div class="status-badge light-bg light-bg">In Process</div>
                                                        </td>
                                                        <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                                class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer"
                                                        onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">Mohan Kumar</td>
                                                        <td>Wayne Pvt Ltd</td>
                                                        <td>Bengaluru</td>
                                                        <td class="">
                                                            <div class="status-badge light-bg light-bg">In Process</div>
                                                        </td>
                                                        <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                                class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer"
                                                        onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">Mohan Kumar</td>
                                                        <td>Wayne Pvt Ltd</td>
                                                        <td>Bengaluru</td>
                                                        <td class="">
                                                            <div class="status-badge light-bg light-bg">In Process</div>
                                                        </td>
                                                        <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                                class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer"
                                                        onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">Mohan Kumar</td>
                                                        <td>Wayne Pvt Ltd</td>
                                                        <td>Bengaluru</td>
                                                        <td class="">
                                                            <div class="status-badge light-bg light-bg">In Process</div>
                                                        </td>
                                                        <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                                class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer"
                                                        onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">Mohan Kumar</td>
                                                        <td>Wayne Pvt Ltd</td>
                                                        <td>Bengaluru</td>
                                                        <td class="">
                                                            <div class="status-badge light-bg light-bg">In Process</div>
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
                                                    <li class="button"><a href="#"><img src="{{ asset('static/images/Backward.svg')}}"></a></li>
                                                    <li class="button"><a href="#"><img src="{{ asset('static/images/forward.svg')}}"></a></li>
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