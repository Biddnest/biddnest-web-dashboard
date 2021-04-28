@extends('layouts.app')
@section('title') Sliders And Banners @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createpush">
    <div class="d-flex flex-row justify-content-between">
        <h3 class="page-head text-left p-4 pb-0 f-20">Create Push Notification</h3>
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
                  <h3 class="f-18 mb-4 mt-3 pl-3 theme-text">
                    Create Push Notification
                  </h3>
                </div>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active margin-topneg-15" id="order" role="tabpanel"
                    aria-labelledby="new-order-tab">
                    <!-- form starts -->
                      <form action="{{route('notification_add')}}" method="POST" data-next="redirect" data-redirect-type="hard" data-url="{{route('push-notification')}}" data-alert="tiny" class="create-notification" id="myForm" data-parsley-validate style="    margin: 30px !important;">
                      <div class="d-flex row">
                        <div class="col-lg-6">
                          <div class="form-input">
                            <label class="full-name">Notification Title</label>
                            <input type="text" id="banner_name" name="title" placeholder="New Year Sale" class="form-control br-5" />
                            <span class="error-message">Please enter a valid banner name</span>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          {{--<div class="form-input">
                            <label class="full-name">Notification Body</label>
                            <input type="text" id="banner_name" placeholder="Lorem ipsum" class="form-control br-5" />
                            <span class="error-message">Please enter a valid banner name</span>
                          </div>--}}
                        </div>
                          <div class="col-lg-6">
                          <div class="form-input">
                            <label class="full-name">Notification For</label>
                              <select id="zone" class="form-control br-5 field-toggle" name="for">
                                  <option value="">--Select--</option>
                                  <option value="1" data-value="user" data-target=".admin">User</option>
                                  <option value="2" data-value="customer" data-target=".user">Customer</option>
                                  <option value="3" data-value="vendor" data-target=".vendor">Vendor</option>
                              </select>
                            <span class="error-message">Please enter a valid banner name</span>
                          </div>
                        </div>
                        <div class="col-lg-6 admin">
                          <div class="form-input">
                            <label class="full-name">Users</label>
                            <select id="user" class="form-control br-5 searchadmin" name="admin">
                                <option value="">--Select--</option>
                                @foreach(\App\Models\Admin::where(['status'=>\App\Enums\CommonEnums::$YES, 'deleted'=>\App\Enums\CommonEnums::$NO])->get() as $admin)
                                    <option value="{{$admin->id}}">{{ucfirst(trans($admin->fname))}} {{ucfirst(trans($admin->lname))}}</option>
                                @endforeach
                            </select>
                            <span class="error-message">Please enter a valid banner type</span>
                          </div>
                        </div>
                          <div class="col-lg-6 user">
                              <div class="form-input">
                                  <label class="full-name ">Customer</label>
                                  <select id="cust" class="form-control br-5 searchuser" name="user">
                                      <option value="">--Select--</option>
                                      @foreach(\App\Models\User::where(['status'=>\App\Enums\CommonEnums::$YES, 'deleted'=>\App\Enums\CommonEnums::$NO])->get() as $customer)
                                          <option value="{{$customer->id}}">{{ucfirst(trans($customer->fname))}} {{ucfirst(trans($customer->lname))}}</option>
                                      @endforeach
                                  </select>
                                  <span class="error-message">Please enter a valid banner type</span>
                              </div>
                          </div>
                          <div class="col-lg-6 vendor">
                              <div class="form-input">
                                  <label class="full-name">Vendor</label>
                                  <select id="vendor" class="form-control br-5 searchvendor" name="vendor">
                                      <option value="">--Select--</option>
                                      @foreach(\App\Models\Organization::where('deleted', \App\Enums\CommonEnums::$NO)->get() as $org)
                                          <option value="{{$org->id}}">{{ucfirst(trans($org->org_name))}} {{$org->org_type}}</option>
                                      @endforeach
                                  </select>
                                  <span class="error-message">Please enter a valid banner type</span>
                              </div>
                          </div>
                        {{--<div class="col-lg-6">
                          <div class="form-input">
                            <label class="phone-num-lable">Zone</label>
                            <input style="padding: 0px !important" type="text" placeholder="Mahadevapura,Whitefield"
                              id="areas" class="form-control" name="tags" />
                            <span class="error-message">Please enter valid Phone number</span>
                          </div>
                        </div>--}}
                        <div class="col-lg-12">
                          <div class="form-input">
                            <label class="full-name">Description</label>
                            <textarea type="text" id="banner_name" name="desc" placeholder="Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam" class="form-control br-5"
                              rows="3"></textarea>
                            <span class="error-message">Please enter a valid banner name</span>
                          </div>
                        </div>
                        {{--<div class="col-lg-6">
                          <div class="form-input">
                            <label class="full-name">URL</label>
                            <input type="text" id="url" autocomplete="off" placeholder="http://example.com"
                              class="form-control br-5" />
                            <span class="error-message">Please enter a valid URL</span>
                          </div>
                        </div>--}}
                      </div>
                      <div class="accordion bg-white pl-0 pr-0" id="comments">
                        <div class="d-flex justify-content-between flex-row p-10 py-0"
                          style="border-top: 1px solid #70707040">
                          <div class="w-50">
                            <a class="white-text p-10 cancel" href="#"><button type="button"
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
