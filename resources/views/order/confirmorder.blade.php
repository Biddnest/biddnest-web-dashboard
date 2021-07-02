@extends('layouts.app')
@section('title') Orders And Bookings @endsection
@section('content')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="confirmorders">
        <div class="d-flex  flex-row justify-content-between">
            <h3 class="page-head text-left p-4">Confirm Order</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left p-4 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('orders-booking')}}">Booking & Orders</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Confirm Order</li>
                    </ol>
                </nav>
            </div>

        </div>

        <div class="d-flex  flex-row text-left ml-120">
            <!-- <a href="booking-orders.html" class="text-decoration-none">
           <h3 class="page-subhead text-left p-4 f-20 theme-text">
            <i class="p-1"> <img src="assets/images/Icon feather-chevrons-left.svg" alt="" srcset=""></i> Back to Bookings & Orders</h3></a> -->

        </div>
        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-sm-10">
                <div class="card  h-auto p-0 pt-10 ">
                    <div class="card-head right text-left  p-8">
                        <h3 class="f-18">
                            <ul class="nav nav-tabs pt-10 p-0" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link p-15 disabled"  href="#">Create New Order</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active p-15" id="quotation" data-toggle="tab" href="#past" role="tab"
                                       aria-controls="profile" aria-selected="false">Quotations</a>
                                </li>
                            </ul>
                        </h3>
                    </div>
                    <div class="tab-content  margin-topneg-15" id="myTabContent">
                        <div class="tab-pane fade show active  pt-20  border-top" id="past" role="tabpanel" aria-labelledby="past-tab">
                            <form class="form-new-order pt-4 mt-3 input-text-blue" action="{{route('order_confirm')}}" method="PUT" data-next="redirect" data-url="{{route('enquiry-booking')}}" data-alert="mega" id="myForm" data-parsley-validate  autocomplete="off">
                                <input type="hidden" name="id" value="{{$booking->user_id}}">
                                <input type="hidden" name="public_booking_id" value="{{$booking->public_booking_id}}">
                                <div class="p-0  border-top-2 order-cards">
                                    <div class="d-flex justify-content-center f-14 theme-text text-center ">
                                        Please note that this is the baseline price, you will be receiving the <br>Vendor bid list with the final quotations
                                    </div>
                                    <div class="d-flex flex-row justify-content-around f-14 theme-text text-center p-10 quotation">
                                        <div class="flex-column justify-content-center test">
                                            <div class="card m-20  card-price eco cursor-pointer"  >
                                                <div class="p-60 f-22 border-cicle eco-card" >
                                                    <div>₹{{json_decode($booking->quote_estimate, true)['economic']}}</div>
                                                    <div class="f-14 ">Base price</div>
                                                </div>
                                                <div class="p-10 f-18">  Economy</div>
                                            </div>
                                            <div class="radio-group">
                                                <div class="form-input radio-item ">
                                                    <input type="radio" id="economy" value="economic" name="service_type" class="radio-button__input cursor-pointer">
                                                    <label class="" for="economy"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="felx-column">
                                            <div class="card m-20 card-price pre  cursor-pointer ">
                                                <div class="p-60 f-32  border-cicle pre-card  " >
                                                    <div>₹{{json_decode($booking->quote_estimate, true)['premium']}}</div>
                                                    <div class="f-14 p-1">Base price</div>
                                                </div>
                                                <div class="p-10 f-18">  Premium</div>
                                            </div>
                                            <div class="radio-group">
                                                <div class="form-input radio-item ">
                                                    <input type="radio" id="premium" value="premium" name="service_type" class="radio-button__input ">
                                                    <label class="" for="premium"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- Buttons -->
                            <div class="d-flex justify-content-between flex-row p-8">
                                <div class="w-50">
                                </div>
                                <div class="w-50 text-right">
                                    <a class="white-text p-1 " href="{{route('reject-order', ['id'=>$booking->id])}}"><button type="button" class="btn w-30  reject btn theme-br white-bg">REJECT</button> </a>
                                    <a class="white-text p-1 reject" href="#"><button class="btn theme-bg white-text w-30 reject-btn">Accept</button> </a>
                                </div>
                            </div>
                            </form>
                        </div>
                        <!--  -->
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
