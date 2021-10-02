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
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('vendor.service_request')}}">Service Request</a></li>
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
                        <h3 class="f-18 mb-4 ml-4 pl-1 theme-text">
                                Create Service
                        </h3>
                    </div>
                    <form class="form-new-order  onboard-vendor-branch input-text-blue" action="{{route('api.ticket.addticket')}}" data-next="redirect" data-url="{{route('vendor.service_request')}}" data-alert="mega" method="{{"POST"}}" data-parsley-validate>
                        <div class="d-flex pa-20 mr-1 ml-1 row p-10">

                            <div class="col-lg-6" style="padding-left: 0 !important;">
                                    <div class="form-input">
                                        <label class="full-name"> Choose Booking </label>
                                        <select id="ban-type" class="form-control br-5" name="public_booking_id" required>
                                            <option value="">--select--</option>
                                            @foreach($past_bookings as $booking)
                                                <option value="{{$booking->public_booking_id}}">{{ucwords(json_decode($booking->source_meta, true)['city'])}} - {{ucwords(json_decode($booking->destination_meta, true)['city'])}} [#{{$booking->public_booking_id}}]</option>
                                            @endforeach
                                        </select>
                                        <span class="error-message">Please enter a valid banner type</span>
                                    </div>
                            </div>
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
                            <div class="col-lg-6">
                                <label class="para-head">Upload Image</label>
                                <div class="row d-flex uploaded-image ml-2">
                                    <div class="col-md-2 pl-0 cursor-pointer">
                                        <input type="file" class="hidden custom-file-input upload-image" accept="image/*">
                                        <img src="https://cdn.iconscout.com/icon/premium/png-256-thumb/plus-square-1179806.png" onclick="$(this).parent().find('input').click();" alt="uploadedImage" class="image-upload-by-customer" style="width: 100%; height: 100%;"/>
                                    </div>
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
                                <div class="w-50 text-right mr-2">
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
        <script id="image_upload_preview" type="text/x-handlebars-template">
            <div class="col-md-2 pl-0 upload-image-container">
                <input type="hidden" id="custId" value="@{{image}}" name="images[]" >
                <img src="@{{image}}" alt="uploadedImage" class="image-upload-by-customer" style="width: 100%; height: 100%;"/>
                <i class="fa fa-close fa-2x" onclick="console.log('hello'); $(this).closest('.upload-image-container').fadeOut(100).remove()"></i>
            </div>
        </script>
    </div>
@endsection
