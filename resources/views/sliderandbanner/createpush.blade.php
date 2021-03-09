@extends('layouts.app')
@section('title') Sliders And Banners @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createpush">
          <div class="d-flex flex-row justify-content-between">
            <h3 class="page-head text-left p-4 f-20">Create Push Notification</h3>
          </div>
          <!-- Dashboard cards -->
          <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left   mt-3 pb-0   p-2">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">Sliders & Banners
                  </li>
                  <li class="breadcrumb-item"><a href="{{route('push-notification')}}"> Notifications</a></li>
                  <li class="breadcrumb-item"><a href="#"> Create Push Notification</a></li>
                </ol>
              </nav>
            </div>
          </div>
          <div class="d-flex flex-row justify-content-center Dashboard-lcards">
            <div class="col-lg-10">
              <div class="card h-auto p-0 pt-10">
                <div class="card-head right text-left border-bottom-2 p-10  pb-0">
                  <h3 class="f-18 mb-4 pl-3 theme-text">
                    Create Push Notification
                  </h3>
                </div>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active margin-topneg-15" id="order" role="tabpanel"
                    aria-labelledby="new-order-tab">
                    <!-- form starts -->
                    <form class="form-new-order pt-4 mt-3 onboard-vendor-form input-text-blue">
                      <div class="d-flex row">
                        <div class="col-lg-6">
                          <p class="img-label ">Image</p>
                          <div class="upload-section p-20 pt-0">
                            <img src="{{asset('static/images/upload-image.svg')}}" alt="" />
                            <div class="ml-1">
                              <div class="file-upload">
                                <input type="file" />
                                <button class="btn theme-bg white-text my-0">
                                  UPLOAD IMAGE
                                </button>
                              </div>
                              <p>Max File size: 1MB</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6  pr-5 mr-4" style=" display: flex;  align-items: center; align-self: flex-start; margin: inherit; ">
                          <div class="col-sm-4 pr-0">
                            <div class="form-input ">
                              <label class="full-name">Schedule</label>
                              <input type="text" class="dateselect form-control br-5" required="required" />
                              <span class="error-message">please enter valid date</span>
                            </div>
                          </div>
                          <div class="col-sm-2 mt-4 pt-3 pr-0 pl-3">
                            <div class="form-input">
                              <input type="text" class=" form-control br-5" required="required" placeholder="09" />

                            </div>
                          </div>
                          <div class="mt-4 f-20 pt-2 pl-2 pr-0">:</div>

                          <div class="col-sm-2  mt-4 pt-3 pr-0 pl-2">
                            
                            <div class="form-input">
                              <input type="text" class=" form-control br-5" required="required" placeholder="25" />

                            </div>
                          </div>
                          <div class="col-sm-2  mt-4 pt-3">
                            <button class="p-8 btn theme-bg  white-text">
                              AM
                            </button>
                          </div>
                          <div class="col-sm-2 mt-4 pt-3  ">
                            <button class="p-8 btn white-bg  theme-text">
                              PM
                            </button>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex row p-20">
                        <div class="col-lg-6">
                          <div class="form-input">
                            <label class="full-name">Notification Title</label>
                            <input type="text" id="banner_name" placeholder="New Year Sale" class="form-control br-5" />
                            <span class="error-message">Please enter a valid banner name</span>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-input">
                            <label class="full-name">Notification Body</label>
                            <input type="text" id="banner_name" placeholder="Lorem ipsum" class="form-control br-5" />
                            <span class="error-message">Please enter a valid banner name</span>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-input">
                            <label class="full-name">Users</label>
                            <select id="zone" class="form-control br-5">
                              <option>Customer 1</option>
                              <option>Customer 2</option>
                              <option>Customer 3</option>
                            </select>
                            <span class="error-message">Please enter a valid banner type</span>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-input">
                            <label class="phone-num-lable">Zone</label>
                            <input style="padding: 0px !important" type="text" placeholder="Mahadevapura,Whitefield"
                              id="areas" class="form-control" name="tags" />
                            <span class="error-message">Please enter valid Phone number</span>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-input">
                            <label class="full-name">Description</label>
                            <textarea type="text" id="banner_name" placeholder="Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam" class="form-control br-5"
                              rows="3"></textarea>
                            <span class="error-message">Please enter a valid banner name</span>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-input">
                            <label class="full-name">URL</label>
                            <input type="text" id="url" autocomplete="off" placeholder="http://example.com"
                              class="form-control br-5" />
                            <span class="error-message">Please enter a valid URL</span>
                          </div>
                        </div>
                      </div>
                      <div class="accordion" id="comments">
                        <div class="d-flex justify-content-between flex-row p-10 py-0"
                          style="border-top: 1px solid #70707040">
                          <div class="w-50">
                            <a class="white-text p-10" href="#"><button
                                class="btn theme-br theme-text w-30 white-bg br-5">
                                Cancel
                              </button></a>
                          </div>
                          <div class="w-50 text-right">
                            <a class="white-text p-10"><button class="btn theme-bg white-text w-30 br-5">
                                Send Now
                              </button></a>
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