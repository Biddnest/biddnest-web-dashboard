@extends('layouts.app')
@section('title') Complaints @endsection
@section('content')

    <!-- Main Content -->
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="createcomplaints">
        <div class="d-flex  flex-row justify-content-between">
            <h3 class="page-head text-left p-4 theme-text">Create Ticket</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left p-4 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Review & Ratings</li>
                        <li class="breadcrumb-item"><a href="{{route('complaints')}}">Complaint</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create New Complaint</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Dashboard cards -->


        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-sm-10">
                <div class="card  h-auto p-0 pt-10 ">
                    <div class="card-head right text-left border-bottom-2 p-10 pt-20">
                        <h3 class="f-18 theme-text ml-2  pl-1">
                            Create Complaint
                        </h3>
                    </div>
                    <form action="{{route('complaint_add')}}" method="POST" data-next="redirect" data-redirect-type="hard" data-url="{{route('complaints')}}" data-alert="mega" class="form-new-order pt-4 mt-3" data-parsley-validate >
                        <div class="d-flex  row pl-4 pr-4 p-20">
                            <div class="col-sm-6">
                                <div class="form-input">
                                    <label class="coupon-name">Enter Order ID</label>
                                    <span class="">
                                        <select name="public_booking_id" class="form-control searchorder single order-search" data-action="id" name="order_id">
                                        </select>
                                        <span class="error-message">Please enter  valid </span>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-input">
                                    <label class="email-label">Customer Name</label>
                                    <span class="autofill">
                                        <input type="text" placeholder="User name" id="E-mail" class="form-control autofill-name hidden">
                                        <input type="hidden" name="user_id" class="form-control autofill-id">
                                        <select name="search_user_id" class="form-control searchuser single autofill-select" data-action="id" name="order_id">
                                        </select>
                                        <span class="error-message">Please enter  valid Email</span>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-input">
                                    <label class="coupon-code">Title</label>
                                    <span class="">
                                        <input type="text" placeholder="Title" name="heading" id="coupon-code" class="form-control" required>
                                        <span class="error-message">Please enter  valid </span>
                                    </span>
                                </div>
                            </div>

                            {{--<div class="col-sm-6">
                                <div class="form-input">
                                    <label>Date of Movement </label>
                                    <span class="">
                                        <input type="text" class="form-control br-5" required="required" placeholder="15/02/2021"/>
                                        <span class="error-message">Please enter  valid</span>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-input">
                                    <label class="coupon-id">Driver Name</label>
                                    <span class="">
                                        <input type="text" placeholder="Rakesh" id="coupon-id" class="form-control">
                                        <span class="error-message">Please enter  valid </span>
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-input">
                                    <label class="coupon-id">Vehicle Details</label>
                                    <span class="">
                                        <input type="text" placeholder="C123456" id="coupon-id" class="form-control">
                                        <span class="error-message">Please enter  valid </span>
                                    </span>
                                </div>
                            </div>--}}

                            <div class="col-sm-6">
                                <div class="form-input">
                                    <label>Category</label>
                                    <span class="">
                                        <select  class="form-control" name="category" required>
                                            <option value="">--Select--</option>
                                            @foreach(array_slice(\App\Enums\TicketEnums::$TYPE, 0, 5) as $type=>$type_key)
                                                <option value="{{$type_key}}">{{ucwords($type)}}</option>
                                            @endforeach
                                        </select>
                                        <span class="error-message">Please enter  valid</span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-input">
                                    <label>Status</label>
                                    <span class="">
                                        <select class="form-control" name="status" required>
                                            <option value="">--Select--</option>
                                            @foreach(App\Enums\TicketEnums::$STATUS as $status=>$key)
                                                <option value="{{$key}}">{{ucwords($status)}}</option>
                                            @endforeach
                                        </select>
                                        <span class="error-message">Please enter  valid</span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-input">
                                    <label>Description</label>
                                    <span class="">
                                        <textarea class="form-control" name="desc" rows="3" placeholder="Add Discription"></textarea>
                                        <span class="error-message">Please enter  valid</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex  justify-content-between flex-row  p-10 border-top ">
                            <div class="w-50">
                                <a class="white-text p-10" href="{{route('complaints')}}">
                                    <button type="button" class="btn theme-br theme-text w-30 white-bg ml-1">Cancel</button>
                                </a>
                            </div>
                            <div class="w-50 text-right">
                                <a class="white-text p-10">
                                    <button class="btn theme-bg white-text w-30">Save</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
