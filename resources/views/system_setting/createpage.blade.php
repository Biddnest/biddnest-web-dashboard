@extends('layouts.app')
@section('title') General Pages Settings @endsection
@section('content')

    <!-- Main Content -->
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="createpages">
        <div class="d-flex flex-row justify-content-between">
            <h3 class="heading1 p-4">@if(!$pages) Create @else Edit @endif Page</h3>
        </div>
        <!-- Dashboard cards -->
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left p-5 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{route('pages')}}">General Pages</a>
                        </li>
                        <li class="breadcrumb-item">@if(!$pages) Create @else Edit @endif</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="d-flex flex-row justify-content-center Dashboard-lcards">
            <div class="col-lg-10">
                <div class="card h-auto p-0 p-10">
                    <div  class="card-head right text-left border-bottom-2 p-8">
                        <h3 class="f-18 mb-4 theme-text">
                            @if(!$pages) Create @else Edit @endif Page
                        </h3>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active margin-topneg-15" id="order" role="tabpanel" aria-labelledby="new-order-tab">
                            <!-- form starts -->
                            <form action="@if(!$pages){{route('page_add')}}@else{{route('page_edit')}}@endif" method="@if(isset($pages)){{"PUT"}}@else{{"POST"}}@endif" data-next="redirect" data-redirect-type="hard" data-url="{{route('pages')}}" data-alert="tiny" class="form-new-order pt-4 mt-3" id="newForm" data-parsley-validate >
                                    @if($pages)
                                        <input type="hidden" name="id" value="{{$pages->id}}">
                                    @endif

                                <div class="row p-20">
                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Title</label>
                                            <input name="name" type="text" id="banner_name" placeholder="Name" value="@if($pages){{ucfirst(trans($pages->title))}}@endif" class="form-control br-5" required/>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-input">
                                            <label class="full-name">Slug</label>
                                            <input name="slug" type="text" id="banner_name" placeholder="Slug" value="@if($pages){{$pages->slug}}@endif" class="form-control br-5" required/>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-input">
                                            <label class="full-name">Content</label>
                                            <textarea id="" class = "form-control" rows = "5" name="contents" placeholder ="Write Description" required>@if($pages){{$pages->content}}@endif</textarea>
                                        </div>
                                    </div>


                                </div>

                                <div class="" id="comments">
                                    <div class="d-flex justify-content-between flex-row p-10 py-0" style="border-top: 1px solid #70707040">
                                        <div class="w-50">
                                            <a class="white-text p-10 cancel" href="{{route('dashboard')}}">
                                                <button type="button" class="btn theme-br theme-text w-30 white-bg br-5">
                                                    Cancel
                                                </button>
                                            </a>
                                        </div>
                                        <div class="w-50 text-right">
                                            <a class="white-text p-10">
                                                <button class="btn theme-bg white-text w-30 br-5">
                                                    @if(!$pages)
                                                        Save
                                                    @else
                                                        Update
                                                    @endif
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
