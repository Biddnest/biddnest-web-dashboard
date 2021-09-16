@extends('website.layouts.frame')
@section('title') Book Move @endsection
@section('header_title')Estimated Cost @endsection
@section('content')
    <div class="content-wrapper" data-barba="container" data-barba-namespace="estimatebooking">
        <div class="container ">
            <div class="book-move-screen responsive ontop w-70 ">
                <div class="card-body ">
                    <div class="row d-flex ">
                        <div class="col-md-3 br-line view-none pt-4 ">
                            <div class="row steps-form-3 ">
                                <div class="col-md-8 setup-panel-3">
                                    <div class="steps-step-1 ">
                                        <p class="step-text text-right ">Customer Details
                                            <span class="text-muted "> Personal Info</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 steps-row-3 setup-panel-3">
                                    <div class="steps-step-3 card-block ">
                                        <a href="#step-1 " type="button " class="btn steps-icon rounded-icons btn-info btn-circle-3 waves-effect ml-0 text-muted completed-step-1 " data-toggle="tooltip " data-placement="top " title="Basic Information "><i
                                                class="fa fa-user " aria-hidden="true "></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="row steps-form-3 ">
                                <div class="col-md-8 setup-panel-3">
                                    <div class="steps-step-2 ">
                                        <p class="step-text text-right ">Delivery Details<span class="text-muted ">
                                                Personal Info</span>
                                    </div>
                                </div>
                                <div class="col-md-4 steps-row-3 setup-panel-3">
                                    <div class="steps-step-3 card-block ">
                                        <a href="#step-2 " type="button " class="btn steps-icon rounded-icons btn-pink btn-circle-3 waves-effect p-3 card-block completed-step-2" data-toggle="tooltip " data-placement="top " title="Basic Information "><i
                                                class="fa fa-map-marker " aria-hidden="true "></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="row steps-form-3 ">
                                <div class="col-md-8 setup-panel-3">
                                    <div class="steps-step-3 ">
                                        <p class="step-text text-right ">Requirements<span class="text-muted "> Personal
                                                Info</span></p>
                                    </div>
                                </div>
                                <div class="col-md-4 steps-row-3 setup-panel-3">
                                    <div class="steps-step-3 ">
                                        <a href="#step-3 " type="button " class="btn steps-icon rounded-icons btn-pink btn-circle-3 waves-effect step-todo completed-step-3" data-toggle="tooltip " data-placement="top " title="Basic Information "><i
                                                class="fa fa-list " aria-hidden="true "></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="row steps-form-3 ">
                                <div class="col-md-8 setup-panel-3">
                                    <div class="steps-step-4 ">
                                        <p class="step-text text-right">Instructions<span class="text-muted ">
                                                Personal Info</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 steps-row-3 setup-panel-3">
                                    <div class="steps-step-3 ">
                                        <a href="#step-4 " type="button " class="btn steps-icon rounded-icons btn-pink btn-circle-3 waves-effect p-3 step-todo completed-step-4" data-toggle="tooltip " data-placement="top " title="Basic Information "><i
                                                class="fa fa-comments " aria-hidden="true "></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="row steps-form-3 ">
                                <div class="col-md-8 setup-panel-3">
                                    <div class="steps-step-5 color-purple">
                                        <p class="step-text text-right ">Estimation Cost<span class="text-muted ">
                                                Personal Info</span>
                                    </div>
                                </div>
                                <div class="col-md-4 steps-row-3 setup-panel-3">
                                    <div class="steps-step-3 ">
                                        <a href="#step-5 " type="button " class="btn steps-icon rounded-icons btn-pink btn-circle-3 turntheme waves-effect p-3 step-todo completed-step-5" data-toggle="tooltip " data-placement="top " title="Basic Information "><i
                                                class="fa fa-tag " aria-hidden="true "></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="row steps-form-3 ">
                                <div class="col-md-8 setup-panel-3">
                                    <div class="steps-step-6">
                                        <p class="step-text text-right ">Place Request<span class="text-muted ">
                                                Personal
                                                Info</span></p>
                                    </div>
                                </div>
                                <div class="col-md-4 steps-row-3 setup-panel-3">
                                    <div class="steps-step-3 ">
                                        <a href="#step-6 " type="button " class="btn steps-icon rounded-icons btn-pink btn-circle-3 waves-effect p-3 step-todo completed-step-6" data-toggle="tooltip " data-placement="top " title="Basic Information "><i
                                                class="fa fa-thumbs-up " aria-hidden="true "></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 book-move-questions-container ">
                                <div class="row setup-content-3 step-estimate" id="step-5">
                                    <div class="col-md-12">
                                        <div>
                                            <p class="text-muted">Step 5 / 6</p>
                                            <h5 class="border-bottom theme-text pb-4 text-view-center">Price Estimation</h5>
                                        </div>
                                        <form class="form-new-order  input-text-blue" action="{{route('order_estimate')}}" method="PUT" data-next="redirect" data-redirect-type="hard" data-url="{{route('place-booking', ['id'=>$booking->public_enquiry_id])}}" data-alert="mega"  data-parsley-validate>
                                            <div class="p-0  border-top-2 order-cards select-date">
                                                <div class="d-flex justify-content-center f-14  text-center  mt-2 mb-1">
                                                    Please note that this is the baseline price, you will be receiving the <br>Vendor bid list with the final quotations
                                                </div>
                                                <input type="hidden" name="public_booking_id" value="{{$booking->public_booking_id}}">
                                               {{-- <div class="d-flex flex-row flex-view-col justify-content-around f-14 theme-text text-center  quotation mb-3">
                                                    <div class="flex-column justify-content-center test">
                                                        <div class="card m-20  card-price eco cursor-pointer">
                                                            <div class="p-60 f-22 border-cicle eco-card">
                                                                <div>
                                                                    <div class="f-22">₹{{json_decode($booking->quote_estimate, true)['economic']}}</div>
                                                                    <div class="f-16 ">Base price</div>
                                                                </div>
                                                            </div>
                                                            <div class="p-eco f-18"> Economy
                                                                <p class="italic f-12 ">Economy Service include moving only
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="radio-group">
                                                            <div class="form-input radio-item" >
                                                                <input type="radio" id="economy" value="economic" name="service_type" class="radio-button__input cursor-pointer" required>
                                                                <label class="" for="economy" style="cursor: pointer;"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="felx-column">
                                                        <div class="card m-20 card-price pre  cursor-pointer ">
                                                            <div class="p-60 f-22  border-cicle pre-card  ">
                                                                <div class="f-22">₹{{json_decode($booking->quote_estimate, true)['premium']}}</div>
                                                                <div class="f-16 p-1">Base price</div>
                                                            </div>
                                                            <div class=" f-18"> Premium
                                                                <p class="italic f-12 ">Premium Service include Packing
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="radio-group">
                                                            <div class="form-input radio-item" >
                                                                <input type="radio" id="premium" value="premium" name="service_type" class="radio-button__input " required>
                                                                <label class="" for="premium" style="cursor: pointer;"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>--}}

                                                <div class="d-flex justify-content-center f-14 mt-2 mb-3 cursor-pointer">
                                                    <div class="row col-sm-10 move-add-date est-box move-dates">
                                                        <input type="radio" id="economy" value="economic" name="service_type" class="card-input-element moving-dates" required>
                                                        <div class="col-3" style="padding: 0 !important;">
                                                            <img src="{{ asset('static/website/images/images/Group 14563.svg')}}" class="blue-img" style="height: 80%; padding: 5%;">
                                                            <img src="{{ asset('static/website/images/images/Group 14563_white.svg')}}" class="white-img hidden" style="height: 80%; padding: 5%;">
                                                        </div>
                                                        <div class="col-8">
                                                            <label class="d-flex" style="margin-bottom: 0; margin-top: .5rem">ECONOMY<i class="icon-estimate fa fa-info" aria-hidden="true"></i></label>
                                                            <div class="f-22">₹{{json_decode($booking->quote_estimate, true)['economic']}}*<span style="font-size: 12px; font-weight: 700;">Base price</span></div>
                                                            <div><i>Economy services includes moving only</i></div>
                                                        </div>
                                                        <div class="col-1 status3  cursor-pointer est-select">
                                                            <i class="fa fa-angle-right" aria-hidden="true" style="font-size: 50px;"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-center f-14 mt-2 mb-3 cursor-pointer">
                                                    <div class="row col-sm-10 move-add-date est-box move-dates">
                                                        <input type="radio" id="premium" value="premium" name="service_type" class="card-input-element moving-dates" required>
                                                        <div class="col-3" style="padding: 0 !important;">
                                                            <img src="{{ asset('static/website/images/images/Group 14564.svg')}}" class="blue-img" style="height: 80%; padding: 5%;">
                                                            <img src="{{ asset('static/website/images/images/Group 14564_white.svg')}}" class="white-img hidden" style="height: 80%; padding: 5%;">
                                                        </div>
                                                        <div class="col-8">
                                                            <label class="d-flex" style="margin-bottom: 0; margin-top: .5rem">PREMIUM<i class="icon-estimate fa fa-info" aria-hidden="true"></i></label>
                                                            <div class="f-22">₹{{json_decode($booking->quote_estimate, true)['premium']}}*<span style="font-size: 12px; font-weight: 700;">Base price</span></div>
                                                            <div><i>Premium services includes packing and moving only</i></div>
                                                        </div>
                                                        <div class="col-1 status3 cursor-pointer est-select">
                                                            <i class="fa fa-angle-right" aria-hidden="true" style="font-size: 50px;"></i>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-center f-14 mt-2 mb-3 cursor-pointer" data-toggle="modal" data-target="#reject-modal">
                                                    <div class="row col-sm-10 est-box" >
                                                        <div class="col-11">
                                                            <label class="d-flex" style="margin-bottom: 0; margin-top: 1.5rem">NOT SATISFIED WITH THIS PRICES? </label>
                                                             <div class="text-muted"><i>Talk to our agent</i></div>
                                                        </div>
                                                        <div class="col-1" style="padding-top: 20px;">
                                                            <i class="fa fa-angle-right" aria-hidden="true" style="font-size: 50px;"></i>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="actionBtn-view border-top move-btn">
                                                <button class="btn btn-mdb-color mt-2 nextBtn-3 btn-rounded ml-4" style="float: right;">
                                                    PLACE ORDER
                                                </button>
                                            </div>

                                            {{--<div style="text-align: center; padding-bottom: 20px;">
                                               <a href="#" data-toggle="modal" data-target="#reject-modal">
                                                    <button class="btn btn-mdb-color mt-2 btn-rounded cancelBtn mr-4 " type="button ">
                                                        Reject
                                                    </button>
                                                </a>
                                                <button class="btn btn-mdb-color mt-2 nextBtn-3 btn-rounded ml-4">
                                                    Submit
                                                </button>
                                            </div>--}}

                                            <!-- <div class=" actionBtn actionBtn-view border-top ">
                                                <a href="{{route('home')}}">
                                                    <button class="btn btn-mdb-color mt-2 btn-rounded cancelBtn float-left ml-2 " type="button ">
                                                        Cancel
                                                    </button>
                                                </a>
                                                <button class="btn btn-mdb-color mt-2 btn-rounded nextBtn-3 float-right">
                                                    Next
                                                </button>
                                            </div> -->
                                        </form>
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
                           <form action="{{route('add_cancel_ticket')}}" method="POST" data-next="redirect" data-url="{{route('my-bookings')}}" data-alert="mega" class="form-new-order mt-3 input-text-blue" data-parsley-validate >
                              <div class="col-12">
                                   <div class="form-input">
                                       <input class="hidden" name="public_booking_id" value="{{$booking->public_booking_id}}">
                                              <select id="" class="form-control" name="heading">
                                                  <option value="">--Select--</option>
                                                 @foreach($reasons as $reason)
                                                      <option value="{{$reason}}">{{$reason}}</option>
                                                  @endforeach
                                              </select>
                                       <span class="error-message">Please enter valid Phone number</span>
                                   </div>
                              </div>
                               <div class="col-12">
                                   <div class="form-input">
                                       <textarea class="form-control" rows="3" name="desc" placeholder="Description..."> </textarea>
                                   </div>
                               </div>
                               <div class="col-12 d-flex center mt-2 mb-2">
                                   <div class="form-groups">
                                       <label class="container-01 p-1 pl-6 m-0">
                                              <input type="checkbox" id="Lift1" name="request_callback" value="true"/>
                                              <span class="checkmark-agree -mt-10"></span>
                                       </label>
                                   </div>
                                   <p class="text-muted f-10" style="padding-left: 20px;">Talk to our agend</p>
                               </div>
                               <button type="submit" class="btn btn-theme-bg button-modal ml-5 text-view-center mt-2 padding-btn-res white-bg">
                                                    Reject Booking
                                   <a class="white-text" href="#"></a>
                               </button>
                           </form>
                      </div>
                 </div>
            </div>
        </div>
    </div>
@endsection
