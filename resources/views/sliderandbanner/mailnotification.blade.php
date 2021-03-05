@extends('layouts.app')
@section('title') Push Notifications @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="mailnotification">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4 f-20">Push Notification & Messages</h3>
        <div class="mr-20 create-notification">
                        
            <button class="btn theme-bg white-text dropdown-toggle"><i class="fa fa-plus p-1" aria-hidden="true"></i> Create New </button>
                            <div class="dropdown">
                                <ul>
                                    <li><a href="create-new-notification.html">Push Notification</a></li>
                                    <li><a href="create-new-message.html">Mail</a></li>
                                 
                                </ul>
                            </div>
                     
                        </div>
                    </div>
                    <div class="d-flex  flex-row justify-content-between">
                        <div class="page-head text-left  pt-0 pb-0 p-2">
                          <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Push Notification & Messages</li>
                              <li class="breadcrumb-item"><a href="#">Notifications</a></li>
                              
                            </ol>
                          </nav>
                        
                        
                        </div>
                  
                    </div>

                    <!-- Dashboard cards -->


                    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
                        <div class="col-sm-12">

                            <div class="card  h-auto p-0 pt-10">
                                <div class="d-flex flex-row justify-content-between p-10">
                                    <div class=" card-head right text-left">
                                      <h3 class="f-18">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link  p-15" id="live-tab" href="{{ route('mail-notification')}}">Push Notifications</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active p-15" id="past-tab" href="mail-notification" role="tab" aria-controls="profile" aria-selected="false">Mails</a>
                                            </li>

                                        </ul>
                                      </h3> 
                                          
                                       
                                    </div>
                              
                                </div>
                                <!-- Table -->

                                <div class="tab-content margin-topneg-7" id="myTabContent">

                                    <div class="tab-pane fade" id="past" role="tabpanel" aria-labelledby="past-tab">
                                        <table class="table text-left p-0 theme-text mb-0 primary-table margin-topneg-35">
                                            <thead class="secondg-bg p-0">
                                                <tr>
                                                    <th scope="col">Attachements</th>
                                                    <th scope="col">Subject Name</th>
                                                    <th scope="col">Zone</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Operations</th>
                                                </tr>
                                            </thead>
                                            <tbody class="mtop-20 f-13">
                                                <tr class="tb-border cursor-pointer"
                                                   >
                                                    <td scope="row"> <img class="default-image w-74"
                                                            src="{{asset('static/images/default-image.svg')}}" alt=""></td>
                                                    <td>Make an easy move</td>
                                                    <td>Chennai Urban</td>
                                                    <td class="">
                                                        <div class="status-badge light-bg">Draft</div>
                                                    </td>
                                                    <td>
                                                       This mail is to inform you...
                                                        
                                                    </td>
                                                    <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                            class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                                </tr>
                                                <tr class="tb-border cursor-pointer"
                                                   >
                                                    <td scope="row"> <img class="default-image w-74"
                                                            src="{{asset('static/images/default-image.svg')}}" alt=""></td>
                                                    <td>New Year Sale is here</td>
                                                    <td>Kolkata</td>
                                                    <td class="">
                                                        <div class="status-badge light-green-bg">Public</div>
                                                    </td>
                                                    <td>
                                                       This mail is to inform you...
                                                        
                                                    </td>
                                                    <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                            class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                                </tr>
                                                <tr class="tb-border cursor-pointer"
                                               >
                                                <td scope="row"> <img class="default-image w-74"
                                                        src="{{asset('static/images/default-image.svg')}}" alt=""></td>
                                                <td>Ho! Ho! Ho! Xmas sale</td>
                                                <td>Chennai Urban</td>
                                                <td class="">
                                                    <div class="status-badge light-green-bg">Public</div>
                                                </td>
                                                <td>
                                                   This mail is to inform you...
                                                    
                                                </td>
                                                <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                        class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                            </tr>
                                            <tr class="tb-border cursor-pointer"
                                           >
                                            <td scope="row"> <img class="default-image w-74"
                                                    src="{{asset('static/images/default-image.svg')}}" alt=""></td>
                                            <td>Make an easy move</td>
                                            <td>Bengaluru Urban</td>
                                            <td class="">
                                                <div class="status-badge light-bg">Draft</div>
                                            </td>
                                            <td>
                                               This mail is to inform you...
                                                
                                            </td>
                                            <td> <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i><i
                                                    class="icon dripicons-trash p-1" aria-hidden="true"></i></i></td>
                                        </tr>
                                        <tr class="tb-border cursor-pointer"
                                       >
                                        <td scope="row"> <img class="default-image w-74"
                                                src="{{asset('static/images/default-image.svg')}}" alt=""></td>
                                        <td>Make an easy move</td>
                                        <td>Chennai Urban</td>
                                        <td class="">
                                            <div class="status-badge light-bg">Draft</div>
                                        </td>
                                        <td>
                                           This mail is to inform you...
                                            
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
                                            <li class="button"><a href="#"><img src="{{asset('static/images/Backward.svg')}}"></a></li>
                                            <li class="button"><a href="#"><img src="{{asset('static/images/forward.svg')}}"></a></li>
                                        </ul>
                                    </div>
                                    </div>
                                    
                                    <!--  -->
                                </div>


                            </div>

                        </div>

                    </div>




</div>

@endsection