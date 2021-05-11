@extends('layouts.app')
@section('title') API Settings @endsection
@section('content')

<!-- Main Content -->
<div class="main-content grey-bg" data-barba="container" data-barba-namespace="apisettings">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4 f-18">Website Settings</h3>

    </div>
    <div class="d-flex  flex-row justify-content-between">
      <div class="page-head text-left p-2 pt-0 pb-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('pages')}}"></a> Website settings</li>

          </ol>
        </nav>


      </div>

  </div>

<!-- Dashboard cards -->


<div class="d-flex flex-row  Dashboard-lcards  justify-content-center">
<div class="col">
    <!-- <div class="d-flex  flex-row text-left">
        <a href="booking-orders.html" class="text-decoration-none">
            <h3 class="page-subhead text-left p-4 f-20 theme-text">
             <i class="p-1"> <img src="assets/images/Icon feather-chevrons-left.svg" alt="" srcset=""></i> Back to Bookings & Orders</h3></a>

     </div> -->
<div class="card  h-auto p-0 pt-10 " >

    <div class="card-head right text-center  pb-0 p-05">
      <h3 class="f-18">
        <ul class="nav nav-tabs  justify-content-start p-0 flex-row" id="myTab" role="tablist">
          <li class="nav-item ">
              <a class="nav-link active p-15" id="customer-details-tab" data-toggle="tab" href="#customer-details" role="tab" aria-controls="home" aria-selected="true">Website Settings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="#vendor-details" role="tab" aria-controls="profile" aria-selected="false">Google Map settings</a>
            </li>


            <li class="nav-item">
              <a class="nav-link p-15" id="order-status-tab" data-toggle="tab" href="#order-status" role="tab" aria-controls="profile" aria-selected="false">SMS settings</a>
            </li>


        </ul>
      </h3>








</div>
<div class="tab-content border-top margin-topneg-7" id="myTabContent">

    <div class="tab-pane fade show active" id="customer-details" role="tabpanel" aria-labelledby="customer-details-tab">
        <div class="d-flex p-60 row d-felx justify-content-center ">

                <div class="col-sm-6">
                    <div class="form-input">
                      <label class="full-name">API Key</label>
                      <span class="">
                        <input type="text" id="fullname" placeholder="Enter API Key here" class="form-control">
                        <span class="error-message">Please enter valid Phone number</span>
                      </span>


                    </div>
                  </div>
                <!-- <textarea id="mytextarea" rows="5" cols="10">
                   <span class="bold f-14"> About US :</span>
                   <br>

                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab repudiandae aliquid a velit minima dolore assumenda explicabo quisquam quis dolorem amet similique magni sunt, enim quod voluptas recusandae vero maiores!</textarea> -->


        </div>

          <div class="border-top-3">
            <div class="d-flex justify-content-between">
                <div class="w-100">
                    <a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Cancel</button></a>
                </div>
                <div class="w-100 margin-r-20">
                    <div class="d-flex justify-content-end">
                     <div></div>
                        <button  class="btn white-text theme-bg w-30">Save</button>
                    </div>

                </div>
            </div>

    </div>


    <!-- Tab-1 form -->
      </div>
    <div class="tab-pane fade   " id="vendor-details" role="tabpanel" aria-labelledby="vendor-tab">
        <div class="d-flex p-15 row ">
            <div class="col-sm-12">
                <div class="form-input">
                  <label class="email-label">Show map on order tracking</label>

                    <div class="d-flex  flex-row margin-topneg-15">
                        <input type="checkbox" checked data-toggle="toggle" data-size="xs" data-width="110"
                          data-height="35" data-onstyle="outline-primary" data-offstyle="outline-secondary"
                          data-on="YES" data-off="NO" id="switch">
                        <!-- Button -->
                        <!-- <div class="theme-text f-20 mr-20">For me</div>
            <label class="switch mr-20">
                <input type="checkbox" id="switch">
                <span class="slider"></span>
              </label>
              <div class="theme-text f-20 ">Book for others</div> -->

                      </div>
                    <span class="error-message">Please enter valid Email</span>



                </div>

              </div>

                <div class="col-sm-6">
                    <div class="form-input">
                      <label class="email-label">Google Map API Key (with HTTP Restriction):</label>
                      <span class="">
                        <input type="email" placeholder="" id="E-mail" class="form-control">
                        <span class="error-message">Please enter valid Email</span>
                      </span>


                    </div>

                  </div>
                  <div class="col-sm-6">
                    <div class="form-input">
                      <label class="email-label">Google Map API Key (with IP Restriction):</label>
                      <span class="">
                        <input type="email" placeholder="" id="E-mail" class="form-control">
                        <span class="error-message">Please enter valid Email</span>
                      </span>


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

                            <button  class="btn white-text theme-bg w-30" >SAVE</button>
                        </div>

                    </div>
                </div>

        </div>

    </div>


    <div class="tab-pane fade" id="order-status" role="tabpanel" aria-labelledby="order-status-tab">






        <div class="d-flex p-60 row d-felx justify-content-center ">

            <div class="col-sm-6">
                <div class="form-input">
                  <label class="full-name">MSG91 Auth Key</label>
                  <span class="">
                    <input type="text" id="fullname" placeholder="" class="form-control">
                    <span class="error-message">Please enter valid Phone number</span>
                  </span>


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

                    <button  class="btn white-text theme-bg w-30" >SAVE</button>
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
