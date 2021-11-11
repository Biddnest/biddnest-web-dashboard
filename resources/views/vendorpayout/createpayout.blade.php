@extends('layouts.app')
@section('title') Vendor Payout @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createvendorpayout">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head f-28 text-left p-4 theme-text">@if($payout) Edit @else Create @endif Payout</h3>
    </div>
    <div class="d-flex  flex-row justify-content-between">
      <div class="page-head text-left p-4 pt-0 pb-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('vendor-payout')}}">Vendor Payout</a></li>
            <li class="breadcrumb-item active" aria-current="page">@if($payout) Edit @else Create @endif  Payout</li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- Dashboard cards -->
    <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
        <div class="col-sm-10">
            <div class="card  h-auto p-0 pt-10 ">
                <div class="card-head right text-left border-bottom-2 pl-3 ml-1 p-10 pt-20">
                    <h3 class="f-18 mt-1 theme-text">
                        @if($payout) Edit @else Create @endif Payout
                    </h3>
                </div>
                <form action="@if($payout){{route('payout_edit')}}@else{{route('payout_add')}}@endif" method="@if(isset($payout)){{"PUT"}}@else{{"POST"}}@endif" data-next="redirect" data-redirect-type="hard" data-url="{{route('vendor-payout')}}" data-alert="tiny" class="create-coupon" id="myForm" data-parsley-validate>
                    <div class="d-flex pl-4 pr-4 row  p-20" >
                        @if($payout)
                            <input type="hidden" name="id" value="{{$payout->id}}">
                        @endif
                        <div class="col-sm-6">
                            <div class="form-input">
                                <label>Vendor Name</label>
                                <select class="form-control br-5 vendor-select" name="orgnizations" id="orgnizations" @if($payout) readonly @endif required>
                                    <option value="">--Select--</option>
                                    @foreach($organizations as $org)
                                        <option id="org_{{$org->id}}" value="{{$org->id}}" data-comission="{{$org->commission}}" @if($payout && ($payout->organization_id == $org->id)) selected @endif>{{ucfirst(trans($org->org_name))}} {{$org->org_type}}</option>
                                    @endforeach
                                </select>
                                <span class="error-message">Please enter  valid</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input" >
                                <label class="start-date">Payout date</label>
                                <div id="my-modal">
                                    <input type="text" id="dateselect" name="payout_date" value="@if($payout){{date('Y-m-d', strtotime($payout->dispatch_at))}}@endif" class="date form-control br-5" required="required" placeholder="23/Dec/2020" />
                                    <span class="error-message">please enter valid date</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-input">
                                <label class="coupon-code"> Total Amount</label>
                                <input type="number"  placeholder="₹ 9,300" value="@if($payout){{$payout->amount}}@endif" id="amount" name="amount" class="form-control" @if($payout) readonly @endif required min="1">
                                <span class="error-message">Please enter  valid </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input">
                                <label class="coupon-id">Number Of Orders</label>
                                <input type="number"  placeholder="10" id="coupon-id" name="no_of_orders" value="@if($payout){{json_decode($payout->meta, true)['total_bookings']}}@endif" class="form-control" @if($payout) readonly @endif required min="1">
                                <span class="error-message">Please enter  valid </span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input">
                                <label class="coupon-id">Commission Rate</label>
                                <input type="number" placeholder="10%" id="commission" value="@if($payout){{$payout->commission_percentage}}@endif" name="commission" class="form-control commission" readonly>
                                <input type="hidden" placeholder="10%" id="commission_amount" value="@if($payout){{$payout->commission}}@endif" name="commission_amount" class="form-control">
                                <span class="error-message">Please enter  valid </span>
                            </div>
                        </div>
                       {{-- <div class="col-sm-6">
                            <div class="form-input">
                                <label class="max-discount">Adjustments</label>
                                <input type="text"  placeholder="5%" id="max-discount" class="form-control">
                                <span class="error-message">Please enter  valid </span>
                            </div>
                        </div>--}}
                         <div class="col-sm-6">
                           <div class="form-input">
                               <label class="max-discount">Status</label>
                               <select class="form-control br-5" name="status"  required>
                                   <option value="">--Select--</option>
                                   @foreach(\App\Enums\PayoutEnums::$STATUS as $key=>$status)
                                       <option value="{{$status}}" @if($payout && ($payout->status == $status)) selected @endif>{{ucfirst(trans($key))}}</option>
                                   @endforeach
                               </select>
                               <span class="error-message">Please enter Status</span>
                           </div>
                       </div>
                        <div class="col-sm-6">
                            <div class="form-input">
                                <label class="min-order">Payout Amount</label>
                                <input type="number"  placeholder="₹ 9,300" id="payout_amount" value="@if($payout){{$payout->final_payout}}@endif" name="payout_amount" class="form-control" required readonly>
                                <span class="error-message">Please enter  valid </span>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-input">
                                <label>Description</label>
                                <textarea id="" class = "form-control" rows = "4" name="desc" placeholder ="Write Description" required>@if($payout){{$payout->remarks}}@endif</textarea>
                                <span class="error-message">Please enter Description</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex  justify-content-between flex-row  p-10 border-top " >
                        <div class="w-50">
                            <a class="white-text p-10 cancel" href="{{route('vendor-payout')}}">
                                <button type="button" class="btn theme-br theme-text w-30 white-bg">Cancel</button>
                            </a>
                        </div>
                        <div class="w-50 text-right">
                            <button class="btn theme-bg white-text w-30" type="submit">@if($payout) Update @else Save @endif</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>

@endsection
