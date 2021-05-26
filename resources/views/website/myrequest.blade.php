@extends('website.layouts.frame')
@section('title')My Request @endsection
@section('header_title') My Request @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="myrequest">
        <div class="container">
            <div class="quote responsive w-70 ontop p-4 bg-white">
                <div class="card-head right text-left p-8 pt-10 pb-0">
                    <h3 class="f-18">
                        <ul class="nav nav-tabs pt-10 p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15" id="new-order-tab" data-toggle="tab" href="{{route('website.my-profile')}}">My Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15" id="new-order-tab" data-toggle="tab" href="{{route('my-bookings-enquiries')}}">Enquiries</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15" id="quotation" data-toggle="tab" href="{{route('my-bookings')}}">Ongoing Booking</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15" id="booking-history" href="{{route('order-history')}}">Booking History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab active p-15" id="request-tab" data-toggle="tab" href="#request" role="tab" aria-controls="profile" aria-selected="false">My Requests</a>
                            </li>
                        </ul>
                    </h3>
                </div>
                <div class="tab-content margin-topneg-7 border-top" id="myTabContent">
                    <div class="tab-pane fade show active" id="request" role="tabpanel" aria-labelledby="request-tab">
                        <div class="row">
                            <div class="col-md-8 col-xs-12 col-sm-12  border-right">
                                <h5 class="heading ml-4 mt-4">My Request</h5>
                                @foreach($tickets as $ticket)
                                    <div class="card ml-4 mt-4">
                                    <div class="card-body">
                                        <div>
                                            <div class="d-flex justify-content-between">
                                                <div class="ticket-id pt-4">
                                                    <h6 class="para-head light pl-2">
                                                        REQUEST ID <span class="bold">: #{{$ticket->id}}</span>
                                                    </h6>
                                                </div>
                                                @switch($ticket->status)
                                                    @case(\App\Enums\TicketEnums::$STATUS['open'])
                                                        <div class="status-badge bg-green white-text h-content" style="min-width: auto!important;">
                                                            <a data-toggle="modal" data-target="#req-modal">
                                                                <p class="f-12 mb-0" style="padding-left: 0px!important;">
                                                                    Open
                                                                </p>
                                                            </a>
                                                        </div>
                                                    @break;

                                                    @case(\App\Enums\TicketEnums::$STATUS['closed'])
                                                        <div class="status-badge bg-green white-text h-content"  style="min-width: auto!important;">
                                                            <a data-toggle="modal" data-target="#req-modal">
                                                                <p class="f-12 mb-0" style="padding-left: 0px!important;">
                                                                    Closed
                                                                </p>
                                                            </a>
                                                        </div>
                                                    @break;

                                                    @case(\App\Enums\TicketEnums::$STATUS['rejected'])
                                                        <div class="status-badge bg-red white-text h-content"  style="min-width: auto!important;">
                                                            <a data-toggle="modal" data-target="#req-modal">
                                                                <p class="f-12 mb-0" style="padding-left: 0px!important;">
                                                                    Rejected
                                                                </p>
                                                            </a>
                                                        </div>
                                                    @break;

                                                    @case(\App\Enums\TicketEnums::$STATUS['resolved'])
                                                        <div class="status-badge bg-green white-text h-content" style="min-width: auto!important;">
                                                            <a data-toggle="modal" data-target="#req-modal">
                                                                <p class="f-12 mb-0" style="padding-left: 0px!important;">
                                                                    Resolved
                                                                </p>
                                                            </a>
                                                        </div>
                                                    @break;
                                                @endswitch
                                            </div>
                                            <h6 class="para-head pl-2">{{ucwords($ticket->heading)}}</h6>
                                            <p class="para">
                                                {{$ticket->desc}}
                                              {{--  <span id="more" class="cursor-pointer" href="#" onclick="toggle_visibility('view_more_content');">.....View more </span>--}}

                                            </p>
                                        </div>
                                        <div id="view_more_content" class="togglenone">
                                            <div class="ticket-id d-flex pt-4  border-top justify-content-between">
                                                <p class="para-head l-cap">Ticket Id : <span>#454556</span></p>
                                                <!-- <p class="bg-blur col-orange l-cap">In process</p> -->
                                            </div>
                                            <div class="ticket-id border-top pt-4">
                                                <h6 class="para-head ml-1">Subject</h6>
                                                <p class="l-cap col-grey pl-1">Category</p>
                                                <p class="para pl-1"> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                            </div>
                                            <div class="reply border-top pt-4">
                                                <h5 class="para-head mb-3">Reply</h5>

                                                <div class="d-flex">
                                                    <i class="fa fa-square f-52"></i>
                                                    <!-- <i class="fas fa-stop"></i> -->
                                                    <div class="mt-1">
                                                        <h6 class="para-text bold ml-3 mb-0">Customer Support</h6>
                                                        <p class="text-muted ml-1">2 days ago</p>
                                                        <p class="para ml-1"> Dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer.Dummy text of the printing and typesetting
                                                            industry. Ipsum has been the industry’s
                                                        </p>
                                                        <p class="para ml-1">
                                                            industry’s standard dummy text ever since the 1500s, when an unknown
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-md-4 col-xs-12 col-sm-12 ">
                                <h5 class="heading mt-4 f-20 mb-3">New Request</h5>
                                <form action="{{route('add_ticket')}}" method="POST" data-next="refresh"  data-alert="mega" class="form-new-order mt-3 input-text-blue" data-parsley-validate>
                                    <div class="form-group">
                                        <label class="phone-num-lable">Category</label>
                                              <select name="category" class="form-control" required>
                                                <option value="">--Select--</option>
                                                  @foreach(\App\Enums\TicketEnums::$TYPE as $type=>$key)
                                                      <option value="{{$key}}">{{ucwords($type)}}</option>
                                                  @endforeach
                                              </select>
                                              <span class="error-message">Please enter valid
                                                Designation</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="para-head">Subject</label>
                                        <input type="text" class="form-control" id="formGroupExampleInput" name="heading" placeholder="Subject" required/>
                                    </div>
                                    <div class="form-input">
                                        <label class="para-head">Message</label>
                                              <textarea id="" class="form-control" name="desc" rows="4" placeholder="Description" required></textarea>
                                              <span class="error-message">Please enter valid</span>
                                    </div>
                                    <a class="white-text" href="#">
                                        <button class="btn mt-4 btn-theme-bg full-width white-bg">
                                            submit
                                        </button>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
