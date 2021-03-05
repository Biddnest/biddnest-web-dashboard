@extends('layouts.app')
@section('title') Dashboard @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="detailszones">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4">Order Details</h3>
     
    </div>
    <div class="d-flex  flex-row justify-content-between">
      <div class="page-head text-left p-4 pt-0 pb-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('zones')}}">Zones</a></li>
            
            <li class="breadcrumb-item active" aria-current="page">Zone Details
            </li>
          </ol>
        </nav>
      
      
      </div>

  </div>
   
<!-- Dashboard cards -->


<div class="d-flex flex-row  Dashboard-lcards  justify-content-center">
<div class=" col-sm-10" >
    
<div class="card  h-auto p-0 pt-10 " >
    
    <div class="card-head right text-center   pt-10">
        <div class="d-flex justify-content-between">
          <h3 class="f-18">
            <ul class="nav nav-tabs pt-20 justify-content-start p-0 flex-row " id="myTab" role="tablist">
              <li class="nav-item ">
                  <a class="nav-link active p-15" id="customer-details-tab" data-toggle="tab" href="#customer-details" role="tab" aria-controls="home" aria-selected="true">Zone Details</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="#vendor-details" role="tab" aria-controls="profile" aria-selected="false">Zone Insights</a>
                </li>
              
               
            </ul>
          </h3>
         
              <div class="eidt-icon margin-r-20 vertical-center p-10">
                <i class="fa fa-pencil p-1 cursor-pointer theme-text" aria-hidden="true"></i>
            </div>
        </div>
       
         
          
 

    


   
</div>
<div class="tab-content margin-topneg-7 border-top" id="myTabContent">
 
    <div class="tab-pane fade show active" id="customer-details" role="tabpanel" aria-labelledby="customer-details-tab">
        
        <div class="d-flex  row p-15" >

            <div class="col-sm-4  secondg-bg margin-topneg-15 pt-10">
              <div class="theme-text f-14 bold p-20">
                Latitude
              </div>
              <div class="theme-text f-14 bold p-20">
                Logitude
              </div>
              <div class="theme-text f-14 bold p-20">
                Zone Name
              </div>
              <div class="theme-text f-14 bold p-20">
                City
              </div>
              <div class="theme-text f-14 bold p-20">
                District
              </div>
              <div class="theme-text f-14 bold p-20">
                State
              </div>
              <div class="theme-text f-14 bold p-20">
                Status
              </div>
           
            

              
            </div>
            
            <div class="col-sm-5 white-bg  margin-topneg-15 pt-10">
              
                <div class="theme-text f-14 p-20">
                    57.2046° N
                  </div> 
                  <div class="theme-text f-14 p-20">
                    77.2046° E
                  </div>
                  <div class="theme-text f-14 p-20">
                    Whitefield
                  </div>
                  <div class="theme-text f-14 p-20">
                    Bengaluru
                  </div>
                  <div class="theme-text f-14 p-20">
                    Bengaluru Urban
                  </div>
                  <div class="theme-text f-14 p-20">
                    Karnataka
                  </div>
                  <div class="theme-text f-14 p-20">
                    <div class="d-flex justify-content-start   margin-topneg-20 white-text">
                      <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-width="110" data-height="30" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-on="Active" data-off="Inactive" id="">
                                                                            </div>
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
 
   
    
        <div class="d-flex  row  p-20">

            <div class="col-sm-6">
              <div class="theme-text f-14 bold">
                List of Orders
              </div>
              
            </div>
            
           
           
            
          </div>
          <table class="table text-center p-10 theme-text">
            <thead class="secondg-bg  p-0">
              <tr>
                <th scope="col">Order ID</th>
                <th scope="col" >Status</th>
                <th scope="col" >Order Date</th>
              
              </tr>
            </thead>
            <tbody class="mtop-20">
              <tr class="tb-border  cursor-pointer">
                <th scope="row">sku123456</th>
               
               
                <td class=""><span class="text-center status-badge">Enquiry</span></td>
                <td  class="text-center">23 Dec 20</td>
                
              </tr>
              <tr class="tb-border  cursor-pointer">
                <th scope="row">sku123456</th>
                <td class=""><span class="green-bg  text-center status-badge">In Transit</span></td>
                <td>23 Dec 20</td>
               
               
              </tr>
              <tr class="tb-border  cursor-pointer">
                <th scope="row">sku123456</th>
                <td class=""><span class="light-bg  text-center status-badge">Awaiting Pickup</span></td>
                <td>24 Dec 20</td>
              
               
              </tr>
            </tbody>
          </table>
          <div class="d-flex  row  p-20">

            <div class="col-sm-6">
              <div class="theme-text f-14 bold">
                List of Coupons
              </div>
              
            </div>
            
           
           
            
          </div>
          <table class="table text-center p-10 theme-text">
            <thead class="secondg-bg  p-0">
              <tr>
                <th scope="col">Coupon Code</th>
                <th scope="col" >Discount</th>
                <th scope="col" >Order Date</th>
              
              </tr>
            </thead>
            <tbody class="mtop-20">
              <tr class="tb-border  cursor-pointer">
                <th scope="row">sku123456</th>
               
               
                <td class=""><span class=" text-center ">30%</span></td>
                <td  class="text-center">23 Dec 20</td>
                
              </tr>
              <tr class="tb-border  cursor-pointer">
                <th scope="row">sku123456</th>
                <td class=""><span class=" text-center ">40%</span></td>
                <td>23 Dec 20</td>
               
               
              </tr>
              <tr class="tb-border  cursor-pointer">
                <th scope="row">sku123456</th>
                <td class=""><span class="  text-center ">60%</span></td>
                <td>24 Dec 20</td>
              
               
              </tr>
            </tbody>
          </table>
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