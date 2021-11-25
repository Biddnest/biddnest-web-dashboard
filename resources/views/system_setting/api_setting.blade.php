@extends('layouts.app')
@section('title')API Settings @endsection
@section('content')

    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="pages">
        <div class="d-flex  flex-row justify-content-between">
            <h3 class="page-head theme-text text-left p-4 f-20">API Settings</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">General Settings</li>
                        <li class="breadcrumb-item"><a href="#">API Settings</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-between Dashboard-lcards ">
            <div class="col-sm-12" style="padding-right: 0px;">
                <div class="card h-auto p-0 pt-10">
                    <div class="header-wrap" style="padding: 5px 20px;">
                        <header>
                            <h3 class="f-18">
                                API Settings
                            </h3>
                        </header>
                    </div>
                    <div class="card-head right text-left border-bottom-2 p-10 pt-10 pb-0">
                        <h3 class="f-18 mb-0 mt-0">
                            <ul class="nav nav-tabs  p-0" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link p-15" id="genaeral" href="{{route('api-settings')}}">Genaeral Key Settings</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active p-15" id="api" data-toggle="tab"
                                       href="#genaeral" role="tab" aria-controls="home"
                                       aria-selected="true">API Key Settings</a>
                                </li>
                                
                            </ul>
                        </h3>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active margin-topneg-15" id="genaeral" role="tabpanel"
                             aria-labelledby="new-order-tab">
                            <form action="{{route('api_settings_update')}}" method="POST" data-next="redirect" data-redirect-type="hard" data-url="{{route('api-settings')}}" data-alert="tiny" class="form-new-order pt-4 mt-3" id="newForm" data-parsley-validate >
                                <table class="table text-center p-0 theme-text mb-0 primary-table">
                                    <thead class="secondg-bg p-0">
                                        <tr>
                                            <th scope="col">API Key</th>
                                            <th scope="col">Values</th>
                                        </tr>
                                    </thead>
                                    <tbody class="mtop-20 f-13">
                                        @foreach($settings as $setting)
                                            @if(($setting->key == "cancellation_reason_options") ||($setting->key == "onesignal_user_app_creds") ||($setting->key == "onesignal_vendor_app_creds"))
                                                <tr class="tb-border cursor-pointer">
                                                    <td>{{ucfirst(trans(str_replace('_', ' ',$setting->key)))}}</td>
                                                    <td>
                                                        <select class="form-control select-box2" name="key_{{$setting->id}}[]" multiple required>
                                                            @foreach(json_decode($setting->value, true) as $val_key)
                                                                <option value="{{$val_key}}" selected>{{$val_key}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                            @else
                                                <tr class="tb-border cursor-pointer">
                                                    <td>{{ucfirst(trans(str_replace('_', ' ',$setting->key)))}}</td>
                                                    <td><input type="text" name="key_{{$setting->id}}" value="{{$setting->value}}" class="form-control br-5" required></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="" id="comments">
                                    <div class="d-flex justify-content-between flex-row p-10 py-0" style="border-top: 1px solid #70707040">
                                        <div class="w-50">

                                        </div>
                                        <div class="w-50 text-right">
                                            <a class="white-text p-10">
                                                <button class="btn theme-bg white-text w-30 br-5">
                                                        Update
                                                </button>
                                            </a>
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
