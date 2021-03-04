@extends('layouts.app')
@section('title') Vendor Management @endsection
@section('content')

<!-- Main Content -->
<div class="main-content grey-bg">
                            <div class="d-flex  flex-row justify-content-between vertical-center">
                                <h3 class="page-head text-left p-4 f-20 theme-text">Vendor Management</h3>
                                <div class="mr-20">
                                    <a  href="{{ route('create-vendors')}}">
                                    <button class="btn theme-bg white-text"><i class="fa fa-plus p-1" aria-hidden="true"></i>ONBOARD VENDER</button>
                                </a>
                                </div>
                            </div>    
                            <div class="d-flex  flex-row justify-content-between">
                                <div class="page-head text-left  pt-0 pb-0 p-2">
                                  <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active" aria-current="page">Vendor Management</li>
                                      <li class="breadcrumb-item"><a href="#"> Leads</a></li>
                                      
                                    </ol>
                                  </nav>
                                
                                
                                </div>
                          
                            </div>                      

                            <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
                                <div class="col-lg-12">
                                    <div class="card  h-auto p-0 pt-10">
                                        <div class="header-wrap ">
                                            <h3 class="f-18  pl-1">Leads</h3>
                                           <div>
                                            <form class="form-inline  input-group search-bar">
                                                
                                                <input class="form-control    icon-bg  br-5" type="search" placeholder="Search..." aria-label="Search">
                                             
                                                  
                                              </form>
                                           </div>
                                        </div>                                        
                                        <div class="all-vender-details " >
                                            <table  class="table text-justify p-5 theme-text th-no-border">
                                                <thead class="secondg-bg p-0"  >
                                                    <tr>
                                                        <th  scope="col">Vendor Name</th>
                                                        <th scope="col">Org Name</th>
                                                        <th scope="col">Phone</th>
                                                        <th scope="col">City</th>
                                                        <th scope="col">Zone</th>
                                                        <th scope="col">Operations</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="mtop-20 text-justify">
                                                    <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">Mohan Kumar</td>
                                                        <td>Wayne Pvt Ltd</td>
                                                        <td>+91-873546576</td>
                                                        <td>Bengaluru</td>
                                                        <td class="">Bengaluru Urban</td>
                                                        <td>
                                                            <i class="fa fa-check-circle"></i>
                                                             <i class="icon dripicons-pencil  p-1 mx-4" aria-hidden="true"></i>
                                                            <i class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                        </td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">Tuka Ram</td>
                                                        <td>Wayne Pvt Ltd</td>
                                                        <td>+91-873546576</td>
                                                        <td>Bengaluru</td>
                                                        <td class="">Bengaluru Urban</td>
                                                        <td>
                                                            <i class="fa fa-check-circle"></i>
                                                             <i class="icon dripicons-pencil  p-1 mx-4" aria-hidden="true"></i>
                                                            <i class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                        </td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">Soham Hans</td>
                                                        <td>Wayne Pvt Ltd</td>
                                                        <td>+91-873546576</td>
                                                        <td>Bengaluru</td>
                                                        <td class="">Bengaluru Urban</td>
                                                        <td>
                                                            <i class="fa fa-check-circle"></i>
                                                             <i class="icon dripicons-pencil  p-1 mx-4" aria-hidden="true"></i>
                                                            <i class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                        </td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">Mithila Shekhar</td>
                                                        <td>Wayne Pvt Ltd</td>
                                                        <td>+91-873546576</td>
                                                        <td>Bengaluru</td>
                                                        <td class="">Bengaluru Urban</td>
                                                        <td>
                                                            <i class="fa fa-check-circle"></i>
                                                             <i class="icon dripicons-pencil  p-1 mx-4" aria-hidden="true"></i>
                                                            <i class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                        </td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">Shrikirshna Mohan</td>
                                                        <td>Wayne Pvt Ltd</td>
                                                        <td>+91-873546576</td>
                                                        <td>Bengaluru</td>
                                                        <td class="">Bengaluru Urban</td>
                                                        <td>
                                                            <i class="fa fa-check-circle"></i>
                                                             <i class="icon dripicons-pencil  p-1 mx-4" aria-hidden="true"></i>
                                                            <i class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                        </td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">Ram Kumar</td>
                                                        <td>Wayne Pvt Ltd</td>
                                                        <td>+91-873546576</td>
                                                        <td>Bengaluru</td>
                                                        <td class="">Bengaluru Urban</td>
                                                        <td>
                                                            <i class="fa fa-check-circle"></i>
                                                             <i class="icon dripicons-pencil  p-1 mx-4" aria-hidden="true"></i>
                                                            <i class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                        </td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">Sanjay Subramanyan</td>
                                                        <td>Wayne Pvt Ltd</td>
                                                        <td>+91-873546576</td>
                                                        <td>Bengaluru</td>
                                                        <td class="">Bengaluru Urban</td>
                                                        <td>
                                                            <i class="fa fa-check-circle"></i>
                                                             <i class="icon dripicons-pencil  p-1 mx-4" aria-hidden="true"></i>
                                                            <i class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                        </td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">Unni Srinivas</td>
                                                        <td>Wayne Pvt Ltd</td>
                                                        <td>+91-873546576</td>
                                                        <td>Bengaluru</td>
                                                        <td class="">Bengaluru Urban</td>
                                                        <td>
                                                            <i class="fa fa-check-circle"></i>
                                                             <i class="icon dripicons-pencil  p-1 mx-4" aria-hidden="true"></i>
                                                            <i class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
                                                        </td>
                                                    </tr>
                                                    <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                                                        <td scope="row">Rajesh Kannan</td>
                                                        <td>Wayne Pvt Ltd</td>
                                                        <td>+91-873546576</td>
                                                        <td>Bengaluru</td>
                                                        <td class="">Bengaluru Urban</td>
                                                        <td>
                                                            <i class="fa fa-check-circle"></i>
                                                             <i class="icon dripicons-pencil  p-1 mx-4" aria-hidden="true"></i>
                                                            <i class="icon dripicons-trash p-1" aria-hidden="true"></i></i>
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
                                                    <li class="button"><a href="#"><img src="{{ asset('static/images/Backward.svg')}}"></a></li>
                                                    <li class="button"><a href="#"><img src="{{ asset('static/images/forward.svg')}}"></a></li>
                                                </ul>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>

                                </div>

                            </div>




</div>

@endsection