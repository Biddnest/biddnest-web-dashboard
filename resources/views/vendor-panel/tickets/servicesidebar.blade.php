<div class="modal-header pb-0 border-none">
    <h3 class="f-18 mt-0 pt-0 p-10">
        Service Request Details
    </h3>
    <button type="button" class="close  theme-text margin-topneg-10" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
        <!-- <span aria-hidden="true" >&times;</span> -->
        <i class="fa fa-times theme-text" aria-hidden="true"></i>
    </button>
</div>
<div class="modal-body border-top margin-topneg-7">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active " id="details" role="tabpanel"
             aria-labelledby="zone-tab" style="margin-bottom: 50px;">
            <!-- form starts -->
            <div class="d-flex  row  p-8">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Service ID
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 d-flex justify-content-between">
                        {{$ticket->id}}
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-8 pt-0">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Category
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        <div class="status-badge red-bg">
                            @foreach(\App\Enums\TicketEnums::$TYPE as $type=>$key)
                                @if($ticket->type == $key)
                                    {{ucwords($type)}}
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex  row  p-8">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Title
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14 d-flex justify-content-between">
                        {{$ticket->heading}}
                    </div>
                </div>
            </div>

            <div class="d-flex  row  p-8">
                <div class="col-sm-6">
                    <div class="theme-text f-14 bold">
                        Description
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="theme-text f-14">
                        <div class="d-flex vertical-center">
                            {{$ticket->desc}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="  p-15 border-top">
                <div class=" row ">
                    <div class="col-sm-12  p-8">
                        <div class="theme-text f-14 bold">
                            Replies
                        </div>
                    </div>
                    @foreach($replies as $reply)
                        @if(!$reply->admin_id)
                            <div class="col-sm-7 p-8">
                                <div class="theme-text f-14 bold" style="float: right">
                                    <div>@if($reply->vendor_id){{$reply->vendor->fname}} {{$reply->vendor->lname}}@endif</div>
                                    <span class="text-muted">{{\Carbon\Carbon::now()->diffForHumans($reply->created_at)}}</span>
                                    <p class="p-1">{!! $reply->chat !!}</p>
                                </div>


                            </div>
                            <div class="col-sm-3 p-8">
                                <div class="theme-text f-14 bold">
                                    <img src="@if($reply->vendor_id){{$reply->vendor->image}}@else{{$reply->user->avatar}}@endif" alt="" srcset="" style="border-radius: 50px">
                                </div>
                            </div>
                        @else
                            <div class="col-sm-3 p-8">
                                <div class="theme-text f-14 bold">
                                    <img src="{{$reply->admin->image}}" alt="" srcset="" style="border-radius: 50px">
                                </div>
                            </div>
                            <div class="col-sm-7 p-8">
                                <div class="theme-text f-14 bold">
                                    <div>{{$reply->admin->fname}} {{$reply->admin->lname}}</div>
                                    <span class="text-muted">{{\Carbon\Carbon::now()->diffForHumans($reply->created_at)}}</span>
                                    <p class="p-1">{!! $reply->chat !!}</p>
                                </div>

                            </div>
                        @endif
                    @endforeach

                    <div class="col-sm-12">
                        <form action="{{route('api.ticket.addreply')}}" method="POST" data-next="refresh" data-alert="tiny" class="form-new-order pt-4 mt-3 input-text-blue" id="myForm" data-parsley-validate>
                            <div class="form-input">
                                <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                                    <textarea type="text" id="fullname" name="reply"
                                              placeholder="Chandigarh"
                                              class="form-control" rows="3" required> </textarea>
                                <button class="btn-1 btn white-bg float-right mt-1 " style="position:absolute; top: 66px; right: 27px;">Comment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="d-flex   justify-content-center p-10">
                <div class=""><a class="white-text p-10" href="{{route('vendor.service_sidebar.reply', ['id'=>$ticket->id])}}" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');"><button
                            class="btn theme-bg white-text">View More</button></a></div>
            </div>
        </div>
    </div>
</div>
