@extends('layouts.app')
@section('title') Dashboard @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createzones">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4 theme-text">Create Zone</h3>
     
    </div>
    <div class="d-flex  flex-row justify-content-between">
      <div class="page-head text-left p-4 pt-0 pb-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('zones')}}">Zones</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Zone</li>
          </ol>
        </nav>
      
      
      </div>

  </div>

<!-- Dashboard cards -->


<div class="d-flex flex-row justify-content-center Dashboard-lcards ">
<div class="col-sm-10">
<div class="card  h-auto p-0 pt-10 ">
    
    <div class="card-head right text-left border-bottom-2 p-10 pt-20">
        <h3 class="f-18 theme-text pl-2 ml-1">
            Create Zone
          
    </h3>

    


   
</div>
<form class="create-coupons">
    <div class="d-flex  row  m-20  p-20" >

    
        <div class="col-sm-6">
          <div class="form-input">
            <label class="latitude">Latitude</label>
            <span class="">
              <input type="text" id="coupon-name" placeholder="57.2046° N"  class="form-control">
             <span class="error-message">Please enter  valid </span>
            </span>
           
             
         </div>
        </div>
       
        <div class="col-sm-6">
          <div class="form-input">
            <label class="logitude">Logitude</label>
            <span class="">
              <input type="text"  placeholder="77.2046° E" id="logitude" class="form-control">
             <span class="error-message">Please enter  valid </span>
            </span>
           
             
         </div>
          
        </div>
        <div class="col-sm-6">
            <div class="form-input">
              <label class="zoneName">Zone Name</label>
              <span class="">
                <input type="text"  placeholder="Whitefield" id="zoneName" class="form-control">
               <span class="error-message">Please enter  valid </span>
              </span>
             
               
           </div>
            
          </div>
          <div class="col-sm-6">
            <div class="form-input">
              <label class="city">City</label>
              <span class="">
                <input type="text"  placeholder="Bengaluru" id="city" class="form-control">
               <span class="error-message">Please enter  valid </span>
              </span>
             
               
           </div>
            
          </div>
          <div class="col-sm-6">
            <div class="form-input">
              <label class="district">District</label>
              <span class="">
                <input type="text"  placeholder="Bengaluru" id="district" class="form-control">
               <span class="error-message">Please enter  valid </span>
              </span>
             
               
           </div>
            
          </div>
          <div class="col-sm-6">
            <div class="form-input">
              <label class="state">State</label>
              <span class="">
                <input type="text"  placeholder="Karnataka" id="state" class="form-control">
               <span class="error-message">Please enter  valid </span>
              </span>
             
               
           </div>
            
          </div>
          <div class="col-sm-6">
            <div class="form-input">
              <label class="areas">Areas</label>
              <span class="">
                <input type="text"  placeholder="Mahadevapura,Whitefield  " id="areas" class="form-control" name="tags">
               <span class="error-message">Please enter  valid </span>
              </span>
             
               
           </div>
            
          </div>
          <div class="col-sm-6">
            <div class="form-input">
              <label>Status</label>
              <div class="d-flex justify-content-start  theme-text margin-topneg-15 small-switch">
                <!-- <p class="font-inactive f-15 zone-status">Inactive</p>  
                            <label class="switch-reverse ml-10" onchange="
                $('.zone-status').toggleClass('font-inactive')">
                             <input type="checkbox" id="switch">
                               <span class="slider"></span>
                            </label>
                            <p class="ml-10 zone-status f-15">   Active</p> -->
                            <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-width="100" data-height="35" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-on="Active" data-off="Inactive" id="switch" class="p-0">
                            </div>
             
              
           </div>
            
          </div>
          
        
       
          
          
          
          
          
       
      </div>
      <div class="d-flex    w-100 p-10 border-top margin-r-20 justify-content-between ">
        <div class="w-50 "><a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Cancel</button></a></div>
        <div class="w-50 text-right"><a class="white-text p-10"  data-target="#for-friend"><button class="btn theme-bg white-text w-30">Save</button></a></div>
       </div>
</form>



</div>

</div>

</div>




</div>

@endsection