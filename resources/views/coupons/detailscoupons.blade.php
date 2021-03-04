@extends('layouts.app')
@section('title') Coupons And Offers @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="details-coupons">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4">Order Details</h3>
     
    </div>
    <div class="d-flex  flex-row justify-content-between">
      <div class="page-head text-left p-4 pt-0 pb-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('coupons')}}">Coupons & offers</a></li>
            
            <li class="breadcrumb-item active" aria-current="page">Coupon Details
            </li>
          </ol>
        </nav>
      
      
      </div>

  </div>

   
<!-- Dashboard cards -->


<div class="d-flex flex-row  Dashboard-lcards  justify-content-center">
<div class="w-75" >
    <!-- <div class="d-flex  flex-row text-left">
        <a href="coupons.html" class="text-decoration-none"> 
            <h3 class="page-subhead text-left p-4 f-20 theme-text">
             <i class="p-1"> <img src="assets/images/Icon feather-chevrons-left.svg" alt="" srcset=""></i> Back to Coupons & offers</h3></a>
      
     </div> -->
<div class="card  h-auto p-0 pt-10 " >
    
    <div class="card-head right border-bottom-2  pt-20"><h3 class="f-18 theme-text p-10">
        Coupon Details
          
    </h3>

    


   
</div>

        
    <div class="d-flex  row p-15" >

        <div class="col-sm-6  secondg-bg margin-topneg-15 pt-10">
          <div class="theme-text f-14 bold p-20">
            Coupon Code
          </div>
          <div class="theme-text f-14 bold p-20">
            Coupon ID 
          </div>
          <div class="theme-text f-14 bold p-20">
            Coupon Type 
          </div>
          <div class="theme-text f-14 bold p-20">
            Coupon Usage
          </div>
          <div class="theme-text f-14 bold p-20">
            Coupon Description 
          </div>
          <div class="theme-text f-14 bold p-20">
            Zone
          </div>
        
          
          

          
        </div>
        
        <div class="col-sm-5 white-bg  margin-topneg-15 pt-10">
          
            <div class="theme-text f-14 p-20">
                SKU1234456  
              </div> 
              <div class="theme-text f-14 p-20">
                Discount123456
              </div>
              <div class="theme-text f-14 p-20">
                Discount
              </div>
              <div class="theme-text f-14 p-20">
                <div class="d-flex justify-content-start vertical-center">
                    10
                  <div class="progress">
                      <div class="bg-progress  progress-bar" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                 </div> 
              </div>
              <div class="theme-text f-14 p-20">
                Get sale offer of 30%  on your
next order
              </div>
              <div class="theme-text f-14 p-20">
                Bengaluru Urban
              </div>
              
              
             
          </div>
       
          <div class="col-sm-1 white-bg d-flex flex-row  mtop-5">
            <i class="fa fa-pencil p-1 cursor-pointer theme-text" aria-hidden="true"></i> <a href="#" class="ml-1">Edit</a>
           </div>
       
        
      </div>
     
     
     
      <table class="table text-center p-0 theme-text mb-0 primary-table">
        <thead class="secondg-bg  p-0">
            <tr>
                <th scope="col">Coupon  Name</th>
                <th scope="col">Coupon Type</th>
                <th scope="col">Value</th>
                <th scope="col">Coupon Usage</th>
                <th scope="col">Coupon Description</th>
                <th scope="col">Status</th>
               
            </tr>
        </thead>
        <tbody class="mtop-20 f-13">
            <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                <td scope="row">MOVESAFE</td>
                <td>Fixed</td>
                <td>₹ 2,300</td>
                <td>
                   <div class="d-flex justify-content-center vertical-center">
                      10
                    <div class="progress  ">
                        <div class="bg-progress  progress-bar" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                   </div> 
                    
                    </td>
                <td>Get ₹2,300 off</td>
                <td class=""><div class="status-badge">Active</div>
                </td>
            </tr>
            <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                <td scope="row">EASYPACK</td>
                <td>Percentage</td>
                <td>30%</td>
                <td> <div class="d-flex justify-content-center vertical-center">
                    15
                  <div class="progress">
                      <div class="bg-progress  progress-bar" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                 </div> </td>
                <td>Get ₹2,300 off</td>
                <td class=""><div class="status-badge">Completed</div>
                </td>
                
            </tr>
            <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                <td scope="row">SALEISHERE</td>
                <td>Fixed</td>
                <td>₹ 2,300</td>
                <td> <div class="d-flex justify-content-center vertical-center">
                    20
                  <div class="progress">
                      <div class="bg-progress  progress-bar" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                 </div> </td>
                <td>Get ₹2,300 off</td>
                <td class=""><div class="status-badge">Inactive</div>
                </td>
            </tr>
            <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                <td scope="row">30SALE</td>
                <td>Percentage</td>
                <td>30%</td>
                <td> <div class="d-flex justify-content-center vertical-center">
                    15
                  <div class="progress  ">
                      <div class="bg-progress  progress-bar" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                 </div> </td>
                <td>Get ₹2,300 off</td>
                <td class=""><div class="status-badge">Active</div>
                </td>
            </tr>
            <tr class="tb-border cursor-pointer" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                <td scope="row">MOVE12345</td>
                <td>Fixed</td>
                <td>₹ 2,300</td>
                <td> <div class="d-flex justify-content-center vertical-center">
                    15
                  <div class="progress">
                      <div class="bg-progress  progress-bar" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                 </div> </td>
                <td>Get ₹2,300 off</td>
                <td class=""><div class="status-badge">Completed</div>
                </td>
            </tr>
           
         
           
           
          
        </tbody>

    </table>
      <div class="d-flex border-top  p-20">
        <div class="w-50 "><a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Back</button></a></div>
       
      </div>
     

<!-- Tab-1 form -->
  

</div>

</div>

</div>




</div>

@endsection