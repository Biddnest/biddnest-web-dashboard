<div class="modal-header">
    <div class="theme-text heading f-18">Review & Ratings</div>
    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close"
            onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
        <!-- <span aria-hidden="true" >&times;</span> -->
        <i class="fa fa-times theme-text" aria-hidden="true"></i>
    </button>
</div>
<div class="modal-body">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active margin-topneg-15" id="customer" role="tabpanel"
             aria-labelledby="new-order-tab">
            <!-- form starts -->
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Customer Name
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="theme-text f-14">
                        {{$reviews->user->fname}} {{$reviews->user->lname}}
                    </div>
                </div>

            </div>
            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Rating
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 d-flex justify-content-between">
                        @php $ratings = 0; @endphp
                        @foreach(json_decode($reviews->ratings, true) as $rating)
                            @php $ratings += $rating['rating']; @endphp
                        @endforeach
                        @php $ratings = number_format($ratings/count(json_decode($reviews->ratings, true)), 2); @endphp
                        @for($star=$ratings; $star > 0; $star--)
                            @if($star < 1)
                                <i class="fa fa-star-half-o checked bg-yellow" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-star checked bg-yellow" aria-hidden="true"></i>
                            @endif
                        @endfor
                        @php $blank_star = floor(5 - $ratings); @endphp

                        @for($star_o=$blank_star; $star_o >= 1; $star_o--)
                            <i class="fa fa-star-o bg-yellow" aria-hidden="true"></i>
                        @endfor
                    </div>
                </div>
            </div>
            @if($reviews->Booking)
                <div class="d-flex  row  p-10">
                    <div class="col-sm-6">
                        <div class="theme-text f-14 bold">
                            Publick Booking Id
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="theme-text f-14">
                            {{$reviews->Booking->public_booking_id}}
                        </div>
                    </div>
                </div>
            @endif

            <div class="d-flex  row  p-10">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Description
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 d-flex justify-content-between">
                        {{$reviews->desc}}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
