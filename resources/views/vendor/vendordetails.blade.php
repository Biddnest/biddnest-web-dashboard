@extends('layouts.app')
@section('title') Vendor Management @endsection
@section('content')
<!-- Main Content -->
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="vendorDetails">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4">Order Details</h3>
     
    </div>
    <div class="d-flex  flex-row justify-content-between">
      <div class="page-head text-left p-4 pt-0 pb-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Vendor Management
            </li>
            <li class="breadcrumb-item"><a href="{{ route('vendors')}}">Manage vendor</a></li>
            
            <li class="breadcrumb-item active" aria-current="page">Venor Details
            </li>
          </ol>
        </nav>
      
      
      </div>

  </div>
   
<!-- Dashboard cards -->


<div class="d-flex flex-row  Dashboard-lcards  justify-content-center">
<div class=" col-sm-10" >
    <!-- <div class="d-flex  flex-row text-left">
        <a href="zone-details.html" class="text-decoration-none"> 
            <h3 class="page-subhead text-left p-4 f-20 theme-text">
             <i class="p-1"> <img src="assets/images/Icon feather-chevrons-left.svg" alt="" srcset=""></i> Back to Zone Managment</h3></a>
      
     </div> -->
<div class="card  h-auto p-0 pt-10 " >
    
    <div class="card-head right text-center   ptop-5">
        <div class="d-flex justify-content-between">
          <h3>
            <ul class="nav nav-tabs pt-20 justify-content-start p-0 flex-row f-18" id="myTab" role="tablist">
              <li class="nav-item ">
                  <a class="nav-link active p-15" id="customer-details-tab" data-toggle="tab" href="#customer-details" role="tab" aria-controls="home" aria-selected="true">Vendor Details</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="#vendor-details" role="tab" aria-controls="profile" aria-selected="false">Vendor Insights</a>
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
        
        <div class="d-flex  row p-15 " >

            <div class="col-sm-4  secondg-bg margin-topneg-15 pt-10">
              <div class="theme-text f-14 bold p-20">
                Vendor Name
              </div>
              <div class="theme-text f-14 bold p-20">
                Org Name
              </div>
              <div class="theme-text f-14 bold p-20">
                Assigned Driver
              </div>
              <div class="theme-text f-14 bold p-20">
                Phone Number
              </div>
              <div class="theme-text f-14 bold p-20">
                City
              </div>
              <div class="theme-text f-14 bold p-20">
                Status
              </div>
              <div class="theme-text f-14 bold p-20">
                Org Description
              </div>
              <div class="theme-text f-14 bold p-20">
                State
              </div>
              <div class="theme-text f-14 bold p-20">
                Pin Code
              </div>
             
            

              
            </div>
            
            <div class="col-sm-5 white-bg  margin-topneg-15 pt-10">
              
                <div class="theme-text f-14 p-20">
                    Mohan Kumar
                  </div> 
                  <div class="theme-text f-14 p-20">
                    Wayne Pvt Ltd
                  </div>
                  <div class="theme-text f-14 p-20">
                    Abhi Ram
                  </div>
                  <div class="theme-text f-14 p-20">
                   +91 - 9725364758
                  </div>
                  <div class="theme-text f-14 p-20">
                    Bengaluru
                   
                  </div>
                  <div class="theme-text f-14 p-20">
                    <span class="status-badge">In Process</span> 
                  </div>
                  <div class="theme-text f-12 p-20 pb-0 margin-topneg-10">
                      <p class=""> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt </p>
                   
                  </div>
                  <div class="theme-text f-14 p-20 margin-topneg-15 ">
                    Karnataka
                  </div>
                  <div class="theme-text f-14 p-20 ">
                    560097
                  </div>
                 
                
              </div>
           
              
              <div class="col-sm-6 mt-2">
                <div class="theme-text f-14 bold">
                    Vendor Revenue Trend
                </div>
                
              </div>
              <div class="col-sm-12 p-20 mt-2">
                <div class="theme-text f-14 bold text-center">
                   <img src="{{asset('static/images/graph/graph-lg.svg')}}" width="95%">
                </div>
                
              </div>
            
          </div>
         
       
          <div class="border-top-3">
            <div class="d-flex justify-content-between">
                <div class="w-100">
                    <a class="white-text p-20" href="#"><button class="btn theme-br theme-text w-30 white-bg">Back</button></a>
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
 
   
    
        <div class="d-flex  row  p-15">

            <div class="col-sm-4  secondg-bg margin-topneg-15 pt-10">
                <div class="theme-text f-14 bold p-20">
                    Service Type
                </div>
                <div class="theme-text f-14 bold p-20">
                    Services Provided
                </div>
                <div class="theme-text f-14 bold p-20">
                    Alt. Phone Number
                </div>
                <div class="theme-text f-14 bold p-20">
                    No of branches
                </div>
               
               
                
          
                
               
              
  
                
              </div>
              <div class="col-sm-5 white-bg  margin-topneg-15 pt-10">
              
                <div class="theme-text f-14 p-20">
                    Economic
                  </div> 
                  <div class="theme-text f-14 p-20">
                    Residential
                  </div>
                  <div class="theme-text f-14 p-20">
                    +91 - 9725364758
                  </div>
                  <div class="theme-text f-14 p-20">
              2
                  </div>
                  
                
                  
                  
                 
                
              </div>
           
           
            
          </div>
          
          <div class="d-flex  row  p-20">

            <div class="col-sm-6">
              <div class="theme-text f-14 bold">
                List of Payouts
              </div>
              
            </div>
            
           
           
            
          </div>
          <table class="table text-center p-20 theme-text">
            <thead class="secondg-bg  p-0">
              <tr>
                <th scope="col">Payout ID</th>
                <th scope="col" >Description</th>
                <th scope="col" >Status</th>
                <th scope="col" >Pay out Date</th>
                <th scope="col" >Amount</th>
                <th scope="col" >Commission Rate</th>
              
              </tr>
            </thead>
            <tbody class="mtop-15">
              <tr class="tb-border  cursor-pointer">
                <th scope="row">P123409</th>
               
               
                <td class=""><span class=" text-center ">Payment for BLR movers</span></td>
                <td  class="text-center">
                    <span class="status-badge green-bg">Completed</span></td>
                    <td class=""><span class=" text-center ">23 Dec 20</span></td>
                    <td class=""><span class=" text-center ">₹ 5,300</span></td>
                    <td class=""><span class=" text-center ">10%</span></td>
                    

                
              </tr>
              <tr class="tb-border  cursor-pointer">
                <th scope="row">P123409</th>
               
               
                <td class=""><span class=" text-center ">Payment for BLR movers</span></td>
                <td  class="text-center">
                    <span class="status-badge red-bg">Pending</span></td>
                    <td class=""><span class=" text-center ">23 Dec 20</span></td>
                    <td class=""><span class=" text-center ">₹ 5,300</span></td>
                    <td class=""><span class=" text-center ">10%</span></td>
                    

                
              </tr>
              <tr class="tb-border  cursor-pointer">
                <th scope="row">P123409</th>
               
               
                <td class=""><span class=" text-center ">Payment for BLR movers</span></td>
                <td  class="text-center">
                    <span class="status-badge">Processing</span></td>
                    <td class=""><span class=" text-center ">23 Dec 20</span></td>
                    <td class=""><span class=" text-center ">₹ 5,300</span></td>
                    <td class=""><span class=" text-center ">10%</span></td>
                    

                
              </tr>
              <tr class="tb-border  cursor-pointer">
                <th scope="row">P123409</th>
               
               
                <td class=""><span class=" text-center ">Payment for BLR movers</span></td>
                <td  class="text-center">
                    <span class="status-badge green-bg">Completed</span></td>
                    <td class=""><span class=" text-center ">23 Dec 20</span></td>
                    <td class=""><span class=" text-center ">₹ 5,300</span></td>
                    <td class=""><span class=" text-center ">10%</span></td>
                    

                
              </tr>
              
              
            </tbody>
          </table>
        <div class="border-top-3">
                <div class="d-flex justify-content-start">
                    <div class="w-50">
                        <a class="white-text p-20" href="#"><button class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>
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