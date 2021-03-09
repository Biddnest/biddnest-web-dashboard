@extends('layouts.app')
@section('title') Coupons And Offers @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="cupons">
     <div class="d-flex  flex-row justify-content-between vertical-center">
                                <h3 class="page-head text-left p-4 f-20 theme-text">Coupons & offers </h3>
                                <div class="mr-20">
                                    <a href="{{route('create-coupons')}}">
                                        <button class="btn theme-bg white-text"><i class="fa fa-plus p-1"
                                            aria-hidden="true"></i>CREATE NEW</button>
                                    </a>
                                 
                                </div>
    </div>
    <div class="d-flex  flex-row justify-content-between">
                                <div class="page-head text-left  pt-0 pb-0 p-2">
                                  <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active" aria-current="page">Coupons & offers</li>
                                      <li class="breadcrumb-item"><a href="#"> Manage Coupons</a></li>
                                      
                                    </ol>
                                  </nav>
                                
                                
                                </div>
                          
    </div>

    <div class="vender-all-details">
                                <div class="simple-card min-width-30">
                                    <p>TOTAL NO OF COUPONS</p>
                                    <h1>456</h1>
                                </div>
                                <div class="simple-card min-width-30">
                                    <p>ACTIVE COUPONS</p>
                                    <h1>3,459</h1>
                                </div>
                                <div class="simple-card min-width-30">
                                    <p>INACTIVE COUPONS</p>
                                    <h1>2,300</h1>
                                </div>
                              
                              
    </div>
                            <!-- Dashboard cards -->


    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-sm-12">
            <div class="card  h-auto p-0 pt-10">
                <div class="header-wrap">
                    <div class="col-sm-8 p-3 ">
                                        <h3 class="f-18">Coupons & Offers </h3>
                                
                    </div>
                                            
                    <div class="header-wrap p-0 col-sm-1" >
                        <a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i><img src="{{asset('static/images/filter.svg')}}" alt="" srcset="" ></i>
                          
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="date">
                                    <label class="form-check-label" for="date">
                                                                                           Date
                                    </label>
                            </div></a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="zone">
                                    <label class="form-check-label" for="zone">
                                                                Zone
                                    </label>
                            </div></a>
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
                                    <input class="form-check-input" type="checkbox" value="" id="couponName">
                                    <label class="form-check-label" for="couponName">
                                                                            Coupon Name
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="couponType">
                                    <label class="form-check-label" for="couponType">
                                                                        Coupon Type
                                    </label>
                                </div>
                            </a>
                            <a class="dropdown-item border-top-bottom" href="#">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="status">
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
                    <div class="all-vender-details">
                                            <table class="table text-center p-0 theme-text mb-0 primary-table">
                                                <thead class="secondg-bg  p-0">
                                                    <tr>
                                                        <th scope="col">Coupon  Name</th>
                                                        <th scope="col">Coupon Type</th>
                                                        <th scope="col">Value</th>
                                                        <th scope="col">Coupon Usage</th>
                                                        <th scope="col">Coupon Description</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Operations</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="mtop-20 f-13">
                                                    <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">MOVESAFE</td>
                                                        <td>Fixed</td>
                                                        <td>₹ 2,300</td>
                                                        <td>
                                                           <div class="d-flex justify-content-center vertical-center">
                                                              10
                                                            <div class="progress">
                                                                <div class="progress-bar bg-progress" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                              </div>
                                                           </div> 
                                                            
                                                            </td>
                                                        <td>Get ₹2,300 off</td>
                                                        <td class=""><div class="status-badge ">Active</div>
                                                        </td><td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">EASYPACK</td>
                                                        <td>Percentage</td>
                                                        <td>30%</td>
                                                        <td> <div class="d-flex justify-content-center vertical-center">
                                                            15
                                                          <div class="progress  ">
                                                              <div class="progress-bar bg-progress" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                         </div> </td>
                                                        <td>Get ₹2,300 off</td>
                                                        <td class=""><div class="status-badge red-bg">Inactive </div>
                                                        </td><td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">SALEISHERE</td>
                                                        <td>Fixed</td>
                                                        <td>₹ 2,300</td>
                                                        <td> <div class="d-flex justify-content-center vertical-center">
                                                            20
                                                          <div class="progress  ">
                                                              <div class="progress-bar bg-progress" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                         </div> </td>
                                                        <td>Get ₹2,300 off</td>
                                                        <td class=""><div class="status-badge ">Active</div>
                                                        </td><td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">30SALE</td>
                                                        <td>Percentage</td>
                                                        <td>30%</td>
                                                        <td> <div class="d-flex justify-content-center vertical-center">
                                                            15
                                                          <div class="progress  ">
                                                              <div class="progress-bar bg-progress" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                         </div> </td>
                                                        <td>Get ₹2,300 off</td>
                                                        <td class=""><div class="status-badge ">Active</div>
                                                        </td><td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">MOVE12345</td>
                                                        <td>Fixed</td>
                                                        <td>₹ 2,300</td>
                                                        <td> <div class="d-flex justify-content-center vertical-center">
                                                            15
                                                          <div class="progress  ">
                                                              <div class="progress-bar bg-progress" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                         </div> </td>
                                                        <td>Get ₹2,300 off</td>
                                                        <td class=""><div class="status-badge green-bg">Completed</div>
                                                        </td><td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">MOVE12345</td>
                                                        <td>Fixed</td>
                                                        <td>₹ 2,300</td>
                                                        <td> <div class="d-flex justify-content-center vertical-center">
                                                            15
                                                          <div class="progress  ">
                                                              <div class="progress-bar bg-progress" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                         </div> </td>
                                                        <td>Get ₹2,300 off</td>
                                                        <td class=""><div class="status-badge red-bg">Inactive</div>
                                                        </td><td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                                    </tr>
                                                 
                                                    <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">MOVE12345</td>
                                                        <td>Percentage</td>
                                                        <td>30%</td>
                                                        <td> <div class="d-flex justify-content-center vertical-center">
                                                            15
                                                          <div class="progress  ">
                                                              <div class="progress-bar bg-progress" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                         </div> </td>
                                                        <td>Get ₹2,300 off</td>
                                                        <td class=""><div class="status-badge ">Active</div>
                                                        </td><td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">MOVE12345</td>
                                                        <td>Fixed</td>
                                                        <td>₹ 2,300</td>
                                                        <td> <div class="d-flex justify-content-center vertical-center">
                                                            15
                                                          <div class="progress  ">
                                                              <div class="progress-bar bg-progress" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                         </div> </td>
                                                        <td>Get ₹2,300 off</td>
                                                        <td class=""><div class="status-badge green-bg">Completed</div>
                                                        </td><td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">MOVE12345</td>
                                                        <td>Fixed</td>
                                                        <td>₹ 2,300</td>
                                                        <td> <div class="d-flex justify-content-center vertical-center">
                                                            15
                                                          <div class="progress  ">
                                                              <div class="progress-bar bg-progress" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                         </div> </td>
                                                        <td>Get ₹2,300 off</td>
                                                        <td class=""><div class="status-badge red-bg">Inactive</div>
                                                        </td><td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                            <div class="pagination">
                                                <ul>
                                                    <li class="p-1">Page</li>
                                                    <li class="digit">1</li>
                                                    <li class="label">of</li>
                                                    <li class="digit">20</li>
                                                    <li class="button"><a href="#"><img src="{{asset('static/images/Backward.svg')}}"></a></li>
                                                    <li class="button"><a href="#"><img src="{{asset('static/images/forward.svg')}}"></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>




</div>



<div class="main-content grey-bg" data-barba="container" data-barba-namespace="cupons">
                    <div class="d-flex  flex-row justify-content-between vertical-center">
                        <h3 class="page-head text-left p-4 f-20 theme-text">Coupons & Offers </h3>
                        <div class="mr-20">
                            <a href="c{{route('create-coupons')}}">
                                <button class="btn theme-bg white-text"><i class="fa fa-plus p-1"
                                        aria-hidden="true"></i>CREATE NEW</button>
                            </a>

                        </div>
                    </div>
                    <div class="d-flex  flex-row justify-content-between">
                        <div class="page-head text-left  pt-0 pb-0 p-2">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">Coupons & Offers</li>
                                    <li class="breadcrumb-item"><a href="#"> Manage Coupons</a></li>

                                </ol>
                            </nav>


                        </div>

                    </div>

                    <div class="vender-all-details">
                        <div class="simple-card min-width-30">
                            <p>TOTAL NO OF COUPONS</p>
                            <h1>456</h1>
                        </div>
                        <div class="simple-card min-width-30">
                            <p>ACTIVE COUPONS</p>
                            <h1>3,459</h1>
                        </div>
                        <div class="simple-card min-width-30">
                            <p>INACTIVE COUPONS</p>
                            <h1>2,300</h1>
                        </div>


                    </div>
                    <!-- Dashboard cards -->


                    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
                        <div class="col-sm-12">
                            <div class="card  h-auto p-0 pt-10">
                                <div class="row no-gutters">
                                    <div class="col-sm-8 p-3 ">
                                        <h3 class="f-18">Coupons & Offers </h3>
                                
                                    </div>
                                    <div class="col-sm-1 -mr-4 pt-3 pl-8 ">
                                        <a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i><img class="" src="{{asset('static/mages/filter.svg')}}" alt="" srcset=""></i>
                                
                                    </a>
                                    <div class="dropdown-menu f-14">
                                        <a class="dropdown-item border-top-bottom " href="#">
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
                                <div class="all-vender-details">
                                    <table class="table text-left p-0 theme-text mb-0 primary-table">
                                        <thead class="secondg-bg  p-0">
                                            <tr>
                                                <th scope="col">Coupon Name</th>
                                                <th scope="col">Coupon Type</th>
                                                <th scope="col">Value</th>
                                                <th scope="col">Coupon Usage</th>
                                                <th scope="col">Coupon Description</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody class="mtop-20 f-13">
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">MOVESAFE</td>
                                                <td>Fixed</td>
                                                <td>₹ 2,300</td>
                                                <td>
                                                    <div class="d-flex justify-content-center vertical-center">
                                                        10
                                                        <div class="progress">
                                                            <div class="progress-bar y-color " role="progressbar"
                                                                style="width: 30%" aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td>Get ₹2,300 off</td>
                                                <td class="">
                                                    <div class="status-badge ">Active</div>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">EASYPACK</td>
                                                <td>Percentage</td>
                                                <td>30%</td>
                                                <td>
                                                    <div class="d-flex justify-content-center vertical-center">
                                                        15
                                                        <div class="progress  ">
                                                            <div class="progress-bar y-color" role="progressbar"
                                                                style="width: 30%" aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Get ₹2,300 off</td>
                                                <td class="">
                                                    <div class="status-badge red-bg">Inactive </div>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">SALEISHERE</td>
                                                <td>Fixed</td>
                                                <td>₹ 2,300</td>
                                                <td>
                                                    <div class="d-flex justify-content-center vertical-center">
                                                        20
                                                        <div class="progress  ">
                                                            <div class="progress-bar y-color" role="progressbar"
                                                                style="width: 30%" aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Get ₹2,300 off</td>
                                                <td class="">
                                                    <div class="status-badge ">Active</div>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">30SALE</td>
                                                <td>Percentage</td>
                                                <td>30%</td>
                                                <td>
                                                    <div class="d-flex justify-content-center vertical-center">
                                                        15
                                                        <div class="progress  ">
                                                            <div class="progress-bar y-color" role="progressbar"
                                                                style="width: 30%" aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Get ₹2,300 off</td>
                                                <td class="">
                                                    <div class="status-badge ">Active</div>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">MOVE12345</td>
                                                <td>Fixed</td>
                                                <td>₹ 2,300</td>
                                                <td>
                                                    <div class="d-flex justify-content-center vertical-center">
                                                        15
                                                        <div class="progress  ">
                                                            <div class="progress-bar y-color" role="progressbar"
                                                                style="width: 30%" aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Get ₹2,300 off</td>
                                                <td class="">
                                                    <div class="status-badge green-bg">Completed</div>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">MOVE12345</td>
                                                <td>Fixed</td>
                                                <td>₹ 2,300</td>
                                                <td>
                                                    <div class="d-flex justify-content-center vertical-center">
                                                        15
                                                        <div class="progress  ">
                                                            <div class="progress-bar y-color" role="progressbar"
                                                                style="width: 30%" aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Get ₹2,300 off</td>
                                                <td class="">
                                                    <div class="status-badge red-bg">Inactive</div>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>

                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">MOVE12345</td>
                                                <td>Percentage</td>
                                                <td>30%</td>
                                                <td>
                                                    <div class="d-flex justify-content-center vertical-center">
                                                        15
                                                        <div class="progress  ">
                                                            <div class="progress-bar y-color" role="progressbar"
                                                                style="width: 30%" aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Get ₹2,300 off</td>
                                                <td class="">
                                                    <div class="status-badge ">Active</div>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">MOVE12345</td>
                                                <td>Fixed</td>
                                                <td>₹ 2,300</td>
                                                <td>
                                                    <div class="d-flex justify-content-center vertical-center">
                                                        15
                                                        <div class="progress  ">
                                                            <div class="progress-bar y-color" role="progressbar"
                                                                style="width: 30%" aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Get ₹2,300 off</td>
                                                <td class="">
                                                    <div class="status-badge green-bg">Completed</div>
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                </td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                                onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                <td scope="row">MOVE12345</td>
                                                <td>Fixed</td>
                                                <td>₹ 2,300</td>
                                                <td>
                                                    <div class="d-flex justify-content-center vertical-center">
                                                        15
                                                        <div class="progress  ">
                                                            <div class="progress-bar y-color" role="progressbar"
                                                                style="width: 30%" aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Get ₹2,300 off</td>
                                                <td class="">
                                                    <div class="status-badge red-bg">Inactive</div>
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