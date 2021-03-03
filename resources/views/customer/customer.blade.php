@extends('layouts.app')

@section('content')
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="customer">

    <div class="d-flex  flex-row justify-content-between vertical-center">
        <h3 class="page-head text-left p-4 f-20 theme-text">Customer Management</h3>
            <div class="mr-20">
                <a href="{{route('create-customers')}}">
                                    <button class="btn theme-bg white-text"><i class="fa fa-plus p-1"
                                        aria-hidden="true"></i>CREATE CUSTOMER</button>
                                   </a>
                                </div>
                            </div>
                            <div class="d-flex  flex-row justify-content-between">
                                <div class="page-head text-left  pt-0 pb-0 p-2">
                                  <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active" aria-current="page">Customer Management</li>
                                      <li class="breadcrumb-item"><a href="#"> Manage Customers
                                    </a></li>
                                      
                                    </ol>
                                  </nav>
                                
                                
                                </div>
                          
                            </div>  

                            <div class="vender-all-details">
                                <div class="simple-card">
                                    <p>TOTAL CUSTOMERS</p>
                                    <h1>12,390</h1>
                                </div>
                                <div class="simple-card">
                                    <p>ACTIVE CUSTOMERS</p>
                                    <h1>3,459</h1>
                                </div>
                                <div class="simple-card">
                                    <p> INACTIVE CUSTOMERS</p>
                                    <h1>3,459</h1>
                                </div>
                                <div class="simple-card">
                                    <p> FAVOURITE CUSTOMERS</p>
                                    <h1>3,459</h1>
                                </div>                               
                            </div>
                            <!-- Dashboard cards -->


                            <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
                                <div class="col-lg-12">
                                    <div class="card  h-auto p-0 pt-10">
                                        <div class="header-wrap">
                                            <h3 class="f-18 ">Customers</h3>
                                            
                                            <div class="header-wrap p-0">
                    <a href="#" class="margin-r-20" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i><img src="{{ asset('static/images/filter.svg')}}" alt="" srcset="" ></i>
                          
                                                </a>
                                                <div class="dropdown-menu ">
                                                    <a class="dropdown-item border-top-bottom" href="#">
                                                        <div class="form-check">
                                                           <input class="form-check-input" type="checkbox" value="" id="selectall">
                                                                                       <label class="form-check-label" for="selectall">
                                                                                        Select all
                                                                                       </label>
                                                                   </div></a>
                             <a class="dropdown-item border-top-bottom" href="#">
                                 <div class="form-check">
                                                                       <input class="form-check-input" type="checkbox" value="" id="city">
                                                                                                   <label class="form-check-label" for="city">
                                                                                                    City
                                                                                                   </label>
                                                                               </div></a>
                                                 <a class="dropdown-item border-top-bottom" href="#">
                                                                                       <div class="form-check">
                                                                                           <input class="form-check-input" type="checkbox" value="" id="Customer">
                                                                                                                       <label class="form-check-label" for=" Customer">
                                                                                                                        Customer Status
                                                                                                                       </label>
                                               </div>
                                                                                   </a>
                                                <a class="dropdown-item border-top-bottom" href="#">
                                                                                       <div class="form-check">
                                                                                           <input class="form-check-input" type="checkbox" value="" id="customerType">
                                                                                                                       <label class="form-check-label" for="customerType">
                                                                                                                        Customer Type
                                                                                                                       </label>
                                               </div>
                                                                                   </a>
                 
        
                                                                      </div>
                                                                      <form class="form-inline  input-group search-bar">
                                                
                                                                        <input class="form-control    icon-bg  br-5" type="search" placeholder="Search..." aria-label="Search">
                                                                     
                                                                          
                                                                      </form>
                                            </div>
                                            
                                           
                         </div> 
                                        <div class="all-vender-details">
                                            <table class="table text-center p-0 theme-text mb-0 primary-table left-col-table" >
                                                <thead class="secondg-bg  p-0">
                                                    <tr>
                                                        <th scope="col">Customer Name</th>
                                                        <th scope="col">Phone</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">City</th>
                                                        <th scope="col" style="text-align: center;">Favourite</th>
                                                        <th scope="col" style="text-align: center;">Status</th>
                                                        <th scope="col" style="text-align: center;">Operation</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="mtop-20">
                                                    <tr class="tb-border cursor-pointer"
                                                        onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">David Jerome</td>
                                                        <td>+91-9739823457</td>
                                                        <td>davidjerome@ymail.com</td>
                                                        <td>Bengaluru</td>
                                                        <td style="text-align: center;">
                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        </td>
                                                        <td class="" style="text-align: center;">
                                                            <div class="status-badge">Enquiry</div>
                                                        </td>
                                                        <td style="text-align: center;"> <i class="fa fa-pencil p-1 mr-3" aria-hidden="true"></i>
                                                            <i class="fa fa-ban" aria-hidden="true"></i>
                                                        </td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer"
                                                    onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                    <td scope="row">Ann Hency</td>
                                                    <td>+91-9739823457</td>
                                                    <td>davidjerome@ymail.com</td>
                                                    <td>Bengaluru</td>
                                                    <td style="text-align: center;">
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    </td>
                                                    <td class="" style="text-align: center;">
                                                        <div class="status-badge">Bidding</div>
                                                    </td>
                                                    <td style="text-align: center;"> <i class="fa fa-pencil p-1 mr-3" aria-hidden="true"></i>
                                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                                    </td>
                                                </tr>
                                                <tr class="tb-border cursor-pointer"
                                                        onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">Abhiram Rao</td>
                                                        <td>+91-9739823457</td>
                                                        <td>abhiramrao@ymail.com</td>
                                                        <td>Bengaluru</td>
                                                        <td style="text-align: center;">
                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        </td>
                                                        <td class="" style="text-align: center;">
                                                            <div class="status-badge">Enquiry</div>
                                                        </td>
                                                        <td style="text-align: center;"> <i class="fa fa-pencil p-1 mr-3" aria-hidden="true"></i>
                                                            <i class="fa fa-ban" aria-hidden="true"></i>
                                                        </td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer"
                                                        onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">Rohan Seth</td>
                                                        <td>+91-9739823457</td>
                                                        <td>rohanseth@ymail.com</td>
                                                        <td>Bengaluru</td>
                                                        <td style="text-align: center;">
                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        </td>
                                                        <td class="" style="text-align: center;">
                                                            <div class="status-badge">In Transit</div>
                                                        </td>
                                                        <td style="text-align: center;"> <i class="fa fa-pencil p-1 mr-3" aria-hidden="true"></i>
                                                            <i class="fa fa-ban" aria-hidden="true"></i>
                                                        </td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer"
                                                        onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">Abhishek Raghu</td>
                                                        <td>+91-9739823457</td>
                                                        <td>abhishekraghu@ymail.com</td>
                                                        <td>Bengaluru</td>
                                                        <td style="text-align: center;">
                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        </td>
                                                        <td class="" style="text-align: center;">
                                                            <div class="status-badge">Awaiting Pickup</div>
                                                        </td>
                                                        <td style="text-align: center;"> <i class="fa fa-pencil p-1 mr-3" aria-hidden="true"></i>
                                                            <i class="fa fa-ban" aria-hidden="true"></i>
                                                        </td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer"
                                                        onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">Mitraj Singh</td>
                                                        <td>+91-9739823457</td>
                                                        <td>mitrajsingh@ymail.com</td>
                                                        <td>Bengaluru</td>
                                                        <td style="text-align: center;">
                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        </td>
                                                        <td class="" style="text-align: center;">
                                                            <div class="status-badge">Completed</div>
                                                        </td>
                                                        <td style="text-align: center;"> <i class="fa fa-pencil p-1 mr-3" aria-hidden="true"></i>
                                                            <i class="fa fa-ban" aria-hidden="true"></i>
                                                        </td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer"
                                                        onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">Bhumika Kaur</td>
                                                        <td>+91-9739823457</td>
                                                        <td>bhumikakaur@ymail.com</td>
                                                        <td>Bengaluru</td>
                                                        <td style="text-align: center;">
                                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                                        </td>
                                                        <td class="" style="text-align: center;">
                                                            <div class="status-badge">Bidding</div>
                                                        </td>
                                                        <td style="text-align: center;"> <i class="fa fa-pencil p-1 mr-3" aria-hidden="true"></i>
                                                            <i class="fa fa-ban" aria-hidden="true"></i>
                                                        </td>
                                                    </tr>


                                                </tbody>

                                            </table>
                                            <div class="pagination">
                                                <ul>
                                                    <li class="digit">1</li>
                                                    <li class="label">of</li>
                                                    <li class="digit">20</li>
                                                    <li class="button"><a href="#"><img src="{{asset('static/images/Backward.svg')}}"></a></li>
                                                    <li class="button"><a href="#"><img src="{{asset('static/images/forward.svg')}}"></a></li>
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