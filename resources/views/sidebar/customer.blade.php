<div class="modal-header pb-0 border-none">
    <h3 class="f-14">
        <ul class="nav nav-tabs pt-20 p-0" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active pb-3" id="new-order-tab" data-toggle="tab" href="#vendor" role="tab" aria-controls="home" aria-selected="true">Users Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link pb-3" id="quotation" data-toggle="tab" href="#customer" role="tab" aria-controls="profile" aria-selected="false">Users Insights</a>
            </li>
        </ul>
    </h3>
    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
        <i class="fa fa-times theme-text" aria-hidden="true"></i>
    </button>
</div>
<div class="modal-body border-top margin-topneg-7">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="vendor" role="tabpanel" aria-labelledby="past-tab">
            <div class="row d-flex  pb-4 pl-3">
                <div class="col-lg-12 ">
                    <div class="profile-section">
                        <figure>
                            <img src="@if($users->avatar){{$users->avatar}}@endif" alt="" style="width: 50%;">
                        </figure>
                        <div class="profile-details-side-pop">
                            <ul>
                                <li style="padding-bottom: 5px;">
                                    <h1>{{$users->fname}} {{$users->lname}}</h1>
                                    <a href="{{route('edit-customers', ['id'=>$users->id])}}"><i class="fa fa-pencil pr-1 mr-1 " style="color: #3BA3FB;" aria-hidden="true"></i></a>
                                </li>
                                <li style="padding-bottom: 5px;">
                                    <h2>{{$users->email}}</h2>
                                </li>
                                <li>
                                    <p>+91-{{$users->phone}}</p>

                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row d-flex pb-4 pl-3">
                                <div class="col-lg-6 align-items-center">
                                    <h1 class="side-popup-heading">Date of Birth</h1>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                                    <h1 class="side-popup-content">{{date('d/m/Y', strtotime($users->dob))}}</h1>
                                </div>
                            </div>
                            <div class="row d-flex pb-4 pl-3">
                                <div class="col-lg-6 align-items-center">
                                    <h1 class="side-popup-heading">Gender</h1>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                                    <h1 class="side-popup-content">{{ucfirst(trans($users->gender))}}</h1>
                                </div>
                            </div>
                            {{--<div class="row d-flex pb-4 pl-3">
                                <div class="col-lg-6 align-items-center">
                                    <h1 class="side-popup-heading">Zone</h1>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                                    <h1 class="side-popup-content">Bengaluru Urban</h1>
                                </div>
                            </div>--}}
                            <div class="row d-flex pb-4 pl-3">
                                <div class="col-lg-6 align-items-center">
                                    <h1 class="side-popup-heading">No of Orders</h1>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                                    <h1 class="side-popup-content">{{$count_orders}}</h1>
                                </div>
                            </div>
                            @if(empty($status_orders))
                                <div class="row d-flex pb-4 pl-3">
                                    <div class="col-lg-6 align-items-center">
                                        <h1 class="side-popup-heading">Status</h1>
                                    </div>

                                    <div class="col-lg-6 d-flex justify-content-between align-items-center">
                                        @foreach(\App\Enums\BookingEnums::$STATUS as $status=>$val)
                                            @if($status_orders[0] == $val)
                                                <div class="status-badge">{{ucfirst(trans($status))}}</div>
                                            @endif
                                        @endforeach
                                    </div>

                                </div>
                            @endif

                            <div class="d-flex justify-content-center p-20">
                                <!-- <div class="">
                                    <a class="white-text p-10" href="#">
                                        <button class="btn theme-bg white-text my-0" style="width: 127px;
                                        border-radius: 6px;">View More</button>
                                    </a>
                                </div> -->
                            </div>

                        </div>
                        <div class="tab-pane fade  margin-topneg-15" id="customer" role="tabpanel"
                            aria-labelledby="new-order-tab">
                            <!-- form starts -->
                            <div class="d-flex row pt-3 p-20">
                                <div class="col-lg-6">
                                    <div class="theme-text f-14 bold">
                                        List of Orders
                                    </div>
                                </div>
                            </div>
                            <table class="table text-center p-10 theme-text th-no-border">
                                <thead class="secondg-bg p-0" >
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Order Date</th>
                                </tr>
                                </thead>
                                <tbody class="mtop-20">
                                @if($users->bookings)
                                    @foreach($users->bookings as $booking)
                                        <tr class="cursor-pointer">
                                            <td scope="row">
                                                <p style="text-decoration: underline;margin: 0;">{{$booking->public_booking_id}}</p>
                                            </td>
                                            <td class="">
                                                @foreach(\App\Enums\BookingEnums::$STATUS as $status=>$val)
                                                    @if($booking->status == $val)
                                                        <div class="status-badge">{{ucfirst(trans($status))}}</div>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center">{{date('d m Y', strtotime($booking->created_at))}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            @if(count($users->bookings)== 0)
                                <div class="row hide-on-data">
                                    <div class="col-md-12 text-center p-20">
                                        <p class="font14"><i>. This Customer don't have any orders.</i></p>
                                    </div>
                                </div>
                            @endif
                            <div class="d-flex row pt-3 p-20">
                                <div class="col-lg-6">
                                    <div class="theme-text f-14 bold">
                                        List of Coupons
                                    </div>
                                </div>
                            </div>
                            <table class="table text-center p-10 theme-text th-no-border">
                                <thead class="secondg-bg p-0" >
                                <tr>
                                    <th scope="col">Coupon Code</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Order Date</th>

                                </tr>
                                </thead>
                                <tbody class="mtop-20">
                                    @if($users->bookings)
                                        @foreach($users->bookings as $coupon)
                                            @if($coupon->payment && $coupon->payment->coupon_code)
                                                <tr class="cursor-pointer">
                                                    <td scope="row">
                                                        <p style="text-decoration: underline;margin: 0;">{{$coupon->payment->coupon_code}}</p>
                                                    </td>
                                                    <td class="">
                                                        @if($coupon->payment->coupon->discount_type == \App\Enums\CouponEnums::$DISCOUNT_TYPE['percentage'])
                                                            {{$coupon->payment->coupon->discount_amount}}%
                                                        @else
                                                            &#x20B9;{{$coupon->payment->coupon->discount_amount}}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{date('d m Y', strtotime($coupon->payment->created_at))}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if(count($users->bookings)== 0)
                                <div class="row hide-on-data">
                                    <div class="col-md-12 text-center p-20">
                                        <p class="font14"><i>. This Customer don't have used any Coupons.</i></p>
                                    </div>
                                </div>
                            @endif
                            <div class="d-flex   justify-content-center p-20">

                                <!-- <div class=""><a class="white-text p-10" href="#">
                                    <button class="btn theme-bg white-text my-0" style="width: 127px;
                                    border-radius: 6px;">View More</button>
                                        </a></div> -->




                            </div>
                        </div>


                        <!--  -->
                    </div>
                </div>
