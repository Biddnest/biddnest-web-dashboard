@extends('layouts.app')
@section('title') Categories @endsection
@section('content')

<!-- Main Content -->
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createcategory">
  <div class="d-flex flex-row justify-content-between">
    <h3 class="heading1 p-4">Create Category</h3>
  </div>
  <!-- Dashboard cards -->
  <div class="d-flex  flex-row justify-content-between">
    <div class="page-head text-left p-5 pt-0 pb-0">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page"><a href="{{route('categories')}}">Categories</a>
          </li>
          <li class="breadcrumb-item">Create Categories</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="d-flex flex-row justify-content-center Dashboard-lcards">
    <div class="col-lg-10">
      <div class="card h-auto p-0 p-10">
        <div  class="card-head right text-left border-bottom-2 p-8">
          <h3 class="f-18 mb-4 theme-text">
              @if(!$category) Create Category @else Edit Category @endif
          </h3>
        </div>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active margin-topneg-15" id="order" role="tabpanel" aria-labelledby="new-order-tab">
                      <!-- form starts -->
            <form action="@if(!$category){{route('service_add')}}@else{{route('service_edit')}}@endif" method="@if(isset($category)){{"PUT"}}@else{{"POST"}}@endif" data-next="redirect" data-redirect-type="hard" data-url="{{route('categories')}}" data-alert="tiny" class="form-new-order pt-4 mt-3" id="newForm" data-parsley-validate >
                <div class="row">
                      @if($category)
                        <input type="hidden" name="id" value="{{$category->id}}">
                      @endif
                    <div class="col-lg-6">
                        <p class="img-label">Photo</p>
                        <div class="upload-section p-20 pb-2 pt-3">
                          <img class="upload-preview" src="@if(!$category){{asset('static/images/upload-image.svg')}}@else{{$category->image}}@endif" alt=""/>
                          <div class="ml-1">
                            <div class="file-upload">
                                <input type="hidden" class="base-holder" id="image" name="image" value="@if($category){{$category->image}}@endif" required/>
                                <button type="button" class="btn theme-bg white-text my-0" data-action="upload">
                                        UPLOAD IMAGE
                                </button>
                                <input type="file" accept=".png,.jpg,.jpeg" @if(!$category) required @endif/>

                            </div>
                            <p class="text-black">Max File size: 1MB</p>
                          </div>
                        </div>
                    </div>
                </div>

                <div class="row pt-0 p-20">
                    <div class="col-lg-6">
                        <div class="form-input">
                          <label class="full-name">Name</label>
                            <input name="name" type="text" id="banner_name" placeholder="Name" value="@if($category){{ucfirst(trans($category->name))}}@endif" class="form-control br-5" required/>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-input">
                            <label class="full-name">Quantity Type</label>
                            <select class="form-control br-5" name="inventory_quantity_type:number"  required>
                                        <option value="">--Select--</option>
                                        @foreach(\App\Enums\ServiceEnums::$INVENTORY_QUANTITY_TYPE as $key=>$type)
                                            <option value="{{$type}}" @if($category && $type == $category->inventory_quantity_type) selected @endif>{{ucfirst(trans($key))}}</option>
                                        @endforeach
                                    </select>
                            <span class="error-message">Please enter a valid banner type</span>
                        </div>
                    </div>
                </div>

                <div class="" id="comments">
                    <div class="d-flex justify-content-between flex-row p-10 py-0" style="border-top: 1px solid #70707040">
                        <div class="w-50">
                          <a class="white-text p-10 cancel" href="#">
                              <button type="button" class="btn theme-br theme-text w-30 white-bg br-5">
                                  Cancel
                              </button>
                          </a>
                        </div>
                        <div class="w-50 text-right">
                              <a class="white-text p-10">
                                  <button class="btn theme-bg white-text w-30 br-5">
                                      @if(!$category)
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
