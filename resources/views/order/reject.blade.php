@extends('layouts.app')
@section('title') Orders And Bookings @endsection
@section('content')



    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="rejectorders">
        <div class="d-flex  flex-row justify-content-between">
            <h3 class="page-head text-left p-4">Reject Order</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left p-4 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('orders-booking')}}">Booking & Orders</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Reject Order</li>
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
                                    <a class="nav-link p-15 disabled" id="new-order-tab">Create New Order</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link p-15 active" id="quotation" data-toggle="tab" href="#past" role="tab"
                                       aria-controls="profile" aria-selected="false">Quotations</a>
                                </li>
                            </ul>
                        </h3>
                    </div>
                    <div class="tab-content  margin-topneg-15" id="myTabContent">
                        <div class="tab-pane fade show active pt-20  border-top" id="past" role="tabpanel" aria-labelledby="past-tab">
                            <form class="quation-form">
                                <!-- Resaosn for rejaction -->
                                <div class="d-flex  justify-content-center">
                                    <div class="w-50  f-14 theme-text text-left  rejection-message">
                                        <div ><h4 class="heading">Reason For Rejection</h4></div>
                                        <div class="form-input">
                                <textarea  placeholder="Need to Include bike" id="" class="form-control" rows="4" cols="50">
                                </textarea>
                                            <span class="error-message">Please enter  valid</span>
                                        </div>
                                    </div>
                                </div>

                            </form>
                            <!-- Buttons -->
                            <div class="d-flex justify-content-between flex-row p-8">
                                <div class="w-50"> <a class=" p-1 reject" href="{{route('confirm-order')}}"><button class="btn theme-br theme-text w-30 white-bg" id="backbtn">Back</button></a></div>
                                <div class="w-50 text-right">
                                    <a class="white-text p-1 reject" href="#"><button class="btn theme-bg white-text w-30 reject-btn">Submit</button> </a>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
