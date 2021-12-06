@extends('layouts.app')
@section('title') Customer Management @endsection
@section('content')
    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="createcustomer">
        <div class="d-flex  flex-row justify-content-between ">
            <h3 class="page-head text-left p-4 f-20">Customer Reward Points</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left    pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('customers')}}">Customer Management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Reward Points</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Dashboard cards -->
        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-lg-10">
                <div class="card  h-auto p-0 pt-10 ">
                    <div class="card-head right text-left border-bottom-2 pb-0">
                        <h3 class="f-18 mb-0">
                            <ul class="nav nav-tabs  p-0" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link  p-15" id="new-order-tab" data-toggle="tab"
                                       href="#order" role="tab" aria-controls="home"
                                       aria-selected="true">@if(!$users) Create @else Edit @endif Customer</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active p-15" id="quotation" href="@if(!$users)#@else{{route("rewards-customers", ['id'=>$users->id])}}@endif"
                                    >Reward Points</a>
                                </li>

                            </ul>
                        </h3>
                    </div>
                    <div class="create-customer">
                        <div class="form-wrapper">
                            <div class="view-more">
                                @foreach($users->vouchers as $vouch)
                                    @php \Debugbar::info($vouch) @endphp
                                    <div class="branch-wrapper price_{{$vouch->id}}">
                                        <div class="branch-snip d-flex flex-row justify-content-start">
                                            <div class="data-group border-right" style="min-width: 20%">
                                                <h1 class="voucher-code" style=""><span>{{$vouch->voucher_code}}</span></h1>
                                                <p style="text-align: center;">CODE</p>
                                            </div>
                                            <div class="data-group" style="min-width: 60%">
                                                <h5 style="font-size: 14px;">Expires On: {{$vouch->expires_at}}</h5>
                                                <p> {{ \App\Models\Voucher::where("id",$vouch->id)->pluck('title')[0] }}</p>

                                                {{--<br />
                                                <h5 style="font-size: 14px;">Biddnest Price Economic</h5>
                                                <p>&#8377; {{ $price->bp_economic  }}</p>--}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
