@extends('vendor-panel.layouts.frame')
@section('title') Order Details @endsection
@section('body')

    <div class="main-content grey-bg" data-barba="container" data-barba-namespace="orderdetail">
        <div class="d-flex  flex-row justify-content-between vertical-center">
            <h3 class="page-head text-left p-4 f-20 theme-text">Order Details</h3>
        </div>
        <div class="d-flex  flex-row justify-content-between">
            <div class="page-head text-left  pt-0 pb-0 p-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page" ><a href="manage-bookings.html"> Manage Bookings</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="d-flex flex-row justify-content-center Dashboard-lcards ">
            <div class="col-lg-10">
                <div class="card h-auto p-0 pt-20">
                    <div class="tab-pane fade  active show" id="order-status" role="tabpanel" aria-labelledby="order-status-tab">
                        <div class="p-15">
                            <div class="d-flex p-10">
                                <div class="steps-container mr-5 pr-5 justify-content-center">
                                    <hr class="dash-line" style="width:22% !important;margin-left: 10%;">
                                    <div class="steps-status " style="margin: 0px 130px;">
                                        <div class="step-dot">
                                            <div class="child-dot"></div>
                                        </div>
                                        <p class="f-16">Bidding</p>
                                    </div>
                                    <div class="steps-status ">
                                        <div class="step-dot bg-step">
                                        </div>
                                        <p class="f-16">My Quote</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-felx justify-content-center pt-4 border-top row">
                                <div class="bid-badge mr-4">
                                    <h4 class="step-title">₹ 4000</h4>
                                    <p>Current Bid Price</p>
                                </div>
                                <div class="bid-badge mr-4">
                                    <h4 class="step-title">5:00:00</h4>
                                    <p>Time Left</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex  border-bottom pb-0">
                            <ul class="nav nav-tabs pt-20 p-0 f-18" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="new-order-tab" data-toggle="tab" href="#order-details" role="tab" aria-controls="home" aria-selected="true">Order Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="requirments-tab" data-toggle="tab" href="#requirements" role="tab" aria-controls="profile" aria-selected="false">Item List</a>
                                </li>
                            </ul>
                        </div>

                        <div class="d-flex">
                            <div class="tab-content w-100" id="myTabContent">
                                <div class="tab-pane fade active show" id="order-details" role="tabpanel" aria-labelledby="order-details-tab">
                                    <div class="d-flex  row pt-3 pr-4 pl-3 margin-topneg-15">
                                        <div class="col-sm-4  secondg-bg   pt-10">
                                            <div class="theme-text f-14 bold p-8">
                                                From
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                From Pincode
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                From Floor
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                To
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                To Pincode
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                To Floor
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                Distance
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                Type of Movement
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                Category
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                Order Price
                                            </div>
                                            <div class="theme-text f-14 bold p-8">
                                                Moving Date
                                            </div>
                                        </div>

                                        <div class="col-sm-5 white-bg  pt-10">
                                            <div class="theme-text f-14 p-8">
                                                ABC Studio, ABC Street, Chennai
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                560097
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                01 (Lift: Yes)
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                LMN Apartment, LMN Street, Bengaluru
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                560097
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                01 (Lift: Yes)
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                563 KM
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                Shared
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                1 BHK
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                Rs. 4000
                                            </div>
                                            <div class="theme-text f-14 p-8">
                                                25 Jan 20
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="requirements" role="tabpanel" aria-labelledby="requirments-tab">
                                    <div class="heading theme-text    p-10  row">
                                        <div class="col-sm-6 " style="margin:0px  !important">
                                            <div class="row ml-10 mt-2">Category:
                                                <div class="bold "> 1 BHK</div> </div>
                                            <table class="table text-center  theme-text grey-br mtop-5 p-10">
                                                <thead class="secondg-bg  p-10 f-14">
                                                <tr>
                                                    <th scope="col">Item</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Size</th>
                                                </tr>
                                                </thead>
                                                <tbody class="mtop-15">
                                                <tr class="tb-border  cursor-pointer">
                                                    <th scope="row">Cupboards</th>
                                                    <td class="text-center">2</td>
                                                    <td class=""><span class=" text-center w-100  ">Large</span></td>
                                                </tr>
                                                <tr class="tb-border  cursor-pointer">
                                                    <th scope="row">Chair</th>
                                                    <td>4</td>
                                                    <td class=""><span class="  text-center  w-100">Medium</span></td>
                                                </tr>
                                                <tr class="tb-border  cursor-pointer border-bottom">
                                                    <th scope="row">TV</th>
                                                    <td>1</td>
                                                    <td class=""><span class="  text-center  w-100">Small</span></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-6  mt-2 ">
                                            Pictures uploaded by the customer
                                            <div class="row d-felx mr-2 justify-content-start  mt-2">
                                                <div class="col-sm-3">
                                                    <img src="./assets/images/Mask Group 1.svg">
                                                </div>
                                                <div class="col-sm-3">
                                                    <img src="./assets/images/Mask Group 2.svg">
                                                </div>
                                                <div class="col-sm-3">
                                                    <img src="./assets/images/Mask Group 3.svg">
                                                </div>
                                                <div class="col-sm-3">
                                                    <img src="./assets/images/Mask Group 2.svg">
                                                </div>
                                                <div class="col-sm-3 mt-3">
                                                    <img src="./assets/images/Mask Group 1.svg">
                                                </div>
                                                <div class="col-sm-3 mt-3">
                                                    <img src="./assets/images/Mask Group 2.svg">
                                                </div>
                                                <div class="col-sm-3 mt-3">
                                                    <img src="./assets/images/Mask Group 3.svg">
                                                </div>
                                                <div class="col-sm-3 mt-3">
                                                    <img src="./assets/images/Mask Group 2.svg">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-top">
                                    <div class="d-flex pb-2 pt-1 justify-content-end button-section">
                                        <button class="btn theme-br theme-text  white-bg  justify-content-center">Quote Later</button>
                                        <button class="btn theme-br theme-text" data-toggle="modal" data-target="#for-friend">Accept</button>
                                        <button class="btn">Reject</button>
                                    </div>
                                </div>
                            </div>
                            <!--  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
