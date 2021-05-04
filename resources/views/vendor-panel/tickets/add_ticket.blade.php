@extends('vendor-panel.layouts.frame')
@section('title') Tickets @endsection
@section('body')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="addticket">
        <div class="d-flex  flex-row justify-content-between vertical-center">
            <h3 class="page-head text-left p-4 f-20 theme-text">Service Request</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Service Request</li>
                        <li class="breadcrumb-item">Create Request</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-lg-10">
                <div class="card h-auto p-0 pt-10">
                    <div class="card-head right text-left  p-10 pt-20 pb-0">
                        <h3 class="f-18 mb-4 theme-text">
                                Create Service
                        </h3>
                    </div>
                    <form class="form-new-order pt-4 mt-3 onboard-vendor-branch input-text-blue" action="{{route('api.ticket.addticket')}}" data-next="redirect" data-url="{{route('vendor.service_request')}}" data-alert="mega" method="{{"POST"}}" data-parsley-validate>
                        <div class="d-flex pa-20 row p-10">
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name"> Category </label>
                                    <select id="ban-type" class="form-control br-5" name="category" required>
                                            <option value="">--select--</option>
                                            @foreach(\App\Enums\TicketEnums::$TYPE as $type=>$key)
                                                @if($key !== 2 && $key !==3)
                                                    <option value="{{$key}}">{{ucwords($type)}}</option>
                                                @endif
                                            @endforeach
                                    </select>
                                    <span class="error-message">Please enter a valid banner type</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Title</label>
                                    <input type="text" id="fullname"
                                                       placeholder="Item not packed"
                                                       class="form-control" name="heading" required>
                                    <span class="error-message">Please enter valid
                                                    Zone</span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group theme-text">
                                    <label class="pt-4">Description</label>
                                    <textarea class="form-control  br-5" id="testim-description" name="desc" rows="3" required>                                                     </textarea>
                                    <span class="error-message">Please enter valid
                                                Description</span>
                                </div>
                            </div>
                        </div>
                        <div id="comments">
                            <div class="d-flex justify-content-between flex-row p-10 py-0">
                                <div class="w-50">

                                </div>
                                <div class="w-50 text-right">
                                    <a class="white-text p-10"><button class="btn theme-bg br-5 white-text w-30">
                                                Submit
                                        </button></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
