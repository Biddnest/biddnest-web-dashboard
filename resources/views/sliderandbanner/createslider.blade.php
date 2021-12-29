@extends('layouts.app')
@section('title') Sliders And Banners @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createslider">
            <div class="d-flex flex-row justify-content-between">
              <h3 class="heading1 " style="margin-left: 4rem;">@if(isset($slider)) Edit @else Create @endif Slider</h3>
            </div>

            <!-- Dashboard cards -->
            <div class="d-flex  flex-row justify-content-between">
              <div class="page-head text-left p-5 pt-0 pb-0">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Sliders & Banners</li>
                    <li class="breadcrumb-item"><a href="{{route('slider')}}"> Manage Sliders</a></li>
                    <li class="breadcrumb-item"> @if(isset($slider)) Edit @else Create @endif Sliders</li>
                  </ol>
                </nav>
              </div>
            </div>
    <div class="d-flex flex-row text-left ml-120">
        <a href="{{route('slider')}}" class="text-decoration-none">
            <h3 class="page-subhead text-left f-18" style="margin-top: 10px; !important; color: #2e0789;">
                <i class="p-1">
                    <img src="{{asset('static/images/Icon feather-chevrons-left.svg')}}" alt="" srcset="">
                </i> Back to Sliders & Banners
            </h3>
        </a>
    </div>

            <div class="d-flex flex-row justify-content-center Dashboard-lcards">
              <div class="col-lg-10">
                <div class="card h-auto p-0 pt-10">
                      <div class=" card-head right text-left border-bottom-2 p-10  pb-0">
                          <h3 class=" f-18 pb-0 mb-0 theme-text" style="margin-top: 0px !important;">
                              <ul class="nav nav-tabs pb-0 mb-0" id="myTab" role="tablist">
                                  <li class="nav-item">
                                      <a class="nav-link active p-15" id="live-tab" data-toggle="tab" href="#live" role="tab" aria-controls="home" aria-selected="true">@if(isset($slider)) Edit @else Create @endif  Slider</a>
                                  </li>
                                  @if(isset($slider))
                                    <li class="nav-item">
                                        <a class="nav-link p-15" href="{{route('create-banner', ['id'=>$id])}}" role="tab" >Banners</a>
                                    </li>
                                  @endif
                              </ul>
                          </h3>
                      </div>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active margin-topneg-15" role="tabpanel" aria-labelledby="live-tab">
                          <!-- form starts -->
                              <form class="form-new-order mt-1 onboard-vendor-form input-text-blue add-slider" action="@if(isset($slider)) {{route('sliders_edit')}} @else{{route('sliders_add')}}@endif" data-next="redirect" data-url="{{route('create-banner', ['id'=>':id'])}}" data-alert="mega" method="@if(isset($slider)){{"PUT"}}@else{{"POST"}}@endif" id="myFormF" data-parsley-validate>
                              @if(isset($slider))
                                  <input type="hidden" value="{{$id}}" name="id" />
                              @endif
                            <div class="d-flex row p-20">
                                <div class="col-lg-6">
                                    <div class="form-input">
                                        <label class="full-name">Name</label>
                                        <input
                                            type="text" required
                                            autocomplete="off"
                                            placeholder="Diwali"
                                            class="form-control br-5"
                                            name="name"
                                            value="{{$slider->name ?? '' }}"
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
                                                <option value="{{$type}}" @if($type == ($slider->type ?? '')) selected @endif>{{$key}}</option>
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
                                        <select class="form-control br-5" required name="size">
                                            <option value=""> -Select- </option>
                                            @foreach(\App\Enums\SliderEnum::$SIZE as $size=>$value)
                                            <option value="{{$value}}"  @if($value == ($slider->size ?? '')) selected @endif>{{$size}} {{App\Enums\SliderEnum::$BANNER_DIMENSIONS[$size][0]}}x{{App\Enums\SliderEnum::$BANNER_DIMENSIONS[$size][1]}}</option>
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
                                        <select class="form-control br-5" required name="position">
                                            <option value=""> -Select- </option>
                                            @foreach(\App\Enums\SliderEnum::$POSITION as $position=>$value)
                                            <option value="{{$value}}"  @if($value == ($slider->position ?? '')) selected @endif>{{$position}}</option>
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
                                        <select class="form-control br-5" required name="platform">
                                            <option value=""> -Select- </option>
                                            @foreach(\App\Enums\SliderEnum::$PLATFORM as $platform=>$value)
                                            <option value="{{$value}}"  @if($value == ($slider->platform ?? '')) selected @endif>{{$platform}}</option>
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
                                    <input type="text" name="from_date" value="{{$slider->from_date ?? ''}}" class=" form-control br-5 dateselect singledate" required="required"/>
                                    <span class="error-message">please enter valid date</span>
                                  </div>
                                </div>

                                <div class="col-lg-6">
                                  <div class="form-input">
                                    <label class="full-name">To date</label>
                                    <input type="text" name="to_date" value="{{$slider->to_date ?? ''}}" class=" form-control br-5 dateselect singledate" required="required" />
                                    <span class="error-message">please enter valid date</span>
                                  </div>
                                </div>

                                <div class="col-lg-6">
                                  <div class="form-input">
                                    <label class="phone-num-lable">City Scope</label>
                                      <select class="form-control field-toggle br-5" required name="zone_scope" data-value="{{\App\Enums\SliderEnum::$ZONE['custom']}}" data-target=".zones_list">
                                          <option value=""> -Select- </option>
                                          @foreach(\App\Enums\SliderEnum::$ZONE as $zone_type=>$value)
                                              <option value="{{$value}}"  @if($value == ($slider->zone_scope ?? '')) selected @endif>{{$zone_type}}</option>
                                          @endforeach
                                      </select>
                                    <span class="error-message">Please enter valid Phone number</span>
                                  </div>
                                </div>

                                <div class="col-lg-6 zones_list @if(($slider->zone_scope ?? '') != \App\Enums\SliderEnum::$ZONE['custom']) hidden @endif">
                                  <div class="form-input">
                                    <label class="phone-num-lable">Select Cities</label>
                                      <select  class="form-control br-5 select-box" name="city[]" multiple @if(($slider->zone_scope ?? '') == \App\Enums\SliderEnum::$ZONE['custom']) required @endif>
                                          @foreach(Illuminate\Support\Facades\Session::get('cities') as $city)
                                              <option value="{{$city->id}}"
                                                      @if(isset($slider))
                                                @foreach($slider->cities as $slider_city)
                                                  @if($city->id == $slider_city->id) selected @endif
                                                @endforeach
                                                  @endif
                                                      >
                                                  {{$city->name}}
                                              </option>

                                          @endforeach
                                      </select>
                                  </div>
                                </div>
                            </div>

                            <div class="row">
                              <div class="col-md-12" id="comments">
                                  <div class="d-flex justify-content-between flex-row p-10 py-0" style="border-top: 1px solid #70707040">
                                    <div class="w-50">
                                            <a class="white-text p-10 cancel" href="{{route('slider')}}">
                                              <button type="button" class="btn theme-br theme-text w-30 white-bg br-5">
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

@endsection
