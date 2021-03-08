@extends('layouts.app')
@section('title') Vendor Payout @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createvendorpayout">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4">Vendor Payout</h3>
     
    </div>
    <div class="d-flex  flex-row justify-content-between">
      <div class="page-head text-left p-4 pt-0 pb-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('vendor-payout')}}">Vendors Payout</a></li>
            
            <li class="breadcrumb-item active" aria-current="page">Vendor Payout Details
            </li>
          </ol>
        </nav>
      
      
      </div>

  </div>
   
<!-- Dashboard cards -->


<div class="d-flex flex-row  Dashboard-lcards  justify-content-center">
<div class="w-75" >
    <!-- <div class="d-flex  flex-row text-left">
        <a href="payout-details.html" class="text-decoration-none"> 
            <h3 class="page-subhead text-left p-4 f-20 theme-text">
             <i class="p-1"> <img src="assets/images/Icon feather-chevrons-left.svg" alt="" srcset=""></i> Back to Vendor Payout</h3></a>
      
     </div> -->
<div class="card  h-auto p-0 pt-10 " >
   
        <div class="border-bottom-2 p-10">
        
         
                 <div class="f-18 theme-text p-10 d-felx justify-content-between">
                    Vendor Payout Details
                    <div class="float-right">
                        <div class="">
                            <i class="fa fa-pencil p-1 cursor-pointer theme-text" aria-hidden="true"></i> <a href="#" class="ml-1"></a>
                           </div>
                    </div>
                   
                      
                </div>
               
           

           
    
        
       
    
       
           </div>
   
   
    

        
    <div class="d-flex  row p-15" >

        <div class="col-sm-6 secondg-bg margin-topneg-15 pt-10">
          <div class="theme-text f-14 bold p-10">
            Payment ID
          </div>
          <div class="theme-text f-14 bold p-10">
            Vendor Name
          </div>
          <div class="theme-text f-14 bold p-10">
            Payout Date
          </div>
          <div class="theme-text f-14 bold p-10">
            Commission Rate
          </div>
          <div class="theme-text f-14 bold p-10">
            Amount
          </div>
          <div class="theme-text f-14 bold p-10">
            Description
          </div>
        
          
          

          
        </div>
        
        <div class="col-sm-5 white-bg  margin-topneg-15 pt-10">
          
            <div class="theme-text f-14 p-10">
                P012345698
              </div> 
              <div class="theme-text f-14 p-10">
                Pradeep
              </div>
              <div class="theme-text f-14 p-10">
                23 Dec 20
              </div>
              <div class="theme-text f-14 p-10">
                10%
              </div>
              <div class="theme-text f-14 p-10">
                ₹ 5,300
              </div>
              <div class="theme-text f-14 p-10">
                Payment for BLR movers
              </div>
              
              
             
          </div>
       
         
       
        
      </div>
     
     
     
      <div class="d-flex  row  p-10 margin-lr-20">

        <div class="col-sm-6">
            <div class="theme-text f-14 bold">
                List of Orders
            </div>

        </div>




    </div>
    <div class=" d-felx flex-row margin-lr-20">
        <table class="table text-center p-10 theme-text">
            <thead class="secondg-bg  p-0">
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Amount</th>
    
                </tr>
            </thead>
            <tbody class="mtop-20">
                <tr class="tb-border  cursor-pointer">
                    <th scope="row">Order123456</th>
    
                    <td class="text-center">SKU124672</td>
                    <td class="">₹ 9,300
                    </td>
    
                </tr>
                <tr class="tb-border  cursor-pointer">
                    <th scope="row">Order123456</th>
    
                    <td class="text-center">SKU124672</td>
                    <td class="">₹ 9,300
                    </td>
    
                </tr>
                <tr class="tb-border  cursor-pointer">
                    <th scope="row">Order123456</th>
    
                    <td class="text-center">SKU124672</td>
                    <td class="">₹ 8,300
                    </td>
    
                </tr>
            </tbody>
        </table>
    </div>
    
      <div class="d-flex border-top  p-8">
        <div class="w-50 "><a class="white-text" href="#"><button class="btn theme-br theme-text w-30 white-bg">Back</button></a></div>
       
      </div>
     

<!-- Tab-1 form -->
  

</div>

</div>

</div>




</div>

@endsection

