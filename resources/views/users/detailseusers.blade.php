@extends('layouts.app')
@section('title') Users And Roles @endsection
@section('content')

 <!-- Main Content -->
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="usersandroles">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4">Order Details</h3>
     
    </div>
   
<!-- Dashboard cards -->


<div class="d-flex flex-row  Dashboard-lcards  justify-content-center">
<div class=" col-sm-10" >
    <!-- <div class="d-flex  flex-row text-left">
        <a href="users-roles.html" class="text-decoration-none"> 
            <h3 class="page-subhead text-left p-4 f-20 theme-text">
             <i class="p-1"> <img src="assets/images/Icon feather-chevrons-left.svg" alt="" srcset=""></i> Back to Users & Roles</h3></a>
      
     </div> -->
<div class="card  h-auto p-0 pt-10 " >
    
    <div class="card-head right text-center  pt-10">
        <div class="d-flex justify-content-between">
          <h3>
            <ul class="nav nav-tabs pt-20 justify-content-start p-0 flex-row f-18" id="myTab" role="tablist">
              <li class="nav-item ">
                  <a class="nav-link active p-15" id="customer-details-tab" data-toggle="tab" href="#customer-details" role="tab" aria-controls="home" aria-selected="true">User Details</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="#vendor-details" role="tab" aria-controls="profile" aria-selected="false">Banking Details</a>
                </li>
              
               
            </ul>
          </h3>
          
              <div class="eidt-icon margin-r-20 vertical-center p-10">
                <i class="fa fa-pencil p-1 cursor-pointer theme-text" aria-hidden="true"></i>
            </div>
        </div>
       
         
          
 

    


   
</div>
<div class="tab-content border-top margin-topneg-7" id="myTabContent">

  
  <div class="tab-pane fade show active" id="customer-details" role="tabpanel" aria-labelledby="customer-details-tab">
        
    <div class="d-flex  row p-15 pb-0" >

        <div class="col-sm-4 secondg-bg margin-topneg-15 pt-10">
          <div class="theme-text f-14 bold p-10">
        <div class="d-flex justify-content-between">
          <figure class="">
            <img src="{{asset('static/images/big-profile.svg')}}" alt="">
        </figure>
          <div class="profile-details">
            <p class="profile-name">David jerome</p>
        <p class="profile-id">davidjerome@gamil.com</p>
        <p class="profile-num">987456123</p>
          </div>
        </div>
          </div>
          <div class="theme-text f-14 bold p-10">
            Employee ID
          </div>
          <div class="theme-text f-14 bold p-10">
            Employee Role
          </div>
          <div class="theme-text f-14 bold p-10">
            Manager Name
          </div>
          <div class="theme-text f-14 bold p-10">
            Alternate Phone number
          </div>
          <div class="theme-text f-14 bold p-10">
            Gender
          </div>
          <div class="theme-text f-14 bold p-10">
            Educational Details
          </div>
          <div class="theme-text f-14 bold p-10">
            Date of Birth
          </div>
          <div class="theme-text f-14 bold p-10">
            PAN Card Number
          </div>
          <div class="theme-text f-14 bold p-10">
            Address
          </div>
          
        </div>
        
        <div class="col-sm-7 white-bg  margin-topneg-15  pt-10">
          
            <div class="theme-text f-14 p-10">
              <p class="theme-text">Status</p>
                        <div class="form-input">
                         
                          <div class="d-flex justify-content-start vertical-center theme-text margin-topneg-15">
                            <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-width="80" data-height="30" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-on="Active" data-off="Inactive" id="">
                            <!-- <p class="font-inactive f-15 zone-status">Inactive</p>  
                                        <label class="switch-reverse ml-10" onchange="
                            $('.zone-status').toggleClass('font-inactive')">
                                         <input type="checkbox" id="switch">
                                           <span class="slider"></span>
                                        </label>
                                        <p class="ml-10 zone-status f-15">   Active</p> -->
                                        </div>
                         
                          
                       </div> 
              </div> 
              <div class="theme-text f-14 p-10">
                davidjerome
              </div>
              <div class="theme-text f-14 p-10">
         <div class="status-badge">Super Admin</div>
              </div>
              <div class="theme-text f-14 p-10">
                Rohan Kumar
              </div>
              <div class="theme-text f-14 p-10">
                +91 9783546271
              </div>
              <div class="theme-text f-14 p-10">
                Male
              </div>
              <div class="theme-text f-14 p-10">
                Master of Business Administration
              </div>
              <div class="theme-text f-14 p-10 ">
                30 / 07 / 1995
              </div>
              <div class="theme-text f-14 p-10">
                AXKPVXXXX
              </div>
              <div class="theme-text f-14 p-10 ">
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero
              </div>
          </div>
       
      
       
        
      </div>
     
     
      
      <div class="border-top-3">
        <div class="d-flex justify-content-between">
            <div class="w-100">
                <a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Back</button></a>
            </div>
            <div class="w-100 margin-r-20">
                <div class="d-flex justify-content-end">
                 <div></div>
                    <button  class="btn white-text theme-bg w-30">Next</button>
                </div>
                
            </div>
        </div>
  
</div>
     

<!-- Tab-1 form -->
  </div>
<div class="tab-pane fade   " id="vendor-details" role="tabpanel" aria-labelledby="vendor-tab">



    <div class="d-flex  row p-15 pb-0 " >

        <div class="col-sm-4 secondg-bg  margin-topneg-15 pt-10">
          <div class="theme-text f-14 bold p-10">
            Account Number 
          </div>
          <div class="theme-text f-14 bold p-10">
            Bank Name
          </div>
          <div class="theme-text f-14 bold p-10">
            Account Holder Name
          </div>
          <div class="theme-text f-14 bold p-10">
            IFSC Code
          </div>
          <div class="theme-text f-14 bold p-10">
            Branch Name
          </div>
          <div class="theme-text f-14 bold p-10">
            Government ID proof
          </div>
          

          
        </div>
        
        <div class="col-sm-7 white-bg  margin-topneg-15 pt-10">
          
            <div class="theme-text f-14 p-10">
              63217485796
              </div> 
              <div class="theme-text f-14 p-10">
                ICICI Bank
              </div>
              <div class="theme-text f-14 p-10">
                David Jerome
              </div>
              <div class="theme-text f-14 p-10">
                ICI00001234
              </div>
              <div class="theme-text f-14 p-10">
                Indiranagar
              </div>
              <div class="theme-text f-14 p-10">
                PancardDoc.pdf
              </div>
           
              
          
          </div>
       
    
        
      </div>
    <div class="border-top-3">
            <div class="d-flex justify-content-start">
                <div class="w-50">
                    <a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>
                </div>
                <div class="w-50 margin-r-20">
                    <div class="d-flex justify-content-end">
                     <button  class="btn theme-text white-bg theme-br w-30 mr-20">Back</button>
                        <button  class="btn white-text theme-bg w-30" >Next</button>
                    </div>
                    
                </div>
            </div>
      
    </div>
   
</div> 



    <!--  -->
</div>

</div>

</div>

</div>




</div>

@endsection