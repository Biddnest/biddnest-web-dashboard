<div class="modal-header pb-0 border-none">
    <div class="theme-text heading f-18">
                <a class="nav-link active pl-4 p-15" id="new-order-tab">Coupon Details</a>
    </div>

    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close"
            onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');" style="padding: 1.5rem !important; margin-top: 0px;">
        <i class="fa fa-times theme-text" aria-hidden="true"></i>
    </button>
</div>
<div class="modal-body border-top">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active margin-topneg-15" id="customer" role="tabpanel" aria-labelledby="new-order-tab">
            <!-- form starts -->
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Coupons Code
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="theme-text f-14">
                        {{$coupons->code}}
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="theme-text f-14">
                        <a href="{{route('edit-coupons', ["id"=>$coupons->id])}}"><i class="icon dripicons-pencil p-1 cursor-pointer "  aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Coupon Name
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 d-flex justify-content-between">
                        {{$coupons->name}}
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Coupon Type
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        @foreach(\App\Enums\CouponEnums::$COUPON_TYPE as $key=>$type)
                            @if($type == $coupons->coupon_type)
                                {{ucfirst(trans($key))}}
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Coupon Usage
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        <div class="d-flex vertical-center">
                            {{$coupons->usage}}
                            <div class="progress  ">
                                <div class="progress-bar bg-progress" role="progressbar" style="width: 30%" aria-valuenow="{{$coupons->usage}}" aria-valuemin="0" aria-valuemax="{{$coupons->max_usage}}"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Coupon Description
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        {{$coupons->desc}}
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Zone
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        @if(\App\Enums\CouponEnums::$ZONE_SCOPE['custom'] == $coupons->zone_scope)
                            @foreach($coupons->zones as $zone)
                                {{ucfirst(trans($zone->name))}}
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10 border-top-pop">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Coupon List
                    </div>
                </div>
            </div>
            <table class="table text-center p-10 theme-text">
                <thead class="secondg-bg  p-0">
                    <tr>
                        <th scope="col">Coupon</th>
                        <th scope="col">Order ID</th>
                        <th scope="col">Order Date</th>
                    </tr>
                </thead>
                <tbody class="mtop-20">
                    @foreach($coupons->payment as $payment)
                        <tr class="tb-border  cursor-pointer">
                            <th scope="row">{{$payment->coupon_code}}</th>
                            <td class="text-center">{{json_decode($payment->meta, true)['public_booking_id']}}</td>
                            <td class="">{{date('d M y', strtotime($payment->created_at))}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
