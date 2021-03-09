@extends('layouts.app')
@section('title') Sliders And Banners @endsection
@section('content')

<div class="main-content grey-bg">
            <div class="d-flex flex-row justify-content-between">
              <h3 class="page-head text-left p-4 f-18">Create Mail</h3>
            </div>
            
            <!-- Dashboard cards -->
            <div class="d-flex  flex-row justify-content-between">
              <div class="page-head text-left   mt-3 pb-0   p-2">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Sliders & Banners
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('mail-notification')}}"> Notifications</a></li>
                    <li class="breadcrumb-item"><a href="#"> Create Mail</a></li>
                    
                   
                  </ol>
                </nav>
              
              
              </div>
        
          </div>
            <div
              class="d-flex flex-row justify-content-center Dashboard-lcards">
              <div class="col-lg-10">
                <div class="card h-auto p-0 pt-10">
                  <div
                    class="card-head right text-left border-bottom-2 p-10  pb-0">
                    <h3 class="f-18 mb-4 pl-3 theme-text">
                        Create Mail
                    </h3>
                  </div>
                  <div class="tab-content" id="myTabContent">
                    <div
                      class="tab-pane fade show active margin-topneg-15"
                      id="order"
                      role="tabpanel"
                      aria-labelledby="new-order-tab">
                      <!-- form starts -->
                      <form
                        class="form-new-order pt-4 mt-3 onboard-vendor-form input-text-blue">
                        <div class="d-flex row  ml-1 mr-1  mt-4">
                          <div class="col-lg-6">
                            <p class="img-label">Attachement</p>
                            <div class="upload-section p-20 pt-0">
                              <img src="{{asset('static/images/upload-image.svg')}}" alt=""/>
                              <div class="ml-1">
                                <div class="file-upload">
                                  <input type="file" />
                                  <button class="btn theme-bg white-text my-0">
                                    UPLOAD FILE
                                  </button>
                                </div>
                                <p>Max File size: 25MB</p>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="d-flex row p-20 -mt-20 ml-1 mr-1">
                         
                            <div class="col-lg-6">
                                <div class="form-input">
                                  <label class="full-name">Subject</label>
                                  <input
                                    type="text"
                                    id="banner_name"
                                    placeholder="New Year Sale"
                                    class="form-control br-5"
                                  />
                                  <span class="error-message"
                                    >Please enter a valid banner name</span
                                  >
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
                                  
    
                                  <span class="error-message"
                                    >Please enter a valid banner type</span
                                  >
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-input">
                                  <label class="phone-num-lable">Zone ID</label>
                                  <input
                                  
                                    type="text"
                                    placeholder="Z123456"
                                    id="areas"
                                    class="form-control"
                                    
                                  />
    
                                  <span class="error-message"
                                    >Please enter valid Phone number</span
                                  >
                                </div>
                              </div>
                            
                              <div class="col-lg-12">
                                <div class="form-input">
                                  <label class="full-name">Description</label>
                                  <textarea
                                    type="text"
                                    id="banner_name"
                                    placeholder="voluptas minima. At aut nam aspernatur quas numquam!"
                                    class="form-control br-5"
                                   rows="4"></textarea>
                                  <span class="error-message"
                                    >Please enter a valid banner name</span
                                  >
                                </div>
                              </div>
                             
                        </div>
                        <div class="accordion" id="comments">
                          <div
                            class="d-flex justify-content-between flex-row p-10 py-0"
                            style="border-top: 1px solid #70707040"
                          >
                            <div class="w-50">
                              <a class="white-text p-10" href="#"
                                ><button
                                  class="btn theme-br theme-text w-30 white-bg br-5 ml-4"
                                >
                                  Cancel
                                </button></a
                              >
                            </div>
                            <div class="w-50 text-right">
                              <a class="white-text p-10" href="#"><button
                                class="btn theme-br theme-text w-40 white-bg">Save as Draft</button></a>
                              <a class="white-text p-10"
                                ><button
                                  class="btn theme-bg white-text w-30 br-5 mr-4"
                                >
                                  Send
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