@extends('layouts.app')
@section('title') Sliders And Banners @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createslider">
            <div class="d-flex flex-row justify-content-between">
              <h3 class="heading1 p-4">Manage Banners</h3>
            </div>

            <!-- Dashboard cards -->
            <div class="d-flex  flex-row justify-content-between">
              <div class="page-head text-left p-5 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Sliders & Banners</li>
                    <li class="breadcrumb-item"><a href="sliders-banners.html"> Manage Sliders</a></li>
                    <li class="breadcrumb-item"><a href="#"> Manage Banner</a></li>
                  </ol>
                </nav>
              </div>
            </div>

            <div class="d-flex flex-row justify-content-center Dashboard-lcards">
              <div class="col-lg-10">
                <div class="card h-auto p-0 pt-10">
                      <div class=" card-head right text-left border-bottom-2 p-10  pb-0">
                          <h3 class=" f-18 pb-0 mb-4 theme-text" style="margin-top: 0px !important;">
                              <ul class="nav nav-tabs" id="myTab" role="tablist">
                                  <li class="nav-item">
                                      <a class="nav-link p-15" href="{{route('edit-slider', $id)}}" aria-controls="home" aria-selected="true">Edit Slider</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link active p-15" id="past-tab" data-toggle="tab" href="#past" role="tab" aria-controls="profile" aria-selected="false">Banners</a>
                                  </li>
                              </ul>
                          </h3>
                      </div>
                                  <div class="tab-content" id="myTabContent">

                                      <div class="tab-pane fade show active margin-topneg-15" id="past" role="tabpanel" aria-labelledby="past-tab">
                                          <!-- form starts -->
                                          <form class="form-new-order pt-4 mt-3 onboard-vendor-form input-text-blue add-slider"  action="{{route('banners_add')}}" data-next="redirect" data-url="{{route('create-banner', ['id'=>$id])}}" data-alert="mega" method="POST" data-parsley-validate>

                                              <input type="hidden" value="{{$id}}" name="id" />

                                              <div id="banners-add" class="sortable">
                                              @foreach($banners as $banner)
                                                 <div> <div class="d-flex row p-20 banner-form-wrapper relative">

                                                      <div class="col-lg-6">
                                                          <p class="img-label">Image</p>
                                                          <div class="upload-section p-20 pt-0">
                                                              <img class="upload-preview"
                                                                   src="{{$banner->image}}"
                                                                   alt=""
                                                              />
                                                              <div class="ml-1">
                                                                  <div class="file-upload">
                                                                      <input type="file" />
                                                                      <input type="hidden" class="base-holder" name="banners[][image]" value="{{$banner->image}}" required />
                                                                      <button type="button" class="btn theme-bg white-text my-0" data-action="upload">
                                                                          UPLOAD IMAGE
                                                                      </button>
                                                                  </div>
                                                                  <p class="text-black">Max File size: 1MB</p>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div class="col-lg-6 text-right">

                                                          <a href="#0" class="btn bg-danger closer text-white" data-parent=".banner-form-wrapper">Delete</a>
                                                          <a class="btn bg-primary dragger text-white" style="cursor: move;">Drag & Reorder</a>
                                                      </div>
                                                      <div class="col-lg-6">
                                                          <div class="form-input">
                                                              <label class="full-name">Banner Name</label>
                                                              <input
                                                                  type="text"
                                                                  id="name" required
                                                                  autocomplete="off"
                                                                  placeholder="Diwali"
                                                                  class="form-control br-5"
                                                                  name="banners[][name]"
                                                                  value="{{$banner->name}}"
                                                              />
                                                              <span class="error-message"
                                                              >Please enter a valid URL</span
                                                              >
                                                          </div>
                                                      </div>

                                                      <div class="col-lg-6">
                                                          <div class="form-input">
                                                              <label class="full-name">Url</label>
                                                              <input
                                                                  type="url"
                                                                  id="url"
                                                                  autocomplete="off"
                                                                  placeholder="Diwali.com"
                                                                  class="form-control br-5"
                                                                  name="banners[][url]"
                                                                  value="{{$banner->url}}"
                                                              />
                                                              <span class="error-message"
                                                              >Please enter a valid URL</span
                                                              >
                                                          </div>
                                                      </div>

                                                      <div class="col-lg-6">
                                                          <div class="form-input">
                                                              <label class="full-name">From date</label>
                                                              <input type="date" name="banners[][date][from]" class="dateselect form-control br-5" required="required" value="{{$banner->from_date}}"/>
                                                              <span class="error-message">please enter valid date</span>
                                                          </div>
                                                      </div>

                                                      <div class="col-lg-6">
                                                          <div class="form-input">
                                                              <label class="full-name">To date</label>
                                                              <input type="date" name="banners[][date][to]" class="dateselect form-control br-5" required="required" value="{{$banner->to_date}}" />
                                                              <span class="error-message">please enter valid date</span>
                                                          </div>
                                                      </div>

                                                     </div> </div>
                                              @endforeach
                                                </div>


                                                      @if(count($banners) == 0)
                                              <div class="row hide-on-data">
                                                  <div class="col-md-12 text-center p-20">
                                                          <p class="font14"><i>. You dont have any banners here. <br />Add a banner to get started.</i></p>
                                                  </div></div>
                                                      @endif
                                              <div class="row"><div class="col-md-12 text-center p-20">
                                                      <button type="button" class="btn theme-bg white-text repeater" data-content="#banner-form" data-container="#banners-add">Add Banner</button>
                                                  </div></div>

                            <div class="row">
                              <div class="col-md-12" id="comments">
                                  <div class="d-flex justify-content-between flex-row p-10 py-0" style="border-top: 1px solid #70707040">
                                    <div class="w-50">
                                            <a class="white-text p-10" href="#">
                                              <button class="btn theme-br theme-text w-30 white-bg br-5">
                                                    Cancel
                                              </button>
                                            </a>
                                    </div>
                                    <div class="w-50 text-right">
                                            <a class="white-text p-10">
                                              <button class="btn theme-bg white-text w-30 br-5">
                                                    Save
                                              </button>
                                            </a>
                                    </div>
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
</div>

    <script type="text/html" id="banner-form">

        <div class="d-flex row p-20 banner-form-wrapper relative">
            <span class="closer" data-parent=".banner-form-wrapper">
                Remove
            </span>
            <div class="col-lg-6">
                <p class="img-label">Image</p>
                <div class="upload-section p-20 pt-0">
                    <img class="upload-preview"
                         src="{{asset('static/images/upload-image.svg')}}"
                         alt=""
                    />
                    <div class="ml-1">
                        <div class="file-upload">
                            <input type="file" />
                            <input type="hidden" class="base-holder" name="banners[][image]" value="" required />
                            <button type="button" class="btn theme-bg white-text my-0" data-action="upload">
                                UPLOAD IMAGE
                            </button>
                        </div>
                        <p class="text-black">Max File size: 1MB</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-input">
                    <label class="full-name">Banner Name</label>
                    <input type="text"
                        id="name" required
                        autocomplete="off"
                        placeholder="Diwali"
                        class="form-control br-5"
                        name="banners[][name]"
                    />
                    <span class="error-message"
                    >Please enter a valid URL</span
                    >
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-input">
                    <label class="full-name">Url</label>
                    <input
                        type="url"
                        id="url" required
                        autocomplete="off"
                        placeholder="Diwali.com"
                        class="form-control br-5"
                        name="banners[][url]"
                    />
                    <span class="error-message"
                    >Please enter a valid URL</span
                    >
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-input">
                    <label class="full-name">From date</label>
                    <input type="date" name="banners[][date][from]" class="dateselect form-control br-5" required="required" value="{{$slider->from_date}}" />
                    <span class="error-message">please enter valid date</span>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-input">
                    <label class="full-name">To date</label>
                    <input type="date" name="banners[][date][to]" class="dateselect form-control br-5" required="required" value="{{$slider->to_date}}" />
                    <span class="error-message">please enter valid date</span>
                </div>
            </div>
        </div>

    </script>

@endsection
