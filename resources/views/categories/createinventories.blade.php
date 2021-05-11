@extends('layouts.app')
@section('title') Inventory @endsection
@section('content')


<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createinventories">
    <div class="d-flex flex-row justify-content-between">
        <h3 class="page-head f-20 p-4">Categories & Subcategories</h3>
    </div>

    <!-- Dashboard cards -->
    <div class="d-flex  flex-row justify-content-between">
        <div class="page-head  p-1 mt-2 pb-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('categories')}}">Categories and Subcategories</a>
                    </li>
                    <li class="breadcrumb-item pl-2"><a href="#">@if(!$inventory)Create @else Edit @endif Inventory</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="d-flex flex-row justify-content-center Dashboard-lcards">
        <div class="col-sm-10">
            <div class="card h-auto p-0 p-10">
                <div class="card-head right text-left border-bottom-2 p-8">
                    <h3 class="f-18 mt-3 mb-3 pl-3 theme-text">
                        @if(!$inventory)Create @else Edit @endif Subcategory
                    </h3>
                </div>
                <div class="" id="">
                    <div
                      class="tab-pane fade show active margin-topneg-15"
                      id="order"
                      role="tabpanel"
                      aria-labelledby="new-order-tab"
                    >
                      <!-- form starts -->
                    <form action="@if(!$inventory){{route('inventories_add')}}@else{{route('inventories_edit')}}@endif" method="@if(!$inventory){{"POST"}}@else{{"PUT"}}@endif" data-next="redirect" data-redirect-type="hard" data-url="{{route('inventories')}}" data-alert="tiny"
                        class="form-new-order pt-4 mt-3" id="newForm" data-parsley-validate >
                        <div class="d-flex row pt-3">
                            @if($inventory)
                                <input type="hidden" name="id" value="{{$inventory->id}}">
                            @endif
                            <div class="col-lg-6">
                                <p class="img-label">Photo</p>
                                    <div class="upload-section  pt-0" style="padding-left: 20px;">
                                    <img class="upload-preview"
                                                src="@if(!$inventory){{asset('static/images/upload-image.svg')}}@else{{$inventory->image}}@endif"
                                                alt=""
                                            />
                                    <div class="ml-1">
                                        <div class="file-upload">
                                        <input type="hidden" class="base-holder" name="image" value="@if($inventory){{$inventory->image}}@endif" required />
                                                <button type="button" class="btn theme-bg white-text my-0" data-action="upload">
                                                    UPLOAD IMAGE
                                                </button>
                                            <input type="file" required/>
                                        </div>
                                        <p class="text-black pl-2">Max File size: 1MB</p>
                                    </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <p class="img-label pl-3">Icon</p>
                                    <div class="upload-section  pt-0" style="margin: 0px 0px 0px -10px !important; padding-left:20px"  >
                                        <img class="upload-preview"
                                                src="@if(!$inventory){{asset('static/images/upload-image.svg')}}@else{{$inventory->icon}}@endif"
                                                alt=""
                                            />
                                        <div class="ml-1">
                                            <div class="file-upload">
                                                <input type="file" />
                                                <input type="hidden" class="base-holder" name="icon" value="@if($inventory){{$inventory->icon}}@endif" required />
                                                    <button type="button" class="btn theme-bg white-text my-0" data-action="upload">
                                                        UPLOAD IMAGE
                                                    </button>
                                            </div>
                                            <p class="text-black pl-2">Max File size: 1MB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex row pl-4 pr-4" style="margin-top: 15px;">
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="full-name">Item Name</label>
                                <input
                                    type="text"
                                    id="banner_name"
                                    name="name"
                                    placeholder="Name"
                                    value="@if($inventory){{$inventory->name}}@endif"
                                    class="form-control br-5" required
                                  />
                                <span class="error-message"
                                    >Please enter a valid banner name</span
                                  >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="phone-num-lable">Material</label>
                                <select class="form-control select-box2" name="material[]" multiple required>
                                    @if($inventory && $inventory->material)
                                        @foreach(json_decode($inventory->material) as $material)
                                            <option value="{{$material}}" selected>{{$material}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="error-message"
                                    >Please enter valid Material</span
                                  >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-input">
                                <label class="phone-num-lable">Size</label>
                                <select class="form-control select-box2" name="size[]" multiple required>
                                    @if($inventory && $inventory->size)
                                        @foreach(json_decode($inventory->size) as $size)
                                            <option value="{{$size}}" selected>{{$size}}</option>
                                        @endforeach
                                    @endif
                                </select>

                                <span class="error-message"
                                    >Please enter valid Size</span
                                  >
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="example mt-3">
                                <label class="f-14">Category Type </label>
                                <div>
                                    <select class="form-control br-5" name="category"  required>
                                        <option value="">--Select--</option>
                                        @foreach(\App\Enums\InventoryEnums::$CATEGORY as $type)
                                            <option value="{{$type}}"
                                                    @if($inventory && ($inventory->category == $type)) selected @endif
                                            >{{ucfirst(trans($type))}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="mt-5">
                        <div
                            class="d-flex justify-content-between flex-row p-10 py-0"
                            style="border-top: 1px solid #70707040"
                          >
                            <div class="w-50">
                              <a class="white-text p-10 cancel" href="#"
                                ><button
                                  class="btn theme-br theme-text w-30 white-bg br-5"
                                >
                                  Cancel
                                </button></a
                              >
                            </div>
                            <div class="w-50 text-right">
                              <a class="white-text p-10"
                                ><button
                                  class="btn theme-bg white-text w-30 br-5"
                                >
                                  Save
                                </button></a
                              >
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
