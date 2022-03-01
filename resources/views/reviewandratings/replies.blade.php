
@extends('layouts.app')
@section('title') Tickets @endsection
@section('content')


    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="reply">
        <div class="d-flex  flex-row justify-content-between">
            <h3 class="page-head theme-text text-left p-4 f-20">
                @foreach(\App\Enums\TicketEnums::$TYPE as $type=>$key)
                    @if($tickets && ($tickets->type == $key))
                        {{ucfirst(trans(str_replace('_', ' ',$type)))}}
                    @endif
                @endforeach
            </h3>

        </div>

        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
            <div class="col-lg-12">
                <div class="card  h-auto p-0 pt-10">
                    <div class="row no-gutters" style="margin-top: 5px;">
                        <div class="col-sm-8 p-3 ">
                            <h3 class="f-18 pl-8 title">
                                Ticket ID #{{$tickets->id}}
                            </h3 >
                        </div>
                    </div>
                    <div class="card testimonials-card" style="border-radius: 5px !important; margin-left: 30px; margin-right: 30px;">
                        <div class="d-flex  flex-row justify-content-between">
                            <h3 class="page-head theme-text text-left ml-4" style="font-size: 16px !important; margin-top: 5px !important; margin-bottom: 0px !important;">{{$tickets->heading}}</h3>
                            <div class="mr-20">
                                    @switch($tickets->status)
                                        @case(\App\Enums\TicketEnums::$STATUS['open'])
                                        <span class="status-badge green-bg text-black-50 text-center">Open</span>
                                        @break

                                        @case(\App\Enums\TicketEnums::$STATUS['rejected'])
                                        <span class="status-badge red-bg text-black-50 text-center">Rejected</span>
                                        @break

                                        @case(\App\Enums\TicketEnums::$STATUS['resolved'])
                                        <span class="status-badge green-bg text-black-50 text-center">Resolved</span>
                                        @break

                                        @case(\App\Enums\TicketEnums::$STATUS['closed'])
                                        <span class="status-badge red-bg text-black-50 text-center">Closed</span>
                                        @break
                                    @endswitch
                            </div>
                        </div>
                        <div class="d-flex  flex-row justify-content-between" style="margin-top: 10px; margin-left: 15px;">
                            <h4 class="name" style="font-size: 16px !important; margin-top: 5px !important; margin-bottom: 0px !important; font-weight: 600 !important;">{{$tickets->desc}}</h4>
                            @if($tickets->type == \App\Enums\TicketEnums::$TYPE['new_branch'] || $tickets->type == \App\Enums\TicketEnums::$TYPE['price_update'])
                                <div class="mr-20">
                                    @switch($service)
                                        @case(\App\Enums\CommonEnums::$TICKET_STATUS['open'])
                                        <span class="status-badge red-bg text-black-50 text-center">Open</span>
                                        @break

                                        @case(\App\Enums\CommonEnums::$TICKET_STATUS['approve'])
                                        <span class="status-badge green-bg text-black-50 text-center">Approved</span>
                                        @break

                                        @case(\App\Enums\CommonEnums::$TICKET_STATUS['modify'])
                                        <span class="status-badge red-bg text-black-50 text-center">Modify</span>
                                        @break
                                    @endswitch
                                </div>
                            @endif
                        </div>

                    </div>
                    <div class="row" style="margin-left: 30px; margin-right: 0px;">
                        <div class="card testimonials-card bootstrap snippets bootdey col-md-6" style="border-radius: 5px !important; margin-left: 0px; margin-right: 30px;">
                            <div class="chat" style="overflow: hidden; outline: none; overflow-y: scroll;" tabindex="5001">
                                <div class="col-inside-lg decor-default">
                                    <div class="chat-body">
                                        @foreach($replies as $reply)
                                            @if(!$reply->admin_id)
                                                <div class="answer left">
                                                    <div class="avatar">
                                                        <img src="@if($reply->vendor_id){{$reply->vendor->image}}@else{{$reply->user->avatar}}@endif" alt="Avatar">
                                                    </div>
                                                    <div class="text" style="padding-bottom: 5px;">
                                                        <div class="name">@if($reply->vendor_id){{$reply->vendor->fname}} {{$reply->vendor->lname}}@else{{$reply->user->fname}} {{$reply->user->lname}}@endif</div>
                                                        <div class="text time" style="padding-left: 0px;"> {{\Carbon\Carbon::parse($reply->created_at)->diffForHumans()}}</div>
                                                        {!! $reply->chat !!}
                                                    </div>
                                                </div>
                                            @else
                                                <div class="answer right">
                                                    <div class="avatar">
                                                        <img src="{{$reply->admin->image}}" alt="Avatar">
                                                    </div>
                                                    <div class="text" style="padding-bottom: 5px;">
                                                        <div class="name">{{$reply->admin->fname}} {{$reply->admin->lname}}</div>
                                                        <div class="white-text time" style="padding-right: 0px;"> {{\Carbon\Carbon::parse($reply->created_at)->diffForHumans()}}</div>
                                                        {!! $reply->chat !!}
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        @if(count($replies) == 0)
                                                <div class="row hide-on-data">
                                                    <div class="col-md-12 text-center p-20">
                                                        <p class="font14"><i>No Replies.</i></p>
                                                    </div>
                                                </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card testimonials-card bootstrap snippets bootdey col-md-5" style="border-radius: 5px !important; float: right; margin-right: 0px;">
                            <div class="card-head right text-left  ">
                                <h3 class="f-18 mt-0 border-bottom">
                                    <ul class="nav nav-tabs pt-10 p-0" id="myTab" role="tablist">
                                        @if($ticket_info)
                                            <li class="nav-item">
                                                <a class="nav-link active " id="new-order-tab" data-toggle="tab" href="#info" role="tab"
                                                   aria-controls="home" aria-selected="true">Info</a>
                                            </li>
                                        @endif
                                        <li class="nav-item">
                                            <a class="nav-link @if(!$ticket_info) active @endif " id="new-order-tab" data-toggle="tab" href="#order" role="tab"
                                               aria-controls="home" aria-selected="true">Add Reply</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " id="quotation" data-toggle="tab" href="#past" role="tab"
                                               aria-controls="home" aria-selected="false">Action</a>
                                        </li>
                                    </ul>
                                </h3>
                            </div>
                            <div class="  tab-content  flex-row justify-content-between">
                                @if($ticket_info)
                                    <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="new-order-tab">
                                        <div class="col-sm-12" style="margin-top: 20px; margin: 0px !important; padding: 0px !important;">
                                            @if($tickets->type == \App\Enums\TicketEnums::$TYPE['order_reschedule'] || $tickets->type == \App\Enums\TicketEnums::$TYPE['order_cancellation'] || $tickets->type == \App\Enums\TicketEnums::$TYPE['call_back'] || $tickets->type == \App\Enums\TicketEnums::$TYPE['complaint'])
                                                <div class="col-sm-5 secondg-bg margin-topneg-15 pt-10">
                                                    @if(json_decode($tickets->meta, true)['public_booking_id'])
                                                        @if($ticket_info->public_booking_id)
                                                            <div class="theme-text f-14 bold p-15 pl-0" style="padding-top: 5px;">
                                                                Order ID
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if($tickets->user_id)
                                                        <div class="theme-text f-14 bold p-15 pl-0" style="padding-top: 5px;">
                                                            User
                                                        </div>
                                                    @elseif($tickets->vendor_id)
                                                        <div class="theme-text f-14 bold p-15 pl-0" style="padding-top: 5px;">
                                                            Vendor
                                                        </div>
                                                    @endif
                                                    @if(json_decode($tickets->meta, true)['public_booking_id'])
                                                        @if($ticket_info->organization)
                                                            <div class="theme-text f-14 bold p-15 pl-0" style="padding-top: 5px;">
                                                                Vendor
                                                            </div>
                                                        @endif
                                                    @endif
                                                    {{--<div class="theme-text f-14 bold p-15 pl-0" style="padding-top: 5px;">
                                                        Status
                                                    </div>--}}
                                                </div>
                                                <div class="col-sm-7 white-bg  margin-topneg-15 pt-10">
                                                    @if(json_decode($tickets->meta, true)['public_booking_id'])
                                                        @if($ticket_info->public_booking_id)
                                                            <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                                                <a href="#" class="cursor-pointer invsidebar a-underline" data-sidebar="{{ route('sidebar.booking',['id'=>$ticket_info->id]) }}">
                                                                    @if($ticket_info->status > \App\Enums\BookingEnums::$STATUS['payment_pending'])
                                                                        {{$ticket_info->public_booking_id}}
                                                                    @else
                                                                        {{$ticket_info->public_enquiry_id}}
                                                                    @endif
                                                                </a>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    @if($tickets->user)
                                                        <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                                            <a href="#" class="cursor-pointer invsidebar a-underline" data-sidebar="{{ route('sidebar.customer',['id'=>$tickets->user->id]) }}">
                                                                    {{$tickets->user->fname}} {{$tickets->user->lname}}
                                                            </a>
                                                        </div>
                                                    @elseif($tickets->vendor)
                                                            <a href="#" class="cursor-pointer invsidebar a-underline" data-sidebar="{{ route('sidebar.vendors',['id'=>json_decode($tickets->vendor, true)['organization_id']])}}">
                                                                {{json_decode($tickets->vendor, true)['fname']}} {{json_decode($tickets->vendor, true)['lname']}}
                                                            </a>
                                                    @endif
                                                    @if(json_decode($tickets->meta, true)['public_booking_id'])
                                                        @if($ticket_info->organization)
                                                            <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                                                @if($ticket_info->id)
                                                                <a href="#" class="cursor-pointer invsidebar a-underline" data-sidebar="{{ route('sidebar.vendors',['id'=>$ticket_info->id]) }}">
                                                                        {{$ticket_info->organization->org_name}}
                                                                </a>
                                                                @else
                                                                    Not Assigned Yet
                                                                @endif
                                                            </div>
                                                        @endif
                                                    @endif
                                                    <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                                       @if($tickets->type == \App\Enums\TicketEnums::$TYPE['order_reschedule'])
                                                            <input type="text" id="movement_dates" name="movement_dates" class="form-control br-5 filterdate dateselect" required="required" placeholder="15 Jan"  />
                                                            <span class="error-message">please enter valid date</span>

                                                            <a class="white-text reschedule" href="#" data-url="{{route('web.reschedule-order', ['id'=>$ticket_info->public_booking_id])}}">
                                                                <button class="btn theme-bg white-text w-100">Reschedule</button>
                                                            </a>
                                                        @endif
                                                        @if($tickets->type == \App\Enums\TicketEnums::$TYPE['order_cancellation'])
                                                            <a class="white-text" href="{{route('order-details-cancel', ['id'=>$ticket_info->id])}}">
                                                                <button class="btn theme-bg white-text w-100">Cancel</button>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            @elseif($tickets->type == \App\Enums\TicketEnums::$TYPE['new_branch'])
                                                <div class="col-sm-5 secondg-bg margin-topneg-15 pt-10">
                                                    <div class="theme-text f-14 bold p-15 pl-0" style="padding-top: 5px;">
                                                        Org Name
                                                    </div>
                                                    <div class="theme-text f-14 bold p-15 pl-0" style="padding-top: 5px;">
                                                        Branch Name
                                                    </div>
                                                </div>
                                                <div class="col-sm-7 white-bg  margin-topneg-15 pt-10">
                                                    <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                                        <a href="#" class="cursor-pointer invsidebar a-underline" data-sidebar="{{ route('sidebar.vendors',['id'=>$ticket_info->parent_org_id]) }}">{{$ticket_info->org_name}} {{$ticket_info->org_type}}</a>
                                                    </div>
                                                    <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                                        <a href="#" class="cursor-pointer invsidebar a-underline" data-sidebar="{{ route('sidebar.branch',['id'=>$ticket_info->parent_org_id]) }}">{{$ticket_info->city}}</a>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 " style="margin-right: 20px; margin-top: 10px;">
                                                    <div class="form-input">
                                                        <form method="PUT" action="{{route('change_Branchticket_status', ['id'=>$ticket_info->id])}}" data-next="refresh" data-parsley-validate>
                                                        <label>Approval Status</label>
                                                            <select id="status" name="status" class="form-control" required>
                                                                @foreach(\App\Enums\CommonEnums::$TICKET_STATUS as $key=>$status)
                                                                    <option id="reply" value="{{$status}}" @if($ticket_info->ticket_status==$status) Selected @endif >{{ucwords(str_replace("_", " ", $key))}}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="error-message">Please enter valid</span>

                                                            <a class="white-text" href="#">
                                                                <button class="btn theme-bg white-text w-100">Submit</button>
                                                            </a>
                                                        </form>
                                                    </div>
                                                </div>
                                            @elseif($tickets->type == \App\Enums\TicketEnums::$TYPE['price_update'])
                                                <div class="col-sm-5 secondg-bg margin-topneg-15 pt-10">
                                                    <div class="theme-text f-14 bold p-15 pl-0" style="padding-top: 5px;">
                                                        Org Name
                                                    </div>
                                                    <div class="theme-text f-14 bold p-15 pl-0" style="padding-top: 5px;">
                                                        Service Type
                                                    </div>
                                                    <div class="theme-text f-14 bold p-15 pl-0" style="padding-top: 5px;">
                                                        Inventory Item Name
                                                    </div>
                                                </div>
                                                <div class="col-sm-7 white-bg  margin-topneg-15 pt-10">
                                                    <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                                        <a href="#" class="cursor-pointer invsidebar a-underline" data-sidebar="{{ route('sidebar.vendors',['id'=>$ticket_info->organization_id]) }}">{{$ticket_info->organization->org_name}} {{$ticket_info->org_type}}</a>
                                                    </div>
                                                    <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                                        {{$ticket_info->service->name}}
                                                    </div>
                                                    <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                                        <a href="#" class="cursor-pointer invsidebar a-underline" data-sidebar="{{ route('sidebar.inventory',['id'=>$ticket_info->inventory_id, 'org_id'=>$ticket_info->organization_id, 'cat_id'=>$ticket_info->service_type]) }}">{{$ticket_info->inventory->name}}</a>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 " style="margin-right: 20px; margin-top: 10px;">
                                                    <div class="form-input">
                                                        <form method="PUT" action="{{route('change_priceticket_status', ['id'=>$ticket_info->inventory_id, 'org_id'=>$ticket_info->organization_id, 'cat_id'=>$ticket_info->service_type])}}" data-next="refresh" data-parsley-validate>
                                                            <label>Aproval Status</label>

                                                            <select id="status" name="status" class="form-control" required>
                                                                @foreach(\App\Enums\CommonEnums::$TICKET_STATUS as $key=>$status)
                                                                    <option id="reply" value="{{$status}}" @if($ticket_info->ticket_status==$status) Selected @endif >{{ucwords(str_replace("_", " ", $key))}}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="error-message">Please enter valid</span>

                                                            <a class="white-text" href="#">
                                                                <button class="btn theme-bg white-text w-100">Submit</button>
                                                            </a>
                                                        </form>
                                                    </div>
                                                </div>
                                            @elseif($tickets->type == \App\Enums\TicketEnums::$TYPE['service_request'])
                                                <div class="col-sm-5 secondg-bg margin-topneg-15 pt-10">
                                                    <div class="theme-text f-14 bold p-15 pl-0" style="padding-top: 5px;">
                                                        Vendor Name
                                                    </div>
                                                </div>
                                                <div class="col-sm-7 white-bg  margin-topneg-15 pt-10">
                                                    <div class="theme-text f-14 p-15" style="padding-top: 5px;">
                                                        <a href="#" class="cursor-pointer invsidebar a-underline" data-sidebar="{{ route('sidebar.vendors',['id'=>$ticket_info->id]) }}">
                                                            {{json_decode($ticket_info->meta, true)['auth_fname']}} {{json_decode($ticket_info->meta, true)['auth_lname']}}
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                    <div class="tab-pane fade @if(!$ticket_info) show active @endif " id="order" role="tabpanel" aria-labelledby="new-order-tab">
                                        @if($tickets->status == \App\Enums\CommonEnums::$TICKET_STATUS['open'])
                                      <form action="{{route('add_reply')}}" method="POST" data-next="redirect" data-redirect-type="hard" data-url="{{route('reply',['id'=>$tickets->id])}}" data-alert="tiny" class="create-coupon" id="myForm" data-parsley-validate style="width: 100%;">
                                            <div class="col-sm-12">
                                                <div class="form-input">
                                                    <input type="hidden" name="ticket_id" value="{{$tickets->id}}">
                                                    <textarea name="reply" class = "form-control editor" rows="2"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <button class="btn theme-bg white-text w-100" type="submit">ADD REPLY</button>
                                            </div>
                                        </form>

                                    @else
                                        <div class="tab-pane fade @if(!$ticket_info) show active @endif " id="order" role="tabpanel" aria-labelledby="new-order-tab">
                                            <p style="font-size: 14px;padding: 0 10px">This ticket no more open. You cannot add any more replies to this thread.</p>
                                        </div>
                                    @endif
                                        @if($tickets->image)
                                            <div class="col-sm-12"  style="margin-top: 20px; margin: 0px !important; padding: 0px !important;">
                                                <h4 class="text-center"><b>Pictures uploaded by the User</b></h4>
                                                <div class="row d-flex mr-2 justify-content-start  mt-2">
                                                    @foreach(json_decode($tickets->image, true) as $image)
                                                        <div class="col-sm-3">
                                                            <a href="{{$image}}" data-lightbox="image"><img src="{{$image}}" style="width: 100%;"></a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                <div class="tab-pane fade " id="past" role="tabpanel" aria-labelledby="quotation">
                                    <div class="col-sm-12 " style="margin-right: 20px; margin-top: 10px;">
                                        <div class="form-input">
                                        <label>Ticket Status</label>

                                            <select id="status" name="role" class="form-control reply_status" data-url="{{route('change_status', ['id'=>$tickets->id])}}" required>
                                                @foreach(\App\Enums\TicketEnums::$STATUS as $key=>$status)
                                                    <option id="reply" value="{{$status}}" @if($tickets && ($tickets->status==$status)) Selected @endif >{{ucwords($key)}}</option>
                                                @endforeach
                                            </select>
                                            <span class="error-message">Please enter valid</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
