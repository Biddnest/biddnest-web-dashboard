@extends('layouts.app')
@section('title') Complaints @endsection
@section('content')


<div class="main-content grey-bg" data-barba="container" data-barba-namespace="complainnts">
                    <div class="d-flex  flex-row justify-content-between vertical-center">
                        <h3 class="page-head text-left p-4 f-20 theme-text">Complaints</h3>
                        <div class="mr-20">
                            <a href="{{route('create-complaint')}}">
                                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1"
                                        aria-hidden="true"></i>CREATE NEW</button>
                            </a>

                        </div>
                    </div>
                    <div class="d-flex  flex-row justify-content-between">
                        <div class="page-head text-left p-2 pt-0 pb-0">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">Complaint</li>
                                    <li class="breadcrumb-item"><a href="{{route('service-requests')}}">Services</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>


                    <div class="vender-all-details">
                        <div class="simple-card min-width-30">
                            <p> RESOLVED COMPLAINTS</p>
                            <h1>456</h1>
                        </div>
                        <div class="simple-card min-width-30">
                            <p>UNRESOLVED COMPLAINTS</p>
                            <h1>3,459</h1>
                        </div>
                        <div class="simple-card min-width-30">
                            <p>CREATE COMPLAINT</p>
                            <h1>2,300</h1>
                        </div>
                    </div>
                    <!-- Dashboard cards -->


                    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
                        <div class="col-sm-12">
                            <div class="card  h-auto p-0 pt-10">



<div class="row no-gutters" style="margin-top: 5px;">
    <div class="col-sm-8 p-3 ">
        <h3 class="f-18 pl-8 title">Complaints</h3 >

    </div>
    <div class="col-sm-1 -mr-4 pt-3 pl-8 ">
        <a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i><img class="" src="{{asset('static/images/filter.svg')}}" alt="" srcset=""></i>

    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item border-top-bottom" href="#">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="fdate">
                <label class="form-check-label" for="fdate">
                    Order ID
                </label>
            </div>
        </a>
        <a class="dropdown-item border-top-bottom" href="#">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value=""
                    id="todate">
                <label class="form-check-label" for="todate">
                    Zone
                </label>
            </div>
        </a>
        <a class="dropdown-item border-top-bottom" href="#">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value=""
                    id="vendorName">
                <label class="form-check-label" for="vendorName">
                    City
                </label>
            </div>
        </a>
        <a class="dropdown-item border-top-bottom" href="#">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value=""
                    id="Status">
                <label class="form-check-label" for="couponName">
                    Type
                </label>
            </div>
        </a>
        <a class="dropdown-item border-top-bottom" href="#">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value=""
                    id="Status">
                <label class="form-check-label" for="couponName">
                    Date
                </label>
            </div>
        </a>
        <a class="dropdown-item border-top-bottom" href="#">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value=""
                    id="Status">
                <label class="form-check-label" for="couponName">
                    status
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
                                    <h3 class="f-18">Complaints</h3>

                                    <div class="header-wrap p-0">
                                        <a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i><img src="./assets/images/filter.svg" alt="" srcset=""></i>

                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item border-top-bottom" href="#">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="fdate">
                                                    <label class="form-check-label" for="fdate">
                                                        Order ID
                                                    </label>
                                                </div>
                                            </a>
                                            <a class="dropdown-item border-top-bottom" href="#">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="todate">
                                                    <label class="form-check-label" for="todate">
                                                        Zone
                                                    </label>
                                                </div>
                                            </a>
                                            <a class="dropdown-item border-top-bottom" href="#">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="vendorName">
                                                    <label class="form-check-label" for="vendorName">
                                                        City
                                                    </label>
                                                </div>
                                            </a>
                                            <a class="dropdown-item border-top-bottom" href="#">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="Status">
                                                    <label class="form-check-label" for="couponName">
                                                        Type
                                                    </label>
                                                </div>
                                            </a>
                                            <a class="dropdown-item border-top-bottom" href="#">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="Status">
                                                    <label class="form-check-label" for="couponName">
                                                        Date
                                                    </label>
                                                </div>
                                            </a>
                                            <a class="dropdown-item border-top-bottom" href="#">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="Status">
                                                    <label class="form-check-label" for="couponName">
                                                        status
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
                                    <table class="table text-left p-0  mb-0">
                                        <thead class="secondg-bg  p-0">
                                            <tr>
                                                <th scope="col">Complaints ID </th>
                                                <th scope="col">Order ID</th>
                                                <th scope="col">Customer Name</th>
                                                <th scope="col">Complaint Type</th>
                                                <th scope="col">Created At</th>
                                                <th scope="col">Created By</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Status</th>



                                                <th scope="col">Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody class="mtop-20 f-13">
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">0123456789</td>
                                                <td>SKU123456</td>
                                                <td>priyanka</td>
                                                <td>package</td>
                                                <td>23 Dec</td>
                                                <td>Davidjerome</td>
                                                <td>Unpack</td>
                                                <td>
                                                    <div class="status-badge green-bg">Viewed</div>

                                                </td>

                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">0123456789</td>
                                                <td>SKU123456</td>
                                                <td>priyanka</td>
                                                <td>package</td>
                                                <td>23 Dec</td>
                                                <td>Davidjerome</td>
                                                <td>Unpack</td>
                                                <td>
                                                    <div class="status-badge green-bg">Viewed</div>

                                                </td>

                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">0123456789</td>
                                                <td>SKU123456</td>
                                                <td>priyanka</td>
                                                <td>package</td>
                                                <td>23 Dec</td>
                                                <td>Davidjerome</td>
                                                <td>Unpack</td>
                                                <td>
                                                    <div class="status-badge green-bg">Viewed</div>

                                                </td>

                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">0123456789</td>
                                                <td>SKU123456</td>
                                                <td>priyanka</td>
                                                <td>package</td>
                                                <td>23 Dec</td>
                                                <td>Davidjerome</td>
                                                <td>Unpack</td>
                                                <td>
                                                    <div class="status-badge green-bg">Viewed</div>

                                                </td>

                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">0123456789</td>
                                                <td>SKU123456</td>
                                                <td>priyanka</td>
                                                <td>package</td>
                                                <td>23 Dec</td>
                                                <td>Davidjerome</td>
                                                <td>Unpack</td>
                                                <td>
                                                    <div class="status-badge green-bg">Viewed</div>

                                                </td>

                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">0123456789</td>
                                                <td>SKU123456</td>
                                                <td>priyanka</td>
                                                <td>package</td>
                                                <td>23 Dec</td>
                                                <td>Davidjerome</td>
                                                <td>Unpack</td>
                                                <td>
                                                    <div class="status-badge green-bg">Viewed</div>

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