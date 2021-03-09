<div class="modal-header pb-0 border-none">
                    <h3 class="f-14">
                        <ul class="nav nav-tabs  p-0" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active p-15" id="new-order-tab" data-toggle="tab" href="#customer" role="tab" aria-controls="home" aria-selected="true">Customer Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link p-15" id="quotation" data-toggle="tab" href="#vendor" role="tab" aria-controls="profile" aria-selected="false">Vendor Details</a>
                            </li>

                        </ul>
                    </h3>

                    <button type="button" class="close theme-text margin-topneg-10" data-dismiss="modal" aria-label="Close" onclick="$('.side-bar-pop-up').toggleClass('display-pop-up');">
                        <!-- <span aria-hidden="true" >&times;</span> -->
                        <i class="fa fa-times theme-text" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body border-top margin-topneg-7">
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active " id="customer" role="tabpanel" aria-labelledby="new-order-tab">
                            <!-- form starts -->
                            <div class="d-flex  row  p-10">
                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Customer Name
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="theme-text f-14">
                                        David Jerome
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="theme-text f-14">
                                        <i class="icon dripicons-pencil p-1 cursor-pointer" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex  row  p-10">
                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        From Address
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex  row  p-10">
                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        To Address
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex  row  p-10 border-top-pop">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Items to be moved
                                    </div>

                                </div>




                            </div>
                            <table class="table text-center p-10 theme-text">
                                <thead class="secondg-bg  p-0">
                                <tr>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Size</th>

                                </tr>
                                </thead>
                                <tbody class="mtop-20">
                                <tr class="tb-border  cursor-pointer">
                                    <th scope="row">Bed</th>

                                    <td class="text-center">02</td>
                                    <td class=""><span class="red-bg text-center w-100  td-padding">Large</span></td>

                                </tr>
                                <tr class="tb-border  cursor-pointer">
                                    <th scope="row">Cupbords</th>

                                    <td>04</td>
                                    <td class=""><span class="green-bg text-center td-padding-2 w-100">Medium</span></td>

                                </tr>
                                <tr class="tb-border  cursor-pointer">
                                    <th scope="row">Books</th>

                                    <td>03</td>
                                    <td class=""><span class=" light-bg text-center td-padding w-100">Small</span></td>

                                </tr>
                                </tbody>
                            </table>
                            <div class="d-flex   justify-content-center p-10">
                                <div class=""><a class="white-text p-10" href="{{route('order-details',["id"=>1])}}"><button class="btn theme-bg white-text">View More</button></a></div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="vendor" role="tabpanel" aria-labelledby="past-tab">
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Assigned Vendor
                                    </div>

                                </div>
                                <div class="col-sm-5">
                                    <div class="theme-text f-14">
                                        Wayne Pvt Ltd
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="theme-text f-14">
                                        <i class="icon dripicons-pencil p-1 cursor-pointer" aria-hidden="true"></i>
                                    </div>
                                </div>


                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Assigned Vehicle
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        KA03 B 1165
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Assigned Driver
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        Abhi Ram
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Driver Phone Number
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        +91 - 9725364758
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Commission Amount
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        ₹ 2,300
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex  row  p-10">

                                <div class="col-sm-6">
                                    <div class="theme-text f-14 bold">
                                        Discount From Vendor
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="theme-text f-14">
                                        30% Off
                                    </div>
                                </div>



                            </div>
                            <div class="d-flex   justify-content-center p-10">

                                <div class=""><a class="white-text p-10" href="{{route('order-details',["id"=>1])}}"><button class="btn theme-bg white-text">View More</button></a></div>




                            </div>
                        </div>
                        <!--  -->
                    </div>
                </div>