@extends('vendor-panel.layouts.frame')
@section('title') Order Details @endsection
@section('body')

    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="orderdetail">
        <div class="d-flex  flex-row justify-content-between vertical-center">
            <h3 class="page-head text-left p-4 f-20 theme-text">Order Details</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page" ><a href="manage-bookings.html"> Manage Bookings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-lg-10">
                <div class="card h-auto p-0 pt-20">
                    <div class="tab-pane fade  active show" id="order-status" role="tabpanel" aria-labelledby="order-status-tab">
                        <div class="p-15">
                            <div class="d-flex p-10">
                                <div class="steps-container mr-5 pr-5 justify-content-center">
                                    <hr class="dash-line" style="width:22% !important;margin-left: 10%;">
                                    <div class="steps-status " style="margin: 0px 130px;">
                                        <div class="step-dot">
                                            <div class="child-dot"></div>
                                        </div>
                                        <p class="f-16">Bidding</p>
                                    </div>
                                    <div class="steps-status ">
                                        <div class="step-dot bg-step">
                                        </div>
                                        <p class="f-16">My Quote</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-felx justify-content-center pt-4 border-top row">
                                <div class="bid-badge mr-4">
                                    <h4 class="step-title">₹ {{$booking->final_estimated_quote}}</h4>
                                    <p>Estimated Price</p>
                                </div>
                                <div class="bid-badge mr-4">
                                    <h4 class="step-title"><span class="text-center timer" data-time="{{$booking->bid_result_at}}" style="min-width: 0px !important;"></span></h4>
                                    <p>Time Left</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex  border-bottom pb-0">
                            <ul class="nav nav-tabs pt-20 p-0 f-18" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="new-order-tab" data-toggle="tab" href="#order-details" role="tab" aria-controls="home" aria-selected="true">Order Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="requirments-tab" data-toggle="tab" href="#requirements" role="tab" aria-controls="profile" aria-selected="false">Item List</a>
                                </li>
                            </ul>
                        </div>

                        <div class="d-flex">
                            <div class="tab-content w-100" id="myTabContent">
                                <div class="tab-pane fade active show" id="order-details" role="tabpanel" aria-labelledby="order-details-tab">
                                    <div class="d-flex  row pt-3 pr-4 pl-3 margin-topneg-15">
                                        <div class="col-sm-4  secondg-bg   pt-10">
                                            <div class="theme-text f-14 bold p-8">
                                                From
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                From Pincode
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                From Floor
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                To
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                To Pincode
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                To Floor
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                Distance
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                Type of Movement
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                Category
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                Order Price
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                Moving Date
                                            </div>
                                        </div>

                                        <div class="col-sm-5 white-bg  pt-10">
                                            <div class="theme-text f-14 p-8">
                                               {{json_decode($booking->source_meta, true)['address']}}
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{json_decode($booking->source_meta, true)['pincode']}}
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{json_decode($booking->source_meta, true)['floor']}} @if(json_decode($booking->source_meta, true)['lift']==\App\Enums\CommonEnums::$YES)(Lift: Yes) @else (Lift: Yes) @endif
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{json_decode($booking->destination_meta, true)['address']}}
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{json_decode($booking->destination_meta, true)['pincode']}}
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{json_decode($booking->destination_meta, true)['floor']}} @if(json_decode($booking->destination_meta, true)['lift']==\App\Enums\CommonEnums::$YES)(Lift: Yes) @else (Lift: Yes) @endif
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{json_decode($booking->meta, true)['distance']}} KM
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                @if(json_decode($booking->source_meta, true)['shared_service']== true)Dedicated @else Shared @endif
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                {{$booking->service->name}}
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                Rs. {{$booking->final_estimated_quote}}
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                @foreach($booking->movement_dates as $mdate)
                                                    <span class="status-3">{{date("d M Y", strtotime($mdate->date))}}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="requirements" role="tabpanel" aria-labelledby="requirments-tab">
                                    <div class="heading theme-text    p-10  row">
                                        <div class="col-sm-6 " style="margin:0px  !important">
                                            <div class="row ml-10 mt-2">Category:
                                                <div class="bold "> {{$booking->service->name}}</div> </div>
                                            <table class="table text-center  theme-text grey-br mtop-5 p-10">
                                                <thead class="secondg-bg  p-10 f-14">
                                                <tr>
                                                    <th scope="col">Item</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Size</th>
                                                </tr>
                                                </thead>
                                                <tbody class="mtop-15">
                                                    @foreach($booking->inventories as $inventory)
                                                        <tr class="tb-border  cursor-pointer">
                                                            <th scope="row">{{$inventory->name}}</th>
                                                            <td class="text-center">
                                                                @if($inventory->quantity_type == \App\Enums\CommonEnums::$YES)
                                                                    {{$inventory->quantity->min}}-{{$inventory->quantity->max}}
                                                                @else
                                                                    {{$inventory->quantity}}
                                                                @endif
                                                            </td>
                                                            <td class=""><span class=" text-center w-100  ">{{$inventory->size}}</span></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-6  mt-2 ">
                                            Pictures uploaded by the customer
                                            <div class="row d-felx mr-2 justify-content-start  mt-2">
                                                @foreach(json_decode($booking->meta, true)['images'] as $image)
                                                    <div class="col-sm-3">
                                                        <img src="{{$image}}" style="width: 100%;">
                                                    </div>
                                                @endforeach
                                                @if(count(json_decode($booking->meta, true)['images'])== 0)
                                                    <div class="row hide-on-data">
                                                            <div class="col-md-12 text-center p-20">
                                                                <p class="font14"><i>. You don't have any Images here.</i></p>
                                                            </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-top">
                                    <div class="d-flex pb-2 pt-1 justify-content-end button-section">
                                        @if($booking->bid->status != \App\Enums\BidEnums::$STATUS['bid_submitted'])
                                            <a href="#" class="bookings inline-icon-button" data-url="{{route('api.booking.bookmark', ['id'=>$booking->public_booking_id])}}" data-confirm="Do you want add this booking in Bookmarked?">
                                                <button class="btn theme-br theme-text  white-bg  justify-content-center">Quote Later</button>
                                            </a>
                                        @endif
                                        <a class="modal-toggle" data-target="#add-role">
                                            <button class="btn theme-br theme-text">Accept</button>
                                        </a>
                                        @if($booking->bid->status != \App\Enums\BidEnums::$STATUS['bid_submitted'])
                                            <a href="#" class="bookings inline-icon-button" data-url="{{route('api.booking.reject', ['id'=>$booking->public_booking_id])}}" data-confirm="Are you sure, you want reject this Booking? You won't be able to undo this.">
                                                <button class="btn">Reject</button>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="fullscreen-modal" id="add-role" style="min-height: 155%;">
        <div class="fullscreen-modal-body" role="document">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Your Bid</h5>
                <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-new-order pt-4 mt-3 onboard-vendor-branch input-text-blue" action="{{route('api.booking.bid')}}" data-next="redirect" data-url="{{route('vendor.my-quote',['id'=>$booking->public_booking_id])}}" data-alert="mega" method="POST" data-parsley-validate>
                <div class="modal-body" style="padding: 10px 9px;">
                    <div class="d-flex justify-content-center row ">
                        <div class="col-sm-12 bid-amount">
                            <div class="d-flex flex-row p-10 justify-content-between secondg-bg heading status-badge">
                                <div><p class="mt-2">Expected Price</p></div>
                                <div class="col-2">
                                    <input class="form-control border-purple" type="text" value="{{$booking->final_estimated_quote}}" placeholder="6000" readonly/>
                                    <input class="form-control border-purple" type="text" value="{{$booking->public_booking_id}}" name="public_booking_id" placeholder="6000" readonly/>
                                </div>
                            </div>
                            <div class="col-sm-12  p-0  pb-0" >
                                <div class="heading p-8 mtop-22">
                                    <p class="text-muted light">
                                        <span class="bold">Note:</span>
                                        you can modify the old price for individual item OR you can directly set a new Total Price
                                    </p>
                                </div>
                                <table class="table text-left theme-text tb-border2" id="items" >
                                    <thead class="secondg-bg bx-shadowg p-0 f-14">
                                        <tr class="">
                                            <th scope="col">Item Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Size</th>
                                            <th scope="col" style="width: 120px;">Old Price</th>
                                        </tr>
                                    </thead>
                                    <tbody class="mtop-20 f-13">
                                        @foreach($booking->inventories as $inventory)
                                            <tr class="">
                                                <th scope="row">{{$inventory->name}}</th>
                                                <td class="">
                                                    @if($inventory->quantity_type == \App\Enums\CommonEnums::$YES)
                                                        {{$inventory->quantity->min}}-{{$inventory->quantity->max}}
                                                    @else
                                                        {{$inventory->quantity}}
                                                    @endif
                                                </td>
                                                <td class="">{{$inventory->size}}</td>
                                                <td> <input class="form-control border-purple w-88" name="inventory[][booking_inventory_id]" value="{{$inventory->id}}" type="text" placeholder="2000"/>
                                                    <input class="form-control border-purple w-88" name="inventory[][amount]" type="text" placeholder="2000"/>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr id='addr1'></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex mtop-22 mb-4 flex-row p-10 justify-content-between secondg-bg status-badge heading">
                                <div><p class="mt-2">Total Price</p></div>
                                <div class="col-2">
                                    <input class="form-control border-purple" value="{{$booking->final_estimated_quote}}" type="number" name="bid_amount" placeholder="4000" />
                                </div>
                            </div>
                        </div>

                        <div class ="col-sm-12 bid-amount-2">
                            <div class="d-flex flex-row p-10 justify-content-between secondg-bg heading status-badge">
                                <div><p class="mt-2">Expected Price</p></div>
                                <div class="col-2">
                                    <input class="form-control border-purple" type="text" value="{{$booking->final_estimated_quote}}" placeholder="6000" readonly/>
                                </div>
                            </div>
                            <div class="d-flex row p-10">
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Type of Movement</label>
                                            <select id="" class="form-control" name="type_of_movement" required>
                                                <option value="">--select--</option>
                                                @if(json_decode($booking->source_meta, true)['shared_service']== true)
                                                    <option value="dedicated">Dedicated</option>
                                                @else
                                                    <option value="shared">Shared</option>
                                                    <option value="dedicated">Dedicated</option>
                                                @endif
                                            </select>
                                        <span class="error-message"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Moving Date</label>
                                        <div>
                                            @foreach($booking->movement_dates as $mdate)
                                                <span class="status-3">{{date("d M Y", strtotime($mdate->date))}}</span>
                                            @endforeach
                                        </div>
                                        <input type="text" class="form-control br-5 filterdate" name="moving_date" id="date" data-selecteddate="{{$booking->movement_dates}}" required placeholder="15/02/2021">
                                        <span class="error-message">Please enter valid</span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Minimum and  Maximum Number Of Man Power</label>
                                        <div class="d-felx justify-content-between">
                                            <div class="d-flex range-input-group justify-content-between flex-row">
                                                <input type="text" class="custom_slider custom_slider_1 range" name="man_power"  data-min="0" data-max="5" data-from="0" data-to="5" data-type="double" data-step="1" />
                                            </div>
                                        </div>
                                        <span class="error-message">Please enter valid </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-input">
                                       <label class="full-name">Name of Vehicle</label>
                                       <select id="" class="form-control" name="vehicle_type">
                                            <option value="">--select--</option>
                                            @foreach($vehicles as $vehicle)
                                               <option value="{{$vehicle->vehicle_type}}">{{$vehicle->name}}-{{$vehicle->vehicle_type}}</option>
                                           @endforeach
                                       </select>
                                        <span class="error-message"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 enter-pin p-60">
                            <div class="form-input">
                                <h4 class="text-center bold">Enter Your Pin</h4>
                                <input class="form-control" name="pin" type="number" maxlength="4" minlength="4" required/>
                                <span class="error-message">Please enter valid OTP</span>
                            </div>
                            <div class="text-center">
                                <span class="text-center">Forgot Pin?</span><a class="link-regular" href="#"> Reset</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer p-15 ">
                    <div class="w-50">
                    </div>
                    <div class="w-50 text-right"><a class="white-text p-10" href="#"><button
                           type="button" class="btn theme-bg white-text w-30 " id="next-btn-1" style="margin-bottom: 20px;">Next</button>
                            <button type="button"
                                class="btn theme-bg white-text w-30 " id="next-btn-2" style="margin-bottom: 20px;">Next</button>
                            <button
                                class="btn theme-bg white-text w-30 " id="submitbtn" style="margin-bottom: 20px;">Submit</button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
