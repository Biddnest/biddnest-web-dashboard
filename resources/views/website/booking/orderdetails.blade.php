@extends('website.layouts.frame')
@section('title')Ongoing Book @endsection
@section('header_title') Ongoing Book @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="orderdetails">
        <div class="container">
            <div class="quote responsive w-70 ontop p-4 bg-white">
                <div class="card-head right text-left  p-8 pt-10 pb-0">
                    <h3 class="f-18">
                        <ul class="nav nav-tabs pt-10 p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15" id="new-order-tab" data-toggle="tab" href="{{route('my-profile')}}">My Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab active p-15" id="quotation" data-toggle="tab" href="#past" role="tab" aria-controls="profile" aria-selected="false">Ongoing Booking</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15" id="booking-history" data-toggle="tab" href="{{route('order-history')}}">Booking History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link light-nav-tab p-15" id="request-tab" data-toggle="tab" href="{{route('my-request')}}">My Requests</a>
                            </li>
                        </ul>
                    </h3>
                </div>
                <div class="tab-content margin-topneg-7 border-top" id="myTabContent">
                    <div class="tab-pane fade show active " id="past" role="tabpanel" aria-labelledby="past-tab">
                        <div class="container " id="booking-show">
                            <div class=" d-flex justify-content-between direction-col   mt-4 pb-4 border-bottom ">
                                <div class="center mt-1">
                                    <h5>Booking Details</h5>
                                </div>
                                <div class="d-flex direction-col  ">
                                    <div>
                                        <button class="btn btn-booking d-flex theme-text f-14 center mr-3 "><img
                                                src="{{asset('static/website/images/icons/call-button.svg')}}" />Virtual
                                            Assistance</button>
                                    </div>
                                    <div>
                                        <button data-toggle="modal" data-target="#order-detail-modal" class="btn btn-booking d-flex theme-text f-14 center  mr-3"><img
                                                src="{{asset('static/website/images/icons/page.svg')}}" />Order Details</button>
                                    </div>
                                    <div>
                                        <button class="btn btn-booking d-flex theme-text f-14 center  mr-3"><img
                                                src="{{asset('static/website/images/icons/share.svg')}}"
                                                class="share-margin" />Share</button>
                                    </div>
                                    <div>
                                        <button data-toggle="modal" data-target="#manage-modal" class="btn btn-booking d-flex theme-text f-14 center  mr-3"><img
                                                src="{{asset('static/website/images/icons/cross.svg')}}" />Manage Orders</button>
                                    </div>
                                    <div>
                                        <button data-toggle="modal" data-target="#pin-modal" class="btn btn-theme-bg padding-btn-res btn-padding">start</button>
                                    </div>

                                </div>
                            </div>
                            <div class="row pb-4 border-bottom">

                                <div class="col-md-6 col-sm-12 col-xs-12 border-right pr-5 mt-4 pl-0">
                                    <div class=" d-flex justify-content-between">
                                        <div>
                                            <p class="f-14 ">FROM</p>
                                            <p class="bg-blur f-18"> Bengaluru</p>
                                        </div>
                                        <div class=" mt-1 pt-3">
                                            <img src="{{asset('static/website/images/icons/moving-truck.svg')}}" />
                                        </div>
                                        <div>
                                            <p class="f-14">TO</p>
                                            <p class="bg-blur f-18">Chennai</p>
                                        </div>
                                    </div>


                                    <div class="card text-left  details-card  bg-blur mt-1 ">
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <div>
                                                    <p class="l-cap f-12 mb-0 p-0">Driver</p>
                                                    <p class="mt-0 f-14  p-0"> Omkar Patel</p>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div>
                                                    <p class="l-cap f-12 mb-0  p-0">Vehicle Name</p>
                                                    <p class="f-14  p-0">Motor-X</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <div>
                                                    <p class="l-cap f-12 mb-0 p-0">Phone Number</p>
                                                    <p class="mt-0 f-14  p-0">9099090999</p>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="pr-1">
                                                    <p class="l-cap f-12 mb-0  p-0">Vehicle Type </p>
                                                    <p class="mt-0 f-14  p-0"> Heavy</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="">
                                                <div>
                                                    <button data-toggle="modal" data-target="#detail-modal" class="btn btn-theme-bg p-1 f-12 ">Send details to
                                                        phone</button>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="pr-3">
                                                    <p class="l-cap f-12 mb-0  p-0">Manpower</p>
                                                    <p class="mt-0 f-14  p-0">5</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12  col-sm-12 mt-4 pl-4 text-left">
                                    <div class="d-flex mr-30 justify-content-between">
                                        <div>
                                            <h6 class="l-cap f-14 p-0">Date</h6>
                                            <h5>20 Jan 21</h5>
                                        </div>
                                        <div>
                                            <h6 class="l-cap f-14">Price </h6>
                                            <h5>Rs. 9,800</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex mr-46 justify-content-between mt-2 ">
                                        <div>
                                            <h6 class="l-cap f-14">Order ID</h6>
                                            <h5>#312334</h5>
                                        </div>
                                        <div>
                                            <h6 class="l-cap f-14">Distance</h6>
                                            <h5>314 KM</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2 mr-2">
                                        <div>
                                            <h6 class="l-cap f-14">Status</h6>
                                            <h5>Booked</h5>
                                        </div>
                                        <div class="margin-cat">
                                            <h6 class="l-cap f-14">Category</h6>
                                            <h5>Commercial</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-4 ">
                                <h5 class="text-view-center m-auto">
                                    Order Tracking

                                </h5>

                            </div>
                            <div class="onbaording-flow-container mt-2 pb-100">
                                <div class="flow">
                                    <div class="flow__item">
                                        <span class="flow__item__circle " data-onboarding-step="" data-onboarding-step-text="Booked"><img
                                                src="{{asset('static/website/images/icons/check.svg')}}" /></span>
                                    </div>
                                    <div class="flow__item-line" data-onboarding-step="2"></div>
                                    <div class="flow__item">
                                        <div class="flow__item__circle" data-onboarding-step="" data-onboarding-step-text="Payment"><img src="{{asset('static/website/images/icons/card.svg')}}" /></div>
                                    </div>
                                    <div class="flow__item-line" data-onboarding-step="3"></div>
                                    <div class="flow__item">
                                        <div class="flow__item__circle bg-purple u-purple-color" data-onboarding-step="" data-onboarding-step-text="Driver Assigned"><img src="{{asset('static/website/images/icons/person.svg')}}" /></div>
                                    </div>
                                    <div class="flow__item-line" data-onboarding-step="4"></div>
                                    <div class="flow__item">
                                        <div class="flow__item__circle" data-onboarding-step="" data-onboarding-step-text="Awaiting Pickup"><img src="{{asset('static/website/images/icons/truck.svg')}}" /></div>
                                    </div>
                                    <div class="flow__item-line" data-onboarding-step="5"></div>
                                    <div class="flow__item">
                                        <div class="flow__item__circle" data-onboarding-step="" data-onboarding-step-text="In Transit"><img src="{{asset('static/website/images/icons/time-truck.svg')}}" /></div>
                                    </div>
                                    <div class="flow__item-line" data-onboarding-step="6"></div>
                                    <div class="flow__item">
                                        <div class="flow__item__circle" data-onboarding-step="" data-onboarding-step-text="Completed"><img src="{{asset('static/website/images/icons/pin-location.svg')}}" /></div>
                                    </div>
                                </div>
                                <!-- <button onclick="stepFlip()" style="margin-top: 50px;">move</button> -->
                            </div>

                            <!-- Modal Order Details -->
                            <div class="modal fade" id="order-detail-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                                <div class="modal-dialog para-head input-text-blue" role="document">
                                    <div class="modal-content  w-1000 mt-50  right-25">
                                        <div class="modal-header  bg-purple">
                                            <h5 class="modal-title m-0-auto -mr-30 text-white" id="exampleModalLongTitle ">
                                                Order Details</h5>
                                            <button type="button" class="close text-white  " data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body margin-topneg-2">
                                            <div class="row border-bottom d-flex center">
                                                <div class="col-2 ">
                                                    <i class="icon-order-details fa fa-bed"></i>
                                                </div>
                                                <div class="col-4">
                                                    <p class="pl-0">Cupboard</p>
                                                    <div>
                                                        <p class="bg-blur f-12">Medium</p>

                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <p>Arclic</p>
                                                </div>
                                                <div class="col-2">
                                                    <p class="bg-blur bg-blur-num">01</p>
                                                </div>
                                            </div>
                                            <div class="row border-bottom d-flex center">

                                                <div class="col-2">
                                                    <i class="icon-order-details fa fa-bed"></i>
                                                </div>
                                                <div class="col-4">
                                                    <p class="pl-0"> Cupboard</p>
                                                    <div>
                                                        <p class="bg-blur f-12">Large</p>

                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <p>Wood</p>
                                                </div>
                                                <div class="col-2">
                                                    <p class="bg-blur bg-blur-num">01</p>
                                                </div>
                                            </div>
                                            <div class="row border-bottom d-flex center">

                                                <div class="col-2">
                                                    <i class="icon-order-details fa fa-bed"></i>
                                                </div>
                                                <div class="col-4">
                                                    <p class="pl-0">Cupboard</p>
                                                    <div>
                                                        <p class="bg-blur f-12">Small</p>

                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <p>WPC</p>
                                                </div>
                                                <div class="col-2">
                                                    <p class="bg-blur bg-blur-num">01</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="manage-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                                <div class="modal-dialog para-head input-text-blue" role="document">
                                    <div class="modal-content  w-1000 mt-50  right-25">
                                        <div class="modal-header  bg-purple">
                                            <h5 class="modal-title m-0-auto -mr-30 text-white" id="exampleModalLongTitle ">
                                                Manage Order</h5>
                                            <button type="button" class="close text-white  " data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-15 margin-topneg-2">
                                            <div>
                                                <p class="f-16 center text-view-center">How you do like to manage your order
                                                </p>
                                            </div>
                                            <div class="accordion" id="comments">
                                                <div class="button-bottom d-flex justify-content-between text-view-center mr-2-0 pt-4 mr-2 ml-4">

                                                    <div class=""><a class="white-text "><button data-toggle="modal"
                                                                                                 data-target="#cancel-modal"
                                                                                                 class="btn btn-theme-w-bg f-14 padding-btn-max">cancel &
                                                                Refund</button></a>
                                                    </div>
                                                    <div class="">
                                                        <button type="submit" data-toggle="modal" data-target="#reschedule-modal" class="btn btn-theme-bg  f-14  white-bg padding-btn-max">Reschedule
                                                            <a class="white-text " href="./book-move.html"></a>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- MOdal Get details on call -->
                            <div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                                <div class="modal-dialog para-head input-text-blue" role="document">
                                    <div class="modal-content  w-1000 mt-50  right-25">
                                        <div class="modal-header  bg-purple">
                                            <h5 class="modal-title m-0-auto -mr-30 text-white" id="exampleModalLongTitle ">
                                                Get details on phone</h5>
                                            <button type="button" class="close text-white  " data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-15 margin-topneg-2">
                                            <div>
                                                <form>
                                                    <div class="row d-flex justify-content-center">

                                                        <div class="col-lg-10 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="formGroupExampleInput" class="mb-0">Phone
                                                                    Number</label>
                                                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="9739912345">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>

                                                <div class="d-flex justify-content-center">
                                                    <a class="white-text " href="#">
                                                        <button class="btn mt-2 mt-1 btn-theme-bg full-width white-bg padding-btn-res">Send
                                                            Details</button>
                                                    </a>
                                                </div>
                                                <div class="mt-1 pt-1">
                                                    <!-- <p class="center light text-view-center mt-3">Did not receive pin?
                                                        <span class="theme-text pl-1 f-bolder">Resend</span></p> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal  Reschedule -->
                            <div class="modal fade" id="reschedule-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                                <div class="modal-dialog para-head input-text-blue" role="document">
                                    <div class="modal-content  w-1000 mt-50  right-25">
                                        <div class="modal-header  bg-purple">
                                            <h5 class="modal-title m-0-auto -mr-30 text-white" id="exampleModalLongTitle ">
                                                Reschedule Order</h5>
                                            <button type="button" class="close text-white  " data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body f-w-400 p-15 margin-topneg-2">
                                            <div>
                                                <p class="f-14 center">Terms & Conditions</p>
                                            </div>
                                            <div>
                                                <ol>
                                                    <li class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim
                                                        id est laborum.</li>
                                                    <li class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim
                                                        id est laborum.</li>

                                                </ol>

                                            </div>
                                            <div class="accordion" id="comments">
                                                <div class="button-bottom d-flex justify-content-between mr-2 ml-4 pt-4">
                                                    <div class="">
                                                        <button type="submit" class="btn btn-theme-w-bg p-yes white-bg">No
                                                            <a class="white-text " href="./book-move.html"></a>
                                                        </button>
                                                    </div>
                                                    <div class=""><a class="white-text "><button
                                                                class="btn btn-theme-bg p-yes">Yes</button></a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- modal -->
                            <div class="modal fade" id="cancel-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                                <div class="modal-dialog para-head input-text-blue" role="document">
                                    <div class="modal-content  w-1000 mt-50  right-25">
                                        <div class="modal-header  bg-purple">
                                            <h5 class="modal-title m-0-auto -mr-30 text-white" id="exampleModalLongTitle ">
                                                Cancel Order</h5>
                                            <button type="button" class="close text-white  " data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body f-w-400 p-15 margin-topneg-2">
                                            <div>
                                                <p class="f-14 center">Terms & Conditions</p>
                                            </div>
                                            <div>
                                                <ol>
                                                    <li class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim
                                                        id est laborum.</li>
                                                    <li class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim
                                                        id est laborum.</li>

                                                </ol>

                                            </div>
                                            <div class="accordion" id="comments">
                                                <div class="button-bottom d-flex justify-content-between mr-2 ml-4 pt-4">
                                                    <div class="">
                                                        <a class="white-text" data-toggle="modal" data-target="#reject-modal"><button
                                                                class="btn btn-theme-w-bg">No</button></a>

                                                    </div>
                                                    <div class=""><a class="white-text "><button
                                                                class="btn btn-theme-bg p-yes">Yes</button></a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="reject-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                                <div class="modal-dialog para-head input-text-blue" role="document">
                                    <div class="modal-content ml-4 w-90 mt-50 right-25">
                                        <div class="modal-header bg-purple">
                                            <h5 class="modal-title m-0-auto -mr-30 text-white" id="exampleModalLongTitle ">
                                                Reason for Rejection
                                            </h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-15 margin-topneg-2">
                                            <form>
                                                <div class="col-12">
                                                    <div class="form-input">
                                                        <span class="">
                                                            <select id="" class="form-control">
                                                                <option>High Price</option>
                                                                <option>Lower Quality</option>
                                                                <option>Bad Ideas</option>
                                                            </select>
                                                            <span class="error-message">Please enter valid Phone
                                                                number</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-input">
                                                        <textarea class="form-control" rows="3" placeholder="Enter your expected price here">
                                            </textarea>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-12 d-flex center mt-2 mb-2">
                                                    <div class="form-groups">
                                                        <label class="container-01 p-1 pl-2 m-0">
                                              <input type="checkbox" id="Lift1" />
                                              <span class="checkmark-agree -mt-10"></span>
                                            </label>
                                                    </div>
                                                    <p class="text-muted f-10">Talk to our agend</p>
                                                </div> -->
                                                <button type="submit" class="btn btn-theme-bg button-modal ml-5 text-view-center mt-2 padding-btn-res white-bg">
                                                    Cancel Booking
                                                    <a class="white-text" href="#"></a>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="pin-modal" tabindex="-1" role="dialog" aria-labelledby="for-friend" aria-hidden="true">
                                <div class="modal-dialog para-head input-text-blue" role="document">
                                    <div class="modal-content  w-1000 mt-50  right-25">
                                        <div class="modal-header  bg-purple">
                                            <h5 class="modal-title m-0-auto -mr-30 text-white" id="exampleModalLongTitle ">
                                                Pin</h5>
                                            <button type="button" class="close text-white  " data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-15 margin-topneg-2">
                                            <div>
                                                <form>
                                                    <div class="row d-flex justify-content-center">

                                                        <div class="col-lg-2 col-xs-2">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="3" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-xs-2">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="2" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-xs-2">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="3" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-xs-2">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="2" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                                <div>
                                                    <!-- <p class="center light">Did not receive pin? <span class="theme-text pl-1">Resend</span></p> -->
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <a class="white-text " href="#">
                                                        <button class="btn mt-4 btn-theme-bg full-width white-bg">submit</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
