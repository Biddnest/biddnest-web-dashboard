<div class="modal-header">
    <div class="theme-text heading f-18">
        <a class="nav-link active pl-4 p-15" id="new-order-tab">Vendor Payout</a>
    </div>
    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
        <!-- <span aria-hidden="true" >&times;</span> -->
        <i class="fa fa-times theme-text" aria-hidden="true"></i>
    </button>
</div>
<div class="modal-body">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active margin-topneg-15" id="customer" role="tabpanel" aria-labelledby="new-order-tab">
            <!-- form starts -->
            <div class="d-flex  row  p-10">

                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Payment ID
                    </div>

                </div>
                <div class="col-sm-5">
                    <div class="theme-text f-14">
                        {{$payout->public_payout_id}}
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="theme-text f-14">
                        <a href="{{route('edit-payout', ['id'=>$payout->id])}}"><i class="icon dripicons-pencil p-1 cursor-pointer" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Vendor Name
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 d-flex justify-content-between">
                        {{ucfirst(trans($payout->organization->org_name))}} {{$payout->organization->org_type}}
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Payout Date
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        {{date('d M Y h:i A', strtotime($payout->dispatch_at))}}
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">

                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Commission Rate
                    </div>

                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        <div class="d-flex vertical-center">
                            {{$payout->commission_percentage}}%
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Amount
                    </div>

                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        ₹ {{$payout->final_payout}}
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Description
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        {{$payout->remarks}}
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-10 border-top-pop">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        List of Orders
                    </div>
                </div>
            </div>
            <table class="table text-center p-10 theme-text">
                <thead class="secondg-bg  p-0">
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Amount</th>
                </tr>
                </thead>
                <tbody class="mtop-20">
                    @foreach($payout->organization->booking as $booking)
                        <tr class="tb-border  cursor-pointer">
                            <th scope="row">{{$booking->public_booking_id}}</th>
                            <td class="text-center">{{date('d M Y', strtotime($booking->created_at))}}</td>
                            <td class="">₹{{$booking->final_quote}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if(count($payout->organization->booking)== 0)
                <div class="row hide-on-data">
                    <div class="col-md-12 text-center p-20">
                        <p class="font14"><i>. There is no records.</i></p>
                    </div>
                </div>
            @endif
           {{-- <div class="d-flex   justify-content-center p-10">
                <div class="">
                    <a class="white-text p-10" href="{{route('payout-details')}}"><button
                                            class="btn theme-bg white-text">View More</button></a></div>

            </div>--}}
        </div>
    </div>
</div>
