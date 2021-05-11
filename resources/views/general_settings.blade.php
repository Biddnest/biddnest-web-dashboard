@extends('layouts.app')
@section('title') General Settings @endsection
@section('content')

<div class="main-content grey-bg" data-barba="container" data-barba-namespace="settings">
    <div class="d-flex  flex-row justify-content-between">
        <h3 class="page-head text-left p-4">General Settings</h3>

    </div>
    <div class="d-flex  flex-row justify-content-between">
      <div class="page-head text-left p-4 pt-0 pb-0">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">General Settings</li>
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
        <ul class="nav nav-tabs  justify-content-around p-0 flex-row" id="myTab" role="tablist">
          <li class="nav-item ">
              <a class="nav-link active p-15" id="customer-details-tab" data-toggle="tab" href="#customer-details" role="tab" aria-controls="home" aria-selected="true">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link p-15" id="vendor-tab" data-toggle="tab" href="#vendor-details" role="tab" aria-controls="profile" aria-selected="false">Terms & Conditions</a>
            </li>


            <li class="nav-item">
              <a class="nav-link p-15" id="order-status-tab" data-toggle="tab" href="#order-status" role="tab" aria-controls="profile" aria-selected="false">FAQs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link p-15" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="profile" aria-selected="false">Contact Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link p-15" id="complaints-tab" data-toggle="tab" href="#complaints" role="tab" aria-controls="profile" aria-selected="false">Other Details</a>
            </li>
        </ul>
      </h3>








</div>
<div class="tab-content border-top margin-topneg-7" id="myTabContent">

    <div class="tab-pane fade show active" id="customer-details" role="tabpanel" aria-labelledby="customer-details-tab">
        <div class="d-flex p-15 row ">
            <div class="col-sm-12">
                <div id="froala-editor">
                    About Us:
                    <br>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio architecto quia ad? Quisquam omnis libero nihil, obcaecati recusandae corrupti dolorum optio dolores eaque error? Incidunt modi delectus cupiditate magni ex?
                </div>
                <!-- <textarea id="mytextarea" rows="5" cols="10">
                   <span class="bold f-14"> About US :</span>
                   <br>

                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab repudiandae aliquid a velit minima dolore assumenda explicabo quisquam quis dolorem amet similique magni sunt, enim quod voluptas recusandae vero maiores!</textarea> -->
            </div>

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
                <div id="froala-editor">
                    Terms & Conditions:
                    <br>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio architecto quia ad? Quisquam omnis libero nihil, obcaecati recusandae corrupti dolorum optio dolores eaque error? Incidunt modi delectus cupiditate magni ex?
                </div>
                <!-- <textarea id="mytextarea" rows="5" cols="10">
                   <span class="bold f-14"> About US :</span>
                   <br>

                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab repudiandae aliquid a velit minima dolore assumenda explicabo quisquam quis dolorem amet similique magni sunt, enim quod voluptas recusandae vero maiores!</textarea> -->
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


    <div class="tab-pane fade" id="order-status" role="tabpanel" aria-labelledby="order-status-tab">






        <div class="d-flex p-15 ">
            <div class="col-sm-12">
                <div class="form-input">
                  <label></label>
                  <span class="">
                    <select id="" class="form-control" >
                      <option> Enter Question here</option>
                      <option> Question 1</option>
                      <option> Question 2</option>
                      <option>Question 3</option>
                      <option> Question 4</option>

                    </select>
                    <span class="error-message">Please enter valid</span>
                  </span>


                </div>

              </div>

        </div>
        <div class="d-flex p-15" style="margin-top: -55px;">
            <div class="col-sm-12">
                <div class="form-input">

                  <span class="">
                    <textarea placeholder="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti eaque nihil repellat totam. Rerum, ratione. Dolor facere ea numquam dicta tempora vel eum, libero accusantium sequi, deleniti autem quibusdam in!" id="" class="form-control" rows="4"
                      cols="50">

        </textarea>
                    <span class="error-message">Please enter valid</span>
                  </span>


                </div>
              </div>

        </div>
        <div class="d-flex p-15 justify-content-end  margin-topneg-15">

                <div class=" d-flex" style="margin-right: 10px;">
                 <button class="btn">Add Question</button>

                </div>



        </div>





        <div class="border-top-3">
            <div class="d-flex justify-content-start">
                <div class="w-50">
                    <a class="white-text p-10" href="#"><button class="btn theme-br theme-text w-30 white-bg">Back</button></a>
                </div>

            </div>

    </div>

    </div>
    <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">

        <div class="d-flex  row p-15" >
            <div class="col-sm-6">
                <div class="form-input">
                  <label class="full-name">Full Name</label>
                  <span class="">
                    <input type="text" id="fullname" placeholder="David Jerome" class="form-control">
                    <span class="error-message">Please enter valid Phone number</span>
                  </span>


                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-input">
                  <label class="phone-num-lable">Phone Number</label>
                  <span class="">
                    <input type="tel" id="phone" placeholder="987654321"
                      class=" form-control form-control-tel">
                    <span class="error-message">Please enter valid Phone number</span>
                  </span>


                </div>

              </div>
              <div class="col-sm-6">
                <div class="form-input">
                  <label>Gender</label>
                  <span class="">
                    <select id="" class="form-control">
                      <option> Male</option>
                      <option> Female</option>

                    </select>
                    <span class="error-message">Please enter valid</span>
                  </span>


                </div>

              </div>
              <div class="col-sm-6">
                <div class="form-input">
                  <label class="">Organization Name</label>
                  <span class="">
                    <input type="text" id="fullname" placeholder="wayne pvt ltd" class="form-control">
                    <span class="error-message">Please enter valid Phone number</span>
                  </span>


                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-input">
                  <label>Address</label>
                  <span class="">
                    <input type="text" placeholder="Benguluru Urban" id="" class="form-control">
                    <span class="error-message">Please enter valid</span>
                  </span>


                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-input">
                  <label> Pincode</label>
                  <span class="">
                    <input type="text" placeholder="530000" id="" class="form-control">
                    <span class="error-message">Please enter valid</span>
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
                 <button  class="btn theme-text white-bg theme-br w-30 mr-20">Back</button>
                    <button  class="btn white-text theme-bg w-30" >Next</button>
                </div>

            </div>
        </div>

</div>
    </div>
    <div class="tab-pane fade" id="complaints" role="tabpanel" aria-labelledby="complaints-tab">



      <div class="d-flex  row p-15" >


        <div class="col-sm-4">
            <div class="form-input">
              <label class="coupon-name">Timer value</label>
              <div class="otp-input-group d-flex flex-row justify-content-between " style="margin-left: -8px;">

                <input class="form-control" type="number"  />
                <span class="p-8 bold">:</span>
                <input class="form-control" type="number"  />
                <span class="p-8 bold">:</span>
                <input class="form-control" type="number"  />




        </div>


           </div>
          </div>
          <div class="col-sm-4">
            <div class="form-input">
              <label class="coupon-name">Buffer value</label>
              <div class="otp-input-group d-flex flex-row justify-content-between " style="margin-left: -8px;">

                <input class="form-control" type="number"  />
                <span class="p-8 bold">:</span>
                <input class="form-control" type="number"  />
                <span class="p-8 bold">:</span>
                <input class="form-control" type="number"  />




        </div>


           </div>
          </div>
          <div class="col-sm-4">
            <div class="form-input">
              <label class="coupon-name">Max Time until  app remains open</label>
              <div class="otp-input-group d-flex flex-row justify-content-between " style="margin-left: -8px;">

                <input class="form-control" type="number"  />
                <span class="p-8 bold">:</span>
                <input class="form-control" type="number"  />
                <span class="p-8 bold">:</span>
                <input class="form-control" type="number"  />




        </div>


           </div>
          </div>
          <div class="col-sm-6">
            <div class="form-input">
              <label class="">Organization Name</label>
              <span class="">
                <input type="text"placeholder="wayne pvt ltd"  class="form-control">
               <span class="error-message">Please enter  valid </span>
              </span>


           </div>
          </div>
          <div class="col-sm-6">
            <div class="form-input">
              <label class="coupon-name">GST</label>
              <span class="">
                <input type="text"  placeholder="25XXXXXXXXXX"  class="form-control">
               <span class="error-message">Please enter  valid </span>
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
