@extends('layouts.app')
@section('title') Push Notifications @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="pushnotification">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4 f-20">Push Notification & Messages</h3>
        <div class="mr-20 create-notification">
            <button class="btn theme-bg white-text dropdown-toggle"><i class="fa fa-plus p-1" aria-hidden="true"></i> Create New </button>
            <div class="dropdown">
                <ul>
                    <li><a href="{{route('create-push-notification')}}">Push Notification</a></li>
{{--                        <li><a href="{{route('create-mail-notification')}}">Mail</a></li>--}}
                </ul>
            </div>
        </div>
    </div>
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head text-left  pt-0 pb-0 p-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Push Notification & Messages</li>
                    <li class="breadcrumb-item"><a href="#">Notifications</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
        <div class="col-sm-12">
            <div class="card  h-auto p-0 pt-10">
                <div class="d-flex flex-row justify-content-between p-10">
                    <div class=" card-head right text-left">
                        <h3 class="f-18 mt-0">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active p-15" id="live-tab" data-toggle="tab" href="#live" role="tab" aria-controls="home" aria-selected="true">Push Notifications</a>
                                </li>
                                {{--<li class="nav-item">
                                       <a class="nav-link p-15" id="past-tab" href="{{ route('mail-notification')}}" >Mails</a>
                                </li>--}}
                            </ul>
                        </h3>
                    </div>
                </div>
                <!-- Table -->

                <div class="tab-content margin-topneg-7" id="myTabContent">
                    <div class="tab-pane fade show active" id="live" role="tabpanel" aria-labelledby="live-tab">
                        <table class="table text-left p-0 theme-text mb-0 primary-table margin-topneg-35">
                            <thead class="secondg-bg text-left p-0">
                                <tr>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Vendor Name</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Desc</th>
{{--                                    <th scope="col">Operations</th>--}}
                                </tr>
                            </thead>
                            <tbody class="mtop-20 f-13">
                            @foreach($notifications as $notification)
                                <tr class="tb-border ">
                                    <td>@if($notification->user){{$notification->user->fname}} {{$notification->user->lname}}@endif</td>
                                    <td>@if($notification->vendor){{$notification->vendor->fname}} {{$notification->vendor->lname}}@endif</td>
                                    <td>{{$notification->title}}</td>
                                    <td>{{$notification->desc}}</td>
                                    {{--<td> <a href="edit-notification.html">
                                            <i class="icon dripicons-pencil p-1 mr-2" aria-hidden="true"></i>
                                        </a>
                                        <i class="icon dripicons-trash p-1" aria-hidden="true"></i>
                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if(count($notifications)== 0)
                            <div class="row hide-on-data">
                                <div class="col-md-12 text-center p-20">
                                    <p class="font14"><i>There is no any Notification created.</i></p>
                                </div>
                            </div>
                        @endif
                        <div class="pagination">
                            <ul>
                                <li class="p-1">Page</li>
                                <li class="digit">{{$notifications->currentPage()}}</li>
                                <li class="label">of</li>
                                <li class="digit">{{$notifications->lastPage()}}</li>
                                @if(!$notifications->onFirstPage())
                                    <li class="button"><a href="{{$notifications->previousPageUrl()}}"><img src="{{asset('static/images/Backward.svg')}}"></a>
                                    </li>
                                @endif
                                @if($notifications->currentPage() != $notifications->lastPage())
                                    <li class="button"><a href="{{$notifications->nextPageUrl()}}"><img src="{{asset('static/images/forward.svg')}}"></a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
