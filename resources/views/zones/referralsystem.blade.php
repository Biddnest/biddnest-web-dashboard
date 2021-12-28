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
    <div class="d-flex flex-row text-left ml-120">
        <a href="{{route('zones')}}" class="text-decoration-none">
            <h3 class="page-subhead text-left f-18" style="margin-top: 10px; !important; color: #2e0789;">
                <i class="p-1">
                    <img src="{{asset('static/images/Icon feather-chevrons-left.svg')}}" alt="" srcset="">
                </i> Back to Zones
            </h3>
        </a>
    </div>

<!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
    <div class="col-sm-10">
        <div class="card  h-auto p-0 pt-10 ">
            <div class="card-head right text-left border-bottom-2 pb-0">
                <h3 class="f-18 mb-0">
                    <ul class="nav nav-tabs  p-0" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link  p-15" id="new-order-tab" data-toggle="tab"
                               href="@if(!$zones)#@else{{route('edit-zones', ['id'=>$zones->id])}}@endif" role="tab" aria-controls="home"
                               aria-selected="true">@if(!$zones) Create @else Edit @endif Zone</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active p-15" id="quotation" href="@if(!$zones)#@else{{route('zone-referral-system', ['id'=>$zones->id])}}@endif"
                            >Referral System</a>
                        </li>

                    </ul>
                </h3>
            </div>
            <form action="{{route('zones_save_referal')}}" method="POST" data-next="redirect" data-redirect-type="hard" data-url="{{route('zones')}}" data-alert="tiny"
                  class="form-new-order" id="myForm" data-parsley-validate >
                <div class="d-flex  row  m-20  p-20" >
                    @if($zones)
                        <input type="hidden" value="{{$zones->id}}" name="zone_id">
                    @endif
                        <div class="col-sm-12 p-10  secondg-bg heading">
                            <div>Referrer Settings</div>
                        </div>
                    <div class="col-sm-6">
                        <div class="form-input">
                            <label class="latitude">Reward Type</label>
                            <select class="form-control" name="referrer[reward_type]">
                                <option value="">--Choose--</option>
                                @foreach(\App\Enums\ReferralEnums::$TYPE as $key=>$value)
                                    <option value="{{$value}}" @if($referrer && $referrer->reward_type == $value) selected @endif> {{ucwords($key)}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-input">
                            <label class="logitude">Points to be rewarded</label>
                            <input type="number" placeholder="Enter points" id="source-lng" name="referrer[reward_points]" value="{{$referrer ? $referrer->reward_points : 0}}" class="form-control" required min="1">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-input">
                            <label class="zoneName">Voucher to be rewarded</label>
                            <select class="form-control" name="referrer[voucher_id]">
                                <option value="">--Choose--</option>
                                @foreach($vouchers as $voucher)
                                    <option value="{{$voucher->id}}" @if($referrer && $referrer->voucher_id == $voucher->id) checked @endif> {{$voucher->name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-input">
                            <label class="city">Trigger reward after</label>
                            <select class="form-control" name="referrer[trigger_on]">
                                <option value="">--Choose--</option>
                                @foreach(\App\Enums\ReferralEnums::$TRIGGER as $key=>$value)
                                    <option value="{{$value}}" @if($referrer && $referrer->trigger_on == $value) selected @endif> {{ucwords(str_replace("_"," ",$key))}} </option>
                                @endforeach
                            </select>
                    </div>
                </div>


                        <div class="col-sm-12 p-10 secondg-bg heading mt-10">
                            <div>Referee Settings</div>
                        </div>
                    <div class="col-sm-6">
                        <div class="form-input">
                            <label class="latitude">Reward Type</label>
                            <select class="form-control" name="referee[reward_type]">
                                <option value="">--Choose--</option>
                                @foreach(\App\Enums\ReferralEnums::$TYPE as $key=>$value)
                                    <option value="{{$value}}" @if($referee && $referee->reward_type == $value) selected @endif> {{ucwords($key)}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-input">
                            <label class="logitude">Points to be rewarded</label>
                            <input type="number" placeholder="Enter points" id="source-lng" name="referee[reward_points]" value="{{$referrer ? $referrer->reward_points : 0}}" class="form-control" required min="1">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-input">
                            <label class="zoneName">Voucher to be rewarded</label>
                            <select class="form-control" name="referee[voucher_id]">
                                <option value="">--Choose--</option>
                                @foreach($vouchers as $voucher)
                                    <option value="{{$voucher->id}}" @if($referee && $referee->voucher_id == $voucher->id) selected @endif> {{$voucher->name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-input">
                            <label class="city">Trigger reward after</label>
                            <select class="form-control" name="referee[trigger_on]">
                                <option value="">--Choose--</option>
                                @foreach(\App\Enums\ReferralEnums::$TRIGGER as $key=>$value)
                                    <option value="{{$value}}" @if($referee && $referee->trigger_on == $value) selected @endif> {{ucwords(str_replace("_"," ",$key))}} </option>
                                @endforeach
                            </select>
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
                </div>
            </form>
        </div>
    </div>
</div>
</div>

@endsection
