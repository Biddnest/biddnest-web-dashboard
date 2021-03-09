<div class="modal-header pb-0 border-none">
                    <h3 class="f-14">
                        <ul class="nav nav-tabs pt-20 p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active pb-3" id="new-order-tab" data-toggle="tab" href="#vendor" role="tab"
                                aria-controls="home" aria-selected="true">Users Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pb-3" id="quotation" data-toggle="tab" href="#customer" role="tab"
                                aria-controls="profile" aria-selected="false">Users Insights</a>
                            </li>

                        </ul>
                    </h3>

                    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close"
                            onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                        <i class="fa fa-times theme-text" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body border-top margin-topneg-7">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="vendor" role="tabpanel" aria-labelledby="past-tab">

                            <div class="row d-flex  pb-4 pl-3">
                                <div class="col-lg-12 ">
                                    <div class="profile-section">
                                        <figure>
                                            <img src="assets/images/big-profile.svg" alt="">
                                        </figure>
                                        <div class="profile-details-side-pop">
                                            <ul>
                                                <li>
                                                    <h1>David Jerome</h1>
                                                    <i class="fa fa-pencil pr-1 mr-1 " style="color: #3BA3FB;" aria-hidden="true"></i>
                                                </li>
                                                <li>
                                                    <h2>davidjerome@ymail.com</h2>
                                                    <a href="#">
                                                        <i class="fa fa-star-o pr-1 mr-1" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <p>+91-9739823457</p>

                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row d-flex pb-4 pl-3">
                                <div class="col-lg-6 align-items-center">
                                    <h1 class="side-popup-heading">Date of Birth</h1>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                                    <h1 class="side-popup-content">30 / 07 / 1995</h1>
                                </div>
                            </div>
                            <div class="row d-flex pb-4 pl-3">
                                <div class="col-lg-6 align-items-center">
                                    <h1 class="side-popup-heading">Gender</h1>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                                    <h1 class="side-popup-content">Male</h1>
                                </div>
                            </div>
                            <div class="row d-flex pb-4 pl-3">
                                <div class="col-lg-6 align-items-center">
                                    <h1 class="side-popup-heading">Zone</h1>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                                    <h1 class="side-popup-content">Bengaluru Urban</h1>
                                </div>
                            </div>
                            <div class="row d-flex pb-4 pl-3">
                                <div class="col-lg-6 align-items-center">
                                    <h1 class="side-popup-heading">No of Orders</h1>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                                    <h1 class="side-popup-content">10</h1>
                                </div>
                            </div>
                            <div class="row d-flex pb-4 pl-3">
                                <div class="col-lg-6 align-items-center">
                                    <h1 class="side-popup-heading">Status</h1>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-between align-items-center">
                                    <div class="status-badge">Enquiry</div>
                                </div>
                            </div>



                            <div class="d-flex justify-content-center p-20">
                                <!-- <div class="">
                                    <a class="white-text p-10" href="#">
                                        <button class="btn theme-bg white-text my-0" style="width: 127px;
                                        border-radius: 6px;">View More</button>
                                    </a>
                                </div> -->
                            </div>



                        </div>
                        <div class="tab-pane fade  margin-topneg-15" id="customer" role="tabpanel"
                            aria-labelledby="new-order-tab">
                            <!-- form starts -->
                            <div class="d-flex row pt-3 p-20">
                                <div class="col-lg-6">
                                    <div class="theme-text f-14 bold">
                                        List of Orders
                                    </div>
                                </div>
                            </div>
                            <table class="table text-center p-10 theme-text th-no-border">
                                <thead class="secondg-bg p-0" >
                                <tr>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Order Date</th>

                                </tr>
                                </thead>
                                <tbody class="mtop-20">
                                <tr class="cursor-pointer">
                                    <td scope="row">
                                        <p style="text-decoration: underline;margin: 0;">SKU12345</p>
                                    </td>
                                    <td class="">
                                        <div class="status-badge">Bidding</div>
                                    </td>
                                    <td class="text-center">23 Dec 20</td>

                                </tr>
                                <tr class="cursor-pointer">
                                    <td scope="row">
                                        <p style="text-decoration: underline;margin: 0;">SKU12335</p>
                                    </td>
                                    <td class="">
                                        <div class="status-badge">In Transit</div>
                                    </td>
                                    <td class="text-center">23 Dec 20</td>

                                </tr>
                                <tr class="cursor-pointer" style="border-bottom: 1px solid #dee2e6;">
                                    <td scope="row">
                                        <p style="text-decoration: underline;margin: 0;">SKU12348</p>
                                    </td>
                                    <td class="">
                                        <div class="status-badge">Awaiting Packup</div>
                                    </td>
                                    <td class="text-center">26 Dec 20</td>
                                </tr>

                                </tbody>
                            </table>

                            <div class="d-flex row pt-3 p-20">
                                <div class="col-lg-6">
                                    <div class="theme-text f-14 bold">
                                        List of Coupons
                                    </div>
                                </div>
                            </div>
                            <table class="table text-center p-10 theme-text th-no-border">
                                <thead class="secondg-bg p-0" >
                                <tr>
                                    <th scope="col">Coupon Code</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Order Date</th>

                                </tr>
                                </thead>
                                <tbody class="mtop-20">
                                <tr class="cursor-pointer">
                                    <td scope="row">
                                        <p style="text-decoration: underline;margin: 0;">SKU12348</p>
                                    </td>
                                    <td class="">
                                        30%
                                    </td>
                                    <td class="text-center">23 Dec 20</td>

                                </tr>
                                <tr class="cursor-pointer">
                                    <td scope="row">
                                        <p style="text-decoration: underline;margin: 0;">SKU12448</p>
                                    </td>
                                    <td class="">
                                        45%
                                    </td>
                                    <td class="text-center">23 Dec 20</td>

                                </tr>
                                <tr class="cursor-pointer" style="border-bottom: 1px solid #dee2e6;">
                                    <td scope="row">
                                        <p style="text-decoration: underline;margin: 0;">SKU12349</p>
                                    </td>
                                    <td class="">
                                        60%
                                    </td>
                                    <td class="text-center">26 Dec 20</td>
                                </tr>

                                </tbody>
                            </table>

                            <div class="d-flex   justify-content-center p-20">

                                <!-- <div class=""><a class="white-text p-10" href="#">
                                    <button class="btn theme-bg white-text my-0" style="width: 127px;
                                    border-radius: 6px;">View More</button>
                                        </a></div> -->




                            </div>
                        </div>


                        <!--  -->
                    </div>
                </div>