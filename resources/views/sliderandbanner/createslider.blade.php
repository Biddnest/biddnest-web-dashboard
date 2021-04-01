@extends('layouts.app')
@section('title') Sliders And Banners @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createslider">
            <div class="d-flex flex-row justify-content-between">
              <h3 class="heading1 p-4">Create Slider & Banners</h3>
            </div>

            <!-- Dashboard cards -->
            <div class="d-flex  flex-row justify-content-between">
              <div class="page-head text-left p-5 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Sliders & Banners
                    </li>
                    <li class="breadcrumb-item"><a href="sliders-banners.html"> Manage Sliders</a></li>
                    <li class="breadcrumb-item"><a href="#"> Create-Sliders</a></li>
                  </ol>
                </nav>
              </div>
          </div>
            <div
              class="d-flex flex-row justify-content-center Dashboard-lcards"
            >
              <div class="col-lg-10">
                <div class="card h-auto p-0 pt-10">
                  <div
                    class="card-head right text-left border-bottom-2 p-10  pb-0"
                  >
                    <h3 class="f-18 mb-4 theme-text">
                      Create Slider
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
                      <form class="form-new-order pt-4 mt-3 onboard-vendor-form input-text-blue" action="{{route('sliders_add')}}" data-next="redirect" data-url="{{route('slider')}}" data-alert="mega" method="POST" data-parsley-validate>
                        <div class="d-flex row p-20">
                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Name</label>
                                    <input
                                        type="text"
                                        id="url" required
                                        autocomplete="off"
                                        placeholder="Diwali"
                                        class="form-control br-5"
                                        name="name"
                                    />
                                    <span class="error-message"
                                    >Please enter a valid URL</span
                                    >
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Type</label>
                                    <select required id="ban-type" class="form-control br-5" name="type">
                                        <option value=""> -Select- </option>
                                        @foreach(\App\Enums\SliderEnum::$TYPE as $key=>$type)
                                            <option value="{{$type}}">{{$key}}</option>
                                        @endforeach

                                    </select>


                                    <span class="error-message"
                                    >Please enter a valid banner type</span
                                    >
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Size</label>
                                    <select id="ban-type" class="form-control br-5" required name="size">
                                        <option value=""> -Select- </option>
                                        @foreach(\App\Enums\SliderEnum::$SIZE as $size=>$value)
                                        <option value="{{$value}}">{{$size}} {{App\Enums\SliderEnum::$BANNER_DIMENSIONS[$size][0]}}x{{App\Enums\SliderEnum::$BANNER_DIMENSIONS[$size][1]}}</option>
                                        @endforeach
                                    </select>


                                    <span class="error-message"
                                    >Please enter a valid banner type</span
                                    >
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">POSITION</label>
                                    <select id="ban-type" class="form-control br-5" required name="position">
                                        <option value=""> -Select- </option>
                                        @foreach(\App\Enums\SliderEnum::$POSITION as $position=>$value)
                                        <option value="{{$value}}">{{$position}}</option>
                                        @endforeach
                                    </select>


                                    <span class="error-message"
                                    >Please enter a valid banner type</span
                                    >
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-input">
                                    <label class="full-name">Platform</label>
                                    <select id="ban-type" class="form-control br-5" required name="platform">
                                        <option value=""> -Select- </option>
                                        @foreach(\App\Enums\SliderEnum::$PLATFORM as $platform=>$value)
                                        <option value="{{$value}}">{{$platform}}</option>
                                        @endforeach
                                    </select>


                                    <span class="error-message"
                                    >Please enter a valid banner type</span
                                    >
                                </div>
                            </div>

                          <div class="col-lg-6">
                            <div class="form-input">
                              <label class="full-name">From date</label>
                              <input type="date" name="from_date" class="dateselect form-control br-5" required="required"/>
                              <span class="error-message"
                                >please enter valid date</span
                              >
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-input">
                              <label class="full-name">To date</label>
                              <input type="text" name="to_date" class="dateselect form-control br-5" required="required" />
                              <span class="error-message"
                                >please enter valid date</span
                              >
                            </div>
                          </div>

                          <div class="col-lg-6">
                            <div class="form-input">
                              <label class="phone-num-lable">Zone Availabiity</label>
                                <select id="ban-type" class="form-control field-toggle br-5" required name="zone_scope" data-value="{{\App\Enums\SliderEnum::$ZONE['custom']}}" data-target=".zones_list">
                                    <option value=""> -Select- </option>
                                    @foreach(\App\Enums\SliderEnum::$ZONE as $zone_type=>$value)
                                        <option value="{{$value}}">{{$zone_type}}</option>
                                    @endforeach
                                </select>

                              <span class="error-message"
                                >Please enter valid Phone number</span
                              >
                            </div>
                          </div>


                            <div class="col-lg-6 zones_list hidden">
                            <div class="form-input">
                              <label class="phone-num-lable">Zones</label>
                                <select id="ban-type" class="form-control br-5 select-box" name="zones[]" multiple>
                                    @foreach(Illuminate\Support\Facades\Session::get('zones') as $zone)
                                        <option value="{{$zone->id}}">{{$zone->name}}</option>
                                    @endforeach
                                </select>

                              <span class="error-message"
                                >Please enter valid Phone number</span
                              >
                            </div>
                          </div>
                        </div>
                      <div class="row">

                          <div class="col-md-12" id="comments">
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
                                          </button></a>
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

                      </div>

                      </form>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


@endsection
