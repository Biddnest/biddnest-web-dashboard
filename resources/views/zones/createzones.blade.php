@extends('layouts.app')
@section('title') Zones @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createzones">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4 theme-text">@if(!$zones) Create @else Edit @endif Zone</h3>
    </div>
    <div class="d-flex  flex-row justify-content-between">
      <div class="page-head text-left p-4 pt-0 pb-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('zones')}}">Zones</a></li>
            <li class="breadcrumb-item active" aria-current="page">@if(!$zones) Create @else Edit @endif Zone</li>
          </ol>
        </nav>
      </div>
    </div>

<!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-center Dashboard-lcards">
    <div class="col-sm-10">
        <div class="card  h-auto p-0">
            <div class="card-head right text-left border-bottom-2 pb-0">
                <h3 class="f-18 mb-0">
                    <ul class="nav nav-tabs  p-0" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active p-15" id="new-order-tab" data-toggle="tab"
                               href="#order" role="tab" aria-controls="home"
                               aria-selected="true">@if(!$zones) Create @else Edit @endif Zone</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link p-15" id="quotation" href="@if(!$zones)#@else{{route("zone-referral-system", ['id'=>$zones->id])}}@endif"
                            >Referral System</a>
                        </li>

                    </ul>
                </h3>
            </div>
            <form action="@if(!$zones){{route('zones_add')}}@else{{route('zones_edit')}}@endif" method="@if(!$zones){{"POST"}}@else{{"PUT"}}@endif" data-next="redirect" data-redirect-type="hard" data-url="{{route('zones')}}" data-alert="tiny"
                  class="form-new-order" id="myForm" data-parsley-validate >
                <div class="d-flex  row  m-20  p-20" >
                    @if($zones)
                        <input type="hidden" value="{{$zones->id}}" name="id">
                    @endif
                    <div class="col-sm-12">
                        <div class="form-input">
                            <label>Set Zone Center</label>
                            <input type="text" placeholder="Search place or address" name="geocode" class="form-control source-autocomplete">
                            <span class="error-message">Please enter valid</span>
                        </div>
                        <div style="width: 100%; height: 280px;" class="source-map-picker"></div>
                        <br />
                    </div>
                    <div class="col-sm-6">
                        <div class="form-input">
                            <label class="latitude">Latitude</label>
                            <input type="text" id="source-lat" placeholder="57.2046" name="lat" value="@if($zones){{$zones->lat}}@endif" class="form-control" required>
                            <span class="error-message">Please enter valid Latitide</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-input">
                            <label class="logitude">Logitude</label>
                            <input type="text"  placeholder="77.2046" id="source-lng" name="lng" value="@if($zones){{$zones->lng}}@endif" class="form-control" required>
                            <span class="error-message">Please enter valid Logitude</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-input">
                            <label class="zoneName">Zone Name</label>
                            <input type="text"  placeholder="Whitefield" id="zoneName" name="name" value="@if($zones){{$zones->name}}@endif" class="form-control" required>
                            <span class="error-message">Please enter valid Zone</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-input">
                            <label class="city">City</label>
                            <input type="text"  placeholder="Bengaluru" id="city" name="city" value="@if($zones){{$zones->city}}@endif" class="form-control" required>
                            <span class="error-message">Please enter  valid </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-input">
                            <label class="district">District</label>
                            <input type="text"  placeholder="Bengaluru" id="district" name="district" value="@if($zones){{$zones->district}}@endif" class="form-control" required>
                            <span class="error-message">Please enter  valid </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-input">
                            <label class="state">State</label>
                            <select id="state" class="form-control" name="state" required>
                                <option value="">--select--</option>
                                <option value="Andhra Pradesh" @if($zones && ($zones->state == "Andhra Pradesh")) selected @endif>Andhra Pradesh</option>
                                <option value="Andaman and Nicobar Islands" @if($zones && ($zones->state == "Andaman and Nicobar Islands")) selected @endif>Andaman and Nicobar Islands</option>
                                <option value="Arunachal Pradesh" @if($zones && ($zones->state == "Arunachal Pradesh")) selected @endif>Arunachal Pradesh</option>
                                <option value="Assam" @if($zones && ($zones->state == "Assam")) selected @endif>Assam</option>
                                <option value="Bihar" @if($zones && ($zones->state == "Bihar")) selected @endif>Bihar</option>
                                <option value="Chandigarh" @if($zones && ($zones->state == "Chandigarh")) selected @endif>Chandigarh</option>
                                <option value="Chhattisgarh" @if($zones && ($zones->state == "Chhattisgarh")) selected @endif>Chhattisgarh</option>
                                <option value="Dadar and Nagar Haveli" @if($zones && ($zones->state == "Dadar and Nagar Haveli")) selected @endif>Dadar and Nagar Haveli</option>
                                <option value="Daman and Diu" @if($zones && ($zones->state == "Daman and Diu")) selected @endif>Daman and Diu</option>
                                <option value="Delhi" @if($zones && ($zones->state == "Delhi")) selected @endif>Delhi</option>
                                <option value="Lakshadweep" @if($zones && ($zones->state == "Lakshadweep")) selected @endif>Lakshadweep</option>
                                <option value="Puducherry" @if($zones && ($zones->state == "Puducherry")) selected @endif>Puducherry</option>
                                <option value="Goa" @if($zones && ($zones->state == "Goa")) selected @endif>Goa</option>
                                <option value="Gujarat" @if($zones && ($zones->state == "Gujarat")) selected @endif>Gujarat</option>
                                <option value="Haryana" @if($zones && ($zones->state == "Haryana")) selected @endif>Haryana</option>
                                <option value="Himachal Pradesh" @if($zones && ($zones->state == "Himachal Pradesh")) selected @endif>Himachal Pradesh</option>
                                <option value="Jammu and Kashmir" @if($zones && ($zones->state == "Jammu and Kashmir")) selected @endif>Jammu and Kashmir</option>
                                <option value="Jharkhand" @if($zones && ($zones->state == "Jharkhand")) selected @endif>Jharkhand</option>
                                <option value="Karnataka" @if($zones && ($zones->state == "Karnataka")) selected @endif>Karnataka</option>
                                <option value="Kerala" @if($zones && ($zones->state == "Kerala")) selected @endif>Kerala</option>
                                <option value="Madhya Pradesh" @if($zones && ($zones->state == "Madhya Pradesh")) selected @endif>Madhya Pradesh</option>
                                <option value="Maharashtra" @if($zones && ($zones->state == "Maharashtra")) selected @endif>Maharashtra</option>
                                <option value="Manipur" @if($zones && ($zones->state == "Manipur")) selected @endif>Manipur</option>
                                <option value="Meghalaya" @if($zones && ($zones->state == "Meghalaya")) selected @endif>Meghalaya</option>
                                <option value="Mizoram" @if($zones && ($zones->state == "Mizoram")) selected @endif>Mizoram</option>
                                <option value="Nagaland" @if($zones && ($zones->state == "Nagaland")) selected @endif>Nagaland</option>
                                <option value="Odisha" @if($zones && ($zones->state == "Odisha")) selected @endif>Odisha</option>
                                <option value="Punjab" @if($zones && ($zones->state == "Punjab")) selected @endif>Punjab</option>
                                <option value="Rajasthan" @if($zones && ($zones->state == "Rajasthan")) selected @endif>Rajasthan</option>
                                <option value="Sikkim" @if($zones && ($zones->state == "Sikkim")) selected @endif>Sikkim</option>
                                <option value="Tamil Nadu" @if($zones && ($zones->state == "Tamil Nadu")) selected @endif>Tamil Nadu</option>
                                <option value="Telangana" @if($zones && ($zones->state == "Telangana")) selected @endif>Telangana</option>
                                <option value="Tripura" @if($zones && ($zones->state == "Tripura")) selected @endif>Tripura</option>
                                <option value="Uttar Pradesh" @if($zones && ($zones->state == "Uttar Pradesh")) selected @endif>Uttar Pradesh</option>
                                <option value="Uttarakhand" @if($zones && ($zones->state == "Uttarakhand")) selected @endif>Uttarakhand</option>
                                <option value="West Bengal" @if($zones && ($zones->state == "West Bengal")) selected @endif>West Bengal</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-input">
                            <label class="areas">Areas</label>
                            <select class="form-control select-box2" style="background-image: none !important;" name="area[]" multiple required>

                                @isset($zones)
                                    @foreach(json_decode($zones->area, true) as $area)
                                    <option value="{{$area}}" selected>{{$area}}</option>
                                    @endforeach
                                @endisset

                            </select>
                            <span class="error-message">Please enter  valid </span>
                        </div>
                    </div>
                </div>
                <div class="d-flex    w-100 p-10 border-top margin-r-20 justify-content-between ">
                    <div class="w-50 ">
                        <a class="white-text p-10 cancel" href="{{route('zones')}}">
                            <button type="button" class="btn theme-br theme-text w-30 white-bg">Cancel</button>
                        </a>
                    </div>
                    <div class="w-50 text-right">
                        <a class="white-text p-10" data-target="#for-friend">
                            <button class="btn theme-bg white-text w-30">Save</button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

@endsection
