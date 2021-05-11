@extends('layouts.app')
@section('title') Complaints @endsection
@section('content')

<!-- Main Content -->
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="createcomplaints">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4 theme-text">Create Complaint</h3>

    </div>
    <div class="d-flex  flex-row justify-content-between">
      <div class="page-head text-left p-4 pt-0 pb-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Review & Ratings</li>
            <li class="breadcrumb-item"><a href="{{route('complaints')}}">Complaints</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create New Complaint</li>
          </ol>
        </nav>


      </div>

    </div>

    <!-- Dashboard cards -->


    <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
    <div class="col-sm-10">
    <div class="card  h-auto p-0 pt-10 ">

    <div class="card-head right text-left border-bottom-2 p-10 pt-20">

        <h3 class="f-18 theme-text ml-2  pl-1">
            Create Complaint

    </h3>





    </div>

    <form class="create-coupons">
    <div class="d-flex  row pl-4 pr-4 p-20" >


        <div class="col-sm-6">
          <div class="form-input">
            <label class="coupon-name">Enter Order ID</label>
            <span class="">
              <input type="text" id="coupon-name" placeholder="SKU1234456"  class="form-control">
             <span class="error-message">Please enter  valid </span>
            </span>


         </div>
        </div>

        <div class="col-sm-6">
          <div class="form-input">
            <label class="email-label">Customer Name</label>
            <span class="">
              <input type="text"  placeholder="Priyanka" id="E-mail" class="form-control">
             <span class="error-message">Please enter  valid Email</span>
            </span>


         </div>

        </div>
        <div class="col-sm-6">
            <div class="form-input">
              <label class="coupon-code">Vendor Name</label>
              <span class="">
                <input type="text"  placeholder="Pradeep" id="coupon-code" class="form-control">
               <span class="error-message">Please enter  valid </span>
              </span>


           </div>

          </div>
          <div class="col-sm-6">
            <div class="form-input">
              <label>Date of Movement </label>
              <span class="">
                <input type="text" class="form-control br-5" required="required" placeholder="15/02/2021"/>
               <span class="error-message">Please enter  valid</span>
              </span>


           </div>

          </div>
          <div class="col-sm-6">
            <div class="form-input">
              <label class="coupon-id">Driver Name</label>
              <span class="">
                <input type="text"  placeholder="Rakesh" id="coupon-id" class="form-control">
               <span class="error-message">Please enter  valid </span>
              </span>


           </div>

          </div>
          <div class="col-sm-6">
            <div class="form-input">
              <label class="coupon-id">Vehicle Details</label>
              <span class="">
                <input type="text"  placeholder="C123456" id="coupon-id" class="form-control">
               <span class="error-message">Please enter  valid </span>
              </span>


           </div>

          </div>

          <div class="col-sm-6">
            <div class="form-input">
              <label>Complaint Type</label>
              <span class="">

                  <select  id="" class="form-control">
                    <option >  Package</option>
                    <option>  Commercial</option>
                    <option>  Office</option>
                    </select>


               <span class="error-message">Please enter  valid</span>
              </span>


           </div>

          </div>
          <div class="col-sm-6">
            <div class="form-input">
              <label>Status</label>
              <span class="">

                  <select  id="" class="form-control">
                    <option >  Viewed</option>
                    <option>  Pending</option>
                    <option>  Removed</option>
                    </select>


               <span class="error-message">Please enter  valid</span>
              </span>


           </div>

          </div>



          <div class="col-sm-12">
            <div class="form-input">
              <label>Description</label>
              <span class="">
                <!-- <textarea  id="" class="form-control " rows="3" cols="" placeholder="hello" style="margin: 0 20px 0 0;">

                  </textarea> -->
                  <textarea class = "form-control" rows = "3" placeholder="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti eaque nihil repellat totam. Rerum, ratione. Dolor facere ea numquam dicta tempora vel eum, libero accusantium sequi, deleniti autem quibusdam in!"></textarea>

               <span class="error-message">Please enter  valid</span>
              </span>


           </div>
          </div>
      </div>
      <div class="d-flex  justify-content-between flex-row  p-10 border-top " >
        <div class="w-50"><a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg ml-1">Cancel</button></a></div>
        <div class="w-50 text-right"><a class="white-text p-10" data-toggle="modal" data-target="#for-friend"><button class="btn theme-bg white-text w-30">Save</button></a></div>
       </div>
    </form>



    </div>

    </div>

    </div>




</div>

@endsection
