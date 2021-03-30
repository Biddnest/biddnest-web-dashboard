@extends('layouts.app')
@section('title') Coupons And Offers @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createcoupons">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4 theme-text">Create New Coupon</h3>
     
    </div>
    <div class="d-flex  flex-row justify-content-between">
      <div class="page-head text-left p-4 pt-0 pb-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="coupons.html">Coupons & offers</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create New Coupon</li>
          </ol>
        </nav>
      
      
      </div>

  </div>

<!-- Dashboard cards -->


<div class="d-flex flex-row justify-content-center Dashboard-lcards ">
<div class="col-sm-10">
<div class="card  h-auto p-0 pt-10 ">
    
    <div class="card-head right text-left border-bottom-2 p-10 pt-20">
      
        <h3 class="f-18 theme-text">
            Create New Coupon
          
    </h3>

    


   
</div>

<form class="create-coupons">
    <div class="d-flex  row  p-20" >

    
        <div class="col-sm-6">
          <div class="form-input">
            <label class="coupon-name">Coupon Name</label>
            <span class="">
              <input type="text" id="coupon-name" name="name" placeholder="Sundayhub001"  class="form-control" required>
             <span class="error-message">Please enter  valid </span>
            </span>           
         </div>
        </div>

        <div class="col-sm-6">
            <div class="form-input">
              <label>Coupon Description</label>
              <span class="">
                <textarea  id="" class="form-control " rows="" cols="" placeholder="hello" style="margin: 0 20px 0 0;">
       
                  </textarea>
               <span class="error-message">Please enter  valid</span>
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
                    <option value="{{$type}}">{{$key}}</option>
                   @endforeach
              </select>
            </div>          
          </div>
        </div>

        <div class="col-sm-6">
            <div class="form-input">
              <label class="coupon-code">Coupon Code</label>
              <span class="">
                <input type="text" name="code" placeholder="Sundayhub001" id="coupon-code" class="form-control" required style="text-transform:uppercase">
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
                    <option value="{{$type}}">{{$key}}</option>
                   @endforeach
              </select>
              </div>            
           </div>
            
          </div>
          
          <div class="col-sm-6">
            <div class="form-input">
              <label>Discount Amount</label>
              <span class="">
                <input type="number" name="discount_amount" class="form-control br-5" required="required" placeholder="Discount Amount"/>
                <span class="error-message">Please enter  valid</span>
              </span>
           </div>
            
          </div>

          <div class="col-sm-6">
            <div class="form-input">
              <label>Start Date </label>
              <span class="">
                <input type="date" class="dateselect form-control br-5" name="valid_from" required="required" placeholder="15/02/2021"/>
               <span class="error-message">Please enter  valid</span>
              </span> 
           </div>
          </div>
        
          <div class="col-sm-6">
            <div class="form-input">
              <label>End Date </label>
              <span class="">
                <input type="date" class="dateselect form-control br-5" name="valid_to" required="required"  placeholder="15/02/2021"/>
               <span class="error-message">Please enter  valid</span>
              </span>  
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-input">
              <label class="max-discount">Max Discount Amount</label>
              <span class="">
                <input type="number"  placeholder="5000" id="max-discount" class="form-control">
                <span class="error-message">Please enter  valid </span>
              </span>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-input">
              <label class="min-order">Mini Order Amount</label>
              <span class="">
                <input type="number"  placeholder="5000" id="min-order" class="form-control">
               <span class="error-message">Please enter  valid </span>
              </span>
            </div>            
          </div>

          <div class="col-sm-6">
            <div class="form-input">
              <label>Cash Deduct from</label>
              <div>
                <select class="form-control br-5" name="deduction_source" required>
                  <option value="">--Select--</option>
                    @foreach(\App\Enums\CouponEnums::$DEDUCTION_SOURCE as $key=>$type)
                      <option value="{{$type}}">{{$key}}</option>
                    @endforeach
                </select>
              </div> 
            </div>
          </div>
       
          <div class="col-sm-6">
            <div class="form-input">
              <label class="max-usage">Max Usage</label>
              <span class="">
                <input type="number" name="max_usage"  placeholder="Max No of total used this coupon" id="" class="form-control">
               <span class="error-message">Please enter  valid </span>
              </span>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-input">
              <label class="max-usage-user">Max Usage/User</label>
              <span class="">
                <input type="number" name="max_usage_per_user" placeholder="Max No of coupon Usage/User" id="" class="form-control">
               <span class="error-message">Please enter  valid </span>
              </span>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="form-input">
              <label>Zone Scope</label>
              <div>
                <select class="form-control br-5 field-toggle" data-value="1" data-target=".zones" name="zone_scope" required>
                  <option value="">--Select--</option>
                    @foreach(\App\Enums\CouponEnums::$ZONE_SCOPE as $key=>$type)
                      <option value="{{$type}}">{{$key}}</option>
                    @endforeach
                </select>
              </div> 
            </div>
          </div>

          <div class="col-sm-6 zones hidden" >
            <div class="form-input">
              <label>Select Zones</label>
              <div>
                <select class="form-control br-5 field-toggle" name="zones">
                  <option value="">--Select--</option>
                    @foreach(Illuminate\Support\Facades\Session::get('zones') as $zone)
                      <option value="{{$zone->id}}">{{$zone->name}}</option>
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
                      <option value="{{$type}}">{{$key}}</option>
                    @endforeach
                </select>
              </div> 
            </div>
          </div>

          <div class="col-sm-6 orgnization hidden" >
            <div class="form-input">
              <label>Select Orgnization</label>
              <div>
                <select class="form-control br-5 field-toggle" name="zones">
                  <option value="">--Select--</option>
                    @foreach($organizations as $org)
                      <option value="{{$org->id}}">{{$org->org_name}}</option>
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
                      <option value="{{$type}}">{{$key}}</option>
                    @endforeach
                </select>
              </div> 
            </div>
          </div>

          <div class="col-sm-6 user hidden" >
            <div class="form-input">
              <label>Select Orgnization</label>
              <div>
                <input type="text"  class="form-control searchuser field-toggle" name="users">
                
              </div> 
            </div>
          </div>
      </div>
      <div class="d-flex  justify-content-between flex-row ml-20 p-10 border-top " >
        <div class="w-50"><a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Cancel</button></a></div>
        <div class="w-50 text-right"><a class="white-text p-10" data-toggle="modal" data-target="#for-friend"><button class="btn theme-bg white-text w-30">Save</button></a></div>
       </div>
</form>



</div>

</div>

</div>




</div>

@endsection