<div class="modal-header pb-0 border-none">
                    <h3 class="f-14">
                        <ul class="nav nav-tabs pt-20 p-0 " id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active pl-2" id="zone-tab" data-toggle="tab" href="#zone" role="tab"
                                    aria-controls="home" aria-selected="true">Zone Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="zone-insight-tab" data-toggle="tab" href="#zone-insight" role="tab"
                                    aria-controls="zone-insight" aria-selected="false">Zone Insights</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="order-trend-tab" data-toggle="tab" href="#order-trend" role="tab"
                                    aria-controls="order-trend" aria-selected="false">Order Trend</a>
                            </li>

                        </ul>
                    </h3>


                    <button type="button" class="close theme-text" data-dismiss="modal" aria-label="Close"
                        onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                        <!-- <span aria-hidden="true" >&times;</span> -->
                        <i class="fa fa-times theme-text" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body border-top margin-topneg-7">
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active " id="zone" role="tabpanel" aria-labelledby="zone-tab">
                            <!-- form starts -->
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Zone Name
                                    </div>

                                </div>
                                <div class="col-sm-5">
                                    <div class="theme-text f-14">
                                        Bengaluru Urban
                                    </div>
                                </div>

                                <div class="col-sm-1">
                                    <div class="theme-text f-14">
                                        <i class="icon dripicons-pencil p-1 cursor-pointer " aria-hidden="true"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Zone ID
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14 d-flex justify-content-between">
                                        <div>Z123u489</div>
                                        <!-- <div><input type="checkbox" checked data-toggle="toggle" data-size="xs" data-width="80" data-height="35" data-onstyle="outline-primary" data-offstyle="outline-secondary" data-on="active" data-off="inactive" id=""></div> -->
                                        <!-- <label class="switch-small">
                                            <input type="checkbox" id="switch">
                                            <span class="slider"></span>
                                        </label> -->

                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        State
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        Karnataka
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        City
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        <div class="d-flex vertical-center">
                                            Bengaluru

                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        District
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        Bengaluru Urban
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Status
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14 status-badge text-center">
                                        Completed
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Created By
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        David Jerome
                                    </div>
                                </div>



                            </div>



                            <div class="d-flex   justify-content-center p-10">

                                <div class=""><a class="white-text p-10" href="{{route('details-zones')}}" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');"><button
                                            class="btn theme-bg white-text">View More</button></a></div>




                            </div>
                        </div>
                        <div class="tab-pane fade  " id="zone-insight" role="tabpanel" aria-labelledby="zone-insight-tab">
                            <div class="d-flex  row  p-10 mr-2">

                                <div class="col-sm-6 -ml-10">
                                    <div class="theme-text f-14 bold">
                                        Total No Venders
                                    </div>

                                </div>
                                <div class="col-sm-5">
                                    <div class="theme-text f-14">
                                        1200
                                    </div>
                                </div>

                                <div class="col-sm-1">
                                    <div class="theme-text f-14">
                                        <i class="icon dripicons-pencil p-1 cursor-pointer " aria-hidden="true"></i>
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex  row mr-2 p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Categories
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        03
                                    </div>
                                </div>



                            </div>


                            <!-- <div class="d-flex  row  p-10">

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
                                        <th scope="col">Status</th>
                                        <th scope="col">Order Date</th>

                                    </tr>
                                </thead>
                                <tbody class="mtop-20">
                                    <tr class="tb-border  cursor-pointer">
                                        <th scope="row">SKU123456</th>


                                        <td class=""><span class="light-bg text-center status-badge">Enquiry</span></td>
                                        <td class="text-center">23 Dec 20</td>

                                    </tr>
                                    <tr class="tb-border  cursor-pointer">
                                        <th scope="row">SKU123456</th>
                                        <td class=""><span class=" p-color text-center status-badge">In Transit</span>
                                        </td>
                                        <td>23 Dec 20</td>


                                    </tr>
                                    <tr class="tb-border  cursor-pointer">
                                        <th scope="row">SKU123456</th>
                                        <td class=""><span class="  text-center status-badge">Awaiting
                                                Pickup</span></td>
                                        <td>24 Dec 20</td>


                                    </tr>
                                </tbody>
                            </table> -->




                            <div class="col-sm-12 mtop-20  p-10 " >
                                <div class="theme-text f-14 pb-3 pl-0 bold">
                                    List of Orders
                                </div>
                                <table class="table text-center p-10 theme-text tb-border2" id="items" >

                                    <thead class="secondg-bg  p-0">
                                        <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Order Date</th>

                                        </tr>
                                    </thead>

                                    <tbody class="mtop-20">
                                        <tr class="  cursor-pointer">
                                            <th scope="row">SKU123456</th>


                                            <td class=""><span class="light-bg text-center status-badge">Enquiry</span></td>
                                            <td class="text-center">23 Dec 20</td>

                                        </tr>
                                        <tr class="  cursor-pointer">
                                            <th scope="row">SKU123456</th>
                                            <td class=""><span class=" p-color text-center status-badge">In Transit</span>
                                            </td>
                                            <td>23 Dec 20</td>


                                        </tr>
                                        <tr class="  cursor-pointer">
                                            <th scope="row">SKU123456</th>
                                            <td class=""><span class="  text-center status-badge">Awaiting
                                                    Pickup</span></td>
                                            <td>24 Dec 20</td>


                                        </tr>
                                    </tbody>
                                </table>
                            </div>














                        <div class="col-sm-12 mtop-20  p-10 " >
                            <div class="theme-text f-14 pb-3 pl-0 bold">
                                List of Coupons
                            </div>
                            <table class="table text-center p-10 theme-text tb-border2" id="items" >

                                <thead class="secondg-bg bx-shadowg p-0 f-14">
                                    <tr>
                                        <th scope="col">Coupon</th>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Order Date</th>

                                    </tr>
                                </thead>

                                <tbody class="mtop-20">
                                    <tr class="cursor-pointer">
                                        <th scope="row">SKU123456</th>


                                        <td class=""><span class=" text-center ">30%</span></td>
                                        <td class="text-center">23 Dec 20</td>

                                    </tr>
                                    <tr class="cursor-pointer">
                                        <th scope="row">SKU123456</th>
                                        <td class=""><span class=" text-center ">40%</span></td>
                                        <td>23 Dec 20</td>


                                    </tr>
                                    <tr class="cursor-pointer">
                                        <th scope="row">SKU123456</th>
                                        <td class=""><span class="  text-center ">60%</span></td>
                                        <td>24 Dec 20</td>


                                    </tr>
                                </tbody>
                            </table>
                        </div>
                            <div class="d-flex   justify-content-center p-10">

                                <div class=""><a class="white-text p-10" href="zone-details.html" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');"><button
                                            class="btn theme-bg white-text">View More</button></a></div>




                            </div>
                        </div>
                        <div class="tab-pane fade" id="order-trend" role="tabpanel" aria-labelledby="order-trend-tab">
                            <div class="d-flex p-10">
                                <i><img src="./assets/images/graph/graph.svg" alt="" srcset=""></i>
                            </div>
                            <div class="d-flex   justify-content-center p-10">

                                <div class=""><a class="white-text p-10" href="zone-details.html" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');"><button
                                            class="btn theme-bg white-text">View More</button></a></div>




                            </div>

                        </div>


                        <!--  -->
                    </div>
                </div>
