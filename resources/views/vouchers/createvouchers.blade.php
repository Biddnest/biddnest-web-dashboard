@extends('layouts.app')
@section('title') Create Voucher @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createcoupons">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4 theme-text">@if($vouchers) Edit Voucher @else Create Voucher @endif</h3>

    </div>
    <div class="d-flex  flex-row justify-content-between">
      <div class="page-head text-left p-4 pt-0 pb-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('coupons')}}">Create Voucher</a></li>
            <li class="breadcrumb-item active" aria-current="page">@if($vouchers) Edit voucher @else Create Voucher @endif</li>
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
                    @if($vouchers) Edit Voucher @else Create Voucher @endif
                </h3>
            </div>

            <form action="@if($vouchers){{route('api.voucher.edit')}}@else{{route('api.voucher.add')}}@endif" method="@if(isset($vouchers)){{"PUT"}}@else{{"POST"}}@endif" data-next="redirect" data-redirect-type="hard" data-url="{{route('vouchers')}}" data-alert="tiny" class="create-coupons" id="myForm" data-parsley-validate>
    <div class="d-flex  row  p-20" >
        @if($vouchers)
            <input type="hidden" name="id" value="{{$vouchers->id}}">
        @endif
        <div class="col-sm-6">
          <div class="form-input">
            <label class="coupon-name">Voucher Logo</label>
            <div class="upload-section p-20 pt-0">
              <img class="upload-preview" src="{{asset('static/images/upload-image.svg')}}" alt=""/>
              <div class="ml-1">
                <div class="file-upload">
                  <input type="hidden" class="base-holder" name="image" value="" required/>
                  <button type="button" class="btn theme-bg white-text my-0" data-action="upload">
                    UPLOAD IMAGE
                  </button>
                  <input type="file" accept=".png,.jpg,.jpeg" required/>
                </div>
                <p class="text-black">Max File size: 1MB</p>
              </div>
            </div>
         </div>
        </div>
        
        <div class="col-sm-6">
        </div>
        
        <div class="col-sm-6">
          <div class="form-input">
            <label class="coupon-name">Voucher Name</label>
            <span class="">
              <input type="text" id="coupon-name" name="name" placeholder="Amazon Diwali Coupon" value="@if($vouchers){{$vouchers->name}}@endif" class="form-control" required>
             <span class="error-message">Please enter valid name </span>
            </span>
         </div>
        </div>
        <div class="col-sm-6">
          <div class="form-input">
            <label class="email-label">Title</label>
            <div>
                <input type="text" id="coupon-name" name="title" placeholder="Amazon Diwali Coupon" value="@if($vouchers){{$vouchers->title}}@endif" class="form-control" required>
            </div>
          </div>
        </div>

        <div class="col-sm-12">
            <div class="form-input">
              <label>Description</label>
              <span class="">
              <textarea class = "form-control" rows = "2" placeholder = "Enter Coupon Description" required name="desc">@if($vouchers) {!! $vouchers->desc !!} @endif</textarea>

                <!-- <textarea  required class="form-control" rows="" cols="" placeholder="hello" name="desc" style="margin: 0 20px 0 0;">
{{--                    @if($vouchers){!! $vouchers->desc !!}@endif--}}
                </textarea> -->
               <span class="error-message">Please enter  valid</span>
              </span>
            </div>
        </div>



        <div class="col-sm-6">
            <div class="form-input">
              <label class="coupon-code">Provider</label>
              <span class="">
               <select class="form-control br-5" name="provider" required>
                <option value="">--Select--</option>
                  @foreach(\App\Enums\VoucherEnums::$PROVIDER as $key=>$value)
                       <option value="{{$value}}" @if($vouchers && ($vouchers->provider == $value)) selected @endif>{{ucfirst(trans($key))}}</option>
                   @endforeach
              </select>
               <span class="error-message">Please enter  valid </span>
              </span>


           </div>

          </div>

          <div class="col-sm-6">
            <div class="form-input">
              <label>Provider Url</label>
              <span class="">
                <input type="url" name="provider_url" class="form-control br-5" value="@if($vouchers){{$vouchers->provider_url}}@endif" required="required" placeholder="Discount Amount"/>
                <span class="error-message">Please enter  valid</span>
              </span>
           </div>

          </div>


            <div class="col-sm-6">
            <div class="form-input">
              <label>Max Redemptions</label>
              <span class="">
                <input type="number" name="max_redemptions" class="form-control br-5" value="@if($vouchers){{$vouchers->max_redemptions}}@endif" required="required" placeholder="Discount Amount"/>
                <span class="error-message">Please enter  valid</span>
              </span>
           </div>

          </div>

            <div class="col-sm-6">
                <div class="form-input">
                    <label class="coupon-code">Type</label>
                    <span class="">
               <select class="form-control br-5" name="type" required>
                <option value="">--Select--</option>
                <option value="{{\App\Enums\VoucherEnums::$TYPE['predefined']}}" selected> Predefined </option>
                 {{-- @foreach(\App\Enums\VoucherEnums::$PROVIDER as $key=>$value)
                       <option value="{{$value}}" @if($vouchers && ($vouchers->provider == $value)) selected @endif>{{ucfirst(trans($key))}}</option>
                   @endforeach--}}
              </select>
               <span class="error-message">Please enter  valid </span>
              </span>


                </div>

            </div>

            <div class="col-sm-12 mtop-20  p-15   pb-0" >
                <div class="heading p-10 border-around " style="padding-left: 26px;">
                    List of Available Voucher Codes
                </div>

                <table class="table text-center p-10  theme-text tb-border2" id="items" >
                    <thead class="secondg-bg bx-shadowg p-0 f-14">
                    <tr class="">
                        <th scope="col">Voucher Code</th>
                        <th scope="col">Expires At</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="mtop-20 f-13 item-subservice" id="add-inventory-wrapper">
                    <tr class="inventory-snip">
                        <td scope="row" class="text-left">
                            <input type="text" name="codes[code]" class="form-control br-5" value="" required="required" placeholder="ABCD123456DEF"/>
                        </td>

                        <td class="">
                            <input type="text" class="form-control br-5 date dateselect" value="" name="codes[expires_on]" required="required" placeholder="15/02/2021"/>
                        </td>
                        <td>
                            <span class="closer" data-parent=".inventory-snip"><i class="fa fa-trash p-1 cursor-pointer" aria-hidden="true"></i></span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-12 mtop-20 w-30">
                <a class="float-right btn theme-bg white-text repeater load-extra-inventories" data-content="#add-inventory-row" data-container="#add-inventory-wrapper"  id="addnew-btn" data-url="{{route('subservice-category-inventories')}}">
                    <i class="fa fa-plus  m-1" aria-hidden="true"></i>
                    Add New Voucher Code
                </a>
            </div>

          @if($vouchers)
            <div class="col-sm-6" >
                <div class="form-input">
                  <label>Change Status</label>
                  <div>
                      <select class="form-control" name="status" required>
                              @foreach(\App\Enums\CouponEnums::$STATUS as $status=>$key)
                                  <option value="{{$key}}" @if($vouchers->status == $key) selected @endif>{{ucfirst(trans($status))}}</option>
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


    <script type="text/html" id="add-inventory-row">
        <tr class="inventory-snip">
            <td scope="row" class="text-left">
                <input type="text" name="codes[code]" class="form-control br-5" value="" required="required" placeholder="ABCD123456DEF"/>
            </td>

            <td class="">
                <input type="text" class="form-control br-5 singledate dateselect" value="" name="codes[expires_on]" required="required" placeholder="15/02/2021"/>
            </td>
            <td>
                <span class="closer" data-parent=".inventory-snip"><i class="fa fa-trash p-1 cursor-pointer" aria-hidden="true"></i></span>
            </td>
        </tr>
    </script>

</div>

@endsection
