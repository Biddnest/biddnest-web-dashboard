@extends('layouts.app')
@section('title') General Pages Settings @endsection
@section('content')

    <!-- Main Content -->
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="createpages">
        <div class="d-flex flex-row justify-content-between">
            <h3 class="heading1 p-4">Contact Us Page</h3>
        </div>
        <!-- Dashboard cards -->
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left p-5 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">General Settings
                        </li>
                        <li class="breadcrumb-item"><a href="#">Contact Us</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-center Dashboard-lcards">
            <div class="col-lg-10">
                <div class="card h-auto p-0 p-10">
                    <div  class="card-head right text-left border-bottom-2 p-8">
                        <h3 class="f-18 mb-4 theme-text">
                            Contact Us Page
                        </h3>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active margin-topneg-15" id="order" role="tabpanel" aria-labelledby="new-order-tab">
                            <!-- form starts -->
                            <form action="{{route('contact_add')}}" method="POST" data-next="redirect" data-redirect-type="hard" data-url="{{route('contact_us')}}" data-alert="tiny" class="form-new-order pt-4 mt-3" id="newForm" data-parsley-validate >
                                 <div class="row p-20">
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Contact No</label>
                                            <select class="form-control select-box2" name="phone[]" multiple required>
                                                @if($contact_us && $contact_us['contact_no'])
                                                    @foreach($contact_us['contact_no'] as $phone)
                                                        <option value="{{$phone}}" selected>{{$phone}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Email</label>
                                            <select class="form-control select-box2" name="email[]" multiple required>
                                                @if($contact_us && $contact_us['email_id'])
                                                    @foreach($contact_us['email_id'] as $email)
                                                        <option value="{{$email}}" selected>{{$email}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-input">
                                            <label class="full-name">Address</label>
                                            <textarea id="" class = "form-control" rows = "5" name="address" placeholder ="Write Description" required>@if($contact_us){{$contact_us['address']}}@endif</textarea>
                                        </div>
                                    </div>


                                </div>

                                <div class="" id="comments">
                                    <div class="d-flex justify-content-between flex-row p-10 py-0" style="border-top: 1px solid #70707040">
                                        <div class="w-50">

                                        </div>
                                        <div class="w-50 text-right">
                                            <a class="white-text p-10">
                                                <button class="btn theme-bg white-text w-30 br-5">
                                                        Update
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
