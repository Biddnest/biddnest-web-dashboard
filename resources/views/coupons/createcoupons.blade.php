@extends('layouts.app')
@section('title') Coupons And Offers @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createcoupons">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4 theme-text">@if($coupons) Edit Coupon @else Create New Coupon @endif</h3>

    </div>
    <div class="d-flex  flex-row justify-content-between">
      <div class="page-head text-left p-4 pt-0 pb-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('coupons')}}">Coupons & offers</a></li>
            <li class="breadcrumb-item active" aria-current="page">@if($coupons) Edit Coupon @else Create New Coupon @endif</li>
          </ol>
        </nav>


      </div>

  </div>

<!-- Dashboard cards -->


<div class="d-flex flex-row justify-content-center Dashboard-lcards ">
    <div class="col-sm-10">
        <div class="card  h-auto p-0 pt-10 ">
            <div class="card-head right text-left border-bottom-2 p-10 pt-20">
                <h3 class="f-18 theme-text mt-1 ml-3">
                    @if($coupons) Edit Coupon @else Create New Coupon @endif
                </h3>
            </div>

            <form action="@if($coupons){{route('coupon_edit')}}@else{{route('coupon_add')}}@endif" method="@if(isset($coupons)){{"PUT"}}@else{{"POST"}}@endif" data-next="redirect" data-redirect-type="hard" data-url="{{route('coupons')}}" data-alert="tiny" class="create-coupons" id="myForm" data-parsley-validate>
    <div class="d-flex  row  p-20" >
        @if($coupons)
            <input type="hidden" name="id" value="{{$coupons->id}}">
        @endif
        <div class="col-sm-6">
          <div class="form-input">
            <label class="coupon-name">Coupon Name</label>
            <span class="">
              <input type="text" id="coupon-name" name="name" placeholder="Sundayhub001" value="@if($coupons){{$coupons->name}}@endif" class="form-control" required>
             <span class="error-message">Please enter valid name </span>
            </span>
         </div>
        </div>
        <div class="col-sm-6">
          <div class="form-input">
            <label class="email-label">Coupon Type</label>
            <div>
              <select class="form-control br-5" name="type"  required>
                <option value="">--Select--</option>
                  @foreach(\App\Enums\CouponEnums::$COUPON_TYPE as $key=>$type)
                    <option value="{{$type}}" @if($coupons && ($coupons->coupon_type == $type)) selected @endif>{{ucfirst(trans($key))}}</option>
                   @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="col-sm-12">
            <div class="form-input">
              <label>Coupon Description</label>
              <span class="">
              <textarea class = "form-control" rows = "2" placeholder = "Enter Coupon Description" required name="desc">@if($coupons) {!! $coupons->desc !!} @endif</textarea>

                <!-- <textarea  required class="form-control" rows="" cols="" placeholder="hello" name="desc" style="margin: 0 20px 0 0;">
{{--                    @if($coupons){!! $coupons->desc !!}@endif--}}
                </textarea> -->
               <span class="error-message">Please enter  valid</span>
              </span>
            </div>
        </div>



        <div class="col-sm-6">
            <div class="form-input">
              <label class="coupon-code">Coupon Code</label>
              <span class="">
                <input type="text" name="code" placeholder="Sundayhub001" id="coupon-code" value="@if($coupons){{$coupons->code}}@endif" class="form-control" required style="text-transform:uppercase">
               <span class="error-message">Please enter  valid </span>
              </span>


           </div>

          </div>

          <div class="col-sm-6">
            <div class="form-input">
              <label class="coupon-id">Discount Type</label>
              <div>
              <select class="form-control br-5" name="discount_type" required>
                <option value="">--Select--</option>
                  @foreach(\App\Enums\CouponEnums::$DISCOUNT_TYPE as $key=>$type)
                    <option value="{{$type}}" @if($coupons && ($coupons->discount_type == $type)) selected @endif>{{ucfirst(trans($key))}}</option>
                   @endforeach
              </select>
              </div>
           </div>

          </div>

          <div class="col-sm-6">
            <div class="form-input">
              <label>Discount Amount</label>
              <span class="">
                <input type="number" name="discount_amount" class="form-control br-5" value="@if($coupons){{$coupons->discount_amount}}@endif" required="required" placeholder="Discount Amount"/>
                <span class="error-message">Please enter  valid</span>
              </span>
           </div>

          </div>

          <div class="col-sm-6">
            <div class="form-input">
              <label>Start Date </label>
              <span class="">
                <input type="text" class="form-control br-5 date dateselect" value="@if($coupons){{$coupons->valid_from}}@endif" name="valid_from" required="required" placeholder="15/02/2021"/>
               <span class="error-message">Please enter  valid</span>
              </span>
           </div>
          </div>

          <div class="col-sm-6">
            <div class="form-input">
              <label>End Date </label>
              <span class="">
                <input type="text" class=" form-control br-5 date dateselect " name="valid_to" value="@if($coupons){{$coupons->valid_to}}@endif" required="required"  placeholder="15/02/2021"/>
               <span class="error-message">Please enter  valid</span>
              </span>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-input">
              <label class="max-discount">Max Discount Amount</label>
              <span class="">
                <input type="number"  placeholder="5000" name="max_discount_amount" id="max-discount" value="@if($coupons){{$coupons->max_discount_amount}}@endif" class="form-control">
                <span class="error-message">Please enter  valid </span>
              </span>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-input">
              <label class="min-order">Mini Order Amount</label>
              <span class="">
                <input type="number"  placeholder="5000" id="min-order" value="@if($coupons){{$coupons->min_order_amount}}@endif" name="min_order_amount" class="form-control" required>
               <span class="error-message">Please enter  valid </span>
              </span>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-input">
              <label>Cash Deduct from</label>
              <div>
                <select class="form-control br-5" name="deduction_source" id="coupon-source" required>
                  <option value="">--Select--</option>
                    @foreach(\App\Enums\CouponEnums::$DEDUCTION_SOURCE as $key=>$type)
                      <option value="{{$type}}" @if($coupons && ($coupons->deduction_source == $type)) selected @endif>{{ucfirst(trans($key))}}</option>
                    @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-input">
              <label class="max-usage">Max Usage</label>
              <span class="">
                <input type="number" name="max_usage"  placeholder="Max No of total used this coupon" value="@if($coupons){{$coupons->max_usage}}@endif" id="" class="form-control" required min="1">
               <span class="error-message">Please enter  valid </span>
              </span>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-input">
              <label class="max-usage-user">Max Usage/User</label>
              <span class="">
                <input type="number" name="max_usage_per_user" placeholder="Max No of coupon Usage/User" value="@if($coupons){{$coupons->max_usage_per_user}}@endif" id="" class="form-control" required min="1">
               <span class="error-message">Please enter  valid </span>
              </span>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-input">
              <label>Zone</label>
              <div>
                <select class="form-control br-5 field-toggle" data-value="1" data-target=".zones" name="zone_scope" required>
                  <option value="">--Select--</option>
                    @foreach(\App\Enums\CouponEnums::$ZONE_SCOPE as $key=>$type)
                      <option value="{{$type}}" @if($coupons && ($coupons->zone_scope == $type)) selected @endif>{{ucfirst(trans($key))}}</option>
                    @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="col-sm-6 zones hidden" >
            <div class="form-input">
              <label>Select Zones</label>
              <div>
                <select class="form-control br-5 field-toggle select-box" name="zones[]" multiple>

                    @foreach(Illuminate\Support\Facades\Session::get('zones') as $zone)
                      <option value="{{$zone->id}}" @if($coupons) @foreach($coupons->zones as $zones)  @if($zones->id == $zone->id) selected @endif @endforeach @endif>{{ucfirst(trans($zone->name))}}</option>
                    @endforeach
                </select>
              </div>
            </div>
          </div>


          <div class="col-sm-6">
            <div class="form-input">
              <label>Organization Scope</label>
              <div>
                <select class="form-control br-5 field-toggle" data-value="1" data-target=".orgnization" name="organization_scope" required>
                  <option value="">--Select--</option>
                    @foreach(\App\Enums\CouponEnums::$ORGANIZATION_SCOPE as $key=>$type)
                      <option value="{{$type}}" @if($coupons && ($coupons->organization_scope == $type)) selected @endif>{{ucfirst(trans($key))}}</option>
                    @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="col-sm-6 orgnization @if($coupons && ($coupons->organization_scope == \App\Enums\CouponEnums::$ORGANIZATION_SCOPE['custom'])) @else hidden @endif" >
            <div class="form-input">
              <label>Select Organization</label>
              <div>
                <select class="form-control br-5 select-box" name="organizations[]" multiple>
                    @foreach($organizations as $org)
                      <option value="{{$org->id}}" @if($coupons) @foreach($coupons->organizations as $organizations)  @if($organizations->id == $org->id) selected @endif @endforeach @endif>{{ucfirst(trans($org->org_name))}}</option>
                    @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-input">
              <label>User Scope</label>
              <div>
                <select class="form-control br-5 field-toggle" data-value="1" data-target=".user" name="user_scope" required>
                  <option value="">--Select--</option>
                    @foreach(\App\Enums\CouponEnums::$USER_SCOPE as $key=>$type)
                      <option value="{{$type}}" @if($coupons && ($coupons->user_scope == $type)) selected @endif>{{ucfirst(trans($key))}}</option>
                    @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="col-sm-6 user @if($coupons && ($coupons->user_scope == \App\Enums\CouponEnums::$USER_SCOPE['custom'])) @else hidden @endif" >
            <div class="form-input">
              <label>Select Users</label>
              <div>
                  <select class="form-control searchuser" name="users[]" multiple>
                      @if($coupons)
                          @foreach($coupons->users as $user)
                              <option value="{{$user->id}}" selected>{{ucfirst(trans($user->fname))}} {{ucfirst(trans($user->lname))}}</option>
                          @endforeach
                      @endif
                  </select>
              </div>
            </div>
          </div>

          @if($coupons)
            <div class="col-sm-6" >
                <div class="form-input">
                  <label>Change Status</label>
                  <div>
                      <select class="form-control" name="status" required>
                              @foreach(\App\Enums\CouponEnums::$STATUS as $status=>$key)
                                  <option value="{{$key}}" @if($coupons->status == $key) selected @endif>{{ucfirst(trans($status))}}</option>
                              @endforeach
                      </select>
                  </div>
                </div>
            </div>
          @endif
      </div>
      <div class="d-flex  justify-content-between flex-row  p-10 border-top " >
        <div class="w-50">
            <a class="white-text p-10 cancel" href="{{route('coupons')}}">
                <button type="button" class="btn theme-br theme-text w-30 white-bg">Cancel</button>
            </a>
        </div>
        <div class="w-50 text-right"><button class="btn theme-bg white-text w-30 mr-4" type="submit">Save</button></div>
       </div>
</form>



</div>

</div>

</div>




</div>

@endsection
