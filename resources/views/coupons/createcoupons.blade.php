@extends('layouts.app')
@section('title') Coupons And Offers @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="create-coupons">
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
              <input type="text" id="coupon-name" placeholder="Sundayhub001"  class="form-control">
             <span class="error-message">Please enter  valid </span>
            </span>
           
             
         </div>
        </div>
       
        <div class="col-sm-6">
          <div class="form-input">
            <label class="email-label">Coupon Type</label>
            <span class="">
              <input type="text"  placeholder="discount" id="E-mail" class="form-control">
             <span class="error-message">Please enter  valid Email</span>
            </span>
           
             
         </div>
          
        </div>
        <div class="col-sm-6">
            <div class="form-input">
              <label class="coupon-code">Coupon Code</label>
              <span class="">
                <input type="text"  placeholder="Sundayhub001" id="coupon-code" class="form-control">
               <span class="error-message">Please enter  valid </span>
              </span>
             
               
           </div>
            
          </div>
          <div class="col-sm-6">
            <div class="form-input">
              <label class="coupon-id">Coupon Value</label>
              <span class="">
                <input type="text"  placeholder="C123456" id="coupon-id" class="form-control">
               <span class="error-message">Please enter  valid </span>
              </span>
             
               
           </div>
            
          </div>
          
        <div class="col-sm-6">
            <div class="form-input">
              <label>Zone</label>
              <span class="">
                <select  id="" class="form-control js-example-basic-multiple" multiple="multiple">
                  <option >  Bengaluru</option>
                  <option>  Chennai</option>
                  <option>Mumbai</option>
                  </select>
               <span class="error-message">Please enter  valid</span>
              </span>
             
              
           </div>
            
          </div>
          <div class="col-sm-6">
            <div class="form-input">
              <label>Category</label>
              <span class="">
              
                  <select  id="" class="form-control">
                    <option >  Residential</option>
                    <option>  Commercial</option>
                    <option>  Office</option>
                    </select>
                
              
               <span class="error-message">Please enter  valid</span>
              </span>
             
              
           </div>
            
          </div>
          <div class="col-sm-6">
            <div class="form-input">
              <label>Start Date </label>
              <span class="">
                <input type="text" class="dateselect form-control br-5" required="required" placeholder="15/02/2021"/>
               <span class="error-message">Please enter  valid</span>
              </span>
             
              
           </div>
            
          </div>
        
          <div class="col-sm-6">
            <div class="form-input">
              <label>End Date </label>
              <span class="">
                <input type="text" class="dateselect form-control br-5" required="required"  placeholder="15/02/2021"/>
               <span class="error-message">Please enter  valid</span>
              </span>
             
              
           </div>
            
          </div>
          <div class="col-sm-6">
            <div class="form-input">
              <label class="max-discount">Max Discount Amount</label>
              <span class="">
                <input type="text"  placeholder="5000" id="max-discount" class="form-control">
               <span class="error-message">Please enter  valid </span>
              </span>
             
               
           </div>
            
          </div>
          <div class="col-sm-6">
            <div class="form-input">
              <label class="min-order">Mini Order Amount</label>
              <span class="">
                <input type="text"  placeholder="5000" id="min-order" class="form-control">
               <span class="error-message">Please enter  valid </span>
              </span>
             
               
           </div>
            
          </div>
          <div class="col-sm-6">
            <div class="form-input">
              <label>Cash Deduct from</label>
              <span class="">
                <select  id="" class="form-control">
                  <option >Vendor/Company</option>
             
                  </select>
               <span class="error-message">Please enter  valid</span>
              </span>
             
              
           </div>
            
          </div>
       
          <div class="col-sm-6">
            <div class="form-input">
              <label class="max-usage">Max Usage</label>
              <span class="">
                <input type="text"  placeholder="Max No of total used this coupon" id="" class="form-control">
               <span class="error-message">Please enter  valid </span>
              </span>
             
               
           </div>
            
          </div>
          <div class="col-sm-6">
            <div class="form-input">
              <label class="max-usage-user">Max Usage/User</label>
              <span class="">
                <input type="text"  placeholder="Max No of coupon Usage/User" id="" class="form-control">
               <span class="error-message">Please enter  valid </span>
              </span>
             
               
           </div>
            
          </div>
          <div class="col-sm-12">
            <div class="form-input">
              <label>Coupon Description</label>
              <span class="">
                <textarea  id="" class="form-control " rows="" cols="" placeholder="hello" style="margin: 0 20px 0 0;">
       
                  </textarea>
               <span class="error-message">Please enter  valid</span>
              </span>
             
               
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