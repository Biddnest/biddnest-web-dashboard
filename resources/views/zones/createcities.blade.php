@extends('layouts.app')
@section('title') Zones @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createzones">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4 theme-text">@if(!$cities) Create @else Edit @endif City</h3>
    </div>
    <div class="d-flex  flex-row justify-content-between">
      <div class="page-head text-left p-4 pt-0 pb-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('zones-city')}}">Cities</a></li>
            <li class="breadcrumb-item active" aria-current="page">@if(!$cities) Create @else Edit @endif City</li>
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
                                <a class="nav-link active p-15" id="new-order-tab" data-toggle="tab" href="#order" role="tab" aria-controls="home" aria-selected="true">@if(!$cities) Create @else Edit @endif City</a>
                            </li>
                        </ul>
                    </h3>
                </div>
                <form action="@if(!$cities){{route('cities_add')}}@else{{route('cities_edit')}}@endif" method="@if(!$cities){{"POST"}}@else{{"PUT"}}@endif" data-next="redirect" data-redirect-type="hard" data-url="{{route('zones-city')}}" data-alert="tiny"
                      class="form-new-order" id="myForm" data-parsley-validate >
                    <div class="d-flex  row  m-20  p-20" >
                        @if($cities)
                            <input type="hidden" value="{{$cities->id}}" name="id">
                        @endif
                        <div class="col-sm-6">
                            <div class="form-input">
                                <label class="zoneName">City Name</label>
                                <input type="text"  placeholder="Whitefield" id="zoneName" name="name" value="@if($cities){{$cities->name}}@endif" class="form-control" required>
                                <span class="error-message">Please enter valid Zone</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input">
                                <label class="state">State</label>
                                <select id="state" class="form-control" name="state" required>
                                        <option value="">--select--</option>
                                        <option value="Andhra Pradesh" @if($cities && ($cities->state == "Andhra Pradesh")) selected @endif>Andhra Pradesh</option>
                                        <option value="Andaman and Nicobar Islands" @if($cities && ($cities->state == "Andaman and Nicobar Islands")) selected @endif>Andaman and Nicobar Islands</option>
                                        <option value="Arunachal Pradesh" @if($cities && ($cities->state == "Arunachal Pradesh")) selected @endif>Arunachal Pradesh</option>
                                        <option value="Assam" @if($cities && ($cities->state == "Assam")) selected @endif>Assam</option>
                                        <option value="Bihar" @if($cities && ($cities->state == "Bihar")) selected @endif>Bihar</option>
                                        <option value="Chandigarh" @if($cities && ($cities->state == "Chandigarh")) selected @endif>Chandigarh</option>
                                        <option value="Chhattisgarh" @if($cities && ($cities->state == "Chhattisgarh")) selected @endif>Chhattisgarh</option>
                                        <option value="Dadar and Nagar Haveli" @if($cities && ($cities->state == "Dadar and Nagar Haveli")) selected @endif>Dadar and Nagar Haveli</option>
                                        <option value="Daman and Diu" @if($cities && ($cities->state == "Daman and Diu")) selected @endif>Daman and Diu</option>
                                        <option value="Delhi" @if($cities && ($cities->state == "Delhi")) selected @endif>Delhi</option>
                                        <option value="Lakshadweep" @if($cities && ($cities->state == "Lakshadweep")) selected @endif>Lakshadweep</option>
                                        <option value="Puducherry" @if($cities && ($cities->state == "Puducherry")) selected @endif>Puducherry</option>
                                        <option value="Goa" @if($cities && ($cities->state == "Goa")) selected @endif>Goa</option>
                                        <option value="Gujarat" @if($cities && ($cities->state == "Gujarat")) selected @endif>Gujarat</option>
                                        <option value="Haryana" @if($cities && ($cities->state == "Haryana")) selected @endif>Haryana</option>
                                        <option value="Himachal Pradesh" @if($cities && ($cities->state == "Himachal Pradesh")) selected @endif>Himachal Pradesh</option>
                                        <option value="Jammu and Kashmir" @if($cities && ($cities->state == "Jammu and Kashmir")) selected @endif>Jammu and Kashmir</option>
                                        <option value="Jharkhand" @if($cities && ($cities->state == "Jharkhand")) selected @endif>Jharkhand</option>
                                        <option value="Karnataka" @if($cities && ($cities->state == "Karnataka")) selected @endif>Karnataka</option>
                                        <option value="Kerala" @if($cities && ($cities->state == "Kerala")) selected @endif>Kerala</option>
                                        <option value="Madhya Pradesh" @if($cities && ($cities->state == "Madhya Pradesh")) selected @endif>Madhya Pradesh</option>
                                        <option value="Maharashtra" @if($cities && ($cities->state == "Maharashtra")) selected @endif>Maharashtra</option>
                                        <option value="Manipur" @if($cities && ($cities->state == "Manipur")) selected @endif>Manipur</option>
                                        <option value="Meghalaya" @if($cities && ($cities->state == "Meghalaya")) selected @endif>Meghalaya</option>
                                        <option value="Mizoram" @if($cities && ($cities->state == "Mizoram")) selected @endif>Mizoram</option>
                                        <option value="Nagaland" @if($cities && ($cities->state == "Nagaland")) selected @endif>Nagaland</option>
                                        <option value="Odisha" @if($cities && ($cities->state == "Odisha")) selected @endif>Odisha</option>
                                        <option value="Punjab" @if($cities && ($cities->state == "Punjab")) selected @endif>Punjab</option>
                                        <option value="Rajasthan" @if($cities && ($cities->state == "Rajasthan")) selected @endif>Rajasthan</option>
                                        <option value="Sikkim" @if($cities && ($cities->state == "Sikkim")) selected @endif>Sikkim</option>
                                        <option value="Tamil Nadu" @if($cities && ($cities->state == "Tamil Nadu")) selected @endif>Tamil Nadu</option>
                                        <option value="Telangana" @if($cities && ($cities->state == "Telangana")) selected @endif>Telangana</option>
                                        <option value="Tripura" @if($cities && ($cities->state == "Tripura")) selected @endif>Tripura</option>
                                        <option value="Uttar Pradesh" @if($cities && ($cities->state == "Uttar Pradesh")) selected @endif>Uttar Pradesh</option>
                                        <option value="Uttarakhand" @if($cities && ($cities->state == "Uttarakhand")) selected @endif>Uttarakhand</option>
                                        <option value="West Bengal" @if($cities && ($cities->state == "West Bengal")) selected @endif>West Bengal</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input">
                                <label class="zoneName">Zones</label>
                                <select id="" class="form-control select-box" name="zones[]" multiple required>
                                    <option value="">--Select--</option>
                                    @foreach($zones as $zone)
                                        <option value="{{$zone->id}}"
                                        @if($cities)
                                            @foreach($cities->zones as $zonekey)
                                                @if($zonekey->id == $zone->id) selected @endif
                                            @endforeach
                                        @endif
                                        >{{ucfirst(trans($zone->name))}}</option>
                                    @endforeach
                                </select>
                                <span class="error-message">Please enter valid Service</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex    w-100 p-10 border-top margin-r-20 justify-content-between ">
                        <div class="w-50 ">
                            <a class="white-text p-10 cancel" href="{{route('zones-city')}}">
                                <button type="button" class="btn theme-br theme-text w-30 white-bg">Cancel</button>
                            </a>
                        </div>
                        <div class="w-50 text-right">
                            <a class="white-text p-10" data-target="#for-friend">
                                <button class="btn theme-bg white-text w-30">@if(!$cities) Save @else Update @endif</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
