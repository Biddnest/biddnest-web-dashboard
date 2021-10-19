@extends('layouts.app')
@section('title') General Pages Settings @endsection
@section('content')

    <!-- Main Content -->
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="faq">
        <div class="d-flex flex-row justify-content-between">
            <h3 class="heading1 p-4">Add FAQ</h3>
        </div>
        <!-- Dashboard cards -->
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left p-5 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">General Settings
                        </li>
                        <li class="breadcrumb-item"><a href="#">Create</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-center Dashboard-lcards">
            <div class="col-lg-10">
                <div class="card h-auto p-0 p-10">
                    <div  class="card-head right text-left border-bottom-2 p-8">
                        <h3 class="f-18 mb-4 theme-text">
                            Add FAQ
                        </h3>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active margin-topneg-15" id="order" role="tabpanel" aria-labelledby="new-order-tab">
                            <!-- form starts -->
                            <form action="@if($faq){{route('faq_edit')}}@else{{route('faq_add')}}@endif" method="@if($faq){{"PUT"}}@else{{"POST"}}@endif" data-next="redirect" data-redirect-type="hard" data-url="{{route('admin.faq')}}" data-alert="tiny" class="form-new-order pt-4 mt-3" id="newForm" data-parsley-validate >
                                @if($faq)
                                    <input type="hidden" name="id" value="{{$faq->id}}">
                                @endif
                                <div class="row p-20">
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Categorys</label>
                                            <select class="form-control br-5 inventory-select" name="category" required>
                                                <option value="">--Select--</option>
                                                @foreach(\App\Enums\FaqEnums::$TYPE as $category)
                                                    <option value="{{$category}}" @if($faq && $faq->category)  selected @endif>{{$category}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-input">
                                            <label class="full-name">Question</label>
                                            <input name="ques" type="text" id="banner_name" value="@if($faq && $faq->title){{$faq->title}}@endif" placeholder="Question" class="form-control br-5" required/>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-input">
                                            <label class="full-name">Answer</label>
                                            <textarea id="" class = "form-control" rows = "5" name="answer" placeholder ="Write Answer" required>@if($faq && $faq->desc){{$faq->desc}}@endif</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="" id="comments">
                                    <div class="d-flex justify-content-between flex-row p-10 py-0" style="border-top: 1px solid #70707040">
                                        <div class="w-50">
                                        </div>
                                        <div class="w-50 text-right">
                                            <a class="white-text p-10">
                                                <button class="btn theme-bg white-text w-30 br-5 text-center" style="padding: 10px 10px !important;">
                                                    @if($faq) UPDATE @else ADD @endif
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
