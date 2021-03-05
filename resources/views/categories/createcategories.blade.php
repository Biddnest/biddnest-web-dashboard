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
                    <li class="breadcrumb-item active" aria-current="page">Categories
                    </li>
                    <li class="breadcrumb-item"><a href="Push-Notifications.html">Category Management</a></li>
                    <li class="breadcrumb-item"><a href="#">Create Category</a></li>
                    
                   
                  </ol>
                </nav>
              
              
              </div>
        
          </div>
            <div
              class="d-flex flex-row justify-content-center Dashboard-lcards"
            >
              <div class="col-lg-10">
                <div class="card h-auto p-0 p-10">
                  <div
                    class="card-head right text-left border-bottom-2 p-8"
                  >
                    <h3 class="f-18 mb-4 theme-text">
                      Create Category
                    </h3>
                  </div>
                  <div class="tab-content" id="myTabContent">
                    <div
                      class="tab-pane fade show active margin-topneg-15"
                      id="order"
                      role="tabpanel"
                      aria-labelledby="new-order-tab"
                    >
                      <!-- form starts -->
                      <form
                        class="form-new-order pt-4 mt-3 onboard-vendor-form input-text-blue"
                      >
                        <div class="d-flex row">
                          <div class="col-lg-6">
                            <p class="img-label">Photo</p>
                            <div class="upload-section p-20 pt-0">
                              <img
                                src="{{asset('static/images/upload-image.svg')}}"
                                alt=""
                              />
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
                          <div class="col-lg-6">
                            <div class="form-input">
                              <label class="full-name">Status</label>
                              <div class="d-flex  flex-row small-switch">
                                <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-width="110"
                                  data-height="35" data-onstyle="outline-primary" data-offstyle="outline-secondary"
                                  data-on="Blocked" data-off="Unblocked" id="switch">
                               
      
                              </div>
                              <span class="error-message"
                                >please enter valid date</span
                              >
                            </div>
                          </div>
                        
                        </div>

                        <div class="d-flex row p-20">
                         
                          
                              <div class="col-lg-6">
                                <div class="form-input">
                                  <label class="full-name">Name</label>
                                  <input
                                    type="text"
                                    id="banner_name"
                                    placeholder="Name"
                                    class="form-control br-5"
                                  />
                                  <span class="error-message"
                                    >Please enter a valid banner name</span
                                  >
                                </div>
                              </div>
                       
                              <div class="col-lg-6">
                                <div class="form-input">
                                  <label class="phone-num-lable">Zone</label>
                                  <input
                                    type="text"
                                    placeholder="Mahadevapura,Whitefield"
                                    id="areas"
                                    class="form-control"
                                    name="tags"
                                  />
    
                                  <span class="error-message"
                                    >Please enter valid Phone number</span
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