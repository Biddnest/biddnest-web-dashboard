
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
            <div class="col-sm-2 p-3 " style="margin-right: 20px;">
                <div class="form-input">
                    <select id="status" name="role" class="form-control reply_status" data-url="{{route('change_status', ['id'=>$tickets->id])}}" required>
                        @foreach(\App\Enums\TicketEnums::$STATUS as $key=>$status)
                            <option value="{{$status}}" @if($tickets && ($tickets->status==$status)) Selected @endif >{{ucwords($key)}}</option>
                        @endforeach
                    </select>
                    <span class="error-message">Please enter valid</span>
                </div>
            </div>
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
                            <h3 class="page-head theme-text text-left" style="font-size: 16px !important; margin-top: 5px !important; margin-bottom: 0px !important;">{{$tickets->heading}}</h3>
                            <div class="mr-20">
                                    @switch($tickets->status)
                                        @case(\App\Enums\TicketEnums::$STATUS['open'])
                                        <span class="status-badge green-bg white-text text-center">Open</span>
                                        @break

                                        @case(\App\Enums\TicketEnums::$STATUS['rejected'])
                                        <span class="status-badge red-bg white-text text-center">Rejected</span>
                                        @break

                                        @case(\App\Enums\TicketEnums::$STATUS['resolved'])
                                        <span class="status-badge green-bg white-text text-center">Resolved</span>
                                        @break

                                        @case(\App\Enums\TicketEnums::$STATUS['closed'])
                                        <span class="status-badge red-bg white-text text-center">Closed</span>
                                        @break
                                    @endswitch
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h4 class="name" style="font-size: 16px !important; margin-top: 5px !important; margin-bottom: 0px !important; font-weight: 600 !important;">{{$tickets->desc}}</h4>
                        </div>
                    </div>
                    <div class="card testimonials-card bootstrap snippets bootdey" style="border-radius: 5px !important; margin-left: 30px; margin-right: 30px;">
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
                                                    <div class="text time" style="padding-left: 0px;"> {{\Carbon\Carbon::now()->diffForHumans($reply->created_at)}}</div>
                                                    {{$reply->chat}}
                                                </div>
                                            </div>
                                        @else
                                            <div class="answer right">
                                                <div class="avatar">
                                                    <img src="{{$reply->admin->image}}" alt="Avatar">
                                                </div>
                                                <div class="text" style="padding-bottom: 5px;">
                                                    <div class="name">{{$reply->admin->fname}} {{$reply->admin->lname}}</div>
                                                    <div class="white-text time" style="padding-right: 0px;"> {{\Carbon\Carbon::now()->diffForHumans($reply->created_at)}}</div>
                                                    {{$reply->chat}}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex  flex-row justify-content-between">
                            <form action="{{route('add_reply')}}" method="POST" data-next="redirect" data-redirect-type="hard" data-url="{{route('reply',['id'=>$tickets->id])}}" data-alert="tiny" class="create-coupon" id="myForm" data-parsley-validate style="width: 100%;">
                                <div class="col-sm-10">
                                    <div class="form-input">
                                        <input type="hidden" name="ticket_id" value="{{$tickets->id}}">
                                        <textarea name="reply" class = "form-control" rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn theme-bg white-text w-100" type="submit">ADD REPLY</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
